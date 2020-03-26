<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\Procedures;
use App\Process;
use App\Procedures_To_Process;
use App\Http\Controllers\SidebarController;
class ProceduresToProcessController extends Controller
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
      $currenturl = $_SERVER['REQUEST_URI'];
      if ( strstr($currenturl, 'pcdid') )
      {
        $procedureid = explode('pcdid',$currenturl);
        $procedureid = $procedureid[1];
        $data = Procedures_To_Process::where('procedure_id',$procedureid)->paginate(100000);
      }
      else
      {
        $data = Procedures_To_Process::paginate(30);
      }
        $process = Process::all();
        $procedure = Procedures::all();
        $proceduretoprocess = Procedures_To_Process::all();
        return view('system-mgmt/procedures-to-process/index', ['proceduretoprocess' => $proceduretoprocess,'process' => $process,'procedure' => $procedure,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $process = Process::all();
      $procedure = Procedures::all();
      $proceduretoprocess = Procedures_To_Process::all();

        return view( 'system-mgmt/procedures-to-process/create',compact(['proceduretoprocess','process','procedure']));
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
         Procedures_To_Process::create([
            'name' => $request['name'],
            'process_id' => $request['process_id'],
            'next_procedure_to_process' => $request['next_procedure_to_process'],
            'procedure_id' => $request['procedure_id'],
            'start_process_flag' => $request['start_process_flag'],
            'end_process_flag' => $request['end_process_flag'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/procedures-to-process');
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
      return view( 'system-mgmt/procedures-to-process/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $proceduretoprocess = Procedures_To_Process::all();
            $process = Process::all();
            $procedure = Procedures::all();
        $data = Procedures_To_Process::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Procedures_To_Process::find($id);

            return redirect ('/admin/procedures-to-process');
        }

        return view( 'system-mgmt/procedures-to-process/edit', ['proceduretoprocess' => $proceduretoprocess,'process' => $process,'procedure' => $procedure,'data' => $data]);
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
          'process_id' => $request['process_id'],
          'next_procedure_to_process' => $request['next_procedure_to_process'],
          'procedure_id' => $request['procedure_id'],
          'start_process_flag' => $request['start_process_flag'],
          'end_process_flag' => $request['end_process_flag'],
          'description' => $request['description']
        ];
        Procedures_To_Process::where('id', $id)
            ->update($input);

        return redirect ('/admin/procedures-to-process');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Procedures_To_Process::where('id', $id)->delete();
         return redirect ('/admin/procedures-to-process');
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
            $process = Process::all();
            $procedure = Procedures::all();
            $proceduretoprocess = Procedures_To_Process::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/procedures-to-process/index', ['proceduretoprocess' => $proceduretoprocess,'procedure' => $procedure,'process' => $process,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Procedures_To_Process::query();
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
