
<div class="modal-dialog modal-simple">
  {{ Form::model($user,array('route' => array((!$user->exists) ? 'user.store':'user.update',$user->pk()),
  'class'=>'modal-content','id'=>'user-form','method'=>(!$user->exists) ? 'POST' : 'PUT')) }}
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="formModalLabel">{{ ($user->exists?'Edit':'Tambah').' Users' }}</h4>
    </div>
    <div class="modal-body">
      {!! App\Console\Commands\Generator\Form::input('name','text')->model($user)->show() !!}
      {!! App\Console\Commands\Generator\Form::input('username','text')->model($user)->show() !!}
      {!! App\Console\Commands\Generator\Form::input('email','text')->model($user)->show() !!}
      {!! App\Console\Commands\Generator\Form::input('password','password')->model($user)->show() !!}
      {!! App\Console\Commands\Generator\Form::autocomplete('jabatan',array('value'=>$user->exists?(isset($user->jabatan)?$user->jabatan->jabatan:null):null))->model(null)->show() !!}
      {!! App\Console\Commands\Generator\Form::input('id_jabatan','hidden')->model($user)->showHidden() !!}
      {!! App\Console\Commands\Generator\Form::radio('jenis_kelamin','Jenis Kelamin',array(
    								array('value'=>'L','label'=>'Laki-laki'),
    								array('value'=>'P','label'=>'Perempuan'),
                  ),$user->exists?$user->jenis_kelamin:'L') !!}
      <div class="col-md-12 float-right">
        <div class="text-right">
          <button class="btn btn-primary" id="simpan">Simpan</button>
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>
<script>
$('#user-form').formValidation({
  framework: "bootstrap4",
  button: {
    selector: '#simpan',
    disabled: 'disabled'
  },
  icon: null,
  fields: {
    name: {
      validators: {
        notEmpty: {
          message: 'The full name is required and cannot be empty'
        }
      }
    },
    email: {
      validators: {
        notEmpty: {
          message: 'The email address is required and cannot be empty'
        },
        emailAddress: {
          message: 'The email address is not valid'
        }
      }
    },
    password: {
        validators: {
          notEmpty: {
            message: 'The password is required'
          },
          stringLength: {
            min: 8,
            message: 'The content must be less than 8 characters long'
          }
        }
      },
    username: {
      validators: {
        notEmpty: {
          message: 'The content is required and cannot be empty'
        },
        stringLength: {
          max: 50,
          message: 'The content must be less than 50 characters long'
        }
      }
    },
    id_jabatan: {
      validators: {
        notEmpty: {
          message: 'The content is required and cannot be empty'
        },
      }
    },
  },
  err: {
    clazz: 'invalid-feedback'
  },
  control: {
    // The CSS class for valid control
    valid: 'is-valid',

    // The CSS class for invalid control
    invalid: 'is-invalid'
  },
  row: {
    invalid: 'has-danger'
  }
});
// var state = new Bloodhound({
//   datumTokenizer: Bloodhound.tokenizers.whitespace,
//   queryTokenizer: Bloodhound.tokenizers.whitespace,
//   cache: false,
//   local: states
// });

var jabatanEngine = new Bloodhound({
	datumTokenizer: function(d) { return d.tokens; },
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	cache: false,
	remote: {
		url: '{{ url("autocomplete/jabatan") }}?q=%QUERY',
		wildcard: "%QUERY"
	}
});

// passing in `null` for the `options` arguments will result in the default
// options being used
$('#jabatan').typeahead({
  hint: true,
	highlight: true,
	minLength: 1
},
{
  name: 'jabatan',
  displayKey: 'jabatan',
  source: jabatanEngine.ttAdapter(),
  templates: {
			suggestion: function(data){
				return Handlebars.compile([
								// "<div class=\"tt-menu\">",
											"<div class=\"tt-dataset\">",
													"<div>@{{jabatan}}</div>",
											"</div>",
								// "</div>",
							].join(""))(data);
			},
				empty: [
						"<div>jabatan tidak ditemukan</div>"
				]
		}
}).bind("typeahead:selected", function(obj, datum, name) {
	$("#id_jabatan").val(datum.id);
}).bind("typeahead:change", function(obj, datum, name) {

});
</script>
