<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Helpers;
use App\Project;
use App\Contract;
use App\Country;
use App\WorkersCategory;
use App\Workday;
use App\Provider;
use App\ProjectProvider;
use App\FrameFunction;
use App\Client;
use App\ProyectCategory;
use App\Study;
use App\CenterCost;
use DateTime;

class Report extends Model
{

    static function getTypes()
    {
      $list = [
        'information_project' => 'Información de Proyecto',
        'extra_hours' => 'Horas Extras',
        'contract_secure' => 'Contratos Seguros',
        'contracts' => 'Contratos Plazo Fijo, Eventual y Tiempo indeterminado'
      ];

      return $list;
    }

    static function getType($key)
    {
      $list = self::getTypes();
      return $list[$key];
    }

    static function exportProject($id_project, $from = null, $to = null, $exclude = null)
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
                              'is_closed as estado',
                              'active as activo'
                            )
                            ->where('id', $id_project)
                            ->get()
                            ->toArray();

        foreach ($results as &$result)
        {
          $result['cliente'] = Client::getNick($result['cliente']);
          $result['centro_costo'] = CenterCost::getNumber($result['centro_costo']);
          $result['tipo_proyecto'] = ProyectCategory::getName($result['tipo_proyecto']);
          $result['referente'] = Project::getReferring($result['referente']);
          $result['fecha_inicio'] = Helpers::getDateParseFormat($result['fecha_inicio']);
          $result['fecha_finalizacion'] = Helpers::getDateParseFormat($result['fecha_finalizacion']);
          $result['estado'] = Project::getIsClosed($result['estado']);
          $result['activo'] = Helpers::getActive($result['activo']);
        }

        if($exclude)
        {
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
          ->where('project_providers.created_at', '>=', $from)
          ->where('project_providers.created_at', '<=', $to)
          ->where('project_providers.id_contract', '!=', $exclude)
          ->orderBy('project_providers.created_at', 'ASC')
          ->get();

        } else {

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
          ->where('project_providers.created_at', '>=', $from)
          ->where('project_providers.created_at', '<=', $to)
          ->orderBy('project_providers.created_at', 'ASC')
          ->get();
        }

        foreach($listTeams as &$team)
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

              $horasTrabajadas = ProjectProvider::getHoursExtrasExport($hs_extra_initial_date->format('H:i'), $hs_extra_finish_date->format('H:i'));
              $countHsExtra += ($horasTrabajadas - $team->horas_pactadas);
            }
          }

          $team->horas_extras = $countHsExtra;
        }

        $timestamp = date('Ymdhis');
        $nameProject = Project::getCenterCost($id_project);

        if(count($listTeams))
        {
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

        } else {
          return back()->with("message", "No se encontraron Horas Extras para los Teams del Proyecto Seleccionado.");
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    static function exportExtraHours($id_project, $from = null, $to = null)
    {
      try {
        $listTeams = ProjectProvider::select('extra_hours', 'id_provider', 'salary_workdays')
                                      ->where('project_providers.created_at', '>=', $from)
                                      ->where('project_providers.created_at', '<=', $to)
                                      ->where('id_project', $id_project)
                                      ->get();

        if(count($listTeams)){

          $nameProject = Project::getCenterCost($id_project);

          $timestamp = date('Ymdhis');
          Excel::create(Helpers::setLimitString("{$nameProject}_hsextras_{$timestamp}", 27), function($excel) use ($listTeams){

            foreach ($listTeams as $val) {

              $horasExtras = $val->extra_hours;
              $name = Provider::getNameOrderLastName($val->id_provider);
              $arrayHs = array();

              if(!empty($horasExtras)){
                foreach ($horasExtras as $hs_extra) {

                  $hs_extra_initial = substr($hs_extra['start'], 0, strpos($hs_extra['start'], '('));
                  $hs_extra_initial_date = new DateTime($hs_extra_initial);

                  $hs_extra_finish = substr($hs_extra['finish'], 0, strpos($hs_extra['finish'], '('));
                  $hs_extra_finish_date = new DateTime($hs_extra_finish);

                  $horasTrabajadas = ProjectProvider::getHoursExtrasExport($hs_extra_initial_date->format('H:i'), $hs_extra_finish_date->format('H:i'));
                  $parseSalary = str_replace(array('.', ','), array('', '.'), $val->salary_workdays);
                  $horasExtras = ((int) $horasTrabajadas - $hs_extra['agreed_hours']);
                  $valorHora = ( ($parseSalary / (int) $hs_extra['agreed_hours']) * 1.5 );

                  $arrayHs[] = array(
                                "fecha" => Helpers::getDay($hs_extra_initial_date->format('w')).' '.$hs_extra_initial_date->format('d/m/Y'),
                                "rol" => FrameFunction::getName($hs_extra['rol']),
                                "inicio" => $hs_extra_initial_date->format('H:i'),
                                "final" => $hs_extra_finish_date->format('H:i'),
                                "horas_pactadas" => $hs_extra['agreed_hours'],
                                "horas_extras" => $horasExtras,
                                "valor_hora" => "$" . round($valorHora, 2),
                                "valor_total" => "$" . round(($valorHora * $horasExtras), 2)
                              );
                }
              }

              if(!empty($arrayHs))
              {
                $excel->sheet(Helpers::setLimitString($name, 27), function($sheet) use ($arrayHs){
                  $sheet->fromArray($arrayHs);
                });
              }

            }

          })->download();
        } else {
          return back()->with("message", "No se encontraron Horas Extras para los Teams del Proyecto Seleccionado.");
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

    static function exportContractSecure($id_project, $from = null, $to = null)
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
                                    'project_providers.start_date_contract as Vigencia_Desde',
                                    'project_providers.finish_date_contract as Vigencia_Hasta',
                                    'project_providers.count_workdays_crew as Cantidad_de_Dias',
                                    'project_providers.salary_daily as Referencia_Prima_Diaria'
                                    )
                                    ->join('providers', 'project_providers.id_provider', '=', 'providers.id')
                                    ->join('users', 'providers.id_user', '=', 'users.id')
                                    ->where('project_providers.id_project', $id_project)
                                    ->where('project_providers.created_at', '>=', $from)
                                    ->where('project_providers.created_at', '<=', $to)
                                    ->where('project_providers.id_contract', '4') // 4 = Servicios
                                    ->where('project_providers.active', '1')
                                    ->orderBy('project_providers.created_at', 'ASC')
                                    ->get();

        if(count($results)){
          $count = 1;
          foreach ($results as &$team)
          {
            $fechaEmision = Carbon::parse($team->Vigencia_Desde);
            $fechaExpiracion = Carbon::parse($team->Vigencia_Hasta);

            $team->N° = $count;
            $team->Nombre_Apellido = User::getFullName($team->Nombre_Apellido);
            $team->Fecha_Nac = Helpers::getDateParseFormat($team->Fecha_Nac);
            $team->Actividad_Declarada = WorkersCategory::getName($team->Actividad_Declarada, false);
            $team->Fecha_de_Declaracion = Helpers::getDateParseFormat($team->Fecha_de_Declaracion);
            $team->Vigencia_Desde = Helpers::getDateParseFormat($team->Vigencia_Desde);
            $team->Vigencia_Hasta = Helpers::getDateParseFormat($team->Vigencia_Hasta);
            $team->Cantidad_de_Dias = $fechaExpiracion->diffInDays($fechaEmision);
            $team->Referencia_Prima_Diaria = '';
            $team->Costo_por_dia_sin_IVA = '';
            $team->Costo_por_dia_con_IVA = '';
            $team->Movimiento = 'Alta';

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

                $sheet->cell('C53', function($cell) use ($nameProject){
                  $cell->setValue(Client::getRazonSocial($nameProject->id_client));
                  $cell->setBorder('thin','thin', 'thin', 'thin');
                });

                $sheet->cell('D53', function($cell) use ($nameProject){
                  $cell->setValue(Client::getCuit($nameProject->id_client));
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

                  $sheet->cell('C53', function($cell) use ($nameProject){
                    $cell->setValue(Client::getRazonSocial($nameProject->id_client));
                    $cell->setBorder('thin','thin', 'thin', 'thin');
                  });

                  $sheet->cell('D53', function($cell) use ($nameProject){
                    $cell->setValue(Client::getCuit($nameProject->id_client));
                    $cell->setBorder('thin','thin', 'thin', 'thin');
                  });
                }

              });
            }

          })->download();
        } else {
          return back()->with("message", "No se encontraron Horas Extras para los Teams del Proyecto Seleccionado.");
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
      }
    }

}
