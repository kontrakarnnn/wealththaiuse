<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lead_Status;
use App\Person;
use App\Block;
use App\Structure;
use App\Portfolio;
use App\Province;
use App\Prospect;
use App\match_id;
use App\Noti;
use Illuminate\Support\Facades\Auth;
use App\View;
use Mail;
use App\Http\Controllers\SidebarController;
class ProspectAdminController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$date = date('Y-m-d');
      $ref = match_id::whereNotNull('user_id')->get();
      $currentdate = date('d/m/Y');
      $date1 = date('d/m/Y', strtotime("+1 days"));
      $date2 = date('d/m/Y', strtotime("+2 days"));
    //  $carbon = \Carbon\Carbon::now()->addDays(2);
    //  $format = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $carbon)->format('Y.m.d');
      date_default_timezone_set('Asia/Bangkok');
      $typeofdate = $_SERVER['REQUEST_URI'];
      $typeofdate = explode('/',$typeofdate);
      $type = '';
      if(in_array('type',$typeofdate)){
        $type = $typeofdate[3];
      }
      //  return $date;
        $current = Auth::user()->id;
        $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
        $prospect = DB::table('prospect')
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->paginate(30);

        $recontact = DB::table('prospect')
        ->whereIn('re_contact_date', [$date1, $date2])
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();
        $recontactcount = DB::table('prospect')
        ->whereIn('re_contact_date', [$date1, $date2])
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();

        $recontactcurrent = DB::table('prospect')
        ->where('re_contact_date','=',$currentdate)
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();
        $recontactcurrentcount = DB::table('prospect')
        ->where('re_contact_date','=',$currentdate)
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();

        $recontactearly = DB::table('prospect')
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();
        $recontactearlycount = DB::table('prospect')
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();

        $meetingdatecurrent = DB::table('prospect')
        ->where('meeting_date','=',$currentdate)
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();

        $meetingdatecurrentcount = DB::table('prospect')
        ->where('meeting_date','=',$currentdate)
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();

        $meetingdatenear = DB::table('prospect')
        ->where('meeting_date', [$date1, $date2])
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();

        $meetingdateearly = DB::table('prospect')
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();
        $meetingdateearlycount = DB::table('prospect')
        ->where('meeting_date','<',$currentdate)
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();
        //return $lead;
        $i = 0;
        $i2 = 0;
        $leadstatus = DB::table('lead_status')->get();
        return view('system-mgmt/prospectadmin/index', ['recontactcurrent'=>$recontactcurrent,'i2'=>$i2,'i'=>$i,'meetingdateearlycount' => $meetingdateearlycount,'meetingdatecurrentcount' => $meetingdatecurrentcount,'meetingdatenear' => $meetingdatenear,'recontactearly' => $recontactearly,'recontactcount' => $recontactcount,'meetingdateearly' => $meetingdateearly,'meetingdatecurrent' => $meetingdatecurrent,'recontact' => $recontact,'ref' => $ref,'date1' => $date1,'date2' => $date2,'currentdate' => $currentdate,'type' => $type,'leadstatus' => $leadstatus,'prospect' => $prospect]);
    }
    public function changestatus(Request $request){
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('/',$url);
      $lead = Prospect::find($url[4]);
      $lead->status = $url[5];
      $lead->save();
      //return $lead->status;
      //return $url[3];
      //return 'yes';
      $request->session()->flash('alert-success', 'เปลี่ยนข้อมูลเรียบร้อย');

      return redirect('admin/prospectadmin');
    }
    public function changepriority(Request $request){
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('/',$url);
      $lead = Prospect::find($url[4]);
      //return $lead;
      $lead->priority = $url[5];
      $lead->save();
      //return $lead->status;
      //return $url[3];
      //return 'yes';
      $request->session()->flash('alert-success', 'เปลี่ยนข้อมูลเรียบร้อย');
      return redirect('admin/prospectadmin');
    }
    public function changetype(Request $request){
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('/',$url);
      $lead = Prospect::find($url[4]);
      //return $lead;
      $lead->type = $url[5];
      $lead->save();
      //return $lead->status;
      //return $url[3];
      //return 'yes';
      $request->session()->flash('alert-success', 'เปลี่ยนข้อมูลเรียบร้อย');
      return redirect('admin/prospectadmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function show($id)
     {
       $current = Auth::user()->id;
       $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
       $lead = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->get();
         return view('system-mgmt/lead/show',compact(['lead']));
     }

    public function create()
    {
      $ref = match_id::whereNotNull('user_id')->get();
      $province = Province::all();
      $currentyear = date('Y') + 543;
        return view('system-mgmt/prospectadmin/create',compact(['ref','province','currentyear']));
    }

    public function convert()
    {
      $url = $_SERVER['REQUEST_URI'];
      $url = urldecode($url);
      $url = explode('/',$url);
      $convert = 0;
      if(in_array('convert',$url)){
      $convert = 1;
      $value = $_SERVER['REQUEST_URI'];
      $value = urldecode($value);
      $name = explode('=name=',$value);
      $name = $name[1];
      $lname = explode('=lname=',$value);
      $lname = $lname[1];
      $nickname = explode('=nickname=',$value);
      $nickname = $nickname[1];
      $email = explode('=email=',$value);
      $email = $email[1];
      $mobile = explode('=email=',$value);
      $mobile = $mobile[1];

      }
      $province = Province::all();
      $currentyear = date('Y') + 543;
        return view('per/quickregis',compact(['name','lname','nickname','email','mobile','convert','province','currentyear']));
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
      'mobile' => 'nullable|string|max:13',
      'email' => 'nullable|email|max:255|unique:persons',


    ]);
    $currentdate = date('d/m/Y');
    $currenttime = date('H:i:s');
    $current = Auth::user()->id;
    $currentpid = DB::table('match_id')->where('user_id',$current)->value('id');
      $prospect = new Prospect;
      $prospect->name = $request->name;
      $prospect->lname = $request->lname;
      $prospect->email = $request->email;
      $prospect->nickname = $request->nickname;
      $prospect->mobile = $request->mobile;
      $prospect->refered = $currentpid;
      $prospect->type = $request->type;
      $prospect->relation = $request->relation;
      $prospect->priority = $request->priority;
      $prospect->refered = $request->refered;
      $prospect->assign_from_center = 1;
      $prospect->regis_date = $currentdate;
      $prospect->regis_time = $currenttime;

      $prospect->save();

       $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อย');
        return redirect ('/admin/prospectadmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $ref = match_id::whereNotNull('user_id')->get();

        $leadstatus = Lead_Status::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($leadstatus == null) {
          $leadstatus = Lead_Status::find($id);
          $data = array(
              'leadstatus' => $leadstatus
            );
            return redirect ('/admin/prospectadmin');
        }
        return view('system-mgmt/leadstatus/edit', ['ref' => $ref,'leadstatus' => $leadstatus]);
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
    $pros = Prospect::where('id', $id)->value('assign_from_center');



      $lead = Prospect::find($id);
      $lead->last_contact_date = $request->last_contact_date;
      $lead->re_contact_date = $request->re_contact_date;
      $lead->re_contact_time = $request->re_contact_time;
      $lead->meeting_date = $request->meeting_date;
      $lead->meeting_time = $request->meeting_time;
      $lead->meeting_location = $request->meeting_location;
      $lead->note = $request->note;
      $lead->interest = $request->interest;
      $lead->relation = $request->relation;
      if($request->refered != $lead->refered ){

      $lead->refered = $request->refered;
      $pro = Prospect::find($id);
      $messagetypes = DB::table('message_types')
      ->where('message_types.id',42)->get();
      $message = new Noti;
      $message->message_type_id = 42;
      foreach($messagetypes as $m)
      {
      $message->message = $m->message_default.'Firstname: '.$pro->name;
      $message->topic = $m->message_template;
      $message->status = $m->default_status;
      }
      $message->sender_id  = 1;
      $message->created_by = 1;
      $message->recieve_id = $lead->refered;
      $message->save();
      $recieveremail = match_id::where('id',$lead->refered)->value('public_email');
      Mail::send('emails.assignprospect',compact('pro'),function($message) use ($recieveremail,$messagetypes){

               $message->to($recieveremail);

                foreach ($messagetypes as $messages) {
                $message->subject($messages->message_template);
                }
              });
    }
      if($pros < 0)
      {
        $pros = explode('-',$pros);
        $pros = $pros[1];
        $lead->assign_from_center = $pros+1;
      }
      $lead->assign_from_center = 1;
      $lead->status = 3;

      $lead->update();
    //  return $lead;



       $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect('/admin/prospectadmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $pros = Prospect::where('id', $id)->value('assign_from_center');
        if($pros != NULL){
          Prospect::where('id', $id)->delete();
           return redirect('/admin/prospectadmin');
        }

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
      $ref = match_id::whereNotNull('user_id')->get();

      $currentdate = date('d/m/Y');
      $date1 = date('d/m/Y', strtotime("+1 days"));
      $date2 = date('d/m/Y', strtotime("+2 days"));
      $current = Auth::user()->id;
      $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
      $prospect = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->paginate(30);

      $recontact = DB::table('prospect')
      ->whereIn('re_contact_date', [$date1, $date2])
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();
      $recontactcount = DB::table('prospect')
      ->whereIn('re_contact_date', [$date1, $date2])
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();

      $recontactcurrent = DB::table('prospect')
      ->where('re_contact_date','=',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();
      $recontactcurrentcount = DB::table('prospect')
      ->where('re_contact_date','=',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();

      $recontactearly = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();
      $recontactearlycount = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();

      $meetingdatecurrent = DB::table('prospect')
      ->where('meeting_date','=',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();

      $meetingdatecurrentcount = DB::table('prospect')
      ->where('meeting_date','=',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();

      $meetingdatenear = DB::table('prospect')
      ->where('meeting_date', [$date1, $date2])
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();

      $meetingdateearly = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();
      $meetingdateearlycount = DB::table('prospect')
      ->where('meeting_date','<',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();
      //return $lead;
      $i = 0;
      $i2 = 0;
      $leadstatus = DB::table('lead_status')->get();
        $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            'column' => $request['column'],
            ];
            $url = $_SERVER['HTTP_REFERER'];
            //return $url;

            $url = 'prospect.'.$request['column'];
            //return $url;

            $type = '';

            //return $type;
       $prospect = $this->doSearchingQuery($constraints,$url);
       $leadstatus  = DB::table('lead_status')->get();
        return view('system-mgmt/prospectadmin/index', ['recontactcurrent'=>$recontactcurrent,'i2'=>$i2,'i'=>$i,'meetingdateearlycount' => $meetingdateearlycount,'meetingdatecurrentcount' => $meetingdatecurrentcount,'meetingdatenear' => $meetingdatenear,'recontactearly' => $recontactearly,'recontactcount' => $recontactcount,'meetingdateearly' => $meetingdateearly,'meetingdatecurrent' => $meetingdatecurrent,'recontact' => $recontact,'ref' => $ref,'date1' => $date1,'date2' => $date2,'currentdate' => $currentdate,'type' => $type,'leadstatus' => $leadstatus,'prospect' => $prospect]);
          }
    private function doSearchingQuery($constraints ,$url) {
      date_default_timezone_set('Asia/Bangkok');

        $date = date("d/m/Y");
        //return $date;
        $current = Auth::user()->id;
        $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
        $prospect = DB::table('prospect')
        ->leftjoin('lead_status','prospect.status','=','lead_status.id')
        ->where($url, '>=', $constraints['from'])
        ->where($url, '<=', $constraints['to'])
        ->select('prospect.*','lead_status.name as lead_statusname')
        ->orderBy('prospect.regis_date', 'DESC')
        ->paginate(10000000);

        return $prospect;
    }

    public function searchnormal(Request $request) {
      $ref = match_id::whereNotNull('user_id')->get();

      $currentdate = date('d/m/Y');
      $date1 = date('d/m/Y', strtotime("+1 days"));
      $date2 = date('d/m/Y', strtotime("+2 days"));

      $current = Auth::user()->id;
      $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
      $prospect = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->paginate(30);

      $recontact = DB::table('prospect')
      ->whereIn('re_contact_date', [$date1, $date2])
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();
      $recontactcount = DB::table('prospect')
      ->whereIn('re_contact_date', [$date1, $date2])
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();

      $recontactcurrent = DB::table('prospect')
      ->where('re_contact_date','=',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();
      $recontactcurrentcount = DB::table('prospect')
      ->where('re_contact_date','=',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();

      $recontactearly = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();
      $recontactearlycount = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();

      $meetingdatecurrent = DB::table('prospect')
      ->where('meeting_date','=',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();

      $meetingdatecurrentcount = DB::table('prospect')
      ->where('meeting_date','=',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();

      $meetingdatenear = DB::table('prospect')
      ->where('meeting_date', [$date1, $date2])
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();

      $meetingdateearly = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->get();
      $meetingdateearlycount = DB::table('prospect')
      ->where('meeting_date','<',$currentdate)
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC')
      ///->orderBy('persons.priority', 'DESC')
      ->count();
      //return $lead;
      $i = 0;
      $i2 = 0;
      $leadstatus = DB::table('lead_status')->get();


      $type = '';
        $constraints = [
            'prospect.name' => $request['name'],
            'prospect.lastname' => $request['lname'],
			    'prospect.email' => $request['email'],
            'prospect.mobile' => $request['mobile'],
            'prospect.type' => $request['type'],
            'lead_status.name' => $request['lead_statusname'],
			       'prospect.nickname' => $request['nickname'],
             'prospect.priority' => $request['priority']

            ];

       $prospect = $this->doSearchingQuerynormal($constraints);
			 $constraints['name'] = $request['name'];
			 $constraints['lname'] = $request['lname'];
			 $constraints['email'] = $request['email'];
			 $constraints['mobile'] = $request['mobile'];
			 $constraints['type'] = $request['type'];
       $constraints['lead_statusname'] = $request['lead_statusname'];
       $constraints['nickname'] = $request['nickname'];
       $constraints['priority'] = $request['priority'];


        return view('system-mgmt/prospectadmin/index', ['recontactcurrent'=>$recontactcurrent,'i2'=>$i2,'i'=>$i,'meetingdateearlycount' => $meetingdateearlycount,'meetingdatecurrentcount' => $meetingdatecurrentcount,'meetingdatenear' => $meetingdatenear,'recontactearly' => $recontactearly,'recontactcount' => $recontactcount,'meetingdateearly' => $meetingdateearly,'meetingdatecurrent' => $meetingdatecurrent,'recontact' => $recontact,'ref' => $ref,'date1' => $date1,'date2' => $date2,'currentdate' => $currentdate,'type' => $type,'leadstatus' => $leadstatus,'prospect' => $prospect]);
          }

    private function doSearchingQuerynormal($constraints) {
      $current = Auth::user()->id;
      $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
      $query = DB::table('prospect')
      ->leftjoin('lead_status','prospect.status','=','lead_status.id')
      ->select('prospect.*','lead_status.name as lead_statusname')
      ->orderBy('prospect.regis_date', 'DESC');
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





}
