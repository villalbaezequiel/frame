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

    static public function getIdUser($id)
    {
      $crew = Provider::find($id);
      return $crew->id_user;
    }

    static public function getAddressFull($id)
    {
      $crew = Provider::find($id);
      if($crew->piso_depto != null || $crew->piso_depto != ""){
        return $crew->address.' '.$crew->address_number.'. Piso/Departamento: '.$crew->piso_depto;
      } else {
        return $crew->address.' '.$crew->address_number;
      }
    }
}
