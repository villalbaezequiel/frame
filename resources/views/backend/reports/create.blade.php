@extends('layouts.admin')

@section('title', "Reportes / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'reports.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Nuevo Reporte</h4>
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
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="id_project" required>
                    @foreach(\App\CenterCost::getAllAssigne() as $centerCost)
                      <option value="{{ $centerCost->id }}">{{ $centerCost->number }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Tipo de Reporte <span class="required-red">*</span></label>
              <div class="col-md-7" style="margin-top: 10px;">
                <div class="form-file-upload">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="type" required>
                    @foreach(\App\Report::getTypes() as $key => $report)
                      <option value="{{ $key }}">{{ $report }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Rango de Fechas por <span class="required-red">*</span></label>
              <div class="col-md-7" style="margin-top: 10px;">
                <div class="form-file-upload">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="date_by" required>
                    @foreach(\App\Report::getDatesBy() as $key => $report)
                      <option value="{{ $key }}">{{ $report }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Desde <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control datepicker" type="text" name="from" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Hasta <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control datepicker" type="text" name="to" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Acción <span class="required-red">*</span></label>
              <div class="col-md-7" style="margin-top: 10px;">
                <div class="form-file-upload">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="action" required>
                    <option value="send">Enviar por Email</option>
                    <option value="download" selected="selected">Descargar</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Email Destinatario</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="email" name="send_email">
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <a href="javascript:void(0)" class="back-history btn">Cancelar</a>
            <input type="submit" class="btn btn-primary" value="Ejecutar" />
          </div>
        </div>
        {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
  $('a').click(function(e){

    if(!$(this).hasClass('none-alert')){
      var parentForm = $(this).parents('form');
      if(parentForm.length != 1 || $(this).hasClass('back-history')){
        e.preventDefault();
        alertLeaveForm(this);
      }
    }

  });
});
</script>
@endsection
