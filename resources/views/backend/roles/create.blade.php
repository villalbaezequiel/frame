@extends('layouts.admin')

@section('title', "Roles / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Nuevo Rol</h4>
            </div>
          </div>
          <div class="card-body ">

            @if (session('message'))
              <div class="toolbar">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  {{ session('message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            @endif

            <div class="row">
              <label class="col-md-2 col-form-label">Nombre *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">URL Amigable *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="slug" value="{{ old('slug') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Descripción *</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="description" value="{{ old('description') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Permiso especial</label>
              <div class="col-md-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="all-access" name="special" checked> Acceso total
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="no-access" name="special"> Ningún acceso
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Lista de Permisos</label>
              <div class="col-md-10 checkbox-radios">

                @foreach($permissions as $permission)
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permissions[]"> {{ $permission->name }}
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                @endforeach
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <input type="submit" class="btn btn-primary" value="Guardar" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
