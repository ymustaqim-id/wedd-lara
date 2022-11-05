@extends('layouts.app')

@section('title', $title='Users')
@section('content')
   <div class="page-header">
     <h1 class="page-title">DataTables</h1>
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
       <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
       <li class="breadcrumb-item active">DataTables</li>
     </ol>
     <div class="page-header-actions">
     <a class="btn btn-block btn-primary waves-classic" id="data-modal" href="#"  value="{{ route('user.create') }}" >Tambah</a>
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
         <table class="table table-hover dataTable table-striped w-full" id="user-table">
           <thead>
               <tr>
                 <th>No</th>
                                 <th>name</th>
                           <th>username</th>
                           <th>email</th>
                           <!-- <th>email_verified_at</th>
                           <th>password</th>
                           <th>remember_token</th>
                           <th>created_at</th> -->
                             <th>Action</th>
               </tr>
           </thead>
         </table>
       </div>
     </div>
     <!-- End Panel Table Tools -->
 </div>
 <div class="modal fade" id="formModal" aria-hidden="true" aria-labelledby="formModalLabel" role="dialog" tabindex="-1">
 <div>

@endsection

@push('js')
<script type="text/javascript">
$(function() {
	$('.trash-ck').click(function(){
		if ($('.trash-ck').prop('checked')) {
			document.location = '{{ url("user?status=trash") }}';
		} else {
			document.location = '{{ url("user") }}';
		}
	});
    $('#user-table').DataTable({
    	stateSave: true,
  		processing : true,
  		serverSide : true,
  		pageLength:20,
      ajax : {
				url:"{{ url('user/load-data') }}",
				data: function (d) {

        }
			},
      columns: [
      	{ data: 'nomor', name: 'nomor',searchable:false,orderable:false },
      	{ data: 'name', name: 'name' },
      	{ data: 'username', name: 'username' },
      	{ data: 'email', name: 'email' },
      	// { data: 'email_verified_at', name: 'email_verified_at' },
      	// { data: 'password', name: 'password' },
      	// { data: 'remember_token', name: 'remember_token' },
      	// { data: 'created_at', name: 'created_at' },
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
          sSearchPlaceholder: "Pencarian..",
          lengthMenu: "_MENU_",
          search: "_INPUT_",
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