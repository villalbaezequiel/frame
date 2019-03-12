@extends('layouts.auth')
@section('title', 'Contrato')

@section('container')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 ml-auto mr-auto">

    <div class="form-inline">
      <div class="col-md-6 ml-auto mr-auto">
        <img src="{{ asset('img/logo.svg') }}" />
      </div>

      <?php
        $user = $data['user'];
        $project_provider = $data['project_provider'];
        $provider = $data['provider'];
      ?>

      <div class="card card-login">
        <div class="card-header card-header-primary text-center">
          <h4 class="card-title">Contrato</h4>
        </div>
        <div class="card-body ">

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Proyecto:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Project::getName($project_provider->id_project) }}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Tipo de Proyecto:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Project::getProyectCategory($project_provider->id_project) }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Función Frame / Categoría SAT:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\FrameFunction::getName($project_provider->id_function_frame) }} / {{ \App\WorkersCategory::getName($project_provider->id_category_sat) }}" disabled>
            </div>
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Modalidad:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Project::getModalidad($project_provider->id_project) }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Tipo de Contrato:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Contract::getName($project_provider->id_contract) }}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Cantidad de Jornadas Laborables:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $project_provider->count_workdays_crew }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Fecha de Alta/Baja Contrato:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($project_provider->start_date_contract, '/') }} - {{ \App\Helpers::getDateParseFormat($project_provider->finish_date_contract, '/') }}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Fecha de Alta/Baja AFIP:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($project_provider->start_afip, '/') }} - {{ \App\Helpers::getDateParseFormat($project_provider->finish_afip, '/') }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Sueldo Jornada:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $project_provider->salary_workdays}}" disabled>
            </div>

            <div class="input-group col-lg-6">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Sueldo A Liquidar Neto:
                </span>
              </div>
              <input type="text" class="form-control" value="${{ $project_provider->salary_liquidate}}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Crew Apellido-Nombre:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ \App\Provider::getNameOrderLastName($project_provider->id_provider) }}" disabled>
            </div>

            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Crew DNI:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $user->dni }}" disabled>
            </div>

            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Crew CUIT:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $user->cuit }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Crew Domicilio:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $provider->address }}" disabled>
            </div>

            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Número:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $provider->address_number }}" disabled>
            </div>

            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Piso/Depto:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $provider->piso_depto }}" disabled>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Crew Telefono:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $provider->telephone }}" disabled>
            </div>

            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Crew Otro Telefono:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $provider->other_telephone }}" disabled>
            </div>

            <div class="input-group col-lg-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  Crew Email:
                </span>
              </div>
              <input type="text" class="form-control" value="{{ $user->email }}" disabled>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
@endsection
