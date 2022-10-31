<?php
namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class AcaraController extends Controller
{
    public $viewDir = "acara";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Acara','link'=>"#",'active'=>false,'display'=>true),
       );

       public function __construct()
       {
           $this->middleware('permission:read-menus');
       }

       public function index()
       {
           return $this->view( "index");
       }

       /**
        * Show the form for creating a new resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function create()
       {
           return $this->view("form",['acara' => new Acara]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, Acara::validationRules());

           $act=Acara::create($request->all());
           message($act,'Data Acara berhasil ditambahkan','Data Acara gagal ditambahkan');
           return redirect('acara');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $acara=Acara::find($kode);
           return $this->view("show",['acara' => $acara]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $acara=Acara::find($kode);
           return $this->view( "form", ['acara' => $acara] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $acara=Acara::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, Acara::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $acara->update($data);
               return "Record updated";
           }
           $this->validate($request, Acara::validationRules());

           $act=$acara->update($request->all());
           message($act,'Data acara berhasil diupdate','Data acara gagal diupdate');

           return redirect('/acara');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $acara=Acara::find($kode);
           $act=false;
           try {
               $act=$acara->forceDelete();
           } catch (\Exception $e) {
               $acara=Acara::find($acara->pk());
               $act=$acara->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = Acara::select('*');
           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }
           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('action', function ($data) {
                   $edit=url("acara/".$data->pk())."/edit";
                   $delete=url("acara/".$data->pk());
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                  $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";

                   return $content;
               })
               ->make(true);
       }
         }
