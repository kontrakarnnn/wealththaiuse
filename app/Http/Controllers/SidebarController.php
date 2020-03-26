<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Viewper;
use Session;
use App\User_auth;
class SidebarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	     public function getArrayAlldBlock($currentstruc,$currentid1,$notebook){

    //$CurrentDivisions = Block::where('id', '=',$currentid )->get();
    $result =$notebook;
    $ChildDivisions = Block::whereIn('under_block',$currentid1)->pluck('id');
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
$ChildDivisions2 = Block::whereIn('id',$currentid2)->pluck('under_block');

//return $ChildDivisions;
//$ChildDivisions = Block::whereIn('under_block',$currentid2)->pluck('id'); topdown
//  $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$CurrentDivisions )->pluck('id');
foreach ( $ChildDivisions2 as $Division2 => $get2) {
  $nextblockID2[$Division2] = $get2;
  $arraylength2 = sizeof($result2);
  //$currentid=$currentid;
  $result2[$arraylength2]  = $nextblockID2[$Division2];
  //$result2 = $this->blockbtu($currentstruc2,$nextblockID2,$result2);
  }

  return $result2;
}

public function getSide() {
	//sidebar
	$current = Auth::user()->id;
	$currentstruc = DB::table('user_auths')

					->where([
										[ 'user_id', '=', $current]

								 ])
								 ->pluck('structure_id');
			$currentstruc = $currentstruc->toArray();
			$currentstruc2 = DB::table('user_auths')

							->where([ //[ 'structure_id', '=',9 ],
												[ 'user_id', '=', $current]

										 ])
										 ->pluck('structure_id');
					$currentstruc2 = $currentstruc2->toArray();
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


											$curblock = DB::table('user_auths')->where('user_id',$current)->pluck('block_id');
										//  return $curblock;
											 $currentid = [0];
											if(count($curblock)!= NULL){

													 $currentid = DB::table('user_auths')

																	 ->where([ //[ 'structure_id', '=', 10 ],
																						 [ 'user_id', '=', $current]

																					])
																					->pluck('block_id');

																					$currentid = $currentid->toArray();
																				}

																				$currentid1= DB::table('match_views')->where('block_td','!=',NULL)
																																	->pluck('block_td');

																																	$currentid1 = $currentid1->toArray();
																					$currentid2= DB::table('match_views')->where('block_btu','!=',NULL)
																																		->pluck('block_btu');
																																		$currentid2 = $currentid2->toArray();
																				$notebook = array();
																			 $notebook = $this->getArrayAlldBlock($currentstruc,$currentid1,$notebook);
																			 $notebook = array_merge_recursive($currentid1,$notebook);
																			 $notebook2 = array();
																		  $notebook2 = $this->blockbtu($currentstruc2,$currentid2,$notebook2);
																			 $notebook2 = array_merge_recursive($currentid2,$notebook2);

															$matchviews = DB::table('match_views as m')
															->leftJoin('views', 'm.view_id', '=', 'views.id')

														 ->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
														 ->leftJoin('block as b', 'm.block_id', '=', 'b.id')
														 ->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
														 ->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')


														->leftJoin('users', 'm.user_id', '=', 'users.id')
														->whereIn(
																	 'structure.id',$currentstruc
																 )
														->orwhere(
															'm.all_user','=','Yes'
														)
														->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

													 ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

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
																 'b.id',$curblock
															 )
														 ->pluck('view_id')->toArray();


														if(array_intersect($currentid,$notebook)){
														$matchviewsauthtopdown = DB::table('match_views as m')
														->leftJoin('views', 'm.view_id', '=', 'views.id')
													 ->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
													 ->leftJoin('block as b', 'm.block_id', '=', 'b.id')
													 ->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
													 ->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')
													->leftJoin('users', 'm.user_id', '=', 'users.id')
													->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')
												 ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')
												 ->whereIn(
																			 'bt.id',$notebook
																		)

													 ->pluck('view_id')->toArray();
													 $matchviews = array_merge($matchviews,$matchviewsauthtopdown);

												 }
													 if(array_intersect($currentid,$notebook2)){
													 $matchviewsauthbottomup = DB::table('match_views as m')
													 ->leftJoin('views', 'm.view_id', '=', 'views.id')
													->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
													->leftJoin('block as b', 'm.block_id', '=', 'b.id')
													->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
													->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')
												 ->leftJoin('users', 'm.user_id', '=', 'users.id')
												 ->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

												->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')
												->whereIn(
													'bb.id',$notebook2
												)

													->pluck('view_id')->toArray();
												//  return $matchviewsauthbottomup;
												$matchviews = array_merge($matchviews,$matchviewsauthbottomup);
												}


                              //  return $notebook2;
                              //return $matchviews;


         $views = View::whereIn('id',$matchviews )
                        ->where('belong_to','=',NULL )->orderBy('priority','ASC')->get();
                        $viewss = View::whereIn('id',$matchviews )
                                       ->pluck('id');
                                       $viewss =$viewss->toArray();
         $tree='<li class="treeview">';
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
         $tree .='</li>';
  //sidebar
  return $tree;
 }
 public function childView($view,$viewss){
        $html ='<ul class="treeview-menu">';
        foreach ($view->childs as $arr) {
            if(count($arr->childs) && in_array($arr->id, $viewss) && $view->add_to_side == "Yes"){
            $html .='<li> <a  href ="'.$arr->view_url.'"class=""><i class="fa fa-link"></i><span>'.$arr->name.' </span>  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span></a>  ';
                    $html.= $this->childView($arr,$viewss);


                }
								elseif($view->add_to_side == "Yes" && in_array($arr->id, $viewss)){

                    $html .='<li class="treeview"><a href ="'.$arr->view_url.'"class=""><span>'.$arr->name.' </span> </a>' ;
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
