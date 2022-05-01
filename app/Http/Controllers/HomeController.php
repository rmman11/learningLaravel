<?php

namespace App\Http\Controllers;

use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function video(){
        $today =  Carbon::now();
        $title   = "Video";
       return view('video',compact('title'),['today' => $today]);
   
   
       }
 public function fqa()

    {

       $title ="frequently asked questions";
        return view('fqa',compact('title'));
    }
}
