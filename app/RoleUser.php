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

  static public function getRolesRedirectUrl($key_rol)
  {
    if($key_rol == "1" || $key_rol == "2" || $key_rol == "14" || $key_rol == "15") {
      return "/projects";
    } elseif($key_rol == "3") {
      return "/providers";
    } elseif($key_rol == "4") {
      return "/clients";
    } elseif($key_rol == "12" || $key_rol == "5") {
      return "/workers_categories";
    } elseif($key_rol == "13" || $key_rol == "5") {
      return "/frame_functions";
    } elseif($key_rol == "6") {
      return "/users";
    } elseif($key_rol == "7") {
      return "/utilities/contracts";
    } elseif($key_rol == "8") {
      return "/reports";
    } elseif($key_rol == "9") {
      return "/projects_jornadas";
    } elseif($key_rol == "10") {
      return "/center_costs";
    } elseif($key_rol == "11") {
      return "/callsheet";
    }
 
  }

}
