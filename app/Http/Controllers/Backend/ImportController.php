<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\Excel\Excel;
use App\Helpers;
use App\WorkersCategory;

class ImportController extends Controller
{

  public function workersCategories()
  {
    return view('backend.import.workers_categories.index');
  }

  public function workersCategoriesStore(Request $request)
  {
    $message;
    try {

      if($request->hasFile('csv_sat')){

        $path = $request->file('csv_sat')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();

        if($data->count()) {
          foreach ($data as $key => $value) {

            if( $value->numero_categoria && $value->sueldo_basico
              && $value->sueldo_adicional && $value->sueldo_bruto )
            {
                $sueldo_buto = str_replace(array("$"), array(""), $value->sueldo_bruto);
                $salary_neto = (floatval($sueldo_buto) / 1.19);
                $salary_netoCheck = explode(".", "$salary_neto");
                $decimales_neto = (isset($salary_netoCheck[1]) ? $salary_netoCheck[1] : '00');
                $salaryNetoFinish = substr($salary_netoCheck[0], 0, -3).".".substr($salary_netoCheck[0], -3).",".$decimales_neto;

                $workersCategories = WorkersCategory::where('number_category', $value->numero_categoria)->get();

                if(count($workersCategories)) 
                {  

                  foreach ($workersCategories as $category)
                  {
                    $category->sueldo_basico      = Helpers::getFormatSalary($value->sueldo_basico);
                    $category->sueldo_adicional   = Helpers::getFormatSalary($value->sueldo_adicional);
                    $category->presentismo        = Helpers::getFormatSalary($value->presentismo);
                    $category->sueldo_bruto       = Helpers::getFormatSalary($value->sueldo_bruto);
                    $category->sueldo_bruto_texto = $value->sueldo_bruto_texto;
                    $category->sueldo_neto        = $salaryNetoFinish;
                    $category->save();   
                  }
                } 
            }
          }

          return redirect('/workers_categories')->with('message', "Categorias SAT, Importadas con Exito!");

        } else {
          return back()->withInput()->with('message', "Ocurrio un Error al Importar las Categorias SAT. Verifique que esté subiendo el Archivo y Formato Correcto. Gracias!");
        }
      }

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

}
