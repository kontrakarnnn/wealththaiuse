<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Organize;
use App\Port_Org_auth;
use App\Block;
use App\Person;
use App\Organize_auth;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Viewper;
use Mail;
use App\Noti;
use App\match_id;
use Session;
class OrganizeAuthController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $current = Auth::guard('person')->user()->id;
      $current = Auth::guard('person')->user()->id;
      $userauths = DB::table('organize_auths')
      ->where('organize_id',$current)

      ->leftJoin('persons','organize_auths.member_id','=','persons.id')
      ->select('organize_auths.*','persons.email as member_email','persons.name as member_name','persons.lname as member_lname')
      ->paginate(100);

     return view('system-mgmt/organizeauth/index', ['userauths' => $userauths]);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       $current = Auth::guard('person')->user()->id;
       $structures = Person::where('id',$current)->get();
       $users = Person::all();
       return view('system-mgmt/organizeauth/create', ['structures' => $structures, 'users' => $users]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

       //Organize::findOrFail($request['organize_id']);

       //Person::findOrFail($request['member_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
      $mail = $request->member_id;
      $matchids = DB::table('persons')


     ->where(
       'email',$mail
     )
     //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

     ->value('id');
     if($matchids == NULL){
       $current = Auth::guard('person')->user()->id;
       $publicid = match_id::where('member_id',$current)->value('id');
       $publicname = match_id::where('member_id',$current)->value('public_name');
       $link = 'https://erp.wealththai.net/quickregister?refmem?'.$publicid;
       $what = 'องค์กร';
       Mail::send('emails.requestregis',compact('what','link','publicid','publicname'),function($message) use ($mail){
        $message->to($mail);
        $message->subject('มีการเชิญเข้าร่วมองค์กร');
      });

       $request->session()->flash('alert-danger', 'อีเมลล์ '.$mail.' ไม่มีอยู่ในระบบเราได้ทำการส่งข้อความใหอีเมลล์นี้รับทราบแล้ว');
       return redirect('/organizeauth');
     }
    // return $matchids;
  //  return $matchids;
        $pid = DB::table('match_id')->where('member_id',$matchids)->value('id');
        //return $pid;
        $current = Auth::guard('person')->user()->id;
        $currentpid = DB::table('match_id')->where('member_id',$current)->value('id');
        //return $currentpid;
        Organize_auth::create([

          'member_id' => $matchids,
          'organize_id' => $request['organize_id'],
          'status' => "Request",
          'description' => $request['description']

       ]);
		 $sendername = DB::table('match_id')->where('id',$currentpid)->value('public_name');
       $noti = new Noti;
                 $noti->message_type_id = 38;
                 $message = DB::table('message_types')->where('id',$noti->message_type_id)->get();
                 foreach($message as $mes){
                 $noti->message = $mes->message_default.$sendername;
                 $noti->topic = $mes->message_template;
               }
                 $noti->sender_note  = $request-> sender_note;
                 $noti->status = $request-> status;
                 $noti->sender_id  = $currentpid;
                 $noti->created_by = 1;
                 $noti->recieve_id =$pid;
                 $noti->save();

                 $reciever = DB::table('match_id')->where('id',$pid)->get();

                 $sender = DB::table('match_id')->where('id',$currentpid)->get();
                 $messagetypes = DB::table('message_types')
                 ->where('message_types.id',$noti->message_type_id)
                 ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                 ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')
                 ->get();
				$recieveremail = DB::table('match_id')->where('id',$pid)->value('public_email');
		 		//return $recieveremail;
		 		$pathToImage = 'https://erp.wealththai.net/img/logodeep.png';
      		 Mail::send('emails.invitationorg',compact('pathToImage','messagetypes','sender','reciever'),function($message) use ($matchids,$messagetypes,$sender,$recieveremail,$reciever){
      		   foreach ($sender as $sen) {
      	   $message->from($sen->public_email);
            }

         $message->to($recieveremail);

         foreach ($messagetypes as $messages) {
         $message->subject($messages->message_template);
         }
       });

         return redirect('/organizeauth');
     }


     public function request(Request $request){

       //sidebar
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





      //$curor = Organize::where('created_by' ,'=', $current)->orwhere('member_id',$current)->pluck('id');
      //$curorg = Organize::where('created_by' ,'=', $current)->orwhere('member_id',$current)->get();



       $userauths = DB::table('organize_auths')

       ->leftJoin('persons', 'organize_auths.member_id', '=', 'persons.id')
      ->leftJoin('persons as organize', 'organize_auths.organize_id', '=', 'organize.id')
      ->where('organize_auths.member_id' ,'=', $current)

      ->where('organize_auths.status' ,'=', 'Request')


      ->select('organize_auths.*','organize_auths.description', 'organize.name as organize_name', 'organize.email as organize_email', 'organize.mobile as organize_mobile', 'organize.dob as organize_dob', 'organize.id_num as organize_idnum', 'organize.gender as organize_gender', 'organize.nationality as organize_nationality', 'organize.add2 as organize_add2', 'organize.add2_alley as organize_alley', 'organize.add2_road as organize_road', 'organize.add2_subdistrict as organize_subdistrict', 'organize.add2_district as organize_district', 'organize.add2_city as organize_city', 'organize.add2_country as organize_country', 'organize.add2_postcode as organize_postcode','organize.more as organize_more','organize.couple_email as organize_couple_email', 'organize.id as organize_id','persons.name as member_name', 'persons.id as member_id')

      ->paginate(100);





      return view('system-mgmt/organizeauth/request', ['userauths' => $userauths,'tree' =>$tree]);
     }


     public function updaterequest(Request $request,$id){

      $userauth = Organize_auth::findOrFail($id);
      Organize_auth::where('id', $id)
          ->update(['status'=>'Accept']);
       return redirect()->back();
       //$submit =   Family_auth::where('member_id',$request->get('id'))->update(['status'=> 'Accept']);
       //return back();
     }


     public function list(){



             //sidebar
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

                                      $curfam = DB::table('organize_auths')

             ->where('status',"Accept")
             ->where('member_id',$current)
            // ->where('member_id',$current)
             ->pluck('organize_id');
            // return $curfam;
           //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
               $curfamss = Person::whereIn('id',$curfam)->orwhere('belong_to',$current)->get();

             $userauths = DB::table('organize_auths')
             ->leftJoin('persons', 'organize_auths.member_id', '=', 'persons.id')
            ->leftJoin('persons as organize', 'organize_auths.organize_id', '=', 'organize.id')


            ->where('organize_auths.status' , "Accept")
            ->where('organize_auths.member_id' , $current)
          //  ->where('organize.id' , $current)
          //  ->orwhere('organize.belong_to' , $current)


            ->select('organize_auths.*','organize_auths.description', 'organize.name as organize_name', 'organize.email as organize_email', 'organize.mobile as organize_mobile', 'organize.dob as organize_dob', 'organize.id_num as organize_idnum', 'organize.gender as organize_gender', 'organize.nationality as organize_nationality', 'organize.add2 as organize_add2', 'organize.add2_alley as organize_alley', 'organize.add2_road as organize_road', 'organize.add2_subdistrict as organize_subdistrict', 'organize.add2_district as organize_district', 'organize.add2_city as organize_city', 'organize.add2_country as organize_country', 'organize.add2_postcode as organize_postcode','organize.more as organize_more','organize.couple_email as organize_couple_email', 'organize.id as organize_id','persons.name as member_name', 'persons.id as member_id')


            ->get();
            return view('system-mgmt/organizeauth/list', ['curfamss'=>$curfamss,'userauths' => $userauths,'tree' =>$tree]);

     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
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


         $userauth = Organize_auth::find($id);
         $member = Person::all();

         // Redirect to division list if updating division wasn't existed
         if ($userauth == null) {
           $userauth = Organize_auth::find($id);
           $data = array(
               'userauth' => $userauth
             );
             return redirect()->intended('/organizeauth');
           }
           $structures = Organize::all();

           $users = Person::all();
         return view('system-mgmt/organizeauth/edit', ['member'=>$member,'userauth' => $userauth,'structures' => $structures,'users' => $users,'tree' =>$tree]);
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
         $userauth = Organize_auth::findOrFail($id);
         $input = [
           'member_id' => $request['member_id'],
           'organize_id' => $request['organize_id'],

           'description' => $request['description']

         ];
         $this->validate($request, [
         'member_id' => 'nullable|max:60',
         'organize_id' => 'nullable|max:60',

         'description' => 'nullable|max:60'
         ]);
         Organize_auth::where('id', $id)
             ->update($input);

         return redirect()->intended('/organizeauth');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Organize_auth::where('id', $id)->delete();
         Port_Org_auth::where('org_id',$id)->delete();
          return redirect()->back();
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */
     public function search(Request $request) {

       //sidebar
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



          $constraints = [
           'member_id' => $request['member_id'],
           'organize_id' => $request['organize_id'],

           'description' => $request['description'],
           'organize.name' => $request['organize_name'],

            'persons.name' => $request['member_name']
             ];

        $userauths = $this->doSearchingQuery($constraints);
        $constraints['organize_name'] = $request['organize_name'];
        $constraints['member_name'] = $request['member_name'];

        return view('system-mgmt/organizeauth/index', ['userauths' => $userauths, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {

		 $current = Auth::guard('person')->user()->id;

       $query = DB::table('organize_auths')
      ->where('organize_id',$current)

      ->leftJoin('persons','organize_auths.member_id','=','persons.id')
      ->select('organize_auths.*','persons.email as member_email','persons.name as member_name','persons.lname as member_lname');
         $fields = array_keys($constraints);
         $index = 0;
         foreach ($constraints as $constraint) {
             if ($constraint != null) {
                 $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
             }

             $index++;
         }
         return $query->paginate(1000000);
     }
     private function validateInput($request) {
         $this->validate($request, [
           'user_id' => 'nullable|max:60',
           'structure_id' => 'nullable|max:60',
           'block_id' => 'nullable|max:60',
           'description' => 'nullable|max:60'

     ]);
     }

     public function org(Request $request){
       //sidebar
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

     $i=0;

     $dep = $request->dep;
     $current = Auth::user()->id;


     $currentid = DB::table('user_auths')

     ->where([ //[ 'structure_id', '=',9 ],
       [ 'user_id', '=', $current]

     ])
     ->pluck('block_id');


     $currentid = $currentid->toArray();

     //  $CurrentDivisions = Block::whereIn('id',$currentid )->pluck('id');
     //  $CurrentDivisions = $CurrentDivisions->toArray();

     /* 2 $userId = auth()->user()->id;

     $userautha = User::with('user_auths')->findOrFail($userId);

     //*3 $user = User::with('user_auths')->find(Auth::id())->firstOrFail();






     // $userauth = User_auth::where('user_id', '=',$currentid )->get();
     //  $currentid = Auth::user()->$userauth;


     //  $userauth = User_auth::where('user_id', '=',$currentid )->get();*/
     $org = $request->org;



     //  echo "<pre>";
     //  print_r($currentstruc);

     $curor = Organize::where('created_by' ,'=', $current)->orwhere('member_id',$current)->pluck('id');
     $curorg = Organize::where('created_by' ,'=', $current)->get();

     $curfam = DB::table('organize_auths')

     ->where('status',"Accept")
     ->orwhere('member_id',$current)
     ->pluck('organize_id');
   //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
    $curfamss = Person::whereIn('id',$curfam)->orwhere('belong_to',$current)->get();


     $userauths = DB::table('organize_auths')
     ->leftJoin('persons', 'organize_auths.member_id', '=', 'persons.id')
    ->leftJoin('persons as organize', 'organize_auths.organize_id', '=', 'organize.id')
  //  ->whereIn('organize_id',$curor)
    ->where('organize.name',$org)

    ->where('organize_auths.status' , "Accept")
    ->orwhere('organize.belong_to' , $current)
    ->orwhere('organize.id' , $current)
    ->select('organize_auths.*','organize_auths.description', 'organize.name as organize_name', 'organize.email as organize_email', 'organize.mobile as organize_mobile', 'organize.dob as organize_dob', 'organize.id_num as organize_idnum', 'organize.gender as organize_gender', 'organize.nationality as organize_nationality', 'organize.add2 as organize_add2', 'organize.add2_alley as organize_alley', 'organize.add2_road as organize_road', 'organize.add2_subdistrict as organize_subdistrict', 'organize.add2_district as organize_district', 'organize.add2_city as organize_city', 'organize.add2_country as organize_country', 'organize.add2_postcode as organize_postcode','organize.more as organize_more','organize.couple_email as organize_couple_email', 'organize.id as organize_id','persons.name as member_name', 'persons.id as member_id')

    ->get();


     /*  $data =  DB::table('portfolio')->join('structure','structure.id','portfolio.structure_id')
     ->where('structure.name',$dep)->get();*/
    return view('system-mgmt/organizeauth/list', ['curfamss'=>$curfamss,'userauths' => $userauths,'tree' =>$tree]);
     //  return view('system-mgmt/portfolio/index2',['data'=>$data, 'depByUser'=> $dep]);

     //  $data =  DB::table('portfolio')->join('department','department.id','portfolio.department_id')
     //  ->where('department.name',$dep)->get();
     //  return view('system-mgmt/portfolio/index2',['data'=>$data, 'depByUser'=> $dep]);
   }
 }
