<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;
use App\View;

use App\Block;
use App\User;
use App\Person;
use App\User_group;
use App\match_user_id;
use App\Http\Controllers\SidebarController;
class MatchUserIdController extends Controller
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

      $matchgroups = DB::table('match_user_groups')
      ->leftJoin('users', 'match_user_groups.user_id', '=', 'users.id')

     ->leftJoin('user_groups', 'match_user_groups.user_group_id', '=', 'user_groups.id')

     ->select('match_user_groups.*','match_user_groups.id', 'user_groups.name as group_name', 'user_groups.id as group_id','users.username as user_name', 'users.id as user_id')

     ->paginate(30);

    return view('system-mgmt/match-user-group/index', ['matchgroups' => $matchgroups,'tree'=>$tree]);
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




       $ugroups = User_group::all();

       $users = User::all();
       $matchgroups = match_user_id::all();

        return view('system-mgmt/match-user-group/create', [ 'ugroups' => $ugroups, 'users' => $users, 'matchgroupss' => $matchgroups,'tree'=>$tree]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {


       //Person::findOrFail($request['member_id']); ใช้เพื่อทำให้ก่อนจะบันทึกต้องมีข้อมูลในตารางนี้ด้วย
      // User::findOrFail($request['user_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
        match_user_id::create([
          'user_id' => $request['user_id'],
          'user_group_id' => $request['user_group_id'],


       ]);


         return redirect ('/admin/match-user-group');
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


         $matchgroup = match_user_id::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($matchgroup == null) {
           $matchgroup = match_user_id::find($id);
           $data = array(
               'matchgroup' => $matchgroup
             );
             return redirect ('/admin/match-user-group');
           }

           $ugroups = User_group::all();
           $users = User::all();

         return view('system-mgmt/match-user-group/edit', ['matchgroup' => $matchgroup,'ugroups' => $ugroups,'users' => $users,'tree'=>$tree]);
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
         $matchgroup = match_user_id::findOrFail($id);
         $input = [
           'user_id' => $request['user_id'],
           'user_group_id' => $request['user_group_id'],

         ];
         $this->validate($request, [

         ]);
         match_user_id::where('id', $id)
             ->update($input);

         return redirect ('/admin/match-user-group');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         match_user_id::where('id', $id)->delete();
          return redirect ('/admin/match-user-group');
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
            'user_id' => $request['user_id'],
            'user_group_id' => $request['user_group_id'],

             ];

        $matchgroups = $this->doSearchingQuery($constraints);

        $constraints['user_name'] = $request['user_name'];
        $constraints['group_name'] = $request['group_name'];
        return view('system-mgmt/match-user-group/index', ['matchgroups' => $matchgroups, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
                $query = DB::table('match_user_groups')
                ->leftJoin('users', 'match_user_groups.user_id', '=', 'users.id')

               ->leftJoin('user_groups', 'match_user_groups.user_group_id', '=', 'user_groups.id')

               ->select('match_user_groups.*', 'user_groups.name as group_name', 'user_groups.id as group_id','users.username as user_name', 'users.id as user_id');


         $fields = array_keys($constraints);
         $index = 0;
         foreach ($constraints as $constraint) {
             if ($constraint != null) {
                 $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
             }

             $index++;
         }
         return $query->paginate(1000);
     }
     private function validateInput($request) {
         $this->validate($request, [


     ]);
     }
 }
