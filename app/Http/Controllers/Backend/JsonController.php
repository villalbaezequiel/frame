<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers;
use App\FrameFunction;
use App\WorkersCategory;
use App\SatFunction;

class JsonController extends Controller
{

  /*
  * parameter: id_frame_function
  * return WorkersCategories
  * Logica: a base de 'id_frame_function' busca todas las Funciones SAT donde tenga asociada el parametro mencionado.
  * Table SatFunction, select.id_workers_category, Where 'id_frame_function' = $id_frame_function, groupBy 'id_frame_function'.
  */
  public function getWorkersCategories($id_frame_function)
  {
    $message;
    try {

      $workersCategories = DB::table('sat_functions as sf')
                            ->join('workers_categories as wc', 'wc.id', '=', 'sf.id_workers_category')
                            ->select('sf.id_workers_category', 'wc.*')
                            ->where('sf.id_frame_function', $id_frame_function)
                            ->groupBy('sf.id_workers_category')
                            ->get();

      return \Response::json(array('data' => $workersCategories));

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

  /*
  * parameter: id_frame_function, id_workers_category
  * return WorkersCategories
  * Logica: a base de 'id_frame_function' y 'id_workers_category' busca todas las Funciones SAT donde tenga asociados estos parametros mencionados.
  * Table SatFunction, select.*, Where id_frame_function = $id_frame_function and 'id_workers_category' = $id_workers_category.
  */
  public function getSatFunctions($id_frame_function, $id_workers_category)
  {
    $message;
    try {

      $satFunctions = SatFunction::where('id_frame_function', $id_frame_function)
                            ->where('id_workers_category', $id_workers_category)
                            ->get();

      return \Response::json(array('data' => $satFunctions));

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
