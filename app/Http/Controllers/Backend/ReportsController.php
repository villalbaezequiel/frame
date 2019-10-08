<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Report;
use App\Project;

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

        if($request->get('action') == 'download')
        {
          switch ($type) {
            case 'information_project':
              Report::exportProject($projectId, $from, $to);
              break;
            case 'extra_hours':
              Report::exportExtraHours($projectId, $from, $to);
              break;
            case 'contract_secure':
              Report::exportContractSecure($projectId, $from, $to);
              break;
            case 'contracts':
              // exclude contracts type services. ID = 4
              Report::exportProject($projectId, $from, $to, '4');
              break;
            default:
              Report::exportProject($projectId, $from, $to);
              break;
          }
        } else {
          // send by mail
        }

        return redirect('/reports')->with('message', 'Reporte creado con exito!');

      } catch(\Exception $e) {
        var_dump($e);
        die();

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
