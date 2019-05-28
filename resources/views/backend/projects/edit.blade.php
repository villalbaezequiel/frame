@extends('layouts.admin')

@section('title', "Proyectos / Editar")

@section('content')
<div class="container-fluid">
  <div class="col-md-12 col-12 mr-auto ml-auto">

    <a href='{{ url("/export/project/$project->id") }}' class="btn btn-primary none-alert" target="_blank">Descargar Proyecto</a>

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

        {!! Form::open(['route' => ['projects.update', $project->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'onKeyPress' => 'return disableEnterKey(event)', 'id' => 'logic_project']) !!}
          <div class="card-header text-center">
            <h3 class="card-title">
              Editar Proyecto
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
                        <div class="card-icon">
                          <i class="material-icons">library_books</i>
                        </div>
                        <h4 class="card-title">Fecha de Inicio</h4>
                      </div>
                      <div class="card-body ">
                        <div class="form-group is-filled">
                          <?php $start_date = explode('-', \App\Helpers::getDate($project->start_date)); ?>
                          <input type="text" class="form-control datepicker" value="{{ $start_date[2].'/'.$start_date[1].'/'.$start_date[0] }}" name="start_date" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="card ">
                      <div class="card-header card-header-rose card-header-text">
                        <div class="card-icon">
                          <i class="material-icons">library_books</i>
                        </div>
                        <h4 class="card-title">Fecha de Finalización</h4>
                      </div>
                      <div class="card-body ">
                        <div class="form-group is-filled">
                          <?php $finish_date = explode('-', \App\Helpers::getDate($project->finish_date)); ?>
                          <input type="text" class="form-control datepicker" value="{{ $finish_date[2].'/'.$finish_date[1].'/'.$finish_date[0] }}" name="finish_date" required>
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
                        <input type="text" class="form-control" name="cost_center" value="{{ $project->cost_center }}">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Nombre: (*)
                        </span>
                        <input type="text" class="form-control" name="name" value="{{ $project->name }}" maxlength="125" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Cliente: (*)
                        </span>
                        <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="id_client" required>
                          <option value="">Seleccionar</option>
                          @foreach(\App\Client::getAllClients() as $client)
                          <option value="{{ $client->id }}" <?php if($project->id_client == $client->id){ echo "selected"; } ?>><?php if($client->nick){ echo $client->nick; } else { echo $client->razon_social; } ?></option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Descripción:
                        </span>
                        <input type="number" class="form-control" name="description" value="{{ $project->description }}" maxlength="125">
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
                          <option value="{{ $provider->id }}" <?php if($provider->id == $project->id_team_referring){ echo "selected"; } ?>>{{ $provider->last_name.' '.$provider->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Tipo de Proyecto: (*)
                        </span>
                          <select class="selectpicker ajax_functions_frame_by_type_project" data-live-search="true" data-style="select-with-transition" name="id_proyect_category" required>
                          <option value="">Seleccionar</option>
                          @foreach(\App\ProyectCategory::getAllProyectCategories() as $type_project)
                          <option value="{{ $type_project->id }}" <?php if($project->id_proyect_category == $type_project->id){ echo "selected"; } ?>>{{ $type_project->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane" id="module_two">

              @if(!$project->active)
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
                          @foreach(\App\FrameFunction::getAllFrameFunctionByTypeProject($project->id_proyect_category) as $f_frame)
                          <option value="{{ $f_frame->id }}">{{ $f_frame->name }}</option>
                          @endforeach
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
                          <input type="number" class="form-control" name="count_workdays_crew" maxlength="125">
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
                        <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_crew_reemplazo">
                          <option value="0">Seleccionar</option>
                          @foreach($list_crew as $item_crew)
                            @if($item_crew->is_reemplazo == "1")
                            <option value="{{ $item_crew->id_provider }}">{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 text-center" style="padding: 20px;">
                    <button id="add_crew" type="button" class="btn btn-primary">Agregar Team</button>
                  </div>
                </div>
              @endif

                <h5 class="info-text"> Lista de Team  </h5>
                <div class="row justify-content-center list_crew_view" style="margin-top: -22px;">
                  @foreach($list_crew as $item_crew)
                    <div class="col-md-4 d-flex" id="item_view_{{ $item_crew->id_provider }}">
                      <div class="card mb-3">
                        <div class="card-header card-section-color">
                          {{ \App\FrameFunction::getName($item_crew->id_function_frame) }}
                        </div>
                        <div class="card-body">
                          <h4 class="card-title">{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}</h4>
                          <p class="card-text mb-2">{{ \App\WorkersCategory::getName($item_crew->id_category_sat) }}</p>
                          <p class="card-text mb-2">Fechas: {{ \App\Helpers::getDateParseFormat($item_crew->start_date_contract, '/') }} a {{ \App\Helpers::getDateParseFormat($item_crew->finish_date_contract, '/') }}</p>
                          <p class="card-text mb-2">Contrato: {{ \App\Contract::getName($item_crew->id_contract) }}</p>
                          <p class="card-text mb-2">Estado: {{ \App\ProjectProvider::getActive($item_crew->active) }}</p>
                          <p class="card-text mb-2">Puesto: {{ \App\ProjectProvider::getPuesto($item_crew->id) }}</p>
                        </div>
                        <div class="card-footer pt-0">
                          <a href="{{ url('/export/crew_contract/'.$item_crew->id) }}" target="_blank" class="btn btn-link btn-warning btn-just-icon edit" title="Descargar Contrato"><i class="material-icons">assignment</i></a>
                          <a href="{{ url('/export/release/'.$item_crew->id) }}" target="_blank" class="btn btn-link btn-warning btn-just-icon edit" title="Descargar Release"><i class="material-icons">assignment</i></a>
                          <a data-url="{{ url('/project_providers/'.$item_crew->id) }}" class="btn btn-link btn-warning btn-just-icon edit openWindowUrl" data-width="900" title="Calendario - Horas Extras"><i class="material-icons">calendar_today</i></a>
                          @if(!$project->active)
                            <a href="{{ url('/project_providers/'.$item_crew->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit" title="Ver / Editar" target="_blank"><i class="material-icons">dvr</i></a>
                          @endif
                          <button type="button" class="btn btn-link btn-danger btn-just-icon remove alert-confirm-delete-button" title="Eliminar" data-id="{{ $item_crew->id }}" data-idprovider="{{ $item_crew->id_provider }}"><i class="material-icons">close</i></button>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>

                <!-- append list crew  -->
                <div class="list_crew"> </div>

              @if(!$project->active)
                <h5 class="info-text"> Generacion de Seguros - Contratos tipos Servicios </h5>
                <div class="row justify-content-center">

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Cláusula de No Repetición
                        </span>
                        <select class="selectpicker" data-style="select-with-transition" name="clausula_no_repe">
                          <option value="0" <?php if($project->clausula_no_repe == "0"){ echo "selected"; } ?>>No</option>
                          <option value="1" <?php if($project->clausula_no_repe == "1"){ echo "selected"; } ?>>Si</option>
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
                          <option value="0" <?php if($project->certificado_cobertura == "0"){ echo "selected"; } ?>>No</option>
                          <option value="1" <?php if($project->certificado_cobertura == "1"){ echo "selected"; } ?>>Si</option>
                        </select>
                      </div>
                    </div>
                  </div>

                </div>
              @endif

              </div>

            </div>
          </div>
          <div class="card-footer">
            <div class="mr-auto">
              <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Anterior">
            </div>
            <div class="ml-auto">

              <textarea name="observations" class="hidden">{{ $project->observations }}</textarea>

              <input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next" value="Siguiente">
              <input type="submit" class="btn btn-finish btn-fill btn-primary btn-wd show-content-observation" name="finish" value="Guardar" style="display: none;" />
            </div>
            <div class="clearfix"></div>
          </div>
        {!! Form::close() !!}

        <!-- List Form delete to Team -->
        @foreach($list_crew as $item_crew)
          {!! Form::open(['route' => ['project_providers.destroy', $item_crew->id], 'method' => 'DELETE', 'id' => $item_crew->id, 'class'=> 'alert-confirm-delete']) !!}
          {!! Form::close() !!}
        @endforeach

      </div>
    </div>

  </div>
</div>
@endsection
@section('javascript')
  <script src="{{ asset('/js/project.js') }}"> </script>
@endsection
