<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
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
use App\CenterCost;
use App\Report;
use App\Holiday;
use App\ExtraHours;
use DateTime;

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
        $timestamp = date('mdhis');
        $nameProject = Project::getCenterCost($projectProvider->id_project);
        $lastName = User::getLastName($provider->id_user);

        switch (Contract::getName($projectProvider->id_contract))
        {
          case "Eventual":
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractEventual( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $provider->cp, $user->dni, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat, false), WorkersCategory::getSueldoBrutoTexto($projectProvider->id_category_sat), WorkersCategory::getSueldoBruto($projectProvider->id_category_sat), Project::getName($projectProvider->id_project), $user->email ));
            break;

          case "Plazo Fijo":
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractPlazoFijo( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $provider->cp, $user->dni, $user->cuit, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), Helpers::getDateParseFormat($projectProvider->finish_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat, false), WorkersCategory::getSueldoBrutoTexto($projectProvider->id_category_sat), WorkersCategory::getSueldoBruto($projectProvider->id_category_sat), Project::getName($projectProvider->id_project), $user->email, Project::getCenterCost($projectProvider->id_project) ));
            break;

          case "Servicios":
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractServicio( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $provider->cp, $user->dni, Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), Helpers::getDateParseFormat($projectProvider->finish_date_contract, '/'), WorkersCategory::getName($projectProvider->id_category_sat, false), $projectProvider->total_workdays_text, "$".$projectProvider->total_workdays, Project::getName($projectProvider->id_project), $user->email ));
            break;

          case "Tiempo Indeterminado":
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getContractTiempoIndeterminado( Provider::getNameOrderLastName($projectProvider->id_provider), Provider::getAddressFull($projectProvider->id_provider), $provider->location, $provider->cp, $user->dni, $user->cuit, WorkersCategory::getName($projectProvider->id_category_sat, false), WorkersCategory::getSueldoBrutoTexto($projectProvider->id_category_sat), WorkersCategory::getSueldoBruto($projectProvider->id_category_sat), $user->email ));
            break;

          default;
            return back();
          break;
        }

        $name_contract_doc = "{$nameProject}_{$lastName}_contrato_{$timestamp}.docx";

        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        Storage::disk('public')->makeDirectory("contract/".$id_project_provider);
        $name_file = 'app/public/contract/'.$id_project_provider.'/'.$name_contract_doc;
        $objectWriter->save(storage_path($name_file));

        return response()->download(storage_path($name_file));

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    /*
      export release by Single Team to Project
    */
    public function crewRelease($id_project_provider){
      try {
        $projectProvider = ProjectProvider::find($id_project_provider);
        $provider = Provider::find($projectProvider->id_provider);
        $user = User::find($provider->id_user);

        // create new docx
        $word = new \PhpOffice\PhpWord\PhpWord();
        $section = $word->addSection();

        \PhpOffice\PhpWord\Shared\Html::addHtml($section, Contract::getRelease( Provider::getNameOrderLastName($projectProvider->id_provider), Helpers::getDateParseFormat($user->birthdate, '/'), Project::getName($projectProvider->id_project), WorkersCategory::getName($projectProvider->id_category_sat, false), Helpers::getDateParseFormat($projectProvider->start_date_contract, '/'), Contract::getName($projectProvider->id_contract) ));

        $timestamp = date('mdhis');
        $nameProject = Project::getCenterCost($projectProvider->id_project);
        $lastName = User::getLastName($provider->id_user);

        $name_release_doc = "{$nameProject}_{$lastName}_release_{$timestamp}.docx";

        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        Storage::disk('public')->makeDirectory("release/".$id_project_provider);
        $name_file = 'app/public/release/'.$id_project_provider.'/'.$name_release_doc;
        $objectWriter->save(storage_path($name_file));

        return response()->download(storage_path($name_file));

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function callSheet($id_project)
    {
      try{
        $listTeam = ProjectProvider::where('id_project', $id_project)
                                  ->where('active', '1')
                                  ->get();
        $results = array();

        foreach($listTeam as $team)
        {
            $other_phone = (\App\Provider::getOtherTelephone($team->id_provider) != '' ? ' - '.\App\Provider::getOtherTelephone($team->id_provider) : '');

            array_push($results, [
              //'categoria_sat' => WorkersCategory::getName($team->id_category_sat),
              'rol_desempenar' => FrameFunction::getName($team->id_function_frame),
              'nombre_team' => Provider::getNameOrderLastName($team->id_provider),
              'telefono' => Provider::getTelephone($team->id_provider).$other_phone,
              'email' => Provider::getEmail($team->id_provider)
            ]);
        }

        $timestamp = date('Ymdhis');
        $nameProject = Project::getCenterCost($id_project);

        Excel::create(Helpers::setLimitString("callshet_{$nameProject}_{$timestamp}", 27), function($excel) use ($results){

          $excel->sheet("Lista de Contactos", function($sheet) use ($results){
            $sheet->fromArray(json_decode( json_encode($results), true));
          });

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

        if(count($results)) {

          foreach ($results as &$result) {
            $result->pais = Country::getName($result->pais);
            $result->activo = Helpers::getActive($result->activo);
            $result->retiene_ganancia = Helpers::getActive($result->retiene_ganancia);
            $result->retiene_iibb = Helpers::getActive($result->retiene_iibb);
            $result->retiene_iva = Helpers::getActive($result->retiene_iva);
          }

          $timestamp = date('Ymdhis');

          Excel::create(Helpers::setLimitString("clients_{$timestamp}", 27), function($excel) use ($results){

            $excel->sheet('Clientes', function($sheet) use ($results){
              $sheet->fromArray($results);
            });

          })->download();

        } else {
          return back()->with('message', 'El Listado de Clientes se encuentra vacio!');
        }

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

        if(count($results)) {

          foreach ($results as &$result) {
            $result->activo = Helpers::getActive($result->activo);
          }

          $timestamp = date('Ymdhis');

          Excel::create(Helpers::setLimitString("categorias_sat_{$timestamp}", 27), function($excel) use ($results){

            $excel->sheet('Categorias Sat', function($sheet) use ($results){
              $sheet->fromArray($results);
            });

          })->download();

        } else {
          return back()->with('message', 'El Listado de las Categorias SAT se encuentra vacio!');
        }

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

        if(count($results)) {

          foreach ($results as &$result) {
            $result->activo = Helpers::getActive($result->activo);
            $result->tipo_proyecto = ProyectCategory::getName($result->tipo_proyecto);
          }

          $timestamp = date('Ymdhis');
          Excel::create(Helpers::setLimitString("funciones_frame_{$timestamp}", 27), function($excel) use ($results){

            $excel->sheet('Funciones segun Frame', function($sheet) use ($results){
              $sheet->fromArray($results);
            });

          })->download();

        } else {
          return back()->with('message', 'El Listado de las Funciones Frame se encuentra vacio!');
        }

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
        if(count($results)){

          $timestamp = date('Ymdhis');
          Excel::create(Helpers::setLimitString("funciones_frame_relacion_categoria_sat_{$timestamp}", 27), function($excel) use ($results){

            foreach ($results as $result) {
              $type = ProyectCategory::getName($result->id_proyect_category);
              $nameSheet = "$result->name - $type";

              $categories = array();
              foreach (json_decode($result->id_workers_category) as $val) {
                $categories[] = array("nombre_categoria" => WorkersCategory::getName($val, false),
                                      "numero_categoria" => WorkersCategory::getNumber($val));
              }

              $excel->sheet(Helpers::setLimitString($nameSheet, 27), function($sheet) use ($categories){
                $sheet->fromArray($categories);
              });
            }

          })->download();

        } else {
          return back()->with('message', 'El Listado de las Funciones Frame se encuentra vacio!');
        }

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
        $timestamp = date('Ymdhis');

        if($request->get('is_crew')){
          $results = User::select('users.name as nombre',
                                  'users.last_name as apellido',
                                  'users.email',
                                  'users.gender as genero',
                                  'users.type_dni as tipo_dni',
                                  'users.dni',
                                  'users.cuit',
                                  'users.birthdate as fecha_nacimiento',
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

                                  'users.id as rol_usuario',
                                  'users.active as activo'
                                )
                                ->join('providers', 'users.id', '=', 'providers.id_user')
                                ->where('users.is_crew', '1')
                                ->get();

          foreach ($results as &$result) {
            $result->genero = Helpers::getGenderEs($result->genero);
            $result->fecha_nacimiento = Helpers::getDateParseFormat($result->fecha_nacimiento);
            $result->pais = Country::getName($result->pais);

            $result->rol_usuario = RoleUser::getRoleNameByUser($result->rol_usuario);
            $result->activo = Helpers::getActive($result->activo);

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
                                  'birthdate as fecha_nacimiento',
                                  'id_country as pais',
                                  'id as rol_usuario',
                                  'active as activo'
                                )
                                ->where('is_crew', '0')
                                ->get();

          foreach ($results as &$result) {
            $result->genero = Helpers::getGenderEs($result->genero);
            $result->fecha_nacimiento = Helpers::getDateParseFormat($result->fecha_nacimiento);
            $result->pais = Country::getName($result->pais);
            $result->activo = Helpers::getActive($result->activo);
            $result->rol_usuario = RoleUser::getRoleNameByUser($result->rol_usuario);
          }

          $nameExcel = "usuarios";
        }

        Excel::create(Helpers::setLimitString($nameExcel."_".$timestamp, 27), function($excel) use ($results, $nameExcel){

          $excel->sheet(Helpers::setLimitString($nameExcel, 27), function($sheet) use ($results){
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
                              'id as cliente',
                              'name as nombre',
                              'description as descripcion',
                              'observations as observacion',
                              'cost_center as centro_costo',
                              'id_proyect_category as tipo_proyecto',
                              // 'id_team_referring as referente',
                              'start_date as fecha_inicio',
                              'finish_date as fecha_finalizacion',
                              'is_closed as estado',
                              'active as activo'
                            )
                            ->where('id', $id_project)
                            ->get()
                            ->toArray();

        foreach ($results as &$result) {
          $result['cliente'] = Client::getNick(CenterCost::getIdClient($result['centro_costo']));
          $result['centro_costo'] = CenterCost::getNumber($result['centro_costo']);
          $result['tipo_proyecto'] = ProyectCategory::getName($result['tipo_proyecto']);
          // $result['referente'] = Project::getReferring($result['referente']);
          $result['fecha_inicio'] = Helpers::getDateParseFormat($result['fecha_inicio']);
          $result['fecha_finalizacion'] = Helpers::getDateParseFormat($result['fecha_finalizacion']);
          $result['estado'] = Project::getIsClosed($result['estado']);
          $result['activo'] = Helpers::getActive($result['activo']);
        }

        $listTeams = ProjectProvider::select(

          'users.last_name as apellido',
          'users.name as nombre',
          'project_providers.id_project as n_proyecto',
          'project_providers.id_project as nombre_proyecto',
          'project_providers.id_function_frame as funcion_frame',
          'project_providers.id_category_sat as categoria_sat',
          'project_providers.id_contract as tipo_contrato',
          'project_providers.id_workday as modalidad',
          'project_providers.count_workdays_crew as cant_jornadas_laborables',
          'project_providers.salary_workdays as sueldo_jornada',
          'project_providers.total_workdays as sueldo_mano',
          'project_providers.total_workdays_text as sueldo_mano_texto',
          'project_providers.salary_contract_category_function as sueldo_contrato_mensual',
          'project_providers.salary_daily as sueldo_diario_sat',
          'project_providers.salary_liquidate as sueldo_liquidar',
          'project_providers.salaty_difference as sueldo_diferencia',
          'project_providers.created_at as fecha_de_declaracion',
          'project_providers.start_date_contract as fecha_alta_contrato',
          'project_providers.finish_date_contract as fecha_baja_contrato',
          'project_providers.start_afip as fecha_alta_afip',
          'project_providers.finish_afip as fecha_baja_afip',
          'project_providers.is_reemplazo as puesto',
          'project_providers.id_crew_reemplazo as reemplazo_del_team',
          'project_providers.hour_initial as hora_inicio',
          'project_providers.hour_end as hora_final',
          'project_providers.hour_initial as horas_pactadas',
          'project_providers.extra_hours as horas_extras',
          'project_providers.active as activo',
          'users.email',
          'users.gender as genero',
          'users.type_dni as tipo_dni',
          'users.dni',
          'users.cuit',
          'users.birthdate as fecha_nacimiento',
          'users.civil_status as estado_civil',
          'providers.address as direccion',
          'providers.address_number as direccion_numero',
          'providers.piso_depto as direccion_piso_depto',
          'users.id_country as pais',
          'providers.location as localidad',
          'providers.cp as codigo_postal',
          'providers.nationality as nacionalidad',
          'providers.id_study as nivel_estudio',
          'providers.social_work as obrasocial_prepaga',
          'providers.social_work_code as info_obrasocial_prepaga',
          'providers.telephone as telefono',
          'providers.other_telephone as otro_telefono',
          'providers.referring as es_referente',
          'providers.cbu',
          'providers.bank as banco',
          'providers.type_account as tipo_cuenta',
          'providers.number_account as numero_cuenta',
          'providers.alias_account as alias'
          )

        ->join('providers', 'project_providers.id_provider', '=', 'providers.id')
        ->join('users', 'providers.id_user', '=', 'users.id')
        ->where('project_providers.id_project', $id_project)
        ->orderBy('project_providers.created_at', 'ASC')
        ->get();

      foreach ($listTeams as &$team) {

        $team->n_proyecto = Project::getCenterCost($team->n_proyecto);
        $team->nombre_proyecto = Project::getName($team->nombre_proyecto);

        $team->genero = Helpers::getGenderEs($team->genero);
        $team->fecha_nacimiento = Helpers::getDateParseFormat($team->fecha_nacimiento);
        $team->pais = Country::getName($team->pais);
        $team->nacionalidad = Country::getNacionality($team->nacionalidad);
        $team->nivel_estudio = Study::getName($team->nivel_estudio);
        $team->obrasocial_prepaga = Helpers::getActive($team->obrasocial_prepaga);
        $team->es_referente = Helpers::getActive($team->es_referente);
        $team->banco = Helpers::getBank($team->banco);

        $team->horas_pactadas = ProjectProvider::getHoursExtras($team->hora_inicio,$team->hora_final);

        $team->funcion_frame = FrameFunction::getName($team->funcion_frame);
        $team->categoria_sat = WorkersCategory::getName($team->categoria_sat);
        $team->tipo_contrato = Contract::getName($team->tipo_contrato);
        $team->modalidad = Workday::getName($team->modalidad);
        $team->fecha_de_declaracion = Helpers::getDateParseFormat($team->fecha_de_declaracion);
        $team->fecha_alta_contrato = Helpers::getDateParseFormat($team->fecha_alta_contrato);
        $team->fecha_baja_contrato = Helpers::getDateParseFormat($team->fecha_baja_contrato);
        $team->fecha_alta_afip =  ($team->fecha_alta_afip != null && $team->fecha_alta_afip != '' ? Helpers::getDateParseFormat($team->fecha_alta_afip) : '');
        $team->fecha_baja_afip =  ($team->fecha_baja_afip != null && $team->fecha_baja_afip != '' ? Helpers::getDateParseFormat($team->fecha_baja_afip) : '');
        $team->puesto = ProjectProvider::getStringPuesto($team->puesto);
        $team->reemplazo_del_team = ($team->reemplazo_del_team ? Provider::getNameOrderLastName($team->reemplazo_del_team) : '-');
        $team->activo = Helpers::getActive($team->activo);


        $countHsExtra = 0;
        if(!empty(json_decode($team->horas_extras))){
          foreach (json_decode($team->horas_extras) as $e) {
            $hs_extra_initial = substr($e->start, 0, strpos($e->start, '('));
            $hs_extra_initial_date = new DateTime($hs_extra_initial);

            $hs_extra_finish = substr($e->finish, 0, strpos($e->finish, '('));
            $hs_extra_finish_date = new DateTime($hs_extra_finish);

            $horasTrabajadas = ProjectProvider::getHoursExtrasExport($hs_extra_initial_date, $hs_extra_finish_date);

            if($e->agreed_hours == 0){
              $countHsExtra += $horasTrabajadas;
            } else {
              $countHsExtra += ($horasTrabajadas - $team->horas_pactadas);
            }

          }
        }

        $team->horas_extras = $countHsExtra;
      }

        $timestamp = date('Ymdhis');
        $nameProject = Project::getCenterCost($id_project);

        Excel::create(Helpers::setLimitString("{$nameProject}_info_".$timestamp, 27), function($excel) use ($results, $listTeams){

          $excel->sheet(Helpers::setLimitString($results[0]['centro_costo'], 27), function($sheet) use ($results){
            $sheet->fromArray($results);
          });

          $excel->sheet('Lista de Teams', function($sheet) use ($listTeams){
            $sheet->fromArray($listTeams);
          });

          $groupDateResults = array();

          foreach($listTeams as $key => $value){
            $groupDateResults[$value['fecha_de_declaracion']][$key] = $value;
          }

          foreach($groupDateResults as $k => $v){
            $excel->sheet($k, function($sheet) use ($v){
              $sheet->fromArray(json_decode(json_encode($v), true));
            });
          }

        })->download();

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function horasExtrasAndAbsencesTeams($id_project)
    {
      try {
        $generateExportHsExAbsences = Report::exportExtraHours($id_project);

        if($generateExportHsExAbsences) {
          return $generateExportHsExAbsences;
        } else {
          return back()->with("message", "No se encontraron Horas Extras y/o Ausencias para los Teams del Proyecto Seleccionado.");
        }
      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function horasExtrasAusenciasTeams($id_project)
    {
      try {
        $generateExportHsEs = Report::exportExtraHoursAbsences($id_project);

        if($generateExportHsEs) {
          return $generateExportHsEs;
        } else {
          return back()->with("message", "No se encontraron Ausencias ni Horas Extras para los Teams del Proyecto Seleccionado.");
        }
      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function horasExtrasTeams($id_project)
    {
      try {
        $generateExportHsEs = Report::exportExtraHours($id_project);

        if($generateExportHsEs) {
          return $generateExportHsEs;
        } else {
          return back()->with("message", "No se encontraron Horas Extras para los Teams del Proyecto Seleccionado.");
        }
      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function absencesTeams($id_project)
    {
      try {
        $generateExportAbsencesTeams = Report::exportAbsences($id_project);

        if($generateExportAbsencesTeams){
          return $generateExportAbsencesTeams;
        } else {
          return back()->with("message", "No se encontraron Ausencias para los Teams del Proyecto Seleccionado.");
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function seguroServicios($id_project)
    {
      // listado de teams, que hayan aceptado,
      try {

        $nameProject = Project::find($id_project);
        $results = ProjectProvider::select(
                                    'users.active as N°', // no se usa el field active, sino que tengo que hacer mencion a un campo para manipuilarlo como count
                                    'users.id as Nombre_Apellido',
                                    'users.dni as DNI_N',
                                    'users.birthdate as Fecha_Nac',

                                    'project_providers.id_category_sat as Actividad_Declarada',
                                    'project_providers.created_at as Fecha_de_Declaracion',
                                    'project_providers.start_date_secure_contract as Vigencia_Desde',
                                    'project_providers.end_date_secure_contract as Vigencia_Hasta',

                                    'project_providers.start_date_contract as start_contract',
                                    'project_providers.finish_date_contract as end_contract',

                                    'project_providers.count_workdays_crew as Cantidad_de_Dias',
                                    'project_providers.salary_daily as Referencia_Prima_Diaria'
                                    )
                                    ->join('providers', 'project_providers.id_provider', '=', 'providers.id')
                                    ->join('users', 'providers.id_user', '=', 'users.id')
                                    ->where('project_providers.id_project', $id_project)
                                    ->where('project_providers.id_contract', '4') // 4 = Servicios
                                    ->where('project_providers.active', '1')
                                    ->orderBy('project_providers.created_at', 'ASC')
                                    ->get();

        if(count($results))
        {
          $count = 1;
          foreach ($results as &$team)
          {
            $vigenciaFrom = ($team->Vigencia_Desde ? $team->Vigencia_Desde : $team->start_contract);
            $vigenciaTo = ($team->Vigencia_Hasta ? $team->Vigencia_Hasta : $team->end_contract);

            $fechaEmision = Carbon::parse($vigenciaFrom);
            $fechaExpiracion = Carbon::parse($vigenciaTo);

            $team->N° = $count;
            $team->Nombre_Apellido = User::getFullName($team->Nombre_Apellido);
            $team->Fecha_Nac = Helpers::getDateParseFormat($team->Fecha_Nac);
            $team->Actividad_Declarada = WorkersCategory::getName($team->Actividad_Declarada, false);
            $team->Fecha_de_Declaracion = Helpers::getDateParseFormat($team->Fecha_de_Declaracion);
            $team->Vigencia_Desde = Helpers::getDateParseFormat($vigenciaFrom);
            $team->Vigencia_Hasta = Helpers::getDateParseFormat($vigenciaTo);
            $team->Cantidad_de_Dias = $fechaExpiracion->diffInDays($fechaEmision);
            $team->Referencia_Prima_Diaria = '';
            $team->Costo_por_dia_sin_IVA = '';
            $team->Costo_por_dia_con_IVA = '';
            $team->Movimiento = 'Alta';

            unset($team->start_contract);
            unset($team->end_contract);

            $count++;
          }

          $getCenterCoste = Project::getCenterCost($id_project);
          $timestamp = date('Ymdhis');

          Excel::create(Helpers::setLimitString("{$getCenterCoste}_seguro_".$timestamp, 27), function($excel) use ($nameProject, $results){

            $excel->sheet(Helpers::setLimitString(CenterCost::getNumber($nameProject->cost_center), 27), function($sheet) use ($nameProject, $results){

              $sheet->setStyle(array(
                'font' => array(
                  'name' => 'Arial',
                  'size' => 10,
                  'bold' => false
                )
              ));

              $sheet->setBorder('B6:N50', 'thin');

              $sheet->setWidth(array(
                'A'     =>  15,
                'B'     =>  35,
                'C'     =>  25,
                'D'     =>  25,
                'E'     =>  25,
                'F'     =>  25,
                'G'     =>  25,
                'H'     =>  25,
                'I'     =>  25,
                'J'     =>  25,
                'K'     =>  25,
                'L'     =>  25,
                'M'     =>  25,
                'N'     =>  25
              ));

              $sheet->cell('B1', function($cell) {
                $cell->setValue('Nº de Centro de Costo');
                $cell->setBorder('thin','thin', 'thin', 'thin');
              });
              $sheet->cell('B2', function($cell) {
                $cell->setValue('Proyecto');
                $cell->setBorder('thin','thin', 'thin', 'thin');
              });
              $sheet->cell('B3', function($cell) {
                $cell->setValue('Cláusula de No Repetición');
                $cell->setBorder('thin','thin', 'thin', 'thin');
              });
              $sheet->cell('B4', function($cell) {
                $cell->setValue('Necesidad de Certificado de Cobertura');
                $cell->setBorder('thin','thin', 'thin', 'thin');
              });

              $sheet->cell('C1', function($cell) use ($nameProject) {
                $cell->setValue(CenterCost::getNumber($nameProject->cost_center));
                $cell->setBorder('thin','thin', 'thin', 'thin');
              });
              $sheet->cell('C2', function($cell) use ($nameProject) {
                $cell->setValue($nameProject->name);
                $cell->setBorder('thin','thin', 'thin', 'thin');
              });
              $sheet->cell('C3', function($cell) use ($nameProject) {
                $cell->setValue(Helpers::getActive($nameProject->clausula_no_repe));
                $cell->setBorder('thin','thin', 'thin', 'thin');
              });
              $sheet->cell('C4', function($cell) use ($nameProject) {
                $cell->setValue(Helpers::getActive($nameProject->certificado_cobertura));
                $cell->setBorder('thin','thin', 'thin', 'thin');
              });

              $sheet->cells('B6:B50', function ($cells) {
                $cells->setFontWeight('bold');
              });

              $sheet->cells('B6:N6', function ($cells) {
                $cells->setFontWeight('bold');
              });

              $sheet->cells('B6:N50', function ($cells) {
                $cells->setBorder('thin','thin', 'thin', 'thin');
              });

              $sheet->cells('C6:J50', function ($cells) {
                $cells->setBackground('#FFFF99');
                $cells->setFontSize(9);
              });

              $sheet->cells('N6:N50', function ($cells) {
                $cells->setBackground('#FFFF99');
                $cells->setFontSize(9);
              });

              $sheet->cells('N7:N50', function ($cells) {
                $cells->setFontColor('#339966');
              });

              $sheet->cells('K6:M50', function ($cells) {
                $cells->setBackground('#FFFFFF');
                $cells->setFontSize(9);
              });

              $sheet->cells('B6:B50', function($cells) {
                $cells->setAlignment('center');
              });

              $sheet->fromArray($results, null, 'B6', true, true);


              if($nameProject->clausula_no_repe){
                $sheet->cell('B52', function($cell) {
                  $cell->setValue('Cliente/Empresa');
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });

                $sheet->cell('C52', function($cell) {
                  $cell->setValue('Razon Social');
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });

                $sheet->cell('D52', function($cell) {
                  $cell->setValue('Cuit');
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });

                $idClient = CenterCost::getIdClientClient($nameProject->cost_center);

                $sheet->cell('C53', function($cell) use ($idClient){
                  $cell->setValue(Client::getRazonSocial($idClient));
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });

                $sheet->cell('D53', function($cell) use ($idClient){
                  $cell->setValue(Client::getCuit($idClient));
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });
              }

            });

            $groupDateResults = array();

            foreach($results as $key => $value){
              $groupDateResults[$value['Fecha_de_Declaracion']][$key] = $value;
            }

            foreach($groupDateResults as $k => $v){

              $excel->sheet($k, function($sheet) use ($nameProject, $v){

                $sheet->setStyle(array(
                  'font' => array(
                    'name' => 'Arial',
                    'size' => 10,
                    'bold' => false
                  )
                ));

                $sheet->setBorder('B6:N50', 'thin');

                $sheet->setWidth(array(
                  'A'     =>  15,
                  'B'     =>  35,
                  'C'     =>  25,
                  'D'     =>  25,
                  'E'     =>  25,
                  'F'     =>  25,
                  'G'     =>  25,
                  'H'     =>  25,
                  'I'     =>  25,
                  'J'     =>  25,
                  'K'     =>  25,
                  'L'     =>  25,
                  'M'     =>  25,
                  'N'     =>  25
                ));

                $sheet->cell('B1', function($cell) {
                  $cell->setValue('Nº de Centro de Costo');
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });
                $sheet->cell('B2', function($cell) {
                  $cell->setValue('Proyecto');
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });
                $sheet->cell('B3', function($cell) {
                  $cell->setValue('Cláusula de No Repetición');
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });
                $sheet->cell('B4', function($cell) {
                  $cell->setValue('Necesidad de Certificado de Cobertura');
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });

                $sheet->cell('C1', function($cell) use ($nameProject) {
                  $cell->setValue(CenterCost::getNumber($nameProject->cost_center));
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });
                $sheet->cell('C2', function($cell) use ($nameProject) {
                  $cell->setValue($nameProject->name);
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });
                $sheet->cell('C3', function($cell) use ($nameProject) {
                  $cell->setValue(Helpers::getActive($nameProject->clausula_no_repe));
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });
                $sheet->cell('C4', function($cell) use ($nameProject) {
                  $cell->setValue(Helpers::getActive($nameProject->certificado_cobertura));
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });

                $sheet->cells('B6:B50', function ($cells) {
                  $cells->setFontWeight('bold');
                });

                $sheet->cells('B6:N6', function ($cells) {
                  $cells->setFontWeight('bold');
                });

                $sheet->cells('B6:N50', function ($cells) {
                  $cells->setBorder('thin','thin', 'thin', 'thin');
                });

                $sheet->cells('C6:J50', function ($cells) {
                  $cells->setBackground('#FFFF99');
                  $cells->setFontSize(9);
                });

                $sheet->cells('N6:N50', function ($cells) {
                  $cells->setBackground('#FFFF99');
                  $cells->setFontSize(9);
                });

                $sheet->cells('N7:N50', function ($cells) {
                  $cells->setFontColor('#339966');
                });

                $sheet->cells('K6:M50', function ($cells) {
                  $cells->setBackground('#FFFFFF');
                  $cells->setFontSize(9);
                });

                $sheet->cells('B6:B50', function($cells) {
                  $cells->setAlignment('center');
                });

                $sheet->fromArray(json_decode(json_encode($v), true), null, 'B6', true, true);


                if($nameProject->clausula_no_repe){
                  $sheet->cell('B52', function($cell) {
                    $cell->setValue('Cliente/Empresa');
                    $cell->setBorder('thin','thin', 'thin', 'thin');
                  });

                  $sheet->cell('C52', function($cell) {
                    $cell->setValue('Razon Social');
                    $cell->setBorder('thin','thin', 'thin', 'thin');
                  });

                  $sheet->cell('D52', function($cell) {
                    $cell->setValue('Cuit');
                    $cell->setBorder('thin','thin', 'thin', 'thin');
                  });

                  $idClient = CenterCost::getIdClientClient($nameProject->cost_center);

                  $sheet->cell('C53', function($cell) use ($idClient){
                    $cell->setValue(Client::getRazonSocial($idClient));
                    $cell->setBorder('thin','thin', 'thin', 'thin');
                  });

                  $sheet->cell('D53', function($cell) use ($idClient){
                    $cell->setValue(Client::getCuit($idClient));
                    $cell->setBorder('thin','thin', 'thin', 'thin');
                  });
                }

              });
            }

          })->download();

        } else {
          return back()->with('message', 'El Listado de Generacion de Seguros se encuentra vacio!');
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function exportTeamHourExtras(Request $request)
    {
      try {
        $nameTeam         = $request->get('name_team');
        $list             = $request->get('hs_extras');
        $nameProject      = '';
        $lastName         = '';

        $teams = ProjectProvider::select(
          'users.last_name as apellido',
          'users.name as nombre',
          'project_providers.id_project as n_proyecto',
          'project_providers.id_project as nombre_proyecto',
          'project_providers.id_function_frame as funcion_frame',
          'project_providers.id_category_sat as categoria_sat',
          'project_providers.id_contract as tipo_contrato',
          'project_providers.id_workday as modalidad',
          'project_providers.count_workdays_crew as cant_jornadas_laborables',
          'project_providers.salary_workdays as sueldo_jornada',
          'project_providers.total_workdays as sueldo_mano',
          'project_providers.total_workdays_text as sueldo_mano_texto',
          'project_providers.salary_contract_category_function as sueldo_contrato_mensual',
          'project_providers.salary_daily as sueldo_diario_sat',
          'project_providers.salary_liquidate as sueldo_liquidar',
          'project_providers.salaty_difference as sueldo_diferencia',
          'project_providers.created_at as fecha_de_declaracion',
          'project_providers.start_date_contract as fecha_alta_contrato',
          'project_providers.finish_date_contract as fecha_baja_contrato',
          'project_providers.start_afip as fecha_alta_afip',
          'project_providers.finish_afip as fecha_baja_afip',
          'project_providers.is_reemplazo as puesto',
          'project_providers.id_crew_reemplazo as reemplazo_del_team',
          'project_providers.hour_initial as hora_inicio',
          'project_providers.hour_end as hora_final',
          'project_providers.hour_initial as horas_pactadas',
          'project_providers.extra_hours as horas_extras',
          'project_providers.active as activo',
          'users.email',
          'users.gender as genero',
          'users.type_dni as tipo_dni',
          'users.dni',
          'users.cuit',
          'users.birthdate as fecha_nacimiento',
          'users.civil_status as estado_civil',
          'providers.address as direccion',
          'providers.address_number as direccion_numero',
          'providers.piso_depto as direccion_piso_depto',
          'users.id_country as pais',
          'providers.location as localidad',
          'providers.cp as codigo_postal',
          'providers.nationality as nacionalidad',
          'providers.id_study as nivel_estudio',
          'providers.social_work as obrasocial_prepaga',
          'providers.social_work_code as info_obrasocial_prepaga',
          'providers.telephone as telefono',
          'providers.other_telephone as otro_telefono',
          'providers.referring as es_referente',
          'providers.cbu',
          'providers.bank as banco',
          'providers.type_account as tipo_cuenta',
          'providers.number_account as numero_cuenta',
          'providers.alias_account as alias'
        )
        ->join('providers', 'project_providers.id_provider', '=', 'providers.id')
        ->join('users', 'providers.id_user', '=', 'users.id')
        ->where('project_providers.extra_hours', '!=', null)
        ->where('project_providers.extra_hours', '!=', '[]')
        ->where('project_providers.id', $request->get('id_project_provider'))
        ->orderBy('project_providers.created_at', 'ASC')
        ->get();

        foreach($teams as &$team)
        {
          $team->n_proyecto = Project::getCenterCost($team->n_proyecto);
          $team->nombre_proyecto = Project::getName($team->nombre_proyecto);

          $team->genero = Helpers::getGenderEs($team->genero);
          $team->fecha_nacimiento = Helpers::getDateParseFormat($team->fecha_nacimiento);
          $team->pais = Country::getName($team->pais);
          $team->nacionalidad = Country::getNacionality($team->nacionalidad);
          $team->nivel_estudio = Study::getName($team->nivel_estudio);
          $team->obrasocial_prepaga = Helpers::getActive($team->obrasocial_prepaga);
          $team->es_referente = Helpers::getActive($team->es_referente);
          $team->banco = Helpers::getBank($team->banco);

          $team->horas_pactadas = ProjectProvider::getHoursExtras($team->hora_inicio,$team->hora_final);

          $team->funcion_frame = FrameFunction::getName($team->funcion_frame);
          $team->categoria_sat = WorkersCategory::getName($team->categoria_sat);
          $team->tipo_contrato = Contract::getName($team->tipo_contrato);
          $team->modalidad = Workday::getName($team->modalidad);
          $team->fecha_de_declaracion = Helpers::getDateParseFormat($team->fecha_de_declaracion);
          $team->fecha_alta_contrato = Helpers::getDateParseFormat($team->fecha_alta_contrato);
          $team->fecha_baja_contrato = Helpers::getDateParseFormat($team->fecha_baja_contrato);
          $team->fecha_alta_afip =  ($team->fecha_alta_afip != null && $team->fecha_alta_afip != '' ? Helpers::getDateParseFormat($team->fecha_alta_afip) : '');
          $team->fecha_baja_afip =  ($team->fecha_baja_afip != null && $team->fecha_baja_afip != '' ? Helpers::getDateParseFormat($team->fecha_baja_afip) : '');
          $team->puesto = ProjectProvider::getStringPuesto($team->puesto);
          $team->reemplazo_del_team = ($team->reemplazo_del_team ? Provider::getNameOrderLastName($team->reemplazo_del_team) : '-');
          $team->activo = Helpers::getActive($team->activo);

          $countHsExtra = 0;
          if(!empty(json_decode($team->horas_extras))){
            foreach (json_decode($team->horas_extras) as $e) {
              $hs_extra_initial = substr($e->start, 0, strpos($e->start, '('));
              $hs_extra_initial_date = new DateTime($hs_extra_initial);

              $hs_extra_finish = substr($e->finish, 0, strpos($e->finish, '('));
              $hs_extra_finish_date = new DateTime($hs_extra_finish);

              $horasTrabajadas = ProjectProvider::getHoursExtrasExport($hs_extra_initial_date, $hs_extra_finish_date);

              if($e->agreed_hours == 0){
                $countHsExtra += $horasTrabajadas;
              } else {
                $countHsExtra += ($horasTrabajadas - $team->horas_pactadas);
              }

            }
          }

          $team->horas_extras = $countHsExtra;

          $nameProject = $team->n_proyecto;
          $lastName = $team->apellido.' '.$team->nombre;
        }

        $timestamp = date('mdhis');

        Excel::create(Helpers::setLimitString("{$nameProject}_{$lastName}_hsextras_{$timestamp}", 27), function($excel) use ($teams, $nameTeam, $list)
        {
          $excel->sheet(Helpers::setLimitString($nameTeam, 27), function($sheet) use ($teams){
            $sheet->fromArray($teams);
          });

          $excel->sheet(Helpers::setLimitString("Horas Extras", 27), function($sheet) use ($list){
            $sheet->fromArray(json_decode($list, true));
          });

        })->download();

      } catch(\Exception $e){
        Helpers::getCapturError($e);
      }
    }

    public function exportTeamAbsences(Request $request)
    {
      try {
        $nameTeam     = $request->get('name_team');
        $list         = $request->get('absences');
        $nameProject  = '';
        $lastName   = '';

        $teams = ProjectProvider::select(
          'users.last_name as apellido',
          'users.name as nombre',
          'project_providers.id_project as n_proyecto',
          'project_providers.id_project as nombre_proyecto',
          'project_providers.id_function_frame as funcion_frame',
          'project_providers.id_category_sat as categoria_sat',
          'project_providers.id_contract as tipo_contrato',
          'project_providers.id_workday as modalidad',
          'project_providers.count_workdays_crew as cant_jornadas_laborables',
          'project_providers.salary_workdays as sueldo_jornada',
          'project_providers.total_workdays as sueldo_mano',
          'project_providers.total_workdays_text as sueldo_mano_texto',
          'project_providers.salary_contract_category_function as sueldo_contrato_mensual',
          'project_providers.salary_daily as sueldo_diario_sat',
          'project_providers.salary_liquidate as sueldo_liquidar',
          'project_providers.salaty_difference as sueldo_diferencia',
          'project_providers.created_at as fecha_de_declaracion',
          'project_providers.start_date_contract as fecha_alta_contrato',
          'project_providers.finish_date_contract as fecha_baja_contrato',
          'project_providers.start_afip as fecha_alta_afip',
          'project_providers.finish_afip as fecha_baja_afip',
          'project_providers.is_reemplazo as puesto',
          'project_providers.id_crew_reemplazo as reemplazo_del_team',
          'project_providers.hour_initial as hora_inicio',
          'project_providers.hour_end as hora_final',
          'project_providers.hour_initial as horas_pactadas',
          'project_providers.active as activo',
          'users.email',
          'users.gender as genero',
          'users.type_dni as tipo_dni',
          'users.dni',
          'users.cuit',
          'users.birthdate as fecha_nacimiento',
          'users.civil_status as estado_civil',
          'providers.address as direccion',
          'providers.address_number as direccion_numero',
          'providers.piso_depto as direccion_piso_depto',
          'users.id_country as pais',
          'providers.location as localidad',
          'providers.cp as codigo_postal',
          'providers.nationality as nacionalidad',
          'providers.id_study as nivel_estudio',
          'providers.social_work as obrasocial_prepaga',
          'providers.social_work_code as info_obrasocial_prepaga',
          'providers.telephone as telefono',
          'providers.other_telephone as otro_telefono',
          'providers.referring as es_referente',
          'providers.cbu',
          'providers.bank as banco',
          'providers.type_account as tipo_cuenta',
          'providers.number_account as numero_cuenta',
          'providers.alias_account as alias'
        )
        ->join('providers', 'project_providers.id_provider', '=', 'providers.id')
        ->join('users', 'providers.id_user', '=', 'users.id')
        ->where('project_providers.absence', '!=', null)
        ->where('project_providers.absence', '!=', '[]')
        ->where('project_providers.id', $request->get('id_project_provider'))
        ->orderBy('project_providers.created_at', 'ASC')
        ->get();

        foreach($teams as &$team)
        {
          $team->n_proyecto = Project::getCenterCost($team->n_proyecto);
          $team->nombre_proyecto = Project::getName($team->nombre_proyecto);

          $team->genero = Helpers::getGenderEs($team->genero);
          $team->fecha_nacimiento = Helpers::getDateParseFormat($team->fecha_nacimiento);
          $team->pais = Country::getName($team->pais);
          $team->nacionalidad = Country::getNacionality($team->nacionalidad);
          $team->nivel_estudio = Study::getName($team->nivel_estudio);
          $team->obrasocial_prepaga = Helpers::getActive($team->obrasocial_prepaga);
          $team->es_referente = Helpers::getActive($team->es_referente);
          $team->banco = Helpers::getBank($team->banco);

          $team->horas_pactadas = ProjectProvider::getHoursExtras($team->hora_inicio,$team->hora_final);

          $team->funcion_frame = FrameFunction::getName($team->funcion_frame);
          $team->categoria_sat = WorkersCategory::getName($team->categoria_sat);
          $team->tipo_contrato = Contract::getName($team->tipo_contrato);
          $team->modalidad = Workday::getName($team->modalidad);
          $team->fecha_de_declaracion = Helpers::getDateParseFormat($team->fecha_de_declaracion);
          $team->fecha_alta_contrato = Helpers::getDateParseFormat($team->fecha_alta_contrato);
          $team->fecha_baja_contrato = Helpers::getDateParseFormat($team->fecha_baja_contrato);
          $team->fecha_alta_afip =  ($team->fecha_alta_afip != null && $team->fecha_alta_afip != '' ? Helpers::getDateParseFormat($team->fecha_alta_afip) : '');
          $team->fecha_baja_afip =  ($team->fecha_baja_afip != null && $team->fecha_baja_afip != '' ? Helpers::getDateParseFormat($team->fecha_baja_afip) : '');
          $team->puesto = ProjectProvider::getStringPuesto($team->puesto);
          $team->reemplazo_del_team = ($team->reemplazo_del_team ? Provider::getNameOrderLastName($team->reemplazo_del_team) : '-');
          $team->activo = Helpers::getActive($team->activo);

          $nameProject = $team->n_proyecto;
          $lastName = $team->apellido.' '.$team->nombre;
        }

        $timestamp = date('mdhis');

        Excel::create(Helpers::setLimitString("{$nameProject}_{$lastName}_ausencias_{$timestamp}", 27), function($excel) use ($teams, $list, $nameTeam)
        {
          $excel->sheet(Helpers::setLimitString($nameTeam, 27), function($sheet) use ($teams){
            $sheet->fromArray($teams);
          });

          $excel->sheet(Helpers::setLimitString("Ausencias", 27), function($sheet) use ($list){
            $sheet->fromArray(json_decode($list, true));
          });

        })->download();

      } catch(\Exception $e){
        Helpers::getCapturError($e);
      }
    }

    public function getCenterCosts()
    {
      try {
        $results = CenterCost::select( 'number as numero',
                                    'name as nombre',
                                    'client as cliente',
                                    'assigne as asignado_a_proyecto',
                                    'active as activo'
                                    )->get();

        if(count($results)) {

          foreach ($results as &$result) {
            $result->asignado_a_proyecto = Helpers::getActive($result->asignado_a_proyecto);
            $result->activo = Helpers::getActive($result->activo);
          }

          $timestamp = date('Ymdhis');

          Excel::create(Helpers::setLimitString("center_costs_{$timestamp}", 27), function($excel) use ($results){

            $excel->sheet('Centro de Costos', function($sheet) use ($results){
              $sheet->fromArray($results);
            });

          })->download();

        } else {
          return back()->with('message', 'El Listado de Centro de Costos se encuentra vacio!');
        }

      } catch(\Exception $e){
        Helpers::getCapturError($e);
      }
    }

    public function allProject()
    {
      try {
        $results = Project::select(
                              'id as cliente',
                              'name as nombre',
                              'description as descripcion',
                              'observations as observacion',
                              'cost_center as centro_costo',
                              'id_proyect_category as tipo_proyecto',
                              // 'id_team_referring as referente',
                              'start_date as fecha_inicio',
                              'finish_date as fecha_finalizacion',
                              'is_closed as estado',
                              'active as activo'
                            )
                            ->orderBy('projects.cost_center', 'DESC')
                            ->get()
                            ->toArray();

        foreach ($results as &$result) {
          $result['cliente'] = Client::getNick(CenterCost::getIdClient($result['centro_costo']));
          $result['centro_costo'] = CenterCost::getNumber($result['centro_costo']);
          $result['tipo_proyecto'] = ProyectCategory::getName($result['tipo_proyecto']);
          // $result['referente'] = Project::getReferring($result['referente']);
          $result['fecha_inicio'] = Helpers::getDateParseFormat($result['fecha_inicio']);
          $result['fecha_finalizacion'] = Helpers::getDateParseFormat($result['fecha_finalizacion']);
          $result['estado'] = Project::getIsClosed($result['estado']);
          $result['activo'] = Helpers::getActive($result['activo']);
        }

        $listTeams = ProjectProvider::select(

          'project_providers.id_project as centro_costo',
          'users.last_name as apellido',
          'users.name as nombre',
          'project_providers.id_function_frame as funcion_frame',
          'project_providers.id_category_sat as categoria_sat',
          'project_providers.id_contract as tipo_contrato',
          'project_providers.id_workday as modalidad',
          'project_providers.count_workdays_crew as cant_jornadas_laborables',
          'project_providers.salary_workdays as sueldo_jornada',
          'project_providers.total_workdays as sueldo_mano',
          'project_providers.total_workdays_text as sueldo_mano_texto',
          'project_providers.salary_contract_category_function as sueldo_contrato_mensual',
          'project_providers.salary_daily as sueldo_diario_sat',
          'project_providers.salary_liquidate as sueldo_liquidar',
          'project_providers.salaty_difference as sueldo_diferencia',
          'project_providers.created_at as fecha_de_declaracion',
          'project_providers.start_date_contract as fecha_alta_contrato',
          'project_providers.finish_date_contract as fecha_baja_contrato',
          'project_providers.start_afip as fecha_alta_afip',
          'project_providers.finish_afip as fecha_baja_afip',
          'project_providers.is_reemplazo as puesto',
          'project_providers.id_crew_reemplazo as reemplazo_del_team',
          'project_providers.hour_initial as hora_inicio',
          'project_providers.hour_end as hora_final',
          'project_providers.hour_initial as horas_pactadas',
          'project_providers.extra_hours as horas_extras',
          'project_providers.active as activo',
          'users.email',
          'users.gender as genero',
          'users.type_dni as tipo_dni',
          'users.dni',
          'users.cuit',
          'users.birthdate as fecha_nacimiento',
          'users.civil_status as estado_civil',
          'providers.address as direccion',
          'providers.address_number as direccion_numero',
          'providers.piso_depto as direccion_piso_depto',
          'users.id_country as pais',
          'providers.location as localidad',
          'providers.cp as codigo_postal',
          'providers.nationality as nacionalidad',
          'providers.id_study as nivel_estudio',
          'providers.social_work as obrasocial_prepaga',
          'providers.social_work_code as info_obrasocial_prepaga',
          'providers.telephone as telefono',
          'providers.other_telephone as otro_telefono',
          'providers.referring as es_referente',
          'providers.cbu',
          'providers.bank as banco',
          'providers.type_account as tipo_cuenta',
          'providers.number_account as numero_cuenta',
          'providers.alias_account as alias'
          )

        ->join('providers', 'project_providers.id_provider', '=', 'providers.id')
        ->join('users', 'providers.id_user', '=', 'users.id')
        ->orderBy('project_providers.id_project', 'DESC')
        ->get();

      foreach ($listTeams as &$team) {

        $team->centro_costo = Project::getCenterCost($team->centro_costo);

        $team->genero = Helpers::getGenderEs($team->genero);
        $team->fecha_nacimiento = ($team->fecha_nacimiento != null && $team->fecha_nacimiento != '' ? Helpers::getDateParseFormat($team->fecha_nacimiento) : '');
        $team->pais = Country::getName($team->pais);
        $team->nacionalidad = Country::getNacionality($team->nacionalidad);
        $team->nivel_estudio = Study::getName($team->nivel_estudio);
        $team->obrasocial_prepaga = Helpers::getActive($team->obrasocial_prepaga);
        $team->es_referente = Helpers::getActive($team->es_referente);
        $team->banco = Helpers::getBank($team->banco);

        $team->horas_pactadas = ProjectProvider::getHoursExtras($team->hora_inicio,$team->hora_final);

        $team->funcion_frame = FrameFunction::getName($team->funcion_frame);
        $team->categoria_sat = WorkersCategory::getName($team->categoria_sat);
        $team->tipo_contrato = Contract::getName($team->tipo_contrato);
        $team->modalidad = Workday::getName($team->modalidad);
        $team->fecha_de_declaracion = Helpers::getDateParseFormat($team->fecha_de_declaracion);
        $team->fecha_alta_contrato = Helpers::getDateParseFormat($team->fecha_alta_contrato);
        $team->fecha_baja_contrato = Helpers::getDateParseFormat($team->fecha_baja_contrato);
        $team->fecha_alta_afip = ($team->fecha_alta_afip != null && $team->fecha_alta_afip != '' ? Helpers::getDateParseFormat($team->fecha_alta_afip) : '');
        $team->fecha_baja_afip = ($team->fecha_baja_afip != null && $team->fecha_baja_afip != '' ? Helpers::getDateParseFormat($team->fecha_baja_afip) : '');
        $team->puesto = ProjectProvider::getStringPuesto($team->puesto);
        $team->reemplazo_del_team = ($team->reemplazo_del_team ? Provider::getNameOrderLastName($team->reemplazo_del_team) : '-');
        $team->activo = Helpers::getActive($team->activo);


        $countHsExtra = 0;
        if(!empty(json_decode($team->horas_extras))){
          foreach (json_decode($team->horas_extras) as $e) {
            $hs_extra_initial = substr($e->start, 0, strpos($e->start, '('));
            $hs_extra_initial_date = new DateTime($hs_extra_initial);

            $hs_extra_finish = substr($e->finish, 0, strpos($e->finish, '('));
            $hs_extra_finish_date = new DateTime($hs_extra_finish);

            $horasTrabajadas = ProjectProvider::getHoursExtrasExport($hs_extra_initial_date, $hs_extra_finish_date);

            if($e->agreed_hours == 0){
              $countHsExtra += $horasTrabajadas;
            } else {
              $countHsExtra += ($horasTrabajadas - $team->horas_pactadas);
            }

          }
        }

        $team->horas_extras = $countHsExtra;
      }

        $timestamp = date('Ymdhis');

        Excel::create(Helpers::setLimitString("projects_list_".$timestamp, 27), function($excel) use ($results, $listTeams){

          $excel->sheet('Lista de Teams', function($sheet) use ($listTeams){
            $sheet->fromArray($listTeams);
          });

          $groupDateResults = array();

          foreach($results as $key => $value){
            $groupDateResults[$value['centro_costo']][$key] = $value;
          }

          foreach($groupDateResults as $k => $v){
            $excel->sheet(Helpers::setLimitString(trim($k), 27), function($sheet) use ($v){
              $sheet->fromArray(json_decode(json_encode($v), true));
            });
          }

        })->download();

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function exportReport($id)
    {
      try {

        $report = Report::find($id);

        if(!$report){
          return view('frontend.status', [
            'message' => 'El Reporte a Descargar ya no se encuentra disponible!'
          ]);
        }

        $report->count_repeat = ($report->count_repeat + 1);
        $report->save();

        $reportDownload = '';

        switch ($report->type) {
          case 'information_project':
            $reportDownload = Report::exportProject($report->id_project, $report->from, $report->to, $report->date_by);
            break;
          case 'extra_hours':
            $reportDownload = Report::exportExtraHoursAbsences($report->id_project, $report->from, $report->to);
            break;
          case 'contract_secure':
            $reportDownload = Report::exportContractSecure($report->id_project, $report->from, $report->to, $report->date_by);
            break;
          case 'contracts':
            // exclude contracts type services. ID = 4
            $reportDownload = Report::exportProject($report->id_project, $report->from, $report->to, $report->date_by, '4');
            break;
          default:
            $reportDownload = Report::exportProject($report->id_project, $report->from, $report->to, $report->date_by);
            break;
        }

        if($reportDownload){
          return $reportDownload;
        } else {
          return view('frontend.status', [
            'message' => 'No encontramos Información para el Reporte a Descargar!'
          ]);
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function getHolidays()
    {
      try {
        $results = Holiday::select(
                            'name as nombre',
                            'date as fecha',
                            'description as descripcion',
                            'active as activo'
                          )->get();

        if(count($results)) {
          foreach ($results as &$result) {
            $result->fecha = Helpers::getDateParseFormat($result->fecha, '/');
            $result->activo = Helpers::getActive($result->activo);
          }

          $timestamp = date('Ymdhis');

          Excel::create(Helpers::setLimitString("feriados_{$timestamp}", 27), function($excel) use ($results){

            $excel->sheet('Feriados Nacionales', function($sheet) use ($results){
              $sheet->fromArray($results);
            });

          })->download();
        } else {
          return back()->with('message', 'El Listado de Feriados Nacionales se encuentra vacio!');
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    public function historyTeamProjects($id_team)
    {
      try{
        $projects = ProjectProvider::select('id_project')
                                ->where('id_provider', $id_team)
                                ->groupBy('id_project')
                                ->get();

        if(!count($projects)) {
          return redirect ('/providers')->with('message', 'No se encontro Historial de Proyectos para Descargar!');
        }

        $teams = ProjectProvider::select(
                                  'id',
                                  'id_provider',
                                  'id_project',
                                  'id_function_frame',
                                  'id_category_sat',
                                  'start_date_contract',
                                  'finish_date_contract',
                                  'id_contract',
                                  'active'
                                )->where('id_provider', $id_team)
                                ->get();

        $timestamp = date('Ymdhis');

        Excel::create(Helpers::setLimitString("historial_{$id_team}_{$timestamp}", 27), function($excel) use ($projects, $teams){

          foreach ($projects as $project)
          {
            $excel->sheet(Helpers::setLimitString(Project::getCenterCost($project->id_project)), function($sheet) use ($project, $teams){

              $results = array();
              foreach($teams as $team)
              {
                if($team->id_project == $project->id_project)
                {
                  array_push($results, [
                    'nombre' => Provider::getNameOrderLastName($team->id_provider),
                    'funcion_frame' => FrameFunction::getName($team->id_function_frame),
                    'funcion_sat' => WorkersCategory::getName($team->id_category_sat),
                    'alta_contrato' => Helpers::getDateParseFormat($team->start_date_contract, '/'),
                    'baja_contrato' =>  Helpers::getDateParseFormat($team->finish_date_contract, '/'),
                    'tipo_contrato' => Contract::getName($team->id_contract),
                    'estado' => ProjectProvider::getActive($team->active),
                    'puesto' => ProjectProvider::getPuesto($team->id)
                  ]);
                }
              }

              $sheet->fromArray(json_decode( json_encode($results), true));
            });
          }

        })->download();

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

}
