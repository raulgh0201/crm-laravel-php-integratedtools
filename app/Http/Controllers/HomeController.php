<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

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
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();     
       
        if(Auth::user()->role === 'admin'){
            return view('admin.index', compact('user'));
        }elseif(Auth::user()->role === 'user'){
            return view('user.index', compact('user'));
        }

        return view('home', compact('user'));
    }
}


