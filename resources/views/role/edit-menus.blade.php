@extends('layouts.app')

@section('content')
{{-- {{ Form::model($role,array('route' => array((!$role->exists) ? 'role.createpermissionrole',$role->pk()),
'class'=>'modal-content','id'=>'role-form','method'=>(!$role->exists) ? 'POST')) }} --}}
	{{ Form::model($role,array('route' => array((!$role->exists) ? 'role.createpermissionrole':'role.createpermissionrole',$role->pk()),
  'class'=>'modal-content','id'=>'role-form','method'=>(!$role->exists) ? 'POST' : 'POST')) }}

   <div class="page-header">
     <h1 class="page-title">Hak Akses Per Menu</h1>
      @include('layouts.inc.breadcrumb')
     <div class="page-header-actions">
     {{-- <a class="btn btn-block btn-primary data-modal" id="data-modal" href="#" onclick="show_modal('{{ route('role.create') }}')" >Tambah</a> --}}
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
         <table class="table table-hover dataTable table-striped w-full" id="edit-menus-table">
           <thead>
               <tr>
                 <th>No</th>
                 <th>Name</th>
                 <th>Url</th>
                 <th>Permission</th>
                                    <th>Aktif</th>
                                    {{-- <th>Description</th> --}}
                                  
               </tr>
           </thead>
           <tbody>
             <?php $nomor = 1;
             ?>
             @foreach ($permissionmenu as $num =>$row )
           
            <tr data-tt-id="{{$row}}">
            <td>{{ $nomor++ }}</td>
            <td>Menu {{ $row['nama_menu'] }}</td>
            <td>/ {{ $row['url'] }}</td>
            <td> {{ $row['nama_perm'] }}</td>
            <?php
            $check=\App\Models\PermissionRole::select('*')
            ->where('permission_id',$row['id_perm'])
            ->where('role_id',$role_id)

            ->first();
            ?>
                                 <td >
                                 
                                   {{-- <input type="checkbox" name="flag_aktif"> --}}
                                   {{-- {!! App\Console\Commands\Generator\Form::checkbox('flag_aktif','Flag Aktif',array('label'=>'','value'=>'Y'),null) !!}  --}}
                                   <div class="checkbox-custom checkbox-default">
                                      @if($check != null)
                                      <input type="checkbox" name="role[{{ $num }}][flag_aktif]" checked>
                                      @else
                                      <input type="checkbox" name="role[{{ $num }}][flag_aktif]">
                                      @endif
                                 
                                      <label for="inputBasicRemember"></label>
                              </div>
                                  </td>
                                <input type="hidden" name="role[{{ $num }}][id_perm]" value="{{ $row['id_perm'] }}" class="checkbox-custom checkbox-default">      
          </tr>
          
          
          @endforeach
          <input type="hidden" name="role_id" value="{{ $role_id }}" class="checkbox-custom checkbox-default">      

        </tbody>
         </table>
         <br>
         <br>
         <div class="text-right">
						<button class="btn btn-primary" id="simpan">Simpan</button>
					</div>
       </div>
     </div>
     
     <!-- End Panel Table Tools -->
 </div>
 
 </div>
 {{ Form::close() }}
@endsection

@push('js')
<script type="text/javascript">
$(function() {
  $('.trash-ck').click(function(){
    if ($('.trash-ck').prop('checked')) {
      document.location = '{{ url("role?status=trash") }}';
    } else {
      document.location = '{{ url("role") }}';
    }
  });
    // $('#role-table').DataTable({
    //   stateSave: true,
    // processing : true,
    // serverSide : true,
    // pageLength:20,
    //     ajax : {
    //               url:"{{ url('role/load-data') }}",
    //             data: function (d) {

    //             }
    //   },
    //     columns: [
    //       { data: 'nomor', name: 'nomor',searchable:false,orderable:false },
    //                   { data: 'action', name: 'action', orderable: false, searchable: false },
    //                                   { data: 'name', name: 'name' },
    //                   { data: 'display_name', name: 'display_name' },
    //                   { data: 'description', name: 'description' },
    //                   { data: 'created_at', name: 'created_at' },
    //   ],
    //   language: {
    //         lengthMenu : '{{ "Menampilkan _MENU_ data" }}',
    //         zeroRecords : '{{ "Data tidak ditemukan" }}' ,
    //         info : '{{ "_PAGE_ dari _PAGES_ halaman" }}',
    //         infoEmpty : '{{ "Data tidak ditemukan" }}',
    //         infoFiltered : '{{ "(Penyaringan dari _MAX_ data)" }}',
    //         loadingRecords : '{{ "Memuat data dari server" }}' ,
    //         processing :    '{{ "Memuat data data" }}',
    //         search :        '{{ "Pencarian:" }}',
    //         paginate : {
    //             first :     '{{ "<" }}' ,
    //             last :      '{{ ">" }}' ,
    //             next :      '{{ ">>" }}',
    //             previous :  '{{ "<<" }}'
    //         }
    //     },
    //     aoColumnDefs: [{
    //       bSortable: false,
    //       aTargets: [-1]
    //     }],
    //     iDisplayLength: 5,
    //     aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    //     // sDom: '<"dt-panelmenu clearfix"Bfr>t<"dt-panelfooter clearfix"ip>',
    //     // buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
    // });
});
</script>
@endpush
