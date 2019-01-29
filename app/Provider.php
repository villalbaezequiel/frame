<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    static public function getAllProviders($status = '1')
    {
      return Provider::join('users', 'users.id', '=', 'providers.id_user')
              ->where('users.active', $status)
              ->get();
    }
}
