<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
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

        if(!empty($data) && $data->count()){

          foreach ($data as $key => $value) {
            if( !empty($value->numero_categoria) && !empty($value->nombre) && !empty($value->sueldo_basico)
              && !empty($value->adicional) && !empty($value->sueldo_bruto) )
            {
                $sueldo_buto = str_replace(array("$"), array(""), $value->sueldo_bruto);
                $salary_neto = (floatval($sueldo_buto) - (floatval($sueldo_buto)*0.19));
                $salary_netoCheck = explode(".", "$salary_neto");
                $decimales_neto = (isset($salary_netoCheck[1]) ? $salary_netoCheck[1] : '00');
                $salaryNetoFinish = substr($salary_netoCheck[0], 0, -3).".".substr($salary_netoCheck[0], -3).",".$decimales_neto;

                // New WorkersCategory
                $workersCategory = new WorkersCategory;
                $workersCategory->number_category = $value->numero_categoria;
                $workersCategory->name = $value->nombre;
                $workersCategory->sueldo_basico = Helpers::getFormatSalary($value->sueldo_basico);
                $workersCategory->sueldo_adicional = Helpers::getFormatSalary($value->adicional);
                $workersCategory->sueldo_bruto = Helpers::getFormatSalary($value->sueldo_bruto);
                $workersCategory->sueldo_bruto_texto = $value->sueldo_bruto_texto;
                $workersCategory->sueldo_neto = "$".$salaryNetoFinish;
                $workersCategory->presentismo = Helpers::getFormatSalary($value->presentismo);
                $workersCategory->categoria_afip = $value->categoria_afip;
                $workersCategory->active = '1';
                $workersCategory->save();

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
