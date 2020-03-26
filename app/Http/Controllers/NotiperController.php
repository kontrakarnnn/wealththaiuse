<?php

namespace App\Http\Controllers;
use Mail;
use App\Classes\PersonClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PersonController;
use App\User;
use App\Person;
use App\Noti;
use App\Message_type;
use App\match_id;
use App\Viewper;
use Session;
class NotiperController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
         {
             $this->middleware('auth:person');
         }


    public function index()
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


	$currents = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $curren = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'member_id', '=',$currents

                       )
                       ->get();
      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'member_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')

  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
  ->whereIn('d.sender_id',$currentid)
  ->orwhereIn('d.recieve_id',$currentid)


  ->select('d.*','d.id', 'au.public_name as sender_name', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' ,'message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);



//return $views;

  return view('system-mgmt/notiper/index', ['notis' => $notis,'curren' => $curren,'tree' =>$tree]);
    }

    public function childView($view,$viewss){






          $html ='<ul class="treeview-menu">';
          foreach ($view->childs as $arr) {

              if(count($arr->childs) && in_array($arr->id, $viewss) && $view->add_to_side == "Yes"){

              $html .='<li> <a  href ="'.$arr->view_url.'"class=""><i class="fa fa-link"></i>'.$arr->name.'   <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                      </span></a> ';
                      $html.= $this->childView($arr,$viewss);


                  }elseif($view->add_to_side == "Yes" && in_array($arr->id, $viewss)){

                      $html .='<li class="treeview"><a href ="'.$arr->view_url.'"class="">'.$arr->name.'  </a>' ;
                      $html .="</li>";

                  }

          }
          $html .="</ul>";

          return $html;
  }


    public function inbox()
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



	$currents = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $curren = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'member_id', '=',$currents

                       )
                       ->get();
      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'member_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')
  //->whereNotIn('d.created_by',$currentid)
  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
  ->whereIn('d.recieve_id',$currentid)
 ->whereNotIn('d.created_by', [1])

  ->select('d.*','d.id', 'au.public_name as sender_name', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' ,'message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);
  return view('system-mgmt/notiper/inbox', ['notis' => $notis,'curren' => $curren,'tree' =>$tree]);
    }

    public function sentbox()
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



	$currents = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $curren = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'member_id', '=',$currents

                       )
                       ->get();
      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'member_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')
 // ->whereIn('d.created_by',$currentid)
  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
  ->whereIn('d.sender_id',$currentid)
 //->whereNotIn('d.created_by', [1])

  ->select('d.*','d.id', 'au.public_name as sender_name', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' ,'message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);
  return view('system-mgmt/notiper/sentbox', ['notis' => $notis,'curren' => $curren,'tree' =>$tree]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
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



       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'member_id', '=',$current

                        )
                        ->get();

       $matchids = match_id::all();
       $messagetypes = message_type::where('message_cat_id','=',12)->get();

       //return $currentid;
        return view('system-mgmt/notiper/create', [ 'currentid' =>$currentid,'messagetypes' => $messagetypes,'matchids' => $matchids,'tree' =>$tree]);

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


       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
      $noti = new Noti;
      $noti->message_type_id = $request-> message_type_id;
      $noti->topic = $request-> topic;
      $noti->message = $request-> message;
      $noti->reflink = $request-> reflink;
      $noti->sender_note = $request-> sender_note;
      $noti->reciever_note = $request-> reciever_note ;
      $noti->status = $request-> status;
      $noti->sender_id = $request-> sender_id;
      $noti->recieve_id = $request-> recieve_id ;
      $current =$noti->message_type_id;

      $messagetypesde = DB::table('message_types')
      ->where('message_types.id',$current)
      ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
      ->value('default_recieve');
      $noti->cc_reciever1 = $request-> cc_reciever1 ;
      $noti->cc_reciever2 = $request-> cc_reciever2 ;
      $noti->cc_reciever3 = $request-> cc_reciever3 ;
      $noti->created_by = $request-> created_by ;

      if($noti->recieve_id == NULL){
        $noti->recieve_id = $messagetypesde;

      }


      $noti->save();


      $currentid =$noti->recieve_id;

      $matchids = DB::table('match_id')
      ->where('match_id.id',$currentid)
      ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

     ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

     //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

     ->pluck('public_email');

     //dd($matchids);

     $currentsender =$noti->created_by;

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


    ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

    ->get();
    //->pluck('public_email');


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
     $messages = $request->message;
       Mail::send('emails.noti',compact('messages','messagetypes','sender'),function($message) use ($matchids,$messagetypes,$cursender){
         foreach ($cursender as $cursen) {

         $message->from($cursen->public_email);
            }
         $message->to($matchids);

         foreach ($messagetypes as $messages) {
         $message->subject($messages->message_template);
         }
       });


       $currentid =Auth::id();
       $matchids = DB::table('match_id')
       ->where('match_id.member_id',$currentid)

      //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

      ->value('id');
      $autore = DB::table('message_types')
      ->where('id',$request->message_type_id)
      ->value('auto_reply');
      $replymes = DB::table('message_types')
      ->where('id',$request->message_type_id)
      ->value('reply_mst_id');
       //return $autore;
       if($autore == "Yes"){

         $reply = new Noti;
         $reply->message_type_id = $replymes ;
         $reply->topic = $request-> topic;
         $reply->message = $request-> message;
         $reply->reflink = $request-> reflink;
         $reply->sender_note = $request-> sender_note;
         $reply->reciever_note = $request-> reciever_note ;
         $reply->status = $request-> status;
         $reply->sender_id =  1;
         $reply->recieve_id = $request-> sender_id ;

         $currents =$reply->message_type_id;

         $messagetypesde = DB::table('message_types')
         ->where('message_types.id',$currents)
         ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
         ->value('default_recieve_id');

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
           Mail::send('emails.replymes',compact('messagetyperep','senderrr','pname'),function($message) use ($matchidsss,$messagetyperep,$cursenderss){
             foreach ($cursenderss as $cursen) {

             $message->from($cursen->public_email);
                }
             $message->to($matchidsss);

             foreach ($messagetyperep as $messages) {
             $message->subject($messages->message_template);
             }
           });
         }


         return redirect()->intended('/system-management/notiper');
     }

     public function notifications($noti)
        {
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
           Mail::send('emails.notimarketing',compact('messagetypes','sender'),function($message) use ($matchids,$messagetypes,$cursender){
             foreach ($cursender as $cursen) {

             $message->from($cursen->public_email);
                }
             $message->to($matchids);

             foreach ($messagetypes as $messages) {
             $message->subject($messages->message_template);
             }
           });
        }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
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


          $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'member_id', '=',$current

                        )
                        ->get();


       $matchids = match_id::all();
       $messagetypes = message_type::all();
       $current = Auth::user()->id;

       $curmatch = DB::table('match_id')
                   ->where('member_id','=',$current)
                   ->pluck('id');
                   $curmatch  =$curmatch->toArray();
       $curmem = DB::table('notis')

              ->whereIn('sender_id',$curmatch)
		   	  ->orwhereIn('recieve_id',$curmatch)

                     ->pluck('id');
                     $curmem = $curmem->toArray();
       $portfolio = Noti::find($id);
       $number = [123, 713, 3];
       // Redirect to city list if updating city wasn't existed
       //if ($id == $number )
         if(in_array($id, $curmem)){
           $notis = DB::table('notis as d')
           ->where('d.id',$id)
           ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

           ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
           ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
           ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')



          ->select('d.*','d.id', 'au.public_name as sender_name', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' ,'message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

          ->get();
         $data = array(
             'notis' => $notis,


         );
          return view('system-mgmt/notiper/show',[ 'currentid' =>$currentid,'notis' =>$notis, 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree' =>$tree])->with('id',$id);


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
         $noti = Noti::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($noti == null) {
           $noti = Noti::find($id);
           $data = array(
               'noti' => $noti
             );
             return redirect()->intended('/system-management/notiper');
           }


           $matchids = match_id::all();
           $messagetypes = match_id::all();

         return view('system-mgmt/notiper/edit', ['noti' => $noti,'matchids' => $matchids,'messagetypes' => $messagetypes]);
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
         $input = [
           'message_type_id' => $request['message_type_id'],
           'topic' => $request['topic'],
           'message' => $request['message'],
           'reflink' => $request['reflink'],
           'sender_note' => $request['sender_note'],
           'reciever_note' => $request['reciever_note'],
           'status' => $request['status'],
           'sender_id' => $request['sender_id'],
           'recieve_id' => $request['recieve_id']

         ];
         $this->validate($request, [

         ]);
         Noti::where('id', $id)
             ->update($input);

         return redirect()->intended('system-management/notiper');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Noti::where('id', $id)->delete();
          return redirect()->intended('system-management/notiper');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */
     public function search(Request $request) {
          $constraints = [
            'message_type_id' => $request['message_type_id'],
            'message' => $request['message'],
            'sender_note' => $request['sender_note'],
            'reciever_note' => $request['reciever_note'],
            'status' => $request['status'],
            'sender_id' => $request['sender_id'],
            'recieve_id' => $request['recieve_id']



             ];

        $notis = $this->doSearchingQuery($constraints);

        $constraints['user_name'] = $request['user_name'];
        $constraints['member_name'] = $request['member_name'];
        return view('system-mgmt/notiper/index', ['notis' => $notis, 'searchingVals' => $constraints]);
     }

     private function doSearchingQuery($constraints) {
                $query = DB::table('notis')
                ->leftJoin('message_types', 'notis.message_type_id', '=', 'message_types.id')
                ->leftJoin('match_id', 'notis.sender_id', '=', 'match_id.id')

               ->leftJoin('match_id', 'notis.recieve_id', '=', 'match_id.id')

               ->select('notis.*','notis.id', 'match_id.public_name as sender_name', 'match_id.id as sender_id','match_id.public_name as recieve_name', 'match_id.id as recieve_id' ,'message_types.name as message_type_name', 'message_types.id as message_type_id');



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


     ]);
     }

	 public function forward($id)
     {
		 date_default_timezone_set('Asia/Bangkok');

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

         /*$portfolio = Portfolio::find($id);
         // Redirect to city list if updating city wasn't existed
         if ($portfolio == null) {
           $portfolio = Portfolio::find($id);
           $data = array(
               'portfolio' => $portfolio
           );

         }*/
       /*  $u = Auth::user()->id;
         $user = DB::table('portfolio')

                 ->where(//[ 'structure_id', '=',9 ],
                           'member_id', '=',$u

                        )
                        ->pluck('id');
                    $user = $user->toArray();*/
                    $current = Auth::user()->id;


                   // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
                      $currentid = DB::table('match_id')

                              ->where(//[ 'structure_id', '=',9 ],
                                        'member_id', '=',$current

                                     )
                                     ->get();


                    $matchids = match_id::all();
                    $messagetypes = message_type::where('message_cat_id',12)->get();
                    $current = Auth::user()->id;

                    $curmatch = DB::table('match_id')
                                ->where('member_id','=',$current)
                                ->pluck('id');
                                $curmatch  =$curmatch->toArray();
                    $curmem = DB::table('notis')

                           ->whereIn('sender_id',$curmatch)
                           ->orwhereIn('recieve_id',$curmatch)

                                  ->pluck('id');
                                  $curmem = $curmem->toArray();
                    $portfolio = Noti::find($id);
                    $number = [123, 713, 3];
                    // Redirect to city list if updating city wasn't existed
                    //if ($id == $number )
                      if(in_array($id, $curmem)){
                      $noti = Noti::find($id);
                      $data = array(
                          'noti' => $noti,
                          'matchids' => $matchids,
                          'messagetypes' => $messagetypes,
                          'currentid' => $currentid

                      );
                       return view('system-mgmt/notiper/forward',[ 'currentid' =>$currentid,'noti' =>$noti, 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree' =>$tree])->with('id',$id);


                    }
                     return view('error');

             //       $data = Hash::make($id);
         //$portfolio = DB::table('portfolio')->where('id',$id)->first();

       //return $data;
     //  return view('person/notebook',compact('portfolio'))->with('id',$id);
     }

	public function reply($id)
     {
		date_default_timezone_set('Asia/Bangkok');

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

         /*$portfolio = Portfolio::find($id);
         // Redirect to city list if updating city wasn't existed
         if ($portfolio == null) {
           $portfolio = Portfolio::find($id);
           $data = array(
               'portfolio' => $portfolio
           );

         }*/
       /*  $u = Auth::user()->id;
         $user = DB::table('portfolio')

                 ->where(//[ 'structure_id', '=',9 ],
                           'member_id', '=',$u

                        )
                        ->pluck('id');
                    $user = $user->toArray();*/
                    $current = Auth::user()->id;


                   // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
                      $currentid = DB::table('match_id')

                              ->where(//[ 'structure_id', '=',9 ],
                                        'member_id', '=',$current

                                     )
                                     ->get();


                    $matchids = match_id::all();
                    $messagetypes = message_type::where('message_cat_id',12)->get();
                    $current = Auth::user()->id;

                    $curmatch = DB::table('match_id')
                                ->where('member_id','=',$current)
                                ->pluck('id');
                                $curmatch  =$curmatch->toArray();
                    $curmem = DB::table('notis')

                           ->whereIn('sender_id',$curmatch)
                           ->orwhereIn('recieve_id',$curmatch)

                                  ->pluck('id');
                                  $curmem = $curmem->toArray();
                    $portfolio = Noti::find($id);
                    $number = [123, 713, 3];
                    // Redirect to city list if updating city wasn't existed
                    //if ($id == $number )
                      if(in_array($id, $curmem)){
                      $noti = Noti::find($id);
                      $data = array(
                          'noti' => $noti,
                          'matchids' => $matchids,
                          'messagetypes' => $messagetypes,
                          'currentid' => $currentid

                      );
                       return view('system-mgmt/notiper/reply',[ 'currentid' =>$currentid,'noti' =>$noti, 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree' =>$tree])->with('id',$id);


                    }
                     return view('error');

             //       $data = Hash::make($id);
         //$portfolio = DB::table('portfolio')->where('id',$id)->first();

       //return $data;
     //  return view('person/notebook',compact('portfolio'))->with('id',$id);
     }
 }
