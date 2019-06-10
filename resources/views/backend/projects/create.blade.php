@extends('layouts.admin')

@section('title', "Proyectos / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="col-md-12 col-12 mr-auto ml-auto">

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

    <div class="wizard-container">
      <div class="card card-wizard active" data-color="purple" id="wizardProfile">

        {!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'class' => 'form-horizontal', 'onKeyPress' => 'return disableEnterKey(event)', 'id' => 'logic_project']) !!}
          <div class="card-header text-center">
            <h3 class="card-title">
              Nuevo Proyecto
            </h3>
            <!-- <h5 class="card-description">Pequeña descripcion</h5> -->
          </div>
          <div class="wizard-navigation">
            <ul class="nav nav-pills">
              <li class="nav-item" style="width: 50%;">
                <a class="nav-link active" href="#module_one" data-toggle="tab" role="tab">
                  Módulo 1
                </a>
              </li>
              <li class="nav-item" style="width: 50%;">
                <a class="nav-link" href="#module_two" data-toggle="tab" role="tab">
                  Módulo 2
                </a>
              </li>
            </ul>
            <div class="moving-tab" style="width: 189.109px; transform: translate3d(-8px, 0px, 0px); transition: transform 0s ease 0s;">
              Módulo 1
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <div class="tab-pane active" id="module_one">
                <h5 class="info-text"> Información General </h5>
                <div class="row justify-content-center">

                  <div class="col-md-5">
                    <div class="card ">
                      <div class="card-header card-header-rose card-header-text">
                        <div class="card-icon card-icon-project">
                          <i class="material-icons">library_books</i>
                        </div>
                        <h4 class="card-title">Fecha de Inicio</h4>
                      </div>
                      <div class="card-body ">
                        <div class="form-group is-filled">
                          <input type="text" class="form-control datepicker" value="{{ date('d/m/Y') }}" name="start_date" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="card ">
                      <div class="card-header card-header-rose card-header-text">
                        <div class="card-icon card-icon-project">
                          <i class="material-icons">library_books</i>
                        </div>
                        <h4 class="card-title">Fecha de Finalización</h4>
                      </div>
                      <div class="card-body ">
                        <div class="form-group is-filled">
                          <input type="text" class="form-control datepicker" name="finish_date" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Centro de Costo
                        </span>
                        <input type="text" class="form-control" name="cost_center" value="{{ old('cost_center') }}">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Nombre<span class="required-red">*</span>
                        </span>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="125" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Cliente<span class="required-red">*</span>
                        </span>
                        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_client" required>
                          <option value="">Seleccionar</option>
                          @foreach(\App\Client::getAllClients() as $client)
                          <option value="{{ $client->id }}"><?php if($client->nick){ echo $client->nick; } else { echo $client->razon_social; } ?></option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Descripción
                        </span>
                        <input type="text" class="form-control" name="description" value="{{ old('description') }}" maxlength="125">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Referente:
                        </span>
                        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_team_referring">
                          <option value="">Seleccionar</option>
                          @foreach(\App\Provider::getAllProvidersReferring() as $provider)
                          <option value="{{ $provider->id }}">{{ $provider->last_name.' '.$provider->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Tipo de Proyecto<span class="required-red">*</span>
                        </span>
                        <select class="selectpicker ajax_functions_frame_by_type_project" data-live-search="true" data-style="select-with-transition" name="id_proyect_category" required>
                          <option value="">Seleccionar</option>
                          @foreach(\App\ProyectCategory::getAllProyectCategories() as $type_project)
                          <option value="{{ $type_project->id }}">{{ $type_project->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane" id="module_two">
                <h5 class="info-text"> Team </h5>
                <div class="row justify-content-center empty-values-finish-add-crew">

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Función Frame<span class="required-red">*</span>
                        </span>
                        <select class="selectpicker get_value_frame_functions ajax_categories_sat_by_function_frame ajax_crew_by_function_frame" data-live-search="true" data-style="select-with-transition" name="id_function_frame">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Categoría SAT<span class="required-red">*</span>
                        </span>
                        <select class="selectpicker get_value_categories_sat event_toggle_category_sat" data-live-search="true" data-style="select-with-transition" name="id_category_sat">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Team<span class="required-red">*</span>
                        </span>
                        <select class="selectpicker get_value_crew" data-live-search="true" data-style="select-with-transition" name="id_provider">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Tipo de Contrato<span class="required-red">*</span>
                        </span>
                          <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_contract" onchange="getContractProject(this.value)">
                          <option value="">Seleccionar</option>
                          @foreach(\App\Contract::getAllContracts('1') as $contract)
                          <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Fecha de Alta Contrato<span class="required-red">*</span>
                        </span>
                        <input class="form-control datepicker_crew" type="text" name="start_date_contract">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Fecha de Baja Contrato<span class="required-red">*</span>
                        </span>
                        <input class="form-control datepicker_crew" type="text" name="finish_date_contract">
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="days_crew" value="" />

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Modalidad<span class="required-red">*</span>
                        </span>
                        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_workday">
                          <option value="">Seleccionar</option>
                          @foreach(\App\Workday::getAllWorkdays() as $workday)
                          <option
                            <?php if($workday->day): ?>
                            data-day="{{ $workday->day }}"
                            <?php endif; ?>
                            value="{{ $workday->id }}">{{ $workday->name }}<?php if($workday->day && $workday->day != 1){ echo " (".$workday->day." dias)";} ?></option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Cant. Jornadas Laborables<span class="required-red">*</span>
                        </span>
                          <input type="number" class="form-control input-type-number" name="count_workdays_crew" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Hora de Inicio:
                        </span>
                        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="hour_initial">
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Hora Final:
                        </span>
                        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="hour_end">
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 field-afip">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Fecha de Alta AFIP:
                        </span>
                        <input class="form-control datepicker" type="text" name="start_afip">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 field-afip">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Fecha de Baja AFIP:
                        </span>
                        <input class="form-control datepicker" type="text" name="finish_afip">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Jornada<span class="required-red" style="margin-right: 4px;">*</span> $
                        </span>
                          <input type="text" class="form-control validate-number-decimal-not-ps" name="salary_workdays" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo en mano $
                        </span>
                          <input type="text" class="form-control" name="total_workdays" maxlength="125" placeholder="Click aquí para que actualizar los Sueldos" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo en mano Texto<span class="required-red">*</span>
                        </span>
                        <input type="text" class="form-control" name="total_workdays_text" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Contrato Mensual $
                        </span>
                          <input type="text" class="form-control" name="salary_contract_category_function" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Diario SAT $
                        </span>
                          <input type="text" class="form-control" name="salary_daily" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="salary_liquidate" maxlength="125" readonly>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Diferencia $
                        </span>
                        <input type="text" class="form-control" name="crew_sueldo_diferencia" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Es Reemplazo:
                        </span>
                        <select class="selectpicker" data-style="select-with-transition" name="is_reemplazo" disabled>
                          <option value="1" selected>No</option> <!-- 1 = Titular -->
                          <option value="2">Si</option> <!-- 1 = Suplente -->
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Reemplazo del Team:
                        </span>
                        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_crew_reemplazo" disabled>
                          <option value="0">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Estado de Invitacion al Proyecto:
                        </span>
                        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="active">
                          <option value="0">Pendiente</option>
                          <option value="1">Aceptado</option>
                          <option value="2">Rechazado</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">

                    </div>
                  </div>

                  <div class="col-md-12 text-center" style="padding: 20px;">
                    <button id="add_crew" type="button" class="btn btn-primary">Agregar Team</button>
                  </div>
                </div>

                <h5 class="info-text" id="ancla_list_crew_view"> Lista de Team </h5>
                <div class="row justify-content-center list_crew_view" style="margin-top: -22px;"></div>

                <!-- append list crew  -->
                <div class="list_crew"> </div>

                <h5 class="info-text"> Generacion de Seguros - Contratos tipos Servicios </h5>
                <div class="row justify-content-center">

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Cláusula de No Repetición
                        </span>
                        <select class="selectpicker" data-style="select-with-transition" name="clausula_no_repe">
                          <option value="0">No</option>
                          <option value="1">Si</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Necesidad de Certificado de Cobertura
                        </span>
                        <select class="selectpicker" data-style="select-with-transition" name="certificado_cobertura">
                          <option value="0">No</option>
                          <option value="1">Si</option>
                        </select>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
          <div class="card-footer">
            <div class="mr-auto">
              <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Anterior">
            </div>
            <div class="ml-auto">

              <textarea name="observations" class="hidden"></textarea>

              <input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next" value="Siguiente">
              <input type="submit" class="btn btn-finish btn-fill btn-primary btn-wd show-content-observation" name="finish" value="Guardar" style="display: none;" onclick="frameJs.setDisabled(this)" />
            </div>
            <div class="clearfix"></div>
          </div>
        {!! Form::close() !!}

      </div>
    </div>

  </div>
</div>
@endsection
@section('javascript')
  <script src="{{ asset('/js/project.js') }}"> </script>
@endsection
