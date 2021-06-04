@extends('admin.layouts.app')

@section('title') Editar Proyecto @endsection
@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection

@section('content')

<h1>Lista de tareas para el proyecto:  "{{ $p_name->project_name }}" </h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre de la tarea</th>
        <th>Nombre del proyecto</th>
        <th>Prioridad</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>

@if ( !$task_list->isEmpty() ) 
    <tbody>
    @foreach ( $task_list as $task)
      <tr>
        <td>{{ $task->task_title }} </td>
        <td>{{ $task->project->project_name }}</td>
        <td>
            @if ( $task->priority == 0 )
                <span class="label label-info">Normal</span>
            @else
                <span class="label label-danger">Alto</span>
            @endif
        </td>
        <td>
            @if ( !$task->completed )
                <a href="{{ route('admin.task.completed', ['id' => $task->id]) }}" class="btn btn-warning"> Marcar como completada</a>
            @else
                <span class="label label-success">Completada</span>
            @endif
        </td>
        <td>
             <a href="{{ route('admin.task.edit', ['id' => $task->id]) }}" class="btn btn-primary"> Editar </a> 
            <a href="{{ route('admin.task.view', ['id' => $task->id]) }}" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"> Ver</span> </a>
            <a href="{{ route('admin.task.delete', ['id' => $task->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span></a>

        </td>
      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>No hay tareas asginadas aun</em></p>
@endif


</table>



<div class="btn-group">
    <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
</div>




@stop