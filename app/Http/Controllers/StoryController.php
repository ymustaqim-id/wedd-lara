<?php
namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class StoryController extends Controller
{
    public $viewDir = "story";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'story','link'=>"#",'active'=>false,'display'=>true),
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
           return $this->view("form",['story' => new story]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, Story::validationRules());

           $act=Story::create($request->all());
           message($act,'Data story berhasil ditambahkan','Data story gagal ditambahkan');
           return redirect('stories');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $story=Story::find($kode);
           return $this->view("show",['story' => $story]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $story=Story::find($kode);
           return $this->view( "form", ['story' => $story] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $story=Story::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, Story::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $story->update($data);
               return "Record updated";
           }
           $this->validate($request, Story::validationRules());

           $act=$story->update($request->all());
           message($act,'Data story berhasil diupdate','Data story gagal diupdate');

           return redirect('/stories');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $story=Story::find($kode);
           $act=false;
           try {
               $act=$story->forceDelete();
           } catch (\Exception $e) {
               $story=Story::find($story->pk());
               $act=$story->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = Story::select('*');
           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }
           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('action', function ($data) {
                   $edit=url("stories/".$data->pk())."/edit";
                   $delete=url("stories/".$data->pk());
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                  $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";

                   return $content;
               })
               ->make(true);
       }
         }
