<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\ProyectCategory;

class UtilitiesProyectCategoriesController extends Controller
{
    protected $_permission;
    protected $permissionApproved = ['1', '7'];

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
       return view('backend.proyect_categories.index', [
         'proyect_categories' => ProyectCategory::orderBy('id', 'DESC')->get()
       ]);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
       return view('backend.proyect_categories.create');
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
           // New ProyectCategory
           $proyectCategory = new ProyectCategory;
           $proyectCategory->name = $request->get('name');
           $proyectCategory->active = $request->get('active');
           $proyectCategory->save();

           return redirect('/utilities/proyect_categories')->with('message', 'Tipo de Proyecto creado con exito!');

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
       $proyectCategory = ProyectCategory::find($id);
       return view('backend.proyect_categories.edit', [
         'proyect_category' => $proyectCategory
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
           // Update ProyectCategory
           $proyectCategory = ProyectCategory::find($id);
           $proyectCategory->name = $request->get('name');
           $proyectCategory->active = $request->get('active');
           $proyectCategory->save();

           return redirect('/utilities/proyect_categories')->with('message', 'Tipo de Proyecto editado con exito!');

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
       $proyectCategory = ProyectCategory::find($id);
       $proyectCategory->delete();

       return response(array('message' => 'Tipo de Proyecto eliminado con exito!'));
     }
}
