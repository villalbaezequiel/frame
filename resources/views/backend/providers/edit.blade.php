@extends('layouts.admin')

@section('title', "Proveedores / Editar")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => ['providers.update' , $provider->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Editar Proveedor</h4>
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
                  <input class="form-control" type="text" name="name" value="{{ $user->name }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Apellido *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Email *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="email" email="true" name="email" value="{{ $user->email }}" maxlength="125" required>
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
                    <option value="{{ $key }}" <?php if($user->gender == $key){ echo "selected='selected'"; } ?> >{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Fecha de Nacimiento</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="date" name="birthdate" value="{{ $provider->birthdate }}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Tipo de Documentación *</label>
              <div class="col-sm-2">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="type_dni" required>
                    @foreach(\App\Helpers::getTypesDocumentationPerson() as $key => $val)
                    <option value="{{ $key }}" <?php if($user->type_dni == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="dni" value="{{ $user->dni }}" placeholder="Número *" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">CUIT *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="cuit" pattern="\b(20|23|24|27|30|33|34)(\D)?[0-9]{8}(\D)?[0-9]" value="{{ $user->cuit }}" maxlength="125" required>
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
                  <input class="form-control" type="text" name="address" value="{{ $provider->address }}" required>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="address_number" value="{{ $provider->address_number }}" placeholder="Número Dirección *" required>
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
                    <option value="{{ $country->id }}" <?php if($user->id_country == $country->id){ echo "selected='selected'"; } ?>>{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="location" value="{{ $provider->location }}" placeholder="Localidad *" required>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="number" name="cp" value="{{ $provider->cp }}" placeholder="Codigo Postal *" required>
                </div>
              </div>
            </div>


            <div class="row">
              <label class="col-sm-2 col-form-label">Nacionalidad *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="nationality" value="{{ $provider->nationality }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Nivel de Estudio *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_study" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Study::getAllStudy('active') as $study)
                    <option value="{{ $study->id }}" <?php if($provider->id_study == $study->id){ echo "selected='selected'"; } ?>>{{ $study->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Obra Social</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="text" name="social_work" value="{{ $provider->social_work }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Teléfono *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="number" name="telephone" value="{{ $provider->telephone }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Otro Teléfono</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <input class="form-control" type="number" name="other_telephone" value="{{ $provider->other_telephone }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Categoría *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_workers_category" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\WorkersCategory::getAllWorkersCategory('active') as $category)
                    <option value="{{ $category->id }}" <?php if($provider->id_workers_category == $category->id){ echo "selected='selected'"; } ?>>{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Función Frame *</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_function_frame" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\FrameFunction::getAllFrameFunction('active') as $frame)
                    <option value="{{ $frame->id }}" <?php if($provider->id_function_frame == $frame->id){ echo "selected='selected'"; } ?>>{{ $frame->name }}</option>
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
                    @foreach(\App\SatFunction::getAllSatFunction('active') as $sat)
                    <option value="{{ $sat->id }}" <?php if($provider->id_function_sat == $sat->id){ echo "selected='selected'"; } ?>>{{ $sat->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox">Proveedor Activo</label>
              <div class="col-sm-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="active" <?php if($user->active == 1){ echo "checked"; } ?>> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="active" <?php if($user->active == 0){ echo "checked"; } ?>> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <!-- Hide Val-->
            <input type="hidden" name="id_user" value="{{ $user->id }}" />
            <input type="submit" class="btn btn-primary" value="Editar" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
