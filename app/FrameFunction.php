<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
      return $frameFunction->name;
    }

    static public function getAllFrameFunctionByTypeProject($id_proyect_category)
    {
      return FrameFunction::where('id_proyect_category', $id_proyect_category)->get();
    }
}
