<?php

namespace App\Http\Controllers\CRM\Ventas;
//
use Session;
use Illuminate\Http\Request;
//
use App\Http\Controllers\Controller;
//
use App\Models\Project;
use App\Models\Task;
//
use Illuminate\Support\Facades\Auth;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        // $tasks = Task::
        $user = Auth::user();
        $projects = Project::all() ;
        return view('admin.project.projects')->with('projects',$projects)
                                            ->with('user',$user) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        // $proje
        return view('admin.project.create')->with('user',$user) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projects_count = Project::count() ;
        $user = Auth::user();
      
        if ( $projects_count < 10  ) {  
            
            // dd( $request->all()  ) ;
            $this->validate( $request, [
                'project' => 'required'
            ] ) ;        
    
            $project_new = new Project;
            $project_new->project_name = $request->project;
            $project_new->save() ;
            Session::flash('success', 'Project Created') ;
            return redirect()->route('admin.project.show') ;
        }
        
        else {
            Session::flash('info', 'Please delete some projects, Demo max: 10') ;
            return redirect()->route('admin.project.show') ;          
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $edit_project =  Project::find($id) ;
        return view('admin.project.edit',compact('edit_project','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $update_project = Project::find($id) ;
        $update_project->project_name = $request->name;
        $update_project->save() ;
        Session::flash('success', 'Project was sucessfully edited') ;
        return redirect()->route('admin.project.show') ;
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
        $delete_project = Project::find($id) ;
        $delete_project->delete() ;
        Session::flash('success', 'Project was deleted and tasks associated with it') ;
        return redirect()->back();        
        
    }

    // does not work see  /app/Http/Controllers/Auth/LoginController.php
    // public function logout () {
    //     //logout user
    //     auth()->logout();
    //     // redirect to homepage or login
    //     return redirect('/login');
    // }


}
