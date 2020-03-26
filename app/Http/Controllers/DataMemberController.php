<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Viewper;
use Session;
use App\Portfolio;
use App\User_auth;
use App\MemberTool;

class DataMemberController extends Controller
{

		public function getport()
		{
			$current = Auth::guard('person')->user()->id;
			$portfolio = Portfolio::with(['Structure','Block','port_type'])->where('member_id',$current)->get();
			return $portfolio;
		}

		public function membertool()
		{
		  $current = Auth::guard('person')->user()->id;

			$data = MemberTool::with(['Tool','Member_Tool_Status','Person'])->where('member_id',$current)->paginate(30);
			return $data;
		}
		public function membertoolcheckinarray()
		{
			$current = Auth::guard('person')->user()->id;

			$membertoolcheckinarray = MemberTool::where('member_id',$current)->pluck('id')->toArray();
			return $membertoolcheckinarray;
		}



}
