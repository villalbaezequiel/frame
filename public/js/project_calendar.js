$(document).ready(function() {


  function getTimeCalendar(){
    var jornadas = [
      "00:00","00:30",
      "01:00","01:30",
      "02:00","02:30",
      "03:00","03:30",
      "04:00","04:30",
      "05:00","05:30",
      "06:00","06:30",
      "07:00","07:30",
      "08:00","08:30",
      "09:00","09:30",
      "10:00","10:30",
      "11:00","11:30",
      "12:00","12:30",
      "13:00","13:30",
      "14:00","14:30",
      "15:00","15:30",
      "16:00","16:30",
      "17:00","17:30",
      "18:00","18:30",
      "19:00","19:30",
      "20:00","20:30",
      "21:00","21:30",
      "22:00","22:30",
      "23:00","23:30",
    ];

    return jornadas;
  }

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
              '<select class="form-control" data-style="btn btn-link" id="inicio_hs_extra" name="inicio_hs_extra" required>'+
                '<option value="">Seleccionar</option>'+
              '</select>'+
            '</div>'+
          '</div>'+
        '</div>'+
        '<div class="row">'+
          '<label class="col-md-6 col-form-label">Final Hora Extra:</label>'+
          '<div class="col-md-4">'+
            '<div class="form-group">'+
              '<select class="form-control" data-style="btn btn-link" id="final_hs_extra" name="final_hs_extra" required>'+
                '<option value="">Seleccionar</option>'+
              '</select>'+
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

    var start_date = new Date(v.start_date_contract);
    var end_date = new Date(v.finish_date_contract);

    // quizas realizar un each de fechas

    listEvents.push({
      id: v.id,
      title: v.name_user+" ("+v.function_frame_name+")",
      start: start_date,
      end: end_date,
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

            $.each(getTimeCalendar(), function(i, v){
               $("#inicio_hs_extra").append('<option value="'+v+'">'+v+'</option>');
            });

            $.each(getTimeCalendar(), function(i, v){
               $("#final_hs_extra").append('<option value="'+v+'">'+v+'</option>');
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
      eventClick: function(crew, element) {
          /* via ajax
            * Inicio hora
            * Fin hora
            * Horas Trabajadas -> automatico
          */

          var formHtml =
          '<form id="'+crew.id+'"><div class="row">'+
              '<label class="col-md-6 col-form-label">Hora de Inicio:</label>'+
              '<div class="col-md-4">'+
                '<div class="form-group">'+
                  '<select class="form-control" data-style="btn btn-link" id="inicio_hs_jornada" name="inicio_hs_jornada" required>'+
                    '<option value="">Seleccionar</option>'+
                  '</select>'+
                '</div>'+
              '</div>'+
            '</div>'+
            '<div class="row">'+
              '<label class="col-md-6 col-form-label">Hora de Final:</label>'+
              '<div class="col-md-4">'+
                '<div class="form-group">'+
                  '<select class="form-control" data-style="btn btn-link" id="final_hs_jornada" name="final_hs_jornada" required>'+
                    '<option value="">Seleccionar</option>'+
                  '</select>'+
                '</div>'+
              '</div>'+
            '</div></form>';

            swal({
              title: "Horario de Jornada "+crew.title,
              html: formHtml,
              showCancelButton: !0,
              confirmButtonClass: "btn btn-success",
              cancelButtonClass: "btn btn-danger",
              buttonsStyling: !1,
              onBeforeOpen: () => {
                $.each(getTimeCalendar(), function(i, v){
                   $("#inicio_hs_jornada").append('<option value="'+v+'">'+v+'</option>');
                });

                $.each(getTimeCalendar(), function(i, v){
                   $("#final_hs_jornada").append('<option value="'+v+'">'+v+'</option>');
                });
              }
            })
            .then(function(status,data){

              // ajax SAVE horas jornada POR DIA
              if(status.value == true){

                var inicio_hs_jornada = $("select[name=inicio_hs_jornada] option:selected").val().split(':');
                var final_hs_jornada = $("select[name=final_hs_jornada] option:selected").val().split(':');

                var crew_inicio = new Date(crew.start);
                var crew_end = new Date(crew.end);

                crew_inicio.setHours(inicio_hs_jornada[0]);
                crew_inicio.setMinutes(inicio_hs_jornada[1]);

                crew_end.setHours(final_hs_jornada[0]);
                crew_end.setMinutes(final_hs_jornada[1]);

                crew.start = crew_inicio;
                crew.end = crew_end;

                $calendar.fullCalendar('updateEvent', crew);
              }

            })
            .catch(swal.noop)

      }

  });

});
