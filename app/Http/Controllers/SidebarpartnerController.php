<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Viewpartner;
use App\Partner_structure;
use App\Partner_block;
use App\Partner;
use App\Partner_group;
use App\Partner_auth;



use Session;
class SidebarpartnerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

		 public function getArrayAlldBlock($currentstruc,$currentid1,$notebook){

		$CurrentDivisions = Partner_block::where('id', '=' ,$currentid1 )->get();
		$result =$notebook;
		$ChildDivisions = Partner_block::whereIn('under_block',$currentid1 )->pluck('id');
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

		$CurrentDivisions = Partner_block::where('under_block', '=', NULL )->pluck('id');
		$result2 =$notebook2;
		$ChildDivisions = Partner_block::whereIn('id',$currentid2)->pluck('under_block');
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
	$current = Auth::guard('partner')->user()->id;
	//  $current2 = Session::all();
	//  return $current2;

	$currentstruc = DB::table('partner_auths')

					->where([
										[ 'partner_id', '=', $current]

								 ])
								 ->pluck('structure_id');
								 $currentstruc = $currentstruc->toArray();
					 			$currentstruc2 = DB::table('partner_auths')

					 							->where([ //[ 'structure_id', '=',9 ],
					 												[ 'partner_id', '=', $current]

					 										 ])
					 										 ->pluck('structure_id');
					 					$currentstruc2 = $currentstruc2->toArray();

						$currentmatchids = DB::table('match_id')

										->where([
															[ 'partner_id', '=', $current]

													 ])
													 ->pluck('id');

													 $currentusergroups = DB::table('match_partner_group')

																 ->where([
																		 [ 'partner_id', '=', $current]

																			])
																			->pluck('partner_group_id');

								$currentmatchids = $currentmatchids->toArray();
								$currentpidgroups = DB::table('match_pid_groups')
												->where([
																	[ 'id', '=', $currentmatchids]

															 ])
															 ->pluck('pid_group_id');

															 $curblock = DB::table('partner_auths')->where('partner_id',$current)->pluck('block_id');
															 $currentid = [0];
															if(count($curblock)!= NULL){

																	 $currentid = DB::table('partner_auths')

																					 ->where([ //[ 'structure_id', '=', 10 ],
																										 [ 'partner_id', '=', $current]

																									])
																									->pluck('block_id');

																									$currentid = $currentid->toArray();
																								}

																								$currentid1= DB::table('match_views_partner')->where('block_td','!=',NULL)
																																					->pluck('block_td');

																																					$currentid1 = $currentid1->toArray();
																										if(count($currentid1) == NULL){
																											$currentid1 =[0];
																										}
																									$currentid2= DB::table('match_views_partner')->where('block_btu','!=',NULL)
																																						->pluck('block_btu');
																																						$currentid2 = $currentid2->toArray();
																																						$notebook = array();
																																					 $notebook = $this->getArrayAlldBlock($currentstruc,$currentid1,$notebook);
																																					 $notebook = array_merge_recursive($currentid1,$notebook);

																																					 $notebook2 = array();
																																					 $notebook2 = $this->blockbtu($currentstruc2,$currentid2,$notebook2);
																																					 $notebook2 = array_merge_recursive($currentid2,$notebook2);
																						 //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
																		$currents = DB::table('partner')->where('id',$current)->pluck('id');

																		$matchviews = DB::table('match_views_partner as m')
																		->leftJoin('views_partner', 'm.view_id', '=', 'views_partner.id')
																		->leftJoin('partner_structure', 'm.structure_id', '=', 'partner_structure.id')
																		->leftJoin('partner_block as b', 'm.block_id', '=', 'b.id')
																		->leftJoin('partner_block as bt', 'm.block_td', '=', 'bt.id')
																		->leftJoin('partner_block as bb', 'm.block_btu', '=', 'bb.id')

																		->whereIn(
																					 'partner_structure.id',$currentstruc
																				 )
																	->orwhereIn(
																		'pid_groups.id',$currentpidgroups
																	)
																	->orwhereIn(
																		'm.partner_id',$currents
																	)
																	->orwhere(
																		'm.all_partner','=','Yes'
																	)
																	->leftJoin('partner_group', 'm.partner_group_id', '=', 'partner_group.id')
																	->orwhereIn(
																		'partner_group.id',$currentusergroups
																	)
																	->orwhereIn(
																		'b.id',$curblock
																	)
																 ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

																	 ->pluck('view_id')->toArray();
																	 if(array_intersect($currentid,$notebook)){
			 														$matchviewsauthtopdown = DB::table('match_views_partner as m')
			 														->leftJoin('views_partner', 'm.view_id', '=', 'views_partner.id')
			 													 ->leftJoin('partner_structure', 'm.structure_id', '=', 'partner_structure.id')
			 													 ->leftJoin('partner_block as b', 'm.block_id', '=', 'b.id')
			 													 ->leftJoin('partner_block as bt', 'm.block_td', '=', 'bt.id')
			 													 ->leftJoin('partner_block as bb', 'm.block_btu', '=', 'bb.id')
			 													->leftJoin('partner', 'm.partner_id', '=', 'partner.id')
			 													->leftJoin('partner_group', 'm.partner_group_id', '=', 'partner_group.id')
			 												 ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')
			 												 ->whereIn(
			 																			 'bt.id',$notebook
			 																		)

			 													 ->pluck('view_id')->toArray();
			 													 $matchviews = array_merge($matchviews,$matchviewsauthtopdown);

			 												 }

															 if(array_intersect($currentid,$notebook2)){
															 $matchviewsauthbottomup = DB::table('match_views_partner as m')
															 ->leftJoin('views_partner', 'm.view_id', '=', 'views_partner.id')
															->leftJoin('partner_structure', 'm.structure_id', '=', 'partner_structure.id')
															->leftJoin('partner_block as b', 'm.block_id', '=', 'b.id')
															->leftJoin('partner_block as bt', 'm.block_td', '=', 'bt.id')
															->leftJoin('partner_block as bb', 'm.block_btu', '=', 'bb.id')
														 ->leftJoin('partner', 'm.partner_id', '=', 'partner.id')
														 ->leftJoin('partner_group', 'm.partner_group_id', '=', 'partner_group.id')

														->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')
														->whereIn(
															'bb.id',$notebook2
														)

															->pluck('view_id')->toArray();
														//  return $matchviewsauthbottomup;
														$matchviews = array_merge($matchviews,$matchviewsauthbottomup);
														}
					 $views = Viewpartner::whereIn('id',$matchviews )
													->where('belong_to','=',NULL )->orderBy('priority','ASC')->get();
													$viewss = Viewpartner::whereIn('id',$matchviews )
																				 ->pluck('id');
																				 $viewss =$viewss->toArray();
					 $tree='<li class="treeview"></li>';
					 foreach ($views as $view) {

								if(count($view->childs) &&in_array($view->id, $viewss)&& $view->add_to_side == "Yes"){
									$tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i><span>'.$view->name.'</span>     <span class="pull-right-container">
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

            $html .='<li> <a  href ="'.$arr->view_url.'"class=""><i class="fa fa-link"></i><span>'.$arr->name.' </span>  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span></a> ';
                    $html.= $this->childView($arr,$viewss);


                }elseif($view->add_to_side == "Yes" && in_array($arr->id, $viewss)){

                    $html .='<li class="treeview"><a href ="'.$arr->view_url.'"class=""><span>'.$arr->name.'</span>  </a>' ;
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
