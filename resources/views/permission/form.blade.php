<div class="modal-dialog modal-simple">

		{{ Form::model($permission,array('route' => array((!$permission->exists) ? 'permission.store':'permission.update',$permission->pk()),
	        'class'=>'modal-content','id'=>'permission-form','method'=>(!$permission->exists) ? 'POST' : 'PUT')) }}

		<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="formModalLabel">{{ ($permission->exists?'Edit':'Tambah').' Permissions' }}</h4>
    </div>
    <div class="modal-body">
					    {!! App\Console\Commands\Generator\Form::input('name','text')->model($permission)->show() !!}
					    {!! App\Console\Commands\Generator\Form::input('display_name','text')->model($permission)->show() !!}
					    {!! App\Console\Commands\Generator\Form::input('description','text')->model($permission)->show() !!}
				<div class="col-md-12 float-right">
					<div class="text-right">
						<button class="btn btn-primary" id="simpan">Simpan</button>
					</div>
				</div>
		</div>

	    {{ Form::close() }}
</div>


<script type="text/javascript">
$(document).ready(function(){
	$('#permission-form').formValidation({
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
