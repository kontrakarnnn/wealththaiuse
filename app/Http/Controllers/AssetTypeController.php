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
use App\Asset_type;
use App\View;

use App\Block;
use App\Http\Controllers\SidebarController;
class AssetTypeController extends Controller
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

public function blockbtu($currentstruc,$currentid,$notebook){

 $CurrentDivisions = Block::where('under_block', '=', NULL )->pluck('id');
 $result =$notebook;
 $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$CurrentDivisions )->pluck('id');
 foreach ( $ChildDivisions as $Division => $get) {
   $nextblockID[$Division] = $get;
   $arraylength = sizeof($result);
   //$currentid=$currentid;
   $result[$arraylength]  = $nextblockID[$Division];
   $result = $this->blockbtu($currentstruc,$nextblockID,$result);
   }

   return $result;
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
		$porttypes = DB::table('asset_type')
    ->leftjoin('asset_cat','asset_type.asset_cat','=','asset_cat.id')
    ->leftjoin('member_groups','asset_type.issuer_guild','=','member_groups.id')

      ->select('asset_type.*','member_groups.name as member_group_name','asset_cat.name as asset_cat_name')
      ->paginate(30);
      return view('system-mgmt/asset-type/index', ['porttypes' => $porttypes,'tree'=>$tree]);
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
            $membergroup = DB::table('member_groups')->get();

           $portcat = DB::table('asset_cat')->get();
         return view('system-mgmt/asset-type/create',['membergroup'=>$membergroup,'portcat'=>$portcat,'tree'=>$tree]);
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
          Asset_type::create([
            'la_nla' => $request['la_nla'],
            'asset_cat' => $request['asset_cat'],
            'la_nla_type' => $request['la_nla_type'],
            'nla_sub_type' => $request['nla_sub_type'],
            'link_info' => $request['link_info'],
            'call_center' => $request['call_center'],
            'ref_num_head1' => $request['ref_num_head1'],
            'ref_num_head2' => $request['ref_num_head2'],
            'ref_num_head3' => $request['ref_num_head3'],
            'ref_info_head1' => $request['ref_info_head1'],
            'ref_info_head2' => $request['ref_info_head2'],
            'ref_info_head3' => $request['ref_info_head3'],
            'ref_info_head4' => $request['ref_info_head4'],
            'ref_info_head5' => $request['ref_info_head5'],
            'ref_info_head6' => $request['ref_info_head6'],
            'ref_info_head7' => $request['ref_info_head7'],
            'ref_info_head8' => $request['ref_info_head8'],
            'ref_info_head9' => $request['ref_info_head9'],
            'ref_info_head10' => $request['ref_info_head10'],
            'ref_info_head11' => $request['ref_info_head11'],
            'ref_info_head12' => $request['ref_info_head12'],
            'ref_info_head13' => $request['ref_info_head13'],
            'ref_info_head14' => $request['ref_info_head14'],
            'ref_info_head15' => $request['ref_info_head15'],
            'ref_info_head16' => $request['ref_info_head16'],
            'ref_info_head17' => $request['ref_info_head17'],
            'ref_info_head18' => $request['ref_info_head18'],
            'issuer_guild' => $request['issuer_guild'],
            'unit' => $request['unit'],
            'ref_name_head' => $request['ref_name_head'],


         ]);

         return redirect ('/admin/asset-type');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
       //sidebar

     $tree = session()->get('tree');
     //sidebar
         //
         $porttypes = DB::table('asset_type')->where('asset_type.id',$id)
         ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
         ->select('asset_type.*','asset_cat.name as portcat_name','asset_cat.id as portcat_id')
         ->get();
        // return $porttypes;
         return view('system-mgmt/asset-type/show',['porttypes'=>$porttypes,'tree' => $tree]);
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
    $membergroup = DB::table('member_groups')->get();
         $porttype = Asset_type::find($id);
         // Redirect to country list if updating country wasn't existed
         if ($porttype == null) {
           $porttype = Asset_type::find($id);
           $data = array(
               'porttype' => $porttype
             );
             return redirect ('/admin/asset-type');
         }

          $portcat = DB::table('asset_cat')->get();
         return view('system-mgmt/asset-type/edit', ['membergroup' => $membergroup,'portcat' => $portcat,'porttype' => $porttype,'tree'=>$tree]);
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
         $porttype = Asset_type::findOrFail($id);
         $input = [
           'la_nla' => $request['la_nla'],
           'asset_cat' => $request['asset_cat'],
           'la_nla_type' => $request['la_nla_type'],
           'nla_sub_type' => $request['nla_sub_type'],
           'link_info' => $request['link_info'],
           'call_center' => $request['call_center'],
           'ref_num_head1' => $request['ref_num_head1'],
           'ref_num_head2' => $request['ref_num_head2'],
           'ref_num_head3' => $request['ref_num_head3'],
           'ref_info_head1' => $request['ref_info_head1'],
           'ref_info_head2' => $request['ref_info_head2'],
           'ref_info_head3' => $request['ref_info_head3'],
           'ref_info_head4' => $request['ref_info_head4'],
           'ref_info_head5' => $request['ref_info_head5'],
           'ref_info_head6' => $request['ref_info_head6'],
           'ref_info_head7' => $request['ref_info_head7'],
           'ref_info_head8' => $request['ref_info_head8'],
           'ref_info_head9' => $request['ref_info_head9'],
           'ref_info_head10' => $request['ref_info_head10'],
           'ref_info_head11' => $request['ref_info_head11'],
           'ref_info_head12' => $request['ref_info_head12'],
           'ref_info_head13' => $request['ref_info_head13'],
           'ref_info_head14' => $request['ref_info_head14'],
           'ref_info_head15' => $request['ref_info_head15'],
           'ref_info_head16' => $request['ref_info_head16'],
           'ref_info_head17' => $request['ref_info_head17'],
           'ref_info_head18' => $request['ref_info_head18'],
           'issuer_guild' => $request['issuer_guild'],
           'unit' => $request['unit'],
           'ref_name_head' => $request['ref_name_head'],
         ];
         $this->validate($request, [
        // 'type' => 'required|max:60'
         ]);
         Asset_type::where('id', $id)
             ->update($input);

         return redirect ('/admin/asset-type');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Asset_type::where('id', $id)->delete();
          return redirect ('/admin/asset-type');
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
             'la_nla_type' => $request['la_nla_type'],
             'la_nla' => $request['la_nla']

             ];

        $porttypes = $this->doSearchingQuery($constraints);
        return view('system-mgmt/asset-type/index', ['porttypes' => $porttypes, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
         $query = Asset_type::query();
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
      //   'type' => 'required|max:60|unique:asset_type',

     ]);
     }
 }
