<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    static public function getNick($id)
    {
      $client = Client::find($id);
      if($client){
        return $client->nick;
      }
    }

    static public function getAllClients($status = '1')
    {
      return Client::where('active', $status)
              ->get();
    }

    static public function getRazonSocial($id)
    {
      $client = Client::find($id);
      if($client){
        return $client->razon_social;
      }
    }

    static public function getCuit($id)
    {
      $client = Client::find($id);
      if($client){
        return $client->cuit;
      }
    }
}
