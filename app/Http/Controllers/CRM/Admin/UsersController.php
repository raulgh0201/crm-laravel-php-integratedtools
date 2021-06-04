<?php

namespace App\Http\Controllers\CRM\Admin;
use App\Http\Controllers\Controller;


use App\Models\Task; 
use App\Models\User;
use App\Models\Project; 


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();     
        $users = User::all();

        return view('admin.user.users', compact('users','user'));
    }

    public function getUser(Request $request, $id)
    {
        $currentUser = Auth::user(); 
        $user = User::find($id);
        if(!$user){
            return redirect('admin/users')->with('error','No se ha Encontrado el Empleado');
        }

        return view('admin.user.user', ['employee' => $user],['user' => $currentUser ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|unique:users|email',
            'role' => 'required',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);
        
        $user_password = Hash::make($request->password);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = $user_password;

        $user->save();

        return redirect('admin/users')->with('success', 'Usuario Creado Correctamente');

    }

    public function update(Request $request){

        // dd($request);
        // Manualy check the database to see if their are any emails that it matches in the database other than this users email.
       
        echo "hola";
        $request->validate([
            'id' => 'required',
            'name' => 'required|min:6',
            'email' => 'required|unique:users,email,' .$request->id,
            'role' => 'required',
            'isActive' => 'required',
        ]);

       
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->isActive = $request->isActive;

        $user->save();

        return redirect('admin/user/' . $user->id)->with('success', 'Usuario Actualizado Correctamente');

    }

    public function userTaskList($id) {

        $username = User::find($id) ;
        $task_list = Task::where('user_id','=' , $id)->get();
        // return view('user.list')->with('username', $username)
        //             ->with('task_list', $task_list) ;
        return view('user.list', compact('task_list', 'username') ) ;
    }
}