<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $session =   url()->previous();

      switch ($guard) {
        case 'person':
			  $id = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $per = DB::table('persons')->where('id',$id)->value('status');
        if ($per == "Request Reset Password"){
          $ch = '/member/resetpassword/'.$id.'';
          return \Redirect::to($ch);
        }
        if (Auth::guard($guard)->check()){
            $url = Redirect::intended()->getTargetUrl();
          if ( Auth::guard($guard)->check() && $url != "https://erp.wealththai.net"){

            return \Redirect::to($url);

          }
          else{
                     return redirect()->route('person.dashboard');
          }


        }
        //  if()







        break;
        }

        return $next($request);
    }
}
