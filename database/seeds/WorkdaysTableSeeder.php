<?php

use Illuminate\Database\Seeder;
use App\Workday;

class WorkdaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // key: name, description
      $list = array(
        ['Mensual', 'Más de 15 días'],
        ['Semanal', 'Más de 5 días hasta 15 días'],
        ['Jornada', 'Menos de 5 días']
      );

      foreach ($list as $value) {
        $workday = new Workday;
        $workday->name = $value[0];
        $workday->description = $value[1];
        $workday->active = '1';
        $workday->save();
      }
    }
}
