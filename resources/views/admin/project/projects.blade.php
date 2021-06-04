@extends('admin.layouts.app')

@section('title') Proyectos @endsection
@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection

@section('content')
@include('includes.errors') 


<h1>LISTA DE PROYECTOS ACTIVOS</h1>

<div class="new_project">
  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Añadir nuevo proyecto</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Entrar Nombre del Proyecto</h4>
      </div>
      <div class="modal-body">
        <form id="project_form" action="{{ route('admin.project.store') }}" method="POST">
            {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" id="project" name="project">
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <input class="btn btn-primary" type="submit" value="Submit" >
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

        </form>
      </div>

    </div>

  </div>
</div>
<!--  END modal  -->



<div class="table-responsive">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre del proyecto</th>
        <th>Lista de tareas</th>
        <th>Acciones</th>
      </tr>
    </thead>

@if ( !$projects->isEmpty() ) 
    <tbody>
    @foreach ( $projects  as $project)
      <tr>
        <td>{{ $project->project_name }} </td>
        <td>
           <a href="{{ route('admin.task.list', [ 'projectid' => $project->id ]) }}">List all tasks</a>
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.project.edit', [ 'id' => $project->id ]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true">Editar</span></a>          
          <a class="btn btn-danger" href="{{ route('admin.project.delete', [ 'id' => $project->id ]) }}" Onclick="return ConfirmDelete();"><span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span></a>&nbsp;&nbsp;
        </td>

      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>There are no tasks assigned yet</em></p>
@endif


</table>
</div>




@stop


<script>

function ConfirmDelete()
{
  var x = confirm("Are you sure? Deleting a Project will also delete all tasks associated with this project");
  if (x)
      return true;
  else
    return false;
}




</script>  
