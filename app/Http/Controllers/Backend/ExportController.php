<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use App\Helpers;
use App\Project;
use App\Contract;
use App\Country;
use App\WorkersCategory;
use App\Workday;
use App\User;
use App\Provider;
use App\ProjectProvider;
use App\FrameFunction;
use App\Client;
use App\ProyectCategory;
use App\RoleUser;
use App\Study;

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
        Helpers::getCapturError($e);
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
        Helpers::getCapturError($e);
      }
    }

    public function clients()
    {
      try {

        $results = Client::select( 'id_tango',
                                    'razon_social',
                                    'nick',
                                    'cuit',
                                    'address as direccion',
                                    'address_number as direccion_numero',
                                    'piso_depto as direccion_piso_depto',
                                    'id_country as pais',
                                    'location as localidad',
                                    'cp as codigo_postal',
                                    'telephone as telefono',
                                    'other_telephone as otro_telefono',
                                    'active as activo',
                                    'retencion_ganancia as retiene_ganancia',
                                    'iibb as retiene_iibb',
                                    'iva as retiene_iva',
                                    'contact_name as contacto_de_empresa_nombre',
                                    'contact_email as contacto_de_empresa_email',
                                    'contact_telephone as contacto_de_empresa_telefono'
                                    )->get();

        foreach ($results as &$result) {
          $result->pais = Country::getName($result->pais);
          $result->activo = Helpers::getActive($result->activo);
          $result->retiene_ganancia = Helpers::getActive($result->retiene_ganancia);
          $result->retiene_iibb = Helpers::getActive($result->retiene_iibb);
          $result->retiene_iva = Helpers::getActive($result->retiene_iva);
        }

        $timestamp = date('Y_m_d_h_i_s');

        Excel::create("clients_{$timestamp}", function($excel) use ($results){

          $excel->sheet('Clientes', function($sheet) use ($results){
            $sheet->fromArray($results);
          });

        })->download();

      } catch(\Exception $e){
        Helpers::getCapturError($e);
      }
    }

    public function workersCategories()
    {
      try {

        $results = WorkersCategory::select( 'number_category as numero_categoria',
                                    'name as nombre',
                                    'sueldo_basico',
                                    'sueldo_adicional',
                                    'presentismo',
                                    'sueldo_bruto',
                                    'sueldo_bruto_texto',
                                    'categoria_afip',
                                    'active as activo'
                                    )->get();

        foreach ($results as &$result) {
          $result->activo = Helpers::getActive($result->activo);
        }

        $timestamp = date('Y_m_d_h_i_s');

        Excel::create("categorias_sat_{$timestamp}", function($excel) use ($results){

          $excel->sheet('Categorias Sat', function($sheet) use ($results){
            $sheet->fromArray($results);
          });

        })->download();

      } catch(\Exception $e){
        Helpers::getCapturError($e);
      }
    }

    public function frameFunctions()
    {
      try {

        $results = FrameFunction::select(
                                    'name as nombre',
                                    'description as descripcion',
                                    'id_proyect_category as tipo_proyecto',
                                    'color',
                                    'active as activo'
                                    )->get();

        foreach ($results as &$result) {
          $result->activo = Helpers::getActive($result->activo);
          $result->tipo_proyecto = ProyectCategory::getName($result->tipo_proyecto);
        }

        $timestamp = date('Y_m_d_h_i_s');
        Excel::create("funciones_frame{$timestamp}", function($excel) use ($results){

          $excel->sheet('Funciones segun Frame', function($sheet) use ($results){
            $sheet->fromArray($results);
          });

        })->download();

      } catch(\Exception $e){
        Helpers::getCapturError($e);
      }
    }

    public function frameFunctionsByWorkersCategories()
    {
      try {

        $results = FrameFunction::select(
                                    'name',
                                    'id_proyect_category',
                                    'id_workers_category'
                                    )->get();

        $timestamp = date('Y_m_d_h_i_s');
        Excel::create("funciones_frame_relacion_categoria_sat{$timestamp}", function($excel) use ($results){

          foreach ($results as $result) {
            $type = ProyectCategory::getName($result->id_proyect_category);
            $nameSheet = "$result->name - $type";

            $categories = array();
            foreach (json_decode($result->id_workers_category) as $val) {
              $categories[] = array("nombre_categoria" => WorkersCategory::getName($val, false),
                                    "numero_categoria" => WorkersCategory::getNumber($val));
            }

            $excel->sheet($nameSheet, function($sheet) use ($categories){
              $sheet->fromArray($categories);
            });
          }

        })->download();

      } catch(\Exception $e){
        Helpers::getCapturError($e);
      }
    }

    public function getUsers()
    {
      return view('backend.export.users.index');
    }

    public function postUsers(Request $request)
    {
      try {
        $timestamp = date('Y_m_d_h_i_s');

        if($request->get('is_crew')){
          $results = User::select('users.name as nombre',
                                  'users.last_name as apellido',
                                  'users.email',
                                  'users.gender as genero',
                                  'users.type_dni as tipo_dni',
                                  'users.dni',
                                  'users.cuit',
                                  'users.birthdate as fecha_cumpleanos',
                                  'users.civil_status as estado_civil',

                                  'providers.address as direccion',
                                  'providers.address_number as direccion_numero',
                                  'providers.piso_depto as direccion_piso_depto',

                                  'users.id_country as pais',

                                  'providers.location as localidad',
                                  'providers.cp as codigo_postal',
                                  'providers.location as localidad',
                                  'providers.nationality as nacionalidad',
                                  'providers.id_study as nivel_estudio',
                                  'providers.social_work as obrasocial_prepaga',
                                  'providers.social_work_code as info_obrasocial_prepaga',
                                  'providers.telephone as telefono',
                                  'providers.other_telephone as otro_telefono',
                                  'providers.id_function_frame as rol_desempenar_frame',
                                  'providers.referring as es_referente',
                                  'providers.cbu',
                                  'providers.bank as banco',
                                  'providers.type_account as tipo_cuenta',
                                  'providers.number_account as numero_cuenta',
                                  'providers.alias_account as alias',

                                  'users.active as activo'
                                )
                                ->join('providers', 'users.id', '=', 'providers.id_user')
                                ->where('users.is_crew', '1')
                                ->get();

          foreach ($results as &$result) {
            $result->genero = Helpers::getGenderEs($result->genero);
            $result->fecha_cumpleanos = Helpers::getDateParseFormat($result->fecha_cumpleanos);
            $result->pais = Country::getName($result->pais);
            $result->activo = Helpers::getActive($result->activo);
            $result->rol_usuario = RoleUser::getRoleNameByUser($result->rol_usuario);

            $result->nacionalidad = Country::getNacionality($result->nacionalidad);
            $result->nivel_estudio = Study::getName($result->nivel_estudio);
            $result->obrasocial_prepaga = Helpers::getActive($result->obrasocial_prepaga);
            $result->es_referente = Helpers::getActive($result->es_referente);
            $result->banco = Helpers::getBank($result->banco);

            $rolDesemp = "";
            foreach (json_decode($result->rol_desempenar_frame) as $val) {
              $rolDesemp .= FrameFunction::getName($val).", ";
            }

            $result->rol_desempenar_frame = $rolDesemp;
          }

          $nameExcel = "teams";

        } else {
          $results = User::select('name as nombre',
                                  'last_name as apellido',
                                  'email',
                                  'type_dni as tipo_dni',
                                  'dni',
                                  'cuit',
                                  'gender as genero',
                                  'civil_status as estado_civil',
                                  'birthdate as fecha_cumpleanos',
                                  'id_country as pais',
                                  'id as rol_usuario',
                                  'active as activo'
                                )
                                ->where('is_crew', '0')
                                ->get();

          foreach ($results as &$result) {
            $result->genero = Helpers::getGenderEs($result->genero);
            $result->fecha_cumpleanos = Helpers::getDateParseFormat($result->fecha_cumpleanos);
            $result->pais = Country::getName($result->pais);
            $result->activo = Helpers::getActive($result->activo);
            $result->rol_usuario = RoleUser::getRoleNameByUser($result->rol_usuario);
          }

          $nameExcel = "usuarios";
        }

        Excel::create($nameExcel."_".$timestamp, function($excel) use ($results, $nameExcel){

          $excel->sheet($nameExcel, function($sheet) use ($results){
            $sheet->fromArray($results);
          });

        })->download();


      } catch(\Exception $e){
        Helpers::getCapturError($e);
      }
    }

    public function project($id_project)
    {
      try {
        $results = Project::select(
                              'id_client as cliente',
                              'name as nombre',
                              'description as descripcion',
                              'observations as observacion',
                              'cost_center as centro_costo',
                              'id_proyect_category as tipo_proyecto',
                              'id_team_referring as referente',
                              'start_date as fecha_inicio',
                              'finish_date as fecha_finalizacion',
                              'active as activo'
                            )
                            ->where('id', $id_project)
                            ->get()
                            ->toArray();

        foreach ($results as &$result) {
          $result['cliente'] = Client::getNick($result['cliente']);
          $result['tipo_proyecto'] = ProyectCategory::getName($result['tipo_proyecto']);
          $result['referente'] = Project::getReferring($result['referente']);
          $result['fecha_inicio'] = Helpers::getDateParseFormat($result['fecha_inicio']);
          $result['fecha_finalizacion'] = Helpers::getDateParseFormat($result['fecha_finalizacion']);
          $result['activo'] = Helpers::getActive($result['activo']);
        }

        $listTeams = ProjectProvider::select(
                                            'id_provider as nombre_team',
                                            'id_function_frame as funcion_frame',
                                            'id_category_sat as categoria_sat',
                                            'id_contract as tipo_contrato',
                                            'id_workday as modalidad',
                                            'salary_workdays as sueldo_jornada',
                                            'total_workdays as sueldo_mano',
                                            'total_workdays_text as sueldo_mano_texto',
                                            'salary_contract_category_function as sueldo_contrato_mensual',
                                            'salary_daily as sueldo_diario_sat',
                                            'salary_liquidate as sueldo_liquidar',
                                            'salaty_difference as sueldo_diferencia',
                                            'start_date_contract as fecha_alta_contrato',
                                            'finish_date_contract as fecha_baja_contrato',
                                            'count_workdays_crew as cant_jornadas_laborables',
                                            'hour_initial as hora_inicio',
                                            'hour_end as hora_final',
                                            'start_afip as fecha_alta_afip',
                                            'finish_afip as fecha_baja_afip',
                                            'is_reemplazo as puesto',
                                            'id_crew_reemplazo as reemplazo_del_team',
                                            'active as activo')
                                          ->where('id_project', $id_project)
                                          ->get();

        foreach ($listTeams as &$team) {
          $team->nombre_team = Provider::getNameOrderLastName($team->nombre_team);
          $team->funcion_frame = FrameFunction::getName($team->funcion_frame);
          $team->categoria_sat = WorkersCategory::getName($team->categoria_sat);
          $team->tipo_contrato = Contract::getName($team->tipo_contrato);
          $team->modalidad = Workday::getName($team->modalidad);
          $team->fecha_alta_contrato = Helpers::getDateParseFormat($team->fecha_alta_contrato);
          $team->fecha_baja_contrato = Helpers::getDateParseFormat($team->fecha_baja_contrato);
          $team->fecha_alta_afip = Helpers::getDateParseFormat($team->fecha_alta_afip);
          $team->fecha_baja_afip = Helpers::getDateParseFormat($team->fecha_baja_afip);
          $team->puesto = ProjectProvider::getPuesto($team->puesto);
          $team->reemplazo_del_team = ($team->reemplazo_del_team ? Provider::getNameOrderLastName($team->reemplazo_del_team) : '-');
          $team->activo = Helpers::getActive($team->activo);
        }

        $timestamp = date('Y_m_d_h_i_s');
        Excel::create("proyecto_".$timestamp, function($excel) use ($results, $listTeams){

          $excel->sheet($results[0]['nombre'], function($sheet) use ($results){
            $sheet->fromArray($results);
          });

          $excel->sheet('Lista de Teams', function($sheet) use ($listTeams){
            $sheet->fromArray($listTeams);
          });

        })->download();

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

}
