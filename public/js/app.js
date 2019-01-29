function addActiveNavSidebar(idItemNav, idContentItemNav){

  var urlPathname = window.location.pathname;
  if(urlPathname === idItemNav || urlPathname === idItemNav+"/create"){

    $("#"+idItemNav+"-nav").addClass('active');
    $("#exampleAccordion").animate({ scrollTop: $(document).height() }, 1000);
    $(".nav-link-collapse").removeClass('collapsed');
    $(".nav-link-collapse").attr('aria-expanded', 'true');
    $("#"+idContentItemNav).addClass('show');
  }
}

$(document).ready(function(){

  // datatables global
  $("#datatables").DataTable({
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    }
  });

  // Nav Check url active menu
  var url = window.location.href;
  $(".nav-check-url").each(function(i,v){
    var link = $(this).children('a').attr('href');
    if(url === link || url === link+"/create"){
      $(this).addClass('active');
    }
  });

  // jQuery UI -> Datepicker
  $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '< Ant',
    nextText: 'Sig >',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['es']);
 
  $(".datepicker").datepicker();

});
