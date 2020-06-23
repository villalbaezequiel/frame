@extends('layouts.admin')

@section('title', "Centro de Costos / Editar")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => ['center_costs.update' , $center_cost->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Editar Centro de Costo</h4>
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
              <label class="col-md-2 col-form-label">Número</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="number" value="{{ $center_cost->number }}" maxlength="125" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Nombre</label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="name" value="{{ $center_cost->name }}" maxlength="125" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Tipo de Proyecto</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="id_type_project" required>
                    @foreach(\App\ProyectCategory::getAllProyectCategories() as $type_project)
                    <option value="{{ $type_project->id }}" <?php if($center_cost->id_type_project == $type_project->id){ echo "selected"; } ?>>{{ $type_project->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Cliente</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="client" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Client::getAllClients() as $client)
                    <option value="{{ $client->id }}" <?php if($center_cost->client == $client->id){ echo "selected"; } ?>><?php if($client->nick){ echo $client->nick; } else { echo $client->razon_social; } ?></option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Referente/s</label>
              <div class="col-md-7">
                <div class="form-group">
                    <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="referente[]" multiple>
                      <option value="">Seleccionar</option>
                      @foreach(\App\Provider::getAllProvidersReferring() as $provider)
                      <option value="{{ $provider->id }}"
                          <?php
                          if(json_decode($center_cost->referente)){
                            foreach (json_decode($center_cost->referente) as $referente) {
                              if($referente && $referente == $provider->id){
                                echo "selected='selected'";
                          }}} ?>>
                        {{ $provider->last_name.' '.$provider->name }}
                      </option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Pedidos/Productores</label>
              <div class="col-md-7">
                <div class="form-group">
                    <select class="selectpicker" data-live-search="true" data-style="select-with-transition" name="push_rol_producer_orders">
                      <option value="0" <?php if((int) $center_cost->push_rol_producer_orders == 0){ echo "selected"; } ?> >No</option>
                      <option value="1" <?php if((int) $center_cost->push_rol_producer_orders == 1){ echo "selected"; } ?> >Si</option>
                    </select>
                </div>
              </div>
            </div>

            <div class="row">
                <label class="col-md-2 col-form-label">Asignado a Proyecto</label>
                <div class="col-md-7">
                  <div class="form-group">
                    <input class="form-control" type="text" value="{{ App\Helpers::getActive($center_cost->assigne) }}" disabled>
                  </div>
                </div>
              </div>

            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Activo</label>
              <div class="col-md-10 checkbox-radios">
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="1" name="active" <?php if($center_cost->active == 1){ echo "checked"; } ?>> Si
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" value="0" name="active" <?php if($center_cost->active == 0){ echo "checked"; } ?>> No
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
            <!-- <input type="submit" class="btn btn-primary" value="Guardar" onclick="javascript:this.form.submit();this.disabled= true;" /> -->
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
