<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::create([
        'name'		=> 'Admin',
        'slug'  	=> 'admin',
        'description'		=> 'Admin',
        'special' 	=> 'all-access'
      ]);

      Role::create([
        'name'		=> 'Ninguno',
        'slug'  	=> 'ninguno',
        'description'  	=> 'ninguno',
        'special' 	=> 'no-access'
      ]);
    }
}
