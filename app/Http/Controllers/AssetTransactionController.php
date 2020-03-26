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
use App\Asset_Transaction;
use App\Asset;
use App\View;
use Session;
use App\Block;
use App\Http\Controllers\SidebarController;
class AssetTransactionController extends Controller
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
      $porttypes = DB::table('asset_transaction')
      ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
      ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
    //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
     ->select('asset_transaction.*', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
       ->paginate(30);
      return view('system-mgmt/asset-transaction/index', ['porttypes' => $porttypes,'tree'=>$tree]);
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



           //return $assettype;
           $asset = DB::table('asset')->get();
           $port = DB::table('portfolio')->get();
         return view('system-mgmt/asset-transaction/create',['port'=>$port,'asset'=>$asset,'tree'=>$tree]);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {



            $currenttime = date('d-m-y H:i:s');
            $d = $request->d;
            $m = $request->m;
            $y = $request->y;
            $date = $d."/".$m."/".$y;
         $this->validateInput($request);

          Asset_Transaction::create([
             'date' => $date,
             'time' => $request['time'],
             'l_s' => $request['l_s'],
             'o_c' => $request['o_c'],
             'port_id' => $request['port_id'],
             'asset_id' => $request['asset_id'],
             'symbol' => $request['symbol'],
             'underlying_id' => $request['underlying_id'],
             'volumn' => $request['volumn'],
             'price' => $request['price'],
             'status' => $request['status'],
             'note' => $request['note'],



         ]);

         return redirect ('/admin/asset-transaction');
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


            $transaction = Asset_Transaction::where('');

            $transaction = DB::table('asset_transaction')
            ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
            ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
          //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
            ->where('asset_transaction.id',$id)
           ->select('asset_transaction.*', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
             ->get();
         return view('system-mgmt/asset-transaction/show',['transaction'=>$transaction,'tree' => $tree]);
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


           $cur = Asset_Transaction::where('id',$id)->value('date');
           if($cur != NULL){

         $cur = explode('/', $cur);
         $curdate =$cur[0];
         $curmonth =$cur[1];
         $curyear =$cur[2];
     }
     else {
       $curdate ="";
       $curmonth ="";
       $curyear ="";
     }
         $porttype = Asset_Transaction::find($id);
         // Redirect to country list if updating country wasn't existed
         if ($porttype == null) {
           $porttype = Asset::find($id);
           $data = array(
               'porttype' => $porttype
             );
             return redirect ('/admin/asset-transaction');
         }

          $port = DB::table('portfolio')->get();
          $asset = DB::table('asset')->get();
         return view('system-mgmt/asset-transaction/edit', ['curdate' => $curdate,'curmonth' => $curmonth,'curyear' => $curyear,'asset' => $asset,'port' => $port,'porttype' => $porttype,'tree'=>$tree]);
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



       $d = $request->d;
       $m = $request->m;
       $y = $request->y;
       $date = $d."/".$m."/".$y;
         $input = [
           'date' => $date,
           'time' => $request['time'],
           'l_s' => $request['l_s'],
           'o_c' => $request['o_c'],
           'port_id' => $request['port_id'],
           'asset_id' => $request['asset_id'],
           'symbol' => $request['symbol'],
           'underlying_id' => $request['underlying_id'],
           'volumn' => $request['volumn'],
           'price' => $request['price'],
           'status' => $request['status'],
           'note' => $request['note'],

         ];
         $this->validate($request, [
        // 'type' => 'required|max:60'
         ]);
         Asset_Transaction::where('id', $id)
             ->update($input);

             // return $previous;
             return redirect ('/admin/asset-transaction');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Asset_Transaction::where('id', $id)->delete();
          return redirect()->back();
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
            // 'portfolio.type' => $request['port_name'],
             //'asset.name' => $request['asset_name'],
             'fromdate' => $request['fromdate'],
             'todate' => $request['todate'],
             //'la_nla' => $request['la_nla']

             ];
             date_default_timezone_set('Asia/Bangkok');
               date('d-m-y H:i:s');
        $porttypes = $this->getHiredEmployeesinbox($request,$constraints);
        return view('system-mgmt/asset-transaction/index', ['porttypes' => $porttypes, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function getHiredEmployeesinbox($constraints) {



       $porttypes = DB::table('asset_transaction')
       ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
       ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
     //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
     ->where('asset_transaction.date', '>=', $constraints['fromdate'])
     ->where('asset_transaction.date', '<=', $constraints['todate'])
      ->select('asset_transaction.*', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')

            ->paginate(1000);

         return $porttypes;
     }

     private function doSearchingQuery($constraints) {
         $query = Asset_Transaction::query();
         $fields = array_keyss($constraints);
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
