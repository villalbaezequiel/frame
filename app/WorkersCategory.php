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

    static public function getName($id)
    {
      $workersCategory = WorkersCategory::find($id);
      if($workersCategory){
        return $workersCategory->name;
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
}
