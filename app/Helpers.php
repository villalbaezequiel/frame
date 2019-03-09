<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helpers extends Model
{

    static public function print_x($array)
    {
      echo "<pre>";
      print_r($array);
      echo "</pre>";
    }

    static public function getActive($active)
    {
      if($active == 0){
        return "No";
      } else {
        return "Si";
      }
    }

    static public function getTypesDocumentationPerson()
    {
      $list = array('dni'=>'DNI', 'le'=>'LE', 'CI'=>'CI');
      return $list;
    }

    static public function getGendersPerson()
    {
      $list = array('male'=>'Masculino', 'female'=>'Femenino');
      return $list;
    }

    static public function setMessageValidationForm($key)
    {
      return "El $key insertado se encuentra en uso en el Sistema. Por favor, ingrese otro!";
    }

    static public function getCivilStatus()
    {
      $list = array('soltero'=>'Soltero', 'casado'=>'Casado', 'concuvino'=>'Concuvino',
                    'divorciado'=>'Divorciado', 'viudo'=>'Viudo');
      return $list;
    }

    static public function getDate($date)
    {
        return substr($date, 0, 10);
    }

    static public function getDateParseFormat($date, $separartor = '-')
    {
      $substrDate = substr($date, 0, 10);
      $format = explode($separartor, $substrDate);
      return $format[2].$separartor.$format[1].$separartor.$format[0];
    }

}
