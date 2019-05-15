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

  // export
  Route::get('/export/crew_contract/{id_project_provider}', 'Backend\ExportController@crewContract');

  // import
  Route::get('/import/workers_categories/', 'Backend\ImportController@workersCategories');
  Route::post('/import/workers_categories/store', 'Backend\ImportController@workersCategoriesStore')->name('import.workers_categories.store');

});

// ajax return Json
Route::get('/json/workers_categories/{id_frame_function}', 'Backend\JsonController@getWorkersCategories');
Route::get('/json/sat_functions/{id_frame_function}/{id_workers_category}', 'Backend\JsonController@getSatFunctions');

Route::get('/json/{type_project}/functions_frame', 'Backend\JsonController@getFunctionsFrameByTypeProject');
Route::get('/json/{id_function_frame}/categories_sat', 'Backend\JsonController@getCategoriesSatByFunctionFrame');
Route::get('/json/{id_frame_function}/crew', 'Backend\JsonController@getTeamByFunctionFrame');
Route::get('/json/check_crew_project/{id_provider}/{start_date_contract}', 'Backend\JsonController@checkAvailableTeamProject');
Route::get('/json/category_sat_salary/{id_category_sat}', 'Backend\JsonController@getSalaryCategorySat');
Route::get('/json/project_providers/extra_hours', 'Backend\JsonController@storeExtraHours');
Route::get('/json/project_providers/jornada_crew', 'Backend\JsonController@storeJornadaTeam');

// register crew
Route::post('/crew/store', 'Backend\ProvidersController@store')->name('crew.store');

// accept project Team
Route::get('/crew/accept_project/{id_project_provider}', 'Backend\NotificationsController@getAcceptProjectTeam')->name('crew_acceptproject.get');
Route::post('/crew/accept_project', 'Backend\NotificationsController@postAcceptProjectTeam')->name('crew_acceptproject.post');

// insert user manually
Route::get('/insert_usert_ev', function(){
  $user = new \App\User;
  $user->name = 'Ezeuiel';
  $user->email = 'villalbaezequiel64@gmail.com';
  $user->password = \Illuminate\Support\Facades\Hash::make('EVI12345!!');
  $user->is_crew = '0';
  $user->active = '1';
  $user->save();
});
