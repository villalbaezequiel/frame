@extends('layouts.auth')
@section('title', 'Centro de Costos')

@section('container')
<div class="row">
  <div class="col-md-10 ml-auto mr-auto">
      <div class="col-md-6 ml-auto mr-auto">
        <img src="{{ asset('img/logo.svg') }}" />
      </div>

      <div class="card">
        <h4 class="card-title card-header-primary text-center">Lista de Centro de Costos!</h4>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Asignado a Proyecto</th>
                    <th scope="col">Activo</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($center_costs as $cost)
                    <tr>
                      <th scope="row">{{ $cost->number }}</th>
                      <td>{{ $cost->name }}</td>
                      <td>{{ $cost->client }}</td>
                      <td>{{ App\Helpers::getActive($cost->assigne) }}</td>
                      <td>{{ App\Helpers::getActive($cost->active) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>

      </div>

  </div>
</div>
@endsection
