<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Workday;

class Project extends Model
{
    //
    static public function getName($id){
      $project = Project::find($id);
      if($project){
        return $project->name;
      }
    }

    static public function getModalidad($id_project){
      $project = Project::find($id_project);
      return Workday::getName($project->id_workday);
    }
}
