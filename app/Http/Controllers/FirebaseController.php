<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
class FirebaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('view');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
              $firebase = (new Factory)
              ->withServiceAccount($serviceAccount)
              ->withDatabaseUri('https://wealththai-10d83.firebaseio.com/')
              ->create();

              $database   =   $firebase->getDatabase();
              $createPost    =   $database
              ->getReference('blog/posts')
              ->push([
                  'title' =>  'Laravel 6',
                  'body'  =>  'This is really a cool database that is managed in real time.'

              ]);

              echo '<pre>';
              print_r($createPost->getvalue());
              echo '</pre>';
    }

    public function getData() {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://wealththai-10d83.firebaseio.com/')
        ->create();

        $database   =   $firebase->getDatabase();
        $createPost    =   $database->getReference('blog/posts')->getvalue();
      //  return response()->json($createPost);
      return $createPost;

    }



}
