@extends('admin.layouts.app')
@section('title') Empleados @endsection

@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection

@section('content')

    <div class="row">

        @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
        @endif

        <div class="col-sm-5">
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-block btn-danger" id="show-new-user-form" onclick="mostrar()">Añadir nuevo empleado</button>
                        <div id="componente">
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
            <option value="user" default>User</option>
            <option value="admin">Admin</option>
        </select>
        @if($errors->has('role'))
            <div class="invalid-feedback">
                {{ $errors->first('role') }}
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Entrar Contraseña Temporal</label>
        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password">
        @if($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirmar Contraseña Temporal</label>
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
                
            </div>

            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        Empleados Actuales
                    </div>
                    <ul class="list-group list-group-flush">
                        @if($users)
                            @foreach ($users as $user)
                            <li class="list-group-item"><a href="{{ route('admin.user', ['id' => $user->id]) }}">{{ $user->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>   

    </div>

@endsection

@push('admin.layouts.scripts.scripts')
    <script src="{{ asset('js/admin/contact/employee/users.js') }}"></script>
@endpush
<script src="{{ asset('js/admin/contact/employee/users.js') }}"></script>