<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;


class UserControllerFix extends Controller
{
    public $viewDir = "user";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
       );

       public function __construct()
       {
           // $this->middleware('permission:users-read');
           // $this->middleware('permission:users-create', ['only' => ['create','store']]);
           // $this->middleware('permission:users-update', ['only' => ['edit','udate']]);
           // $this->middleware('permission:users-delete', ['only' => ['delete']]);
       }

       public function index()
       {
           // return $this->view( "index_bak");
           return $this->view( "index");
       }

       /**
        * Show the form for creating a new resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function create()
       {
           return $this->view("form",['user' => new User]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store(Request $request)
       {
           $valid = $this->validate($request, User::validationRules(),User::customMessages());
           // dd($valid);
           $act=User::create($request->all());
           message($act,'Data Users berhasil ditambahkan','Data Users gagal ditambahkan');
           return redirect('user');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $user=User::find($kode);
           return $this->view("show",['user' => $user]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $user=User::find($kode);
           return $this->view( "form", ['user' => $user] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $user=User::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, User::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $user->update($data);
               return "Record updated";
           }
           $this->validate($request, User::validationRules());

           $act=$user->update($request->all());
           message($act,'Data Users berhasil diupdate','Data Users gagal diupdate');

           return redirect('/user');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $user=User::find($kode);
           $act=false;
           try {
               $act=$user->forceDelete();
           } catch (\Exception $e) {
               $user=User::find($user->pk());
               $act=$user->delete();
           }
           // return redirect('/user');
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = User::select('*');
           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }
           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('action', function ($data) {
                   $edit=url("user/".$data->pk())."/edit";
                   $delete=url("user/".$data->pk());
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                  $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";
                  return $content;
               })
               ->make(true);
       }

}
