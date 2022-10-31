<?php
namespace App\Http\Controllers;

use App\Models\Mempelai;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class MempelaiController extends Controller
{
    public $viewDir = "mempelai";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Mempelai','link'=>"#",'active'=>false,'display'=>true),
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
           return $this->view("form",['mempelai' => new Mempelai]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, Mempelai::validationRules());

           $act=Mempelai::create($request->all());
           message($act,'Data Mempelai berhasil ditambahkan','Data Mempelai gagal ditambahkan');
           return redirect('mempelai');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $mempelai=Mempelai::find($kode);
           return $this->view("show",['mempelai' => $mempelai]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $mempelai=Mempelai::find($kode);
           return $this->view( "form", ['mempelai' => $mempelai] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $mempelai=Mempelai::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, Mempelai::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $mempelai->update($data);
               return "Record updated";
           }
           $this->validate($request, Mempelai::validationRules());

           $act=$mempelai->update($request->all());
           message($act,'Data Mempelai berhasil diupdate','Data Mempelai gagal diupdate');

           return redirect('/mempelai');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $mempelai=Mempelai::find($kode);
           $act=false;
           try {
               $act=$mempelai->forceDelete();
           } catch (\Exception $e) {
               $mempelai=Mempelai::find($mempelai->pk());
               $act=$mempelai->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = Mempelai::select('*');
           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }
           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('action', function ($data) {
                   $edit=url("mempelai/".$data->pk())."/edit";
                   $delete=url("mempelai/".$data->pk());
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                  $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";

                   return $content;
               })
               ->make(true);
       }
         }
