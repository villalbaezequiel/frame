@extends('layouts.admin')

@section('title', "Proyectos")

@section('content')
<div class="container-fluid">

  <a href="{{ url('/projects/create') }}" class="btn btn-primary">Nuevo Proyecto</a>
  <a href='{{ url("/export/all_project") }}' class="btn btn-primary">Descargar Lista</a>

  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title">Lista</h4>
        </div>
        <div class="card-body">
          @if (session('message'))
            <div class="toolbar">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
          @endif
          <table id="datatables" class="table table-hover table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>C.de Costo</th>
                <th>Nombre</th>
                <th>Tipo de Proyecto</th>
                <th>Fechas: Inicio - Finalización</th>
                <th>Estado</th>
                <th>Activo</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($projects as $project)

              <?php
               $start_date = explode('-', \App\Helpers::getDate($project->start_date));
               $finish_date = explode('-', \App\Helpers::getDate($project->finish_date));
              ?>

              <tr class="item-alert-confirm-delete">
                <td>{{ \App\CenterCost::getNumber($project->cost_center) }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ \App\ProyectCategory::getName($project->id_proyect_category) }}</td>
                <td>{{ $start_date[2].'/'.$start_date[1].'/'.$start_date[0] }} - {{ $finish_date[2].'/'.$finish_date[1].'/'.$finish_date[0] }}</td>
                <td>{{ \App\Project::getIsClosed($project->is_closed) }}</td>
                <td>{{ \App\Helpers::getActive($project->active) }}</td>
                <td class="text-right">

                  @if($project->is_closed)

                  <div style="text-align: center;">
                    <!-- List Exports: info_proyecto, personal_teams_proyecto, generacion_seguros_servicios -->
                    <a href="{{ url('/export/project/'.$project->id) }}" class="btn btn-link btn-success btn-just-icon" title="Descargar Informacion del Proyecto"><i class="material-icons">file_download</i></a>
                    <a href="{{ url('/export/project/'.$project->id.'/hs_ex_absences_teams') }}" class="btn btn-link btn-success btn-just-icon" title="Descargar Ausencias y Horas Extras del Personal"><i class="material-icons">file_download</i></a>
                    <a href="{{ url('/export/seguros_servicios/'.$project->id) }}" class="btn btn-link btn-success btn-just-icon" title="Descargar Generacion de Seguros"><i class="material-icons">file_download</i></a>
                    <!-- action closed -->
                    <a href="{{ url('/projects_is_closed/'.$project->id.'/0') }}" class="btn btn-link btn-success btn-just-icon remove" title="Abrir Proyecto"><i class="material-icons">lock_open</i></a>
                  </div>
                  @else

                    {!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'DELETE', 'class'=> 'alert-confirm-delete', 'style'=> 'text-align: center;']) !!}
                      <!-- List Exports: info_proyecto, personal_teams_proyecto, generacion_seguros_servicios -->
                      <a href="{{ url('/export/project/'.$project->id) }}" class="btn btn-link btn-success btn-just-icon" title="Descargar Informacion del Proyecto"><i class="material-icons">file_download</i></a>
                      <a href="{{ url('/export/project/'.$project->id.'/hs_ex_absences_teams') }}" class="btn btn-link btn-success btn-just-icon" title="Descargar Ausencias y Horas Extras del Personal"><i class="material-icons">file_download</i></a>
                      <a href="{{ url('/export/seguros_servicios/'.$project->id) }}" class="btn btn-link btn-success btn-just-icon" title="Descargar Generacion de Seguros"><i class="material-icons">file_download</i></a>
                        <!-- action closed -->
                      <a href="{{ url('/projects_is_closed/'.$project->id.'/1') }}" class="btn btn-link btn-danger btn-just-icon remove" title="Cerrar Proyecto"><i class="material-icons">lock_outline</i></a>
                      <!-- CRUD PROJECT -->
                      <a href="{{ url('/projects/'.$project->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit" title="Editar"><i class="material-icons">dvr</i></a>
                      <button type="submit" class="btn btn-link btn-danger btn-just-icon remove" title="Eliminar"><i class="material-icons">close</i></button>
                    {!! Form::close() !!}

                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- end card-body-->

      </div><!--  end card  -->
    </div><!-- end col-md-12 -->
  </div><!-- end row -->
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
  $(".alert-confirm-delete").submit(function(e) {
    e.preventDefault();
    alertConfirmDeleteItem(this);
  });
});
</script>
@endsection
