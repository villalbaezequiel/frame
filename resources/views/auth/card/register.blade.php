<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Nombre:
      </span>
    </div>
    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Apellido:
      </span>
    </div>
    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Email:
      </span>
    </div>
    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Género:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  name="gender" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Helpers::getGendersPerson() as $key => $val)
      <option value="{{ $key }}">{{ $val }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Tipo de Documentación:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  name="type_dni" required>
      @foreach(\App\Helpers::getTypesDocumentationPerson() as $key => $val)
      <option value="{{ $key }}">{{ $val }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Número DNI/LE/CI:
      </span>
    </div>
    <input class="form-control" type="text" name="dni" value="{{ old('dni') }}" required>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        CUIT:
      </span>
    </div>
    <input class="form-control input-type-number" type="text" name="cuit" value="{{ old('cuit') }}" maxlength="125" required>
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Fecha de Nacimiento:
      </span>
    </div>
    <input class="form-control datepicker" type="text" name="birthdate" value="{{ old('birthdate') }}">
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Pais:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  name="id_country" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Country::all() as $country)
      <option value="{{ $country->id }}">{{ $country->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Localidad:
      </span>
    </div>
    <input class="form-control" type="text" name="location" value="{{ old('location') }}" required>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Dirección:
      </span>
    </div>
    <input class="form-control" type="text" name="address" value="{{ old('address') }}" required>
  </div>

  <div class="input-group col-md-2 p-2">
    <input class="form-control input-type-number" type="text" name="address_number" value="{{ old('address_number') }}" placeholder="Número Dirección *" required>
  </div>

  <div class="input-group col-md-2 p-2">
    <input class="form-control" type="text" name="piso_depto" value="{{ old('piso_depto') }}" placeholder="Piso/Depto">
  </div>

  <div class="input-group col-md-2 p-2">
    <input class="form-control input-type-number" type="text" name="cp" value="{{ old('cp') }}" placeholder="Cp" required>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Nacionalidad:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  name="nationality" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Country::all() as $country)
      <option value="{{ $country->id }}">{{ $country->male.' / '.$country->female }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Visa/Otra Ciudadania?
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  data-style="btn btn-link" data-live-search="true" name="visa">
      <option value="0">No</option>
      <option value="1">Si</option>
    </select>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Nivel de Estudio:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  name="id_study" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Study::getAllStudy('1') as $study)
      <option value="{{ $study->id }}">{{ $study->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
          Obra Social / Prepaga:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true" name="social_work" onchange="frameJs.getChangeOs(this.value)">
      <option value="0">No</option>
      <option value="1">Si</option>
    </select>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2 hidden" id="social_work_name_content">
    <div class="input-group-prepend">
      <span class="input-group-text">
          Lista de O.S.
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true" name="social_work_name">
      <option value="">Seleccionar</option>
      @foreach(\App\Helpers::getListOs() as $key => $os)
        <option value="{{ $key }}">{{ $os }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6 p-2 hidden" id="social_work_code_content">
    <div class="input-group-prepend">
      <span class="input-group-text">
          Descripcion O.S.
      </span>
    </div>
    <div class="input-group col-md-6 p-2">
      <input class="form-control" type="text" name="social_work_code" value="{{ old('social_work_code') }}">
    </div>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Celular:
      </span>
    </div>
    <input class="form-control input-type-number" type="text" name="telephone" value="{{ old('telephone') }}" maxlength="125">
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Otro Teléfono:
      </span>
    </div>
    <input class="form-control input-type-number" type="text" name="other_telephone" value="{{ old('other_telephone') }}" maxlength="125">
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Estado Civil:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  name="civil_status" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Helpers::getCivilStatus() as $key => $val)
      <option value="{{ $key }}">{{ $val }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Rol a Desempeñar:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  name="id_function_frame[]" multiple required>
      @foreach(\App\FrameFunction::getAllFrameFunction('1') as $frame)
      <option value="{{ $frame->id }}">{{ $frame->name }}</option>
      @endforeach
    </select>
  </div>
</div>

<hr>

<h4 style="color: #495057;font-weight: normal;text-align: center;padding: 15px;">Datos Bancarios</h4>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Banco:
      </span>
    </div>
    <select class="selectpicker" data-style="btn btn-link" data-live-search="true"  name="bank" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Helpers::getListsBank() as $k => $v)
      <option value="{{ $k }}">{{ $v }}</option>
      @endforeach
    </select>
  </div>
  <div class="input-group col-md-6 p-2">
      <div class="input-group-prepend">
        <span class="input-group-text">
          CBU:
        </span>
      </div>
      <input class="form-control input-type-number" type="text" name="cbu" value="{{ old('cbu') }}" minlength="22" maxlength="22" required>
    </div>
</div>

<div class="form-group">
  <div class="input-group col-md-4 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Tipo de Cuenta:
      </span>
    </div>
    <input class="form-control" type="text" name="type_account" value="{{ old('type_account') }}" required>
  </div>
  <div class="input-group col-md-4 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        N* de Cuenta:
      </span>
    </div>
    <input class="form-control input-type-number" type="text" name="number_account" value="{{ old('number_account') }}" required>
  </div>
  <div class="input-group col-md-4 p-2">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Alias:
      </span>
    </div>
    <input class="form-control" type="text" name="alias_account" value="{{ old('alias_account') }}">
  </div>
</div>

<hr>

<div class="form-group">
  <div class="input-group col-md-6 p-2">
    <span class="input-group-text">
      <input class="form-control" type="checkbox" name="" style="margin-right: 10px; width: 15px;" required>
      Aceptar<a href="javascript:void(0)" class="hide-footer click-remove-wrapper-full-page" data-toggle="modal" data-target="#exampleModal" style="margin-left: 4px;">Terminos y Condiciones</a>
    </span>
  </div>
</div>

<input type="hidden" name="active" value="1">
<input type="hidden" name="referring" value="0">

@include('auth.card.tyc')
