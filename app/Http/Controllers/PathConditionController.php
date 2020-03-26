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
use App\Path_condition_detail;
use App\Path_condition;
use App\Cases;
use App\Path;

use App\Http\Controllers\SidebarController;
class PathConditionController extends Controller
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
        $data = Path_condition::orderBy('path_id','ASC')->paginate(30);
        $pathcondition = Path_condition::all();
        //return data;
        $path = Path::all();
        $conditiontype = Condition_type::all();
        $condition = Condition::all();
        $case = Cases::all();
        $casecondition = Path_condition_detail::all();
        return view('system-mgmt/pathcondition/index', ['pathcondition' => $pathcondition,'path' => $path,'casecondition' => $casecondition,'case' => $case,'condition' => $condition,'conditiontype' => $conditiontype,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $casecondition = Path_condition_detail::all();
      $case = Cases::all();
      $condition = Condition::all();
      $path = Path::all();
        return view( 'system-mgmt/pathcondition/create',compact(['path','condition','casecondition','condition','case']));
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
         Path_condition::create([
           'name' => $request['name'],
           'path_id' => $request['path_id'],
           'reverse_all_preposition' => $request['reverse_all_preposition'],
           'reverse_each_preposition1' => $request['reverse_each_preposition1'],
           'reverse_each_preposition2' => $request['reverse_each_preposition2'],
           'reverse_each_preposition3' => $request['reverse_each_preposition3'],
           'reverse_each_preposition4' => $request['reverse_each_preposition4'],
           'reverse_each_preposition5' => $request['reverse_each_preposition5'],
           'reverse_each_preposition6' => $request['reverse_each_preposition6'],
           'reverse_each_preposition7' => $request['reverse_each_preposition7'],
           'reverse_each_preposition8' => $request['reverse_each_preposition8'],
           'reverse_each_preposition9' => $request['reverse_each_preposition9'],
           'reverse_each_preposition10' => $request['reverse_each_preposition10'],
           'path_condition_detail1' => $request['path_condition_detail1'],
           'path_condition_detail2' => $request['path_condition_detail2'],
           'path_condition_detail3' => $request['path_condition_detail3'],
           'path_condition_detail4' => $request['path_condition_detail4'],
           'path_condition_detail5' => $request['path_condition_detail5'],
           'path_condition_detail6' => $request['path_condition_detail6'],
           'path_condition_detail7' => $request['path_condition_detail7'],
           'path_condition_detail8' => $request['path_condition_detail8'],
           'path_condition_detail9' => $request['path_condition_detail9'],
           'path_condition_detail10' => $request['path_condition_detail10'],
           'description' => $request['description']
        ]);
        return redirect ('/admin/pathcondition');
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
      return view( 'system-mgmt/pathcondition/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $casecondition = Path_condition_detail::all();
      $case = Cases::all();
      $condition = Condition::all();
      $path = Path::all();
        $data = Path_condition::find($id);
        $case = Cases::all();

        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Path_condition::find($id);

            return redirect ('/admin/pathcondition');
        }

        return view( 'system-mgmt/pathcondition/edit', ['casecondition' => $casecondition,'path' => $path,'case' => $case,'data' => $data]);
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
          'path_id' => $request['path_id'],
          'reverse_all_preposition' => $request['reverse_all_preposition'],
          'reverse_each_preposition1' => $request['reverse_each_preposition1'],
          'reverse_each_preposition2' => $request['reverse_each_preposition2'],
          'reverse_each_preposition3' => $request['reverse_each_preposition3'],
          'reverse_each_preposition4' => $request['reverse_each_preposition4'],
          'reverse_each_preposition5' => $request['reverse_each_preposition5'],
          'reverse_each_preposition6' => $request['reverse_each_preposition6'],
          'reverse_each_preposition7' => $request['reverse_each_preposition7'],
          'reverse_each_preposition8' => $request['reverse_each_preposition8'],
          'reverse_each_preposition9' => $request['reverse_each_preposition9'],
          'reverse_each_preposition10' => $request['reverse_each_preposition10'],
          'path_condition_detail1' => $request['path_condition_detail1'],
          'path_condition_detail2' => $request['path_condition_detail2'],
          'path_condition_detail3' => $request['path_condition_detail3'],
          'path_condition_detail4' => $request['path_condition_detail4'],
          'path_condition_detail5' => $request['path_condition_detail5'],
          'path_condition_detail6' => $request['path_condition_detail6'],
          'path_condition_detail7' => $request['path_condition_detail7'],
          'path_condition_detail8' => $request['path_condition_detail8'],
          'path_condition_detail9' => $request['path_condition_detail9'],
          'path_condition_detail10' => $request['path_condition_detail10'],
          'description' => $request['description']
        ];
        Path_condition::where('id', $id)
            ->update($input);

        return redirect ('/admin/pathcondition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Path_condition::where('id', $id)->delete();
         return redirect ('/admin/pathcondition');
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
            'path_id' => $request['path_id'],
            'reverse_all_preposition' => $request['reverse_all_preposition'],
            'path_condition_detail1' => $request['path_condition_detail1'],
            'path_condition_detail2' => $request['path_condition_detail2'],
            'path_condition_detail3' => $request['path_condition_detail3'],
            'path_condition_detail4' => $request['path_condition_detail4'],
            'path_condition_detail5' => $request['path_condition_detail5'],
            'path_condition_detail6' => $request['path_condition_detail6'],
            'path_condition_detail7' => $request['path_condition_detail7'],
            'path_condition_detail8' => $request['path_condition_detail8'],
            'path_condition_detail9' => $request['path_condition_detail9'],
            'path_condition_detail10' => $request['path_condition_detail10'],            ];
            $pathcondition = Path_condition::all();
            //return data;
            $path = Path::all();
            $conditiontype = Condition_type::all();
            $condition = Condition::all();
            $case = Cases::all();
            $casecondition = Path_condition_detail::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/pathcondition/index', ['pathcondition' => $pathcondition,'path' => $path,'casecondition' => $casecondition,'case' => $case,'condition' => $condition,'conditiontype' => $conditiontype,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Path_condition::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(1000000000);
    }
    private function validateInput($request) {
        $this->validate($request, [
        //'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
