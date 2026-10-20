<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Study;

class StudiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // key: name,
      $list = array(
        ['Secundario Completo'],
        ['Terciario'],
        ['Universitario']
      );

      foreach ($list as $value) {
        $study = new Study;
        $study->name = $value[0];
        $study->active = '1';
        $study->save();
      }
    }
}
