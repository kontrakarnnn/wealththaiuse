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
use App\Http\Controllers\SidebarController;
class ConditionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Condition::paginate(30);
        //return data;
        $conditiontype = Condition_type::all();
        $condition = Condition::all();
        return view('system-mgmt/condition/index', ['condition' => $condition,'conditiontype' => $conditiontype,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $conditiontype = Condition_type::all();
        return view( 'system-mgmt/condition/create',compact(['conditiontype']));
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
         Condition::create([
           'name' => $request['name'],
           'type_id' => $request['type_id'],
           'con_para_name1' => $request['con_para_name1'],
           'con_para_name2' => $request['con_para_name2'],
           'con_para_name3' => $request['con_para_name3'],
           'con_para_name4' => $request['con_para_name4'],
           'con_para_name5' => $request['con_para_name5'],
           'con_para_name6' => $request['con_para_name6'],
           'con_para_name7' => $request['con_para_name7'],
           'con_para_name8' => $request['con_para_name8'],
           'con_para_name9' => $request['con_para_name9'],
           'con_para_name10' => $request['con_para_name10'],
           'description' => $request['description']
        ]);
        return redirect ('/admin/condition');
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
        $data = Condition::find($id);
        $conditiontype = Condition_type::all();

        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Condition::find($id);

            return redirect ('/admin/condition');
        }

        return view( 'system-mgmt/condition/edit', ['conditiontype' => $conditiontype,'data' => $data]);
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
        $structure = Condition::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'type_id' => $request['type_id'],
          'con_para_name1' => $request['con_para_name1'],
          'con_para_name2' => $request['con_para_name2'],
          'con_para_name3' => $request['con_para_name3'],
          'con_para_name4' => $request['con_para_name4'],
          'con_para_name5' => $request['con_para_name5'],
          'con_para_name6' => $request['con_para_name6'],
          'con_para_name7' => $request['con_para_name7'],
          'con_para_name8' => $request['con_para_name8'],
          'con_para_name9' => $request['con_para_name9'],
          'con_para_name10' => $request['con_para_name10'],
          'description' => $request['description']
        ];
        Condition::where('id', $id)
            ->update($input);

        return redirect ('/admin/condition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Condition::where('id', $id)->delete();
         return redirect ('/admin/condition');
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
            'type_id' => $request['type_id'],
            ];
       $conditiontype = Condition_type::all();
      $condition = Condition::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/condition/index', ['condition' => $condition,'conditiontype' => $conditiontype,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Condition::query();
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
