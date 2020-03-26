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
use App\Party;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\DataController;


class AssetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('view', ['except' => ['findAssetLabel','findPortnum','findPortMember','findPortAsset','findMemId','findMemRefid',
        'findMemType','findAssetType','findPartyName','findAssetIssue','findAssetIssueName','findAssetIssueBranch' ]]);
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
public function ownassetadmin()
     {

       //sidebar

       $tree = session()->get('tree');
       //sidebar

    $r = $_SERVER['REQUEST_URI'];
    $r = explode('/', $r);
    $r = $r[4];






       $porttypes = DB::table('asset')
       ->where('asset.port_id',$r)
       ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
       ->leftJoin('persons', 'asset.issued_by', '=', 'persons.id')
     // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
      ->select('asset.*', 'persons.name as issuer', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla')
        ->paginate(100000);
       return view('system-mgmt/asset-admin/ownasset', ['r'=>$r,'porttypes' => $porttypes,'tree'=>$tree]);
   }
     public function ownasset()
     {

       //sidebar

       $tree = session()->get('tree');
       //sidebar

    $r = $_SERVER['REQUEST_URI'];
    $r = explode('/', $r);
    $r = $r[4];



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






    $current = Auth::user()->id;


    $currentstruc = DB::table('user_auths')

          ->where([ //[ 'structure_id', '=',9 ],
                    [ 'user_id', '=', $current]

                 ])
                 ->pluck('structure_id');
      $currentstruc = $currentstruc->toArray();
      //  echo "<pre>";
      //  print_r($currentstruc);
      $persons = DB::table('persons');
    $notebook = array();
    $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
    $notebook = array_merge_recursive($currentid,$notebook);

    $current = Auth::user()->id;
    $curmem = DB::table('portfolio')

         ->whereIn('block_id',$notebook)

                ->pluck('member_id');
                $portfo = DB::table('portfolio')
              ->whereIn('member_id',$curmem)
                 //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา

                 ->pluck('id');
                 $portfo = $portfo->toArray();




  //  $portfolio = portfolio::find($id);
    $number = [123, 713, 3];
    // Redirect to city list if updating city wasn't existed
    //if ($id == $number )
      if(in_array($r, $portfo)){
       $porttypes = DB::table('asset')
       ->where('asset.port_id',$r)
       ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
       ->leftJoin('persons', 'asset.issued_by', '=', 'persons.id')
     // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
      ->select('asset.*', 'persons.name as issuer', 'asset_type.la_nla_type as asset_type_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla')
        ->paginate(100000);
       return view('system-mgmt/asset/ownasset', ['r'=>$r,'porttypes' => $porttypes,'tree'=>$tree]);
     }
     return view('errortype2');
   }
  /*  public function index()
    {

		//sidebar
    $current = Auth::user()->id;
    $currentstruc = DB::table('user_auths')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('structure_id');
        $currentstruc = $currentstruc->toArray();

        $currentmatchids = DB::table('match_id')

                ->where([
                          [ 'user_id', '=', $current]

                       ])
                       ->pluck('id');
            $currentmatchids = $currentmatchids->toArray();
            $currentpidgroups = DB::table('match_pid_groups')

                    ->where([
                              [ 'p_id', '=', $currentmatchids]

                           ])
                           ->pluck('pid_group_id');

             $currentusergroups = DB::table('match_user_groups')

                   ->where([
                       [ 'user_id', '=', $current]

                        ])
                        ->pluck('user_group_id');
                      $s = DB::table('user_auths')->pluck('block_id');
                      $s = $s->toArray();
                        if(in_array($current, $s)){
                           $currentid = DB::table('user_auths')

                                   ->where([ //[ 'structure_id', '=', 10 ],
                                             [ 'user_id', '=', $current]

                                          ])
                                          ->pluck('block_id');

                                          $currentid = $currentid->toArray();}
              $currentid = [0];
            //  $currentid = $currentid->toArray();
              $notebook = array();
             //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
            // $notebook = array_merge_recursive($currentid,$notebook);
            $notebook = array_merge_recursive($currentid,$notebook);
            $blocktd = array();
            $blocktd = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
            $blocktd = array_merge_recursive($currentid,$blocktd);
            $blockbtu = array();
            $blockbtu = $this->blockbtu($currentstruc,$currentid,$notebook);
            $blockbtu = array_merge_recursive($currentid,$blockbtu);

            $matchviews = DB::table('match_views as m')
            ->leftJoin('views', 'm.view_id', '=', 'views.id')

           ->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
           ->whereIn(
             'structure.id',$currentstruc
           )
           ->leftJoin('block as b', 'm.block_id', '=', 'b.id')
           ->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
           ->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')


          ->leftJoin('users', 'm.user_id', '=', 'users.id')
          ->orWhere(
            'users.id',$current
          )
          ->orwhereIn(
            'pid_groups.id',$currentpidgroups
          )
          ->orwhereIn(
            'user_groups.id',$currentusergroups
          )
          ->orwhereIn(
            'b.id',$notebook
          )
          ->orwhereIn(
            'bt.id',$blocktd
          )
          ->orwhereIn(
            'bb.id',$blockbtu
          )
          ->orwhere(
            'm.all_user','=','Yes'
          )
          ->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

         ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

         ->select('m.*','m.id', 'views.name as view_name', 'views.id as view_id','users.username as user_name',
          'users.id as user_id','structure.name as structure_name', 'structure.id as strucutre_id','b.name as block_name','bt.name as blocktop_name','bb.name as blockbottom_name', 'b.id as block_id', 'bt.id as blocktop_id', 'bb.id as blockbottom_id',
          'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','user_groups.name as user_group_name', 'user_groups.id as user_group_id')
           ->pluck('view_id');


           $views = View::whereIn('id',$matchviews )
                          ->where('belong_to','=',NULL )->get();
                          $viewss = View::whereIn('id',$matchviews )
                                         ->pluck('id');
                                         $viewss =$viewss->toArray();
           $tree='<li class="treeview"></li>';
           foreach ($views as $view) {

                if(count($view->childs) &&in_array($view->id, $viewss)&& $view->add_to_side == "Yes"){
                  $tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i>'.$view->name.'     <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span></a>';

                }elseif($view->add_to_side == "Yes"){
                  $tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i>'.$view->name.'
                          </span></a>';
                }

                if(count($view->childs)) {

                   $tree .=$this->childView($view,$viewss);
               }
           }
           $tree .='<ul class="sidebar-menu">';

		//sidebar
      $porttypes = DB::table('asset')
      ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')

    // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
     ->select('asset.*', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla')
       ->paginate(30);
      return view('system-mgmt/asset/index', ['porttypes' => $porttypes,'tree'=>$tree]);
    }*/



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

           $currentport = $_SERVER['REQUEST_URI'];
           $currentport = explode('/', $currentport);
           $currentport = $currentport[4];

           $checkurl = $_SERVER['REQUEST_URI'];
           $checkurl = explode('/', $checkurl);

           if(in_array('allinone',$checkurl)){
           $currentport = $_SERVER['REQUEST_URI'];

					 $currentport = explode('pf', $currentport);

					 $currentport = $currentport[1];
          // return $currentport;
           }


          //return $currentport;
           $findporttype = DB::table('portfolio')->where('id',$currentport)->value('port_id');
           $portasset =DB::table('port_asset_type')->where('port_type_id',$findporttype)->pluck('asset_type_id');
          // return $findporttype;//$assettype = DB::table()
           $assettype = DB::table('asset_type')->whereIn('id',$portasset)->get();
           //return $assettype;
           $portcat = DB::table('asset_type')->get();
           $status = DB::table('asset_status')->get();
           $checkurl = $_SERVER['REQUEST_URI'];
           $checkurl = explode('/', $checkurl);



         return view('system-mgmt/asset/create',['status'=>$status,'assettype'=>$assettype,'portcat'=>$portcat,'tree'=>$tree]);
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
         $asset->ref_info9 = $request -> ref_info9;
         $asset->ref_info10 = $request -> ref_info10;
         $asset->ref_info11 = $request -> ref_info11;
         $asset->ref_info12 = $request -> ref_info12;
         $asset->ref_info13 = $request -> ref_info13;
         $asset->ref_info14 = $request -> ref_info14;
         $asset->ref_info15 = $request -> ref_info15;
         $asset->ref_info16 = $request -> ref_info16;
         $asset->ref_info17 = $request -> ref_info17;
         $asset->ref_info18 = $request -> ref_info18;
         $asset->link_underlying = $request -> link_underlying;
         $asset->amount = $request -> amount;
         $asset->value = $request -> value;
         $asset->cost = $request -> cost;
         $asset->ref_to_asset = $request -> ref_to_asset;
         $asset->valid_from = $datef;
         $asset->valid_to = $datet;
         $asset->file_attachment = $request -> file_attachment;
         $asset->link_to_more = $request -> link_to_more;
         $asset->contact_pid = $request -> contact_pid;

         $asset->issued_by = $request ->issued_by;
         $asset->branch_id = $request ->branch_id;
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

         $previous = $request->previous;
        // return $previous;
        $checkurl = url()->previous();
        $checkurl = explode('/', $checkurl);
        //$checkurl = $checkurl[6];
        if(in_array('pnumber',$checkurl)){
          //return 'yes';
          $url = url()->previous();
          /*$ptnum = explode('pty', $url);
          $ptnum = $ptnum[1];
        //  return $ptnum;
          $stnum = explode('str', $url);
          $stnum = $stnum[1];
          $bnum = explode('blc', $url);
          $bnum = $bnum[1];*/
          $ownum = explode('aow', $url);
          $ownum = $ownum[1];
      //    return $ownum;
          $getcurnum = explode('refm', $url);
          $getcurnum = $getcurnum[1];
          $getpnum = explode('pf', $url);
          $getpnum = $getpnum[1];

          $url2 = '/Nonlife/create??/refermem/refm'.$getcurnum.'refm/owner/aow'.$ownum.'aow/pnumber/pf'.$getpnum.'pf/reasnumber/as'.$asset->id.'as';
        return redirect($url2);
     }
     return redirect ($previous);
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



            $porttypes = DB::table('asset')
            ->where('asset.id',$id)
            ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
            ->leftJoin('portfolio','asset.port_id','=','portfolio.id')
           ->select('asset.*', 'portfolio.id as port_id', 'portfolio.type as port_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla')
             ->paginate(30);
         return view('system-mgmt/asset/show',['porttypes'=>$porttypes,'tree' => $tree]);
     }

     public function detail($id)
     {
       //sidebar

       $tree = session()->get('tree');
       //sidebar

         $currentid = Auth::user()->id;
         $findfileid = DB::table('asset_attachment')->where('asset_id',$id)->pluck('file_id');
         $fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','Active')->get();
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






      $current = Auth::user()->id;


      $currentstruc = DB::table('user_auths')

            ->where([ //[ 'structure_id', '=',9 ],
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('structure_id');
        $currentstruc = $currentstruc->toArray();
        //  echo "<pre>";
        //  print_r($currentstruc);
        $persons = DB::table('persons');
      $notebook = array();
      $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
      $notebook = array_merge_recursive($currentid,$notebook);

      $current = Auth::user()->id;
      $curmem = DB::table('portfolio')

           ->whereIn('block_id',$notebook)

                  ->pluck('member_id');
                  $portfo = DB::table('portfolio')
                ->whereIn('member_id',$curmem)
                   //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา

                   ->pluck('id');
                   $portfo = $portfo->toArray();




    //  $portfolio = portfolio::find($id);
      $number = [123, 713, 3];
      // Redirect to city list if updating city wasn't existed
      //if ($id == $number )
        if(in_array($r, $portfo)){
      $assetnumber = Asset::where('id',$id)
     ->value('id');
     $name1 = 'Asset_Attachment_'.$r;
     $filerefname =$name1.'_'.$assetnumber ;
     $filecat ='CA8CA';

     $portid = DB::table('asset')
     ->where('asset.id',$id)
     ->value('port_id');
     //return $portid;
     $findblock = DB::table('portfolio')->where('id',$portid)->value('block_id');
     $conblock = DB::table('block')->where('id',$findblock)->get();
     //return $conblock;
            $porttypes = DB::table('asset')
            ->where('asset.id',$id)
            ->where('asset.port_id',$r)
            ->leftJoin('branch', 'asset.branch_id', '=', 'branch.id')
            ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
            ->leftJoin('member_groups', 'asset_type.issuer_guild', '=', 'member_groups.id')
            ->leftJoin('match_member_groups', 'member_groups.id', '=', 'match_member_groups.member_group_id')
            ->leftJoin('persons', 'asset.issued_by', '=', 'persons.id')
            ->leftJoin('portfolio','asset.port_id','=','portfolio.id')
           ->select('asset.*', 'portfolio.id as port_id', 'portfolio.type as port_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla'
           ,'asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8'
           ,'asset_type.ref_info_head9 as ref_head9','asset_type.ref_info_head10 as ref_head10','asset_type.ref_info_head11 as ref_head11','asset_type.ref_info_head12 as ref_head12','asset_type.ref_info_head13 as ref_head13','asset_type.ref_info_head14 as ref_head14','asset_type.ref_info_head15 as ref_head15','asset_type.ref_info_head16 as ref_head16'
           ,'asset_type.ref_info_head17 as ref_head17','asset_type.ref_name_head as name_head','asset_type.ref_info_head18 as ref_head18','asset_type.ref_num_head1 as num_head1','asset_type.ref_num_head2 as num_head2','asset_type.ref_num_head3 as num_head3','member_groups.name as guild_name','persons.name as member_name'
           ,'persons.emergency_name as emergency_name','persons.emergency_phone as emergency_phone','persons.emergency_email as emergency_email','branch.name as branch_name'
           ,'branch.tel as branch_tel','branch.fax as branch_fax','branch.con_name as branch_con_name','branch.con_tel as branch_con_tel','branch.con_email as branch_con_email','branch.con_lastname as branch_con_lastname')
             ->paginate(30);
         return view('system-mgmt/asset/show',['conblock'=>$conblock,'portid'=>$portid,'fileasset'=>$fileasset,'filerefname'=>$filerefname,'filecat'=>$filecat,'portnumber'=>$portnumber,'porttypes'=>$porttypes,'tree' => $tree]);
     }
     return view('errortype2');
   }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $tree = session()->get('tree');
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
         $issue = 0;
         $issueref = 0;
         $matchmem = DB::table('match_member_groups')->whereIn('member_group_id',$refissuetype)->pluck('member_id')->toArray();
         $issue = DB::table('persons')->where('id',0)->get();;
         $issueref = DB::table('persons')->where('id',0)->pluck('id')->toArray();
         if($matchmem != NULL){
         $issue = DB::table('persons')->where('id',$matchmem)->get();
         $issueref = DB::table('persons')->where('id',$matchmem)->pluck('id')->toArray();
         }
         $branch = DB::table('branch')->whereIn('org_id',$issueref)->get();
        // return $astrefinfo;
         //return $yf;
         // Redirect to country list if updating country wasn't existed

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






      $current = Auth::user()->id;


      $currentstruc = DB::table('user_auths')

            ->where([ //[ 'structure_id', '=',9 ],
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('structure_id');
        $currentstruc = $currentstruc->toArray();
        //  echo "<pre>";
        //  print_r($currentstruc);
        $persons = DB::table('persons');
      $notebook = array();
      $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
      $notebook = array_merge_recursive($currentid,$notebook);

      $current = Auth::user()->id;
      $curmem = DB::table('portfolio')

           ->whereIn('block_id',$notebook)

                  ->pluck('member_id');
                  $portfo = DB::table('portfolio')
                ->whereIn('member_id',$curmem)
                   //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา

                   ->pluck('id');
                   $portfo = $portfo->toArray();




    //  $portfolio = portfolio::find($id);
      $port = DB::table('asset')->where('id',$id)->value('port_id');
      $number = [123, 713, 3];
      // Redirect to city list if updating city wasn't existed
      //if ($id == $number )
        if(in_array($port, $portfo)){
          $portcat = DB::table('asset_type')->get();

          //  return $port;
          return view('system-mgmt/asset/edit', ['branch'=>$branch,'issuetype'=>$issuetype,'issue'=>$issue,'astrefinfo'=>$astrefinfo,'yt'=>$yt,'mt'=>$mt,'dt'=>$dt,'yf'=>$yf,'mf'=>$mf,'df'=>$df,'portcat' => $portcat,'porttype' => $porttype,'tree'=>$tree]);
         }

        return view('errortype2');
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
       $df = $request->df;
       $mf = $request->mf;
       $yf = $request->yf;
       $datef = $df."/".$mf."/".$yf;
       $dt = $request->dt;
       $mt = $request->mt;
       $yt = $request->yt;
       $datet = $dt."/".$mt."/".$yt;
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
             return redirect ($previous);
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
        return view('system-mgmt/asset/index', ['porttypes' => $porttypes, 'searchingVals' => $constraints,'tree'=>$tree]);
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

     public function findAssetLabel(Request $request){
     $data=Asset_type::select('*')->where('id',$request->id) ->get();
     return response()->json($data);
     }
     public function findAssetIssue(Request $request){

         $data= DB::table('asset_type')->where('asset_type.id',$request->id)
         ->leftJoin('member_groups','asset_type.issuer_guild','=','member_groups.id')
         ->leftJoin('match_member_groups', 'member_groups.id', '=', 'match_member_groups.member_group_id')
         ->leftJoin('persons', 'persons.id', '=', 'match_member_groups.member_id')
		->orderBy('persons.name','ASC')
         ->select('asset_type.*','member_groups.name as guild_name','persons.name as member_name','persons.id as member_id')->get();

         return response()->json($data);

     }

     public function findAssetIssueName(Request $request){

         $data= DB::table('match_member_groups')->where('match_member_groups.member_group_id',$request->id)
         ->leftJoin('persons','match_member_groups.member_id','=','persons.id')
         ->select('match_member_groups.*','persons.name as member_name','persons.id as member_id')->get();

         return response()->json($data);

     }
     public function findAssetIssueBranch(Request $request){

         $data= DB::table('branch')->where('org_id',$request->id)
         ->get();

         return response()->json($data);

     }

     public function findAssetRef(Request $request){
     $data=Asset_type::select('ref_info_head1','ref_info_head2','ref_info_head3','ref_info_head4','ref_info_head5','ref_info_head6','ref_info_head7','ref_info_head8')->where('id',$request->id) ->get();
     return response()->json($data);
     }

     public function findPortnum(Request $request){
     $data=Portfolio::select('id')->where('id',$request->id) ->get();
     return response()->json($data);
     }

     public function findPortMember(Request $request){
     $data=Portfolio::select('id','type','number')->where('member_id',$request->id) ->get();
     return response()->json($data);
     }

     public function findPortAsset(Request $request){
       $data= DB::table('asset')
       ->leftJoin('asset_type','asset.la_nla_type', '=','asset_type.id')
       ->where('asset_type.la_nla','=','Non Liquidity Asset')
       ->where('asset.port_id',$request->id)
       ->select('asset.name','asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8')
        ->get();
     return response()->json($data);
     }
     public function findMemId(Request $request){
     $data=Person::select('id','name','lname')->where('id',$request->id) ->get();
     return response()->json($data);
     }
     public function findMemRefid(Request $request){
     $data=Person::select('id','name','lname')->where('id',$request->id) ->get();
     return response()->json($data);
     }
     public function findAssetType(Request $request){
     $data= DB::table('asset')
     ->leftJoin('asset_type','asset.la_nla_type', '=','asset_type.id')
     ->where('asset_type.la_nla','=','Non Liquidity Asset')
     ->where('asset.id',$request->id)
     ->select('asset.name','asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8')
      ->get();
     return response()->json($data);
     }

     public function findMemType(Request $request){

       if($request->id == 1)
       {
         $data= DB::table('persons')
         ->whereIn('type',[$request->id,0])
         ->get();
       }
       else{

     $data= DB::table('persons')
     ->where('type',$request->id)
     ->get();
   }
     return response()->json($data);
     }

     public function findPartyName(Request $request){
       $data=Party::select('name','id')->where('member_group_id',$request->id)->get();
       return response()->json($data);
     }

public function allasset(){
        //sidebar

       $tree = session()->get('tree');
       //sidebar
             $refass = DB::table('asset')
       ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
       //->where('asset_type.la_nla','=','Non Liquidity Asset')
       ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
       ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
       ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
       ->leftjoin('structure','portfolio.structure_id','=','structure.id')
       ->where('structure.id',14)
      // ->leftJoin('users', 'block.user_id', '=', 'users.id')
     // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
        ->pluck('asset.ref_to_asset');
         $porttypes = DB::table('asset')
         ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
         ->where('asset_type.la_nla','=','Non Liquidity Asset')
         ->whereIn('asset.id',$refass)
         ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
         ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
         ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')

        // ->leftJoin('users', 'block.user_id', '=', 'users.id')
       // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
        ->select('asset.*', 'block.name as block_name', 'persons.name as member_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla')
         	->orderBy('created_at','desc')
			 ->paginate(30);
         return view('system-mgmt/asset/allasset', ['porttypes' => $porttypes,'tree'=>$tree]);
     }
     public function showfromall($id){
       //sidebar

       $tree = session()->get('tree');
       //sidebar
       $findfileid = DB::table('asset_attachment')->where('asset_id',$id)->pluck('file_id');
       $fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','Active')->get();
      // return $fileasset;


      $assetnumber = Asset::where('id',$id)
     ->value('id');
       $portid = DB::table('asset')
       ->where('asset.id',$id)
       ->value('port_id');
       $name1 = 'Asset_Attachment_'.$portid;
       $filerefname =$name1.'_'.$assetnumber ;
       $filecat ='CA8CA';
        $portnumber = DB::table('portfolio')->where('id',$portid)->value('id');
       $findblock = DB::table('portfolio')->where('id',$portid)->value('block_id');
       $conblock = DB::table('block')->where('id',$findblock)->get();
       $refass = DB::table('asset')
       ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
       //->where('asset_type.la_nla','=','Non Liquidity Asset')
       ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
       ->leftJoin('persons', 'asset.issued_by', '=', 'persons.id')
       ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
       ->leftjoin('structure','portfolio.structure_id','=','structure.id')
       ->where('structure.id',14)
       ->pluck('asset.ref_to_asset');

       $porttypes = DB::table('asset')
       ->where('asset.id',$id)
       ->whereIn('asset.id',$refass)
       ->leftJoin('branch', 'asset.branch_id', '=', 'branch.id')
       ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
       ->leftJoin('member_groups', 'asset_type.issuer_guild', '=', 'member_groups.id')
       ->leftJoin('match_member_groups', 'member_groups.id', '=', 'match_member_groups.member_group_id')
       ->leftJoin('persons', 'asset.issued_by', '=', 'persons.id')
       ->leftJoin('portfolio','asset.port_id','=','portfolio.id')
       ->select('asset.*', 'portfolio.id as port_id', 'portfolio.type as port_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla'
       ,'asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8'
       ,'asset_type.ref_info_head9 as ref_head9','asset_type.ref_info_head10 as ref_head10','asset_type.ref_info_head11 as ref_head11','asset_type.ref_info_head12 as ref_head12','asset_type.ref_info_head13 as ref_head13','asset_type.ref_info_head14 as ref_head14','asset_type.ref_info_head15 as ref_head15','asset_type.ref_info_head16 as ref_head16'
       ,'asset_type.ref_info_head17 as ref_head17','asset_type.ref_name_head as name_head','asset_type.ref_info_head18 as ref_head18','asset_type.ref_num_head1 as num_head1','asset_type.ref_num_head2 as num_head2','asset_type.ref_num_head3 as num_head3','member_groups.name as guild_name','persons.name as member_name'
       ,'persons.emergency_name as emergency_name','persons.emergency_phone as emergency_phone','persons.emergency_email as emergency_email','branch.name as branch_name'
       ,'branch.tel as branch_tel','branch.fax as branch_fax','branch.con_name as branch_con_name','branch.con_tel as branch_con_tel','branch.con_email as branch_con_email','branch.con_lastname as branch_con_lastname')
       	        ->orderBy('created_at','desc')

		   ->paginate(30);
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






       $current = Auth::user()->id;


       $currentstruc = DB::table('user_auths')

             ->where([ //[ 'structure_id', '=',9 ],
                       [ 'user_id', '=', $current]

                    ])
                    ->pluck('structure_id');
         $currentstruc = $currentstruc->toArray();
         //  echo "<pre>";
         //  print_r($currentstruc);
         $persons = DB::table('persons');
       $notebook = array();
       $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
       $notebook = array_merge_recursive($currentid,$notebook);

       $current = Auth::user()->id;
       $curmem = DB::table('portfolio')

            ->whereIn('block_id',$notebook)

                   ->pluck('member_id');
                   $portfo = DB::table('portfolio')
                 ->whereIn('member_id',$curmem)
                    //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา

                    ->pluck('id');
                    $portfo = $portfo->toArray();
                    $port = DB::table('asset')->where('id',$id)->value('port_id');
  //return $nl;
 if (in_array($port,$portfo)) {
         return view('system-mgmt/asset/showfromall', ['filerefname' =>$filerefname,'filecat' =>$filecat,'portnumber' =>$portnumber,'fileasset' =>$fileasset,'conblock' => $conblock,'portid' => $portid,'portid' => $portid,'porttypes' => $porttypes,'tree'=>$tree]);
     }
     return view('errortype2');
}
     public function editfromall($id)
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
         $issue = 0;
         $issueref = 0;
         $matchmem = DB::table('match_member_groups')->whereIn('member_group_id',$refissuetype)->pluck('member_id')->toArray();
         $issue = DB::table('persons')->where('id',0)->get();;
         $issueref = DB::table('persons')->where('id',0)->pluck('id')->toArray();
         if($matchmem != NULL){
         $issue = DB::table('persons')->where('id',$matchmem)->get();
         $issueref = DB::table('persons')->where('id',$matchmem)->pluck('id')->toArray();
         }
         $branch = DB::table('branch')->whereIn('org_id',$issueref)->get();
        // return $astrefinfo;
         //return $yf;
         // Redirect to country list if updating country wasn't existed

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






               $current = Auth::user()->id;


               $currentstruc = DB::table('user_auths')

                     ->where([ //[ 'structure_id', '=',9 ],
                               [ 'user_id', '=', $current]

                            ])
                            ->pluck('structure_id');
                 $currentstruc = $currentstruc->toArray();
                 //  echo "<pre>";
                 //  print_r($currentstruc);
                 $persons = DB::table('persons');
               $notebook = array();
               $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
               $notebook = array_merge_recursive($currentid,$notebook);

               $current = Auth::user()->id;
               $curmem = DB::table('portfolio')

                    ->whereIn('block_id',$notebook)

                           ->pluck('member_id');
                           $portfo = DB::table('portfolio')
                         ->whereIn('member_id',$curmem)
                            //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา

                            ->pluck('id');
                            $portfo = $portfo->toArray();
                            $port = DB::table('asset')->where('id',$id)->value('port_id');
          //return $nl;
         if (in_array($port,$portfo)) {

           $porttransaction  = DB::table('asset_transaction')->where('asset_id',21)->get();
         //  return $porttransaction;
          $portcat = DB::table('asset_type')->get();
         return view('system-mgmt/asset/editfromall', ['branch'=>$branch,'issuetype'=>$issuetype,'issue'=>$issue,'astrefinfo'=>$astrefinfo,'yt'=>$yt,'mt'=>$mt,'dt'=>$dt,'yf'=>$yf,'mf'=>$mf,'df'=>$df,'portcat' => $portcat,'porttype' => $porttype,'tree'=>$tree]);
     }
     return view('errortype2');
}
     public function searchfromall(Request $request) {

       //sidebar

       $tree = session()->get('tree');
       //sidebar

         $constraints = [
           //'asset_type.la_nla' => $request['la_nla'],
           'persons.name' => $request['member_name'],
           'users.firstname' => $request['user_name'],
           'asset_type.la_nla_type' => $request['asset_type_name'],
           'asset.name' => $request['name'],
           'block.name' => $request['block_name'],
             ];

        $porttypes = $this->doSearchingQueryFromall($constraints);
        $constraints['member_name'] = $request['member_name'];
       $constraints['user_name'] = $request['user_name'];
       $constraints['asset_type_name'] = $request['asset_type_name'];
       $constraints['name'] = $request['name'];
       $constraints['block_name'] = $request['block_name'];
        return view('system-mgmt/asset/allasset', ['porttypes' => $porttypes, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQueryFromall($constraints) {
       $refass = DB::table('asset')
      ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
      //->where('asset_type.la_nla','=','Non Liquidity Asset')
      ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
      ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
      ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
      ->leftjoin('structure','portfolio.structure_id','=','structure.id')
      ->where('structure.id',14)
      // ->leftJoin('users', 'block.user_id', '=', 'users.id')
      // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
      ->pluck('asset.ref_to_asset');
      $query = DB::table('asset')
      ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
      ->where('asset_type.la_nla','=','Non Liquidity Asset')
      ->whereIn('asset.id',$refass)
      ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
      ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
      ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')

      // ->leftJoin('users', 'block.user_id', '=', 'users.id')
      // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
      ->select('asset.*', 'block.name as block_name', 'persons.name as member_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla');
         $fields = array_keys($constraints);
         $index = 0;
         foreach ($constraints as $constraint) {
             if ($constraint != null) {
                 $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
             }

             $index++;
         }
         return $query->paginate(100000000);
     }

     public function onlynon(){
       //sidebar
       $datacontroller = New DataController;
       $day = $datacontroller->loadday();
       $moth = $datacontroller->loadmonth();
       $year = $datacontroller->loadyear();
       $assettype = Asset_type::all();
       $tree = session()->get('tree');
       //sidebar
         $porttypes = DB::table('asset')
         ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
         //->where('asset_type.la_nla','=','Non Liquidity Asset')
         ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
         ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
         ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
         ->leftjoin('structure','portfolio.structure_id','=','structure.id')
         ->where('structure.id',14)
        // ->leftJoin('users', 'block.user_id', '=', 'users.id')
       // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
        ->select('asset.*', 'block.name as block_name', 'persons.name as member_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla')
        ->orderBy('created_at', 'desc')
          ->paginate(30);

         return view('system-mgmt/asset/onlynon', ['day' => $day,'moth' => $moth,'year' => $year,'assettype' => $assettype,'porttypes' => $porttypes,'tree'=>$tree]);
     }
     public function showonlynon($id){
       //sidebar

       $tree = session()->get('tree');
       //sidebar
       $findfileid = DB::table('asset_attachment')->where('asset_id',$id)->pluck('file_id');
       $fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','Active')->get();
      // return $fileasset;


      $assetnumber = Asset::where('id',$id)
     ->value('id');
       $portid = DB::table('asset')
       ->where('asset.id',$id)
       ->value('port_id');
       $name1 = 'Asset_Attachment_'.$portid;
       $filerefname =$name1.'_'.$assetnumber ;
       $filecat ='CA8CA';
        $portnumber = DB::table('portfolio')->where('id',$portid)->value('id');
       $findblock = DB::table('portfolio')->where('id',$portid)->value('block_id');
       $conblock = DB::table('block')->where('id',$findblock)->get();
       $refass = DB::table('asset')
       ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
       ->where('asset_type.la_nla','=','Non Liquidity Asset')
       ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
       ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
       ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
       ->leftjoin('structure','portfolio.structure_id','=','structure.id')
       ->where('structure.id',14)
       ->pluck('asset.id');

       $porttypes = DB::table('asset')
       ->where('asset.id',$id)
       ->leftJoin('branch', 'asset.branch_id', '=', 'branch.id')
       ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
       ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
       ->leftJoin('member_groups', 'asset_type.issuer_guild', '=', 'member_groups.id')
       ->leftJoin('match_member_groups', 'member_groups.id', '=', 'match_member_groups.member_group_id')
->leftJoin('persons', 'asset.issued_by', '=', 'persons.id')
		   ->leftjoin('structure','portfolio.structure_id','=','structure.id')
       ->where('structure.id',14)
       ->select('asset.*', 'portfolio.id as port_id', 'portfolio.type as port_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla'
       ,'asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8'
       ,'asset_type.ref_info_head9 as ref_head9','asset_type.ref_info_head10 as ref_head10','asset_type.ref_info_head11 as ref_head11','asset_type.ref_info_head12 as ref_head12','asset_type.ref_info_head13 as ref_head13','asset_type.ref_info_head14 as ref_head14','asset_type.ref_info_head15 as ref_head15','asset_type.ref_info_head16 as ref_head16'
       ,'asset_type.ref_info_head17 as ref_head17','asset_type.ref_name_head as name_head','asset_type.ref_info_head18 as ref_head18','asset_type.ref_num_head1 as num_head1','asset_type.ref_num_head2 as num_head2','asset_type.ref_num_head3 as num_head3','member_groups.name as guild_name','persons.name as member_name'
       ,'persons.emergency_name as emergency_name','persons.emergency_phone as emergency_phone','persons.emergency_email as emergency_email','branch.name as branch_name'
       ,'branch.tel as branch_tel','branch.fax as branch_fax','branch.con_name as branch_con_name','branch.con_tel as branch_con_tel','branch.con_email as branch_con_email','branch.con_lastname as branch_con_lastname')
        ->paginate(30);
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






        $current = Auth::user()->id;


        $currentstruc = DB::table('user_auths')

              ->where([ //[ 'structure_id', '=',9 ],
                        [ 'user_id', '=', $current]

                     ])
                     ->pluck('structure_id');
          $currentstruc = $currentstruc->toArray();
          //  echo "<pre>";
          //  print_r($currentstruc);
          $persons = DB::table('persons');
        $notebook = array();
        $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
        $notebook = array_merge_recursive($currentid,$notebook);

        $current = Auth::user()->id;
        $curmem = DB::table('portfolio')

             ->whereIn('block_id',$notebook)

                    ->pluck('member_id');
                    $portfo = DB::table('portfolio')
                  ->whereIn('member_id',$curmem)
                     //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา

                     ->pluck('id');
                     $portfo = $portfo->toArray();
                     $port = DB::table('asset')->where('id',$id)->value('port_id');
   //return $nl;
  if (in_array($port,$portfo)) {
         return view('system-mgmt/asset/showonlynon', ['filerefname' =>$filerefname,'filecat' =>$filecat,'portnumber' =>$portnumber,'fileasset' =>$fileasset,'conblock' => $conblock,'portid' => $portid,'portid' => $portid,'porttypes' => $porttypes,'tree'=>$tree]);
     }
     return view('errortype2');
   }
     public function editonlynon($id)
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
         $issue = 0;
         $issueref = 0;
         $matchmem = DB::table('match_member_groups')->whereIn('member_group_id',$refissuetype)->pluck('member_id')->toArray();
         $issue = DB::table('persons')->where('id',0)->get();;
         $issueref = DB::table('persons')->where('id',0)->pluck('id')->toArray();
         if($matchmem != NULL){
         $issue = DB::table('persons')->where('id',$matchmem)->get();
         $issueref = DB::table('persons')->where('id',$matchmem)->pluck('id')->toArray();
         }
         $branch = DB::table('branch')->whereIn('org_id',$issueref)->get();
        // return $astrefinfo;
         //return $yf;
         // Redirect to country list if updating country wasn't existed

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






                        $current = Auth::user()->id;


                        $currentstruc = DB::table('user_auths')

                              ->where([ //[ 'structure_id', '=',9 ],
                                        [ 'user_id', '=', $current]

                                     ])
                                     ->pluck('structure_id');
                          $currentstruc = $currentstruc->toArray();
                          //  echo "<pre>";
                          //  print_r($currentstruc);
                          $persons = DB::table('persons');
                        $notebook = array();
                        $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
                        $notebook = array_merge_recursive($currentid,$notebook);

                        $current = Auth::user()->id;
                        $curmem = DB::table('portfolio')

                             ->whereIn('block_id',$notebook)

                                    ->pluck('member_id');
                                    $portfo = DB::table('portfolio')
                                  ->whereIn('member_id',$curmem)
                                     //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา

                                     ->pluck('id');
                                     $portfo = $portfo->toArray();
                                     $port = DB::table('asset')->where('id',$id)->value('port_id');
                   //return $nl;
                  if (in_array($port,$portfo)) {
           $porttransaction  = DB::table('asset_transaction')->where('asset_id',21)->get();
         //  return $porttransaction;
          $portcat = DB::table('asset_type')->get();
         return view('system-mgmt/asset/editonlynon', ['branch'=>$branch,'issuetype'=>$issuetype,'issue'=>$issue,'astrefinfo'=>$astrefinfo,'yt'=>$yt,'mt'=>$mt,'dt'=>$dt,'yf'=>$yf,'mf'=>$mf,'df'=>$df,'portcat' => $portcat,'porttype' => $porttype,'tree'=>$tree]);
     }
     return view('errortype2');
}
     public function searchonlynon(Request $request) {

       //sidebar

       $tree = session()->get('tree');
       //sidebar
       $datacontroller = New DataController;
       $day = $datacontroller->loadday();
       $moth = $datacontroller->loadmonth();
       $year = $datacontroller->loadyear();
       $assettype = Asset_type::all();
       $fromdate =  $request->valid_from_day.'/'.$request->valid_from_month.'/'.$request->valid_from_year;
       $todate =   $request->valid_to_day.'/'.$request->valid_to_month.'/'.$request->valid_to_year;
       if($fromdate =='//')
       {
         $fromdate = '';
       }
       if($todate == '//')
       {
         $todate = '';
       }
         $constraints = [
           //'asset_type.la_nla' => $request['la_nla'],
           'persons.name' => $request['member_name'],
           'users.firstname' => $request['user_name'],
           'asset.la_nla_type' => $request['asset_type'],
           'asset.name' => $request['name'],
           'asset.valid_from' => $fromdate,
           'asset.valid_to' => $todate,
           'block.name' => $request['block_name'],
             ];
        $porttypes = $this->doSearchingQueryOnlynon($constraints);
        $constraints['member_name'] = $request['member_name'];
       $constraints['user_name'] = $request['user_name'];
       $constraints['asset_type_name'] = $request['asset_type_name'];
       $constraints['name'] = $request['name'];
       $constraints['block_name'] = $request['block_name'];
        return view('system-mgmt/asset/onlynon', ['day' => $day,'moth' => $moth,'year' => $year,'assettype' => $assettype,'porttypes' => $porttypes, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQueryOnlynon($constraints) {

         $query =DB::table('asset')
         ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
        // ->where('asset_type.la_nla','=','Non Liquidity Asset')
         ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
         ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
         ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
         ->leftjoin('structure','portfolio.structure_id','=','structure.id')
         ->where('structure.id',14)
        // ->leftJoin('users', 'block.user_id', '=', 'users.id')
       // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
        ->select('asset.*', 'block.name as block_name', 'asset_type.nla_sub_type as asset_subtype_name', 'persons.name as member_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla');
         $fields = array_keys($constraints);
         $index = 0;
         foreach ($constraints as $constraint) {
             if ($constraint != null) {
                 $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
             }

             $index++;
         }
         return $query->paginate(100000000);
     }

     public function savedataexcelcar($request)
     {
       $findmember  =Person::where('customer_code',$request->customer_code)->value('id');
       $portfolio = Portfolio::where('member_id',$findmember)->value('id');
       $validfrom = explode('/',$request->valid_from);
       $validfromday = $validfrom[0];
       $validfrommonth= $validfrom[1];
       $validfromyear = $validfrom[2];

       $validto = explode('/',$request->valid_to);
       $validtoday = $validto[0];
       $validtomonth= $validto[1];
       $validtoyear = $validto[2];

       $asset = new Asset;
       $asset->name = $request -> ref_name;
       $asset->ref_name = $request -> ref_name;
       $asset->la_nla_type = 5;
       $asset->port_id = $portfolio;
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
       $asset->ref_info9 = $request -> ref_info9;
       $asset->ref_info10 = $request -> ref_info10;
       $asset->ref_info11 = $request -> ref_info11;
       $asset->ref_info12 = $request -> ref_info12;
       $asset->ref_info13 = $request -> ref_info13;
       $asset->ref_info14 = $request -> ref_info14;
       $asset->ref_info15 = $request -> ref_info15;
       $asset->ref_info16 = $request -> ref_info16;
       $asset->ref_info17 = $request -> ref_info17;
       $asset->ref_info18 = $request -> ref_info18;
       $asset->amount =1;
       $asset->value = $request -> value;
       $asset->cost = $request -> cost;
       $asset->issued_by = $request ->issued_by;
       $asset->branch_id = $request ->branch_id;
       $asset->note = $request -> note;
       $asset->note = $valid_from -> valid_from;
       $asset->note = $valid_to-> valid_to;
       $asset->save();
       $d = $request->d;
       $m = $request->m;
       $y = $request->y;
       $date = $d."/".$m."/".$y;
       Asset_Transaction::create([
        //  'date' => $date,
        ///  'time' => $request['time'],
        //  'l_s' => $request['l_s'],
        //  'o_c' => $request['o_c'],
          'port_id' => $portfolio,
          'asset_id' => $asset->id,
      //    'symbol' => $request['symbol'],
        //  'underlying_id' => $request['underlying_id'],
      //    'volumn' => $request['volumn'],
      //    'price' => $request['price'],
      //    'status' => $request['status'],
      //    'note' => $request['note'],
      ]);
     }
     public function savedataexcelcarinsurance($request)
     {
       $findmember  =Person::where('customer_code',$request->customer_code)->value('id');
       $portfolio = Portfolio::where('member_id',$findmember)->where('structure_id',14)->where()->value('id');
       $asset = new Asset;
       $asset->name = $request -> ref_name;
       $asset->ref_name = $request -> ref_name;
       $asset->la_nla_type = 5;
       $asset->port_id = $portfolio;
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
       $asset->ref_info9 = $request -> ref_info9;
       $asset->ref_info10 = $request -> ref_info10;
       $asset->ref_info11 = $request -> ref_info11;
       $asset->ref_info12 = $request -> ref_info12;
       $asset->ref_info13 = $request -> ref_info13;
       $asset->ref_info14 = $request -> ref_info14;
       $asset->ref_info15 = $request -> ref_info15;
       $asset->ref_info16 = $request -> ref_info16;
       $asset->ref_info17 = $request -> ref_info17;
       $asset->ref_info18 = $request -> ref_info18;
       $asset->amount =1;
       $asset->value = $request -> value;
       $asset->cost = $request -> cost;
       $asset->issued_by = $request ->issued_by;
       $asset->branch_id = $request ->branch_id;
       $asset->note = $request -> note;
       $asset->save();

       $d = $request->d;
       $m = $request->m;
       $y = $request->y;
       $date = $d."/".$m."/".$y;
       Asset_Transaction::create([
        //  'date' => $date,
        ///  'time' => $request['time'],
        //  'l_s' => $request['l_s'],
        //  'o_c' => $request['o_c'],
          'port_id' => $portfolio,
          'asset_id' => $asset->id,
      //    'symbol' => $request['symbol'],
        //  'underlying_id' => $request['underlying_id'],
      //    'volumn' => $request['volumn'],
      //    'price' => $request['price'],
      //    'status' => $request['status'],
      //    'note' => $request['note'],
      ]);
     }
 }
