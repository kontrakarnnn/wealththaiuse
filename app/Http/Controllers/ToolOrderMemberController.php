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
use App\Tool_Package_To_Set;
use App\ToolSet;
use App\Http\Controllers\SidebarController;
class ToolOrderMemberController extends Controller
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

        $data = Tool_Order::with(['Person','ToolSet','ToolPackage','Tool_Order_Status'])->where('member_id',$current)->paginate(30);
        return view('system-mgmt/tool-order-member/index', ['data' => $data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $member = Person::all();
      $toolset = ToolSet::all();
      $toolpackage = ToolPackage::all();
      $toolorderstatus =Tool_Order_Status::all();
        return view( 'system-mgmt/tool-order/create', ['member' => $member,'toolset' => $toolset,'toolpackage' => $toolpackage,'toolorderstatus' => $toolorderstatus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function storepackage(Request $request)
     {
       //return $request->tool_set_id;

       $current = Auth::guard('person')->user()->id;
       $toolpackage = ToolPackage::find($request->tool_package);
       $toolpackageset = Tool_Package_To_Set::where('tool_package',$toolpackage->id)->pluck('tool_set')->toArray();
       $toolset = ToolSet::whereIn('id',$toolpackageset)->get();
       foreach($toolset as $set)
       {
         date_default_timezone_set('Asia/Bangkok');
         $currentdate = date('d/m/Y');
         $currenttime = date('H:i:s');
         $next_period_deal_date = "+".$toolpackage->valid_period."days";
       $next_period_deal_date =  date('d/m/Y', strtotime($next_period_deal_date));
            Tool_Order::create([
               'member_id' => $current,
               'order_create_date' => $currentdate,
               'tool_set_id' => $set->id,
               'tool_package_id' => $toolpackage->id,
               'initial_fee' =>$toolpackage->initial_free,
               'period_fee' => $toolpackage->period_fee,
               'exit_fee' => $toolpackage->exit_fee,
               'initial_deal_date' => $currentdate,
               'next_period_deal_date' => $next_period_deal_date,
               'order_status' => 1,
               'description' => $request['description'],
               'invoice_number' => $request['invoice_number'],
           ]);
       }
       //return $toolset;
         return redirect ('/toolordermember');
     }

    public function store(Request $request)
    {

      //return $request->tool_set_id;

      $current = Auth::guard('person')->user()->id;
      $toolset = ToolSet::find($request->tool_set_id);
      //return $toolset;
      date_default_timezone_set('Asia/Bangkok');
      $currentdate = date('d/m/Y');
      $currenttime = date('H:i:s');
      $next_period_deal_date = "+".$toolset->valid_period."days";
    $next_period_deal_date =  date('d/m/Y', strtotime($next_period_deal_date));
         Tool_Order::create([
            'member_id' => $current,
            'order_create_date' => $currentdate,
            'tool_set_id' => $request['tool_set_id'],
            'tool_package_id' => $request['tool_package_id'],
            'initial_fee' =>$toolset->initial_free,
            'period_fee' => $toolset->period_fee,
            'exit_fee' => $toolset->exit_fee,
            'initial_deal_date' => $currentdate,
            'next_period_deal_date' => $next_period_deal_date,
            'order_status' => 1,
            'description' => $request['description'],
            'invoice_number' => $request['invoice_number'],
        ]);
        return redirect ('/toolordermember');
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
