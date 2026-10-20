<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Holiday;
use App\Helpers;

class HolidaysController extends Controller
{
  protected $_permission;
  protected $permissionApproved = ['1', '7'];

  /**
   * Instantiate a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      $cancelPermission = true;
      $this->_permission = json_decode(Auth::user()->permissions);

      if($this->_permission){
        foreach($this->permissionApproved as $approved){
          foreach($this->_permission as $userPermission){
            if($approved == $userPermission){
              $cancelPermission = false;
              return $next($request);
            }
          }
        }
      }

        abort(404);
    });
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('backend.holidays.index', [
      'holidays' => Holiday::orderBy('date', 'DESC')->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('backend.holidays.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $message;
    try {

        $holiday = new Holiday;
        $holiday->name = $request->get('name');
        $holiday->date = Helpers::setDateFormatTimestamp($request->get('date'));
        $holiday->description = $request->get('description');
        $holiday->active = $request->get('active');
        $holiday->save();

        return redirect('/utilities/holidays')->with('message', 'Feriado creado con exito!');

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

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $holiday = Holiday::find($id);
    return view('backend.holidays.edit', [
      'holiday' => $holiday
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $message;
    try {

        $holiday = Holiday::find($id);
        $holiday->name = $request->get('name');
        $holiday->date = Helpers::setDateFormatTimestamp($request->get('date'));
        $holiday->description = $request->get('description');
        $holiday->active = $request->get('active');
        $holiday->save();

        return redirect('/utilities/holidays')->with('message', 'Feriado editado con exito!');

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

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $holiday = Holiday::find($id);
    $holiday->delete();

    return response(array('message' => 'Feriado eliminado con exito!'));
  }
}
