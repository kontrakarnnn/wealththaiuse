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
use App\Path;
use App\Http\Controllers\SidebarController;
class PathController extends Controller
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
        $data = Path::paginate(30);
        //return data;
        $stage = Stage::all();

        return view('system-mgmt/path/index', ['stage' => $stage,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $stage = Stage::all();
        return view( 'system-mgmt/path/create',compact(['stage']));
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
         Path::create([
           'name' => $request['name'],
           'from_stage' => $request['from_stage'],
           'to_stage' => $request['to_stage'],
           'path_connection' => $request['path_connection'],
           'path_priority' => $request['path_priority'],
           'description' => $request['description']
        ]);
        return redirect ('/admin/path');
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
        $data = Path::find($id);
        $stage = Stage::all();


        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Path::find($id);

            return redirect ('/admin/path');
        }

        return view( 'system-mgmt/path/edit', ['stage' => $stage,'data' => $data]);
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
        $structure = Path::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'from_stage' => $request['from_stage'],
          'to_stage' => $request['to_stage'],
          'path_connection' => $request['path_connection'],
          'path_priority' => $request['path_priority'],
          'description' => $request['description']
        ];
        Path::where('id', $id)
            ->update($input);

        return redirect ('/admin/path');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Path::where('id', $id)->delete();
         return redirect ('/admin/path');
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
          'path_connection' => $request['path_connection'],
          'path_priority' => $request['path_priority'],
          'description' => $request['description'],
          'from_stage' => $request['from_stage'],
          'to_stage' => $request['to_stage'],
            ];
       $stage = Stage::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/path/index', ['stage' => $stage,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Path::query();
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
