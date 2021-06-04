@extends('admin.layouts.app')

@section('title') Tareas @endsection
@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection

@section('content')

<!--   /views/task/task/tasks.blade.php   -->
<div class="row">
    <div class="col-md-6">
        <h1>TODAS LAS TAREAS</h1>
    </div>

    <div class="col-md-6">
        <form action="{{ route('admin.task.search') }}" class="navbar-form" role="search" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search in Tasks..." name="search_task">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search">
                            <span class="sr-only">Buscar...</span>
                        </span>
                    </button>
                </span>
            </div>
        </form>
    </div> 

</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Created At</th>
        <th><a href="{{ route('admin.task.sort', [ 'key' => 'task' ]) }}">Título de la tarea <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th>Assignado A / Proyecto</th>
        <th><a href="{{ route('admin.task.sort', [ 'key' => 'priority' ]) }}">Prioridad <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th><a href="{{ route('admin.task.sort', [ 'key' => 'completed' ]) }}">Estado <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span> </a></th>
        <th>Actions</th>
      </tr>
    </thead>

@if ( !$tasks->isEmpty() ) 
    <tbody>
    @foreach ( $tasks as $task)
      <tr>
        <td>{{ Carbon\Carbon::parse($task->created_at)->format('m-d-Y') }}</td>
        <td>{{ $task->task_title }} </td>

        <td>
         
            @foreach( $users as $user) 
                @if ( $user->id == $task->user_id )
                    <a href="{{ route('admin.user.list', [ 'id' => $user->id ]) }}">{{ $user->name }}</a>
                @endif
            @endforeach
            <span class="label label-jc">{{ $task->project->project_name }}</span>

        </td>

        <td>
            @if ( $task->priority == 0 )
                <span class="label label-info">Normal</span>
            @else
                <span class="label label-danger">Alta</span>
            @endif
        </td>
        <td>
            @if ( !$task->completed )
                <a href="{{ route('admin.task.completed', ['id' => $task->id]) }}" class="btn btn-warning"> Marcar como completada</a>
                <span class="label label-danger">{{ ( $task->duedate < Carbon\Carbon::now() )  ? "!" : "" }}</span>
            @else
                <span class="label label-success">Completada</span>
            @endif
  
            

        </td>
        <td>
            <a href="{{ route('admin.task.view', ['id' => $task->id]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true">Ver</span></a>
           <a href="{{ route('admin.task.edit', ['id' => $task->id]) }}" class="btn btn-primary"> Editar </a>
            <a href="{{ route('admin.task.delete', ['id' => $task->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true">Eliminar</span></a>

        </td>
      </tr>

    @endforeach
    </tbody>

    {{ $tasks->links() }}


@else 
    <p><em>There are no tasks assigned yet</em></p>
@endif


</table>
</div>


@stop