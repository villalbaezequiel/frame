<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectCategory extends Model
{
    //
    static public function getAllProyectCategories($status = '1')
    {
      return ProyectCategory::where('active', $status)->get();
    }

    static public function getName($id)
    {
      $projectCategoryName = ProyectCategory::find($id);
      return $projectCategoryName->name;
    }
}
