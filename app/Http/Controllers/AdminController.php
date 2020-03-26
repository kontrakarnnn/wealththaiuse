<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class AdminController extends Controller
{
       /**
     * Where to redirect users after registration.
     *
     * @var string
     */


         /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function index()
    {
        $users = User::All();

        return view('/dashboard', ['users' => $users]);
    }

  }
