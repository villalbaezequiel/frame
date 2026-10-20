<?php

namespace App;

use App\Notifications\MyResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
      $this->notify(new MyResetPassword($token));
    }

    static function getName($id)
    {
      $user = User::find($id);
      if($user){
        return $user->name;
      }
    }

    static function getLastName($id)
    {
      $user = User::find($id);
      if($user) {
        return $user->last_name;
      }
    }

    static function getFullName($id)
    {
      $user = User::find($id);
      if($user) {
        return $user->last_name.' '.$user->name;
      }
    }

    static function getDNI($id)
    {
      $user = User::find($id);
      if($user) {
        return $user->dni;
      }
    }

    static function getActive($id)
    {
      $user = User::find($id);
      if($user) {
        if($user->active == 0){
          return "No";
        } else {
          return "Si";
        }
      }
    }

    static function getAllCenterCostNotification()
    {
      try {
        $list = User::where('section_notification', 'like', '%"center_cost"%')
                      ->where('is_notification', '1')
                      ->where('active', '1')
                      ->get();
        return $list;
      } catch (\Exception $error) {

      }
    }

    static function getAllOwnerSecureNotification()
    {
      try {
        $list = User::where('section_notification', 'like', '%"owner_secure"%')
                      ->where('is_notification', '1')
                      ->where('active', '1')
                      ->get();
        return $list;
      } catch (\Exception $error) {

      }
    }

    static function getAllProducerOrdersNotification($referente)
    {
      try {
        if(json_decode($referente))
        {
          $listReferentes = array_map('intval', json_decode($referente));
        
          $list = User::select('users.*')
                        ->join('providers', 'providers.id_user', '=', 'users.id')
                        ->whereIn('providers.id', $listReferentes)
                        ->where('users.permissions', 'like', '%"16"%')
                        ->where('users.section_notification', 'like', '%"producer_orders"%')
                        ->where('users.is_notification', '1')
                        ->where('users.active', '1')
                        ->get();
          return $list;
        } else {
          return;
        }

      } catch (\Exception $error) {

      }
    }

    static function getListPermissionsFromUser($user)
    {
      $listPermissions = array();
  
      if($user->permissions) {
        foreach(json_decode($user->permissions) as $userPermission) {
          array_push($listPermissions, $userPermission);
        }
      }

      return $listPermissions;
    }

}
