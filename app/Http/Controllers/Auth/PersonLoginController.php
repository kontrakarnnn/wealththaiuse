<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SidebarperController;
use Illuminate\Support\Facades\Redirect;

use Auth;
use Session;

class PersonLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:person',['except' => ['logout']]);
    }
    public function showLoginForm()
    {

      $chkredirectlink = urldecode(url()->previous());
						  $ss = base64_encode( 12 );

           $_SESSION['mobileappkey'] = $ss;
				if($chkredirectlink == 'http://localhost/tabs/tab7')
      {
					  $ss = base64_encode( 42 );
           $_SESSION['mobileappkey'] = $ss;
			$email = '';
			 $chkrelink = 1;
		$chkmail = 0;
			$chkredirectlink = 'https://erp.wealththai.net/person';
		return view('auth.person-login',['chkrelink'=>$chkrelink,'chkredirectlink'=>$chkredirectlink,'chkmail'=>$chkmail,'email'=>$email]);

      }

				//$ss = base64_decode($_SESSION["mobileappkey"]);
	//return $ss;
		if($chkredirectlink == 'http://192.168.10.83:8100/tabs/tab2')
      {
			$email = '';
			 $chkrelink = 1;
		$chkmail = 0;
			$chkredirectlink = 'https://erp.wealththai.net/person';
		return view('auth.person-login',['chkrelink'=>$chkrelink,'chkredirectlink'=>$chkredirectlink,'chkmail'=>$chkmail,'email'=>$email]);

      }

      $chkrelink =0;
      if($chkredirectlink != 'https://erp.wealththai.net')
      {
        $chkrelink = 1;
        $chkredirectlink = explode('https://erp.wealththai.net',$chkredirectlink);
        $chkredirectlink = $chkredirectlink[1];
      //return $chkredirectlink;
      }
      $checkemail = $_SERVER['REQUEST_URI'];
      $checkemail = explode('?',$checkemail);
      $chkmail = 0;
      $email = '';
      if(in_array('mail',$checkemail)){
        $email = $_SERVER['REQUEST_URI'];
      //  return $email;
        $email = explode('=',$email);
        $email = $email[1];
        $chkmail = 1;
      }
      return view('auth.person-login',['chkrelink'=>$chkrelink,'chkredirectlink'=>$chkredirectlink,'chkmail'=>$chkmail,'email'=>$email]);
    }

    public function login(Request $request)
    {

       $this->validate($request,[
         'email' => 'required|email',
         'password' => 'required|min:6'
       ]);
       if(Auth::guard('person')->attempt(['email' => $request->email,'password' => $request->password],$request->remember)){
          $side = new SidebarperController();
          $side = $side->getSide();
          Session::put('side', $side);
          $url =  $request->previous;
          $url2 =Redirect::intended();

		   			 $reurl = url()->previous();
		   //return $reurl;refmem
		   		   if(strstr($url,'password') || strstr($reurl,'refmem'))
		   {
				return redirect('/person');
		   }
		   if(strstr($url,'wealththai.co.th'))
		   {
				return redirect('/person');
		   }
			if($reurl != "https://erp.wealththai.net")
			{
				$chklit = url()->previous();
				$chklit  = explode('?',$chklit);
				if(in_array("lit",$chklit))
				{
					$chklitt = url()->previous();
					$chklitt  = explode('?lit?',$chklitt);
					$chklitt = $chklitt[1];
					 if ( strstr($chklitt, 'toolid=') ) {
					$positiontoolid = strpos($chklitt,"toolid=");
         		    $positiontoolid = $positiontoolid+7;
        		   $toolid = substr($chklitt, $positiontoolid,9);
								 $chklitt = DB::table('tool')->where('tool_ref_product_id',$toolid)->value('id');
								 $chklitt = 'https://erp.wealththai.net/toolmember/toolset/'.$chklitt;

					}

					return redirect($chklitt);
				}
				$chk = url()->previous();
				$chk = explode('??',$chk);

				if(in_array("wealththaievent",$chk))
				{
					$chk = $chk[1];
				$reurl = explode('??',$reurl);
				$reurl =$reurl[2];
				if($reurl == "ref"){
          		return redirect('/person');
        		}
				return redirect($reurl);
				}
				}

          if($url == "https://erp.wealththai.net" ||$url == "https://erp.wealththai.net/wealththaiagent"){
            $side = new SidebarperController();
            $side = $side->getSide();
            Session::put('side', $side);
         return redirect('/person');
         }
         if($url != "https://erp.wealththai.net"){
         //  return $url;
         $side = new SidebarperController();
         $side = $side->getSide();
         Session::put('side', $side);

            return redirect($url);
}
          return redirect('/person');

       }
       return redirect()->back()->withInput($request->only('email','remember'));

    }

    public function logout()
  {
    $email = $_SERVER['REQUEST_URI'];
    $email = explode('?',$email);

      Auth::guard('person')->logout();
      if(in_array('mail',$email)){
        $orgmail = $email[2];
        $url = '/?mail?='.$orgmail;
        return redirect($url);
      }
      return redirect('/');
  }
}
