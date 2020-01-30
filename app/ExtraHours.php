<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Holiday;
use App\Helpers;

class ExtraHours extends Model
{

    /*
     * day = date object 
     * salary float
     */
    static public function calculateExHs($day, float $salary, $isJornada = false)
    {
        try {
            $checkHoliday = Holiday::getIssetHolidayByTimestamp($day->format('Y-m-d 00:00:00'));

            if($checkHoliday || Helpers::isWeekend($day->format('w'))) {
                return 100;
            } else {
                return round(self::calculateFifty($salary, $isJornada), 2);
            }            
        } catch (\Exception $e) {
            Helpers::getCapturError($e);
        }
    }

    /* las horas al 100% son:
        * sábados, domingos y feriados. 
    */
    static public function calculateHundred($salary, $isJornada = false)
    {
        if($isJornada) {
            return (($salary / 7) * 2);
        } else {
            return (($salary / 150) * 2); 
        }
    }

    /* las horas al 100% son:
        * de lunes a viernes. Excluyendo feriados. 
    */
    static public function calculateFifty($salary, $isJornada = false)
    {
        if($isJornada) {
            return (($salary / 7) * 1.5);
        } else {
            return (($salary / 150) * 1.5); 
        }
    }
}
