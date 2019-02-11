@extends('layouts.admin')

@section('title', "Usuarios / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Nuevo Usuario</h4>
            </div>
          </div>
          <div class="card-body ">

            @if (session('message'))
              <div class="toolbar">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  {{ session('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            @endif

            <div class="row">
              <label class="col-md-2 col-form-label">Nombre *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Apellido *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Email *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="email" name="email" value="{{ old('email') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Tipo de Documentación *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="type_dni" required>
                    @foreach(\App\Helpers::getTypesDocumentationPerson() as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">DNI *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="number" name="dni" value="{{ old('dni') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">CUIT *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="cuit" pattern="\b(20|23|24|27|30|33|34)(\D)?[0-9]{8}(\D)?[0-9]" value="{{ old('cuit') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Género *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="gender" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getGendersPerson() as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Estado Civil *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="civil_status" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getCivilStatus() as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Fecha de Nacimiento *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control datepicker" type="text" name="birthdate" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">País *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_country" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Country::all() as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Rol Usuario *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="role_user" required>
                    <option value="">Seleccionar</option>
                    @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Activo</label>
              <div class="col-md-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="active" checked> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="active"> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <input type="submit" class="btn btn-primary" value="Editar" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
