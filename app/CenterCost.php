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

    static public function getAllNoAssigne($active = '1')
    {
      $listPermissions = User::getListPermissionsFromUser(Auth::user());

      if(in_array("16", $listPermissions))
      {
        $center_costs = CenterCost::where('push_rol_producer_orders', '1')->where('assigne', '0')->get();
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
