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
                            value="{{ $workday->id }}">{{ $workday->name }}<?php if($workday->day && $workday->day != 1){ echo "(".$workday->day." dias)";} ?></option>
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
                          Sueldo Jornada:
                        </span>
                          <input type="text" class="form-control validate-number-decimal-not-ps" name="salary_workdays" maxlength="125">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Total:
                        </span>
                          <input type="text" class="form-control" name="total_workdays" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Contrato Mensual:
                        </span>
                          <input type="text" class="form-control" name="salary_contract_category_function" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo Diario SAT:
                        </span>
                          <input type="text" class="form-control" name="salary_daily" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Sueldo A Liquidar Neto:
                        </span>
                          <input type="text" class="form-control" name="salary_liquidate" maxlength="125" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          Diferencia:
                        </span>
                        <input type="text" class="form-control" name="crew_sueldo_diferencia" maxlength="125" readonly>
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
        id_workday: {
          required: true
        },
        duration_workdays: {
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
    var count_workdays_crew = $('input[name=count_workdays_crew]').val();
    var start_afip = $('input[name=start_afip]').val();
    var finish_afip = $('input[name=finish_afip]').val();

    if(id_function_frame && id_category_sat && id_contract && id_provider &&
       salary_workdays && total_workdays && salary_contract_category_function &&
       salary_daily && salary_liquidate && start_date_contract && finish_date_contract &&
       count_workdays_crew && start_afip && finish_afip)
    {

      // verificar si el Crew esta en otro proecto en esas fechas
      $.ajax({
        type: 'GET',
        url: '/sistema/json/check_crew_project/'+id_provider+'/'+start_date_contract.replace('/', '-'),
        dataType: 'json',
        success: function(data){

          var status = data.status;

          if(status == true){
            return true;
          } else {
            Swal.fire({
              type: 'warning',
              title: '¡Advertencia! El Crew, en las Fechas de Contrato ingresadas, se encuentra Trabajando en otro Proyecto!',
              text: "Por favor ingrese nuevas Fechas de Contrato o pruebe con Otro Crew.",
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, continuar!'
            });
            return false;
          }

        },
        error: function(xhr, status){
          console.log('Error: '+xhr);
        }
      });


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
        'count_workdays_crew': count_workdays_crew,
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

      // check jornada de trabajo del proyecto segun la jornada que mas tenga de los CREW
      if(isNaN(parseFloat($('input[name=count_workdays]').val()))) {
        $('input[name=count_workdays]').val(count_workdays_crew);
      } else if($("select[name=id_workday]").find(':selected').data('day') != 1){
        if(parseFloat($('input[name=count_workdays]').val()) <= parseFloat(count_workdays_crew)){
          $('input[name=count_workdays]').val(count_workdays_crew);
        }
      }

      // add crew list table front
      var crewName = $('select[name=id_provider] option:selected').text();
      var crewFrameSat = $('select[name=id_function_frame] option:selected').text()+" / "+$('select[name=id_category_sat] option:selected').text();
      var crewDates = start_date_contract+" - "+finish_date_contract;

      // button to onClick add remove crew
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
    if($('input[name=salary_workdays]').val() && $('input[name=count_workdays_crew]').val()){

      var salary_workdays = $('input[name=salary_workdays]').val();
      var count_workdays_crew = $('input[name=count_workdays_crew]').val();
      var total_workdays = (parseFloat(salary_workdays.replace(".", "").replace(",", ".")) * parseFloat(count_workdays_crew));

      $('input[name=total_workdays]').val(getFormatNumber(total_workdays));

      if($('input[name=salary_contract_category_function]').val()){

        var salary_contract_category_function = $('input[name=salary_contract_category_function]').val();
        var salary_contract_category_functionFinish = parseFloat(salary_contract_category_function.replace(".", "").replace(",", "."));
        var days = $('input[name=days]').val();
        var salary_daily = (salary_contract_category_functionFinish / 30);

        $('input[name=salary_daily]').val(getFormatNumber(salary_daily));
        $('input[name=salary_liquidate]').val(getFormatNumber(parseFloat(days) * salary_daily));
        $('input[name=crew_sueldo_diferencia]').val( getFormatNumber(total_workdays - (parseFloat(days) * salary_daily)) );

      } else {
        alert('Seleccione una Categoria SAT, para que se autocomplete el campo seleccionado');
      }

    } else {
      alert('Ingrese un Valor en Sueldo Jornada, para que se autocomplete el campo seleccionado');
    }
  });


  $(".get_value_categories_sat").change(function(){
    var salaryneto = $(this).find(':selected').data('salaryneto');
    if(salaryneto){
      $('input[name=salary_contract_category_function]').val(salaryneto);
    }
  });

  // module 2 Jornadas
  $("select[name=id_workday]").change(function(){
    if($(this).find(':selected').data('day') == 1){
      $('input[name=count_workdays]').removeAttr('readonly');
    } else {
      $('input[name=count_workdays]').attr('readonly', 'readonly');
      $('input[name=count_workdays]').val('');
    }
    $("select[name=view_modality_work]").find('option').remove().end().append('<option selected="selected">'+$(this).find(':selected').text()+'</option>');
    $('.selectpicker').selectpicker('refresh');
  });

});

function getFormatNumber(number){
  var numberInt = number.toString().split('.');
  if(numberInt[1]){
    if(numberInt[0].length == 4) {
      return numberInt[0].substr(0, 1)+"."+numberInt[0].substr(-3)+","+numberInt[1];
    } else if(numberInt[0].length == 5){
      return numberInt[0].substr(0, 2)+"."+numberInt[0].substr(-3)+","+numberInt[1];
    } else if(numberInt[0].length == 6) {
      return numberInt[0].substr(0, 3)+"."+numberInt[0].substr(-3)+","+numberInt[1];
    } else {
      return numberInt[0]+","+numberInt[1];
    }
  } else {
    if(numberInt[0].length == 4) {
      return numberInt[0].substr(0, 1)+"."+numberInt[0].substr(-3)+",00";
    } else if(numberInt[0].length == 5){
      return numberInt[0].substr(0, 2)+"."+numberInt[0].substr(-3)+",00";
    } else if(numberInt[0].length == 6) {
      return numberInt[0].substr(0, 3)+"."+numberInt[0].substr(-3)+",00";
    } else {
      return numberInt[0]+","+numberInt[1];
    }
  }
}
</script>
@endsection
