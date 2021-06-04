<?php

namespace App\Http\Controllers\CRM\Marketing;
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

        return view('marketing.client.clients', compact('clients','user'));
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
            return redirect('marketing/clients')->with('error','No se ha Encontrado el Cliente');
        }
        
        
        return view('marketing.client.client', compact('client','user'));
    }

}
