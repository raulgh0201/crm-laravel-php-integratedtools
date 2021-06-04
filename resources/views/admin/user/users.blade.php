@extends('admin.layouts.app')
@section('style')
<link href="{{asset('assets/css/CRM/Admin/contact/user/users.css')}}" rel="stylesheet">
@endsection
@section('title') Empleados @endsection

@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection


@section('content')

<!--NO BORRAR!!!!! SIRVE PARA LOS FALLOS Y SUCESOS-->
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
    <!--Formulario-->
   <!--Esta en el archivo ARNAU-USERS-FORM(ES EL QUE DA ERROR)-->
    <!--Fin Formulario-->
            <!--Plantilla-->
    <div class="small-box bg-info">
            <div class="inner">
                <h3>EMPLEADOS ACTUALES</h3>
                <button class="btn btn-success" id="show-new-user-form">Añadir nuevo empleado</button>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <ul class="list-group list-group-flush">
                @if($users)
                    @foreach ($users as $user)
                    <li class="small-box-footer">{{ $user->name }}
                        <a class="users-info"href="{{ route('admin.user', ['id' => $user->id]) }}" >
                            Más Información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </li>
                    <hr>
                    @endforeach
                @endif
            </ul>
    </div>
            <!--FIN-Plantilla-->

    <div class="modal-style" id="add-contact-modal">
        <div class="card">
            <div class="card-header"><h5>Añadir Nuevo Empleado <span class="float-right close-modal">X</span> </h5></div>
            <div class="card-body">
                <form action="{{ route('admin.user.store') }}" method="POST" id="new-user-form">
                                @csrf 
                                <div class="form-group">
                                    <label for="name">Nombre de usuario:</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}">
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="role">Seleccionar ROL:</label>
                                    <select name="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}" value="{{ old('role') }}">
                                        <option value="Admin" default>Admin</option>
                                        <option value="Marketing">Marqueting</option>
                                        <option value="Sales">Ventas</option>

                                    </select>
                                    @if($errors->has('role'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('role') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Entrar Contraseña</label>
                                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirmar Contraseña</label>
                                    <input type="password" class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}" name="confirm_password">
                                    @if($errors->has('confirm_password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('confirm_password') }}
                                        </div>
                                    @endif
                                </div>
                                <button class="btn btn-block btn-primary">Añadir Nuevo Empleado</button>
                </form>
            </div>
        </div>
    </div>

            


@endsection

<script src="{{ asset('js/admin/contact/employee/users.js') }}"></script>