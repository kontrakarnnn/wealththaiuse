<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Department;
use App\Division;
use App\User;
use App\Person;
use App\Port_type;
use App\View;

use App\Block;
use App\Policy;

use App\Http\Controllers\SidebarController;

class PolicyController extends Controller
{

    public function index()
    {
      $policy = Policy::paginate(30);
      return view('system-mgmt/policy/index', ['policy' => $policy]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {

         return view('system-mgmt/policy/create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
          Policy::create([
            'name' => $request['name'],
             'policy' => $request['policy'],


         ]);

         return redirect ('/admin/policy');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */


     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {

         $policy = Policy::find($id);
         // Redirect to country list if updating country wasn't existed
         if ($policy == null) {
           $policy = Port_type::find($id);
           $data = array(
               'policy' => $policy
             );
             return redirect ('/admin/policy');
         }

         return view('system-mgmt/policy/edit', ['policy' => $policy]);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
         $input = [
           'name' => $request['name'],
           'policy' => $request['policy'],


         ];

         Policy::where('id', $id)
             ->update($input);

         return redirect ('/admin/policy');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Policy::where('id', $id)->delete();
          return redirect()->back();
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */


     public function search(Request $request) {



         $constraints = [
             'name' => $request['name']

             ];

        $policy = $this->doSearchingQuery($constraints);
        return view('system-mgmt/policy/index', ['policy' => $policy, 'searchingVals' => $constraints]);
     }

     private function doSearchingQuery($constraints) {
         $query = Policy::query();
         $fields = array_keys($constraints);
         $index = 0;
         foreach ($constraints as $constraint) {
             if ($constraint != null) {
                 $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
             }

             $index++;
         }
         return $query->paginate(1000000000000);
     }

 }
