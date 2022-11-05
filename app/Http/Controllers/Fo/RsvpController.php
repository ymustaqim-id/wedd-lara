<?php

namespace App\Http\Controllers\Fo;

use Illuminate\Http\Request;

class RsvpController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('landingfo/rsvp');
    }
}
