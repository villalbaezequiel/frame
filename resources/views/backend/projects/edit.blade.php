@extends('layouts.admin')

@section('title', "Proyectos / Editar")

@section('content')

<?php 
  $listPermissions = \App\User::getListPermissionsFromUser(Auth::user());
?>

<div class="container-fluid">
  <div class="col-md-12 col-12 mr-auto ml-auto">

  @if(!in_array("16", $listPermissions))
    <a href='{{ url("/export/project/$project->id") }}' class="btn btn-primary none-alert" target="_blank">Descargar Proyecto</a>
    <a href='{{ url("/export/project/$project->id") }}/horas_extras_teams' class="btn btn-primary none-alert" target="_blank">Descargar Horas Extras</a>
    <a href='{{ url("/export/project/$project->id") }}/absences_teams' class="btn btn-primary none-alert" target="_blank">Descargar Ausencias</a>
  @endif

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
                        <div class="card-icon card-icon-project">
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
                        <div class="card-icon card-icon-project">
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
                        <select class="selectpicker ajax_functions_frame_by_type_project" data-live-search="true" data-style="select-with-transition" name="cost_center" required>
                            <option 
                              value="{{ $project->cost_center }}" 
                              data-idtypeproject="{{ $project->id_proyect_category }}"
                              selected="selected"
                            >{{ \App\CenterCost::getNumber($project->cost_center) }}</option>
                          @foreach(\App\CenterCost::getAllNoAssigne() as $center_cost)
                            <option 
                              value="{{ $center_cost->id }}"
                              data-idtypeproject="{{ $center_cost->id_type_project }}"
                              ><?php echo $center_cost->number; ?></option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  @if(!in_array("16", $listPermissions))
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
                  @endif

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

                </div>
              </div>

              <div class="tab-pane" id="module_two">

              <div id="content-form-edit-team" class="hidden">
                <h5 class="info-text"> Team </h5>
                
                @if(!in_array("16", $listPermissions))
                  @include('backend.projects.components.edit.team_admin')
                @else
                  @include('backend.projects.components.edit.team_pedido')
                @endif

              </div>

              <div class="col-md-12 text-center" style="padding: 20px;">
                <button type="button" class="btn btn-primary button-show-form-team">Agregar Team</button>
              </div>

                <h5 class="info-text" id="ancla_list_crew_view" > Lista de Team </h5>

                <div class="form-group">
                  <div class="col-md-6">
                    <input type="search" placeholder="Buscar Team" id="search_input_card" class="form-control" />
                  </div>
                  <div class="col-md-6"></div>
                </div>

                <div class="row justify-content-center list_crew_view" style="margin-top: -22px;">
                  @foreach($list_crew as $item_crew)
                    <div class="col-md-4 d-flex group-more-team" data-hasreemplazo="{{ \App\ProjectProvider::hasReemplazo($item_crew->id_provider) }}"  data-idprovider="{{ $item_crew->id_provider }}" data-name="{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}" id="item_view_{{ $item_crew->id_provider }}">
                      <div class="card mb-3">
                        <div class="card-header card-section-color edit-text-function_frame">
                          {{ \App\FrameFunction::getName($item_crew->id_function_frame) }}
                        </div>
                        <div class="card-body"> 
                          <h4 class="card-title">{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}</h4>
                          <p class="card-text mb-2 edit-text-category_sat">{{ \App\WorkersCategory::getName($item_crew->id_category_sat) }}</p>
                          <p class="card-text mb-2 edit-text-dates">Fechas: {{ \App\Helpers::getDateParseFormat($item_crew->start_date_contract, '/') }} a {{ \App\Helpers::getDateParseFormat($item_crew->finish_date_contract, '/') }}</p>
                          <p class="card-text mb-2 edit-text-contract">Contrato: {{ \App\Contract::getName($item_crew->id_contract) }}</p>
                          <p class="card-text mb-2 edit-text-total_workdays">Sueldo en Mano: ${{ $item_crew->total_workdays }}</p>
                          <p class="card-text mb-2 edit-text-active">Estado: {{ \App\ProjectProvider::getActive($item_crew->active) }}</p>
                          <p class="card-text mb-2 edit-text-puesto">Puesto: {{ \App\ProjectProvider::getPuesto($item_crew->id) }}</p>
                        </div>
                        <div class="card-footer card-footer-project pt-0">
                          <a href="{{ url('/export/crew_contract/'.$item_crew->id) }}" target="_blank" class="btn btn-link btn-warning btn-just-icon edit" title="Descargar Contrato"><i class="material-icons">assignment</i></a>
                          <a href="{{ url('/export/release/'.$item_crew->id) }}" target="_blank" class="btn btn-link btn-warning btn-just-icon edit" title="Descargar Release"><i class="material-icons">assignment</i></a>
                          <a data-url="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon edit show-hour-extras" data-id="{{ $item_crew->id }}" data-nameteam="{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}" title="Ver/Editar Horas Extras"><i class="material-icons">calendar_today</i></a>
                          <a data-url="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon edit show-absences" data-id="{{ $item_crew->id }}" data-nameteam="{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}" title="Ver/Editar Ausencias"><i class="material-icons">calendar_today</i></a>
                          @if($item_crew->active == '1' || $item_crew->active == 1)
                            {{-- <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon edit add-hour-extras" data-id="{{ $item_crew->id }}" data-nameteam="{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}" title="Agregar Horas Extras"><i class="material-icons">calendar_today</i></a> --}}
                          @endif
                          <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon edit project-team-edit" data-id="{{ $item_crew->id }}" data-nameteam="{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}" data-idfunctionframe="{{ $item_crew->id_function_frame }}" data-iscategory="{{ $item_crew->id_category_sat }}" data-category="{{ \App\WorkersCategory::getName($item_crew->id_category_sat) }}" title="Ver / Editar"><i class="material-icons">dvr</i></a>
                          <button type="button" class="btn btn-link btn-danger btn-just-icon remove alert-confirm-delete-button" title="Eliminar" data-id="{{ $item_crew->id }}" data-idprovider="{{ $item_crew->id_provider }}"><i class="material-icons">close</i></button>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>

                <!-- append list crew  -->
                <div class="list_crew"> </div>

                @if(!in_array("16", $listPermissions))
                  @if(!$project->active)
                    <h5 class="info-text"> Generacion de Seguros - Contratos tipos Servicios </h5>
                    <div class="row justify-content-center">

                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text no-wrap">
                              Cláusula de No Repetición
                            </span>
                            <select class="selectpicker" data-style="select-with-transition" name="clausula_no_repe">
                              <option value="0" <?php if($project->clausula_no_repe == "0"){ echo "selected"; } ?>>No</option>
                              <option value="1" <?php if($project->clausula_no_repe == "1"){ echo "selected"; } ?>>Si</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text no-wrap">
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

                  <h5 class="info-text"> Configurar Notificaciones </h5>
                  <div class="row justify-content-center">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text no-wrap">
                            Enviar Notificaciones a los Teams:
                          </span>
                          <select class="selectpicker" data-style="select-with-transition" name="notification_team">
                            <option value="0" selected>No</option>
                            <option value="1">Si</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <h5 class="info-text"> Sistema de Pedidos </h5>
                  <div class="row justify-content-center">
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text no-wrap">
                            Es pedido:
                          </span>
                          <select class="selectpicker" data-style="select-with-transition" readonly>
                            <option value="0">{{ \App\Helpers::getActive($project->is_producer_order) }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    @if((int) $project->is_producer_order)  

                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text no-wrap">
                              Creador del Pedido:
                            </span>
                            <select class="selectpicker" data-style="select-with-transition" readonly>
                              <option value="0">{{ \App\User::getFullName($project->iduser_producer_order) }}</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text no-wrap">
                              Estado del pedido:
                            </span>
                            <select class="selectpicker" data-style="select-with-transition" name="status_producer_order">
                              <option value="0" <?php if((int) $project->status_producer_order == 0) { echo "selected"; } ?> >Stand By</option>
                              <option value="1" <?php if((int) $project->status_producer_order == 1) { echo "selected"; } ?>>Aceptar</option>
                              <option value="2" <?php if((int) $project->status_producer_order == 2) { echo "selected"; } ?>>Rechazar</option>
                            </select>
                          </div>
                        </div>
                      </div>

                    @endif

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
              <input type="submit" class="btn btn-finish btn-fill btn-primary btn-wd show-content-observation" name="finish" value="Guardar" style="display: none;" onclick="frameJs.setDisabled(this)" />
            </div>
            <div class="clearfix"></div>
          </div>

          @if(in_array("16", $listPermissions))
              <input type="hidden" name="is_team_pedido" value="1">
          @endif
          
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
  <script>
    var listTeams = {!! json_encode($list_crew,JSON_FORCE_OBJECT) !!};
    let holidays = {!! json_encode($holidays,true) !!};

    $('.datepicker').datepicker({
        beforeShowDay: function (date){
          let thisDate = jQuery.datepicker.formatDate('yy-mm-dd', date);
          for(var i=0; i < holidays.length; ++i) {
              if(holidays[i] == thisDate) {
                return [true, 'ui-state-highlight ui-state-active'];
              }
          }
          return [true];
        }
    });

    $('.datepicker_crew').datepicker({
        beforeShowDay: function (date){
          let thisDate = jQuery.datepicker.formatDate('yy-mm-dd', date);
          for(var i=0; i < holidays.length; ++i) {
              if(holidays[i] == thisDate) {
                return [true, 'ui-state-highlight ui-state-active'];
              }
          }
          return [true];
        }
    });
  </script>
  <script src="{{ asset('/js/project.js') }}"> </script>
@endsection
