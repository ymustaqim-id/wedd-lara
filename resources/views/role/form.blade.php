<div class="modal-dialog modal-simple">

		{{ Form::model($role,array('route' => array((!$role->exists) ? 'role.store':'role.update',$role->pk()),
	        'class'=>'modal-content','id'=>'role-form','method'=>(!$role->exists) ? 'POST' : 'PUT')) }}

		<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="formModalLabel">{{ ($role->exists?'Edit':'Tambah').' Roles' }}</h4>
    </div>
    <div class="modal-body">
																				        {!! App\Console\Commands\Generator\Form::input('name','text')->model($role)->show() !!}
																        {!! App\Console\Commands\Generator\Form::input('display_name','text')->model($role)->show() !!}
																        {!! App\Console\Commands\Generator\Form::input('description','text')->model($role)->show() !!}
																												<div class="col-md-12 float-right">
					<div class="text-right">
						<button class="btn btn-primary" id="simpan">Simpan</button>
					</div>
				</div>
		</div>

	    {{ Form::close() }}
</div>

<script src="{{ asset('admin_remark_base/') }}/assets/js/ModalShow.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#role-form').formValidation({
	  framework: "bootstrap4",
	  button: {
	    selector: "#simpan",
	    disabled: "disabled"
	  },
	  icon: null,
	  fields: {
	name : { validators: {
				        notEmpty: {
				          message: 'Kolom name tidak boleh kosong'
							}
						}
					}
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
	

});
</script>
