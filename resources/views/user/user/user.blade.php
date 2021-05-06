@extends('admin.layouts.app')
@section('title') Empleado @endsection

@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection

@section('content')
<style>
#edit-details-modal{
  margin-top:-297px !important;
  width: 100%;
  
  border-radius: 15px;
  box-shadow: 0 0 5px #CCC;
  background: #CCC;
  position: relative;
  transition: all 5s ease-in-out;
  margin: auto auto;
  visibility: visible;
  opacity: 0.9;
}
#overlay {
    opacity: 1;
}
</style>
    

<div class="row">
    <div class="col-sm-5">
        
        {{-- @if ($errors)
            {{$errors}}
        @endif --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Editar Empleado
                <span class="btn btn-sm btn-danger float-right"  onclick="showEditUserForm()">Edit</span>
            </div>
            <div class="card-body">
                <h5>Nombre: {{ $employee->name}}</h5>
                <h5>Email: {{ $employee->email}}</h5>
                <h5>Rol: {{ $employee->role}}</h5>
                <h5>Activo: {{ $employee->isActive == 1 ? 'Yes' : 'No'}}</h5>
            </div>
        </div>
        
    </div>
    <div class="col-sm-5">
        <div class="card">
            
        </div>
    </div>
</div>
{{-- /.row --}}

{{-- Modals --}}

<div id="edit-details-modal" style="display: none" class="modal-cont" id="overlay">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <div class="card mt-5">
                <div class="card-header">
                    Editar Empleado: {{ $employee->name }} <span class="float-right" id="close-edit-details-modal" style="cursor: pointer; color: red;" onclick=closeEditUserForm()><b>X</b></span>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.user.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="id" value="{{ $employee->id }}" hidden>
                        <div class="form-group">
                            <label for="name">Nombre de Usuario:</label>
                            <input type="text" class="form-control" name="name" value="{{ $employee->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" value="{{ $employee->email}}">
                        </div>
                        <div class="form-group">
                            <label for="role">Rol:</label>
                            <select name="role" class="form-control">
                            <option value="{{ $employee->role }}">{{ ucfirst($employee->role) }}</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="isActive">Usuario Activo:</label>
                            <select name="isActive" class="form-control">
                                <option value="1" {{$employee->isActive == 1 ? 'default' : '' }}>Si</option>
                                <option value="0" {{$employee->isActive == 0 ? 'default' : ''}}>No</option>
                            </select>
                        </div>
                        <button class="btn btn-danger btn-block">Actualizar Usuario</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<script src="{{ asset('js/admin/contact/employee/user.js') }}"></script>
