@extends('layouts.admin')

@section('title', "Proveedores / Nuevo")

@section('content')
<div class="container-fluid">
  <div class="col-md-12 col-12 mr-auto ml-auto">

    <!--      Wizard container        -->
    <div class="wizard-container">
      <div class="card card-wizard active" data-color="purple" id="wizardProfile">

        {!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
          <div class="card-header text-center">
            <h3 class="card-title">
              Nuevo Proyecto
            </h3>
            <!-- <h5 class="card-description">Pequeña descripcion</h5> -->
          </div>
          <div class="wizard-navigation">
            <ul class="nav nav-pills">
              <li class="nav-item" style="width: 33.3333%;">
                <a class="nav-link active" href="#module_one" data-toggle="tab" role="tab">
                  Módulo 1
                </a>
              </li>
              <li class="nav-item" style="width: 33.3333%;">
                <a class="nav-link" href="#module_two" data-toggle="tab" role="tab">
                  Módulo 2
                </a>
              </li>
              <li class="nav-item" style="width: 33.3333%;">
                <a class="nav-link" href="#module_three" data-toggle="tab" role="tab">
                  Módulo 3
                </a>
              </li>
            </ul>
            <div class="moving-tab" style="width: 189.109px; transform: translate3d(-8px, 0px, 0px); transition: transform 0s ease 0s;">
              Módulo 1
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <div class="tab-pane active" id="module_one">
                <h5 class="info-text"> Información General </h5>
                <div class="row justify-content-center">

                  <div class="col-md-10">
                    <div class="form-group">
                      <label for="exampleInput1" class="bmd-label-floating">First Name (required)</label>
                      <input class="form-control" type="text" name="name" value="{{ old('name') }}" maxlength="125">
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane" id="module_two">
                <h5 class="info-text"> Fechas </h5>
                <div class="row justify-content-center">
                  <div class="col-lg-10">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="choice" data-toggle="wizard-checkbox">
                          <input type="checkbox" name="jobb" value="Design">
                          <div class="icon">
                            <i class="fa fa-pencil"></i>
                          </div>
                          <h6>Design</h6>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="choice" data-toggle="wizard-checkbox">
                          <input type="checkbox" name="jobb" value="Code">
                          <div class="icon">
                            <i class="fa fa-terminal"></i>
                          </div>
                          <h6>Code</h6>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="choice" data-toggle="wizard-checkbox">
                          <input type="checkbox" name="jobb" value="Develop">
                          <div class="icon">
                            <i class="fa fa-laptop"></i>
                          </div>
                          <h6>Develop</h6>
                        </div>
                        <div class="dropdown bootstrap-select"><select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" tabindex="-98"><option class="bs-title-option" value=""></option>
                          <option disabled="" selected="">Choose city</option>
                          <option value="2">Foobar</option>
                          <option value="3">Is great</option>
                        </select><button type="button" class="dropdown-toggle btn btn-primary btn-round" data-toggle="dropdown" role="button" title="Choose city"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Choose city</div></div> </div></button><div class="dropdown-menu " role="combobox"><div class="inner show" role="listbox" aria-expanded="false" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="module_three">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <h5 class="info-text"> Proveedores </h5>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <label class="bmd-label-static">Street Name</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="bmd-label-static">Street No.</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label class="bmd-label-static">City</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group select-wizard">
                      <label>Country</label>
                      <div class="dropdown bootstrap-select"><select class="selectpicker" data-size="7" data-style="select-with-transition" title="Single Select" tabindex="-98"><option class="bs-title-option" value=""></option>
                        <option value="Afghanistan"> Afghanistan </option>
                        <option value="Albania"> Albania </option>
                        <option value="Algeria"> Algeria </option>
                        <option value="American Samoa"> American Samoa </option>
                        <option value="Andorra"> Andorra </option>
                        <option value="Angola"> Angola </option>
                        <option value="Anguilla"> Anguilla </option>
                        <option value="Antarctica"> Antarctica </option>
                      </select><button type="button" class="btn dropdown-toggle bs-placeholder select-with-transition" data-toggle="dropdown" role="button" title="Single Select"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Single Select</div></div> </div></button><div class="dropdown-menu " role="combobox"><div class="inner show" role="listbox" aria-expanded="false" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="mr-auto">
              <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Anterior">
            </div>
            <div class="ml-auto">
              <input type="button" class="btn btn-next btn-fill btn-primary btn-wd" name="next" value="Siguiente">
              <input type="submit" class="btn btn-finish btn-fill btn-primary btn-wd" name="finish" value="Crear" style="display: none;" />
            </div>
            <div class="clearfix"></div>
          </div>
        {!! Form::close() !!}

      </div>
    </div>
    <!-- wizard container -->

  </div>
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){

  // input validate
  var rules = {
      // name: {
      //     required: true,
      //     minlength: 3
      // },
      // lastname: {
      //     required: true,
      //     minlength: 3
      // },
      // email: {
      //     required: true,
      //     minlength: 3,
      // }
  };

  // Initialise the wizard
  frameJs.initMaterialWizard(rules);

  setTimeout(function() {
    $('.card.card-wizard').addClass('active');
  }, 600);
});
</script>
@endsection
