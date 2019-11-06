@extends('layouts.admin')

@section('title', "Teams / Historial de Proyectos")

@section('content')
<div class="container-fluid">

    <a href='{{ url("/export/team/history_projects/$id_provider") }}' class="btn btn-primary">Descargar Historial Proyectos</a>

    <div class="header text-center">
      <h3 class="title">{{ $team_name }}</h3>
    </div>

    <div class="row">
      <div class="col-md-12 ml-auto mr-auto">

        @if(!count($projects))
          <div class="toolbar">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              No se encontro Historial de Proyectos.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        @else

          @foreach($projects as $project)
            <h4 class="col-md-12 btn btn-primary">{{ $project->name }}</h4>

            <div class="row justify-content-center">
              @foreach($list_crew as $item_crew)

                @if($item_crew->id_project == $project->id_project)
                <div class="col-md-4 d-flex group-more-team" data-idprovider="{{ $item_crew->id_provider }}" data-name="{{ \App\Provider::getNameOrderLastName($item_crew->id_provider) }}" id="item_view_{{ $item_crew->id_provider }}">
                  <div class="card mb-3">
                    <div class="card-header card-section-color edit-text-function_frame">
                      {{ \App\FrameFunction::getName($item_crew->id_function_frame) }}
                    </div>
                    <div class="card-body">
                      <p class="card-text mb-2 edit-text-category_sat">{{ \App\WorkersCategory::getName($item_crew->id_category_sat) }}</p>
                      <p class="card-text mb-2 edit-text-dates">Fechas: {{ \App\Helpers::getDateParseFormat($item_crew->start_date_contract, '/') }} a {{ \App\Helpers::getDateParseFormat($item_crew->finish_date_contract, '/') }}</p>
                      <p class="card-text mb-2 edit-text-contract">Contrato: {{ \App\Contract::getName($item_crew->id_contract) }}</p>
                      <p class="card-text mb-2 edit-text-active">Estado: {{ \App\ProjectProvider::getActive($item_crew->active) }}</p>
                      <p class="card-text mb-2 edit-text-puesto">Puesto: {{ \App\ProjectProvider::getPuesto($item_crew->id) }}</p>
                    </div>
                    <div class="card-footer card-footer-project pt-0">
                      <a href="{{ url('/export/crew_contract/'.$item_crew->id) }}" target="_blank" class="btn btn-link btn-warning btn-just-icon edit" title="Descargar Contrato"><i class="material-icons">assignment</i></a>
                      <a href="{{ url('/export/release/'.$item_crew->id) }}" target="_blank" class="btn btn-link btn-warning btn-just-icon edit" title="Descargar Release"><i class="material-icons">assignment</i></a>
                    </div>
                  </div>
                </div>
                @endif

              @endforeach
            </div>
          @endforeach

        @endif
    </div>
  </div>
</div>
@endsection
