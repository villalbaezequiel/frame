<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Role;

class RoleUser extends Model
{
  protected $table = 'role_user';

  static public function getRoleNameByUser($id)
  {
    $rol = RoleUser::where('user_id', $id)->get();

    if(isset($rol[0])){
      $nameRol = Role::find($rol[0]->role_id);
      return $nameRol->name;
    } else {
      return "No asignado";
    }
  }

  static public function getRoleUser($id)
  {
    $rol = RoleUser::where('user_id', $id)->first();

    if($rol){
      if($rol->role_id == 0) {
        return false;
      } else {
        return $rol;
      }
    }
  }

  static public function role()
  {
    return $this->hasMany('Caffeinated\Shinobi\Models\Role');
  }

}
