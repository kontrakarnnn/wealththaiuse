<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\ToolType;
use App\ToolCategory;
use App\Http\Controllers\SidebarController;
class ToolTypeController extends Controller
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
      $toolcat = ToolCategory::all();
        $data = ToolType::with(['ToolCategory'])->paginate(30);
        //return $data;
        return view('system-mgmt/tool-type/index', ['toolcat' => $toolcat,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $toolcat = ToolCategory::all();
        return view( 'system-mgmt/tool-type/create',compact('toolcat'));
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
         ToolType::create([
            'name' => $request['name'],
            'cat_id' => $request['cat_id'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/tool-type');
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
      return view( 'system-mgmt/tool-type/index', compact(['structures','blocks','tree']));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $toolcat = ToolCategory::all();
        $data = ToolType::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = ToolType::find($id);

            return redirect ('/admin/tool-type');
        }

        return view( 'system-mgmt/tool-type/edit', ['toolcat' => $toolcat,'data' => $data]);
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
        $structure = ToolCategory::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'cat_id' => $request['cat_id'],
            'description' => $request['description']
        ];
        ToolType::where('id', $id)
            ->update($input);

        return redirect ('/admin/tool-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ToolType::where('id', $id)->delete();
         return redirect ('/admin/tool-type');
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
            'cat_id' => $request['cat_id'],
            ];

       $data = $this->doSearchingQuery($constraints);
       $toolcat = ToolCategory::all();

       return view( 'system-mgmt/tool-type/index', ['toolcat' => $toolcat,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = ToolType::query();
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
