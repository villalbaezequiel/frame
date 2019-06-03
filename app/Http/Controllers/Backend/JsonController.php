<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers;
use App\FrameFunction;
use App\Provider;
use App\ProjectProvider;
use App\Project;
use App\WorkersCategory;
use DateTime;

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
      Helpers::getCapturError($e);
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
      Helpers::getCapturError($e);
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
      Helpers::getCapturError($e);
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
      Helpers::getCapturError($e);
    }
  }

  /*
  * parameter: id_frame_function
  * return list Team
  * Logica: a base de 'id_frame_function' busca todas los Team where active = 1.
  */
  public function getTeamByFunctionFrame($id_frame_function)
  {
    $message;
    try {

      $listTeam = array();
      $allTeam = DB::table('providers as p')
                            ->join('users as u', 'p.id_user', '=', 'u.id')
                            ->select('p.id', 'u.name', 'u.last_name', 'p.id_function_frame')
                            ->where('u.active', '1')
                            ->get();

      foreach($allTeam as $crew) {
        $crewFunctionFrame = json_decode($crew->id_function_frame);

        foreach($crewFunctionFrame as $key => $value) {
          if($value == $id_frame_function){
            array_push($listTeam, $crew);
          }
        }
      }

      return \Response::json(array('data' => $listTeam));

    } catch(\Exception $e) {
      Helpers::getCapturError($e);
    }
  }

    /*
    * parameter: id_provider, start_date_contract, finish_date_contract, active = 0
    * return Boolean
    * Logica:
    */
    public function checkAvailableTeamProject($id_provider, $start_date_contract, $active = '1')
    {
      $message;
      try {
        $status = false;

        $start_date = explode('-', $start_date_contract);
        $start_date_contract_format = $start_date[2].'-'.$start_date[1].'-'.$start_date[0].' 00:00:00';

        $checkTeam = ProjectProvider::where('id_provider', $id_provider)
                                    ->whereDate('finish_date_contract', '>=', $start_date_contract_format)
                                    ->where('active', $active)
                                    ->count();

        $checkT = ProjectProvider::where('id_provider', $id_provider)->first();

        if($checkTeam == 0){
          $status = true;
        } else {
          $status = false;
        }

        if($status){
          return \Response::json(array('status' => $status));
        } else {
          $result = array(
            'name' => Provider::getNameOrderLastName($checkT->id_provider),
            'project' => Project::getName($checkT->id_project),
            'initial' => Helpers::getDateParseFormat($checkT->start_date_contract, '/'),
            'finished' => Helpers::getDateParseFormat($checkT->finish_date_contract, '/')
          );
          return \Response::json(array('status' => $status, 'result' => $result));
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    /*
    * parameter: id_category_sat
    * return Boolean
    * Logica:
    */
    public function getSalaryCategorySat($id_category_sat)
    {
      $message;
      try {
        $satFunctions = WorkersCategory::find($id_category_sat);

        return \Response::json(array('data' => $satFunctions));

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    /*
    * parameter:
    * return
    * Logica:
    */
    public function storeExtraHours(Request $request)
    {
      $message;
      try {
        $names = array();
        foreach($request->get('crew') as $team)
        {
          $projectProvider = ProjectProvider::find($team);
          $newExtraHours = $projectProvider->extra_hours;

          // validar cuantas horas extras realizo.
          // Dependiendo de las horas de inicio y final de su jornada.
          $hourInitial =  new DateTime('2019-06-01 '.$projectProvider->hour_initial);
          $hourEnd = new DateTime('2019-06-01 '.$projectProvider->hour_end);
          $agreedHours = $hourInitial->diff($hourEnd)->h;

          $newExtraHours[] = array(
                            'rol' => $request->get('rol'),
                            'start' => $request->get('start'),
                            'finish' => $request->get('finish'),
                            'agreed_hours' => $agreedHours
                          );

          $projectProvider->extra_hours = $newExtraHours;
          $projectProvider->save();

          array_push($names, Provider::getNameOrderLastName($projectProvider->id_provider));
        }

        return \Response::json( array('status' => true, 'name' => $names ) );

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    /*
    * parameter:
    * return
    * Logica:
    */
    public function storeJornadaTeam(Request $request)
    {
      $message;
      try {

        $idTeam = explode('_', $request->get('id'));

        $projectProvider = ProjectProvider::find($idTeam[1]);
        $calendar = $projectProvider->calendar;

        $calendar[$idTeam[0]] = array(
                          'start' => $request->get('start'),
                          'finish' => $request->get('finish')
                         );
        $projectProvider->calendar = $calendar;
        $projectProvider->save();

        return \Response::json( array('status' => true) );

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function getFuctionsFrame(){
      try {
        return response()->json(array("results" => FrameFunction::getAllFrameFunction() ));
      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

}
