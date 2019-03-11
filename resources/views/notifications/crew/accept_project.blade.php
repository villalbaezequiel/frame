@extends('layouts.auth')
@section('title', 'Incorporacion en el Proyecto')

@section('container')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 ml-auto mr-auto">
    {!! Form::open(['route' => 'crew_acceptproject.post', 'method' => 'POST', 'class' => 'form-inline']) !!}
      @csrf

      <div class="col-md-6 ml-auto mr-auto">
        <img src="{{ asset('img/logo.svg') }}" />
      </div>

      <div class="card card-login">
        <div class="card-header card-header-primary text-center">
          <h4 class="card-title">Incorporación al Proyecto</h4>
        </div>
        <div class="card-body ">

          <p class="card-description text-center" style="color: #9c27b0!important;">
            @if (session('message'))
              <strong>{{ session('message') }}</strong>
            @endif
          </p>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Proyecto:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Project::getName($crew->id_project) }}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Crew:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Provider::getNameOrderLastName($crew->id_provider) }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Función Frame / Categoría SAT:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\FrameFunction::getName($crew->id_function_frame) }} / {{ \App\WorkersCategory::getName($crew->id_category_sat) }}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Tipo de Contrato:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Contract::getName($crew->id_contract) }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Fecha de Alta/Baja Contrato:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($crew->start_date_contract, '/') }} - {{ \App\Helpers::getDateParseFormat($crew->finish_date_contract, '/') }}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Fecha de Alta/Baja AFIP:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($crew->start_afip, '/') }} - {{ \App\Helpers::getDateParseFormat($crew->finish_afip, '/') }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Modalidad:
                </span>
              </div>
              <!-- <input type="text" class="form-control" value=" \App\Project::getModalidad($crew->id_project)" disabled> -->
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Cantidad de Jornadas Laborables:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $crew->count_workdays_crew}}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Sueldo Jornada:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $crew->salary_workdays}}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Sueldo Total:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $crew->total_workdays}}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Sueldo Contrato Mensual:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $crew->salary_contract_category_function}}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Sueldo Diario SAT:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $crew->salary_daily}}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Sueldo A Liquidar Neto:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $crew->salary_liquidate}}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Diferencia:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $crew->salaty_difference}}" disabled>
            </div>
          </div>

          <div class="form-group">
            @if($crew->active == 0)
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Aceptar:
                </span>
              </div>
                <div class="form-check form-check-inline" style="margin-top: 25px;">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="confirmation" checked> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline" style="margin-top: 25px;">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="confirmation"> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
            </div>
            @else
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Aceptar:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Helpers::getActive($crew->active) }}" disabled>
            </div>
            @endif
          </div>

        </div>

        @if($crew->active == 0)
        <div class="card-footer">
          <div class="col-md-12">
            <center>
              <button type="submit" class="btn btn-primary btn-link btn-lg">
                Guardar
              </button>
              <input type="hidden" name="id_project_provider" value="{{ $crew->id }}" />
            </center>
          </div>
        </div>
        @endif

      </div>
      {!! Form::close() !!}
  </div>
</div>
@endsection
