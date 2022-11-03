@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Template Undangan WA</h1>
        {{-- @include('layouts.inc.breadcrumb') --}}
        {{-- <div class="page-header-actions">
            <a class="btn btn-block btn-primary data-modal" id="data-modal" href="#"
                onclick="show_modal('{{ route('tundangan.create') }}')">Tambah</a>
        </div> --}}
    </div>
    <div class="page-content">
        <!-- Panel Table Tools -->
        <div class="row">
            <div class="col-md-12">

                <div class="panel">
                    {{ Form::model($tundangan, [
                    'route' => [!$tundangan ? 'tundangan.store' : 'tundangan.update',$tundangan->pk()],
                    'class' => 'modal-content',
                    'id' => 'tundangan-from',
                    'method' => !$tundangan ? 'POST' : 'PUT',
                    ]) }}
                    {{-- {{ $tundangan }} --}}
                    <input type="hidden" name="id" value="{{ isset($tundangan->id) ? $tundangan->id : '' }}">
                    <div class="panel-body">
                        <textarea id="summernote" data-plugin="summernote" name="template">
                            {{ isset($tundangan->template) ? $tundangan->template : '' }}
                        </textarea>
                    </div>

                    <div class="col-md-7 float-right">
                        <div class="text-right">
                            <button class="btn btn-primary" id="simpan">Simpan</button>
                        </div>
                    </div><br><br>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
