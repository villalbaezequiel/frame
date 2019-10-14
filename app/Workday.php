<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    //
    static public function getAllWorkdays($status = '1')
    {
      return Workday::where('active', $status)->get();
    }

    static public function getName($id)
    {
      $workday = Workday::find($id);

      if($workday){
        return $workday->name;
      }
    }

    static public function getTypeWorkMode()
    {
      $list = [
        'month-7' => 'Mes por 7',
        'month-5' => 'Mes por 5',
        'week-7' => 'Semana por 7',
        'week-5' => 'Semana por 5'
      ];

      return $list;
    }

    static public function getMode($key)
    {
      $list = self::getTypeWorkMode();

      return $list[$key];
    }

}
