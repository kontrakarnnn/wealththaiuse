<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Person;
use App\Noti;
use App\Message_type;
use App\match_id;
use Mail;

use App\View;
class NotiGroupController extends Controller
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

     public function search(Request $request) {
         $constraints = [
             'from' => $request['from'],
             'to' => $request['to']
         ];
         $currents = Auth::user()->id;


            // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
               $curren = DB::table('match_id')

                       ->where(//[ 'structure_id', '=',9 ],
                                 'user_id', '=',$currents

                              )
                              ->get();

         $notis = $this->getHiredEmployees($constraints);
         return view('system-mgmt/noti/index', ['curren' => $curren,'notis' => $notis, 'searchingVals' => $constraints]);
     }

     public function searchinbox(Request $request) {
         $constraints = [
             'from' => $request['from'],
             'to' => $request['to']
         ];

         $notis = $this->getHiredEmployeesinbox($constraints);
         return view('system-mgmt/noti/inbox', ['notis' => $notis, 'searchingVals' => $constraints]);
     }

     public function searchsentbox(Request $request) {
       $current = Auth::user()->id;
       $currentstruc = DB::table('user_auths')

               ->where([
                         [ 'user_id', '=', $current]

                      ])
                      ->pluck('structure_id');
           $currentstruc = $currentstruc->toArray();

           $currentmatchids = DB::table('match_id')

                   ->where([
                             [ 'user_id', '=', $current]

                          ])
                          ->pluck('id');
               $currentmatchids = $currentmatchids->toArray();
               $currentpidgroups = DB::table('match_pid_groups')

                       ->where([
                                 [ 'p_id', '=', $currentmatchids]

                              ])
                              ->pluck('pid_group_id');

                $currentusergroups = DB::table('match_user_groups')

                      ->where([
                          [ 'user_id', '=', $current]

                           ])
                           ->pluck('user_group_id');
                         $s = DB::table('user_auths')->pluck('block_id');
                         $s = $s->toArray();
                           if(in_array($current, $s)){
                              $currentid = DB::table('user_auths')

                                      ->where([ //[ 'structure_id', '=', 10 ],
                                                [ 'user_id', '=', $current]

                                             ])
                                             ->pluck('block_id');

                                             $currentid = $currentid->toArray();}
                 $currentid = [0];
               //  $currentid = $currentid->toArray();
                 $notebook = array();
                //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
               // $notebook = array_merge_recursive($currentid,$notebook);
               $notebook = array_merge_recursive($currentid,$notebook);
               $blocktd = array();
               $blocktd = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
               $blocktd = array_merge_recursive($currentid,$blocktd);
               $blockbtu = array();
               $blockbtu = $this->blockbtu($currentstruc,$currentid,$notebook);
               $blockbtu = array_merge_recursive($currentid,$blockbtu);

               $matchviews = DB::table('match_views as m')
               ->leftJoin('views', 'm.view_id', '=', 'views.id')

              ->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
              ->whereIn(
                'structure.id',$currentstruc
              )
              ->leftJoin('block as b', 'm.block_id', '=', 'b.id')
              ->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
              ->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')


             ->leftJoin('users', 'm.user_id', '=', 'users.id')
             ->orWhere(
               'users.id',$current
             )
             ->orwhereIn(
               'pid_groups.id',$currentpidgroups
             )
             ->orwhereIn(
               'user_groups.id',$currentusergroups
             )
             ->orwhereIn(
               'b.id',$notebook
             )
             ->orwhereIn(
               'bt.id',$blocktd
             )
             ->orwhereIn(
               'bb.id',$blockbtu
             )
             ->orwhere(
               'm.all_user','=','Yes'
             )
             ->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

            ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

            ->select('m.*','m.id', 'views.name as view_name', 'views.id as view_id','users.username as user_name',
             'users.id as user_id','structure.name as structure_name', 'structure.id as strucutre_id','b.name as block_name','bt.name as blocktop_name','bb.name as blockbottom_name', 'b.id as block_id', 'bt.id as blocktop_id', 'bb.id as blockbottom_id',
             'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','user_groups.name as user_group_name', 'user_groups.id as user_group_id')
              ->pluck('view_id');


           $views = View::whereIn('id',$matchviews )
                          ->where('belong_to','=',NULL )->get();
           $tree='<li class="treeview"></li>';
           foreach ($views as $view) {

                if(count($view->childs) && $view->add_to_side == "Yes"){
                  $tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i>'.$view->name.'   <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span></a>';
                }elseif($view->add_to_side == "Yes"){
                  $tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i>'.$view->name.'
                          </span></a>';
                }

                if(count($view->childs)) {
                   $tree .=$this->childView($view);
               }
           }
           $tree .='<ul class="sidebar-menu">';

         $constraints = [
             'from' => $request['from'],
             'to' => $request['to']
         ];

         $notis = $this->getHiredEmployeessentbox($constraints);
         return view('system-mgmt/noti/sentbox', ['notis' => $notis, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function getHiredEmployees($constraints) {
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->pluck('id');
                    $currentid = $currentid->toArray();
   $notis = DB::table('notis as d')
   ->where('d.created_at', '>=', $constraints['from'])
   ->where('d.created_at', '<=', $constraints['to'])
   ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

   ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
   ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
   ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
   ->whereIn('d.recieve_id',$currentid)


  ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
  ->get();

         return $notis;
     }

     private function getHiredEmployeesinbox($constraints) {
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->pluck('id');
                    $currentid = $currentid->toArray();
   $notis = DB::table('notis as d')
   ->whereNotIn('d.created_by',$currentid)
   ->where('d.created_at', '>=', $constraints['from'])
   ->where('d.created_at', '<=', $constraints['to'])
   ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

   ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
   ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
   ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
   ->whereIn('d.recieve_id',$currentid)


  ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
  ->get();

         return $notis;
     }

     private function getHiredEmployeessentbox($constraints) {


       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->pluck('id');
                    $currentid = $currentid->toArray();
   $notis = DB::table('notis as d')
   ->whereIn('d.created_by',$currentid)
   ->where('d.created_at', '>=', $constraints['from'])
   ->where('d.created_at', '<=', $constraints['to'])
   ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

   ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
   ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
   ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
   ->whereIn('d.recieve_id',$currentid)


  ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
  ->get();

         return $notis;
     }
    public function index()
    {

		//sidebar
    $current = Auth::user()->id;
    $currentstruc = DB::table('user_auths')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('structure_id');
        $currentstruc = $currentstruc->toArray();

        $currentmatchids = DB::table('match_id')

                ->where([
                          [ 'user_id', '=', $current]

                       ])
                       ->pluck('id');
            $currentmatchids = $currentmatchids->toArray();
            $currentpidgroups = DB::table('match_pid_groups')

                    ->where([
                              [ 'p_id', '=', $currentmatchids]

                           ])
                           ->pluck('pid_group_id');

             $currentusergroups = DB::table('match_user_groups')

                   ->where([
                       [ 'user_id', '=', $current]

                        ])
                        ->pluck('user_group_id');
                      $s = DB::table('user_auths')->pluck('block_id');
                      $s = $s->toArray();
                        if(in_array($current, $s)){
                           $currentid = DB::table('user_auths')

                                   ->where([ //[ 'structure_id', '=', 10 ],
                                             [ 'user_id', '=', $current]

                                          ])
                                          ->pluck('block_id');

                                          $currentid = $currentid->toArray();}
              $currentid = [0];
            //  $currentid = $currentid->toArray();
              $notebook = array();
             //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
            // $notebook = array_merge_recursive($currentid,$notebook);
            $notebook = array_merge_recursive($currentid,$notebook);
            $blocktd = array();
            $blocktd = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
            $blocktd = array_merge_recursive($currentid,$blocktd);
            $blockbtu = array();
            $blockbtu = $this->blockbtu($currentstruc,$currentid,$notebook);
            $blockbtu = array_merge_recursive($currentid,$blockbtu);

            $matchviews = DB::table('match_views as m')
            ->leftJoin('views', 'm.view_id', '=', 'views.id')

           ->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
           ->whereIn(
             'structure.id',$currentstruc
           )
           ->leftJoin('block as b', 'm.block_id', '=', 'b.id')
           ->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
           ->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')


          ->leftJoin('users', 'm.user_id', '=', 'users.id')
          ->orWhere(
            'users.id',$current
          )
          ->orwhereIn(
            'pid_groups.id',$currentpidgroups
          )
          ->orwhereIn(
            'user_groups.id',$currentusergroups
          )
          ->orwhereIn(
            'b.id',$notebook
          )
          ->orwhereIn(
            'bt.id',$blocktd
          )
          ->orwhereIn(
            'bb.id',$blockbtu
          )
          ->orwhere(
            'm.all_user','=','Yes'
          )
          ->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

         ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

         ->select('m.*','m.id', 'views.name as view_name', 'views.id as view_id','users.username as user_name',
          'users.id as user_id','structure.name as structure_name', 'structure.id as strucutre_id','b.name as block_name','bt.name as blocktop_name','bb.name as blockbottom_name', 'b.id as block_id', 'bt.id as blocktop_id', 'bb.id as blockbottom_id',
          'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','user_groups.name as user_group_name', 'user_groups.id as user_group_id')
           ->pluck('view_id');


           $views = View::whereIn('id',$matchviews )
                          ->where('belong_to','=',NULL )->get();
           $tree='<li class="treeview"></li>';
           foreach ($views as $view) {

                if(count($view->childs) && $view->add_to_side == "Yes"){
                  $tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i>'.$view->name.'   <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span></a>';
                }elseif($view->add_to_side == "Yes"){
                  $tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i>'.$view->name.'
                          </span></a>';
                }

                if(count($view->childs)) {
                   $tree .=$this->childView($view);
               }
           }
           $tree .='<ul class="sidebar-menu">';
		//sidebar

      $currents = Auth::user()->id;


         // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
            $curren = DB::table('match_id')

                    ->where(//[ 'structure_id', '=',9 ],
                              'user_id', '=',$currents

                           )
                           ->get();

      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'user_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')

  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
  ->whereIn('d.recieve_id',$currentid)


 ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);
  return view('system-mgmt/noti/index', ['notis' => $notis,'curren' => $curren,'tree'=>$tree]);
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


    public function sentbox()
    {


      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'user_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')
  ->whereIn('d.created_by',$currentid)
  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
  ->whereIn('d.recieve_id',$currentid)


 ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);
  return view('system-mgmt/noti/sentbox', ['notis' => $notis]);
    }

    public function inbox()
    {


      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'user_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')
  ->whereNotIn('d.created_by',$currentid)
  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
  ->whereIn('d.recieve_id',$currentid)


 ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);

  return view('system-mgmt/noti/inbox', ['notis' => $notis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->get();


       $matchids = match_id::all();
       $messagetypes = message_type::all();

        return view('system-mgmt/noti/create', [ 'currentid' =>$currentid, 'messagetypes' => $messagetypes,'matchids' => $matchids]);

     }


     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

       message_type::findOrFail($request['message_type_id']);
       match_id::findOrFail($request['recieve_id']);
       match_id::findOrFail($request['sender_id']);

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
        $noti->cc_reciever1 = $request-> cc_reciever1 ;
        $noti->cc_reciever2 = $request-> cc_reciever2 ;
        $noti->cc_reciever3 = $request-> cc_reciever3 ;
        $noti->created_by = $request-> created_by ;


        $noti->save();


                    $currentid =$request-> sender_id;

                    $matchids = DB::table('match_id')
                    ->where('match_id.id',$currentid)
                    ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                   ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                   //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                   ->pluck('public_email');

                   $currentsender =$noti->created_by;

                   $cursender = DB::table('match_id')
                   ->where('match_id.id',$currentsender)
                   ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                  ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                  ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
                  ->get();
                  //->pluck('public_email');

                   $curren = $noti->recieve_id;

                   $sender = DB::table('notis as d')

                   ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

                   ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
                   ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
                   ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
                   ->where('d.recieve_id',$curren)


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

        /*  'message_type_id' => $request['message_type_id'],
          'topic' => $request['topic'],
          'message' => $request['message'],
          'reflink' => $request['reflink'],
          'sender_note' => $request['sender_note'],
          'reciever_note' => $request['reciever_note'],
          'status' => $request['status'],
          'sender_id' => $request['sender_id'],
          'recieve_id' => $request['recieve_id'],
          'cc_reciever1' => $request['cc_reciever1'],
          'cc_reciever2' => $request['cc_reciever2'],
          'cc_reciever3' => $request['cc_reciever3'],
          'created_by' => $request['created_by']*/




         return redirect()->intended('system-management/noti');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->get();


       $matchids = match_id::all();
       $messagetypes = message_type::all();
       $current = Auth::user()->id;

       $curmatch = DB::table('match_id')
                   ->where('user_id','=',$current)
                   ->pluck('id');
                   $curmatch  =$curmatch->toArray();
       $curmem = DB::table('notis')

              ->whereIn('recieve_id',$curmatch)

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



          ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','du.public_email as created_mail','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

          ->get();
         $data = array(
             'notis' => $notis,


         );
          return view('system-mgmt/noti/show',[ 'currentid' =>$currentid,'notis' =>$notis, 'messagetypes' => $messagetypes,'matchids' => $matchids])->with('id',$id);


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
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->pluck('id');
                    $currentid = $currentid->toArray();

                    $curnoti = DB::table('notis')

                           ->whereIn('recieve_id',$currentid)

                                  ->pluck('id');
                                  $curnoti = $curnoti->toArray();

         $noti = Noti::find($id);

         // Redirect to division list if updating division wasn't existed
         if(in_array($id,$curnoti)) {
           $noti = Noti::find($id);
           $data = array(
               'noti' => $noti
             );
             $matchids = match_id::all();
             $messagetypes = Message_type::all();
             $persons = Person::all();
             $users = User::all();
           return view('system-mgmt/noti/edit', ['noti' => $noti,'matchids' => $matchids,'messagetypes' => $messagetypes]);
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
           'recieve_id' => $request['recieve_id'],
           'cc_reciever1' => $request['cc_reciever1'],
           'cc_reciever2' => $request['cc_reciever2'],
           'cc_reciever3' => $request['cc_reciever3'],
           'created_by' => $request['created_by']
         ];
         $this->validate($request, [

         ]);
         Noti::where('id', $id)
             ->update($input);

         return redirect()->intended('system-management/noti');
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
          return redirect()->intended('system-management/noti');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */

     private function validateInput($request) {
         $this->validate($request, [


     ]);
     }
     public function reply($id)
     {
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
                                        'user_id', '=',$current

                                     )
                                     ->get();


                    $matchids = match_id::all();
                    $messagetypes = message_type::all();
                    $current = Auth::user()->id;

                    $curmatch = DB::table('match_id')
                                ->where('user_id','=',$current)
                                ->pluck('id');
                                $curmatch  =$curmatch->toArray();
                    $curmem = DB::table('notis')

                           ->whereIn('recieve_id',$curmatch)

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
                       return view('system-mgmt/noti/reply',[ 'currentid' =>$currentid,'noti' =>$noti, 'messagetypes' => $messagetypes,'matchids' => $matchids])->with('id',$id);


                    }
                     return view('error');

             //       $data = Hash::make($id);
         //$portfolio = DB::table('portfolio')->where('id',$id)->first();

       //return $data;
     //  return view('person/notebook',compact('portfolio'))->with('id',$id);
     }

     public function forward($id)
     {
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
                                        'user_id', '=',$current

                                     )
                                     ->get();


                    $matchids = match_id::all();
                    $messagetypes = message_type::all();
                    $current = Auth::user()->id;

                    $curmatch = DB::table('match_id')
                                ->where('user_id','=',$current)
                                ->pluck('id');
                                $curmatch  =$curmatch->toArray();
                    $curmem = DB::table('notis')

                           ->whereIn('recieve_id',$curmatch)

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
                       return view('system-mgmt/noti/forward',[ 'currentid' =>$currentid,'noti' =>$noti, 'messagetypes' => $messagetypes,'matchids' => $matchids])->with('id',$id);


                    }
                     return view('error');

             //       $data = Hash::make($id);
         //$portfolio = DB::table('portfolio')->where('id',$id)->first();

       //return $data;
     //  return view('person/notebook',compact('portfolio'))->with('id',$id);
     }
 }
