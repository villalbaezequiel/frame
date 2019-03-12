<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectProvider;

class NotificationsController extends Controller
{

    public function getAcceptProjectCrew($id_project_provider)
    {
      return view('notifications.crew.accept_project', [
        'crew' => ProjectProvider::find($id_project_provider)
      ]);
    }

    public function postAcceptProjectCrew(Request $request)
    {
      try {
          $message = '';
          $project_provider = ProjectProvider::find($request->get('id_project_provider'));

          if($project_provider->active == '1' || $project_provider->active == '2'){
            $message = 'La solicitud al Proyecto ya fue respondida con Anterioridad. Gracias!';
          } else {
            if($request->get('confirmation') == 1){
              $project_provider->active = "1";
              $project_provider->save();

              $message = 'Haz aceptado la solicitud del Proyecto. En brevedad nos contactaremos con usted. Gracias!';

            } elseif($request->get('confirmation') == 2) {
              // send mail to suplent crew

              $project_provider->active = "2";
              $project_provider->save();

              $message = 'Haz rechazado la solicitud del Proyecto. Gracias!';
            }
          }

          return back()->withInput()->with('message', $message);

      } catch (\Exception $e) {

      }

    }
}
