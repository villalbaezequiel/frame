<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Provider;
use App\Helpers;
use App\FrameFunction;
use App\WorkersCategory;
use App\Project;
use App\ProjectProvider;
use App\Holiday;

class ProjectsJornadasController extends Controller
{
    protected $_permission;
    protected $permissionApproved = ['1', '2'];

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
        return view('backend.projects_jornadas.index', [
          'projects' => Project::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $project = Project::find($id);
      $listTeam = ProjectProvider::where('id_project', $id)
                                  ->where('active', '1')
                                  ->get();

      foreach ($listTeam as $crew) {
        // name crew
        // posicion frame/sat
        $crew->name_user = Provider::getNameOrderLastName($crew->id_provider)." (".Helpers::getDateParseFormat($crew->start_date_contract, '/')." - ".Helpers::getDateParseFormat($crew->finish_date_contract, '/').")";
        $crew->function_frame_name = FrameFunction::getName($crew->id_function_frame);
        $crew->function_frame_color = FrameFunction::getColor($crew->id_function_frame);
      }

      return view('backend.projects_jornadas.show', [
        'project' => $project,
        'list_crew' => $listTeam,
        'holidays' => Holiday::where('active', '1')->get()
      ]);
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
        //
    }
}
