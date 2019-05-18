<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use App\Helpers;
use App\Project;
use App\Contract;
use App\WorkersCategory;
use App\User;
use App\Provider;
use App\ProjectProvider;
use App\FrameFunction;

class ExportController extends Controller
{
    /*
      export contract by Single Team to Project
    */
    public function crewContract($id_project_provider){
      try {

        $projectProvider = ProjectProvider::find($id_project_provider);
        $provider = Provider::find($projectProvider->id_provider);
        $user = User::find($provider->id_user);

        // create new docx
        $word = new \PhpOffice\PhpWord\PhpWord();
        $section = $word->addSection();
        $timestamp = date('Y_m_d_h_i_s');

        if(Contract::getName($projectProvider->id_contract) == "Eventual"){

          \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractEventual( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $provider->cp, $user->dni, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat), $projectProvider->total_workdays_text, "$".$projectProvider->total_workdays, Project::getName($projectProvider->id_project) ));
          $name_contract_doc = "contrato_eventual_{$timestamp}.docx";

        } elseif(Contract::getName($projectProvider->id_contract) == "Plazo Fijo"){

          \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractPlazoFijo( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $provider->cp, $user->dni, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), Helpers::getDateParseFormat($projectProvider->finish_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat), $projectProvider->total_workdays_text, "$".$projectProvider->total_workdays, Project::getName($projectProvider->id_project), $user->email ));
          $name_contract_doc = "contrato_plazofijo_{$timestamp}.docx";

        } elseif(Contract::getName($projectProvider->id_contract) == "Servicios"){

          \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractServicio( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $provider->cp, $user->dni, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), Helpers::getDateParseFormat($projectProvider->finish_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat), $projectProvider->total_workdays_text, "$".$projectProvider->total_workdays, Project::getName($projectProvider->id_project) ));
          $name_contract_doc = "contrato_servicio_{$timestamp}.docx";
        }

        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        Storage::disk('public')->makeDirectory("contract/".$id_project_provider);
        $name_file = 'app/public/contract/'.$id_project_provider.'/'.$name_contract_doc;
        $objectWriter->save(storage_path($name_file));

        return response()->download(storage_path($name_file));

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

    public function callSheet($id_project)
    {
      try{
        $functionsFrame = ProjectProvider::select('id_function_frame')
                                    ->where('id_project', $id_project)
                                    ->where('active', '1')
                                    ->groupBy('id_function_frame')
                                    ->get();

        $listTeam = ProjectProvider::where('id_project', $id_project)
                                  ->where('active', '1')
                                  ->get();
        $results = array();

        foreach($functionsFrame as $frame){

          $results[$frame->id_function_frame] = array();

          foreach($listTeam as $team){
            if($team->id_function_frame == $frame->id_function_frame){

              $other_phone = (\App\Provider::getOtherTelephone($team->id_provider) != '' ? ' - '.\App\Provider::getOtherTelephone($crew->id_provider) : '');

              array_push($results[$team->id_function_frame], [
                'rol_desempenar' => WorkersCategory::getName($team->id_category_sat),
                'nombre_team' => Provider::getNameOrderLastName($team->id_provider),
                'telefono' => Provider::getTelephone($team->id_provider),
                'email' => Provider::getEmail($team->id_provider).$other_phone
              ]);
            }
          }
        }

        $timestamp = date('Y_m_d_h_i_s');
        $nameProject = Project::getName($id_project);

        Excel::create("callshet_{$nameProject}_{$timestamp}", function($excel) use ($results){

          foreach ($results as $key => $value) {
            $nameFF = FrameFunction::getName($key);
            $excel->sheet($nameFF, function($sheet) use ($value){
              $sheet->fromArray(json_decode( json_encode($value), true));
            });
          }

        })->download();



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
