<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
