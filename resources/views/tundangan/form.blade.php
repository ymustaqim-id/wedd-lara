<div class="modal-dialog modal-simple">

    {{ Form::model($tundangan, [
        'route' => [!$tundangan->exists ? 'tundangan.store' : 'tundangan.update', $tundangan->pk()],
        'class' => 'modal-content',
        'id' => 'tundangan-from',
        'method' => !$tundangan->exists ? 'POST' : 'PUT',
    ]) }}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="formModalLabel">{{ ($tundangan->exists ? 'Edit' : 'Tambah') . ' Template Undangan' }}</h4>
    </div>
    <div class="modal-body">
        {!! App\Console\Commands\Generator\Form::textarea('template')->model($tundangan)->show() !!}
        <div class="col-md-12 float-right">
            <div class="text-right">
                <button class="btn btn-primary" id="simpan">Simpan</button>
            </div>
        </div>
    </div>

    {{ Form::close() }}
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#tundangan-from').formValidation({
            framework: "bootstrap4",
            button: {
                selector: "#simpan",
                disabled: "disabled"
            },
            icon: null,
            fields: {
                template: {
                    validators: {
                        notEmpty: {
                            message: 'Kolom template tidak boleh kosong'
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
