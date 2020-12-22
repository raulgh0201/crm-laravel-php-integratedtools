<?php
header ("Cache-Control: no cache, must-revalidate");
header ("Expires: Sat, 1 Jul 2000 05:00:00 GMT");

?>
@extends('layouts.app')
<div class="login-form">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="text-center">
            <a href="index.html" aria-label="Space">
                <img class="mb-3" src="assets/image/logo.png" alt="Logo" width="259" height="76">
            </a>
          </div>
        <div class="text-center mb-4">
            <h1></h1>
        </div>
        <div class="js-form-message mb-3">
            <div class="js-focus-state input-group form">
              <div class="input-group-prepend form__prepend">
                <span class="input-group-text form__text">
                  <i class="fa fa-user form__text-inner"></i>
                </span>
              </div>
              <input id="name" type="text" class="form-control form__input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"placeholder="Nombre" autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="js-form-message mb-3">
            <div class="js-focus-state input-group form">
              <div class="input-group-prepend form__prepend">
                <span class="input-group-text form__text">
                  <i class="fa fa-envelope form__text-inner"></i>
                </span>
              </div>
              <input type="email" class="form-control form__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email" autocomplete="email">
              @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
	<div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>
                </div>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Contraseña" autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-key"></i>
                    </span>
                </div>
                <input type="password" class="form-control" name="password_confirmation"  placeholder="Confirmar Contraseña" autocomplete="new-password">
            </div>
        </div>
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary login-btn btn-block">Crear Cuenta</button>
        </div>
        <div class="text-center mb-3">
            <p class="text-muted">Tienes una cuenta? <a href="{{route('login')}}">Iniciar Sesión</a></p>
        </div>
	<div class="or-seperator"><i>O</i></div>
        <div class="row mx-gutters-2 mb-4">
            <div class="col-sm-6 mb-2 mb-sm-0">
              <a href="{{ route('social.oauth', 'facebook') }}" type="button" class="btn btn-block btn-sm btn-facebook">
                <i class="fa fa-facebook mr-2"></i>
                Con Facebook
              </a>
            </div>
            <div class="col-sm-6">
              <a href="{{ route('social.oauth', 'google') }}" type="button" class="btn btn-block btn-sm btn-google">
                <i class="fa fa-google mr-2"></i>
                Con Google
              </a>
            </div>
        </div>
        <p class="small text-center text-muted mb-0">© 2020 IntegratedTools, Inc. Todos los derechos reservados.</p>
    </form>
</div>
