@extends('layouts.app')

@section('title', $title='undangan')
@section('content')
   <div class="page-header">
     <h1 class="page-title">undangan</h1>
      @include('layouts.inc.breadcrumb')
     <div class="page-header-actions">
     <a class="btn btn-block btn-primary data-modal" id="data-modal" href="#" onclick="show_modal('{{ route('undangan.create') }}')" >Tambah</a>
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
         <!-- <table class="table table-bordered" id="undangans-table">

         </table> -->
         <table class="table table-hover dataTable table-striped w-full" id="undangan-table">
           <thead>
               <tr>
                 <th>No</th>
                 <th>nama</th>
                 <th>wa</th>
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
			document.location = '{{ url("undangan?status=trash") }}';
		} else {
			document.location = '{{ url("undangan") }}';
		}
	});
    $('#undangan-table').DataTable({
    	stateSave: true,
  		processing : true,
  		serverSide : true,
  		pageLength:20,
      ajax : {
				url:"{{ url('undangan/load-data') }}",
				data: function (d) {

        }
			},
      columns: [
      	{ data: 'nomor', name: 'nomor',searchable:false,orderable:false },
      	{ data: 'nama', name: 'nama' },
      	{ data: 'wa', name: 'wa' },
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

jQuery(document).ready(function($) {
  $('#copy-to-clipboard-button').on('click', function(e) {
    e.preventDefault();
    
    /* Get the text field */
    var copyText = document.getElementById("copy-to-clipboard-input");
    
    /* Prevent iOS keyboard from opening */
    copyText.readOnly = true;

    /* Change the input's type to text so its text becomes selectable */
    copyText.type = 'text';

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);

    /* Replace the tooltip's text */
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copied: " + copyText.value;

    /* Change the input's type back to hidden */
    copyText.type = 'hidden';
  });
  
  $('#copy-to-clipboard-button').on('mouseout', function(e) {
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copy to clipboard";
  });
});

</script>
<style type="text/css">
  .tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 7px 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
  font-size: 14px;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>

@endpush
