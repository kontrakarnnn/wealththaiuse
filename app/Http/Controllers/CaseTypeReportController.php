<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\CaseReport;
use App\CaseTypeReport;
use App\CaseType;

use App\Http\Controllers\SidebarController;
class CaseTypeReportController extends Controller
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
      //  $data = CaseReport::$colName;
      //$col =
      $data = CaseTypeReport::paginate(30);
      $casereport = CaseReport::all();
      $casetypereport = CaseTypeReport::all();
      $casetype = CaseType::all();

        //return $data;

        return view('system-mgmt/case-type-report/index', ['casetypereport' => $casetypereport,'casereport' => $casereport,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $casetypereport = CaseTypeReport::all();
      $casereport = CaseReport::all();

      $casetype = CaseType::all();
        return view( 'system-mgmt/case-type-report/create',compact(['casereport','casetypereport','casetype']));
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
         CaseTypeReport::create([
            'name' => $request['name'],
            'case_report_id' => $request['case_report_id'],
            'case_type_id' => $request['case_type_id'],
            'description' => $request['description']

        ]);
        return redirect ('/admin/case-type-report');
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
      return view( 'system-mgmt/case-type-report/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CaseTypeReport::find($id);
        $casetypereport = CaseTypeReport::all();
        $casereport = CaseReport::all();

        $casetype = CaseType::all();
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = CaseReport::find($id);

            return redirect ('/admin/case-type-report');
        }
        return view( 'system-mgmt/case-type-report/edit', ['casetypereport' => $casetypereport,'casereport' => $casereport,'casetype' => $casetype,'data' => $data]);
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
        $structure = CaseTypeReport::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'case_report_id' => $request['case_report_id'],
          'case_type_id' => $request['case_type_id'],
          'description' => $request['description']
        ];
        CaseTypeReport::where('id', $id)
            ->update($input);

        return redirect ('/admin/case-type-report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CaseTypeReport::where('id', $id)->delete();
         return redirect ('/admin/case-type-report');
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
            $casereport = CaseReport::all();

       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/case-type-report/index', ['casereport' => $casereport,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = CaseTypeReport::query();
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
