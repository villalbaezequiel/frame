function getFormatNumber(number){
  var numberInt = number.toString().split('.');
  if(numberInt[1]){
    if(numberInt[0].length == 4) {
      return numberInt[0].substr(0, 1)+"."+numberInt[0].substr(-3)+","+numberInt[1];
    } else if(numberInt[0].length == 5){
      return numberInt[0].substr(0, 2)+"."+numberInt[0].substr(-3)+","+numberInt[1];
    } else if(numberInt[0].length == 6) {
      return numberInt[0].substr(0, 3)+"."+numberInt[0].substr(-3)+","+numberInt[1];
    } else {
      return numberInt[0]+","+numberInt[1];
    }
  } else {
    if(numberInt[0].length == 4) {
      return numberInt[0].substr(0, 1)+"."+numberInt[0].substr(-3)+",00";
    } else if(numberInt[0].length == 5){
      return numberInt[0].substr(0, 2)+"."+numberInt[0].substr(-3)+",00";
    } else if(numberInt[0].length == 6) {
      return numberInt[0].substr(0, 3)+"."+numberInt[0].substr(-3)+",00";
    } else {
      return numberInt[0]+","+numberInt[1];
    }
  }
}

$(document).ready(function(){

  // input validate
  var rules = {
        id_client: {
          required: true
        },
        name: {
          required: true,
          maxlength: 125
        },
        description: {
          maxlength: 125
        },
        id_proyect_category: {
          required: true
        },
        start_date: {
          required: true
        },
        finish_date: {
          required: true
        },
        id_workday: {
          required: true
        },
        duration_workdays: {
          required: true
        },
        days: {
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
      var parentForm = $(this).parents('form');
      if(parentForm.length != 1 || $(this).hasClass('back-history')){
        e.preventDefault();
        alertLeaveForm(this);
      }
    }

  });

  $("#add_crew").click(function(){
    // list values
    var id_function_frame = $('select[name=id_function_frame]').val();
    var id_category_sat = $('select[name=id_category_sat]').val(); // agregar al schema ´project_providers´
    var id_provider = $('select[name=id_provider]').val();
    var id_contract = $('select[name=id_contract]').val();
    var salary_workdays = $('input[name=salary_workdays]').val();
    var total_workdays = $('input[name=total_workdays]').val();
    var total_workdays_text = $('input[name=total_workdays_text]').val();
    var salary_contract_category_function = $('input[name=salary_contract_category_function]').val();
    var salary_daily = $('input[name=salary_daily]').val();
    var salary_liquidate = $('input[name=salary_liquidate]').val();
    var salaty_difference = $('input[name=crew_sueldo_diferencia]').val();
    var start_date_contract = $('input[name=start_date_contract]').val();
    var finish_date_contract = $('input[name=finish_date_contract]').val();
    var count_workdays_crew = $('input[name=count_workdays_crew]').val();
    var start_afip = $('input[name=start_afip]').val();
    var finish_afip = $('input[name=finish_afip]').val();

    if(id_function_frame && id_category_sat && id_contract && id_provider &&
       salary_workdays && total_workdays && total_workdays_text && salary_contract_category_function &&
       salary_daily && salary_liquidate && start_date_contract && finish_date_contract &&
       count_workdays_crew && start_afip && finish_afip)
    {

      // object crew
      var crew = {
        'id_function_frame': id_function_frame,
        'id_category_sat': id_category_sat,
        'id_provider': id_provider,
        'id_contract': id_contract,
        'salary_workdays': salary_workdays,
        'total_workdays': total_workdays,
        'total_workdays_text': total_workdays_text,
        'salary_contract_category_function': salary_contract_category_function,
        'salary_daily': salary_daily,
        'salary_liquidate': salary_liquidate,
        'salaty_difference': salaty_difference,
        'start_date_contract': start_date_contract,
        'finish_date_contract': finish_date_contract,
        'count_workdays_crew': count_workdays_crew,
        'start_afip': start_afip,
        'finish_afip': finish_afip
      };

      // verificar si el Crew esta en otro proecto en esas fechas
      $.ajax({
        type: 'GET',
        url: '/sistema/json/check_crew_project/'+id_provider+'/'+start_date_contract.replace(/\//g, '-'),
        dataType: 'json',
        success: function(data){

          var status = data.status;

          if(status == true){

            // add crew
            // add crew to list input request
            if($('#'+id_provider).length == 0){
              $('.list_crew').append("<input type='hidden' name='list_crew[]' id='"+id_provider+"' value='' />");
              $('#'+id_provider).val(JSON.stringify(crew));

            } else {
              $('#'+id_provider).val('');
              $('#'+id_provider).val(JSON.stringify(crew));

              // remove item_view
              $("#item_view_"+id_provider).remove();
            }

            // check jornada de trabajo del proyecto segun la jornada que mas tenga de los CREW
            if(isNaN(parseFloat($('input[name=count_workdays]').val()))) {
              $('input[name=count_workdays]').val(count_workdays_crew);
            } else if($("select[name=id_workday]").find(':selected').data('day') != 1){
              if(parseFloat($('input[name=count_workdays]').val()) <= parseFloat(count_workdays_crew)){
                $('input[name=count_workdays]').val(count_workdays_crew);
              }
            }

            // add crew list table front
            var crewName = $('select[name=id_provider] option:selected').text();
            var crewFrameSat = $('select[name=id_function_frame] option:selected').text()+" / "+$('select[name=id_category_sat] option:selected').text();
            var crewDates = start_date_contract+" - "+finish_date_contract;

            // button to onClick add remove crew
            var onClickRemoveCrew = "$('#'+$(this).data('itemremove')).remove();$('#'+$(this).data('idcrew')).remove()";

            // add html list crew view
            $('.list_crew_view').append("<tr id='item_view_"+id_provider+"'><td>"+crewName+"</td><td>"+crewFrameSat+"</td><td>"+crewDates+"</td><td><button type='button' class='btn btn-link btn-danger btn-just-icon remove' onClick="+onClickRemoveCrew+" data-idcrew='"+id_provider+"' data-itemremove='item_view_"+id_provider+"' title='Eliminar'><i class='material-icons'>close</i></button></td></tr>");

            // restart input add crew
            $(".empty-values-finish-add-crew input").val('');

          } else {
            Swal.fire({
              type: 'warning',
              title: 'El Crew se encuentra Trabajando en otro Proyecto, en las Fechas de Contrato selecionadas!',
              text: "Por favor ingrese nuevas Fechas de Contrato o pruebe con Otro Crew.",
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, continuar!'
            });
            return false;
          }

        },
        error: function(xhr, status){
          console.log('Error: '+xhr);
        }
      });

    } else {
      alert('Complete los datos correspondientes para agregar un Crew!');
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

        if(crew_sueldo_diferencia > 0){
          $('input[name=crew_sueldo_diferencia]').css({backgroundColor: "green", color: "white"});
        } else {
          $('input[name=crew_sueldo_diferencia]').css({backgroundColor: "red", color: "white"});
        }

      } else {
        alert('Seleccione una Categoria SAT, para que se autocomplete los campos de Sueldos.');
      }

    } else {
      alert('Ingrese un Valor en Cantidad de Jornadas Laborables y Sueldo Jornada, para que se autocomplete el campo seleccionado.');
    }
  });

  $('input[name=salary_contract_category_function]').click(function(){
    if($('input[name=salary_contract_category_function]').val() == "" ){
      alert('Seleccione una Categoria SAT, para que se autocomplete los campos de Sueldos.');
    };
  });


  $(".get_value_categories_sat").change(function(){
    var salaryneto = $(this).find(':selected').data('salaryneto');
    if(salaryneto){
      $('input[name=salary_contract_category_function]').val(salaryneto);
    }
  });

  // module 2 Jornadas
  $("select[name=id_workday]").change(function(){
    if($(this).find(':selected').data('day') == 1){
      $('input[name=count_workdays]').removeAttr('readonly');
    } else {
      $('input[name=count_workdays]').attr('readonly', 'readonly');
      $('input[name=count_workdays]').val('');
    }
    $("select[name=view_modality_work]").find('option').remove().end().append('<option selected="selected">'+$(this).find(':selected').text()+'</option>');
    $('.selectpicker').selectpicker('refresh');
  });


  // remove by ajax crew list on project
  $(".alert-confirm-delete-button").click(function() {

    var form = $(this).data('id');
    var idProvider = $(this).data('idprovider');

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
    openWindowUrl(url);
  });

});
