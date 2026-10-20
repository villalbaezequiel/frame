<?php


namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Client;

class ClientsController extends Controller
{
    protected $_permission;
    protected $permissionApproved = ['1', '4'];

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware(function ($request, $next) {
        $cancelPermission = true;
        $this->_permission = json_decode(Auth::user()->permissions);

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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.clients.index', [
        'clients' => Client::orderBy('id', 'DESC')->get()
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
        $cuit = Client::where('cuit', $request->get('cuit'))->count();

        if($cuit == 0):
          // New Client
          $client = new Client;
          $client->razon_social = $request->get('razon_social');
          $client->nick = $request->get('nick');
          $client->cuit = $request->get('cuit');
          $client->address = $request->get('address');
          $client->address_number = $request->get('address_number');
          $client->piso_depto = $request->get('piso_depto');
          $client->id_country = $request->get('country');
          $client->location = $request->get('location');
          $client->cp = $request->get('cp');
          $client->telephone = $request->get('telephone');
          $client->other_telephone = $request->get('other_telephone');
          $client->contact_name = $request->get('contact_name');
          $client->contact_email = $request->get('contact_email');
          $client->contact_telephone = $request->get('contact_telephone');
          $client->retencion_ganancia = $request->get('retencion_ganancia');
          $client->iibb = $request->get('iibb');
          $client->iva = $request->get('iva');
          $client->id_tango = $request->get('id_tango');
          $client->active = $request->get('active');
          $client->save();

          return redirect('/clients')->with('message', 'Cliente creado con exito!');

        else:

          $message = Helpers::setMessageValidationForm('CUIT');

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
        'client' => $client
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
        $cuit = Client::where('cuit', $request->get('cuit'))->where('id', '!=', $id)->count();

        if($cuit == 0):
          // New Client
          $client = Client::find($id);
          $client->razon_social = $request->get('razon_social');
          $client->nick = $request->get('nick');
          $client->cuit = $request->get('cuit');
          $client->address = $request->get('address');
          $client->address_number = $request->get('address_number');
          $client->piso_depto = $request->get('piso_depto');
          $client->id_country = $request->get('country');
          $client->location = $request->get('location');
          $client->cp = $request->get('cp');
          $client->telephone = $request->get('telephone');
          $client->other_telephone = $request->get('other_telephone');
          $client->contact_name = $request->get('contact_name');
          $client->contact_email = $request->get('contact_email');
          $client->contact_telephone = $request->get('contact_telephone');
          $client->retencion_ganancia = $request->get('retencion_ganancia');
          $client->iibb = $request->get('iibb');
          $client->iva = $request->get('iva');
          $client->id_tango = $request->get('id_tango');
          $client->active = $request->get('active');
          $client->save();

          return redirect('/clients')->with('message', 'Cliente editado con exito!');

        else:

          $message = Helpers::setMessageValidationForm('CUIT');

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
      $client->delete();

      return response(array('message' => 'Cliente eliminado con exito!'));
    }
}
