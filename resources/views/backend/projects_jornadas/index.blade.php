@extends('layouts.admin')

@section('title', "Jornadas de Proyectos")

@section('content')
<div class="container-fluid">

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
                <th>Nombre</th>
                <th>Tipo de Proyecto</th>
                <th>Fechas: Inicio - Finalización</th>
                <th>Activo</th>
                <th class="text-right">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($projects as $project)

              <?php
               $start_date = explode('-', \App\Helpers::getDate($project->start_date));
               $finish_date = explode('-', \App\Helpers::getDate($project->finish_date));
              ?>

              <tr class="item-alert-confirm-delete">
                <td>{{ $project->name }}</td>
                <td>{{ \App\ProyectCategory::getName($project->id_proyect_category) }}</td>
                <td>{{ $start_date[2].'/'.$start_date[1].'/'.$start_date[0] }} - {{ $finish_date[2].'/'.$finish_date[1].'/'.$finish_date[0] }}</td>
                <td>{{ \App\Helpers::getActive($project->active) }}</td>
                <td class="text-right">
                  <a href="{{ url('/projects_jornadas/'.$project->id) }}" class="btn btn-link btn-warning btn-just-icon edit" title="Calendario Jornadas"><i class="material-icons">calendar_today</i></a>
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
