<?php

namespace App\Http\Controllers\CRM\Admin;
use App\Models\User;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate(10);
        $user = Auth::user();  
        $users = User::all();
        return view('admin.contact.contacts', compact('contacts','users','user'));
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
       
        $contact = new Contact;

        $contact->created_by = Auth::id();

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->phone_2 = $request->phone_2;
        $contact->instagram_user = $request->instagram;
        $contact->facebook_user = $request->facebook;
        $contact->phone_2 = $request->phone_2;
        $contact->address = $request->address;
        $contact->city = $request->city;
        $contact->province_state = $request->province_state;
        $contact->country = $request->country;
        $contact->note = $request->note; 
        $contact->isProspect = false;
        $contact->isClient = false; 

      
       // echo $file->getClientOriginalName();

        if ($request->hasFile('imgperfil')) {
            $file =  $request->file('imgperfil');
            $fileName =  $file->getClientOriginalName();
            $file->move('images/contactImgs/profileImgs', $fileName);
            $contact->imgPerfil = $fileName;
        } 

        if($request->assigned != 0){
            $contact->assigned = $request->assigned;
            $contact->date_assigned = now();
            $contact->isClaimable = 0;
        }

        if($request->type == 1){
            $contact->isProspect = true;
        }
        if($request->type == 2){
            $contact->isClient = true;
        }

       $contact->save();

       return redirect()->route('admin.contacts')->with('success','Contacto Creado Correctamente');    
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
        $contact = Contact::find($id);
        $users = User::all();

        if(!$contact){
            return redirect('admin/contacts')->with('error','No se ha Encontrado el Contacto');
        }
        $assigned_to = User::find($contact->assigned);
        //echo $assigned_to->name;
        return view('admin.contact.contact', compact('contact','assigned_to','user','users'));
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
            'email' => 'unique:contacts,email,' .$request->id,
            'note' => 'required|min:20',
            'imgperfil' => 'image|nullable|max: 1999'
        ]);        

        $contact = Contact::find($request->id);

        $contact->name = $request->name;        
        $contact->email = $request->email;
        $contact->instagram_user = $request->instagram;
        $contact->facebook_user = $request->facebook;
        $contact->phone = $request->phone;
        $contact->phone_2 = $request->phone_2;
        $contact->address = $request->address;
        $contact->city = $request->city;
        $contact->province_state = $request->province_state;
        $contact->country = $request->country;
        $contact->note = $request->note; 
        $contact->isClient = false;
        $contact->isProspect = false; 

        if ($request->hasFile('imgperfil')) {
            $file =  $request->file('imgperfil');
            $fileName =  $file->getClientOriginalName();
            $file->move('images/contactImgs/profileImgs', $fileName);
            $contact->imgPerfil = $fileName;
        } 
        
        
        if ($request->type==1){
            $contact->isProspect = true;    
        }elseif($request->type==2){
            $contact->isClient = true;
        }

        $contact->save();

        return redirect('admin/contact/' . $contact->id)->with('success', 'Contacto Actualizado Correctamente');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user(); 
        
        if(Contact::where('id', $id)->delete()){
            return redirect('admin/contacts')->with('success','Contacto Eliminado Correctamente');
        }else{
            return redirect('admin/contacts')->with('success','Error Eliminando el Contacto');
        }
        
    }
}
