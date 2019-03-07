<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers;
use App\FrameFunction;
use App\Provider;
use App\ProjectProvider;
use App\WorkersCategory;

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

      $satFunctions = WorkersCategory::where('id_frame_function', $id_frame_function)
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

  /*
  * parameter: id_type_project
  * return list FrameFunction
  * Logica: a base de 'id_type_project' busca todas las Funciones FRAME where id_proyect_category = id_type_project and active = 1.
  */
  public function getFunctionsFrameByTypeProject($id_type_project)
  {
    $message;
    try {

      $frameFunction = FrameFunction::where('id_proyect_category', $id_type_project)
                            ->where('active', '1')
                            ->get();

      return \Response::json(array('data' => $frameFunction));

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
  * parameter: id_frame_function
  * return list WorkersCategory
  * Logica: a base de 'id_frame_function' busca todas las Categorias SAT where active = 1.
  */
  public function getCategoriesSatByFunctionFrame($id_frame_function)
  {
    $message;
    try {

      $listCategoriesSat = array();

      $frameFunction = FrameFunction::find($id_frame_function);

      foreach(json_decode($frameFunction->id_workers_category) as $id_sat) {
        $categorySAT = WorkersCategory::where('id', $id_sat)
                              ->where('active', '1')
                              ->first();
        array_push($listCategoriesSat, $categorySAT);
      }

      return \Response::json(array('data' => $listCategoriesSat));

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
  * parameter: id_frame_function
  * return list Crew
  * Logica: a base de 'id_frame_function' busca todas los Crew where active = 1.
  */
  public function getCrewByFunctionFrame($id_frame_function)
  {
    $message;
    try {

      $listCrew = array();
      $allCrew = DB::table('providers as p')
                            ->join('users as u', 'p.id_user', '=', 'u.id')
                            ->select('p.id', 'u.name', 'u.last_name', 'p.id_function_frame')
                            ->where('u.active', '1')
                            ->get();

      foreach($allCrew as $crew) {
        $crewFunctionFrame = json_decode($crew->id_function_frame);

        foreach($crewFunctionFrame as $key => $value) {
          if($value == $id_frame_function){
            array_push($listCrew, $crew);
          }
        }
      }

      return \Response::json(array('data' => $listCrew));

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
    * parameter: id_provider, start_date_contract, finish_date_contract, active = 0
    * return Boolean
    * Logica:
    */
    public function checkAvailableCrewProject($id_provider, $start_date_contract, $active = '0')
    {
      $message;
      try {
        $status = false;

        $start_date = explode('-', $start_date_contract);
        $start_date_contract_format = $start_date[2].'-'.$start_date[1].'-'.$start_date[0].' 00:00:00';

        $checkCrew = ProjectProvider::where('id_provider', $id_provider)
                                    ->where('finish_date_contract', '>=', $start_date_contract_format)
                                    ->where('active', $active)
                                    ->count();
        if($checkCrew == 0){
          $status = true;
        } else {
          $status = false;
        }
        return \Response::json(array('status' => $status));

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
