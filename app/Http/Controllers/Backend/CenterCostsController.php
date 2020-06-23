<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\newCenterCost;
use App\Notifications\ProducerOrders;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\User;
use App\CenterCost;

class CenterCostsController extends Controller
{
  protected $_permission;
  protected $permissionApproved = ['1', '10', '16'];

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

    });
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $id_team_referente = User::select('providers.id')
                              ->join('providers', 'providers.id_user', '=', 'users.id')
                              ->where('users.id', Auth::user()->id)
                              ->where('users.permissions', 'like', '%"16"%')
                              ->where('users.section_notification', 'like', '%"producer_orders"%')
                              ->where('users.is_notification', '1')
                              ->where('users.active', '1')
                              ->first();
      if($id_team_referente)
      {
        $listCC = CenterCost::where('push_rol_producer_orders', '1')
                              ->where('referente', 'like', "%$id_team_referente->id%")
                              ->orderBy('id', 'DESC')
                              ->get();
      } else {
        $listCC = CenterCost::orderBy('id', 'DESC')->get();
      }

      return view('backend.center_costs.index', [
        'center_costs' => $listCC
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.center_costs.create');
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

        // verify center_cost
        if(CenterCost::issetCenterCost($request->get('number'))) {
          return back()->with('message', 'El Número de Centro de Costo ya existe. Intente con otro Número!');
        }

        // New Center Cost
        $center_cost = new CenterCost;
        $center_cost->number = $request->get('number');
        $center_cost->name = $request->get('name');
        $center_cost->client = $request->get('client');
        $center_cost->id_type_project = $request->get('id_type_project');
        $center_cost->referente = ($request->get('referente') ? json_encode($request->get('referente')) : null);
        $center_cost->push_rol_producer_orders = $request->get('push_rol_producer_orders');
        $center_cost->active = $request->get('active');
        $center_cost->save();

        if((int) $center_cost->push_rol_producer_orders == 1 && (int) $center_cost->assigne == 0) 
        {
          $listUsersProducerOrdersNoti = User::getAllProducerOrdersNotification($center_cost->referente);
          
          if($listUsersProducerOrdersNoti)
          { 
            foreach ($listUsersProducerOrdersNoti as $user)
            {
              $data = array(
                'user' => $user
              );

              $user->notify(new ProducerOrders($data));
            }
          }
        }

        // enviar notificicacion por mail cuando se crea un nuevo centro de costo
        if($center_cost){
          $listUsersNoti = User::getAllCenterCostNotification();
          foreach ($listUsersNoti as $user) {

            $data = array(
              'user' => $user,
              'center_cost' => $center_cost
            );

            $user->notify(new newCenterCost($data));
          }
        }

        return redirect('/center_costs')->with('message', 'Centro de Costo creado con exito!');

      } catch(\Exception $e) {
        echo $e->getMessage();
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
      $center_cost = CenterCost::find($id);
      return view('backend.center_costs.edit', [
        'center_cost' => $center_cost
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

        // verify center_cost
        if(CenterCost::issetCenterCost($request->get('number'), $id)) {
          return back()->with('message', 'El Número de Centro de Costo ya existe. Intente con otro Número!');
        }

        // Update Center Cost
        $center_cost = CenterCost::find($id);
        $center_cost->number = $request->get('number');
        $center_cost->name = $request->get('name');
        $center_cost->client = $request->get('client');
        $center_cost->id_type_project = $request->get('id_type_project');
        $center_cost->referente = ($request->get('referente') ? json_encode($request->get('referente')) : null);
        $center_cost->push_rol_producer_orders = $request->get('push_rol_producer_orders');
        $center_cost->active = $request->get('active');
        $center_cost->save();

        if((int) $center_cost->push_rol_producer_orders == 1 && (int) $center_cost->assigne == 0) 
        {
          $listUsersProducerOrdersNoti = User::getAllProducerOrdersNotification($center_cost->referente);
          
          if($listUsersProducerOrdersNoti)
          {
            foreach ($listUsersProducerOrdersNoti as $user) {

              $data = array(
                'user' => $user
              );

              $user->notify(new ProducerOrders($data));
            }
          }
        }

        return redirect('/center_costs')->with('message', 'Centro de Costo editado con exito!');

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
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
      $center_cost = CenterCost::find($id);
      $center_cost->delete();

      return response(array('message' => 'Centro de Costo eliminado con exito!'));
    }
}
