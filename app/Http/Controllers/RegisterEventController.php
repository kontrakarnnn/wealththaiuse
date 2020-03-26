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
use App\match_id;
use App\Organize;
use App\Family;
use App\Member_group;
use App\Event_To_Member;
use App\Message_type;
use App\Noti;
use Mail;
use App\Http\Controllers\DataController;
class RegisterEventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('viewper');
    }

    public function regisevent($id){
      date_default_timezone_set('Asia/Bangkok');

      //sidebar

      $tree = session()->get('tree');
      //sidebar
      $eventid = $_SERVER['REQUEST_URI'];
      $eventid = explode('/',$eventid);
      $eventid = $eventid[3];
      $eventchk = Event::where('id',$eventid)->value('show_member');
      if($eventchk == 0 || $eventchk == NULL){
        return view('error');
      }
      $event = Event::where('id',$eventid)->get();
      $eventlimit  = DB::table('event')
      ->where('event.id',$id)->value('number_seat');
      $eventcount  = DB::table('event_to_member')
      ->where('event_id',$id)->count();
      //return $eventlimit;
      $ref   = DB::table('event')
      ->where('event.id',$id)
     ->leftJoin('event_type', 'event.event_type_id', '=', 'event_type.id')
     ->leftJoin('persons as organize', 'event.organization_id', '=', 'organize.id')
     ->leftJoin('family', 'event.group_id', '=', 'family.id')
     ->leftJoin('member_groups', 'event.member_group_id', '=', 'member_groups.id')
     ->leftJoin('event_regis_status', 'event.regis_default_status', '=', 'event_regis_status.id')
     ->select('event.*', 'event_regis_status.name as status_name', 'event_type.name as event_type_name', 'event_type.id as event_type_id', 'organize.name as organize_name', 'organize.id as organize_id'
              , 'family.name as group_name', 'family.id as group_id', 'member_groups.name as member_group_name', 'member_groups.id as member_group_id')
     ->get();

     //return $mymember;
     $current = Auth::guard('person')->user()->id;
     $eventtomember = DB::table('event_to_member')->where('event_id',$id)->where('member_id',$current)->get();
     $eventstatus = DB::table('event_regis_status')->get();
      //$br = DB::table('branch')->where('org_id',$id)->get();
      return view('system-mgmt/eventmember/regisevent', compact(['eventtomember','eventlimit','eventcount','event','eventstatus','ref','tree']));
    }

    public function checkevent($id)
    {

      //sidebar

      $tree = session()->get('tree');
      //sidebar


        $event = Event::find($id);

        $current = Auth::user()->id;

        // Redirect to division list if updating division wasn't existed
        if ($event == null) {
          $event = Event::find($id);
          $data = array(
              'event' => $event
            );
            return redirect ('/eventmember');
        }
        $eventtypes = EventType::all();
        $organizes = Organize::all();
        $member = Event_To_Member::where('event_to_member.event_id',$id)
        ->leftJoin('persons','event_to_member.member_id','persons.id')
        ->leftJoin('users','event_to_member.created_by','users.id')
        ->leftJoin('event_regis_status','event_to_member.event_regis_status','event_regis_status.id')
        ->select('event_to_member.*','event_regis_status.name as status_name','users.id as creator_id','users.firstname as creator_name','users.lastname as creator_lname','persons.name as member_name','persons.lname as member_lname')
        ->get();
      //  return $member;
      $ref   = DB::table('event')
      ->where('event.id',$id)
     ->leftJoin('event_type', 'event.event_type_id', '=', 'event_type.id')
     ->leftJoin('persons as organize', 'event.organization_id', '=', 'organize.id')
     ->leftJoin('family', 'event.group_id', '=', 'family.id')
     ->leftJoin('member_groups', 'event.member_group_id', '=', 'member_groups.id')
     ->leftJoin('event_regis_status', 'event.regis_default_status', '=', 'event_regis_status.id')
     ->select('event.*', 'event_regis_status.name as status_name', 'event_type.name as event_type_name', 'event_type.id as event_type_id', 'organize.name as organize_name', 'organize.id as organize_id'
              , 'family.name as group_name', 'family.id as group_id', 'member_groups.name as member_group_name', 'member_groups.id as member_group_id')
     ->get();

        return view('system-mgmt/eventmember/showmem', ['current' => $current,'ref' => $ref,'member' => $member,'event' => $event, 'eventtypes' => $eventtypes,'organizes' => $organizes,'tree'=>$tree]);
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
      $status = DB::table('event_regis_status')->get();
        return view('system-mgmt/event/create',['status' =>$status,'groups' =>$groups,'groupmems' =>$groupmems,'day' =>$day,'month' =>$month,'year' =>$year,'time' =>$time,'eventtypes' => $eventtypes, 'organizes' => $organizes,'tree'=>$tree]);
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
      date('D-m-y H:i:s');
      //  $this->validateInput($request);
      $current = Auth::guard('person')->user()->id;
      $currentmacthid  = match_id::where('member_id',$current)->value('id');
      $url = url()->previous();
      $url = explode('/',$url);
    //  return $url;
      $url = $url[5];

      $whatINeed1 = explode('?', $_SERVER['HTTP_REFERER']);
      //return $whatINeed1;
      //return $whatINeed1;
      $source = '';
      $medium = '';
      $name = '';
      $term = '';
      $content = '';
      if(count($whatINeed1)>1)
	  {
      $source = explode('utm_source=',$whatINeed1[1]);
      $source = explode('&',$source[1]);
      $source = $source[0];
      $medium = explode('medium=',$whatINeed1[1]);
      $medium = explode('&',$medium[1]);
      $medium = $medium[0];
      $name = explode('name=',$whatINeed1[1]);
      $name = explode('&',$name[1]);
      $name = $name[0];
      $term = explode('term=',$whatINeed1[1]);
      $term = explode('&',$term[1]);
      $term = $term[0];
      $content = explode('content=',$whatINeed1[1]);
      $content = explode('&',$content[1]);
      $content = $content[0];
}
      $statusid = Event::where('id',$url)->value('regis_default_status');
      //return $statusid;

      $eventregis = New Event_To_Member;
      $eventregis->event_id = $url;
      $eventstartdate = Event::where('id',$url)->value('event_start_date');
      $eventenddate = Event::where('id',$url)->value('event_end_date');
      $date = date('d/m/Y');
      $time = date('H:i:s');
      //1=preregis 2=onevent 3=post event
      $period = '';
      $birth =' ';
      $end =' ';
      $date1 = date('d-m-Y');
      if($eventstartdate != NULL)
      {
      $birth=explode("/",str_replace(" ","-",$eventstartdate));
      //($birth[0])."-".$birth[1]."-".$birth[2];
      $birth = $birth[0]."-".$birth[1]."-".$birth[2];
      }
      if($eventenddate != NULL)
      {
      $end=explode("/",str_replace(" ","-",$eventenddate));
      //($birth[0])."-".$birth[1]."-".$birth[2];
      $end = $end[0]."-".$end[1]."-".$end[2];
      }
      $datetime1 = date_create($date1);
      $datetime2 = date_create($birth);
      $datetime3 = date_create($end);
      $interval = date_diff($datetime1, $datetime2);
      $interval2 = date_diff($datetime1, $datetime3);
      $day =  $interval->format("%R%a");
      $day2 =  $interval2->format("%R%a");
      //return $day;
      if($day > 0){
        $period = 1;
      }
      if($day <= 0 && $day2 >= 1){
        $period = 2;
      }
      if($day < 0 && $day2 < 1){
        $period = 3;
      }
      $eventregis->regis_period = $period;
      $eventregis->member_id = $current;
      $eventregis->note = $request->note;
      $eventregis->created_by = $currentmacthid;
      $eventregis->event_regis_status = $statusid;
      $eventregis->utm_medium = $medium;
      $eventregis->utm_term = $term;
      $eventregis->utm_name = $name;
      $eventregis->utm_source = $source;
      $eventregis->utm_content = $content;
      $eventregis->save();
		//Message & Email Module
    $noti_pid = Event::where('id',$url)->value('noti_pid');
    $messagetypes = DB::table('message_types')
    ->where('message_types.id',40)->get();

      $message_to_pid = New Noti;
      $message_to_pid->message_type_id = 40;
      foreach($messagetypes as $m)
      {
        $message_to_pid->message = $m->message_default;
        $message_to_pid->topic = $m->message_template;
        $message_to_pid->sender_note  = $request-> sender_note;
        $message_to_pid->status = $m->default_status;
        $message_to_pid->recieve_id =$m->default_recieve_id;
      }
      $senderid = match_id::where('member_id',$eventregis->member_id)->value('id');
      $user_ref = Person::where('id',$eventregis->member_id)->value('ref_user_pid');
      $message_to_pid->sender_id  = $senderid;
      $message_to_pid->created_by = $senderid;
      if($noti_pid != NULL)
      {
        $message_to_pid->recieve_id =$noti_pid;
      }
        $message_to_pid->cc_reciever1 =$user_ref;
        $message_to_pid->save();

        $eventdetail = Event::where('id',$eventregis->event_id)->get();
        $notiemail = match_id::where('id',$noti_pid)->get();
        $ccemail = match_id::where('id',$message_to_pid->cc_reciever1)->value('public_email');
        $reciever = match_id::where('id',$message_to_pid->recieve_id)->value('public_email');
        $senderdetail = Person::where('id',$eventregis->member_id)->get();
        Mail::send('emails.eventusertouser',compact('eventdetail','senderdetail','messagetypes'),function($message) use ($ccemail,$reciever,$messagetypes){
                if($ccemail == NULL){
                  $message->to([$reciever]);
                }
                else{
                 $message->to([$reciever,$ccemail]);
               }
                  foreach ($messagetypes as $messages) {
                  $message->subject($messages->message_template);
                  }
                });

        $autore = DB::table('message_types')
                  ->where('id',40)
                  ->value('auto_reply');
                  $replymes = DB::table('message_types')
                  ->where('id',40)
                  ->get();
                //  return $replymes;
                  if($autore == "Yes"){
                   $reply = new Noti;
                   foreach($replymes as $m)
                   {
                   $reply->message = $m->message_default;
                   $reply->topic = $m->message_template;
                   $reply->sender_note  = $request-> sender_note;
                   $reply->status = $m->default_status;
                   }
                   $reply->sender_id =  1;
                   $reply->recieve_id = $senderid ;
                   $reply->created_by = 1 ;
                   $reply->reply_msg = $message_to_pid->id ;
                   $reply->save();
                 }
                 $senderemail = match_id::where('member_id',$eventregis->member_id)->value('public_email');
                Mail::send('emails.eventuser',compact('eventdetail','senderdetail','messagetypes'),function($message) use ($senderemail,$messagetypes){
                          $message->to($senderemail);
                           foreach ($messagetypes as $messages) {
                           $message->subject($messages->message_template);
                           }
                         });
      $request->session()->flash('alert-success', 'ลงทะเบียนเรียบร้อยแล้ว');
      $redirectlink = Event::where('id',$url)->value('redirect_link');
      if($redirectlink == NULL || $redirectlink == '')
      {
        return redirect ('/eventmember');
      }
      else
      {
        return redirect($redirectlink);
      }
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


        $event = Event::find($id);


        // Redirect to division list if updating division wasn't existed
        if ($event == null) {
          $event = Event::find($id);
          $data = array(
              'event' => $event
            );
            return redirect ('/admin/event');
        }
        $curdob = Event::where('id',$id)->value('event_start_date');
        if($curdob != NULL){

      $curdob = explode('/', $curdob);
      $curdate =$curdob[0];
      $curmonth =$curdob[1];
      $curyear =$curdob[2];
  }
  else {
    $curdate ="";
    $curmonth ="";
    $curyear ="";
  }
  $curedob = Event::where('id',$id)->value('event_end_date');
  if($curdob != NULL){

    $curedob = explode('/', $curedob);
    $curedate =$curdob[0];
    $curemonth =$curdob[1];
    $cureyear =$curdob[2];
  }
  else {
    $curedate ="";
    $curemonth ="";
    $cureyear ="";
  }
        $eventtypes = EventType::all();
        $organizes = Person::where('type','=','2')->get();
        $groups = Family::all();
        $groupmems = Member_group::all();
        $member = DB::table('persons')->where('event_id',1)->get();
        $status = DB::table('event_regis_status')->get();
      //  return $member;
        return view('system-mgmt/event/edit', ['curdate' =>$curdate,'curmonth' =>$curmonth,
        'curyear' =>$curyear,'status' =>$status,'curedate' =>$curedate,'curemonth' =>$curemonth,
        'cureyear' =>$cureyear,'groups' => $groups,'groupmems' => $groupmems,'member' => $member,'event' => $event, 'eventtypes' => $eventtypes,'organizes' => $organizes,'tree'=>$tree]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



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




}
