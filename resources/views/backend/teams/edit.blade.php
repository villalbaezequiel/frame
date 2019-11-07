@extends('layouts.admin')

@section('title', "Team / Editar")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => ['providers.update' , $provider->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Editar Team</h4>
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
                  <input class="form-control" type="text" name="name" value="{{ $user->name }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Apellido <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Email <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="email" email="true" name="email" value="{{ $user->email }}" maxlength="125" required>
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
                    <option value="{{ $key }}" <?php if($user->gender == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
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
                    <option value="{{ $key }}" <?php if($user->type_dni == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="dni" value="{{ $user->dni }}" placeholder="Número *" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">CUIT <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <!-- <input class="form-control" type="text" name="cuit" pattern="\b(20|23|24|27|30|33|34)(\D)?[0-9]{8}(\D)?[0-9]" value="{{ $user->cuit }}" maxlength="125" required> -->
                  <input class="form-control input-type-number" type="text" name="cuit" value="{{ $user->cuit }}" maxlength="125" required>
                </div>
              </div>
              <label class="col-md-3 label-on-right">
                <code>inserte únicamente números.</code>
              </label>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Fecha de Nacimiento <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  @if($user->birthdate)
                    <?php $birthdate = explode('-', \App\Helpers::getDate($user->birthdate)); ?>
                    <input class="form-control datepicker" style="background-color: white!important;" pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$" type="text" name="birthdate" value="{{ $birthdate[2].'/'.$birthdate[1].'/'.$birthdate[0] }}" minlength="10" maxlength="10" required readonly>
                  @else
                    <input class="form-control datepicker" style="background-color: white!important;" pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$" type="text" name="birthdate" value="{{ \App\Helpers::getDate($user->birthdate) }}" minlength="10" maxlength="10" required readonly>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Estado Civil <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="civil_status" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getCivilStatus() as $key => $val)
                    <option value="{{ $key }}" <?php if($user->civil_status == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Dirección <span class="required-red">*</span></label>
              <div class="col-md-3">
                <div class="form-group">
                  <input class="form-control" type="text" name="address" value="{{ $provider->address }}" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="address_number" value="{{ $provider->address_number }}" placeholder="Número Dirección *" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input class="form-control" type="text" name="piso_depto" value="{{ $provider->piso_depto }}" placeholder="Piso/Depto">
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
                    <option value="{{ $country->id }}" <?php if($user->id_country == $country->id){ echo "selected='selected'"; } ?>>{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input class="form-control" type="text" name="location" value="{{ $provider->location }}" placeholder="Localidad *" required>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="cp" value="{{ $provider->cp }}" placeholder="Codigo Postal *" required>
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
                    <option value="{{ $country->id }}" <?php if($provider->nationality == $country->id){ echo "selected='selected'"; } ?>>{{ $country->male.' / '.$country->female }}</option>
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
                    <option value="{{ $study->id }}" <?php if($provider->id_study == $study->id){ echo "selected='selected'"; } ?>>{{ $study->name }}</option>
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
                      <option value="0" <?php if($provider->social_work == '0'){ echo "selected"; } ?> >No</option>
                      <option value="1" <?php if($provider->social_work == '1'){ echo "selected"; } ?>>Si</option>
                    </select>
                </div>
              </div>
              <div id="social_work_name_content" class="col-md-3 <?php if($provider->social_work == '0') { echo "hidden";} ?>">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="social_work_name">
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getListOs() as $key => $os)
                      <option value="{{ $key }}" <?php if($key == $provider->social_work_name){ echo "selected"; } ?>>{{ $os }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div id="social_work_code_content" class="col-md-2 <?php if($provider->social_work == '0') { echo "hidden";} ?>">
                <div class="form-group">
                  <input class="form-control" type="text" name="social_work_code" value="{{ $provider->social_work_code }}">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Teléfono <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="telephone" value="{{ $provider->telephone }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Otro Teléfono</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="other_telephone" value="{{ $provider->other_telephone }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Rol a desempeñar <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" data-live-search="true" name="id_function_frame[]" multiple required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\FrameFunction::getAllFrameFunction('1') as $frame)
                    <option value="{{ $frame->id }}"
                       <?php foreach(json_decode($provider->id_function_frame) as $key => $val) {
                          if($val == $frame->id){ echo "selected"; }
                        }?>>
                       {{ $frame->name }}
                     </option>
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
                    <input class="form-check-input" type="radio" value="1" name="visa" <?php if($provider->visa == 1){ echo "checked"; } ?>> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="visa" <?php if($provider->visa == 0){ echo "checked"; } ?>> No
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
                    <input class="form-check-input" type="radio" value="1" name="referring" <?php if($provider->referring == 1){ echo "checked"; } ?>> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="referring" <?php if($provider->referring == 0){ echo "checked"; } ?>> No
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
                    <option value="{{ $k }}" <?php if($k == $provider->bank) { echo "selected"; } ?>>{{ $v }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">CBU <span class="required-red">*</span></label>
              <div class="col-md-7">
                  <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="cbu" value="{{ $provider->cbu }}" minlength="22" maxlength="22" required>
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
                    <input class="form-control" type="text" name="type_account" value="{{ $provider->type_account }}" required>
                  </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">N* de Cuenta <span class="required-red">*</span></label>
              <div class="col-md-7">
                  <div class="form-group">
                  <input class="form-control input-type-number" type="text" name="number_account" value="{{ $provider->number_account }}" required>
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
                    <input class="form-control" type="text" name="alias_account" value="{{ $provider->alias_account }}">
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

            <div class="row" style="padding: 15px;">
              <label class="col-md-12 col-form-label">
                <center><strong>Valoraciones</strong></center>
              </label>
            </div>
            <div class="row">
              <div class="col-md-10 ml-auto mr-auto table-responsive-md">
                <table class="table col-md-10" style="margin: 0 auto;">
                  <thead>
                    <tr>
                      <th><strong>Proyecto</strong></th>
                      <th><strong>Descripción</strong></th>
                      <th><strong>Puntaje</strong></th>
                      <th><strong>Promedio</strong></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $countValorations = 0;
                      $countPorcentajes = 0;
                      $countAssessments = 0;
                    ?>
                    @foreach($provider_assessments as $assessment)
                      <tr>
                        <td>{{ \App\Project::getName($assessment->id_project) }}</td>
                        <td>{{ $assessment->description }}</td>
                        <td>{{ $assessment->value }}</td>
                        <td>{{ \App\ProviderAssessment::getAssessmentPorcentaje($assessment->value).'%' }}</td>
                      </tr>
                      <?php
                        $countValorations += $assessment->value;
                        $countPorcentajes += \App\ProviderAssessment::getAssessmentPorcentaje($assessment->value);
                        $countAssessments++;
                      ?>
                    @endforeach
                      <tr>
                        <td style="color: #9c27b0;"><strong>TOTAL</strong></td>
                        <td></td>
                        <td style="color: #9c27b0;"><strong>{{ $countValorations }}</strong></td>
                        <td style="color: #9c27b0;"><strong>{{ \App\ProviderAssessment::getAssessmentPorcentaje($countPorcentajes, ($countAssessments * 100) ).'%' }}</strong></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <!-- Hide Val-->
            <input type="hidden" name="id_user" value="{{ $user->id }}" />
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
