<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    static public function getAllContracts($status = 1)
    {
      return Contract::where('active', $status)->get();
    }
}
