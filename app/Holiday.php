<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
  static public function getAllDate($active = '1')
  {
    $holidays = Holiday::select('date')->where('active', $active)->get();
    $lists = [];

    if(count($holidays)){
      foreach ($holidays as $holiday) {
        array_push($lists, substr($holiday->date, 0, 10));
      }
    }

    return $lists;
  }

  static public function getIssetHolidayByTimestamp($date)
  {
    $holidays = Holiday::select('date')
                  ->where('date', $date)
                  ->where('active', '1')
                  ->first();

    return $holidays;
  }
}
