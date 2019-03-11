@extends('layouts.auth')
@section('title', 'Registráte')

@section('container')
<div class="row">
  <div class="col-lg-5 col-md-6 col-sm-8 ml-auto mr-auto">
    {!! Form::open(['route' => 'crew.store', 'method' => 'POST', 'class' => 'form']) !!}
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

            @if (session('message'))
              <strong>{{ session('message') }}</strong>
            @endif
          </p>

        <div style="max-height: 280px; overflow: scroll;">
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Nombre:
                </span>
              </div>
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Apellido:
                </span>
              </div>
              <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Email:
                </span>
              </div>
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Género:
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" name="gender" required>
                <option value="">Seleccionar</option>
                @foreach(\App\Helpers::getGendersPerson() as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
              </select>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Tipo de Documentación:
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" name="type_dni" required>
                @foreach(\App\Helpers::getTypesDocumentationPerson() as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
              </select>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Número DNI/LE/CI:
                </span>
              </div>
              <input class="form-control" type="text" name="dni" value="{{ old('dni') }}" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  CUIT:
                </span>
              </div>
              <input class="form-control" type="number" name="cuit" value="{{ old('cuit') }}" maxlength="125" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Fecha de Nacimiento:
                </span>
              </div>
              <input class="form-control datepicker" type="text" name="birthdate" value="{{ old('birthdate') }}">
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Estado Civil:
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" name="civil_status" required>
                <option value="">Seleccionar</option>
                @foreach(\App\Helpers::getCivilStatus() as $key => $val)
                <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
              </select>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Dirección:
                </span>
              </div>
              <input class="form-control" type="text" name="address" value="{{ old('address') }}" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Número Dirección:
                </span>
              </div>
              <input class="form-control" type="number" name="address_number" value="{{ old('address_number') }}" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Pais:
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" name="id_country" required>
                <option value="">Seleccionar</option>
                @foreach(\App\Country::all() as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
              </select>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Localidad:
                </span>
              </div>
              <input class="form-control" type="text" name="location" value="{{ old('location') }}" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  CP:
                </span>
              </div>
              <input class="form-control" type="number" name="cp" value="{{ old('cp') }}" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Nacionalidad:
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" name="nationality" required>
                <option value="">Seleccionar</option>
                @foreach(\App\Country::all() as $country)
                <option value="{{ $country->id }}">{{ $country->male.' / '.$country->female }}</option>
                @endforeach
              </select>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Nivel de Estudio:
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" name="id_study" required>
                <option value="">Seleccionar</option>
                @foreach(\App\Study::getAllStudy('1') as $study)
                <option value="{{ $study->id }}">{{ $study->name }}</option>
                @endforeach
              </select>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Obra Social:
                </span>
              </div>
              <input class="form-control" type="text" name="social_work" value="{{ old('social_work') }}" maxlength="125">
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Teléfono:
                </span>
              </div>
              <input class="form-control" type="number" name="telephone" value="{{ old('telephone') }}" maxlength="125" required>
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Otro Teléfono:
                </span>
              </div>
              <input class="form-control" type="number" name="other_telephone" value="{{ old('other_telephone') }}" maxlength="125">
            </div>
          </span>
          <span class="bmd-form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Función según Frame:
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" name="id_function_sat" required>
                <option value="">Seleccionar</option>
                @foreach(\App\FrameFunction::getAllFrameFunction('1') as $frame)
                <option value="{{ $frame->id }}">{{ $frame->name }}</option>
                @endforeach
              </select>
            </div>
          </span>
        </div>

          <!-- <span class="bmd-form-group">
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
          </span> -->
        </div>
        <div class="card-footer justify-content-center">
          <input type="hidden" name="crew_register_person" value="1" />
          <input type="submit" class="btn btn-primary btn-link btn-lg" value="Guardar" />
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection
