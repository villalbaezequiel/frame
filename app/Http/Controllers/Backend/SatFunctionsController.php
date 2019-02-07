<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use App\SatFunction;

class SatFunctionsController extends Controller
{
  /**
   * Instantiate a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('permission:sat_functions', ['only' => ['index','create', 'store', 'edit', 'update', 'show','destroy']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
     return view('backend.sat_functions.index', [
       'sat_functions' => SatFunction::all()
     ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
     return view('backend.sat_functions.create');
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
         // New SatFunction
         $satFunction = new SatFunction;
         $satFunction->name = $request->get('name');
         $satFunction->description = $request->get('description');
         $satFunction->id_workers_category = $request->get('id_workers_category');
         $satFunction->id_frame_function = $request->get('id_frame_function');
         $satFunction->active = $request->get('active');
         $satFunction->save();

         return redirect('/sat_functions')->with('message', 'Función SAT creado con exito!');

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
     $satFunction = SatFunction::find($id);
     return view('backend.sat_functions.edit', [
       'satFunction' => $satFunction
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
         // Update SatFunction
         $satFunction = SatFunction::find($id);
         $satFunction->name = $request->get('name');
         $satFunction->description = $request->get('description');
         $satFunction->id_workers_category = $request->get('id_workers_category');
         $satFunction->id_frame_function = $request->get('id_frame_function');
         $satFunction->active = $request->get('active');
         $satFunction->save();

         return redirect('/sat_functions')->with('message', 'Función SAT editado con exito!');

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
     $satFunction = SatFunction::find($id);
     $satFunction->delete();

     return redirect('/sat_functions')->with('message', 'Función SAT eliminado con exito!');
   }
}
