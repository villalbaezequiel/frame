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
}
