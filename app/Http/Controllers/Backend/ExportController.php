<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use App\Provider;
use App\ProjectProvider;

class ExportController extends Controller
{
    /*
      export contract by Single Crew to Project
    */
    public function crewContract($id_project_provider){
      try {

        $project_provider = ProjectProvider::find($id_project_provider);
        $provider = Provider::find($project_provider->id_provider);
        $user = User::find($provider->id_user);

        $data = array(
          'project_provider' => $project_provider,
          'provider' => $provider,
          'user' => $user
        );

        $pdf = PDF::loadView('export.pdf.crew_contract', compact('data'));
        $date = date('d-M-Y');

        return $pdf->download("contrato_crew_{$date}.pdf");

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
}
