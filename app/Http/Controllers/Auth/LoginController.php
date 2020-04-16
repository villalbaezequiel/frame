<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\RoleUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
      $user         = User::where('email', $request->email)->first();
      $permissions  = ($user ? json_decode($user->permissions) : null);

      if($permissions && count($permissions))
      {
        return [
          'email'     => $request->email,
          'password'  => $request->password,
          'is_crew'   => $user->is_crew,
          'active'    => $user->active
        ];
      } else {
        return [
          'email'     => '',
          'password'  => '',
          'is_crew'   => 0,
          'active'    => 0
        ];
      }

    }
}
