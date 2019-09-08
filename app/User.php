<?php

namespace App;

use App\Notifications\MyResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        $list = User::where('is_notification', '1')
                      ->where('section_notification', 'center_cost')
                      ->where('active', '1')
                      ->get();
        return $list;
      } catch (\Exception $error) {

      }
    }

}
