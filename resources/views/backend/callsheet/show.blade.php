@extends('layouts.admin')

@section('title', "CallSheet / $project->name ")

@section('content')
<div class="container-fluid">

  <div class="header text-center">
    <h3 class="title">{{ $project->name }}</h3>
    <p class="category">{{ $project->description }}</p>
  </div>

  <div class="row">
    <div class="col-md-12 ml-auto mr-auto">
      @foreach($functions_frame as $frame)
      <h4 class="col-md-12 btn btn-primary">{{ \App\FrameFunction::getName($frame->id_function_frame) }}</h4>
      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Team</th>
            <th scope="col">Categoría SAT</th>
            <th scope="col">Telefono/s</th>
            <th scope="col">Email</th>
            <th scope="col">Dirección</th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_crew as $crew)
            @if($crew->id_function_frame == $frame->id_function_frame)

            <?php  $other_phone = (\App\Provider::getOtherTelephone($crew->id_provider) != '' ? ' - '.\App\Provider::getOtherTelephone($crew->id_provider) : ''); ?>

              <tr>
                <td>{{ \App\Provider::getNameOrderLastName($crew->id_provider) }}</td>
                <td>{{ \App\WorkersCategory::getName($crew->id_category_sat) }}</td>
                <td>{{ \App\Provider::getTelephone($crew->id_provider).$other_phone }} </td>
                <td>{{ \App\Provider::getEmail($crew->id_provider) }}</td>
                <td>{{ \App\Provider::getAddressFull($crew->id_provider) }}</td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
      @endforeach

    </div>
  </div>
</div>
@endsection
