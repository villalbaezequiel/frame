<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\TeamProject;
use App\Notifications\SeguroServicios;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateInterval;
use DatePeriod;
use App\User;
use App\Provider;
use App\Helpers;
use App\Project;
use App\ProjectProvider;
use App\CenterCost;

class ProjectsController extends Controller
{

    protected $_permission;
    protected $permissionApproved = ['1', '2'];

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware(function ($request, $next) {
        $cancelPermission = true;
        $this->_permission = json_decode(Auth::user()->permissions);

        if($this->_permission){
          foreach($this->permissionApproved as $approved){
            foreach($this->_permission as $userPermission){
              if($approved == $userPermission){
                $cancelPermission = false;
                return $next($request);
              }
            }
          }
        }

      });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       return view('backend.projects.index', [
         'projects' => Project::orderBy('id', 'DESC')->get()
       ]);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
       return view('backend.projects.create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
        $message;
        try {
          /*
           Cuando se crea un Proyecto, los usuarios asociados quedan pendientes.
           Ellos tienen que confirmar la solicitud que pueden SI trabajar en ese Proyecto.
          */
          $list_crew = $request->get('list_crew');
          $list_crew_secundario = $request->get('list_crew_secundario');

          if(empty($list_crew[0])){
            return redirect('/projects/create')->with('message', 'Error al Crear Proyecto. Debe Agregar al menos un Team!');
          }

          $start_date = explode('/', $request->get('start_date'));
          $finish_date = explode('/', $request->get('finish_date'));

          $project = new Project;
          $project->id_client = $request->get('id_client');
          $project->name = $request->get('name');
          $project->description = $request->get('description');
          $project->observations = $request->get('observations');
          $project->cost_center = $request->get('cost_center');
          $project->id_proyect_category = $request->get('id_proyect_category');
          $project->id_team_referring = $request->get('id_team_referring');
          $project->start_date = (isset($start_date[2]) ? $start_date[2].'-'.$start_date[1].'-'.$start_date[0] : $request->get('start_date'));
          $project->finish_date = (isset($finish_date[2]) ? $finish_date[2].'-'.$finish_date[1].'-'.$finish_date[0] : $request->get('finish_date'));
          $project->clausula_no_repe = $request->get('clausula_no_repe');
          $project->certificado_cobertura = $request->get('certificado_cobertura');
          $project->is_closed = '0'; // 0 = abierto / 1 = cerrado
          $project->active = '0'; // cuando todos los proveedores que se agregaron aceptan la solicitud del proyecto, automaticamente cambia su estado a activo 1. Y cuando el proyecto finaliza tambien se da de baja el mismo.
          $project->save();

          // update module CenterCost
          $center_cost = CenterCost::find($request->get('cost_center'));
          $center_cost->assigne = '1';
          $center_cost->save();

          // add provides Titulares relation Project
          foreach ($list_crew as $crew) {
            $crewObj = json_decode($crew);

            // si es contrato tipo servicio, dates afip nulo
            if($crewObj->id_contract != '4'){
              $start_afipParse = explode('/', $crewObj->start_afip);
              $finish_afipParse = explode('/', $crewObj->finish_afip);

              $start_afip = (isset($start_afipParse[2]) ? $start_afipParse[2].'-'.$start_afipParse[1].'-'.$start_afipParse[0] : $crewObj->start_afip);
              $finish_afip = (isset($finish_afipParse[2]) ? $finish_afipParse[2].'-'.$finish_afipParse[1].'-'.$finish_afipParse[0] : $crewObj->finish_afip);
            } else {
              $start_afip = null;
              $finish_afip = null;
            }

            $start_date_contract = explode('/', $crewObj->start_date_contract);
            $finish_date_contract = explode('/', $crewObj->finish_date_contract);

            $calendar = array();
            $startDatejson = new DateTime( $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] );
            $endDatejson = new DateTime( $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] );
            $endDatejson = $endDatejson->modify( '+1 day' );
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($startDatejson, $interval ,$endDatejson);
            foreach($daterange as $date){
                $calendar[$date->format("Ymd")] = array(
                                'start' => $date->format("Y-m-d")." ".$crewObj->hour_initial.":00",
                                'finish' => $date->format("Y-m-d")." ".$crewObj->hour_initial.":00"
                              );
            }

            $team = new ProjectProvider;
            $team->id_project = $project->id;
            $team->id_function_frame = $crewObj->id_function_frame;
            $team->id_category_sat = $crewObj->id_category_sat;
            $team->id_provider = $crewObj->id_provider;
            $team->id_contract = $crewObj->id_contract;
            $team->id_workday = $crewObj->id_workday;
            $team->salary_workdays = $crewObj->salary_workdays;
            $team->total_workdays = $crewObj->total_workdays;
            $team->total_workdays_text = $crewObj->total_workdays_text;
            $team->salary_contract_category_function = $crewObj->salary_contract_category_function;
            $team->salary_daily = $crewObj->salary_daily;
            $team->salary_liquidate = $crewObj->salary_liquidate;
            $team->salaty_difference = $crewObj->salaty_difference;
            $team->start_date_contract = (isset($start_date_contract[2]) ? $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] : $crewObj->start_date_contract);
            $team->finish_date_contract = (isset($finish_date_contract[2]) ? $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] : $crewObj->finish_date_contract);
            $team->count_workdays_crew = $crewObj->count_workdays_crew;
            $team->hour_initial = $crewObj->hour_initial;
            $team->hour_end = $crewObj->hour_end;
            $team->start_afip = $start_afip;
            $team->finish_afip = $finish_afip;
            $team->is_reemplazo = $crewObj->is_reemplazo;
            $team->id_crew_reemplazo = $crewObj->id_crew_reemplazo;
            $team->calendar = $calendar;
            $team->active = $crewObj->active;
            $team->save();

            $user = User::find(Provider::getIdUser($team->id_provider));

            // Enviar Mails a los crew notificandolo del proyecto y si acepta trabajar
            $data = array(
              'project' => $project,
              'user' => $user,
              'project_crew' => $team
            );

            if($request->get('notification_team') == "1" || $request->get('notification_team') == 1) {
              $user->notify(new TeamProject($data));
            }

          }

          // add crew Secundarios
          if(!empty($list_crew_secundario)){
            foreach ($list_crew_secundario as $crew) {
              $crewObj = json_decode($crew);

              // si es contrato tipo servicio, dates afip nulo
              if($crewObj->id_contract != '4'){
                $start_afipParse = explode('/', $crewObj->start_afip);
                $finish_afipParse = explode('/', $crewObj->finish_afip);

                $start_afip = (isset($start_afipParse[2]) ? $start_afipParse[2].'-'.$start_afipParse[1].'-'.$start_afipParse[0] : $crewObj->start_afip);
                $finish_afip = (isset($finish_afipParse[2]) ? $finish_afipParse[2].'-'.$finish_afipParse[1].'-'.$finish_afipParse[0] : $crewObj->finish_afip);
              } else {
                $start_afip = null;
                $finish_afip = null;
              }

              $start_date_contract = explode('/', $crewObj->start_date_contract);
              $finish_date_contract = explode('/', $crewObj->finish_date_contract);

              $calendar = array();
              $startDatejson = new DateTime( $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] );
              $endDatejson = new DateTime( $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] );
              $endDatejson = $endDatejson->modify( '+1 day' );
              $interval = new DateInterval('P1D');
              $daterange = new DatePeriod($startDatejson, $interval ,$endDatejson);
              foreach($daterange as $date){
                  $calendar[$date->format("Ymd")] = array(
                                  'start' => $date->format("Y-m-d")." ".$crewObj->hour_initial.":00",
                                  'finish' => $date->format("Y-m-d")." ".$crewObj->hour_initial.":00"
                                );
              }

              $team = new ProjectProvider;
              $team->id_project = $project->id;
              $team->id_function_frame = $crewObj->id_function_frame;
              $team->id_category_sat = $crewObj->id_category_sat;
              $team->id_provider = $crewObj->id_provider;
              $team->id_contract = $crewObj->id_contract;
              $team->id_workday = $crewObj->id_workday;
              $team->salary_workdays = $crewObj->salary_workdays;
              $team->total_workdays = $crewObj->total_workdays;
              $team->total_workdays_text = $crewObj->total_workdays_text;
              $team->salary_contract_category_function = $crewObj->salary_contract_category_function;
              $team->salary_daily = $crewObj->salary_daily;
              $team->salary_liquidate = $crewObj->salary_liquidate;
              $team->salaty_difference = $crewObj->salaty_difference;
              $team->start_date_contract = (isset($start_date_contract[2]) ? $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] : $crewObj->start_date_contract);
              $team->finish_date_contract = (isset($finish_date_contract[2]) ? $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] : $crewObj->finish_date_contract);
              $team->count_workdays_crew = $crewObj->count_workdays_crew;
              $team->hour_initial = $crewObj->hour_initial;
              $team->hour_end = $crewObj->hour_end;
              $team->start_afip = $start_afip;
              $team->finish_afip = $finish_afip;
              $team->is_reemplazo = $crewObj->is_reemplazo;
              $team->id_crew_reemplazo = $crewObj->id_crew_reemplazo;
              $team->calendar = $calendar;
              $team->active = $crewObj->active;
              $team->save();
            }
          }

          $crews_project = ProjectProvider::where('id_project', $project->id)
                                            ->where('is_reemplazo', '1')
                                            ->get();
          $status = true;

          foreach ($crews_project as $value) {
            if($value->active == '0'){
              $status = false;
            } elseif($value->active == '2'){

              // verifico si su Secundario acepto
              $checkSecundario = ProjectProvider::where('id_project', $project->id)
                                                ->where('is_reemplazo', '2')
                                                ->where('id_crew_reemplazo', $value->id_provider)
                                                ->first();
              if(!empty($checkSecundario)){
                if($checkSecundario->active == '0' || $checkSecundario->active == '2'){
                  $status = false;
                }
              } else {
                $status = false;
              }
            }
          }

          if($status == true){
            // project active 1
            $projectCheck = Project::find($project->id);
            $projectCheck->active = '1';
            $projectCheck->save();

            // chequer si tengo al menos un personal de tipo de contrato servicios
            $checkServices = ProjectProvider::where('id_project', $project->id)
                                            ->where('id_contract', '4') // 4 = Servicios
                                            ->count();

            if($checkServices > 0){
              // send mail al Profesional que ve la generacion de seguros
              if(!empty(env('MAIL_PERSONAL_SEGUROS_SERVICIOS'))){
                $personalSeguro = User::where('email', env('MAIL_PERSONAL_SEGUROS_SERVICIOS'))->first();

                $data = array(
                  'user' => $personalSeguro,
                  'project' => $projectCheck
                );
                $personalSeguro->notify(new SeguroServicios($data));
              }
            }
          }

          return redirect('/projects')->with('message', 'Proyecto creado con exito!');

       } catch(\Exception $e) {
        Helpers::getCapturError($e);
       }
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
       $project = Project::find($id);
       $listTeam = ProjectProvider::where('id_project', $id)->get();
       return view('backend.projects.edit', [
         'project' => $project,
         'list_crew' => $listTeam
       ]);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
        $message;
        try {
          /*
           Cuando se crea un Proyecto, los usuarios asociados quedan pendientes.
           Ellos tienen que confirmar la solicitud que pueden SI trabajar en ese Proyecto.
          */
          $list_crew = $request->get('list_crew');
          $list_crew_secundario = $request->get('list_crew_secundario');

          $start_date = explode('/', $request->get('start_date'));
          $finish_date = explode('/', $request->get('finish_date'));

          $project = Project::find($id);
          $project->id_client = $request->get('id_client');
          $project->name = $request->get('name');
          $project->description = $request->get('description');
          $project->id_proyect_category = $request->get('id_proyect_category');
          $project->start_date = (isset($start_date[2]) ? $start_date[2].'-'.$start_date[1].'-'.$start_date[0] : $request->get('start_date'));
          $project->finish_date = (isset($finish_date[2]) ? $finish_date[2].'-'.$finish_date[1].'-'.$finish_date[0] : $request->get('finish_date'));

          // update module CenterCost
          if($project->cost_center != $request->get('cost_center'))
          {
            // habilito el anterior centro de costo del proyecto
            if(CenterCost::find($project->cost_center)){
              $center_cost_old = CenterCost::find($project->cost_center);
              $center_cost_old->assigne = '0';
              $center_cost_old->save();
            }

            // actualizo el nuevo centro de costo para el proyecto
            $center_cost = CenterCost::find($request->get('cost_center'));
            $center_cost->assigne = '1';
            $center_cost->save();

            $project->cost_center = $request->get('cost_center');
          } else {
            $project->cost_center = $request->get('cost_center');
          }

          $project->id_team_referring = $request->get('id_team_referring');
          $project->observations = $request->get('observations');
          $project->clausula_no_repe = $request->get('clausula_no_repe');
          $project->certificado_cobertura = $request->get('certificado_cobertura');
          $project->save();

          // add provides relation Project
          if(!empty($list_crew)){
            foreach ($list_crew as $crew) {
              $crewObj = json_decode($crew);

              // si es contrato tipo servicio, dates afip nulo
              if($crewObj->id_contract != '4'){
                $start_afipParse = explode('/', $crewObj->start_afip);
                $finish_afipParse = explode('/', $crewObj->finish_afip);

                $start_afip = (isset($start_afipParse[2]) ? $start_afipParse[2].'-'.$start_afipParse[1].'-'.$start_afipParse[0] : $crewObj->start_afip);
                $finish_afip = (isset($finish_afipParse[2]) ? $finish_afipParse[2].'-'.$finish_afipParse[1].'-'.$finish_afipParse[0] : $crewObj->finish_afip);
              } else {
                $start_afip = null;
                $finish_afip = null;
              }

              $start_date_contract = explode('/', $crewObj->start_date_contract);
              $finish_date_contract = explode('/', $crewObj->finish_date_contract);

              $calendar = array();
              $startDatejson = new DateTime( $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] );
              $endDatejson = new DateTime( $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] );
              $endDatejson = $endDatejson->modify( '+1 day' );
              $interval = new DateInterval('P1D');
              $daterange = new DatePeriod($startDatejson, $interval ,$endDatejson);
              foreach($daterange as $date){
                  $calendar[$date->format("Ymd")] = array(
                                  'start' => $date->format("Y-m-d")." ".$crewObj->hour_initial.":00",
                                  'finish' => $date->format("Y-m-d")." ".$crewObj->hour_initial.":00"
                                );
              }

              if($crewObj->id_project_provider){
                $team = ProjectProvider::find($crewObj->id_project_provider);
                $team->id_project = $project->id;
                $team->id_function_frame = $crewObj->id_function_frame;
                $team->id_category_sat = $crewObj->id_category_sat;
                $team->id_provider = $crewObj->id_provider;
                $team->id_contract = $crewObj->id_contract;
                $team->id_workday = $crewObj->id_workday;
                $team->salary_workdays = $crewObj->salary_workdays;
                $team->total_workdays = $crewObj->total_workdays;
                $team->total_workdays_text = $crewObj->total_workdays_text;
                $team->salary_contract_category_function = $crewObj->salary_contract_category_function;
                $team->salary_daily = $crewObj->salary_daily;
                $team->salary_liquidate = $crewObj->salary_liquidate;
                $team->salaty_difference = $crewObj->salaty_difference;
                $team->start_date_contract = (isset($start_date_contract[2]) ? $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] : $crewObj->start_date_contract);
                $team->finish_date_contract = (isset($finish_date_contract[2]) ? $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] : $crewObj->finish_date_contract);
                $team->count_workdays_crew = $crewObj->count_workdays_crew;
                $team->hour_initial = $crewObj->hour_initial;
                $team->hour_end = $crewObj->hour_end;
                $team->start_afip = $start_afip;
                $team->finish_afip = $finish_afip;
                $team->is_reemplazo = $crewObj->is_reemplazo;
                $team->id_crew_reemplazo = $crewObj->id_crew_reemplazo;
                $team->calendar = $calendar;
                $team->active = $crewObj->active;
                $team->save();
              } else {
                $team = new ProjectProvider;
                $team->id_project = $project->id;
                $team->id_function_frame = $crewObj->id_function_frame;
                $team->id_category_sat = $crewObj->id_category_sat;
                $team->id_provider = $crewObj->id_provider;
                $team->id_contract = $crewObj->id_contract;
                $team->id_workday = $crewObj->id_workday;
                $team->salary_workdays = $crewObj->salary_workdays;
                $team->total_workdays = $crewObj->total_workdays;
                $team->total_workdays_text = $crewObj->total_workdays_text;
                $team->salary_contract_category_function = $crewObj->salary_contract_category_function;
                $team->salary_daily = $crewObj->salary_daily;
                $team->salary_liquidate = $crewObj->salary_liquidate;
                $team->salaty_difference = $crewObj->salaty_difference;
                $team->start_date_contract = (isset($start_date_contract[2]) ? $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] : $crewObj->start_date_contract);
                $team->finish_date_contract = (isset($finish_date_contract[2]) ? $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] : $crewObj->finish_date_contract);
                $team->count_workdays_crew = $crewObj->count_workdays_crew;
                $team->hour_initial = $crewObj->hour_initial;
                $team->hour_end = $crewObj->hour_end;
                $team->start_afip = $start_afip;
                $team->finish_afip = $finish_afip;
                $team->is_reemplazo = $crewObj->is_reemplazo;
                $team->id_crew_reemplazo = $crewObj->id_crew_reemplazo;
                $team->calendar = $calendar;
                $team->active = $crewObj->active;
                $team->save();
              }

              $user = User::find(Provider::getIdUser($team->id_provider));

              // Enviar Mails a los crew notificandolo del proyecto y si acepta trabajar
              $data = array(
                'project' => $project,
                'user' => $user,
                'project_crew' => $team
              );

              if($request->get('notification_team') == "1" || $request->get('notification_team') == 1) {
                $user->notify(new TeamProject($data));
              }
            }
          }

          // add crew Secundarios
          if(!empty($list_crew_secundario)){
            foreach ($list_crew_secundario as $crew) {
              $crewObj = json_decode($crew);

              // si es contrato tipo servicio, dates afip nulo
              if($crewObj->id_contract != '4'){
                $start_afipParse = explode('/', $crewObj->start_afip);
                $finish_afipParse = explode('/', $crewObj->finish_afip);

                $start_afip = (isset($start_afipParse[2]) ? $start_afipParse[2].'-'.$start_afipParse[1].'-'.$start_afipParse[0] : $crewObj->start_afip);
                $finish_afip = (isset($finish_afipParse[2]) ? $finish_afipParse[2].'-'.$finish_afipParse[1].'-'.$finish_afipParse[0] : $crewObj->finish_afip);
              } else {
                $start_afip = null;
                $finish_afip = null;
              }

              $start_date_contract = explode('/', $crewObj->start_date_contract);
              $finish_date_contract = explode('/', $crewObj->finish_date_contract);

              $calendar = array();
              $startDatejson = new DateTime( $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] );
              $endDatejson = new DateTime( $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] );
              $endDatejson = $endDatejson->modify( '+1 day' );
              $interval = new DateInterval('P1D');
              $daterange = new DatePeriod($startDatejson, $interval ,$endDatejson);
              foreach($daterange as $date){
                  $calendar[$date->format("Ymd")] = array(
                                  'start' => $date->format("Y-m-d")." ".$crewObj->hour_initial.":00",
                                  'finish' => $date->format("Y-m-d")." ".$crewObj->hour_initial.":00"
                                );
              }

              if($crewObj->id_project_provider){
                $team = ProjectProvider::find($crewObj->id_project_provider);
                $team->id_project = $project->id;
                $team->id_function_frame = $crewObj->id_function_frame;
                $team->id_category_sat = $crewObj->id_category_sat;
                $team->id_provider = $crewObj->id_provider;
                $team->id_contract = $crewObj->id_contract;
                $team->id_workday = $crewObj->id_workday;
                $team->salary_workdays = $crewObj->salary_workdays;
                $team->total_workdays = $crewObj->total_workdays;
                $team->total_workdays_text = $crewObj->total_workdays_text;
                $team->salary_contract_category_function = $crewObj->salary_contract_category_function;
                $team->salary_daily = $crewObj->salary_daily;
                $team->salary_liquidate = $crewObj->salary_liquidate;
                $team->salaty_difference = $crewObj->salaty_difference;
                $team->start_date_contract = (isset($start_date_contract[2]) ? $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] : $crewObj->start_date_contract);
                $team->finish_date_contract = (isset($finish_date_contract[2]) ? $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] : $crewObj->finish_date_contract);
                $team->count_workdays_crew = $crewObj->count_workdays_crew;
                $team->hour_initial = $crewObj->hour_initial;
                $team->hour_end = $crewObj->hour_end;
                $team->start_afip = $start_afip;
                $team->finish_afip = $finish_afip;
                $team->is_reemplazo = $crewObj->is_reemplazo;
                $team->id_crew_reemplazo = $crewObj->id_crew_reemplazo;
                $team->calendar = $calendar;
                $team->active = $crewObj->active;
                $team->save();
              } else {
                $team = new ProjectProvider;
                $team->id_project = $project->id;
                $team->id_function_frame = $crewObj->id_function_frame;
                $team->id_category_sat = $crewObj->id_category_sat;
                $team->id_provider = $crewObj->id_provider;
                $team->id_contract = $crewObj->id_contract;
                $team->id_workday = $crewObj->id_workday;
                $team->salary_workdays = $crewObj->salary_workdays;
                $team->total_workdays = $crewObj->total_workdays;
                $team->total_workdays_text = $crewObj->total_workdays_text;
                $team->salary_contract_category_function = $crewObj->salary_contract_category_function;
                $team->salary_daily = $crewObj->salary_daily;
                $team->salary_liquidate = $crewObj->salary_liquidate;
                $team->salaty_difference = $crewObj->salaty_difference;
                $team->start_date_contract = (isset($start_date_contract[2]) ? $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] : $crewObj->start_date_contract);
                $team->finish_date_contract = (isset($finish_date_contract[2]) ? $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] : $crewObj->finish_date_contract);
                $team->count_workdays_crew = $crewObj->count_workdays_crew;
                $team->hour_initial = $crewObj->hour_initial;
                $team->hour_end = $crewObj->hour_end;
                $team->start_afip = $start_afip;
                $team->finish_afip = $finish_afip;
                $team->is_reemplazo = $crewObj->is_reemplazo;
                $team->id_crew_reemplazo = $crewObj->id_crew_reemplazo;
                $team->calendar = $calendar;
                $team->active = $crewObj->active;
                $team->save();
              }
            }
          }

          $crews_project = ProjectProvider::where('id_project', $project->id)
                                            ->where('is_reemplazo', '1')
                                            ->get();
          $status = true;

          foreach ($crews_project as $value) {
            if($value->active == '0'){
              $status = false;
            } elseif($value->active == '2'){

              // verifico si su Secundario acepto
              $checkSecundario = ProjectProvider::where('id_project', $project->id)
                                                ->where('is_reemplazo', '2')
                                                ->where('id_crew_reemplazo', $value->id_provider)
                                                ->first();
              if(!empty($checkSecundario)){
                if($checkSecundario->active == '0' || $checkSecundario->active == '2'){
                  $status = false;
                }
              } else {
                $status = false;
              }
            }
          }

          if($status == true){
            // project active 1
            $projectCheck = Project::find($project->id);
            $projectCheck->active = '1';
            $projectCheck->save();

            // chequer si tengo al menos un personal de tipo de contrato servicios
            $checkServices = ProjectProvider::where('id_project', $project->id)
                                            ->where('id_contract', '4') // 4 = Servicios
                                            ->count();

            if($checkServices > 0){
              // send mail al Profesional que ve la generacion de seguros
              if(!empty(env('MAIL_PERSONAL_SEGUROS_SERVICIOS'))){
                $personalSeguro = User::where('email', env('MAIL_PERSONAL_SEGUROS_SERVICIOS'))->first();

                $data = array(
                  'user' => $personalSeguro,
                  'project' => $projectCheck
                );
                $personalSeguro->notify(new SeguroServicios($data));
              }
            }
          }

          return redirect('/projects')->with('message', 'Proyecto editado con exito!');

       } catch(\Exception $e) {
        Helpers::getCapturError($e);
       }
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
        $project = Project::find($id);
        $project->delete();

        // eliminar los datos relacionados en ProjectProvider
        $crewList = ProjectProvider::where('id_project', $id)->get();
        if($crewList[0]){
          foreach ($crewList as $val) {
            $crew = ProjectProvider::find($val->id);
            $crew->delete();
          }
        }

       return response(array('message' => 'Proyecto eliminado con exito!'));
     }

 }
