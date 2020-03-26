<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\CaseSubType;
use App\CaseType;
use App\Http\Controllers\SidebarController;
class CaseSubTypeController extends Controller
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
      //  $data = CaseSubType::$colName;
      //$col =
      $casetype = CaseType::all();
      $col = CaseSubType::arraycolumn();
      $casesubtype = CaseSubType::with(['CaseType'])->get();
      $data = CaseSubType::with(['CaseType'])->paginate(30);
        //return $data;

        return view('system-mgmt/case-subtype/index', ['casesubtype' => $casesubtype,'casetype' => $casetype,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $casetype = CaseType::all();
        return view( 'system-mgmt/case-subtype/create',compact('casetype'));
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
         CaseSubType::create([
            'name' => $request['name'],
            'case_type' => $request['case_type'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/case-subtype');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $casetype = CaseType::all();
      $col = CaseSubType::arraycolumn();
        $data = CaseSubType::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = CaseSubType::find($id);

            return redirect ('/admin/case-subtype');
        }

        return view( 'system-mgmt/case-subtype/edit', ['col' => $col,'casetype' => $casetype,'data' => $data]);
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
        $structure = CaseSubType::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'case_type' => $request['case_type'],

            'description' => $request['description']
        ];
        CaseSubType::where('id', $id)
            ->update($input);

        return redirect ('/admin/case-subtype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CaseSubType::where('id', $id)->delete();
         return redirect ('/admin/case-subtype');
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
            'case_type' => $request['case_type'],
            'description' => $request['description']
            ];
       $casetype = CaseType::all();
       $casesubtype = CaseSubType::with(['CaseType'])->get();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/case-subtype/index', ['casesubtype' => $casesubtype,'casetype' => $casetype,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = CaseSubType::query();
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
    ]);
    }
}
