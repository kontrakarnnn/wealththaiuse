<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\ActionType;
use App\ActionCategory;
use App\Action;
use App\StageAction;
use App\Cases;
use App\Stage;
use App\Message_type;
use App\match_id;
use App\Member_group;
use App\Partner_group;
use App\Pid_group;
use App\Asset_type;

use App\Http\Controllers\SidebarController;
class StageActionController extends Controller
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

      $data = StageAction::paginate(30);
      $action = Action::all();
      $stage = Stage::all();
      $stageaction = StageAction::all();
        return view('system-mgmt/stageaction/index',compact(['stage','stageaction','action','data']));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $url = $_SERVER['REQUEST_URI'];

      $action = Action::all();
      $stage = Stage::all();
      $messagetype = Message_type::where('message_cat_id',15)->get();
      $publicid = match_id::all();
      $guildmem = Member_group::all();
      $grouppartner = Partner_group::all();
      $grouppid = Pid_group::all();
      $assettype = Asset_type::all();

      if(strstr($url,'?stage'))
      {
        $cut = explode('?stage',$url);
        $stageid = explode('actime=',$cut[1]);
        $stageid = $stageid[0];
        $stage = Stage::where('id',$stageid)->get();
      }
      $actiontimeexitflag = 0;
      if(strstr($url,'exit'))
      {
        $actiontimeexitflag =1;
      }
      $actiontimeenterflag = 0;
      if(strstr($url,'enter'))
      {
        $actiontimeenterflag =1;
      }
        return view( 'system-mgmt/stageaction/create',compact(['assettype','actiontimeenterflag','actiontimeexitflag','guildmem','grouppartner','grouppid','messagetype','publicid','action','stage']));
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
         StageAction::create([
            'name' => $request['name'],
            'current_stage_id' => $request['current_stage_id'],
            'action_id' => $request['action_id'],
            'action_time' => $request['action_time'],
            'action_para_value1' => $request['action_para_value1'],
            'action_para_value2' => $request['action_para_value2'],
            'action_para_value3' => $request['action_para_value3'],
            'action_para_value4' => $request['action_para_value4'],
            'action_para_value5' => $request['action_para_value5'],
            'action_para_value6' => $request['action_para_value6'],
            'action_para_value7' => $request['action_para_value7'],
            'action_para_value8' => $request['action_para_value8'],
            'action_para_value9' => $request['action_para_value9'],
            'action_para_value10' => $request['action_para_value10'],
        ]);
        $url = url()->previous();
        if(strstr($url,'blink='))
        {

          $blink = explode('blink=',$url);
          $idtogo = explode('id=',$blink[1]);
          return redirect($idtogo[0].'id='.$idtogo[1]);
        }
        return redirect ('/admin/stageaction');
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
      return view( 'system-mgmt/stageaction/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = StageAction::find($id);
        $action = Action::all();
        $stage = Stage::all();
        $messagetype = Message_type::where('message_cat_id',15)->get();
        $publicid = match_id::all();
        $guildmem = Member_group::all();
        $grouppartner = Partner_group::all();
        $grouppid = Pid_group::all();
        $assettype = Asset_type::all();

          if ($data == null) {
          $data = StageAction::find($id);

            return redirect ('/admin/stageaction');
        }

        return view( 'system-mgmt/stageaction/edit',compact(['assettype','guildmem','grouppartner','grouppid','messagetype','publicid','action','stage','data']));
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
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'current_stage_id' => $request['current_stage_id'],
          'action_id' => $request['action_id'],
          'action_time' => $request['action_time'],
          'action_para_value1' => $request['action_para_value1'],
          'action_para_value2' => $request['action_para_value2'],
          'action_para_value3' => $request['action_para_value3'],
          'action_para_value4' => $request['action_para_value4'],
          'action_para_value5' => $request['action_para_value5'],
          'action_para_value6' => $request['action_para_value6'],
          'action_para_value7' => $request['action_para_value7'],
          'action_para_value8' => $request['action_para_value8'],
          'action_para_value9' => $request['action_para_value9'],
          'action_para_value10' => $request['action_para_value10'],
        ];
        StageAction::where('id', $id)
            ->update($input);

        return redirect ('/admin/stageaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StageAction::where('id', $id)->delete();
         return redirect ('/admin/stageaction');
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
            'current_stage_id' => $request['current_stage_id'],
            'action_id' => $request['action_id'],
            'action_time' => $request['action_time'],
            ];
            $action = Action::all();
            $stage = Stage::all();
            $case = Cases::all();
            $stageaction = StageAction::all();
       $data = $this->doSearchingQuery($constraints);



       return view( 'system-mgmt/stageaction/index', ['action' => $action, 'stage' => $stage, 'case' => $case, 'stageaction' => $stageaction,  'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = StageAction::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(100000000);
    }
    private function validateInput($request) {
        $this->validate($request, [
        //'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
