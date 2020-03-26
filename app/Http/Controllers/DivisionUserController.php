<?php

namespace App\Http\Controllers;
use App\User;
use App\Division;
use App\Department;
use Illuminate\Http\Request;

class DivisionUserController extends Controller
{
    public function index($userId)
    {
      $user = User::find($userId);
      return $user->division;
    }
}
