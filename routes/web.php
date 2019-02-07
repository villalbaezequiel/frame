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
  Route::resource('/users', 'Backend\UserController');
  Route::resource('/projects', 'Backend\ProjectsController');
  Route::resource('/clients', 'Backend\ClientsController');
  Route::resource('/providers', 'Backend\ProvidersController');
  Route::resource('/workers_categories', 'Backend\WorkersCategoriesController');
  Route::resource('/frame_functions', 'Backend\FrameFunctionsController');
  Route::resource('/sat_functions', 'Backend\SatFunctionsController');
  Route::resource('/utilities/contracts', 'Backend\UtilitiesContractsController');
  Route::resource('/utilities/countries', 'Backend\UtilitiesCountriesController');
  Route::resource('/utilities/proyect_categories', 'Backend\UtilitiesProyectCategoriesController');
  Route::resource('/utilities/studies', 'Backend\UtilitiesStudiesController');
  Route::resource('/utilities/workdays', 'Backend\UtilitiesWorkdaysController');

});

// ajax return Json
Route::get('/json/workers_categories/{id_frame_function}', 'Backend\JsonController@getWorkersCategories');
Route::get('/json/sat_functions/{id_frame_function}/{id_workers_category}', 'Backend\JsonController@getSatFunctions');
