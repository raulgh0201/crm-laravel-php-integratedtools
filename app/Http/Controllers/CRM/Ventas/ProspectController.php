<?php

namespace App\Http\Controllers\CRM\Ventas;
use App\Models\User;
use App\Models\Contact;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();  
        
        $prospects =  Contact::where('assigned', Auth::id() )
                            ->where('isProspect', true)
                            ->paginate(10);
        return view('ventas.prospect.prospects', compact('prospects','users','user'));
        //return view('admin.prospects', ['prospects' => $prospects, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::all(); 
        $user = Auth::user();  
        $prospect = Contact::find($id);
        //echo $assigned_to->name;
        if(!$prospect){
            return redirect('ventas/prospects')->with('error','No se ha Encontrado el Prospecto');
        }
        $assigned_to = User::find($prospect->assigned);
        return view('ventas.prospect.prospect', compact('prospect','assigned_to','user','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
