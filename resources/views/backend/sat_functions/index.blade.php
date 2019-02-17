@extends('layouts.admin')

@section('title', "Funciones SAT")

@section('content')
<div class="container-fluid">

  <a href="{{ url('/sat_functions/create') }}" class="btn btn-primary">Nueva Función SAT</a>

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
          <table id="datatables" class="table table-hover table-striped">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Función Frame</th>
                <th>Activo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sat_functions as $satFunction)
              <tr class="item-alert-confirm-delete">
                <td>{{ $satFunction->id }}</td>
                <td>{{ $satFunction->name }}</td>
                <td>{{ \App\WorkersCategory::getName($satFunction->id_workers_category)  }}</td>
                <td>{{ \App\FrameFunction::getName($satFunction->id_frame_function) }}</td>
                <td>{{ \App\Helpers::getActive($satFunction->active) }}</td>
                <td class="text-right">
                  {!! Form::open(['route' => ['sat_functions.destroy', $satFunction->id], 'method' => 'DELETE', 'class'=> 'alert-confirm-delete']) !!}
                    <a href="{{ url('/sat_functions/'.$satFunction->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit" title="Editar"><i class="material-icons">dvr</i></a>
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
