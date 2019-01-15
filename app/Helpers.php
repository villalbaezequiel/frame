<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helpers extends Model
{

    static function print_x($array)
    {
      echo "<pre>";
      print_r($array);
      echo "</pre>";
    }

    static function getTypesDocumentationPerson()
    {
      $list = array('dni'=>'DNI', 'le'=>'LE', 'CI'=>'CI');
      return $list;
    }

    static function getGendersPerson()
    {
      $list = array('male'=>'Masculino', 'female'=>'Femenino');
      return $list;
    }

    static function setMessageValidationForm($key)
    {
      return "El $key insertado se encuentra en uso en el Sistema. Por favor, ingrese otro!";
    }
}
