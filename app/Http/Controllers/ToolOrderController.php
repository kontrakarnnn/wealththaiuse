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
use App\Tool_Order;
use App\ToolCategory;
use App\Tool_Order_Status;
use App\Person;
use App\ToolPackage;
use App\MemberTool;
use App\ToolSet;
use App\Tool;
use App\Portfolio;
use App\Http\Controllers\SidebarController;
class ToolOrderController extends Controller
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
        $member = Person::all();
        $tool = Tool::all();
        $toolset = ToolSet::all();
        $toolpackage = ToolPackage::all();
        $toolorderstatus =Tool_Order_Status::all();
        $data = Tool_Order::with(['User','Person','ToolSet','ToolPackage','Tool_Order_Status'])->paginate(30);
        return view('system-mgmt/tool-order/index', ['data' => $data,'member' => $member,'toolset' => $toolset,'toolpackage' => $toolpackage,'toolorderstatus' => $toolorderstatus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $member = Person::all();
      $tool = Tool::all();
      $toolset = ToolSet::all();
      $toolpackage = ToolPackage::all();
      $toolorderstatus =Tool_Order_Status::all();
      $url = $_SERVER['REQUEST_URI'];
      //return $url;
      $portfolio =Portfolio::where('member_id',0)->get();
      if ( strstr($url, '?') ) {
        $url = explode('?',$url);
        $url = $url[1];
        //return $url;
        $member = Person::where('id',$url)->get();
        $members = Person::where('id',$url)->value('id');
        $portfolio = Portfolio::with(['Port_type'])->where('member_id',$members)->get();
      }
        return view( 'system-mgmt/tool-order/create',['portfolio' => $portfolio,'tool' => $tool,'tool' => $tool,'member' => $member,'toolset' => $toolset,'toolpackage' => $toolpackage,'toolorderstatus' => $toolorderstatus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function changeorderstatus(Request $request){
	   $current = Auth::user()->id;
       $url = $_SERVER['REQUEST_URI'];
       $url = explode('/',$url);
       $status = Tool_Order::find($url[3]);
       $status->order_status = $url[4];
	   $status->modified_by = $current;
       $status->save();
       //return $lead->status;
       //return $url[3];
       //return 'yes';
      $request->session()->flash('alert-success', 'เปลี่ยนข้อมูลเรียบร้อย');
      if($status->order_status ==2)
      {
        $a1 = mt_rand(1,9);
        $a2 = mt_rand(1,9);
        $a3 = mt_rand(1,9);
        $a4 = mt_rand(1,9);
        $a5 = mt_rand(1,9);
        $a6 = mt_rand(1,9);
        $a7 = mt_rand(1,9);
        $a8 = mt_rand(1,9);
        $a9 = mt_rand(1,9);
        $a10 = mt_rand(1,9);
        $a11 = mt_rand(1,9);
        $a12 = mt_rand(1,9);

      $find = Tool_Order::find($url[3]);
      $findtool = ToolSet::find($find->tool_set_id);
      $currentdate = date('d/m/Y');
      $currenttime = date('H:i:s');
      $valid_to = "+".$findtool->valid_period."days";
      $valid_to =  date('d/m/Y', strtotime($valid_to));
      $end_contract = "+".$findtool->contract_period."days";
      $end_contract =  date('d/m/Y', strtotime($end_contract));
      $membertool = new MemberTool;
      $membertool->member_id = $find->member_id;
      $membertool->tool_id = $findtool->tool_id;
      $membertool->member_tool_status = $findtool->default_tool_status;
      $membertool->limit_number_of_port = $findtool->limit_number_port;
      $membertool->valid_from =$find->order_create_date;
      $membertool->register_key = $a1.$a2.$a3.$a4.$a5.$a6.$a7.$a8.$a9.$a10.$a11.$a12;
      $membertool->valid_to =$valid_to;
      $membertool->end_contract =$end_contract;
      if($status->tool_package_id !=NULL)
      {
        $toolpackage = ToolPackage::find($status->tool_package_id );
        $packagevalid_to = "+".$toolpackage->valid_period."days";
        $packagevalid_to =  date('d/m/Y', strtotime($packagevalid_to));
        $packageend_contract = "+".$toolpackage->contract_period."days";
        $packageend_contract =  date('d/m/Y', strtotime($packageend_contract));
        $membertool->member_tool_status = $toolpackage->default_tool_status;
        $membertool->limit_number_of_port = $toolpackage->limit_number_port;
        $membertool->valid_to =$packagevalid_to;
        $membertool->end_contract =$packageend_contract;
      }
      $membertool->save();
    }
       return redirect('/admin/tool-order');
     }
    public function store(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $current = Auth::user()->id;
      if ( strstr($request->member_id, '?') ) {
      $memberid = $request->member_id;
      $memberid = explode('?',$memberid);
      $memberid = $memberid[1];
    }

      $a1 = mt_rand(1,9);
      $a2 = mt_rand(1,9);
      $a3 = mt_rand(1,9);
      $a4 = mt_rand(1,9);
      $a5 = mt_rand(1,9);
      $a6 = mt_rand(1,9);
      $a7 = mt_rand(1,9);
      $a8 = mt_rand(1,9);
      $a9 = mt_rand(1,9);
      $a10 = mt_rand(1,9);
      $a11 = mt_rand(1,9);
      $a12 = mt_rand(1,9);

      $currentdate = date('d/m/Y');
      //$currenttime = date('H:i:s');
        $this->validateInput($request);
        $find = Tool_Order::create([
            'member_id' => $memberid,
            'order_create_date' => $currentdate,
            'tool_set_id' => $request['tool_set_id'],
            'tool_package_id' => $request['tool_package_id'],
            'initial_fee' => $request['initial_fee'],
            'period_fee' => $request['period_fee'],
            'exit_fee' => $request['exit_fee'],
            'initial_deal_date' => $request['initial_deal_date'],
            'next_period_deal_date' => $request['next_period_deal_date'],
            'order_status' => $request['order_status'],
            'description' => $request['description'],
            'invoice_number' => $request['invoice_number'],
            'modified_by' => $current,
        ]);

        $findtool = ToolSet::find($find->tool_set_id);
        $currentdate = date('d/m/Y');
        $currenttime = date('H:i:s');
        $valid_to = "+".$findtool->valid_period."days";
        $valid_to =  date('d/m/Y', strtotime($valid_to));
        $end_contract = "+".$findtool->contract_period."days";
        $end_contract =  date('d/m/Y', strtotime($end_contract));
        $membertool = new MemberTool;
        $membertool->member_id = $find->member_id;
        $membertool->tool_id = $findtool->tool_id;
        $membertool->member_tool_status = $findtool->default_tool_status;
        $membertool->limit_number_of_port = $findtool->limit_number_port;
        $membertool->valid_from =$find->order_create_date;
        $membertool->register_key = $a1.$a2.$a3.$a4.$a5.$a6.$a7.$a8.$a9.$a10.$a11.$a12;
        $membertool->valid_to =$valid_to;
        $membertool->end_contract =$end_contract;

        $status = Tool_Order::find($find->id);
        $status->order_status = 2;
 	      $status->modified_by = $current;
        $status->save();


        if($status->tool_package_id !=NULL)
        {
          $toolpackage = ToolPackage::find($status->tool_package_id );
          $packagevalid_to = "+".$toolpackage->valid_period."days";
          $packagevalid_to =  date('d/m/Y', strtotime($packagevalid_to));
          $packageend_contract = "+".$toolpackage->contract_period."days";
          $packageend_contract =  date('d/m/Y', strtotime($packageend_contract));
          $membertool->member_tool_status = $toolpackage->default_tool_status;
          $membertool->limit_number_of_port = $toolpackage->limit_number_port;
          $membertool->valid_to =$packagevalid_to;
          $membertool->end_contract =$packageend_contract;
        }
        $membertool->save();
        $assignport = New MemberAssignTool;
        $assignport->member_tool_id = $membertool->id;
        $assignport->port_id = $request->port_id;
        $assignport->save();
        return redirect ('/admin/tool-order');
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

     public function invoice($id)
     {

       $data = Tool_Order::with(['Person','ToolSet','ToolPackage','Tool_Order_Status'])->find($id);
         return view( 'system-mgmt/tool-order/invoice',compact(['data']));
     }


    public function edit($id)
    {
      $member = Person::all();
      $toolset = ToolSet::all();
      $toolpackage = ToolPackage::all();
      $toolorderstatus =Tool_Order_Status::all();
        $data = Tool_Order::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Tool_Order::find($id);

            return redirect ('/admin/tool-order');
        }

        return view( 'system-mgmt/tool-order/edit', ['data' => $data,'member' => $member,'toolset' => $toolset,'toolpackage' => $toolpackage,'toolorderstatus' => $toolorderstatus]);
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
        $structure = Tool_Order::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'member_id' => $request['member_id'],
          'order_create_date' => $request['order_create_date'],
          'tool_set_id' => $request['tool_set_id'],
          'tool_package_id' => $request['tool_package_id'],
          'initial_fee' => $request['initial_fee'],
          'period_fee' => $request['period_fee'],
          'exit_fee' => $request['exit_fee'],
          'initial_deal_date' => $request['initial_deal_date'],
          'next_period_deal_date' => $request['next_period_deal_date'],
          'order_status' => $request['order_status'],
          'description' => $request['description'],
          'invoice_number' => $request['invoice_number'],

        ];
        Tool_Order::where('id', $id)
            ->update($input);

        return redirect ('/admin/tool-order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tool_Order::where('id', $id)->delete();
         return redirect ('/admin/tool-order');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'invoice_number' => $request['invoice_number'],
            'member_id' => $request['member_id'],
            'tool_set_id' => $request['tool_set_id'],
            'tool_package_id' => $request['tool_package_id'],
            'order_status' => $request['order_status'],
            'order_create_date' => $request['order_create_date'],
            ];
            $member = Person::all();
            $toolset = ToolSet::all();
            $toolpackage = ToolPackage::all();
            $toolorderstatus =Tool_Order_Status::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/tool-order/index', ['data' => $data, 'searchingVals' => $constraints,'member' => $member,'toolset' => $toolset,'toolpackage' => $toolpackage,'toolorderstatus' => $toolorderstatus]);
    }

    private function doSearchingQuery($constraints) {
        $query = Tool_Order::query();
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
            'invoice_number' => 'required|unique:tool_order',
    ]);
    }
}
