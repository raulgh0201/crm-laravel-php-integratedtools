<?php

namespace App\Http\Controllers\CRM\User;
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

        return view('user.prospect.prospects', compact('prospects','user'));
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
        $prospect = Contact::find($id);
        if(!$prospect || !$prospect->assigned==Auth::id() || !$prospect->isProspect){
            return redirect('user/prospects')->with('error','No se ha Encontrado el Prospecto');
        }       
        
        return view('user.prospect.prospect', compact('prospect','user'));
    }
}
