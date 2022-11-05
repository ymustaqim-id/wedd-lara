<?php

namespace App\Http\Controllers\Fo;

use Illuminate\Http\Request;

class StoryController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('landingfo/story');
    }
}
