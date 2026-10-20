<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Provider;
use App\User;

class UsersController extends Controller
{
    protected $_permission;
    protected $permissionApproved = ['1', '6'];

    protected $helpers;
    
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware(function ($request, $next) {
        $cancelPermission   = true;
        $this->_permission  = json_decode(Auth::user()->permissions);
        
        if($request->path() == "users/".Auth::user()->id."/edit" && $request->method() == 'GET')
        {
          return $next($request);
        }

        if($request->path() == "users/".Auth::user()->id && $request->method() == 'PUT')
        {
          return $next($request);
        }

        if($this->_permission){
          foreach($this->permissionApproved as $approved){
            foreach($this->_permission as $userPermission){
              if($approved == $userPermission){
                $cancelPermission = false;
                return $next($request);
              }
            }
          }
        }

        abort(404);
      });

      $this->helpers = new Helpers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.users.index', [
        'users' => User::orderBy('id', 'DESC')
                        ->get()
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

          $user = new User;
          $user->name = $request->get('name');
          $user->last_name = $request->get('last_name');
          $user->email = $request->get('email');
          $user->type_dni = $request->get('type_dni');
          $user->dni = $request->get('dni');
          $user->cuit = $request->get('cuit');
          $user->gender = $request->get('gender');
          $user->civil_status = $request->get('civil_status');
          $user->birthdate = $this->helpers->setDateFormat($request->get('birthdate'));
          $user->id_country = $request->get('id_country');
          $user->password = Hash::make('frame_'.$request->get('cuit'));
          $user->permissions = ($request->get('permissions') ? json_encode($request->get('permissions')) : null);
          $user->is_notification = $request->get('is_notification');
          $user->section_notification = ($request->get('section_notification') ? json_encode($request->get('section_notification')) : null);
          $user->active = $request->get('active');
          $user->save();

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
        'user' => User::find($id)
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

          $user = User::find($id);
          $user->name = $request->get('name');
          $user->last_name = $request->get('last_name');
          $user->email = $request->get('email');
          $user->type_dni = $request->get('type_dni');
          $user->dni = $request->get('dni');
          $user->cuit = $request->get('cuit');
          $user->gender = $request->get('gender');
          $user->civil_status = $request->get('civil_status');
          $user->birthdate = $this->helpers->setDateFormat($request->get('birthdate'));
          $user->id_country = $request->get('id_country');
          if($request->get('password')){
            $user->password = Hash::make($request->get('password'));
          }
          $user->permissions = ($request->get('permissions') ? json_encode($request->get('permissions')) : null);
          $user->is_notification = $request->get('is_notification');
          $user->section_notification = ($request->get('section_notification') ? json_encode($request->get('section_notification')) : null);
          $user->active = $request->get('active');
          $user->save();

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
        // if Users is Provider, destroy
        $provider = Provider::where('id_user', $id)->delete();
      $user->delete();

      return response(array('message' => 'Usuario eliminado con exito!'));
    }
}
