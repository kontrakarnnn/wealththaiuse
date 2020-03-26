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

use App\Http\Controllers\SidebarController;
class CaseReportController extends Controller
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
      $data = CaseReport::paginate(30);
      $casereport = CaseReport::all();

        //return $data;

        return view('system-mgmt/case-report/index', ['casereport' => $casereport,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'system-mgmt/case-report/create');
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
         CaseReport::create([
            'name' => $request['name'],
            'view_link_url' => $request['view_link_url'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/case-report');
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
      return view( 'system-mgmt/case-report/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CaseReport::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = CaseReport::find($id);

            return redirect ('/admin/case-report');
        }

        return view( 'system-mgmt/case-report/edit', ['data' => $data]);
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
        $structure = CaseReport::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'view_link_url' => $request['view_link_url'],
          'description' => $request['description']
        ];
        CaseReport::where('id', $id)
            ->update($input);

        return redirect ('/admin/case-report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CaseReport::where('id', $id)->delete();
         return redirect ('/admin/case-report');
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
       return view( 'system-mgmt/case-report/index', ['casereport' => $casereport,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = CaseReport::query();
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
