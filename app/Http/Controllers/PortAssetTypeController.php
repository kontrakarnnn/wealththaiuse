<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Structure;
use App\Block;
use App\Port_type;
use App\Asset_type;
use App\User;
use App\Port_Asset;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Http\Controllers\SidebarController;

class PortAssetTypeController extends Controller
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

      $userauths = DB::table('port_asset_type')
      ->leftJoin('port_types', 'port_asset_type.port_type_id', '=', 'port_types.id')
     ->leftJoin('asset_type', 'port_asset_type.asset_type_id', '=', 'asset_type.id')

     ->select('port_asset_type.*', 'port_types.type as port_type_name', 'port_types.id as port_type_id','asset_type.la_nla_type as asset_type_name','asset_type.nla_sub_type as asset_subtype_name')

     ->paginate(10);
     return view('system-mgmt/port-asset/index', ['userauths' => $userauths,'tree'=>$tree]);
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



       $structures = Port_type::all();
       $blocks = Asset_type::all();

       $users = User::all();

        return view('system-mgmt/port-asset/create', ['structures' => $structures, 'blocks' => $blocks, 'users' => $users,'tree'=>$tree]);

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
        Port_Asset::create([
          'port_type_id' => $request['port_type_id'],
          'asset_type_id' => $request['asset_type_id'],
          'description' => $request['description']

       ]);


         return redirect ('admin/port-asset');
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

         $userauth = Port_Asset::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($userauth == null) {
           $userauth = User_auth::find($id);
           $data = array(
               'userauth' => $userauth
             );
             return redirect ('/admin/asset-type');
           }
           $structures = Port_type::all();
           $blocks = Asset_type::all();
           $users = User::all();
         return view('system-mgmt/port-asset/edit', ['userauth' => $userauth,'structures' => $structures,'blocks' => $blocks,'users' => $users,'tree'=>$tree]);
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
         $userauth = Port_Asset::findOrFail($id);
         $input = [
           'port_type_id' => $request['port_type_id'],
           'asset_type_id' => $request['asset_type_id'],
           'description' => $request['description']


         ];
         $this->validate($request, [

         ]);
         Port_Asset::where('id', $id)
             ->update($input);

         return redirect ('/admin/port-asset');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Port_Asset::where('id', $id)->delete();
          return redirect ('/admin/port-asset');
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

           'port_types.type' => $request['port_type_name'],
           'asset_type.la_nla_type' => $request['asset_type_name'],
             ];

        $userauths = $this->doSearchingQuery($constraints);
        $constraints['port_type_name'] = $request['port_type_name'];
        $constraints['asset_type_name'] = $request['asset_type_name'];
        return view('system-mgmt/port-asset/index', ['userauths' => $userauths, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
                $query = DB::table('port_asset_type')
                ->leftJoin('port_types', 'port_asset_type.port_type_id', '=', 'port_types.id')
               ->leftJoin('asset_type', 'port_asset_type.asset_type_id', '=', 'asset_type.id')

               ->select('port_asset_type.*', 'port_types.type as port_type_name', 'port_types.id as port_type_id','asset_type.la_nla_type as asset_type_name');


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
