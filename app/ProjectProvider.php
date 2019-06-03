<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Provider;
use DateTime;

class ProjectProvider extends Model
{

  protected $casts = [
    'extra_hours' => 'array',
    'calendar' => 'array'
  ];

  static public function getActive($active)
  {
    if($active == 0 || $active == '0'){
      return "Pendiente.";
    } elseif($active == 1 || $active == '1'){
      return "Aceptado";
    } elseif($active == 2 || $active == '2') {
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

  static public function getPuesto($id, $of = true)
  {
    $crew = ProjectProvider::find($id);

    if($crew){
      if($crew->is_reemplazo == "1"){
        return "Titular";
      } elseif($crew->is_reemplazo == "2"){
        if($of){
          $suplenteDe = Provider::getNameOrderLastName($crew->id_crew_reemplazo);
          return "Secundario de $suplenteDe";
        } else {
          return "Secundario";
        }
      }
    }
  }

  static public function getStringPuesto($is_reemplazo)
  {
    if($is_reemplazo == "1"){
      return "Titular";
    } elseif($is_reemplazo == "2"){
      return "Secundario";
    }
  }

  static public function getHoursExtras($init, $finish)
  {
    $hourInitial =  new DateTime('2019-06-01 '.$init.':00');
    $hourEnd = new DateTime('2019-06-01 '.$finish.':00');
    return $hourInitial->diff($hourEnd)->h;
  }

  static public function getHoursExtrasExport($init, $finish)
  {
    $hourInitial =  new DateTime('2019-06-01 '.$init.':00');
    $hourEnd = new DateTime('2019-06-01 '.$finish.':00');
    return $hourInitial->diff($hourEnd)->h.'.'.$hourInitial->diff($hourEnd)->i;
  }
}
