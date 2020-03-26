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
use App\ToolPackage;
use App\ToolCategory;
use Image;
use Storage;
use App\Http\Controllers\SidebarController;
class ToolPackageAdminController extends Controller
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
        $tooltype = ToolType::with(['ToolCategory'])->get();
        $tool = Tool::with(['ToolType','User'])->get();
        $data = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->paginate(30);
        //return $data;
        return view('system-mgmt/toolpackageadmin/index', ['tool' => $tool,'toolcat' => $toolcat,'tooltype' => $tooltype,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $membertoolstatus = Member_Tool_Status::get();
      $termofpayment = Term_Of_Payment::get();
      $mainpage = ToolPackage::where('main_page',1)->count();
        return view( 'system-mgmt/toolpackageadmin/create',compact('mainpage','membertoolstatus','termofpayment'));
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

        $toolpackage = New ToolPackage;
        $toolpackage->name = $request->name;
        $toolpackage->limit_number_port = $request->limit_number_port;
        $toolpackage->default_tool_status = $request->default_tool_status;
        $toolpackage->term_of_payment = $request->term_of_payment;
        $toolpackage->valid_period = $request->valid_period;
        $toolpackage->initial_free = $request->initial_free;
        $toolpackage->period_fee = $request->period_fee;
        $toolpackage->exit_fee = $request->exit_fee;
        $toolpackage->main_page = $request->main_page;
        $toolpackage->description = $request->description;
        if($request->file('attachment')){
          //return 'meme';
          $filename = $request->file('attachment')->getClientOriginalName();
          $image_thumb = Image::make($request->file('attachment'))->resize(970, 250)->stream();
          $uploaded = Storage::disk('toolpackagedisk')->put($filename, $image_thumb);
          $toolpackage->attachment = $filename;
        }
        $toolpackage->save();
        return redirect ('/admin/toolpackageadmin');
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
      $membertoolstatus = Member_Tool_Status::get();
      $termofpayment = Term_Of_Payment::get();
      $tool = Tool::with(['ToolType','User'])->get();
      $mainpage = ToolPackage::where('main_page',1)->count();
      $data = ToolPackage::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = ToolPackage::find($id);
            return redirect ('/admin/toolpackageadmin');
        }
        return view( 'system-mgmt/toolpackageadmin/edit', ['mainpage' => $mainpage,'termofpayment' => $termofpayment,'membertoolstatus' => $membertoolstatus,'tool' => $tool,'data' => $data]);
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
        $toolpackage = ToolPackage::find($id);
        $toolpackage->name = $request->name;
        $toolpackage->limit_number_port = $request->limit_number_port;
        $toolpackage->default_tool_status = $request->default_tool_status;
        $toolpackage->term_of_payment = $request->term_of_payment;
        $toolpackage->valid_period = $request->valid_period;
        $toolpackage->initial_free = $request->initial_free;
        $toolpackage->period_fee = $request->period_fee;
        $toolpackage->exit_fee = $request->exit_fee;
        $toolpackage->main_page = $request->main_page;
        $toolpackage->description = $request->description;
        if($request->file('attachment')){
          //return 'meme';
          $filepath = ToolPackage::where('id',$id)->value('attachment');
          $uploaded = Storage::disk('toolpackagedisk')->delete($filepath);
          $filename = $request->file('attachment')->getClientOriginalName();
          $image_thumb = Image::make($request->file('attachment'))->resize(970, 250)->stream();
          $uploaded = Storage::disk('toolpackagedisk')->put($filename, $image_thumb);
          $toolpackage->attachment = $filename;
        }
        $toolpackage->save();

        return redirect ('/admin/toolpackageadmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $filepath = ToolPackage::where('id',$id)->value('attachment');
      $uploaded = Storage::disk('toolpackagedisk')->delete($filepath);
        ToolPackage::where('id', $id)->delete();
         return redirect ('/admin/toolpackageadmin');
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

            //'tool_type.cat_id' => $request['cat_id'],
            ];

       $data = $this->doSearchingQuery($constraints);
       /*$constraints['name'] = $request['name'];
       $constraints['tool_type'] = $request['tool_type'];
       $constraints['cat_id'] = $request['cat_id'];*/
       $tooltype = ToolType::all();
       $toolcat = ToolCategory::all();


       return view( 'system-mgmt/toolpackageadmin/index', ['toolcat' => $toolcat,'tooltype' => $tooltype,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status']);
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
//        'main_page' => 'unique:tool_package'
    ]);
    }
}
