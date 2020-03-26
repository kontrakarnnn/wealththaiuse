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
use App\FileCatGroup;
use App\FileCat;
use App\Path_condition_detail;


use App\Http\Controllers\SidebarController;
class PathConditionDetailController extends Controller
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
        $data = Path_condition_detail::paginate(30);
        //return data;
        $conditiontype = Condition_type::all();
        $condition = Condition::all();
        $case = Path_condition_detail::all();
        return view('system-mgmt/pathconditiondetail/index', ['case' => $case,'condition' => $condition,'conditiontype' => $conditiontype,'data' => $data]);
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
      $filecatgroup = FileCatGroup::all();
      $filecat = FileCat::all();
        return view( 'system-mgmt/pathconditiondetail/create',compact(['filecat','filecatgroup','condition','case']));
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
         Path_condition_detail::create([
           'name' => $request['name'],
           'condition_id' => $request['condition_id'],
           'con_para_value1' => $request['con_para_value1'],
           'con_para_value2' => $request['con_para_value2'],
           'con_para_value3' => $request['con_para_value3'],
           'con_para_value4' => $request['con_para_value4'],
           'con_para_value5' => $request['con_para_value5'],
           'con_para_value6' => $request['con_para_value6'],
           'con_para_value7' => $request['con_para_value7'],
           'con_para_value8' => $request['con_para_value8'],
           'con_para_value9' => $request['con_para_value9'],
           'con_para_value10' => $request['con_para_value10'],
           'description' => $request['description']
        ]);
        return redirect ('/admin/pathconditiondetail');
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
      return view( 'system-mgmt/condition/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Path_condition_detail::find($id);
        $case = Cases::all();
        $num = Path_condition_detail::where('id',$id)->value('condition_id');
        $condition = Condition::where('id',$num)->get();
        $conditions = Condition::all();
        $filecatgroup = FileCatGroup::all();
        $filecat = FileCat::all();
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Path_condition_detail::find($id);

            return redirect ('/admin/pathconditiondetail');
        }

        return view( 'system-mgmt/pathconditiondetail/edit', ['filecatgroup' => $filecatgroup,'filecat' => $filecat,'conditions' => $conditions,'case' => $case,'condition' => $condition,'data' => $data]);
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
          'condition_id' => $request['condition_id'],
          'con_para_value1' => $request['con_para_value1'],
          'con_para_value2' => $request['con_para_value2'],
          'con_para_value3' => $request['con_para_value3'],
          'con_para_value4' => $request['con_para_value4'],
          'con_para_value5' => $request['con_para_value5'],
          'con_para_value6' => $request['con_para_value6'],
          'con_para_value7' => $request['con_para_value7'],
          'con_para_value8' => $request['con_para_value8'],
          'con_para_value9' => $request['con_para_value9'],
          'con_para_value10' => $request['con_para_value10'],
          'description' => $request['description']
        ];
        Path_condition_detail::where('id', $id)
            ->update($input);

        return redirect ('/admin/pathconditiondetail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Path_condition_detail::where('id', $id)->delete();
         return redirect ('/admin/pathconditiondetail');
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
            'condition_id' => $request['condition_id'],
            'description' => $request['description']
            ];
       $conditiontype = Condition_type::all();
      $condition = Condition::all();
      $case = Path_condition_detail::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/pathconditiondetail/index', ['case' => $case,'condition' => $condition,'conditiontype' => $conditiontype,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Path_condition_detail::query();
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
