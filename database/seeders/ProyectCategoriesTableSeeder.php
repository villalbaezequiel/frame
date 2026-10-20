<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\ProyectCategory;

class ProyectCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // key: name
      $list = array(
        ['TV'],
        ['DIGITAL']
      );

      foreach ($list as $value) {
        $proyectCategory = new ProyectCategory;
        $proyectCategory->name = $value[0];
        $proyectCategory->active = '1';
        $proyectCategory->save();
      }
    }
}
