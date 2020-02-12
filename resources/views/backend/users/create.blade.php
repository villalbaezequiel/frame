@extends('layouts.admin')

@section('title', "Usuarios / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        <div class="card ">
          <div class="card-header card-header-primary card-header-text">
            <div class="card-text">
              <h4 class="card-title">Nuevo Usuario</h4>
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
              <label class="col-md-2 col-form-label">Nombre <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="name" value="{{ old('name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Apellido <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Email <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control" type="email" name="email" value="{{ old('email') }}" maxlength="125" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Tipo de Documentación <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="type_dni" required>
                    @foreach(\App\Helpers::getTypesDocumentationPerson() as $key => $val)
                    <option value="{{ $key }}" <?php if(old('type_dni') == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">DNI <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control input-type-number" type="number" name="dni" value="{{ old('dni') }}" minlength="8" maxlength="8" required>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">CUIT <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control input-type-number" type="number" name="cuit" value="{{ old('cuit') }}" maxlength="125" required>
                </div>
              </div>
              <label class="col-md-3 label-on-right">
                <code>inserte únicamente números.</code>
              </label>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Género <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="gender" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getGendersPerson() as $key => $val)
                    <option value="{{ $key }}" <?php if(old('gender') == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Estado Civil <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-style="btn btn-link" name="civil_status" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::getCivilStatus() as $key => $val)
                    <option value="{{ $key }}" <?php if(old('civil_status') == $key){ echo "selected='selected'"; } ?>>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Fecha de Nacimiento <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <input class="form-control datepicker validate-year" style="background-color: white!important;" pattern="^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$" type="text" name="birthdate" value="{{ old('birthdate') }}" minlength="10" maxlength="10" required readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">País <span class="required-red">*</span></label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="id_country" required>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Country::all() as $country)
                    <option value="{{ $country->id }}" <?php if(old('id_country') == $country->id){ echo "selected='selected'"; } ?>>{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-md-2 col-form-label">Rol Usuario </label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="permissions[]" multiple>
                    @foreach(\App\RoleUser::getRoles() as $key => $permission)
                    <option value="{{ $key }}">{{ $permission }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Recibe Notificaciones?</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="is_notification">
                    <option value="0" selected="selected">No</option>
                    <option value="1">Si</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label">Tipo de Notificación</label>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control selectpicker" data-live-search="true" data-style="btn btn-link" name="section_notification[]" multiple>
                    <option value="">Seleccionar</option>
                    @foreach(\App\Helpers::typesSendNotifications() as $key => $value)
                      <option value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-md-2 col-form-label label-checkbox">Activo</label>
              <div class="col-md-10 checkbox-radios">
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
