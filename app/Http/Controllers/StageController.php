<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\Stage;
use App\Process;
use App\Action;
use App\Message_type;
use App\match_id;
use App\Member_group;
use App\Partner_group;
use App\Pid_group;
use App\StageAction;

use App\Path_condition_detail;
use App\Http\Controllers\SidebarController;
class StageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('view');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $action = Action::all();
      $messagetype = Message_type::where('message_cat_id',15)->get();
      $publicid = match_id::all();
      $guildmem = Member_group::all();
      $grouppartner = Partner_group::all();
      $grouppid = Pid_group::all();

      $currenturl = $_SERVER['REQUEST_URI'];
      if ( strstr($currenturl, 'proceid') )
      {
        $procedureid = explode('proceid',$currenturl);
        $procedureid = $procedureid[1];
        $data = Stage::where('process_id',$procedureid)->paginate(100000);
      }
      else
      {
        $data = Stage::paginate(30);
      }
      $idcut = "No";
      if ( strstr($currenturl, 'openflag') )
      {
        $idcut = explode('id=dd',$currenturl);
        $idcut = $idcut[1];
      }
    //  return $idcut;
        $process = Process::all();
        $pathconditiondetail = Path_condition_detail::all();
        $structures = Asset_cat::paginate(30);
        return view('system-mgmt/stage/index', ['idcut' => $idcut,'action' => $action,'messagetype' => $messagetype,'publicid' => $publicid,'guildmem' => $guildmem,'grouppartner' => $grouppartner,'grouppid' => $grouppid,'pathconditiondetail' => $pathconditiondetail,'process' => $process,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $process = Process::all();

        return view( 'system-mgmt/stage/create',compact(['process']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
         Stage::create([
            'name' => $request['name'],
            'process_id' => $request['process_id'],
            'end_stage_flag' => $request['end_stage_flag'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/stage');
    }
    public function deleteaction()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?',$url);
        $id = $url[1];
        StageAction::where('id', $id)->delete();
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      //sidebar

$tree = session()->get('tree');
//sidebar


      $blocks = Structure::find($id)->portfolio;
      $structures = Structure::paginate(5);
      return view( 'system-mgmt/stage/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $process = Process::all();

        $data = Stage::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Stage::find($id);

            return redirect ('/admin/stage');
        }

        return view( 'system-mgmt/stage/edit', ['process' => $process,'data' => $data]);
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
        $structure = Stage::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'process_id' => $request['process_id'],
          'end_stage_flag' => $request['end_stage_flag'],
          'description' => $request['description']
        ];
        Stage::where('id', $id)
            ->update($input);

        return redirect ('/admin/stage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stage::where('id', $id)->delete();
         return redirect ('/admin/stage');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name'],
            'description' => $request['description']
            ];

       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/stage/index', ['data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Stage::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
