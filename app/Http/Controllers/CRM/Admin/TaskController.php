<?php
namespace App\Http\Controllers\CRM\Admin;


use Session;
use Request;
use App\Http\Controllers\Controller;

// import our models
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskFiles;
use App\Models\User; 

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
/*===============================================
    INDEX
===============================================*/
    public function index()
    {
        // dd() ;
        // $tasks = Task::all() ;  // retrieve all Tasks
        $users =  User::all() ; 
        $user = Auth::user(); 

        $tasks  = Task::orderBy('created_at', 'desc')->paginate(10) ;  // Paginate Tasks 
        // dd($tasks) ;
        // pass is_overdue
        $today = \Carbon\Carbon::now() ; // not used
        // dd ($today) ;
        return view('admin.task.tasks')->with('tasks', $tasks) 
                                 ->with('users', $users ) 
                                ->with('user', $user) ;
    }

/*===============================================
    LIST Tasks
===============================================*/
    public function tasklist( $projectid ) {

        // dd($projectid);
        $user = Auth::user();
        $users =  User::all() ;
        $p_name = Project::find($projectid) ;
        // ->get()  will return a collection
        $task_list = Task::where('project_id','=' , $projectid)->get();
        return view('admin.task.list')->with('users', $users) 
                                ->with('p_name', $p_name)
                                ->with('task_list', $task_list) 
                                ->with('user', $user) ;
    }

/*===============================================
    VIEW Task
===============================================*/
    public function view($id)  {
        $user = Auth::user();
        $images_set = [] ;
        $files_set = [] ;
        $images_array = ['png','gif','jpeg','jpg'] ;
        // get task file names with task_id number
        $taskfiles = TaskFiles::where('task_id', $id )->get() ;

        if ( count($taskfiles) > 0 ) { 
            foreach ( $taskfiles as $taskfile ) {

                // explode the filename into 2 parts: the filename and the extension
                $taskfile = explode(".", $taskfile->filename ) ;
                // store images only in one array
                // $taskfile[0] = filename
                // $taskfile[1] = jpg
                // check if extension is a image filetype
                if ( in_array($taskfile[1], $images_array ) ) 
                    $images_set[] = $taskfile[0] . '.' . $taskfile[1] ;
                    // if not an image, store in files array
                else
                    $files_set[] = $taskfile[0] . '.' . $taskfile[1]; 
            }
        }



        $task_view = Task::find($id) ;

        // Get task created and due dates
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task_view->created_at);
        $to   = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task_view->duedate ); // add here the due date from create task

        $current_date = \Carbon\Carbon::now();
 
        // Format dates for Humans
        $formatted_from = $from->toRfc850String();  
        $formatted_to   = $to->toRfc850String();

        // Get Difference between current_date and duedate = days left to complete task
        // $diff_in_days = $from->diffInDays($to);
        $diff_in_days = $current_date->diffInDays($to);

        // Check for overdue tasks
        $is_overdue = ($current_date->gt($to) ) ? true : false ;

        // $task_view->project->project_name   will output the project name for this specific task
        // to populate the right sidebar with related tasks
        $projects = Project::all() ;
        return view('admin.task.view')
            ->with('task_view', $task_view) 
            ->with('projects', $projects) 
            ->with('taskfiles', $taskfiles)
            ->with('diff_in_days', $diff_in_days )
            ->with('is_overdue', $is_overdue) 
            ->with('formatted_from', $formatted_from ) 
            ->with('formatted_to', $formatted_to )
            ->with('images_set', $images_set)
            ->with('files_set', $files_set) 
            ->with('user', $user) ;
    }

/*===============================================
    SORT TASKS
===============================================*/
    public function sort( $key ) {
        $user = Auth::user();
        $users = User::all() ;
        // dd ($key) ; 
        switch($key) {
            case 'task':
                $tasks = Task::orderBy('task')->paginate(10); // replace get() with paginate()
            break;
            case 'priority':
                $tasks = Task::orderBy('priority')->paginate(10);
            break;
            case 'completed':
                $tasks = Task::orderBy('completed')->paginate(10);
            break;
        }

        return view('admin.task.tasks')->with('users', $users)
                                ->with('tasks', $tasks)
                                ->with('user', $user)  ;
    }

/*===============================================
    CREATE TASK
===============================================*/
    public function create()
    {
        $user = Auth::user();
        $projects = Project::all()  ;
        $users = User::all() ;
        return view('admin.task.create')->with('projects', $projects) 
                                  ->with('users', $users)
                                  ->with('user', $user)  ;        
    }

/*===============================================
    STORE NEW TASK
===============================================*/
    public function store(Request $request)
    {
        // dd($request->all() ) ;
        $tasks_count = Task::count() ;
        
        if ( $tasks_count < 20  ) { 
            // dd( $request->all()  ) ;
            // dd($request->file('photos'));

            $this->validate( $request, [
                'task_title' => 'required',
                'task'       => 'required',
                'project_id' => 'required|numeric',
                'photos.*'   => 'sometimes|required|mimes:png,gif,jpeg,jpg,txt,pdf,doc',  // photos is an array: photos.*
                'duedate'    => 'required'
            ]) ;

            // dd($request->all() ) ;
            // First save Task Info
            $task = Task::create([
                'project_id' => $request->project_id,
                'user_id'    => $request->user,
                'task_title' => $request->task_title,
                'task'       => $request->task,
                'priority'   => $request->priority,
                'duedate'    => $request->duedate
            ]);

            // Then save files using the newly created ID above
            if( $request->hasFile('photos') ) {
                foreach ($request->photos as $file) {
                    // To Storage
                    //$filename = $file->store('public'); // /storage/app/public

                    // filename will be saved as: public/wKZsF9ltDSNj82ynh.png
                    // explode this value at / and get the second element
                    // $filename = explode("/", $filename ) ; // FOR STORAGE

                    // If you want to save into  /public/images
                   // $filename = str_replace(' ' , '' , time() . '_' .$file->getClientOriginalName() );  // get original file name ex:   cat.jpg
                    // remove whitespaces and dots in filenames : [' ' => '', '.' => ''] 
                    $filename = strtr( pathinfo( time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME) , [' ' => '', '.' => ''] ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $file->move('images',$filename);

                    // save to DB
                    TaskFiles::create([
                        'task_id'  => $task->id, // newly created ID
                        'filename' => $filename  // For Regular Public Images
                        //'filename' => $filename[1]  // [0] => public, [1] => wKZsF9ltDSNj82ynh.png FOR STORAGE
                    ]);
                }
            }
    
            Session::flash('success', 'Task Created') ;
            return redirect()->route('admin.task.show') ; 
        }
        
        else {
            Session::flash('info', 'Please delete some tasks, Demo max tasks: 20') ;
            return redirect()->route('admin.task.show') ;         
        }

    }

/*===============================================
    MARK TASK AS COMPLETED
===============================================*/
    public function completed($id)
    {
        $user = Auth::user();
        $task_complete = Task::find($id) ;
        $task_complete->completed = 1;
        $task_complete->save() ;
        return redirect()->back();
    }

/*===============================================
    EDIT TASK
===============================================*/
    public function edit($id)
    {
        $user = Auth::user();
// $project::find(1)->tasks; retrieves the project record with id 1 and lists all tasks that have the project_id 1.

        // $task_list = Task::where('project_id','=' , $projectid)->get();
        $task = Task::find($id)  ; 
        $taskfiles = TaskFiles::where('task_id', '=', $id)->get() ;
        // dd($taskfiles) ;
        $projects = Project::all() ;
        $users = User::all() ;
        //$project_edit = Project::find($id)->tasks ; 
        // echo '<pre>';
        // print_r( Project::all() );
        // echo '</pre>';

        // dd($task_edit) ;  // returns NULL

        //dd($task_edit) ;  // Works
        //$project_edit = Project::find($id) ;
        return view('admin.task.edit')->with('task', $task)
                                ->with('projects', $projects ) 
                                ->with('users', $users)
                                ->with('user', $user) 
                                ->with('taskfiles', $taskfiles);
    }

/*===============================================
    UPDATE TASK
===============================================*/
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        // dd( $request->all() ) ;
        $update_task = Task::find($id) ;
        // dd( $update_task->id ) ;

        $this->validate( $request, [
            'task_title' => 'required',
            'task'       => 'required',
            'project_id' => 'required|numeric',
            'photos.*'   => 'sometimes|required|mimes:png,gif,jpeg,jpg,txt,pdf,doc' // photos is an array: photos.*
        ]) ;

        $update_task->task_title = $request->task_title; 
        $update_task->task       = $request->task;
        $update_task->user_id    = $request->user_id;
        $update_task->project_id = $request->project_id;
        $update_task->priority   = $request->priority;
        $update_task->completed  = $request->completed;
        $update_task->duedate    = $request->duedate;

        if( $request->hasFile('photos') ) {
            foreach ($request->photos as $file) {
                // remove whitespaces and dots in filenames : [' ' => '', '.' => ''] 
                $filename = strtr( pathinfo( time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME) , [' ' => '', '.' => ''] ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
               // $filename = str_replace(' ' , '' , pathinfo( time() . '_' . $file->getClientOriginalName(), PATHINFO_FILENAME)   ) . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);  // get original file name ex:   cat.jpg
              //  echo 'filename: ' . $filename ; 

               // dd ($filename) ; 
                $file->move('images',$filename);

                // save to DB
                TaskFiles::create([
                    'task_id'  => $request->task_id,
                    'filename' => $filename  // For Regular Public Images
                ]);
            }        
        }

        $update_task->save() ;
        
        Session::flash('success', 'Task was sucessfully edited') ;
        return redirect()->route('admin.task.show') ;
    }

/*===============================================
    DESTROY TASK
===============================================*/
    public function destroy($id)
    {
        $user = Auth::user();
        $delete_task = Task::find($id) ;
        $delete_task->delete() ;
        Session::flash('success', 'Task was deleted') ;
        return redirect()->back();
    }

/*===============================================
    DELETE FILE
===============================================*/
    public function deleteFile($id) {
        $user = Auth::user();
        $delete_file = TaskFiles::find($id) ;
        // remove  file from public directory
        unlink( public_path() . '/images/' . $delete_file->filename ) ;

        // delete entry from database
        $delete_file->delete() ;
        Session::flash('success', 'File Deleted') ;
        return redirect()->back(); 
    }

/*===============================================
    SEARCH TASK
===============================================*/
    public function searchTask() {
        $user = Auth::user();
        $value = Request::input('search_task');
        $tasks = Task::where('task', 'LIKE', '%' . $value . '%')->limit(25)->get();

        return view('admin.task.search', compact('value', 'tasks', 'user')  ) ;
    }


}
