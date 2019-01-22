<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SatFunction extends Model
{
    //

    static public function getAllSatFunction($status = 1)
    {
      return Study::where('active', $status)->get();
    }
}
