function addActiveNavSidebar(idItemNav, idContentItemNav) {

  var urlPathname = window.location.pathname;
  if(urlPathname === idItemNav || urlPathname === idItemNav+"/create"){

    $("#"+idItemNav+"-nav").addClass('active');
    $("#exampleAccordion").animate({ scrollTop: $(document).height() }, 1000);
    $(".nav-link-collapse").removeClass('collapsed');
    $(".nav-link-collapse").attr('aria-expanded', 'true');
    $("#"+idContentItemNav).addClass('show');
  }
}

function alertLeaveForm(link){
  // se genera un alert de confirmacion para abandonar el Formulario
  Swal.fire({
    title: '¿Estás seguro que quieres abandonar el Formulario?',
    text: "Tener en cuenta que los campos completados no se guardarán!",
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
    if(result.value == true){
      if($(link).hasClass('back-history')){
        window.history.go(-1); return false;
      } else {
        window.location.href = $(link).attr('href');
      }
    }
  })
}

function alertConfirmDeleteItem(form){
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
    if(result.value == true){

      $.ajax({
        url: $(form).attr('action'),
        data: {_method: 'DELETE', _token: $('meta[name="csrf-token"]').attr('content')},
			  type: 'POST'
      })
      .done(function(data) {
  			$(form).parents('.item-alert-confirm-delete').remove();
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
}

function openWindowUrl(url) {
  window.open(url, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=450, height=900");
}

$(document).ready(function(){

  // datatables global
  $("#datatables").DataTable({
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
    responsive: true
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

  $("select.ajax_functions_frame_by_type_project").change(function(){

      $.ajax({
        type: 'GET',
        url: '/sistema/json/'+$(this).val()+'/functions_frame',
        dataType: 'json',
        success: function(data){
          // append result for select -> option
          var results = data.data;

          if(results.length >= 1){
            var getValueFrameFunctions = $('select.get_value_frame_functions');
            var getValueCategoriesSat = $('select.get_value_categories_sat');

            getValueFrameFunctions.empty();
            getValueCategoriesSat.empty();

            // insert option
            getValueFrameFunctions.append("<option value=''>Seleccionar</option>");
            $.each(results, function(i,v){
              getValueFrameFunctions.append("<option value='"+v.id+"'>"+v.name+"</option>");
            });

            $('.selectpicker').selectpicker('refresh');
          }

        },
        error: function(xhr, status){
          console.log('Error: '+xhr);
        }
      });

  });

  $("select.ajax_categories_sat_by_function_frame").change(function(){

      var id_frame_function = $("select.get_value_frame_functions").val();

      $.ajax({
        type: 'GET',
        url: '/sistema/json/'+id_frame_function+'/categories_sat',
        dataType: 'json',
        success: function(data){
          // append result for select -> option
          var results = data.data;

          if(results.length >= 1){
            var getValueCategoriesSat = $('select.get_value_categories_sat');

            // empty getValueCategoriesSat
            getValueCategoriesSat.empty();

            // insert option
            getValueCategoriesSat.append("<option value=''>Seleccionar</option>");
            $.each(results, function(i,v){
              getValueCategoriesSat.append("<option value='"+v.id+"' data-salaryneto='"+v.sueldo_neto+"'>"+v.name+"</option>");
            });

            $('.selectpicker').selectpicker('refresh');
          }
        },
        error: function(xhr, status){
          console.log('Error: '+xhr);
        }
      });

  });

  $("select.ajax_crew_by_function_frame").change(function(){

      var id_frame_function = $("select.get_value_frame_functions").val();

      $.ajax({
        type: 'GET',
        url: '/sistema/json/'+id_frame_function+'/crew',
        dataType: 'json',
        success: function(data){
          // append result for select -> option
          var results = data.data;

          if(results.length >= 1){
            var getValueCrew = $('select.get_value_crew');

            // empty getValueCategoriesSat
            getValueCrew.empty();

            // insert option
            getValueCrew.append("<option value=''>Seleccionar</option>");
            $.each(results, function(i,v){
              getValueCrew.append("<option value='"+v.id+"'>"+v.name+" "+v.last_name+"</option>");
            });

            $('.selectpicker').selectpicker('refresh');
          }
        },
        error: function(xhr, status){
          console.log('Error: '+xhr);
        }
      });

  });

  $(".validate-number-decimal").on({
    "focus": function(event) {
      $(event.target).select();
    },
    "keyup": function(event) {
      $(event.target).val(function(index, value) {
        return "$"+(value.replace(/\D/g, "")
          .replace(/([0-9])([0-9]{2})$/, '$1,$2')
          .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, "."));
      });
    }
  });

  $(".validate-number-decimal-not-ps").on({
    "focus": function(event) {
      $(event.target).select();
    },
    "keyup": function(event) {
      $(event.target).val(function(index, value) {
        return (value.replace(/\D/g, "")
          .replace(/([0-9])([0-9]{2})$/, '$1,$2')
          .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, "."));
      });
    }
  });

});
