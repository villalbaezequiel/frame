@extends('layouts.admin')

@section('title', "Crew")

@section('content')
<div class="container-fluid">

  <a href="{{ url('/providers/create') }}" class="btn btn-primary">Nuevo Crew</a>

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
          <table id="datatables_crew" class="table table-hover table-striped">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Nombre</th>
                <th>Puesto FRAME</th>
                <th>Celular</th>
                <th>Valoración</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($providers as $provider)
              <tr class="item-alert-confirm-delete">
                <td>{{ $provider->id }}</td>
                <td>{{ \App\User::getFullName($provider->id_user) }}</td>
                <td>
                    @foreach(json_decode($provider->id_function_frame) as $key => $val)
                       {{ \App\FrameFunction::getName($val).', ' }}
                    @endforeach
                </td>
                <td>{{ $provider->telephone }}</td>
                <td>{{ \App\ProviderAssessment::getCountByProvider($provider->id) }}</td>
                <td class="text-right">
                  {!! Form::open(['route' => ['providers.destroy', $provider->id], 'method' => 'DELETE', 'class'=> 'alert-confirm-delete']) !!}
                    <a href="{{ url('/providers/'.$provider->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit" title="Editar"><i class="material-icons">dvr</i></a>
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

  $("#datatables_crew").DataTable({
    responsive: true,
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
    "order": [[ 4, 'desc' ]]
  });

  $(".alert-confirm-delete").submit(function(e) {
    e.preventDefault();
    alertConfirmDeleteItem(this);
  });
});
</script>
@endsection
