<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use App\Project;

class HelpersController extends Controller
{

  public function setIsClosed($id_project, $status)
  {
    try {
      $project = Project::find($id_project);
      $project->is_closed = $status;
      $project->save();

      return back()->with('message', 'Proyecto editado con exito!');
    } catch(\Exception $e) {
      Helpers::getCapturError($e);
    }
  }

}
