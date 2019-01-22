<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    //

    static public function getAllStudy($status = '1')
    {
      return Study::where('active', $status)->get();
    }
}
