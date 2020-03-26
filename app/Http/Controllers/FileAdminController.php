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
use App\Member_group;
use Session;
use Storage;
use Image;
use App\User;
use App\FileCat;
use App\Http\Controllers\SidebarController;
class FileAdminController extends Controller
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




        $events = DB::table('file')
       ->leftJoin('file_category', 'file.file_cat_id', '=', 'file_category.id')
       ->select('file.*', 'file_category.name as file_cat_name', 'file_category.id as file_cat_id')
       ->paginate(20);
        return view('system-mgmt/file/index', ['events' => $events,'tree' => $tree]);
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

        $filecat = DB::table('file_category')->where('id',$fc)->get();
      //  return $filecat;
        return view('system-mgmt/file/create',['filecat' =>$filecat,'groups' =>$groups,'groupmems' =>$groupmems,'day' =>$day,'month' =>$month,'year' =>$year,'time' =>$time,'eventtypes' => $eventtypes, 'organizes' => $organizes,'tree'=>$tree]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $curid = $request->catid;
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



        $re = $request->previous;

        return redirect ($re);
    }

    public function change(Request $request)
    {

      $refno = url()->previous();
      //return $filecat;
    //  $te =
  $refno = explode('/', $refno);
  $refno = $refno[6];
  $url = '/SecurityBroke/portfolio/shows/'.$refno;

  //return $url;
  $findref = url()->previous();
  $findref = explode('ref', $findref);
  $findref = $findref[1];

  if($findref == 1){
  //  return '1';
    $findportref = DB::table('portfolio')->where('id',$refno)->value('file_port_ref1');

  }
  if($findref == 2){
    $findportref = DB::table('portfolio')->where('id',$refno)->value('file_port_ref2');
//    return '2';
  }
  if($findref == 3){
  //    return '3';
    $findportref = DB::table('portfolio')->where('id',$refno)->value('file_port_ref3');
  }

  $gotofile = DB::table('file')->where('id',$findportref)->value('physical_path');
  Storage::delete($gotofile);
  //File::where('id', $findportref)->update();
//  return $gotofile;

      //  Storage::delete($oldFilename);
    //    File::where('id', $id)->delete();
      $curid = $request->catid;
      $filecat = DB::table('file_category')->where('id',$curid)->value('max_file_size');
      $s = '10000000';
      $this->validate($request,[
        'attachment' => 'required|file|max:'.$s,
      ]);
      date_default_timezone_set('Asia/Bangkok');
      date('D-m-y H:i:s');

      $ses = Session::all();

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
        $file = File::find($findportref);
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
      //return $test;
      $type = explode('/', $test);
      $type = $type[1];
      //return $type;
    if($type == 'vnd.ms-excel')
          $file->physical_path = $path;
          $file->type = $type;

        }


        $file->save();



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

        $cururl = url()->previous();


        $re = $request -> previous;

        $request->session()->flash('alert-success', 'อัพเดทเรียบร้อยแล้ว');
        return redirect ($url);
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
          ->leftJoin('users','file.add_by','=','users.id')
          ->select('file.*', 'file_category.ref_label1 as label1', 'file_category.ref_label2 as label2', 'file_category.ref_label3 as label3', 'file_category.name as file_cat_name', 'users.firstname as user_name', 'file_category.id as file_cat_id', 'users.id as user_id')
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
  if(in_array($canedit, $portfo)){

  //  return $portfo;
$canedit = DB::table('file')->where('edit_ref_no',$portref)->pluck('id');



//return $canedit;

        $filecat = DB::table('file_category')->where('id',$fc)->get();
        //return $filecat;
        return view('system-mgmt/file/edit',['filecat' =>$filecat,'groups' =>$groups,'groupmems' =>$groupmems,'day' =>$day,'month' =>$month,'year' =>$year,'time' =>$time,'eventtypes' => $eventtypes, 'organizes' => $organizes,'tree'=>$tree]);
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
      $s = '10000000';
      $this->validate($request,[
        'attachment' => 'required|file|max:'.$filecat,
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
      $filepath = File::where('id',$id)->get();
      return $filepath;
      File::Delete('/storage/app/myfolder/'.$filename);

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
            'event_name' => $request['event_name'],

            ];

       $events = $this->doSearchingQuery($constraints);
    //  $constraints['structure_name'] = $request['structure_name'];

       return view('system-mgmt/event/index', ['events' => $events, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('event')
       ->leftJoin('event_type', 'event.event_type_id', '=', 'event_type.id')
       ->leftJoin('persons as organize', 'event.organization_id', '=', 'organize.id')
       ->leftJoin('family', 'event.group_id', '=', 'family.id')
       ->leftJoin('member_groups', 'event.member_group_id', '=', 'member_groups.id')

       ->select('event.*', 'event_type.name as event_type_name', 'event_type.id as event_type_id', 'organize.name as organize_name', 'organize.id as organize_id'
                , 'family.name as group_name', 'family.id as group_id', 'member_groups.name as member_group_name', 'member_groups.id as member_group_id');
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
        'name' => 'required|max:60'
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


    public function mem($id)
    {

      //sidebar

    $tree = session()->get('tree');
    //sidebar


        $event = Event::find($id);


        // Redirect to division list if updating division wasn't existed
        if ($event == null) {
          $event = Event::find($id);
          $data = array(
              'event' => $event
            );
            return redirect ('/admin/event');
        }
        $eventtypes = EventType::all();
        $organizes = Organize::all();
        $member = DB::table('persons')->where('event_id',1)->get();
      //  return $member;
        return view('system-mgmt/event/showmem', ['member' => $member,'event' => $event, 'eventtypes' => $eventtypes,'organizes' => $organizes,'tree'=>$tree]);
    }
    public function showevent($id){
      date_default_timezone_set('Asia/Bangkok');

      //sidebar

    $tree = session()->get('tree');
    //sidebar





      $ref   = DB::table('event')
      ->where('event.id',$id)
     ->leftJoin('event_type', 'event.event_type_id', '=', 'event_type.id')
     ->leftJoin('persons as organize', 'event.organization_id', '=', 'organize.id')
     ->leftJoin('family', 'event.group_id', '=', 'family.id')
     ->leftJoin('member_groups', 'event.member_group_id', '=', 'member_groups.id')

     ->select('event.*', 'event_type.name as event_type_name', 'event_type.id as event_type_id', 'organize.name as organize_name', 'organize.id as organize_id'
              , 'family.name as group_name', 'family.id as group_id', 'member_groups.name as member_group_name', 'member_groups.id as member_group_id')
     ->get();
      //$br = DB::table('branch')->where('org_id',$id)->get();
      return view('system-mgmt/event/showevent', compact(['ref','tree']));
    }


    public function fix($id){
      //sidebar

          $tree = session()->get('tree');
          //sidebar

        $file = File::find($id);
        $user = User::all();
        $filecat = FileCat::all();
        return view('system-mgmt/file/fix', compact(['filecat','user','file','tree']));

    }

    public function fixup(Request $request, $id)
    {
      $file = File::find($id);

      $file->file_public_name = $request -> file_public_name;
      $file->file_ref_name = $request -> file_ref_name;
      $file->physical_path = $request -> physical_path;
      $file->file_cat_id	 = $request -> file_cat_id	;
      $file->type = $request -> type;
      $file->status = $request -> status;
      $file->ref_number1 = $request -> ref_number1;
      $file->ref_number2 = $request -> ref_number2;
      $file->ref_number3 = $request -> ref_number3;
      $file->view_ref_no = $request -> view_ref_no;
      $file->edit_ref_no = $request -> edit_ref_no;
      $file->delete_ref_no = $request -> delete_ref_no;
      $file->last_time_view = $request -> last_time_view;
      $file->last_time_edit = $request -> last_time_edit;
      $file->last_time_delete = $request -> last_time_delete;
      $file->save();

        $re = url()->previous();
        $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');

        return redirect ('/admin/file');
    }





}
