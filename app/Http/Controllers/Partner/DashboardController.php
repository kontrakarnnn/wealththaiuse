<?php

namespace App\Http\Controllers\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\User_auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\SidebarController;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('viewpartner');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('partner/dashboard');
    }


}
