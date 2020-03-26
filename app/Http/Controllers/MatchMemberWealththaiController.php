<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\member;
use App\Person;
use App\Member_group;
use App\match_member_id;
use App\Http\Controllers\SidebarController;
class MatchMemberWealththaiController extends Controller
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


      $matchgroups = DB::table('match_member_groups')
      ->leftJoin('persons', 'match_member_groups.member_id', '=', 'persons.id')

     ->leftJoin('member_groups', 'match_member_groups.member_group_id', '=', 'member_groups.id')
     ->where('member_groups.id',6)
     ->leftJoin('party', 'match_member_groups.party_id', '=', 'party.id')

     ->select('match_member_groups.*','match_member_groups.id', 'party.name as party_name', 'member_groups.name as group_name', 'member_groups.id as group_id','persons.name as member_name', 'persons.id as member_id')

     ->paginate(30);

    return view('system-mgmt/match-member-wealththai/index', ['matchgroups' => $matchgroups,'tree'=>$tree]);
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



       $ugroups = member_group::where('id',6)->get();

       $members = Person::all();
       $matchgroups = match_member_id::all();
        $party = DB::table('party')->where('member_group_id',6)->get();
        return view('system-mgmt/match-member-wealththai/create', [ 'party' => $party,'ugroups' => $ugroups, 'members' => $members, 'matchgroupss' => $matchgroups,'tree'=>$tree]);

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
      // member::findOrFail($request['member_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
        match_member_id::create([
          'member_id' => $request['member_id'],
          'member_group_id' => $request['member_group_id'],
          'party_id' => $request['party_id'],


       ]);


         return redirect ('match-member-wealththai');
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

         $matchgroup = match_member_id::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($matchgroup == null) {
           $matchgroup = match_member_id::find($id);
           $data = array(
               'matchgroup' => $matchgroup
             );
             return redirect ('/match-member-wealththai');
           }
           $ugroups = member_group::where('id',6)->get();

           $members = Person::all();
           $matchgroups = match_member_id::all();
           $party = DB::table('party')->where('member_group_id',6)->get();
         return view('system-mgmt/match-member-wealththai/edit', ['party' => $party,'matchgroup' => $matchgroup,'ugroups' => $ugroups,'members' => $members,'tree'=>$tree]);
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
         $matchgroup = match_member_id::findOrFail($id);
         $input = [
           'member_id' => $request['member_id'],
           'member_group_id' => $request['member_group_id'],
           'party_id' => $request['party_id'],
         ];
         $this->validate($request, [

         ]);
         match_member_id::where('id', $id)
             ->update($input);

         return redirect ('match-member-wealththai');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         match_member_id::where('id', $id)->delete();
          return redirect ('match-member-wealththai');
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
            'persons.name' => $request['member_name'],
            'member_groups.name' => $request['group_name'],
            'party.name' => $request['party_name'],

             ];

        $matchgroups = $this->doSearchingQuery($constraints);

        $constraints['member_name'] = $request['member_name'];
        $constraints['group_name'] = $request['group_name'];
        $constraints['party_name'] = $request['party_name'];
        return view('system-mgmt/match-member-wealththai/index', ['matchgroups' => $matchgroups, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
                $query =  DB::table('match_member_groups')
                ->leftJoin('persons', 'match_member_groups.member_id', '=', 'persons.id')

               ->leftJoin('member_groups', 'match_member_groups.member_group_id', '=', 'member_groups.id')
               ->where('member_groups.id',6)
               ->leftJoin('party', 'match_member_groups.party_id', '=', 'party.id')

               ->select('match_member_groups.*','match_member_groups.id', 'party.name as party_name', 'member_groups.name as group_name', 'member_groups.id as group_id','persons.name as member_name', 'persons.id as member_id');




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
