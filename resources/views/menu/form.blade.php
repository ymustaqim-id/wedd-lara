<div class="modal-dialog modal-simple">

		{{ Form::model($menu,array('route' => array((!$menu->exists) ? 'menu.store':'menu.update',$menu->pk()),
	        'class'=>'modal-content','id'=>'menu-form','method'=>(!$menu->exists) ? 'POST' : 'PUT')) }}

		<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="formModalLabel">{{ ($menu->exists?'Edit':'Tambah').' Menu' }}</h4>
    </div>
    <div class="modal-body">
			        {!! App\Console\Commands\Generator\Form::input('name','text')->model($menu)->show() !!}
				      {!! App\Console\Commands\Generator\Form::input('url','text')->model($menu)->show() !!}
				      {!! App\Console\Commands\Generator\Form::input('icon','text')->model($menu)->show() !!}
				      {!! App\Console\Commands\Generator\Form::input('ordinal','text')->model($menu)->show() !!}
				      {!! App\Console\Commands\Generator\Form::input('parent_status','text')->model($menu)->show() !!}
				      {!! App\Console\Commands\Generator\Form::input('parent_id','hidden')->model($menu)->showHidden() !!}
							{!! App\Console\Commands\Generator\Form::autocomplete('parent',array('value'=>$menu->exists?(isset($menu->parent)?$menu->parent->parent:null):null))->model(null)->show() !!}
				      {!! App\Console\Commands\Generator\Form::input('permission_id','hidden')->model($menu)->showHidden() !!}
							{!! App\Console\Commands\Generator\Form::autocomplete('permission',array('value'=>$menu->exists?(isset($menu->permission)?$menu->permission->permission:null):null))->model(null)->show() !!}
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
	$('#menu-form').formValidation({
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

					var parentEngine = new Bloodhound({
							datumTokenizer: function(d) { return d.tokens; },
							queryTokenizer: Bloodhound.tokenizers.whitespace,
							cache: false,
							remote: {
								url: '{{ url("autocomplete/parent") }}?q=%QUERY',
								wildcard: "%QUERY"
							}
						});

						$("#parent").typeahead({
									hint: true,
									highlight: true,
									minLength: 1
							},
							{
									source: parentEngine.ttAdapter(),
									name: "parent",
									displayKey: "parent",
									templates: {
										suggestion: function(data){
											return Handlebars.compile([
																"<div class=\"tt-dataset\">",
																		"<div>@{{jabatan}}</div>",
																"</div>",
														].join(""))(data);
										},
											empty: [
													"<div>parent tidak ditemukan</div>"
											]
									}
							}).bind("typeahead:selected", function(obj, datum, name) {
								$("#id_parent").val(datum.id);
							}).bind("typeahead:change", function(obj, datum, name) {

							});

					var permissionEngine = new Bloodhound({
							datumTokenizer: function(d) { return d.tokens; },
							queryTokenizer: Bloodhound.tokenizers.whitespace,
							cache: false,
							remote: {
								url: '{{ url("autocomplete/permission") }}?q=%QUERY',
								wildcard: "%QUERY"
							}
						});

						$("#permission").typeahead({
									hint: true,
									highlight: true,
									minLength: 1
							},
							{
									source: permissionEngine.ttAdapter(),
									name: "permission",
									displayKey: "permission",
									templates: {
										suggestion: function(data){
											return Handlebars.compile([
																"<div class=\"tt-dataset\">",
																		"<div>@{{jabatan}}</div>",
																"</div>",
														].join(""))(data);
										},
											empty: [
													"<div>permission tidak ditemukan</div>"
											]
									}
							}).bind("typeahead:selected", function(obj, datum, name) {
								$("#permission_id").val(datum.id);
							}).bind("typeahead:change", function(obj, datum, name) {

							});


});
</script>
