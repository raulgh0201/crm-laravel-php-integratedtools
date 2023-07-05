@extends('admin.layouts.app')
@section('title') Empleado @endsection
@section('style')
<link href="{{asset('assets/css/CRM/Admin/contact/user/user.css')}}" rel="stylesheet">
@endsection
@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection

@section('content')

    
 <!--Plantilla
 No eliminar! Sirve para mostrar errores y sucesos! S puede cambiar la estructura pero manteniendo el php
 -->
 @if (count($errors) > 0)

    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                <strong>Hay un error en tu formulario!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    
@endif
 @if(session()->has('error'))
<div class="row">
    <div class="col-12">
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    </div>
</div>
@endif
@if(session()->has('success'))
<div class="row">
    <div class="col-12">
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    </div>
</div>
@endif
 <div class="small-box bg-info">
 
   
            <div class="inner">
                <h3>Editar Empleado</h3>
                <button class="btn btn-success" onclick="showEditUserForm()">Editar</button>
            </div>
            <div class="icon">
                
                <i class="fas fa-user-tie"></i>
            </div>
            <ul class="list-group list-group-flush">
                    <li class="small-box-footer">
                        <h5>Nombre: {{ $employee->name}}</h5>
                        <h5>Email: {{ $employee->email}}</h5>
                        <h5>Rol: {{ $employee->role}}</h5>
                        <h5>Activo: {{ $employee->isActive == 1 ? 'Yes' : 'No'}}</h5>
                    </li>
                    <hr>
            </ul>
</div>
    <!--FIN-Plantilla-->
{{-- /.row --}}

{{-- Modals --}}


<div id="edit-details-modal" style="display: none" class="modal-cont" id="overlay">
    <div class="row">
    {{-- @if ($errors)
            {{$errors}}
        @endif --}} 
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
                            <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ $employee->name}}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('name')}}    
                                </div>                                    
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ $employee->email}}">
                            @if ($errors->has('email'))
                            <!--No funciona la clase invalid-feedback para mostrar los errores, cambiar por otra o arreglar-->
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}    
                                </div>                                    
                            @endif
                        </div>
                            
                        <div class="form-group">
                            <label for="role">Rol:</label>
                            <select name="role" class="form-control  {{ $errors->has('role') ? 'is-invalid' : '' }}">
                            <option value="{{ $employee->role }}">{{ ucfirst($employee->role) }}</option>
                                  <option value="admin">Admin</option>
                                <option value="sales">Sales</option>
                                <option value="marketing">Marketing</option>
                            </select>
                            @if ($errors->has('role'))
                                <!--No funciona la clase invalid-feedback para mostrar los errores, cambiar por otra o arreglar-->

                                <div class="invalid-feedback">
                                    {{$errors->first('role')}}    
                                </div>                                    
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="isActive">Usuario Activo:</label>
                            <select name="isActive" class="form-control  {{ $errors->has('isActive') ? 'is-invalid' : '' }}">
                                <option value="1" {{$employee->isActive == 1 ? 'default' : '' }}>Si</option>
                                <option value="0" {{$employee->isActive == 0 ? 'default' : ''}}>No</option>
                            </select>
                            @if ($errors->has('isActive'))
                                <!--No funciona la clase invalid-feedback para mostrar los errores, cambiar por otra o arreglar-->

                                <div class="invalid-feedback">
                                    {{$errors->first('isActive')}}    
                                </div>                                    
                            @endif
                        </div>
                        <button class="btn btn-success btn-block">Actualizar Usuario</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<script src="{{ asset('js/admin/contact/employee/user.js') }}"></script>
