<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatFunction extends Model
{
    //

    static public function getAllSatFunction($status = 1)
    {
      return SatFunction::where('active', $status)->get();
    }
}
