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
use App\Member_group;
use App\Http\Controllers\SidebarController;
class EventUserController extends Controller
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




        $events = DB::table('event')
       ->leftJoin('event_type', 'event.event_type_id', '=', 'event_type.id')
       ->leftJoin('persons as organize', 'event.organization_id', '=', 'organize.id')
       ->leftJoin('family', 'event.group_id', '=', 'family.id')
       ->leftJoin('member_groups', 'event.member_group_id', '=', 'member_groups.id')

       ->select('event.*', 'event_type.name as event_type_name', 'event_type.id as event_type_id', 'organize.name as organize_name', 'organize.id as organize_id'
                , 'family.name as group_name', 'family.id as group_id', 'member_groups.name as member_group_name', 'member_groups.id as member_group_id')
       ->paginate(30);

        return view('system-mgmt/eventuser/index', ['events' => $events,'tree' => $tree]);
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
        return view('system-mgmt/eventuser/create',['status' =>$status,'groups' =>$groups,'groupmems' =>$groupmems,'day' =>$day,'month' =>$month,'year' =>$year,'time' =>$time,'eventtypes' => $eventtypes, 'organizes' => $organizes,'tree'=>$tree]);
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
      EventType::findOrFail($request['event_type_id']);
      //  $this->validateInput($request);

        $sd = $request->sd;
        $sm = $request->sm;
        $sy = $request->sy;

        $startdate = $sd."/".$sm."/".$sy;


        $ed = $request->ed;
        $em = $request->em;
        $ey = $request->ey;

        $enddate = $ed."/".$em."/".$ey;
        //return $startdate;

        $event = new Event;
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
        return redirect ('/eventuser');
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
        return view('system-mgmt/eventuser/edit', ['curdate' =>$curdate,'curmonth' =>$curmonth,
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
        return redirect ('/eventuser');


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

       return view('system-mgmt/eventuser/index', ['events' => $events, 'searchingVals' => $constraints,'tree'=>$tree]);
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





}
