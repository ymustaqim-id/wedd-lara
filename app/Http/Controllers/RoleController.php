<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Menu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\PermissionRole;

class RoleController extends Controller
{
    public $viewDir = "role";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Roles','link'=>"#",'active'=>false,'display'=>true),
       );

       public function __construct()
       {
           $this->middleware('permission:read-roles');
       }

       public function index()
       {
           return $this->view( "index");
       }

       
       public function createpermissionrole(Request $request )
       {
        $roleId = ($request->input('role_id'));
        // dd($roleId);
           $all_data = $request->all();
        //    dd($all_data);
       $permisi =  \DB::table('permission_role')->where('role_id',$roleId)->delete();
    //  dd($permisi);
           foreach ($all_data['role'] as $num => $row){
            if(isset($row['flag_aktif']) &&($row['flag_aktif']=='on') ){
                // $role = Role::find($roleId);
            $datarole = array(
                'permission_id'=>$row['id_perm'],
                'role_id'=>$roleId,

            );
            $permissionmenu = PermissionRole::create($datarole);
            //   dd($permissionmenu);
             }
        
 
            }
       
            // dd($all_data);

      

        message('Data Hak Akses berhasil ditambahkan','Data Hak Akses berhasil ditambahkan');
         
           return redirect('role');
       }


       public function hakmenus($role_id)
       {
        $send['role_id'] = $role_id;
        $send['role'] = new Role;
        
        // $pemesan=Stok::select(\DB::raw($selected_field));
        $send['permissionmenu']=$permissionmenu= Menu::select(\DB::raw('menus.permission_id as id_perm,menus.*,menus.name as nama_menu , permissions.name as nama_perm'))
        ->join('permissions','permissions.id','=','menus.permission_id')
        // ->where('menus.url','!=',null)
        // ->join('permission_role','permission_role.permission_id','=','permissions.id')
        ->get();

        

           return $this->view( "edit-menus",$send);
       }

       /**
        * Show the form for creating a new resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function create()
       {
           return $this->view("form",['role' => new Role]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, Role::validationRules());

           $act=Role::create($request->all());
           message($act,'Data Roles berhasil ditambahkan','Data Roles gagal ditambahkan');
           return redirect('role');
       }

       /**
        * Display the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function show(Request $request, $kode)
       {
           $role=Role::find($kode);
           return $this->view("show",['role' => $role]);
       }

       /**
        * Show the form for editing the specified resource.
        *
        * @return  \Illuminate\Http\Response
        */
       public function edit(Request $request, $kode)
       {
           $role=Role::find($kode);
           return $this->view( "form", ['role' => $role] );
       }

       /**
        * Update the specified resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function update(Request $request, $kode)
       {
           $role=Role::find($kode);
           if( $request->isXmlHttpRequest() )
           {
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, Role::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $role->update($data);
               return "Record updated";
           }
           $this->validate($request, Role::validationRules());

           $act=$role->update($request->all());
           message($act,'Data Roles berhasil diupdate','Data Roles gagal diupdate');

           return redirect('/role');
       }

       /**
        * Remove the specified resource from storage.
        *
        * @return  \Illuminate\Http\Response
        */
       public function destroy(Request $request, $kode)
       {
           $role=Role::find($kode);
           $act=false;
           try {
               $act=$role->forceDelete();
           } catch (\Exception $e) {
               $role=Role::find($role->pk());
               $act=$role->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = Role::select('*');
           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }
           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
            //    ->addColumn('action', function ($data) {
            //        $edit=url("role/".$data->pk())."/edit";
            //        $delete=url("role/".$data->pk());
            //      $content = '';
            //       $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
            //       $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";

            //        return $content;
            //    })

               ->addColumn('action', function ($data) {
              
              $content = '';
              $content .= "<a href='permission-role/get/".$data->pk()."/menu' class='btn btn-sm btn-icon btn-pure btn-default on-default ' ><span class='btn btn-info btn-sm ' id='edit'>Edit Hak Akses</span></a>";
                
                return $content;
            })
               ->make(true);
       }
         }
