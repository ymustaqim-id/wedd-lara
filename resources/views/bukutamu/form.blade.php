
<div class="modal-dialog modal-simple">
  {{ Form::model($bukutamu,array('route' => array((!$bukutamu->exists) ? 'bukutamu.store':'bukutamu.update',$bukutamu->pk()),
  'class'=>'modal-content','id'=>'bukutamu-form','method'=>(!$bukutamu->exists) ? 'POST' : 'PUT')) }}
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="formModalLabel">{{ ($bukutamu->exists?'Edit':'Tambah').' bukutamu' }}</h4>
  </div>
  <div class="modal-body">
    {!! App\Console\Commands\Generator\Form::input('id','hidden')->model($bukutamu)->showHidden() !!}
    {!! App\Console\Commands\Generator\Form::input('nama','text')->model($bukutamu)->show() !!}
    {!! App\Console\Commands\Generator\Form::input('alamat','text')->model($bukutamu)->show() !!}
    {!! App\Console\Commands\Generator\Form::input('nominal','text')->model($bukutamu)->show() !!}
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

//format rupiah here
var rupiah = document.getElementById('nominal');
    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
//end
</script>
