function redondeo(numero)
{
  return numero.substr(0,2);
}

function getFormatNumber(number)
{
  let numberInt = number.toString().split('.');
  if(numberInt[1]){
    if(numberInt[0].length == 4) {
      return numberInt[0].substr(0, 1)+"."+numberInt[0].substr(-3)+","+redondeo(numberInt[1]);
    } else if(numberInt[0].length == 5){
      return numberInt[0].substr(0, 2)+"."+numberInt[0].substr(-3)+","+redondeo(numberInt[1]);
    } else if(numberInt[0].length == 6) {
      return numberInt[0].substr(0, 3)+"."+numberInt[0].substr(-3)+","+redondeo(numberInt[1]);
    } else {

      if (numberInt[1] == null){
        return numberInt[0]+",00";
      } else {
        return numberInt[0]+","+redondeo(numberInt[1]);
      }

    }
  } else {
    if(numberInt[0].length == 4) {
      return numberInt[0].substr(0, 1)+"."+numberInt[0].substr(-3)+",00";
    } else if(numberInt[0].length == 5){
      return numberInt[0].substr(0, 2)+"."+numberInt[0].substr(-3)+",00";
    } else if(numberInt[0].length == 6) {
      return numberInt[0].substr(0, 3)+"."+numberInt[0].substr(-3)+",00";
    } else {

      if (numberInt[1] == null){
        return numberInt[0]+",00";
      } else {
        return numberInt[0]+","+redondeo(numberInt[1]);
      }

    }
  }
}

function getContractProject(value)
{
  // id 4 = Servicios
  if(value == 4 || value == '4'){
    $('.field-afip').hide();
    $('.field-afip input').val('');
  } else {
    $('.field-afip').show();
  }
}

function getDatePickerFormat(value){
  let newDate = new Date(value);

  return newDate.getDate()+'/'+(newDate.getMonth()+1)+'/'+newDate.getFullYear();
}

function getTemplateTeam(idTeam, functionFrame, name, categorySat, dates, contract, statu, position, action)
{
  return (`<div class="col-md-4 d-flex" id="item_view_${idTeam}">
            <div class="card mb-3">
              <div class="card-header card-section-color">
                ${functionFrame}
              </div>
              <div class="card-body">
                <h4 class="card-title">${name}</h4>
                <p class="card-text mb-2">${categorySat}</p>
                <p class="card-text mb-2">Fechas: ${dates}</p>
                <p class="card-text mb-2">Contrato: ${contract}</p>
                <p class="card-text mb-2">Estado: ${statu}</p>
                <p class="card-text mb-2">Puesto: ${position}</p>
              </div>
              <div class="card-footer pt-0">
                <button type="button" class="btn btn-link btn-danger btn-just-icon remove" onClick="${action}" data-idcrew="${idTeam}" data-itemremove="item_view_${idTeam}" title='Eliminar'><i class='material-icons'>close</i></button>
              </div>
            </div>
          </div>`);
}

function setCardTeamIsset(idCard, function_frame, category_sat, dates, contract, active, puesto){
  $("#item_view_"+idCard+" .edit-text-function_frame").text(function_frame);
  $("#item_view_"+idCard+" .edit-text-category_sat").text(category_sat);
  $("#item_view_"+idCard+" .edit-text-dates").text(`Fechas: ${dates}`);
  $("#item_view_"+idCard+" .edit-text-contract").text(`Contrato: ${contract}`);
  $("#item_view_"+idCard+" .edit-text-active").text(`Estado: ${active}`);
  $("#item_view_"+idCard+" .edit-text-puesto").text(`Puesto: ${puesto}`);
}

function setEmptyFormTeam(){

  // si el proyecto ya esta activo, que se oculte el form content del team luego de editar
  $("#content-form-edit-team").addClass('hidden');

  // restart input add crew
  $(".empty-values-finish-add-crew input").val('');
  $("select[name=is_reemplazo]").val("1"); // Default Titular
  $("select[name=active]").val("0"); // Default Pendiente
  $("select[name=id_crew_reemplazo]").val("0"); // "Seleccionar..."
  $('input[name=crew_sueldo_diferencia]').removeAttr('style');
  $("select[name=is_reemplazo]").removeAttr('disabled');
  $("select[name=id_crew_reemplazo]").removeAttr('disabled');

  $("#add_crew").text("Agregar Team");
  $('.selectpicker').selectpicker('refresh');

  $('body,html').stop(true,true).animate({ scrollTop: $("#ancla_list_crew_view").offset().top },1000);

}

function getOptionTeam()
{

  let formSwal =
    `<div class="row">
    <label class="col-md-5 col-form-label text-right">Rol a Desempeñar:</label>
    <div class="col-md-5">
      <div class="form-group">
        <select class="form-control" data-style="btn btn-link" id="rol_hs_extra" name="rol_hs_extra" required>
          <option value="">Seleccionar</option>
        </select>
      </div>
    </div>
  </div>
    <div class="row">
      <label class="col-md-5 col-form-label text-right">Team:</label>
      <div class="col-md-5">
        <div class="form-group">
          <select class="form-control" data-style="btn btn-link" id="crew_hs_extra" name="crew_hs_extra[]" multiple required>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
        <label class="col-md-5 col-form-label text-right">Hora Inicio:</label>
        <div class="col-md-5">
          <div class="form-group">
            <select class="form-control" data-style="btn btn-link" id="inicio_hs_extra" name="inicio_hs_extra" required>
              <option value="">Seleccionar</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-5 col-form-label text-right">Hora Final:</label>
        <div class="col-md-5">
          <div class="form-group">
            <select class="form-control" data-style="btn btn-link" id="final_hs_extra" name="final_hs_extra" required>
              <option value="">Seleccionar</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-left">
          <ul>
            <li><i>El Dia el cual se agregaran las Horas Extras desde este Modulo, es el dia de Hoy.</i></li>
            <li><i>Si deseas agregar Horas Extras a otro dia, por favor dirijase a "Jornadas de Proyectos" que se encuentra en su Menu Izquierdo.</i></li>
          </ul>
        </div>
      </div>`;

  return formSwal;
}

function getTemplateHourExtras(){
  let formSwal = `<div class="table-responsive"><table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Rol a Desempeñar</th>
                            <th>Inicio (hs)</th>
                            <th>Final (hs)</th>
                            <th>Cantidad Total(hs)</th>
                            <th>Precio por Hora</th>
                        </tr>
                    </thead>
                    <tbody id="content-hour-extras">
                     </tbody>
                  </table></div>`;

  return formSwal;
}

$(document).ready(function(){

  // input validate
  let rules = {
        start_date: {
          required: true
        },
        finish_date: {
          required: true
        },
        name: {
          required: true
        },
        id_client: {
          required: true
        },
        id_proyect_category: {
          required: true
        }
  };
  // Initialise the wizard
  frameJs.initMaterialWizard(rules);

  setTimeout(function() {
    $('.card.card-wizard').addClass('active');
  }, 600);

  $('a').click(function(e){

    if(!$(this).hasClass('none-alert')){
      let parentForm = $(this).parents('form');
      if(parentForm.length != 1 || $(this).hasClass('back-history')){
        e.preventDefault();
        alertLeaveForm(this);
      }
    }

  });

  // add horas inicial y final
  // hay que reemplzar esto por Promesas JS
  $.each(frameJs.getTimeCalendar(), function(i, v){
    $('select[name=hour_initial]').append(`<option value="${v}">${v}</option>`);
    $('select[name=hour_end]').append(`<option value="${v}">${v}</option>`);
  });

  $("#add_crew").click(function(){

    // list values
    let id_function_frame = $('select[name=id_function_frame]').val(); // required
    let id_category_sat = $('select[name=id_category_sat]').val(); // required
    let id_provider = $('select[name=id_provider]').val(); // required
    let id_contract = $('select[name=id_contract]').val(); // required
    let start_date_contract = $('input[name=start_date_contract]').val(); // required
    let finish_date_contract = $('input[name=finish_date_contract]').val(); // required
    let id_workday = $('select[name=id_workday]').val(); // required
    let count_workdays_crew = $('input[name=count_workdays_crew]').val(); // required

    let hour_initial = $('select[name=hour_initial]').val();
    let hour_end = $('select[name=hour_end]').val();
    let start_afip = $('input[name=start_afip]').val();
    let finish_afip = $('input[name=finish_afip]').val();

    let salary_workdays = $('input[name=salary_workdays]').val(); // required
    let total_workdays = $('input[name=total_workdays]').val(); // required
    let total_workdays_text = $('input[name=total_workdays_text]').val(); // required
    let salary_contract_category_function = $('input[name=salary_contract_category_function]').val(); // required
    let salary_daily = $('input[name=salary_daily]').val(); // required
    let salary_liquidate = $('input[name=salary_liquidate]').val(); // required
    let salaty_difference = $('input[name=crew_sueldo_diferencia]').val(); // required
    let active = $('select[name=active]').val();
    let id_project_provider = $("input[name=id_project_provider]").val();

    // check is_reemplazo
    // puesto
    // 1 = Titular
    // 2 = Secundario
    let checkIsSuplente = $("select[name=is_reemplazo]").val();
    let idTeamSuplente = $("select[name=id_crew_reemplazo]").val();
    let nameTeamSuplente = $("select[name=id_crew_reemplazo]").find(':selected').text();

    if( id_function_frame && id_category_sat && id_provider &&
        id_contract && start_date_contract && finish_date_contract &&
        id_workday && count_workdays_crew && salary_workdays &&
        total_workdays && total_workdays_text && salary_contract_category_function &&
        salary_daily && salary_liquidate && salaty_difference)
    {

      // object crew
      let crew = {
        'id_function_frame': id_function_frame,
        'id_category_sat': id_category_sat,
        'id_provider': id_provider,
        'id_contract': id_contract,
        'start_date_contract': start_date_contract,
        'finish_date_contract': finish_date_contract,
        'id_workday': id_workday,
        'count_workdays_crew': count_workdays_crew,
        'hour_initial': hour_initial,
        'hour_end': hour_end,
        'start_afip': start_afip,
        'finish_afip': finish_afip,
        'salary_workdays': salary_workdays,
        'total_workdays': total_workdays,
        'total_workdays_text': total_workdays_text,
        'salary_contract_category_function': salary_contract_category_function,
        'salary_daily': salary_daily,
        'salary_liquidate': salary_liquidate,
        'salaty_difference': salaty_difference,
        'is_reemplazo': checkIsSuplente,
        'id_crew_reemplazo': idTeamSuplente,
        'id_project_provider': id_project_provider,
        'active': active
      };

      // verificar si el Team esta en otro proyecto en esas fechas

      // text value
      var crewNameText = $('select[name=id_provider] option:selected').text();
      let crewFunctionFrameText = $('select[name=id_function_frame] option:selected').text();
      let crewCategorySatText = $('select[name=id_category_sat] option:selected').text();
      let crewDatesText = start_date_contract+" - "+finish_date_contract;
      let contractText = $('select[name=id_contract] option:selected').text();
      let activeText = $('select[name=active] option:selected').text();

      // is Titular o Secundario
      if(checkIsSuplente == "1"){
        var textPuesto = "Titular";
      } else {
        var textPuesto = "Secundario de "+nameTeamSuplente;
      }

      let continueAddTeam = function(is_edit = false) {
        if(checkIsSuplente == "2" && idTeamSuplente != "0"){

          // add crew SECUNDARIO to list input request
          if($('#'+id_provider).length == 0){
            $('.list_crew').append(`<input type="hidden" name="list_crew_secundario[]" id="${id_provider}" value="" />`);
            $('#'+id_provider).val(JSON.stringify(crew));

          } else {

            // verifico que no pueda seleccionar un crew secundario que sea igual al titular
            if($('#'+id_provider).attr('name') != "list_crew[]"){
              $('#'+id_provider).val('');
              $('#'+id_provider).val(JSON.stringify(crew));
            } else {
              Swal.fire({
                title: 'No puedes Agregar un Team Secundario al mismo Team Titular!',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
              });
              return false;
            }

          }

        } else if(checkIsSuplente == "2" && idTeamSuplente == "0"){

          Swal.fire({
            title: 'Haz Seleccionado un Team Secundario. Por favor seleccione un Team en "Reemplazo del Team". Gracias!',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
          });
          return false;

        } else {
          // add crew TITULAR to list input request
          if($('#'+id_provider).length == 0){
            $('.list_crew').append(`<input type="hidden" name="list_crew[]" id="${id_provider}" value="" />`);
            $('#'+id_provider).val(JSON.stringify(crew));

          } else {
            $('#'+id_provider).val('');
            $('#'+id_provider).val(JSON.stringify(crew));
          }

        }

        if(!is_edit){
          // button to onClick add remove crew
          let onClickRemoveTeam = "$('#'+$(this).data('itemremove')).remove();$('#'+$(this).data('idcrew')).remove();";

          // add html list crew view
          $('.list_crew_view').append(getTemplateTeam(id_provider,crewFunctionFrameText, crewNameText, crewCategorySatText, crewDatesText, contractText, 'Pendiente', textPuesto, activeText, onClickRemoveTeam));
        }
        // una vez que haya aunque sea 1 CREW en la lista de Empleados, se habilita los INPUT de SUPLENTES
        // y AGREGO a la lista de "Reemplazo del Team" los crew agregados
        // TENER EN CUENTA SI SE BORRA EL CREW DEL PROYECTO, QUE SE BORRE DE ESTA LISTA TAMBIEN
        // Y SI EL TITULAR BORRADO TIENE UN SUPLENTE, QUE EL Suplente TAMBIEN SE ELIMINE
        if(checkIsSuplente == "1" && $("select[name=id_crew_reemplazo] option[value='"+id_provider+"']").length == 0){
          $("select[name=id_crew_reemplazo]").append("<option value='"+id_provider+"'>"+crewNameText+"</option>");
        }

      }

      if(id_project_provider && id_project_provider.length){
        setCardTeamIsset(id_provider, crewFunctionFrameText, crewCategorySatText, crewDatesText, contractText, activeText, textPuesto);
        continueAddTeam(true);
      } else {

        $.ajax({
          type: 'GET',
          url: '/sistema/json/check_crew_project/'+id_provider+'/'+start_date_contract.replace(/\//g, '-'),
          dataType: 'json',
          success: function(data){
            // add crew

            if(!data.status){

              var resultTeam = data.result;

              Swal.fire({
                type: 'warning',
                title: 'Ups!',
                html:
                `<p>El Team por agregar se encuentra Trabajando en otro Proyecto, en las Fechas seleccionadas!</p>
                <ul>
                  <li style="text-align: left;"><strong>Team:</strong> ${resultTeam.name}</li>
                  <li style="text-align: left;"><strong>Proyecto:</strong> ${resultTeam.project}</li>
                  <li style="text-align: left;"><strong>Fecha de Alta:</strong> ${resultTeam.initial}</li>
                  <li style="text-align: left;"><strong>Fecha de Baja:</strong> ${resultTeam.finished}</li>
                </ul>
                <p>Desea agregarlo de todas maneras?</p>
                `,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, continuar!'
              })
              .then((result) => {
                if(result.dismiss == "cancel"){
                  return false;
                }
                if(result.value){
                  continueAddTeam();
                }
              });
            } else {
              continueAddTeam();
            }

          },
          error: function(xhr, status){
            console.log('Error: '+xhr);
          }
        });
      }

      setEmptyFormTeam();
      $('.selectpicker').selectpicker('refresh');

    } else {
      Swal.fire({
        title: 'Complete los datos correspondientes para agregar un Team!',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      });
    }

  });

  // automatic calculate input
  $('input[name=total_workdays]').click(function(){
    if($('input[name=salary_workdays]').val() && $('input[name=count_workdays_crew]').val()){

      var salary_workdays = $('input[name=salary_workdays]').val();
      var count_workdays_crew = $('input[name=count_workdays_crew]').val();
      var total_workdays = (parseFloat(salary_workdays.replace(".", "").replace(",", ".")) * parseFloat(count_workdays_crew));

      $('input[name=total_workdays]').val(getFormatNumber(total_workdays));

      if($('input[name=salary_contract_category_function]').val()){

        var salary_contract_category_function = $('input[name=salary_contract_category_function]').val();
        var salary_contract_category_functionFinish = parseFloat(salary_contract_category_function.replace(".", "").replace(",", "."));
        var days = $('input[name=days_crew]').val();
        var salary_daily = (salary_contract_category_functionFinish / 30);
        var crew_sueldo_diferencia = getFormatNumber( total_workdays -  (salary_daily * parseFloat(count_workdays_crew)) );

        $('input[name=salary_daily]').val(getFormatNumber(salary_daily));
        $('input[name=salary_liquidate]').val(getFormatNumber(parseFloat(days) * salary_daily));
        $('input[name=crew_sueldo_diferencia]').val(crew_sueldo_diferencia);

        // Si crew_sueldo_diferencia es negativo or positivo backgroundColor
        $('input[name=crew_sueldo_diferencia]').removeAttr('style');

        if(parseFloat( $('input[name=crew_sueldo_diferencia]').val() ) > 0){
          $('input[name=crew_sueldo_diferencia]').css({backgroundColor: "green", color: "white"});
        } else {
          $('input[name=crew_sueldo_diferencia]').css({backgroundColor: "red", color: "white"});
        }

      } else {
        Swal.fire({
          title: 'Seleccione una Categoria SAT, para que se autocomplete los campos de Sueldos!',
          type: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar'
        });
      }

    } else {
      Swal.fire({
        title: 'Ingrese un Valor en Cantidad de Jornadas Laborables y Sueldo Jornada, para que se autocomplete el campo seleccionado!',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      });
    }
  });

  $('input[name=salary_contract_category_function]').click(function(){
    if($('input[name=salary_contract_category_function]').val() == "" ){
      Swal.fire({
        title: 'Seleccione una Categoria SAT, para que se autocomplete los campos de Sueldos!',
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      });
    };
  });

  $(".get_value_categories_sat").change(function(){
    var salaryneto = $(this).find(':selected').data('salaryneto');
    if(salaryneto){
      $('input[name=salary_contract_category_function]').val(salaryneto);
    }
  });

  // Edit -> remove by ajax crew list on project
  $(".alert-confirm-delete-button").click(function() {

    const form = $(this).data('id');
    const idProvider = $(this).data('idprovider');

    // se genera un alert de confirmacion para abandonar el Formulario
    Swal.fire({
      title: '¿Estás seguro que quieres Eliminar el Elemento Seleccionado?',
      text: "",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, continuar!'
    })
    .then((result) => {
      if(result.dismiss == "cancel"){
        return false;
      }
      if(result.value){

        $.ajax({
          url: $("#"+form).attr('action'),
          data: {_method: 'DELETE', _token: $('meta[name="csrf-token"]').attr('content')},
  			  type: 'POST'
        })
        .done(function(data) {
    			$("#item_view_"+idProvider).remove();
          Swal.fire(
            data.message,
            '',
            'success'
          );
        })
        .fail(function(xhr) {
          console.log(xhr);
  			});

      }
    })

  });

  // open window edit crew
  $(".openWindowUrl").click(function(){
    var url = $(this).data('url');
    var width = ( $(this).data('width') != null ? $(this).data('width') : 450 );

    openWindowUrl(url, width);
  });

  $('.show-content-observation').click(function(e){

    e.preventDefault();

    Swal.fire({
      'title': 'Observaciones',
      input: 'textarea',
      inputValue: $('textarea[name=observations]').val(),
      showCancelButton: true
    })
    .then((result) => {
      if(result.dismiss == "cancel"){
        return false;
      }

      $('textarea[name=observations]').val(result.value);
      $('#logic_project').submit();
    });

  });

  // edit team
  $('.project-team-edit').click(function(){

    $("#content-form-edit-team").removeClass('hidden');

    $('body,html').stop(true,true).animate({ scrollTop: $("#module_two").offset().top },1000);

    let id = $(this).data('id');
    let categorySat = $(this).data('category');
    let nameTeam = $(this).data('nameteam');

    $.each(listTeams, function(i, v){
      if(v.id == id){
        // list field by form
        $("#add_crew").text("Editar Team");

        // add id to input
        $("input[name=id_project_provider]").val(v.id);

        //select id_function_frame. Each Funcion Frame
        $.each($('select[name=id_function_frame] option'), function(ind,val){
          let valOption = $(val).attr('value');
          if(valOption == v.id_function_frame){
            $(val).prop('selected', true);
          }
        });

        // category sat
        $('select[name=id_category_sat]').empty();
        $('select[name=id_category_sat]').append(`<option value="${v.id_category_sat}" selected="selected">${categorySat}</option>`);

        // team
        $('select[name=id_provider]').empty();
        $('select[name=id_provider]').append(`<option value="${v.id_provider}" selected="selected">${nameTeam}</option>`);

        // type contract
        $.each($('select[name=id_contract] option'), function(ind,val){
          let valOption = $(val).attr('value');
          if(valOption == v.id_contract){
            $(val).prop('selected', true);
          }
        });

        // si es contrato servicio, oculto dates afip
        getContractProject(v.id_contract);

        // start_date_contract
        $('input[name=start_date_contract]').val(getDatePickerFormat(v.start_date_contract));

        // finish_date_contract
        $('input[name=finish_date_contract]').val(getDatePickerFormat(v.finish_date_contract));

        // modalidad
        $.each($('select[name=id_workday] option'), function(ind,val){
          let valOption = $(val).attr('value');
          if(valOption == v.id_workday){
            $(val).prop('selected', true);
          }
        });

        // cant jornadas
        $('input[name="count_workdays_crew"]').val(v.count_workdays_crew);

        // hour init
        $.each($('select[name=hour_initial] option'), function(ind,val){
          let valOption = $(val).attr('value');
          if(valOption == v.hour_initial){
            $(val).prop('selected', true);
          }
        });

        // hour finished
        $.each($('select[name=hour_end] option'), function(ind,val){
          let valOption = $(val).attr('value');
          if(valOption == v.hour_end){
            $(val).prop('selected', true);
          }
        });

        // start_afip
        $('input[name=start_afip]').val(getDatePickerFormat(v.start_afip));

        // finish_afip
        $('input[name=finish_afip]').val(getDatePickerFormat(v.finish_afip));

        // salary_workdays
        $('input[name="salary_workdays"]').val(v.salary_workdays);

        // total_workdays
        $('input[name="total_workdays"]').val(v.total_workdays);

        // total_workdays_text
        $('input[name="total_workdays_text"]').val(v.total_workdays_text);

        // salary_contract_category_function
        $('input[name="salary_contract_category_function"]').val(v.salary_contract_category_function);

        // salary_daily
        $('input[name="salary_daily"]').val(v.salary_daily);

        // crew_sueldo_diferencia
        $('input[name="crew_sueldo_diferencia"]').val(v.salaty_difference);

        // salary_liquidate
        $('input[name="salary_liquidate"]').val(v.salary_liquidate);

        // hour init
        $.each($('select[name=active] option'), function(ind,val){
          let valOption = $(val).attr('value');
          if(valOption == v.active){
            $(val).prop('selected', true);
          }
        });

        // falta chequear si el user es secundario


        $('.selectpicker').selectpicker('refresh');
        return false;
      }
    });

  });

  // hour extras
  $(".add-hour-extras").click(function(){

    swal({
      title: "Agregar horas extra",
      html: getOptionTeam(),
      showCancelButton: !0,
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: !1,
      onBeforeOpen: () => {

        let id_project_provider = $(this).data('id');
        let nameteam = $(this).data('nameteam');

        // add 'rol a desempeñar' funciones frame
        $.ajax({
          type: 'GET',
          url: '/sistema/json/get_function_frame',
          success: function(data){
            if(data.results){
              $.each(data.results, function(i, v){
                $("#rol_hs_extra").append(`<option value="${v.id}">${v.name}</option>`);
              });
            }
          },
          error: function(xhr, status){
            console.log('Error: '+xhr);
          }
        });

        $("#crew_hs_extra").append(`<option value="${id_project_provider}" selected>${nameteam}</option>`);


        $.each(frameJs.getTimeCalendar(), function(i, v){
           $("#inicio_hs_extra").append(`<option value="${v}">${v}</option>`);
        });

        $.each(frameJs.getTimeCalendar(), function(i, v){
           $("#final_hs_extra").append(`<option value="${v}">${v}</option>`);
        });
      }
    })
    .then(function(data){

      if(data.value){
        // ajax SAVE horas extras

        let crew = $("#crew_hs_extra").val();
        let start = $("#inicio_hs_extra").find(':selected').val().split(':');
        let finish = $("#final_hs_extra").find(':selected').val().split(':');
        let rol = $("#rol_hs_extra").find(':selected').val();

        var dateStart = new Date();
        var dateFinish = new Date();

        if(start != '' && finish != '' && rol != ''){

          dateStart.setHours(parseFloat(start[0]),parseFloat(start[1]));
          dateFinish.setHours(parseFloat(finish[0]),parseFloat(finish[1]));

          let extraHours = {
            crew: crew,
            rol: rol,
            start: dateStart,
            finish: dateFinish
          }

          $.ajax({
            type: 'GET',
            url: '/sistema/json/project_providers/extra_hours',
            data: extraHours,
            success: function(data){
              if(data.status){
                // swal ALERT que las horas extras se cargo con exito
                Swal.fire({
                  title: 'Horas Extras ingresadas con Exito!',
                  type: 'info',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar'
                });
              }
            },
            error: function(xhr, status){
              console.log('Error: '+xhr);
            }
          });

        } else {
          Swal.fire({
            title: 'Para Agregar horas extras a un Team debes completar los datos mencionados en el Formulario! Gracias.',
            type: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
          })
        }

      }

    })
    .catch(swal.noop)
  });

  $(".show-hour-extras").click(function(){

    let id = $(this).data('id');
    let nameTeam = $(this).data('nameteam');
    $.ajax({
      type: 'GET',
      url: '/sistema/project_providers/'+id,
      success: function(data){

        function parseDate(date){
          return ("0" + (date)).slice(-2);
        }

        function timeConvert(n) {
          var num = n;
          var hours = (num / 60);
          var rhours = Math.floor(hours);
          var minutes = (hours - rhours) * 60;
          var rminutes = Math.round(minutes);
          return rhours + " hora(s) y " + rminutes + " minuto(s).";
        }

        function getHourMinParse(n) {
          var num = n;
          var hours = (num / 60);
          var rhours = Math.floor(hours);
          var minutes = (hours - rhours) * 60;
          var rminutes = Math.round(minutes);

          return rhours+'.'+minutes;
        }

        if(data.results){

          swal({
            title: `${nameTeam} : Horas Extras`,
            html: getTemplateHourExtras(),
            confirmButtonClass: "btn btn-success",
            showCancelButton: false,
            customClass: 'swal-wide',
            buttonsStyling: !1,
            onBeforeOpen: () => {
              $.each(data.results, function(i,v){
                var start = new Date(v.start);
                var finish = new Date(v.finish);
                var day = start.getFullYear();
                var countHour = ((finish - start) / 60000);
                var price = ( (parseFloat(data.salary.replace(".", "").replace(",", ".")) / getHourMinParse(countHour) ) * 1.5);

                $("#content-hour-extras").append("<tr> "+
                                  "<td>"+parseDate(start.getDay())+'-'+parseDate(start.getMonth())+'-'+start.getFullYear()+"</td>"+
                                  "<td>"+v.rol+"</td>"+
                                  "<td>"+parseDate(start.getHours())+':'+parseDate(start.getMinutes())+"</td>"+
                                  "<td>"+parseDate(finish.getHours())+':'+parseDate(finish.getMinutes())+"</td>"+
                                  "<td>"+timeConvert(countHour)+"</td>"+
                                  "<td>$"+getFormatNumber(price)+"</td>"+
                              "</tr>");
              });

            }
          });
        }
      },
      error: function(xhr, status){
        Swal.fire({
          title: 'NO se encontraron Horas Extras!',
          type: 'info',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar'
        })
        console.log('Error: '+xhr);
      }
    });
  });
});
