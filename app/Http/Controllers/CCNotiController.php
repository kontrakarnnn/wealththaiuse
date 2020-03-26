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

use App\View;
use App\Block;
use App\Http\Controllers\SidebarController;
class CCNotiController extends Controller
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

     public function search(Request $request) {
       //sidebar

     $tree = session()->get('tree');
     //sidebar


         $constraints = [
             'from' => $request['from'],
             'to' => $request['to']
         ];

         $notis = $this->getHiredEmployees($constraints);
         return view('system-mgmt/ccnoti/index', ['notis' => $notis, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     public function searchinbox(Request $request) {
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

                               $currentid = DB::table('user_auths')

                                       ->where([ //[ 'structure_id', '=', 10 ],
                                                 [ 'user_id', '=', $current]

                                              ])
                                              ->pluck('block_id');
                                              $currentid = $currentid->toArray();
                                              $notebook = array();
                                             //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
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
                                  ->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

                                 ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

                                 ->select('m.*','m.id', 'views.name as view_name', 'views.id as view_id','users.username as user_name',
                                  'users.id as user_id','structure.name as structure_name', 'structure.id as strucutre_id','b.name as block_name','bt.name as blocktop_name','bb.name as blockbottom_name', 'b.id as block_id', 'bt.id as blocktop_id', 'bb.id as blockbottom_id',
                                  'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','user_groups.name as user_group_name', 'user_groups.id as user_group_id')
                                   ->pluck('view_id');


           $views = View::whereIn('id',$matchviews )
                          ->where('belong_to','=',NULL )->get();
                          $viewss = View::whereIn('id',$matchviews )
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
             'from' => $request['from'],
             'to' => $request['to']
         ];

         $notis = $this->getHiredEmployeesinbox($constraints);
         return view('system-mgmt/ccnoti/inbox', ['notis' => $notis, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     public function searchsentbox(Request $request) {
       //sidebar

     $tree = session()->get('tree');
     //sidebar
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
             'from' => $request['from'],
             'to' => $request['to']
         ];

         $notis = $this->getHiredEmployeessentbox($constraints);
         return view('system-mgmt/ccnoti/sentbox', ['notis' => $notis, 'searchingVals' => $constraints,'tree'=>$tree]);
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
   ->whereIn('d.cc_reciever1',$currentid)
   ->orWhereIn('d.cc_reciever2',$currentid)
   ->orWhereIn('d.cc_reciever3',$currentid)
   ->where('d.created_at', '>=', $constraints['from'])
   ->where('d.created_at', '<=', $constraints['to'])
   ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

   ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
   ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
   ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')


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
   ->whereIn('d.recieve_id',$currentid)


  ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' ,'message_types.message_template as message_type_name', 'message_types.id as message_type_id')
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

    //sidebar

  $tree = session()->get('tree');
  //sidebar

		//sidebar

      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'user_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')
  ->whereIn('d.cc_reciever1',$currentid)
  ->orWhereIn('d.cc_reciever2',$currentid)
  ->orWhereIn('d.cc_reciever3',$currentid)
  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')


 ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);
  return view('system-mgmt/ccnoti/index', ['notis' => $notis,'tree'=>$tree]);
    }

 }
