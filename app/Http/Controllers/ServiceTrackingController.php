<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\View;
use App\Viewper;
use App\Noti;
use App\Group_service;
use App\Type_service;
use App\Message_type;
use App\service_form;
use App\Text1_service;
use App\Text2_service;
use App\Text3_service;
use App\Text4_service;
use App\Text5_service;
use Session;
class ServiceTrackingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:person', ['except' => 'findcatmsg']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      //sidebar
      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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


          $serviceforms = DB::table('service_form')
        ->leftJoin('group_of_service', 'service_form.group_service_id', '=', 'group_of_service.id')
        ->leftJoin('message_types', 'service_form.msg_type_id', '=', 'message_types.id')
        ->select('service_form.*','group_of_service.name as group_service_name', 'group_of_service.id as group_service_id'
                                      ,'message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')
        ->paginate(50);
        $session = Session::get('_previous');


    //return $this;
      // return $session;

      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
          $matchids = DB::table('match_id')
          ->where('match_id.member_id',$current)->pluck('id');

          $curstatus = DB::table('notis')->where('sender_id',$matchids)->orderBy('created_at','DESC')->latest('created_at')->first();
          $results = Noti::latest('created_at')->where('sender_id',$matchids)->value('message_type_id');
          $sta = Noti::latest('created_at')->where('sender_id',$matchids)->where('message_type_id',$results)->value('status');
        //  return $sta;
      $statuss = DB::table('message_types')->where('id','8')->value('default_status');
    //  return $statuss;
    $mst = DB::table('message_types')->where('message_cat_id' ,"=", 9)->pluck('id');
    $port = DB::table('portfolio')->where('member_id',$current)->get();
    //return $port;
    $notis = DB::table('notis')->where('sender_id',$matchids)->where('status' ,'=', "Request")->get();


    $noti = DB::table('notis')->whereIn('message_type_id',$mst)->where('sender_id',$matchids)
    ->leftjoin('message_types', 'notis.message_type_id','=', 'message_types.id')
    ->leftjoin('match_id','notis.sender_id' ,'=', 'match_id.id')
    ->leftjoin('match_id as r','notis.recieve_id' ,'=', 'r.id')
    ->select('notis.*','match_id.public_name as sender_name', 'match_id.id as sender_id','r.public_name as recieve_name', 'r.id as recieve_id',
              'message_types.message_template as service_name', 'message_types.id as service_id')
    ->get();

  //  $service = DB::table('service_form')->whereIn('msg_type_id',$noti)->pluck('name');
  //return $noti;
  $groups =Group_service::all();
  $serg = Group_service::all();

          return view('system-mgmt/servicetracking/index', ['serg'=>$serg,'groups'=>$groups,'noti'=>$noti,'tree'=>$tree]);
    }

	public function childView($view){



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
}



    public function sentservice(Request $request){
      //  $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
    //  $ew = $request->ew;
    //  $dw =$request->dw;
  //    $mer = $ew."<br>".$dw;
  $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
      $matchids = DB::table('match_id')
      ->where('match_id.member_id',$current)

     //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

     ->value('id');
     $curciti = DB::table('match_id')
     ->where('match_id.member_id',$current)

    //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

    ->value('sender_citizen');
     $sn =$request->sn;
     $qt  =$request->qt;
     $qti  =$request->qti;
     $ati  =$request->ati;
     $time  =$request->time;
     $t1 =$request->t1;
     $u1 =$request->u1;
     $t2 =$request->t2;
     $u2 =$request->u2;
     $t3 =$request->t3;
     $u3 =$request->u3;
     $t4 =$request->t4;
     $u4 =$request->u4;
     $t5 =$request->t5;
     $u5 =$request->u5;

     $a1 = $request->a1;
     $a2 = $request->a2;
     $a3 = $request->a3;
     $a4 = $request->a4;
     $a5 = $request->a5;
     $qm = $request->qm;
     $n = $request->n;
     $reciever = $request->recieve_id;
     $citi = $request->citi;
     $mst = $request->mst;
     $more =$request->more;
     $port =$request->port;
     $qp = $request->qp;
     if($request->port == NULL){
       $ans = "<b>".$n."</b>"." <br> "."<b>".$t1."</b>"." <br> ".$a1." ".$u1."<br> "."<b>".$t2."</b>"." <br> ".$a2." ".$u2." <br>"."<b>".$t3."</b>"." <br> ".
              $a3." ".$u3."<br> "."<b>".$t4."</b>"." <br> ".$a4." ".$u4."<br> "."<b>".$t5."</b>"." <br> ".$a5." ".$u5 ."<b>".$qt."</b>"." <br> ".$time." "."<br> "
              ."<b>".$qti."</b>"." <br> ".$ati." "."<br> "."<b>".$qm."</b>"." <br> ".$more." "."<br> "."<b>".$qm."</b>"." <br> ".$more." "."<br> ";
     }
            $ans = "<b>".$n."</b>"." <br> "."<b>".$t1."</b>"." <br> ".$a1." ".$u1."<br> "."<b>".$t2."</b>"." <br> ".$a2." ".$u2." <br>"."<b>".$t3."</b>"." <br> ".
                   $a3." ".$u3."<br> "."<b>".$t4."</b>"." <br> ".$a4." ".$u4."<br> "."<b>".$t5."</b>"." <br> ".$a5." ".$u5 ."<b>".$qt."</b>"." <br> ".$time." "."<br> "
                   ."<b>".$qti."</b>"." <br> ".$ati." "."<br> "."<b>".$qm."</b>"." <br> ".$more." "."<br> "."<b>".$qp."</b>"." <br> ".$port." "."<br> ";

      $noti = new Noti;
                $noti->message_type_id = $mst;
                $noti->message = $ans;
              //  $noti->topic = $request-> dw;
              if($citi != NULL){
                $noti->sender_note  = $curciti;
              }
            //  $curid = $noti->sender_note;
                //$noti->status = $request-> status;
                $noti->sender_id  = $matchids;
                $statuss = DB::table('message_types')->where('id',$mst)->value('default_status');
                $noti->status  = $statuss;
                //$noti->created_by = 1;
                $noti->recieve_id = $reciever;
                $messagetypesde = DB::table('message_types')
                ->where('message_types.id',$mst)
                ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                ->value('default_recieve_id');
                $noti->cc_reciever1 = $request-> cc_reciever1 ;
                $noti->cc_reciever2 = $request-> cc_reciever2 ;
                $noti->cc_reciever3 = $request-> cc_reciever3 ;
                $noti->created_by = $matchids ;
                $noti->created_by = $request-> created_by ;

                if($noti->recieve_id == NULL){
                  $noti->recieve_id = $messagetypesde;

                }

                $noti->save();
                $curid = $noti->sender_note;
                $currentid =$noti->recieve_id;

                $matchids = DB::table('match_id')
                ->where('match_id.id',$currentid)
                ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                ->pluck('public_email');

                $currentsender =$noti->sender_id;

                $cursender = DB::table('match_id')
                ->where('match_id.id',$currentsender)
                ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
                ->get();
                //->pluck('public_email');

                $curren = $noti->sender_id;

                $sender = DB::table('notis as d')

                ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

                ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
                ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
                ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
                ->where('d.sender_id',$curren)


                ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

                ->get();


                //->pluck('public_email');

                $currenre = $noti->recieve_id;
                $reciever = DB::table('notis as d')

                ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

                ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
                ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
                ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
                ->where('d.sender_id',$currenre)


                ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

                ->get();


                $current =$noti->message_type_id;
                $messagetypes = DB::table('message_types')
                ->where('message_types.id',$current)
                ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')

                //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                //->pluck('message_template');
                ->get();


                $matchids = $matchids->toArray();
                //$input = $request->all();

                $cursender = $cursender->toArray();

                //  $mem = $this->$input->toArray();
                $noid = $noti->id;
                 Mail::send('emails.service',compact('messagetypes','sender','ans','citi','curid','reciever','cursender','noid'),function($message) use ($matchids,$messagetypes,$cursender){
                   foreach ($cursender as $cursen) {

                   $message->from($cursen->public_email);
                      }
                   $message->to($matchids);

                   foreach ($messagetypes as $messages) {
                   $message->subject($messages->message_template);
                   }
                 });

                 $matchids = DB::table('match_id')
                 ->where('match_id.member_id',$current)

                //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                ->value('id');

                 $reply = new Noti;
                 $reply->message_type_id = 8;
                 $reply->topic = $request-> topic;
                 $reply->message = $request-> message;
                 $reply->reflink = $request-> reflink;
                 $reply->sender_note = $request-> sender_note;
                 $reply->reciever_note = $request-> reciever_note ;

                 $reply->status = $statuss;
                 $reply->sender_id =  1;
                 $reply->recieve_id = $noti->sender_id ;
                 $currentmst =$reply->message_type_id;

                 $messagetypreply = DB::table('message_types')
                 ->where('message_types.id',$currentmst)
                 ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                 ->value('default_recieve');

                //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                //->pluck('message_template');
                  //->first();
                  $reply->cc_reciever1 = $request-> cc_reciever1 ;
                  $reply->cc_reciever2 = $request-> cc_reciever2 ;
                  $reply->cc_reciever3 = $request-> cc_reciever3 ;
                  $reply->created_by =  1 ;
                  $reply->reply_msg = $noti->id ;

                 // $messagetypesde = $messagetypesde->toArray();
                  //dd($messagetypesde);
                 if($reply->recieve_id == NULL){
                   $reply->recieve_id = $messagetypesde;

                 }



                 $reply->save();

                 $currentmt =$reply->message_type_id;
                 $messagetyperep = DB::table('message_types')
                 ->where('message_types.id',$currentmt)
                 ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                 ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')

                 //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                 //->pluck('message_template');
                  ->get();

                 //  $mem = $this->$input->toArray();

                 $currentidss =$reply->recieve_id;

                 $matchidsss = DB::table('match_id')
                 ->where('match_id.id',$currentidss)
                 ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                 ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                 //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                 ->pluck('public_email');
                 $pname = DB::table('match_id')
                 ->where('match_id.id',$currentidss)


                 //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                 ->get();
                // dd($pname);

                 $currentsenderss =$reply->recieve_id;

                 $cursenderss = DB::table('match_id')
                 ->where('match_id.id',$currentsenderss)
                 ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
                ->get();


                $currennn = $reply->sender_id;

                $senderrr = DB::table('notis as d')

                ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

                ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
                ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
                ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
                ->where('d.sender_id',$currennn)


               ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

               ->get();

                $matchidsss = $matchidsss->toArray();
                //$input = $request->all();

                $cursenderss = $cursenderss->toArray();
                   Mail::send('emails.reply',compact('messagetyperep','senderrr','pname'),function($message) use ($matchidsss,$messagetyperep,$cursenderss){
                     foreach ($cursenderss as $cursen) {

                     $message->from($cursen->public_email);
                        }
                     $message->to($matchidsss);

                     foreach ($messagetyperep as $messages) {
                     $message->subject($messages->message_template);
                     }
                   });
    //  dd($mer);
 //return $mer;
 //return $citi;
 $request->session()->flash('alert-success', 'การร้องขอบริการของท่านสำเร็จแล้ว!! โปรดรอพนักงานติดต่อกลับ ');
      return redirect()->back();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		 //sidebar

	$current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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




        //$views = View::all();

        $groups = Group_service::all();
        $types = Message_type::all();

        return view('system-mgmt/serviceform/create',['types' => $types,'groups' => $groups,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      Group_service::findOrFail($request['group_service_id']);
      Message_type::findOrFail($request['msg_type_id']);

      $service = new service_form;
      $service->group_service_id = $request-> group_service_id ;
      $service->msg_type_id = $request-> msg_type_id;
      $service->name = $request-> name;
      $service->text_field1 = $request-> text_field1;
      $service->unit_field1 = $request-> unit_field1;
      $service->text_field2 = $request-> text_field2;
      $service->unit_field2 = $request-> unit_field2;
      $service->text_field3 = $request-> text_field3;
      $service->unit_field3 = $request-> unit_field3;
      $service->text_field4 = $request-> text_field4;
      $service->unit_field4 = $request-> unit_field4;
      $service->text_field5 = $request-> text_field5 ;
      $service->unit_field5 = $request-> unit_field5;
      $service->icon = $request-> icon;
      $service->save();




       return redirect()->intended('/admin/serviceform');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $blocks = View::find($id)->portfolio;
      $views = Vew::paginate(5);
      return view('/view/index', compact(['views','blocks']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
$current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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
		

        $view =service_form::find($id);
		$views =service_form::all();
        // Redirect to department list if updating department wasn't existed
        if ($view == null) {
          $view = service_form::find($id);
          $data = array(
              'view' => $view
            );
            return redirect()->intended('/admin/service');
        }

      $group = Group_service::all();
      $type = Message_type::all();
      $text1 =  Text1_service::all();
      $text2 =  Text2_service::all();
      $text3 =   Text3_service::all();
      $text4 = Text4_service::all();
      $text5 = Text5_service::all();

        return view('system-mgmt/serviceform/edit', ['group' => $group,
                                                        'type' => $type,'text1' => $text1,
                                                        'text2' => $text2,'text3' => $text3,
                                                        'text4' => $text4,'text5' => $text5,'view' => $view,
                                                        'views' => $views,'tree'=>$tree]);
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
         $noti = Noti::findOrFail($id);
         $noti = Noti::find($id);
         $noti->message_type_id=$noti-> message_type_id;
         $noti->topic=$noti-> topic;
         $noti->message=$noti-> message;
         $noti->reflink=$noti-> reflink;
         $noti->sender_note=$noti-> sender_note;
         $noti->reciever_note =$noti->reciever_note;
         $noti->status=$request-> status;
         $noti->sender_id =$noti->sender_id;
         $noti->recieve_id =$noti->recieve_id;
         $noti->cc_reciever1 =$noti->cc_reciever1;
         $noti->cc_reciever2 =$noti->cc_reciever2;
         $noti->cc_reciever3 =$noti->cc_reciever3;
         $noti->created_by =$noti->created_by;
         $currentsender =$noti->sender_id;

         $cursender = DB::table('match_id')
         ->where('match_id.id',$currentsender)
         ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

         ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

         ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
         ->get();

         $current =$noti->message_type_id;
         $messagetypes = DB::table('message_types')
         ->where('message_types.id',$current)
         ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
         ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')

         //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

         //->pluck('message_template');
         ->get();
         $currentid =$noti->recieve_id;
         $matchids = DB::table('match_id')
         ->where('match_id.id',$currentid)
         ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

         ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

         //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

         ->pluck('public_email');
         $noid = $noti->id;
         $currenre = $noti->recieve_id;
         $reciever = DB::table('notis as d')

         ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

         ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
         ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
         ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
         ->where('d.sender_id',$currenre)


         ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

         ->get();
         $matchids = $matchids->toArray();
         //$input = $request->all();

         $cursender = $cursender->toArray();
        // return $matchids;
         Mail::send('emails.statustell',compact('messagetypes','sender','ans','citi','curid','reciever','cursender','noid'),function($message) use ($matchids,$messagetypes,$cursender){
           foreach ($cursender as $cursen) {

           $message->from($cursen->public_email);
              }
           $message->to($matchids);

           foreach ($messagetypes as $messages) {
           $message->subject($messages->message_template);
           }
         });
         $noti->save();
         //<a href="http://localhost:8000/MessageCenter/noti/show/{{$noid}}">http://localhost:8000/MessageCenter/noti/show/{{$noid}} </a></p>
         $ans2 ='มีการเปลี่ยนสถานะของการร้องขอบริการ โดยท่านสามารถเข้าไปดูรายละเอียดได้โดย  <a  href ="https://erp.wealththai.net/MessageCenter/noti/show/'.$noid.'">"คลิกที่นี่"</a>';

         $notis = new Noti;
                   $notis->message_type_id =$noti-> message_type_id;
                   $notis->message = $ans2;
                   $notis->reflink=$noti-> reflink;
                   $notis->sender_note=$noti-> sender_note;
                   $notis->reciever_note =$noti->reciever_note;
                   $notis->status=$request-> status;
                   $notis->sender_id =1;
                   $notis->recieve_id =$noti->recieve_id;
                   $notis->cc_reciever1 =$noti->cc_reciever1;
                   $notis->cc_reciever2 =$noti->cc_reciever2;
                   $notis->cc_reciever3 =$noti->cc_reciever3;
                   $notis->created_by =1;

                   $notis->save();




 $request->session()->flash('alert-success', 'เปลี่ยนสถานะเรียบร้อยแล้ว!!  ');
      return redirect()->back();

         return redirect()->back();
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        service_form::where('id', $id)->delete();
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
      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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
      $groups =Group_service::all();


        $constraints = [
           'match_id.public_name' => $request['reciever_name'],
        //    'match_id as r.public_name ' => $request['reciever_name'],
            'message_types.message_template' => $request['service_name'],
            'sender_id' => $request['sender_id'],
            'recieve_id' => $request['recieve_id'],
            'from' => $request['from'],
            'to' => $request['to'],
            ];

       $noti = $this->doSearchingQuery($constraints);
    //  $constraints['sender_name'] = $request['sender_name'];
       $constraints['reciever_name'] = $request['reciever_name'];
       $constraints['service_name'] = $request['service_name'];
       $groups =Group_service::all();
       $serg = Group_service::all();
       return view('system-mgmt/servicetracking/index', ['serg' => $serg,'groups' => $groups,'noti' => $noti, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {

      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
          $matchids = DB::table('match_id')
          ->where('match_id.member_id',$current)->pluck('id');

          $curstatus = DB::table('notis')->where('sender_id',$matchids)->orderBy('created_at','DESC')->latest('created_at')->first();
          $results = Noti::latest('created_at')->where('sender_id',$matchids)->value('message_type_id');
          $sta = Noti::latest('created_at')->where('sender_id',$matchids)->where('message_type_id',$results)->value('status');
        //  return $sta;
      $statuss = DB::table('message_types')->where('id','8')->value('default_status');
    //  return $statuss;
    $mst = DB::table('message_types')->where('message_cat_id' ,"=", 9)->pluck('id');
    $port = DB::table('portfolio')->where('member_id',$current)->get();
    //return $port;
    $notis = DB::table('notis')->where('sender_id',$matchids)->where('status' ,'=', "Request")->get();

    $query = DB::table('notis')->whereIn('message_type_id',$mst)->where('sender_id',$matchids)
    ->leftjoin('message_types', 'notis.message_type_id','=', 'message_types.id')
    ->leftjoin('match_id','notis.sender_id' ,'=', 'match_id.id')
    ->leftjoin('match_id as r','notis.recieve_id' ,'=', 'r.id')
    ->select('notis.*','match_id.public_name as sender_name', 'match_id.id as sender_id','r.public_name as recieve_name', 'r.id as recieve_id',
              'message_types.message_template as service_name', 'message_types.id as service_id');


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
        //'name' => 'unique:views',
      //  'select_file'  => 'required|image|mimes:jpg,png,gif|max:2048'
    ]);
    }
    public function searchinbox(Request $request) {

      //sidebar
      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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
      $groups =Group_service::all();

        $constraints = [
            'from' => $request['from'],
            'to' => $request['to'],
            'message_types.message_template' => $request['service_name'],
      'sender_name' => $request['sender_name'],
        ];

        $groups =Group_service::all();
        $serg = Group_service::all();

        $noti = $this->getHiredEmployeesinbox($request,$constraints);

        return view('system-mgmt/servicetracking/index', ['serg'=>$serg,'groups'=>$groups,'tree'=>$tree,'noti' => $noti, 'searchingVals' => $constraints]);
    }


    private function getHiredEmployeesinbox($constraints) {


          $serviceforms = DB::table('service_form')
        ->leftJoin('group_of_service', 'service_form.group_service_id', '=', 'group_of_service.id')
        ->leftJoin('message_types', 'service_form.msg_type_id', '=', 'message_types.id')
        ->select('service_form.*','group_of_service.name as group_service_name', 'group_of_service.id as group_service_id'
                                      ,'message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')
        ->paginate(50);
        $session = Session::get('_previous');


      //return $this;
      // return $session;

      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
          $matchids = DB::table('match_id')
          ->where('match_id.member_id',$current)->pluck('id');

          $curstatus = DB::table('notis')->where('sender_id',$matchids)->orderBy('created_at','DESC')->latest('created_at')->first();
          $results = Noti::latest('created_at')->where('sender_id',$matchids)->value('message_type_id');
          $sta = Noti::latest('created_at')->where('sender_id',$matchids)->where('message_type_id',$results)->value('status');
        //  return $sta;
      $statuss = DB::table('message_types')->where('id','8')->value('default_status');
      //  return $statuss;
      $mst = DB::table('message_types')->where('message_cat_id' ,"=", 9)->pluck('id');
      $port = DB::table('portfolio')->where('member_id',$current)->get();
      //return $port;
      $notis = DB::table('notis')->where('sender_id',$matchids)->where('status' ,'=', "Request")->get();


      $noti = DB::table('notis')->whereIn('message_type_id',$mst)->where('sender_id',$matchids)
      ->leftjoin('message_types', 'notis.message_type_id','=', 'message_types.id')
      ->leftjoin('match_id','notis.sender_id' ,'=', 'match_id.id')
      ->leftjoin('match_id as r','notis.recieve_id' ,'=', 'r.id')
      ->where('notis.created_at', '>=', $constraints['from'])
      ->where('notis.created_at', '<=', $constraints['to'])
      ->select('notis.*','match_id.public_name as sender_name', 'match_id.id as sender_id','r.public_name as recieve_name', 'r.id as recieve_id',
                'message_types.message_template as service_name', 'message_types.id as service_id')

            ->get();

        return $noti;
    }

    public function findservice(Request $request){
      $data=service_form::select('name','id')->where('group_service_id',$request->id)->take(100)->get();
      return response()->json($data);
    }

    public function listservice(Request $request){


      //sidebar
      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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


            $org = $request->org;

          //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
              $curfamss = service_form::all();
              $serg = Group_service::all();

              $serviceforms = DB::table('service_form')
              ->leftJoin('group_of_service', 'service_form.group_service_id', '=', 'group_of_service.id')
              ->leftJoin('message_types', 'service_form.msg_type_id', '=', 'message_types.id')
              ->select('service_form.*','group_of_service.name as group_service_name', 'group_of_service.id as group_service_id'
                                          ,'message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')
              ->paginate(50);
              $session = Session::get('_previous');


              //return $this;
              // return $session;

              $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
              $matchids = DB::table('match_id')
              ->where('match_id.member_id',$current)->pluck('id');

              $curstatus = DB::table('notis')->where('sender_id',$matchids)->orderBy('created_at','DESC')->latest('created_at')->first();
              $results = Noti::latest('created_at')->where('sender_id',$matchids)->value('message_type_id');
              $sta = Noti::latest('created_at')->where('sender_id',$matchids)->where('message_type_id',$results)->value('status');
              //  return $sta;
              $statuss = DB::table('message_types')->where('id','8')->value('default_status');
              //  return $statuss;
              $mst = DB::table('message_types')->where('message_cat_id' ,"=", 9)->pluck('id');
              $port = DB::table('portfolio')->where('member_id',$current)->get();
              //return $port;
              $notis = DB::table('notis')->where('sender_id',$matchids)->where('status' ,'=', "Request")->get();




              $noti = DB::table('notis')->whereIn('message_type_id',$mst)->where('sender_id',$matchids)
              ->leftjoin('message_types', 'notis.message_type_id','=', 'message_types.id')
              ->where('message_types.message_template' , $org)
                ->leftjoin('match_id','notis.sender_id' ,'=', 'match_id.id')
              ->leftjoin('match_id as r','notis.recieve_id' ,'=', 'r.id')
              ->select('notis.*','match_id.public_name as sender_name', 'match_id.id as sender_id','r.public_name as recieve_name', 'r.id as recieve_id',
                        'message_types.message_template as service_name', 'message_types.id as service_id')
              ->get();

              //  $service = DB::table('service_form')->whereIn('msg_type_id',$noti)->pluck('name');
              //return $noti;
              $groups =Group_service::all();
              $serg = Group_service::all();

              return view('system-mgmt/servicetracking/index', ['serg'=>$serg,'groups'=>$groups,'noti'=>$noti,'tree'=>$tree]);

    }


    public function groupservice(Request $request){


      //sidebar
      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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


            $org = $request->org;

          //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
              $curfamss = service_form::all();
              $serg = Group_service::all();

              $serviceforms = DB::table('service_form')
              ->leftJoin('group_of_service', 'service_form.group_service_id', '=', 'group_of_service.id')
              ->leftJoin('message_types', 'service_form.msg_type_id', '=', 'message_types.id')
              ->select('service_form.*','group_of_service.name as group_service_name', 'group_of_service.id as group_service_id'
                                          ,'message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')
              ->paginate(50);
              $session = Session::get('_previous');


              //return $this;
              // return $session;

              $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
              $matchids = DB::table('match_id')
              ->where('match_id.member_id',$current)->pluck('id');

              $curstatus = DB::table('notis')->where('sender_id',$matchids)->orderBy('created_at','DESC')->latest('created_at')->first();
              $results = Noti::latest('created_at')->where('sender_id',$matchids)->value('message_type_id');
              $sta = Noti::latest('created_at')->where('sender_id',$matchids)->where('message_type_id',$results)->value('status');
              //  return $sta;
              $statuss = DB::table('message_types')->where('id','8')->value('default_status');
              //  return $statuss;
              $mst = DB::table('message_types')->where('message_cat_id' ,"=", 9)->pluck('id');
              $port = DB::table('portfolio')->where('member_id',$current)->get();
              //return $port;
              $notis = DB::table('notis')->where('sender_id',$matchids)->where('status' ,'=', "Request")->get();


              $noti = DB::table('notis')->whereIn('message_type_id',$mst)->where('sender_id',$matchids)
              ->leftjoin('message_types', 'notis.message_type_id','=', 'message_types.id')
              ->where('message_types.message_template' , $org)
              ->leftjoin('match_id','notis.sender_id' ,'=', 'match_id.id')
              ->leftjoin('match_id as r','notis.recieve_id' ,'=', 'r.id')
              ->select('notis.*','match_id.public_name as sender_name', 'match_id.id as sender_id','r.public_name as recieve_name', 'r.id as recieve_id',
                        'message_types.message_template as service_name', 'message_types.id as service_id')
              ->get();

              //  $service = DB::table('service_form')->whereIn('msg_type_id',$noti)->pluck('name');
              //return $noti;
              $groups =Group_service::all();
              $serg = Group_service::all();

              return view('system-mgmt/servicetracking/index', ['serg'=>$serg,'groups'=>$groups,'noti'=>$noti,'tree'=>$tree]);

    }
	
	    public function findcatmsg(Request $request){
      $data=Message_type::select('message_template','id')->where('message_cat_id',$request->id)->take(100)->get();
      return response()->json($data);
      //return view('system-mgmt/serviceper/index', ['serg'=>$serg,
    //  return $data=service_form::select('name','id')->where('group_service_id',$request->id)->take(100)->get();
    }
}
