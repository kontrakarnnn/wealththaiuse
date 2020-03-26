<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\Cases;
use App\Case_log;
use App\Stage;
use App\Path;

use App\Http\Controllers\SidebarController;
class CaseLogController extends Controller
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
      //  $data = Case_log::$colName;
      //$col =
      $case = Cases::all();
      $stage = Stage::all();
      $path = Path::all();
      $data = Case_log::paginate(30);
        //return $data;

        return view('system-mgmt/case-log/index', compact(['data','case','stage','path']));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $case = Cases::all();
      $stage = Stage::all();
      $path = Path::all();
        return view( 'system-mgmt/case-log/create', compact(['case','stage','path']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $date = date("d/m/Y");
        $this->validateInput($request);
         Case_log::create([
            'case_id' => $request['case_id'],
            'date_time' => $request['date']." ".$request['time'],
            'move_to_stage' => $request['move_to_stage'],
            'move_from_stage' => $request['move_from_stage'],
            'moving_path' => $request['moving_path'],
            'condition_match' => $request['condition_match'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/case-log');
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
      return view( 'system-mgmt/case-log/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $case = Cases::all();
      $stage = Stage::all();
      $path = Path::all();
        $data = Case_log::find($id);
        $cut = explode(" ",$data->date_time);
        $date = "";
        $time = "";
        if(count($cut) >0 )
        {
        $date = $cut[0];
        }
        if(count($cut) >1 )
        {
          $time = $cut[1];
        }
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Case_log::find($id);

            return redirect ('/admin/case-log');
        }

        return view( 'system-mgmt/case-log/edit', compact(['date','time','data','case','stage','path']));
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
        $structure = Case_log::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'case_id' => $request['case_id'],
          'date_time' => $request['date'].$request['time'],
          'move_to_stage' => $request['move_to_stage'],
          'move_from_stage' => $request['move_from_stage'],
          'moving_path' => $request['moving_path'],
          'condition_match' => $request['condition_match'],
          'description' => $request['description']
        ];
        Case_log::where('id', $id)
            ->update($input);

        return redirect ('/admin/case-log');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Case_log::where('id', $id)->delete();
         return redirect ('/admin/case-log');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
          'case_id' => $request['case_id'],
          'date_time' => $request['date'].$request['time'],
          'move_to_stage' => $request['move_to_stage'],
          'move_from_stage' => $request['move_from_stage'],
          'moving_path' => $request['moving_path'],
            ];
            $case = Cases::all();
            $stage = Stage::all();
            $path = Path::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/case-log/index', ['case' => $case,'stage' => $stage,'path' => $path,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Case_log::query();
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
