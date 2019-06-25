@extends('layouts.admin')

@section('title', "CallSheet")

@section('content')
<div class="container-fluid">

  <a href='{{ url("/export/callsheet/$project->id") }}' class="btn btn-primary">Descargar CallSheet</a>

  <div class="header text-center">
    <h3 class="title">{{ $project->name }}</h3>
    <p class="category">{{ $project->description }}</p>
  </div>

  <div class="row">
    <div class="col-md-12 ml-auto mr-auto">

      @if(!count($functions_frame))
        <div class="toolbar">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            No se encontraron Teams para el Proyecto Seleccionado.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      @endif

      @foreach($functions_frame as $frame)
      <h4 class="col-md-12 btn btn-primary">{{ \App\FrameFunction::getName($frame->id_function_frame) }}</h4>
      <div class="table-responsive-md">
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Rol a Desempeñar</th>
              <th scope="col">Nombre Team</th>
              <th scope="col">Telefono/s</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <tbody>
            @foreach($list_crew as $crew)
              @if($crew->id_function_frame == $frame->id_function_frame)

              <?php $other_phone = (\App\Provider::getOtherTelephone($crew->id_provider) != '' ? ' - '.\App\Provider::getOtherTelephone($crew->id_provider) : ''); ?>

                <tr>
                  <td>{{ \App\WorkersCategory::getName($crew->id_category_sat) }}</td>
                  <td>{{ \App\Provider::getNameOrderLastName($crew->id_provider) }}</td>
                  <td>{{ \App\Provider::getTelephone($crew->id_provider).$other_phone }}</td>
                  <td>{{ \App\Provider::getEmail($crew->id_provider) }}</td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
      @endforeach

    </div>
  </div>
</div>
@endsection
