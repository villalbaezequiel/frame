<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProviderAssessment extends Model
{
    //

    static public function getCountByProvider($id)
    {
      $countValue = ProviderAssessment::select('value')->where('id_provider', $id)->get()->toArray();
      return array_sum(array_column($countValue, 'value'));
    }
}
