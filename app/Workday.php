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

    static public function getName($id)
    {
      $workday = Workday::find($id);
      return $workday->name;
    }
}
