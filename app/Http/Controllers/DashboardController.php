<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\User_auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\SidebarController;
use App\Cases;
use App\Offer;
use App\Proposal;
use App\Case_log;
use App\Person;
use App\CaseAuth;
use App\Asset;

use App\Casemiddledata;
use Carbon\Carbon;
use App\Jobs\AddRenewCaseJobs;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
		 {
       $start = microtime(true);
       $queries = \DB::getQueryLog('asset');
       return $queries;
       $ass = Asset::whereNotNUll('created_from_caseid')->get();
       foreach($ass as $a)
       {
         if(in_array($a->la_nla_type,[6,10,11,12,13,14]))
         {
           $casedatefrom  = Cases::where('id',$a->created_from_caseid)->value('var_value5');
           $casedateto  = Cases::where('id',$a->created_from_caseid)->value('var_value52');
           $input = [
             'valid_from' => $casedatefrom,
             'valid_to' => $casedateto,

           ];
           Asset::where('id', $a->id)
               ->update($input);
         }
         elseif($a->la_nla_type == 9)
         {
           $casedatefrom  = Cases::where('id',$a->created_from_caseid)->value('var_value6');
           $casedateto  = Cases::where('id',$a->created_from_caseid)->value('var_value51');
           $input = [
             'valid_from' => $casedatefrom,
             'valid_to' => $casedateto,
           ];
           Asset::where('id', $a->id)
               ->update($input);
         }
         elseif($a->la_nla_type == 16)
         {
           $casedatefrom  = Cases::where('id',$a->created_from_caseid)->value('var_value7');
           $casedateto  = Cases::where('id',$a->created_from_caseid)->value('var_value53 ');
           $input = [
             'valid_from' => $casedatefrom,
             'valid_to' => $casedateto,

           ];
           Asset::where('id', $a->id)
               ->update($input);
         }

       }
       return $ass;
       $fromcase = Cases::find(47);
       if($fromcase->renew_case_id == NULL)
       {

       $case = New Cases;
       $case->name = $fromcase->name;
       $case->type_id = $fromcase->type_id;
       $case->sub_type_id =  $fromcase->sub_type_id;
       $case->created_by_pid = $fromcase->created_by_pid;
       $case->procedure_id	 = $fromcase->procedure_id;
       $case->stage =  $fromcase->stage;
       $case->referal_asset = $fromcase->referal_asset;
       $case->ref_previous_case = $fromcase->id;
       //$case->ref_name = $refname;
       $case->note_from_partner =  $fromcase->note_from_partner;
       $case->note_from_user =  $fromcase->note_from_user;
       $case->note_from_member =  $fromcase->note_from_member;
       $case->note_from_previous_case = $fromcase->note_to_copy_to_renew_case;
       $case->case_channel = $fromcase->case_channel;
       $case->case_status = 1;
       $case->member_case_owner = $fromcase->member_case_owner;
       $case->consult_partner_block_id = $fromcase->consult_partner_block_id;
       $case->service_user_block_id = $fromcase->service_user_block_id;
       $case->coordinate_user_block_id = $fromcase->coordinate_user_block_id;
       $case->case_created_date = $fromcase->case_created_date;
       //$case->auto_renew_date = '';
       //$case->next_notify_date = '';
       $case->require_value1 = $fromcase->require_value1;
       $case->require_value2 = $fromcase->require_value2;
       $case->require_value3 = $fromcase->require_value3;
       $case->require_value4 = $fromcase->require_value4;
       $case->require_value5 = $fromcase->require_value5;
       $case->require_value6 = $fromcase->require_value6;
       $case->require_value7 = $fromcase->var_value51;
       $case->require_value8 = $fromcase->var_value52;
       $case->require_value9 = $fromcase->var_value53;
       $case->require_value10 = $fromcase->require_value10;
       $case->require_value11 = $fromcase->require_value11;
       $case->require_value12 = $fromcase->require_value12;
       $case->require_value13 = $fromcase->require_value13;
       $case->require_value14 = $fromcase->require_value14;
       $case->require_value15 = $fromcase->require_value15;
       $case->require_value16 = $fromcase->require_value16;
       $case->require_value17 = $fromcase->require_value17;
       $case->require_value18 = $fromcase->require_value18;
       $case->require_value19 = $fromcase->require_value19;
       $case->require_value20 = $fromcase->require_value20;
       $case->save();
       $input = [
         'renew_case_id' => $case->id,
       ];
       Cases::where('id', $fromcase->id)
           ->update($input);
       $getoldcaseauth = CaseAuth::where('case_id',$fromcase->id)->get();
       foreach($getoldcaseauth as $getold)
       {
         $caseauth = New CaseAuth;
         $caseauth->case_id = $case->id;
         $caseauth->public_id = $getold->public_id;
         $caseauth->block_partner = $getold->block_partner;
         $caseauth->block_user = $getold->block_user;
         $caseauth->guild_member = $getold->guild_member;
         $caseauth->group_member = $getold->group_member;
         $caseauth->group_pid = $getold->group_pid;
         $caseauth->group_partner = $getold->group_partner;
         $caseauth->save();
       }

     }
     else
     {

     }
       date_default_timezone_set("Asia/Bangkok");

 $day = date("d");
   $month = date("m");
   $year = date("Y");
   $currentdate = $year.$month.$day;
 //  $array= array();
   $case = Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->whereNotNull('auto_renew_date')->whereNull('renew_case_id')->where('case_status',2)->where('id',47)->get();
$arr = array();
 foreach($case as $ca)
   {
     $explode = explode('/',$ca->auto_renew_date);
     $dayre = $explode[0];
     $monthre = $explode[1];
     $yearre = $explode[2]-543;
     $renewdate = $yearre.$monthre.$dayre;

           if(($renewdate-$currentdate) == 1)
     {
        $caseid = $ca->id;
         array_push($arr,$caseid);
        dispatch(new AddRenewCaseJobs($caseid))->delay(now()->addMinutes(1));

     }
 }
 return $arr;


       $var51 = "26/2/2563";
       $var52 = "27/2/2563";
       $var53 = "28/2/2563";
       if ($var51 != null ||$var51 != '') {
           $explode51 = explode('/', $var51);
           $day51 = $explode51[0];
           $month51 = $explode51[1];
           $year51 = $explode51[2];
           $var51merge = $year51.$month51.$day51;
           $var51 =$var51merge;
       }
       if ($var52 != null ||$var52 != '') {
           $explode52 = explode('/', $var52);
           $day52 = $explode52[0];
           $month52 = $explode52[1];
           $year52 = $explode52[2];
           $var52merge = $year52.$month52.$day52;
           $var52 = $var52merge;
       }
       if ($var53 != null ||$var53 != '') {
           $explode53 = explode('/', $var53);
           $day53 = $explode53[0];
           $month53 = $explode53[1];
           $year53 = $explode53[2];
           $var53merge = $year53.$month53.$day53;
           $var53 = $var53merge;
       }
       $findmin= min($var51, $var52, $var53);
       $dayplus = "-".'45'." day";
       $auto_renew_date = '';
       if ($var51 == $findmin) {
           $auto_renew_date =  date('d/m/Y', strtotime($var51 . $dayplus));
       } elseif ($var52 == $findmin) {
           $auto_renew_date =  date('d/m/Y', strtotime($var52 . $dayplus));
       } elseif ($var53 == $findmin) {
           $auto_renew_date =  date('d/m/Y', strtotime($var53 . $dayplus));
       } else {
           $auto_renew_date = '';
       }
       return $auto_renew_date;

      $blockid = 57;
    //   $block = Block::with(['Cases','Structure','belongtoblock'])->where('id',$blockid)->get();
       //$casemiddle = Casemiddledata::with(['offer','cases','cases.person'])->whereIn('case_id',$array)->pluck('case_id')->toArray();
       $casemiddle = Casemiddledata::with(['offer','cases','cases.person'])->pluck('case_id')->toArray();
       $findmember = Cases::whereIn('id',$casemiddle)->pluck('member_case_owner')->toArray();
       $member = Person::whereIn('id',$findmember)->get();
       $offer =  Cases::rightjoin('users','cases.coordinate_user_block_id','users.id')
      // ->whereIn('cases.id',$array)
      ->rightjoin('case_middle_data','case_middle_data.case_id','cases.id')
      ->rightjoin('offer','case_middle_data.offer_id','offer.id')
       ->select([DB::raw("COUNT(coordinate_user_block_id) as total_case"),DB::raw("SUM(offer.offer_payment_value10) as total_fee"),'users.id as user_id','users.firstname as user_name'])
         ->groupBy('users.id')->orderBy('total_case','DESC')
         ->get();
         return $offer;

       $case = Cases::pluck('id')->toArray();
        Case_log::WhereNotIn('case_id', $case)->delete();
		 //  $notebook = array();
     $blockstartid = 71;
			 $notebook =[];
			array_push($notebook,$blockstartid);
			$block = Block::where('under_block',$blockstartid)->get();
			 foreach ($block as $view) {

						if(count($view->childs)) {
							array_push($notebook,$view->id);
							$notebook = $this->childblock($view,$notebook);
					 }
           array_push($notebook,$view->id);
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
    public function save()
    {
    /*  return  $offer =  Offer::rightjoin('case_middle_data','case_middle_data.offer_id','offer.id')
                          ->rightjoin('portfolio','case_middle_data.port_id','portfolio.id')
                          ->join('block','portfolio.block_id','block.id')
                          ->select([DB::raw("SUM(offer_payment_value1) as total_premium"),'offer.*','case_middle_data.*','portfolio.type','block.name'])
                          ->groupBy('case_middle_data.port_id')
        ->get();*/
      /*  $input = [
            'port_id' => '843',

        ];
        Casemiddledata::where('port_id', 833)
            ->update($input);*/
            return  $offer =  Cases::rightjoin('block','cases.service_user_block_id','block.id')
            ->rightjoin('structure','block.structure_id','structure.id')
            ->rightjoin('block as block_under','block.under_block','block_under.id')
            ->select([DB::raw("COUNT(service_user_block_id) as total_case"),'block.name','block_under.name as block_under_name'])
              ->groupBy('block.id')->orderBy('total_case','DESC')
              ->get();

            return  $offer =  Offer::rightjoin('proposal','offer.proposal_id','proposal.id')
              ->rightjoin('cases','proposal.case_id','cases.id')
              ->rightjoin('case_middle_data','case_middle_data.case_id','cases.id')
              ->rightjoin('block','cases.service_user_block_id','block.id')
              ->rightjoin('block as block_under','block.under_block','block_under.id')
              ->select([DB::raw("SUM(offer_payment_value19) as total_premium"),'block.id','block.name','block_under.name as under_block_name'])
              ->groupBy('block.id')->orderBy('total_premium','DESC')
              ->get();
            //////////////
            return  $offer =  Offer::rightjoin('proposal','offer.proposal_id','proposal.id')
              ->rightjoin('cases','proposal.case_id','cases.id')
              ->rightjoin('case_middle_data','case_middle_data.case_id','cases.id')
              ->rightjoin('persons','cases.member_case_owner','persons.id')
              ->rightjoin('portfolio','portfolio.id','case_middle_data.port_id')
              ->rightjoin('block','portfolio.block_id','block.id')
              ->select([DB::raw("SUM(offer_payment_value1) as total_premium"),'persons.name','persons.lname','portfolio.type as port_name','portfolio.id as port_id','block.name as blockportname'])
              ->groupBy('portfolio.id')->orderBy('total_premium','DESC')
              ->get();
              //////////////////
  /*  return  $offer =  Cases::rightjoin('persons','cases.member_case_owner','persons.id')
    //  ->select([DB::raw("COUNT(member_case_owner) as total_case"),'persons.name','persons.lname','portfolio.type as port_name','portfolio.id as port_id','block.name as blockportname','cases.id as case_id'])
    ->select([DB::raw("COUNT(member_case_owner) as total_case"),'persons.name','persons.lname'])
      ->groupBy('persons.id')->orderBy('total_case','DESC')
      ->get();*/
////////////
/*return  $offer =  Cases::rightjoin('portfolio','portfolio.member_id','cases.member_case_owner')
  ->rightjoin('persons','persons.id','portfolio.member_id')
  ->rightjoin('block','portfolio.block_id','block.id')
  ->rightjoin('proposal','proposal.case_id','cases.id')
  ->rightjoin('case_middle_data','proposal.case_id','cases.id')
  ->rightjoin('offer','offer.proposal_id','proposal.id')
//  ->select([DB::raw("COUNT(member_case_owner) as total_case"),'persons.name','persons.lname','portfolio.type as port_name','portfolio.id as port_id','block.name as blockportname','cases.id as case_id'])
->select([DB::raw("SUM(offer.offer_payment_value1) as total_case"),'offer.name as offer_name','block.name as block_port_name','portfolio.id as port_id','portfolio.type as port_name','persons.name','persons.lname'])
  ->groupBy('portfolio.id')->orderBy('total_case','DESC')
  ->get();*/
  return  $offer =  Cases::rightjoin('block','cases.service_user_block_id','block.id')
  ->rightjoin('structure','block.structure_id','structure.id')
  ->rightjoin('block as block_under','block.under_block','block_under.id')
  ->select([DB::raw("COUNT(service_user_block_id) as total_case"),'block.name','block_under.name as block_under_name'])
    ->groupBy('block.id')->orderBy('total_case','DESC')
    ->get();

  return  $offer =  Cases::rightjoin('block','cases.service_user_block_id','block.id')
  ->rightjoin('structure','block.structure_id','structure.id')
  ->rightjoin('block as block_under','block.under_block','block_under.id')
  ->select([DB::raw("COUNT(service_user_block_id) as total_case"),'block.name','block_under.name as block_under_name'])
    ->groupBy('block.id')->orderBy('total_case','DESC')
    ->get();

return  $offer =  Cases::rightjoin('persons','cases.member_case_owner','persons.id')
//  ->select([DB::raw("COUNT(member_case_owner) as total_case"),'persons.name','persons.lname','portfolio.type as port_name','portfolio.id as port_id','block.name as blockportname','cases.id as case_id'])
->select([DB::raw("COUNT(member_case_owner) as total_case"),'persons.name','persons.lname'])
  ->groupBy('persons.id')->orderBy('total_case','DESC')
  ->get();
      /*$hive_count = DB::table('case_middle_data')
              //    ->where('active','true')
                  ->join('offer', 'case_middle_data.offer_id', '=', 'offer.id')
                  ->groupBy('offer_id')
                  ->selectRaw('sum(offer.offer_payment_value1) as sum, case_middle_data.* ')
                  ->orderBy('sum','DESC')->get();
                  return $hive_count;*/
      return Casemiddledata::join('offer', 'case_middle_data.offer_id', '=', 'offer.id')
        ->select([DB::raw("SUM(offer.offer_payment_value1) as total_premium"),'case_middle_data.*'])
        ->get();
      $casemid = Casemiddledata::with(['offer','cases','cases.person'])->get()->groupBy("port_id");

      return $casemid;
      foreach($casemid as $key => $ca)
      {
         foreach($ca as $c)
         {
           return $c;
         }
      }
      $offer = DB::table('offer')->whereIn('proposal_id',['47','28'])
      ->orderByRaw(DB::raw("SUM(offer_payment_value1)"))->get();

      return $offer;
        $case  = DB::table('cases')
        ->Join('proposal','proposal.case_id','cases.id')
        ->Join('offer','offer.proposal_id','proposal.id')
        ->select('cases.*','proposal.id','offer.id')
        ->get()->groupBy('member_case_owner');
      //  return $case;
          $casemiddledata = DB::table('case_middle_data')->select('case_middle_data.*','offer.offer_payment_value4 as netpremium ','cases.member_case_owner as member_id',DB::raw('(SELECT SUM(offer_payment_value4) FROM offer WHERE id = offer_id) as balance'))

        ->leftJoin('offer','case_middle_data.offer_id','offer.id')
        ->leftJoin('cases','case_middle_data.case_id','cases.id')

        ->get()->groupBy('member_id');
        /*$customers = User::select("*",
                   \DB::raw('(SELECT SUM(amount) FROM customer_balances WHERE customer_balances.customer_id = customers.id) as balance'))
            ->orderBy('balance', 'DESC')
            ->get()
            ->toArray();*/

        return $casemiddledata;

        return view('dashboard');
    }


}
