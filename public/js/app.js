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

  $(".datepicker").datepicker({
    onSelect: function(){
      var days = 0;
      var startDay = $("input[name=start_date]").datepicker('getDate');
      var endDay = $("input[name=finish_date]").datepicker('getDate');

      if (startDay && endDay) {
        days = Math.floor((endDay.getTime() - startDay.getTime()) / 86400000); // ms per day
      }

      $("input[name=days]").val(days);
    }
  });

  // request global ajax frame_functions, for workers_categories
  $("select.ajax_workers_categories_by_functions_frame").change(function(){

      $.ajax({
        type: 'GET',
        url: '/json/workers_categories/'+$(this).val(),
        dataType: 'json',
        success: function(data){
          // append result for select -> option
          var results = data.data;

          if(results.length >= 1){
            var getValueWorkersCategories = $('select.get_value_workers_categories_ajax');
            var getValueFunctionsSat = $('select.get_value_functions_sat_ajax');

            // empty getValueWorkersCategories and getValueFunctionsSat
            getValueWorkersCategories.empty();
            getValueFunctionsSat.empty();

            // insert option
            getValueWorkersCategories.append("<option value=''>Seleccionar</option>");
            $.each(results, function(i,v){
              getValueWorkersCategories.append("<option value='"+v.id+"'>"+v.name+"</option>");
            });

            $('.selectpicker').selectpicker('refresh');
          }

        },
        error: function(xhr, status){
          console.log('Error: '+xhr);
        }
      });

  });

  // request global ajax frame_functions, for workers_categories
  $("select.ajax_functions_sat_by_workers_categories").change(function(){

      var id_frame_function = $("select.ajax_workers_categories_by_functions_frame").val();

      $.ajax({
        type: 'GET',
        url: '/json/sat_functions/'+id_frame_function+'/'+$(this).val(),
        dataType: 'json',
        success: function(data){
          // append result for select -> option
          var results = data.data;

          if(results.length >= 1){
            var getValueFunctionsSat = $('select.get_value_functions_sat_ajax');

            // empty getValueFunctionsSat
            getValueFunctionsSat.empty();

            // insert option
            getValueFunctionsSat.append("<option value=''>Seleccionar</option>");
            $.each(results, function(i,v){
              getValueFunctionsSat.append("<option value='"+v.id+"'>"+v.name+"</option>");
            });

            $('.selectpicker').selectpicker('refresh');
          }
        },
        error: function(xhr, status){
          console.log('Error: '+xhr);
        }
      });

  });

});
