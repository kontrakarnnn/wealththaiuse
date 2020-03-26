<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterPersonController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20',
            'dob' => 'required|string|max:255',
            'age' => 'required|integer|max:255',
            'id_num' => 'required|string|max:25',
            'address' => 'required|string|max:25',
            'university' => 'required|string|max:25',
            'faculty' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'gpa' => 'required|decimal|max:255',
            'job' => 'required|string|max:255',
            'workexpr' => 'required|string|max:255',
            'skill' => 'required|string|max:255',
            'interest' => 'required|string|max:255',
            'another' => 'required|string|max:255',
            'status' => 'required|string|max:255',


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function store(request $request)
    {
        return Person::create([
            'name' => $data['name'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone'=> $data['phone'],
            'password' => Hash::make($data['password']),
            'dob' =>$data['dob'],
            'age' =>$data['age'],
            'id_num' =>$data['id_num'],
            'address' =>$data['university'],
            'university' =>$data['team'],
            'faculty' =>$data['faculty'],
            'major' =>$data['major'],
            'gpa' =>$data['gpa'],
            'job' =>$data['job'],
            'workexpr' =>$data['workexpr'],
            'skill' =>$data['skill'],
            'interest' =>$data['interest'],
            'another' =>$data['another'],
            'status' =>$data['status']


        ]);
    }
}
