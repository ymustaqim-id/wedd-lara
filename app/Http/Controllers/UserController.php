<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class UserController extends Controller
{
    public $viewDir = "user";
    public $breadcrumbs = array(
         'permissions'=>array('title'=>'Users','link'=>"#",'active'=>false,'display'=>true),
       );

       public function __construct()
       {
           $this->middleware('permission:read-users');
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
          return $this->view("form",['user' => new User]);
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param    \Illuminate\Http\Request  $request
        * @return  \Illuminate\Http\Response
        */
       public function store( Request $request )
       {
           $this->validate($request, User::validationRules());
           $all_data = $request->all();
           // dd($all_data);
           DB::beginTransaction();
           try {
             $user  = array(
               'name' =>$all_data['name'] ,
               'username' =>$all_data['username'] ,
               'email' =>$all_data['email'] ,
               'password' =>bcrypt($all_data['password']) ,
               // 'jenis_kelamin' =>isset($all_data['jenis_kelamin'])?$all_data['jenis_kelamin']:'' ,
             );
             $user=User::create($user);
             $roleUser = RoleUser::firstOrCreate([
               'role_id'=>$all_data['role'],
               'user_id'=>$user->id,
               'user_type'=>'App\User'
             ]);
           } catch (Exception $e) {
              echo 'Message' .$e->getMessage();
            DB::rollback();
          }
          DB::commit();


           message($roleUser,'Data Users berhasil ditambahkan','Data Users gagal ditambahkan');
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
           $user=User::select(\DB::raw("users.*, roles.display_name,role_user.role_id"))
            ->join('role_user','role_user.user_id','=','users.id')
            ->join('roles','roles.id','role_user.role_id')
            ->where('users.id',$kode)
            ->first();
            // dd($user);
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
           // $roleUser=RoleUser::where('user_id',$kode)->get();
           // dd($roleUser);
           // $data = [$request->name  => $request->value];
           // dd($data);
           if( $request->isXmlHttpRequest() )
           {
              //belum disesuaikan karena belum ada contoh nya.
               $data = [$request->name  => $request->value];
               $validator = \Validator::make( $data, User::validationRules( $request->name ) );
               if($validator->fails())
                   return response($validator->errors()->first( $request->name),403);
               $user->update($data);
               return "Record updated";
           }
           $this->validate($request, User::validationRules());
           $all_data = $request->all();
           // dd($all_data);
           DB::beginTransaction();
           try {
             $dataUser = array(
              'name' =>$all_data['name'] ,
              'username' =>$all_data['username'] ,
              'email' =>$all_data['email'] ,
              'password' =>bcrypt($all_data['password']) ,
              // 'jenis_kelamin' =>isset($all_data['jenis_kelamin'])?$all_data['jenis_kelamin']:'' ,
            );
            $act=$user->update($dataUser);
            $delRoleUser=RoleUser::where('user_id',$kode)->forceDelete();
            $roleUser = RoleUser::firstOrCreate([
              'role_id'=>$all_data['role'],
              'user_id'=>$user->id,
              'user_type'=>'App\User'
            ]);
          } catch (Exception $e) {
             echo 'Message' .$e->getMessage();
           DB::rollback();
         }
         DB::commit();
          message($roleUser,'Data Users berhasil diupdate','Data Users gagal diupdate');

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
               $delRoleUser=RoleUser::where('user_id',$kode)->forceDelete();
           } catch (\Exception $e) {
               $user=User::find($user->pk());
               $act=$user->delete();
               $delRoleUser=RoleUser::where('user_id',$kode)->delete();
           }
       }

       protected function view($view, $data = [])
       {
           return view($this->viewDir.".".$view, $data);
       }
       public function loadData()
       {
          $config = config('laratrust_seeder.list_role');
           $GLOBALS['nomor']=\Request::input('start',1)+1;
           $dataList = User::select('*');
           if (request()->get('status') == 'trash') {
               $dataList->onlyTrashed();
           }
           return Datatables::of($dataList)
               ->addColumn('nomor',function($kategori){
                   return $GLOBALS['nomor']++;
               })
               ->addColumn('role',function($data){
                  if(isset($data->roleUser->role->display_name)){
                    return $data->roleUser->role->display_name;
                  }else{
                    return null;
                  }
              })
               ->addColumn('action', function ($data) use ($config) {
                   $edit=url("user/".$data->pk())."/edit";
                   $delete=url("user/".$data->pk());
                 $content = '';
                 if (!in_array($data->username, $config)) {
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                  $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";
                }

                   return $content;
               })
               ->make(true);
       }

       function checkUsername(){
         $username = \Request::input('username');
         $idUser = \Request::input('id_user');
         $cek = User::where('username',$username)->where('id','<>',$idUser)->exists();
         $data['status'] = ($cek)?'ada':'kosong';
         echo json_encode($data);
       }
       function checkEmail(){
         $username = \Request::input('email');
         $idUser = \Request::input('id_user');
         $cek = User::where('email',$username)->where('id','<>',$idUser)->exists();
         $data['status'] = ($cek)?'ada':'kosong';
         echo json_encode($data);
       }

       public function getRole(){
         $query=Role::get();
         $data=array('query'=>$query);
         echo json_encode($data);
       }
}
