@extends('layouts.admin')

@section('title', "Centro de Costos")

@section('content')

<?php 
  $listPermissions = \App\User::getListPermissionsFromUser(Auth::user());
?>

<div class="container-fluid">

  @if(!in_array("16", $listPermissions))
    <a href="{{ url('/center_costs/create') }}" class="btn btn-primary">Nuevo Centro de Costo</a>
    <a href='{{ url("/export/center_costs") }}' class="btn btn-primary">Descargar Lista</a>
  @endif

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
                <th>Número</th>
                <th>Nombre</th>
                <th>Cliente</th>
                @if(!in_array("16", $listPermissions))
                  <th>Activo</th>
                  <th class="text-right">Acciones</th>
                @else
                  <th>Disponible</th>
                @endif
                
              </tr>
            </thead>
            <tbody>
              @foreach($center_costs as $center_cost)
              <tr class="item-alert-confirm-delete">
                <td>{{ $center_cost->number }}</td>
                <td>{{ $center_cost->name }}</td>
                <td>{{ App\Client::getNick($center_cost->client) }}</td>

                @if(!in_array("16", $listPermissions))
                  <td>{{ \App\Helpers::getActive($center_cost->active) }}</td>
                  <td class="text-right">
                    {!! Form::open(['route' => ['center_costs.destroy', $center_cost->id], 'method' => 'DELETE', 'class'=> 'alert-confirm-delete']) !!}
                      <a href="{{ url('/center_costs/'.$center_cost->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit" title="Editar"><i class="material-icons">dvr</i></a>
                      <button type="submit" class="btn btn-link btn-danger btn-just-icon remove" title="Eliminar"><i class="material-icons">close</i></button>
                    {!! Form::close() !!}
                  </td>
                @else
                  <td><?php if((int)$center_cost->assigne == 1){ echo "No"; } else { echo "Si"; } ?></td>
                @endif

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
