$(document).ready(function() {

  function getOptionCrew(){

    var formSwal =
      '<div class="row">'+
        '<label class="col-md-6 col-form-label">Crew:</label>'+
        '<div class="col-md-4">'+
          '<div class="form-group">'+
            '<select class="form-control" data-style="btn btn-link" id="crew_hs_extra" name="crew_hs_extra" required>'+
              '<option value="">Seleccionar</option>'+
            '</select>'+
          '</div>'+
        '</div>'+
      '</div>'+
      '<div class="row">'+
          '<label class="col-md-6 col-form-label">Inicio Hora Extra:</label>'+
          '<div class="col-md-4">'+
            '<div class="form-group">'+
              '<input class="form-control" type="number" name="inicio_hs_extra">'+
            '</div>'+
          '</div>'+
        '</div>'+
        '<div class="row">'+
          '<label class="col-md-6 col-form-label">Final Hora Extra:</label>'+
          '<div class="col-md-4">'+
            '<div class="form-group">'+
              '<input class="form-control" type="number" name="final_hs_extra">'+
            '</div>'+
          '</div>'+
        '</div>'+
        '<div class="row">'+
          '<label class="col-md-6 col-form-label">Valor por Hora:</label>'+
          '<div class="col-md-4">'+
            '<div class="form-group">'+
              '<input class="form-control" type="number" name="value_hs_extra">'+
            '</div>'+
          '</div>'+
        '</div>';

    return formSwal;
  }

  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  var listEvents = [];
  $.each(list_crew, function(i, v){
    listEvents.push({
      id: v.id,
      title: v.name_user+" ("+v.function_frame_name+")",
      start: v.start_date_contract,
      end: v.finish_date_contract,
      allDay: 1,
      backgroundColor: getRandomColor(),
      color: getRandomColor()
    });
  });

  $calendar = $("#fullCalendarProject"),
  today = new Date,
  y = today.getFullYear(),
  m = today.getMonth(),
  d = today.getDate(),

  $calendar.fullCalendar({
    locale: 'es',
    // viewRender:function(e,a){
    //   "month"!=e.name&&$(a).find(".fc-scroller").perfectScrollbar()
    // },
    header: {
      left: "title",
      center: "month,agendaWeek,agendaDay",
      right: "prev,next,today"},
      defaultDate: today,
      selectable: !0,
      selectHelper: !0,
      views: {
        month: { titleFormat:"MMMM YYYY" },
        week:{ titleFormat:" MMMM D YYYY" },
        day:{ titleFormat:"D MMM, YYYY" }
      },
      select: function(data){

        var day = new Date(data._d);
        var dateHs = (day.getDate() + 1) +"-"+ (day.getMonth() + 1) +"-"+ day.getFullYear();

        swal({
          title: "Agregar horas extra",
          html: getOptionCrew(),
          showCancelButton: !0,
          confirmButtonClass: "btn btn-success",
          cancelButtonClass: "btn btn-danger",
          buttonsStyling: !1,
          onBeforeOpen: () => {
            $.each(list_crew, function(i, v){
               $("#crew_hs_extra").append('<option value="'+v.id+'">'+v.name_user+'</option>');
            });
          }
        })
        .then(function(e,data){

          // ajax SAVE horas extras

          var a;
          event_title = $("#input-field").val(),
          event_title && ( a = {
            title: event_title,
            start: t,
            end: n
          },
          $calendar.fullCalendar("renderEvent",a,!0)),
          $calendar.fullCalendar("unselect")

        })
        .catch(swal.noop)
      },
      editable: !0,
      eventLimit: !0,
      events: listEvents,
      eventClick: function(crew) {
          /* via ajax
            * Inicio hora
            * Fin hora
            * Horas Trabajadas -> automatico
          */

          console.log(crew);

          var formHtml =
          '<div class="row">'+
              '<label class="col-md-6 col-form-label">Hora de Inicio:</label>'+
              '<div class="col-md-4">'+
                '<div class="form-group">'+
                  '<input class="form-control" type="number" name="inicio_hs_jornada">'+
                '</div>'+
              '</div>'+
            '</div>'+
            '<div class="row">'+
              '<label class="col-md-6 col-form-label">Hora de Final:</label>'+
              '<div class="col-md-4">'+
                '<div class="form-group">'+
                  '<input class="form-control" type="number" name="final_hs_jornada">'+
                '</div>'+
              '</div>'+
            '</div>';

            swal({
              title: "Horario de Jornada "+crew.title,
              html: formHtml,
              showCancelButton: !0,
              confirmButtonClass: "btn btn-success",
              cancelButtonClass: "btn btn-danger",
              buttonsStyling: !1
            })
            .then(function(e,data){

              // ajax SAVE horas extras

              // var a;
              // event_title = $("#input-field").val(),
              // event_title && ( a = {
              //   title: event_title,
              //   start: t,
              //   end: n
              // },
              // $calendar.fullCalendar("renderEvent",a,!0)),
              // $calendar.fullCalendar("unselect")

            })
            .catch(swal.noop)

      }

  });

});
