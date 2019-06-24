function getOptionTeam()
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

      var dateStart = new Date(data);
      dateStart.setDate(dateStart.getDate() + 1);

      var dateFinish = new Date(data);
      dateFinish.setDate(dateFinish.getDate() + 1);

      swal({
        title: "Agregar horas extra",
        html: getOptionTeam(),
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
             $("#crew_hs_extra").append(`<option value="${v.id}">${v.name_user}</option>`);
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
              finish: dateFinish
            }

            $.ajax({
              type: 'GET',
              url: '/sistema/json/project_providers/extra_hours',
              data: extraHours,
              success: function(data){

                if(data.status){
                  // swal ALERT que las horas extras se cargo con exito
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
            });
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

      // if(crew.id){

      //   let formHtml =
      //   `<form id="${crew.id}"><div class="row">
      //       <label class="col-md-5 col-form-label text-right">Hora de Inicio:</label>
      //       <div class="col-md-5">
      //         <div class="form-group">
      //           <select class="form-control" data-style="btn btn-link" id="inicio_hs_jornada" name="inicio_hs_jornada" required>
      //             <option value="">Seleccionar</option>
      //           </select>
      //         </div>
      //       </div>
      //     </div>
      //     <div class="row">
      //       <label class="col-md-5 col-form-label text-right">Hora de Final:</label>
      //       <div class="col-md-5">
      //         <div class="form-group">
      //           <select class="form-control" data-style="btn btn-link" id="final_hs_jornada" name="final_hs_jornada" required>
      //             <option value="">Seleccionar</option>
      //           </select>
      //         </div>
      //       </div>
      //     </div></form>`;

      //     swal({
      //       title: `Horario de Jornada ${crew.title}`,
      //       html: formHtml,
      //       showCancelButton: !0,
      //       confirmButtonClass: "btn btn-success",
      //       cancelButtonClass: "btn btn-danger",
      //       buttonsStyling: !1,
      //       onBeforeOpen: () => {
      //         $.each(frameJs.getTimeCalendar(), function(i, v){
      //            $("#inicio_hs_jornada").append(`<option value="${v}">${v}</option>`);
      //         });

      //         $.each(frameJs.getTimeCalendar(), function(i, v){
      //            $("#final_hs_jornada").append(`<option value="${v}">${v}</option>`);
      //         });
      //       }
      //     })
      //     .then(function(status){

      //       // ajax SAVE horas jornada POR DIA
      //       if(status.value){

      //         let inicio_hs_jornada = $("select[name=inicio_hs_jornada] option:selected").val().split(':');
      //         let final_hs_jornada = $("select[name=final_hs_jornada] option:selected").val().split(':');

      //         if(inicio_hs_jornada[0] && final_hs_jornada[0]){

      //           var crew_inicio = new Date(crew.start);
      //           var crew_end = ( crew.end ? new Date(crew.end) : new Date(crew.start) );

      //           crew_inicio.setHours(inicio_hs_jornada[0]);
      //           crew_inicio.setMinutes(inicio_hs_jornada[1]);

      //           crew_end.setHours(final_hs_jornada[0]);
      //           crew_end.setMinutes(final_hs_jornada[1]);

      //           let jornadaTeam = {
      //             id: crew.id,
      //             start: crew_inicio,
      //             finish: crew_end
      //           }

      //           $.ajax({
      //             type: 'GET',
      //             url: '/sistema/json/project_providers/jornada_crew',
      //             data: jornadaTeam,
      //             success: function(data){

      //               if(data.status){

      //                 crew.start = crew_inicio;
      //                 crew.end = crew_end;
      //                 $calendar.fullCalendar('updateEvent', crew);

      //                 Swal.fire({
      //                   title: 'Horario de Jornada actualizada con exito!',
      //                   type: 'info',
      //                   showCancelButton: false,
      //                   confirmButtonColor: '#3085d6',
      //                   cancelButtonColor: '#d33',
      //                   confirmButtonText: 'Aceptar'
      //                 });
      //               }
      //             },
      //             error: function(xhr, status){
      //               console.log('Error: '+xhr);
      //             }
      //           });

      //         } else {
      //           Swal.fire({
      //             title: 'Para Agregar un horario a la Jornada del Team debes seleccionar un Inicio y Final de Horas! Gracias.',
      //             type: 'info',
      //             showCancelButton: false,
      //             confirmButtonColor: '#3085d6',
      //             cancelButtonColor: '#d33',
      //             confirmButtonText: 'Aceptar'
      //           });
      //         }

      //       }

      //     })
      //     .catch(swal.noop)

      // } else {
        Swal.fire({
          title: crew.title,
          type: 'info',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar'
        });
      //}

    }

  });

});
