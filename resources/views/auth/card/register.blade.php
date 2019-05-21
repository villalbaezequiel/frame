<div class="form-group">
  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Nombre:
      </span>
    </div>
    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
  </div>

  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Apellido:
      </span>
    </div>
    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Email:
      </span>
    </div>
    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
  </div>

  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Género:
      </span>
    </div>
    <select class="custom-select" name="gender" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Helpers::getGendersPerson() as $key => $val)
      <option value="{{ $key }}">{{ $val }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Tipo de Documentación:
      </span>
    </div>
    <select class="custom-select" name="type_dni" required>
      @foreach(\App\Helpers::getTypesDocumentationPerson() as $key => $val)
      <option value="{{ $key }}">{{ $val }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Número DNI/LE/CI:
      </span>
    </div>
    <input class="form-control" type="text" name="dni" value="{{ old('dni') }}" required>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-lg-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        CUIT:
      </span>
    </div>
    <input class="form-control" type="number" name="cuit" value="{{ old('cuit') }}" maxlength="125" required>
  </div>

  <div class="input-group col-lg-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Fecha de Nacimiento:
      </span>
    </div>
    <input class="form-control datepicker" type="text" name="birthdate" value="{{ old('birthdate') }}">
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Pais:
      </span>
    </div>
    <select class="custom-select" name="id_country" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Country::all() as $country)
      <option value="{{ $country->id }}">{{ $country->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Nacionalidad:
      </span>
    </div>
    <select class="custom-select" name="nationality" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Country::all() as $country)
      <option value="{{ $country->id }}">{{ $country->male.' / '.$country->female }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Dirección:
      </span>
    </div>
    <input class="form-control" type="text" name="address" value="{{ old('address') }}" required>
  </div>

  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Número Dirección:
      </span>
    </div>
    <input class="form-control" type="number" name="address_number" value="{{ old('address_number') }}" required>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Localidad:
      </span>
    </div>
    <input class="form-control" type="text" name="location" value="{{ old('location') }}" required>
  </div>

  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        CP:
      </span>
    </div>
    <input class="form-control" type="number" name="cp" value="{{ old('cp') }}" required>
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Nivel de Estudio:
      </span>
    </div>
    <select class="custom-select" name="id_study" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Study::getAllStudy('1') as $study)
      <option value="{{ $study->id }}">{{ $study->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-4">
    <div class="input-group-prepend">
      <span class="input-group-text">
          Obra Social / Prepaga:
      </span>
    </div>
    <select class="custom-select" name="social_work" onchange="frameJs.getChangeOs(this.value)">
      <option value="0">No</option>
      <option value="1">Si</option>
    </select>
  </div>
  <div class="input-group col-md-2 hidden" id="social_work_code_content">
    <input class="form-control" type="number" name="social_work_code" value="{{ old('social_work_code') }}" placeholder="Codigo">
  </div>
</div>

<div class="form-group">
  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Teléfono:
      </span>
    </div>
    <input class="form-control" type="number" name="telephone" value="{{ old('telephone') }}" maxlength="125">
  </div>

  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Otro Teléfono:
      </span>
    </div>
    <input class="form-control" type="number" name="other_telephone" value="{{ old('other_telephone') }}" maxlength="125">
  </div>
</div>

<div class="form-group">
  <div class="input-group col-lg-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Estado Civil:
      </span>
    </div>
    <select class="custom-select" name="civil_status" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Helpers::getCivilStatus() as $key => $val)
      <option value="{{ $key }}">{{ $val }}</option>
      @endforeach
    </select>
  </div>

  <div class="input-group col-md-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Función según Frame:
      </span>
    </div>
    <select class="custom-select" name="id_function_frame[]" multiple required>
      @foreach(\App\FrameFunction::getAllFrameFunction('1') as $frame)
      <option value="{{ $frame->id }}">{{ $frame->name }}</option>
      @endforeach
    </select>
  </div>
</div>

<hr>

<h4 style="color: #495057;font-weight: normal;text-align: center;padding: 15px;">Datos Bancarios</h4>

<div class="form-group">
  <div class="input-group col-lg-6">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Banco:
      </span>
    </div>
    <select class="custom-select" name="bank" required>
      <option value="">Seleccionar</option>
      @foreach(\App\Helpers::getListsBank() as $k => $v)
      <option value="{{ $k }}">{{ $v }}</option>
      @endforeach
    </select>
  </div>
  <div class="input-group col-md-6">
      <div class="input-group-prepend">
        <span class="input-group-text">
          CBU:
        </span>
      </div>
      <input class="form-control" type="number" name="cbu" value="{{ old('cbu') }}" step="1" min="999999999999999999999" max="9999999999999999999999" required>
    </div>
</div>

<div class="form-group">
  <div class="input-group col-lg-4">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Tipo de Cuenta:
      </span>
    </div>
    <input class="form-control" type="text" name="type_account" value="{{ old('type_account') }}" required>
  </div>
  <div class="input-group col-md-4">
    <div class="input-group-prepend">
      <span class="input-group-text">
        N* de Cuenta:
      </span>
    </div>
    <input class="form-control" type="number" name="number_account" value="{{ old('number_account') }}" step="1" required>
  </div>
  <div class="input-group col-lg-4">
    <div class="input-group-prepend">
      <span class="input-group-text">
        Alias:
      </span>
    </div>
    <input class="form-control" type="text" name="alias_account" value="{{ old('alias_account') }}" required>
  </div>
</div>

<hr>

<div class="form-group">
  <div class="input-group col-md-6">
    <span class="input-group-text">
      <input class="form-control" type="checkbox" name="" style="margin-right: 10px;" required>
      Aceptar<a href="#" style="margin-left: 4px;">Terminos y Condiciones</a>
    </span>
  </div>
</div>

<input type="hidden" name="active" value="1">
<input type="hidden" name="referring" value="0">
