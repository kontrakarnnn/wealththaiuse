<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Viewper;
use Session;
class SidebarperController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	     public function getArrayAlldBlock($currentstruc,$currentid,$notebook){

    //$CurrentDivisions = Block::where('id', '=',$currentid )->get();
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

public function blockbtu($currentstruc2,$currentid2,$notebook2){

$CurrentDivisions = Block::where('under_block', '=', NULL )->pluck('id');
$result2 =$notebook2;
$ChildDivisions = Block::whereIn('id',$currentid2)->pluck('under_block');
//$ChildDivisions = Block::whereIn('under_block',$currentid2)->pluck('id'); topdown
//  $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$CurrentDivisions )->pluck('id');
foreach ( $ChildDivisions as $Division => $get) {
  $nextblockID2[$Division] = $get;
  $arraylength = sizeof($result2);
  //$currentid=$currentid;
  $result2[$arraylength]  = $nextblockID2[$Division];
  $result2 = $this->blockbtu($currentstruc2,$nextblockID2,$result2);
  }

  return $result2;
}

public function getSide() {
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
																	[ 'id', '=', $currentmatchids]

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
													->where('belong_to','=',NULL )->orderBy('priority','ASC')->get();
													$viewss = Viewper::whereIn('id',$matchviews )
																				 ->pluck('id');
																				 $viewss =$viewss->toArray();
					 $tree='<li class="treeview"></li>';
					 foreach ($views as $view) {

								if(count($view->childs) &&in_array($view->id, $viewss)&& $view->add_to_side == "Yes"){
									$tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i><span>'.$view->name.' </span>    <span class="pull-right-container">
														<i class="fa fa-angle-left pull-right"></i>
													</span></a>';

								}elseif($view->add_to_side == "Yes"){
									$tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i><span>'.$view->name.'</span>
													</span></a>';
								}

								if(count($view->childs)) {

									 $tree .=$this->childView($view,$viewss);
							 }
					 }
					 $tree .='<ul class="sidebar-menu">';
					 return $tree;
 }
 public function childView($view,$viewss){






        $html ='<ul class="treeview-menu">';
        foreach ($view->childs as $arr) {

            if(count($arr->childs) && in_array($arr->id, $viewss) && $view->add_to_side == "Yes"){

            $html .='<li> <a  href ="'.$arr->view_url.'"class=""><i class="fa fa-link"></i><span>'.$arr->name.'</span>   <span class="pull-right-container">
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

}
