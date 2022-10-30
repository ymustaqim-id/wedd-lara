<div class="modal-dialog modal-simple">

		{{ Form::model($<?=$gen->modelVariableName()?>,array('route' => array((!$<?=$gen->modelVariableName()?>->exists) ? '<?=$gen->route()?>.store':'<?=$gen->route()?>.update',$<?=$gen->modelVariableName()?>->pk()),
	        'class'=>'modal-content','id'=>'<?=$gen->route()?>-form','method'=>(!$<?=$gen->modelVariableName()?>->exists) ? 'POST' : 'PUT')) }}

		<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="formModalLabel">{{ ($<?=$gen->modelVariableName()?>->exists?'Edit':'Tambah').' <?=$gen->titlePlural()?>' }}</h4>
    </div>
    <div class="modal-body">
				<?php foreach ( $fields as $field )  { ?>
				<?php if( $str = App\Console\Commands\Generator\Db::getFormInputMarkup( $field, $gen->modelVariableName() ) ) { ?>
				        <?=$str?>
				<?php } ?>
				<?php } ?>
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
	$('#<?=$gen->route()?>-form').formValidation({
	  framework: "bootstrap4",
	  button: {
	    selector: "#simpan",
	    disabled: "disabled"
	  },
	  icon: null,
	  fields: {
	<?php
		$jsScript = "";
		$jsScriptAutocomplete = "";
		$timestampType = false;
		foreach ( $fields as $field )  {
			// if($field->type=="timestamp"){ $timestampType=true; }
			if(in_array($field->name, App\Console\Commands\Generator\Db::skippedFields()) && $field->name!='created_at' && $field->name!='updated_at') continue;
				if($field->required){
					$jsScript.= $field->name;
					$jsScript.= " : { ";
					$jsScript.= "validators: {
				        notEmpty: {
				          message: 'Kolom ".$field->name." tidak boleh kosong'
							}
						}
					},";
					// $jsScript.=" }, ";
				}

				if(($field->type == 'int')&&(preg_match("/id_|_id/",$field->name,$match))){
					$fieldName = preg_replace("/id_|_id/","",$field->name);
					$temp ='
					var '.$fieldName.'Engine = new Bloodhound({
							datumTokenizer: function(d) { return d.tokens; },
							queryTokenizer: Bloodhound.tokenizers.whitespace,
							cache: false,
							remote: {
								url: \'{{ url("autocomplete/'.$fieldName.'") }}?q=%QUERY\',
								wildcard: "%QUERY"
							}
						});

						$("#'.$fieldName.'").typeahead({
									hint: true,
									highlight: true,
									minLength: 1
							},
							{
									source: '.$fieldName.'Engine.ttAdapter(),
									name: "'.$fieldName.'",
									displayKey: "'.$fieldName.'",
									templates: {
										suggestion: function(data){
											return Handlebars.compile([
																"<div class=\"tt-dataset\">",
																		"<div>@{{'.$fieldName.'}}</div>",
																"</div>",
														].join(""))(data);
										},
											empty: [
													"<div>'.$fieldName.' tidak ditemukan</div>"
											]
									}
							}).bind("typeahead:selected", function(obj, datum, name) {
								$("#id_'.$fieldName.'").val(datum.id);
							}).bind("typeahead:change", function(obj, datum, name) {

							});
					';
					$jsScriptAutocomplete .=$temp;
				}
		}
		$jsScript=rtrim($jsScript, ",");
		echo $jsScript."\n";
	?>
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
	<?php if($timestampType) {?>
	$('.tanggal-picker').datepicker({format:'yyyy-mm-dd',autoclose:true,todayHighlight: true});
	<?php
	}
	echo $jsScriptAutocomplete."\n";
	?>

});
</script>
