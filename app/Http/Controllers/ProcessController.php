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
use App\Procedures_To_Process;
use App\Stage;
use App\Http\Controllers\SidebarController;
class ProcessController extends Controller
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
      if ( strstr($currenturl, 'procdid') )
      {
        $procedureid = explode('procdid',$currenturl);
        $procedureid = $procedureid[1];
        $data = Process::where('id',$procedureid)->paginate(100000);
      }
      else
      {
        $data = Process::paginate(30);
      }
        //return data;
        $stage = Stage::all();
        $structures = Asset_cat::paginate(30);
        return view('system-mgmt/process/index', ['stage' => $stage,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $stage = Stage::all();

        return view( 'system-mgmt/process/create',compact(['stage']));
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
         Process::create([
           'name' => $request['name'],
           'start_stage' => $request['start_stage'],
           'description' => $request['description']
        ]);
        return redirect ('/admin/process');
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
      return view( 'system-mgmt/process/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Process::find($id);
        $stage = Stage::all();

        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Process::find($id);

            return redirect ('/admin/process');
        }

        return view( 'system-mgmt/process/edit', ['stage' => $stage,'data' => $data]);
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
        $structure = Process::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'start_stage' => $request['start_stage'],
          'description' => $request['description']
        ];
        Process::where('id', $id)
            ->update($input);

        return redirect ('/admin/process');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Process::where('id', $id)->delete();
         return redirect ('/admin/process');
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
       $stage = Stage::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/process/index', ['stage' => $stage,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Process::query();
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
