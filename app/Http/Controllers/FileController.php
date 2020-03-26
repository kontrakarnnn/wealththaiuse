<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Block;
use App\Structure;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Person;
use App\Event;
use App\EventType;
use App\Organize;
use App\Family;
use App\File;
use App\Port_Asset;
use App\Asset_Attacht;
use App\Member_Attacht;
use App\Case_Attacht;
use App\Offer_Attacht;
use App\Member_group;
use Session;
use Storage;
use Image;
use App\Asset;
use App\Asset_Transaction;
use App\Port_auth;
use App\Http\Controllers\SidebarController;
use App\Organize_auth;
class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('view')->except(["findBlockName"]);
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




        $events = DB::table('file')
       ->leftJoin('file_category', 'file.file_cat_id', '=', 'file_category.id')
       ->select('file.*', 'file_category.name as file_cat_name', 'file_category.id as file_cat_id')
			->orderBy('created_at', 'desc')
       ->paginate(20);
        return view('system-mgmt/file/index', ['events' => $events,'tree' => $tree]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function choosegroup(Request $request)
     {

       //return $request->ref_label2;
       $publicname = $request->file_public_name;
       $ref_number2 = $request->ref_number2;
       $ref_number3 = $request->ref_number3;
	   $textplub = utf8_encode( $publicname );
	   $textnum2 = utf8_encode( $ref_number2 );
	   $textnum3 = utf8_encode( $ref_number3 );
       $textnumber3real = utf8_decode( $textnum3 );
		$textnumber2real = utf8_decode( $textnum2 );
		$textplubreal = utf8_decode( $textplub );
		 //return $textplubreal;
       $serve = str_replace(url('/'), '', url()->previous()).'?pbn'.$textplubreal.'pbn'.'rn2'.$textnumber2real.'rn2'.'rn3'.$textnumber3real.'rn3';
       //return $serve;
       $filegroup = DB::table('file_category')->where('file_cat_group',1)->get();$mergeserve = 'http://192.168.10.57/erp.wealththai.net/public/index.php'.$serve;
       return redirect($mergeserve);
     }

     public function submitfile(Request $request)
     {
       //return $request->ref_label2;
       //return 'yes';
       $checkurl = $_SERVER['REQUEST_URI'];
	   $checkurl = urldecode($checkurl);
       $publicname = explode('pbn', $checkurl);
       $publicname = $publicname[1];
	   $publicna = base64_decode( $publicname );

       $refnum2 = explode('rn2', $checkurl);
       $refnum2 = $refnum2[1];
	   //$refnum2 = utf8_decode( $refnum2 );
       $refnum3 = explode('rn3', $checkurl);
       $refnum3 = $refnum3[1];
	  // $refnum3 = utf8_decode( $refnum3 );
       $filephy = explode('fin', $checkurl);
       $filephy = $filephy[1];

       $asset = url()->previous();
       //return $checkurl;
       $asset = explode('/', $checkurl);
       $asset = $asset[6];
       //return $asset;

       $curid = url()->previous();
       $curid = explode('CA', $checkurl);
       $curid = $curid[1];
       $filecat = DB::table('file_category')->where('id',$curid)->value('max_file_size');
       $filetype = DB::table('file_category')->where('id',$curid)->value('file_type');
       $s = $filecat * 1000;

       //return $filetype;

       date_default_timezone_set('Asia/Bangkok');
       date('D-m-y H:i:s');

       $ses = Session::all();
       $refno = url()->previous();
       //return $filecat;
     //  $te =
     //return $checkurl;
   $refno = explode('/', $checkurl);
   $refno = $refno[8];
   $assetno = url()->previous();
   $assetno = explode('/', $checkurl);
   $assetno = $assetno[9];
   $filerefname = url()->previous();
   $filerefname = explode('/', $checkurl);
   $filerefname = $filerefname[12];
   //return $filerefname;
     //    return $ses;
         $txt = $request->txt;

       $time =  date('d-m-y');
       $rand = str_random(32);
       $plus = $txt.$time.$rand;
       $chksum = strlen($plus);
       $end = $plus.$chksum;
     //  return $end;

         $cur = $request->user()->id;
         $file = new File;
         $file->file_public_name = $publicname;
         if($asset == 'member')
         {
           $filerefname = explode('/', $checkurl);
           $filerefname = $filerefname[11];
           }
         $file->file_ref_name = $filerefname;

         $file->ref_number1 = $refno;
         $file->ref_number2 =$refnum2;
         $file->ref_number3 = $refnum3;

         $file->file_cat_id = $curid;

         $file->status = 'Active';
         $file->view_ref_no = $refno;
         $file->edit_ref_no = $refno;
         $file->delete_ref_no = $refno;
         $file->last_time_view = $request -> last_time_view;
         $file->last_time_edit = $request -> last_time_edit;
         $file->last_time_delete = $request -> last_time_delete;
         $file->add_by = $cur;
         $file->edit_by = $request -> edit_by;
         $file->delete_by = $request -> delete_by;
         //$test = Storage::mimeType($path);
        // $type = explode('/', $test);
      //   $type = $type[1];
         $file->physical_path = $filephy;
      //   $file->type = $type;
      //return $file;
         $file->save();
         $fileid=  $file->id;

         if($asset == 'asset')
         {
           //return 'yes';
           $portasset = New Asset_Attacht;
           $portasset->asset_id = $assetno;
           $portasset->file_id = $file->id;
           $portasset->name = $filerefname;
           $portasset->save();
         }
         elseif($asset == 'member'){
           //$refno = explode('/', $refno);
           //$refno = $refno[6];
           $assetno = url()->previous();
           //return $checkurl;
           $assetno = explode('/', $checkurl);
           $assetno = $assetno[8];
           $filerefname = url()->previous();
           //return $checkurl;
           $filerefname = explode('/', $checkurl);
           $filerefname = $filerefname[11];
           //return $filerefname;
         $memberfile = New Member_Attacht;
         $memberfile->member_id = $assetno;
         $memberfile->file_id = $file->id;
         $memberfile->name = $filerefname;
         $memberfile->save();
         }
         else{
         $findref = url()->previous();

         $findref = explode('ref', $checkurl);

         $findref = $findref[1];
         $portfolio = Portfolio::find($refno);
         //$portfolio->id = $refno;
         if($findref == 1){
           $portfolio->file_port_ref1 = $fileid;
         //  return $portfolio;
           $portfolio->save();
         }
         if($findref == 2){
           $portfolio->file_port_ref2 = $fileid;
           $portfolio->save();
         }
         if($findref == 3){
           $portfolio->file_port_ref3 = $fileid;
           $portfolio->save();
         }
         }
         $chkinput = $_SERVER['REQUEST_URI'];
         $chkref2 = explode('rn2', $chkinput);
         $chkref2 = $chkref2[1];
         $ck2 = 0;
         $chkref3 = explode('rn3', $chkinput);
         $chkref3 = $chkref3[1];
         $ck3 = 0;
         if($chkref2 == NULL){
           $ck2 = 1;
         }
         if($chkref3 == NULL){
           $ck3 = 1;
         }
         //return $chkinput;
       //return $ur;
       return view('system-mgmt/file/submitfile',['ck3' =>$ck3,'ck2' =>$ck2,'publicname' =>$publicname,'refnum2' =>$refnum2,'refnum3' =>$refnum3]);
     }

    public function create(Request $request)
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




           //$portfolio = portfolio::find($id);
           $number = [123, 713, 3];
           // Redirect to city list if updating city wasn't existed
           //if ($id == $number )
           $cg = $_SERVER['REQUEST_URI'];
           $cg = explode('CG', $cg);
           $cg = $cg[1];
           $link = $_SERVER['REQUEST_URI'];
           $filegroup = DB::table('file_category')->where('file_cat_group',$cg)->get();

           $asset = $_SERVER['REQUEST_URI'];
           $asset = explode('/', $asset);
           $asset = $asset[2];
           if($asset == 'asset'){
             $portid = $_SERVER['REQUEST_URI'];
             $portid = explode('/', $portid);
             $portid = $portid[4];
             $fc = 0;
          }
          $portids = $_SERVER['REQUEST_URI'];
          $portids = explode('?', $portids);
          //return $portid;
          $portid = $_SERVER['REQUEST_URI'];
          $portid = explode('/', $portid);
          $portid = $portid[4];
          $fc= 0;
          $chkca = 0;
          if(in_array('cat',$portids)){
          $fc =$_SERVER['REQUEST_URI'];
          $fc =explode('CA', $fc);
          $fc =$fc[1];
          $filegroup = DB::table('file_category')->where('id',$fc)->get();
          $chkca = 1;
          }



           //check link before to validate create file
           $checkurl = $_SERVER['REQUEST_URI'];

           if($asset == 'portfolio'|| $asset == 'showfromall'|| $asset == 'asset'|| $asset == 'member' || strstr($checkurl, 'case') ||strstr($checkurl, 'offer')){
           //return $portid;
			   //return $portid;
             //if(in_array($portid, $portfo)){
        $eventtypes = EventType::all();
        $organizes = Person::where('type','=','2')->get();
        $groups = Family::all();
        $groupmems = Member_group::all();
        date_default_timezone_set("Asia/Bangkok");
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $time = date("h:i:s");
        $filecat = DB::table('file_category')->where('id',$fc)->get();
        $fileserver = DB::table('file_category')->where('id',$fc)->value('default_server_id');

        $blink = str_replace(url('/'), '', url()->previous());

      /* if($fileserver == 1){
          $serve = $_SERVER['REQUEST_URI'];
          return view('system-mgmt/file/createinternal',['serve' =>$serve,'filecat' =>$filecat,'groups' =>$groups,'groupmems' =>$groupmems,'day' =>$day,'month' =>$month,'year' =>$year,'time' =>$time,'eventtypes' => $eventtypes, 'organizes' => $organizes,'tree'=>$tree]);
        }*/
        //return $filecat;
				         $filepackage = DB::table('file_package')->get();

        return view('system-mgmt/file/create',['filepackage'=>$filepackage,'blink'=>$blink,'chkca'=>$chkca,'link'=>$link,'filegroup'=>$filegroup,'fileserver'=>$fileserver,'filecat' =>$filecat,'groups' =>$groups,'groupmems' =>$groupmems,'day' =>$day,'month' =>$month,'year' =>$year,'time' =>$time,'eventtypes' => $eventtypes, 'organizes' => $organizes,'tree'=>$tree]);
   // }
    //return view('errortype2');
  }
    return view('errortype2');
   }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function gotocomplete(){
       //http://192.168.10.57:8000/SecurityBroke/portfolio/file/changstatus
       $link = str_replace(url('/'), '', url()->previous());
      // return $link;
      $mergelink = 'http://192.168.10.57/erp.wealththai.net/public/index.php/SecurityBroke/portfolio/file/changstatus?'.$link;
       /*$link = explode('blink', $link);
       $link = $link[1];*/
       //return $link;
       return redirect($mergelink);
     }
    public function store(Request $request)
    {
      $asset = url()->previous();
      $asset = explode('/', $asset);
      $asset = $asset[4];


      $curid = url()->previous();
      $curid = explode('CA', $curid);
      $curid = $curid[1];
      $filecat = DB::table('file_category')->where('id',$curid)->value('max_file_size');
      $filetype = DB::table('file_category')->where('id',$curid)->value('file_type');
      $s = $filecat * 1000;

      //return $filetype;
      $this->validate($request,[
        'attachment' => 'required|file|max:'.$s,
        'attachment' => 'mimes:'.$filetype,

      ],
      [ 'attachment.max' => 'ขนาดของไฟล์ห้ามเกิน '.$filecat.' MB',
        'attachment.required' => 'กรุณาใส่ไฟล์ของท่าน',
        'attachment.mimes' => 'รูปแบบของไฟล์ต้องเป็น '.$filetype.' เท่านั้น',

      ]);
      date_default_timezone_set('Asia/Bangkok');
      date('D-m-y H:i:s');

      $ses = Session::all();
      $refno = url()->previous();
      //return $filecat;
    //  $te =
  $refno = explode('/', $refno);
  $refno = $refno[6];
  $assetno = url()->previous();
  $assetno = explode('/', $assetno);
  $assetno = $assetno[7];
  $filerefname = url()->previous();
  $filerefname = explode('/', $filerefname);
  $checkurl = url()->previous();
  if(strstr($checkurl, 'case'))
  {
  $filerefname =   $filerefname[9];
  }
  elseif(strstr($checkurl, 'offer'))
  {
  $filerefname =   $filerefname[9];
  }
  else{
      $filerefname = $filerefname[10];
  }
  //return $filerefname;
    //    return $ses;
        $txt = $request->txt;

      $time =  date('d-m-y');
      $rand = str_random(32);
      $plus = $txt.$time.$rand;
      $chksum = strlen($plus);
      $end = $plus.$chksum;
    //  return $end;
        $cur = $request->user()->id;
        $file = new File;
        $file->file_public_name = $request -> file_public_name;
        $file->file_ref_name = $filerefname;
        $file->ref_number1 = $refno;
        $file->ref_number2 = $request -> ref_number2;
        $file->ref_number3 = $request -> ref_number3;

        $file->file_cat_id = $curid;

        $file->status = 'Active';
        $file->view_ref_no = $refno;
        $file->edit_ref_no = $refno;
        $file->delete_ref_no = $refno;
        $file->last_time_view = $request -> last_time_view;
        $file->last_time_edit = $request -> last_time_edit;
        $file->last_time_delete = $request -> last_time_delete;
        $file->add_by = $cur;
        $file->edit_by = $request -> edit_by;
        $file->delete_by = $request -> delete_by;
  //  return $file;


        if($request->file('attachment')){
          $filefolder = DB::table('file_category')->where('id',$curid)->value('default_folder_path');
			          $filesubfolder = DB::table('file_category')->where('id',$curid)->value('subfolder');

          $filename = $request->file('attachment')->getClientOriginalName();
          //return $filefolder;
          $r = explode('.', $filename);
          $r = $r[1];
          //return $r;



          $filename = $request->file('attachment')->getClientOriginalName();
          //return $filefolder;
          $r = explode('.', $filename);
          $r = $r[1];
          //return $r;
      if($filesubfolder == 'Yes'){


      $fileNames = 'sdasdasdasdastest';
          $path = $request->file('attachment')->storeAs(
      $filefolder.'/'.$refno,$end
  );
  }
  else{

  $fileNames = 'sdasdasdasdastest';
      $path = $request->file('attachment')->storeAs(
  $filefolder.'/'.'',$end);
}
  //  return $path ;
      $test = Storage::mimeType($path);
      $type = explode('/', $test);
      $type = $type[1];
    //  return $type;
      $file->physical_path = $path;
      $file->type = $type;

        }
        $file->save();
        if($asset == 'asset'){
        $portasset = New Asset_Attacht;
        $portasset->asset_id = $assetno;
        $portasset->file_id = $file->id;
        $portasset->name = $filerefname;
        $portasset->save();
        }
        elseif($asset == 'member'){
          //$refno = explode('/', $refno);
          //$refno = $refno[6];
          $assetno = url()->previous();
          $assetno = explode('/', $assetno);
          $assetno = $assetno[6];
          $filerefname = url()->previous();
          $filerefname = explode('/', $filerefname);
          $filerefname = $filerefname[9];

        $memberfile = New Member_Attacht;
        $memberfile->member_id = $assetno;
        $memberfile->file_id = $file->id;
        $memberfile->name = $filerefname;
        $memberfile->save();
        }
        $checkurl = url()->previous();
        if(strstr($checkurl, 'case'))
        {
          $assetno = url()->previous();
          $assetno = explode('/', $assetno);
          $assetno = $assetno[6];
          $filerefname = url()->previous();
          $filerefname = explode('/', $filerefname);
          $filerefname = $filerefname[9];
          $casefile = New Case_Attacht;
          $casefile->case_id = $assetno;
          $casefile->file_id = $file->id;
          $casefile->name = $filerefname;
          $casefile->save();
          //return 'yes';
        }
        elseif(strstr($checkurl, 'offer'))
        {
          $assetno = url()->previous();
          $assetno = explode('/', $assetno);
          $assetno = $assetno[6];
          $filerefname = url()->previous();
          $filerefname = explode('/', $filerefname);
          $filerefname = $filerefname[9];
          $offerfile = New Offer_Attacht;
          $offerfile->offer_id = $assetno;
          $offerfile->file_id = $file->id;
          $offerfile->name = $filerefname;
          $offerfile->save();
          //return 'yes';
        }
        else{
        $findref = url()->previous();
        $findref = explode('ref', $findref);
        $findref = $findref[1];

        $portfolio = Portfolio::find($refno);
        //$portfolio->id = $refno;
        if($findref == 1){
          $portfolio->file_port_ref1 = $file->id;
        //  return $portfolio;
          $portfolio->save();
        }
        if($findref == 2){
          $portfolio->file_port_ref2 = $file->id;
          $portfolio->save();
        }
        if($findref == 3){
          $portfolio->file_port_ref3 = $file->id;
          $portfolio->save();
        }
        }


        $re = url()->previous();
        $re = explode('blink', $re);
        $re = $re[1];
        //return $re;

        return redirect ($re);
    }

    public function change(Request $request)
    {
      $currentuserid = Auth::user()->id;
      //return $currentuserid;

      $asset = url()->previous();
      $asset = explode('/', $asset);
      $asset = $asset[4];


      $curid = url()->previous();
      $curid = explode('CA', $curid);
      $curid = $curid[1];
      $filecat = DB::table('file_category')->where('id',$curid)->value('max_file_size');
      $filetype = DB::table('file_category')->where('id',$curid)->value('file_type');
      $s = $filecat * 1000;

      //return $filetype;
      $this->validate($request,[
        'attachment' => 'required|file|max:'.$s,
        'attachment' => 'mimes:'.$filetype,

      ],
      [ 'attachment.max' => 'ขนาดของไฟล์ห้ามเกิน '.$filecat.' MB',
        'attachment.required' => 'กรุณาใส่ไฟล์ของท่าน',
        'attachment.mimes' => 'รูปแบบของไฟล์ต้องเป็น '.$filetype.' เท่านั้น',

      ]);
      date_default_timezone_set('Asia/Bangkok');
      date('D-m-y H:i:s');

      $ses = Session::all();
      $refno = url()->previous();
      //return $filecat;
    //  $te =
  $refno = explode('/', $refno);
  $refno = $refno[6];
  $assetno = url()->previous();
  $assetno = explode('/', $assetno);
  $assetno = $assetno[7];
  $filerefname = url()->previous();
  $filerefname = explode('/', $filerefname);
  $filerefname = $filerefname[10];
  //return $filerefname;
    //    return $ses;

        $txt = $request->txt;
      $curdatetime = date('d-m-y H:i:s');
    //  return $curdatetime;
      $time =  date('d-m-y');
      $rand = str_random(32);
      $plus = $txt.$time.$rand;
      $chksum = strlen($plus);
      $end = $plus.$chksum;
    //  return $end;
        $cur = $request->user()->id;
        $file = new File;
        $file->file_public_name = $request -> file_public_name;
        $file->file_ref_name = $filerefname;
        $file->ref_number1 = $refno;
        $file->ref_number2 = $request -> ref_number2;
        $file->ref_number3 = $request -> ref_number3;

        $file->file_cat_id = $curid;

        $file->status = 'Active';
        $file->view_ref_no = $refno;
        $file->edit_ref_no = $refno;
        $file->delete_ref_no = $refno;
        $file->last_time_view = $request -> last_time_view;
        $file->last_time_edit = $curdatetime;
        $file->last_time_delete = $request -> last_time_delete;
        //$file->add_by = $cur;
        $file->edit_by = $currentuserid;
        $file->delete_by = $request -> delete_by;
  //  return $file;


        if($request->file('attachment')){
          $filefolder = DB::table('file_category')->where('id',$curid)->value('default_folder_path');
          $filenametostore = $filename.'_'.uniqid().'.'.$end;
          Storage::disk('ftp')->put($filenametostore, fopen($request->file('attachment'), 'r+'));

          $filename = $request->file('attachment')->getClientOriginalName();
          //return $filefolder;
          $r = explode('.', $filename);
          $r = $r[1];
          //return $r;


      $fileNames = 'sdasdasdasdastest';
        /*  $path = $request->file('attachment')->storeAs(
      $filefolder.'/'.$refno,$end
  );*/
  //  return $path ;
      $test = Storage::mimeType($path);
      $type = explode('/', $test);
      $type = $type[1];
    //  return $type;
          $file->physical_path = $path;
          $file->type = $type;

        }


        $file->save();
        if($asset == 'asset'){

          $portasset = New Asset_Attacht;
          $portasset->asset_id = $assetno;
          $portasset->file_id = $file->id;
          $portasset->name = $filerefname;
          $portasset->save();
        }
        else{
        $findref = url()->previous();
        $findref = explode('ref', $findref);
        $findref = $findref[1];

        $portfolio = Portfolio::find($refno);
        //$portfolio->id = $refno;
        if($findref == 1){
          $portfolio->file_port_ref1 = $file->id;
        //  return $portfolio;
          $portfolio->save();
        }
        if($findref == 2){
          $portfolio->file_port_ref2 = $file->id;
          $portfolio->save();
        }
        if($findref == 3){
          $portfolio->file_port_ref3 = $file->id;
          $portfolio->save();
        }
        }



        $re = $request->previous;

        return redirect ($re);
    }

    public function fakedelete($id){
      //return 'fakedelete';
      $checkurl = $_SERVER['REQUEST_URI'];
      if(strstr($checkurl, 'casesdelete'))
      {
        $asset = $_SERVER['REQUEST_URI'];
        $asset = explode('/', $asset);
        $asset = $asset[5];
      }
      elseif(strstr($checkurl, 'offerdelete'))
      {
        $asset = $_SERVER['REQUEST_URI'];
        $asset = explode('/', $asset);
        $asset = $asset[5];
      }
      else{

      $asset = url()->previous();
      $asset = explode('/', $asset);
      $asset = $asset[5];

    }


      $portref = $_SERVER['REQUEST_URI'];
      $portref = explode('/', $portref);
      $portref = $portref[6];
      if($portref == 'ref1ref'){
      $port = $_SERVER['REQUEST_URI'];
      $port = explode('/', $port);
      $port = $port[5];
      $portfolio = DB::table('portfolio')->where('id',$port)->value('file_port_ref1');
      }
      if($portref == 'ref2ref'){
        $port = $_SERVER['REQUEST_URI'];
        $port = explode('/', $port);
        $port = $port[5];
        $portfolio = DB::table('portfolio')->where('id',$port)->value('file_port_ref2');
        }
        if($portref == 'ref3ref'){
          $port = $_SERVER['REQUEST_URI'];
          $port = explode('/', $port);
          $port = $port[5];
          $portfolio = DB::table('portfolio')->where('id',$port)->value('file_port_ref3');
          }


          if($asset == 'asset'){


          $portfolio = $_SERVER['REQUEST_URI'];
          $portfolio = explode('/', $portfolio);
          $portfolio = $portfolio[4];
          }
		          $portfolio = $_SERVER['REQUEST_URI'];
          $portfolio = explode('/', $portfolio);
          $portfolio = $portfolio[4];
          //return $portfolio;
          $filedel = DB::table('file')->where('id',$portfolio)->value('delete_ref_no');



        //  return $filedel;

    //  return $filedel;
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
        //if(in_array($filedel, $portfo)){
      date_default_timezone_set('Asia/Bangkok');
      date('D-m-y H:i:s');
      $currentid = Auth::user()->id;
      $currenttime = date('d-m-y H:i:s');
      $r = $_SERVER['REQUEST_URI'];
      $r = explode('/', $r);
      $r = $r[4];
//      return $r;

      $lastview = ['status' =>'Delete' ,
                    'delete_by' =>$currentid,
                    'last_time_delete' =>$currenttime ];
      $fileup = DB::table('file')->where('id',$r)->update($lastview);
      return redirect()->back();
  //  }
  //  return view('errortype2');
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


           $events = DB::table('file')
           ->where('file.id',$id)
          ->leftJoin('file_category', 'file.file_cat_id', '=', 'file_category.id')
          ->leftJoin('users as add','file.add_by','=','add.id')
          ->leftJoin('users as edit','file.edit_by','=','edit.id')
          ->leftJoin('users as delete','file.delete_by','=','delete.id')

          ->select('file.*', 'file_category.ref_label1 as label1', 'file_category.ref_label2 as label2', 'file_category.ref_label3 as label3', 'file_category.name as file_cat_name', 'add.firstname as add_name', 'delete.firstname as delete_name', 'edit.firstname as edit_name', 'file_category.id as file_cat_id')
          ->paginate(20);


        // Redirect to division list if updating division wasn't existed
        if ($events == null) {
          $events = File::find($id);
          $data = array(
              'event' => $event
            );
            return redirect ('/admin/file');
        }

        $eventtypes = EventType::all();
        $organizes = Organize::all();
        $member = DB::table('persons')->where('event_id',1)->get();
      //  return $member;
        return view('system-mgmt/file/show', ['member' => $member,'events' => $events, 'eventtypes' => $eventtypes,'organizes' => $organizes,'tree'=>$tree]);
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


        $eventtypes = EventType::all();
        $organizes = Person::where('type','=','2')->get();
        $groups = Family::all();
        $groupmems = Member_group::all();
        date_default_timezone_set("Asia/Bangkok");
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        $time = date("h:i:s");
    //    return $year;
    $fc = $_SERVER['REQUEST_URI'];
    $fc = explode('CA', $fc);
    $fc = $fc[1];
  //  return $fc;
  $portref = $_SERVER['REQUEST_URI'];
$portref = explode('/', $portref);
$portref = $portref[4];

$portrefname = $_SERVER['REQUEST_URI'];
$portrefname = explode('/', $portrefname);
$portrefname = $portrefname[9];
//return $portrefname;

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
$canedit = DB::table('file')->where('id',$portrefname)->value('edit_ref_no');
//  return $canedit;
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
$portid = $_SERVER['REQUEST_URI'];
$portid = explode('/', $portid);
$portid = $portid[4];

$fileid = $_SERVER['REQUEST_URI'];
$fileid = explode('/', $fileid);
$fileid = $fileid[9];
//   return $portid;
  if(in_array($portid, $portfo)){

  if(in_array($canedit, $portfo)){

  //  return $portfo;
$canedit = DB::table('file')->where('edit_ref_no',$portref)->pluck('id');
$file = File::find($fileid);
//return $file;

//return $canedit;

        $filecat = DB::table('file_category')->where('id',$fc)->get();
        //return $filecat;
        return view('system-mgmt/file/edit',['file' =>$file,'filecat' =>$filecat,'groups' =>$groups,'groupmems' =>$groupmems,'day' =>$day,'month' =>$month,'year' =>$year,'time' =>$time,'eventtypes' => $eventtypes, 'organizes' => $organizes,'tree'=>$tree]);
      }
      return view('errortype2');
    }
    return view('error');
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
      $curid = $request->catid;
      $filecat = DB::table('file_category')->where('id',$curid)->value('max_file_size');
  	  $s = $filecat * 1000;
      $this->validate($request,[
        'attachment' => 'required|file|max:'.$s,
      ]);
      date_default_timezone_set('Asia/Bangkok');
      date('D-m-y H:i:s');

      $ses = Session::all();
      $refno = url()->previous();
      //return $filecat;
    //  $te =
  $refno = explode('/', $refno);
  $refno = $refno[6];
  $filerefname = url()->previous();
  $filerefname = explode('/', $filerefname);
  $filerefname = $filerefname[10];
  //return $filerefname;
    //    return $ses;
        $txt = $request->txt;

      $time =  date('d-m-y');
      $rand = str_random(32);
      $plus = $txt.$time.$rand;
      $chksum = strlen($plus);
      $end = $plus.$chksum;
    //  return $end;
        $cur = $request->user()->id;
        $file = new File;
        $file->file_public_name = $request -> file_public_name;
        $file->file_ref_name = $filerefname;
        $file->ref_number1 = $refno;
        $file->ref_number2 = $request -> ref_number2;
        $file->ref_number3 = $request -> ref_number3;

        $file->file_cat_id = $curid;

        $file->status = 1;
        $file->view_ref_no = $refno;
        $file->edit_ref_no = $refno;
        $file->delete_ref_no = $refno;
        $file->last_time_view = $request -> last_time_view;
        $file->last_time_edit = $request -> last_time_edit;
        $file->last_time_delete = $request -> last_time_delete;
        $file->add_by = $cur;
        $file->edit_by = $request -> edit_by;
        $file->delete_by = $request -> delete_by;
  //  return $file;


        if($request->file('attachment')){
          $filefolder = DB::table('file_category')->where('id',$curid)->value('default_folder_path');
          $filename = $request->file('attachment')->getClientOriginalName();
          //return $filefolder;
          $r = explode('.', $filename);
          $r = $r[1];
          //return $r;


      $fileNames = 'sdasdasdasdastest';
          $path = $request->file('attachment')->storeAs(
      $filefolder.'/'.$refno,$end
  );
  //  return $path ;
      $test = Storage::mimeType($path);
      $type = explode('/', $test);
      $type = $type[1];
    //  return $type;
          $file->physical_path = $path;
          $file->type = $type;

        }


        $file->save();

        $findref = url()->previous();
        $findref = explode('ref', $findref);
        $findref = $findref[1];

        $portfolio = Portfolio::find($refno);
        //$portfolio->id = $refno;
        if($findref == 1){
          $portfolio->file_port_ref1 = $file->id;
        //  return $portfolio;
          $portfolio->save();
        }
        if($findref == 2){
          $portfolio->file_port_ref2 = $file->id;
          $portfolio->save();
        }
        if($findref == 3){
          $portfolio->file_port_ref3 = $file->id;
          $portfolio->save();
        }



        $re = url()->previous();
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
       $filepath = File::where('id',$id)->value('physical_path');
      // return $filepath;
       Storage::delete($filepath);

         File::where('id', $id)->delete();
          return redirect()->back();
     }

    public function loadStates($structureId) {
        $blocks = Block::where('structure_id', '=', $structureId)->get(['id', 'name']);

        return response()->json($blocks);
    }
    /**
     * Search division from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

      //sidebar

  $tree = session()->get('tree');
  //sidebar

        $constraints = [
            'file_ref_name' => $request['file_ref_name'],
            'file_public_name' => $request['file_public_name'],
            'file_category.name' => $request['file_cat_name'],
            'type' => $request['type'],
            'status'=> $request['status'],
            'ref_number1' => $request['ref_number1'],
            'ref_number2' => $request['ref_number2'],
            'ref_number3' => $request['ref_number3'],
            'view_ref_no' => $request['view_ref_no'],
            'edit_ref_no' => $request['edit_ref_no'],
            'delete_ref_no' => $request['delete_ref_no'],
            'last_time_view' => $request['last_time_view'],
            'last_time_edit' => $request['last_time_edit'],
            'last_time_delete' => $request['last_time_delete'],
            'add_by' => $request['add_by'],
            'edit_by' => $request['edit_by'],
            'delete_by' => $request['delete_by'],


            ];

       $events = $this->doSearchingQuery($constraints);
      $constraints['file_cat_name'] = $request['file_cat_name'];

       return view('system-mgmt/file/index', ['events' => $events, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('file')
       ->leftJoin('file_category', 'file.file_cat_id', '=', 'file_category.id')
       ->select('file.*', 'file_category.name as file_cat_name', 'file_category.id as file_cat_id');
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


    /*public function load($name) {
         $path = storage_path().'/app/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }*/


    private function validateInput($request) {
        $this->validate($request, [
      //  'name' => 'required|max:60'
    ]);
    }
    public function findBlockName(Request $request){
      $data=Block::select('name','id')->where('structure_id',$request->id)->take(100)->get();
      return response()->json($data);
    }

    public function divDep(Request $request){

      $dep = $request->dep;

      $data = DB::table('block')->join('structure','structure.id','block.structure_id')
      ->where('structure.name',$dep)->get();
      return view('system-mgmt/block/index',[
        'data' => $data ,'depByUser' => $dep
      ]);
    }
    public function divisionDep(Request $request){
       $structure_id = $request->structure_id;
      $data = DB::table('block')
      ->join('structure','structure.id','block.structure_id')
      ->where('block.structure_id',$structure_id)
      ->get();
    }



    public function Allinone(){

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

       									 $curmem = $curmem->toArray();
                        // $member = DB::table('persons')->whereIn('id',$curmem)->get();
                        //return $member;

  		//sidebar
      $checkurl = $_SERVER['REQUEST_URI'];
      $checkurl = explode('/', $checkurl);
      //$checkurl = $checkurl[1];
      //return $checkurl;
      $portfolio =DB::table('portfolio')->where('member_id',0)->where('id',30)->get();
      $portwealth = DB::table('portfolio')->where('member_id',0)->where('port_id',31)->get();
      $asset = DB::table('asset')->where('id',0)->get();
      $portn =DB::table('portfolio')->where('id',0)->get();
      $assetnl = DB::table('asset')
      ->where('asset.id',0)
      ->leftJoin('asset_type','asset.la_nla_type', '=','asset_type.id')
      ->where('asset_type.la_nla','=','Non Liquidity Asset')
      ->get();
		$member = DB::table('persons')->get();
      if(in_array('refermem',$checkurl)){
      $memid = $_SERVER['REQUEST_URI'];
      $memid = explode('refm', $memid);
      $memid = $memid[1];
      //return $memid;
      $member = DB::table('persons')->where('id',$memid)->get();



    //  return $aoid;
      }
      else{
        //$member = DB::table('persons')->where('id',0)->get();
        $ownass = DB::table('persons')->where('id',0)->get();
      }

      if(in_array('owner',$checkurl)){
        $aoid = $_SERVER['REQUEST_URI'];
        $aoid = explode('aow', $aoid);
        $aoid = $aoid[1];
      //  return $aoid;
        $ownass = DB::table('persons')->where('id',$aoid)->get();
        $portn = DB::table('portfolio')->where('member_id',$aoid)->where('structure_id',15)->where('block_id',80)->get();
        $portfolio =DB::table('portfolio')->where('member_id',$aoid)->where('id',30)->get();
        $portwealth = DB::table('portfolio')->where('member_id',$aoid)->where('port_id',31)->get();

      }
      else{
        $ownass = DB::table('persons')->where('id',0)->get();
          //$port = DB::table('portfolio')->where('member_id',0)->get();
      }
      if(in_array('pnumber',$checkurl)){
        $pfid = $_SERVER['REQUEST_URI'];
        $pfid = explode('pf', $pfid);
        $pfid = $pfid[1];
        $portn = DB::table('portfolio')->where('id',$pfid)->get();
        $assetnl = DB::table('asset')->where('port_id',$pfid)->get();
        //return $assetnl;
        //return $pfid;
        $asset = DB::table('asset')
        ->where('asset.port_id',$pfid)
        ->leftJoin('asset_type','asset.la_nla_type', '=','asset_type.id')
        ->where('asset_type.la_nla','=','Non Liquidity Asset')
        ->select('asset.*','asset_type.la_nla_type as asset_type_name','asset_type.id as asset_type_id')
        ->get();//return $asset;
      }


      if(in_array('reasnumber',$checkurl)){

        $asid = $_SERVER['REQUEST_URI'];
        $asid = explode('as', $asid);
        $asid = $asid[2];
      //  return $asid;
        $assetnl = DB::table('asset')->where('id',$asid)->get();
      // return $assetnl;
      }
      $curport = DB::table('portfolio')->where('id',0)->get();
		$assettype = DB::table('asset_type')->whereIn('id',[0])->get();
      if(in_array('WealthNon',$checkurl)){

        $curportid = $_SERVER['REQUEST_URI'];
        $curportid = explode('pw', $curportid);
        $curportid = $curportid[1];
        $curport = DB::table('portfolio')->where('id',$curportid)->where('port_id',31)->get();
        //return $curport;
		          $findporttype = DB::table('portfolio')->where('id',$curportid)->value('port_id');
        $portasset =DB::table('port_asset_type')->where('port_type_id',$findporttype)->pluck('asset_type_id');
        $assettype = DB::table('asset_type')->whereIn('id',$portasset)->get();
      }

    //  return $curport;

    //  return $assetnl;


    //  $asset = DB::table('asset')->get();



    //  return $asstes;
    $url1= $_SERVER['REQUEST_URI'];
    //return $url1;
    $status = DB::table('asset_status')->get();
    $checkport = $_SERVER['REQUEST_URI'];
    $checkport = explode('/', $checkport);
    $ifport = 0;
    if(in_array('pnumber',$checkport)){
      $ifport = 1;
	  $show = $_SERVER['REQUEST_URI'];
      $show = explode('pf', $show);
      $show = $show[1];
	  if($show == 0){
        $ifport = 0;
      }
    }
    $ifwealth = 0;
    if(in_array('WealthNon',$checkport)){
      $ifwealth = 1;
    }
    $ifrefm = 0;
    if(in_array('create??',$checkport)){
      $ifrefm = 1;
    }
    $ifaow = 0;
    if(in_array('owner',$checkport)){
      $ifaow = 1;
    }
    $ifas = 0;
    if(in_array('reasnumber',$checkport)){
      $ifas = 1;
    }


    //return $asset;
    //$asset = DB::table('asset')->where('port_id',$pfid)->get();
    //return $portwealth;
  //  return $ifport;
  //  return $checkport;
      return view('system-mgmt/file/allinone',compact('curport','ifwealth','portwealth','ifas','ifaow','ifrefm','ifport','status','portn','ownass','url1','assettype','assetnl','asset','portfolio','member','tree')) ;
    }
    public function saveallinone(Request $request)
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
  // $datef = $df."/".$mf."/".$yf;
//   $dt = $request->dt;
//   $mt = $request->mt;
//   $yt = $request->yt;
//   $datet = $dt."/".$mt."/".$yt;
   //$datef
   $refmem = url()->previous();
   $refmem = explode('refm', $refmem);
   $refmem = $refmem[1];
   $assetown = url()->previous();
   $assetown = explode('aow', $assetown);
   $assetown = $assetown[1];
   $portid = url()->previous();
   $portid = explode('pw', $portid);
   $portid = $portid[1];

         date_default_timezone_set('Asia/Bangkok');
           date('D-m-y H:i:s');
           $currenttime = date('d-m-y H:i:s');
        $this->validateInput($request);
      //  return $request->get('name');
        foreach($request->get('name') as $key =>$v){
        //  return $request->name[$key];
          $data = Asset::create([
                          'name'=>$request->name[$key],
                          'ref_name'=>$request->ref_name[$key],
                          'la_nla_type'=>$request->la_nla_type[$key],
                          'sub_type'=>$request->sub_type[$key],
                          'port_id'=>$portid,
                          'ref_number1'=>$request->ref_number1 [$key],
                          'ref_number2'=>$request->ref_number2[$key],
                          'ref_number3'=>$request->ref_number3[$key],
                          'ref_info1'=>$request->ref_info1 [$key],
                          'ref_info2'=>$request->ref_info2[$key],
                          'ref_info3'=>$request->ref_info3[$key],
                          'ref_info4'=>$request->ref_info4 [$key],
                          'ref_info5'=>$request->ref_info5[$key],
                          'ref_info6'=>$request->ref_info6[$key],
                          'ref_info7'=>$request->ref_info7[$key],
                          'ref_info8'=>$request->ref_info8[$key],
                          'ref_info9'=>$request->ref_info9[$key],
                          'ref_info10'=>$request->ref_info10[$key],
                          'ref_info11'=>$request->ref_info11[$key],
                          'ref_info12'=>$request->ref_info12[$key],
                          'ref_info13'=>$request->ref_info13[$key],
                          'ref_info14'=>$request->ref_info14[$key],
                          'ref_info15'=>$request->ref_info15[$key],
                          'ref_info16'=>$request->ref_info16[$key],
                          'ref_info17'=>$request->ref_info17[$key],
                          'ref_info18'=>$request->ref_info18[$key],
                          'link_underlying'=>$request->link_underlying[$key],
                          'amount'=>$request->amount [$key],
                          'value'=>$request->value[$key],
                          'cost'=>$request->cost[$key],
                          'ref_to_asset'=>$request->ref_to_asset[$key],
                          'valid_from'=>$request->df[$key]."/".$request->mf[$key]."/".$request->yf[$key],
                          'valid_to'=>$request->dt[$key]."/".$request->mt[$key]."/".$request->yt[$key],
                          'file_attachment'=>$request->file_attachment[$key],
                          'link_to_more'=>$request->link_to_more[$key],
                          'contact_pid'=>$request->contact_pid[$key],
                          'note'=>$request->note [$key],
                          'issued_by'=>$request->issued_by[$key],
                          'branch_id'=>$request->branch_id[$key],
                        //  'updated_at'=>$currenttime,


              ]);
              //return $data;
             // Asset::insert($data);
              $data2 = array(
                'date'=>$request->date[$key],
                'time'=>$request->time[$key],
                'l_s'=>$request->l_s[$key],
                'o_c'=>$request->o_c [$key],
                'port_id'=>$portid,
                'asset_id'=>$data['id'],
                'symbol'=>$request->symbol [$key],
                //'valid_from'=>$request->valid_from[$key],
              //  'valid_to'=>$request->valid_to[$key],
                'underlying_id'=>$request->underlying_id [$key],
                'volumn'=>$request->volumn[$key],
                'price'=>$request->price[$key],
                'status'=>$request->status [$key],
                'note'=>$request->note[$key],
              );
              Asset_Transaction::insert($data2);
        }


       if($request->share == '1')
       {
       $urltypemem = url()->previous();
       $urltypemem = explode('refm', $urltypemem);
       $urltypemem= $urltypemem[1];
       $findtypemem = DB::table('persons')->where('id',$urltypemem)->value('type');
       $findportnum = url()->previous();
       $findportnum = explode('pw', $findportnum);
       $findportnum= $findportnum[1];
      // return $findtypemem;
       $refmember = url()->previous();
       $refmember = explode('refm', $refmember);
       $refmember= $refmember[1];
       if($findtypemem != 2){
         //return $urltypemem;
         Port_auth::create([
           'port_id'=> $findportnum,
           'member_id'=>$refmember,
           //'description'=>$request->description [$key],
           'created_by' =>$urltypemem,
        ]);
        // return $findtypemem;
       }
       if($findtypemem == 2){
         Organize_auth::create([

           'member_id' => $refmember,
           'organize_id' => $urltypemem,
           'status' => "Request",
           //'description' => $request['description']

        ]);
       }
       }



    $request->session()->flash('alert-success', 'บันทึกแล้ว');
    return redirect ('/Nonlife/onlynon');
  }


    public function memor(){

      //sidebar

      $tree = session()->get('tree');
      //sidebar


      return view('system-mgmt/file/memor',compact('tree')) ;
    }









}
