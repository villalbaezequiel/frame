function getFormHsEsTeam()
{
  let formSwal =
    `<div class="row hidden">
    <label class="col-sm-5 col-form-label text-right">Rol a Desempeñar:</label>
    <div class="col-sm-5">
      <div class="form-group">
        <select class="form-control" data-style="btn btn-link" id="rol_hs_extra" name="rol_hs_extra" required>
          <option value="0" selected="selected"></option>
        </select>
      </div>
    </div>
  </div>
    <div class="row">
      <label class="col-sm-5 col-form-label text-right">Team:</label>
      <div class="col-sm-5">
        <div class="form-group">
          <select class="form-control selectpicker" data-style="btn btn-link" id="crew_hs_extra" name="crew_hs_extra[]" multiple required>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
        <label class="col-sm-5 col-form-label text-right">Hora Inicio:</label>
        <div class="col-sm-5">
          <div class="form-group">
            <select class="form-control selectpicker" data-style="btn btn-link" id="inicio_hs_extra" name="inicio_hs_extra" required>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-sm-5 col-form-label text-right">Hora Final:</label>
        <div class="col-sm-5">
          <div class="form-group">
            <select class="form-control selectpicker" data-style="btn btn-link" id="final_hs_extra" name="final_hs_extra" required>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 text-left">
          <ul>
            <li><i>Multiple Seleccion: haga click en los Team que necesites.</i></li>
            <li><i>Las Horas Extras se visualizarán de color Violeta.</i></li>
          </ul>
        </div>
      </div>`;

  return formSwal;
}

function getFormAbsenceTeam()
{
  let formSwal =
    `<div class="row">
      <label class="col-sm-4 col-form-label text-right">Team:</label>
      <div class="col-sm-6">
        <div class="form-group">
          <select class="form-control selectpicker" data-style="btn btn-link" id="crew_absence" name="crew_absence[]" multiple required>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-4 col-form-label text-right">Asunto:</label>
      <div class="col-sm-6">
        <div class="form-group">
          <select class="form-control selectpicker" data-style="btn btn-link" id="crew_subject_absence" name="crew_subject_absence" required>
            <option value="razones_personales">Razones personales</option>
            <option value="enfermedad">Enfermedad</option>
            <option value="sin_aviso">Sin aviso</option>
            <option value="vacaciones">Vacaciones</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-4 col-form-label text-right">Nota:</label>
      <div class="col-sm-6">
        <div class="form-group">
          <textarea class="form-control" id="crew_description_absence" name="crew_description_absence" maxlength="100"></textarea>
        </div>
      </div>
    </div>`;

  return formSwal;
}

function getActionSelect()
{
  let formSwal =
    `<div class="row">
      <label class="col-sm-4 col-form-label text-right">Seleccionar:</label>
      <div class="col-sm-8">
        <select class="form-control selectpicker" data-style="btn btn-link" id="select_action" name="select_action" required>
          <option value="hs_extras">Horas Extras</option>
          <option value="absence">Ausencia</option>
        </select>
      </div>
    </div>`;

  return formSwal;
}

function getDateSelect()
{
  let formSwal =
    `<div class="row">
        <label class="col-sm-5 col-form-label text-right">Fecha (mes/dia/año):</label>
        <div class="col-sm-5">
          <div class="form-group">
            <input type="date" id="date-workdays-input" name="date-workdays-input">
          </div>
        </div>
      </div>`;

  return formSwal;
}

function getAlertInfo(message)
{
  Swal.fire({
    title: message,
    type: 'info',
    showCancelButton: false,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar'
  });
}

function popUpCreateAbsence(dateStart)
{
  swal({
    title: "Agregar Ausencia",
    html: getFormAbsenceTeam(),
    showCancelButton: !0,
    confirmButtonClass: "btn btn-success",
    cancelButtonClass: "btn btn-danger",
    buttonsStyling: !1,
    onBeforeOpen: () => {

      $.each(list_crew, function(i, v){

        let setBackground = false;

        if(v.calendar){
          $.each(v.calendar, function(c,d){
            let eventTeamToday = new Date(d.start);
            let dateStartFull = dateStart.getDate()+'-'+dateStart.getMonth()+'-'+dateStart.getFullYear();
            let eventTeamTodayFull = eventTeamToday.getDate()+'-'+eventTeamToday.getMonth()+'-'+eventTeamToday.getFullYear();

            if(dateStartFull == eventTeamTodayFull){
              setBackground = true;
            }
          });
        }

        if(setBackground){
          $("#crew_absence").append(`<option style="background: #5cb85c; color: #fff;" value="${v.id}">${v.name_user}</option>`);
        } else {
          $("#crew_absence").append(`<option value="${v.id}">${v.name_user}</option>`);
        }

      });

      $('.selectpicker').selectpicker('refresh');
    }
  })
  .then(function(data){

    if(data.value){
      // ajax SAVE horas extras

      let crew = $("#crew_absence").val();
      let note = $("#crew_description_absence").val();
      let subject = $("#crew_subject_absence").find(':selected').val();

      if(crew)
      {
        let dateAbsence = {
          crew: crew,
          date: dateStart,
          subject: subject,
          note: note
        }

        $.ajax({
          type: 'POST',
          url: '/sistema/json/project_providers/absence',
          data: dateAbsence,
          success: function(data){

            if(data.status)
            {
              getAlertInfo("Ausencia ingresada con Exito!");
            }
          },
          error: function(xhr, status){
            getAlertInfo("Se ha generado un Error al ingresar Ausencia!");
            console.log('Error: '+xhr);
          }
        });

      } else {
        getAlertInfo("Para Agregar Ausencia a un Team debes completar los datos mencionados en el Formulario! Gracias.");
      }

    }

  })
  .catch(swal.noop)
}

function popUpCreateHsEs(dateStart, dateFinish)
{
    swal({
      title: "Agregar horas extra",
      html: getFormHsEsTeam(),
      showCancelButton: !0,
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: !1,
      onBeforeOpen: () => {

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

        $.each(list_crew, function(i, v){

          let setBackground = false;

          if(v.calendar){
            $.each(v.calendar, function(c,d){
              let eventTeamToday = new Date(d.start);

              let dateStartFull = dateStart.getDate()+'-'+dateStart.getMonth()+'-'+dateStart.getFullYear();
              let eventTeamTodayFull = eventTeamToday.getDate()+'-'+eventTeamToday.getMonth()+'-'+eventTeamToday.getFullYear();

              if(dateStartFull == eventTeamTodayFull){
                setBackground = true;
              }
            });
          }

          if(setBackground){
            $("#crew_hs_extra").append(`<option style="background: #5cb85c; color: #fff;" value="${v.id}">${v.name_user}</option>`);
          } else {
            $("#crew_hs_extra").append(`<option value="${v.id}">${v.name_user}</option>`);
          }

        });

        $.each(frameJs.getTimeCalendar(), function(i, v){
            $("#inicio_hs_extra").append(`<option value="${v}">${v}</option>`);
        });

        $.each(frameJs.getTimeCalendar(), function(i, v){
            $("#final_hs_extra").append(`<option value="${v}">${v}</option>`);
        });

        $('.selectpicker').selectpicker('refresh');
      }
    })
    .then(function(data){

      if(data.value){
        // ajax SAVE horas extras

        let crew = $("#crew_hs_extra").val();
        let start = $("#inicio_hs_extra").find(':selected').val().split(':');
        let finish = $("#final_hs_extra").find(':selected').val().split(':');
        let rol = $("#rol_hs_extra").find(':selected').val();

        if(crew && start && finish){

          dateStart.setHours(parseFloat(start[0]),parseFloat(start[1]),'00');
          dateFinish.setHours(parseFloat(finish[0]),parseFloat(finish[1]),'00');

          let extraHours = {
            crew: crew,
            rol: rol,
            start: dateStart,
            finish: dateFinish,
            day: dateStart.getDay(),
            day_validation: dateStart.getFullYear()+'-'+( dateStart.getMonth() + 1 )+'-'+dateStart.getDate()+' 00:00:00'
          }

          $.ajax({
            type: 'POST',
            url: '/sistema/json/project_providers/extra_hours',
            data: extraHours,
            success: function(data){

              if(data.status){

                // crear Evento en el calendario
                // $.each(data.name, function(ind, name){
                //   let hourExtra = {
                //     title: `Horas Extras - ${name}`,
                //     start: dateStart,
                //     end: dateFinish,
                //     color: '#9c27b0'
                //   };
                //   $calendar.fullCalendar("renderEvent",hourExtra,!0);
                //   $calendar.fullCalendar("unselect");
                // });

                // swal ALERT que las horas extras se cargo con exito
                getAlertInfo("Horas Extras ingresadas con Exito!");

              }
            },
            error: function(xhr, status){
              getAlertInfo("Se ha generado un Error al ingresar Horas Extras!");
              console.log('Error: '+xhr);
            }
          });

        } else {
          getAlertInfo("Para Agregar Horas Extras a un Team debes completar los datos mencionados en el Formulario! Gracias.");
        }

      }

    })
    .catch(swal.noop)
}

$(function() {

  let listEvents = [];
  $.each(list_crew, function(i, v){

    const color = v.function_frame_color;

    if(v.calendar){
      $.each(v.calendar, function(c,d){
        listEvents.push({
          id: `${c}_${v.id}`,
          title: `${v.name_user} (${v.function_frame_name})`,
          start: new Date(d.start),
          end: new Date(d.finish),
          allDay: 1,
          backgroundColor: color,
          color: color
        });
      });
    }

    // if(v.extra_hours){
    //   $.each(v.extra_hours, function(a,b){
    //     listEvents.push({
    //       title: `Horas Extras - ${v.name_user}`,
    //       start: new Date(b.start),
    //       end: new Date(b.finish),
    //       backgroundColor: '#9c27b0',
    //       color: '#9c27b0'
    //     });
    //   });
    // }

  });

  $.each(holidays, function(i, v) {
    if(v.date){
      listEvents.push({
        class: 'holiday',
        title: `${v.name}`,
        start: new Date(v.date),
        end: new Date(v.date),
        allDay: 1,
        backgroundColor: '#777620',
        color: '#777620'
      });
    }
  });

  $calendar = $("#fullCalendarProject"),
  today = new Date,
  y = today.getFullYear(),
  m = today.getMonth(),
  d = today.getDate(),

  $calendar.fullCalendar({
    locale: 'es',
    header: {
      left: "title",
      center: "month,agendaWeek,agendaDay",
      right: "prev,next,today"
    },
    defaultDate: today,
    selectable: !0,
    selectHelper: !0,
    views: {
      month: { titleFormat:"MMMM YYYY" },
      week:{ titleFormat:" MMMM D YYYY" },
      day:{ titleFormat:"D MMM, YYYY" }
    },
    select: function(data){

      let dateStart = new Date(data);
      dateStart.setDate(dateStart.getDate() + 1);

      let dateFinish = new Date(data);
      dateFinish.setDate(dateFinish.getDate() + 1);

      swal({
        title: "Agregar Horas Extras o Ausencias",
        html: getActionSelect(),
        showCancelButton: true,
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        onBeforeOpen: () => {
          $('.selectpicker').selectpicker('refresh');
        }
      })
      .then(function(data){
        let selectedAction = $("#select_action").find(':selected').val();

        if(data.value){
          if(selectedAction == 'hs_extras')
          {
            popUpCreateHsEs(dateStart, dateFinish);
          }

          if(selectedAction == 'absence')
          {
            popUpCreateAbsence(dateStart);
          }

        }

      })
      .catch(swal.noop)
    },
    eventStartEditable: false,
    editable: !0,
    eventLimit: !0,
    events: listEvents,
    eventClick: function(crew, element) {
      getAlertInfo(crew.title);
    }

  });

  $("#add-hs-extras-button").click(function()
  {
    swal({
      title: "Seleccionar Fecha",
      html: getDateSelect(),
      showCancelButton: true,
      confirmButtonText: 'Continuar',
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: !1,
    })
    .then(function(status){
      if(status.value)
      {

        if(!$("input[name='date-workdays-input']").val())
        {
          getAlertInfo("Debes seleccionar una Fecha para avanzar con el Formulario");

          return false;
        }

        let dateStart = new Date($("input[name='date-workdays-input']").val());
        dateStart.setDate(dateStart.getDate() + 1);

        let dateFinish = new Date($("input[name='date-workdays-input']").val());
        dateFinish.setDate(dateFinish.getDate() + 1);

        popUpCreateHsEs(dateStart, dateFinish);

      }

    });
  });

  $("#add-absence-button").click(function()
  {
    swal({
      title: "Seleccionar Fecha",
      html: getDateSelect(),
      showCancelButton: true,
      confirmButtonText: 'Continuar',
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: !1,
    })
    .then(function(status){
      if(status.value)
      {

        if(!$("input[name='date-workdays-input']").val())
        {
          getAlertInfo("Debes seleccionar una Fecha para avanzar con el Formulario");
          return false;
        }

        let dateStart = new Date($("input[name='date-workdays-input']").val());
        dateStart.setDate(dateStart.getDate() + 1);

        popUpCreateAbsence(dateStart);

      }

    });
  });

});
