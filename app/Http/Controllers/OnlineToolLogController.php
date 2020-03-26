<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\role;
use App\Structure;
use App\Block;
use App\match_id;
use Response;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Online_tool_log;
use App\Tool;
use App\Portfolio;

use App\Http\Controllers\SidebarController;

use Illuminate\Support\Facades\Hash;


class OnlineToolLogController extends Controller
{
       /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/user-management';

         /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('view', ['except' => ['updatestatus' ]]);
    }


    public function index()
    {
				$onlinecount = Online_tool_log::with(['Tool','Portfolio'])->where('flag_status',1)->count();
		$offlinecount = Online_tool_log::with(['Tool','Portfolio'])->where('flag_status',2)->count();
		$banedcount = Online_tool_log::with(['Tool','Portfolio'])->where('flag_status',3)->count();
		$requestcount = Online_tool_log::with(['Tool','Portfolio'])->where('flag_status',4)->count();

        $data = Online_tool_log::with(['Tool','Portfolio'])->orderBy('created_at','DESC')->paginate(50);
		$count = Online_tool_log::with(['Tool','Portfolio'])->count();
        //return $data;
        $tool = Tool::all();
        $portfolios = Portfolio::leftJoin('port_types','portfolio.port_id','=','port_types.id')
        ->select('portfolio.*','port_types.type as port_type_name')->get();

		$tools = Tool::pluck('id')->toArray();
		$portfolio = Portfolio::pluck('id')->toArray();
        return view('system-mgmt/onlinetoollog/index', ['portfolios' => $portfolios,'onlinecount' => $onlinecount,'offlinecount' => $offlinecount,'banedcount' => $banedcount,'requestcount' => $requestcount,'count' => $count,'portfolio' => $portfolio,'tools' => $tools,'data' => $data,'tool' => $tool]);
    }
    public function updatestatus()
    {
      $post = file_get_contents('php://input');
      if(!empty($_POST['refproductid']))
      {
       //echo $_GET['refproductid'];
      $data = new Online_tool;
                           $data->tool_ref_pid = $_POST['refproductid'];
                            $data->account_num = $_POST['account'];
                            $data->save();
      }  //return view('system-mgmt/onlinetool/index', ['data' => $data,'tool' => $tool]);

    }



    /**
     * Search user from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {


        $constraints = [
            'tool_id' => $request['tool_id'],
            'flag_status' => $request['flag_status'],
            'portfolio_id' => $request['portfolio_id'],
            'acname' => $request['acname'],

            ];

       $data = $this->doSearchingQuery($constraints);
		$onlinecount = Online_tool_log::with(['Tool','Portfolio'])->where('flag_status',1)->count();
		$offlinecount = Online_tool_log::with(['Tool','Portfolio'])->where('flag_status',2)->count();
		$banedcount = Online_tool_log::with(['Tool','Portfolio'])->where('flag_status',3)->count();
		$requestcount = Online_tool_log::with(['Tool','Portfolio'])->where('flag_status',4)->count();
		$count = Online_tool_log::with(['Tool','Portfolio'])->count();
                 $tool = Tool::all();
				$tools = Tool::pluck('id')->toArray();
		$portfolio = Portfolio::pluck('id')->toArray();
    $portfolios = Portfolio::leftJoin('port_types','portfolio.port_id','=','port_types.id')
    ->select('portfolio.*','port_types.type as port_type_name')->get();

       return view('system-mgmt/onlinetoollog/index', ['portfolios' => $portfolios,'count' => $count,'onlinecount' => $onlinecount,'offlinecount' => $offlinecount,'banedcount' => $banedcount,'requestcount' => $requestcount,'tools' => $tools,'portfolio' => $portfolio,'tool' => $tool,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Online_tool_log::with(['Tool','Portfolio'])->orderBy('tool_id','DESC');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(1000);
    }
    private function validateInput($request) {
        $this->validate($request, [
        'username' => 'required|max:20',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'firstname' => 'required|max:60',
        'lastname' => 'required|max:60'
    ]);
    }




}
