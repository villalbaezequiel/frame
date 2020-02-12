<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\TeamProject;
use App\Notifications\SeguroServicios;
use App\Helpers;
use App\User;
use App\Project;
use App\Provider;
use App\ProjectProvider;

class NotificationsController extends Controller
{
    // ProjectProvider -> ACTIVE: 0 = "pendiente", 1 = "aceptado", 2 = "rechazado"

    public function getAcceptProjectTeam($id_project_provider)
    {
      return view('notifications.team.accept_project', [
        'crew' => ProjectProvider::find($id_project_provider)
      ]);
    }

    public function postAcceptProjectTeam(Request $request)
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

              $project_provider->active = "2"; // rechazado
              $project_provider->save();

              $message = 'Haz rechazado la solicitud del Proyecto. Gracias!';

              /* ---------------------------------------------------------------*/

              // Si el Titular no ACEPTA, se lo notifica al Secundario
              // y a este Team Secundario se le envia un Mail
              // verifico si es Titular y tiene SUPLENTE

              if($project_provider->is_reemplazo == '1' && $project_provider->active == '2'){

                $checkSecundario = ProjectProvider::where('id_project', $project_provider->id_project)
                                                  ->where('is_reemplazo', '2')
                                                  ->where('id_crew_reemplazo', $project_provider->id_provider)
                                                  ->where('active', '0')
                                                  ->first();

                if(!empty($checkSecundario)){

                  $crewSecundario = ProjectProvider::find($checkSecundario->id);
                  $project = Project::find($crewSecundario->id_project);
                  $user = User::find(Provider::getIdUser($crewSecundario->id_provider));

                  // Enviar Mail al crew notificandolo del proyecto y si acepta trabajar
                  $data = array(
                    'project' => $project,
                    'user' => $user,
                    'project_crew' => $crewSecundario
                  );
                  $user->notify(new TeamProject($data));

                }

              }

            }
          }

          // Verifico si todos los Team del Proyecto,
          // que sean TITULAR O SI EL TITULAR NO ACEPTO, QUE SU SUPLENTE HAYA ACEPTADO
          // SI EL TITULAR NO TIENE SUPLENTE Y NO ACEPTA, continue;
          // aceptaron el Contrato

          $id_project = $project_provider->id_project;

          $crews_project = ProjectProvider::where('id_project', $id_project)
                                            ->where('is_reemplazo', '1')
                                            ->get();
          $status = true;

          foreach ($crews_project as $value) {

            if($value->active == '0'){
              $status = false;
            } elseif($value->active == '2'){

              // verifico si su Secundario acepto
              $checkSecundario = ProjectProvider::where('id_project', $id_project)
                                                ->where('is_reemplazo', '2')
                                                ->where('id_crew_reemplazo', $value->id_provider)
                                                ->first();
              if(!empty($checkSecundario)){

                if($checkSecundario->active == '0' || $checkSecundario->active == '2'){
                  $status = false;
                }

              } else {
                $status = false;
              }

            }

          }

          if($status == true){
            // project active 1
            $project = Project::find($id_project);
            $project->active = '1';
            $project->save();

            // chequer si tengo al menos un personal de tipo de contrato servicios
            $checkServices = ProjectProvider::where('id_project', $id_project)
                                            ->where('id_contract', '4') // 4 = Servicios
                                            ->count();

            if($checkServices > 0)  {
              // send mail a los Profesionales que VE la generacion de seguros
              $listUsersNoti = User::getAllOwnerSecureNotification();
              foreach ($listUsersNoti as $user) {

                $data = array(
                  'user' => $user,
                  'project' => $projectCheck
                );

                $user->notify(new SeguroServicios($data));
              }
            }
            
          }

          return back()->withInput()->with('message', $message);

      } catch (\Exception $e) {

      }

    }
}
