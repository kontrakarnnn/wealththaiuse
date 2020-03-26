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
use App\Noti;
use Mail;
use App\Organize;
use App\Family;
use App\Member_group;
use App\Event_To_Member;
use App\Message_type;
use App\Http\Controllers\DataController;
class EventToMemberController extends Controller
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

    public function regisevent($id){
      date_default_timezone_set('Asia/Bangkok');

      //sidebar
      $tree = session()->get('tree');
      //sidebar
      $eventid = $_SERVER['REQUEST_URI'];
      $eventid = explode('/',$eventid);
      $eventid = $eventid[3];
      $current = Auth::user()->id;
      $currentmacthid  = match_id::where('user_id',$current)->value('id');
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
     $mymember = new DataController();
     $mymember = $mymember->mymember();
     //return $mymember;
     $member = DB::table('persons')->where('ref_user_pid',$currentmacthid)->orwhereIn('id',$mymember)->get();
     $eventstatus = DB::table('event_regis_status')->get();
      //$br = DB::table('branch')->where('org_id',$id)->get();
      return view('system-mgmt/eventuser/regisevent', compact(['eventlimit','eventcount','event','eventstatus','member','ref','tree']));
    }

    public function checkevent($id)
    {

      //sidebar

      $tree = session()->get('tree');
      //sidebar


        $event = Event::find($id);

        $current = Auth::user()->id;
        $currentmacthid  = match_id::where('user_id',$current)->value('id');

        // Redirect to division list if updating division wasn't existed
        if ($event == null) {
          $event = Event::find($id);
          $data = array(
              'event' => $event
            );
            return redirect ('/eventuser');
        }
        $eventtypes = EventType::all();
        $organizes = Organize::all();
        $member = Event_To_Member::where('event_to_member.event_id',$id)
        ->leftJoin('persons','event_to_member.member_id','persons.id')
        ->leftJoin('match_id','event_to_member.created_by','match_id.id')
        ->leftJoin('event_regis_status','event_to_member.event_regis_status','event_regis_status.id')
        ->select('event_to_member.*','event_regis_status.name as status_name','match_id.id as creator_id','match_id.public_name as creator_name','persons.name as member_name','persons.lname as member_lname')
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

        return view('system-mgmt/eventuser/showmem', ['currentmacthid' => $currentmacthid,'current' => $current,'ref' => $ref,'member' => $member,'event' => $event, 'eventtypes' => $eventtypes,'organizes' => $organizes,'tree'=>$tree]);
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
      $url = url()->previous();
      $url = explode('/',$url);
      $url = $url[5];

      //return $noti_pid;
      $statusid = Event::where('id',$url)->value('regis_default_status');
      //return $statusid;
      $current = Auth::user()->id;
      $currentmacthid  = match_id::where('user_id',$current)->value('id');
      $eventregis = New Event_To_Member;
      $eventregis->event_id = $url;
      $eventstartdate = Event::where('id',$request->event_id)->value('event_start_date');
      $eventenddate = Event::where('id',$request->event_id)->value('event_end_date');
      $date = date('d/m/Y');
      $time = date('H:i:s');
      //1=preregis 2=onevent 3=post event
      $period = '';
      if($date < $eventstartdate){
        $period = 1;
      }
      if($date >= $eventstartdate && $date <= $eventenddate){
        $period = 2;
      }
      if($date > $eventstartdate && $date > $eventenddate){
        $period = 3;
      }
      $eventregis->regis_period = $period;
      $eventregis->member_id = $request->member_id;
      $eventregis->note = $request->note;
      $eventregis->created_by = $currentmacthid;
      $eventregis->event_regis_status = $statusid;
      $eventregis->save();

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
      $message_to_pid->sender_id  = $senderid;
      $message_to_pid->created_by = $senderid;
      if($noti_pid != NULL)
      {
      $message_to_pid->recieve_id =$noti_pid;
      }
      $userref = Person::where('id',$eventregis->member_id)->value('ref_user_pid');
      $message_to_pid->cc_reciever1 =$userref;
      $message_to_pid->save();

      $eventdetail = Event::where('id',$eventregis->event_id)->get();
      $notiemail = match_id::where('id',$noti_pid)->get();
      $ccemail = match_id::where('id',$message_to_pid->cc_reciever1)->value('public_email');
      $reciever = match_id::where('id',$message_to_pid->recieve_id)->value('public_email');
      $senderdetail = Person::where('id',$eventregis->member_id)->get();
      Mail::send('emails.eventusertouser',compact('eventdetail','senderdetail','messagetypes'),function($message) use ($ccemail,$reciever,$messagetypes){

               $message->to([$reciever,$ccemail]);

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
      //return $message_to_pid;

        return redirect ('/eventuser');
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
    public function update(Request $request, $id)
    {
      date_default_timezone_set('Asia/Bangkok');
      //  $block = Block::findOrFail($id);
        $sd = $request->sd;
        $sm = $request->sm;
        $sy = $request->sy;

        $startdate = $sd."/".$sm."/".$sy;


        $ed = $request->ed;
        $em = $request->em;
        $ey = $request->ey;

        $enddate = $ed."/".$em."/".$ey;
        //return $startdate;

        $event = Event::find($id);;
        $event->event_type_id = $request -> event_type_id;
        $event->organization_id = $request -> organization_id;
        $event->group_id = $request -> group_id;
        $event->member_group_id = $request -> member_group_id;
        $event->event_name  = $request -> event_name;
        $event->event_start_date = $startdate;
        $event->event_start_time = $request -> event_start_time;
        $event->event_end_date = $enddate;
        $event->event_end_time = $request-> event_end_time;
        $event->location  = $request -> location;
        $event->event_description = $request -> event_description;
        $event->link = $request -> link;
        $event->captcha = $request -> captcha;
        $event->regis_default_status = $request -> regis_default_status;
        $event->number_seat = $request -> number_seat;
        $event->show_member = $request -> show_member;
        $event->link_moreinfo = $request -> link_moreinfo;
        $event->save();
        return redirect ('/admin/event');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::where('id', $id)->delete();
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
     ->leftJoin('event_regis_status', 'event.regis_default_status', '=', 'event_regis_status.id')
     ->select('event.*', 'event_regis_status.name as status_name', 'event_type.name as event_type_name', 'event_type.id as event_type_id', 'organize.name as organize_name', 'organize.id as organize_id'
              , 'family.name as group_name', 'family.id as group_id', 'member_groups.name as member_group_name', 'member_groups.id as member_group_id')
     ->get();
      //$br = DB::table('branch')->where('org_id',$id)->get();
      return view('system-mgmt/event/showevent', compact(['ref','tree']));
    }

}
