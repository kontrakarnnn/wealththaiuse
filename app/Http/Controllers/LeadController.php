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

use Illuminate\Support\Facades\Auth;
use App\View;
use App\Http\Controllers\SidebarController;
class LeadController extends Controller
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
      date_default_timezone_set('Asia/Bangkok');

        $date = date("d/m/Y");
        $date3 = date("Ymd");
        $day = '20190611';
        $daycal  =  $day-$date3;
        $date1 = date('d/m/Y', strtotime("+1 days"));
        $date2 = date('d/m/Y', strtotime("+2 days"));
        $currentdate = date('d/m/Y');

      //  return $daycal;
      $date2 = date("m/d/Y");
      $dayAfter = (new \DateTime($date2))->modify('+1 day')->format('d/m/Y');
      //  return $date;
        $current = Auth::user()->id;
        $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
        $lead = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->paginate(30);
        $recontact = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->whereIn('re_contact_date',[$date1,$date2])
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();
        //return $recontact;
        $recontactcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->whereIn('re_contact_date', [$date1,$date2])
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();

        $recontactearly = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();

        $recontactearlycount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->where('re_contact_date','<',$currentdate)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();

        $recontactcurrent = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->where('re_contact_date','=',$currentdate)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();


        $recontactcurrentcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->where('re_contact_date','=',$currentdate)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();

        $meetingdatenear = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->whereIn('meeting_date',[$date1,$date2])
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();
        $meetingdatecurrent = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->where('meeting_date','=',$currentdate)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();
        $meetingdatecurrentcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->where('meeting_date','=',$currentdate)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();
        $meetingdateearly = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->get();
        $meetingdateearlycount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->where('meeting_date','<',$currentdate)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();
        //return $lead;
        $leadcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
        ->where('lead_status','!=',4)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
        ->select('persons.*','lead_status.name as lead_statusname')
        ->orderBy('persons.regis_date', 'DESC')
        ///->orderBy('persons.priority', 'DESC')
        ->count();
        $i = 0;
        $i2 = 0;
        $leadstatus = DB::table('lead_status')->get();
        return view('system-mgmt/lead/index', ['meetingdatenear'=>$meetingdatenear,'recontactcurrentcount'=>$recontactcurrentcount,'recontactcurrent'=>$recontactcurrent,'recontactearly'=>$recontactearly,'recontactearlycount'=>$recontactearlycount,'leadcount'=>$leadcount,'i2'=>$i2,'i'=>$i,'meetingdateearlycount' => $meetingdateearlycount,'meetingdatecurrentcount' => $meetingdatecurrentcount,'recontactcount' => $recontactcount,'meetingdateearly' => $meetingdateearly,'meetingdatecurrent' => $meetingdatecurrent,'recontact' => $recontact,'date' => $date,'date1' => $date1,'date2' => $date2,'leadstatus' => $leadstatus,'lead' => $lead]);
    }

    public function changestatus(Request $request){
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('/',$url);
      $lead = Person::find($url[2]);
      $lead->lead_status = $url[3];
      $lead->save();
      //return $lead->status;
      //return $url[3];
      //return 'yes';
		       $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อย');

      return redirect('/lead');
    }
    public function changepriority(Request $request){
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('/',$url);
      $lead = Person::find($url[2]);

      $lead->priority = $url[3];
      $lead->save();
      //return $lead->status;
      //return $url[3];
      //return 'yes';
		       $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อย');

      return redirect('/lead');
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
      $province = Province::all();
      $currentyear = date('Y') + 543;
      $convert = 0;
        return view('per/quickregis',compact(['convert','province','currentyear']));
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

      $leadstatus = new Lead_Status;
      $leadstatus->name = $request->name;
      $leadstatus->save();

       $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อย');
        return redirect ('/admin/leadstatus');
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
        $leadstatus = Lead_Status::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($leadstatus == null) {
          $leadstatus = Lead_Status::find($id);
          $data = array(
              'leadstatus' => $leadstatus
            );
            return redirect ('/admin/leadstatus');
        }
        return view('system-mgmt/leadstatus/edit', ['leadstatus' => $leadstatus]);
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

      $lead = Person::find($id);
      $lead->last_contact_date = $request->last_contact_date;
      $lead->re_contact_date = $request->re_contact_date;
      $lead->re_contact_time = $request->re_contact_time;
      $lead->meeting_date = $request->meeting_date;
      $lead->meeting_time = $request->meeting_time;
      $lead->meeting_location = $request->meeting_location;
      $lead->lead_note = $request->lead_note;
      $lead->save();

       $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อย');
        return redirect('/lead');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

		   $person = Person::find($id);
          $person->lead_status = 4;
          $person->update();
         return redirect('/lead');
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

       $date = date("d/m/Y");
       $date3 = date("Ymd");
       $day = '20190611';
       $daycal  =  $day-$date3;
       $date1 = date('d/m/Y', strtotime("+1 days"));
       $date2 = date('d/m/Y', strtotime("+2 days"));
       $currentdate = date('d/m/Y');

     //  return $daycal;
     $date2 = date("m/d/Y");
     $dayAfter = (new \DateTime($date2))->modify('+1 day')->format('d/m/Y');
     //  return $date;
       $current = Auth::user()->id;
       $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
       $lead = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->paginate(30);
       $recontact = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->whereIn('re_contact_date',[$date1,$date2])
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();

       $recontactcurrent = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('re_contact_date','=',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();


       $recontactcurrentcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('re_contact_date','=',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       //return $recontact;
       $recontactcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->whereIn('re_contact_date', [$date1,$date2])
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       $meetingdatecurrent = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('meeting_date','=',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();
       $recontactearly = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();
       $meetingdatecurrentcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('meeting_date','=',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       $meetingdateearly = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();
       $meetingdateearlycount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('meeting_date','<',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       $meetingdatenear = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->whereIn('meeting_date',[$date1,$date2])
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();
       //return $lead;
       $leadcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       $i = 0;
       $i2 = 0;
         $constraints = [
             'from' => $request['from'],
             'to' => $request['to'],
             'column' => $request['column'],
             ];
             $url = $_SERVER['HTTP_REFERER'];
             //return $url;

             $url = 'persons.'.$request['column'];
             //return $url;

             $type = '';

             //return $type;
        $lead = $this->doSearchingQuery($constraints,$url);
        $leadstatus  = DB::table('lead_status')->get();
        return view('system-mgmt/lead/index', ['meetingdatenear'=>$meetingdatenear,'recontactearly' => $recontactearly,'recontactcurrentcount' => $recontactcurrentcount,'recontactcurrent' => $recontactcurrent,'recontact' => $recontact,'leadcount'=>$leadcount,'i2'=>$i2,'i'=>$i,'meetingdateearlycount' => $meetingdateearlycount,'meetingdatecurrentcount' => $meetingdatecurrentcount,'recontactcount' => $recontactcount,'meetingdateearly' => $meetingdateearly,'meetingdatecurrent' => $meetingdatecurrent,'date' => $date,'date1' => $date1,'date2' => $date2,'type' => $type,'leadstatus' => $leadstatus,'lead' => $lead, 'searchingVals' => $constraints,'tree'=>$tree]);
     }
     private function doSearchingQuery($constraints ,$url) {
       date_default_timezone_set('Asia/Bangkok');

         $date = date("d/m/Y");
         //return $date;
         $current = Auth::user()->id;
         $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
         $lead = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
         ->where('lead_status','!=',4)
         ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
         ->where($url, '>=', $constraints['from'])
         ->where($url, '<=', $constraints['to'])
         ->select('persons.*','lead_status.name as lead_statusname')
         ->orderBy('persons.regis_date', 'DESC')
         ->paginate(10000000);

         return $lead;
     }

     public function searchnormal(Request $request) {
       $date = date("d/m/Y");
       $date3 = date("Ymd");
       $day = '20190611';
       $daycal  =  $day-$date3;
       $date1 = date('d/m/Y', strtotime("+1 days"));
       $date2 = date('d/m/Y', strtotime("+2 days"));
       $currentdate = date('d/m/Y');

     //  return $daycal;
     $date2 = date("m/d/Y");
     $dayAfter = (new \DateTime($date2))->modify('+1 day')->format('d/m/Y');
     //  return $date;
       $current = Auth::user()->id;
       $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
       $lead = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->paginate(30);
       $recontact = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->whereIn('re_contact_date',[$date1,$date2])
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();

       $recontactcurrent = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('re_contact_date','=',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();


       $recontactcurrentcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('re_contact_date','=',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       //return $recontact;
       $recontactcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->whereIn('re_contact_date', [$date1,$date2])
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       $meetingdatecurrent = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('meeting_date','=',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();
       $recontactearly = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();
       $meetingdatecurrentcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('meeting_date','=',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       $meetingdateearly = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();
       $meetingdateearlycount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->where('meeting_date','<',$currentdate)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();

       $meetingdatenear = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->whereIn('meeting_date',[$date1,$date2])
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->get();
       //return $lead;
       $leadcount = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
       ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC')
       ///->orderBy('persons.priority', 'DESC')
       ->count();
       $i = 0;
       $i2 = 0;

       $leadstatus  = DB::table('lead_status')->get();


       $type = '';
         $constraints = [
             'persons.name' => $request['name'],
             'persons.lname' => $request['lname'],
 			       'persons.email' => $request['email'],
             'persons.mobile' => $request['mobile'],
             'lead_status.name' => $request['lead_statusname'],
 			       'persons.nickname' => $request['nickname'],
              'persons.priority' => $request['priority'],
              'persons.utm_source' => $request['utm_source'],
               'persons.utm_medium' => $request['utm_medium'],
               'persons.utm_name' => $request['utm_name'],
               'persons.utm_term' => $request['utm_term'],
               'persons.utm_content' => $request['utm_content'],


             ];
//             return $request['lead_statusname'];

        $lead = $this->doSearchingQuerynormal($constraints);
 			 $constraints['name'] = $request['name'];
 			 $constraints['lname'] = $request['lname'];
 			 $constraints['email'] = $request['email'];
 			 $constraints['mobile'] = $request['mobile'];
        $constraints['lead_statusname'] = $request['lead_statusname'];
        $constraints['nickname'] = $request['nickname'];
        $constraints['priority'] = $request['priority'];
        $constraints['utm_source'] = $request['utm_source'];
        $constraints['utm_medium'] = $request['utm_medium'];
        $constraints['utm_name'] = $request['utm_name'];
        $constraints['utm_term'] = $request['utm_term'];
        $constraints['utm_content'] = $request['utm_content'];

        return view('system-mgmt/lead/index', ['meetingdatenear'=>$meetingdatenear,'recontactearly' => $recontactearly,'recontactcurrent' => $recontactcurrent,'recontact' => $recontact,'leadcount'=>$leadcount,'i2'=>$i2,'i'=>$i,'meetingdateearlycount' => $meetingdateearlycount,'meetingdatecurrentcount' => $meetingdatecurrentcount,'recontactcount' => $recontactcount,'meetingdateearly' => $meetingdateearly,'meetingdatecurrent' => $meetingdatecurrent,'lead' => $lead,'date' => $date,'date1' => $date1,'date2' => $date2,'type' => $type,'leadstatus' => $leadstatus, 'searchingVals' => $constraints]);
     }

     private function doSearchingQuerynormal($constraints) {
       $current = Auth::user()->id;
       $current_pid = DB::table('match_id')->where('user_id',$current)->value('id');
       $query = DB::table('persons')->where('ref_user_pid',$current_pid)->where('type','=',0)
       ->where('lead_status','!=',4)
        ->leftjoin('lead_status','persons.lead_status','=','lead_status.id')
       ->select('persons.*','lead_status.name as lead_statusname')
       ->orderBy('persons.regis_date', 'DESC');
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




    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60'
    ]);
    }
}
