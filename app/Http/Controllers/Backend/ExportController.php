<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Helpers;
use App\Project;
use App\Contract;
use App\WorkersCategory;
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

        $projectProvider = ProjectProvider::find($id_project_provider);
        $provider = Provider::find($projectProvider->id_provider);
        $user = User::find($provider->id_user);

        // create new docx
        $word = new \PhpOffice\PhpWord\PhpWord();
        $section = $word->addSection();
        $timestamp = date('Y_m_d_h_i_s');

        if(Contract::getName($projectProvider->id_contract) == "Eventual"){

          \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractEventual( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $user->dni, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat), $projectProvider->total_workdays_text, "$".$projectProvider->total_workdays, Project::getName($projectProvider->id_project) ));
          $name_contract_doc = "contrato_eventual_{$timestamp}.docx";

        } elseif(Contract::getName($projectProvider->id_contract) == "Plazo Fijo"){

          \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractPlazoFijo( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $user->dni, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat), $projectProvider->total_workdays_text, "$".$projectProvider->total_workdays, Project::getName($projectProvider->id_project) ));
          $name_contract_doc = "contrato_plazofijo_{$timestamp}.docx";

        } elseif(Contract::getName($projectProvider->id_contract) == "Servicios"){

          \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractServicio( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $user->dni, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat), $projectProvider->total_workdays_text, "$".$projectProvider->total_workdays, Project::getName($projectProvider->id_project) ));
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
}
