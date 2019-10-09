<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Report as SendReport;
use App\User;
use App\Report;
use App\CenterCost;
use App\Project;
use App\Helpers;

class ReportsController extends Controller
{

    protected $_permission;
    protected $permissionApproved = ['1', '8'];

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
      return view('backend.reports.index', [
        'reports' => Report::orderBy('id', 'DESC')->get()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        // obtengo el Projecto con el ID de Centro de Costo
        // id_project = id_centercost
        $project = Project::getProjectByCenterCost($request->get('id_project'));
        $projectId = $project->id;
        $from = Helpers::setTransformDateTimestamp($request->get('from'));
        $to = Helpers::setTransformDateTimestamp($request->get('to'));
        $type = $request->get('type');

        $report = new Report;
        $report->id_project = $projectId;
        $report->type = $type;
        $report->from = $from;
        $report->to = $to;
        $report->action = $request->get('action');
        $report->send_email = $request->get('send_email');
        $report->count_repeat = 0;
        $report->save();

        if($request->get('action') == 'download'){

          return redirect('/reports')->with([
            'message' => 'Reporte creado con exito!',
            'download' => url('/export/report/'.$report->id)
          ]);

        } else {
          // send by mail
          try {

            $data = [
              'center_cost' => CenterCost::getNumber($request->get('id_project')),
              'type_report' => Report::getType($request->get('type')),
              'from'        => $request->get('from'),
              'to'          => $request->get('to'),
              'report_id'   => $report->id
            ];

            $user = new User;
            $user->email = $request->get('send_email');
            $user->notify(new SendReport($data));

            return redirect('/reports')->with('message', 'Reporte creado y enviado con exito!');

          } catch (\Exception $e) {
            return redirect('/reports')->with('message', 'Reporte creado con exito! Hubo un error en enviar el Reporte por Mail.');
          }
        }

      } catch(\Exception $e) {
        Helpers::getCapturError($e);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $report = Report::find($id);
      $report->delete();

      return response(array('message' => 'Reporte eliminado con exito!'));
    }
}
