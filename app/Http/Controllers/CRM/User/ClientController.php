<?php

namespace App\Http\Controllers\CRM\User;
use App\Models\User;
use App\Models\Contact;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();  
        
        $clients =  Contact::where('assigned', Auth::id() )
                            ->where('isClient', true)
                            ->paginate(10);

        return view('user.client.clients', compact('clients','user'));
        //return view('admin.prospects', ['prospects' => $prospects, 'users' => $users]);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)

    {
        $user = Auth::user();
        $client = Contact::find($id);
        if(!$client || !$client->assigned==Auth::id() || !$client->isClient ){
            return redirect('user/clients')->with('error','No se ha Encontrado el Cliente');
        }
        
        
        return view('user.client.client', compact('client','user'));
    }

}
