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

    static public function getName($id)
    {
      $crew = Provider::join('users', 'users.id', '=', 'providers.id_user')
              ->where('providers.id', $id)
              ->first();
      return $crew->name.' '.$crew->last_name;
    }

    static public function getNameOrderLastName($id)
    {
      $crew = Provider::join('users', 'users.id', '=', 'providers.id_user')
              ->where('providers.id', $id)
              ->first();
      return $crew->last_name.' '.$crew->name;
    }
}
