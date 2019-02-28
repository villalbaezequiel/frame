<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use App\Project;
use App\ProjectProvider;

class ProjectsController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('permission:projects', ['except' => ['index','create', 'store', 'edit', 'update', 'show','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       return view('backend.projects.index', [
         'projects' => Project::all()
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

          if(empty($list_crew[0])){
            return redirect('/projects/create')->with('message', 'Error al Crear Proyecto. Debe Agregar al menos un Crew!');
          }

          $start_date = explode('/', $request->get('start_date'));
          $finish_date = explode('/', $request->get('finish_date'));

          $project = new Project;
          $project->id_client = $request->get('id_client');
          $project->name = $request->get('name');
          $project->description = $request->get('description');
          $project->id_proyect_category = $request->get('id_proyect_category');
          $project->start_date = (isset($start_date[2]) ? $start_date[2].'-'.$start_date[1].'-'.$start_date[0] : $request->get('start_date'));
          $project->finish_date = (isset($finish_date[2]) ? $finish_date[2].'-'.$finish_date[1].'-'.$finish_date[0] : $request->get('finish_date'));
          $project->count_workdays = $request->get('count_workdays');
          $project->duration_workdays = $request->get('duration_workdays');
          $project->id_workday = $request->get('id_workday');
          $project->days = $request->get('days');
          $project->active = '0'; // cuando todos los proveedores que se agregaron aceptan la solicitud del proyecto, automaticamente cambia su estado a activo 1. Y cuando el proyecto finaliza tambien se da de baja el mismo.
          $project->save();

          // add provides relation Project
          foreach ($list_crew as $crew) {
            $crewObj = json_decode($crew);

            $start_afip = explode('/', $crewObj->start_afip);
            $finish_afip = explode('/', $crewObj->finish_afip);
            $start_date_contract = explode('/', $crewObj->start_date_contract);
            $finish_date_contract = explode('/', $crewObj->finish_date_contract);

            $crew = new ProjectProvider;
            $crew->id_project = $project->id;
            $crew->id_function_frame = $crewObj->id_function_frame;
            $crew->id_category_sat = $crewObj->id_category_sat;
            $crew->id_provider = $crewObj->id_provider;
            $crew->id_contract = $crewObj->id_contract;
            $crew->salary_workdays = $crewObj->salary_workdays;
            $crew->total_workdays = $crewObj->total_workdays;
            $crew->salary_contract_category_function = $crewObj->salary_contract_category_function;
            $crew->salary_daily = $crewObj->salary_daily;
            $crew->salary_liquidate = $crewObj->salary_liquidate;
            $crew->salaty_difference = $crewObj->salaty_difference;
            $crew->start_date_contract = (isset($start_date_contract[2]) ? $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] : $crewObj->start_date_contract);
            $crew->finish_date_contract = (isset($finish_date_contract[2]) ? $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] : $crewObj->finish_date_contract);
            $crew->start_afip = (isset($start_afip[2]) ? $start_afip[2].'-'.$start_afip[1].'-'.$start_afip[0] : $crewObj->start_afip);
            $crew->finish_afip = (isset($finish_afip[2]) ? $finish_afip[2].'-'.$finish_afip[1].'-'.$finish_afip[0] : $crewObj->finish_afip);
            $crew->active = '0';
            $crew->save();

            // Enviar Mails a los crew notificandolo del proyecto y si acepta trabajar
          }
          return redirect('/projects')->with('message', 'Proyecto creado con exito!');

       } catch(\Exception $e) {
         if(\Config::get('app.debug')):
           $message = 'ERROR('.$e->getLine().'): '.$e->getMessage();
         else:
           $message = 'Se ha producido un error. Por favor intente nuevamente.';
         endif;

         $respuesta = array(
           'estado' => false,
           'mensaje' => $message
         );
         return \Response::json($respuesta);

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
       $listCrew = ProjectProvider::where('id_project', $id)->get();
       return view('backend.projects.edit', [
         'project' => $project,
         'list_crew' => $listCrew
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

          if(empty($list_crew[0])){
            return redirect('/projects/edit')->with('message', 'Error al Editar Proyecto. Debe Agregar al menos un Crew!');
          }

          $start_date = explode('/', $request->get('start_date'));
          $finish_date = explode('/', $request->get('finish_date'));

          $project = Project::find($id);
          $project->id_client = $request->get('id_client');
          $project->name = $request->get('name');
          $project->description = $request->get('description');
          $project->id_proyect_category = $request->get('id_proyect_category');
          $project->start_date = (isset($start_date[2]) ? $start_date[2].'-'.$start_date[1].'-'.$start_date[0] : $request->get('start_date'));
          $project->finish_date = (isset($finish_date[2]) ? $finish_date[2].'-'.$finish_date[1].'-'.$finish_date[0] : $request->get('finish_date'));
          $project->count_workdays = $request->get('count_workdays');
          $project->duration_workdays = $request->get('duration_workdays');
          $project->id_workday = $request->get('id_workday');
          $project->days = $request->get('days');
          $project->active = '0'; // cuando todos los proveedores que se agregaron aceptan la solicitud del proyecto, automaticamente cambia su estado a activo 1. Y cuando el proyecto finaliza tambien se da de baja el mismo.
          $project->save();

          // add provides relation Project

          foreach ($list_crew as $crew) {
            $crewObj = json_decode($crew);

            $start_afip = explode('/', $crewObj->start_afip);
            $finish_afip = explode('/', $crewObj->finish_afip);
            $start_date_contract = explode('/', $crewObj->start_date_contract);
            $finish_date_contract = explode('/', $crewObj->finish_date_contract);

            $crew = new ProjectProvider;
            $crew->id_project = $project->id;
            $crew->id_function_frame = $crewObj->id_function_frame;
            $crew->id_category_sat = $crewObj->id_category_sat;
            $crew->id_provider = $crewObj->id_provider;
            $crew->id_contract = $crewObj->id_contract;
            $crew->salary_workdays = $crewObj->salary_workdays;
            $crew->total_workdays = $crewObj->total_workdays;
            $crew->salary_contract_category_function = $crewObj->salary_contract_category_function;
            $crew->salary_daily = $crewObj->salary_daily;
            $crew->salary_liquidate = $crewObj->salary_liquidate;
            $crew->salaty_difference = $crewObj->salaty_difference;
            $crew->start_date_contract = (isset($start_date_contract[2]) ? $start_date_contract[2].'-'.$start_date_contract[1].'-'.$start_date_contract[0] : $crewObj->start_date_contract);
            $crew->finish_date_contract = (isset($finish_date_contract[2]) ? $finish_date_contract[2].'-'.$finish_date_contract[1].'-'.$finish_date_contract[0] : $crewObj->finish_date_contract);
            $crew->start_afip = (isset($start_afip[2]) ? $start_afip[2].'-'.$start_afip[1].'-'.$start_afip[0] : $crewObj->start_afip);
            $crew->finish_afip = (isset($finish_afip[2]) ? $finish_afip[2].'-'.$finish_afip[1].'-'.$finish_afip[0] : $crewObj->finish_afip);
            $crew->active = '0';
            $crew->save();

            // Enviar Mails a los crew notificandolo del proyecto y si acepta trabajar
          }
          return redirect('/projects')->with('message', 'Proyecto editado con exito!');

       } catch(\Exception $e) {
         if(\Config::get('app.debug')):
           $message = 'ERROR('.$e->getLine().'): '.$e->getMessage();
         else:
           $message = 'Se ha producido un error. Por favor intente nuevamente.';
         endif;

         $respuesta = array(
           'estado' => false,
           'mensaje' => $message
         );
         return \Response::json($respuesta);

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

       // hay que eliminar los datos relacionados en ProjectProvider

       return response(array('message' => 'Proyecto eliminado con exito!'));
     }
 }
