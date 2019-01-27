@extends('layouts.admin')

@section('title', "Proveedores / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'providers.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Nuevo Proveedor</h4>
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
              <label class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="date" name="birthdate" value="{{ old('birthdate') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Estado Civil</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
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
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_country" required>
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
              <label class="col-sm-2 col-form-label">Nacionalidad *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="nationality" value="{{ old('nationality') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Nivel de Estudio *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_study" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Study::getAllStudy('1') as $study)
                    <option value="{{ $study->id }}">{{ $study->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Obra Social</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="social_work" value="{{ old('social_work') }}" maxlength="125">
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
              <label class="col-sm-2 col-form-label">Función Frame *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_function_frame" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\FrameFunction::getAllFrameFunction('1') as $frame)
                    <option value="{{ $frame->id }}">{{ $frame->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Categoría del Trabajador *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_workers_category" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\WorkersCategory::getAllWorkersCategory('1') as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Función SAT *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_function_sat" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\SatFunction::getAllSatFunction('1') as $sat)
                    <option value="{{ $sat->id }}">{{ $sat->name }}</option>
                    @endforeach
                  </select>
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
