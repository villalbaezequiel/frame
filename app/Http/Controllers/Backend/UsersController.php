<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Caffeinated\Shinobi\Models\Role;
use App\Helpers;
use App\RoleUser;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.users.index', [
        'users' => User::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.users.create', [
        'roles' => Role::all()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $message;
      try {
        // Validations, check: email, dni, cuit
        $email = User::where('email', $request->get('email'))->count();
        $dni = User::where('dni', $request->get('dni'))->count();
        $cuit = User::where('cuit', $request->get('cuit'))->count();

        if($email == 0 && $dni == 0 && $cuit == 0):

          // add format birthdate
          $birthdate = explode('/', $request->get('birthdate'));

          $user = new User;
          $user->name = $request->get('name');
          $user->last_name = $request->get('last_name');
          $user->email = $request->get('email');
          $user->type_dni = $request->get('type_dni');
          $user->dni = $request->get('dni');
          $user->cuit = $request->get('cuit');
          $user->gender = $request->get('gender');
          $user->civil_status = $request->get('civil_status');
          $user->birthdate = (isset($birthdate[2]) ? $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0] : $request->get('birthdate'));
          $user->id_country = $request->get('id_country');
          $user->password = Hash::make('frame_'.$request->get('cuit'));
          $user->active = $request->get('active');
          $user->save();

          // create role user
          $role_user = new RoleUser;
          $role_user->role_id = $request->get('role_user');
          $role_user->user_id = $user->id;
          $role_user->save();

          return redirect("/users")->with('message', 'Usuario Creado con Exito!');

        else:

          if($email == 1){
            $message = Helpers::setMessageValidationForm('Email');
          } elseif($dni == 1){
            $message = Helpers::setMessageValidationForm('DNI');
          } else {
            $message = Helpers::setMessageValidationForm('CUIT');
          }
          return back()->withInput()->with('message', $message);

        endif;

      } catch(\Exception $e) {
        if(\Config::get('app.debug')):
          $message = 'ERROR('.$e->getLine().'): '.$e->getMessage();
        else:
          $message = 'Se ha producido un error. Por favor intente nuevamente.';
        endif;

        $respuesta = array(
          'estado' => false,
          'mensaje' => $message
        );
        return \Response::json($respuesta);

      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view('backend.users.edit',[
        'user' => User::find($id),
        'roles' => Role::all(),
        'role_user' => RoleUser::getRoleUser($id)
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $message;
      try {
        // Validations, check: email, dni, cuit
        $email = User::where('email', $request->get('email'))->where('id', '!=', $id)->count();
        $dni = User::where('dni', $request->get('dni'))->where('id', '!=', $id)->count();
        $cuit = User::where('cuit', $request->get('cuit'))->where('id', '!=', $id)->count();

        if($email == 0 && $dni == 0 && $cuit == 0):

          // add format birthdate
          $birthdate = explode('/', $request->get('birthdate'));

          $user = User::find($id);
          $user->name = $request->get('name');
          $user->last_name = $request->get('last_name');
          $user->email = $request->get('email');
          $user->type_dni = $request->get('type_dni');
          $user->dni = $request->get('dni');
          $user->cuit = $request->get('cuit');
          $user->gender = $request->get('gender');
          $user->civil_status = $request->get('civil_status');
          $user->birthdate = (isset($birthdate[2]) ? $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0] : $request->get('birthdate'));
          $user->id_country = $request->get('id_country');
          $user->active = $request->get('active');
          $user->save();

          // update role users
          if($request->get('role_user_id') == false){
            $role_user = new RoleUser;
            $role_user->role_id = $request->get('role_user');
            $role_user->user_id = $id;
            $role_user->save();
          } else {
            $role_user = RoleUser::find($request->get('role_user_id'));
            $role_user->role_id = $request->get('role_user');
            $role_user->user_id = $id;
            $role_user->save();
          }

          return redirect("/users/$id/edit")->with('message', 'Usuario Editado con Exito!');

        else:

          if($email == 1){
            $message = Helpers::setMessageValidationForm('Email');
          } elseif($dni == 1){
            $message = Helpers::setMessageValidationForm('DNI');
          } else {
            $message = Helpers::setMessageValidationForm('CUIT');
          }
          return back()->withInput()->with('message', $message);

        endif;

      } catch(\Exception $e) {
        if(\Config::get('app.debug')):
          $message = 'ERROR('.$e->getLine().'): '.$e->getMessage();
        else:
          $message = 'Se ha producido un error. Por favor intente nuevamente.';
        endif;

        $respuesta = array(
          'estado' => false,
          'mensaje' => $message
        );
        return \Response::json($respuesta);

      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
        $role_user = RoleUser::where('user_id', $id)->delete();
      $user->delete();

      return response(array('message' => 'Usuario eliminado con exito!'));
    }
}
