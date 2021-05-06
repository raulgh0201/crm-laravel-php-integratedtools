@extends('user.layouts.app')

@section('title') Mis Clientes @endsection
@section('style')
    <link href="{{asset('assets/css/CRM/User/contact/common/contact/contacts-global.css')}}" rel="stylesheet">
@endsection
@section('left-menu')

    @include('user.layouts.menus.sidebar')

@endsection
@section('style')
    {{ asset('assets/css/CRM/User/contact/client/clients.css')}}
@endsection

@section('content')
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



<section class="content">
    
      <!-- Default box -->
      <div class="card card-solid">
      <h1 class="titulo-seccion">MIS CLIENTES</h1>
        @foreach ($clients as $client)
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-sm-6 offset-sm-3">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header red text-muted border-bottom-0">
                    Cliente
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead red"><b>{{ $client->name }}</b></h2>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{!isset($client->phone) ? 'No Especificado' : $client->phone}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> {{ $client->email }}</li><hr>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="../images/contactImgs/profileImgs/{{$client->imgPerfil}}" alt="user-avatar" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  
                  <div class="card-footer">
                    <div class="text-right">
                      <a href="mailto:{{$client->email }}" class="btn btn-sm bg-teal">
                        <i class="fas fa-comments"></i>
                      </a>
                      <a href="{{ route('user.client', ['id' => $client->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> Ver Perfil
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          
        @endforeach
        {{-- /.row --}}
        <div class="row mt-5">
            <div class="col-md-6 offset-md-4">
                <div class="pagazul" style="margin: 0 auto;">
                    {{ $clients->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
      <!-- /.card -->
</section>
    
@endsection

<script src="{{asset('js/user/contact/common/contact/contacts-global.js')}}"></script>