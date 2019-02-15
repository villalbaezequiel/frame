@extends('layouts.auth')
@section('title', 'Registráte')

@section('container')
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
    {!! Form::open(['route' => 'providers.store', 'method' => 'POST', 'class' => 'form']) !!}
      @csrf

      <div class="col-md-12" style="padding: 15px;">
        <img src="{{ asset('img/logo.svg') }}" />
      </div>

      <div class="card card-login">
        <div class="card-header card-header-primary text-center">
          <h4 class="card-title">¡Forma parte <br/> de nuestro staff!</h4>
        </div>
        <div class="card-body ">


          <p class="card-description text-center" style="color: #9c27b0!important;">
            @if ($errors->has('name'))
              <strong>{{ $errors->first('name') }}</strong>
            @endif
            @if ($errors->has('email'))
              <strong>{{ $errors->first('email') }}</strong>
            @endif
            @if ($errors->has('password'))
              <strong>{{ $errors->first('password') }}</strong>
            @endif
          </p>

          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="material-icons">face</i>
                </span>
              </div>
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Nombre" required autofocus>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="material-icons">email</i>
                </span>
              </div>
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="material-icons">lock_outline</i>
                </span>
              </div>
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="material-icons">lock_outline</i>
                </span>
              </div>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
            </div>
          </span>
        </div>
        <div class="card-footer justify-content-center">
          <button type="submit" class="btn btn-primary btn-link btn-lg">
              Registráte
          </button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
