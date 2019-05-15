@extends('layouts.auth')
@section('title', 'Team')

@section('container')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 ml-auto mr-auto">
      {!! Form::open(['route' => ['project_providers.update' , $crew->id], 'method' => 'PUT', 'class' => 'form-inline']) !!}

        <div class="col-md-5 ml-auto mr-auto">
          <img src="{{ asset('img/logo.svg') }}" />
        </div>

        <div class="card">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title">Información de Team!</h4>
          </div>
          <div class="card-body">

            <div class="form-group">
              <div class="input-group col-md-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Team:
                  </span>
                </div>
                <a href='{{ url("/providers/".$crew->id_provider."/edit") }}' class="btn" target="_blank">{{ \App\Provider::getNameOrderLastName($crew->id_provider) }}</a>
              </div>

              <div class="input-group col-md-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Proyecto:
                  </span>
                </div>
                <a href='{{ url("/projects/".$crew->id_project."/edit") }}' class="btn" target="_blank">{{ \App\Project::getName($crew->id_project) }}</a>
              </div>

              <div class="input-group col-md-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Estado de Solicitud:
                  </span>
                </div>
                <select class="custom-select" name="status">
                  <option value="0" <?php if(\App\ProjectProvider::getActive($crew->active) == 0){ echo "selected"; } ?>>Pendiente</option>
                  <option value="1" <?php if(\App\ProjectProvider::getActive($crew->active) == 1){ echo "selected"; } ?>>Aceptado</option>
                  <option value="2" <?php if(\App\ProjectProvider::getActive($crew->active) == 2){ echo "selected"; } ?>>Rechazado</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Función Frame:
                  </span>
                </div>
                <input type="text" class="form-control" value="{{ \App\FrameFunction::getName($crew->id_function_frame) }}" disabled>
              </div>

              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Categoría SAT:
                  </span>
                </div>
                <input type="text" class="form-control" value="{{ \App\WorkersCategory::getName($crew->id_category_sat) }}" disabled>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Tipo de Contrato:
                  </span>
                </div>
                <input type="text" class="form-control" value="{{ \App\Contract::getName($crew->id_contract) }}" disabled>
              </div>

              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Cantidad de Jornadas Laborables:
                  </span>
                </div>
                <input type="number" class="form-control" value="{{ $crew->count_workdays_crew }}" name="count_workdays_crew">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Fecha de Alta Contrato:
                  </span>
                </div>
                <input type="text" class="form-control datepicker_crew" value="{{ \App\Helpers::getDateParseFormat($crew->start_date_contract, '/') }}" name="start_date_contract">
              </div>

              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Fecha de Baja Contrato:
                  </span>
                </div>
                <input type="text" class="form-control datepicker_crew" value="{{ \App\Helpers::getDateParseFormat($crew->finish_date_contract, '/') }}" name="finish_date_contract">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Fecha de Alta AFIP:
                  </span>
                </div>
                <input type="text" class="form-control datepicker" value="{{ \App\Helpers::getDateParseFormat($crew->start_afip, '/') }}" name="start_afip">
              </div>

              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Fecha de Baja AFIP:
                  </span>
                </div>
                <input type="text" class="form-control datepicker" value="{{ \App\Helpers::getDateParseFormat($crew->finish_afip, '/') }}" name="finish_afip">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Sueldo Jornada: $
                  </span>
                </div>
                <input type="text" class="form-control validate-number-decimal-not-ps" value="{{ $crew->salary_workdays }}" name="salary_workdays">
              </div>

              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Sueldo Total: $
                  </span>
                </div>
                <input type="text" class="form-control validate-number-decimal-not-ps" value="{{ $crew->total_workdays }}" name="total_workdays">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Sueldo Contrato Mensual: $
                  </span>
                </div>
                <input type="text" class="form-control validate-number-decimal-not-ps" value="{{ $crew->salary_contract_category_function }}">
              </div>

              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Sueldo Diario SAT: $
                  </span>
                </div>
                <input type="text" class="form-control validate-number-decimal-not-ps" value="{{ $crew->salary_daily }}">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Sueldo Diferencia: $
                  </span>
                </div>
                <input type="text" class="form-control validate-number-decimal-not-ps" value="{{ $crew->salaty_difference }}">
              </div>

              <div class="input-group col-md-6">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    Modalidad:
                  </span>
                </div>
                <input type="text" class="form-control" value="{{ \App\Project::getModalidad($crew->id_project) }}" disabled>
              </div>
            </div>

          </div>
          <div class="card-footer">
            <div class="col-md-12">
              <center>
                <input class="btn btn-primary btn-link btn-lg" value="Guardar" />
              </center>
            </div>
          </div>
        </div>
      {!! Form::close() !!}
  </div>
</div>
<style media="screen">
  .off-canvas-sidebar .wrapper-full-page .page-header {
    padding: 0px!important;
  }
</style>
@endsection
