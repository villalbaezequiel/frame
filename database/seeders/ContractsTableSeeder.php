<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Contract;

class ContractsTableSeeder extends Seeder
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
        ['Eventual'],
        ['Plazo Fijo'],
        ['Tiempo Indeterminado'],
        ['Servicios']
      );

      foreach ($list as $value) {
        $contract = new Contract;
        $contract->name = $value[0];
        $contract->active = '1';
        $contract->save();
      }
    }
}
