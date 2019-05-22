<?php

use Illuminate\Database\Seeder;
use App\User;
use App\RoleUser;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User;
      $user->name = 'Ezequiel';
      $user->last_name = 'Villalba';
      $user->email = 'villalbaezequiel64@gmail.com';
      $user->type_dni = 'dni';
      $user->dni = '38679374';
      $user->cuit = '20386793744';
      $user->gender = 'male';
      $user->civil_status = 'soltero';
      $user->birthdate = '1994-12-23 00:00:00';
      $user->id_country = '2';
      $user->password = \Illuminate\Support\Facades\Hash::make('EVI12345!!');
      $user->is_crew = '0';
      $user->active = '1';
      $user->save();

      if($user){
        $role_user = new RoleUser;
        $role_user->role_id = 1;
        $role_user->user_id = $user->id;
        $role_user->save();
      }

      $userTwo = new User;
      $userTwo->name = 'Esteban';
      $userTwo->last_name = 'Civilla';
      $userTwo->email = 'estebancivilla@gmail.com';
      $userTwo->type_dni = 'dni';
      $userTwo->dni = '31206797';
      $userTwo->cuit = '24312067974';
      $userTwo->gender = 'male';
      $userTwo->civil_status = 'casado';
      $userTwo->birthdate = '1984-09-10 00:00:00';
      $userTwo->id_country = '2';
      $userTwo->password = \Illuminate\Support\Facades\Hash::make('ECI12345!!');
      $userTwo->is_crew = '0';
      $userTwo->active = '1';
      $userTwo->save();

      if($userTwo){
        $role_user = new RoleUser;
        $role_user->role_id = 1;
        $role_user->user_id = $userTwo->id;
        $role_user->save();
      }

    }
}
