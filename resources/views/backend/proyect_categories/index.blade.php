@extends('layouts.admin')

@section('title', "Tipos de Proyectos")

@section('content')
<div class="container-fluid">

  <a href="{{ url('/utilities/proyect_categories/create') }}" class="btn btn-primary">Nuevo Tipo de Proyecto</a>

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
                <th>Activo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($proyect_categories as $proyect_category)
              <tr>
                <td>{{ $proyect_category->id }}</td>
                <td>{{ $proyect_category->name }}</td>
                <td>{{ \App\Helpers::getActive($proyect_category->active) }}</td>
                <td class="text-right">
                  {!! Form::open(['route' => ['proyect_categories.destroy', $proyect_category->id], 'method' => 'DELETE']) !!}
                    <a href="{{ url('/utilities/proyect_categories/'.$proyect_category->id.'/edit') }}" class="btn btn-link btn-warning btn-just-icon edit" title="Editar"><i class="material-icons">dvr</i></a>
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
