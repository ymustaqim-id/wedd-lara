<?php

namespace App\Http\Controllers\Fo;

use Illuminate\Http\Request;
use App\Models\Acara;

class AcaraController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $akad = '1';
        $resepsi = '2';
        $akad = Acara::where('jenis_acara', $akad)->first();
        $resepsi = Acara::where('jenis_acara', $resepsi)->first();

        return view('landingfo/acara', ['akad' => $akad, 'resepsi' => $resepsi]);
    }
}
