<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;

class CenterCost extends Model
{
    static public function getName($id)
    {
      $center_cost = CenterCost::find($id);

      if($center_cost){
        return $center_cost->name;
      }
    }

    static public function getNumber($id)
    {
      $center_cost = CenterCost::find($id);

      if($center_cost){
        return $center_cost->number;
      }
    }

    static public function getIdClient($id)
    {
      $center_cost = CenterCost::find($id);

      if($center_cost){
        return $center_cost->client;
      }
    }

    static public function getIdReferentes($id)
    {
      $center_cost = CenterCost::find($id);

      if($center_cost){
        return $center_cost->referente;
      }
    }

    static public function getAllNoAssigne($active = '1')
    {
      $id_team_referente = User::select('providers.id')
                              ->join('providers', 'providers.id_user', '=', 'users.id')
                              ->where('users.id', Auth::user()->id)
                              ->where('users.permissions', 'like', '%"16"%')
                              ->where('users.section_notification', 'like', '%"producer_orders"%')
                              ->where('users.is_notification', '1')
                              ->where('users.active', $active)
                              ->first();
      if($id_team_referente)
      {
        $center_costs = CenterCost::where('push_rol_producer_orders', '1')
                                    ->where('referente', 'like', "%$id_team_referente->id%")
                                    ->where('assigne', '0')
                                    ->get();
      } else {
        $center_costs = CenterCost::where('assigne', '0')->where('active', $active)->get();
      }

      return $center_costs;
    }

    static public function getAllAssigne($active = '1')
    {
      $center_costs = CenterCost::where('assigne', '1')
                                  ->where('active', $active)
                                  ->get();

      return $center_costs;
    }

    static public function issetCenterCost($number, $id = null) 
    {
      if($id) {
        $center_costs = CenterCost::where('number', $number)->where('id', '!=', $id)->first();
      } else {
        $center_costs = CenterCost::where('number', $number)->first();
      }
      return ($center_costs ? true : false);
    }
}
