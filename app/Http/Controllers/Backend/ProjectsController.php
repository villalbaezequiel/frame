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
          // debe ser un array



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
       return view('backend.projects.edit', [
         'project' => $project
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

       return redirect('/projects')->with('message', 'Proyecto eliminado con exito!');
     }
 }
