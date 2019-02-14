<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use App\WorkersCategory;

class WorkersCategoriesController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('permission:workers_categories', ['except' => ['index','create', 'store', 'edit', 'update', 'show','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       return view('backend.workers_categories.index', [
         'workers_categories' => WorkersCategory::all()
       ]);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
       return view('backend.workers_categories.create');
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
           // New WorkersCategory
           $workersCategory = new WorkersCategory;
           $workersCategory->name = $request->get('name');
           $workersCategory->sueldo_basico = $request->get('sueldo_basico');
           $workersCategory->sueldo_adicional = $request->get('sueldo_adicional');
           $workersCategory->sueldo_bruto = $request->get('sueldo_bruto');
           $workersCategory->sueldo_bruto_texto = $request->get('sueldo_bruto_texto');
           $workersCategory->presentismo = $request->get('presentismo');
           $workersCategory->active = $request->get('active');
           $workersCategory->save();

           return redirect('/workers_categories')->with('message', 'Categoría de Trabajador creado con exito!');

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
       $workersCategory = WorkersCategory::find($id);
       return view('backend.workers_categories.edit', [
         'workersCategory' => $workersCategory
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
           // Update WorkersCategory
           $workersCategory = WorkersCategory::find($id);
           $workersCategory->name = $request->get('name');
           $workersCategory->sueldo_basico = $request->get('sueldo_basico');
           $workersCategory->sueldo_adicional = $request->get('sueldo_adicional');
           $workersCategory->sueldo_bruto = $request->get('sueldo_bruto');
           $workersCategory->sueldo_bruto_texto = $request->get('sueldo_bruto_texto');
           $workersCategory->presentismo = $request->get('presentismo');
           $workersCategory->active = $request->get('active');
           $workersCategory->save();

           return redirect('/workers_categories')->with('message', 'Categoría de Trabajador editado con exito!');

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
       $workersCategory = WorkersCategory::find($id);
       $workersCategory->delete();

       return redirect('/workers_categories')->with('message', 'Categoría de Trabajador eliminado con exito!');
     }
 }
