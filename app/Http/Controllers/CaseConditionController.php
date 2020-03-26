<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\Process;
use App\Stage;
use App\Condition;
use App\Condition_type;
use App\Case_condition;
use App\Cases;
use App\Path_condition_detail;

use App\Http\Controllers\SidebarController;
class CaseConditionController extends Controller
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
        $data = Case_condition::paginate(30);
        //return data;
        $conditiontype = Condition_type::all();
        $condition = Condition::all();
        $case = Cases::all();
        return view('system-mgmt/casecondition/index', ['case' => $case,'condition' => $condition,'conditiontype' => $conditiontype,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $case = Cases::all();
      $condition = Condition::all();
      $pathconditiondetail = Path_condition_detail::all();
        return view( 'system-mgmt/casecondition/create',compact(['pathconditiondetail','condition','case']));
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
         Case_condition::create([
           'name' => $request['name'],
           'case_id' => $request['case_id'],
           'condition_flag' => $request['condition_flag'],
           'path_condition_detail' => $request['path_condition_detail'],
           'description' => $request['description']
        ]);
        return redirect ('/admin/casecondition');
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
     return view( 'system-mgmt/condition/index', compact(['pathconditiondetail','structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Case_condition::find($id);
        $case = Cases::all();
        $num = Path_condition_detail::where('id',$id)->value('condition_id');
        $condition = Condition::where('id',$num)->get();
        $pathconditiondetail = Path_condition_detail::all();

        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Case_condition::find($id);

            return redirect ('/admin/casecondition');
        }

        return view( 'system-mgmt/casecondition/edit', ['pathconditiondetail' => $pathconditiondetail,'case' => $case,'condition' => $condition,'data' => $data]);
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
          'case_id' => $request['case_id'],
          'condition_flag' => $request['condition_flag'],
          'path_condition_detail' => $request['path_condition_detail'],
          'description' => $request['description']
  
        ];
        Case_condition::where('id', $id)
            ->update($input);

        return redirect ('/admin/casecondition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Case_condition::where('id', $id)->delete();
         return redirect ('/admin/casecondition');
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
            'start_stage' => $request['start_stage'],
            'description' => $request['description']
            ];
       $conditiontype = Condition_type::all();
      $condition = Condition::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/casecondition/index', ['condition' => $condition,'conditiontype' => $conditiontype,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Case_condition::query();
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
        //'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
