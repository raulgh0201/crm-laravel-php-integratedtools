@extends('user.layouts.app')
@section('style')
    <link href="{{asset('assets/css/CRM/User/contact/common/contact/contact-global.css')}}" rel="stylesheet">
@endsection
@section('title') 
{{$client->name}}
@endsection

@section('left-menu')

    @include('user.layouts.menus.sidebar')

@endsection

@section('content')


<!--Plantilla-ARNAU-->
<section class="content">

<!--No borrar!!-->
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

    <!-- Default box -->
      <div class="card card-solid">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-12 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header red text-muted border-bottom-0">
                    Cliente
                  </div>
                  <div class="card-body red pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead red"><b>{{ $client->name }}</b></h2>
                        <ul class="ml-4 mb-0 fa-ul text-muted red"> 
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span>Email: {{!isset($client->email) ? 'No Especificado' : $client->email}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>Teléfono: {{!isset($client->phone) ? "No Especificado" : $client->phone}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone-square"></i></span>Teléfono Secundario: {{!isset($client->phone_2  ) ? 'No Especificado' : $client->phone_2 }}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-route"></i></span>Dirección: {{!isset($client->address) ? 'No Especificado' : $client->address}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-street-view"></i></span>Ciudad: {{!isset($client->city) ? 'No Especificado' :  $client->city}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-location-arrow"></i></span>Provincia/Estado: {{!isset($client->province_state) ? 'No Especificado' : $client->province_state}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-globe-europe"></i></span>País: {{!isset($client->country) ? 'No Especificado' :  $client->country }}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-sticky-note"></i></span>Nota: {{!isset($client->note) ? 'No Especificado' : $client->note}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-comments"></i></span>Mensaje del cliente: {{!isset($client->prospect_message ) ? 'No Especificado' : $client->prospect_message}}</li><hr>
                         
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="../../images/contactImgs/profileImgs/{{$client->imgPerfil}}" alt="user-avatar" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer red">
                    <div class="text-right">
                      <a href="mailto:{{$client->email }}" class="btn btn-sm bg-teal">
                        <i class="fas fa-comments"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- /.card-body -->
    </div>
      <!-- /.card -->
</section>
<!--FIN Plantilla-ARNAU-->


    
@endsection
<script src="{{asset('js/user/contact/common/contact/contact-global.js')}}"></script>