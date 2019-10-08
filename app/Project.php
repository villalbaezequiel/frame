<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Workday;
use App\ProyectCategory;
use App\Client;
use App\Provider;
use App\User;
use App\CenterCost;

class Project extends Model
{

    static public function getName($id)
    {
      $project = Project::find($id);

      if($project){
        return $project->name;
      }
    }

    static public function getModalidad($id_project)
    {
      $project = Project::find($id_project);

      if($project){
        return Workday::getName($project->id_workday);
      }
    }

    static public function getProyectCategory($id_project)
    {
      $project = Project::find($id_project);

      if($project){
        return ProyectCategory::getName($project->id_proyect_category);
      }
    }

    static public function getCliente($id_project)
    {
      $project = Project::find($id_project);

      if($project){
        return Client::getNick($project->id_client);
      }
    }

    static public function getDescription($id_project)
    {
      $project = Project::find($id_project);

      if($project){
        return $project->description;
      }
    }

    static public function getReferring($id_project)
    {
      $project = Project::find($id_project);

      if($project){
        return Provider::getNameOrderLastName($project->id_team_referring);
      }
    }

    static function getIsClosed($status)
    {
      if($status){
        return "Cerrado";
      } else {
        return "Abierto";
      }
    }

    static function getCenterCost($id_project)
    {
      $project = Project::find($id_project);

      if($project){
        return CenterCost::getNumber($project->cost_center);
      }
    }

    static function getProjectByCenterCost($centerCost)
    {
      $project = Project::where('cost_center', $centerCost)->first();

      if($project){
        return $project;
      }
    }
}
