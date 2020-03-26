<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\match_id;
use App\Person;
use App\Pid_group;
use App\match_pid_id;
use App\Http\Controllers\SidebarController;
class MatchpidIdController extends Controller
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


      $matchgroups = DB::table('match_pid_groups')
      ->leftJoin('match_id', 'match_pid_groups.p_id', '=', 'match_id.id')

     ->leftJoin('pid_groups', 'match_pid_groups.pid_group_id', '=', 'pid_groups.id')

     ->select('match_pid_groups.*','match_pid_groups.id', 'pid_groups.name as group_name', 'pid_groups.id as group_id','match_id.public_name as pid_name', 'match_id.id as p_id')

     ->paginate(30);

    return view('system-mgmt/match-pid-group/index', ['matchgroups' => $matchgroups,'tree'=>$tree]);
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



       $ugroups = pid_group::all();

       $pids = match_id::all();
       $matchgroups = match_pid_id::all();

        return view('system-mgmt/match-pid-group/create', [ 'ugroups' => $ugroups, 'pids' => $pids, 'matchgroups' => $matchgroups,'tree'=>$tree]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {


       //Person::findOrFail($request['pid_id']); ใช้เพื่อทำให้ก่อนจะบันทึกต้องมีข้อมูลในตารางนี้ด้วย
      // pid::findOrFail($request['pid_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
        match_pid_id::create([
          'p_id' => $request['p_id'],
          'pid_group_id' => $request['pid_group_id'],


       ]);


         return redirect ('/match-pid-group');
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


         $matchgroup = match_pid_id::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($matchgroup == null) {
           $matchgroup = match_pid_id::find($id);
           $data = array(
               'matchgroup' => $matchgroup
             );
             return redirect ('/match-pid-group');
           }

           $ugroups = pid_group::all();
           $pids = match_id::all();

         return view('system-mgmt/match-pid-group/edit', ['matchgroup' => $matchgroup,'ugroups' => $ugroups,'pids' => $pids,'tree'=>$tree]);
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
         $matchgroup = match_pid_id::findOrFail($id);
         $input = [
           'p_id' => $request['p_id'],
           'pid_group_id' => $request['pid_group_id'],

         ];
         $this->validate($request, [

         ]);
         match_pid_id::where('id', $id)
             ->update($input);

         return redirect ('/match-pid-group');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         match_pid_id::where('id', $id)->delete();
          return redirect ('/match-pid-group');
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
            'pid_id' => $request['pid_id'],
			  'match_id.public_name' => $request['pid_name'],
            'pid_group_id' => $request['pid_group_id'],
			  'pid_groups.name' => $request['group_name'],

             ];

        $matchgroups = $this->doSearchingQuery($constraints);

        $constraints['pid_name'] = $request['pid_name'];
        $constraints['group_name'] = $request['group_name'];
        return view('system-mgmt/match-pid-group/index', ['matchgroups' => $matchgroups, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
                $query = DB::table('match_pid_groups')
      ->leftJoin('match_id', 'match_pid_groups.p_id', '=', 'match_id.id')

     ->leftJoin('pid_groups', 'match_pid_groups.pid_group_id', '=', 'pid_groups.id')

     ->select('match_pid_groups.*','match_pid_groups.id', 'pid_groups.name as group_name', 'pid_groups.id as group_id','match_id.public_name as pid_name', 'match_id.id as p_id');



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
