@extends('layouts.admin')

@section('title', "Reportes / Informacion Completa")

@section('content')
<div class="container-fluid">

  {!! Form::open(['route' => 'export.custom_cost_center', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
    <input type="submit" class="btn btn-primary" value="Descargar Todos Centros de Costos" />
  {!! Form::close() !!}

  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'export.custom_cost_center', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Multiple Centro de Costos</h4>
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
              <label class="col-md-2 col-form-label">Centro de Costo <span class="required-red">*</span></label>
              <div class="col-md-7" style="margin-top: 10px;">
                <div class="form-file-upload">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="cost_centers[]" multiple required>
                    @foreach(\App\CenterCost::getAllAssigne() as $centerCost)
                      <option value="{{ $centerCost->id }}">{{ $centerCost->number }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <a href="javascript:void(0)" class="back-history btn">Cancelar</a>
            <input type="submit" class="btn btn-primary" value="Descargar" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
