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
use App\ToolPackage;
use App\Tool_Package_To_Set;
use App\MemberTool;

use App\Http\Controllers\SidebarController;
class ToolSetMemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('viewper');
    }

    public function index($id)
    {
        $current = Auth::guard('person')->user()->id;
        $data = ToolSet::with(['Tool'])->where('tool_id',$id)->get();
        $tool = Tool::with(['ToolType','User'])->find($id);
        $toollimit = Tool::with(['ToolType','User'])->where('id',$id)->value('limit_assign');
        $count = MemberTool::where('member_id',$current)->count();
        $cantbuy = 0;
        if($count < $toollimit)
        {
          $cantbuy = 1;
        }
      //  return $toollimit;
        return view('system-mgmt/toolsetmember/index',compact(['cantbuy','data','tool']));
    }

    public function toolpackage($id)
    {

      $data = ToolPackage::with(['Term_Of_Payment','Member_Tool_Status'])->find($id);
      $findset = Tool_Package_To_Set::with(['ToolSet','ToolPackage'])->where('tool_package',$id)->get();

        return view('system-mgmt/toolsetmember/toolpackage',compact(['data','findset']));
    }

}
