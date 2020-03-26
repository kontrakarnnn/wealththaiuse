<?php

namespace App\Http\Controllers;
use App\User;
use App\Division;
use App\department;
use Illuminate\Http\Request;

class DivisionDepartmentController extends Controller
{
    public function index($depId)
    {
      $division = Division::find($depId)->division;
      return view('divblock.index',compact('division'));
    }
}
