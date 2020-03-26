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
use App\CaseAction;
use App\Cases;
use App\Stage;

use App\Http\Controllers\SidebarController;
class CaseActionController extends Controller
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

      $data = CaseAction::paginate(30);
      $action = Action::all();
      $stage = Stage::all();
      $case = Cases::all();
      $stageaction = StageAction::all();
      $caseaction = CaseAction::all();

        return view('system-mgmt/caseaction/index',compact(['caseaction','case','stage','stageaction','action','data']));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $action = Action::all();
      $stage = Stage::all();
      $case = Cases::all();
      $stageaction = StageAction::all();

        return view( 'system-mgmt/caseaction/create',compact(['stageaction','case','action','stage']));
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
         CaseAction::create([
            'case_id' => $request['case_id'],
            'stage_action' => $request['stage_action'],
            'action_flag' => $request['action_flag'],
            'action_stage_id' => $request['action_stage_id'],
            'action_time' => $request['action_time'],
            'description' => $request['description'],


        ]);
        return redirect ('/admin/caseaction');
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
      return view( 'system-mgmt/caseaction/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CaseAction::find($id);
        $action = Action::all();
        $stage = Stage::all();
        $case = Cases::all();
        $stageaction = StageAction::all();
          if ($data == null) {
          $data = CaseAction::find($id);

            return redirect ('/admin/caseaction');
        }

        return view( 'system-mgmt/caseaction/edit',compact(['stageaction','case','action','stage','data']));
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
          'case_id' => $request['case_id'],
          'stage_action' => $request['stage_action'],
          'action_flag' => $request['action_flag'],
          'action_stage_id' => $request['action_stage_id'],
          'action_time' => $request['action_time'],
          'description' => $request['description'],
        ];
        CaseAction::where('id', $id)
            ->update($input);

        return redirect ('/admin/caseaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CaseAction::where('id', $id)->delete();
         return redirect ('/admin/caseaction');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'stage_action' => $request['stage_action'],
            'action_stage_id' => $request['action_stage_id'],
            'case_id' => $request['case_id'],
            'action_time' => $request['action_time'],
            ];
            $action = Action::all();
            $stage = Stage::all();
            $case = Cases::all();
            $stageaction = CaseAction::all();
       $data = $this->doSearchingQuery($constraints);



       return view( 'system-mgmt/caseaction/index', ['action' => $action, 'stage' => $stage, 'case' => $case, 'stageaction' => $stageaction,  'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = CaseAction::query();
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
