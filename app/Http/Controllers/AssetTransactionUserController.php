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
class AssetTransactionUserController extends Controller
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
		//sidebar
    $r = $_SERVER['REQUEST_URI'];
    $r = explode('/', $r);
    $r = $r[4];

    $port = $_SERVER['REQUEST_URI'];
    $port = explode('/', $port);
    $port = $port[5];
    //return $port;
    $portinasset = DB::table('asset')->where('id',$r)->value('port_id');
    //return $portinasset;
    $ls =  DB::table('asset_transaction')
    ->where('asset_transaction.port_id',$port)
    ->where('asset_transaction.asset_id',$r)
    ->value('l_s');
    $oc =  DB::table('asset_transaction')
    ->where('asset_transaction.port_id',$port)
    ->where('asset_transaction.asset_id',$r)
    ->value('o_c');
  //  $reaminingvolumn = $ls - $oc;
		$reaminingvolumn  ='';
  //  return $reaminingvolumn;
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




  //$portfolio = portfolio::find($id);
  $number = [123, 713, 3];
  // Redirect to city list if updating city wasn't existed
  //if ($id == $number )
    if(in_array($port, $portfo)){
      $porttypes = DB::table('asset_transaction')
      ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
      ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
      ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
      ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
    //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
      ->where('asset_transaction.port_id',$port)
      ->where('asset_transaction.asset_id',$r)
     ->select('asset_transaction.*', 'asset_type.unit as asset_unit', 'asset_cat.name as asset_cat_name', 'asset_type.la_nla_type as la_nla_type', 'asset_type.la_nla as la_nla', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
       ->paginate(30);
      return view('system-mgmt/asset-transactionuser/index', ['reaminingvolumn'=>$reaminingvolumn,'r'=>$r,'porttypes' => $porttypes,'tree'=>$tree]);
    }
    return view('errortype2');
  }

    public function porttransaction($id)
    {

      //sidebar

$tree = session()->get('tree');
//sidebar
    //sidebar
  /*  $r = $_SERVER['REQUEST_URI'];
    $r = explode('/', $r);
    $r = $r[3];*/

    $port = $_SERVER['REQUEST_URI'];
    $port = explode('/', $port);
    $port = $port[3];
    //return $port;
    //$portinasset = DB::table('asset')->where('id',$r)->value('port_id');
    //return $portinasset;
    /*$ls =  DB::table('asset_transaction')
    ->where('asset_transaction.port_id',$port)
    ->where('asset_transaction.asset_id',$r)
    ->value('l_s');
    $oc =  DB::table('asset_transaction')
    ->where('asset_transaction.port_id',$port)
    ->where('asset_transaction.asset_id',$r)
    ->value('o_c');
    $reaminingvolumn = $ls - $oc;*/
  //  return $reaminingvolumn;
  $reaminingvolumn = 0;
  $r = 0;
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




  $portfolio = portfolio::find($id);
  $number = [123, 713, 3];
  // Redirect to city list if updating city wasn't existed
  //if ($id == $number )
    if(in_array($port, $portfo)){
      $porttypes = DB::table('asset_transaction')
      ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
      ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
      ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
      ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
    //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
      ->where('asset_transaction.port_id',$port)
      ->orderBy('date')
     ->select('asset_transaction.*', 'asset_type.unit as asset_unit', 'asset_cat.name as asset_cat_name', 'asset_type.la_nla_type as la_nla_type', 'asset_type.la_nla as la_nla', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
       ->paginate(30);
      return view('system-mgmt/asset-transactionuser/porttransaction', ['reaminingvolumn'=>$reaminingvolumn,'r'=>$r,'porttypes' => $porttypes,'tree'=>$tree]);
    }
    return view('errortype2');
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
           $status = DB::table('asset_status')->get();
         return view('system-mgmt/asset-transactionuser/create',['status'=>$status,'port'=>$port,'asset'=>$asset,'tree'=>$tree]);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

       $asset = url()->previous();
       $asset = explode('/', $asset);
       $asset = $asset[6];
       $portinasset = DB::table('asset')->where('id',$asset)->value('port_id');
       //return $portinasset;
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
             'port_id' => $portinasset,
             'asset_id' => $asset,
             'symbol' => $request['symbol'],
             'underlying_id' => $request['underlying_id'],
             'volumn' => $request['volumn'],
             'price' => $request['price'],
             'status' => $request['status'],
             'note' => $request['note'],



         ]);
         $re = $request->previous;

         return redirect ($re);
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

         $porttran = DB::table('asset_transaction')->where('id',$id)->value('port_id');
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




         //$portfolio = portfolio::find($id);
         $number = [123, 713, 3];
         // Redirect to city list if updating city wasn't existed
         //if ($id == $number )
           if(in_array($porttran, $portfo)){
         //return $portid;
          //  $transaction = Asset_Transaction::where('');

            $transaction = DB::table('asset_transaction')
            ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
            ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
            ->leftJoin('asset_status', 'asset_transaction.status', '=', 'asset_status.id')

          //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
            ->where('asset_transaction.id',$id)
          //  ->where('asset_transaction.port_id',$portid)
           ->select('asset_transaction.*', 'asset_status.name as asset_status_name', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
             ->get();
         return view('system-mgmt/asset-transactionuser/show',['transaction'=>$transaction,'tree' => $tree]);
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
         $porttran = DB::table('asset_transaction')->where('id',$id)->value('port_id');
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




         //$portfolio = portfolio::find($id);
         $number = [123, 713, 3];
         // Redirect to city list if updating city wasn't existed
         //if ($id == $number )
           if(in_array($porttran, $portfo)){

          $port = DB::table('portfolio')->get();
          $asset = DB::table('asset')->get();
         return view('system-mgmt/asset-transactionuser/edit', ['curdate' => $curdate,'curmonth' => $curmonth,'curyear' => $curyear,'asset' => $asset,'port' => $port,'porttype' => $porttype,'tree'=>$tree]);
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
             $re = $request->previous;
             return redirect ($re);
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
               $r = url()->previous();
               $r = explode('/', $r);
               $r = $r[6];
              // return $r;
               $port = url()->previous();
               $port = explode('/', $port);
               $port = $port[7];
               //return $port;
               $portinasset = DB::table('asset')->where('id',$r)->value('port_id');
               //return $portinasset;
               $ls =  DB::table('asset_transaction')
               ->where('asset_transaction.port_id',$port)
               ->where('asset_transaction.asset_id',$r)
               ->value('l_s');
               $oc =  DB::table('asset_transaction')
               ->where('asset_transaction.port_id',$port)
               ->where('asset_transaction.asset_id',$r)
               ->value('o_c');
               $reaminingvolumn = $ls - $oc;
             //  return $reaminingvolumn;
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




             //$portfolio = portfolio::find($id);
             $number = [123, 713, 3];
             // Redirect to city list if updating city wasn't existed
             //if ($id == $number )
               if(in_array($port, $portfo)){
        $porttypes = $this->getHiredEmployeesinbox($request,$constraints);
        return view('system-mgmt/asset-transactionuser/search', ['reaminingvolumn'=>$reaminingvolumn,'r'=>$r,'porttypes' => $porttypes,'tree'=>$tree]);
     }
     return view('errortype2');
}

public function porttransearch(Request $request) {

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
          $port = $_SERVER['REQUEST_URI'];
          $port = explode('/', $port);
          $port = $port[3];
          //return $port;
          //$portinasset = DB::table('asset')->where('id',$r)->value('port_id');
          //return $portinasset;
          /*$ls =  DB::table('asset_transaction')
          ->where('asset_transaction.port_id',$port)
          ->where('asset_transaction.asset_id',$r)
          ->value('l_s');
          $oc =  DB::table('asset_transaction')
          ->where('asset_transaction.port_id',$port)
          ->where('asset_transaction.asset_id',$r)
          ->value('o_c');
          $reaminingvolumn = $ls - $oc;*/
        //  return $reaminingvolumn;
        $reaminingvolumn = 0;
        $r = 0;
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


   $porttypes = $this->getHiredport($request,$constraints);
//   return $porttypes;
   return view('system-mgmt/asset-transactionuser/porttransactionsearch', ['reaminingvolumn'=>$reaminingvolumn,'r'=>$r,'porttypes' => $porttypes,'tree'=>$tree]);
}



     private function getHiredEmployeesinbox($constraints) {

       $r = url()->previous();
       $r = explode('/', $r);
       $r = $r[6];
      // return $r;
       $port = url()->previous();
       $port = explode('/', $port);
       $port = $port[7];
       //return $port;
       $portinasset = DB::table('asset')->where('id',$r)->value('port_id');
       //return $portinasset;
       $ls =  DB::table('asset_transaction')
       ->where('asset_transaction.port_id',$port)
       ->where('asset_transaction.asset_id',$r)
       ->value('l_s');
       $oc =  DB::table('asset_transaction')
       ->where('asset_transaction.port_id',$port)
       ->where('asset_transaction.asset_id',$r)
       ->value('o_c');
       $reaminingvolumn = $ls - $oc;
     //  return $reaminingvolumn;
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




     //$portfolio = portfolio::find($id);
     $number = [123, 713, 3];
     // Redirect to city list if updating city wasn't existed
     //if ($id == $number )
         $porttypes = DB::table('asset_transaction')
         ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
         ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
         ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
         ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
       //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
         ->where('asset_transaction.port_id',$port)
         ->where('asset_transaction.asset_id',$r)
         ->where('asset_transaction.date', '>=', $constraints['fromdate'])
         ->where('asset_transaction.date', '<=', $constraints['todate'])
        ->select('asset_transaction.*', 'asset_type.unit as asset_unit', 'asset_cat.name as asset_cat_name', 'asset_type.la_nla_type as la_nla_type', 'asset_type.la_nla as la_nla', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')

            ->paginate(1000);

         return $porttypes;
     }

     private function getHiredport($constraints) {

       $port = url()->previous();
       $port = explode('/', $port);
       $port = $port[5];
       //return $port;
       //$portinasset = DB::table('asset')->where('id',$r)->value('port_id');
       //return $portinasset;
       /*$ls =  DB::table('asset_transaction')
       ->where('asset_transaction.port_id',$port)
       ->where('asset_transaction.asset_id',$r)
       ->value('l_s');
       $oc =  DB::table('asset_transaction')
       ->where('asset_transaction.port_id',$port)
       ->where('asset_transaction.asset_id',$r)
       ->value('o_c');
       $reaminingvolumn = $ls - $oc;*/
     //  return $reaminingvolumn;
     $reaminingvolumn = 0;
     $r = 0;
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




    // $portfolio = portfolio::find($id);
     $number = [123, 713, 3];
     // Redirect to city list if updating city wasn't existed
     //if ($id == $number )

         $porttypes = DB::table('asset_transaction')
         ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
         ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
         ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
         ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
       //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')

         ->where('asset_transaction.port_id',$port)
         ->where('asset_transaction.date', '>=', $constraints['fromdate'])
         ->where('asset_transaction.date', '<=', $constraints['todate'])
         ->orderBy('date')
        ->select('asset_transaction.*', 'asset_type.unit as asset_unit', 'asset_cat.name as asset_cat_name', 'asset_type.la_nla_type as la_nla_type', 'asset_type.la_nla as la_nla', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
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
