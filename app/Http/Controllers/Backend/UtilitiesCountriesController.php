<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use App\Country;

class UtilitiesCountriesController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('permission:countries', ['except' => ['index','create', 'store', 'edit', 'update', 'show','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       return view('backend.countries.index', [
         'countries' => Country::orderBy('id', 'DESC')->get()
       ]);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
       return view('backend.countries.create');
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
           // New Country
           $country = new Country;
           $country->name = $request->get('name');
           $country->male = $request->get('male');
           $country->female = $request->get('female');
           $country->save();

           return redirect('/utilities/countries')->with('message', 'País creado con exito!');

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
       $country = Country::find($id);
       return view('backend.countries.edit', [
         'country' => $country
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
           // Update Country
           $country = Country::find($id);
           $country->name = $request->get('name');
           $country->male = $request->get('male');
           $country->female = $request->get('female');
           $country->save();

           return redirect('/utilities/countries')->with('message', 'País editado con exito!');

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
       $country = Country::find($id);
       $country->delete();

       return response(array('message' => 'País eliminado con exito!'));
     }
 }
