<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Notifications\NewTeam;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Provider;
use App\ProviderAssessment;
use App\User;

class ProvidersController extends Controller
{
    protected $_permission;
    protected $permissionApproved = ['1', '3'];

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

      });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       return view('backend.teams.index', [
         'providers' => Provider::orderBy('id', 'DESC')->get()
       ]);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
       return view('backend.teams.create');
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

           // New User
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
           $user->is_crew = '1';
           $user->active = $request->get('active');
           $user->save();

           // New Provider
           $provider = new Provider;
           $provider->id_user = $user->id;
           $provider->address = $request->get('address');
           $provider->address_number = $request->get('address_number');
           $provider->piso_depto = $request->get('piso_depto');
           $provider->cp = $request->get('cp');
           $provider->location = $request->get('location');
           $provider->nationality = $request->get('nationality');
           $provider->id_study = $request->get('id_study');
           $provider->social_work = $request->get('social_work');
           $provider->social_work_name = $request->get('social_work_name');
           $provider->social_work_code = $request->get('social_work_code');
           $provider->cbu = $request->get('cbu');
           $provider->bank = $request->get('bank');
           $provider->type_account = $request->get('type_account');
           $provider->number_account = $request->get('number_account');
           $provider->alias_account = $request->get('alias_account');
           $provider->telephone = $request->get('telephone');
           $provider->other_telephone = $request->get('other_telephone');
           $provider->id_function_frame = json_encode($request->get('id_function_frame'));
           $provider->referring = $request->get('referring');
           $provider->visa = $request->get('visa');
           $provider->save();

           // add valoration crew
           if($request->get('valoration_value')){
             $providerAssessment = new ProviderAssessment;
             $providerAssessment->id_provider = $provider->id;
             $providerAssessment->id_project = ($request->get('valoration_id_project') ? $request->get('valoration_id_project') : null);
             $providerAssessment->description = ($request->get('valoration_description') ? $request->get('valoration_description') : null);
             $providerAssessment->value = $request->get('valoration_value');
             $providerAssessment->save();
           }

           if($request->get('crew_register_person')){

             // Envio un Mail al Admin notificandolo que se REGISTRO un nuevo CREW

             // info del administrador
             if(!empty(env('NEW_CREW_NOTIFICATION1'))){
              $chekUserAdmin = User::where('email', env('NEW_CREW_NOTIFICATION1'))
                                    ->where('is_crew', '0')
                                    ->where('active', '1')
                                    ->first();
             }

            if(!empty(env('NEW_CREW_NOTIFICATION2'))){
              $chekUserAdminSecundario = User::where('email', env('NEW_CREW_NOTIFICATION2'))
                                    ->where('is_crew', '0')
                                    ->where('active', '1')
                                    ->first();
            }

            if(isset($chekUserAdmin) && $chekUserAdmin != null){
              $userAdmin = User::find($chekUserAdmin->id);
            } elseif(isset($chekUserAdminSecundario) && $chekUserAdminSecundario != null) {
              $userAdmin = User::find($chekUserAdminSecundario->id);
            }

            $data = array(
              'user' => $userAdmin,
              'crew' => $provider
            );
            $userAdmin->notify(new NewTeam($data));

            return redirect('/register')->with('message', '1');

           } else {
             return redirect('/providers')->with('message', 'Team creado con exito!');
           }

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
       $provider = Provider::find($id);
       return view('backend.teams.edit', [
         'provider' => $provider,
         'user' => User::where('id', $provider->id_user)->first(),
         'provider_assessments' => ProviderAssessment::where('id_provider', $id)->get()
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

           // add format birthdate
           $birthdate = explode('/', $request->get('birthdate'));

           // Update User
           $user = User::find($request->get('id_user'));
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
           $user->is_crew = '1';
           $user->save();
           // Update Provider
           $provider = Provider::find($id);
           $provider->address = $request->get('address');
           $provider->address_number = $request->get('address_number');
           $provider->piso_depto = $request->get('piso_depto');
           $provider->cp = $request->get('cp');
           $provider->location = $request->get('location');
           $provider->nationality = $request->get('nationality');
           $provider->id_study = $request->get('id_study');
           $provider->social_work = $request->get('social_work');
           $provider->social_work_name = $request->get('social_work_name');
           $provider->social_work_code = $request->get('social_work_code');
           $provider->cbu = $request->get('cbu');
           $provider->bank = $request->get('bank');
           $provider->type_account = $request->get('type_account');
           $provider->number_account = $request->get('number_account');
           $provider->alias_account = $request->get('alias_account');
           $provider->telephone = $request->get('telephone');
           $provider->other_telephone = $request->get('other_telephone');
           $provider->id_function_frame = json_encode($request->get('id_function_frame'));
           $provider->referring = $request->get('referring');
           $provider->visa = $request->get('visa');
           $provider->save();

           // add valoration crew
           if($request->get('valoration_value')){
             $providerAssessment = new ProviderAssessment;
             $providerAssessment->id_provider = $id;
             $providerAssessment->id_project = ($request->get('valoration_id_project') ? $request->get('valoration_id_project') : null);
             $providerAssessment->description = ($request->get('valoration_description') ? $request->get('valoration_description') : null);
             $providerAssessment->value = $request->get('valoration_value');
             $providerAssessment->save();
           }

           return redirect('/providers')->with('message', 'Team editado con exito!');

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
       $provider = Provider::find($id);
         // User Delete
         $user = User::find($provider->id_user);
         $user->delete();
       // Provider Delete
       $provider->delete();

       return response(array('message' => 'Team eliminado con exito!'));
     }
 }
