<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Response;
use Session;
use App\Person;
use App\Structure;
use App\Block;
use App\Portfolio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\View;
use App\Province;
use	App\Member_type;
use App\match_id;
use App\User;
use App\MemberTool;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\PortfolioController;
class PerController extends Controller
{


	    public function __construct()
    {
        $this->middleware('view');
				$this->portfoliocontroller = new PortfolioController;
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

      $count = Person::count();

    $persons = DB::table('persons')
->leftJoin('member_type', 'persons.type', '=', 'member_type.id')
	->select('persons.*', 'member_type.name as memtype_name', 'member_type.id as memtype_id')
    ->paginate(30);
	$url = $_SERVER['REQUEST_URI'];

	if ( strstr($url, '?') ) {
		$memid = explode('?',$url);
		$memid = $memid[1];
		    $persons = DB::table('persons')
	->where('persons.id',$memid)
	->leftJoin('member_type', 'persons.type', '=', 'member_type.id')
	->select('persons.*', 'member_type.name as memtype_name', 'member_type.id as memtype_id')
    ->paginate(30);
	}

      $data = array(
        'persons' => $persons,
		  'tree' => $tree
      );

      return view('per.index',$data)->with('count', $count);
    }

		public function membertool($id)
    {
      $count = Person::count();
    	$persons =MemberTool::with(['Tool','Member_Tool_Status','Person'])->where('member_id',$id)->get();
      $data = array(
        'persons' => $persons
      );

      return view('per.tool',$data);
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
       $province = Province::all();
			 $currentyear = date('Y') + 543;
			 $convert = 0;
        return view('per.quickregis',['convert'=>$convert,'currentyear'=>$currentyear,'province'=>$province,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
		 public function store(Request $request)
		 {

			 date_default_timezone_set('Asia/Bangkok');
				 $this->validate($request, [
					 'name' => 'required|string|max:255',
					'email' => 'required|email|max:255|unique:persons',
					      'mobile' => 'required|string|max:13',


				 ]);

				 $sd = $request->sd;
				 $sm = $request->sm;
				 $sy = $request->sy;

				 $date = $sd."-".$sm."-".$sy;

				 $citiisd = $request->citiisd;
				 $citiism = $request->citiism;
				 $citiisy = $request->citiisy;

				 $citizenissue = $citiisd."-".$citiism."-".$citiisy;

				 $citiexd = $request->citiexd;
				 $citiexm = $request->citiexm;
				 $citiexy = $request->citiexy;

				 $citizenexpire = $citiexd."-".$citiexm."-".$citiexy;

				 $per = new Person;
				 $per->name = $request -> name;
				 $per->Eng_name = $request -> Eng_name;
				 $per->lname = $request -> lname;
				 $per->nickname = $request -> nickname;
				 $per->Eng_lastname = $request -> Eng_lastname;
				 $per->email = $request-> email;
				 $per->password = Hash::make($request->id_num);
				 $per->phone = $request-> phone;
				 $per->dob =$date;

				 $per->id_num = $request-> id_num;

				 $per->university = $request-> university;
				 $per->faculty = $request-> faculty;
				 $per->major = $request-> major;
				 $per->gpa = $request-> gpa;
				 $per->job = $request-> job;

				 $per->skill = $request-> skill;
				 $per->interest = $request-> interest;
				 $per->another = $request-> another;
				 $per->status = $request-> status;

				 $per->gender = $request-> gender;
				 $per->nationality = $request-> nationality;
				 $per->religion = $request-> religion;
				 $per->couple = $request-> couple;
				 $per->income = $request-> income;
				 $per->inctype = $request-> inctype;
				 $per->incbonus = $request-> incbonus;
				 $per->bankaccount = $request-> bankaccount;
				 $per->bank = $request-> bank;
				 $per->activestatus = $request-> activestatus;
				 $per->add1 = $request-> add1;
				 $per->add1_alley = $request-> add1_alley;
				 $per->add1_road = $request-> add1_road;
				 $per->add1_subdistrict = $request-> add1_subdistrict;
				 $per->add1_district = $request-> add1_district;
				 $per->add1_city = $request-> add1_city;
				 $per->add1_postcode = $request-> add1_postcode;
				 $per->add1_tel = $request-> add1_tel;
				 $per->add1_fax = $request-> add1_fax;
				 $per->add2_tel = $request-> add2_tel;
				 $per->add2_fax = $request-> add2_fax;
				 $per->add2 = $request-> add2;
				 $per->add2_alley = $request-> add2_alley;
				 $per->add2_road = $request->add2_road;
				 $per->add2_subdistrict = $request-> add2_subdistrict;
				 $per->add2_district = $request-> add2_district;
				 $per->add2_city = $request-> add2_city;
				 $per->add2_postcode = $request-> add2_postcode;
				 $per->add2_sentdoc = $request-> add2_sentdoc;

				 $per->add3 = $request-> add3;
				 $per->company = $request-> company;
				 $per->position = $request-> position;
				 $per->com_add_no = $request-> com_add_no;
				 $per->com_add_alley = $request-> com_add_alley;
				 $per->com_add_road = $request-> com_add_road;
				 $per->com_add_subdistrict = $request-> com_add_subdistrict;
				 $per->com_add_district = $request-> com_add_district;
				 $per->com_add_city = $request-> com_add_city;
				 $per->com_add_postcode = $request-> com_add_postcode;
				 $per->com_tel = $request-> com_tel;
				 $per->com_fax = $request-> com_fax;
				 $per->couple_name = $request-> couple_name;
				 $per->couple_lname = $request-> couple_lname;
				 $per->couple_job = $request-> couple_job;
				 $per->couple_phone = $request-> couple_phone;
				 $per->couple_workplace = $request-> couple_workplace;


				 $per->mobile = $request-> mobile;
				 $per->citizen_issued_date = $citizenissue;
				 $per->citizen_expire_date = $citizenexpire;


				 $per->race = $request-> race;
				 $per->branch = $request-> branch;
				 $per->bank_account_name	 = $request-> bank_account_name;

				 $per->add1_country = $request-> add1_country;

				 $per->add2_country = $request-> add2_country;
				 $per->type_business = $request-> type_business;
				 $per->occupation = $request-> occupation;
				 $per->work_experience = $request-> work_experience;
				 $per->com_add_country = $request-> com_add_country;
				 $per->couple_position = $request-> couple_position;

				 $per->couple_mobile = $request-> couple_mobile;
				 $per->event_id =$request->event_id;
				 $per->ref_user_pid =$request->ref_user_pid;
			 	$per->type = 0;
			 $per->status = "Request Reset Password" ;
				 $per->ref_member_pid =$request->ref_member_pid;
				 $currentdate = date('d/m/Y');
				 $currenttime = date('H:i:s');
				 $per->regis_date =$currentdate;
				 $per->regis_time =$currenttime;
				 if($request->refered == '1' ){
					 $current  = Auth::user()->id;
					 $currentpid = DB::table('match_id')->where('user_id',$current)->value('id');
					 $per->ref_user_pid = $currentpid;
				 }



				 $per->save();

			 				 $match_id = new match_id;
 										$match_id->public_name = $per->name;
 										$match_id->public_email = $per->email;
 										$match_id->public_mobile = $per->mobile;
 										$match_id->sender_citizen = $per->id_num;
 										$match_id->member_id = $per->id;
 										$match_id->save();
					 $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อย');
					 $r = url()->previous();
					 $r = explode('/', $r);
					 $r = $r[4];

					 if($r == 'allinone'){
						 $return = url()->previous();
						 $return = explode('??', $return);
						 $return = $return[1];
						// return $return;
					$url = '/Nonlife/create??/refermem/refm'.$per->id.'refm';
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
				//	return $url;
				 return redirect($url);
				 }
				 $leadurl = url()->previous();
				 $leadurl = explode('/',$leadurl);
				 if(in_array('convert',$leadurl)){
				 $value = url()->previous();
				// $value = explode('/',$value);
				 $re_contact_date = explode('=recondate=',$value);
				 $re_contact_date = date('d/m/Y', strtotime($re_contact_date[1]));
				 $last_contact_date = explode('=lastcondate=',$value);
	       $last_contact_date = date('d/m/Y', strtotime($last_contact_date[1]));
	       $re_contact_time = explode('=recontime=',$value);
	       $re_contact_time = $re_contact_time[1];
	       $meeting_date = explode('=meetdate=',$value);
	       $meeting_date = date('d/m/Y', strtotime($meeting_date[1]));
				 $meeting_time = explode('=meettime=',$value);
				 $meeting_time = $meeting_time[1];
	       $meeting_location = explode('=meetlocation=',$value);
	       $meeting_location = $meeting_location[1];
				 $note = explode('=leadnote=',$value);
	       $note = $note[1];

				 $convert = Person::find($per->id);
				  //return $re_contact_date;
				 $convert->last_contact_date = $last_contact_date;
				 $convert->re_contact_date =$re_contact_date ;
				 $convert->re_contact_time =$re_contact_time ;
				 $convert->meeting_date =$meeting_date ;
				 $convert->meeting_time = $meeting_time;
				 $convert->meeting_location =$meeting_location ;
				 $convert->lead_note =$note ;
				 $currentdate = date('d/m/Y');
				 $currenttime = date('H:i:s');
				 $convert->regis_date =$currentdate;
				 $convert->regis_time =$currenttime;
				 $convert->lead_status = 3;
				 $convert->type = 0;

				 $convert->save();
			 }
				 if(in_array('lead',$leadurl) || in_array('convert',$leadurl)){
					 return redirect('/lead');
				 }


				 return redirect('/SecurityBroke/per');
		 }

	public function membernote($id)
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


           $per = Person::find($id);

 						if(in_array($id, $curmem)){
 							$per = Person::find($id);
 							$data = array(
 								'per' => $per
 							);

 							$structures = Structure::all();
 			        $blocks = Block::all();
 			        $portfolios = Portfolio::all();

 			        return view('per/notebook', ['tree'=>$tree,'per' => $per,'structures' => $structures, 'blocks' => $blocks,'portfolios' => $portfolios]);

         }
         	return view('error');
     }

	public function noteup(Request $request)
		{

				$per = ['note'=>$request->note];
				DB::table('persons')->where('id',$request->id)->update($per);
				$request->session()->flash('alert-success', 'บันทึกแล้ว');
				return redirect()->back();
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





			if(in_array($id, $curmem)){
				$ref = DB::table('persons')
				->where('persons.id' ,'=',$id)

				->leftJoin('event', 'persons.event_id', '=', 'event.id')
	//->leftJoin('match_id as re ', 'persons.ref_member_pid', '=', 're.id')
			 ->leftJoin('match_id as u', 'persons.ref_user_pid', '=', 'u.id')
				->leftJoin('match_id as i', 'persons.ref_member_pid', '=', 'i.id')
				->leftJoin('provinces as p1', 'persons.add1_city', '=', 'p1.id')
	      ->leftJoin('provinces as p2', 'persons.add2_city', '=', 'p2.id')
	      ->leftJoin('districts as d1','persons.add1_district','=','d1.id')
	      ->leftJoin('districts as d2','persons.add2_district','=','d2.id')
	      ->leftJoin('subdistricts as s1','persons.add1_subdistrict','=','s1.id')
	      ->leftJoin('subdistricts as s2','persons.add2_subdistrict','=','s2.id')
	      ->leftJoin('country as c1','persons.add1_country','=','c1.id')
	      ->leftJoin('country as c2','persons.add2_country','=','c2.id')
			 ->select('persons.*', 'u.public_name as user_name', 'u.id as user_id', 'i.public_name as mem_name', 'i.id as mem_id', 'event.event_name as event_name', 'event.id as event_id'
			 ,'c1.name as add1_country','c2.name as add2_country','p1.name_in_thai as add1_city','p2.name_in_thai as add2_city'
	     ,'d1.name_in_thai as add1_district','d2.name_in_thai as add2_district','s1.name_in_thai as add1_subdistrict','s2.name_in_thai as add2_subdistrict')
				 ->get();
				$data = array(
					'ref' => $ref
				);
				$currentid = Auth::user()->id;
				$memid = $_SERVER['REQUEST_URI'];
				$memid = explode('/', $memid);
				$memid = $memid[3];
				$filerefname = 'Member_Attachment_'.$memid;

				//return $memid;
				$findfileid = DB::table('member_attachment')->where('member_id',$id)->pluck('file_id');
				$fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','Active')->get();
      return view('per/show',['ref'=>$ref,'tree'=>$tree,'filerefname'=>$filerefname,'fileasset'=>$fileasset,'memid'=>$memid]);

    }
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

									 $curmem = $curmem->toArray();


          $per = Person::find($id);

						if(in_array($id, $curmem)){

							$per = Person::find($id);
							$current = Auth::user()->id;
				   //a   $per = Person::where('id',$id);
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


				      $curcitizenis = Person::where('id',$id)->value('citizen_issued_date');

				      if($curcitizenis != NULL){
				      $curcitizenis = explode('-', $curcitizenis);
				      $curcitidate =$curcitizenis[0];
				      $curcitimonth =$curcitizenis[1];
				      $curcitiyear =$curcitizenis[2];
				    }
				  else {
				    $curcitidate ="";
				      $curcitimonth ="";
				      $curcitiyear ="";
				  }

				      $curcitizenex = Person::where('id',$id)->value('citizen_expire_date');
				      if($curcitizenex != NULL){
				      $curcitizenex = explode('-', $curcitizenex);
				      $curcitiexdate =$curcitizenex[0];
				      $curcitiexmonth =$curcitizenex[1];
				      $curcitiexyear =$curcitizenex[2];
				    }
				    else {
				      $curcitiexdate ="";
				      $curcitiexmonth ="";
				      $curcitiexyear ="";
				    }
							$data = array(
								'curcitiexdate' =>$curcitiexdate,'curcitiexmonth' =>$curcitiexmonth,
					      'curcitiexyear' =>$curcitiexyear,'curcitidate' =>$curcitidate,'curcitimonth' =>$curcitimonth,
					     'curcitiyear' =>$curcitiyear,'curdate' =>$curdate,'curmonth' =>$curmonth,
					     'curyear' =>$curyear,
								'per' => $per
							);

							$structures = Structure::all();
			        $blocks = Block::all();
			        $portfolios = Portfolio::all();

							$provinces = DB::table('provinces')->get();
								$countrys = DB::table('country')->get();
									$subdistricts = DB::table('subdistricts')->get();
									$districts = DB::table('districts')->get();
			        return view('per/edit', ['curcitiexdate' =>$curcitiexdate,'curcitiexmonth' =>$curcitiexmonth,
				                                        'curcitiexyear' =>$curcitiexyear,'curcitidate' =>$curcitidate,'curcitimonth' =>$curcitimonth,
				                                        'curcitiyear' =>$curcitiyear,'curdate' =>$curdate,'curmonth' =>$curmonth,
				                                        'curyear' =>$curyear,'per' => $per,'structures' => $structures, 'blocks' => $blocks,'portfolios' => $portfolios,'tree'=>$tree,
																							'provinces' => $provinces,'countrys' => $countrys,'subdistricts' => $subdistricts,'districts' => $districts,]);

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
			 date_default_timezone_set('Asia/Bangkok');
       $this->validate($request, [
         'name' => 'required|string|max:255',

       ]);
 			$sd = $request->sd;
 			$sm = $request->sm;
 			$sy = $request->sy;

 			$date = $sd."-".$sm."-".$sy;

 			$citiisd = $request->citiisd;
 			$citiism = $request->citiism;
 			$citiisy = $request->citiisy;

 			$citizenissue = $citiisd."-".$citiism."-".$citiisy;

 			$citiexd = $request->citiexd;
 			$citiexm = $request->citiexm;
 			$citiexy = $request->citiexy;

 			$citizenexpire = $citiexd."-".$citiexm."-".$citiexy;
       $per = Person::find($id);

       $per->name = $request -> name;
       $per->Eng_name = $request -> Eng_name;
       $per->lname = $request -> lname;
       $per->nickname = $request -> nickname;
       $per->Eng_lastname = $request -> Eng_lastname;
       $per->email = $request-> email;

       $per->phone = $request-> phone;
       $per->dob = $date;

       $per->id_num = $request-> id_num;

       $per->university = $request-> university;
       $per->faculty = $request-> faculty;
       $per->major = $request-> major;
       $per->gpa = $request-> gpa;
       $per->job = $request-> job;

       $per->skill = $request-> skill;
       $per->interest = $request-> interest;
       $per->another = $request-> another;
       $per->status = $request-> status;

       $per->gender = $request-> gender;
       $per->nationality = $request-> nationality;
       $per->religion = $request-> religion;
       $per->couple = $request-> couple;
       $per->income = $request-> income;
       $per->inctype = $request-> inctype;
       $per->incbonus = $request-> incbonus;
       $per->bankaccount = $request-> bankaccount;
       $per->bank = $request-> bank;
       $per->activestatus = $request-> activestatus;
       $per->add1 = $request-> add1;
       $per->add1_alley = $request-> add1_alley;
       $per->add1_road = $request-> add1_road;
       $per->add1_subdistrict = $request-> add1_subdistrict;
       $per->add1_district = $request-> add1_district;
       $per->add1_city = $request-> add1_city;
       $per->add1_postcode = $request-> add1_postcode;
       $per->add1_tel = $request-> add1_tel;
       $per->add1_fax = $request-> add1_fax;
       $per->add2_tel = $request-> add2_tel;
       $per->add2_fax = $request-> add2_fax;
       $per->add2 = $request-> add2;
       $per->add2_alley = $request-> add2_alley;
       $per->add2_road = $request->add2_road;
       $per->add2_subdistrict = $request-> add2_subdistrict;
       $per->add2_district = $request-> add2_district;
       $per->add2_city = $request-> add2_city;
       $per->add2_postcode = $request-> add2_postcode;
       $per->add2_sentdoc = $request-> add2_sentdoc;

       $per->add3 = $request-> add3;
       $per->company = $request-> company;
       $per->position = $request-> position;
       $per->com_add_no = $request-> com_add_no;
       $per->com_add_alley = $request-> com_add_alley;
       $per->com_add_road = $request-> com_add_road;
       $per->com_add_subdistrict = $request-> com_add_subdistrict;
       $per->com_add_district = $request-> com_add_district;
       $per->com_add_city = $request-> com_add_city;
       $per->com_add_postcode = $request-> com_add_postcode;
       $per->com_tel = $request-> com_tel;
       $per->com_fax = $request-> com_fax;
       $per->couple_name = $request-> couple_name;
       $per->couple_lname = $request-> couple_lname;
       $per->couple_job = $request-> couple_job;
       $per->couple_phone = $request-> couple_phone;
       $per->couple_workplace = $request-> couple_workplace;


       $per->mobile = $request-> mobile;
 			$per->citizen_issued_date = $citizenissue;
 			$per->citizen_expire_date = $citizenexpire;


       $per->race = $request-> race;
       $per->branch = $request-> branch;
       $per->bank_account_name	 = $request-> bank_account_name;

       $per->add1_country = $request-> add1_country;

       $per->add2_country = $request-> add2_country;
       $per->type_business = $request-> type_business;
       $per->occupation = $request-> occupation;
       $per->work_experience = $request-> work_experience;
       $per->com_add_country = $request-> com_add_country;
       $per->couple_position = $request-> couple_position;

       $per->couple_mobile = $request-> couple_mobile;
		$per->status = $request-> status;
			 // $per->event_id = $request-> event_id;
			//	 $per->ref_user_pid = $request-> ref_user_pid;
				//  $per->ref_member_pid = $request-> ref_member_pid;
       $per->save();

        $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อย');
       return redirect('/SecurityBroke/per');


     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $per = Person::find($id);
        $per->delete();
        Session::flash('message','Delete Success!!');
        return redirect('per');
    }
    public function findDivName(Request $request){
      $data=Division::select('name','id')->where('department_id',$request->id)  ->get();
      return response()->json($data);
    }

    public function search(Request $request) {
			//sidebar

	    $tree = session()->get('tree');
	    //sidebar

        $constraints = [
					'member_type.name' => $request['memtype_name'],
            'persons.name' => $request['name'],
            'persons.lname' => $request['lname'],
			    'persons.email' => $request['email'],
            'persons.id_num' => $request['id_num'],
            'persons.mobile' => $request['mobile'],
			'persons.nickname' => $request['nickname']
            ];

       $persons = $this->doSearchingQuery($constraints);
			 $constraints['memtype_name'] = $request['memtype_name'];
			 $constraints['name'] = $request['name'];
			 $constraints['lname'] = $request['lname'];
			 $constraints['email'] = $request['email'];
			 $constraints['id_num'] = $request['id_num'];
			 $constraints['mobile'] = $request['mobile'];
			 $constraints['nickname'] = $request['nickname'];

       return view('per/index', ['persons' => $persons, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('persons')
->leftJoin('member_type', 'persons.type', '=', 'member_type.id')
	->select('persons.*', 'member_type.name as memtype_name', 'member_type.id as memtype_id');
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

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
    public function findPortName(Request $request){
      $data=Portfolio::select('port_id','id')->where('division_id',$request->id)  ->get();
      return response()->json($data);
    }

		public function mymember(){
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
									 ->whereIn('persons.id',$curmem)
							 	 ->leftJoin('member_type', 'persons.type', '=', 'member_type.id')
								->select('persons.*', 'member_type.name as memtype_name', 'member_type.id as memtype_id')
								->orderBy('created_at', 'desc')

									 ->paginate(30);
									// return $mymember;
									 return view('per/mymember', ['persons' => $persons,'tree'=>$tree]);
		}
		public function savedataexcel($request)
		{
			$refuserid = User::where('user_code',$request->user_code)->value('id');
			$refuserpid = match_id::where('user_id',$refuserid)->value('id');
			$per = New Person;
			$per->gender = $request->gender;
			$per->name = $request->name;
			$per->lname = $request->lname;
			$per->eng_name = $request->eng_name;
			$per->eng_lastname = $request->eng_lastname;
			$per->nickname = $request->nickname;
			$per->note = $request->note;
			$per->email = $request->email;
			$per->phone = $request->phone;
			$per->mobile = $request->mobile;
			$per->add1 = $request->add1;
			$per->add1_alley = $request->add1_alley;
			$per->add1_road = $request->add1_road;
			$per->add1_subdistrict = $request->add1_subdistrict;
			$per->add1_district = $request->add1_district;
			$per->add1_city = $request->add1_city;
			$per->add1_country = $request->add1_country;
			$per->add1_postcode = $request->add1_postcode;
			$per->add1_tel = $request->add1_tel;
			$per->add1_fax = $request->add1_fax;
			$per->add2 = $request->add2;
			$per->add2_alley = $request->add2_alley;
			$per->add2_road = $request->add2_road;
			$per->add2_subdistrict = $request->add2_subdistrict;
			$per->add2_district = $request->add2_district;
			$per->add2_city = $request->add2_city;
			$per->add2_country = $request->add2_country;
			$per->add2_postcode = $request->add2_postcode;
			$per->add2_tel = $request->add2_tel;
			$per->add2_fax = $request->add2_fax;
			$per->dob = $request->dob;
			$per->id_num = $request->id_num;
			$per->citizen_issued_date = $request->citizen_issued_date;
			$per->citizen_expire_date = $request->citizen_expire_date;
			$per->nationality = $request->nationality;
			$per->race = $request->race;
			$per->religion = $request->religion;
			$per->couple = $request->couple;
			$per->customer_code = $request->customer_code;
			$per->user_code = $request->user_code;
			$per->ref_user_pid = $refuserpid;
			$per->save();
			$this->portfoliocontroller->savedataexcel($per);

			$match_id = new match_id;
					 $match_id->public_name = $per->name;
					 $match_id->public_email = $per->email;
					 $match_id->public_mobile = $per->mobile;
					 $match_id->sender_citizen = $per->id_num;
					 $match_id->member_id = $per->id;
					 $match_id->save();


		}


}
