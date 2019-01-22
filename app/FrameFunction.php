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
}
