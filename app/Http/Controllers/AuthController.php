<?php
namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function getSignUpPage()
    {
        return view('auth.signsup');
    }
    public function getSignInPage()
    {
        return view('auth.signin');
    }
    public function postSignUp(Request $request)
    {
        $user = new User();
        $user->username = $request['username'];
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
        $user->roles()->attach(Role::where('name', 'User')->first());
        Auth::login($user);
        return redirect()->route('main');
    }
    public function postSignIn(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('/login');
        }
        return redirect()->back();
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('/login');
    }
}
