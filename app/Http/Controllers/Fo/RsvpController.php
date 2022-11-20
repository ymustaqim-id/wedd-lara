<?php

namespace App\Http\Controllers\Fo;

use App\Models\Rsvp;
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

    public function storeRsvp( Request $request )
       {
           $act=Rsvp::create($request->all());
           if ($act) {
            $response = 1;
           } else {
            $response = 2;
           }

           return response()->json([
            'response' => $response,
        ]);
       }
}
