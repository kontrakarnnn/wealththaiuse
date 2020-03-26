<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
use App\Person;
use App\Structure;
use App\Block;
use App\Portfolio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\match_id;
use	App\Member_type;
use App\Http\Controllers\SidebarController;
class PerAdminController extends Controller
{

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

      $count = Person::count();

    $persons = Person::leftJoin('member_type', 'persons.type', '=', 'member_type.id')
		->select('persons.*', 'member_type.name as memtype_name', 'member_type.id as memtype_id')
	->orderBy('created_at', 'desc')

    ->paginate(30);

      $data = array(
        'persons' => $persons,
		  'tree' => $tree
      );

      return view('peradmin.index',$data)->with('count', $count);
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



        return view('peradmin.form',['tree'=>$tree]);
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
          'name' => 'required|string|max:255',
			'email' => 'required|email|max:255|unique:persons',


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
        $per->password = Hash::make($request->password);
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
				$per->ref_member_pid =$request->ref_member_pid;
			$per->type = 0;
		$per->status = "Request Reset Password" ;

		$currentdate = date('d/m/Y');
		$currenttime = date('H:i:s');
		$per->regis_date =$currentdate;
		$per->regis_time =$currenttime;
		$per->lead_status =0;

        $per->save();
						$match_id = new match_id;
										$match_id->public_name = $per->name;
										$match_id->public_email = $per->email;
										$match_id->public_mobile = $per->mobile;
										$match_id->sender_citizen = $per->id_num;
										$match_id->member_id = $per->id;
										$match_id->save();
				  $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อย');
        return redirect('/admin/peradmin');

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


    //  $per = Person::with('users')->find($id);
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
			 //return $ref;


      $data = array(
				'ref' => $ref,
      //  'per' => $per,
		  'tree' => $tree
      );
			$currentid = Auth::user()->id;
			$memid = $_SERVER['REQUEST_URI'];
			$memid = explode('/', $memid);
			$memid = $memid[3];
			$filerefname = 'Member_Attachment_'.$memid;

			//return $memid;
			$findfileid = DB::table('member_attachment')->where('member_id',$id)->pluck('file_id');
			$fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','Active')->get();
      return view('peradmin/show',['ref'=>$ref,'filerefname'=>$filerefname,'fileasset'=>$fileasset,'memid'=>$memid]);

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


          $per = Person::find($id);
        if($id !== '') {
           $per = Person::find($id);
            $data = array(
                'per' =>$per
            );



        }
        $structures = Structure::all();
        $blocks = Block::all();
		$memtypes = Member_type::all();
        $portfolios = Portfolio::all();
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
			$provinces = DB::table('provinces')->get();
				$countrys = DB::table('country')->get();
					$subdistricts = DB::table('subdistricts')->get();
					$districts = DB::table('districts')->get();
        return view('peradmin/edit', ['memtypes' =>$memtypes,'curcitiexdate' =>$curcitiexdate,'curcitiexmonth' =>$curcitiexmonth,
	                                        'curcitiexyear' =>$curcitiexyear,'curcitidate' =>$curcitidate,'curcitimonth' =>$curcitimonth,
	                                        'curcitiyear' =>$curcitiyear,'curdate' =>$curdate,'curmonth' =>$curmonth,
	                                        'curyear' =>$curyear,'per' => $per,'structures' => $structures, 'blocks' => $blocks,'portfolios' => $portfolios,'tree'=>$tree
																				,'provinces' => $provinces,'countrys' => $countrys,'subdistricts' => $subdistricts,'districts' => $districts]);
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
			$per->event_id = $request-> event_id;
			 $per->ref_user_pid = $request-> ref_user_pid;
				$per->ref_member_pid = $request-> ref_member_pid;
		$per->type = $request-> type;
		$per->status = $request-> status;
      $per->save();

          $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อย');
      return redirect('/admin/peradmin');


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
        return redirect('/admin/peradmin');
    }
    public function findDivName(Request $request){
      $data=Division::select('name','id')->where('department_id',$request->id)->take(100)->get();
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

       return view('peradmin/index', ['persons' => $persons, 'searchingVals' => $constraints,'tree'=>$tree]);
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
      $data=Portfolio::select('port_id','id')->where('division_id',$request->id)->take(100)->get();
      return response()->json($data);
    }

		public function repassword($id)
    {
			//sidebar

	$tree = session()->get('tree');
	//sidebar

        $user = Person::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($user == null)  {
          $user = Person::find($id);
          $data = array(
              'user' => $user
          );
            return redirect()->intended('/admin/peradmin');
        }

        return view('peradmin/repassword', ['user' => $user,'tree'=>$tree]);
    }

		public function uppass(Request $request, $id)
    {
        $user = Person::findOrFail($id);

        $input = [
        //  $user->password = Hash::make($request->password);

            'password' => Hash::make($request['password']),

        ];
        if ($request['password'] != null && strlen($request['password']) > 0) {
            $constraints['password'] = 'required|min:6|confirmed';
            $input['password'] =  bcrypt($request['password']);
        }
        $this->validate($request, $constraints);
        Person::where('id', $id)
            ->update($input);
$request->session()->flash('alert-success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว!! ');
        return redirect()->intended('/admin/peradmin');
    }
}
