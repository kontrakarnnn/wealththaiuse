<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\ActionCategory;
use App\User;
use App\User_auth;
use App\Partner;
use App\Partner_block;
use App\CaseChannel;
use App\Person;
use App\Member_type;
use App\Country;
use App\Subdistrict;
use App\District;
use App\Province;
use App\Asset_type;
use App\match_member_id;
use App\Portfolio;
use App\Asset;
use App\CaseCategory;
use App\CaseType;
use App\CaseSubType;
use App\Cases;
use App\match_id;
use App\Procedures_To_Process;
use App\Process;
use App\Member_group;
use App\Family;
use App\Pid_group;
use App\Partner_group;
use App\CaseAuth;
use App\File;
use App\Asset_Attacht;
use App\Case_Attacht;
use App\Offer;
use App\OfferType;
use App\Proposal;
use App\Case_proposal;
use App\Case_log;
use App\Casemiddledata;
use App\Casemiddledatatype;
use App\Offer_Attacht;
use App\Promotion;
use App\Case_condition;
use App\CaseAction;
use App\Stage;
use App\CaseStatus;
use PDF;
use App\Http\Controllers\CaseCenterController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ConsildateQuotationController;
use App\Http\Controllers\QuotationCustomerController;
use App\Http\Controllers\ConsolidateQuotationCustomerController;

use FPDF;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\SidebarController;
use App\Http\Controllers\DataController;

class InsuranceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     protected $datacenter;

    public function __construct()
    {
        $this->middleware('view');
        $this->datacenter = new DataController;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatestage()
    {
        $url = $_SERVER['REQUEST_URI'];
        $caseid = 0;
        if (strstr($url, '?fromcase')) {
            $caseid = explode('?fromcase', $url);
            $caseid = $caseid[1];
            $casecenter = new CaseCenterController();
            $inputtocasecondition = $casecenter->putpathconincasecon($caseid);
            $checkcondition =$casecenter->checkcondition($caseid);
            $stagemove =$casecenter->stagemove($caseid);
            $case = Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->find($caseid);

            if ($case->stage == 42) {
                $input = [
                'case_status' => 2,
              ];
                Cases::where('id', $caseid)
                  ->update($input);
            }
            return $case;
        }
    }
    public function consolidatequotationcustomer($id)
    {
        $consolidatequotation = new ConsolidateQuotationCustomerController();
        $consolidatequotation = $consolidatequotation->consolidatequotationcustomer($id);
        return $consolidatequotation;
    }
    public function consolidatequotation($id)
    {
        $consolidatequotation = new ConsolidateQuotationController();
        $consolidatequotation = $consolidatequotation->consolidatequotation($id);
        return $consolidatequotation;
    }
    public function quotationcustomer($id)
    {
        $quotationcustomer = new QuotationCustomerController();
        $quotationcustomer = $quotationcustomer->quotationcustomer($id);
        return $quotationcustomer;
    }
    public function quotation($id)
    {
        $quotation = new QuotationController();
        $quotation = $quotation->quotation($id);
        return $quotation;
    }
    public function invoice($id)
    {
        $invoice = new InvoiceController();
        $invoice = $invoice->invoice($id);
        return $invoice;
    }
    public function allcasebystage()
    {
      $url = $_SERVER['REQUEST_URI'];
      $flagbutton = 0;
      if(strstr($url,'?alludb=1'))
      {
        $flagbutton  =1;
        $casecansee =  $this->datacenter->showcasecanseeall();
      }
      else
      {
        $casecansee =  $this->datacenter->showcasecansee();
      }

        $stage = Stage::WhereNotIn('id', [6,7,8,9,10,11,12,13,14,15,16,17])->get();
        return view('system-mgmt/insurance/bystage', compact(['stage','casecansee','flagbutton']));
    }
    public function allcasebystageuser()
    {
      $url = $_SERVER['REQUEST_URI'];
      $flagbutton = 0;
      if(strstr($url,'?alludb=1'))
      {
        $flagbutton  =1;
        $casecansee =  $this->datacenter->showcasecanseeall();
      }
      else
      {
        $casecansee =  $this->datacenter->showcasecansee();
      }

        $stage = Stage::WhereNotIn('id', [6,7,8,9,10,11,12,13,14,15,16,17])->get();
        return view('system-mgmt/insurance/bystageuser', compact(['stage','casecansee','flagbutton']));
    }
    public function loadcaseaction()
    {
        $url = $_SERVER['REQUEST_URI'];
        $caseid = 0;
        if (strstr($url, '?fromcase')) {
            $caseid = explode('?fromcase', $url);
            $caseid = $caseid[1];
            return CaseAction::with(['stage','stageaction','cases','action'])->where('case_id', $caseid)->get();
        }
    }
    public function recheckoffer()
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $url = $_SERVER['REQUEST_URI'];
        $caseid = 0;

        if (strstr($url, '?fromcase')) {
            $caseid = explode('?fromcase', $url);
            $caseid = $caseid[1];
            if(strstr($url,'?already'))
            {
              $input = ['condition_flag' => 0];
              $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', 70)
              ->update($input);
              $input = [
             'var_value129' => 2,
           ];
            }
            else {
              $input = [
                'stage' => 36,
             'var_value129' => 1,
           ];
            }
            Cases::where('id', $caseid)
             ->update($input);
            return Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->find($caseid);
        }
    }
    public function updatecasepayment(Request $req)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $case = Cases::find($req->id);
        $case->var_value26 =$req->varvalue26;
        $case->var_value27 =$req->varvalue27;
        $case->var_value28 =$req->varvalue28;
        $case->var_value29 =$req->varvalue29;
        $case->var_value30 =$req->varvalue30;
        $case->var_value31 =$req->varvalue31;
        $case->var_value32 =$req->varvalue32;
        $case->var_value33 =$req->varvalue33;
        $case->var_value34 =$req->varvalue34;
        $case->var_value35 =$req->varvalue35;
        $case->var_value36 =$req->varvalue36;
        $case->var_value37 =$req->varvalue37;
        $case->var_value5 =$req->varvalue5;
        $case->var_value6 =$req->varvalue6;
        $case->var_value7 =$req->varvalue7;
        $case->var_value17 =$req->varvalue17;
        $case->var_value18 =$req->varvalue18;
        $case->var_value19 =$req->varvalue19;
        $case->var_value52 =$req->varvalue52;
        $case->var_value51 =$req->varvalue51;
        $case->var_value53 =$req->varvalue53;

        $case->last_updated_date = $day."/".$month."/".$year;
        $case->save();
        return Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->where('id', $req->id)->get();
    }
    public function updatecasetracking(Request $req)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $var51 = 100000000000;
        $var52 = 100000000000;
        $var53 = 100000000000;
        $findcasetype = Cases::find($req->id);
        $casetype = CaseType::find($findcasetype->type_id);
        $case = Cases::find($req->id);
        $case->var_value1 =$req->var1;
        $case->var_value5 =$req->var5;
        $case->var_value6 =$req->var6;
        $case->var_value7 =$req->var7;
        $case->var_value8 =$req->var8;
        $case->var_value9 =$req->var9;
        $case->var_value10 =$req->var10;
        $case->var_value11 =$req->var11;
        $case->var_value12 =$req->var12;
        $case->var_value13 =$req->var13;
        $case->var_value14 =$req->var14;
        $case->var_value15 =$req->var15;
        $case->var_value16 =$req->var16;
        $case->var_value17 =$req->var17;
        $case->var_value18 =$req->var18;
        $case->var_value19 =$req->var19;
        $case->var_value20 =$req->var20;
        $case->var_value21 =$req->var21;
        $case->var_value22 =$req->var22;
        $case->var_value23 =$req->var23;
        $case->var_value24 =$req->var24;
        $case->var_value25 =$req->var25;
        $case->var_value51 =$req->var51;
        $case->var_value52 =$req->var52;
        $case->var_value53 =$req->var53;
        if ($req->var51 != null ||$req->var51 != '') {
            $explode51 = explode('/', $req->var51);
            $day51 = $explode51[0];
            $month51 = $explode51[1];
            $year51 = $explode51[2];
            $var51merge = $year51.$month51.$day51;

            $var51 =$var51merge;
        }
        if ($req->var52 != null ||$req->var52 != '') {
            $explode52 = explode('/', $req->var52);
            $day52 = $explode52[0];
            $month52 = $explode52[1];
            $year52 = $explode52[2];
            $var52merge = $year52.$month52.$day52;
            $var52 = $var52merge;
        }
        if ($req->var53 != null ||$req->var53 != '') {
            $explode53 = explode('/', $req->var53);
            $day53 = $explode53[0];
            $month53 = $explode53[1];
            $year53 = $explode53[2];
            $var53merge = $year53.$month53.$day53;
            $var53 = $var53merge;
        }
        $findmin= min($var51, $var52, $var53);
        $dayplus = "-".$casetype->day_auto_renew." day";
        if ($var51 == $findmin) {
            $case->auto_renew_date =  date('d/m/Y', strtotime($var51 . $dayplus));
        } elseif ($var52 == $findmin) {
            $case->auto_renew_date =  date('d/m/Y', strtotime($var52 . $dayplus));
        } elseif ($var53 == $findmin) {
            $case->auto_renew_date =  date('d/m/Y', strtotime($var53 . $dayplus));
        } else {
            $case->auto_renew_date = '';
        }
        if ($findmin == 100000000000) {
            $case->auto_renew_date = '';
        }
        $case->last_updated_date = $day."/".$month."/".$year;
        $case->save();
        return Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->where('id', $req->id)->get();
    }
    public function casecancel(Request $res)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $time = date('H:i:s');
        $url = $_SERVER['REQUEST_URI'];
        $caseid = $res->id;

            $casecurrentstage = Cases::where('id', $caseid)->value('stage');
            $input = [
           'var_value130' => 1,
           'case_status' => 3,
           'cancel_date' => $day."/".$month."/".$year,
           'stage' => 31,
         ];
            Cases::where('id', $caseid)
             ->update($input);

            $caselog = new Case_log;
            $caselog->case_id = $caseid;
            $caselog->date_time =  $day."/".$month."/".$year." ".$time;
            $caselog->move_from_stage = $casecurrentstage;
            $caselog->move_to_stage = 31;
            //   $caselog->moving_path = $pathid;
            //    $caselog->condition_match = $pathcon;
            $caselog->description = $res->notecancel;
            $caselog->save();
            return Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->find($caseid);

    }
    public function renewcase()
    {
        $url = $_SERVER['REQUEST_URI'];
        $caseid = 0;
        if (strstr($url, '?fromcase')) {
            $caseid = explode('?fromcase', $url);
            $caseid = $caseid[1];
            $fromcase = Cases::find($caseid);
            $case = new Cases;
            $case->name = $fromcase->name;
            $case->type_id = $fromcase->type_id;
            $case->sub_type_id =  $fromcase->sub_type_id;
            $case->created_by_pid = $fromcase->created_by_pid;
            $case->procedure_id	 = $fromcase->procedure_id;
            $case->stage =  32;
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
        }
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
        if ($caseid == 0) {
            return "No";
        } else {
            return Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->where("id", $caseid)->get();
        }
    }
    public function updatesomecase(Request $req)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $case = Cases::find($req->id);
        $url = $_SERVER['REQUEST_URI'];

        if (strstr($url, '?noteprevcase')) {
            $case->note_from_previous_case =$req->noteprevcase;
        }
        if (strstr($url, '?notenextcase')) {
            $case->note_to_copy_to_renew_case =$req->notenextcase;
        }
        if (strstr($url, '?notefrommember')) {
            $case->note_from_member =$req->notefrommember;
        }
        if (strstr($url, '?notefromuser')) {
            $case->note_from_user =$req->notefromuser;
        }
        if (strstr($url, '?notefrompartner')) {
            $case->note_from_partner =$req->notefrompartner;
        }
        if (strstr($url, '?fixins38')) {
            $case->var_value38 =$req->fixins38;
        }
        if (strstr($url, '?fixins39')) {
            $case->var_value39 =$req->fixins39;
        }
        if (strstr($url, '?fixins40')) {
            $case->var_value40 =$req->fixins40;
        }
        if (strstr($url, '?fixins41')) {
            $case->var_value41 =$req->fixins41;
        }
        if (strstr($url, '?fixins42')) {
            $case->var_value42 =$req->fixins42;
        }
        if (strstr($url, '?fixins43')) {
            $case->var_value43 =$req->fixins43;
        }
        if (strstr($url, '?fixins44')) {
            $case->var_value44 =$req->fixins44;
        }
        if (strstr($url, '?fixins45')) {
            $case->var_value45 =$req->fixins45;
        }
        if (strstr($url, '?fixins46')) {
            $case->var_value46 =$req->fixins46;
        }
        if (strstr($url, '?fixins11')) {
            $case->var_value11 =$req->fixins11;
        }
        if (strstr($url, '?fixins52')) {
            $case->var_value52 =$req->fixins52;
        }
        if (strstr($url, '?fixins14')) {
            $case->var_value14 =$req->fixins14;
        }
        if (strstr($url, '?fixins15')) {
            $case->var_value15 =$req->fixins15;
        }
        if (strstr($url, '?fixins12')) {
            $case->var_value12 =$req->fixins12;
        }
        if (strstr($url, '?fixins51')) {
            $case->var_value51 =$req->fixins51;
        }
        if (strstr($url, '?fixins13')) {
            $case->var_value13 =$req->fixins13;
        }
        if (strstr($url, '?fixins16')) {
            $case->var_value16 =$req->fixins16;
        }
        if (strstr($url, '?fixins53')) {
            $case->var_value53 =$req->fixins53;
        }
        if (strstr($url, '?fixins47')) {
            $case->var_value47 =$req->fixins47;
        }
        if (strstr($url, '?fixins48')) {
            $case->var_value48 =$req->fixins48;
        }
        if (strstr($url, '?fixins49')) {
            $case->var_value49 =$req->fixins49;
        }
        if (strstr($url, '?fixins50')) {
            $case->var_value50 =$req->fixins50;
        }
        if (strstr($url, '?fixins55')) {
            $case->var_value55 =$req->fixins55;
        }
        if (strstr($url, '?fixins56')) {
            $case->var_value56 =$req->fixins56;
        }
        if (strstr($url, '?fixins57')) {
            $case->var_value57 =$req->fixins57;
        }
        if (strstr($url, '?fixins58')) {
            $case->var_value58 =$req->fixins58;
        }
        if (strstr($url, '?fixins54')) {
            $case->var_value54 =$req->fixins54;
        }
        if (strstr($url, '?fixins59')) {
            $case->var_value59 =$req->fixins59;
        }
        if (strstr($url, '?fixins60')) {
            $case->var_value60 =$req->fixins60;
        }
        if (strstr($url, '?fixins61')) {
            $case->var_value61 =$req->fixins61;
        }
        if (strstr($url, '?fixins62')) {
            $case->var_value62 =$req->fixins62;
        }
        if (strstr($url, '?fixins63')) {
            $case->var_value63 =$req->fixins63;
        }
        if (strstr($url, '?fixins64')) {
            $case->var_value64 =$req->fixins64;
        }
        if (strstr($url, '?fixins65')) {
            $case->var_value65 =$req->fixins65;
        }
        if (strstr($url, '?fixins66')) {
            $case->var_value66 =$req->fixins66;
        }
        if (strstr($url, '?fixins67')) {
            $case->var_value67 =$req->fixins67;
        }
        if (strstr($url, '?fixins68')) {
            $case->var_value68 =$req->fixins68;
        }
        if (strstr($url, '?fixins69')) {
            $case->var_value69 =$req->fixins69;
        }
        $case->last_updated_date = $day."/".$month."/".$year;
        $case->save();
        return Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->where('id', $req->id)->get();
    }
    public function loadeditcase()
    {
        $url = $_SERVER['REQUEST_URI'];
        $caseid = 0;
        if (strstr($url, '?filtercase')) {
            $caseid = explode('?filtercase', $url);
            $caseid = $caseid[1];
        }
        return Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->find($caseid);
    }
    public function loadcasecondition()
    {
        $url = $_SERVER['REQUEST_URI'];
        $stageid = 0;
        if (strstr($url, '?filterstage')) {
            $stageid = explode('?filterstage', $url);
            $stageid = explode('?filtercase', $stageid[1]);

            $stage = $stageid[0];

            $caseid = $stageid[1];
        }
        return Case_condition::with(['path_condition_detail'])->where('current_stage', $stage)->where('condition_flag', 1)->where('case_id', $caseid)->get();
    }
    public function caselogload()
    {
        $url = $_SERVER['REQUEST_URI'];
        $caseid = 0;
        if (strstr($url, '?filtercase')) {
            $caseid = explode('?filtercase', $url);
            $caseid = $caseid[1];
            return Case_log::with(['cases','movefromstage','movetostage','path','pathcondition'])->where('case_id', $caseid)->get();
        }
    }
    public function loadpromotion()
    {
        return Promotion::all();
    }
    public function storecaseproposaloffer(Request $req)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        Casemiddledata::where('case_id', $req->caseid)->delete();
        foreach ($req->offerid as $key) {
            $file = Offer_Attacht::where('id', $key)->value('file_id');

            $input = [
              'middle_data_type' => 1,
              'case_id' => $req->caseid,
              'offer_id' => $key,
              'asset_id' => $req->assetid,
              'port_id' => $req->portid,
              //'file_id' => $req->assetid,
            ];
            $findoffer = Offer::find($key);
            if ($findoffer->type_id == 1 ||$findoffer->type_id == 2 ||$findoffer->type_id == 3 ||$findoffer->type_id == 4 ||$findoffer->type_id == 5 ||$findoffer->type_id == 6) {
                $inputvar3 = ['var_value3' => $day."/".$month."/".$year,];
                Cases::where('id', $req->caseid)->update($inputvar3);
            }
            if ($findoffer->type_id == 7) {
                $inputvar2 = ['var_value2' => $day."/".$month."/".$year,];
                Cases::where('id', $req->caseid)->update($inputvar2);
            }
            if ($findoffer->type_id == 8) {
                $inputvar4 = ['var_value4' => $day."/".$month."/".$year,];
                Cases::where('id', $req->caseid)->update($inputvar4);
            }
            Casemiddledata::insert($input);
        }
    }
    public function updateofferdelete(Request $request)
    {
        $proposal = Offer::find($request->offerid);
        $proposal->interest = 0;
        $proposal->save();
        $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $request->caseid)->pluck('id')->toArray();
        $caseporposaloffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->get();
        return $caseporposaloffer;
    }
    public function updateofferclick(Request $request)
    {
        $offerclicked = Offer::find($request->offerid);
        $offerclicked->offer_payment_value18 = $request->discountuserlv;
        $offerclicked->offer_payment_value19 = $request->servicefee;
        $offerclicked->save();
        return $offerclicked;
    }
    public function updateoffer(Request $request)
    {
        $proposal = Offer::find($request->offerid);
        $proposal->interest = $request->flaginterest;
        $proposal->save();
        $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $request->caseid)->pluck('id')->toArray();
        $caseporposaloffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->get();
        return $caseporposaloffer;
    }
    public function updateproposal(Request $request)
    {
        $proposal = Proposal::find($request->proposalid);
        $proposal->name = $request->proposalname;
        $proposal->partner_block =$request->partnerblockid;
        $proposal->description = $request->description;
        $proposal->save();
        return Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $request->caseid)->get();
    }
    public function storeproposal(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $date = $day.'/'.$month.'/'.$year;
        $currentid = Auth::user()->id;
        $publicid = match_id::where('user_id', $currentid)->value('id');
        Proposal::create([
            'name' => $request['proposalname'],
            'case_id' => $request['caseid'],
            'created_date' => $date,
            'created_by' => $publicid,
            'partner_block' => $request['partnerblockid'],
            'user_block' => $request['user_block'],
            'member_id' => $request['member_id'],
            'description' => $request['description'],
         ]);
        return Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $request->caseid)->get();
    }
    public function offer()
    {
        $offer = Offer::with(['promotion','campaign','OfferType'])->get();
        return view('system-mgmt/insurance/offer', compact(['offer']));
    }
    public function loadlastestoffer()
    {
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, '?filteroffer')) {
            $arrayoffer = [];
            $exurl = explode('?filteroffer', $url);
            $caseid = $exurl[1];
            $casemiddledata = Casemiddledata::where('case_id', $caseid)->pluck('offer_id')->toArray();
            $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $caseid)->pluck('id')->toArray();
            $caseporposaloffer = Offer::with(['OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->where('interest', 1)->pluck('id')->toArray();
            $lastestoffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->orderBy('id', 'desc')->take(5)->get();

            foreach ($lastestoffer as $last) {
                if (in_array($last->id, $caseporposaloffer)||in_array($last->id, $casemiddledata)) {
                } else {
                    $arrayoffer[] = $last;
                }
            }
            return $arrayoffer;
        } else {
            $arrayoffer = [];
            $caseporposaloffer = Offer::with(['OfferType','match_id','Person','branch'])->where('interest', 1)->pluck('id')->toArray();
            $lastestoffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->orderBy('id', 'DESC')->take(5)->get();
            foreach ($lastestoffer as $last) {
                if (in_array($last->id, $caseporposaloffer)) {
                } else {
                    $arrayoffer[] = $last;
                }
            }
            return $arrayoffer;
        }
    }
    public function confirmofferload()
    {
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, '?filteroffer')) {
            $exurl = explode('?filteroffer', $url);
            $caseid = $exurl[1];
            $casemiddledata = Casemiddledata::where('case_id', $caseid)->pluck('offer_id')->toArray();
            $caseporposaloffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->get();
        } else {
            $casemiddledata = Casemiddledata::pluck('offer_id')->toArray();
            $caseporposaloffer = Offer::with(['promotion','campaign','OfferType','OfferType','OfferType','Proposal','match_id','Person','branch'])->whereIn('id', $casemiddledata)->get();
        }
        return $caseporposaloffer;
    }
    public function loadconfirmoffer()
    {
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, '?filteroffer')) {
            $exurl = explode('?filteroffer', $url);
            $caseid = $exurl[1];
            $casemiddledata = Casemiddledata::where('case_id', $caseid)->pluck('offer_id')->toArray();
        } else {
            $casemiddledata = Casemiddledata::pluck('offer_id')->toArray();
        }
        return $casemiddledata;
    }
    public function loadinterestoffer()
    {
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, '?filteroffer')) {
            $arrayoffer = [];
            $exurl = explode('?filteroffer', $url);
            $caseid = $exurl[1];
            $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $caseid)->pluck('id')->toArray();
            $casemiddledata = Casemiddledata::where('case_id', $caseid)->pluck('offer_id')->toArray();
            $caseporposaloffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->where('interest', 1)->get();
            foreach ($caseporposaloffer as $last) {
                if (in_array($last->id, $casemiddledata)) {
                } else {
                    $arrayoffer[] = $last;
                }
            }
            return $arrayoffer;
        } else {
            $caseporposaloffer = Offer::with(['OfferType'])->where('interest', 1)->get();
        }
        // return $caseporposaloffer;
    }

    public function loadproposal()
    {
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, '?filterproposal')) {
            $exurl = explode('?filterproposal', $url);
            $caseid = $exurl[1];
            $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $caseid)->get();
        } else {
            $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->get();
        }
        return $proposal;
    }
    public function loadalloffer()
    {
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, '?filteroffer')) {
            $exurl = explode('?filteroffer', $url);
            $caseid = $exurl[1];
            $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $caseid)->pluck('id')->toArray();
            $caseporposaloffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->get();
        } else {
            $caseporposaloffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->get();
        }
        return $caseporposaloffer;
    }
    public function loadoffer(Request $res)
    {
        $caseporposaloffer = Case_proposal::with(['Proposal','Offer','Cases'])->where('case_id', $res->caseid)->get();
        return $caseporposaloffer;
    }
    public function loadcases()
    {
      $url = $_SERVER['REQUEST_URI'];
      if(strstr($url,'?alludb=1'))
      {
        $casecansee =  $this->datacenter->showcasecanseeall();
      }
      else
      {
        $casecansee =  $this->datacenter->showcasecansee();
      }
        $url = $_SERVER['REQUEST_URI'];
        if (strstr($url, '?filtercase')) {
            $exurl = explode('?filtercase', $url);
            $caseid = $exurl[1];
            $cases = Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->where('case_status',1)->find($caseid);
        } elseif (strstr($url, '?filterstage')) {
            $exurl2 = explode('?filterstage', $url);
            $stageid = $exurl2[1];
            $cases = Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->where('case_status',1)->where('stage', $stageid)->get();
        } else {
            // $cases = Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->paginate(25);
            $cases = Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->where('case_status',1)->whereIn('id',$casecansee)->get();
        }
        return $cases;
    }
    public function loadcasesdetail($id)
    {
        $cases = Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->where('id', $id)->get();
        return $cases;
    }
    public function allcase()
    {
        return view('system-mgmt/insurance/allcase');
    }
    public function allcaseuser()
    {
        return view('system-mgmt/insurance/allcaseuser');
    }
    public function searchcase()
    {
      return view('system-mgmt/insurance/searchcase');
    }
    public function searchcaseuser()
    {
      return view('system-mgmt/insurance/searchcaseuser');
    }
    public function casestatus()
    {
      return CaseStatus::all();
    }
    public function alluser()
    {
      return User::all();
    }
    public function searchcasepost(Request $request)
    {

      if($request['caseacceptdate'] == '//')
      {
        $request['caseacceptdate']= '';
      }
      if($request['finisheddate'] == '//')
      {
        $request['finisheddate']= '';
      }
      $constraints = [
          'name' => $request['casename'],
          'id' => $request['casecode'],
          'type_id' => $request['casetype'],
          'case_status' => $request['casestatus'],
          'case_channel' => $request['casechannel'],
          'case_created_date' => $request['caseacceptdate'],
          'finish_date' => $request['finisheddate'],
          'service_user_block_id' => $request['userblock'],
          'coordinate_user_block_id' => $request['coordinate'],
          'consult_partner_block_id' => $request['partnerblock'],
          'persons.name' => $request['membername'],
          'persons.lname' => $request['memberlname'],
          'asset.name' => $request['assetname'],
          'asset.ref_name' => $request['assetrefname'],
          'match_id.public_name' => $request['advisorname'],
          /*'structure.name' => $request['structure_name'],
          'block.name' => $request['block_name'],
          'users.username' => $request['user_name'],
          'persons.name' => $request['member_name'],
          'persons.lname' => $request['member_last_name'],
        //  'port_types.type' => $request['port_name'],
          'status' => $request['status'],
            'portfolio_type' => $request['portfolio_type']*/
          ];

     $data = $this->doSearchingQuerycase($request,$constraints);
      return  $data;
    }
    private function doSearchingQuerycase(Request $request ,$constraints ) {
        $query = DB::table('cases')
         ->leftJoin('case_type', 'cases.type_id', '=', 'case_type.id')
         ->leftJoin('case_status', 'cases.case_status', '=', 'case_status.id')
         ->leftJoin('block', 'cases.service_user_block_id', '=', 'block.id')
         ->leftJoin('users', 'cases.coordinate_user_block_id', '=', 'users.id')
         ->leftJoin('partner_block', 'cases.consult_partner_block_id', '=', 'partner_block.id')
         ->leftJoin('persons', 'cases.member_case_owner', '=', 'persons.id')
         ->leftJoin('asset', 'cases.referal_asset', '=', 'asset.id')
         ->leftJoin('match_id', 'persons.ref_member_pid', '=', 'match_id.id')
         ->select('cases.*','block.name as block_name','case_type.name as type_name','case_status.name as status_name'
        ,'users.firstname as coordinator_name','partner_block.name as partner_block_name','persons.name as member_name'
        ,'persons.lname as member_lname','asset.name as asset_name','asset.ref_name as asset_refname','match_id.public_name as advisor_name');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->get();
    }
    public function getcaseport($id)
    {

      $cases = Cases::with(['Person','Renewcases','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->find($id);
      $url = $_SERVER['REQUEST_URI'];
      if(strstr($url,'?frommember'))
      {
        $userblock = explode('?userid=',$url);
        $userblock = $userblock[1];
        $alluserblockid =    $this->datacenter->findunderblock($userblock);
        $portfolio = Portfolio::where('member_id',$id)->whereIn('block_id',$alluserblockid)->get();
      }
      else
      {
        $alluserblockid =    $this->datacenter->findunderblock($cases->service_user_block_id);
        $portfolio = Portfolio::where('member_id',$cases->member_case_owner)->whereIn('block_id',$alluserblockid)->get();
      }
      return $portfolio;
    }
    public function storeport(Request $res)
    {
      $url =$_SERVER['REQUEST_URI'];
      if(strstr($url,'?fromaddcase'))
      {
        $addport = New Portfolio;
        $addport->type = $res->portname;
        $addport->number =$res->portnumber;
        $addport->structure_id  = 14;
        $addport->block_id = $res->userblock;
        $addport->member_id = $res->memberid;
        $addport->port_id = 31;
        $addport->description = $res->description ;
        $addport->status = "Active" ;
        $addport->save();
        $alluserblockid =    $this->datacenter->findunderblock($res->userblock);
        $portfolio = Portfolio::where('member_id',$res->memberid)->whereIn('block_id',$alluserblockid)->get();
        return $portfolio;
      }
      else
      {
        $cases = Cases::with(['Person','Renewcases','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->find($res->id);
        $addport = New Portfolio;
        $addport->type = $res->portname;
        $addport->number =$res->portnumber;
        $addport->structure_id  = 14;
        $addport->block_id = $cases->service_user_block_id;
        $addport->member_id = $cases->member_case_owner;
        $addport->port_id = 31;
        $addport->description = $res->description ;
        $addport->status = "Active" ;
        $addport->save();

        return $this->getcaseport($res->id);
      }

    }
    public function storeportfoliotocase(Request $res)
    {
      $input = [
          'var_value128' => $res['portid'],
      ];
      Cases::where('id', $res->id)
          ->update($input);
          $cases = Cases::with(['Person','Renewcases','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->find($res->id);

          return $cases->var_value128;
    }
    public function showdetail($id)
    {
        $casecansee =  $this->datacenter->showcasecanseeall();

      if(in_array($id,$casecansee))
      {

      $casecenter = new CaseCenterController();
      $inputtocasecondition = $casecenter->putpathconincasecon($id);
      $checkcondition =$casecenter->checkcondition($id);
      $stagemove =$casecenter->stagemove($id);

        $cases = Cases::with(['Person','Renewcases','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','Asset.assettype','match_id','CaseStatus','coordiantor','CaseChannel'])->find($id);
        //$id = $id;
        $name = "";
        /////////data Case Header////////////
        $caseheaderrecheckofferflag =$cases->var_value129;
        $caseheadername =$cases->name;
        $caseheadernotefromprevious =$cases->note_from_previous_case;
        $caseheadernotecopytorenew =$cases->note_to_copy_to_renew_case;
        $caseheadernotefrommember =$cases->note_from_member;
        $caseheadernotefrompartner =$cases->note_from_partner;
        $caseheadernotefromuser =$cases->note_from_user;
        $caseheadervar130 =$cases->var_value130;
        $caseheadercanceldate =$cases->cancel_date;
        $caseheaderrenewcaseid =$cases->renew_case_id;
        /////////data Case Header////////////
        /////////data Case Classify////////////
        $caseclassifycat = $cases->CaseType->CaseCategory->name;
        $caseclassifytype = $cases->CaseType->name;
        $caseclassifysubtype = $cases->CaseSubType->name;
        if ($cases->ref_previous_case == null|| $cases->ref_previous_case == '' ||$cases->ref_previous_case == '') {
            $caseclassifyoldcaseid = '';
            $caseclassifyoldcase = '';
        } else {
            $caseclassifyoldcaseid = $cases->ref_previous_case;
            $caseclassifyoldcase = $cases->Cases->name;
        }
        if ($cases->renew_case_id == null|| $cases->renew_case_id == 0 ||$cases->renew_case_id == '') {
            $caseclassifyrenewcaseid = '';
            $caseclassifyrenewcase = '';
        } else {
            $caseclassifyrenewcaseid =$cases->renew_case_id;
            $caseclassifyrenewcase = $cases->Renewcases->name;
        }
        $caseclassifyname = $cases->name;
        /////////data Case Classify////////////
        /////////data Case Detail////////////
        if ($cases->created_by_pid == null|| $cases->created_by_pid == 0 ||$cases->created_by_pid == '') {
            $casedetailmatchid = '';
        } else {
            $casedetailmatchid = $cases->match_id->public_name;
        }
        if ($cases->service_user_block_id == null|| $cases->service_user_block_id == 0||$cases->service_user_block_id == '') {
            $casedetailserviceuser = '';
        } else {
            $casedetailserviceuser = $cases->Block->name;
        }
        if ($cases->coordinate_user_block_id == null|| $cases->coordinate_user_block_id == 0||$cases->coordinate_user_block_id == '') {
            $casedetailcoordinate = '';
        } else {
            $casedetailcoordinate = $cases->coordiantor->firstname;
        }
        if ($cases->consult_partner_block_id == null|| $cases->consult_partner_block_id == 0||$cases->consult_partner_block_id == '') {
            $casedetailconsultpartner = '';
        } else {
            $casedetailconsultpartner = $cases->Partner_block->name;
        }
        if ($cases->case_channel == null|| $cases->case_channel == 0||$cases->case_channel == '') {
            $casedetailcasechannel = '';
        } else {
            $casedetailcasechannel = $cases->CaseChannel->name;
        }
        if ($cases->referal_asset == null|| $cases->referal_asset == 0||$cases->referal_asset == '') {
            $casedetailrefasset = '';
        } else {
            $casedetailrefasset = $cases->Asset->name;
        }
        /////////data Case Detail////////////
        /////////data Case Tracking////////////
        if ($cases->case_status == null|| $cases->case_status == 0||$cases->case_status == '') {
            $casetrackingcasestatus = '';
        } else {
            $casetrackingcasestatus = $cases->CaseStatus->name;
        }
        if ($cases->stage == null|| $cases->stage == 0||$cases->stage == '') {
            $casetrackingstage = '';
        } else {
            $casetrackingstage = $cases->Stage->name;
        }
        $casetrackingfinisheddate = $cases->finish_date;
        $casetrackingautorenewdate = $cases->auto_renew_date;

        if ($cases->type_id == null|| $cases->type_id == 0||$cases->type_id == '') {
            $casetrackingvarname1 = '';
            $casetrackingvarname52 = '';
            $casetrackingvarname51 = '';
            $casetrackingvarname53 = '';
            $casetrackingvarname2 = '';
            $casetrackingvarname3 = '';
            $casetrackingvarname4 = '';
            $casetrackingvarname5 = '';
            $casetrackingvarname6 = '';
            $casetrackingvarname7 = '';
            $casetrackingvarname8 = '';
            $casetrackingvarname9 = '';
            $casetrackingvarname10 = '';
            $casetrackingvarname11 = '';
            $casetrackingvarname12 = '';
            $casetrackingvarname13 = '';
            $casetrackingvarname14 = '';
            $casetrackingvarname15 = '';
            $casetrackingvarname16 = '';
            $casetrackingvarname17 = '';
            $casetrackingvarname18 = '';
            $casetrackingvarname19 = '';
            $casetrackingvarname20 = '';
            $casetrackingvarname21 = '';
            $casetrackingvarname22 = '';
            $casetrackingvarname23 = '';
            $casetrackingvarname24 = '';
            $casetrackingvarname25 = '';
            $casedetailnotirequirename4 = '';
            $casedetailnotirequirename1 = '';
            $casedetailnotirequirename2 = '';
            $casedetailnotirequirename3 = '';
            $casedetailnotirequirename5 = '';
            $casedetailnotirequirename6 = '';
            $casedetailnotirequirename7 = '';
            $casedetailnotirequirename8 = '';
            $casedetailnotirequirename9 = '';
            $casedetailnotirequirename10 = '';
            $casedetailnotirequirename11 = '';
            $casedetailnotirequirename12 = '';
            $casedetailnotirequirename13 = '';
            $casedetailnotirequirename14 = '';
            $casedetailnotirequirename15 = '';
            /////////data Case Contact Detail////////////
            $casecontactrequirename16 = '';
            $casecontactrequirename17 = '';
            $casecontactrequirename18 = '';
            $casecontactrequirename19 = '';
            $casecontactrequirename20 = '';
            /////////data Case Contact Detail////////////
            //////// for Insurance offer ////////
            $casevarname38 = '';
            $casevarname39 = '';
            $casevarname40 = '';
            //////// for Insurance offer ////////
            //////// for Act offer ////////
            $casevarname41 = '';
            $casevarname42 = '';
            $casevarname43 = '';
            //////// for Act offer ////////
            //////// for Act offer ////////
            $casevarname44 = '';
            $casevarname45 = '';
            $casevarname46 = '';
            //////// for Act offer ////////
            //////// for CasePayment ////////
            $casevarname5 = '';
            $casevarname28 = '';
            $casevarname29 = '';
            $casevarname51 = '';
            $casevarname52 = '';
            $casevarname53 = '';
            $casevarname26 = '';
            $casevarname27 = '';
            $casevarname30 = '';
            $casevarname31 = '';
            $casevarname32 = '';
            $casevarname33 = '';
            $casevarname34 = '';
            $casevarname35 = '';
            $casevarname36 = '';
            $casevarname37 = '';
            $casevarname47 = '';
            $casevarname48 = '';
            $casevarname49 = '';
            $casevarname50 = '';
            $casevarname54 = '';
            $casevarname55 = '';
            $casevarname56 = '';
            $casevarname57 = '';
            $casevarname58 = '';
            $casevarname59 = '';
            $casevarname60 = '';
            $casevarname61 = '';
            $casevarname62 = '';
            $casevarname63 = '';
            $casevarname64 = '';
            $casevarname65 = '';
            $casevarname66 = '';
            $casevarname67 = '';
            $casevarname68 = '';
            $casevarname69 = '';


        } else {
            $casetrackingvarname1 = $cases->CaseType->var_name1;
            $casetrackingvarname52 = $cases->CaseType->var_name52;
            $casetrackingvarname51 = $cases->CaseType->var_name51;
            $casetrackingvarname53 = $cases->CaseType->var_name53;
            $casetrackingvarname2 = $cases->CaseType->var_name2;
            $casetrackingvarname3 = $cases->CaseType->var_name3;
            $casetrackingvarname4 = $cases->CaseType->var_name4;
            $casetrackingvarname5 = $cases->CaseType->var_name5;
            $casetrackingvarname6 = $cases->CaseType->var_name6;
            $casetrackingvarname7 = $cases->CaseType->var_name7;
            $casetrackingvarname8 = $cases->CaseType->var_name8;
            $casetrackingvarname9 = $cases->CaseType->var_name9;
            $casetrackingvarname10 = $cases->CaseType->var_name10;
            $casetrackingvarname11 = $cases->CaseType->var_name11;
            $casetrackingvarname12 = $cases->CaseType->var_name12;
            $casetrackingvarname13 = $cases->CaseType->var_name13;
            $casetrackingvarname14 = $cases->CaseType->var_name14;
            $casetrackingvarname15 = $cases->CaseType->var_name15;
            $casetrackingvarname16 = $cases->CaseType->var_name16;
            $casetrackingvarname17 = $cases->CaseType->var_name17;
            $casetrackingvarname18 = $cases->CaseType->var_name18;
            $casetrackingvarname19 = $cases->CaseType->var_name19;
            $casetrackingvarname20 = $cases->CaseType->var_name20;
            $casetrackingvarname21 = $cases->CaseType->var_name21;
            $casetrackingvarname22 = $cases->CaseType->var_name22;
            $casetrackingvarname23 = $cases->CaseType->var_name23;
            $casetrackingvarname24 = $cases->CaseType->var_name24;
            $casetrackingvarname25 = $cases->CaseType->var_name25;
            $casedetailnotirequirename4 = $cases->CaseType->requirename_var4;
            $casedetailnotirequirename1 = $cases->CaseType->requirename_var1;
            $casedetailnotirequirename2 = $cases->CaseType->requirename_var2;
            $casedetailnotirequirename3 = $cases->CaseType->requirename_var3;
            $casedetailnotirequirename5 = $cases->CaseType->requirename_var5;
            $casedetailnotirequirename6 = $cases->CaseType->requirename_var6;
            $casedetailnotirequirename7 = $cases->CaseType->requirename_var7;
            $casedetailnotirequirename8 = $cases->CaseType->requirename_var8;
            $casedetailnotirequirename9 = $cases->CaseType->requirename_var9;
            $casedetailnotirequirename10 = $cases->CaseType->requirename_var10;
            $casedetailnotirequirename11 = $cases->CaseType->requirename_var11;
            $casedetailnotirequirename12 = $cases->CaseType->requirename_var12;
            $casedetailnotirequirename13 = $cases->CaseType->requirename_var13;
            $casedetailnotirequirename14 = $cases->CaseType->requirename_var14;
            $casedetailnotirequirename15 = $cases->CaseType->requirename_var15;
            /////////data Case Contact Detail////////////
            $casecontactrequirename16 = $cases->CaseType->requirename_var16;
            $casecontactrequirename17 = $cases->CaseType->requirename_var17;
            $casecontactrequirename18 = $cases->CaseType->requirename_var18;
            $casecontactrequirename19 = $cases->CaseType->requirename_var19;
            $casecontactrequirename20 = $cases->CaseType->requirename_var20;
            /////////data Case Contact Detail////////////
            //////// for Insurance offer ////////
            $casevarname38 = $cases->CaseType->var_name38;
            $casevarname39 = $cases->CaseType->var_name39;
            $casevarname40 = $cases->CaseType->var_name40;
            //////// for Insurance offer ////////
            //////// for Act offer ////////
            $casevarname41 = $cases->CaseType->var_name41;
            $casevarname42 = $cases->CaseType->var_name42;
            $casevarname43 = $cases->CaseType->var_name43;
            //////// for Act offer ////////
            //////// for Act offer ////////
            $casevarname44 = $cases->CaseType->var_name44;
            $casevarname45 = $cases->CaseType->var_name45;
            $casevarname46 = $cases->CaseType->var_name46;
            //////// for Act offer ////////
            //////// for CasePayment ////////
            $casevarname5 = $cases->CaseType->var_name5;
            $casevarname28 = $cases->CaseType->var_name28;
            $casevarname29 = $cases->CaseType->var_name29;
            $casevarname51 = $cases->CaseType->var_name51;
            $casevarname52 = $cases->CaseType->var_name52;
            $casevarname53 = $cases->CaseType->var_name53;
            $casevarname26 = $cases->CaseType->var_name26;
            $casevarname27 = $cases->CaseType->var_name27;
            $casevarname30 = $cases->CaseType->var_name30;
            $casevarname31 = $cases->CaseType->var_name31;
            $casevarname32 = $cases->CaseType->var_name32;
            $casevarname33 = $cases->CaseType->var_name33;
            $casevarname34 = $cases->CaseType->var_name34;
            $casevarname35 = $cases->CaseType->var_name35;
            $casevarname36 = $cases->CaseType->var_name36;
            $casevarname37 = $cases->CaseType->var_name37;
            $casevarname47 = $cases->CaseType->var_name47;
            $casevarname48 = $cases->CaseType->var_name48;
            $casevarname49 = $cases->CaseType->var_name49;
            $casevarname50 = $cases->CaseType->var_name50;
            //////// for CasePayment ////////
            $casevarname54 = $cases->CaseType->var_name54;
            $casevarname55 = $cases->CaseType->var_name55;
            $casevarname56 = $cases->CaseType->var_name56;
            $casevarname57 = $cases->CaseType->var_name57;
            $casevarname58 = $cases->CaseType->var_name58;
            $casevarname59 = $cases->CaseType->var_name59;
            $casevarname60 = $cases->CaseType->var_name60;
            $casevarname61 = $cases->CaseType->var_name61;
            $casevarname62 = $cases->CaseType->var_name62;
            $casevarname63 = $cases->CaseType->var_name63;
            $casevarname64 = $cases->CaseType->var_name64;
            $casevarname65 = $cases->CaseType->var_name65;
            $casevarname66 = $cases->CaseType->var_name66;
            $casevarname67 = $cases->CaseType->var_name67;
            $casevarname68 = $cases->CaseType->var_name68;
            $casevarname69 = $cases->CaseType->var_name69;


        }
        $casetrackinglastupdatedate = $cases->last_updated_date;
        $casetrackingvarvalue1 = $cases->var_value1;
        $casetrackingvarvalue51 = $cases->var_value51;
        $casetrackingvarvalue52 = $cases->var_value52;
        $casetrackingvarvalue53 = $cases->var_value53;
        $casetrackingvarvalue2 = $cases->var_value2;
        $casetrackingvarvalue3 = $cases->var_value3;
        $casetrackingvarvalue4 = $cases->var_value4;
        $casetrackingvarvalue5 = $cases->var_value5;
        $casetrackingvarvalue6 = $cases->var_value6;
        $casetrackingvarvalue7 = $cases->var_value7;
        $casetrackingvarvalue8 = $cases->var_value8;
        $casetrackingvarvalue9 = $cases->var_value9;
        $casetrackingvarvalue10 = $cases->var_value10;
        $casetrackingvarvalue11 = $cases->var_value11;
        $casetrackingvarvalue12 = $cases->var_value12;
        $casetrackingvarvalue13 = $cases->var_value13;
        $casetrackingvarvalue14 = $cases->var_value14;
        $casetrackingvarvalue15 = $cases->var_value15;
        $casetrackingvarvalue16 = $cases->var_value16;
        $casetrackingvarvalue17 = $cases->var_value17;
        $casetrackingvarvalue18 = $cases->var_value18;
        $casetrackingvarvalue19 = $cases->var_value19;
        $casetrackingvarvalue20 = $cases->var_value20;
        $casetrackingvarvalue21 = $cases->var_value21;
        $casetrackingvarvalue22 = $cases->var_value22;
        $casetrackingvarvalue23 = $cases->var_value23;
        $casetrackingvarvalue24 = $cases->var_value24;
        $casetrackingvarvalue25 = $cases->var_value25;
        $casetrackingrequirevalue7 = $cases->require_value7;
        $casetrackingrequirevalue8 = $cases->require_value8;
        $casetrackingrequirevalue9 = $cases->require_value9;
        /////////data Case Tracking////////////
        /////////data Detail Noti////////////
        $casedetailnotirequirevalue4 = $cases->require_value4;
        $casedetailnotirequirevalue1 = $cases->require_value1;
        $casedetailnotirequirevalue2 = $cases->require_value2;
        $casedetailnotirequirevalue3 = $cases->require_value3;
        $casedetailnotirequirevalue5 = $cases->require_value5;
        $casedetailnotirequirevalue6 = $cases->require_value6;
        $casedetailnotirequirevalue7 = $cases->require_value7;
        $casedetailnotirequirevalue8 = $cases->require_value8;
        $casedetailnotirequirevalue9 = $cases->require_value9;
        $casedetailnotirequirevalue10 = $cases->require_value10;
        $casedetailnotirequirevalue11 = $cases->require_value11;
        $casedetailnotirequirevalue12 = $cases->require_value12;
        $casedetailnotirequirevalue13 = $cases->require_value13;
        $casedetailnotirequirevalue14 = $cases->require_value14;
        $casedetailnotirequirevalue15 = $cases->require_value15;
        /////////data Detail Noti////////////
        //////// for Act offer //////
        $casevarvalue38 = $cases->var_value38;
        $casevarvalue39 = $cases->var_value39;
        $casevarvalue40 = $cases->var_value40;
        //////// for Act offer //////
        //////// for Act offer //////
        $casevarvalue41 = $cases->var_value41;
        $casevarvalue42 = $cases->var_value42;
        $casevarvalue43 = $cases->var_value43;
        //////// for Act offer //////
        //////// for Act offer //////
        $casevarvalue44 = $cases->var_value44;
        $casevarvalue45 = $cases->var_value45;
        $casevarvalue46 = $cases->var_value46;
        //////// for Act offer //////
        //////// for Case Peyment //////
        $casevarvalue28 = $cases->var_value28;
        $casevarvalue29 = $cases->var_value29;
        $casevarvalue51 = $cases->var_value51;
        $casevarvalue52 = $cases->var_value52;
        $casevarvalue53 = $cases->var_value53;
        $casevarvalue26 = $cases->var_value26;
        $casevarvalue27 = $cases->var_value27;
        $casevarvalue30 = $cases->var_value30;
        $casevarvalue31 = $cases->var_value31;
        $casevarvalue32 = $cases->var_value32;
        $casevarvalue33 = $cases->var_value33;
        $casevarvalue34 = $cases->var_value34;
        $casevarvalue35 = $cases->var_value35;
        $casevarvalue36 = $cases->var_value36;
        $casevarvalue37 = $cases->var_value37;
        //////// for Case Peyment //////
        $casevarvalue47 = $cases->var_value47;
        $casevarvalue48 = $cases->var_value48;
        $casevarvalue49 = $cases->var_value49;
        $casevarvalue50 = $cases->var_value50;

        /////////data Case Customer Detail////////////
        $casevarvalue54 = $cases->var_value54;
        $casevarvalue55 = $cases->var_value55;
        $casevarvalue56 = $cases->var_value56;
        $casevarvalue57 = $cases->var_value57;
        $casevarvalue58 = $cases->var_value58;
        $casevarvalue59 = $cases->var_value59;
        $casevarvalue60 = $cases->var_value60;
        $casevarvalue61 = $cases->var_value61;
        $casevarvalue62 = $cases->var_value62;
        $casevarvalue63 = $cases->var_value63;
        $casevarvalue64 = $cases->var_value64;
        $casevarvalue65 = $cases->var_value65;
        $casevarvalue66 = $cases->var_value66;
        $casevarvalue67 = $cases->var_value67;
        $casevarvalue68 = $cases->var_value68;
        $casevarvalue69 = $cases->var_value69;

        if ($cases->member_case_owner == null|| $cases->member_case_owner == 0||$cases->member_case_owner == '') {
            $casecustomername = '';
            $casecustomerlastname = '';
            $casecustomermobile = '';
            $casecustomeremail = '';
            $casecustomerfax = '';
            $casecustomeraddress = '';
            $casecustomeradvisor = '';

        } else {
            $casecustomername = $cases->Person->name;
            $casecustomerlastname = $cases->Person->lname;
            $casecustomermobile = $cases->Person->mobile;
            $casecustomeremail = $cases->Person->email;
            $casecustomerfax = $cases->Person->add2_fax;
            if($cases->Person->ref_member_pid == null|| $cases->Person->ref_member_pid == 0||$cases->Person->ref_member_pid == '')
            {
              $casecustomeradvisor = '';
            }
            else
            {
              $casecustomeradvisor =  $cases->Person->refmemberpid->public_name;
            }

            if ($cases->Person->add2 == null || $cases->Person->add2 == '') {
                $add2 = '';
            } else {
                $add2 = 'เลขที่ '.$cases->Person->add2;
            }
            if ($cases->Person->add2_road == null || $cases->Person->add2_road == '' || $cases->Person->add2_road == '') {
                $add2road = '';
            } else {
                $add2road = ' ถนน '.$cases->Person->add2_road;
            }
            if ($cases->Person->add2_alley == null || $cases->Person->add2_alley== '') {
                $add2alley = '';
            } else {
                $add2alley = ' ซอย '.$cases->Person->add2_alley;
            }
            if ($cases->Person->add2_subdistrict == null || $cases->Person->add2_subdistrict== '') {
                $add2subdistrict = '';
            } else {
                $add2subdistrict = ' แขวง '.$cases->Person->add2_subdistrict;
            }
            if ($cases->Person->add2_district == null || $cases->Person->add2_district== '') {
                $add2district = '';
            } else {
                $add2district = ' เขต '.$cases->Person->add2_district;
            }
            if ($cases->Person->add2_city == null || $cases->Person->add2_city== '') {
                $add2city = '';
            } else {
                $add2city = ' จังหวัด '.$cases->Person->add2_city;
            }
            if ($cases->Person->add2_country == null || $cases->Person->add2_country== '') {
                $add2country = '';
            } else {
                $add2country= ' ประเทศ '.$cases->Person->add2_country;
            }
            if ($cases->Person->add2_postcode == null ||$cases->Person->add2_postcode== '') {
                $add2postcode = '';
            } else {
                $add2postcode = ' รหัรหัสไปรษณีย์ '.$cases->Person->add2_postcode;
            }
            $casecustomeraddress = $add2.$add2road.$add2alley.$add2subdistrict.$add2district.$add2city.$add2country.$add2postcode;
            if ($casecustomerlastname = 'null') {
                $casecustomerlastname = '';
            }
        }
        /////////data Case Customer Detail////////////
        /////////data Case Contact Detail////////////
        $casecontactrequirevalue16 = $cases->require_value16;
        $casecontactrequirevalue17 = $cases->require_value17;
        $casecontactrequirevalue18 = $cases->require_value18;
        $casecontactrequirevalue19 = $cases->require_value19;
        $casecontactrequirevalue20 = $cases->require_value20;
        /////////data Case Contact Detail////////////
        /////////data Asset ////////////
        if ($cases->referal_asset == null ||$cases->referal_asset == '' ||$cases->referal_asset == 0) {
            $caseassetrefname = '';
            $caseassetrefinfo2 = '';
            $caseassetrefinfo3 = '';
            $caseassetrefinfo4 = '';
            $caseassetrefinfo5 = '';
            $caseassetrefinfo6 = '';
            $caseassetrefinfo8 = '';
            $caseassetrefinfo1 = '';
            $caseassetrefinfo7 = '';
            $caseassetrefinfo9 = '';
            $caseassetrefinfo10 = '';
            $caseassetrefinfo11 = '';
            $caseassetrefinfo12 = '';
            $caseassetrefinfo13 = '';
            $caseassetrefinfo14 = '';
            $caseassetrefinfo15 = '';
            $caseassetrefinfo16 = '';
            $caseassetrefinfo17 = '';
            $caseassetrefinfo18 = '';
            $caseassetrefnamehead = '';
            $caseassetrefinfohead2 = '';
            $caseassetrefinfohead3 = '';
            $caseassetrefinfohead4 = '';
            $caseassetrefinfohead5 = '';
            $caseassetrefinfohead6 = '';
            $caseassetrefinfohead8 = '';
            $caseassetrefinfohead1 = '';
            $caseassetrefinfohead7 = '';
            $caseassetrefinfohead9 = '';
            $caseassetrefinfohead10 = '';
            $caseassetrefinfohead11 = '';
            $caseassetrefinfohead12 = '';
            $caseassetrefinfohead13 = '';
            $caseassetrefinfohead14 = '';
            $caseassetrefinfohead15 = '';
            $caseassetrefinfohead16 = '';
            $caseassetrefinfohead17 = '';
            $caseassetrefinfohead18 = '';
            $caseassetid = '';
        } else {
            $caseassetrefname = $cases->Asset->ref_name;
            $caseassetrefinfo2 = $cases->Asset->ref_info2;
            $caseassetrefinfo3 = $cases->Asset->ref_info3;
            $caseassetrefinfo4 = $cases->Asset->ref_info4;
            $caseassetrefinfo5 = $cases->Asset->ref_info5;
            $caseassetrefinfo6 = $cases->Asset->ref_info6;
            $caseassetrefinfo8 = $cases->Asset->ref_info8;
            $caseassetrefinfo1 = $cases->Asset->ref_info1;
            $caseassetrefinfo7 = $cases->Asset->ref_info7;
            $caseassetrefinfo9 = $cases->Asset->ref_info9;
            $caseassetrefinfo10 = $cases->Asset->ref_info10;
            $caseassetrefinfo11 = $cases->Asset->ref_info11;
            $caseassetrefinfo12 = $cases->Asset->ref_info12;
            $caseassetrefinfo13 = $cases->Asset->ref_info13;
            $caseassetrefinfo14 = $cases->Asset->ref_info14;
            $caseassetrefinfo15 = $cases->Asset->ref_info15;
            $caseassetrefinfo16 = $cases->Asset->ref_info16;
            $caseassetrefinfo17 = $cases->Asset->ref_info17;
            $caseassetrefinfo18 = $cases->Asset->ref_info18;
            $caseassetrefnamehead = $cases->Asset->assettype->ref_name_head;
            $caseassetrefinfohead2 = $cases->Asset->assettype->ref_info_head2;
            $caseassetrefinfohead3 = $cases->Asset->assettype->ref_info_head3;
            $caseassetrefinfohead4 =$cases->Asset->assettype->ref_info_head4;
            $caseassetrefinfohead5 = $cases->Asset->assettype->ref_info_head5;
            $caseassetrefinfohead6 = $cases->Asset->assettype->ref_info_head6;
            $caseassetrefinfohead8 = $cases->Asset->assettype->ref_info_head8;
            $caseassetrefinfohead1 = $cases->Asset->assettype->ref_info_head1;
            $caseassetrefinfohead7 = $cases->Asset->assettype->ref_info_head7;
            $caseassetrefinfohead9 = $cases->Asset->assettype->ref_info_head9;
            $caseassetrefinfohead10 = $cases->Asset->assettype->ref_info_head10;
            $caseassetrefinfohead11 = $cases->Asset->assettype->ref_info_head11;
            $caseassetrefinfohead12 = $cases->Asset->assettype->ref_info_head12;
            $caseassetrefinfohead13 = $cases->Asset->assettype->ref_info_head13;
            $caseassetrefinfohead14 = $cases->Asset->assettype->ref_info_head14;
            $caseassetrefinfohead15 = $cases->Asset->assettype->ref_info_head15;
            $caseassetrefinfohead16 = $cases->Asset->assettype->ref_info_head16;
            $caseassetrefinfohead17 = $cases->Asset->assettype->ref_info_head17;
            $caseassetrefinfohead18 = $cases->Asset->assettype->ref_info_head18;

            $caseassetid = $cases->Asset->id;
        }

        /////////data Asset ////////////
        /////////////////data Offer/////////////
        $casemiddledata = Casemiddledata::where('case_id', $id)->pluck('offer_id')->toArray();

        $offertypefromoffercat = OfferType::where('offer_category',$cases->casetype->offer_cat)->value('id');
        $offertypefromoffercat = OfferType::find($offertypefromoffercat);
        $confirmoffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->get();
        $confirmofferarray = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->pluck('id')->toArray();
        $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $id)->pluck('id')->toArray();
        $interestoffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->WhereNotIn('id', $confirmofferarray)->where('interest', 1)->get();
        $interestofferarray = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->WhereNotIn('id', $confirmofferarray)->where('interest', 1)->pluck('id')->toArray();
        $caseporposaloffer = Offer::with(['OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->where('interest', 1)->pluck('id')->toArray();
        $confirmandinterest = array_merge($interestofferarray, $confirmofferarray);
        $lastestoffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->WhereNotIn('id', $confirmandinterest)->orderBy('id', 'desc')->take(5)->get();
        /////////////////data Offer/////////////
        //////////////// data File /////////////
        $memberid = $cases->member_case_owner;
        $findfile = DB::table('member_attachment')->where('member_id', $memberid)->pluck('file_id');
        $memberfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active');
        $citizenfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 9)->get();
        $driverfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 11)->get();
        $employeefile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 31)->get();
        $salaryslipfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 32)->get();
        $companycopy = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 20)->get();
        $commercialcert = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 28)->get();
        $departmentcopy = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 22)->get();


        $assetid = $cases->referal_asset;
        $portid = $cases->Asset->port_id;
        $assetfileid = Asset_Attacht::where('asset_id', $assetid)->pluck('file_id')->toArray();
        $assetfile = File::whereIn('id', $assetfileid);
        $carfile = File::whereIn('id', $assetfileid)->where('file_cat_id', 15)->get();
        $carphoto = File::whereIn('id', $assetfileid)->where('file_cat_id', 14)->get();
        $carcamera = File::whereIn('id', $assetfileid)->where('file_cat_id', 44)->get();

        $caseid = $id;
        $casefileid = Case_Attacht::where('case_id', $caseid)->pluck('file_id')->toArray();
        $casefile = File::whereIn('id', $casefileid);
        $oldinsurances =  File::whereIn('id', $casefileid)->where('file_cat_id', 36)->get();
        $oldact =  File::whereIn('id', $casefileid)->where('file_cat_id', 37)->get();
        $oldtax =  File::whereIn('id', $casefileid)->where('file_cat_id', 38)->get();
        $guaranteereceipt = File::whereIn('id', $casefileid)->where('file_cat_id', 39)->get();
        $discountcoupon =  File::whereIn('id', $casefileid)->where('file_cat_id', 40)->get();
        $insuranceapplication =  File::whereIn('id', $casefileid)->where('file_cat_id', 41)->get();
        $moneystandin =  File::whereIn('id', $casefileid)->where('file_cat_id', 42)->get();
        $copyrenewnotice =  File::whereIn('id', $casefileid)->where('file_cat_id', 43)->get();
        $copyact =  File::whereIn('id', $casefileid)->where('file_cat_id', 45)->get();
        $insurancecopy =  File::whereIn('id', $casefileid)->where('file_cat_id', 46)->orderBy('id', 'DESC')->take(1)->get();
        $taxcopy = $casefile->where('file_cat_id', 47)->get();
        $insurancecopypayment =  File::whereIn('id', $casefileid)->where('file_cat_id', 50)->get();
        $insurancepaymenttocompanycopy =  File::whereIn('id', $casefileid)->where('file_cat_id', 54)->get();
        $actpaymenttocompanycopy =  File::whereIn('id', $casefileid)->where('file_cat_id', 55)->get();
        $taxpaymenttocompanycopy =  File::whereIn('id', $casefileid)->where('file_cat_id', 56)->get();
        $actcopypayment =  File::whereIn('id', $casefileid)->where('file_cat_id', 51)->get();
        $taxcopypayment =  File::whereIn('id', $casefileid)->where('file_cat_id', 52)->get();
        $anotherfile =  File::whereIn('id', $casefileid)->where('file_cat_id', 53)->get();
        //////////////// data File /////////////
        //////////////// Caselog and casecondition /////////////
        $caselog = Case_log::with(['cases','movefromstage','movetostage','path','pathcondition'])->where('case_id', $id)->get();
        $caseaction =  CaseAction::with(['stage','stageaction','cases','action'])->where('case_id', $id)->get();
        //    $casecondition =  Case_condition::with(['path_condition_detail'])->where('current_stage',$stage)->where('condition_flag',1)->where('case_id',$caseid)->get();
        //////////////// Caselog  /////////////
        /////////////// Data Offer Insurance ////////
        $casemiddledata = Casemiddledata::where('case_id', $id)->pluck('offer_id')->toArray();
        $offerinsuranceid = Offer::whereIn('id', $casemiddledata)->where('type_id','!=',7)->where('type_id','!=',8)->orderBy('id', 'DESC')->take(1)->value('id');
        $offerinsurance = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->find($offerinsuranceid);
        if ($offerinsurance == null || $offerinsurance == '') {
            $offerinsurancecompany = '';
            $offerinsurancepartner = '';
            $offerinsurancefilepublicname = '';
            $offerinsurancefileid = '';
            $offerinsurancepaymentpremium = 0;
            $offerinsurancepaymentdiscount15 = 0;
            $offerinsurancepaymentdiscount16 = 0;
            $offerinsurancepaymentdiscount18 = 0;
            $offerinsurancepaymentdiscount20 = 0;
            $offerinsurancepaymenttaxdeduction= 0;
            $offerinsurancepaymentpartnerconsultfee= 0;
            $offerinsurancepaymentuserservicefee= 0;
            $offerinsurancepaymentgrosscom = 0;
            $offerinsurancecopypaymentfilepublicname = '';
            $offerinsurancecopypaymentfileid = '';
            $offerinsurancepaymenttocompanycopyfilepublicname = '';
            $offerinsurancepaymenttocompanycopyfileid = '';
        } else {
            $offerinsurancecompany = $offerinsurance->Person->name;
            if( $offerinsurance->Proposal->partner_block == NULL ||$offerinsurance->Proposal->partner_block == 0 ||$offerinsurance->Proposal->partner_block == '')
            {
              $offerinsurancepartner = '';
            }
            else
            {
              $offerinsurancepartner = $offerinsurance->Proposal->Partner_block->name;
            }
            $offerinsurancepaymentpremium   = $offerinsurance->offer_payment_value4;
            $offerinsurancepaymentdiscount15 = $offerinsurance->offer_payment_value15;
            $offerinsurancepaymentdiscount18 = $offerinsurance->offer_payment_value18;
            $offerinsurancepaymentdiscount16 = $offerinsurance->offer_payment_value16;
            $offerinsurancepaymentdiscount20 = $offerinsurance->offer_payment_value20;
            $offerinsurancepaymenttaxdeduction = $offerinsurance->offer_payment_value5;
            $offerinsurancepaymentpartnerconsultfee = $offerinsurance->offer_payment_value17;
            $offerinsurancepaymentuserservicefee = $offerinsurance->offer_payment_value19;
            $offerinsurancepaymentgrosscom = $offerinsurance->offer_payment_value8;
            if (count($insurancecopy) < 1) {
                $offerinsurancefilepublicname = '';
                $offerinsurancefileid = '';
            } else {
                foreach ($insurancecopy as $in) {
                    $offerinsurancefilepublicname = $in->file_public_name;
                    $offerinsurancefileid = $in->id;
                }
            }
            if (count($insurancecopypayment) < 1) {
                $offerinsurancecopypaymentfilepublicname = '';
                $offerinsurancecopypaymentfileid = '';
            } else {
                foreach ($insurancecopypayment as $in) {
                    $offerinsurancecopypaymentfilepublicname = $in->file_public_name;
                    $offerinsurancecopypaymentfileid = $in->id;
                }
            }
            if (count($insurancepaymenttocompanycopy) < 1) {
                $offerinsurancepaymenttocompanycopyfilepublicname = '';
                $offerinsurancepaymenttocompanycopyfileid = '';
            } else {
                foreach ($insurancepaymenttocompanycopy as $in) {
                    $offerinsurancepaymenttocompanycopyfilepublicname = $in->file_public_name;
                    $offerinsurancepaymenttocompanycopyfileid = $in->id;
                }
            }
        }

        $offeractid = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->where('type_id', 7)->orderBy('id', 'DESC')->take(1)->value('id');
        $offeract = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->find($offeractid);
        if ($offeract == null || $offeract == '') {
            $offeractcompany = '';
            $offeractpartner = '';
            $offeractfilepublicname = '';
            $offeractfileid = '';
            $offeractpaymentpremium = 0;
            $offeractpaymentdiscount15 = 0;
            $offeractpaymentdiscount16 = 0;
            $offeractpaymentdiscount18 = 0;
            $offeractpaymentdiscount20 = 0;
            $offeractpaymenttaxdeduction = 0;
            $offeractpaymentpartnerconsultfee = 0;
            $offeractpaymentuserservicefee = 0;
            $offeractpaymentgrosscom = 0;
            $offeractcopypaymentfilepublicname = '';
            $offeractcopypaymentfileid = '';
            $offeractpaymenttocompanycopyfilepublicname = '';
            $offeractpaymenttocompanycopyfileid = '';
        } else {
            $offeractcompany = $offeract->Person->name;
            $offeractpartner = $offeract->Proposal->Partner_block->name;
            $offeractpaymentpremium   = $offeract->offer_payment_value4;
            $offeractpaymentdiscount15 = $offeract->offer_payment_value15;
            $offeractpaymentdiscount16 = $offeract->offer_payment_value16;
            $offeractpaymentdiscount18 = $offeract->offer_payment_value18;
            $offeractpaymentdiscount20 = $offeract->offer_payment_value20;
            $offeractpaymenttaxdeduction = $offeract->offer_payment_value5;
            $offeractpaymentpartnerconsultfee = $offeract->offer_payment_value17;
            $offeractpaymentuserservicefee = $offeract->offer_payment_value19;
            $offeractpaymentgrosscom = $offeract->offer_payment_value8;

            if (count($copyact) < 1) {
                $offeractfilepublicname = '';
                $offeractfileid = '';
            } else {
                foreach ($copyact as $in) {
                    $offeractfilepublicname = $in->file_public_name;
                    $offeractfileid = $in->id;
                }
            }
            if (count($actcopypayment) < 1) {
                $offeractcopypaymentfilepublicname = '';
                $offeractcopypaymentfileid = '';
            } else {
                foreach ($actcopypayment as $in) {
                    $offeractcopypaymentfilepublicname = $in->file_public_name;
                    $offeractcopypaymentfileid = $in->id;
                }
            }
            if (count($actpaymenttocompanycopy) < 1) {
                $offeractpaymenttocompanycopyfilepublicname = '';
                $offeractpaymenttocompanycopyfileid = '';
            } else {
                foreach ($actpaymenttocompanycopy as $in) {
                    $offeractpaymenttocompanycopyfilepublicname = $in->file_public_name;
                    $offeractpaymenttocompanycopyfileid = $in->id;
                }
            }
        }
        $offertaxid = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->where('type_id', 8)->orderBy('id', 'DESC')->take(1)->value('id');
        $offertax = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->find($offertaxid);
        if ($offertax == null || $offertax == '') {
            $offertaxcompany = '';
            $offertaxpartner = '';
            $offertaxfilepublicname = '';
            $offertaxfileid = '';
            $offertaxpaymentpremium = 0;
            $offertaxpaymentdiscount15 = 0;
            $offertaxpaymentdiscount16 = 0;
            $offertaxpaymentdiscount18 = 0;
            $offertaxpaymentdiscount20 = 0;
            $offertaxpaymenttaxdeduction = 0;
            $offertaxpaymentuserservicefee = 0;
            $offertaxpaymentgrosscom = 0;
            $offertaxpaymentpartnerconsultfee = 0;
            $offertaxcopypaymentfilepublicname = '';
            $offertaxcopypaymentfileid = '';
            $offertaxpaymenttocompanycopyfilepublicname = '';
            $offertaxpaymenttocompanycopyfileid = '';
        } else {
            $offertaxcompany = $offertax->Person->name;
            $offertaxpartner = $offertax->Proposal->Partner_block->name;
            $offertaxpaymentpremium   = $offertax->offer_payment_value4;
            $offertaxpaymentdiscount15 = $offertax->offer_payment_value15;
            $offertaxpaymentdiscount16 = $offertax->offer_payment_value16;
            $offertaxpaymentdiscount18 = $offertax->offer_payment_value18;
            $offertaxpaymentdiscount20 = $offertax->offer_payment_value20;
            $offertaxpaymenttaxdeduction = $offertax->offer_payment_value5;
            $offertaxpaymentpartnerconsultfee = $offertax->offer_payment_value17;
            $offertaxpaymentuserservicefee = $offertax->offer_payment_value19;
            $offertaxpaymentgrosscom = $offertax->offer_payment_value8;

            if (count($taxcopy) < 1) {
                $offertaxfilepublicname = '';
                $offertaxfileid = '';
            } else {
                foreach ($taxcopy as $in) {
                    $offertaxfilepublicname = $in->file_public_name;
                    $offertaxfileid = $in->id;
                }
            }
            if (count($taxcopypayment) < 1) {
                $offertaxcopypaymentfilepublicname = '';
                $offertaxcopypaymentfileid = '';
            } else {
                foreach ($taxcopypayment as $in) {
                    $offertaxcopypaymentfilepublicname = $in->file_public_name;
                    $offertaxcopypaymentfileid = $in->id;
                }
            }
            if (count($taxpaymenttocompanycopy) < 1) {
                $offertaxpaymenttocompanycopyfilepublicname = '';
                $offertaxpaymenttocompanycopyfileid = '';
            } else {
                foreach ($taxpaymenttocompanycopy as $in) {
                    $offertaxpaymenttocompanycopyfilepublicname = $in->file_public_name;
                    $offertaxpaymenttocompanycopyfileid = $in->id;
                }
            }
        }
        //////////// Calculation For Case Payment ////////////
        if ($offerinsurancepaymentdiscount15 == 'NaN') {
            $offerinsurancepaymentdiscount15 = 0;
        }
        if ($offeractpaymentdiscount16 == 'NaN') {
            $offeractpaymentdiscount16 = 0;
        }
        if ($offertaxpaymentdiscount20 == 'NaN') {
            $offertaxpaymentdiscount20 = 0;
        }
        $alldiscountinsurance = $offerinsurancepaymentdiscount15+$offerinsurancepaymentdiscount15+$offerinsurancepaymentdiscount18+$offerinsurancepaymentdiscount20;
        $alldiscountinsurance = round($alldiscountinsurance, 2);
        if ($offerinsurancepaymentpremium == 'NaN') {
            $offerinsurancepaymentpremium = 0;
        }
        if ($alldiscountinsurance == 'NaN') {
            $alldiscountinsurance = 0;
        }
        $calculatebeforetaxdeductinsurance =$offerinsurancepaymentpremium-$alldiscountinsurance;
        $calculatebeforetaxdeductinsurance =  round($calculatebeforetaxdeductinsurance, 2);
        $calculateaftertaxdeductinsurance =$calculatebeforetaxdeductinsurance-$offerinsurancepaymenttaxdeduction;
        $calculateaftertaxdeductinsurance =  round($calculateaftertaxdeductinsurance, 2);
        if ($calculateaftertaxdeductinsurance == 'NaN' || $calculateaftertaxdeductinsurance == null || $calculateaftertaxdeductinsurance == '') {
            $calculateaftertaxdeductinsurance = 0;
        }
        if ($offerinsurancepaymentpartnerconsultfee == 'NaN' || $offerinsurancepaymentpartnerconsultfee == null || $offerinsurancepaymentpartnerconsultfee == '') {
            $offerinsurancepaymentpartnerconsultfee = 0;
        }
        $totalpaidpartnerinsurance =$calculateaftertaxdeductinsurance-$offerinsurancepaymentpartnerconsultfee;
        $totalpaidpartnerinsurance =  round($totalpaidpartnerinsurance, 2);
        if ($calculateaftertaxdeductinsurance == 'NaN' || $calculateaftertaxdeductinsurance == null || $calculateaftertaxdeductinsurance == '') {
            $calculateaftertaxdeductinsurance = 0;
        }
        if ($totalpaidpartnerinsurance == 'NaN' || $totalpaidpartnerinsurance == null || $totalpaidpartnerinsurance == '') {
            $offerinsurancepaymentuserservicefee = 0;
        }
        $totalpaiduserinsurance =$totalpaidpartnerinsurance-$offerinsurancepaymentuserservicefee;
        $totalpaiduserinsurance =  round($totalpaiduserinsurance, 2);
        if ($offerinsurancepaymentpremium == 'NaN' || $offerinsurancepaymentpremium == null || $offerinsurancepaymentpremium == '') {
            $offerinsurancepaymentpremium = 0;
        }
        if ($offerinsurancepaymentgrosscom == 'กรุณาเลือกหมวดการคำนวณ' || $offerinsurancepaymentgrosscom == null || $offerinsurancepaymentgrosscom == '') {
            $offerinsurancepaymentgrosscom = 0;
        }
        if ($offerinsurancepaymenttaxdeduction == 'NaN' || $offerinsurancepaymenttaxdeduction == null || $offerinsurancepaymenttaxdeduction == '') {
            $offerinsurancepaymenttaxdeduction = 0;
        }
        $totalpaidcompanyinsurance =  $offerinsurancepaymentpremium-$offerinsurancepaymentgrosscom-$offerinsurancepaymenttaxdeduction;
        $totalpaidcompanyinsurance =round($totalpaidcompanyinsurance, 2);

        $alldiscountact = $offeractpaymentdiscount15+$offeractpaymentdiscount16+$offeractpaymentdiscount18+$offeractpaymentdiscount20;
        $alldiscountact = round($alldiscountact, 2);
        $calculatebeforetaxdeductact =$offeractpaymentpremium-$alldiscountact;
        $calculatebeforetaxdeductact =  round($calculatebeforetaxdeductact, 2);
        $calculateaftertaxdeductact =$calculatebeforetaxdeductact-$offeractpaymenttaxdeduction;
        $calculateaftertaxdeductact =  round($calculateaftertaxdeductact, 2);
        $totalpaidpartneract =$calculateaftertaxdeductact-$offeractpaymentpartnerconsultfee;
        $totalpaidpartneract =  round($totalpaidpartneract, 2);
        $totalpaiduseract =$totalpaidpartneract-$offeractpaymentuserservicefee;
        $totalpaiduseract =  round($totalpaiduseract, 2);
        $totalpaidcompanyact =  $offeractpaymentpremium-$offeractpaymentgrosscom-$offeractpaymenttaxdeduction;
        $totalpaidcompanyact =round($totalpaidcompanyact, 2);

        $alldiscounttax = $offertaxpaymentdiscount15+$offertaxpaymentdiscount16+$offertaxpaymentdiscount18+$offertaxpaymentdiscount20;
        $alldiscounttax = round($alldiscounttax, 2);
        $calculatebeforetaxdeducttax =$offertaxpaymentpremium-$alldiscounttax;
        $calculatebeforetaxdeducttax =  round($calculatebeforetaxdeducttax, 2);
        $calculateaftertaxdeducttax =$calculatebeforetaxdeducttax-$offertaxpaymenttaxdeduction;
        $calculateaftertaxdeducttax =  round($calculateaftertaxdeducttax, 2);
        $totalpaidpartnertax =$calculateaftertaxdeducttax-$offertaxpaymentpartnerconsultfee;
        $totalpaidpartnertax =  round($totalpaidpartnertax, 2);
        $totalpaidusertax =$totalpaidpartnertax-$offertaxpaymentuserservicefee;
        $totalpaidusertax =  round($totalpaidusertax, 2);
        $totalpaidcompanytax =  $offertaxpaymentpremium-$offertaxpaymentgrosscom-$offertaxpaymenttaxdeduction;
        $totalpaidcompanytax =round($totalpaidcompanytax, 2);

        $allpremium =  $offerinsurancepaymentpremium+$offeractpaymentpremium+$offertaxpaymentpremium;
        $allpremium = round($allpremium, 2);
        $alltaxdeduct = $offerinsurancepaymenttaxdeduction+$offeractpaymenttaxdeduction+$offertaxpaymenttaxdeduction;
        $alltaxdeduct = round($alltaxdeduct, 2);
        $alldiscount =$alldiscountinsurance+$alldiscountact+$alldiscounttax;
        $alldiscount = round($alldiscount, 2);
        $allcalculatebeforetaxdeduct = $calculatebeforetaxdeductinsurance+$calculatebeforetaxdeductact+$calculatebeforetaxdeducttax;
        $allcalculatebeforetaxdeduct = round($allcalculatebeforetaxdeduct, 2);
        $allcalculateaftertaxdeduct = $calculateaftertaxdeductinsurance+$calculateaftertaxdeductact+$calculateaftertaxdeducttax;
        $allcalculateaftertaxdeduct = round($allcalculateaftertaxdeduct, 2);
        $alltotalpaidpartner = $totalpaidpartnerinsurance+$totalpaidpartneract+$totalpaidpartnertax;
        $alltotalpaidpartner = round($alltotalpaidpartner, 2);
        $alltotalpaiduser = $totalpaiduserinsurance+$totalpaiduseract+$totalpaidusertax;
        $alltotalpaiduser = round($alltotalpaiduser, 2);
        $alltotalpaidcompany = $totalpaidcompanyinsurance+$totalpaidcompanyact+$totalpaidcompanytax;
        $alltotalpaidcompany = round($alltotalpaidcompany, 2);
        //  return $totalpaidcompanyinsurance;
        //////////// Calculation For Case Payment ////////////
        $url = $_SERVER['REQUEST_URI'];
        $caseport = $cases->var_value128;
        return view(
              'system-mgmt/insurance/showdetail',
              compact(
            [
              'casevarvalue54','casevarvalue55','casevarvalue56','casevarvalue57','casevarvalue58','casevarvalue59','casevarvalue60','casevarvalue61','casevarvalue62','casevarvalue63','casevarvalue64','casevarvalue65','casevarvalue66','casevarvalue67','casevarvalue68','casevarvalue69',
              'casevarname54','casevarname55','casevarname56','casevarname57','casevarname58','casevarname59','casevarname60','casevarname61','casevarname62','casevarname63','casevarname64','casevarname65','casevarname66','casevarname67','casevarname68','casevarname69',
              'offertypefromoffercat',
              'casevarvalue47','casevarvalue48','casevarvalue49','casevarvalue50',
              'casevarname47','casevarname48','casevarname49','casevarname50',
              'caseassetrefinfohead8','caseassetrefinfohead1','caseassetrefinfohead7','caseassetrefinfohead9','caseassetrefinfohead10','caseassetrefnamehead','caseassetrefinfohead3','caseassetrefinfohead4','caseassetrefinfohead5','caseassetrefinfohead2','caseassetrefinfohead6',
              'caseassetrefinfohead11','caseassetrefinfohead12','caseassetrefinfohead13','caseassetrefinfohead14','caseassetrefinfohead15','caseassetrefinfohead16','caseassetrefinfohead17','caseassetrefinfohead18',
              'caseheaderrecheckofferflag','casecustomeradvisor','caseport',
              'companycopy','commercialcert','departmentcopy',
              'allpremium','alltaxdeduct','alldiscount','allcalculatebeforetaxdeduct','allcalculateaftertaxdeduct','alltotalpaidpartner','alltotalpaiduser','alltotalpaidcompany',
              'offertaxcopypaymentfilepublicname','offertaxcopypaymentfileid','offertaxpaymenttocompanycopyfilepublicname','offertaxpaymenttocompanycopyfileid',
              'offertaxpaymentpremium','offertaxpaymenttaxdeduction','alldiscounttax','calculatebeforetaxdeducttax','calculateaftertaxdeducttax',
              'totalpaidpartnertax','totalpaidusertax','totalpaidcompanytax',
              'offeractcopypaymentfilepublicname','offeractcopypaymentfileid','offeractpaymenttocompanycopyfilepublicname','offeractpaymenttocompanycopyfileid',
              'offeractpaymentpremium','offeractpaymenttaxdeduction','alldiscountact','calculatebeforetaxdeductact','calculateaftertaxdeductact',
              'totalpaidpartneract','totalpaiduseract','totalpaidcompanyact',
              'offerinsurancecopypaymentfilepublicname','offerinsurancecopypaymentfileid','offerinsurancepaymenttocompanycopyfilepublicname','offerinsurancepaymenttocompanycopyfileid',
              'offerinsurancepaymentpremium','offerinsurancepaymenttaxdeduction','alldiscountinsurance','calculatebeforetaxdeductinsurance','calculateaftertaxdeductinsurance',
              'totalpaidpartnerinsurance','totalpaiduserinsurance','totalpaidcompanyinsurance',
              'casevarname5','casevarname28','casevarname29','casevarname51','casevarname52','casevarname53','casevarname26','casevarname27','casevarname30','casevarname31',
              'casevarname32','casevarname33','casevarname34','casevarname35','casevarname36','casevarname37',
              'casevarvalue28','casevarvalue29','casevarvalue51','casevarvalue52','casevarvalue53','casevarvalue26','casevarvalue27','casevarvalue30','casevarvalue31',
              'casevarvalue32','casevarvalue33','casevarvalue34','casevarvalue35','casevarvalue36','casevarvalue37',
              'offerinsurancecompany','offerinsurancepartner','offerinsurancefilepublicname','offerinsurancefileid',
              'offeractcompany','offeractpartner','offeractfilepublicname','offeractfileid',
              'offertaxcompany','offertaxpartner','offertaxfilepublicname','offertaxfileid',
              'casevarname38','casevarname39','casevarname40',
              'casevarname41','casevarname42','casevarname43',
              'casevarname44','casevarname45','casevarname46',
              'casevarvalue38','casevarvalue39','casevarvalue40',
              'casevarvalue41','casevarvalue42','casevarvalue43',
              'casevarvalue44','casevarvalue45','casevarvalue46',
              'offerinsurance','offeract','offertax',
              'caselog','caseaction',
              'memberid','portid','assetid',
              'oldinsurances','oldact','oldtax','guaranteereceipt','discountcoupon','insuranceapplication','moneystandin','copyrenewnotice',
              'copyact','insurancecopy','taxcopy','insurancecopypayment','insurancepaymenttocompanycopy','actpaymenttocompanycopy','taxpaymenttocompanycopy',
              'actcopypayment','taxcopypayment',
              'anotherfile',
              'carfile','carphoto','carcamera',
              'citizenfile','driverfile','employeefile','salaryslipfile',
              'lastestoffer','interestoffer','confirmoffer',
              'caseassetid','caseassetrefinfo8','caseassetrefinfo1','caseassetrefinfo7','caseassetrefinfo9','caseassetrefinfo10','caseassetrefname','caseassetrefinfo3','caseassetrefinfo4','caseassetrefinfo5','caseassetrefinfo2','caseassetrefinfo6','caseassetrefinfo11','caseassetrefinfo12','caseassetrefinfo13','caseassetrefinfo14','caseassetrefinfo15','caseassetrefinfo16','caseassetrefinfo17','caseassetrefinfo18',
              'casecontactrequirename16','casecontactrequirename17','casecontactrequirename18','casecontactrequirename19','casecontactrequirename20','casecontactrequirevalue16','casecontactrequirevalue17','casecontactrequirevalue18','casecontactrequirevalue19','casecontactrequirevalue20',
              'casecustomername','casecustomerlastname','casecustomermobile','casecustomeremail','casecustomerfax','casecustomeraddress',
              'casedetailnotirequirename7','casedetailnotirequirename8','casedetailnotirequirename9','casedetailnotirequirename10','casedetailnotirequirename11','casedetailnotirequirename12','casedetailnotirequirename13','casedetailnotirequirename14','casedetailnotirequirename15','casedetailnotirequirename2','casedetailnotirequirename1','casedetailnotirequirename3','casedetailnotirequirename4','casedetailnotirequirename5','casedetailnotirequirename6','casedetailnotirequirevalue2',
              'casedetailnotirequirevalue4','casedetailnotirequirevalue7','casedetailnotirequirevalue8','casedetailnotirequirevalue9','casedetailnotirequirevalue10','casedetailnotirequirevalue11','casedetailnotirequirevalue12','casedetailnotirequirevalue13',
              'casedetailnotirequirevalue14','casedetailnotirequirevalue15',
              'casedetailnotirequirevalue1','casedetailnotirequirevalue3','casedetailnotirequirevalue5','casedetailnotirequirevalue6',
              'casetrackingvarname25','casetrackingvarname24','casetrackingvarname23','casetrackingvarname22','casetrackingvarname21','casetrackingvarname20','casetrackingvarname19','casetrackingvarname18','casetrackingvarname17','casetrackingvarname16','casetrackingvarname15','casetrackingvarname14','casetrackingvarname13','casetrackingvarname12','casetrackingvarname11','casetrackingvarname10','casetrackingvarname9','casetrackingvarname8','casetrackingvarname7','casetrackingvarname6',
              'casetrackingvarname5','casetrackingvarname4','casetrackingvarname3','casetrackingvarname2',
              'casetrackingvarname51','casetrackingvarname53','casetrackingvarname52','casetrackingrequirevalue9','casetrackingrequirevalue7','casetrackingrequirevalue8','casetrackingvarvalue1','casetrackinglastupdatedate','casetrackingvarname1','casetrackingvarname1','casetrackingautorenewdate','casetrackingfinisheddate','casetrackingstage','casetrackingcasestatus','casedetailrefasset','casedetailcasechannel','casedetailconsultpartner','casedetailcoordinate','casedetailserviceuser',
              'casedetailmatchid','casetrackingvarvalue25','casetrackingvarvalue24','casetrackingvarvalue23','casetrackingvarvalue22','casetrackingvarvalue21','casetrackingvarvalue20','casetrackingvarvalue19','casetrackingvarvalue18','casetrackingvarvalue17','casetrackingvarvalue16','casetrackingvarvalue15','casetrackingvarvalue14','casetrackingvarvalue13','casetrackingvarvalue12','casetrackingvarvalue11','casetrackingvarvalue10','casetrackingvarvalue9','casetrackingvarvalue8',
              'casetrackingvarvalue7','casetrackingvarvalue6','casetrackingvarvalue5','casetrackingvarvalue4','casetrackingvarvalue3','casetrackingvarvalue2',
              'casetrackingvarvalue51','casetrackingvarvalue53','casetrackingvarvalue52',
              'caseclassifyoldcaseid','caseclassifyrenewcaseid','caseclassifyrenewcase','caseclassifytype','caseclassifycat','caseclassifyname','caseclassifysubtype','caseclassifyoldcase',
              'caseheaderrenewcaseid','caseheadervar130','caseheadername','caseheadernotefromprevious','caseheadernotecopytorenew','caseheadernotefrommember','caseheadernotefrompartner','caseheadernotefromuser','caseheadercanceldate',
              'id','name','cases','url'
            ]
            )
          );
        }
        else
        {
          return view('error');
        }
    }
    public function showoffer($id)
    {
      $casecansee =  $this->datacenter->showcasecanseeall();

    if(in_array($id,$casecansee))
    {
      $cases = Cases::find($id);
      $offertypefromoffercat = OfferType::where('offer_category',$cases->casetype->offer_cat)->value('id');
      $offertypefromoffercat = OfferType::find($offertypefromoffercat);
      $offervaluename5 =  $offertypefromoffercat->offer_value_name5;
      $offervaluename6 =  $offertypefromoffercat->offer_value_name6;
      $offervaluename7 =  $offertypefromoffercat->offer_value_name7;
      $offervaluename1 =  $offertypefromoffercat->offer_value_name1;
      $offervaluename14 =  $offertypefromoffercat->offer_value_name14;
      $offervaluename19 =  $offertypefromoffercat->offer_value_name19;
      $offervaluename2 =  $offertypefromoffercat->offer_value_name2;
      $offervaluename3 =  $offertypefromoffercat->offer_value_name3;
      $offervaluename4 =  $offertypefromoffercat->offer_value_name4;
      $offervaluename8 =  $offertypefromoffercat->offer_value_name8;
      $offervaluename9 =  $offertypefromoffercat->offer_value_name9;
      $offervaluename10 =  $offertypefromoffercat->offer_value_name10;
      $offervaluename11 =  $offertypefromoffercat->offer_value_name11;
      $offervaluename12 =  $offertypefromoffercat->offer_value_name12;
      $offervaluename13 =  $offertypefromoffercat->offer_value_name13;
      $offervaluename14 =  $offertypefromoffercat->offer_value_name14;
      $offervaluename15 =  $offertypefromoffercat->offer_value_name15;
      $offervaluename16 =  $offertypefromoffercat->offer_value_name16;
      $offervaluename17 =  $offertypefromoffercat->offer_value_name17;
      $offervaluename18 =  $offertypefromoffercat->offer_value_name18;
      $offerpaymentvaluename4 =  $offertypefromoffercat->offer_payment_name4;
      $offerpaymentvaluename5 =  $offertypefromoffercat->offer_payment_name5;

      return view('system-mgmt/insurance/showoffer',compact(
            [
              'cases',
              'offervaluename5','offervaluename6','offervaluename7','offervaluename1','offervaluename14','offervaluename19',
              'offervaluename2','offervaluename3','offervaluename4','offervaluename8','offervaluename9','offervaluename10',
              'offervaluename11','offervaluename12','offervaluename13','offervaluename14','offervaluename15','offervaluename16',
              'offervaluename17','offervaluename18','offerpaymentvaluename4','offerpaymentvaluename5'
            ]));
    }
    else
    {
      return view('error');
    }
    }
    public function showofferuser($id)
    {
      $casecansee =  $this->datacenter->showcasecanseeall();

    if(in_array($id,$casecansee))
    {
      $cases = Cases::find($id);
      $offertypefromoffercat = OfferType::where('offer_category',$cases->casetype->offer_cat)->value('id');
      $offertypefromoffercat = OfferType::find($offertypefromoffercat);
      $offervaluename5 =  $offertypefromoffercat->offer_value_name5;
      $offervaluename6 =  $offertypefromoffercat->offer_value_name6;
      $offervaluename7 =  $offertypefromoffercat->offer_value_name7;
      $offervaluename1 =  $offertypefromoffercat->offer_value_name1;
      $offervaluename14 =  $offertypefromoffercat->offer_value_name14;
      $offervaluename19 =  $offertypefromoffercat->offer_value_name19;
      $offervaluename2 =  $offertypefromoffercat->offer_value_name2;
      $offervaluename3 =  $offertypefromoffercat->offer_value_name3;
      $offervaluename4 =  $offertypefromoffercat->offer_value_name4;
      $offervaluename8 =  $offertypefromoffercat->offer_value_name8;
      $offervaluename9 =  $offertypefromoffercat->offer_value_name9;
      $offervaluename10 =  $offertypefromoffercat->offer_value_name10;
      $offervaluename11 =  $offertypefromoffercat->offer_value_name11;
      $offervaluename12 =  $offertypefromoffercat->offer_value_name12;
      $offervaluename13 =  $offertypefromoffercat->offer_value_name13;
      $offervaluename14 =  $offertypefromoffercat->offer_value_name14;
      $offervaluename15 =  $offertypefromoffercat->offer_value_name15;
      $offervaluename16 =  $offertypefromoffercat->offer_value_name16;
      $offervaluename17 =  $offertypefromoffercat->offer_value_name17;
      $offervaluename18 =  $offertypefromoffercat->offer_value_name18;
      $offerpaymentvaluename4 =  $offertypefromoffercat->offer_payment_name4;
      $offerpaymentvaluename5 =  $offertypefromoffercat->offer_payment_name5;

      return view('system-mgmt/insurance/showofferuser',compact(
            [
              'cases',
              'offervaluename5','offervaluename6','offervaluename7','offervaluename1','offervaluename14','offervaluename19',
              'offervaluename2','offervaluename3','offervaluename4','offervaluename8','offervaluename9','offervaluename10',
              'offervaluename11','offervaluename12','offervaluename13','offervaluename14','offervaluename15','offervaluename16',
              'offervaluename17','offervaluename18','offerpaymentvaluename4','offerpaymentvaluename5'
            ]));
    }
    else
    {
      return view('error');
    }
    }
    public function showdetailuser($id)
    {
        $casecansee =  $this->datacenter->showcasecanseeall();

      if(in_array($id,$casecansee))
      {

      $casecenter = new CaseCenterController();
      $inputtocasecondition = $casecenter->putpathconincasecon($id);
      $checkcondition =$casecenter->checkcondition($id);
      $stagemove =$casecenter->stagemove($id);

        $cases = Cases::with(['Person','Renewcases','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','Asset.assettype','match_id','CaseStatus','coordiantor','CaseChannel'])->find($id);
        //$id = $id;
        $name = "";
        /////////data Case Header////////////
        $caseheaderrecheckofferflag =$cases->var_value129;
        $caseheadername =$cases->name;
        $caseheadernotefromprevious =$cases->note_from_previous_case;
        $caseheadernotecopytorenew =$cases->note_to_copy_to_renew_case;
        $caseheadernotefrommember =$cases->note_from_member;
        $caseheadernotefrompartner =$cases->note_from_partner;
        $caseheadernotefromuser =$cases->note_from_user;
        $caseheadervar130 =$cases->var_value130;
        $caseheadercanceldate =$cases->cancel_date;
        $caseheaderrenewcaseid =$cases->renew_case_id;
        /////////data Case Header////////////
        /////////data Case Classify////////////
        $caseclassifycat = $cases->CaseType->CaseCategory->name;
        $caseclassifytype = $cases->CaseType->name;
        $caseclassifysubtype = $cases->CaseSubType->name;
        if ($cases->ref_previous_case == null|| $cases->ref_previous_case == '' ||$cases->ref_previous_case == '') {
            $caseclassifyoldcaseid = '';
            $caseclassifyoldcase = '';
        } else {
            $caseclassifyoldcaseid = $cases->ref_previous_case;
            $caseclassifyoldcase = $cases->Cases->name;
        }
        if ($cases->renew_case_id == null|| $cases->renew_case_id == 0 ||$cases->renew_case_id == '') {
            $caseclassifyrenewcaseid = '';
            $caseclassifyrenewcase = '';
        } else {
            $caseclassifyrenewcaseid =$cases->renew_case_id;
            $caseclassifyrenewcase = $cases->Renewcases->name;
        }
        $caseclassifyname = $cases->name;
        /////////data Case Classify////////////
        /////////data Case Detail////////////
        if ($cases->created_by_pid == null|| $cases->created_by_pid == 0 ||$cases->created_by_pid == '') {
            $casedetailmatchid = '';
        } else {
            $casedetailmatchid = $cases->match_id->public_name;
        }
        if ($cases->service_user_block_id == null|| $cases->service_user_block_id == 0||$cases->service_user_block_id == '') {
            $casedetailserviceuser = '';
        } else {
            $casedetailserviceuser = $cases->Block->name;
        }
        if ($cases->coordinate_user_block_id == null|| $cases->coordinate_user_block_id == 0||$cases->coordinate_user_block_id == '') {
            $casedetailcoordinate = '';
        } else {
            $casedetailcoordinate = $cases->coordiantor->firstname;
        }
        if ($cases->consult_partner_block_id == null|| $cases->consult_partner_block_id == 0||$cases->consult_partner_block_id == '') {
            $casedetailconsultpartner = '';
        } else {
            $casedetailconsultpartner = $cases->Partner_block->name;
        }
        if ($cases->case_channel == null|| $cases->case_channel == 0||$cases->case_channel == '') {
            $casedetailcasechannel = '';
        } else {
            $casedetailcasechannel = $cases->CaseChannel->name;
        }
        if ($cases->referal_asset == null|| $cases->referal_asset == 0||$cases->referal_asset == '') {
            $casedetailrefasset = '';
        } else {
            $casedetailrefasset = $cases->Asset->name;
        }
        /////////data Case Detail////////////
        /////////data Case Tracking////////////
        if ($cases->case_status == null|| $cases->case_status == 0||$cases->case_status == '') {
            $casetrackingcasestatus = '';
        } else {
            $casetrackingcasestatus = $cases->CaseStatus->name;
        }
        if ($cases->stage == null|| $cases->stage == 0||$cases->stage == '') {
            $casetrackingstage = '';
        } else {
            $casetrackingstage = $cases->Stage->name;
        }
        $casetrackingfinisheddate = $cases->finish_date;
        $casetrackingautorenewdate = $cases->auto_renew_date;

        if ($cases->type_id == null|| $cases->type_id == 0||$cases->type_id == '') {
            $casetrackingvarname1 = '';
            $casetrackingvarname52 = '';
            $casetrackingvarname51 = '';
            $casetrackingvarname53 = '';
            $casetrackingvarname2 = '';
            $casetrackingvarname3 = '';
            $casetrackingvarname4 = '';
            $casetrackingvarname5 = '';
            $casetrackingvarname6 = '';
            $casetrackingvarname7 = '';
            $casetrackingvarname8 = '';
            $casetrackingvarname9 = '';
            $casetrackingvarname10 = '';
            $casetrackingvarname11 = '';
            $casetrackingvarname12 = '';
            $casetrackingvarname13 = '';
            $casetrackingvarname14 = '';
            $casetrackingvarname15 = '';
            $casetrackingvarname16 = '';
            $casetrackingvarname17 = '';
            $casetrackingvarname18 = '';
            $casetrackingvarname19 = '';
            $casetrackingvarname20 = '';
            $casetrackingvarname21 = '';
            $casetrackingvarname22 = '';
            $casetrackingvarname23 = '';
            $casetrackingvarname24 = '';
            $casetrackingvarname25 = '';
            $casedetailnotirequirename4 = '';
            $casedetailnotirequirename1 = '';
            $casedetailnotirequirename2 = '';
            $casedetailnotirequirename3 = '';
            $casedetailnotirequirename5 = '';
            $casedetailnotirequirename6 = '';
            $casedetailnotirequirename7 = '';
            $casedetailnotirequirename8 = '';
            $casedetailnotirequirename9 = '';
            $casedetailnotirequirename10 = '';
            $casedetailnotirequirename11 = '';
            $casedetailnotirequirename12 = '';
            $casedetailnotirequirename13 = '';
            $casedetailnotirequirename14 = '';
            $casedetailnotirequirename15 = '';
            /////////data Case Contact Detail////////////
            $casecontactrequirename16 = '';
            $casecontactrequirename17 = '';
            $casecontactrequirename18 = '';
            $casecontactrequirename19 = '';
            $casecontactrequirename20 = '';
            /////////data Case Contact Detail////////////
            //////// for Insurance offer ////////
            $casevarname38 = '';
            $casevarname39 = '';
            $casevarname40 = '';
            //////// for Insurance offer ////////
            //////// for Act offer ////////
            $casevarname41 = '';
            $casevarname42 = '';
            $casevarname43 = '';
            //////// for Act offer ////////
            //////// for Act offer ////////
            $casevarname44 = '';
            $casevarname45 = '';
            $casevarname46 = '';
            //////// for Act offer ////////
            //////// for CasePayment ////////
            $casevarname5 = '';
            $casevarname28 = '';
            $casevarname29 = '';
            $casevarname51 = '';
            $casevarname52 = '';
            $casevarname53 = '';
            $casevarname26 = '';
            $casevarname27 = '';
            $casevarname30 = '';
            $casevarname31 = '';
            $casevarname32 = '';
            $casevarname33 = '';
            $casevarname34 = '';
            $casevarname35 = '';
            $casevarname36 = '';
            $casevarname37 = '';
            $casevarname47 = '';
            $casevarname48 = '';
            $casevarname49 = '';
            $casevarname50 = '';
            $casevarname54 = '';
            $casevarname55 = '';
            $casevarname56 = '';
            $casevarname57 = '';
            $casevarname58 = '';
            $casevarname59 = '';
            $casevarname60 = '';
            $casevarname61 = '';
            $casevarname62 = '';
            $casevarname63 = '';
            $casevarname64 = '';
            $casevarname65 = '';
            $casevarname66 = '';
            $casevarname67 = '';
            $casevarname68 = '';
            $casevarname69 = '';


        } else {
            $casetrackingvarname1 = $cases->CaseType->var_name1;
            $casetrackingvarname52 = $cases->CaseType->var_name52;
            $casetrackingvarname51 = $cases->CaseType->var_name51;
            $casetrackingvarname53 = $cases->CaseType->var_name53;
            $casetrackingvarname2 = $cases->CaseType->var_name2;
            $casetrackingvarname3 = $cases->CaseType->var_name3;
            $casetrackingvarname4 = $cases->CaseType->var_name4;
            $casetrackingvarname5 = $cases->CaseType->var_name5;
            $casetrackingvarname6 = $cases->CaseType->var_name6;
            $casetrackingvarname7 = $cases->CaseType->var_name7;
            $casetrackingvarname8 = $cases->CaseType->var_name8;
            $casetrackingvarname9 = $cases->CaseType->var_name9;
            $casetrackingvarname10 = $cases->CaseType->var_name10;
            $casetrackingvarname11 = $cases->CaseType->var_name11;
            $casetrackingvarname12 = $cases->CaseType->var_name12;
            $casetrackingvarname13 = $cases->CaseType->var_name13;
            $casetrackingvarname14 = $cases->CaseType->var_name14;
            $casetrackingvarname15 = $cases->CaseType->var_name15;
            $casetrackingvarname16 = $cases->CaseType->var_name16;
            $casetrackingvarname17 = $cases->CaseType->var_name17;
            $casetrackingvarname18 = $cases->CaseType->var_name18;
            $casetrackingvarname19 = $cases->CaseType->var_name19;
            $casetrackingvarname20 = $cases->CaseType->var_name20;
            $casetrackingvarname21 = $cases->CaseType->var_name21;
            $casetrackingvarname22 = $cases->CaseType->var_name22;
            $casetrackingvarname23 = $cases->CaseType->var_name23;
            $casetrackingvarname24 = $cases->CaseType->var_name24;
            $casetrackingvarname25 = $cases->CaseType->var_name25;
            $casedetailnotirequirename4 = $cases->CaseType->requirename_var4;
            $casedetailnotirequirename1 = $cases->CaseType->requirename_var1;
            $casedetailnotirequirename2 = $cases->CaseType->requirename_var2;
            $casedetailnotirequirename3 = $cases->CaseType->requirename_var3;
            $casedetailnotirequirename5 = $cases->CaseType->requirename_var5;
            $casedetailnotirequirename6 = $cases->CaseType->requirename_var6;
            $casedetailnotirequirename7 = $cases->CaseType->requirename_var7;
            $casedetailnotirequirename8 = $cases->CaseType->requirename_var8;
            $casedetailnotirequirename9 = $cases->CaseType->requirename_var9;
            $casedetailnotirequirename10 = $cases->CaseType->requirename_var10;
            $casedetailnotirequirename11 = $cases->CaseType->requirename_var11;
            $casedetailnotirequirename12 = $cases->CaseType->requirename_var12;
            $casedetailnotirequirename13 = $cases->CaseType->requirename_var13;
            $casedetailnotirequirename14 = $cases->CaseType->requirename_var14;
            $casedetailnotirequirename15 = $cases->CaseType->requirename_var15;
            /////////data Case Contact Detail////////////
            $casecontactrequirename16 = $cases->CaseType->requirename_var16;
            $casecontactrequirename17 = $cases->CaseType->requirename_var17;
            $casecontactrequirename18 = $cases->CaseType->requirename_var18;
            $casecontactrequirename19 = $cases->CaseType->requirename_var19;
            $casecontactrequirename20 = $cases->CaseType->requirename_var20;
            /////////data Case Contact Detail////////////
            //////// for Insurance offer ////////
            $casevarname38 = $cases->CaseType->var_name38;
            $casevarname39 = $cases->CaseType->var_name39;
            $casevarname40 = $cases->CaseType->var_name40;
            //////// for Insurance offer ////////
            //////// for Act offer ////////
            $casevarname41 = $cases->CaseType->var_name41;
            $casevarname42 = $cases->CaseType->var_name42;
            $casevarname43 = $cases->CaseType->var_name43;
            //////// for Act offer ////////
            //////// for Act offer ////////
            $casevarname44 = $cases->CaseType->var_name44;
            $casevarname45 = $cases->CaseType->var_name45;
            $casevarname46 = $cases->CaseType->var_name46;
            //////// for Act offer ////////
            //////// for CasePayment ////////
            $casevarname5 = $cases->CaseType->var_name5;
            $casevarname28 = $cases->CaseType->var_name28;
            $casevarname29 = $cases->CaseType->var_name29;
            $casevarname51 = $cases->CaseType->var_name51;
            $casevarname52 = $cases->CaseType->var_name52;
            $casevarname53 = $cases->CaseType->var_name53;
            $casevarname26 = $cases->CaseType->var_name26;
            $casevarname27 = $cases->CaseType->var_name27;
            $casevarname30 = $cases->CaseType->var_name30;
            $casevarname31 = $cases->CaseType->var_name31;
            $casevarname32 = $cases->CaseType->var_name32;
            $casevarname33 = $cases->CaseType->var_name33;
            $casevarname34 = $cases->CaseType->var_name34;
            $casevarname35 = $cases->CaseType->var_name35;
            $casevarname36 = $cases->CaseType->var_name36;
            $casevarname37 = $cases->CaseType->var_name37;
            $casevarname47 = $cases->CaseType->var_name47;
            $casevarname48 = $cases->CaseType->var_name48;
            $casevarname49 = $cases->CaseType->var_name49;
            $casevarname50 = $cases->CaseType->var_name50;
            //////// for CasePayment ////////
            $casevarname54 = $cases->CaseType->var_name54;
            $casevarname55 = $cases->CaseType->var_name55;
            $casevarname56 = $cases->CaseType->var_name56;
            $casevarname57 = $cases->CaseType->var_name57;
            $casevarname58 = $cases->CaseType->var_name58;
            $casevarname59 = $cases->CaseType->var_name59;
            $casevarname60 = $cases->CaseType->var_name60;
            $casevarname61 = $cases->CaseType->var_name61;
            $casevarname62 = $cases->CaseType->var_name62;
            $casevarname63 = $cases->CaseType->var_name63;
            $casevarname64 = $cases->CaseType->var_name64;
            $casevarname65 = $cases->CaseType->var_name65;
            $casevarname66 = $cases->CaseType->var_name66;
            $casevarname67 = $cases->CaseType->var_name67;
            $casevarname68 = $cases->CaseType->var_name68;
            $casevarname69 = $cases->CaseType->var_name69;


        }
        $casetrackinglastupdatedate = $cases->last_updated_date;
        $casetrackingvarvalue1 = $cases->var_value1;
        $casetrackingvarvalue51 = $cases->var_value51;
        $casetrackingvarvalue52 = $cases->var_value52;
        $casetrackingvarvalue53 = $cases->var_value53;
        $casetrackingvarvalue2 = $cases->var_value2;
        $casetrackingvarvalue3 = $cases->var_value3;
        $casetrackingvarvalue4 = $cases->var_value4;
        $casetrackingvarvalue5 = $cases->var_value5;
        $casetrackingvarvalue6 = $cases->var_value6;
        $casetrackingvarvalue7 = $cases->var_value7;
        $casetrackingvarvalue8 = $cases->var_value8;
        $casetrackingvarvalue9 = $cases->var_value9;
        $casetrackingvarvalue10 = $cases->var_value10;
        $casetrackingvarvalue11 = $cases->var_value11;
        $casetrackingvarvalue12 = $cases->var_value12;
        $casetrackingvarvalue13 = $cases->var_value13;
        $casetrackingvarvalue14 = $cases->var_value14;
        $casetrackingvarvalue15 = $cases->var_value15;
        $casetrackingvarvalue16 = $cases->var_value16;
        $casetrackingvarvalue17 = $cases->var_value17;
        $casetrackingvarvalue18 = $cases->var_value18;
        $casetrackingvarvalue19 = $cases->var_value19;
        $casetrackingvarvalue20 = $cases->var_value20;
        $casetrackingvarvalue21 = $cases->var_value21;
        $casetrackingvarvalue22 = $cases->var_value22;
        $casetrackingvarvalue23 = $cases->var_value23;
        $casetrackingvarvalue24 = $cases->var_value24;
        $casetrackingvarvalue25 = $cases->var_value25;
        $casetrackingrequirevalue7 = $cases->require_value7;
        $casetrackingrequirevalue8 = $cases->require_value8;
        $casetrackingrequirevalue9 = $cases->require_value9;
        /////////data Case Tracking////////////
        /////////data Detail Noti////////////
        $casedetailnotirequirevalue4 = $cases->require_value4;
        $casedetailnotirequirevalue1 = $cases->require_value1;
        $casedetailnotirequirevalue2 = $cases->require_value2;
        $casedetailnotirequirevalue3 = $cases->require_value3;
        $casedetailnotirequirevalue5 = $cases->require_value5;
        $casedetailnotirequirevalue6 = $cases->require_value6;
        $casedetailnotirequirevalue7 = $cases->require_value7;
        $casedetailnotirequirevalue8 = $cases->require_value8;
        $casedetailnotirequirevalue9 = $cases->require_value9;
        $casedetailnotirequirevalue10 = $cases->require_value10;
        $casedetailnotirequirevalue11 = $cases->require_value11;
        $casedetailnotirequirevalue12 = $cases->require_value12;
        $casedetailnotirequirevalue13 = $cases->require_value13;
        $casedetailnotirequirevalue14 = $cases->require_value14;
        $casedetailnotirequirevalue15 = $cases->require_value15;
        /////////data Detail Noti////////////
        //////// for Act offer //////
        $casevarvalue38 = $cases->var_value38;
        $casevarvalue39 = $cases->var_value39;
        $casevarvalue40 = $cases->var_value40;
        //////// for Act offer //////
        //////// for Act offer //////
        $casevarvalue41 = $cases->var_value41;
        $casevarvalue42 = $cases->var_value42;
        $casevarvalue43 = $cases->var_value43;
        //////// for Act offer //////
        //////// for Act offer //////
        $casevarvalue44 = $cases->var_value44;
        $casevarvalue45 = $cases->var_value45;
        $casevarvalue46 = $cases->var_value46;
        //////// for Act offer //////
        //////// for Case Peyment //////
        $casevarvalue28 = $cases->var_value28;
        $casevarvalue29 = $cases->var_value29;
        $casevarvalue51 = $cases->var_value51;
        $casevarvalue52 = $cases->var_value52;
        $casevarvalue53 = $cases->var_value53;
        $casevarvalue26 = $cases->var_value26;
        $casevarvalue27 = $cases->var_value27;
        $casevarvalue30 = $cases->var_value30;
        $casevarvalue31 = $cases->var_value31;
        $casevarvalue32 = $cases->var_value32;
        $casevarvalue33 = $cases->var_value33;
        $casevarvalue34 = $cases->var_value34;
        $casevarvalue35 = $cases->var_value35;
        $casevarvalue36 = $cases->var_value36;
        $casevarvalue37 = $cases->var_value37;
        //////// for Case Peyment //////
        $casevarvalue47 = $cases->var_value47;
        $casevarvalue48 = $cases->var_value48;
        $casevarvalue49 = $cases->var_value49;
        $casevarvalue50 = $cases->var_value50;

        /////////data Case Customer Detail////////////
        $casevarvalue54 = $cases->var_value54;
        $casevarvalue55 = $cases->var_value55;
        $casevarvalue56 = $cases->var_value56;
        $casevarvalue57 = $cases->var_value57;
        $casevarvalue58 = $cases->var_value58;
        $casevarvalue59 = $cases->var_value59;
        $casevarvalue60 = $cases->var_value60;
        $casevarvalue61 = $cases->var_value61;
        $casevarvalue62 = $cases->var_value62;
        $casevarvalue63 = $cases->var_value63;
        $casevarvalue64 = $cases->var_value64;
        $casevarvalue65 = $cases->var_value65;
        $casevarvalue66 = $cases->var_value66;
        $casevarvalue67 = $cases->var_value67;
        $casevarvalue68 = $cases->var_value68;
        $casevarvalue69 = $cases->var_value69;

        if ($cases->member_case_owner == null|| $cases->member_case_owner == 0||$cases->member_case_owner == '') {
            $casecustomername = '';
            $casecustomerlastname = '';
            $casecustomermobile = '';
            $casecustomeremail = '';
            $casecustomerfax = '';
            $casecustomeraddress = '';
            $casecustomeradvisor = '';

        } else {
            $casecustomername = $cases->Person->name;
            $casecustomerlastname = $cases->Person->lname;
            $casecustomermobile = $cases->Person->mobile;
            $casecustomeremail = $cases->Person->email;
            $casecustomerfax = $cases->Person->add2_fax;
            if($cases->Person->ref_member_pid == null|| $cases->Person->ref_member_pid == 0||$cases->Person->ref_member_pid == '')
            {
              $casecustomeradvisor = '';
            }
            else
            {
              $casecustomeradvisor =  $cases->Person->refmemberpid->public_name;
            }

            if ($cases->Person->add2 == null || $cases->Person->add2 == '') {
                $add2 = '';
            } else {
                $add2 = 'เลขที่ '.$cases->Person->add2;
            }
            if ($cases->Person->add2_road == null || $cases->Person->add2_road == '' || $cases->Person->add2_road == '') {
                $add2road = '';
            } else {
                $add2road = ' ถนน '.$cases->Person->add2_road;
            }
            if ($cases->Person->add2_alley == null || $cases->Person->add2_alley== '') {
                $add2alley = '';
            } else {
                $add2alley = ' ซอย '.$cases->Person->add2_alley;
            }
            if ($cases->Person->add2_subdistrict == null || $cases->Person->add2_subdistrict== '') {
                $add2subdistrict = '';
            } else {
                $add2subdistrict = ' แขวง '.$cases->Person->add2_subdistrict;
            }
            if ($cases->Person->add2_district == null || $cases->Person->add2_district== '') {
                $add2district = '';
            } else {
                $add2district = ' เขต '.$cases->Person->add2_district;
            }
            if ($cases->Person->add2_city == null || $cases->Person->add2_city== '') {
                $add2city = '';
            } else {
                $add2city = ' จังหวัด '.$cases->Person->add2_city;
            }
            if ($cases->Person->add2_country == null || $cases->Person->add2_country== '') {
                $add2country = '';
            } else {
                $add2country= ' ประเทศ '.$cases->Person->add2_country;
            }
            if ($cases->Person->add2_postcode == null ||$cases->Person->add2_postcode== '') {
                $add2postcode = '';
            } else {
                $add2postcode = ' รหัรหัสไปรษณีย์ '.$cases->Person->add2_postcode;
            }
            $casecustomeraddress = $add2.$add2road.$add2alley.$add2subdistrict.$add2district.$add2city.$add2country.$add2postcode;
            if ($casecustomerlastname = 'null') {
                $casecustomerlastname = '';
            }
        }
        /////////data Case Customer Detail////////////
        /////////data Case Contact Detail////////////
        $casecontactrequirevalue16 = $cases->require_value16;
        $casecontactrequirevalue17 = $cases->require_value17;
        $casecontactrequirevalue18 = $cases->require_value18;
        $casecontactrequirevalue19 = $cases->require_value19;
        $casecontactrequirevalue20 = $cases->require_value20;
        /////////data Case Contact Detail////////////
        /////////data Asset ////////////
        if ($cases->referal_asset == null ||$cases->referal_asset == '' ||$cases->referal_asset == 0) {
            $caseassetrefname = '';
            $caseassetrefinfo2 = '';
            $caseassetrefinfo3 = '';
            $caseassetrefinfo4 = '';
            $caseassetrefinfo5 = '';
            $caseassetrefinfo6 = '';
            $caseassetrefinfo8 = '';
            $caseassetrefinfo1 = '';
            $caseassetrefinfo7 = '';
            $caseassetrefinfo9 = '';
            $caseassetrefinfo10 = '';
            $caseassetrefinfo11 = '';
            $caseassetrefinfo12 = '';
            $caseassetrefinfo13 = '';
            $caseassetrefinfo14 = '';
            $caseassetrefinfo15 = '';
            $caseassetrefinfo16 = '';
            $caseassetrefinfo17 = '';
            $caseassetrefinfo18 = '';
            $caseassetrefnamehead = '';
            $caseassetrefinfohead2 = '';
            $caseassetrefinfohead3 = '';
            $caseassetrefinfohead4 = '';
            $caseassetrefinfohead5 = '';
            $caseassetrefinfohead6 = '';
            $caseassetrefinfohead8 = '';
            $caseassetrefinfohead1 = '';
            $caseassetrefinfohead7 = '';
            $caseassetrefinfohead9 = '';
            $caseassetrefinfohead10 = '';
            $caseassetrefinfohead11 = '';
            $caseassetrefinfohead12 = '';
            $caseassetrefinfohead13 = '';
            $caseassetrefinfohead14 = '';
            $caseassetrefinfohead15 = '';
            $caseassetrefinfohead16 = '';
            $caseassetrefinfohead17 = '';
            $caseassetrefinfohead18 = '';
            $caseassetid = '';
        } else {
            $caseassetrefname = $cases->Asset->ref_name;
            $caseassetrefinfo2 = $cases->Asset->ref_info2;
            $caseassetrefinfo3 = $cases->Asset->ref_info3;
            $caseassetrefinfo4 = $cases->Asset->ref_info4;
            $caseassetrefinfo5 = $cases->Asset->ref_info5;
            $caseassetrefinfo6 = $cases->Asset->ref_info6;
            $caseassetrefinfo8 = $cases->Asset->ref_info8;
            $caseassetrefinfo1 = $cases->Asset->ref_info1;
            $caseassetrefinfo7 = $cases->Asset->ref_info7;
            $caseassetrefinfo9 = $cases->Asset->ref_info9;
            $caseassetrefinfo10 = $cases->Asset->ref_info10;
            $caseassetrefinfo11 = $cases->Asset->ref_info11;
            $caseassetrefinfo12 = $cases->Asset->ref_info12;
            $caseassetrefinfo13 = $cases->Asset->ref_info13;
            $caseassetrefinfo14 = $cases->Asset->ref_info14;
            $caseassetrefinfo15 = $cases->Asset->ref_info15;
            $caseassetrefinfo16 = $cases->Asset->ref_info16;
            $caseassetrefinfo17 = $cases->Asset->ref_info17;
            $caseassetrefinfo18 = $cases->Asset->ref_info18;
            $caseassetrefnamehead = $cases->Asset->assettype->ref_name_head;
            $caseassetrefinfohead2 = $cases->Asset->assettype->ref_info_head2;
            $caseassetrefinfohead3 = $cases->Asset->assettype->ref_info_head3;
            $caseassetrefinfohead4 =$cases->Asset->assettype->ref_info_head4;
            $caseassetrefinfohead5 = $cases->Asset->assettype->ref_info_head5;
            $caseassetrefinfohead6 = $cases->Asset->assettype->ref_info_head6;
            $caseassetrefinfohead8 = $cases->Asset->assettype->ref_info_head8;
            $caseassetrefinfohead1 = $cases->Asset->assettype->ref_info_head1;
            $caseassetrefinfohead7 = $cases->Asset->assettype->ref_info_head7;
            $caseassetrefinfohead9 = $cases->Asset->assettype->ref_info_head9;
            $caseassetrefinfohead10 = $cases->Asset->assettype->ref_info_head10;
            $caseassetrefinfohead11 = $cases->Asset->assettype->ref_info_head11;
            $caseassetrefinfohead12 = $cases->Asset->assettype->ref_info_head12;
            $caseassetrefinfohead13 = $cases->Asset->assettype->ref_info_head13;
            $caseassetrefinfohead14 = $cases->Asset->assettype->ref_info_head14;
            $caseassetrefinfohead15 = $cases->Asset->assettype->ref_info_head15;
            $caseassetrefinfohead16 = $cases->Asset->assettype->ref_info_head16;
            $caseassetrefinfohead17 = $cases->Asset->assettype->ref_info_head17;
            $caseassetrefinfohead18 = $cases->Asset->assettype->ref_info_head18;

            $caseassetid = $cases->Asset->id;
        }

        /////////data Asset ////////////
        /////////////////data Offer/////////////
        $casemiddledata = Casemiddledata::where('case_id', $id)->pluck('offer_id')->toArray();

        $offertypefromoffercat = OfferType::where('offer_category',$cases->casetype->offer_cat)->value('id');
        $offertypefromoffercat = OfferType::find($offertypefromoffercat);
        $confirmoffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->get();
        $confirmofferarray = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->pluck('id')->toArray();
        $proposal = Proposal::with(['match_id','partner_block','block','person','cases'])->where('case_id', $id)->pluck('id')->toArray();
        $interestoffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->WhereNotIn('id', $confirmofferarray)->where('interest', 1)->get();
        $interestofferarray = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->WhereNotIn('id', $confirmofferarray)->where('interest', 1)->pluck('id')->toArray();
        $caseporposaloffer = Offer::with(['OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->where('interest', 1)->pluck('id')->toArray();
        $confirmandinterest = array_merge($interestofferarray, $confirmofferarray);
        $lastestoffer = Offer::with(['promotion','campaign','OfferType','match_id','Person','branch'])->whereIn('proposal_id', $proposal)->WhereNotIn('id', $confirmandinterest)->orderBy('id', 'desc')->take(5)->get();
        /////////////////data Offer/////////////
        //////////////// data File /////////////
        $memberid = $cases->member_case_owner;
        $findfile = DB::table('member_attachment')->where('member_id', $memberid)->pluck('file_id');
        $memberfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active');
        $citizenfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 9)->get();
        $driverfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 11)->get();
        $employeefile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 31)->get();
        $salaryslipfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 32)->get();
        $companycopy = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 20)->get();
        $commercialcert = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 28)->get();
        $departmentcopy = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->where('file_cat_id', 22)->get();


        $assetid = $cases->referal_asset;
        $portid = $cases->Asset->port_id;
        $assetfileid = Asset_Attacht::where('asset_id', $assetid)->pluck('file_id')->toArray();
        $assetfile = File::whereIn('id', $assetfileid);
        $carfile = File::whereIn('id', $assetfileid)->where('file_cat_id', 15)->get();
        $carphoto = File::whereIn('id', $assetfileid)->where('file_cat_id', 14)->get();
        $carcamera = File::whereIn('id', $assetfileid)->where('file_cat_id', 44)->get();

        $caseid = $id;
        $casefileid = Case_Attacht::where('case_id', $caseid)->pluck('file_id')->toArray();
        $casefile = File::whereIn('id', $casefileid);
        $oldinsurances =  File::whereIn('id', $casefileid)->where('file_cat_id', 36)->get();
        $oldact =  File::whereIn('id', $casefileid)->where('file_cat_id', 37)->get();
        $oldtax =  File::whereIn('id', $casefileid)->where('file_cat_id', 38)->get();
        $guaranteereceipt = File::whereIn('id', $casefileid)->where('file_cat_id', 39)->get();
        $discountcoupon =  File::whereIn('id', $casefileid)->where('file_cat_id', 40)->get();
        $insuranceapplication =  File::whereIn('id', $casefileid)->where('file_cat_id', 41)->get();
        $moneystandin =  File::whereIn('id', $casefileid)->where('file_cat_id', 42)->get();
        $copyrenewnotice =  File::whereIn('id', $casefileid)->where('file_cat_id', 43)->get();
        $copyact =  File::whereIn('id', $casefileid)->where('file_cat_id', 45)->get();
        $insurancecopy =  File::whereIn('id', $casefileid)->where('file_cat_id', 46)->orderBy('id', 'DESC')->take(1)->get();
        $taxcopy = $casefile->where('file_cat_id', 47)->get();
        $insurancecopypayment =  File::whereIn('id', $casefileid)->where('file_cat_id', 50)->get();
        $insurancepaymenttocompanycopy =  File::whereIn('id', $casefileid)->where('file_cat_id', 54)->get();
        $actpaymenttocompanycopy =  File::whereIn('id', $casefileid)->where('file_cat_id', 55)->get();
        $taxpaymenttocompanycopy =  File::whereIn('id', $casefileid)->where('file_cat_id', 56)->get();
        $actcopypayment =  File::whereIn('id', $casefileid)->where('file_cat_id', 51)->get();
        $taxcopypayment =  File::whereIn('id', $casefileid)->where('file_cat_id', 52)->get();
        $anotherfile =  File::whereIn('id', $casefileid)->where('file_cat_id', 53)->get();
        //////////////// data File /////////////
        //////////////// Caselog and casecondition /////////////
        $caselog = Case_log::with(['cases','movefromstage','movetostage','path','pathcondition'])->where('case_id', $id)->get();
        $caseaction =  CaseAction::with(['stage','stageaction','cases','action'])->where('case_id', $id)->get();
        //    $casecondition =  Case_condition::with(['path_condition_detail'])->where('current_stage',$stage)->where('condition_flag',1)->where('case_id',$caseid)->get();
        //////////////// Caselog  /////////////
        /////////////// Data Offer Insurance ////////
        $casemiddledata = Casemiddledata::where('case_id', $id)->pluck('offer_id')->toArray();
        $offerinsuranceid = Offer::whereIn('id', $casemiddledata)->where('type_id','!=',7)->where('type_id','!=',8)->orderBy('id', 'DESC')->take(1)->value('id');
        $offerinsurance = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->find($offerinsuranceid);
        if ($offerinsurance == null || $offerinsurance == '') {
            $offerinsurancecompany = '';
            $offerinsurancepartner = '';
            $offerinsurancefilepublicname = '';
            $offerinsurancefileid = '';
            $offerinsurancepaymentpremium = 0;
            $offerinsurancepaymentdiscount15 = 0;
            $offerinsurancepaymentdiscount16 = 0;
            $offerinsurancepaymentdiscount18 = 0;
            $offerinsurancepaymentdiscount20 = 0;
            $offerinsurancepaymenttaxdeduction= 0;
            $offerinsurancepaymentpartnerconsultfee= 0;
            $offerinsurancepaymentuserservicefee= 0;
            $offerinsurancepaymentgrosscom = 0;
            $offerinsurancecopypaymentfilepublicname = '';
            $offerinsurancecopypaymentfileid = '';
            $offerinsurancepaymenttocompanycopyfilepublicname = '';
            $offerinsurancepaymenttocompanycopyfileid = '';
        } else {
            $offerinsurancecompany = $offerinsurance->Person->name;
            if( $offerinsurance->Proposal->partner_block == NULL ||$offerinsurance->Proposal->partner_block == 0 ||$offerinsurance->Proposal->partner_block == '')
            {
              $offerinsurancepartner = '';
            }
            else
            {
              $offerinsurancepartner = $offerinsurance->Proposal->Partner_block->name;
            }
            $offerinsurancepaymentpremium   = $offerinsurance->offer_payment_value4;
            $offerinsurancepaymentdiscount15 = $offerinsurance->offer_payment_value15;
            $offerinsurancepaymentdiscount18 = $offerinsurance->offer_payment_value18;
            $offerinsurancepaymentdiscount16 = $offerinsurance->offer_payment_value16;
            $offerinsurancepaymentdiscount20 = $offerinsurance->offer_payment_value20;
            $offerinsurancepaymenttaxdeduction = $offerinsurance->offer_payment_value5;
            $offerinsurancepaymentpartnerconsultfee = $offerinsurance->offer_payment_value17;
            $offerinsurancepaymentuserservicefee = $offerinsurance->offer_payment_value19;
            $offerinsurancepaymentgrosscom = $offerinsurance->offer_payment_value8;
            if (count($insurancecopy) < 1) {
                $offerinsurancefilepublicname = '';
                $offerinsurancefileid = '';
            } else {
                foreach ($insurancecopy as $in) {
                    $offerinsurancefilepublicname = $in->file_public_name;
                    $offerinsurancefileid = $in->id;
                }
            }
            if (count($insurancecopypayment) < 1) {
                $offerinsurancecopypaymentfilepublicname = '';
                $offerinsurancecopypaymentfileid = '';
            } else {
                foreach ($insurancecopypayment as $in) {
                    $offerinsurancecopypaymentfilepublicname = $in->file_public_name;
                    $offerinsurancecopypaymentfileid = $in->id;
                }
            }
            if (count($insurancepaymenttocompanycopy) < 1) {
                $offerinsurancepaymenttocompanycopyfilepublicname = '';
                $offerinsurancepaymenttocompanycopyfileid = '';
            } else {
                foreach ($insurancepaymenttocompanycopy as $in) {
                    $offerinsurancepaymenttocompanycopyfilepublicname = $in->file_public_name;
                    $offerinsurancepaymenttocompanycopyfileid = $in->id;
                }
            }
        }

        $offeractid = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->where('type_id', 7)->orderBy('id', 'DESC')->take(1)->value('id');
        $offeract = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->find($offeractid);
        if ($offeract == null || $offeract == '') {
            $offeractcompany = '';
            $offeractpartner = '';
            $offeractfilepublicname = '';
            $offeractfileid = '';
            $offeractpaymentpremium = 0;
            $offeractpaymentdiscount15 = 0;
            $offeractpaymentdiscount16 = 0;
            $offeractpaymentdiscount18 = 0;
            $offeractpaymentdiscount20 = 0;
            $offeractpaymenttaxdeduction = 0;
            $offeractpaymentpartnerconsultfee = 0;
            $offeractpaymentuserservicefee = 0;
            $offeractpaymentgrosscom = 0;
            $offeractcopypaymentfilepublicname = '';
            $offeractcopypaymentfileid = '';
            $offeractpaymenttocompanycopyfilepublicname = '';
            $offeractpaymenttocompanycopyfileid = '';
        } else {
            $offeractcompany = $offeract->Person->name;
            $offeractpartner = $offeract->Proposal->Partner_block->name;
            $offeractpaymentpremium   = $offeract->offer_payment_value4;
            $offeractpaymentdiscount15 = $offeract->offer_payment_value15;
            $offeractpaymentdiscount16 = $offeract->offer_payment_value16;
            $offeractpaymentdiscount18 = $offeract->offer_payment_value18;
            $offeractpaymentdiscount20 = $offeract->offer_payment_value20;
            $offeractpaymenttaxdeduction = $offeract->offer_payment_value5;
            $offeractpaymentpartnerconsultfee = $offeract->offer_payment_value17;
            $offeractpaymentuserservicefee = $offeract->offer_payment_value19;
            $offeractpaymentgrosscom = $offeract->offer_payment_value8;

            if (count($copyact) < 1) {
                $offeractfilepublicname = '';
                $offeractfileid = '';
            } else {
                foreach ($copyact as $in) {
                    $offeractfilepublicname = $in->file_public_name;
                    $offeractfileid = $in->id;
                }
            }
            if (count($actcopypayment) < 1) {
                $offeractcopypaymentfilepublicname = '';
                $offeractcopypaymentfileid = '';
            } else {
                foreach ($actcopypayment as $in) {
                    $offeractcopypaymentfilepublicname = $in->file_public_name;
                    $offeractcopypaymentfileid = $in->id;
                }
            }
            if (count($actpaymenttocompanycopy) < 1) {
                $offeractpaymenttocompanycopyfilepublicname = '';
                $offeractpaymenttocompanycopyfileid = '';
            } else {
                foreach ($actpaymenttocompanycopy as $in) {
                    $offeractpaymenttocompanycopyfilepublicname = $in->file_public_name;
                    $offeractpaymenttocompanycopyfileid = $in->id;
                }
            }
        }
        $offertaxid = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->whereIn('id', $casemiddledata)->where('type_id', 8)->orderBy('id', 'DESC')->take(1)->value('id');
        $offertax = Offer::with(['promotion','campaign','OfferType','match_id','Person','Proposal','branch'])->find($offertaxid);
        if ($offertax == null || $offertax == '') {
            $offertaxcompany = '';
            $offertaxpartner = '';
            $offertaxfilepublicname = '';
            $offertaxfileid = '';
            $offertaxpaymentpremium = 0;
            $offertaxpaymentdiscount15 = 0;
            $offertaxpaymentdiscount16 = 0;
            $offertaxpaymentdiscount18 = 0;
            $offertaxpaymentdiscount20 = 0;
            $offertaxpaymenttaxdeduction = 0;
            $offertaxpaymentuserservicefee = 0;
            $offertaxpaymentgrosscom = 0;
            $offertaxpaymentpartnerconsultfee = 0;
            $offertaxcopypaymentfilepublicname = '';
            $offertaxcopypaymentfileid = '';
            $offertaxpaymenttocompanycopyfilepublicname = '';
            $offertaxpaymenttocompanycopyfileid = '';
        } else {
            $offertaxcompany = $offertax->Person->name;
            $offertaxpartner = $offertax->Proposal->Partner_block->name;
            $offertaxpaymentpremium   = $offertax->offer_payment_value4;
            $offertaxpaymentdiscount15 = $offertax->offer_payment_value15;
            $offertaxpaymentdiscount16 = $offertax->offer_payment_value16;
            $offertaxpaymentdiscount18 = $offertax->offer_payment_value18;
            $offertaxpaymentdiscount20 = $offertax->offer_payment_value20;
            $offertaxpaymenttaxdeduction = $offertax->offer_payment_value5;
            $offertaxpaymentpartnerconsultfee = $offertax->offer_payment_value17;
            $offertaxpaymentuserservicefee = $offertax->offer_payment_value19;
            $offertaxpaymentgrosscom = $offertax->offer_payment_value8;

            if (count($taxcopy) < 1) {
                $offertaxfilepublicname = '';
                $offertaxfileid = '';
            } else {
                foreach ($taxcopy as $in) {
                    $offertaxfilepublicname = $in->file_public_name;
                    $offertaxfileid = $in->id;
                }
            }
            if (count($taxcopypayment) < 1) {
                $offertaxcopypaymentfilepublicname = '';
                $offertaxcopypaymentfileid = '';
            } else {
                foreach ($taxcopypayment as $in) {
                    $offertaxcopypaymentfilepublicname = $in->file_public_name;
                    $offertaxcopypaymentfileid = $in->id;
                }
            }
            if (count($taxpaymenttocompanycopy) < 1) {
                $offertaxpaymenttocompanycopyfilepublicname = '';
                $offertaxpaymenttocompanycopyfileid = '';
            } else {
                foreach ($taxpaymenttocompanycopy as $in) {
                    $offertaxpaymenttocompanycopyfilepublicname = $in->file_public_name;
                    $offertaxpaymenttocompanycopyfileid = $in->id;
                }
            }
        }
        //////////// Calculation For Case Payment ////////////
        if ($offerinsurancepaymentdiscount15 == 'NaN') {
            $offerinsurancepaymentdiscount15 = 0;
        }
        if ($offeractpaymentdiscount16 == 'NaN') {
            $offeractpaymentdiscount16 = 0;
        }
        if ($offertaxpaymentdiscount20 == 'NaN') {
            $offertaxpaymentdiscount20 = 0;
        }
        $alldiscountinsurance = $offerinsurancepaymentdiscount15+$offerinsurancepaymentdiscount15+$offerinsurancepaymentdiscount18+$offerinsurancepaymentdiscount20;
        $alldiscountinsurance = round($alldiscountinsurance, 2);
        if ($offerinsurancepaymentpremium == 'NaN') {
            $offerinsurancepaymentpremium = 0;
        }
        if ($alldiscountinsurance == 'NaN') {
            $alldiscountinsurance = 0;
        }
        $calculatebeforetaxdeductinsurance =$offerinsurancepaymentpremium-$alldiscountinsurance;
        $calculatebeforetaxdeductinsurance =  round($calculatebeforetaxdeductinsurance, 2);
        $calculateaftertaxdeductinsurance =$calculatebeforetaxdeductinsurance-$offerinsurancepaymenttaxdeduction;
        $calculateaftertaxdeductinsurance =  round($calculateaftertaxdeductinsurance, 2);
        if ($calculateaftertaxdeductinsurance == 'NaN' || $calculateaftertaxdeductinsurance == null || $calculateaftertaxdeductinsurance == '') {
            $calculateaftertaxdeductinsurance = 0;
        }
        if ($offerinsurancepaymentpartnerconsultfee == 'NaN' || $offerinsurancepaymentpartnerconsultfee == null || $offerinsurancepaymentpartnerconsultfee == '') {
            $offerinsurancepaymentpartnerconsultfee = 0;
        }
        $totalpaidpartnerinsurance =$calculateaftertaxdeductinsurance-$offerinsurancepaymentpartnerconsultfee;
        $totalpaidpartnerinsurance =  round($totalpaidpartnerinsurance, 2);
        if ($calculateaftertaxdeductinsurance == 'NaN' || $calculateaftertaxdeductinsurance == null || $calculateaftertaxdeductinsurance == '') {
            $calculateaftertaxdeductinsurance = 0;
        }
        if ($totalpaidpartnerinsurance == 'NaN' || $totalpaidpartnerinsurance == null || $totalpaidpartnerinsurance == '') {
            $offerinsurancepaymentuserservicefee = 0;
        }
        $totalpaiduserinsurance =$totalpaidpartnerinsurance-$offerinsurancepaymentuserservicefee;
        $totalpaiduserinsurance =  round($totalpaiduserinsurance, 2);
        if ($offerinsurancepaymentpremium == 'NaN' || $offerinsurancepaymentpremium == null || $offerinsurancepaymentpremium == '') {
            $offerinsurancepaymentpremium = 0;
        }
        if ($offerinsurancepaymentgrosscom == 'กรุณาเลือกหมวดการคำนวณ' || $offerinsurancepaymentgrosscom == null || $offerinsurancepaymentgrosscom == '') {
            $offerinsurancepaymentgrosscom = 0;
        }
        if ($offerinsurancepaymenttaxdeduction == 'NaN' || $offerinsurancepaymenttaxdeduction == null || $offerinsurancepaymenttaxdeduction == '') {
            $offerinsurancepaymenttaxdeduction = 0;
        }
        $totalpaidcompanyinsurance =  $offerinsurancepaymentpremium-$offerinsurancepaymentgrosscom-$offerinsurancepaymenttaxdeduction;
        $totalpaidcompanyinsurance =round($totalpaidcompanyinsurance, 2);

        $alldiscountact = $offeractpaymentdiscount15+$offeractpaymentdiscount16+$offeractpaymentdiscount18+$offeractpaymentdiscount20;
        $alldiscountact = round($alldiscountact, 2);
        $calculatebeforetaxdeductact =$offeractpaymentpremium-$alldiscountact;
        $calculatebeforetaxdeductact =  round($calculatebeforetaxdeductact, 2);
        $calculateaftertaxdeductact =$calculatebeforetaxdeductact-$offeractpaymenttaxdeduction;
        $calculateaftertaxdeductact =  round($calculateaftertaxdeductact, 2);
        $totalpaidpartneract =$calculateaftertaxdeductact-$offeractpaymentpartnerconsultfee;
        $totalpaidpartneract =  round($totalpaidpartneract, 2);
        $totalpaiduseract =$totalpaidpartneract-$offeractpaymentuserservicefee;
        $totalpaiduseract =  round($totalpaiduseract, 2);
        $totalpaidcompanyact =  $offeractpaymentpremium-$offeractpaymentgrosscom-$offeractpaymenttaxdeduction;
        $totalpaidcompanyact =round($totalpaidcompanyact, 2);

        $alldiscounttax = $offertaxpaymentdiscount15+$offertaxpaymentdiscount16+$offertaxpaymentdiscount18+$offertaxpaymentdiscount20;
        $alldiscounttax = round($alldiscounttax, 2);
        $calculatebeforetaxdeducttax =$offertaxpaymentpremium-$alldiscounttax;
        $calculatebeforetaxdeducttax =  round($calculatebeforetaxdeducttax, 2);
        $calculateaftertaxdeducttax =$calculatebeforetaxdeducttax-$offertaxpaymenttaxdeduction;
        $calculateaftertaxdeducttax =  round($calculateaftertaxdeducttax, 2);
        $totalpaidpartnertax =$calculateaftertaxdeducttax-$offertaxpaymentpartnerconsultfee;
        $totalpaidpartnertax =  round($totalpaidpartnertax, 2);
        $totalpaidusertax =$totalpaidpartnertax-$offertaxpaymentuserservicefee;
        $totalpaidusertax =  round($totalpaidusertax, 2);
        $totalpaidcompanytax =  $offertaxpaymentpremium-$offertaxpaymentgrosscom-$offertaxpaymenttaxdeduction;
        $totalpaidcompanytax =round($totalpaidcompanytax, 2);

        $allpremium =  $offerinsurancepaymentpremium+$offeractpaymentpremium+$offertaxpaymentpremium;
        $allpremium = round($allpremium, 2);
        $alltaxdeduct = $offerinsurancepaymenttaxdeduction+$offeractpaymenttaxdeduction+$offertaxpaymenttaxdeduction;
        $alltaxdeduct = round($alltaxdeduct, 2);
        $alldiscount =$alldiscountinsurance+$alldiscountact+$alldiscounttax;
        $alldiscount = round($alldiscount, 2);
        $allcalculatebeforetaxdeduct = $calculatebeforetaxdeductinsurance+$calculatebeforetaxdeductact+$calculatebeforetaxdeducttax;
        $allcalculatebeforetaxdeduct = round($allcalculatebeforetaxdeduct, 2);
        $allcalculateaftertaxdeduct = $calculateaftertaxdeductinsurance+$calculateaftertaxdeductact+$calculateaftertaxdeducttax;
        $allcalculateaftertaxdeduct = round($allcalculateaftertaxdeduct, 2);
        $alltotalpaidpartner = $totalpaidpartnerinsurance+$totalpaidpartneract+$totalpaidpartnertax;
        $alltotalpaidpartner = round($alltotalpaidpartner, 2);
        $alltotalpaiduser = $totalpaiduserinsurance+$totalpaiduseract+$totalpaidusertax;
        $alltotalpaiduser = round($alltotalpaiduser, 2);
        $alltotalpaidcompany = $totalpaidcompanyinsurance+$totalpaidcompanyact+$totalpaidcompanytax;
        $alltotalpaidcompany = round($alltotalpaidcompany, 2);
        //  return $totalpaidcompanyinsurance;
        //////////// Calculation For Case Payment ////////////
        $url = $_SERVER['REQUEST_URI'];
        $caseport = $cases->var_value128;
        return view(
              'system-mgmt/insurance/showdetailuser',
              compact(
            [
              'casevarvalue54','casevarvalue55','casevarvalue56','casevarvalue57','casevarvalue58','casevarvalue59','casevarvalue60','casevarvalue61','casevarvalue62','casevarvalue63','casevarvalue64','casevarvalue65','casevarvalue66','casevarvalue67','casevarvalue68','casevarvalue69',
              'casevarname54','casevarname55','casevarname56','casevarname57','casevarname58','casevarname59','casevarname60','casevarname61','casevarname62','casevarname63','casevarname64','casevarname65','casevarname66','casevarname67','casevarname68','casevarname69',
              'offertypefromoffercat',
              'casevarvalue47','casevarvalue48','casevarvalue49','casevarvalue50',
              'casevarname47','casevarname48','casevarname49','casevarname50',
              'caseassetrefinfohead8','caseassetrefinfohead1','caseassetrefinfohead7','caseassetrefinfohead9','caseassetrefinfohead10','caseassetrefnamehead','caseassetrefinfohead3','caseassetrefinfohead4','caseassetrefinfohead5','caseassetrefinfohead2','caseassetrefinfohead6',
              'caseassetrefinfohead11','caseassetrefinfohead12','caseassetrefinfohead13','caseassetrefinfohead14','caseassetrefinfohead15','caseassetrefinfohead16','caseassetrefinfohead17','caseassetrefinfohead18',
              'caseheaderrecheckofferflag','casecustomeradvisor','caseport',
              'companycopy','commercialcert','departmentcopy',
              'allpremium','alltaxdeduct','alldiscount','allcalculatebeforetaxdeduct','allcalculateaftertaxdeduct','alltotalpaidpartner','alltotalpaiduser','alltotalpaidcompany',
              'offertaxcopypaymentfilepublicname','offertaxcopypaymentfileid','offertaxpaymenttocompanycopyfilepublicname','offertaxpaymenttocompanycopyfileid',
              'offertaxpaymentpremium','offertaxpaymenttaxdeduction','alldiscounttax','calculatebeforetaxdeducttax','calculateaftertaxdeducttax',
              'totalpaidpartnertax','totalpaidusertax','totalpaidcompanytax',
              'offeractcopypaymentfilepublicname','offeractcopypaymentfileid','offeractpaymenttocompanycopyfilepublicname','offeractpaymenttocompanycopyfileid',
              'offeractpaymentpremium','offeractpaymenttaxdeduction','alldiscountact','calculatebeforetaxdeductact','calculateaftertaxdeductact',
              'totalpaidpartneract','totalpaiduseract','totalpaidcompanyact',
              'offerinsurancecopypaymentfilepublicname','offerinsurancecopypaymentfileid','offerinsurancepaymenttocompanycopyfilepublicname','offerinsurancepaymenttocompanycopyfileid',
              'offerinsurancepaymentpremium','offerinsurancepaymenttaxdeduction','alldiscountinsurance','calculatebeforetaxdeductinsurance','calculateaftertaxdeductinsurance',
              'totalpaidpartnerinsurance','totalpaiduserinsurance','totalpaidcompanyinsurance',
              'casevarname5','casevarname28','casevarname29','casevarname51','casevarname52','casevarname53','casevarname26','casevarname27','casevarname30','casevarname31',
              'casevarname32','casevarname33','casevarname34','casevarname35','casevarname36','casevarname37',
              'casevarvalue28','casevarvalue29','casevarvalue51','casevarvalue52','casevarvalue53','casevarvalue26','casevarvalue27','casevarvalue30','casevarvalue31',
              'casevarvalue32','casevarvalue33','casevarvalue34','casevarvalue35','casevarvalue36','casevarvalue37',
              'offerinsurancecompany','offerinsurancepartner','offerinsurancefilepublicname','offerinsurancefileid',
              'offeractcompany','offeractpartner','offeractfilepublicname','offeractfileid',
              'offertaxcompany','offertaxpartner','offertaxfilepublicname','offertaxfileid',
              'casevarname38','casevarname39','casevarname40',
              'casevarname41','casevarname42','casevarname43',
              'casevarname44','casevarname45','casevarname46',
              'casevarvalue38','casevarvalue39','casevarvalue40',
              'casevarvalue41','casevarvalue42','casevarvalue43',
              'casevarvalue44','casevarvalue45','casevarvalue46',
              'offerinsurance','offeract','offertax',
              'caselog','caseaction',
              'memberid','portid','assetid',
              'oldinsurances','oldact','oldtax','guaranteereceipt','discountcoupon','insuranceapplication','moneystandin','copyrenewnotice',
              'copyact','insurancecopy','taxcopy','insurancecopypayment','insurancepaymenttocompanycopy','actpaymenttocompanycopy','taxpaymenttocompanycopy',
              'actcopypayment','taxcopypayment',
              'anotherfile',
              'carfile','carphoto','carcamera',
              'citizenfile','driverfile','employeefile','salaryslipfile',
              'lastestoffer','interestoffer','confirmoffer',
              'caseassetid','caseassetrefinfo8','caseassetrefinfo1','caseassetrefinfo7','caseassetrefinfo9','caseassetrefinfo10','caseassetrefname','caseassetrefinfo3','caseassetrefinfo4','caseassetrefinfo5','caseassetrefinfo2','caseassetrefinfo6','caseassetrefinfo11','caseassetrefinfo12','caseassetrefinfo13','caseassetrefinfo14','caseassetrefinfo15','caseassetrefinfo16','caseassetrefinfo17','caseassetrefinfo18',
              'casecontactrequirename16','casecontactrequirename17','casecontactrequirename18','casecontactrequirename19','casecontactrequirename20','casecontactrequirevalue16','casecontactrequirevalue17','casecontactrequirevalue18','casecontactrequirevalue19','casecontactrequirevalue20',
              'casecustomername','casecustomerlastname','casecustomermobile','casecustomeremail','casecustomerfax','casecustomeraddress',
              'casedetailnotirequirename7','casedetailnotirequirename8','casedetailnotirequirename9','casedetailnotirequirename10','casedetailnotirequirename11','casedetailnotirequirename12','casedetailnotirequirename13','casedetailnotirequirename14','casedetailnotirequirename15','casedetailnotirequirename2','casedetailnotirequirename1','casedetailnotirequirename3','casedetailnotirequirename4','casedetailnotirequirename5','casedetailnotirequirename6','casedetailnotirequirevalue2',
              'casedetailnotirequirevalue4','casedetailnotirequirevalue7','casedetailnotirequirevalue8','casedetailnotirequirevalue9','casedetailnotirequirevalue10','casedetailnotirequirevalue11','casedetailnotirequirevalue12','casedetailnotirequirevalue13',
              'casedetailnotirequirevalue14','casedetailnotirequirevalue15',
              'casedetailnotirequirevalue1','casedetailnotirequirevalue3','casedetailnotirequirevalue5','casedetailnotirequirevalue6',
              'casetrackingvarname25','casetrackingvarname24','casetrackingvarname23','casetrackingvarname22','casetrackingvarname21','casetrackingvarname20','casetrackingvarname19','casetrackingvarname18','casetrackingvarname17','casetrackingvarname16','casetrackingvarname15','casetrackingvarname14','casetrackingvarname13','casetrackingvarname12','casetrackingvarname11','casetrackingvarname10','casetrackingvarname9','casetrackingvarname8','casetrackingvarname7','casetrackingvarname6',
              'casetrackingvarname5','casetrackingvarname4','casetrackingvarname3','casetrackingvarname2',
              'casetrackingvarname51','casetrackingvarname53','casetrackingvarname52','casetrackingrequirevalue9','casetrackingrequirevalue7','casetrackingrequirevalue8','casetrackingvarvalue1','casetrackinglastupdatedate','casetrackingvarname1','casetrackingvarname1','casetrackingautorenewdate','casetrackingfinisheddate','casetrackingstage','casetrackingcasestatus','casedetailrefasset','casedetailcasechannel','casedetailconsultpartner','casedetailcoordinate','casedetailserviceuser',
              'casedetailmatchid','casetrackingvarvalue25','casetrackingvarvalue24','casetrackingvarvalue23','casetrackingvarvalue22','casetrackingvarvalue21','casetrackingvarvalue20','casetrackingvarvalue19','casetrackingvarvalue18','casetrackingvarvalue17','casetrackingvarvalue16','casetrackingvarvalue15','casetrackingvarvalue14','casetrackingvarvalue13','casetrackingvarvalue12','casetrackingvarvalue11','casetrackingvarvalue10','casetrackingvarvalue9','casetrackingvarvalue8',
              'casetrackingvarvalue7','casetrackingvarvalue6','casetrackingvarvalue5','casetrackingvarvalue4','casetrackingvarvalue3','casetrackingvarvalue2',
              'casetrackingvarvalue51','casetrackingvarvalue53','casetrackingvarvalue52',
              'caseclassifyoldcaseid','caseclassifyrenewcaseid','caseclassifyrenewcase','caseclassifytype','caseclassifycat','caseclassifyname','caseclassifysubtype','caseclassifyoldcase',
              'caseheaderrenewcaseid','caseheadervar130','caseheadername','caseheadernotefromprevious','caseheadernotecopytorenew','caseheadernotefrommember','caseheadernotefrompartner','caseheadernotefromuser','caseheadercanceldate',
              'id','name','cases','url'
            ]
            )
          );
        }
        else
        {
          return view('error');
        }
    }
    public function index()
    {
        $as = ActionCategory::all();

        return view('system-mgmt/insurance/index', compact(['as']));
    }
    public function indexuser()
    {
        $as = ActionCategory::all();

        return view('system-mgmt/insurance/indexuser', compact(['as']));
    }
    public function loaduser()
    {
        $user = Block::all();
        return $user;
    }
    public function loadcoordinate()
    {
        $userauths = DB::table('user_auths')
      ->leftJoin('users', 'user_auths.user_id', '=', 'users.id')
     ->leftJoin('structure', 'user_auths.structure_id', '=', 'structure.id')
     ->leftJoin('block', 'user_auths.block_id', '=', 'block.id')

     ->select('user_auths.id', 'user_auths.description', 'structure.name as structure_name', 'structure.id as structure_id', 'block.name as block_name', 'block.id as block_id', 'users.firstname as user_name', 'users.lastname as user_lastname', 'users.id as user_id')

     ->get();


        return $userauths;
    }

    public function loadpartner()
    {
        $partner = Partner_block::all();

        return $partner;
    }
    public function loadcasechannel()
    {
        $casechannel = CaseChannel::all();

        return $casechannel;
    }
    public function loadmember()
    {
        $member = Person::all();

        return $member;
    }
    public function loadmembertype()
    {
        $membertype = Member_type::all();
        return $membertype;
    }
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
        if (strstr($url, '?fromreportliquid')) {
            $year = date('Y')+545;
        }
        for ($i = $year;$i>=1900;$i--) {
            $day[] = $i;
        }
        return $day;
    }
    public function loadcountry()
    {
        return Country::all();
    }
    public function loaddistrict()
    {
        return District::all();
    }
    public function loadsubdistrict()
    {
        return Subdistrict::all();
    }
    public function loadcity()
    {
        return Province::all();
    }
    public function loadcasefile(Request $res)
    {
        $casefile = Case_Attacht::where('case_id', $res->caseid)->pluck('file_id')->toArray();
        $file = File::whereIn('id', $casefile)->get();
        return $file;
    }
    public function loadassetfile(Request $res)
    {
        $casefile = Asset_Attacht::where('asset_id', $res->assetid)->pluck('file_id')->toArray();
        $file = File::whereIn('id', $casefile)->get();
        return $file;
    }
    public function addmember(Request $res)
    {
        $memberid = $res->memberid;
        $member = DB::table('persons')
        ->where('persons.id', $memberid)
        ->leftJoin('event', 'persons.event_id', '=', 'event.id')
  //->leftJoin('match_id as re ', 'persons.ref_member_pid', '=', 're.id')
       ->leftJoin('match_id as u', 'persons.ref_user_pid', '=', 'u.id')
        ->leftJoin('match_id as i', 'persons.ref_member_pid', '=', 'i.id')
        ->leftJoin('provinces as p1', 'persons.add1_city', '=', 'p1.id')
        ->leftJoin('provinces as p2', 'persons.add2_city', '=', 'p2.id')
        ->leftJoin('districts as d1', 'persons.add1_district', '=', 'd1.id')
        ->leftJoin('districts as d2', 'persons.add2_district', '=', 'd2.id')
        ->leftJoin('subdistricts as s1', 'persons.add1_subdistrict', '=', 's1.id')
        ->leftJoin('subdistricts as s2', 'persons.add2_subdistrict', '=', 's2.id')
        ->leftJoin('country as c1', 'persons.add1_country', '=', 'c1.id')
        ->leftJoin('country as c2', 'persons.add2_country', '=', 'c2.id')
       ->select('persons.*', 'u.public_name as user_name', 'u.id as user_id', 'i.public_name as mem_name', 'i.id as mem_id', 'event.event_name as event_name', 'event.id as event_id', 'c1.name as add1_country', 'c2.name as add2_country', 'p1.name_in_thai as add1_city', 'p2.name_in_thai as add2_city2', 'd1.name_in_thai as add1_district', 'd2.name_in_thai as add2_district', 's1.name_in_thai as add1_subdistrict', 's2.name_in_thai as add2_subdistrict')
         ->get();
        return $member;
    }
    public function addmemberfile(Request $res)
    {
        $memberid = $res->memberid;
        $findfile = DB::table('member_attachment')->where('member_id', $memberid)->pluck('file_id');
        $memberfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->get();
        return $memberfile;
    }
    public function getmemberfile()
    {
        $memberid = $res->memberid;
        $findfile = DB::table('member_attachment')->where('member_id', $memberid)->pluck('file_id');
        $memberfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->get();
        return $memberfile;
    }

    public function addmembercar(Request $res)
    {
        $memberid = $res->memberid;
        $portfolio = DB::table('portfolio')->where('port_id', 30)->where('member_id', $memberid)->pluck('id')->toArray();
        $asset = DB::table('asset')->whereIn('port_id', $portfolio)->get();
        return $asset;
    }

    public function choosememberasset(Request $res)
    {
        $url = $_SERVER['REQUEST_URI'];
        $assetid = 0;
        if (strstr($url, '?fileterassetid')) {
            $assetid = explode('?fileterassetid', $url);
            $assetid = $assetid[1];
        }
        $asset = DB::table('asset')
        ->where('asset.id', $assetid)
        ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
        ->leftJoin('portfolio', 'asset.port_id', '=', 'portfolio.id')
       ->select('asset.*', 'portfolio.id as port_id', 'portfolio.type as port_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id', 'asset_type.la_nla as la_nla', 'asset_type.ref_info_head1 as ref_head1', 'asset_type.ref_info_head2 as ref_head2', 'asset_type.ref_info_head3 as ref_head3', 'asset_type.ref_info_head4 as ref_head4', 'asset_type.ref_info_head5 as ref_head5', 'asset_type.ref_info_head6 as ref_head6', 'asset_type.ref_info_head7 as ref_head7', 'asset_type.ref_info_head8 as ref_head8')
       ->get();
        return $asset;
    }
    public function choosememberassetfile()
    {
        $url = $_SERVER['REQUEST_URI'];
        $assetid = 0;
        if (strstr($url, '?fileterassetid')) {
            $assetid = explode('?fileterassetid', $url);
            $assetid = $assetid[1];
        }
        $findfile = DB::table('asset_attachment')->where('asset_id', $assetid)->pluck('file_id');
        $assetfile = File::with(['filecat'])->whereIn('id', $findfile)->where('status', '=', 'Active')->get();
        return $assetfile;
    }
    public function loadallassettype()
    {
      return Asset_type::where('asset_cat',3)->get();

    }
    public function loadassettype()
    {
        $url = $_SERVER['REQUEST_URI'];
        if(strstr($url,'?filtertype'))
        {
          $typeid = explode('?filtertype',$url);
          $typeid = $typeid[1];
          return Asset_type::where('id', $typeid)->get();
        }
        else
        {
          return Asset_type::where('id', 5)->get();
        }
    }

    public function loadissuer()
    {
        $group = match_member_id::where('member_group_id', 9)->pluck('member_id')->toArray();
        $member = Person::whereIn('id', $group)->get();
        return $member;
    }
    public function loadassurance()
    {
        $group = match_member_id::where('member_group_id', 7)->pluck('member_id')->toArray();
        $member = Person::whereIn('id', $group)->get();
        return $member;
    }
    public function storemember(Request $res)
    {
        $nationality = $res->nationality;
        $more = $res->more;
        $couple_email = $res->couple_email;
        $belongtopidmember = $res->belongtopidmember;
        $name = $res->name;
        $lname = $res->lname;
        $nickname = $res->nickname;
        $email = $res->email;
        $mobile = $res->mobile;
        $membertypeid = $res->membertypeid;
        $gender = $res->gender;
        $dayex = $res->dayex;
        $monthex = $res->monthex;
        $yearex = $res->yearex;
        $daybi = $res->daybi;
        $monthbi = $res->monthbi;
        $yearbi = $res->yearbi;
        $citizenid = $res->citizenid;
        $add1 = $res->add1;
        $add1alley = $res->add1alley;
        $add1road = $res->add1road;
        $add1subdistrict = $res->add1subdistrict;
        $add1district = $res->add1district;
        $add1city = $res->add1city;
        $add1country = $res->add1country;
        $add1postcode = $res->add1postcode;
        $add1tel = $res->add1tel;
        $add1fax = $res->add1fax;
        $noadressflag = $res->noadressflag;
        if ($noadressflag == 1) {
            $add2 = $add1;
            $add2alley = $add1alley;
            $add2road = $add1road;
            $add2subdistrict = $add1subdistrict;
            $add2district = $add1district;
            $add2city = $add1city;
            $add2country = $add1country;
            $add2postcode = $add1postcode;
            $add2tel = $add1tel;
            $add2fax = $add1fax;
        } else {
            $add2 = $res->add2;
            $add2alley = $res->add2alley;
            $add2road = $res->add2road;
            $add2subdistrict = $res->add2subdistrict;
            $add2district = $res->add2district;
            $add2city = $res->add2city;
            $add2country = $res->add2country;
            $add2postcode = $res->add2postcode;
            $add2tel = $res->add2tel;
            $add2fax = $res->add2fax;
        }
        $addmember = new Person;
        $addmember->name = $name;
        $addmember->lname = $lname;
        $addmember->nickname = $nickname;
        $addmember->email = $email;
        $addmember->mobile = $mobile;
        $addmember->type = $membertypeid;
        $addmember->gender = $gender;
        $addmember->citizen_expire_date = $dayex.'-'.$monthex.'-'.$yearex;
        $addmember->dob = $daybi.'-'.$monthbi.'-'.$yearbi;
        $addmember->id_num = $citizenid;
        $addmember->password = Hash::make($citizenid);
        $addmember->add1 = $add1;
        $addmember->add1_alley = $add1alley;
        $addmember->add1_road = $add1road;
        $addmember->add1_subdistrict = $add1subdistrict;
        $addmember->add1_district = $add1district;
        $addmember->add1_city = $add1city;
        $addmember->add1_country = $add1country;
        $addmember->add1_postcode = $add1postcode;
        $addmember->add1_tel = $add1tel;
        $addmember->add1_fax = $add1fax;
        $addmember->add2 = $add2;
        $addmember->add2_alley = $add2alley;
        $addmember->add2_road = $add2road;
        $addmember->add2_subdistrict = $add2subdistrict;
        $addmember->add2_district = $add2district;
        $addmember->add2_city = $add2city;
        $addmember->add2_country = $add2country;
        $addmember->add2_postcode = $add2postcode;
        $addmember->add2_tel = $add2tel;
        $addmember->add2_fax = $add2fax;
        $addmember->save();
        $addmatchid = new match_id;
        $addmatchid->public_name = $addmember->name .' '.$addmember->lname;
        $addmatchid->public_email = $addmember->email;
        $addmatchid->public_mobile = $addmember->mobile;
        $addmatchid->sender_citizen = $addmember->id_num;
        $addmatchid->member_id = $addmember->id;
        $addmatchid->save();
        $member = Person::where('id', $addmember->id)->get();

        return $member;
    }
    public function storeadvisor(Request $res)
    {
        $nationality = $res->nationality;
        $more = $res->more;
        $couple_email = $res->couple_email;
        $belongtopidmember = $res->belongtopidmember;
        $name = $res->name;
        $lname = $res->lname;
        $nickname = $res->nickname;
        $email = $res->email;
        $mobile = $res->mobile;
        $membertypeid = $res->membertypeid;
        $gender = $res->gender;
        $dayex = $res->dayex;
        $monthex = $res->monthex;
        $yearex = $res->yearex;
        $daybi = $res->daybi;
        $monthbi = $res->monthbi;
        $yearbi = $res->yearbi;
        $citizenid = $res->citizenid;
        $add1 = $res->add1;
        $add1alley = $res->add1alley;
        $add1road = $res->add1road;
        $add1subdistrict = $res->add1subdistrict;
        $add1district = $res->add1district;
        $add1city = $res->add1city;
        $add1country = $res->add1country;
        $add1postcode = $res->add1postcode;
        $add1tel = $res->add1tel;
        $add1fax = $res->add1fax;
        $noadressflag = $res->noadressflag;
        if ($noadressflag == 1) {
            $add2 = $add1;
            $add2alley = $add1alley;
            $add2road = $add1road;
            $add2subdistrict = $add1subdistrict;
            $add2district = $add1district;
            $add2city = $add1city;
            $add2country = $add1country;
            $add2postcode = $add1postcode;
            $add2tel = $add1tel;
            $add2fax = $add1fax;
        } else {
            $add2 = $res->add2;
            $add2alley = $res->add2alley;
            $add2road = $res->add2road;
            $add2subdistrict = $res->add2subdistrict;
            $add2district = $res->add2district;
            $add2city = $res->add2city;
            $add2country = $res->add2country;
            $add2postcode = $res->add2postcode;
            $add2tel = $res->add2tel;
            $add2fax = $res->add2fax;
        }
        $addmember = new Person;
        $addmember->name = $name;
        $addmember->lname = $lname;
        $addmember->nickname = $nickname;
        $addmember->email = $email;
        $addmember->mobile = $mobile;
        $addmember->type = $membertypeid;
        $addmember->gender = $gender;
        $addmember->citizen_expire_date = $dayex.'-'.$monthex.'-'.$yearex;
        $addmember->dob = $daybi.'-'.$monthbi.'-'.$yearbi;
        $addmember->id_num = $citizenid;
        $addmember->password = Hash::make($citizenid);
        $addmember->add1 = $add1;
        $addmember->add1_alley = $add1alley;
        $addmember->add1_road = $add1road;
        $addmember->add1_subdistrict = $add1subdistrict;
        $addmember->add1_district = $add1district;
        $addmember->add1_city = $add1city;
        $addmember->add1_country = $add1country;
        $addmember->add1_postcode = $add1postcode;
        $addmember->add1_tel = $add1tel;
        $addmember->add1_fax = $add1fax;
        $addmember->add2 = $add2;
        $addmember->add2_alley = $add2alley;
        $addmember->add2_road = $add2road;
        $addmember->add2_subdistrict = $add2subdistrict;
        $addmember->add2_district = $add2district;
        $addmember->add2_city = $add2city;
        $addmember->add2_country = $add2country;
        $addmember->add2_postcode = $add2postcode;
        $addmember->add2_tel = $add2tel;
        $addmember->add2_fax = $add2fax;
        $addmember->save();
        $addmatchid = new match_id;
        $addmatchid->public_name = $addmember->name .' '.$addmember->lname;
        $addmatchid->public_email = $addmember->email;
        $addmatchid->public_mobile = $addmember->mobile;
        $addmatchid->sender_citizen = $addmember->id_num;
        $addmatchid->member_id = $addmember->id;
        $addmatchid->save();
        $advisor = match_id::whereNotNUll('member_id')->get();
        return $advisor;
    }
    public function storeasset(Request $res)
    {
        $memberid = $res->memberid;
        $userid = $res->userid;
        $issuerid = $res->issuerid;
        $assetname = $res->assetname;
        $refname = $res->refname;
        $ref_number1 = $res->ref_number1;
        $ref_number2 = $res->ref_number2;
        $ref_number3 = $res->ref_number3;
        $ref_info1 = $res->ref_info1;
        $ref_info2 = $res->ref_info2;
        $ref_info3 = $res->ref_info3;
        $ref_info4 = $res->ref_info4;
        $ref_info5 = $res->ref_info5;
        $ref_info6 = $res->ref_info6;
        $ref_info7 = $res->ref_info7;
        $ref_info8 = $res->ref_info8;
        $ref_info9 = $res->ref_info9;
        $ref_info10 = $res->ref_info10;
        $ref_info11 = $res->ref_info11;
        $ref_info12 = $res->ref_info12;
        $ref_info13 = $res->ref_info13;
        $ref_info14 = $res->ref_info14;
        $ref_info15 = $res->ref_info15;
        $ref_info16 = $res->ref_info16;
        $ref_info17 = $res->ref_info17;
        $ref_info18 = $res->ref_info18;
        $amount = $res->amount;
        $assetvalue = $res->assetvalue;
        $cost = $res->cost;
        $validfromday = $res->validfromday;
        $validfrommonth = $res->validfrommonth;
        $validfromyear = $res->validfromyear;
        $validtoday = $res->validtoday;
        $validtomonth = $res->validtomonth;
        $validtoyear = $res->validtoyear;
        $contact_pid = $res->contact_pid;
        $note = $res->note;

        $contact = Block::where('id', $userid)->value('default_pid');
        $port = new Portfolio;
        $port->type = "personal_port";
        $port->number = "000000";
        $port->structure_id = 15;
        $port->block_id = 80;
        $port->port_id = 30;
        $port->member_id = $memberid;
        $port->status = "Active";
        $port->save();

        $asset = new Asset;
        $asset->name = $assetname;
        $asset->name = $refname;
        $asset->la_nla_type = 5;
        $asset->port_id = $port->id;
        $asset->ref_number1 = $ref_number1;
        $asset->ref_number2 = $ref_number2;
        $asset->ref_number3 = $ref_number3;
        $asset->ref_info1 = $ref_info1;
        $asset->ref_info2 = $ref_info2;
        $asset->ref_info3 = $ref_info3;
        $asset->ref_info4 = $ref_info4;
        $asset->ref_info5 = $ref_info5;
        $asset->ref_info6 = $ref_info6;
        $asset->ref_info7 = $ref_info7;
        $asset->ref_info8 = $ref_info8;
        $asset->ref_info9 = $ref_info9;
        $asset->ref_info10 = $ref_info10;
        $asset->ref_info11 = $ref_info11;
        $asset->ref_info12 = $ref_info12;
        $asset->ref_info13 = $ref_info13;
        $asset->ref_info14 = $ref_info14;
        $asset->ref_info15 = $ref_info15;
        $asset->ref_info16 = $ref_info16;
        $asset->ref_info17 = $ref_info17;
        $asset->ref_info18 = $ref_info18;
        $asset->issued_by = $issuerid;
        $asset->amount = $amount;
        $asset->value = $assetvalue;
        $asset->cost = $cost;
        $asset->valid_from = $validfromday.'/'.$validfrommonth.'/'.$validfromyear;
        $asset->valid_to = $validtoday.'/'.$validtomonth.'/'.$validtoyear;
        $asset->contact_pid = $contact;
        $asset->note =$note;
        $asset->save();

        $memberasset = Asset::where('id', $asset->id)->get();

        return $memberasset;
    }
    public function updatecase(Request $res)
    {
        date_default_timezone_set('Asia/Bangkok');

        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $date = $day.'/'.$month.'/'.$year;
        $publicname = $res->publicname;
        $partnername2 = $res->partnername2;
        $username2 = $res->username2;
        $guildmembername = $res->guildmembername;
        $groupmembername = $res->groupmembername;
        $grouppidname = $res->grouppidname;
        $grouppartnername = $res->grouppartnername;
        $userid = $res->userid;
        $coordinate = $res->coordinate;
        $partnerid = $res->partnerid;
        $casechannelid = $res->casechannelid;
        $casecategoryid = $res->casecategoryid;
        $casetypeid = $res->casetypeid;
        $casesubtypeid = $res->casesubtypeid;
        $casechannelid = $res->casechannelid;
        $membercaseowner = $res->membercaseowner;
        $casename = $res->casename;
        $refname = $res->refname;
        $refasset = $res->refasset;
        $requirevalue1 = $res->requirevalue1;
        $requirevalue2 = $res->requirevalue2;
        $requirevalue3 = $res->requirevalue3;
        $requirevalue4 = $res->requirevalue4;
        $requirevalue5 = $res->requirevalue5;
        $requirevalue6 = $res->requirevalue6;
        $requirevalue7day = $res->requirevalue7day;
        $requirevalue7month = $res->requirevalue7month;
        $requirevalue7year = $res->requirevalue7year;
        $requirevalue8day = $res->requirevalue8day;
        $requirevalue8month = $res->requirevalue8month;
        $requirevalue8year = $res->requirevalue8year;
        $requirevalue9day = $res->requirevalue9day;
        $requirevalue9month = $res->requirevalue9month;
        $requirevalue9year = $res->requirevalue9year;
        $requirevalue10 = $res->requirevalue10;
        $requirevalue10 = implode("", $requirevalue10);
        $requirevalue11 = $res->requirevalue11;
        $requirevalue12 = $res->requirevalue12;
        $requirevalue13 = $res->requirevalue13;
        $requirevalue14 = $res->requirevalue14;
        $requirevalue15 = $res->requirevalue15;
        $requirevalue16 = $res->requirevalue16;
        $requirevalue17 = $res->requirevalue17;
        $requirevalue18 = $res->requirevalue18;
        $requirevalue19 = $res->requirevalue19;
        $requirevalue20 = $res->requirevalue20;
        $current = Auth::user()->id;
        $currentpid = match_id::where('user_id', $current)->value('id');
        $procedure  = CaseType::where('id', $casetypeid)->value('default_procedure_id');
        $processid = Procedures_To_Process::where('procedure_id', $procedure)->where('start_process_flag', 1)->value('process_id');
        $stage = Process::where('id', $processid)->value('start_stage');
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $id = $url[4];
        //  return $id;
        $case =  Cases::find($id);
        $case->name = $casename;
        $case->type_id = $casetypeid;
        $case->sub_type_id = $casesubtypeid;
        $case->created_by_pid = $currentpid;
        $case->procedure_id	 = $procedure;
        $case->stage =  $stage;
        $case->referal_asset = $refasset;
        //$case->ref_name = $refname;

        $case->case_channel = $casechannelid;
        $case->case_status = 1;
        $case->member_case_owner = $membercaseowner;
        $case->consult_partner_block_id = $partnerid;
        $case->service_user_block_id = $userid;
        $case->coordinate_user_block_id = $coordinate;
        $case->case_created_date = $date;
        //$case->auto_renew_date = '';
        //$case->next_notify_date = '';
        $case->require_value1 = $requirevalue1;
        $case->require_value2 = $requirevalue2;
        $case->require_value3 = $requirevalue3;
        $case->require_value4 = $requirevalue4;
        $case->require_value5 = $requirevalue5;
        $case->require_value6 = $requirevalue6;
        $case->require_value7 = $requirevalue7day.'/'.$requirevalue7month.'/'.$requirevalue7year;
        $case->require_value8 = $requirevalue8day.'/'.$requirevalue8month.'/'.$requirevalue8year;
        $case->require_value9 = $requirevalue9day.'/'.$requirevalue9month.'/'.$requirevalue9year;
        $case->require_value10 = $requirevalue10;
        $case->require_value11 = $requirevalue11;
        $case->require_value12 = $requirevalue12;
        $case->require_value13 = $requirevalue13;
        $case->require_value14 = $requirevalue14;
        $case->require_value15 = $requirevalue15;
        $case->require_value16 = $requirevalue16;
        $case->require_value17 = $requirevalue17;
        $case->require_value18 = $requirevalue18;
        $case->require_value19 = $requirevalue19;
        $case->require_value20 = $requirevalue20;
        $case->save();


        $caseauth = new CaseAuth;
        $caseauth->case_id = $case->id;
        $caseauth->block_partner = $partnerid;
        $caseauth->block_user = $userid;
        $caseauth->save();
        foreach ($publicname as $key =>$v) {
            $sliced = array_values($v);

            $input = [
               'case_id' => $case->id,
               'public_id' => $sliced[0],



             ];

            if ($sliced[0] !=0) {
                CaseAuth::insert($input);
            }
        }
        foreach ($partnername2 as $key2 =>$v2) {
            $sliced2 = array_values($v2);
            $input2 = [
                'case_id' => $case->id,
                'block_partner' => $sliced2[0],



              ];

            if ($sliced2[0] !=0) {
                CaseAuth::insert($input2);
            }
        }

        foreach ($username2 as $key3 =>$v3) {
            $sliced3 = array_values($v3);

            $input3 = [
                 'case_id' => $case->id,
                 'block_user' => $sliced3[0],



               ];

            if ($sliced3[0] !=0) {
                CaseAuth::insert($input3);
            }
        }

        foreach ($guildmembername as $key4 =>$v4) {
            $sliced4 = array_values($v4);

            $input4 = [
                  'case_id' => $case->id,
                  'guild_member' => $sliced4[0],



                ];

            if ($sliced4[0] !=0) {
                CaseAuth::insert($input4);
            }
        }

        foreach ($grouppartnername as $key5 =>$v5) {
            $sliced5 = array_values($v5);

            $input5 = [
                   'case_id' => $case->id,
                   'group_partner' => $sliced5[0],



                 ];

            if ($sliced5[0] !=0) {
                CaseAuth::insert($input5);
            }
        }

        foreach ($groupmembername as $key6 =>$v6) {
            $sliced6 = array_values($v6);

            $input6 = [
                    'case_id' => $case->id,
                    'group_member' => $sliced6[0],



                  ];

            if ($sliced6[0] !=0) {
                CaseAuth::insert($input6);
            }
        }

        foreach ($grouppidname as $key7 =>$v7) {
            $input7 = [
                   'case_id' => $case->id,
                   'group_pid' => $v7,



                 ];

            if ($v7 !=0) {
                CaseAuth::insert($input7);
            }
        }
        $casedetail = Cases::where('id', $case->id)->get();

        return $casedetail;
    }
    public function storecase(Request $res)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $date = $day.'/'.$month.'/'.$year;

        $publicname = $res->publicname;
        $partnername2 = $res->partnername2;
        $username2 = $res->username2;
        $guildmembername = $res->guildmembername;
        $groupmembername = $res->groupmembername;
        $grouppidname = $res->grouppidname;
        $grouppartnername = $res->grouppartnername;
        $userid = $res->userid;
        $coordinate = $res->coordinate;
        $partnerid = $res->partnerid;
        $casechannelid = $res->casechannelid;
        $casecategoryid = $res->casecategoryid;
        $casetypeid = $res->casetypeid;
        $casesubtypeid = $res->casesubtypeid;
        $casechannelid = $res->casechannelid;
        $membercaseowner = $res->membercaseowner;
        $casename = $res->casename;
        $refname = $res->refname;
        $refasset = $res->refasset;
        $requirevalue1 = $res->requirevalue1;
        $requirevalue2 = $res->requirevalue2;
        $requirevalue3 = $res->requirevalue3;
        $requirevalue4 = $res->requirevalue4;
        $requirevalue5 = $res->requirevalue5;
        $requirevalue6 = $res->requirevalue6;
        $requirevalue7day = $res->requirevalue7day;
        $requirevalue7month = $res->requirevalue7month;
        $requirevalue7year = $res->requirevalue7year;
        $requirevalue8day = $res->requirevalue8day;
        $requirevalue8month = $res->requirevalue8month;
        $requirevalue8year = $res->requirevalue8year;
        $requirevalue9day = $res->requirevalue9day;
        $requirevalue9month = $res->requirevalue9month;
        $requirevalue9year = $res->requirevalue9year;
        $requirevalue10 = $res->requirevalue10;
        $requirevalue10 = implode("", $requirevalue10);
        $requirevalue11 = $res->requirevalue11;
        $requirevalue12 = $res->requirevalue12;
        $requirevalue13 = $res->requirevalue13;
        $requirevalue14 = $res->requirevalue14;
        $requirevalue15 = $res->requirevalue15;
        $requirevalue16 = $res->requirevalue16;
        $requirevalue17 = $res->requirevalue17;
        $requirevalue18 = $res->requirevalue18;
        $requirevalue19 = $res->requirevalue19;
        $requirevalue20 = $res->requirevalue20;
        $requirevalue54 = $res->requirevalue54;
        $requirevalue55 = $res->requirevalue55;
        $requirevalue56 = $res->requirevalue56;
        $requirevalue57 = $res->requirevalue57;
        $requirevalue58 = $res->requirevalue58;
        $requirevalue59 = $res->requirevalue59;
        $requirevalue60 = $res->requirevalue60;
        $requirevalue61 = $res->requirevalue61;
        $requirevalue62 = $res->requirevalue62;
        $requirevalue63 = $res->requirevalue63;
        $requirevalue64 = $res->requirevalue64;
        $requirevalue65 = $res->requirevalue65;
        $requirevalue66 = $res->requirevalue66;
        $requirevalue67 = $res->requirevalue67;
        $requirevalue68 = $res->requirevalue68;
        $requirevalue69 = $res->requirevalue69;

        $current = Auth::user()->id;
        $currentpid = match_id::where('user_id', $current)->value('id');
        $procedure  = CaseType::where('id', $casetypeid)->value('default_procedure_id');
        $processid = Procedures_To_Process::where('procedure_id', $procedure)->where('start_process_flag', 1)->value('process_id');
        $stage = Process::where('id', $processid)->value('start_stage');
        $case = new Cases;
        $case->name = $casename;
        $case->type_id = $casetypeid;
        $case->sub_type_id = $casesubtypeid;
        $case->created_by_pid = $currentpid;
        $case->procedure_id	 = $procedure;
        $case->stage =  $stage;
        $case->referal_asset = $refasset;
        //$case->ref_name = $refname;

        $case->case_channel = $casechannelid;
        $case->case_status = 1;
        $case->member_case_owner = $membercaseowner;
        $case->consult_partner_block_id = $partnerid;
        $case->service_user_block_id = $userid;
        $case->coordinate_user_block_id = $coordinate;
        $case->case_created_date = $date;
        //$case->auto_renew_date = '';
        //$case->next_notify_date = '';
        $case->require_value1 = $requirevalue1;
        $case->require_value2 = $requirevalue2;
        $case->require_value3 = $requirevalue3;
        $case->require_value4 = $requirevalue4;
        $case->require_value5 = $requirevalue5;
        $case->require_value6 = $requirevalue6;
        $case->require_value7 = $requirevalue7day.'/'.$requirevalue7month.'/'.$requirevalue7year;
        $case->require_value8 = $requirevalue8day.'/'.$requirevalue8month.'/'.$requirevalue8year;
        $case->require_value9 = $requirevalue9day.'/'.$requirevalue9month.'/'.$requirevalue9year;
        $case->require_value10 = $requirevalue10;
        $case->require_value11 = $requirevalue11;
        $case->require_value12 = $requirevalue12;
        $case->require_value13 = $requirevalue13;
        $case->require_value14 = $requirevalue14;
        $case->require_value15 = $requirevalue15;
        $case->require_value16 = $requirevalue16;
        $case->require_value17 = $requirevalue17;
        $case->require_value18 = $requirevalue18;
        $case->require_value19 = $requirevalue19;
        $case->require_value20 = $requirevalue20;
        $case->var_value54 = $requirevalue54;
        $case->var_value55 = $requirevalue55;
        $case->var_value56 = $requirevalue56;
        $case->var_value57 = $requirevalue57;
        $case->var_value58 = $requirevalue58;
        $case->var_value59 = $requirevalue59;
        $case->var_value60 = $requirevalue60;
        $case->var_value61 = $requirevalue61;
        $case->var_value62 = $requirevalue62;
        $case->var_value63 = $requirevalue63;
        $case->var_value64 = $requirevalue64;
        $case->var_value65 = $requirevalue65;
        $case->var_value66 = $requirevalue66;
        $case->var_value67 = $requirevalue67;
        $case->var_value68 = $requirevalue68;
        $case->var_value69 = $requirevalue69;
        $case->var_value128 = $res->portid;

        $case->save();
        $input = [
            'ref_member_pid' => $res->memberadvisor,
        ];
        Person::where('id', $case->member_case_owner)
            ->update($input);
        $caseauth = new CaseAuth;
        $caseauth->case_id = $case->id;
        $caseauth->block_partner = $partnerid;
        $caseauth->block_user = $userid;
        $caseauth->save();
        foreach ($publicname as $key =>$v) {
            $sliced = array_values($v);

            $input = [
               'case_id' => $case->id,
               'public_id' => $sliced[0],



             ];

            if ($sliced[0] !=0) {
                CaseAuth::insert($input);
            }
        }
        foreach ($partnername2 as $key2 =>$v2) {
            $sliced2 = array_values($v2);
            $input2 = [
                'case_id' => $case->id,
                'block_partner' => $sliced2[0],



              ];

            if ($sliced2[0] !=0) {
                CaseAuth::insert($input2);
            }
        }

        foreach ($username2 as $key3 =>$v3) {
            $sliced3 = array_values($v3);

            $input3 = [
                 'case_id' => $case->id,
                 'block_user' => $sliced3[0],



               ];

            if ($sliced3[0] !=0) {
                CaseAuth::insert($input3);
            }
        }

        foreach ($guildmembername as $key4 =>$v4) {
            $sliced4 = array_values($v4);

            $input4 = [
                  'case_id' => $case->id,
                  'guild_member' => $sliced4[0],



                ];

            if ($sliced4[0] !=0) {
                CaseAuth::insert($input4);
            }
        }

        foreach ($grouppartnername as $key5 =>$v5) {
            $sliced5 = array_values($v5);

            $input5 = [
                   'case_id' => $case->id,
                   'group_partner' => $sliced5[0],



                 ];

            if ($sliced5[0] !=0) {
                CaseAuth::insert($input5);
            }
        }

        foreach ($groupmembername as $key6 =>$v6) {
            $sliced6 = array_values($v6);

            $input6 = [
                    'case_id' => $case->id,
                    'group_member' => $sliced6[0],



                  ];

            if ($sliced6[0] !=0) {
                CaseAuth::insert($input6);
            }
        }

        foreach ($grouppidname as $key7 =>$v7) {
            $input7 = [
                   'case_id' => $case->id,
                   'group_pid' => $v7,



                 ];

            if ($v7 !=0) {
                CaseAuth::insert($input7);
            }
        }

        $casedetail = Cases::where('id', $case->id)->get();

        return $casedetail;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function loadpublicid()
    {
        $url = $_SERVER['REQUEST_URI'];
        if(strstr($url,'?memberpublicid'))
        {
          return match_id::whereNotNUll('member_id')->get();
        }
        else
        {
          return match_id::all();
        }
    }
    public function loadguildmember()
    {
        return Member_group::all();
    }
    public function loadgroupmember()
    {
        return Family::all();
    }
    public function loadgrouppid()
    {
        return Pid_group::all();
    }
    public function loadgrouppartner()
    {
        return Partner_group::all();
    }
    public function loadmemberpid()
    {
        return match_id::where('member_id', '!=', null)->get();
    }
    public function loadcasecat()
    {
        return CaseCategory::all();
    }
    public function loadcasetype()
    {
      $url = $_SERVER['REQUEST_URI'];
      if(strstr($url,'?filterbycasecat'))
      {
        $casecatid = explode('?filterbycasecat',$url);
        $casecatid = $casecatid[1];
        return CaseType::where('case_cat_id',$casecatid)->get();
      }
      else
      {
        return CaseType::all();
      }
    }
    public function loadcasesubtype()
    {
      $url = $_SERVER['REQUEST_URI'];
      if(strstr($url,'?filterbycasetype'))
      {
        $casetypetid = explode('?filterbycasetype',$url);
        $casetypetid = $casetypetid[1];
        return CaseSubType::where('case_type',$casetypetid)->get();
      }
      else
      {
        return CaseSubType::all();
      }
    }
    public function create()
    {
        return view('system-mgmt/action-category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
        ActionCategory::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);
        return redirect('/admin/action-category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Cases::find($id);
        //return $id;
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
            $data = Cases::find($id);

            return redirect('/admin/action-category');
        }
        return view('system-mgmt/insurance/edit', ['data' => $data]);
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
        $structure = ActionCategory::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'description' => $request['description']
        ];
        ActionCategory::where('id', $id)
            ->update($input);

        return redirect('/admin/action-category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ActionCategory::where('id', $id)->delete();
        return redirect('/admin/action-category');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $constraints = [
            'name' => $request['name'],
            'description' => $request['description']
            ];

        $data = $this->doSearchingQuery($constraints);
        return view('system-mgmt/action-category/index', ['data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints)
    {
        $query = ActionCategory::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request)
    {
        $this->validate($request, [
        'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
