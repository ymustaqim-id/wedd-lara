<?php

namespace App\Http\Controllers\Fo;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $stories = Story::all();
        $counter = Story::count();
        return view('landingfo/story', ['stories' => $stories,'counter' => $counter]);
    }
}
