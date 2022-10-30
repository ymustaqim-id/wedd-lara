function notification( message,type ) {
  if( type == 'success' ) {
        toastr.success(message,'<i>Success</i>');
    } else if( type == 'error' ) {
        toastr.error(message,'error');
    } else if( type == 'warning' ) {
        toastr.warning(message,'Warning');
    } else {
        toastr.info(message,'Information');
    }
};
function show_modal(url) { // clear error string
    $.ajax({
      url:url,
      dataType: 'text',
      success: function(data) {
        $("#formModal").html(data);
        $("#formModal").modal('show');
        // todo:  add the html to the dom...
      }
    });
};
function hapus(url) { // clear error string
  var token = $("meta[name='csrf-token']").attr("content");
  swal({
      title: "Delete",
      text: "Apakah anda yakin akan menghapus data ?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes",
      closeOnConfirm: false
  },
  function(){
      $.ajax({
        url : url,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success:function(){
          swal('Data Berhasil Dihapus', ' ', 'success');

          setTimeout(function() {
  //your code to be executed after 1 second
          location.reload();
          }, 1000);
        },
    });
  });
};
