@extends('layouts.auth')
@section('title', 'Restablecer contraseña')

@section('container')
<div class="row">
  <div class="col-lg-5 col-md-6 col-sm-8 ml-auto mr-auto">
    <form class="form" method="POST" action="{{ route('password.update') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">
      <div class="col-md-12 p-4 ml-auto mr-auto">
        <img src="{{ asset('img/logo.svg') }}" />
      </div>

      <div class="card card-login">
        <div class="card-header card-header-primary text-center">
          <h4 class="card-title">Restablecer contraseña</h4>
        </div>
        <div class="card-body ">


          <p class="card-description text-center" style="color: #9c27b0!important;">
            @if ($errors->has('email'))
              <strong>{{ $errors->first('email') }}</strong>
            @endif
            @if ($errors->has('password'))
              <strong>{{ $errors->first('password') }}</strong>
            @endif
          </p>

          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend" style="width: auto!important;">
                <span class="input-group-text">
                  <i class="material-icons">email</i>
                </span>
              </div>
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend" style="width: auto!important;">
                <span class="input-group-text">
                  <i class="material-icons">lock_outline</i>
                </span>
              </div>
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend" style="width: auto!important;">
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
              Restablecer contraseña
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
