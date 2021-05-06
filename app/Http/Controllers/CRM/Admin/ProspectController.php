<?php

namespace App\Http\Controllers\CRM\Admin;
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
        $prospects = Contact::where('isProspect', true)->paginate(10);
        $user = Auth::user();  
        $users = User::all();

        return view('admin.prospect.prospects', compact('prospects','users','user'));
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
        $prospect->isProspect = true;

        if($request->type != 0){
            $prospect->assigned = $request->assigned;
            $prospect->date_assigned = now();
            $prospect->isClaimable = 0;
        }
        if ($request->hasFile('imgperfil')) {
            $file =  $request->file('imgperfil');
            $fileName =  $file->getClientOriginalName();
            $file->move('images/contactImgs/profileImgs', $fileName);
            $prospect->imgPerfil = $fileName;
        } 
        if($request->assigned != 0){
            $prospect->assigned = $request->assigned;
            $prospect->date_assigned = now();
            $prospect->isClaimable = 0;
        }

        $prospect->save();

        return redirect()->route('admin.prospects')->with('success','Prospecto Creado Correctamente'); 
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
            return redirect('admin/prospects')->with('error','No se ha Encontrado el Prospecto');
        }
        $assigned_to = User::find($prospect->assigned);
        return view('admin.prospect.prospect', compact('prospect','assigned_to','user','users'));
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

    
        $prospect = Contact::find($request->id);

        $prospect->name = $request->name;
        $prospect->email = $request->email;
        $prospect->phone = $request->phone;
        $prospect->phone_2 = $request->phone_2;
        $prospect->address = $request->address;
        $prospect->city = $request->city;
        $prospect->province_state = $request->province_state;
        $prospect->country = $request->country;
        $prospect->note = $request->note; 

        if ($request->hasFile('imgperfil')) {
            $file =  $request->file('imgperfil');
            $fileName =  $file->getClientOriginalName();
            $file->move('images/contactImgs/profileImgs', $fileName);
            $prospect->imgPerfil = $fileName;
        } 
        
        if(isset($request->assigned)){
            $prospect->assigned = $request->assigned;
            $prospect->date_assigned = now();
            $prospect->isClaimable = 0;
        }

        $prospect->save();

        return redirect('admin/prospect/' . $prospect->id)->with('success', 'Prospecto Actualizado Correctamente');


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
