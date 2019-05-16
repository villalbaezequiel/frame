@extends('layouts.admin')

@section('title', "Categorías SAT / Editar")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => ['workers_categories.update' , $workersCategory->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Editar Categoría SAT</h4>
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
              <label class="col-md-2 col-form-label">Nº de Categoría <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="number" name="number_category" value="{{ $workersCategory->number_category }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Nombre <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="name" value="{{ $workersCategory->name }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Básico <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control validate-number-decimal" type="text" name="sueldo_basico" value="{{ $workersCategory->sueldo_basico }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Adicional <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control validate-number-decimal" type="text" name="sueldo_adicional" value="{{ $workersCategory->sueldo_adicional }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Presentismo</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control validate-number-decimal" type="text" name="presentismo" value="{{ $workersCategory->presentismo }}" maxlength="125">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Sueldo Bruto <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control validate-number-decimal" type="text" name="sueldo_bruto" value="{{ $workersCategory->sueldo_bruto }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Sueldo Bruto Texto</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="sueldo_bruto_texto" value="{{ $workersCategory->sueldo_bruto_texto }}" maxlength="300">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Categoría AFIP</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="number" name="categoria_afip" value="{{ $workersCategory->categoria_afip }}" maxlength="300">
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Activo</label>
              <div class="col-md-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="active" <?php if($workersCategory->active == 1){ echo "checked"; } ?>> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="active" <?php if($workersCategory->active == 0){ echo "checked"; } ?>> No
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer ml-auto mr-auto">
            <a href="javascript:void(0)" class="back-history btn">Cancelar</a>
            <input type="submit" class="btn btn-primary" value="Guardar" />
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
