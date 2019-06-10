@extends('layouts.auth')
@section('title', 'Incorporacion en el Proyecto')

@section('container')
<div class="row">
  <div class="col-md-12 col-md-12 col-sm-12">
    {!! Form::open(['route' => 'team_acceptproject.post', 'method' => 'POST', 'class' => 'form-inline']) !!}
      @csrf

      <div class="col-md-5 ml-auto mr-auto">
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
            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Cliente:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Project::getCliente($crew->id_project) }}" disabled>
            </div>

            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Nombre del Proyecto:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Project::getName($crew->id_project) }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Referente:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Project::getReferring($crew->id_project) }}" disabled>
            </div>

            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Descripción:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Project::getDescription($crew->id_project) }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Nombre del Team:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Provider::getNameOrderLastName($crew->id_provider) }}" disabled>
            </div>

            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Rol a Desempeñar:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\WorkersCategory::getName($crew->id_category_sat, false) }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Fecha Estimada:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($crew->start_date_contract, '/') }} - {{ \App\Helpers::getDateParseFormat($crew->finish_date_contract, '/') }}" disabled>
            </div>

            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Monto a cobrar estimado:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $crew->salary_liquidate}}" disabled>
            </div>
          </div>

          <div class="form-group">
            @if($crew->active == 0)
            <div class="input-group col-md-6">
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
                    <input class="form-check-input" type="radio" value="2" name="confirmation"> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
            </div>
            @else
            <div class="input-group col-md-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Aceptar:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\ProjectProvider::getActive($crew->active) }}" disabled>
            </div>
            @endif
          </div>

        </div>

        @if($crew->active == 0)
        <div class="card-footer">
          <div class="col-md-12">
            <center>
              <button type="submit" class="btn btn-primary btn-link btn-md">
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
<style>
  @media screen and (max-width: 450px) {
    .input-group-text {
      padding-left: 0px !important;
    }
  }
</style>
