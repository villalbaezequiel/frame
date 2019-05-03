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

        {!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'class' => 'form-horizontal', 'onKeyPress' => 'return disableEnterKey(event)']) !!}
          <div class="card-header text-center">
            <h3 class="card-title">
              Nuevo Proyecto
            </h3>
            <!-- <h5 class="card-description">Pequeña descripcion</h5> -->
          </div>
          <div class="wizard-navigation">
            <ul class="nav nav-pills">
              <li class="nav-item" style="width: 33.3333%;">
                <a class="nav-link active" href="#module_one" data-toggle="tab" role="tab">
                  Módulo 1
                </a>
              </li>
              <li class="nav-item" style="width: 33.3333%;">
                <a class="nav-link" href="#module_two" data-toggle="tab" role="tab">
                  Módulo 2
                </a>
              </li>
              <li class="nav-item" style="width: 33.3333%;">
                <a class="nav-link" href="#module_three" data-toggle="tab" role="tab">
                  Módulo 3
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

                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Cliente: (*)
                        </span>
                        <select class="selectpicker" data-style="select-with-transition" name="id_client" required>
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
                          Nombre: (*)
                        </span>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="125" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Descripción:
                        </span>
                        <input type="number" class="form-control" name="description" value="{{ old('description') }}" maxlength="125">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Tipo de Proyecto: (*)
                        </span>
                          <select class="selectpicker ajax_functions_frame_by_type_project" data-style="select-with-transition" name="id_proyect_category" required>
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
                <h5 class="info-text"> Fechas </h5>
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
                          <input type="text" class="form-control datepicker" value="{{ date('d/m/Y') }}" name="start_date" required>
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
                          <input type="text" class="form-control datepicker" name="finish_date" required>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Modalidad: (*)
                        </span>
                          <select class="selectpicker" data-style="select-with-transition" name="id_workday" required>
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
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Duración de Jornada Laborables (horas): (*)
                        </span>
                        <input type="number" class="form-control" name="duration_workdays" value="{{ old('duration_workdays') }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Cantidad de Jornadas Laborables:
                        </span>
                          <input type="number" class="form-control" name="count_workdays" value="{{ old('count_workdays') }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Dias: (*)
                        </span>
                        <input type="number" class="form-control" name="days" value="{{ old('days') }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" readonly required>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane" id="module_three">
                <h5 class="info-text"> Crew </h5>
                <div class="row justify-content-center empty-values-finish-add-crew">

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Función Frame:
                        </span>
                        <select class="selectpicker get_value_frame_functions ajax_categories_sat_by_function_frame ajax_crew_by_function_frame" data-style="select-with-transition" name="id_function_frame">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Categoría SAT:
                        </span>
                        <select class="selectpicker get_value_categories_sat event_toggle_category_sat" data-style="select-with-transition" name="id_category_sat">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Crew:
                        </span>
                        <select class="selectpicker get_value_crew" data-style="select-with-transition" name="id_provider">
                          <option value="">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Tipo de Contrato:
                        </span>
                          <select class="selectpicker" data-style="select-with-transition" name="id_contract">
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
                          Fecha de Alta Contrato:
                        </span>
                        <input class="form-control datepicker_crew" type="text" name="start_date_contract">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Fecha de Baja Contrato:
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
                          Modalidad:
                        </span>
                        <select class="selectpicker" data-style="select-with-transition" name="view_modality_work"></select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Cantidad de Jornadas Laborables:
                        </span>
                          <input type="number" class="form-control" name="count_workdays_crew" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Fecha de Alta AFIP:
                        </span>
                        <input class="form-control datepicker" type="text" name="start_afip">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
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
                          Sueldo Jornada: $
                        </span>
                          <input type="text" class="form-control validate-number-decimal-not-ps" name="salary_workdays" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Total: $
                        </span>
                          <input type="text" class="form-control" name="total_workdays" maxlength="125" placeholder="Click aquí para que actualizar los Sueldos" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Total Texto:
                        </span>
                        <input type="text" class="form-control" name="total_workdays_text" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Contrato Mensual: $
                        </span>
                          <input type="text" class="form-control" name="salary_contract_category_function" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Diario SAT: $
                        </span>
                          <input type="text" class="form-control" name="salary_daily" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo A Liquidar Neto: $
                        </span>
                          <input type="text" class="form-control" name="salary_liquidate" maxlength="125" readonly>
                      </div>
                    </div>
                  </div> -->
                  <input type="hidden" name="salary_liquidate" maxlength="125" readonly>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Diferencia: $
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
                          Reemplazo del Crew:
                        </span>
                        <select class="selectpicker" data-style="select-with-transition" name="id_crew_reemplazo" disabled>
                          <option value="0">Seleccionar</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 text-center" style="padding: 20px;">
                    <button id="add_crew" type="button" class="btn btn-primary">Agregar Crew</button>
                  </div>
                </div>

                <h5 class="info-text"> Lista de Crew  </h5>
                <div class="row justify-content-center">

                  <div class="col-md-12">
                    <table class="table" style="margin: 0 auto;">
                      <thead>
                        <tr>
                          <th>Crew</th>
                          <th>Función Frame/Categoría SAT</th>
                          <th>Fechas</th>
                          <th>Puesto</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody class="list_crew_view">
                      </tbody>
                    </table>
                  </div>

                  <!-- append list crew  -->
                  <div class="list_crew"> </div>

                </div>
              </div>

            </div>
          </div>
          <div class="card-footer">
            <div class="mr-auto">
              <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Anterior">
            </div>
            <div class="ml-auto">
              <input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next" value="Siguiente">
              <input type="submit" class="btn btn-finish btn-fill btn-primary btn-wd" name="finish" value="Guardar" style="display: none;" />
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
