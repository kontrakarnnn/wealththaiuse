<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\Viewper;
use App\Asset_cat;
use App\ToolType;
use App\Tool;
use App\ToolCategory;
use App\ToolPackage;
use App\ToolSet;
use App\Http\Controllers\SidebarController;
class ToolMemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('viewper');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $toolcat = ToolCategory::all();
        $toolpackagemain = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->where('main_page',1)->get();
        $toolpackage = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->get();
        $tooltype = ToolType::with(['ToolCategory'])->get();
        $toolpromote = Tool::with(['ToolType','User'])->where('promote',1)->get();
        $tooltophit = Tool::with(['ToolType','User'])->where('top_hit',1)->get();
        $data = Tool::with(['ToolType','User'])->get();
        return view('system-mgmt/toolmember/index', ['toolpromote' => $toolpromote,'tooltophit' => $tooltophit,'toolpackagemain' => $toolpackagemain,'toolpackage' => $toolpackage,'toolcat' => $toolcat,'tooltype' => $tooltype,'data' => $data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tooltype = ToolType::with(['ToolCategory'])->get();
        return view( 'system-mgmt//tool/create',compact('tooltype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $toolset = $request->tool_id;
        $data = ToolSet::with(['Tool','Term_Of_Payment','Member_Tool_Status'])->where('id',$toolset)->get();
        //return $data;
        return view ('/system-mgmt/toolsetmember/confirm',compact(['data']));
    }
    public function storepackage(Request $request)
    {
        $toolset = $request->tool_package;

        $data = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->where('id',$toolset)->get();
        //return $data;
        return view ('/system-mgmt/toolsetmember/confirmpackage',compact(['data']));
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
      return view( 'system-mgmt/tool/index', compact(['structures','blocks','tree']));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $tooltype = ToolType::with(['ToolCategory'])->get();
      $data = Tool::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Tool::find($id);

            return redirect ('/tool');
        }
        return view( 'system-mgmt//tool/edit', ['tooltype' => $tooltype,'data' => $data]);
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
      date_default_timezone_set('Asia/Bangkok');
      $currentdate = date('d/m/Y');
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'tool_type' => $request['tool_type'],
          'tool_ref_product_id' => $request['tool_ref_product_id'],
          'tool_info_link' => $request['tool_info_link'],
          'last_version' => $request['last_version'],
          'published_date' => $request['published_date'],
          'update_date' => $currentdate,
          'description' => $request['description'],
        ];
        Tool::where('id', $id)
            ->update($input);

        return redirect ('/tool');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tool::where('id', $id)->delete();
         return redirect ('/tool');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
      $toolcat = ToolCategory::all();
      $toolpackagemain = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->where('main_page',1)->get();
      $toolpackage = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->get();
      $tooltype = ToolType::with(['ToolCategory'])->get();
      $toolpromote = Tool::with(['ToolType','User'])->where('promote',1)->get();
      $tooltophit = Tool::with(['ToolType','User'])->where('top_hit',1)->get();
        $constraints = [
            'name' => $request['name'],
            'tool_type' => $request['tool_type'],
            //'tool_type.cat_id' => $request['cat_id'],
            ];

       $data = $this->doSearchingQuery($constraints);
       /*$constraints['name'] = $request['name'];
       $constraints['tool_type'] = $request['tool_type'];
       $constraints['cat_id'] = $request['cat_id'];*/
       $tooltype = ToolType::all();
       $toolcat = ToolCategory::all();

       return view( 'system-mgmt/toolmember/search', ['toolpromote' => $toolpromote,'tooltophit' => $tooltophit,'toolpackagemain' => $toolpackagemain,'toolpackage' => $toolpackage,'toolcat' => $toolcat,'tooltype' => $tooltype,'data' => $data, 'searchingVals' => $constraints]);
    }
    private function doSearchingQuery($constraints) {
        $query = Tool::with(['ToolType','User']);
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
