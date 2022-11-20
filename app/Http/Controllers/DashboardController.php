<?php
namespace App\Http\Controllers;

use App\Models\Undangan;
use App\Models\Rsvp;
use App\Models\Bukutamu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use DB;

class DashboardController extends Controller
{

   public function index()
   {
        // jumlah undangan
        $total_undangan = Undangan::select(\DB::raw('count(*) as total_undangan'))->first();
        // jumlah rsvp
        $total_rsvp = Rsvp::select(\DB::raw('count(*) as total_rsvp'))->first();
        // jumlah buku tamu
        $total_tamu = Bukutamu::select(\DB::raw('count(*) as total_tamu'))->first();

        $data['undangan'] = $total_undangan;
        $data['rsvp'] = $total_rsvp;
        $data['tamu'] = $total_tamu;
       return view('dashboard/index', $data);
   }

}
