<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Helpers;
use App\Client;
use App\User;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.clients.index', [
        'clients' => Client::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.clients.create');
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
          // New User
          $user = new User;
          $user->name = $request->get('name');
          $user->last_name = $request->get('last_name');
          $user->email = $request->get('email');
          $user->type_dni = $request->get('type_dni');
          $user->dni = $request->get('dni');
          $user->cuit = $request->get('cuit');
          $user->gender = $request->get('gender');
          $user->id_country = $request->get('country');
          $user->password = Hash::make($request->get('dni'));
          $user->active = 1;
          $user->save();
          // New Client
          $client = new Client;
          $client->id_user = $user->id;
          $client->nick = $request->get('nick');
          $client->razon_social = $request->get('razon_social');
          $client->address = $request->get('address');
          $client->address_number = $request->get('address_number');
          $client->cp = $request->get('cp');
          $client->location = $request->get('location');
          $client->telephone = $request->get('telephone');
          $client->other_telephone = $request->get('other_telephone');
          $client->retencion_ganancia = $request->get('retencion_ganancia');
          $client->iibb = $request->get('iibb');
          $client->iva = $request->get('iva');
          $client->save();

          return redirect('/clients')->with('message', 'Cliente creado con exito!');

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
      $client = Client::find($id);
      return view('backend.clients.edit', [
        'client' => $client,
        'user' => User::where('id', $client->id_user)->first()
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
        $email = User::where('email', $request->get('email'))->where('id', '!=', $request->get('id_user'))->count();
        $dni = User::where('dni', $request->get('dni'))->where('id', '!=', $request->get('id_user'))->count();
        $cuit = User::where('cuit', $request->get('cuit'))->where('id', '!=', $request->get('id_user'))->count();

        if($email == 0 && $dni == 0 && $cuit == 0):
          // Update User
          $user = User::find($request->get('id_user'));
          $user->name = $request->get('name');
          $user->last_name = $request->get('last_name');
          $user->email = $request->get('email');
          $user->type_dni = $request->get('type_dni');
          $user->dni = $request->get('dni');
          $user->cuit = $request->get('cuit');
          $user->gender = $request->get('gender');
          $user->id_country = $request->get('country');
          $user->active = $request->get('active');
          $user->save();
          // Update Client
          $client = Client::find($id);
          $client->nick = $request->get('nick');
          $client->razon_social = $request->get('razon_social');
          $client->address = $request->get('address');
          $client->address_number = $request->get('address_number');
          $client->cp = $request->get('cp');
          $client->location = $request->get('location');
          $client->telephone = $request->get('telephone');
          $client->other_telephone = $request->get('other_telephone');
          $client->retencion_ganancia = $request->get('retencion_ganancia');
          $client->iibb = $request->get('iibb');
          $client->iva = $request->get('iva');
          $client->save();

          return redirect('/clients')->with('message', 'Cliente editado con exito!');

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
      $client = Client::find($id);
        // User Delete
        $user = User::find($client->id_user);
        $user->delete();
      // Client Delete
      $client->delete();

      return redirect('/clients')->with('message', 'Cliente eliminado con exito!');
    }
}
