<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    //
    static public function getAllWorkdays($status = '1')
    {
      return Workday::where('active', $status)->get();
    }
}
