<?php
namespace App\Http\Controllers;

use App\Models\Undangan;
use App\Models\Tundangan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class UndanganController extends Controller
{
    public $viewDir = "undangan";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Undangan','link'=>"#",'active'=>false,'display'=>true),
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
           return $this->view("form",['undangan' => new Undangan]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, Undangan::validationRules());

           $act=Undangan::create($request->all());
           message($act,'Data undangan berhasil ditambahkan','Data undangan gagal ditambahkan');
           return redirect('undangan');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $undangan=Undangan::find($kode);
           return $this->view("show",['undangan' => $undangan]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $undangan=Undangan::find($kode);
           return $this->view( "form", ['undangan' => $undangan] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $undangan=Undangan::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, Undangan::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $undangan->update($data);
               return "Record updated";
           }
           $this->validate($request, Undangan::validationRules());

           $act=$undangan->update($request->all());
           message($act,'Data undangan berhasil diupdate','Data undangan gagal diupdate');

           return redirect('/undangan');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $undangan=Undangan::find($kode);
           $act=false;
           try {
               $act=$undangan->forceDelete();
           } catch (\Exception $e) {
               $undangan=Undangan::find($undangan->pk());
               $act=$undangan->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = Undangan::select('*');

           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }

           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('action', function ($data) {

                $phone= $data['wa'];

                $template ="Assalamualaikum *".$data['nama']."*,"."\n";
                
                $tundangan=Tundangan::first();
                if (!empty($tundangan)) {
                    $template_undangan = strip_tags($tundangan->template);
                } else {
                    $template_undangan = null;
                }

                $edit=url("undangan/".$data->pk())."/edit";
                $delete=url("undangan/".$data->pk());
               
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-info btn-sm' style='color:#ffffff'>Edit</a>";
                  $content .= "<a onclick='hapus(\"$delete\")' class='btn btn-warning  btn-sm' style='color:#ffffff'>Hapus</a>";
                  $content .= "<a href='https://api.whatsapp.com/send/?phone=$phone&text=$template' class='btn btn-primary  btn-sm' id='share_ke_wa' target='_blank'>Share ke ".$data['nama']."</a>";
                   return $content;
               })
               ->make(true);
       }
         }
