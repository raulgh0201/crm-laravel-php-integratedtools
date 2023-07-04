<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Venta;
use App\Models\User;    
use Illuminate\Support\Facades\DB;

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
            $bestSeller = $this->getBestSeller();       
            $bestBuyer = $this->getBestBuyer();       

 

            return view('admin.index', compact('user','n_Users','n_Contacts','n_Prospects','n_Clients','bestSeller','bestBuyer'));

        }elseif(Auth::user()->role === 'marketing'){

            //echo Auth::id();
            $n_Prospects =  Contact::where('assigned', Auth::id() )
                            ->where('isProspect', true)
                            ->count();

            $n_Clients =    Contact::where('assigned', Auth::id() )
                            ->where('isClient', true)
                            ->count();

            $n_ClientsWithSocial = Contact::where('assigned', Auth::id() )
                            ->where('isClient', true)
                            ->WhereNotNull('instagram_user')
                            ->orWhereNotNull('facebook_user')
                            ->count();

            $n_ProspectsWithSocial = Contact::where('assigned', Auth::id() )
                            ->where('isProspect', true)
                            ->WhereNotNull('instagram_user')
                            ->orWhereNotNull('facebook_user')
                            ->count();

            return view('marketing.index', compact('user','n_Prospects','n_Clients','n_ClientsWithSocial','n_ProspectsWithSocial'));

        }elseif(Auth::user()->role === 'sales'){


            $n_Prospects = Contact::where('assigned', Auth::id() )
            ->where('isProspect', true)
            ->count();
            $n_Clients = Contact::where('assigned', Auth::id() )
            ->where('isClient', true)
            ->count();
            $n_VentasRealizadas = $this->getSalesTotalSales();       
            $bestBuyer = $this->getSalesBestBuyer();       

 

            return view('ventas.index', compact('user','n_Prospects','n_Clients','n_VentasRealizadas','bestBuyer'));

        }

        

        //return view('home', compact('user'));
    }

    public function getBestSeller(){
        
        $sql = 'SELECT contacts.name,users.name,SUM(productos_vendidos.precio * productos_vendidos.cantidad) as `Precio`
        FROM productos_vendidos 
        INNER JOIN ventas ON productos_vendidos.id_venta=ventas.id
        INNER JOIN contacts ON ventas.id_cliente=contacts.id
        INNER JOIN users ON ventas.id_usuario=users.id
        group by id_usuario,contacts.name,users.name
        order by Precio DESC';
    
        return DB::select($sql);
        
    }

    public function getBestBuyer(){

        $sql = 'SELECT contacts.name, SUM(productos_vendidos.precio * productos_vendidos.cantidad) as `Precio`
        FROM productos_vendidos
        INNER JOIN ventas ON productos_vendidos.id_venta=ventas.id
        INNER JOIN contacts ON ventas.id_cliente=contacts.id
        group by id_cliente,contacts.name
        order by Precio DESC';

        return DB::select($sql);
            
    }

    public function getSalesTotalSales(){

        $sql = 'SELECT count(*) as `contador` FROM ventas WHERE id_usuario =' .Auth::id();

        return DB::select($sql);
            
    }

    public function getSalesBestBuyer(){
        $idUser = Auth::id();
        $sql = " SELECT contacts.name, productos_vendidos.precio * productos_vendidos.cantidad as `Precio` 
        FROM productos_vendidos 
        INNER JOIN ventas ON productos_vendidos.id_venta=ventas.id 
        INNER JOIN contacts ON ventas.id_cliente=contacts.id
        WHERE ventas.id_usuario = $idUser
        order by Precio DESC";
    

        return DB::select($sql);
            
    }
}


