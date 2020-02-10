<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\WorkersCategory;

class WorkersCategoriesController extends Controller
{
    protected $_permission;
    protected $permissionApproved = ['1', '5', '12'];

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
       return view('backend.workers_categories.index', [
         'workers_categories' => WorkersCategory::orderBy('id', 'DESC')->get()
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

           $sueldo_buto = str_replace(array("$", ".", ","), array("", "", "."), $request->get('sueldo_bruto'));
           $salary_neto = (floatval($sueldo_buto) - (floatval($sueldo_buto)*0.19));
           $salary_netoCheck = explode(".", "$salary_neto");
           $salaryNetoFinish = substr($salary_netoCheck[0], 0, -3).".".substr($salary_netoCheck[0], -3).",".$salary_netoCheck[1];

           // New WorkersCategory
           $workersCategory = new WorkersCategory;
           $workersCategory->number_category = $request->get('number_category');
           $workersCategory->name = $request->get('name');
           $workersCategory->sueldo_basico = $request->get('sueldo_basico');
           $workersCategory->sueldo_adicional = $request->get('sueldo_adicional');
           $workersCategory->sueldo_bruto = $request->get('sueldo_bruto');
           $workersCategory->sueldo_bruto_texto = $request->get('sueldo_bruto_texto');
           $workersCategory->sueldo_neto = $salaryNetoFinish;
           $workersCategory->presentismo = $request->get('presentismo');
           $workersCategory->categoria_afip = $request->get('categoria_afip');
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
           $sueldo_buto = str_replace(array("$", ".", ","), array("", "", "."), $request->get('sueldo_bruto'));
           $salary_neto = (floatval($sueldo_buto) - (floatval($sueldo_buto)*0.19));
           $salary_netoCheck = explode(".", "$salary_neto");
           $salaryNetoFinish = substr($salary_netoCheck[0], 0, -3).".".substr($salary_netoCheck[0], -3).",".$salary_netoCheck[1];

           // Update WorkersCategory
           $workersCategory = WorkersCategory::find($id);
           $workersCategory->number_category = $request->get('number_category');
           $workersCategory->name = $request->get('name');
           $workersCategory->sueldo_basico = $request->get('sueldo_basico');
           $workersCategory->sueldo_adicional = $request->get('sueldo_adicional');
           $workersCategory->sueldo_bruto = $request->get('sueldo_bruto');
           $workersCategory->sueldo_bruto_texto = $request->get('sueldo_bruto_texto');
           $workersCategory->sueldo_neto = $salaryNetoFinish;
           $workersCategory->presentismo = $request->get('presentismo');
           $workersCategory->categoria_afip = $request->get('categoria_afip');
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

       return response(array('message' => 'Categoría de Trabajador eliminado con exito!'));
     }
 }
