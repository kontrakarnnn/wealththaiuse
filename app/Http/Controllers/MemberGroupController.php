<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Department;
use App\Division;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\User;
use App\Person;
use App\Http\Controllers\SidebarController;
use App\Member_group;
class MemberGroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('view');
    }

	     public function getArrayAlldBlock($currentstruc,$currentid,$notebook){

    $CurrentDivisions = Block::where('id', '=',$currentid )->get();
    $result =$notebook;
    $ChildDivisions = Block::whereIn('under_block',$currentid )->pluck('id');
    foreach ( $ChildDivisions as $Division => $get) {
      $nextblockID[$Division] = $get;
      $arraylength = sizeof($result);
      //$currentid=$currentid;
      $result[$arraylength]  = $nextblockID[$Division];
      $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);
      }

      return $result;
}

public function blockbtu($currentstruc2,$currentid2,$notebook2){

$CurrentDivisions = Block::where('under_block', '=', NULL )->pluck('id');
$result2 =$notebook2;
$ChildDivisions = Block::whereIn('id',$currentid2)->pluck('under_block');
//$ChildDivisions = Block::whereIn('under_block',$currentid2)->pluck('id'); topdown
//  $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$CurrentDivisions )->pluck('id');
foreach ( $ChildDivisions as $Division => $get) {
  $nextblockID2[$Division] = $get;
  $arraylength = sizeof($result2);
  //$currentid=$currentid;
  $result2[$arraylength]  = $nextblockID2[$Division];
  $result2 = $this->blockbtu($currentstruc2,$nextblockID2,$result2);
  }

  return $result2;
}







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      //sidebar

    $tree = session()->get('tree');
    //sidebar
      $groups = Member_group::paginate(30);

      return view('system-mgmt/memgroup/index', ['groups' => $groups,'tree'=>$tree]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       //sidebar

       $tree = session()->get('tree');
       //sidebar


         return view('system-mgmt/memgroup/create',['tree'=>$tree]);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         $this->validateInput($request);
          Member_group::create([
             'name' => $request['name'],
             'description' => $request['description'],

         ]);

         return redirect ('/admin/memgroup');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {

       //sidebar

   $tree = session()->get('tree');
   //sidebar


         $group = Member_group::find($id);
         // Redirect to country list if updating country wasn't existed
         if ($group == null) {
           $group = Member_group::find($id);
           $data = array(
               'group' => $group
             );
             return redirect ('/admin/memgroup');
         }


         return view('system-mgmt/memgroup/edit', ['group' => $group,'tree'=>$tree]);
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
         $group = Member_group::findOrFail($id);
         $input = [
             'name' => $request['name'],
             'description' => $request['description'],

         ];
         $this->validate($request, [
         'name' => 'required|max:60'
         ]);
         Member_group::where('id', $id)
             ->update($input);

         return redirect ('/admin/memgroup');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Member_group::where('id', $id)->delete();
          return redirect ('/admin/memgroup');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */


     public function search(Request $request) {
       //sidebar

 $tree = session()->get('tree');
 //sidebar


         $constraints = [
             'name' => $request['name']

             ];

        $groups = $this->doSearchingQuery($constraints);
        return view('system-mgmt/memgroup/index', ['groups' => $groups, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
         $query = Member_group::query();
         $fields = array_keys($constraints);
         $index = 0;
         foreach ($constraints as $constraint) {
             if ($constraint != null) {
                 $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
             }

             $index++;
         }
         return $query->paginate(5);
     }
     private function validateInput($request) {
         $this->validate($request, [
         'name' => 'required|max:60',

     ]);
     }
 }
