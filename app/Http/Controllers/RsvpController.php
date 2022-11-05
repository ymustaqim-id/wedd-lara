<?php
namespace App\Http\Controllers;

use App\Models\Rsvp;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class RsvpController extends Controller
{
    public $viewDir = "rsvp";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Rsvp','link'=>"#",'active'=>false,'display'=>true),
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
           return $this->view("form",['rsvp' => new Rsvp]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, Rsvp::validationRules());

           $act=Rsvp::create($request->all());
           message($act,'Data rsvp berhasil ditambahkan','Data rsvp gagal ditambahkan');
           return redirect('Rsvp');
       }

       public function store_Rsvp( Request $request )
       {
           $this->validate($request, Rsvp::validationRules());

           $act=Rsvp::create($request->all());
           message($act,'Data rsvp berhasil ditambahkan','Data rsvp gagal ditambahkan');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $rsvp=Rsvp::find($kode);
           return $this->view("show",['rsvp' => $rsvp]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $rsvp=Rsvp::find($kode);
           return $this->view( "form", ['rsvp' => $rsvp] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $rsvp=Rsvp::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, Rsvp::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $rsvp->update($data);
               return "Record updated";
           }
           $this->validate($request, Rsvp::validationRules());

           $act=$rsvp->update($request->all());
           message($act,'Data rsvp berhasil diupdate','Data rsvp gagal diupdate');

           return redirect('/rsvp');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $rsvp=Rsvp::find($kode);
           $act=false;
           try {
               $act=$rsvp->forceDelete();
           } catch (\Exception $e) {
               $rsvp=Rsvp::find($rsvp->pk());
               $act=$rsvp->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = Rsvp::select('*');

           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }

           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('action', function ($data) {


                $edit=url("rsvp/".$data->pk())."/edit";
                $delete=url("rsvp/".$data->pk());
               
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                  $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";
                   return $content;
               })
               ->make(true);
       }
         }
