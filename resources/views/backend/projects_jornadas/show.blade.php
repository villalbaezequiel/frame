@extends('layouts.admin')

@section('title', "Jornadas de Proyectos")

@section('content')
<div class="container-fluid">

  <div class="header text-center">
    <h3 class="title">{{ $project->name }}</h3>
    <p class="category">{{ $project->description }}</p>
  </div>

  <div class="row">
    <div class="col-md-12 ml-auto mr-auto">
      <div class="card card-calendar">
        <div class="card-body ">
          <div id="fullCalendarProject"></div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
@section('javascript')
  <script type="text/javascript">
    var project = {!! json_encode($project,JSON_FORCE_OBJECT) !!};
    var list_crew = {!! json_encode($list_crew,JSON_FORCE_OBJECT) !!};
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale/es.js"> </script>
  <script src="{{ asset('/js/project_calendar.js') }}"> </script>
@endsection
