@extends('layouts.admin')

@section('title', "Funciones Frame")

@section('content')
<div class="container-fluid">

  <a href="{{ url('/frame_functions/create') }}" class="btn btn-primary">Nueva Función Frame</a>

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
                <th>Tipo de Proyecto</th>
                <th>Nombre</th>
                <th>N* Categorias SAT</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($frame_functions as $frameFunction)
              <tr class="item-alert-confirm-delete">
                <td>{{ $frameFunction->id }}</td>
                <td>{{ \App\ProyectCategory::getName($frameFunction->id_proyect_category) }}</td>
                <td>{{ $frameFunction->name }}</td>
                <td>{{ \App\FrameFunction::getNumberCategoriesSat($frameFunction->id) }}</td>
                <td class="text-right">
                  {!! Form::open(['route' => ['frame_functions.destroy', $frameFunction->id], 'method' => 'DELETE', 'class'=> 'alert-confirm-delete']) !!}
                    <a href="{{ url('/frame_functions/'.$frameFunction->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit" title="Editar"><i class="material-icons">dvr</i></a>
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
