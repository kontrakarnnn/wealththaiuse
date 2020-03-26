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
class ServicePerController extends Controller
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

      $curfamss = service_form::all();
      $serg = Group_service::all();


          $serviceforms = DB::table('service_form')
        ->leftJoin('group_of_service', 'service_form.group_service_id', '=', 'group_of_service.id')
		->where('group_of_service.main','=','Yes')
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

    $port = DB::table('portfolio')->where('member_id',$current)->get();
    date_default_timezone_set('Asia/Bangkok');
    $d  = date('Y-m-d H:i:s');
  //  return $d;

//return $src;
/*  $images =array(
      "GIF" => "../../service/1.jpg",
      "PNG" => "../../service/1.jpg",
      "JPG" => "../../service/1.jpg"
  );

  $treefd ='<img src="'.$path.'">';
  return $treefd;*/

  /*$image =$_SERVER['DOCUMENT_ROOT'].'\service\1.jpg';
  $images =public_path('service')."\\";

//  return $images;
// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

// Echo out a sample image
//echo '<img src="' . $src . '">';*/


	  $group = Group_service::where('main','=','Yes')->get();
  $grou = Group_service::where('main','=','Yes')->value('id');
  $serv = service_Form::where('group_service_id',$grou)->get();

          return view('system-mgmt/serviceper/index', ['serv'=>$serv,'group'=>$group,'serg'=>$serg,'curfamss'=>$curfamss,'matchids'=>$matchids,'port'=>$port,'sta'=>$sta,'serviceforms' => $serviceforms,'tree'=>$tree]);
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
  date_default_timezone_set('Asia/Bangkok');
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


    //return $port;




                   $ans = "<b>".$n."</b>"." <br> "."<b>".$t1."</b>"." <br> ".$a1." ".$u1."<br> "."<br> "."<b>".$t2."</b>"." <br> ".$a2." ".$u2."<br> "." <br>"."<b>".$t3."</b>"." <br> ".
                          $a3." ".$u3."<br> "."<br> "."<b>".$t4."</b>"." <br> ".$a4." ".$u4."<br> "."<br> "."<b>".$t5."</b>"." <br> ".$a5." ".$u5 ."<br> "."<b>".$qt."</b>"." <br> ".$time." "."<br> "."<br> "
                          ."<b>".$qti."</b>"."<br> "." <br> ".$ati." "."<br> "."<b>".$qm."</b>"."<br> "." <br> ".$more." "."<br> "."<br> "."<b>".$qm."</b>"."<br> "." <br> ".$more." "."<br> ";
                          if($port != NULL){
                            $ports  = DB::table('portfolio')
                            ->where('id',$port)
                            ->value('number');
                     //return $port;


                                 $ans = "<b>".$n."</b>"." <br> "."<b>".$t1."</b>"." <br> ".$a1." ".$u1."<br> "."<br> "."<b>".$t2."</b>"." <br> ".$a2." ".$u2."<br> "." <br>"."<b>".$t3."</b>"." <br> ".
                                        $a3." ".$u3."<br> "."<br> "."<b>".$t4."</b>"." <br> ".$a4." ".$u4."<br> "."<br> "."<b>".$t5."</b>"." <br> ".$a5." ".$u5 ."<br> "."<b>".$qt."</b>"." <br> ".$time." "."<br> "."<br> "
                                        ."<b>".$qti."</b>"."<br> "." <br> ".$ati." "."<br> "."<b>".$qm."</b>"."<br> "." <br> ".$more." "."<br> "."<br> "."<b>".$qm."</b>"."<br> "." <br> ".$more." "."<br> ".$qp."</b>"." <br> ".$ports." "."<br> ";
                                      }
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
                if($reciever == NULL && $port != NULL){
                  $findport = DB::table('portfolio')
                  ->where('id',$port)
                  ->pluck('block_id');
                  $findblock = DB::table('block')
                  ->where('id',$findport)
                  ->value('default_pid');
                $noti->recieve_id = $findblock;
                }
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
                //return $noti->recieve_id;
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
	$matchids = DB::table('match_id')
                 ->where('match_id.member_id',$current)

                //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                ->value('id');
                $autore = DB::table('message_types')
                ->where('id',$mst)
                ->value('auto_reply');
                $replymes = DB::table('message_types')
                ->where('id',$mst)
                ->value('reply_mst_id');
              //  return $replymes;
                if($autore == "Yes"){
                 $reply = new Noti;
                 $reply->message_type_id = $replymes;
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
				}
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
        $view = service_form::findOrFail($id);
        $this->validateInput($request);
        $input = [

            'group_service_id' => $request['group_service_id'],
            'msg_type_id' => $request['msg_type_id'],
            'text_field1' => $request['text_field1'],
			      'text_field2' => $request['text_field2'],
			      'text_field3' => $request['text_field3'],
      'text_field4' => $request['text_field4'],
      'text_field5' => $request['text_field5'],
      'unit_field1' => $request['unit_field1'],
      'unit_field2' => $request['unit_field2'],
      'unit_field3' => $request['unit_field3'],
      'unit_field4' => $request['unit_field4'],
      'unit_field5' => $request['unit_field5'],
      'icon' => $request['icon'],


        ];
        service_form::where('id', $id)
            ->update($input);

        return redirect()->intended('/admin/serviceform');
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



        $constraints = [
            'name' => $request['name']
            ];

       $views = $this->doSearchingQuery($constraints);
       return view('system-mgmt/view/index', ['views' => $views, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = View::query();
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
      ->where('group_of_service.id' , $org)
      ->select('service_form.*','group_of_service.name as group_service_name', 'group_of_service.id as group_service_id'
                ,'message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')



           ->paginate(100);

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

       $port = DB::table('portfolio')->where('member_id',$current)->get();
       date_default_timezone_set('Asia/Bangkok');
       $d  = date('Y-m-d H:i:s');
       $whatINeed = explode('/', $_SERVER['REQUEST_URI']);
       $whatINeed = $whatINeed[3];
       $whatINeed =$whatINeed;
    //   return $whatINeed;

        $group = Group_service::where('id',$whatINeed)->get();
        $grou = Group_service::where('id',$whatINeed)->value('id');
       $serv = service_Form::where('group_service_id',$grou)->get();
      // $servi = service_Form::where('id',$whatINeed)->value('group_service_id');


      // return $whatINeed;
                     return view('system-mgmt/serviceper/filtergroup', ['group'=>$group,'serv'=>$serv,'serg'=>$serg,'curfamss'=>$curfamss,'matchids'=>$matchids,'port'=>$port,'sta'=>$sta,'serviceforms' => $serviceforms,'tree'=>$tree]);

    }

    public function listtype(Request $request){


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
      ->where('service_form.id' , $org)
      ->select('service_form.*','group_of_service.name as group_service_name', 'group_of_service.id as group_service_id'
                ,'message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')



           ->paginate(100);

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

       $port = DB::table('portfolio')->where('member_id',$current)->get();
       date_default_timezone_set('Asia/Bangkok');
       $d  = date('Y-m-d H:i:s');
       $whatINeed = explode('/', $_SERVER['REQUEST_URI']);
       $whatINeed = $whatINeed[2];
       $whatINeed =$whatINeed;

       $grou = Group_service::where('main','=','Yes')->value('id');
       $serv = service_Form::where('id',$whatINeed)->get();
       $servi = service_Form::where('id',$whatINeed)->value('group_service_id');
       $group = Group_service::where('id',$servi)->get();

      // return $whatINeed;
                     return view('system-mgmt/serviceper/filter', ['group'=>$group,'serv'=>$serv,'serg'=>$serg,'curfamss'=>$curfamss,'matchids'=>$matchids,'port'=>$port,'sta'=>$sta,'serviceforms' => $serviceforms,'tree'=>$tree]);

    }


    public function showall()
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

    $port = DB::table('portfolio')->where('member_id',$current)->get();
    date_default_timezone_set('Asia/Bangkok');
    $d  = date('Y-m-d H:i:s');


	  $group = Group_service::where('main','=','Yes')->get();
  $grou = Group_service::where('main','=','Yes')->value('id');
  $serv = service_Form::where('group_service_id',$grou)->get();

          return view('system-mgmt/serviceper/showall', ['serv'=>$serv,'group'=>$group,'serg'=>$serg,'curfamss'=>$curfamss,'matchids'=>$matchids,'port'=>$port,'sta'=>$sta,'serviceforms' => $serviceforms,'tree'=>$tree]);
    }
}
