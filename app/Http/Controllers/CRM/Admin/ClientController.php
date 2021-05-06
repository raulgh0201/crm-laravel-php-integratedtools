<?php

namespace App\Http\Controllers\CRM\Admin;
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
        //$assigned_leads = Prospect::where('assigned', Auth::id() );
        $clients = Contact::where('isClient', true)->paginate(10);
        $user = Auth::user();  
        $users = User::all();

        return view('admin.client.clients', compact('clients','users','user'));
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
        // dd($request);
        $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|unique:contacts',
            'note' => 'required|min:20',
            'imgperfil' => 'image|nullable|max: 1999',
        ]);      
        $prospect = new Contact;

        $prospect->created_by = Auth::id();
        $prospect->name = $request->name;
        $prospect->email = $request->email;
        $prospect->phone = $request->phone;
        $prospect->phone_2 = $request->phone_2;
        $prospect->address = $request->address;
        $prospect->city = $request->city;
        $prospect->province_state = $request->province_state;
        $prospect->country = $request->country;
        $prospect->note = $request->note;
        $prospect->isClient = true;

        if($request->assigned != 0){
            $prospect->assigned = $request->assigned;
            $prospect->date_assigned = now();
            $prospect->isClaimable = 0;
        }

        if ($request->hasFile('imgperfil')) {
            $file =  $request->file('imgperfil');
            $fileName =  $file->getClientOriginalName();
            $file->move('images/contactImgs/profileImgs', $fileName);
            $client->imgPerfil = $fileName;
        }

        if($request->assigned != 0){
            $client->assigned = $request->assigned;
            $client->date_assigned = now();
            $client->isClaimable = 0;
        }

        $prospect->save();

        return redirect()->route('admin.clients')->with('success','Cliente Creado Correctamente');   ;
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
        $users = User::all(); 
        $client = Contact::find($id);
        
        if(!$client){
            return redirect('admin/clients')->with('error','No se ha Encontrado el Cliente');
        }
        $assigned_to = User::find($client->assigned);
        
        return view('admin.client.client', compact('client','assigned_to','user','users'));
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

        // dd($request);
        // Manualy check the database to see if their are any emails that it matches in the database other than this users email.

        $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|unique:contacts,email,' .$request->id,
            'note' => 'required|min:20',
            'imgperfil' => 'image|nullable|max: 1999',
        ]);        

        $client = Contact::find($request->id);
        
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->phone_2 = $request->phone_2;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->province_state = $request->province_state;
        $client->country = $request->country;
        $client->note = $request->note; 

        if ($request->hasFile('imgperfil')) {
            $file =  $request->file('imgperfil');
            $fileName =  $file->getClientOriginalName();
            $file->move('images/contactImgs/profileImgs', $fileName);
            $client->imgPerfil = $fileName;
        } 
        
        if(isset($request->assigned)){
            $client->assigned = $request->assigned;
            $client->date_assigned = now();
            $client->isClaimable = 0;
        }

        $client->save();

        return redirect('admin/client/' . $client->id)->with('success', 'Cliente Actualizado Correctamente');


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
