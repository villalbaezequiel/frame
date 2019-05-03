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

      if($crew){
        return $crew->name.' '.$crew->last_name;
      } else {
        return "Crew no existe.";
      }
    }

    static public function getNameOrderLastName($id)
    {
      $crew = Provider::join('users', 'users.id', '=', 'providers.id_user')
              ->where('providers.id', $id)
              ->first();

      if($crew){
        return $crew->last_name.' '.$crew->name;
      } else {
        return "Crew no existe.";
      }
    }

    static public function getIdUser($id)
    {
      $crew = Provider::find($id);

      if($crew){
        return $crew->id_user;
      } else {
        return "Crew no existe.";
      }
    }

    static public function getAddressFull($id)
    {
      $crew = Provider::find($id);

      if($crew){
        if($crew->piso_depto != null || $crew->piso_depto != ""){
          return $crew->address.' '.$crew->address_number.'. Piso/Departamento: '.$crew->piso_depto;
        } else {
          return $crew->address.' '.$crew->address_number;
        }
      } else {
        return "Crew no existe.";
      }
    }

    static public function getEmail($id)
    {
      $crew = Provider::join('users', 'users.id', '=', 'providers.id_user')
              ->where('providers.id', $id)
              ->first();

      if($crew){
        return $crew->email;
      } else {
        return "Crew no existe.";
      }
    }

    static public function getTelephone($id)
    {
      $crew = Provider::find($id);

      if($crew){
        if($crew->telephone != null){
          return $crew->telephone;
        }
      } else {
        return "Crew no existe.";
      }
    }

    static public function getOtherTelephone($id)
    {
      $crew = Provider::find($id);

      if($crew){
        if($crew->other_telephone != null){
          return $crew->other_telephone;
        }
      } else {
        return "Crew no existe.";
      }
    }

    static public function getCBU($id)
    {
      $crew = Provider::find($id);

      if($crew){
        return $crew->cbu;
      }
    }

}
