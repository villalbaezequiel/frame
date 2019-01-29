<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    static public function getAllClients($status = 1)
    {
      return Client::join('users', 'users.id', '=', 'clients.id_user')
              ->where('users.active', $status)
              ->get();
    }
}
