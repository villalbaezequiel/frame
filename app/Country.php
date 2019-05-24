<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  static public function getName($id)
    {
      $country = Country::find($id);

      if($country){
        return $country->name;
      }
    }

  static public function getNacionality($id)
  {
    $country = Country::find($id);

    if($country){
      return $country->male.' / '.$country->female;
    }
  }
}
