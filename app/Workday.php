<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateInterval;
use DatePeriod;

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

    static public function getCalendarWeekends($startDate, $endDate, $hour = '00:00', $excludeLastDay = false)
    {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $oneday = new DateInterval("P1D");
        $days = array();

        foreach(new DatePeriod($start, $oneday, $end->add($oneday)) as $day)
        {
          $day_num = $day->format("N"); /* 'N' number days 1 (mon) to 7 (sun) */
          if($day_num < 6) { /* weekday */
              $days[$day->format("Y-m-d")] = array(
                'start' => $day->format("Y-m-d")." ".$hour.":00",
                'finish' => $day->format("Y-m-d")." ".$hour.":00"
              );
          }
        }

        if($excludeLastDay) {
          array_pop($days);
        }

        return $days;
    }

}
