$(document).ready(function() {

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
      select: function(t,n){
        swal({
          title: "Agregar horas extra",
          html: '<div class="form-group"><input class="form-control" placeholder="Event Title" id="input-field"></div>',
          showCancelButton: !0,
          confirmButtonClass: "btn btn-success",
          cancelButtonClass: "btn btn-danger",
          buttonsStyling: !1
        })
        .then(function(e){
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
      events:[
        {
          title: "All Day Event",
          start: new Date(y,m,1),
          className: "event-default"
        },
        {
          id: 999,
          title:" Repeating asd",
          start: new Date(y,m,d-4,6,0),
          allDay: !1,
          className: "event-rose"
        },
        {
          id: 999,
          title: "Repeating Event",
          start: new Date(y,m,d+3,6,0),
          allDay: !1,
          className: "event-rose"
        },
        {
          title: "Meeting",
          start: new Date(y,m,d-1,10,30),
          allDay: !1,
          className: "event-green"
        }
        // {title:"Meeting",start:new Date(y,m,d-1,10,30),allDay:!1,className:"event-green"},{title:"Lunch",start:new Date(y,m,d+7,12,0),end:new Date(y,m,d+7,14,0),allDay:!1,className:"event-red"},{title:"Md-pro Launch",start:new Date(y,m,d-2,12,0),allDay:!0,className:"event-azure"},{title:"Birthday Party",start:new Date(y,m,d+1,19,0),end:new Date(y,m,d+1,22,30),allDay:!1,className:"event-azure"},{title:"Click for Creative Tim",start:new Date(y,m,21),end:new Date(y,m,22),url:"http://www.creative-tim.com/",className:"event-orange"},{title:"Click for Google",start:new Date(y,m,21),end:new Date(y,m,22),url:"http://www.creative-tim.com/",className:"event-orange"}
      ]

  });

});
