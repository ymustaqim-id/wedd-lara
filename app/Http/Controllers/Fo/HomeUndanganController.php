<?php

namespace App\Http\Controllers\Fo;

use Illuminate\Http\Request;
use App\Models\Landing;

class HomeUndanganController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $landing = Landing::all();
        return view('landingfo/home', ['landing' => $landing,]);
    }
}
