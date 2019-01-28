@extends('layouts.admin')

@section('title', "Categorías de Trabajadores / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'workers_categories.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Nueva Categoría de Trabajador</h4>
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
              <label class="col-sm-2 col-form-label">Nombre *</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Puesto Trabajo *</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="puesto_trabajo" value="{{ old('puesto_trabajo') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Sueldo Bruto *</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="sueldo_bruto" value="{{ old('sueldo_bruto') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Sueldo Bruto Texto</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="sueldo_bruto_texto" value="{{ old('sueldo_bruto_texto') }}" maxlength="300">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Sueldo Neto *</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="sueldo_neto" value="{{ old('sueldo_neto') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Sueldo Neto Texto</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="sueldo_neto_texto" value="{{ old('sueldo_neto_texto') }}" maxlength="300">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Presentismo</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="presentismo" value="{{ old('presentismo') }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Contrato</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="contrato" value="{{ old('contrato') }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label label-checkbox">Activo</label>
              <div class="col-sm-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="active" checked> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="active"> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <input type="submit" class="btn btn-primary" value="Crear" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
