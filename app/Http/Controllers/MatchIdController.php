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
use App\match_id;
use App\Http\Controllers\SidebarController;
class MatchIdController extends Controller
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


      $matchids = DB::table('match_id')
      ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

     ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

     ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

     ->paginate(40);
     return view('system-mgmt/match-id/index', ['matchids' => $matchids,'tree'=>$tree]);
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


       $persons = Person::all();

       $users = User::all();
       $matchids = match_id::all();

        return view('system-mgmt/match-id/create', [ 'persons' => $persons, 'users' => $users, 'matchids' => $matchids,'tree'=>$tree]);

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
        match_id::create([
          'user_id' => $request['user_id'],
          'member_id' => $request['member_id'],
          'public_name' => $request['public_name'],
          'public_email' => $request['public_email'],
          'public_mobile' => $request['public_mobile'],
          'sender_citizen' => $request['sender_citizen']

       ]);


         return redirect ('/admin/match-id');
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


         $matchid = match_id::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($matchid == null) {
           $matchid = match_id::find($id);
           $data = array(
               'matchid' => $matchid
             );
             return redirect ('/admin/match-id');
           }

           $persons = Person::all();
           $users = User::all();

         return view('system-mgmt/match-id/edit', ['matchid' => $matchid,'persons' => $persons,'users' => $users,'tree'=>$tree]);
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
         $matchid = match_id::findOrFail($id);
         $input = [
           'user_id' => $request['user_id'],
           'member_id' => $request['member_id'],
           'public_name' => $request['public_name'],
           'public_email' => $request['public_email'],
           'public_mobile' => $request['public_mobile'],
           'sender_citizen' => $request['sender_citizen']
         ];
         $this->validate($request, [

         ]);
         match_id::where('id', $id)
             ->update($input);

         return redirect ('/admin/match-id');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         match_id::where('id', $id)->delete();
          return redirect ('/admin/match-id');
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
            'member_id' => $request['member_id'],
            'public_name' => $request['public_name'],
            'public_email' => $request['public_email'],
            'public_mobile' => $request['public_mobile'],
            'sender_citizen' => $request['sender_citizen'],
           'persons.name' => $request['member_name'],
            'users.username' => $request['user_name']
             ];

        $matchids = $this->doSearchingQuery($constraints);

        $constraints['user_name'] = $request['user_name'];
        $constraints['member_name'] = $request['member_name'];
        return view('system-mgmt/match-id/index', ['matchids' => $matchids, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
                $query = DB::table('match_id')
                ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

               ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

               ->select('match_id.*', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id');


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
