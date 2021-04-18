@extends('admin.layouts.app')
@section('title') Usuario @endsection

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
                Editar usuario
                <span class="btn btn-sm btn-primary float-right" id="open-edit-details-modal" onclick="showEditUserForm()">Edit</span>
            </div>
            <div class="card-body">
                <h5>Nombre: {{ $user->name}}</h5>
                <h5>Email: {{ $user->email}}</h5>
                <h5>Rol: {{ $user->role}}</h5>
                <h5>Activo: {{ $user->isActive == 1 ? 'Yes' : 'No'}}</h5>
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
                    Editar Usuario: {{ $user->name }} <span class="float-right" id="close-edit-details-modal" style="cursor: pointer; color: red;" onclick=closeEditUserForm()><b>X</b></span>
                </div>
                <div class="card-body">
                <form action="{{ route('admin.user.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="id" value="{{ $user->id }}" hidden>
                        <div class="form-group">
                            <label for="name">Nombre de Usuario:</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" value="{{ $user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="role">Rol:</label>
                            <select name="role" class="form-control">
                            <option value="{{ $user->role }}">{{ ucfirst($user->role) }}</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="isActive">Usuario Activo:</label>
                            <select name="isActive" class="form-control">
                                <option value="1" {{$user->isActive == 1 ? 'default' : '' }}>Si</option>
                                <option value="0" {{$user->isActive == 0 ? 'default' : ''}}>No</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-block">Actualizar Usuario</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<script src="{{ asset('js/admin/user.js') }}"></script>
