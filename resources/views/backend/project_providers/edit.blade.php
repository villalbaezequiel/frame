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
      <div class="col-md-12">
        {!! Form::open(['route' => ['project_providers.update' , $crew->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
          <div class="form-group">
            <label>Crew:</label>
            <input type="text" class="form-control" value="{{ \App\Provider::getName($crew->id_provider) }}" disabled>
          </div>
          <div class="form-group">
            <label>Función Frame:</label>
            <input type="text" class="form-control" value="{{ \App\FrameFunction::getName($crew->id_function_frame) }}" disabled>
          </div>
          <div class="form-group">
            <label>Categoría SAT:</label>
            <input type="text" class="form-control" value="{{ \App\WorkersCategory::getName($crew->id_category_sat) }}" disabled>
          </div>
          <div class="form-group">
            <label>Tipo de Contrato:</label>
            <input type="text" class="form-control" value="{{ \App\Contract::getName($crew->id_contract) }}" disabled>
          </div>
          <div class="form-group">
            <label>Fecha de Alta Contrato:</label>
            <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($crew->start_date_contract) }}" disabled>
          </div>
          <div class="form-group">
            <label>Fecha de Baja Contrato:</label>
            <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($crew->finish_date_contract) }}" disabled>
          </div>
          <div class="form-group">
            <label>Modalidad:</label>
            <input type="text" class="form-control" value="{{ \App\Project::getModalidad($crew->id_project) }}" disabled>
          </div>
          <div class="form-group">
            <label>Cantidad de Jornadas Laborables:</label>
            <input type="text" class="form-control" value="{{ $crew->count_workdays_crew}}" disabled>
          </div>
          <div class="form-group">
            <label>Fecha de Alta AFIP:</label>
            <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($crew->start_afip) }}" disabled>
          </div>
          <div class="form-group">
            <label>Fecha de Baja AFIP:</label>
            <input type="text" class="form-control" value="{{ \App\Helpers::getDateParseFormat($crew->finish_afip) }}" disabled>
          </div>
          <div class="form-group">
            <label>Sueldo Jornada:</label>
            <input type="text" class="form-control" value="{{ $crew->salary_workdays}}" disabled>
          </div>
          <div class="form-group">
            <label>Sueldo Total:</label>
            <input type="text" class="form-control" value="{{ $crew->total_workdays}}" disabled>
          </div>
          <div class="form-group">
            <label>Sueldo Contrato Mensual:</label>
            <input type="text" class="form-control" value="{{ $crew->salary_contract_category_function}}" disabled>
          </div>
          <div class="form-group">
            <label>Sueldo Diario SAT:</label>
            <input type="text" class="form-control" value="{{ $crew->salary_daily}}" disabled>
          </div>
          <div class="form-group">
            <label>Sueldo A Liquidar Neto:</label>
            <input type="text" class="form-control" value="{{ $crew->salary_liquidate}}" disabled>
          </div>
          <div class="form-group">
            <label>Diferencia:</label>
            <input type="text" class="form-control" value="{{ $crew->salaty_difference}}" disabled>
          </div>
          <div class="form-group">
            <label>Activo:</label>
            <input type="text" class="form-control" value="{{ \App\Helpers::getActive($crew->active)}}" disabled>
          </div>
<!--
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Agregar" />
          </div> -->
        </form>
        {!! Form::close() !!}
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
