@extends('layouts.admin')

@section('title', "Proyectos / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="col-md-12 col-12 mr-auto ml-auto">

    <div class="wizard-container">
      <div class="card card-wizard active" data-color="purple" id="wizardProfile">

        {!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
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
                        <input type="text" class="form-control" name="description" value="{{ old('description') }}" maxlength="125">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Tipo de Proyecto: (*)
                        </span>
                          <select class="selectpicker" data-style="select-with-transition" name="id_proyect_category" required>
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
                          Cantidad de Jornadas: (*)
                        </span>
                          <input type="number" class="form-control" name="count_workdays" value="{{ old('count_workdays') }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Horas / Duración de Jornada: (*)
                        </span>
                        <input type="number" class="form-control" name="duration_workdays" value="{{ old('duration_workdays') }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" required>
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
                          <option value="{{ $workday->id }}">{{ $workday->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Dias: (*)
                        </span>
                        <input type="number" class="form-control" name="days" value="{{ old('days') }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" required>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane" id="module_three">
                <h5 class="info-text"> Proveedores </h5>
                <div class="row justify-content-center">


                  <!-- <div class="row">
                    <label class="col-md-2 col-form-label">Fecha de Alta AFIP</label>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input class="form-control datepicker" type="text" name="start_afip" value="{{ old('start_afip') }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <label class="col-md-2 col-form-label">Fecha de Baja AFIP</label>
                    <div class="col-md-7">
                      <div class="form-group">
                        <input class="form-control datepicker" type="text" name="finish_afip" value="{{ old('finish_afip') }}">
                      </div>
                    </div>
                  </div> -->

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
<script>
$(document).ready(function(){

  // input validate
  var rules = {
        id_client: {
          required: true
        },
        name: {
          required: true,
          maxlength: 125
        },
        description: {
          maxlength: 125
        },
        id_proyect_category: {
          required: true
        },
        start_date: {
          required: true
        },
        finish_date: {
          required: true
        },
        count_workdays: {
          required: true
        },
        duration_workdays: {
          required: true
        },
        id_workday: {
          required: true
        },
        days: {
          required: true
        }
  };
  // Initialise the wizard
  frameJs.initMaterialWizard(rules);

  setTimeout(function() {
    $('.card.card-wizard').addClass('active');
  }, 600);

  $('a').click(function(e){
    var parentForm = $(this).parents('form');
    if(parentForm.length != 1 || $(this).hasClass('back-history')){
      e.preventDefault();
      alertLeaveForm(this);
    }
  });

});
</script>
@endsection
