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
use App\Tool;
use App\Member_Tool_Status;
use App\Term_Of_Payment;
use App\ToolSet;
use App\ToolCategory;
use App\Http\Controllers\SidebarController;
class ToolSetController extends Controller
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
    public function index(Request $request)
    {
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('/',$url);
      $url = $url[2];
      $urlpath = $request->path();
      $toolcat = ToolCategory::all();
      $tooltype = ToolType::with(['ToolCategory'])->get();
      $tool = Tool::with(['ToolType','User'])->where('id',$url)->get();
      $data = ToolSet::with(['Tool','Term_Of_Payment','Member_Tool_Status'])->where('tool_id',$url)->orderBy('created_at','DESC')->paginate(30);
        //return $data;
        return view('system-mgmt/toolset/index', ['urlpath' => $urlpath,'tool' => $tool,'toolcat' => $toolcat,'tooltype' => $tooltype,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('?',$url);
      $fromtool = 0;

      $tool = Tool::with(['ToolType','User'])->get();
      $membertoolstatus = Member_Tool_Status::get();
      $termofpayment = Term_Of_Payment::get();
      if(count($url) > 1)
      {
      $fromtool = 1;
      $url = explode('/',$url[1]);
      $url = $url[1];
      $tool = Tool::with(['ToolType','User'])->where('id',$url)->get();
      }
        return view( 'system-mgmt/toolset/create',compact('fromtool','tool','membertoolstatus','termofpayment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current = Auth::user()->id;
        date_default_timezone_set('Asia/Bangkok');
        $currentdate = date('d/m/Y');
        $this->validateInput($request);
         ToolSet::create([
            'name' => $request['name'],
            'tool_id' => $request['tool_id'],
            'limit_number_port' => $request['limit_number_port'],
            'default_tool_status' => $request['default_tool_status'],
            'term_of_payment' => $request['term_of_payment'],
            'valid_period' => $request['valid_period'],
            'initial_free' => $request['initial_free'],
            'period_fee' => $request['period_fee'],
            'exit_fee' => $request['exit_fee'],


        ]);
        $url = url()->previous();
        $url = explode('?',$url);
        $fromtool = 0;
        if(count($url) > 1)
        {
        $fromtool = 1;
        $url = $url[1];
        return redirect($url);
        }
        return redirect ('/toolset');
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
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('?',$url);
      $fromtool = 0;

      if(count($url) > 1)
      {
      $fromtool = 1;
      }

      $membertoolstatus = Member_Tool_Status::get();
      $termofpayment = Term_Of_Payment::get();
      $tool = Tool::with(['ToolType','User'])->get();
      $data = ToolSet::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = ToolSet::find($id);
            return redirect ('/admin/toolset');
        }
        return view( 'system-mgmt/toolset/edit', ['fromtool'=>$fromtool,'termofpayment' => $termofpayment,'membertoolstatus' => $membertoolstatus,'tool' => $tool,'data' => $data]);
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
          //'tool_id' => $request['tool_id'],
          'limit_number_port' => $request['limit_number_port'],
          'default_tool_status' => $request['default_tool_status'],
          'term_of_payment' => $request['term_of_payment'],
          'valid_period' => $request['valid_period'],
          'initial_free' => $request['initial_free'],
          'period_fee' => $request['period_fee'],
          'exit_fee' => $request['exit_fee'],
        ];
        ToolSet::where('id', $id)
            ->update($input);
            $url = url()->previous();
            $url = explode('?',$url);
            $fromtool = 0;
            if(count($url) > 1)
            {
            $fromtool = 1;
            $url = $url[1];
            return redirect($url);
            }
        return redirect ('/toolset');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ToolSet::where('id', $id)->delete();
         return redirect ('/admin/toolset');
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
            'tool_type' => $request['tool_type'],
            //'tool_type.cat_id' => $request['cat_id'],
            ];

       $data = $this->doSearchingQuery($constraints);
       /*$constraints['name'] = $request['name'];
       $constraints['tool_type'] = $request['tool_type'];
       $constraints['cat_id'] = $request['cat_id'];*/
       $tooltype = ToolType::all();
       $toolcat = ToolCategory::all();


       return view( 'system-mgmt//tool/index', ['toolcat' => $toolcat,'tooltype' => $tooltype,'data' => $data, 'searchingVals' => $constraints]);
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
        'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
