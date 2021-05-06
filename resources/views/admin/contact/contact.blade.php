@extends('admin.layouts.app')

@section('title') {{$contact->name}} @endsection
@section('style')
    <link href="{{asset('assets/css/CRM/Admin/contact/common/contact/contact-global.css')}}" rel="stylesheet">
@endsection

@section('left-menu')

    @include('admin.layouts.menus.sidebar')

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
                    Contacto
                  </div>
                  <div class="card-body red pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead red"><b>{{ $contact->name }}</b></h2>
                        <ul class="ml-4 mb-0 fa-ul text-muted red"> 
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span>Email: {{!isset($contact->email) ? 'No Especificado' : $contact->email}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>Teléfono: {{!isset($contact->phone) ? "No Especificado" : $contact->phone}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone-square"></i></span>Teléfono Secundario: {{!isset($contact->phone_2  ) ? 'No Especificado' : $contact->phone_2 }}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-route"></i></span>Dirección: {{!isset($contact->address) ? 'No Especificado' : $contact->address}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-street-view"></i></span>Ciudad: {{!isset($contact->city) ? 'No Especificado' :  $contact->city}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-location-arrow"></i></span>Provincia/Estado: {{!isset($contact->province_state) ? 'No Especificado' : $contact->province_state}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-globe-europe"></i></span>País: {{!isset($contact->country) ? 'No Especificado' :  $contact->country }}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-sticky-note"></i></span>Nota: {{!isset($contact->note) ? 'No Especificado' : $contact->note}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-comments"></i></span>Mensaje del contacto: {{!isset($contact->contact_message ) ? 'No Especificado' : $contact->contact_message}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-record-vinyl"></i></span>Reclamable: {{$contact->isClaimable == true ? 'Yes' : 'No'}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-th-large"></i></span>Tipo de Contacto:   @if($contact->isProspect)
                                                                                                                                    Prospecto
                                                                                                                                    @elseif($contact->isClient)
                                                                                                                                        Cliente
                                                                                                                                    @else
                                                                                                                                        No Especificado 
                                                                                                                              @endif </li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-list-alt"></i></span>Asignado a: {{!isset($assigned_to->name) ? 'Sin Asignar' : $assigned_to->name }}</li><hr>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="../../images/contactImgs/profileImgs/{{$contact->imgPerfil}}" alt="user-avatar" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer red">
                    <div class="text-right">
                      <a href="{{route('admin.contact.destroy',['id'=>$contact->id])}}" class="btn btn-sm bg-danger">
                        <i class="fas fa-trash"></i>
                      </a>
                      <a href="mailto:{{$contact->email }}" class="btn btn-sm bg-teal">
                        <i class="fas fa-comments"></i>
                      </a>
                      <a href="#" class="btn btn-sm btn-primary " onclick="showEditContactForm()">
                        <i class="fas fa-user" ></i> Actualizar
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

<div id="edit-details-contact" style="display: none" class="modal-cont" id="overlay">
        <div class="card">
        {{-- @if ($errors)
            {{$errors}}
        @endif --}}     
            <div class="card-header"><h5>Datos del Contacto <span class="float-right close-modal" style="cursor: pointer; color: red;" onclick=closeEditContactForm()>X</span> </h5></div>
            <div class="card-body">
                <form action="{{route('admin.contact.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <input type="text" name="id" value="{{ $contact->id }}" hidden>
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ $contact->name }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('name')}}    
                                    </div>                                    
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico:</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{$contact->email }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('email')}}    
                                    </div>                                    
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input type="text" class="form-control" name="phone" value="{{$contact->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="phone_2">Teléfono Secundario:</label>
                                <input type="text" class="form-control" name="phone_2" value="{{ $contact->phone_2 }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección:</label>
                                <input type="text" class="form-control" name="address" value="{{ $contact->address }}">
                            </div>
                            <div class="form-group">
                                <label for="city">Ciudad:</label>
                                <input type="text" class="form-control" name="city" value="{{ $contact->city }}">
                            </div>
                        </div>
                        {{-- /.col-md-6 -- First column --}}
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="province_state">Provincia/Estado:</label>
                                <input type="text" class="form-control" name="province_state" value="{{ $contact->province_state }}">
                            </div>
                            <div class="form-group">
                                <label for="country">País:</label>
                                <input type="text" class="form-control" name="country" value="{{ $contact->country }}">                      
                            </div>   
                            <div class="form-group">
                                <label for="imgperfil">Imagen de perfil</label><br>
                                <input type="file" accept="image/*" name="imgperfil" >
                                @if ($errors->has('imgperfil'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('imgperfil')}}    
                                    </div>                                    
                                @endif
                            </div>                       
                            <div class="form-group">
                                <label for="type">Tipo de Contacto:</label>
                                <select name="type" id="" class="form-control"> 
                                @if($contact->isProspect)                                    
                                    <option value="0">Sin Asignar</option>
                                    <option value="1" selected="selected">Prospecto</option>
                                    <option value="2">Cliente</option>
                                @elseif($contact->isClient)
                                    <option value="0">Sin Asignar</option>
                                    <option value="1">Prospecto</option>
                                    <option value="2" selected="selected">Cliente</option>                                                                                                                                                   
                                @else
                                    <option value="0" selected="selected">Sin Asignar</option>
                                    <option value="1">Prospecto</option>
                                    <option value="2">Cliente</option>                     
                                @endif                                
                                    
                                </select>                    
                            </div>                            
                            <div class="form-group">
                                <label for="note">Más Acerca del Contacto: </label>
                                <textarea name="note" id="" cols="30" rows="9" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}" >{{$contact->note}}</textarea>

                                @if ($errors->has('note'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('note')}}    
                                    </div>                                    
                                @endif
                            </div>                            
                        </div>
                        {{-- /.col-md-6 --}}
                    </div>       
                         {{-- /.row  --}}                    
                    <button class="btn btn-primary btn-sm btn-block">Actualizar Contacto</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection
<script src="{{asset('js/admin/contact/common/contact/contact-global.js')}}"></script>