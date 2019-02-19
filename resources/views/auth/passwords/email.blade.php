@extends('layouts.auth')
@section('title', 'Restablecer la contraseña')

@section('container')
<div class="row">
  <div class="col-lg-5 col-md-6 col-sm-8 ml-auto mr-auto">
    <form class="form" method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="col-md-12" style="padding: 15px;">
        <img src="{{ asset('img/logo.svg') }}" />
      </div>

      <div class="card card-login">
        <div class="card-header card-header-primary text-center">
          <h4 class="card-title">Restablecer la contraseña</h4>
        </div>
        <div class="card-body ">


          <p class="card-description text-center" style="color: #9c27b0!important;">
            @if ($errors->has('email'))
              <strong>{{ $errors->first('email') }}</strong>
            @endif
          </p>

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

        </div>
        <div class="card-footer justify-content-center">
          <button type="submit" class="btn btn-primary btn-link btn-lg">
            Enviar enlace
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
