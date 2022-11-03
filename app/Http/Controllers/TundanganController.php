<?php
namespace App\Http\Controllers;

use App\Models\Tundangan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class TundanganController extends Controller
{
    public $viewDir = "tundangan";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Template Undangan','link'=>"#",'active'=>false,'display'=>true),
       );

       public function __construct()
       {
           $this->middleware('permission:read-menus');
       }

       public function index()
       {
            $tundangan=Tundangan::first();
           return $this->view("index",['tundangan' => $tundangan]);
       }

       /**
        * Show the form for creating a new resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function create()
       {
           return $this->view("form",['tundangan' => new Tundangan]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, Tundangan::validationRules());

           $act=Tundangan::create($request->all());
           message($act,'Data template undangan berhasil ditambahkan','Data template undangan gagal ditambahkan');
           return redirect('tundangan');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $tundangan=Tundangan::first();
           return $this->view("show",['tundangan' => $tundangan]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $tundangan=Tundangan::find($kode);
           return $this->view( "form", ['tundangan' => $tundangan] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $tundangan=Tundangan::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, Tundangan::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $tundangan->update($data);
               return "Record updated";
           }
           $this->validate($request, Tundangan::validationRules());

           $act=$tundangan->update($request->all());
           message($act,'Data undangan berhasil diupdate','Data undangan gagal diupdate');

           return redirect('/tundangan');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $tundangan=Tundangan::find($kode);
           $act=false;
           try {
               $act=$tundangan->forceDelete();
           } catch (\Exception $e) {
               $tundangan=Tundangan::find($tundangan->pk());
               $act=$tundangan->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = Tundangan::select('*');
           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }

           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('action', function ($data) {

                $edit=url("tundangan/".$data->pk())."/edit";
                $delete=url("tundangan/".$data->pk());
               
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                   return $content;
               })
               ->make(true);
       }
         }
