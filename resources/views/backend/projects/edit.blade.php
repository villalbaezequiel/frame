@extends('layouts.admin')

@section('title', "Proyectos / Editar")

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

        {!! Form::open(['route' => ['projects.update', $project->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
          <div class="card-header text-center">
            <h3 class="card-title">
              Editar Proyecto
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
                          Descripción:
                        </span>
                        <input type="text" class="form-control" name="description" value="{{ $project->description }}" maxlength="125">
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
                          <option value="{{ $type_project->id }}" <?php if($project->id_proyect_category == $type_project->id){ echo "selected"; } ?>>{{ $type_project->name }}</option>
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
                          Cantidad de Jornadas: (*)
                        </span>
                          <input type="number" class="form-control" name="count_workdays" value="{{ $project->count_workdays }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Horas / Duración de Jornada: (*)
                        </span>
                        <input type="number" class="form-control" name="duration_workdays" value="{{ $project->duration_workdays }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" required>
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
                          <option value="{{ $workday->id }}" <?php if($project->id_workday == $workday->id){ echo "selected"; } ?>>{{ $workday->name }}</option>
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
                        <input type="number" class="form-control" name="days" value="{{ $project->days }}" placeholder="Ingresar Números, Puntos (.) y/o Comas (,)" maxlength="125" required>
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
                          Categoría SAT:
                        </span>
                        <select class="selectpicker get_value_categories_sat" data-style="select-with-transition" name="id_category_sat">
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
                        <input class="form-control datepicker" type="text" name="start_date_contract">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Fecha de Baja Contrato:
                        </span>
                        <input class="form-control datepicker" type="text" name="finish_date_contract">
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
                          Sueldo Jornada:
                        </span>
                          <input type="number" class="form-control" name="salary_workdays" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Total:
                        </span>
                          <input type="number" class="form-control" name="total_workdays" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Contrato Mensual:
                        </span>
                          <input type="number" class="form-control" name="salary_contract_category_function" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Diario:
                        </span>
                          <input type="number" class="form-control" name="salary_daily" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo A Liquidar:
                        </span>
                          <input type="number" class="form-control" name="salary_liquidate" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Diferencia:
                        </span>
                        <input type="number" class="form-control" name="crew_sueldo_diferencia" maxlength="125">
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
                          <th></th>
                          <th>Crew</th>
                          <th>Función Frame/Categoría SAT</th>
                          <th>Fechas</th>
                          <th>Suplente</th>
                        </tr>
                      </thead>
                      <tbody class="list_crew_view">
                        @foreach($list_crew as $item_crew)
                        <tr id="item_view_{{ $item_crew->id_provider }}">
                          <td><button type='button' class='btn btn-link btn-danger btn-just-icon remove' onClick="$('#'+$(this).data('itemremove')).remove();$('#'+$(this).data('idcrew')).remove()" data-idcrew="{{ $item_crew->id_provider }}" data-itemremove="item_view_{{ $item_crew->id_provider }}" title='Eliminar'><i class='material-icons'>close</i></button></td>
                          <td>{{ \App\Provider::getName($item_crew->id_provider) }}</td>
                          <td>{{ \App\FrameFunction::getName($item_crew->id_function_frame).' / '.\App\WorkersCategory::getName($item_crew->id_category_sat) }}</td>
                          <?php
                            $start_date_contract = explode('-', \App\Helpers::getDate($item_crew->start_date_contract));
                            $finish_date_contract = explode('-', \App\Helpers::getDate($item_crew->finish_date_contract));
                          ?>
                          <td>{{ $start_date_contract[2].'/'.$start_date_contract[1].'/'.$start_date_contract[0].' - '.$finish_date_contract[2].'/'.$finish_date_contract[1].'/'.$finish_date_contract[0] }}</td>
                          <td></td>
                        </tr>
                        @endforeach
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

    if(!$(this).hasClass('none-alert')){
      var parentForm = $(this).parents('form');
      if(parentForm.length != 1 || $(this).hasClass('back-history')){
        e.preventDefault();
        alertLeaveForm(this);
      }
    }

  });

  $("#add_crew").click(function(){
    // list values
    var id_function_frame = $('select[name=id_function_frame]').val();
    var id_category_sat = $('select[name=id_category_sat]').val(); // agregar al schema ´project_providers´
    var id_provider = $('select[name=id_provider]').val();
    var id_contract = $('select[name=id_contract]').val();
    var salary_workdays = $('input[name=salary_workdays]').val();
    var total_workdays = $('input[name=total_workdays]').val();
    var salary_contract_category_function = $('input[name=salary_contract_category_function]').val();
    var salary_daily = $('input[name=salary_daily]').val();
    var salary_liquidate = $('input[name=salary_liquidate]').val();
    var salaty_difference = $('input[name=crew_sueldo_diferencia]').val();
    var start_date_contract = $('input[name=start_date_contract]').val();
    var finish_date_contract = $('input[name=finish_date_contract]').val();
    var start_afip = $('input[name=start_afip]').val(); // no required
    var finish_afip = $('input[name=finish_afip]').val(); // no required

    if(id_function_frame && id_category_sat && id_contract && id_provider &&
       salary_workdays && total_workdays && salary_contract_category_function &&
       salary_daily && salary_liquidate && start_date_contract && finish_date_contract)
    {
      var crew = {
        'id_function_frame': id_function_frame,
        'id_category_sat': id_category_sat,
        'id_provider': id_provider,
        'id_contract': id_contract,
        'salary_workdays': salary_workdays,
        'total_workdays': total_workdays,
        'salary_contract_category_function': salary_contract_category_function,
        'salary_daily': salary_daily,
        'salary_liquidate': salary_liquidate,
        'salaty_difference': salaty_difference,
        'start_date_contract': start_date_contract,
        'finish_date_contract': finish_date_contract,
        'start_afip': start_afip,
        'finish_afip': finish_afip
      };

      // add crew to list input request
      if($('#'+id_provider).length == 0){
        $('.list_crew').append("<input type='hidden' name='list_crew[]' id='"+id_provider+"' value='' />");
        $('#'+id_provider).val(JSON.stringify(crew));
      } else {
        $('#'+id_provider).val('');
        $('#'+id_provider).val(JSON.stringify(crew));

        // remove item_view
        $("#item_view_"+id_provider).remove();
      }

      // add crew list table front
      var crewName = $('select[name=id_provider] option:selected').text();
      var crewFrameSat = $('select[name=id_function_frame] option:selected').text()+" / "+$('select[name=id_category_sat] option:selected').text();
      var crewDates = start_date_contract+" - "+finish_date_contract;

      // onClick remove crew
      var onClickRemoveCrew = "$('#'+$(this).data('itemremove')).remove();$('#'+$(this).data('idcrew')).remove()";

      // add html list crew view
      $('.list_crew_view').append("<tr id='item_view_"+id_provider+"'><td><button type='button' class='btn btn-link btn-danger btn-just-icon remove' onClick="+onClickRemoveCrew+" data-idcrew='"+id_provider+"' data-itemremove='item_view_"+id_provider+"' title='Eliminar'><i class='material-icons'>close</i></button></td><td>"+crewName+"</td><td>"+crewFrameSat+"</td><td>"+crewDates+"</td><td></td></tr>");

      // restart input add crew
      $(".empty-values-finish-add-crew input").val('');

    } else {
      alert('Complete los datos correspondientes para agregar un Crew!');
    }

  });

  // automatic calculate input
  $('input[name=total_workdays]').click(function(){
    if($('input[name=salary_workdays]').val() && $('input[name=count_workdays]').val()){
      $('input[name=total_workdays]').val($('input[name=salary_workdays]').val() * $('input[name=count_workdays]').val());
    } else {
      alert('Ingrese un Valor en Sueldo Jornada, para que se autocomplete el campo seleccionado');
    }
  });

  $('input[name=salary_daily]').click(function(){
    if($('input[name=salary_contract_category_function]').val()){

      $('input[name=salary_daily]').val($('input[name=salary_workdays]').val() / 30);
      $('input[name=salary_liquidate]').val($('input[name=days]').val() * $('input[name=salary_daily]').val());
      $('input[name=crew_sueldo_diferencia]').val($('input[name=total_workdays]').val() - $('input[name=salary_liquidate]').val());

    } else {
      alert('Seleccione una Categoria SAT, para que se autocomplete el campo seleccionado');
    }
  });

  $(".get_value_categories_sat").change(function(){
      var salaryNeto = $(this).data('salaryneto');
      if(salaryNeto != 0){
        $('input[name=salary_contract_category_function]').val(salaryNeto);
      }
  });

  // eliminar los project_providers por ajax

});
</script>
@endsection
