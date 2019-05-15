@extends('layouts.auth')
@section('title', 'Registráte')

@section('container')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 ml-auto mr-auto">
    {!! Form::open(['route' => 'crew.store', 'method' => 'POST', 'class' => 'form-inline']) !!}
      @csrf

      <div class="col-md-6 ml-auto mr-auto">
        <img src="{{ asset('img/logo.svg') }}" />
      </div>

      <div class="card">
        <div class="card-header card-header-primary text-center">
          <h4 class="card-title">¡Forma parte de nuestro staff!</h4>
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

            @if (session('message'))
              @if(session('message') != '1')
                <strong>{{ session('message') }}</strong>
              @endif
            @endif
          </p>

          @if (session('message'))

            @if(session('message') == '1')
            <center>
              <strong style="color: #9c27b0!important; font-size: 1.125rem!important;">Team creado con exito!</strong>
            </center>
            @else
              @include('auth.card.register')
            @endif

          @else
            @include('auth.card.register')
          @endif
        </div>


        @if (session('message'))

          @if(session('message') != '1')
          <div class="card-footer">
            <div class="col-md-12">
              <center>
                <input type="hidden" name="crew_register_person" value="1" />
                <input type="submit" class="btn btn-primary btn-link btn-lg" value="Guardar" />
              </center>
            </div>
          </div>
          @endif

        @else
        <div class="card-footer">
          <div class="col-md-12">
            <center>
              <input type="hidden" name="crew_register_person" value="1" />
              <input type="submit" class="btn btn-primary btn-link btn-lg" value="Guardar" />
            </center>
          </div>
        </div>
        @endif

      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
