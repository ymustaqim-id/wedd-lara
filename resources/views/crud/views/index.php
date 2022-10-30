@extends('layouts.app')

@section('content')
   <div class="page-header">
     <h1 class="page-title"><?=$gen->titlePlural()?></h1>
      @include('layouts.inc.breadcrumb')
     <div class="page-header-actions">
     <a class="btn btn-block btn-primary data-modal" id="data-modal" href="#" onclick="show_modal('{{ route('<?=$gen->route()?>.create') }}')" >Tambah</a>
     </div>
   </div>
   <div class="page-content">
     <!-- Panel Table Tools -->
     <div class="panel">
       <header class="panel-heading">
         <div class="form-group col-md-12">
           <div class="form-group">
         <!-- <h3 class="panel-title">Table Tools</h3> -->

           </div>
         </div>
       </header>
       <div class="panel-body">
         <!-- <table class="table table-bordered" id="users-table">

         </table> -->
         <table class="table table-hover dataTable table-striped w-full" id="<?=$gen->route()?>-table">
           <thead>
               <tr>
                 <th>No</th>
       <?php foreach ( $fields as $field )  { ?>
      <?php if(in_array($field->name, App\Console\Commands\Generator\Db::skippedFields()) && $field->name!='created_at') continue;?>
                        <th><?=$field->name?></th>
      <?php } ?>
                 <th>Action</th>
               </tr>
           </thead>
         </table>
       </div>
     </div>
     <!-- End Panel Table Tools -->
 </div>
 <div class="modal fade" id="formModal" aria-hidden="true" aria-labelledby="formModalLabel" role="dialog" tabindex="-1">
 </div>

@endsection

@push('js')
<script type="text/javascript">
$(function() {
  $('.trash-ck').click(function(){
    if ($('.trash-ck').prop('checked')) {
      document.location = '{{ url("<?=$gen->route()?>?status=trash") }}';
    } else {
      document.location = '{{ url("<?=$gen->route()?>") }}';
    }
  });
    $('#<?=$gen->route()?>-table').DataTable({
      stateSave: true,
    processing : true,
    serverSide : true,
    pageLength:20,
        ajax : {
        <?php if(in_array('deleted_at',$fieldsArr)) { ?>
          @if(request()->get('status') == 'trash')
          url:"{{ url('<?=$gen->route()?>/load-data') }}?status=trash",
          @else
          url:"{{ url('<?=$gen->route()?>/load-data') }}",
          @endif
        <?php }else{ ?>
          url:"{{ url('<?=$gen->route()?>/load-data') }}",
        <?php } ?>
        data: function (d) {

                }
      },
        columns: [
          { data: 'nomor', name: 'nomor',searchable:false,orderable:false },
          <?php $count=1;?>
      <?php foreach ( $fields as $field )  { ?>
      <?php if(in_array($field->name,App\Console\Commands\Generator\Db::skippedFields()) && $field->name!='created_at') continue;?>
          { data: '<?=$field->name?>', name: '<?=$field->name?>' },
      <?php $count++; } ?>
          { data: 'action', name: 'action', orderable: false, searchable: false },
      ],
      language: {
            lengthMenu : '{{ "Menampilkan _MENU_ data" }}',
            zeroRecords : '{{ "Data tidak ditemukan" }}' ,
            info : '{{ "_PAGE_ dari _PAGES_ halaman" }}',
            infoEmpty : '{{ "Data tidak ditemukan" }}',
            infoFiltered : '{{ "(Penyaringan dari _MAX_ data)" }}',
            loadingRecords : '{{ "Memuat data dari server" }}' ,
            processing :    '{{ "Memuat data data" }}',
            search :        '{{ "Pencarian:" }}',
            paginate : {
                first :     '{{ "<" }}' ,
                last :      '{{ ">" }}' ,
                next :      '{{ ">>" }}',
                previous :  '{{ "<<" }}'
            }
        },
        aoColumnDefs: [{
          bSortable: false,
          aTargets: [-1]
        }],
        iDisplayLength: 5,
        aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        // sDom: '<"dt-panelmenu clearfix"Bfr>t<"dt-panelfooter clearfix"ip>',
        // buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
    });
});
</script>
@endpush
