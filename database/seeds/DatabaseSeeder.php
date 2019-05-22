<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        CountriesTableSeeder::class,
        StudiesTableSeeder::class,
        WorkdaysTableSeeder::class,
        ProyectCategoriesTableSeeder::class,
        ContractsTableSeeder::class,
        PermissionsTableSeeder::class,
        RolesTableSeeder::class,
        UsersTableSeeder::class,

      ]);
    }
}
