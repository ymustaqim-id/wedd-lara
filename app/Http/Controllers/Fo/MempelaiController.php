<?php

namespace App\Http\Controllers\Fo;

use Illuminate\Http\Request;

class MempelaiController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('landingfo/mempelai');
    }
}
