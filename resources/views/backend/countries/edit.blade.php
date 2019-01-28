@extends('layouts.admin')

@section('title', "Paises / Editar")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => ['countries.update' , $country->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Editar País</h4>
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
                  <input class="form-control" type="text" name="name" value="{{ $country->name }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Masculino *</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="male" value="{{ $country->male }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label">Femenino *</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="female" value="{{ $country->female }}" maxlength="125" required>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <input type="submit" class="btn btn-primary" value="Editar" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
