@extends('admin.layouts.app')
@section('title') Usuarios @endsection

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
                        <button class="btn btn-block btn-primary" id="show-new-user-form" onclick="mostrar()">Añadir nuevo usuario</button>
                        <div id="componente">
                        @component('admin.layouts.crm.forms.add_user')

                        @endcomponent
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        Usuarios Actuales
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
    <script src="{{ asset('js/admin/users.js') }}"></script>
@endpush
<script src="{{ asset('js/admin/users.js') }}"></script>