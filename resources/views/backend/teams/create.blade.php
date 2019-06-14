@extends('layouts.admin')

@section('title', "Team / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'providers.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Nuevo Team</h4>
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
              <label class="col-md-2 col-form-label">Nombre <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Apellido <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Email <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="email" email="true" name="email" value="{{ old('email') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Género</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="gender" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getGendersPerson() as $key => $val)
                    <option value="{{ $key }}" <?php if(old('gender') == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Tipo de Documentación <span class="required-red">*</span></label>
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="type_dni" required>
                    @foreach(\App\Helpers::getTypesDocumentationPerson() as $key => $val)
                    <option value="{{ $key }}" <?php if(old('type_dni') == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <input class="form-control" type="text" name="dni" value="{{ old('dni') }}" placeholder="Número *" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">CUIT <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <!-- <input class="form-control" type="text" name="cuit" pattern="\b(20|23|24|27|30|33|34)(\D)?[0-9]{8}(\D)?[0-9]" value="{{ old('cuit') }}" maxlength="125" required> -->
                  <input class="form-control input-type-number" type="text" name="cuit" value="{{ old('cuit') }}" maxlength="125" required>
                </div>
              </div>
              <label class="col-md-3 label-on-right">
                <code>inserte únicamente números.</code>
              </label>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Fecha de Nacimiento</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control datepicker" type="text" name="birthdate" value="{{ old('birthdate') }}">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Estado Civil</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="civil_status" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getCivilStatus() as $key => $val)
                    <option value="{{ $key }}" <?php if(old('civil_status') == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Dirección <span class="required-red">*</span></label>
              <div class="col-md-3">
                <div class="form-group">
                  <input class="form-control" type="text" name="address" value="{{ old('address') }}" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="address_number" value="{{ old('address_number') }}" placeholder="Número Dirección *" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input class="form-control" type="text" name="piso_depto" value="{{ old('piso_depto') }}" placeholder="Piso/Depto">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Pais <span class="required-red">*</span></label>
              <div class="col-md-3">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="id_country" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Country::all() as $country)
                    <option value="{{ $country->id }}" <?php if(old('id_country') == $country->id){ echo "selected='selected'"; } ?>>{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input class="form-control" type="text" name="location" value="{{ old('location') }}" placeholder="Localidad *" required>
                </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="cp" value="{{ old('cp') }}" placeholder="Codigo Postal *" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Nacionalidad <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="nationality" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Country::all() as $country)
                    <option value="{{ $country->id }}" <?php if(old('nationality') == $country->id){ echo "selected='selected'"; } ?>>{{ $country->male.' / '.$country->female }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Nivel de Estudio <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="id_study" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Study::getAllStudy('1') as $study)
                    <option value="{{ $study->id }}" <?php if(old('id_study') == $study->id){ echo "selected='selected'"; } ?>>{{ $study->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Obra Social / Prepaga</label>
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="social_work" onchange="frameJs.getChangeOs(this.value)">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3 hidden" id="social_work_name_content">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="social_work_name">
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getListOs() as $key => $os)
                      <option value="{{ $key }}">{{ $os }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2 hidden" id="social_work_code_content">
                <div class="form-group">
                  <input class="form-control" type="text" name="social_work_code" value="{{ old('social_work_code') }}">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Teléfono <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="telephone" value="{{ old('telephone') }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Otro Teléfono</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="other_telephone" value="{{ old('other_telephone') }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Rol a desempeñar <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" data-live-search="true" name="id_function_frame[]" multiple required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\FrameFunction::getAllFrameFunction('1') as $frame)
                    <option value="{{ $frame->id }}">{{ $frame->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Tiene Visa o Otra Ciudadania?</label>
              <div class="col-md-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="visa"> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="visa" checked> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Referente</label>
              <div class="col-md-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="referring"> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="referring" checked> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
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

            <div class="row" style="padding: 15px;">
                <label class="col-md-12 col-form-label">
                    <center><strong>Datos Bancarios</strong></center>
                </label>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Banco <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="bank" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getListsBank() as $k => $v)
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">CBU <span class="required-red">*</span></label>
              <div class="col-md-7">
                  <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="cbu" value="{{ old('cbu') }}" minlength="22" maxlength="22" required>
                  </div>
              </div>
              <label class="col-md-3 label-on-right">
                  <code>inserte únicamente números.</code>
              </label>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Tipo de Cuenta <span class="required-red">*</span></label>
                <div class="col-md-7">
                  <div class="form-group">
                    <select class="form-control selectpicker" data-style="btn btn-link" name="type_account" required>
                      @foreach(\App\Provider::getTipoCuenta() as $val)
                      <option value="{{ $val }}">{{ $val }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">N* de Cuenta <span class="required-red">*</span></label>
              <div class="col-md-7">
                  <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="number_account" value="{{ old('number_account') }}" required>
                  </div>
              </div>
              <label class="col-md-3 label-on-right">
                  <code>inserte únicamente números.</code>
              </label>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Alias</label>
                <div class="col-md-7">
                  <div class="form-group">
                    <input class="form-control" type="text" name="alias_account" value="{{ old('alias_account') }}">
                  </div>
              </div>
            </div>

            <div class="row" style="padding: 15px;">
              <label class="col-md-12 col-form-label">
                <center><strong>Agregar Valoración</strong></center>
              </label>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Proyecto</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="valoration_id_project">
                    <option value="">Seleccionar</option>
                    @foreach(\App\Project::all() as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Descripción</label>
              <div class="col-md-7">
                <div class="form-group">
                  <textarea class="form-control" name="valoration_description" maxlength="125"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Puntaje</label>
              <div class="col-md-10 checkbox-radios">
                <div class="form-check form-check-inline valoration_content">
                  <input class="form-check-input valoration_star_input" id="radio5" type="radio" value="5" name="valoration_value">
                  <label class="form-check-label valoration_star" for="radio5">★</label>

                  <input class="form-check-input valoration_star_input" id="radio4" type="radio" value="4" name="valoration_value">
                  <label class="form-check-label valoration_star" for="radio4">★</label>

                  <input class="form-check-input valoration_star_input" id="radio3" type="radio" value="3" name="valoration_value">
                  <label class="form-check-label valoration_star" for="radio3">★</label>

                  <input class="form-check-input valoration_star_input" id="radio2" type="radio" value="2" name="valoration_value">
                  <label class="form-check-label valoration_star" for="radio2">★</label>

                  <input class="form-check-input valoration_star_input" id="radio1" type="radio" value="1" name="valoration_value">
                  <label class="form-check-label valoration_star" for="radio1">★</label>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <a href="javascript:void(0)" class="back-history btn">Cancelar</a>
            <input type="submit" class="btn btn-primary" value="Guardar" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
  $('a').click(function(e){

    if(!$(this).hasClass('none-alert')){
      var parentForm = $(this).parents('form');
      if(parentForm.length != 1 || $(this).hasClass('back-history')){
        e.preventDefault();
        alertLeaveForm(this);
      }
    }

  });
});
</script>
@endsection
