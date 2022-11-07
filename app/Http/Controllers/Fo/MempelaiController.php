<?php

namespace App\Http\Controllers\Fo;

use Illuminate\Http\Request;
use App\Models\Mempelai;

class MempelaiController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jenis_kelamin_l = 'L';
        $jenis_kelamin_p = 'P';
        $mempelai_pria = Mempelai::where('jenis_kelamin', $jenis_kelamin_l)->first();
        $mempelai_wanita = Mempelai::where('jenis_kelamin', $jenis_kelamin_p)->first();

        return view('landingfo/mempelai', ['pria' => $mempelai_pria, 'wanita' => $mempelai_wanita]);
    }
}
