<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Block;
use App\Structure;
class EditprofileController extends Controller
{
    public function profile($username)

    {
          $per =Person::wherename($username)->first();
          $departments = Structure::all();
          $divisions = Block::all();
          return view('person.editprofile',['departments' => $departments, 'divisions' => $divisions,'per' => $per]);
    }
}
