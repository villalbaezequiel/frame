<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Home Example
Route::get('/home', function(){
  return redirect('/');
})->name('home');

// redirect temporally
Route::get('/', function(){
  return redirect('/projects');
});

Route::group(['middleware' => ['auth']], function () {

  Route::resource('/roles', 'Backend\RolesController');
  Route::resource('/users', 'Backend\UsersController');
  Route::resource('/projects', 'Backend\ProjectsController');
  Route::resource('/projects_jornadas', 'Backend\ProjectsJornadasController');
  Route::resource('/callsheet', 'Backend\CallsheetController');
  Route::resource('/project_providers', 'Backend\ProjectProvidersController');
  Route::resource('/clients', 'Backend\ClientsController');
  Route::resource('/providers', 'Backend\ProvidersController');
  Route::resource('/workers_categories', 'Backend\WorkersCategoriesController');
  Route::resource('/frame_functions', 'Backend\FrameFunctionsController');
  Route::resource('/utilities/contracts', 'Backend\UtilitiesContractsController');
  Route::resource('/utilities/countries', 'Backend\UtilitiesCountriesController');
  Route::resource('/utilities/proyect_categories', 'Backend\UtilitiesProyectCategoriesController');
  Route::resource('/utilities/studies', 'Backend\UtilitiesStudiesController');
  Route::resource('/utilities/workdays', 'Backend\UtilitiesWorkdaysController');
  Route::resource('/center_costs', 'Backend\CenterCostsController');

  // export
  Route::get('/export/crew_contract/{id_project_provider}', 'Backend\ExportController@crewContract');
  Route::get('/export/release/{id_project_provider}', 'Backend\ExportController@crewRelease');
  Route::get('/export/seguros_servicios/{id_project}', 'Backend\ExportController@seguroServicios');
  Route::get('/export/callsheet/{id_project}', 'Backend\ExportController@callSheet');
  Route::get('/export/clients', 'Backend\ExportController@clients');
  Route::get('/export/workers_categories', 'Backend\ExportController@workersCategories');
  Route::get('/export/frame_functions', 'Backend\ExportController@frameFunctions');
  Route::get('/export/frame_functions_relation_sat', 'Backend\ExportController@frameFunctionsByWorkersCategories');
  Route::get('/export/project/{id_project}', 'Backend\ExportController@project');
  Route::get('/export/all_project', 'Backend\ExportController@allProject');
  Route::get('/export/project/{id_project}/horas_extras_teams', 'Backend\ExportController@horasExtrasTeams');
  Route::get('/export/users/', 'Backend\ExportController@getUsers');
  Route::get('/export/center_costs/', 'Backend\ExportController@getCenterCosts');
  Route::post('/export/users/', 'Backend\ExportController@postUsers')->name('export.users');
  Route::post('/export/horas_extras/', 'Backend\ExportController@exportTeamHourExtras')->name('export.horas_extras');

  // import
  Route::get('/import/workers_categories/', 'Backend\ImportController@workersCategories');
  Route::post('/import/workers_categories/store', 'Backend\ImportController@workersCategoriesStore')->name('import.workers_categories.store');

  // action is_closed project
  Route::get('/projects_is_closed/{id_project}/{status}', 'Backend\HelpersController@setIsClosed');

});

/* ----- ajax return Json ----- */
  // get
  Route::get('/json/workers_categories/{id_frame_function}', 'Backend\JsonController@getWorkersCategories');
  Route::get('/json/sat_functions/{id_frame_function}/{id_workers_category}', 'Backend\JsonController@getSatFunctions');
  Route::get('/json/{type_project}/functions_frame', 'Backend\JsonController@getFunctionsFrameByTypeProject');
  Route::get('/json/{id_function_frame}/categories_sat', 'Backend\JsonController@getCategoriesSatByFunctionFrame');
  Route::get('/json/{id_frame_function}/crew', 'Backend\JsonController@getTeamByFunctionFrame');
  Route::get('/json/check_crew_project/{id_provider}/{start_date_contract}', 'Backend\JsonController@checkAvailableTeamProject');
  Route::get('/json/category_sat_salary/{id_category_sat}', 'Backend\JsonController@getSalaryCategorySat');
  Route::get('/json/project_providers/jornada_crew', 'Backend\JsonController@storeJornadaTeam');
  Route::get('/json/get_function_frame', 'Backend\JsonController@getFuctionsFrame');

  // post
  Route::post('/json/project_providers/extra_hours', 'Backend\JsonController@storeExtraHours');
  Route::post('/json/remove_hs_extra', 'Backend\JsonController@postRemoveHsExtra');
  Route::post('/json/edit_team_project', 'Backend\JsonController@updateTeamProject');


/* ----- AUTH ----- */
  // register crew
  Route::post('/crew/store', 'Backend\ProvidersController@store')->name('crew.store');

  // accept project Team
  Route::get('/team/accept_project/{id_project_provider}', 'Backend\NotificationsController@getAcceptProjectTeam')->name('team_acceptproject.get');
  Route::post('/team/accept_project', 'Backend\NotificationsController@postAcceptProjectTeam')->name('team_acceptproject.post');

  // center cost
  Route::get('/centro_de_costos', 'Frontend\CenterCostsController@index');
