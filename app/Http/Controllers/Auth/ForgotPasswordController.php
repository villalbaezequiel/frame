<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {
      $user = User::where('email', $request->get('email'))->first();

      if($user)
      {
        if($user->permissions)
        {
          $this->validateEmail($request);
          $response = $this->broker()->sendResetLink(
            $request->only('email')
          );
          return $response == Password::RESET_LINK_SENT
                      ? $this->sendResetLinkResponse($request, $response)
                      : $this->sendResetLinkFailedResponse($request, $response);
        } else {
          return redirect('/login')->with('message', '¡No tienes Permisos para Recuperar Contraseña!') ;
        }
      } else {
        $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
          $request->only('email')
        );
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
      }

    }
}
