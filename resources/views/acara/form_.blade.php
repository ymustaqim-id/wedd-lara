
{{ Form::model($user,array('route' => array((!$user->exists) ? 'user.store':'user.update',$user->pk()),
'class'=>'modal-content','id'=>'user-form','method'=>(!$user->exists) ? 'POST' : 'PUT')) }}
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			<h4 class="modal-title" id="formModalLabel">{{ ($user->exists?'Edit':'Tambah').' Users' }}</h4>
		</div>


		<div class="modal-body">

        <!-- {!! App\Console\Commands\Generator\Form::input('name','text')->model($user)->show() !!}
				{!! App\Console\Commands\Generator\Form::input('username','text')->model($user)->show() !!}
				{!! App\Console\Commands\Generator\Form::input('email','text')->model($user)->show() !!}
				{!! App\Console\Commands\Generator\Form::input('email_verified_at','text')->model($user)->show() !!}
				{!! App\Console\Commands\Generator\Form::input('password','text')->model($user)->show() !!}
				{!! App\Console\Commands\Generator\Form::input('jenis_kelamin','text')->model($user)->show() !!}
				{!! App\Console\Commands\Generator\Form::input('id_jabatan','text')->model($user)->show() !!}
				{!! App\Console\Commands\Generator\Form::input('remember_token','text')->model($user)->show() !!} -->
					<div class="col-md-12">
						<button class="btn btn-primary" data-dismiss="modal" type="button">Simpan</button>
					</div>
		</div>
	  {{ Form::close() }}

@push('js')
<script type="text/javascript">
$(document).ready(function(){
	var rule=defaultValidation;

	rule.rules = {
	name : { required: true }, username : { required: true }, email : { required: true }, password : { required: true }, id_jabatan : { required: true },
	};
	$('#user-form').validate(rule);
		$('.tanggal-picker').datepicker({format:'yyyy-mm-dd',autoclose:true,todayHighlight: true});


});
</script>
@endpush
