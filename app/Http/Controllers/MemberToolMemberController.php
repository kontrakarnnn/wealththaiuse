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
use App\MemberTool;
use App\Person;
use App\Member_Tool_Status;
use App\ToolCategory;
use App\MemberAssignTool;
use App\Http\Controllers\DataMemberController;
class MemberToolMemberController extends Controller
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
	
      $current = Auth::guard('person')->user()->id;
      $member = Person::get();
      $tool = Tool::with(['ToolType','User'])->get();
      $membertoolstatus = Member_Tool_Status::get();
      $data = MemberTool::with(['Tool','Member_Tool_Status','Person'])->where('member_id',$current)->paginate(30);
      //return $data;
        return view('system-mgmt/mytool/index', ['current' => $current,'member' => $member,'membertoolstatus' => $membertoolstatus,'tool' => $tool,'data' => $data]);
    }
    public function show($id)
    {
      $membertoolcheckinarray = new DataMemberController();
      $membertoolcheckinarray = $membertoolcheckinarray->membertoolcheckinarray();
      if(in_array($id,$membertoolcheckinarray))
      {
        $membertool = MemberTool::where('id',$id)->value('id');
        $portfolio = MemberAssignTool::with('Portfolio','MemberTool')->where('member_tool_id',$id)->get();
      return view('system-mgmt/mytool/configport',['portfolio'=>$portfolio]);

    }
    return view('error');



    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $member = Person::get();
        $tool = Tool::with(['ToolType','User'])->get();
        $membertoolstatus = Member_Tool_Status::get();
        return view( 'system-mgmt/member-tool/create',compact('member','tool','membertoolstatus'));
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
         MemberTool::create([
            'member_id' => $request['member_id'],
            'tool_id' => $request['tool_id'],
            'member_tool_status' => $request['member_tool_status'],
            'limit_number_of_port' => $request['limit_number_of_port'],
            'register_key' => $request['register_key'],
            'valid_from' => $request['valid_from'],
            'valid_to' => $request['valid_to'],
            'description' => $request['description'],

        ]);
        return redirect ('/member-tool');
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
      $member = Person::get();
      $tool = Tool::with(['ToolType','User'])->get();
      $membertoolstatus = Member_Tool_Status::get();
      $data = MemberTool::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = MemberTool::find($id);

            return redirect ('/member-tool');
        }
        return view( 'system-mgmt/member-tool/edit', ['member' => $member,'membertoolstatus' => $membertoolstatus,'tool' => $tool,'data' => $data]);
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
          'member_id' => $request['member_id'],
          'tool_id' => $request['tool_id'],
          'member_tool_status' => $request['member_tool_status'],
          'limit_number_of_port' => $request['limit_number_of_port'],
          //'register_key' => $request['register_key'],
          'valid_from' => $request['valid_from'],
          'valid_to' => $request['valid_to'],
          'description' => $request['description'],

        ];
        MemberTool::where('id', $id)
            ->update($input);

        return redirect ('/member-tool');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MemberTool::where('id', $id)->delete();
         return redirect ('/member-tool');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'tool_id' => $request['tool_id'],
            'member_id' => $request['member_id'],
            'member_tool_status' => $request['member_tool_status'],
            'valid_from' => $request['valid_from'],
            'valid_to' => $request['valid_to'],
            //'tool_type.cat_id' => $request['cat_id'],
            ];

       $data = $this->doSearchingQuery($constraints);
       $member = Person::get();
       $tool = Tool::with(['ToolType','User'])->get();
       $membertoolstatus = Member_Tool_Status::get();

       return view( 'system-mgmt/member-tool/index', ['membertoolstatus' => $membertoolstatus,'member' => $member,'tool' => $tool,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = MemberTool::with(['Tool','Member_Tool_Status','Person']);
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
