@extends('layouts.admin')

@section('title', "Reportes")

@section('content')
<div class="container-fluid">

  <a href="{{ url('/reports/create') }}" class="btn btn-primary">Nuevo Reporte</a>

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
                <th>C. Costo</th>
                <th>Tipo</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th class="text-right">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reports as $report)
              <tr class="item-alert-confirm-delete">
                <td>{{ \App\Project::getCenterCost($report->id_project) }}</td>
                <td>{{ \App\Report::getType($report->type) }}</td>
                <td>{{ $report->from }}</td>
                <td>{{ $report->to }}</td>
                <td class="text-right">
                  {!! Form::open(['route' => ['reports.destroy', $report->id], 'method' => 'DELETE', 'class'=> 'alert-confirm-delete']) !!}
                    <a href="{{ url('/export/report/'.$report->id) }}" target="_blank" class="btn btn-link btn-warning btn-just-icon edit" title="Descargar"><i class="material-icons">cloud_download</i></a>
                    <button type="submit" class="btn btn-link btn-danger btn-just-icon remove" title="Eliminar"><i class="material-icons">close</i></button>
                  {!! Form::close() !!}
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

@if (session('download'))
  <input type="hidden" name="file_download" value="{{ session('download') }}">
  <script>
    let download = $('input[name=file_download]').val();
    window.open(download);
  </script>
@endif

<script>
$(document).ready(function(){
  $(".alert-confirm-delete").submit(function(e) {
    e.preventDefault();
    alertConfirmDeleteItem(this);
  });
});
</script>
@endsection
