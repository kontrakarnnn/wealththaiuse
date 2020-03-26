<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Mail\SendEmailTest;
use Mail;
class FortestfunctionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function emailtest(Request $request){
     $email = new SendEmailTest();
        Mail::to('kontrakarn.th@gmail.com')->send($email);
     }
 }
