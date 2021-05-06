<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\User;
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
        $this->middleware('isActive');
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

            $n_Users  =  User::all()->count();  
            $n_Contacts =  Contact::all()->count();
            $n_Prospects = Contact::where('isProspect', true)->count();
            $n_Clients = Contact::where('isClient', true)->count();

            return view('admin.index', compact('user','n_Users','n_Contacts','n_Prospects','n_Clients'));

        }elseif(Auth::user()->role === 'user'){

            //echo Auth::id();
            $n_Users  =  User::all()->count();  
            $n_Prospects =  Contact::where('assigned', Auth::id() )
                            ->where('isProspect', true)
                            ->count();

            $n_Clients =    Contact::where('assigned', Auth::id() )
                            ->where('isClient', true)
                            ->count();

            return view('user.index', compact('user','n_Users','n_Prospects','n_Clients'));

        }

        return view('home', compact('user'));
    }
}


