<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Role;

class RoleUser extends Model
{
  protected $table = 'role_user';

  static public function getRoleNameByUser($id)
  {
    $rol = RoleUser::where('user_id', $id)->first();

    if($rol){
      $nameRol = Role::find($rol->role_id);
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
    //return $this->hasMany('Caffeinated\Shinobi\Models\Role');
  }

  static public function getRoles()
  {
    $listRoles = [
      '1'   => 'Super Administrador',
      '2'   => 'Proyectos',
      '3'   => 'Teams',
      '4'   => 'Clientes',
      '5'   => 'Categorías Sat / Funciones Frame',
      '6'   => 'Usuarios',
      '7'   => 'Utilidades',
      '8'   => 'Reportes',
      '9'   => 'Jornadas De Proyectos',
      '10'  => 'Centro de Costos',
      '11'  => 'Callsheet',
      '12'  => 'Categorías Sat',
      '13'  => 'Funciones Frame',
      '14'  => 'Proyectos / Jornadas De Proyectos',
      '15'  => 'Proyectos / Jornadas De Proyectos / Callsheet'
    ];
    return $listRoles;
  }

}
