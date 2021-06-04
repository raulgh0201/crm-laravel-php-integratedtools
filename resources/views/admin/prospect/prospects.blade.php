@extends('admin.layouts.app')
@section('title') Prospectos @endsection
@section('style')
    <link href="{{asset('assets/css/CRM/Admin/contact/common/contact/contacts-global.css')}}" rel="stylesheet">
@endsection
@section('left-menu')

    @include('admin.layouts.menus.sidebar')

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
      <h1 class="titulo-seccion">PROSPECTOS</h1>
      <div class="row">
        <div class="col-12">
            <button class="btn btn-success btn-sm" id="add-contact-btn">Añadir Prospecto</button>
        </div>
      </div>
        @foreach ($prospects as $prospect)
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-sm-6 offset-sm-3">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header red text-muted border-bottom-0">
                    Prospecto
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead red"><b>{{ $prospect->name }}</b></h2>
                        <ul  class="ml-4 mb-0 fa-ul text-muted">
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> {{!isset($prospect->phone) ? 'No Especificado' : $prospect->phone}}</li><hr>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> {{ $prospect->email }}</li><hr>
                          @if(empty($prospect->instagram_user))
                            <li class="small"><span class="fa-li"> <i class="fab fa-lg fa-instagram"></i></span>No Especificado</li><hr>
                          @else
                            <li class="small"><span class="fa-li"> <i class="fab fa-lg fa-instagram"></i></span><a href='https://www.instagram.com/{{$prospect->instagram_user}}'>{{$prospect->instagram_user}}</a></li><hr>
                          @endif
                        
                         @if(empty($prospect->facebook_user))
                            <li class="small"><span class="fa-li"> <i class="fab fa-lg fa-facebook"></i></span>No Especificado</span></li><hr>
                         @else
                            <li class="small"><span class="fa-li"> <i class="fab fa-lg fa-facebook"></i></span><a href='https://www.facebook.com/{{$prospect->facebook_user}}'>{{$prospect->facebook_user}}</a></li><hr>
                          @endif
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="../images/contactImgs/profileImgs/{{$prospect->imgPerfil}}" alt="user-avatar" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  
                  <div class="card-footer">
                    <div class="text-right">
                      <a href="mailto:{{$prospect->email }}" class="btn btn-sm bg-teal">
                        <i class="fas fa-comments"></i>
                      </a>
                      <a href="{{ route('admin.prospect', ['id' => $prospect->id]) }}" class="btn btn-sm btn-primary">
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
                    {{ $prospects->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
      <!-- /.card -->
</section>

    {{-- Modals --}}
    <div class="modal-style" id="add-contact-modal">
        <div class="card">
            <div class="card-header"><h5>Añadir Nuevo Prospecto <span class="float-right close-modal">X</span> </h5></div>
            <div class="card-body">
                <form action="{{route('admin.prospect.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('name')}}    
                                    </div>                                    
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico:</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('email')}}    
                                    </div>                                    
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone_2">Teléfono Secundario:</label>
                                <input type="text" class="form-control" name="phone_2" value="{{ old('phone_2') }}">
                            </div>
                            <div class="form-group">
                                <label for="instagram">Usuario Instagram</label>
                                <input type="text" class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" name="instagram" value="{{ old('instagram') }}">
                                @if($errors->has('instagram'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('instagram') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="facebook">Usuario Facebook</label>
                                <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" name="facebook" value="{{ old('facebook') }}">
                                @if($errors->has('facebook'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('facebook') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección:</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                            </div>
                            <div class="form-group">
                                <label for="city">Ciudad:</label>
                                <input type="text" class="form-control" name="city" value="{{ old('city') }}">
                            </div>
                        </div>
                        {{-- /.col-md-6 -- First column --}}
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="province_state">Provincia/Estado:</label>
                                <input type="text" class="form-control" name="province_state" value="{{ old('province_state') }}">
                            </div>
                            <div class="form-group">
                                <label for="country">País:</label>
                                <input type="text" class="form-control" name="country" value="{{ old('country') }}">
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
                                <label for="assigned">Empleado Asignado:</label>
                                <select name="assigned" id="" class="form-control" value="{{ old('assigned') }}">
                                    <option value="0">Sin Asignar</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{ old('assigned') == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                    @endforeach
                                </select>                    
                            </div>                                         
                            <div class="form-group">
                                <label for="note">Más Acerca del Prospecto: </label>
                                <textarea name="note" id="" cols="30" rows="9" class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}">{{ old('note') }}</textarea>
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
                    <button class="btn btn-primary btn-sm btn-block">Añadir Nuevo Prospecto</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection

<script src="{{asset('js/admin/contact/common/contact/contacts-global.js')}}"></script>