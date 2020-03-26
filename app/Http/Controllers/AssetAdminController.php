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
use App\Asset;
use App\View;
use App\Asset_Transaction;
use App\Block;
use App\Http\Controllers\SidebarController;
class AssetAdminController extends Controller
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
    public function getAlldBlock($currentid,$menudepth,$notebook){
        $CurrentDivisions = Block::where('id', '=',$currentid )->get();
        $count = $menudepth;
        $result ='<ul>';
        $trees='<ul id="browser" class="filetree"><li class="tree-view"></li>';

       /* @foreach(App\Structure::whereIn('id',$currentstruc)->get(); as $depList)
        <li><a href="{{url('portfolio')}}/{{$depList->name}}">
          {{$depList->name}}</a></li>
        @endforeach*/

        foreach ($CurrentDivisions as $Division) {
          $trees .='<li class="tree-view closed"<a  class="tree-name">'.$Division->name.'</a>';

          $status = $Division->status;
          if($count == 0){
               $result .='<li class="tree-view closed"><a  href="https://erp.wealththai.net/SecurityBroke/portblock/'.$Division->name.   ' "class="tree-name">'.$Division->name.'</a>'.' Category current Block ID is  :' .$currentid.'count:'.$count;

          }else{
                $result .='<li class="tree-view closed"><a href="https://erp.wealththai.net/SecurityBroke/portblock/'.$Division->name.   ' ">'.$Division->name.   ' <b>Status:</b> '.$status.'</a>';
          }

        }
         $count++;

       $ChildDivisions = Block::where('under_block', '=',$currentid )->get();
       foreach ($ChildDivisions as $Division) {
            $status = $Division->status;
            $nextblockID = $Division->id;
            if($status== 1){
                $result .= $this->getAlldBlock($nextblockID,$count,$notebook);
                $result   .="</li>";
            }else{
                  $result .=$this->getAlldBlock($nextblockID,$count,$notebook);
            }
          //  $tree .='<li class="tree-view closed"<a class="tree-name">'.$Division->name.'Status: '.$status.'</a>';

       }
       $result .="</ul>";
       return $result;


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

      $porttypes = DB::table('asset')
      ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')

    // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
     ->select('asset.*', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla')
       ->paginate(30);
      return view('system-mgmt/asset-admin/index', ['porttypes' => $porttypes,'tree'=>$tree]);
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




          //return $currentport;
           $findporttype = DB::table('portfolio')->where('id',$currentport)->value('port_id');
           $portasset =DB::table('port_asset_type')->where('port_type_id',$findporttype)->pluck('asset_type_id');
          // return $findporttype;//$assettype = DB::table()
           $assettype = DB::table('asset_type')->whereIn('id',$portasset)->get();
           //return $assettype;
           $portcat = DB::table('asset_type')->get();
           $status = DB::table('asset_status')->get();
         return view('system-mgmt/asset-admin/create',['status'=>$status,'assettype'=>$assettype,'portcat'=>$portcat,'tree'=>$tree]);
     }


     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

       $currentport = url()->previous();
       $currentport = explode('/', $currentport);
       $currentport = $currentport[6];
       $checkurl = url()->previous();
       $checkurl = explode('/', $checkurl);
       //$checkurl = $checkurl[6];
       if(in_array('pnumber',$checkurl)){
         $currentport = url()->previous();
         $currentport = explode('pf', $currentport);
         $currentport = $currentport[1];
       }
    //   return $currentport;
    $currenttime = date('d-m-y H:i:s');
    $df = $request->df;
    $mf = $request->mf;
    $yf = $request->yf;
    $datef = $df."/".$mf."/".$yf;
    $dt = $request->dt;
    $mt = $request->mt;
    $yt = $request->yt;
    $datet = $dt."/".$mt."/".$yt;
          date_default_timezone_set('Asia/Bangkok');
            date('D-m-y H:i:s');
            $currenttime = date('d-m-y H:i:s');
         $this->validateInput($request);
         $asset = new Asset;
         $asset->name = $request -> name;
         $asset->ref_name = $request -> ref_name;
         $asset->la_nla_type = $request -> la_nla_type;
         $asset->sub_type = $request -> sub_type;
         $asset->port_id = $currentport;
         $asset->last_modified_date = $request -> last_modified_date;
         $asset->ref_number1 = $request -> ref_number1;
         $asset->ref_number2 = $request -> ref_number2;
         $asset->ref_number3 = $request -> ref_number3;
         $asset->ref_info1 = $request -> ref_info1;
         $asset->ref_info2 = $request -> ref_info2;
         $asset->ref_info3 = $request -> ref_info3;
         $asset->ref_info4 = $request -> ref_info4;
         $asset->ref_info5 = $request -> ref_info5;
         $asset->ref_info6 = $request -> ref_info6;
         $asset->ref_info7 = $request -> ref_info7;
         $asset->ref_info8 = $request -> ref_info8;
         $asset->link_underlying = $request -> link_underlying;
         $asset->amount = $request -> amount;
         $asset->value = $request -> value;
         $asset->cost = $request -> cost;
         $asset->ref_to_asset = $request -> ref_to_asset;
         $asset->valid_from = $request -> datef;
         $asset->valid_to = $request -> datet;
         $asset->file_attachment = $request -> file_attachment;
         $asset->link_to_more = $request -> link_to_more;
         $asset->contact_pid = $request -> contact_pid;
         $asset->note = $request -> note;
         $asset->save();

         $d = $request->d;
         $m = $request->m;
         $y = $request->y;
         $date = $d."/".$m."/".$y;
         Asset_Transaction::create([
            'date' => $date,
            'time' => $request['time'],
            'l_s' => $request['l_s'],
            'o_c' => $request['o_c'],
            'port_id' => $currentport,
            'asset_id' => $asset->id,
            'symbol' => $request['symbol'],
            'underlying_id' => $request['underlying_id'],
            'volumn' => $request['volumn'],
            'price' => $request['price'],
            'status' => $request['status'],
            'note' => $request['note'],
        ]);


     return redirect ('admin/asset');
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

         $currentid = Auth::user()->id;
         $findfileid = DB::table('asset_attachment')->where('asset_id',$id)->pluck('file_id');
         $fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','1')->get();
         $port = DB::table('asset')
         ->where('asset.id',$id)->value('port_id');
         $blockid = DB::table('portfolio')->where('id',$port)->value('block_id');
         $block = DB::table('block')->where('id',$blockid)->get();
         //return $block;

            $porttypes = DB::table('asset')
            ->where('asset.id',$id)
            ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
            ->leftJoin('portfolio','asset.port_id','=','portfolio.id')
           ->select('asset.*', 'portfolio.id as port_id', 'portfolio.type as port_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla'
           ,'asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8')
             ->paginate(30);
         return view('system-mgmt/asset-admin/show',['block'=>$block,'fileasset'=>$fileasset,'porttypes'=>$porttypes,'tree' => $tree]);
     }

     public function detail($id)
     {
       //sidebar

$tree = session()->get('tree');
//sidebar

         $currentid = Auth::user()->id;
         $findfileid = DB::table('asset_attachment')->where('asset_id',$id)->pluck('file_id');
         $fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','1')->get();
         $portnumber = $_SERVER['REQUEST_URI'];
         $portnumber = explode('/', $portnumber);
         $portnumber = $portnumber[6];
      //   return $portnumber;
      $r = $_SERVER['REQUEST_URI'];
      $r = explode('/', $r);
      $r = $r[6];
      //return $r;

      $current = Auth::user()->id;


      $currentid = DB::table('user_auths')

              ->where([ //[ 'structure_id', '=', 10 ],
                        [ 'user_id', '=', $current]

                     ])
                     ->pluck('block_id');


                     $currentstruc = DB::table('user_auths')

                             ->where([
                                       [ 'user_id', '=', $current]

                                    ])
                                    ->pluck('structure_id');
                         $currentstruc = $currentstruc->toArray();
      $menudepth = 0;
      $notebook = array();

      $trees='<ul id="browser" class="filetree"><li class="tree-view"></li>';
      $trees .=$this->getAlldBlock($currentid,$menudepth,$notebook);
      $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);

      $trees .='<ul>';
      $block =




      $i=0;


      $current = Auth::user()->id;


      $currentid = DB::table('user_auths')

             ->where(//[ 'structure_id', '=',9 ],
                       'user_id', '=',$current

                    )
                    ->pluck('block_id');
                $currentid = $currentid->toArray();











    //  $portfolio = portfolio::find($id);

      // Redirect to city list if updating city wasn't existed
      //if ($id == $number )
      $assetnumber = Asset::where('id',$id)
     ->value('id');
     $name1 = 'Asset_Attachment_'.$r;
     $filerefname =$name1.'_'.$assetnumber ;
     $filecat ='CA8CA';


     //return $portid;
            $porttypes = DB::table('asset')
            ->where('asset.id',$id)
            ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
            ->leftJoin('portfolio','asset.port_id','=','portfolio.id')
           ->select('asset.*', 'portfolio.id as port_id', 'portfolio.type as port_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla'
           ,'asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8')
             ->paginate(30);
         return view('system-mgmt/asset-admin/show',['fileasset'=>$fileasset,'filerefname'=>$filerefname,'filecat'=>$filecat,'portnumber'=>$portnumber,'porttypes'=>$porttypes,'tree' => $tree]);

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

                $porttype = Asset::find($id);
                $assetdate = DB::table('asset')->where('id',$id)->value('valid_from');
                //return $assetdate;
                $df =0;
                $yf=0;
                $mf =0;
                $dt=0;
                $mt = 0;
                $yt =0;
                if($assetdate != NULL){


                $df = explode('/', $assetdate);
                $df = $df[0];
                $mf = explode('/', $assetdate);
                $mf = $mf[1];
                $yf = explode('/', $assetdate);
                $yf = $yf[2];
                $assetdateto = DB::table('asset')->where('id',$id)->value('valid_to');
                $dt = explode('/', $assetdateto);
                $dt = $dt[0];
                $mt = explode('/', $assetdateto);
                $mt = $mt[1];
                $yt = explode('/', $assetdateto);
                $yt = $yt[2];
                }
                $refinfo = DB::table('asset')->where('id',$id)->value('la_nla_type');
                $astrefinfo = DB::table('asset_type')->where('id',$refinfo)->get();
                $refissuetype = DB::table('asset_type')->where('id',$refinfo)->pluck('issuer_guild')->toArray();
                $issuetype = DB::table('member_groups')->whereIn('id',$refissuetype)->get();
                //return $issuetype;
                $matchmem = DB::table('match_member_groups')->whereIn('member_group_id',$refissuetype)->pluck('member_id')->toArray();
                $issue = DB::table('persons')->where('id',$matchmem)->get();
                $issueref = DB::table('persons')->where('id',$matchmem)->pluck('id')->toArray();
                $branch = DB::table('branch')->whereIn('org_id',$issueref)->get();
               // return $astrefinfo;
                //return $yf;
                // Redirect to country list if updating country wasn't existed
                if ($porttype == null) {
                  $porttype = Asset::find($id);
                  $data = array(
                      'porttype' => $porttype
                    );
                    return redirect ('/admin/asset');
                }


          $portcat = DB::table('asset_type')->get();
         return view('system-mgmt/asset-admin/edit', ['branch'=>$branch,'issuetype'=>$issuetype,'issue'=>$issue,'astrefinfo'=>$astrefinfo,'yt'=>$yt,'mt'=>$mt,'dt'=>$dt,'yf'=>$yf,'mf'=>$mf,'df'=>$df,'portcat' => $portcat,'porttype' => $porttype,'tree'=>$tree]);
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

       date_default_timezone_set('Asia/Bangkok');
       date('D-m-y H:i:s');
       $currenttime = date('d-m-y H:i:s');

         $input = [
           'name' => $request['name'],
           'ref_name' => $request['ref_name'],
           'la_nla_type' => $request['la_nla_type'],
           'sub_type' => $request['sub_type'],
      //     'port_id' => $request['port_id'],
           'last_modified_date' => $request['last_modified_date'],
           'ref_number1' => $request['ref_number1'],
           'ref_number2' => $request['ref_number2'],
           'ref_number3' => $request['ref_number3'],
           'ref_info1' => $request['ref_info1'],
           'ref_info2' => $request['ref_info2'],
           'ref_info3' => $request['ref_info3'],
           'ref_info4' => $request['ref_info4'],
           'ref_info5' => $request['ref_info5'],
           'ref_info6' => $request['ref_info6'],
           'ref_info7' => $request['ref_info7'],
           'ref_info8' => $request['ref_info8'],
           'ref_info9' => $request['ref_info9'],
           'ref_info10' => $request['ref_info10'],
           'ref_info11' => $request['ref_info11'],
           'ref_info12' => $request['ref_info12'],
           'ref_info13' => $request['ref_info13'],
           'ref_info14' => $request['ref_info14'],
           'ref_info15' => $request['ref_info15'],
           'ref_info16' => $request['ref_info16'],
           'ref_info17' => $request['ref_info17'],
           'ref_info18' => $request['ref_info18'],
           'link_underlying' => $request['link_underlying'],
           'amount' => $request['amount'],
           'value' => $request['value'],
           'cost' => $request['cost'],
           'ref_to_asset' => $request['ref_to_asset'],
           'valid_from' => $datef,
           'valid_to' => $datet,
           'file_attachment' => $request['file_attachment'],
           'link_to_more' => $request['link_to_more'],
           'contact_pid' => $request['contact_pid'],
           'note' => $request['note'],

           'issued_by' => $request['issued_by'],
           'branch_id' => $request['branch_id'],
           'last_modified_date' =>$currenttime

         ];
         $this->validate($request, [
        // 'type' => 'required|max:60'
         ]);
         Asset::where('id', $id)
             ->update($input);

             $previous = $request->previous;
             // return $previous;
             return redirect ('admin/asset');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Asset::where('id', $id)->delete();
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
             'la_nla_type' => $request['la_nla_type'],
             'la_nla' => $request['la_nla']

             ];

        $porttypes = $this->doSearchingQuery($constraints);
        return view('system-mgmt/asset-admin/index', ['porttypes' => $porttypes, 'searchingVals' => $constraints,'tree'=>$tree]);
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
