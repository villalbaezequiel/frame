<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    static public function getAllClients($status = '1')
    {
      return Client::where('active', $status)
              ->get();
    }
}
