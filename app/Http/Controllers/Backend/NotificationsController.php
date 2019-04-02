<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
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

              // si tiene suplente, actualizar su columnna (ejemplo $project_provider->suplente) a "NO LO NECESITAMOS"
              // if(isset suplente de $project_provider->id )

              $message = 'Haz aceptado la solicitud del Proyecto. En brevedad nos contactaremos con usted. Gracias!';

            } elseif($request->get('confirmation') == 2) {
              // send mail to suplent crew

              $project_provider->active = "2";
              $project_provider->save();

              $message = 'Haz rechazado la solicitud del Proyecto. Gracias!';
            }
          }

          // Verifico si todos los Crew del Proyecto,
          // que sean TITULAR O SI EL TITULAR NO ACEPTO, QUE SU SUPLENTE HAYA ACEPTADO
          // SI EL TITULAR NO TIENE SUPLENTE Y NO ACEPTA, continue;
          // aceptaron el Contrato

          $id_project = $project_provider->id_project;
          $crews_project = ProjectProvider::where('id_project', $id_project)->get();
          $status = true;

          foreach ($crews_project as $value) {
            if($value->active == '0'){
              $status = false;
            }
          }

          if($status == true){
            // project active 1
            $project = Project::find($id_project);
            $project->active = '1';
            $project->save();
          }

          return back()->withInput()->with('message', $message);

      } catch (\Exception $e) {

      }

    }
}
