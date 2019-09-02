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

    static public function getAllNoAssigne()
    {
      $center_costs = CenterCost::where('assigne', 0)->get();

      return $center_costs;
    }

}
