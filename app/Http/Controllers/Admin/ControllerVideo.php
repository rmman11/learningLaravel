<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ControllerVideo extends Controller
{


      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function video(){
     $today =  Carbon::now();
     $title   = "Video";
    return view('video.video',compact('title'),['today' => $today]);


    }
}
