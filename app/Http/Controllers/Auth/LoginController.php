<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\SidebarController;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
  //  protected $redirectTo = '/dashboard';

     /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts ($request) {
        $maxLoginAttempts = 2;
        $lockoutTime = 5; // 5 minutes
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
      $ss = base64_encode( 12 );

           $_SESSION['mobileappkey'] = $ss;
      return view('auth.login');
    }

    public function login(Request $request)
    {
       $this->validate($request,[
         'email' => 'required|email',
         'password' => 'required'
       ]);
       if(Auth::guard('web')->attempt(['email' => $request->email,'password' => $request->password],$request->remember)){
         $url =  $request->previous;
         $url2 =Redirect::intended();
	           $tree = new SidebarController();
           $tree = $tree->getSide();
           Session::put('tree', $tree);
         if($url == "http://localhost:8000" || $url == "http://localhost:8000/loggedout" ||$url == "http://localhost:8000/person"){
           $tree = new SidebarController();
           $tree = $tree->getSide();
           Session::put('tree', $tree);
        return redirect('/dashboard');
        }
          // dd($url);
          if($url != "http://localhost:8000/wealththaiagent"){
          //  return $url;
          $tree = new SidebarController();
           $tree = $tree->getSide();
           Session::put('tree', $tree);
             return redirect($url);
}
  //return $url;
              //return $tree;
            return redirect('/dashboard');
       }

       return redirect()->back()->withInput($request->only('email','remember'))->with('alert-danger', 'Email หรือ Password ไม่ถูกต้อง');

    }

    public function logout()
  {
		Session::flush();
      Auth::guard('web')->logout();
        return Redirect::to('http://erp.wealththai.net/loggedout');
  }
}
