<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use App\FrameFunction;

class FrameFunctionsController extends Controller
{
  /**
   * Instantiate a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('permission:frame_functions', ['only' => ['index','create', 'store', 'edit', 'update', 'show','destroy']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
     return view('backend.frame_functions.index', [
       'frame_functions' => FrameFunction::all()
     ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
     return view('backend.frame_functions.create');
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
         // New FrameFunction
         $frameFunction = new FrameFunction;
         $frameFunction->name = $request->get('name');
         $frameFunction->description = $request->get('description');
         $frameFunction->active = $request->get('active');
         $frameFunction->save();

         return redirect('/frame_functions')->with('message', 'Función Frame creado con exito!');

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
     $frameFunction = FrameFunction::find($id);
     return view('backend.frame_functions.edit', [
       'frameFunction' => $frameFunction
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
         // Update FrameFunction
         $frameFunction = FrameFunction::find($id);
         $frameFunction->name = $request->get('name');
         $frameFunction->description = $request->get('description');
         $frameFunction->active = $request->get('active');
         $frameFunction->save();

         return redirect('/frame_functions')->with('message', 'Función Frame editado con exito!');

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
     $frameFunction = FrameFunction::find($id);
     $frameFunction->delete();

     return redirect('/frame_functions')->with('message', 'Función Frame eliminado con exito!');
   }
}
