<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Organize;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\Viewper;
use App\Organize_auth;
use Session;
use Mail;
use App\Person;
use App\match_id;
use App\Message_type;
use Illuminate\Support\Facades\Hash;
use App\Member_group;
use App\match_member_id;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SidebarController;
class OrganizeUserController extends Controller
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
     $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';

    /* @foreach(App\Structure::whereIn('id',$currentstruc)->get(); as $depList)
     <li><a href="{{url('portfolio')}}/{{$depList->name}}">
       {{$depList->name}}</a></li>
     @endforeach*/

     foreach ($CurrentDivisions as $Division) {
       $tree .='<li class="tree-view closed"<a  class="tree-name">'.$Division->name.'</a>';

       $status = $Division->status;
       if($count == 0){
            $result .='<li class="tree-view closed"><a  href="'.$Division->name.   ' "class="tree-name">'.$Division->name.'</a>'.' Category current Block ID is  :' .$currentid.'count:'.$count;

       }else{
             $result .='<li class="tree-view closed"><a href="'.$Division->name.   ' ">'.$Division->name.   ' <b>Status:</b> '.$status.'</a>';
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
 */
 $tree .='<ul>';



 return view('files.treeview',['tree' => $tree]);
 return $tree;


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
      									 $personsss = DB::table('persons')
      									 ->whereIn('persons.id',$curmem)->pluck('id');
                         //return $personsss;
        //$structures = Person::where('type',2)->whereIn('id',$personsss)->paginate(1000);
		$structures = Person::where('type',2)->orderBy('created_at','DESC')->paginate(1000);
      //  return $structures;

        return view('system-mgmt/organizeuser/index', ['structures' => $structures,'tree' =>$tree]);
    }





/*public function childView($view){



        $html ='<ul class="treeview-menu">';
        foreach ($view->childs as $arr) {

            if(count($arr->childs) && $view->add_to_side == "Yes"){

            $html .='<li> <a  href ="'.$arr->view_url.'"class=""><i class="fa fa-link"></i>'.$arr->name.' <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span></a> ';
                    $html.= $this->childView($arr);


                }elseif($view->add_to_side == "Yes"){
                    $html .='<li class="treeview"><a href ="'.$arr->view_url.'"class="">'.$arr->name.'</a>' ;
                    $html .="</li>";
                }

        }
        $html .="</ul>";

        return $html;
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
		  		$current = Auth::user()->id;

      $currentid = DB::table('persons')

              ->where(//[ 'structure_id', '=',9 ],
                        'id', '=',$current

                     )
                     ->get();
                     $r = $_SERVER['REQUEST_URI'];
                    $r = explode('/', $r);
                    $r = $r[2];

                     $allinone =0;
                     $belongto ="";
                    if($r == 'allinone'){
                      $org = $_SERVER['REQUEST_URI'];
                     $org = explode('/', $org);
                     $org = $org[3];
                      $allinone = 1;
                      $try = $_SERVER['REQUEST_URI'];
                     $try = explode('/', $try);
                      $refm = $_SERVER['REQUEST_URI'];
                      if(in_array('create??',$try)){
                     $refm = explode('refm', $refm);
                     $refm = $refm[1];
                      $belongto = DB::table('match_id')->where('member_id',$refm)->value('id');
                   }


                     //return $belongto;
                  }
                  $provinces = DB::table('provinces')->get();
                    $countrys = DB::table('country')->get();
                  //return $allinone;
        return view('system-mgmt/organizeuser/create',['countrys' =>$countrys,'provinces' =>$provinces,'allinone' =>$allinone,'belongto'=>$belongto,'currentid' =>$currentid,'tree' =>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {


		 $this->validate($request, [
      'email' => 'required|email|max:255|unique:persons',
        'id_num' => 'required|min:13|unique:persons',
      ]
      );

		 date_default_timezone_set('Asia/Bangkok');
       $current = Auth::user()->id;
       $sd = $request->sd;
       $sm = $request->sm;
       $sy = $request->sy;

       $date = $sd."-".$sm."-".$sy;
         $ma=DB::table('match_id')->where('id',$request->belong_to)->value('member_id');
       $per = new Person;
       $per->name = $request -> name;
       $per->gender = $request-> gender;
       $per->id_num = $request-> id_num;
       $per->mobile = $request-> mobile;
       $per->dob = $date;
       $per->nationality = $request-> nationality;
       $per->couple_email = $request-> couple_email;
       $per->more = $request-> more;

       $per->add2 = $request-> add2;
       $per->add2_alley = $request-> add2_alley;
       $per->add2_road = $request-> add2_road;
       $per->add2_subdistrict = $request-> add2_subdistrict;
       $per->add2_district = $request-> add2_district;
       $per->add2_city = $request-> add2_city;
       $per->add2_country = $request-> add2_country;
       $per->add2_postcode = $request-> add2_postcode;

       $per->type = 2;
       $per->status = "Request Reset Password" ;
       $per->belong_to = $ma;

       $per->email = $request-> email;
       $per->emergency_name =$request->emergency_name;
       $per->emergency_phone =$request->emergency_phone;
       $per->emergency_email =$request->emergency_email;
       $per->emergency_relation =$request->emergency_relation;
       $per->password = Hash::make($request->id_num);

       $input = $request->all();
      //  $validator = $this->validate($input);
        $password = $request->password;
        $input['password'] =substr($password, 0, -3);

        $input['password'] .= "***";


        //  $mem = $this->$input->toArray();
       /*   Mail::send('emails.welcome',$input,function($message) use ($input){

            $message->to($input['email']);
            $message->subject('ยืนยันการสมัครเข้าใช้งาน Website Wealth Thai ');
          });*/
		// return 'yes';
          $per->save();


          $match_id = new match_id;
                      $match_id->public_name = $per->name;
                      $match_id->public_email = $per->email;
                      $match_id->public_mobile = $per->mobile;
                      $match_id->sender_citizen = $per->id_num;
                      $match_id->member_id = $per->id;
                      $match_id->save();
		 
		 		          $orgauthself = new Organize_auth;
                     $orgauthself->member_id = $per->id;
                     $orgauthself->organize_id = $per->id;
                     $orgauthself->status = 'Accept';
                     $orgauthself->save();
		 
                      $addgroup = new match_member_id;
                      $addgroup->member_id = $per->id;
                      $addgroup->member_group_id = 13;
                      $addgroup->save();
                      $r = url()->previous();
           					 $r = explode('/', $r);
           					 $r = $r[4];

                     if($r == 'allinone'){
          						 $return = url()->previous();
          						 $return = explode('??', $return);
          						 $return = $return[1];
          						// return $return;
          					$url = '/Nonlife/create??/refm'.$per->id.'refm';
          					//return $url;
          					$returnao = url()->previous();
          					$returnao = explode('?', $returnao);
          					$returnao = $returnao[1];
						 	$retururl = url()->previous();
							$retururl = explode('/', $retururl);
          				//	return $returnao;
          					if($returnao == 'owner'){
          					if($retururl == 'refermem'){
								$getcurnum = url()->previous();
								$getcurnum = explode('refm', $getcurnum);
								$getcurnum = $getcurnum[1];
							}
								$getcurnum = 0;
          						$url = '/Nonlife/create??/refermem/refm'.$getcurnum.'refm/owner/aow'.$per->id.'aow';
          					}
          					//return $url;
          				 return redirect($url);
          				 }


         return redirect()->intended('/organizeuser');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      date_default_timezone_set('Asia/Bangkok');
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


                // if(in_array($id, $curmem)){
      $ref = DB::table('persons')
      ->where('persons.id',$id)->where('type','=','2')
      ->leftJoin('country','persons.add2_country','=','country.id')
      ->leftJoin('provinces','persons.add2_city','=','provinces.id')
      ->leftJoin('districts','persons.add2_district','=','districts.id')
      ->leftJoin('subdistricts','persons.add2_subdistrict','=','subdistricts.id')
      ->select('persons.*','persons.name as org_name','persons.id as org_id'
      ,'country.name as country_name','provinces.name_in_thai as province_name'
      ,'districts.name_in_thai as district_name','subdistricts.name_in_thai as subdistrict_name')
      ->get();
      $br = DB::table('branch')->where('org_id',$id)->get();

    //  return $br;
      return view('system-mgmt/organizeuser/show', compact(['ref','tree','br']));
   }
    //return view('error');
   // }

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

    // $member = Person::where('id',$id)->where('type','=','Organize')->get();
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


       // if(in_array($id, $curmem)){

        $structure = Person::where('type','=','2')->find($id);
        $curdob = Person::where('id',$id)->value('dob');
        if($curdob != NULL){

      $curdob = explode('-', $curdob);
      $curdate =$curdob[0];
      $curmonth =$curdob[1];
      $curyear =$curdob[2];
  }
  else {
    $curdate ="";
    $curmonth ="";
    $curyear ="";
  }
        // Redirect to department list if updating department wasn't existed
        $curbl = Person::where('id',$id)->value('belong_to');
      //  return $curbl;
        $ma=DB::table('match_id')->where('id',$curbl)->value('id');
        $provinces = DB::table('provinces')->get();
          $countrys = DB::table('country')->get();
            $districts = DB::table('districts')->get();
            $subdistricts = DB::table('subdistricts')->get();
          return view('system-mgmt/organizeuser/edit', ['districts' => $districts,'subdistricts' => $subdistricts,'provinces' => $provinces,'countrys' => $countrys,'ma' => $ma,'curdate' => $curdate,'curmonth' => $curmonth,'curyear' => $curyear,'structure' => $structure,'tree' =>$tree]);
         // }
         // return view('error');
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



      $sd = $request->sd;
      $sm = $request->sm;
      $sy = $request->sy;

      $date = $sd."-".$sm."-".$sy;
      $ma=DB::table('match_id')->where('id',$request->belong_to)->value('member_id');
      //return $ma;
      $per = Person::find($id);

      $per->name = $request -> name;
      $per->gender = $request-> gender;
      $per->id_num = $request-> id_num;
      $per->mobile = $request-> mobile;
      $per->dob = $date;
      $per->nationality = $request-> nationality;
      $per->couple_email = $request-> couple_email;
      $per->more = $request-> more;

      $per->add2 = $request-> add2;
      $per->add2_alley = $request-> add2_alley;
      $per->add2_road = $request-> add2_road;
      $per->add2_subdistrict = $request-> add2_subdistrict;
      $per->add2_district = $request-> add2_district;
      $per->add2_city = $request-> add2_city;
      $per->add2_country = $request-> add2_country;
      $per->add2_postcode = $request-> add2_postcode;

      $per->type = 2;
      $per->belong_to = $ma ;

      $per->email = $request-> email;
      $per->emergency_name =$request->emergency_name;
      $per->emergency_phone =$request->emergency_phone;
      $per->emergency_email =$request->emergency_email;
      $per->emergency_relation =$request->emergency_relation;
      $per->save();
              $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อยแล้ว ');
        return redirect('/organizeuser');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Person::where('id', $id)->delete();
         return redirect()->back();
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

      //sidebar

  $tree = session()->get('tree');
  //sidebar


        $structures = Person::where('type','=','2')->paginate(1000);
      //  return $structures;

      $constraints = [
          'name' => $request['name']
          ];
       $structures = $this->doSearchingQuery($constraints);
            //   return view('system-mgmt/organizeuser/index', ['structures' => $structures,'tree' =>$tree]);
       return view('system-mgmt/organizeuser/index', ['structures' => $structures, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query =DB::table('persons')
                ->where('type','=','2')
                ->select('persons.*');
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
        'name' => 'required|max:60',
        'password' => 'required|confirmed',
        'email' => 'required|email',
        'mobile' => 'required|numeric',
        'id_num' => 'required|numeric',

    ]);
    }
    public function findbranch($id){
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
                   $persons = DB::table('persons')
                   ->whereIn('persons.id',$curmem);
                   if(in_array($id,$curmem)){


            $listallbranch = DB::table('branch')->where('branch.org_id',$id)
            ->leftJoin('persons','branch.org_id','=','persons.id')
            ->leftJoin('country','branch.add_country','=','country.id')
            ->leftJoin('provinces','branch.add_city','=','provinces.id')
            ->leftJoin('districts','branch.add_district','=','districts.id')
            ->leftJoin('subdistricts','branch.add_subdistrict','=','subdistricts.id')
            ->select('branch.*','persons.name as org_name','persons.id as org_id'
            ,'country.name as country_name','provinces.name_in_thai as province_name'
            ,'districts.name_in_thai as district_name','subdistricts.name_in_thai as subdistrict_name')->paginate(30);
            $orgid = $_SERVER['REQUEST_URI'];
            $orgid = explode('/', $orgid);
            $orgid = $orgid[3];
          //  return $orgid;
            return view('system-mgmt/organizeuser/branch',compact('orgid','listallbranch','tree'));
             }
             return view('error');

    }
}
