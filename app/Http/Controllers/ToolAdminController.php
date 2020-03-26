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
use App\ToolCategory;
use App\ToolStatus;
use Image;
use Storage;

use App\Http\Controllers\SidebarController;
class ToolAdminController extends Controller
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
      $toolpromotecount = Tool::with(['ToolType','User'])->where('promote',1)->count();
    //  return $toolpromotecount;
        $toolcat = ToolCategory::all();
        $tooltype = ToolType::with(['ToolCategory'])->get();
        $data = Tool::with(['ToolType','User'])->paginate(30);
        return view('system-mgmt/tooladmin/index', ['toolcat' => $toolcat,'tooltype' => $tooltype,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $toolstatus = ToolStatus::get();
        $toolpromotecount = Tool::with(['ToolType','User'])->where('promote',1)->count();
        $tooltype = ToolType::with(['ToolCategory'])->get();
        return view( 'system-mgmt/tooladmin/create',compact('toolstatus','tooltype','toolpromotecount'));
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
        $this->validate($request, [
          'limit_assign' => 'numeric',
         // 'broker_id' => 'numeric',
        ],
        [
          'limit_assign.numeric' => 'ต้องเป็นตัวเลขเท่านั้น',
          //'broker_id.numeric' => 'ต้องเป็นตัวเลขเท่านั้น',
        ]
        );
        $tool = New Tool;
        $tool->name = $request->name;
        $tool->tool_type = $request->tool_type;
        $tool->created_by = $current;
        $tool->tool_ref_product_id = $request->tool_ref_product_id;
        $tool->tool_info_link = $request->tool_info_link;
        $tool->last_version = $request->last_version;
        $tool->published_date = $currentdate;
        $tool->description = $request->description;
        $tool->promote = $request->promote;
        $tool->top_hit = $request->top_hit;
        $tool->star = $request->star;
        $tool->broker_id = $request->broker_id;
        $tool->tool_status = $request->tool_status;
        $tool->limit_assign = $request->limit_assign;
        $tool->match_broker = $request->match_broker;

        if($request->file('attachment')){
          //return 'meme';
          $filename = $request->file('attachment')->getClientOriginalName();
          $image_thumb = Image::make($request->file('attachment'))->resize(362, 200)->stream();
          $uploaded = Storage::disk('tooldisk')->put($filename, $image_thumb);
          $tool->attachment = $filename;
        }
        $tool->save();
        return redirect ('/admin/tooladmin');
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
      $toolstatus = ToolStatus::get();
      $toolpromotecount = Tool::with(['ToolType','User'])->where('promote',1)->count();
      $tooltype = ToolType::with(['ToolCategory'])->get();
      $data = Tool::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Tool::find($id);

            return redirect ('/admin/tooladmin');
        }
        return view( 'system-mgmt/tooladmin/edit', ['toolpromotecount' => $toolpromotecount,'toolstatus' => $toolstatus,'tooltype' => $tooltype,'data' => $data]);
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
      /*$filepath = File::where('id',$id)->value('physical_path');
     // return $filepath;
      Storage::delete($filepath);

        File::where('id', $id)->delete();*/
        $this->validate($request, [
          'limit_assign' => 'numeric',
          //'broker_id' => 'numeric',
        ],
        [
          'limit_assign.numeric' => 'ต้องเป็นตัวเลขเท่านั้น',
        //  'broker_id.numeric' => 'ต้องเป็นตัวเลขเท่านั้น',
        ]
        );
            $tool = Tool::find($id);
            $tool->name = $request->name;
            $tool->tool_type = $request->tool_type;
            $tool->tool_ref_product_id = $request->tool_ref_product_id;
            $tool->tool_info_link = $request->tool_info_link;
            $tool->last_version = $request->last_version;
            $tool->published_date = $request->published_date;
            $tool->description = $request->description;
            $tool->promote = $request->promote;
            $tool->top_hit = $request->top_hit;
            $tool->star = $request->star;
            $tool->broker_id = $request->broker_id;
            $tool->tool_status = $request->tool_status;
            $tool->limit_assign = $request->limit_assign;
            $tool->match_broker = $request->match_broker;


            if($request->file('attachment')){
              //return 'meme';
              $filepath = Tool::where('id',$id)->value('attachment');
              $uploaded = Storage::disk('tooldisk')->delete($filepath);
              $filename = $request->file('attachment')->getClientOriginalName();
              $image_thumb = Image::make($request->file('attachment'))->resize(362, 200)->stream();
              $uploaded = Storage::disk('tooldisk')->put($filename, $image_thumb);
              $tool->attachment = $filename;
            }
            $tool->save();
        return redirect ('/admin/tooladmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $filepath = Tool::where('id',$id)->value('attachment');
      $uploaded = Storage::disk('tooldisk')->delete($filepath);
        Tool::where('id', $id)->delete();
         return redirect ('/admin/tooladmin');
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


       return view( 'system-mgmt/tooladmin/index', ['toolcat' => $toolcat,'tooltype' => $tooltype,'data' => $data, 'searchingVals' => $constraints]);
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
        'limit_port' => 'numeric'
    ]);
    }
}
