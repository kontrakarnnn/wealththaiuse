<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SidebarperController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Partner;
use App\Http\Controllers\SidebarpartnerController;
use Auth;
use Session;

class PartnerLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:partner',['except' => ['logout']]);
    }
    public function showLoginForm()
    {
      return view('auth.partner-login');
    }

    public function login(Request $request)
    {

       $this->validate($request,[
         'email' => 'required|email',
         'password' => 'required|min:6'
       ]);
       if(Auth::guard('partner')->attempt(['email' => $request->email,'password' => $request->password,'status' => 2],$request->remember)){

         $sidepart = new SidebarpartnerController();
       $sidepart = $sidepart->getSide();
       Session::put('sidepart', $sidepart);

          return redirect('/wealththaipartner/dashboard');

       }

       return redirect()->back()->withInput($request->only('email','remember'))->with('alert-danger', 'Email หรือ Password ไม่ถูกต้อง');

    }

    public function logout()
  {

    $email = $_SERVER['REQUEST_URI'];
    $email = explode('?',$email);

      Auth::guard('partner')->logout();
      if(in_array('mail',$email)){
        $orgmail = $email[2];
        $url = '/?mail?='.$orgmail;
        return redirect($url);
      }
      return redirect('/wealththaipartner');
  }
}
