<?php
namespace App\Http\Controllers;

use App\Models\Undangan;
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
                // $firstNumber = substr($phone, 0, 1);
                // if ($firstNumber != 0) {
                //     $otp_wa       = '62' . $phone;
                // } else {
                //     $otp_wa       = substr($phone, 1, 20);
                //     $otp_wa       = '62' . $otp_wa;
                // }
                $url_share=url("/?to=".$data['nama']);

                $template ="Assalamualaikum"."\n";
                $template .="Maha suci Allah yang telah menjadikan segala sesuatu lebih indah dan sempurna."."\n";
                $template .="Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i, teman sekaligus sahabat, untuk menghadiri acara pernikahan kami :"."\n";
                $template .="*Ayu & Mustaqim*"."\n";
                $template .="Berikut link untuk info lengkap dari acara kami untuk mengantarkan Bapak/Ibu, teman, serta sahabat ketujuan :"."\n";
                $template .=$url_share."\n";
                $template .="Merupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir dan memberikan doa restu."."\n";
                $template .="Mohon maaf perihal undangan hanya di bagikan melalui  pesan ini."."\n";
                $template .="Kami yang berbahagia"."\n";
                $template .="*Ayu & Mustaqim*"."\n";

                $edit=url("undangan/".$data->pk())."/edit";
                $delete=url("undangan/".$data->pk());
               
                 $content = '';
                  $content .= "<a onclick='show_modal(\"$edit\")' class='btn btn-sm btn-icon btn-pure btn-default on-default edit-row ' data-toggle='tooltip' data-original-title='Edit'><i class='icon md-edit' aria-hidden='true'></i></a>";
                  $content .= " <a onclick='hapus(\"$delete\")' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Remove'><i class='icon md-delete' aria-hidden='true'></i></a>";
                  $content .= " <a href='https://api.whatsapp.com/send/?phone=$phone&text=$template' class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row' data-toggle='tooltip' data-original-title='Share' target='_blank'><i class='icon md-share' aria-hidden='true'></i></a>";
                  $content .="<input value='$template' id='copy-to-clipboard-input' type='hidden'>";
                    $content .="<div class='tooltip'>
    <button class='btn btn-sm btn-icon btn-pure btn-default on-default remove-row'  id='copy-to-clipboard-button'>
        <span class='tooltiptext' id='myTooltip'>Copy to clipboard</span>
        Copy text
    </button>
</div>";

                   return $content;
               })
               ->make(true);
       }
         }
