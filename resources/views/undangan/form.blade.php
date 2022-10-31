
<div class="modal-dialog modal-simple">
  {{ Form::model($undangan,array('route' => array((!$undangan->exists) ? 'undangan.store':'undangan.update',$undangan->pk()),
  'class'=>'modal-content','id'=>'undangan-form','method'=>(!$undangan->exists) ? 'POST' : 'PUT')) }}
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="formModalLabel">{{ ($undangan->exists?'Edit':'Tambah').' undangans' }}</h4>
  </div>
  <div class="modal-body">
    {!! App\Console\Commands\Generator\Form::input('id','hidden')->model($undangan)->showHidden() !!}
    {!! App\Console\Commands\Generator\Form::input('nama','text')->model($undangan)->show() !!}
    {!! App\Console\Commands\Generator\Form::input('wa','text')->model($undangan)->show() !!}
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
            message: 'nama wajib diisi'
          }
        }
      },
      email: {
        validators: {
          notEmpty: {
            message: 'email wajib diisi'
          },
          emailAddress: {
            message: 'format email example@example.com'
          },
          callback: {
            message: 'email sudah dipakai',
            callback: function(value, validator, $field){
              // return true;
              cekemail = cekEmail($('#email').val(),$('#id').val());
              if (cekemail == 'kosong') {
                return true;
              }else{
                return false;
              }

            }
          },
        }
      },
      password: {
        validators: {
          notEmpty: {
            message: 'password wajib diisi'
          },
          stringLength: {
            min: 8,
            message: 'password wajib terdiri 8 karakter atau lebih'
          }
        }
      },
      username: {
        validators: {
          notEmpty: {
            message: 'username wajib diisi'
          },
          stringLength: {
            max: 50,
            message: 'username tidak boleh melebihi 50 karakter'
          },
          callback: {
            message: 'usename sudah dipakai',
            callback: function(value, validator, $field){
              // return true;
              cekusername = cekUsername($('#username').val(),$('#id').val());
              if (cekusername == 'kosong') {
                return true;
                // console.log('data boleh masuk');
              }else{
                return false;
                // console.log('data ga boleh masuk');
              }
              // console.log(cekusername);
              // return false;

            }
          },
        }
      },
      role: {
        validators: {
          notEmpty: {
            message: 'role wajib diisi'
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
  },
})



$.ajax({
  url : "{{url('user/get-role')}}",
  type: "GET",
  dataType: "JSON",
  success: function(data){
// console.log(data.length);
    // console.log('aaaa');
    $.each(data,function(key,value){
      // console.log(value.length);
      if(value.length>0)
      {
        $('#role').empty();
        $('#role').append('<option value="" selected>-Pilih-</option>');
        value.forEach(function(data) {
                // alertc
                // alert(data.id);
                if($('#id_role_default').val()==data.id){
                    // alert('aaaa');
                    $('#role').append('<option value="'+data.id+'" selected>'+data.display_name+'</option>').trigger('change');
                  }
                  else{
                    $('#role').append('<option value="'+data.id+'">'+data.display_name+'</option>');
                  }

                });
      }else{
        $('#role').empty();
        $('#role').append('<option value=""selected>-Data is empty-</option>');
      }
    });
  },error: function (jqXHR, textStatus, errorThrown){
    alert('Error get data from ajax');
  }
});
function cekUsername(username,id_user){
  var cek = function () {
    var tmp = null;
    $.ajax({
      async: false,
      url : "{{url('user/cek-username')}}",
      type: "GET",
      dataType: "JSON",
      data:{
        username: username,
        id_user: id_user
      },
      success: function(data){
        // status = data.status;
        // console.log(data);
        tmp = data.status;
      }
    });
    return tmp;
  }();
  return cek;
};

function cekEmail(email,id_user){
  var cek = function () {
    var tmp = null;
    $.ajax({
      async: false,
      url : "{{url('user/cek-email')}}",
      type: "GET",
      dataType: "JSON",
      data:{
        email: email,
        id_user: id_user
      },
      success: function(data){
        tmp = data.status;
      }
    });
    return tmp;
  }();
  return cek;
};
</script>
