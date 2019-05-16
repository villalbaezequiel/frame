@extends('layouts.admin')

@section('title', "Categorías SAT")

@section('content')
<div class="container-fluid">

  <a href="{{ url('/workers_categories/create') }}" class="btn btn-primary">Nueva Categoría SAT</a>
  <a href="{{ url('/import/workers_categories') }}" class="btn btn-primary">Importar Categorías SAT</a>

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
                <th>Nº Categoría</th>
                <th>Nombre</th>
                <th>Básico</th>
                <th>Adicional</th>
                <th>Presentismo</th>
                <th>Sueldo Bruto</th>
                <th>Activo</th>
                <th class="text-right">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($workers_categories as $workersCategory)
              <tr class="item-alert-confirm-delete">
                <td>{{ $workersCategory->number_category }}</td>
                <td>{{ $workersCategory->name }}</td>
                <td>{{ $workersCategory->sueldo_basico }}</td>
                <td>{{ $workersCategory->sueldo_adicional }}</td>
                <td>{{ $workersCategory->presentismo }}</td>
                <td>{{ $workersCategory->sueldo_bruto }}</td>
                <td>{{ \App\Helpers::getActive($workersCategory->active) }}</td>
                <td class="text-right">
                  {!! Form::open(['route' => ['workers_categories.destroy', $workersCategory->id], 'method' => 'DELETE', 'class'=> 'alert-confirm-delete']) !!}
                    <a href="{{ url('/workers_categories/'.$workersCategory->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit" title="Editar"><i class="material-icons">dvr</i></a>
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
<script>
$(document).ready(function(){
  $(".alert-confirm-delete").submit(function(e) {
    e.preventDefault();
    alertConfirmDeleteItem(this);
  });
});
</script>
@endsection
