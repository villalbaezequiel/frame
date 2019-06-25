<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkersCategory extends Model
{
    //

    static public function getAllWorkersCategory($status = 1)
    {
      return WorkersCategory::where('active', $status)->get();
    }

    static public function getName($id, $number_category = true)
    {
      $workersCategory = WorkersCategory::find($id);
      if($workersCategory){
        if($number_category){
          return $workersCategory->name.' / N* '.SELF::getNumber($id);
        } else {
          return $workersCategory->name;
        }
      } else {
        return "No asociado a Categoría";
      }
    }

    static public function getNumber($id)
    {
      $workersCategory = WorkersCategory::find($id);
      if($workersCategory){
        return $workersCategory->number_category;
      } else {
        return "Sin Número asociado.";
      }
    }

    static public function getSueldoBrutoTexto($id)
    {
      $workersCategory = WorkersCategory::find($id);
      if($workersCategory){
        return $workersCategory->sueldo_bruto_texto;
      } else {
        return "Sin Número asociado.";
      }
    }
}
