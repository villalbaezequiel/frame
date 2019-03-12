<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectProvider extends Model
{
  static public function getActive($active)
  {
    if($active == 0){
      return "No hay respuesta Aún.";
    } elseif($active == 1){
      return "Si";
    } elseif($active == 2) {
      return "No";
    }
  }
}
