<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Response;
use App\Portfolio;
use App\Structure;
use App\Block;
use App\Person;
use App\Port_type;
use App\User;
use App\User_auth;
use App\Port_Ref_Link;
use App\View;
use Storage;
use File;
use App\match_id;

use App\Http\Controllers\SidebarController;

  class PortfolioController extends Controller{
    public function __construct()
    {
        $this->middleware('view', ['except' => ['findPortLabel' ]]);
    }

	       public function getArrayAllddBlock($currentstruc,$currentid,$notebook){

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
    /* public function getArrayAlldBlock($currentid,$notebook){

         $CurrentDivisions = Block::where('id', '=',$currentid )->get();
         $result =$notebook;
         $arraylength = sizeof($result);
         $result[$arraylength]  = $currentid;

         $ChildDivisions = Block::where('under_block', '=',$currentid )->get();
             foreach ($ChildDivisions as $Division) {
               $status = $Division->status;
               $nextblockID = $Division->id;
               $result = $this->getArrayAlldBlock($nextblockID,$result);
             }
       return $result;
     }

     public function getAlldBlock($currentid,$menudepth,$notebook){
         $CurrentDivisions = Block::where('id', '=',$currentid )->get();
         $count = $menudepth;
         $result ='<ul>';

         foreach ($CurrentDivisions as $Division) {


           $status = $Division->status;
           if($count == 0){
                 $result .='Category current Block ID is  :' .$currentid.'count:'.$count;
                 $notebook[1] = 111111111111111111111111111111111111111111;
           }else{
                 $result .='<li class="tree-view closed"><a href="https://www.google.co.th">'.$Division->name.'Status: '.$status.'</a>';
           }

         }
          $count++;

        $ChildDivisions = Block::where('under_division', '=',$currentid )->get();
        foreach ($ChildDivisions as $Division) {
             $status = $Division->status;
             $nextblockID = $Division->id;
             if($status==1){
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




     public function fib(Request $request)
     {

      $currentid = Auth::user()->block_id;
      $menudepth = 0;
      $notebook = array();

     $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
     $tree .=$this->getAlldBlock($currentid,$menudepth,$notebook);
     $notebook = $this->getArrayAlldBlock($currentid,$notebook);
     /*
     $tree .='this is test to check value in arrays size :'.sizeof($notebook).'<br>';
     $count = 0;
     $size = sizeof($notebook);
       while($count<$size){
         $tree .='in notebook:'.$count.'their value is'.$notebook[$count].'<br>';
         $count++;
       }

     $tree .='<ul>';



     return view('files.treeview',['tree' => $tree]);
     return $tree;


   }*/

     public function getArrayAlldBlock($currentstruc,$currentid,$notebook){

         $CurrentDivisions = Block::where('id', '=',$currentid )->get();
         $result =$notebook;
      //$arraylength = sizeof($result);
         //$currentid=$currentid;
      //  $result[$arraylength]  = $currentid;

        /* $arraylength = sizeof($result);
         //$currentid=$currentid;
         $result[$arraylength]  = $currentid;*/
      /*   $ChildDivisions = DB::table('block')

          //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา
            ->whereIn('block.under_block',$currentid)
            ->select('block.*')
            ->get();*/
          //  $payments = Payment::whereIn('status_id', $statuses)->get();
     $ChildDivisions = Block::whereIn('under_block',$currentid )->pluck('id');

      //  $ChildDivisions = Block::where('under_block','=',$currentid )->get();

        //  $ChildDivisions =  $ChildDivisions->whereIn('under_block',$currentid)->get();
      //  if (is_array($ChildDivisions) || is_object($ChildDivisions))
    //    {

            /*  foreach ( $ChildDivisions as $Division ) {
               $status = $Division->status;
                $currentstruc =$Division->structure_id;
                $nextblockID[$currentstruc] = $Division->id;
                $arraylength = sizeof($result);
                //$currentid=$currentid;

                $result[$arraylength]  = $nextblockID;
                $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);

               // $result = array_merge_recursive($result,$currentid);
            }*/

          /*  $Divisions = Block::where('structure_id','=',$currentstruc )->get();
            foreach ( $Divisions as $Division ) {
            $status = $Division->status;
              $nextblockID = $Division->id;
              $arraylength = sizeof($result);
              //$currentid=$currentid;
              $result[$arraylength]  = $nextblockID;
              $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);

             // $result = array_merge_recursive($result,$currentid);
          }*/


             foreach ( $ChildDivisions as $Division => $get) {
              // echo  $get;
               //$status = $get->status;
              // $nextblockID[$get] = $Division;
               $nextblockID[$Division] = $get;
               $arraylength = sizeof($result);
               //$currentid=$currentid;
               $result[$arraylength]  = $nextblockID[$Division];
               $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);

              // $result = array_merge_recursive($result,$currentid);
            }
//}
    //$result = array_merge_recursive($result,$arraylength);

       return $result;

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




     public function fib(Request $request)
     {
       $current = Auth::user()->id;


         $currentid = DB::table('user_auths')

                 ->where([
                           [ 'user_id', '=', $current]

                        ])
                        ->pluck('block_id');

              //  $CurrentDivisions = $CurrentDivisions->toArray();


      //$currentid = Auth::user()->block_id;
      $menudepth = 0;
      $notebook = array();

     $trees='<ul id="browser" class="filetree"><li class="tree-view"></li>';
     $trees .=$this->getAlldBlock($currentid,$menudepth,$notebook);
     $notebook = $this->getArrayAlldBlock($currentid,$notebook);
     /*
     $tree .='this is test to check value in arrays size :'.sizeof($notebook).'<br>';
     $count = 0;
     $size = sizeof($notebook);
       while($count<$size){
         $tree .='in notebook:'.$count.'their value is'.$notebook[$count].'<br>';
         $count++;
       }
     */
     $tree .='<ul>';



     return view('files.treeview',['tree' => $tree]);
     return $trees;


   }




    public function index(Request $request)
    {
      //sidebar

  $tree = session()->get('tree');
  //sidebar
      $current = Auth::user()->id;


        $currentid = DB::table('user_auths')

                ->where([ //[ 'structure_id', '=', 10 ],
                          [ 'user_id', '=', $current]

                       ])
                       ->pluck('block_id');


                       $currentstruc = DB::table('user_auths')

                               ->where([ //[ 'structure_id', '=',9 ],
                                         [ 'user_id', '=', $current]

                                      ])
                                      ->pluck('structure_id');
                           $currentstruc = $currentstruc->toArray();
     $menudepth = 0;
     $notebook = array();

    $trees='<ul id="browser" class="filetree"><li class="tree-view"></li>';
    $trees .=$this->getAlldBlock($currentid,$menudepth,$notebook);
    $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
    /*
    $tree .='this is test to check value in arrays size :'.sizeof($notebook).'<br>';
    $count = 0;
    $size = sizeof($notebook);
      while($count<$size){
        $tree .='in notebook:'.$count.'their value is'.$notebook[$count].'<br>';
        $count++;
      }
    */
    $trees .='<ul>';
    $block =



  //  return view('files.treeview',['tree' => $tree]);
    //return $tree;


    /*  $numberIwant = 3;

      while(($diceRoll = rand (1,6)) !== $numberIwant){
        echo "Yoou rolled a {$diceRoll}, we need a {$numberIwant}<br>";
      }
      echo "you rolled a {$numberIwant}";*/

      $i=0;

     $dep = $request->dep;
     $current = Auth::user()->id;

    // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
       $currentid = DB::table('user_auths')

               ->where(//[ 'structure_id', '=',9 ],
                         'user_id', '=',$current

                      )
                      ->pluck('block_id');
                  $currentid = $currentid->toArray();




               //$currentid = $currentid->toArray();

            //  $CurrentDivisions = Block::whereIn('id',$currentid )->pluck('id');
            //  $CurrentDivisions = $CurrentDivisions->toArray();

             /* 2 $userId = auth()->user()->id;

               $userautha = User::with('user_auths')->findOrFail($userId);

              //*3 $user = User::with('user_auths')->find(Auth::id())->firstOrFail();






    // $userauth = User_auth::where('user_id', '=',$currentid )->get();
    //  $currentid = Auth::user()->$userauth;


    //  $userauth = User_auth::where('user_id', '=',$currentid )->get();*/
    $dep = $request->dep;
    $block = $request->block;
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

       $dep = $request->dep;
        $block = $request->block;
       $portfolios = DB::table('portfolio')
         ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
        ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
        ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
        //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา
        ->whereIn(
          'block.id',$notebook
        )
        ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
        ->select('portfolio.*','portfolio.status', 'portfolio.type','portfolio.portfolio_type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as block_id','persons.name as member_name','persons.lname as member_last_name', 'persons.id as member_id','port_types.type as port_name', 'port_types.id as port_id')
		->orderBy('created_at', 'desc')
        ->paginate(30);

			$url = $_SERVER['REQUEST_URI'];

	if ( strstr($url, '?') ) {
		$memid = explode('?',$url);
		$memid = $memid[1];
		       $portfolios = DB::table('portfolio')
         ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
        ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
        ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
        //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา
        ->where(
          'member_id',$memid
        )
        ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
        ->select('portfolio.*','portfolio.status', 'portfolio.type','portfolio.portfolio_type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as 					 	block_id','persons.name as member_name','persons.lname as member_last_name', 'persons.id as member_id','port_types.type as port_name', 'port_types.id as port_id')
		->orderBy('created_at', 'desc')
        ->paginate(30);


	}
    //  return $notebook;
     return view('system-mgmt/portfolio/index', ['trees'=>$trees, 'notebook' => $notebook,'portfolios' => $portfolios,'depByUser'=> $dep,'BlockByUser'=> $block,'i'=> $i,'currentstruc'=> $currentstruc,'persons' =>$persons,'tree'=>$tree]);
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

      $structures = Structure::all();
      $blocks = Block::where('id',0)->get();
      $persons = Person::all();
      $ptnum = 0;
      $porttypes =Port_type::all();
      $factport = 0;
      $person = " ";
      $checkurl = $_SERVER['REQUEST_URI'];
      $checkurl = explode('/', $checkurl);
      if(in_array('create??',$checkurl)){

        $url = $_SERVER['REQUEST_URI'];
        $ptnum = explode('pty', $url);
        $ptnum = $ptnum[1];
        $stnum = explode('strc', $url);
        $stnum = $stnum[1];
        $bnum = explode('blc', $url);
        $bnum = $bnum[1];
        $ownum = explode('aow', $url);
        $ownum = $ownum[1];
        if(in_array('refermem',$checkurl)){


        $getcurnum = explode('refm', $url);
        $getcurnum = $getcurnum[1];
        }
        $getcurnum = 0;
        $porttypes =DB::table('port_types')->where('id',30)->get();
        $structures = Structure::where('id',15)->get();
        $blocks = Block::where('id',80)->get();
        $persons = Person::where('id',$ownum)->get();

        if(in_array('WealthNon',$checkurl))
        {
          $factport = 1;
          $structures = Structure::where('id',14)->get();
          $blocks = Block::where('structure_id',14)->get();
          $porttypes =DB::table('port_types')->where('id',31)->get();
          $person = DB::table('persons')->where('id',$ownum)->value('name');
          //return $person;
        }

    //  return $aoid;
      }

//return $porttypes;
        return view('system-mgmt/portfolio/create', ['factport'=>$factport,'person'=>$person,'ptnum'=>$ptnum,'structures' => $structures, 'blocks' => $blocks,   'porttypes' => $porttypes, 'persons' => $persons,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //  Structure::findOrFail($request['structure_id']);
      //  Block::findOrFail($request['block_id']);


        $this->validateInput($request,[
       'portfolio_type' => 'nullable|string|max:60',
       //'structure_id' => 'require|string|max:60',
      // 'block_id' => 'require|string|max:60',
      // 'member_id' => 'require|string|max:60',
	//	'port_id' => 'require|string|max:60',
  //     'portfolio_type' => 'nullable|string|max:60',
  //     'status' => 'require|string|max:60',
       ]);
         $port = new Portfolio;
       $port->type = $request->type;
       $port->structure_id = $request->structure_id;
       $port->block_id = $request->block_id;
       $port->member_id = $request->member_id;
       $port->number = $request->number;
       $port->port_id = $request->port_id;
       $port->status = $request->status;
       $port->portfolio_type = $request->portfolio_type;
       $port->description = $request->description;

       $port->available_from_date = $request->available_from_date;
       $port->available_to_date = $request->available_to_date;
       $port->port_detail_data1 = $request->port_detail_data1;
       $port->port_detail_data2 = $request->port_detail_data2;
       $port->port_detail_data3 = $request->port_detail_data3;
       $port->port_detail_data4 = $request->port_detail_data4;
       $port->port_detail_data5 = $request->port_detail_data5;
       $port->port_detail_data6 = $request->port_detail_data6;
       $port->port_detail_data7 = $request->port_detail_data7;
       $port->ref_link_id1 = $request->ref_link_id1;
       $port->ref_link_id2 = $request->ref_link_id2;
       $port->ref_link_id3 = $request->ref_link_id3;
       $port->referal_id1 = $request->referal_id1;
       $port->referal_id2 = $request->referal_id2;
       $port->referal_id3 = $request->referal_id3;
       $port->issuer_name = $request->issuer_name;
       $port->portfolio_limit_value = $request->portfolio_limit_value;
       $port->Notice = $request->Notice;
       $port->call_center = $request->call_center;
       $port->file_port_ref1 = $request->file_port_ref1;
       $port->file_port_ref2 = $request->file_port_ref2;
       $port->file_port_ref3 = $request->file_port_ref3;

       $memberid = $request->member_id;
       $findmemberciti = DB::table('persons')->where('id',$memberid)->value('id_num');

       $memciti = $request->member_citi;
       $inte = $findmemberciti.'+'.$memciti;
       if($findmemberciti != $memciti ){
          $request->session()->flash('alert-danger', 'หมายเลขบัตรประชาชนไม่ตรงกัน');
          return redirect()->back();
       }
    //   return $inte;
       //$perid = Person::where('id',$port->member_id)->value('id');
       //return $perid;  1212121221
        $port->save();

		$perid = Person::where('id',$port->member_id)->value('type');

                if($perid != 2){
          $per = ['type'=> 1];
          DB::table('persons')->where('id',$port->member_id)->update($per);
        }
        $checkurl = url()->previous();
        $checkurl = explode('/', $checkurl);
        if(in_array('create??',$checkurl)){
          $url = url()->previous();
          $ptnum = explode('pty', $url);
          $ptnum = $ptnum[1];
        //  return $ptnum;
          $stnum = explode('str', $url);
          $stnum = $stnum[1];
          $bnum = explode('blc', $url);
          $bnum = $bnum[1];
          $ownum = explode('aow', $url);
          $ownum = $ownum[1];
      //    return $ownum;
          $getcurnum = explode('refm', $url);
          $getcurnum = $getcurnum[1];
          $porttypes =DB::table('port_types')->where('id',30)->get();
          $structures = Structure::where('id',15)->get();
          $blocks = Block::where('id',80)->get();
          $persons = Person::where('id',$ownum)->get();
          $url2 = '/Nonlife/create??/refermem/refm'.$getcurnum.'refm/owner/aow'.$ownum.'aow/pnumber/pf'.$port->id.'pf';
      //  return $aoid;
        if(in_array('WealthNon',$checkurl)){
			$portid = 0;
		if(in_array('pnumber',$checkurl)){
          $portid = explode('pf', $url);
          $portid = $portid[1];
		}

          $url2 = '/Nonlife/create??/refermem/refm'.$getcurnum.'refm/owner/aow'.$ownum.'aow/pnumber/pf'.$portid.'pf/WealthNon/pw'.$port->id.'pw';
        }
          return redirect($url2);
        }

        $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
        return redirect ('/SecurityBroke/portfolio');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showdetail($id){
       //sidebar

       $tree = session()->get('tree');
       //sidebar


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
                if(in_array($id, $portfo)){
                   $ref = DB::table('portfolio')
                   ->where('portfolio.id',$id)
                     ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
                    ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
                    ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
                    //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา
                    ->whereIn(
                      'block.id',$notebook
                    )
                    ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
                    ->leftJoin('file as f1', 'portfolio.file_port_ref1', '=', 'f1.id')
                    ->leftJoin('file as f2', 'portfolio.file_port_ref2', '=', 'f2.id')
                    ->leftJoin('file as f3', 'portfolio.file_port_ref3', '=', 'f3.id')
                    ->select('portfolio.*','portfolio.status', 'portfolio.type','portfolio.portfolio_type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as block_id','persons.name as member_name','persons.lname as member_last_name', 'persons.id as member_id','port_types.type as port_name', 'port_types.id as port_id',
                    'port_types.port_limit_value as port_limitvalue','port_types.port_detail_label1 as port_lebel1','port_types.port_detail_label2 as port_lebel2','port_types.port_detail_label3 as port_lebel3','port_types.port_detail_label4 as port_lebel4','port_types.port_detail_label5 as port_lebel5','port_types.port_detail_label6 as port_lebel6','port_types.port_detail_label7 as port_lebel7',
                    'port_types.ref_link_name1 as ref_name1','port_types.ref_link_name2 as ref_name2','port_types.ref_link_name3 as ref_name3'
                    ,'f1.file_public_name as file_port_name1','f2.file_public_name as file_port_name2','f3.file_public_name as file_port_name3',
                    'port_types.port_label_ref1 as port_label1','port_types.port_label_ref2 as port_label2','port_types.port_label_ref3 as port_label3')
            		//->orderBy('created_at', 'desc')
                    ->get();

                    $findref1 = Portfolio::where('id',$id)
                   ->value('ref_link_id1');
                   $findref2 = Portfolio::where('id',$id)
                  ->value('ref_link_id2');
                  $findref3 = Portfolio::where('id',$id)
                 ->value('ref_link_id3');
                     $reflink1 = Port_Ref_Link::where('ref_link_id',$findref1)->value('real_url');
                     $reflink2 = Port_Ref_Link::where('ref_link_id',$findref2)->value('real_url');
                     $reflink3 = Port_Ref_Link::where('ref_link_id',$findref3)->value('real_url');

                   $data = array(
                     'ref' => $ref
                   );

                 $structures = Structure::all();
                 $blocks = Block::all();
                 $persons = Person::all();
                 $porttypes =Port_type::all();

                 $r = $_SERVER['REQUEST_URI'];
                 $r = explode('/', $r);
                 $r = $r[4];
                 $portnumber = Portfolio::where('id',$id)
                ->value('number');
                $name1 = 'Portfolio_Attachment_'.$r;
                $filerefname =$name1.'_'.$portnumber ;
                $filecat ='CG1CG';//catgroup
                $currentfile1 = DB::table('portfolio')->where('id',$id)->value('file_port_ref1');
                $currentfile2 = DB::table('portfolio')->where('id',$id)->value('file_port_ref2');
                $currentfile3 = DB::table('portfolio')->where('id',$id)->value('file_port_ref3');
              //  $allcurrentport = [$currentfile1,$currentfile2,$currentfile3];

                $files1 = DB::table('file')->where('id',$currentfile1)->get();
                $files2 = DB::table('file')->where('id',$currentfile2)->get();
                $files3 = DB::table('file')->where('id',$currentfile3)->get();
              //  return $files1;
              //  $filerefname = s;
                // return $name2;
                   return view('system-mgmt/portfolio/showdetail',['files1'=>$files1,'files2'=>$files2,'files3'=>$files3,'filecat'=>$filecat,'portnumber'=>$portnumber,'filerefname'=>$filerefname,'r'=>$r,'reflink1'=>$reflink1,'reflink2'=>$reflink2,'reflink3'=>$reflink3,'ref'=>$ref,'tree'=>$tree,'trees'=>$trees]);

     }

     return view('error');
 }

 public function showfile($id){
   //sidebar

 $tree = session()->get('tree');
 //sidebar


   //sidebar
   date_default_timezone_set('Asia/Bangkok');
   date('D-m-y H:i:s');
   $r = $_SERVER['REQUEST_URI'];
   $r = explode('/', $r);
   $r = $r[3];
   //return $r;
   $loadfile = DB::table('file')->where('id',$r)->value('physical_path');
   $checkfilecat = DB::table('file')->where('id',$r)->value('file_cat_id');
   $filecatgroup =DB::table('file_category')->where('id',$checkfilecat)->value('default_server_id');
   //return $filecatgroup;
   if($filecatgroup == 1){
     $gotolink = 'http://192.168.10.57/erp.wealththai.net/public/index.php/SecurityBroke/showfile/'.$loadfile;
     return redirect($gotolink);
   }

   $asset = url()->previous();
   if(strstr($asset, 'cases'))
   {
     $refno =  $_SERVER['REQUEST_URI'];
    $refno = explode('/', $refno);
    $refno = $refno[3];
    //return $refno;
   }

   elseif(strstr($asset, 'offer'))
   {
     $refno =  $_SERVER['REQUEST_URI'];
    $refno = explode('/', $refno);
    $refno = $refno[3];
    //return $refno;
   }
   else{
     $asset = explode('/', $asset);
     $asset = $asset[5];
   }

  if($asset == 'asset'){

      $refno = url()->previous();
     $refno = explode('/', $refno);
     $refno = $refno[8];

  }
  $member = url()->previous();
 $member = explode('/', $member);
 $member = $member[4];
// return $member;
  if($member == 'per'){
      $refno = url()->previous();
      $refno = explode('/', $refno);
      $refno = $refno[5];
     //return $refno;
  }
	 if($member == 'portfolio'){
      $refno = url()->previous();
      $refno = explode('/', $refno);
      $refno = $refno[8];
     //return $refno;
  }
  if(strstr($asset, 'cases'))
  {
    $refno =  $_SERVER['REQUEST_URI'];
   $refno = explode('/', $refno);
   $refno = $refno[3];
   $refno = explode('?', $refno);
   $refno = $refno[1];

   //return $refno;
  }
  elseif(strstr($asset, 'offer'))
  {
    $refno =  $_SERVER['REQUEST_URI'];
   $refno = explode('/', $refno);
   $refno = $refno[3];
   $refno = explode('?', $refno);
   $refno = $refno[1];

   //return $refno;
  }
  else{
   $refno = url()->previous();
   $refno = explode('/', $refno);
   $refno = $refno[6];
  }
//return $member;
if(strstr($asset, 'cases'))
{
  $r = $_SERVER['REQUEST_URI'];
  $r = explode('/', $r);
  $r = $r[3];
  $r = explode('?', $r);
  $r = $r[0];
}
elseif(strstr($asset, 'offer'))
{
  $r = $_SERVER['REQUEST_URI'];
  $r = explode('/', $r);
  $r = $r[3];
  $r = explode('?', $r);
  $r = $r[0];
}
else{
$r = $_SERVER['REQUEST_URI'];
$r = explode('/', $r);
$r = $r[3];
}
	 //return $refno;

$file = DB::table('file')->where('id',$r)->where('view_ref_no',$refno)->value('physical_path');
  //return $refno;
  if(strstr($asset, 'cases'))
  {
    $currenturl = $_SERVER['REQUEST_URI'];
    $currenturl = explode('/', $currenturl);
    $currenturl = $currenturl[3];
    $currenturl = explode('?', $currenturl);
    $currenturl = $currenturl[0];
  }
  elseif(strstr($asset, 'offer'))
  {
    $currenturl = $_SERVER['REQUEST_URI'];
    $currenturl = explode('/', $currenturl);
    $currenturl = $currenturl[3];
    $currenturl = explode('?', $currenturl);
    $currenturl = $currenturl[0];
  }
  else{
$currenturl = $_SERVER['REQUEST_URI'];
$currenturl = explode('/', $currenturl);
$currenturl = $currenturl[3];
}
$curdatetime = date('d-m-y H:i:s');
//return $curdatetime;
$lastview = ['last_time_view' =>$curdatetime ];
$fileup = DB::table('file')->where('id',$currenturl)->update($lastview);
//$fileup->last_time_view = $curdatetime;

   return Response::file(storage_path('app/'.$file));

   ///return view('system-mgmt/portfolio/showfile',['filepdf'=>$filepdf,'file'=>$file,'tree'=>$tree]);
 }



    public function download(){

    }

    public function show($id)
      {
        //sidebar

        $tree = session()->get('tree');
        //sidebar


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
                     $curmem = $curmem->toArray();



        $per = Person::find($id);
        $number = [123, 713, 3];
        // Redirect to city list if updating city wasn't existed
        //if ($id == $number )
          if(in_array($id, $curmem)){
            $ref = DB::table('persons')
            ->where('persons.id' ,'=',$id)

            ->leftJoin('event', 'persons.event_id', '=', 'event.id')
      //->leftJoin('match_id as re ', 'persons.ref_member_pid', '=', 're.id')
           ->leftJoin('match_id as u', 'persons.ref_user_pid', '=', 'u.id')
            ->leftJoin('match_id as i', 'persons.ref_member_pid', '=', 'i.id')


           ->select('persons.*', 'u.public_name as user_name', 'u.id as user_id', 'i.public_name as mem_name', 'i.id as mem_id', 'event.event_name as event_name', 'event.id as event_id')
             ->get();
            $data = array(
              'per' => $per
            );
          $structures = Structure::all();
          $blocks = Block::all();
          $persons = Person::all();
          $porttypes =Port_type::all();
          $memid = $_SERVER['REQUEST_URI'];
  				$memid = explode('/', $memid);
  				$memid = $memid[3];
  				$filerefname = 'Member_Attachment_'.$memid;

  				//return $memid;
  				$findfileid = DB::table('member_attachment')->where('member_id',$id)->pluck('file_id');
  				$fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','Active')->get();
            return view('per/show',['fileasset'=>$fileasset,'memid'=>$memid,'filerefname'=>$filerefname,'ref'=>$ref,'tree'=>$tree,'trees'=>$trees]);

        }

        /*$structures = Structure::all();
        $blocks = Block::all();
        $persons = Person::all();
        $porttypes =Port_type::all();*/
        //return $portfo;
        return view('error');



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
          if(in_array($id, $portfo)){
          $portfolio = Portfolio::find($id);
          $data = array(
              'portfolio' => $portfolio
          );
          $structures = Structure::all();
          $blocks = Block::all();
          $persons = Person::all();
          $porttypes =Port_type::all();
          return view('system-mgmt/portfolio/edit', ['portfolio' => $portfolio,'persons' => $persons, 'structures' => $structures,'blocks' => $blocks,'porttypes' => $porttypes,'trees'=>$trees,'tree'=>$tree]);
            //return redirect ('/system-management/city');
        }

        /*$structures = Structure::all();
        $blocks = Block::all();
        $persons = Person::all();
        $porttypes =Port_type::all();*/
        //return $portfo;
        return view('error');
        //return view('system-mgmt/portfolio/edit', ['portfolio' => $portfolio,'persons' => $persons, 'structures' => $structures,'blocks' => $blocks,'porttypes' => $porttypes]);
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
        $portfolio = Portfolio::findOrFail($id);
         $this->validate($request, [
        'type' => 'nullable|string|max:60'
        ]);
        $input = [
            'type' => $request['type'],
            'number' => $request['number'],
            'structure_id' => $request['structure_id'],
            'block_id' => $request['block_id'],

            'member_id' => $request['member_id'],
            'status' => $request['status'],
            'portfolio_type' => $request['portfolio_type'],
			'port_id' => $request['port_id'],
            'description' => $request['description'],
            'available_from_date' => $request['available_from_date'],
            'available_to_date' => $request['available_to_date'],
            'port_detail_data1' => $request['port_detail_data1'],
            'port_detail_data2' => $request['port_detail_data1'],
            'port_detail_data3' => $request['port_detail_data3'],
            'port_detail_data4' => $request['port_detail_data4'],
            'port_detail_data5' => $request['port_detail_data5'],
            'port_detail_data6' => $request['port_detail_data6'],
            'port_detail_data7' => $request['port_detail_data7'],
            'ref_link_id1' => $request['ref_link_id1'],
            'ref_link_id2' => $request['ref_link_id2'],
            'ref_link_id3' => $request['ref_link_id3'],
            'referal_id1' => $request['referal_id1'],
            'referal_id2' => $request['referal_id2'],
            'referal_id3' => $request['referal_id3'],
            'issuer_name' => $request['issuer_name'],
            'portfolio_limit_value' => $request['portfolio_limit_value'],
            'Notice' => $request['Notice'],
            'call_center' => $request['call_center'],
            'file_port_ref1' => $request['file_port_ref1'],
            'file_port_ref2' => $request['file_port_ref2'],
            'file_port_ref3' => $request['file_port_ref3'],
        ];
        $memberid = $request->member_id;
        //return $memberid;
        $findmemberciti = DB::table('persons')->where('id',$memberid)->value('id_num');

        $memciti = $request->member_citi;
        $inte = $findmemberciti.'+'.$memciti;
        if($findmemberciti != $memciti ){
           $request->session()->flash('alert-danger', 'หมายเลขบัตรประชาชนไม่ตรงกัน');
           return redirect()->back();
        }
        Portfolio::where('id', $id)
            ->update($input);

        return redirect ('/SecurityBroke/portfolio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Portfolio::where('id', $id)->delete();
         return redirect ('/SecurityBroke/portfolio');
    }

    public function loadPortfoloios($departmentId,$divisionId,$userId,$memberID) {
        $portfolios = Portfolio::where('structure_id', '=', $departmentId)->get(['id', 'name']);
        $portfolios1 = Portfolio::where('block_id', '=', $divisionId)->get(['id', 'name']);
        $portfolios2 = Portfolio::where('user_id', '=', $userId)->get(['id', 'name']);
        $portfolios3 = Portfolio::where('member_id', '=', $memberId)->get(['id', 'name']);
        $portfolios4 = Portfolio::where('port_id', '=', $portId)->get(['id', 'type']);
        return response()->json($portfolios,$portfolios1,$portfolios2,$portfolios3,$portfolios4);
    }

    /**
     * Search city from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
      //sidebar

      $tree = session()->get('tree');
      //sidebar

        $constraints = [
            'number' => $request['port_number'],
            'type' => $request['type'],

            'structure.name' => $request['structure_name'],
            'block.name' => $request['block_name'],
            'users.username' => $request['user_name'],
            'persons.name' => $request['member_name'],
            'persons.lname' => $request['member_last_name'],
          //  'port_types.type' => $request['port_name'],
            'status' => $request['status'],
              'portfolio_type' => $request['portfolio_type']
            ];

       $portfolios = $this->doSearchingQuery($request,$constraints);
        $constraints['port_number'] = $request['port_number'];
       $constraints['structure_name'] = $request['structure_name'];
       $constraints['block_name'] = $request['block_name'];
       $constraints['user_name'] = $request['user_name'];
       $constraints['member_name'] = $request['member_name'];
       $constraints['member_last_name'] = $request['member_last_name'];



                 $current = Auth::user()->id;


                   $currentid = DB::table('user_auths')

                           ->where([ //[ 'structure_id', '=', 10 ],
                                     [ 'user_id', '=', $current]

                                  ])
                                  ->pluck('block_id');

			    $current = Auth::user()->id;


      $currentstruc = DB::table('user_auths')

              ->where([ //[ 'structure_id', '=',9 ],
                        [ 'user_id', '=', $current]

                     ])
                     ->pluck('structure_id');
          $currentstruc = $currentstruc->toArray();

                $menudepth = 0;
                $notebook = array();

               $trees='<ul id="browser" class="filetree"><li class="tree-view"></li>';
               $trees .=$this->getAlldBlock($currentid,$menudepth,$notebook);
               $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
               /*
               $tree .='this is test to check value in arrays size :'.sizeof($notebook).'<br>';
               $count = 0;
               $size = sizeof($notebook);
                 while($count<$size){
                   $tree .='in notebook:'.$count.'their value is'.$notebook[$count].'<br>';
                   $count++;
                 }
               */
               $trees .='<ul>';
        $dep = $request->dep;
        $i=0;
        $i=0;

       $dep = $request->dep;
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
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
              $notebook = array();
               $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
               $notebook = array_merge_recursive($currentid,$notebook);
       return view('system-mgmt/portfolio/index', ['portfolios' => $portfolios,'trees' => $trees,'notebook' => $notebook,'currentstruc' => $currentstruc,'depByUser'=> $dep,'i'=>$i, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery(Request $request ,$constraints ) {
       $current = Auth::user()->id;
      $currentid = DB::table('user_auths')

              ->where(//[ 'structure_id', '=',9 ],
                        'user_id', '=',$current

                     )
                     ->pluck('block_id');
                 $currentid = $currentid->toArray();
                 $currentstruc = DB::table('user_auths')

                         ->where([ //[ 'structure_id', '=',9 ],
                                   [ 'user_id', '=', $current]

                                ])
                                ->pluck('structure_id');

           $notebook = array();
            $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
            $notebook = array_merge_recursive($currentid,$notebook);
        $query = DB::table('portfolio')
        ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
       ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
       ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
        ->whereIn('block.id',$notebook)
       ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
       ->select('portfolio.*','portfolio.status', 'portfolio.type','portfolio.portfolio_type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as block_id','persons.name as member_name','persons.lname as member_last_name', 'persons.id as member_id','port_types.type as port_name', 'port_types.id as port_id');
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

  /*  private function doSearchingQuery($constraints) {
        $query = Portfolio::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }*/
    private function validateInput($request) {
        $this->validate($request, [
        ///  'portfolio_type' => 'nullable|string|max:60',
        //  'structure_id' => 'required|string|max:60',
        //  'number' => 'required|max:60',

        //  'block_id' => 'required|string|max:60',
        //  'member_id' => 'required|string|max:60',
        //  'member_citi' => 'confirmed',
        //  'member_citi_confirmation' => 'required',

    ]);
    }
    public function findPortName(Request $request){
      $data=Portfolio::select('portfolio_type','id')->where('structure_id',$request->id)->take(100)->get();
      return response()->json($data);
    }




    public function portDep(Request $request){



      $current = Auth::user()->id;


      $currentid = DB::table('user_auths')

      ->where([ //[ 'structure_id', '=', 10 ],
        [ 'user_id', '=', $current]

      ])
      ->pluck('block_id');

      $currentstruc = DB::table('user_auths')

              ->where([ //[ 'structure_id', '=',9 ],
                        [ 'user_id', '=', $current]

                     ])
                     ->pluck('structure_id');

      $menudepth = 0;
      $notebook = array();

      $trees='<ul id="browser" class="filetree"><li class="tree-view"></li>';
      $trees .=$this->getAlldBlock($currentid,$menudepth,$notebook);
      $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
      /*
      $tree .='this is test to check value in arrays size :'.sizeof($notebook).'<br>';
      $count = 0;
      $size = sizeof($notebook);
      while($count<$size){
      $tree .='in notebook:'.$count.'their value is'.$notebook[$count].'<br>';
      $count++;
    }
    */
    $trees .='<ul>';





    $i=0;

    $dep = $request->dep;
    $current = Auth::user()->id;


    $currentid = DB::table('user_auths')

    ->where([ //[ 'structure_id', '=',9 ],
      [ 'user_id', '=', $current]

    ])
    ->pluck('block_id');


    $currentid = $currentid->toArray();

    //  $CurrentDivisions = Block::whereIn('id',$currentid )->pluck('id');
    //  $CurrentDivisions = $CurrentDivisions->toArray();

    /* 2 $userId = auth()->user()->id;

    $userautha = User::with('user_auths')->findOrFail($userId);

    //*3 $user = User::with('user_auths')->find(Auth::id())->firstOrFail();






    // $userauth = User_auth::where('user_id', '=',$currentid )->get();
    //  $currentid = Auth::user()->$userauth;


    //  $userauth = User_auth::where('user_id', '=',$currentid )->get();*/
    $dep = $request->dep;
    $current = Auth::user()->id;


    $currentstruc = DB::table('user_auths')

    ->where([ //[ 'structure_id', '=',9 ],
    [ 'user_id', '=', $current]

    ])
    ->pluck('structure_id');
    $currentstruc = $currentstruc->toArray();
    //  echo "<pre>";
    //  print_r($currentstruc);

    $notebook = array();
    $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
        $notebook = array_merge_recursive($currentid,$notebook);
    $dep = $request->dep;
    $portfolios = DB::table('portfolio')
    ->leftJoin('users', 'portfolio.user_id', '=', 'users.id')
    ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
    ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
    ->where('structure.name',$dep)
    ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
    ->whereIn('block.id',$notebook)


    ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
    ->select('portfolio.*','portfolio.id','portfolio.status', 'portfolio.type','portfolio.portfolio_type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as block_id','users.username as user_name', 'users.id as user_id','persons.name as member_name','persons.lname as member_last_name', 'persons.id as member_id','port_types.type as port_name', 'port_types.id as port_id')

    ->paginate(1000);
    /*  $data =  DB::table('portfolio')->join('structure','structure.id','portfolio.structure_id')
    ->where('structure.name',$dep)->get();*/
    return view('system-mgmt/portfolio/index', ['trees'=>$trees,'portfolios'=>$portfolios,'notebook'=>$notebook,'depByUser'=> $dep,'i'=> $i,'currentstruc'=> $currentstruc]);
    //  return view('system-mgmt/portfolio/index2',['data'=>$data, 'depByUser'=> $dep]);

    //  $data =  DB::table('portfolio')->join('department','department.id','portfolio.department_id')
    //  ->where('department.name',$dep)->get();
    //  return view('system-mgmt/portfolio/index2',['data'=>$data, 'depByUser'=> $dep]);
  }

      public function portblock(Request $request){
        //sidebar

        $tree = session()->get('tree');
        //sidebar




        $current = Auth::user()->id;


          $currentid = DB::table('user_auths')

                  ->where([ //[ 'structure_id', '=', 10 ],
                            [ 'user_id', '=', $current]

                         ])
                         ->pluck('block_id');


                         $currentstruc = DB::table('user_auths')

                         ->where([ //[ 'structure_id', '=',9 ],
                         [ 'user_id', '=', $current]

                         ])
                         ->pluck('structure_id');
                         $currentstruc = $currentstruc->toArray();
       $menudepth = 0;
       $notebook = array();

      $trees='<ul id="browser" class="filetree"><li class="tree-view"></li>';
      $trees .=$this->getAlldBlock($currentid,$menudepth,$notebook);
      $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
      /*
      $tree .='this is test to check value in arrays size :'.sizeof($notebook).'<br>';
      $count = 0;
      $size = sizeof($notebook);
        while($count<$size){
          $tree .='in notebook:'.$count.'their value is'.$notebook[$count].'<br>';
          $count++;
        }
      */
      $trees .='<ul>';





        $i=0;

        $dep = $request->dep;
        $current = Auth::user()->id;


         $currentid = DB::table('user_auths')

                 ->where([ //[ 'structure_id', '=',9 ],
                           [ 'user_id', '=', $current]

                        ])
                        ->pluck('block_id');


                 $currentid = $currentid->toArray();

              //  $CurrentDivisions = Block::whereIn('id',$currentid )->pluck('id');
              //  $CurrentDivisions = $CurrentDivisions->toArray();

               /* 2 $userId = auth()->user()->id;

                 $userautha = User::with('user_auths')->findOrFail($userId);

                //*3 $user = User::with('user_auths')->find(Auth::id())->firstOrFail();






        // $userauth = User_auth::where('user_id', '=',$currentid )->get();
        //  $currentid = Auth::user()->$userauth;


        //  $userauth = User_auth::where('user_id', '=',$currentid )->get();*/
        $dep = $request->dep;
        $current = Auth::user()->id;


        $currentstruc = DB::table('user_auths')

                ->where([ //[ 'structure_id', '=',9 ],
                          [ 'user_id', '=', $current]

                       ])
                       ->pluck('structure_id');
            $currentstruc = $currentstruc->toArray();
            //  echo "<pre>";
            //  print_r($currentstruc);

        $notebook = array();
        $notebook = $this->getArrayAlldBlock($currentid,$currentid,$notebook);
            $notebook = array_merge_recursive($currentid,$notebook);
        $block = $request->block;
        $portfolios = DB::table('portfolio')
          ->leftJoin('users', 'portfolio.user_id', '=', 'users.id')
          ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
         ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')

         ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
         ->where('block.name',$block)
         ->whereIn('block.id',$notebook)


         ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
         ->select('portfolio.*','portfolio.id','portfolio.status', 'portfolio.type','portfolio.portfolio_type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as block_id','users.username as user_name', 'users.id as user_id','persons.name as member_name','persons.lname as member_last_name', 'persons.id as member_id','port_types.type as port_name', 'port_types.id as port_id')

         ->paginate(1000);
      /*  $data =  DB::table('portfolio')->join('structure','structure.id','portfolio.structure_id')
        ->where('structure.name',$dep)->get();*/
        return view('system-mgmt/portfolio/index', ['tree'=>$tree,'trees'=>$trees,'notebook'=>$notebook,'portfolios'=>$portfolios,'blockByUser'=> $block,'depByUser'=> $dep,'i'=> $i,'currentstruc'=> $currentstruc]);
      //  return view('system-mgmt/portfolio/index2',['data'=>$data, 'depByUser'=> $dep]);

      //  $data =  DB::table('portfolio')->join('department','department.id','portfolio.department_id')
      //  ->where('department.name',$dep)->get();
      //  return view('system-mgmt/portfolio/index2',['data'=>$data, 'depByUser'=> $dep]);
      }


    public function portfolioDep(Request $request){
      $structure_id = $request -> structure_id;

          $data = DB::table('portfolio')
      ->join('structure','structure.id','portfolio.structure_id')
      ->where('portfolio.structure_id',$structure_id)
      ->get();
      return view('system-mgmt/portfolio/index', ['tree'=>$tree,'trees'=>$trees,'notebook'=>$notebook,'portfolios'=>$portfolios,'blockByUser'=> $block,'depByUser'=> $dep,'i'=> $i,'currentstruc'=> $currentstruc]);

        //return $data = DB::table('portfolio')
      //->join('department','department.id','portfolio.department_id')
      //->where('portfolio.department_id',$department_id)
      //->get();
    }
    public function allport(Request $request){



            $data =  DB::table('portfolio')->join('department','department.id','portfolio.department_id')
            ->where('department.name',$dep)->get();
            return view('system-mgmt/portfolio/index2',['data'=>$data, 'depByUser'=> $dep]);
    }

    public function gotoup($id){

      //sidebar

$tree = session()->get('tree');
//sidebar


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
               if(in_array($id, $portfo)){
                  $ref = DB::table('file_category')

                   ->get();

                   $findref1 = Portfolio::where('id',$id)
                  ->value('ref_link_id1');
                  $findref2 = Portfolio::where('id',$id)
                 ->value('ref_link_id2');
                 $findref3 = Portfolio::where('id',$id)
                ->value('ref_link_id3');
                    $reflink1 = Port_Ref_Link::where('ref_link_id',$findref1)->value('real_url');
                    $reflink2 = Port_Ref_Link::where('ref_link_id',$findref2)->value('real_url');
                    $reflink3 = Port_Ref_Link::where('ref_link_id',$findref3)->value('real_url');

                  $data = array(
                    'ref' => $ref
                  );
                $structures = Structure::all();
                $blocks = Block::all();
                $persons = Person::all();
                $porttypes =Port_type::all();
               // return $reflink;
               $r = $_SERVER['REQUEST_URI'];
           $r = explode('/', $r);
           $r = $r[4];

                  return view('system-mgmt/portfolio/gotoup',['r'=>$r,'reflink1'=>$reflink1,'reflink2'=>$reflink2,'reflink3'=>$reflink3,'ref'=>$ref,'tree'=>$tree,'trees'=>$trees]);

    }

    return view('error');
}

public function portfile($id){

  //sidebar

$tree = session()->get('tree');
//sidebar

         $file = DB::table('file')->where('type','!=','pdf')->where('view_ref_no',$id)->get();
         $files = DB::table('file')->where('type','=','pdf')->where('view_ref_no',$id)->get();

        // return $file;
              return view('system-mgmt/portfolio/portfile',['files'=>$files,'file'=>$file,'tree'=>$tree]);

}

public function findPortLabel(Request $request){
$data=Port_type::select('port_detail_label1','port_detail_label2','port_detail_label3','port_detail_label4','port_detail_label5','port_detail_label6','port_detail_label7')->where('id',$request->id)->take(100)->get();
return response()->json($data);
}

 public function savedataexcel($request)
 {
   $this->storepersonalcustomerport($request);
   $this->storecustomerinsuranceport($request);

 }
 public function storepersonalcustomerport($request)
 {
   $port = new Portfolio;
   $port->type = "personal_port";
   $port->structure_id = 15;
   $port->block_id = 80;
   $port->member_id = $request->id;
   $port->number = "000000";
   $port->port_id = 30;
   $port->status = "Active";
   $port->save();
 }
 public function storecustomerinsuranceport($request)
 {
   $finduserblock = User::where('user_code',$request->user_code)->value('id');
   $finduserblock = match_id::where('user_id',$finduserblock)->value('id');
   $block = Block::where('structure_id',14)->where('default_pid',$finduserblock)->value('id');
   $port = new Portfolio;
   $port->type = $request->name;
   $port->structure_id = 14;
   $port->block_id = $block;
   $port->member_id = $request->id;
   $port->number = $request->customer_code;
   $port->port_id = 31;
   $port->status = "Active";
   $port->save();
 }
}
