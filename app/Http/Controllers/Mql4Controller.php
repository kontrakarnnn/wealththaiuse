<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Branch;
use App\Person;
use App\Block;
use App\Structure;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Http\Controllers\SidebarController;
class Mql4Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	public function index()
	{
	 echo $_GET["Name"]; 
        return view('mql4');
	}

	
}
