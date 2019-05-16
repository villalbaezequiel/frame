<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers;
use App\WorkersCategory;

class FrameFunction extends Model
{
    //

    static public function getAllFrameFunction($status = 1)
    {
      return FrameFunction::where('active', $status)->get();
    }

    static public function getName($id)
    {
      $frameFunction = FrameFunction::find($id);
      if($frameFunction){
        return $frameFunction->name;
      }
    }

    static public function getAllFrameFunctionByTypeProject($id_proyect_category)
    {
      return FrameFunction::where('id_proyect_category', $id_proyect_category)->get();
    }

    static public function getNumberCategoriesSat($id)
    {
      $frameFunction = FrameFunction::find($id);

      if($frameFunction){
        $categoriesSat = json_decode($frameFunction->id_workers_category);
        $listNumberSat = "";

        foreach($categoriesSat as $sat){
          $listNumberSat .= "<a href='javascript:void(0)' class='get-salary-sat-modal' title='Ver Salarios de Categoria SAT' data-id='".$sat."'>".WorkersCategory::getNumber($sat)."</a>".', ';
        }

        echo $listNumberSat;
      }

    }

    static public function getColor($id)
    {
      $frameFunction = FrameFunction::find($id);
      if($frameFunction){
        return $frameFunction->color;
      }
    }

}
