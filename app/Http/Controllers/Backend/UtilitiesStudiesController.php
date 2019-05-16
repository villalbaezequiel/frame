<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use App\Study;

class UtilitiesStudiesController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('permission:studies', ['except' => ['index','create', 'store', 'edit', 'update', 'show','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       return view('backend.studies.index', [
         'studies' => Study::orderBy('id', 'DESC')->get()
       ]);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
       return view('backend.studies.create');
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
           // New Study
           $study = new Study;
           $study->name = $request->get('name');
           $study->active = $request->get('active');
           $study->save();

           return redirect('/utilities/studies')->with('message', 'Nivel Educativo creado con exito!');

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
       $study = Study::find($id);
       return view('backend.studies.edit', [
         'study' => $study
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
           // Update Study
           $study = Study::find($id);
           $study->name = $request->get('name');
           $study->active = $request->get('active');
           $study->save();

           return redirect('/utilities/studies')->with('message', 'Nivel Educativo editado con exito!');

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
       $study = Study::find($id);
       $study->delete();

       return response(array('message' => 'Nivel Educativo eliminado con exito!'));
     }
 }
