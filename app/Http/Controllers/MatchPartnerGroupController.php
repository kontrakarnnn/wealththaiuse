<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\member;
use App\Partner;
use App\Partner_group;
use App\match_partner_group;
use App\Http\Controllers\SidebarController;
class MatchPartnerGroupController extends Controller
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

      $matchgroups = match_partner_group::with(['Partner_group','Partner'])->paginate(30);

    return view('system-mgmt/match-partner-group/index', ['matchgroups' => $matchgroups,'tree'=>$tree]);
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



       $ugroups = Partner_group::all();

       $members = Partner::all();
       $matchgroups = match_partner_group::all();
       $party = DB::table('party')->get();
        return view('system-mgmt/match-partner-group/create', [ 'party' => $party,'ugroups' => $ugroups, 'members' => $members, 'matchgroupss' => $matchgroups,'tree'=>$tree]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {


       //Partner::findOrFail($request['member_id']); ใช้เพื่อทำให้ก่อนจะบันทึกต้องมีข้อมูลในตารางนี้ด้วย
      // member::findOrFail($request['member_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
        match_partner_group::create([
          'partner_id' => $request['partner_id'],
          'partner_group_id' => $request['partner_group_id'],


       ]);


         return redirect ('/admin/match-partner-group');
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

         $matchgroup = match_partner_group::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($matchgroup == null) {
           $matchgroup = match_partner_group::find($id);
           $data = array(
               'matchgroup' => $matchgroup
             );
             return redirect ('/admin/match-partner-group');
           }

           $ugroups = Partner_group::all();
           $members = Partner::all();
           $party = DB::table('party')->get();
         return view('system-mgmt/match-partner-group/edit', ['party' => $party,'matchgroup' => $matchgroup,'ugroups' => $ugroups,'members' => $members,'tree'=>$tree]);
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
         $matchgroup = match_partner_group::findOrFail($id);
         $input = [
           'partner_id' => $request['partner_id'],
           'partner_group_id' => $request['partner_group_id'],
         ];
         $this->validate($request, [

         ]);
         match_partner_group::where('id', $id)
             ->update($input);

         return redirect ('/admin/match-partner-group');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         match_partner_group::where('id', $id)->delete();
          return redirect ('/admin/match-partner-group');
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
            'partner.name' => $request['partner_name'],
            'partner_group.name' => $request['group_name'],

             ];

        $matchgroups = $this->doSearchingQuery($constraints);

        $constraints['partner_name'] = $request['partner_name'];
        $constraints['group_name'] = $request['group_name'];
        return view('system-mgmt/match-partner-group/index', ['matchgroups' => $matchgroups, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
                $query = DB::table('match_partner_group')
                ->leftJoin('partner', 'match_partner_group.partner_id', '=', 'partner.id')

               ->leftJoin('partner_group', 'match_partner_group.partner_group_id', '=', 'partner_group.id')

               ->select('match_partner_group.*','match_partner_group.id', 'partner_group.name as group_name', 'partner_group.id as group_id','partner.name as partner_name', 'partner.id as member_id');




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
