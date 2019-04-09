<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crew</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>

    <div class="container-fluid">
      <h4>Horas Extras de {{ \App\Provider::getNameOrderLastName($crew->id_provider) }}</h4>
      <div class="col-md-12">
        <table class="table" style="margin: 0 auto;">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Inicio (hs)</th>
              <th>Final (hs)</th>
              <th>Cantidad Total(hs)</th>
              <th>Precio por Hora</th>
            </tr>
          </thead>
          <tbody class="list_extra_hour">
          </tbody>
          <tfoot>
            <tr>
              <th>Fecha</th>
              <th>Inicio (hs)</th>
              <th>Final (hs)</th>
              <th>Cantidad Total(hs)</th>
              <th>Precio por Hora</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
      var extra_hours = {!! json_encode($crew->extra_hours,JSON_FORCE_OBJECT) !!};

      function parseDate(date){
        return ("0" + (date)).slice(-2);
      }

      function timeConvert(n) {
        var num = n;
        var hours = (num / 60);
        var rhours = Math.floor(hours);
        var minutes = (hours - rhours) * 60;
        var rminutes = Math.round(minutes);
        return rhours + " hora(s) y " + rminutes + " minuto(s).";
      }

      $.each(extra_hours, function(i,v){
        var start = new Date(v.start);
        var finish = new Date(v.finish);
        var day = start.getFullYear();
        var countHour = ((finish - start) / 60000);

        $(".list_extra_hour").append("<tr> "+
                          "<td>"+parseDate(start.getDay())+'-'+parseDate(start.getMonth())+'-'+start.getFullYear()+"</td>"+
                          "<td>"+parseDate(start.getHours())+':'+parseDate(start.getMinutes())+"</td>"+
                          "<td>"+parseDate(finish.getHours())+':'+parseDate(finish.getMinutes())+"</td>"+
                          "<td>"+timeConvert(countHour)+"</td>"+
                          "<td>$"+v.price+"</td>"+
                      "</tr>");

      });
    </script>

  </body>
</html>
