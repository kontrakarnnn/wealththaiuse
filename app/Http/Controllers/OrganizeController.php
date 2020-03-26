<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Organize;
use App\Organize_auth;
use App\Port_Org_auth;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Viewper;
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

class OrganizeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:person');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		//sidebar
    $current = Auth::guard('person')->user()->id;
        //  return $current;
        $alertinvite = DB::table('organize_auths')->where('member_id',$current)->where('status','Request')->count();

        $orgauth = DB::table('organize_auths')->where('member_id',$current)->where('status','Accept')->pluck('organize_id')->toArray();
        $structures = Person::whereIn('id' ,$orgauth)->paginate(100);
        //return $structures;

        return view('system-mgmt/organize/index', ['alertinvite' => $alertinvite,'structures' => $structures]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


      $current = Auth::guard('person')->user()->id;

      $currentid = DB::table('persons')

              ->where(//[ 'structure_id', '=',9 ],
                        'id', '=',$current

                     )
                     ->get();

                     $provinces = DB::table('provinces')->get();
                       $countrys = DB::table('country')->get();
        return view('system-mgmt/organize/create',['countrys' =>$countrys,'provinces' =>$provinces,'currentid' =>$currentid]);
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
      $current = Auth::guard('person')->user()->id;
      $sd = $request->sd;
      $sm = $request->sm;
      $sy = $request->sy;

      $date = $sd."-".$sm."-".$sy;

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
      $per->belong_to = $current ;

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
         Mail::send('emails.welcome',$input,function($message) use ($input){

           $message->to($input['email']);
           $message->subject('ยืนยันการสมัครเข้าใช้งาน Website Wealth Thai ');
         });
         $per->save();


         $match_id = new match_id;
                     $match_id->public_name = $per->name;
                     $match_id->public_email = $per->email;
                     $match_id->public_mobile = $per->mobile;
                     $match_id->sender_citizen = $per->id_num;
                     $match_id->member_id = $per->id;
                     $match_id->save();

          $orgauth = new Organize_auth;
                     $orgauth->member_id = $current;
                     $orgauth->organize_id = $per->id;
                     $orgauth->status = 'Accept';
                     $orgauth->save();
		
		          $orgauthself = new Organize_auth;
                     $orgauthself->member_id = $per->id;
                     $orgauthself->organize_id = $per->id;
                     $orgauthself->status = 'Accept';
                     $orgauthself->save();

	                      $addgroup = new match_member_id;
                      $addgroup->member_id = $per->id;
                      $addgroup->member_group_id = 13;
                      $addgroup->save();
        return redirect()->intended('/organize');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


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
      return view('system-mgmt/organize/show', compact(['ref']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $current = Auth::guard('person')->user()->id;
    //  $current2 = Session::all();
    //  return $current2;


              $currentmatchids = DB::table('match_id')

                      ->where([
                                [ 'member_id', '=', $current]

                             ])
                             ->pluck('id');
                  $currentmatchids = $currentmatchids->toArray();
                  $currentpidgroups = DB::table('match_pid_groups')

                          ->where([
                                    [ 'p_id', '=', $currentmatchids]

                                 ])
                                 ->pluck('pid_group_id');

                   $currentusergroups = DB::table('match_member_groups')

                         ->where([
                             [ 'member_id', '=', $current]

                              ])
                              ->pluck('member_group_id');
                      $currentorg = DB::table('persons')->where('id',$current)->where('type',2)->pluck('id');
                      $currentfamily = DB::table('family_auths')

                              ->where([
                                        [ 'member_id', '=', $current],

                                     ])
                                     ->where('status','=','Accept')
                                     ->pluck('family_id');




                                               //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
                                      $currents = DB::table('persons')->where('id',$current)->pluck('id');

                                      $matchviews = DB::table('match_views_mem as m')
                                      ->leftJoin('views_mem', 'm.view_id', '=', 'views_mem.id')







                                    ->orwhereIn(
                                      'pid_groups.id',$currentpidgroups
                                    )
                                    ->orwhereIn(
                                      'member_groups.id',$currentusergroups
                                    )
                                    ->orwhereIn(
                                      'm.org_id',$currentorg
                                    )
                                    ->orwhereIn(
                                      'm.member_id',$currents
                                    )
                                    ->orwhereIn(
                                      'm.group_id',$currentfamily
                                    )
                                    ->orwhere(
                                      'm.all_member','=','Yes'
                                    )


                                    ->leftJoin('member_groups', 'm.member_group_id', '=', 'member_groups.id')

                                   ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

                                   ->select('m.*','m.id', 'views_mem.name as view_name', 'views_mem.id as view_id',
                                    'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','member_groups.name as member_group_name', 'member_groups.id as member_group_id')
                                     ->pluck('view_id');


             $views = Viewper::whereIn('id',$matchviews )
                            ->where('belong_to','=',NULL )->get();
                            $viewss = Viewper::whereIn('id',$matchviews )
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
     $member = Person::where('id',$current)->get();
     $structures = Organize::where('member_id' ,'=', $current)->pluck('id');
     $structures = $structures->toArray();
      $currentid = DB::table('persons')

              ->where(//[ 'structure_id', '=',9 ],
                        'id', '=',$current

                     )
                     ->get();


        $structure = Organize::find($id);
        // Redirect to department list if updating department wasn't existed
        if(in_array($id,$structures)) {
          $structure = Organize::find($id);
          $data = array(
              'structure' => $structure
            );
          return view('system-mgmt/organize/edit', ['member'=>$member,'structure' => $structure,'currentid'=> $currentid,'tree' =>$tree]);
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
        $structure = Organize::findOrFail($id);



            $current = Auth::guard('person')->user()->id;
            $pers = Person::where('id',$current)->get();
            foreach($pers as $per){
            $per->name = $request -> name;
            $per->email = $request-> email;
            $per->id_num = $request-> id_num;
            $per->mobile = $request-> mobile;
			$per->type = 2;
           $per->save();



               $match_ids = match_id::where('member_id',$current);
               foreach($match_ids as $match_id){
                           $match_id->public_name = $pers->name;
                           $match_id->public_email = $per->email;
                           $match_id->public_mobile = $per->mobile;
                           $match_id->sender_citizen = $per->id_num;

                           $match_id->save();
                         }
            $organizes = Organize::where('member_id',$current);
            foreach($organizes as $organize){
                        $organize->name = $request -> name;
                      //  $organize->member_id = $per->id;


                      $organize->save();
}
            $match_id_members = match_member_id::where('member_id',$current);
            foreach($match_id_members as $match_id_member){
                      ///  $match_id_member->member_id = $per->id;
                        $match_id_member->member_group_id = 1;
                        $match_id_member->save();
}
}
                        //return $per ;
        return redirect()->intended('/organize');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        Organize::where('id', $id)->delete();
         return redirect()->intended('/organize');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

      $current = Auth::guard('person')->user()->id;
    //  $current2 = Session::all();
    //  return $current2;

	    $current = Auth::guard('person')->user()->id;
        //  return $current;
        $alertinvite = DB::table('organize_auths')->where('member_id',$current)->where('status','Request')->count();
              
        $constraints = [
            'name' => $request['name']
            ];

       $structures = $this->doSearchingQuery($constraints);
       return view('system-mgmt/organize/index', ['alertinvite' => $alertinvite,'structures' => $structures, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
		 $current = Auth::guard('person')->user()->id;
       	 $orgauth = DB::table('organize_auths')->where('member_id',$current)->where('status','Accept')->pluck('organize_id')->toArray();
		
        $query = Person::whereIn('id' ,$orgauth);
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(100);
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


    public function portorg($id)
    {
          $current = Auth::guard('person')->user()->id;


      $groupid = $id;
      $portingroup = DB::table('port_org_auths')->where('org_id',$id)
      ->leftJoin('persons','port_org_auths.created_by','persons.id')
      ->leftJoin('portfolio','port_org_auths.port_id','=','portfolio.id')
	  ->leftJoin('port_types','portfolio.port_id','=','port_types.id')
      ->leftJoin('structure','portfolio.structure_id','=','structure.id')
      ->leftJoin('block','portfolio.block_id','=','block.id')
      ->select('port_org_auths.*','port_types.type as port_type_name','portfolio.id as port_id','portfolio.number as number','portfolio.type as port_name','persons.name as creator','persons.lname as        creatorl','structure.name as structure_name',
      'block.name as block_name','block.contact_name as contact_name','block.contact_tel as contact_tel','block.contact_email as contact_email')
      ->get();
    /*  $portingroup = DB::table('portfolio')->whereIn('portfolio.id',$portauth)
      ->leftJoin('persons','portfolio.member_id','=','persons.id')
      ->leftJoin('structure','portfolio.structure_id','structure.id')
      ->leftJoin('block','portfolio.block_id','block.id')
      ->select('portfolio.*','structure.name as structure_name','block.name as block_name',
      'block.contact_name as contact_name','block.contact_tel as contact_tel','block.contact_email as contact_email')
      ->get();*/
      $structures = DB::table('organize_auths')->where('organize_id',$id)->pluck('member_id')->toArray();
      $member = DB::table('persons')->whereIn('id',$structures)->get();
      return view('system-mgmt/organize/port', compact(['portingroup','member']));
    }

    public function memberorg($id)
    {
      $current = Auth::guard('person')->user()->id;
      $structures = DB::table('organize_auths')->where('organize_id',$id)->where('status','Accept')->pluck('member_id')->toArray();
      $member = DB::table('persons')->whereIn('id',$structures)->get();
      return view('system-mgmt/organize/member', compact(['member']));
    }

    public function leaveorg($id)
    {
      $current = Auth::guard('person')->user()->id;
      $re = Organize_auth::where('organize_id',$id)->where('member_id',$current)->delete();
      Organize_auth::where('organize_id',$id)->where('member_id',$current)->delete();
      Port_Org_auth::where('org_id',$id)->where('created_by',$current)->delete();
      return redirect()->back();
    }
}
