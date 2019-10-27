<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
      $center_costs = CenterCost::where('assigne', '0')
                                  ->where('active', $active)
                                  ->get();

      return $center_costs;
    }

    static public function getAllAssigne($active = '1')
    {
      $center_costs = CenterCost::where('assigne', '1')
                                  ->where('active', $active)
                                  ->get();

      return $center_costs;
    }
}
