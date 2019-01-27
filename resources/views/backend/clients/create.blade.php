@extends('layouts.admin')

@section('title', "Clientes / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'clients.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Nuevo Cliente</h4>
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
              <label class="col-sm-2 col-form-label">Nombre *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Apellido *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Email *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="email" email="true" name="email" value="{{ old('email') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Nick</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="nick" value="{{ old('nick') }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Género</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
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
              <label class="col-sm-2 col-form-label">Tipo de Documentación *</label>
              <div class="col-sm-2">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="type_dni" required>
                    @foreach(\App\Helpers::getTypesDocumentationPerson() as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="dni" value="{{ old('dni') }}" placeholder="Número *" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">CUIT *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="cuit" pattern="\b(20|23|24|27|30|33|34)(\D)?[0-9]{8}(\D)?[0-9]" value="{{ old('cuit') }}" maxlength="125" required>
                </div>
              </div>
              <label class="col-sm-3 label-on-right">
                <code>CUIT: ##-12345678-X</code>
              </label>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Dirección *</label>
              <div class="col-sm-5">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="address" value="{{ old('address') }}" required>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="number" name="address_number" value="{{ old('address_number') }}" placeholder="Número Dirección *" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Pais *</label>
              <div class="col-sm-3">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="country" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Country::all() as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="location" value="{{ old('location') }}" placeholder="Localidad *" required>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="number" name="cp" value="{{ old('cp') }}" placeholder="Codigo Postal *" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Razón Social *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="razon_social" value="{{ old('razon_social') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Teléfono *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="number" name="telephone" value="{{ old('telephone') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Otro Teléfono</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="number" name="other_telephone" value="{{ old('other_telephone') }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox">Retienen Ganancias?</label>
              <div class="col-sm-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="retencion_ganancia"> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="retencion_ganancia" checked> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox">Retienen IIBB?</label>
              <div class="col-sm-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="iibb"> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="iibb" checked> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox">Retienen IVA?</label>
              <div class="col-sm-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="iva"> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="iva" checked> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ml-auto mr-auto">
            <input type="submit" class="btn btn-primary" value="Crear" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
