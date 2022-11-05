<?php
namespace App\Http\Controllers;

use App\Models\Bukutamu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class BukutamuController extends Controller
{
    public $viewDir = "bukutamu";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Buku Tamu','link'=>"#",'active'=>false,'display'=>true),
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
           return $this->view("form",['bukutamu' => new Bukutamu]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, Bukutamu::validationRules());

           $act=Bukutamu::create($request->all());
           message($act,'Data buku tamu berhasil ditambahkan','Data buku tamu gagal ditambahkan');
           return redirect('bukutamu');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $buku=Bukutamu::find($kode);
           return $this->view("show",['bukutamu' => $buku]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $buku=Bukutamu::find($kode);
           return $this->view( "form", ['bukutamu' => $buku] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $buku=Bukutamu::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, Bukutamu::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $buku->update($data);
               return "Record updated";
           }
           $this->validate($request, Bukutamu::validationRules());

           $act=$buku->update($request->all());
           message($act,'Data buku tamu berhasil diupdate','Data buku tamu gagal diupdate');

           return redirect('/bukutamu');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $buku=Bukutamu::find($kode);
           $act=false;
           try {
               $act=$buku->forceDelete();
           } catch (\Exception $e) {
               $buku=Bukutamu::find($buku->pk());
               $act=$buku->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = Bukutamu::select('*');

           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }

           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('action', function ($data) {


                $edit=url("bukutamu/".$data->pk())."/edit";
                $delete=url("bukutamu/".$data->pk());
               
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                  $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";
                   return $content;
               })
               ->make(true);
       }
         }
