<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\User_auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


 public function logoutpage(){
   return view('auth.logout');
 }
}
