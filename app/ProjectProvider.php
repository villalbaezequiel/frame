<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Provider;

class ProjectProvider extends Model
{
  static public function getActive($active)
  {
    if($active == 0){
      return "Pendiente.";
    } elseif($active == 1){
      return "Aceptado";
    } elseif($active == 2) {
      return "Rechazado";
    }
  }

  static public function getActiveColor($active)
  {
    if($active == 0){
      echo "black";
    } elseif($active == 1){
      echo "green";
    } elseif($active == 2) {
      echo "red";
    }
  }

  static public function getPuesto($id)
  {
    $crew = ProjectProvider::find($id);
    if($crew->is_reemplazo == "1"){
      return "Titular";
    } elseif($crew->is_reemplazo == "2"){
      $suplenteDe = Provider::getNameOrderLastName($crew->id_crew_reemplazo);
      return "Secundario de $suplenteDe";

    }
  }
}
