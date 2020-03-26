<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Partner_structure;
use App\Partner_block;
use App\Partner;
use App\Partner_auth;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Http\Controllers\SidebarController;

class PartnerAuthController extends Controller
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

      $partnerstructure = Partner_structure::all();
      $partnerblock = Partner_block::all();

      $partner = Partner::all();

      $partnerauths =Partner_auth::with(['Partner','Partner_structure','Partner_block'])
     ->paginate(30);
     return view('system-mgmt/partnerauth/index', ['partnerstructure' => $partnerstructure,'partnerblock' => $partnerblock,'partner' => $partner,'partnerauths' => $partnerauths]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       $partnerstructure = Partner_structure::all();
       $partnerblock = Partner_block::all();

       $partner = Partner::all();

        return view('system-mgmt/partnerauth/create', ['partnerstructure' => $partnerstructure, 'partnerblock' => $partnerblock, 'partner' => $partner]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {



       $this->validateInput($request,[
      ]);
        Partner_auth::create([
          'partner_id' => $request['partner_id'],
          'structure_id' => $request['structure_id'],
          'block_id' => $request['block_id'],
          'description' => $request['description']

       ]);


         return redirect ('admin/partnerauth');
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
         $partnerauth = Partner_auth::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($partnerauth == null) {
           $partnerauth = Partner_auth::find($id);
           $data = array(
               'partnerauth' => $partnerauth
             );
             return redirect ('/admin/partnerauth');
           }
           $partnerstructure = Partner_structure::all();
           $partnerblock = Partner_block::all();
           $partner = Partner::all();
         return view('system-mgmt/partnerauth/edit', ['partnerstructure' => $partnerstructure,'partnerauth' => $partnerauth,'partnerblock' => $partnerblock,'partner' => $partner]);
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
           'partner_id' => $request['partner_id'],
           'structure_id' => $request['structure_id'],
           'block_id' => $request['block_id'],
           'description' => $request['description']
         ];
         $this->validate($request, [

         ]);
         Partner_auth::where('id', $id)
             ->update($input);

         return redirect ('/admin/partnerauth');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Partner_auth::where('id', $id)->delete();
          return redirect ('/admin/partnerauth');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */
     public function search(Request $request) {


          $constraints = [
           'partner_id' => $request['partner_id'],
           'structure_id' => $request['structure_id'],
           'block_id' => $request['block_id'],
             ];
        $partnerauths = $this->doSearchingQuery($constraints);
        $partnerstructure = Partner_structure::all();
        $partnerblock = Partner_block::all();
        $partner = Partner::all();
        return view('system-mgmt/partnerauth/index', ['partnerstructure' => $partnerstructure,'partnerblock' => $partnerblock,'partner' => $partner,'partnerauths' => $partnerauths, 'searchingVals' => $constraints]);
     }

     private function doSearchingQuery($constraints) {


         $query =Partner_auth::with(['Partner','Partner_structure','Partner_block']);

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
           'user_id' => 'nullable|max:60',
           'structure_id' => 'nullable|max:60',
           'block_id' => 'nullable|max:60',
           'description' => 'nullable|max:60'

     ]);
     }
 }
