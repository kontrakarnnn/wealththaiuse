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
use App\Partner_block;
use App\Partner_auth;
use App\match_id;
use App\match_member_id;
use App\match_pid_id;
use App\match_partner_group;
use App\CaseAuth;

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
		 public function loadday()
     {
         for ($i = 10;$i<=31;$i++) {
             $day[] = $i;
         }
         return $day;
     }

     public function loadmonth()
     {
         for ($i = 10;$i<=12;$i++) {
             $day[] = $i;
         }
         return $day;
     }

     public function loadyear()
     {
         date_default_timezone_set('Asia/Bangkok');
         $url = $_SERVER['REQUEST_URI'];

         $year = date('Y')+550;
         if (strstr($url, '?fromreport')) {
             $year = date('Y')+543;
         }
         for ($i = $year;$i>=1900;$i--) {
             $day[] = $i;
         }
         return $day;
     }
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
public function getAlldBlock($currentid,$menudepth,$notebook){


		if(count([$currentid]) == 0){
			$CurrentDivisions = Block::where('id', '=',[0] )->get();

		}
		else{
			$CurrentDivisions = Block::where('id', '=',$currentid )->get();
		}

		$count = $menudepth;
		$result ='<ul>';
		$tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';

	 /* @foreach(App\Structure::whereIn('id',$currentstruc)->get(); as $depList)
		<li><a href="{{url('portfolio')}}/{{$depList->name}}">
			{{$depList->name}}</a></li>
		@endforeach*/

		foreach ($CurrentDivisions as $Division) {
			$tree .='<li class="tree-view closed"<a  class="tree-name">'.$Division->name.'</a>';

			$status = $Division->status;
			if($count == 0){
					 $result .='<li class="tree-view closed"><a  href="'.$Division->name.   ' "class="tree-name">'.$Division->name.'</a>'.' Category current Block ID is  :' .$currentid.'count:'.$count;

			}else{
						$result .='<li class="tree-view closed"><a href="'.$Division->name.   ' ">'.$Division->name.   ' <b>Status:</b> '.$status.'</a>';
			}

		}
		 $count++;
		 if(count([$currentid]) == 0){
	 $ChildDivisions = Block::where('under_block', '=',[0] )->get();
 }
 	else
	{
		$ChildDivisions = Block::where('under_block', '=',$currentid )->get();

	}
	 foreach ($ChildDivisions as $Division) {
				$status = $Division->status;
				$nextblockID = $Division->id;
				if($status== 1){
						$result .= $this->getAlldBlock($nextblockID,$count,$notebook);
						$result   .="</li>";
				}else{
							$result .=$this->getAlldBlock($nextblockID,$count,$notebook);
				}
			//  $tree .='<li class="tree-view closed"<a class="tree-name">'.$Division->name.'Status: '.$status.'</a>';

	 }
	 $result .="</ul>";
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
public function mymember(){
	//sidebar

	$tree = session()->get('tree');
	//sidebar

	$current = Auth::user()->id;


	$currentid = DB::table('user_auths')

					->where([ //[ 'structure_id', '=', 10 ],
										[ 'user_id', '=', $current]

								 ])
								 ->pluck('block_id');


								 $currentstruc = DB::table('user_auths')

												 ->where([
																	 [ 'user_id', '=', $current]

																])
																->pluck('structure_id');
										 $currentstruc = $currentstruc->toArray();
$menudepth = 0;
$notebook = array();

$trees='<ul id="browser" class="filetree"><li class="tree-view"></li>';
$trees .=$this->getAlldBlock($currentid,$menudepth,$notebook);
$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);

$trees .='<ul>';
$block =




$i=0;


$current = Auth::user()->id;


 $currentid = DB::table('user_auths')

				 ->where(//[ 'structure_id', '=',9 ],
									 'user_id', '=',$current

								)
								->pluck('block_id');
						$currentid = $currentid->toArray();






$current = Auth::user()->id;


$currentstruc = DB::table('user_auths')

				->where([ //[ 'structure_id', '=',9 ],
									[ 'user_id', '=', $current]

							 ])
							 ->pluck('structure_id');
		$currentstruc = $currentstruc->toArray();
		//  echo "<pre>";
		//  print_r($currentstruc);
		$persons = DB::table('persons');
$notebook = array();
$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
$notebook = array_merge_recursive($currentid,$notebook);

$current = Auth::user()->id;
$curmem = DB::table('portfolio')

			 ->whereIn('block_id',$notebook)

							->pluck('member_id');

							 $curmem = $curmem->toArray();
							 $persons = DB::table('persons')
							 ->whereIn('persons.id',$curmem)
						 ->leftJoin('member_type', 'persons.type', '=', 'member_type.id')
						->select('persons.*', 'member_type.name as memtype_name', 'member_type.id as memtype_id')
						->orderBy('created_at', 'desc')

							 ->paginate(30);
							// return $mymember;
							 return $curmem;
}

public function getblockid()
{
	$current = Auth::user()->id;
	$block = User_auth::where('user_id',$current)->pluck('block_id')->toArray();
	return $block;
}
public function getpartnerblockid()
{
//	$current = Auth::user()->id;
	$block = Partner_auth::where('user_id',$current)->pluck('block_id')->toArray();
	return $block;
}
public function findpublicidinpartnerblock($partnerblock)
{
	$partnerblock = Partner_block::where('id',$partnerblock)->value('id');
	$partnerid = Partner_auth::where('block_id',$partnerblock)->value('partner_id');
	$publicid = match_id::where('partner_id',$partnerid)->value('id');
	return $publicid;
}

public function findpublicidinuserblock($userblock)
{
	$userblock = Block::where('id',$userblock)->value('id');
	$userid = User_auth::where('block_id',$userblock)->value('user_id');
	$publicid = match_id::where('user_id',$userid)->value('id');
	return $publicid;
}
public function findpublicidinuserid($userid)
{
	$publicid = match_id::where('user_id',$userid)->value('id');
	return $publicid;
}
public function findpublicidinuseridnoinputuserid()
{
	$userid = Auth::user()->id;
	$publicid = match_id::where('user_id',$userid)->value('id');
	return $publicid;
}
public function findpublicidinguildid($guildid)
{
	$memberid = match_member_id::where('member_group_id',$guildid)->pluck('member_id')->toArray();
	$publicid = match_id::whereIn('member_id',$memberid)->pluck('id')->toArray();
	return $publicid;
}
public function findpublicidinpartnergroup($partnergroupid)
{
	$memberid = match_partner_group::where('partner_group_id',$partnergroupid)->pluck('partner_id')->toArray();
	$publicid = match_id::whereIn('partner_id',$memberid)->pluck('id')->toArray();
	return $publicid;
}
public function findpublicidinpidgroup($pidgroupid)
{
	$publicid = match_pid_id::where('pid_group_id',$pidgroupid)->pluck('p_id')->toArray();
	return $publicid;
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
		 public function findunderblock($blockstartid)
		 {
		 //  $notebook = array();
			 $notebook =[];
			 if(is_array($blockstartid))
			 {
				 $block = Block::whereIn('under_block',$blockstartid)->get();
			 }
			 else
			 {
				 $block = Block::where('under_block',$blockstartid)->get();
			 }
			 foreach ($block as $view) {

						if(count($view->childs)) {
							array_push($notebook,$view->id);
							$notebook = $this->childblock($view,$notebook);
					 }
					 array_push($notebook,$view->id);
			 }
			 if(is_array($blockstartid))
			 {
				 	$notebook=array_merge($notebook,$blockstartid);
			 }
			 else
			 {
				 array_push($notebook,$blockstartid);
			 }
			return array_unique($notebook);
		 }
		 public function childblock($view,$notebook)
		 {

			 foreach ($view->childs as $arr) {

					 if(count($arr->childs)){
									 array_push($notebook,$arr->id);
									 $notebook = $this->childblock($arr,$notebook);
							 }
							 array_push($notebook,$arr->id);


			 }
			 return $notebook;
		 }

		public function showcasecansee()
		{
			$userid = Auth::user()->id;
			$blockid = $this->getblockid();
			$publicid = $this->findpublicidinuserid($userid);
			$blockpartner = '';
			$guildmember = '';
			$groupmember = '';
			$grouppid = '';
			$grouppartner = '';
			$blockunder = $this->findunderblock($blockid);
			$caseauthbypid = CaseAuth::where('public_id',$publicid)->pluck('case_id')->toArray();
			$caseauthbyblockpartner = CaseAuth::where('block_partner',$blockpartner)->pluck('case_id')->toArray();
			$caseauthbyguildmember = CaseAuth::where('guild_member',$guildmember)->pluck('case_id')->toArray();
			$caseauthbygroupmember = CaseAuth::where('group_member',$groupmember)->pluck('case_id')->toArray();
			$caseauthbygrouppid = CaseAuth::where('group_pid',$grouppid)->pluck('case_id')->toArray();
			$caseauthbygrouppartner = CaseAuth::where('group_partner',$grouppartner)->pluck('case_id')->toArray();
			$caseauthbyblockuser = CaseAuth::whereIn('block_user',$blockid)->pluck('case_id')->toArray();
			$caseid= array_merge($caseauthbypid,$caseauthbyblockuser,$caseauthbyblockpartner,$caseauthbyguildmember,$caseauthbygroupmember,$caseauthbygrouppid,$caseauthbygrouppartner);
			$caseid =  array_unique($caseid);
			return $caseid;
		}
		public function showcasecanseeall()
		{
			$userid = Auth::user()->id;
			$blockid = $this->getblockid();
			$publicid = $this->findpublicidinuserid($userid);
			$blockpartner = '';
			$guildmember = '';
			$groupmember = '';
			$grouppid = '';
			$grouppartner = '';
			$blockunder = $this->findunderblock($blockid);
			$caseauthbypid = CaseAuth::where('public_id',$publicid)->pluck('case_id')->toArray();
			$caseauthbyblockpartner = CaseAuth::where('block_partner',$blockpartner)->pluck('case_id')->toArray();
			$caseauthbyguildmember = CaseAuth::where('guild_member',$guildmember)->pluck('case_id')->toArray();
			$caseauthbygroupmember = CaseAuth::where('group_member',$groupmember)->pluck('case_id')->toArray();
			$caseauthbygrouppid = CaseAuth::where('group_pid',$grouppid)->pluck('case_id')->toArray();
			$caseauthbygrouppartner = CaseAuth::where('group_partner',$grouppartner)->pluck('case_id')->toArray();
			$caseauthbyblockuser = CaseAuth::whereIn('block_user',$blockid)->pluck('case_id')->toArray();
			$caseauthbyunderblock = CaseAuth::whereIn('block_user',$blockunder)->pluck('case_id')->toArray();
			$caseauth= CaseAuth::where('block_partner',$blockpartner)->orwhere('public_id',$publicid)->orwhere('guild_member',$guildmember)->orwhere('group_member',$groupmember)->orwhere('group_pid',$grouppid)
			->orwhere('group_partner',$grouppartner)->whereIn('block_user',$blockid)->orwhereIn('block_user',$blockunder)->pluck('case_id')->toArray();

			$caseid= array_merge($caseauthbypid,$caseauthbyblockuser,$caseauthbyunderblock,$caseauthbyblockpartner,$caseauthbyguildmember,$caseauthbygroupmember,$caseauthbygrouppid,$caseauthbygrouppartner);
			$caseid =  array_unique($caseid);
			return $caseid;
		}

		public function findallunderblock($userid)
		{
		//  $notebook = array();
		$blockstartid = User_auth::where('user_id',$userid)->pluck('block_id')->toArray();
			$notebook =[];
			if(is_array($blockstartid))
			{
				$block = Block::whereIn('under_block',$blockstartid)->get();
			}
			else
			{
				$block = Block::where('under_block',$blockstartid)->get();
			}
			foreach ($block as $view) {

					 if(count($view->childs)) {
						 array_push($notebook,$view->id);
						 $notebook = $this->childallblock($view,$notebook);
					}
					array_push($notebook,$view->id);
			}
			if(is_array($blockstartid))
			{
				 $notebook=array_merge($notebook,$blockstartid);
			}
			else
			{
				array_push($notebook,$blockstartid);
			}
		 return array_unique($notebook);
		}
		public function childallblock($view,$notebook)
		{

			foreach ($view->childs as $arr) {

					if(count($arr->childs)){
									array_push($notebook,$arr->id);
									$notebook = $this->childblock($arr,$notebook);
							}
							array_push($notebook,$arr->id);


			}
			return $notebook;
		}
		public function userdata()
		{
			$users = DB::table('users')
			->leftJoin('structure', 'users.structure_id', '=', 'structure.id')
			->Join('match_id','match_id.user_id','=','users.id')

			->select('users.*','match_id.id as user_pid','users.id as user_id')
			->orderBy('id', 'DESC')
			->get();
			return $users;
		}
		public function structuredata()
		{
			return $structures = Structure::orderBy('id', 'DESC')->get();

		}
		public function blockdata($flagpaginate)
		{
			if($flagpaginate == 1)
			{
				$blocks = DB::table('block as b')
			 ->leftJoin('structure', 'b.structure_id', '=', 'structure.id')
			 ->leftJoin('block as bl', 'b.under_block', '=', 'bl.id')
			 ->select('b.*','b.name', 'bl.name as block_name', 'structure.name as structure_name', 'structure.id as structure_id')
			 ->paginate(20);
			}
			else
			{
				$blocks = DB::table('block as b')
			 ->leftJoin('structure', 'b.structure_id', '=', 'structure.id')
			 ->leftJoin('block as bl', 'b.under_block', '=', 'bl.id')
			 ->select('b.*','b.name', 'bl.name as block_name', 'structure.name as structure_name', 'structure.id as structure_id')
			 ->get();
			}
			return $blocks;
		}

}
