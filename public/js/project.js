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
  if(value == 4 || value == '4')
  {
    if($('.field-afip') && $('.field-afip').length > 0) {
      $('.field-afip').hide();
      $('.field-afip input').val('');  
    }
    // show dates secure contract
    $('.fields-secure').show();

  } else {
    if($('.field-afip') && $('.field-afip').length > 0) {
      $('.field-afip').show();
    }
    // hide dates secure contract
    $('.fields-secure').hide();
    $('.fields-secure input').val('');

  }
}

function getDatePickerFormat(value, day = false){

  let days =["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
  let newDate = new Date(value);

  if(day){
    return days[newDate.getUTCDay()]+' '+newDate.getDate()+'/'+(newDate.getMonth()+1)+'/'+newDate.getFullYear();

  } else {
    return newDate.getDate()+'/'+(newDate.getMonth()+1)+'/'+newDate.getFullYear();
  }

}

function getTemplateTeam(idTeam, functionFrame, name, categorySat, dates, contract, statu, position, action, total_workdays)
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
                <p class="card-text mb-2">Sueldo en Mano: ${total_workdays}</p>
                <p class="card-text mb-2">Estado: ${statu}</p>
                <p class="card-text mb-2">Puesto: ${position}</p>
              </div>
              <div class="card-footer pt-0">
                <button type="button" class="btn btn-link btn-danger btn-just-icon remove" onClick="${action}" data-idcrew="${idTeam}" data-itemremove="item_view_${idTeam}" title='Eliminar'><i class='material-icons'>close</i></button>
              </div>
            </div>
          </div>`);
}


function convertDateYYMMDD(date, separator = '/', separatorConvert = '-')
{
  let parse = date.split(separator);

  return parse[2]+'-'+parse[1]+'-'+parse[0];
}

function setCardTeamIsset(idCard, function_frame, category_sat, dates, contract, active, puesto, total_workdays){
  $("#item_view_"+idCard+" .edit-text-function_frame").text(function_frame);
  $("#item_view_"+idCard+" .edit-text-category_sat").text(category_sat);
  $("#item_view_"+idCard+" .edit-text-dates").text(`Fechas: ${dates}`);
  $("#item_view_"+idCard+" .edit-text-contract").text(`Contrato: ${contract}`);
  $("#item_view_"+idCard+" .edit-text-total_workdays").text(`Sueldo en Mano: ${total_workdays}`);
  $("#item_view_"+idCard+" .edit-text-active").text(`Estado: ${active}`);
  $("#item_view_"+idCard+" .edit-text-puesto").text(`Puesto: ${puesto}`);
}

function setEmptyFormTeam(){
  // restart input add crew
  $(".empty-values-finish-add-crew input").val('');
  $("select[name=is_reemplazo]").val("1"); // Default Titular
  $("select[name=active]").val("0"); // Default Pendiente
  $("select[name=id_crew_reemplazo]").val("0"); // "Seleccionar..."
  $("select[name=id_function_frame]").val(""); // "Seleccionar..."
  $("select[name=id_category_sat]").empty().append('<option value="">Seleccionar</option>'); // "Seleccionar..."
  $("select[name=id_provider]").empty().append('<option value="">Seleccionar</option>'); // "Seleccionar..."
  $("select[name=id_contract]").val(""); // "Seleccionar..."
  $("select[name=id_workday]").val(""); // "Seleccionar..."
  $("select[name=hour_initial]").val("00:00"); // 00.00
  $("select[name=hour_end]").val("00:00"); // 00.00
  $('input[name=crew_sueldo_diferencia]').removeAttr('style'); // elimino el backgroud del sueldo diferencia

  // una vez que ya agrego un Team al PROYECTO, se habilita las OPCIONES de titular Y suplente
  // y para seleccionar un TEAM cargado si es SUPLENTE
  $("select[name=is_reemplazo]").removeAttr('disabled');
  $("select[name=id_crew_reemplazo]").removeAttr('disabled');

  $("#add_crew").text("Agregar Team");
  $("#is_edit").val("0");


  // default sueldo bruto show y sueldo neto hidden
  $('input[name="salary_contract_bruto_category_function"]').attr('type', 'text');
  $('input[name="salary_contract_category_function"]').attr('type', 'hidden');
  $(".sueldo_contrato_team").text("Sueldo Contrato Bruto");

  // section EDIT
  // si el proyecto ya esta activo, que se oculte el form content del team luego de editar
  $("#content-form-edit-team").addClass('hidden');
  $(".button-show-form-team").removeClass('hidden');

  $('body,html').stop(true,true).animate({ scrollTop: $("#ancla_list_crew_view").offset().top },1000);

  // udpate all select by selectpicker
  $('.selectpicker').selectpicker('refresh');
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
                            <th>Rol</th>
                            <th>Inicio (hs)</th>
                            <th>Final (hs)</th>
                            <th>Pactadas (hs)</th>
                            <th>Extras (hs)</th>
                            <th>Valor</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="content-hour-extras">
                     </tbody>
                  </table></div>
                  <div class="row">
                    <div class="col-md-12">
                    <form id="form_hs_extras" action="/sistema/export/horas_extras" target="_blank" method="post">
                    <input type="hidden" name="_token" value="">
                        <input type="hidden" name="name_team" value="">
                        <input type="hidden" name="hs_extras" value="">
                        <input type="hidden" name="id_project_provider" value="">
                        <input type="submit" class="btn btn-primary" value="Exportar Horas Extras">
                      </form>
                    </div>
                  </div>`;

  return formSwal;
}

function getTemplateAbsences(){
  let formSwal = `<div class="table-responsive"><table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Asunto</th>
                            <th>Nota</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="content-absences">
                     </tbody>
                  </table></div>
                  <div class="row">
                    <div class="col-md-12">
                    <form id="form_absences" action="/sistema/export/absences" target="_blank" method="post">
                    <input type="hidden" name="_token" value="">
                        <input type="hidden" name="name_team" value="">
                        <input type="hidden" name="absences" value="">
                        <input type="hidden" name="id_project_provider" value="">
                        <input type="submit" class="btn btn-primary" value="Exportar Ausencias">
                      </form>
                    </div>
                  </div>`;

  return formSwal;
}

function removeDumplicateValue(myArray)
{
  var newArray = [];
  $.each(myArray, function(key, value) {
    var exists = false;

    $.each(newArray, function(k, val2) {
      if(value.id == val2.id){ exists = true };
    });
    if(exists == false && value.id != "") { newArray.push(value); }
  });

  return newArray;
}

function showGroupTeams(element){
  let showTeams = $(element).data('group');
  let idProvider = $(element).data('idprovider');

  // toggle cards != the cards teams this click
  $.each($('.group-more-team'), function(){
    if($(this).data('idprovider') != idProvider && !$(this).hasClass('group-yes')){

      if(!$(this).data('toggleteams') || $(this).data('toggleteams') != idProvider){
        $(this).toggleClass('d-flex').toggle();
      }

    }
  });

  // scroll top
  $('body,html').stop(true,true).animate({ scrollTop: $("#module_two").offset().top },1000);

  // toggle cards teams this click
  $('.content-group-'+showTeams).toggleClass('d-flex').toggle('slow');
  $(element).find('span').toggle('slow');

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
    let mode_workday = $('select[name=id_workday] option:selected').data('mode');
    let count_workdays_crew = $('input[name=count_workdays_crew]').val(); // required

    let hour_initial = $('select[name=hour_initial]').val();
    let hour_end = $('select[name=hour_end]').val();
    let start_afip = $('input[name=start_afip]').val();
    let finish_afip = $('input[name=finish_afip]').val();
    let start_date_secure_contract = $('input[name=start_date_secure_contract]').val();
    let end_date_secure_contract = $('input[name=end_date_secure_contract]').val();

    let salary_workdays = $('input[name=salary_workdays]').val(); // required
    let total_workdays = $('input[name=total_workdays]').val(); // required
    let total_workdays_text = $('input[name=total_workdays_text]').val(); // required
    let salary_contract_bruto_category_function = $('input[name=salary_contract_bruto_category_function]').val(); // required
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
        id_workday && count_workdays_crew && hour_initial &&
        hour_end && salary_workdays && total_workdays &&
        total_workdays_text && salary_contract_category_function &&
        salary_daily && salary_liquidate && salaty_difference)
    {

      // validate workday mode
      let startDateContract = moment(convertDateYYMMDD(start_date_contract));
      let endDateContract = moment(convertDateYYMMDD(finish_date_contract));

      let diffDatesContract = endDateContract.diff(startDateContract, 'days');

      if(mode_workday == 'week-5'){
        if(diffDatesContract != 4)
        {
          Swal.fire({
            title: 'Haz seleccionado la Modalidad Semana por 5 dias. Por favor corrija las fechas de Contrato para que coincidan con los Dias mencionados!',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
          });

          return false;
        }
      }

      if(mode_workday == 'week-7'){
        if(diffDatesContract != 6)
        {
          Swal.fire({
            title: 'Haz seleccionado la Modalidad Semana por 7 dias. Por favor corrija las fechas de Contrato para que coincidan con los Dias mencionados!',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
          });

          return false;
        }
      }

      // object crew
      let crew = {
        'id_function_frame': id_function_frame,
        'id_category_sat': id_category_sat,
        'id_provider': id_provider,
        'id_contract': id_contract,
        'start_date_contract': start_date_contract,
        'finish_date_contract': finish_date_contract,
        'id_workday': id_workday,
        'mode_workday': mode_workday,
        'count_workdays_crew': count_workdays_crew,
        'hour_initial': hour_initial,
        'hour_end': hour_end,
        'start_afip': start_afip,
        'finish_afip': finish_afip,
        'start_date_secure_contract': start_date_secure_contract,
        'end_date_secure_contract': end_date_secure_contract,
        'salary_workdays': salary_workdays,
        'total_workdays': total_workdays,
        'total_workdays_text': total_workdays_text,
        'salary_contract_bruto_category_function': salary_contract_bruto_category_function,
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
          if($('.list_crew > #'+id_provider).length == 0){
             $('.list_crew').append(`<input type="hidden" name="list_crew_secundario[]" id="${id_provider}" value="" />`);
             $('.list_crew > #'+id_provider).val(JSON.stringify(crew));

          } else {

            // verifico que no pueda seleccionar un crew secundario que sea igual al titular
            if($('.list_crew > #'+id_provider).attr('name') != "list_crew[]"){
               $('.list_crew > #'+id_provider).val('');
               $('.list_crew > #'+id_provider).val(JSON.stringify(crew));
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
          if($('.list_crew > #'+id_provider).length == 0){
            $('.list_crew').append(`<input type="hidden" name="list_crew[]" id="${id_provider}" value="" />`);
            $('.list_crew > #'+id_provider).val(JSON.stringify(crew));

          } else {
            $('.list_crew > #'+id_provider).val('');
            $('.list_crew > #'+id_provider).val(JSON.stringify(crew));
          }

        }

        if(!is_edit){
          // button to onClick add remove crew
          let onClickRemoveTeam = "$('#'+$(this).data('itemremove')).remove();$('#'+$(this).data('idcrew')).remove();";

          // add html list crew view
          $('.list_crew_view').append(getTemplateTeam(id_provider,crewFunctionFrameText, crewNameText, crewCategorySatText, crewDatesText, contractText, activeText, textPuesto, onClickRemoveTeam, '$'+total_workdays));
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
        setCardTeamIsset(id_provider, crewFunctionFrameText, crewCategorySatText, crewDatesText, contractText, activeText, textPuesto, '$'+total_workdays);
        continueAddTeam(true);

        // edit by ajax
        let teamEdit = $('.list_crew > #'+id_provider).val();

        $.ajax({
          type: 'POST',
          url: '/sistema/json/edit_team_project',
          data: { data: teamEdit },
          success: function(data){
            if(data.status){
              Swal.fire({
                title: 'Team editado con exito!',
                type: 'info',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
              });
            } else {
              Swal.fire({
                title: 'Error al editar Team!',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
              });
            }
          },
          error: function(xhr, status){
            console.log('Error: '+xhr);
            Swal.fire({
              title: 'Error al editar Team!',
              type: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Aceptar'
            });
          }
        });



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

    // update all select
    $('.selectpicker').selectpicker('refresh');

  });

  // automatic calculate input
  $('input[name=total_workdays]').click(function()
  {
    if($('input[name=salary_workdays]').val() && $('input[name=count_workdays_crew]').val())
    {
      let salary_workdays     = $('input[name=salary_workdays]').val();
      let count_workdays_crew = $('input[name=count_workdays_crew]').val();
      let total_workdays      = (parseFloat(salary_workdays.replace(".", "").replace(",", ".")) * parseFloat(count_workdays_crew));

      $('input[name=total_workdays]').val(getFormatNumber(total_workdays));

      if($('input[name=salary_contract_category_function]').val())
      {
        let days          = $('input[name=days_crew]').val();
        let mode_workday  = $('select[name=id_workday] option:selected').data('mode');
        let salary_daily  = 0;

        // sueldo categoria sat neto
        let salary_contract_category_function             = $('input[name=salary_contract_category_function]').val();
        let salary_contract_category_functionFinishNeto   = parseFloat(salary_contract_category_function.replace("$", "").replace(".", "").replace(",", "."));
        // sueldo categoria sat bruto
        let salary_contract_bruto_category_function       = $('input[name=salary_contract_bruto_category_function]').val();
        let salary_contract_category_functionFinishBruto  = parseFloat(salary_contract_bruto_category_function.replace("$", "").replace(".", "").replace(",", "."));

        if(mode_workday == 'working-day')
        {
          salary_daily = parseFloat((salary_contract_category_functionFinishBruto / 22) * 1.5);
        } else {
          salary_daily = parseFloat(salary_contract_category_functionFinishNeto / 30);
        }

        let crew_sueldo_diferencia = getFormatNumber( total_workdays - (salary_daily * parseFloat(count_workdays_crew)) );

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
    var salarybruto = $(this).find(':selected').data('salarybruto');
    if(salaryneto){
      $('input[name=salary_contract_category_function]').val(salaryneto);
    }
    if(salarybruto){
      $('input[name=salary_contract_bruto_category_function]').val(salarybruto);
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
    $(".button-show-form-team").addClass('hidden');

    $('body,html').stop(true,true).animate({ scrollTop: $("#module_two").offset().top },1000);

    let id = $(this).data('id');
    let categorySat = $(this).data('category');
    let nameTeam = $(this).data('nameteam');

    $.each(listTeams, function(i, v){
      if(v.id == id){
        // list field by form
        $("#add_crew").text("Editar Team");
        $("#is_edit").val("1");

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

        // start_date_secure_contract
        if(v.start_date_secure_contract){
          $('input[name=start_date_secure_contract]').val(getDatePickerFormat(v.start_date_secure_contract));
        } else {
          $('input[name=start_date_secure_contract]').val(getDatePickerFormat(v.start_date_contract));
        }

        // end_date_secure_contract
        if(v.end_date_secure_contract){
          $('input[name=end_date_secure_contract]').val(getDatePickerFormat(v.end_date_secure_contract));
        } else {
          $('input[name=end_date_secure_contract]').val(getDatePickerFormat(v.finish_date_contract));
        }

        // salary_workdays
        $('input[name="salary_workdays"]').val(v.salary_workdays);

        // total_workdays
        $('input[name="total_workdays"]').val(v.total_workdays);

        // total_workdays_text
        $('input[name="total_workdays_text"]').val(v.total_workdays_text);

        // salary_contract_category_function
        $('input[name="salary_contract_bruto_category_function"]').attr('type', 'hidden');
        $('input[name="salary_contract_category_function"]').attr('type', 'text');
        $(".sueldo_contrato_team").text("Sueldo Contrato Mensual $");
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

        var dateStart = new Date(moment().format("YYYY-MM-DD"));
        var dateFinish = new Date(moment().format("YYYY-MM-DD"));

        dateStart.setDate(dateStart.getDate()+1);
        dateFinish.setDate(dateFinish.getDate()+1);

        if(start != '' && finish != '' && rol != ''){

          dateStart.setHours(parseFloat(start[0]),parseFloat(start[1]),'00');
          dateFinish.setHours(parseFloat(finish[0]),parseFloat(finish[1]),'00');

          let extraHours = {
            crew: crew,
            rol: rol,
            start: dateStart,
            finish: dateFinish,
            day: dateStart.getDay()
          }

          $.ajax({
            type: 'POST',
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

        function calculateHsExtras(n, pactadas) {
          let hours = n;
          let rhours = Math.floor(hours);
          let minutes = (hours - rhours) * 60;
          let rminutes = Math.round(minutes);
          let total = ((rhours+'.'+rminutes) - pactadas).toString();

          return total.substr(0,4);
        }

        function getHourMinParse(n) {
          var num = n;
          var hours = (num / 60);
          var rhours = Math.floor(hours);
          var minutes = (hours - rhours) * 60;
          var rminutes = Math.round(minutes);

          return rhours+'.'+minutes;
        }

        function diff_hours(dt2, dt1) {
          let diff =(dt2 - dt1) / 1000;
          diff /= (60 * 60);
          return Math.abs(diff);    
        }

        if(data.results)
        {
          swal({
            title: `${nameTeam} : Horas Extras`,
            html: getTemplateHourExtras(),
            confirmButtonClass: "btn btn-success",
            showCancelButton: false,
            customClass: 'swal-wide',
            buttonsStyling: !1,
            onBeforeOpen: () => {

              let dataExport = [];

              $.each(data.results, function(i,v){

                let start = new Date(v.start);
                let finish = new Date(v.finish);
                
                let countHour = diff_hours(finish.getTime(), start.getTime());
                let price = ( (parseFloat(data.salary.replace(".", "").replace(",", ".")) / v.agreed_hours) );
                let valorHoraHsExtra = Math.round(parseFloat((price * 1.5)) * 100) / 100;
                let _tokenForm = $("#logic_project input[name=_token]").val();

                $("#content-hour-extras").append(`<tr>
                                  <td>${getDatePickerFormat(v.start)}</td>
                                  <td>${v.rol}</td>
                                  <td>${parseDate(start.getHours())}:${parseDate(start.getMinutes())}</td>
                                  <td>${parseDate(finish.getHours())}:${parseDate(finish.getMinutes())}</td>
                                  <td>${v.agreed_hours}</td>
                                  <td>${(countHour - v.agreed_hours)}</td>
                                  <td>` +"$"+ `${valorHoraHsExtra.toFixed(2)}</td>
                                  <td>
                                    <button type="submit" form="${i}" class="btn btn-primary">Eliminar</button>
                                    <form id="${i}" action="/sistema/json/remove_hs_extra" style="display:none;" method="POST">
                                      <input type="hidden" name="_token" value="${_tokenForm}">
                                      <input type="hidden" value="${i}" name="key" />
                                      <input type="hidden" value="${id}" name="id" />
                                    </form>
                                  </td>
                              </tr>`);

                let valorTotalHoraHsExtra = ( parseFloat(calculateHsExtras(countHour, v.agreed_hours)).toFixed(3) * valorHoraHsExtra );

                dataExport.push({
                  fecha: getDatePickerFormat(v.start, true),
                  rol: v.rol,
                  inicio: parseDate(start.getHours())+':'+parseDate(start.getMinutes()),
                  final: parseDate(finish.getHours())+':'+parseDate(finish.getMinutes()),
                  horas_pactadas: v.agreed_hours,
                  horas_extras: (countHour - v.agreed_hours),
                  valor_hora: "$" + valorHoraHsExtra.toFixed(2),
                  valor_total: "$" + valorTotalHoraHsExtra.toFixed(2)
                });

              });

              $("#form_hs_extras input[name=_token]").val($("#logic_project input[name=_token]").val());
              $("#form_hs_extras input[name=name_team]").val(nameTeam);
              $("#form_hs_extras input[name=id_project_provider]").val(id);
              $("#form_hs_extras input[name=hs_extras]").val(JSON.stringify(dataExport));

            }
          });
        } else {
          Swal.fire({
            title: 'NO se encontraron Horas Extras!',
            type: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
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
        });
      }
    });
  });

  $(".show-absences").click(function(){

    let id = $(this).data('id');
    let nameTeam = $(this).data('nameteam');
    $.ajax({
      type: 'GET',
      url: '/sistema/project_providers/'+id+'/edit',
      success: function(data){

        if(data.results)
        {
          swal({
            title: `${nameTeam} : Ausencias`,
            html: getTemplateAbsences(),
            confirmButtonClass: "btn btn-success",
            showCancelButton: false,
            customClass: 'swal-wide',
            buttonsStyling: !1,
            onBeforeOpen: () => {

              let dataExport = [];

              $.each(data.results, function(i,v){
                let _tokenForm = $("#logic_project input[name=_token]").val();
                let note = (v.note ? v.note : '-')

                $("#content-absences").append(`<tr>
                                  <td>${getDatePickerFormat(v.date)}</td>
                                  <td>${v.subject}</td>
                                  <td>${note}</td>
                                  <td>
                                    <button type="submit" form="${i}" class="btn btn-primary">Eliminar</button>
                                    <form id="${i}" action="/sistema/json/remove_absence" style="display:none;" method="POST">
                                      <input type="hidden" name="_token" value="${_tokenForm}">
                                      <input type="hidden" value="${i}" name="key" />
                                      <input type="hidden" value="${id}" name="id" />
                                    </form>
                                  </td>
                              </tr>`);

                dataExport.push({
                  fecha: getDatePickerFormat(v.date, true),
                  asunto: v.subject,
                  nota: note
                });

              });

              $("#form_absences input[name=_token]").val($("#logic_project input[name=_token]").val());
              $("#form_absences input[name=name_team]").val(nameTeam);
              $("#form_absences input[name=id_project_provider]").val(id);
              $("#form_absences input[name=absences]").val(JSON.stringify(dataExport));

            }
          });
        } else {
          Swal.fire({
            title: 'NO se encontraron Ausencias!',
            type: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
          });
        }
      },
      error: function(xhr, status){
        Swal.fire({
          title: 'NO se encontraron Ausencias!',
          type: 'info',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar'
        });
      }
    });
  });

  $(".button-show-form-team").click(function(){
    $("#content-form-edit-team").removeClass('hidden');
    $(this).addClass('hidden');

    // update all select
    $('.selectpicker').selectpicker('refresh');
  });

    //
    let cardsEq = {};
    $(".group-more-team").each(function() {
      if (this.id != '') {
        cardsEq[this.id] = (cardsEq[this.id] || 0) + 1;
      }
    });

    let cardsAppend = [];

    $(".group-more-team").each(function() {
      let idProvider = $(this).data('idprovider');
      let cards = $(this);

      for(var i in cardsEq) {
        if(cardsEq[i] > 1) {
          if('item_view_'+idProvider == i) {

            cardsAppend.push({
              "id": i,
              "idprovider": cards.data('idprovider'),
              "name": cards.data('name')
            });

            cards.toggleClass('d-flex');
            cards.addClass('group-yes');
            cards.addClass('content-group-'+i);
            cards.hide();
          }
        }
      }
    });

    $.each(removeDumplicateValue(cardsAppend), function(i, v){
      $('.list_crew_view').append(`<div class="col-md-4 d-flex group-more-team" data-toggleteams="${v.idprovider}">
          <div class="card mb-3">
            <div class="card-header card-section-color">
              Grupo de Team
            </div>
            <div class="card-body align-items-center d-flex justify-content-center">
              <h4 class="card-title">${v.name}</h4>
            </div>
            <div class="card-footer pt-0">
              <button data-group="${v.id}" data-idprovider="${v.idprovider}" onclick="showGroupTeams(this);" type="button" class="btn btn-link" style="margin: 0 auto;border: 1px solid #ff9800;">
                <span class="toggle-button-group">Ver Grupo</span>
                <span class="toggle-button-group" style="display: none;">Ocultar Grupo</span>
              </button>
            </div>
          </div>
        </div>`);
    });

    // search cards from projects
    $("#search_input_card").on("keyup", function () {
      var value = $(this).val().toLowerCase();
      $(".list_crew_view .col-md-4").filter(function () {
        $(this).find('.mb-3').toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    
});
