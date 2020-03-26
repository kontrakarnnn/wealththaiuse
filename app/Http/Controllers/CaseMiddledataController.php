<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\CaseType;
use App\CaseCategory;
use App\Partner_block;
use App\Partner_group;
use App\CaseTypeConfig;
use App\Procedures;
use App\Casemiddledatatype;
use App\Casemiddledata;


use App\Http\Controllers\SidebarController;
class CaseMiddledataController extends Controller
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
      $casemiddledatatype  = Casemiddledatatype::all();
      $casemiddledata  = Casemiddledata::all();
      $data = Casemiddledata::with(['Casemiddledatatype','cases','Offer','portfolio','asset','file'])->paginate(30);
      return view('system-mgmt/case-middle-data/index', ['casemiddledata' => $casemiddledata,'casemiddledatatype' => $casemiddledatatype,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $casecategory = CaseCategory::all();
        return view( 'system-mgmt/case-middle-data/create',compact('casecategory'));
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
         CaseMiddledataType::create([
            'name' => $request['name'],
            'case_category' => $request['case_category'],
            'para_name1' => $request['para_name1'],
            'para_name2' => $request['para_name2'],
            'para_name3' => $request['para_name3'],
            'para_name4' => $request['para_name4'],
            'para_name5' => $request['para_name5'],
            'para_name6' => $request['para_name6'],
            'para_name7' => $request['para_name7'],
            'para_name8' => $request['para_name8'],
            'para_name9' => $request['para_name9'],
            'para_name10' => $request['para_name10'],
        ]);
        return redirect ('/admin/case-middle-data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $blocks = Structure::find($id)->portfolio;
      $structures = Structure::paginate(5);
      return view( 'system-mgmt/case-middle-data/index', compact(['structures','blocks','tree']));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $casecategory = CaseCategory::all();
        $data = Casemiddledatatype::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Casemiddledatatype::find($id);

            return redirect ('/admin/case-middle-data');
        }

        return view( 'system-mgmt/case-middle-data/edit', ['casecategory' => $casecategory,'data' => $data]);
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
          'case_category' => $request['case_category'],
          'para_name1' => $request['para_name1'],
          'para_name2' => $request['para_name2'],
          'para_name3' => $request['para_name3'],
          'para_name4' => $request['para_name4'],
          'para_name5' => $request['para_name5'],
          'para_name6' => $request['para_name6'],
          'para_name7' => $request['para_name7'],
          'para_name8' => $request['para_name8'],
          'para_name9' => $request['para_name9'],
          'para_name10' => $request['para_name10'],
        ];
        Casemiddledatatype::where('id', $id)
            ->update($input);

        return redirect ('/admin/case-middle-data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Casemiddledatatype::where('id', $id)->delete();
         return redirect ('/admin/case-middle-data');
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
            'middle_data_type' => $request['middle_data_type'],
            ];

       $data = $this->doSearchingQuery($constraints);
       $casemiddledatatype = Casemiddledata::all();
       $casemiddledata  = Casemiddledata::all();
       return view( 'system-mgmt/case-middle-data/index', ['casemiddledata' => $casemiddledata,'casemiddledatatype' => $casemiddledatatype,'data' => $data, 'searchingVals' => $constraints]);
    }
    private function doSearchingQuery($constraints) {
        $query = Casemiddledata::with(['CaseCategory']);
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(10000000000);
    }
    private function validateInput($request) {
        $this->validate($request, [
        //'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
