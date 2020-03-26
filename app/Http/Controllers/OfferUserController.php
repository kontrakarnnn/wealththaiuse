<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\Process;
use App\Stage;
use App\Condition;
use App\Condition_type;
use App\Cases;
use App\CaseType;
use App\CaseTypeConfig;
use App\Offer;
use App\OfferType;
use App\Asset_type;
use App\Proposal;
use App\match_id;
use App\Branch;
use App\Person;
use App\Campaign;
use App\Promotion;
use App\Partner_block;
use App\match_member_id;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SidebarController;
class OfferUserController extends Controller
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
    public function index()
    {
        return "No Page Found :(";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $url = $_SERVER['REQUEST_URI'];
      if(strstr($url,'?page=offer'))
      {
        $exurl = explode('?page=offer',$url);
        $caseid = $exurl[1];
        $offertype = OfferType::all();
        $offer = Offer::all();
        $proposal = Proposal::where('case_id',$caseid)->get();
        $match_member_group = match_member_id::whereIn('member_group_id',['7','11'])->pluck('member_id')->toArray();
        $member = Person::whereIn('id',$match_member_group)->get();
        $branch = Branch::all();
        $publicid = match_id::all();
        $campaign = Campaign::all();
        $promotion = Promotion::all();
        $membercase = Cases::where('id',$caseid)->value('member_case_owner');
        $memberlevel = Person::where('id',$membercase)->value('level');
        $castypeid = Cases::where('id',$caseid)->value('type_id');
        $casetypeconfigid = CaseType::where('id',$castypeid)->value('case_type_config');
        $taxrate = CaseTypeConfig::where('id',$casetypeconfigid)->value('config_value1');
        $coorrate = CaseTypeConfig::where('id',$casetypeconfigid)->value('config_value2');
        $otherrate = CaseTypeConfig::where('id',$casetypeconfigid)->value('config_value3');
        $partnerblockid = Cases::where('id',$caseid)->value('consult_partner_block_id');
        $partnerlevel = Partner_block::where('id',$partnerblockid)->value('level');
        $userblockid = Cases::where('id',$caseid)->value('service_user_block_id');
        $userlevel = Block::where('id',$userblockid)->value('level');

        if($memberlevel == NULL ||$memberlevel == 0 ||$memberlevel == '')
        {
          $memberlevel = 0;
        }
        if($taxrate == NULL ||$taxrate == 0 ||$taxrate == '')
        {
          $taxrate = 0;
        }
        if($coorrate == NULL ||$coorrate == 0 ||$coorrate == '')
        {
          $coorrate = 0;
        }
        if($otherrate == NULL ||$otherrate == 0 ||$otherrate == '')
        {
          $otherrate = 0;
        }
        if($partnerlevel == NULL ||$partnerlevel == 0 ||$partnerlevel == '')
        {
          $partnerlevel = 0;
        }
        if($userlevel == NULL ||$userlevel == 0 ||$userlevel == '')
        {
          $userlevel = 0;
        }
      }
      else
      {

      /*$offertype = OfferType::all();
      $offer = Offer::all();
      $proposal = Proposal::all();
      $member = Person::all();
      $branch = Branch::all();
      $publicid = match_id::all();*/

    }
        return view( 'system-mgmt/offeruser/create',compact(['branch','userlevel','partnerlevel','otherrate','coorrate','taxrate','memberlevel','campaign','promotion','proposal','member','branch','publicid','offer','offertype']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $datacontoller = New DataController();
      $publicid = $datacontoller->findpublicidinuseridnoinputuserid();
      date_default_timezone_set('Asia/Bangkok');
            $date = date("d/m/Y");
        $this->validateInput($request);
        if($request->campaign_id != 0)
        {
          $offertype_id = Campaign::where('id',$request->campaign_id)->value('offer_type');
        }
        else
        {
          $offertype_id = $request->type_id;
        }
          if($request['name'] == "NaN" ||$request['name'] == NULL)
          {
            $request['name'] = "ไม่ได้ตั้งชื่อ";
          }
          if($request['offer_payment_value1'] == "NaN" ||$request['offer_payment_value1'] == NULL)
          {
            $request['offer_payment_value1'] = 0;
          }
          if($request['offer_payment_value2'] == "NaN" ||$request['offer_payment_value2'] == NULL)
          {
            $request['offer_payment_value2'] = 0;
          }
          if($request['offer_payment_value3'] == "NaN" ||$request['offer_payment_value3'] == NULL)
          {
            $request['offer_payment_value3'] = 0;
          }
          if($request['offer_payment_value4'] == "NaN" ||$request['offer_payment_value4'] == NULL)
          {
            $request['offer_payment_value4'] = 0;
          }
          if($request['offer_payment_value5'] == "NaN" ||$request['offer_payment_value5'] == NULL)
          {
            $request['offer_payment_value5'] = 0;
          }
          if($request['offer_payment_value6'] == "NaN" ||$request['offer_payment_value6'] == NULL)
          {
            $request['offer_payment_value6'] = 0;
          }
          if($request['offer_payment_value7'] == "NaN" ||$request['offer_payment_value7'] == NULL)
          {
            $request['offer_payment_value7'] = 0;
          }
          if($request['offer_payment_value8'] == "NaN" ||$request['offer_payment_value8'] == NULL||$request['offer_payment_value8'] == "กรุณาเลือกหมวดการคำนวณ")
          {
            $request['offer_payment_value8'] = 0;
          }
          if($request['offer_payment_value9'] == "NaN" ||$request['offer_payment_value9'] == NULL)
          {
            $request['offer_payment_value9'] = 0;
          }
          if($request['offer_payment_value10'] == "NaN" ||$request['offer_payment_value10'] == NULL)
          {
            $request['offer_payment_value10'] = 0;
          }
          if($request['offer_payment_value11'] == "NaN" ||$request['offer_payment_value11'] == NULL)
          {
            $request['offer_payment_value11'] = 0;
          }
          if($request['offer_payment_value12'] == "NaN" ||$request['offer_payment_value12'] == NULL)
          {
            $request['offer_payment_value12'] = 0;
          }
          if($request['offer_payment_value13'] == "NaN" ||$request['offer_payment_value13'] == NULL)
          {
            $request['offer_payment_value13'] = 0;
          }
          if($request['offer_payment_value14'] == "NaN" ||$request['offer_payment_value14'] == NULL)
          {
            $request['offer_payment_value14'] = 0;
          }
          if($request['offer_payment_value15'] == "NaN" ||$request['offer_payment_value15'] == NULL)
          {
            $request['offer_payment_value15'] = 0;
          }
          if($request['offer_payment_value16'] == "NaN" ||$request['offer_payment_value16'] == NULL)
          {
            $request['offer_payment_value16'] = 0;
          }
          if($request['offer_payment_value17'] == "NaN" ||$request['offer_payment_value17'] == NULL)
          {
            $request['offer_payment_value17'] = 0;
          }
          if($request['offer_payment_value18'] == "NaN" ||$request['offer_payment_value18'] == NULL)
          {
            $request['offer_payment_value18'] = 0;
          }
          if($request['offer_payment_value19'] == "NaN" ||$request['offer_payment_value19'] == NULL)
          {
            $request['offer_payment_value19'] = 0;
          }
          if($request['offer_payment_value20'] == "NaN" ||$request['offer_payment_value20'] == NULL)
          {
            $request['offer_payment_value20'] = 0;
          }
          if($request['offer_payment_value21'] == "NaN" ||$request['offer_payment_value21'] == NULL)
          {
            $request['offer_payment_value21'] = 0;
          }
         Offer::create([
           'name' => $request['name'],
           'campaign_id' => $request['campaign_id'],
           'promotion_id' => $request['promotion_id'],
           'type_id' => $offertype_id,
           'proposal_id' => $request['proposal_id'],
           'created_date' =>$date,
           'modified_date' => $request['modified_date'],
           'attachment' => $request['attachment'],
           'ref_pid' => $publicid,
           'ref_member_id' => $request['ref_member_id'],
           'ref_branch_id' => $request['ref_branch_id'],
           'offer_value1' => $request['offer_value1'],
           'offer_value2' => $request['offer_value2'],
           'offer_value3' => $request['offer_value3'],
           'offer_value4' => $request['offer_value4'],
           'offer_value5' => $request['offer_value5'],
           'offer_value6' => $request['offer_value6'],
           'offer_value7' => $request['offer_value7'],
           'offer_value8' => $request['offer_value8'],
           'offer_value9' => $request['offer_value9'],
           'offer_value10' => $request['offer_value10'],
           'offer_value11' => $request['offer_value11'],
           'offer_value12' => $request['offer_value12'],
           'offer_value13' => $request['offer_value13'],
           'offer_value14' => $request['offer_value14'],
           'offer_value15' => $request['offer_value15'],
           'offer_value16' => $request['offer_value16'],
           'offer_value17' => $request['offer_value17'],
           'offer_value18' => $request['offer_value18'],
           'offer_value19' => $request['offer_value19'],
           'offer_value20' => $request['offer_value20'],
           'offer_value21' => $request['offer_value21'],
           'offer_value22' => $request['offer_value22'],
           'offer_value23' => $request['offer_value23'],
           'offer_value24' => $request['offer_value24'],
           'offer_value25' => $request['offer_value25'],
           'offer_value26' => $request['offer_value26'],
           'offer_value27' => $request['offer_value27'],
           'offer_value28' => $request['offer_value28'],
           'offer_value29' => $request['offer_value29'],
           'offer_value30' => $request['offer_value30'],
           'offer_value31' => $request['offer_value31'],
           'offer_value32' => $request['offer_value32'],
           'offer_value33' => $request['offer_value33'],
           'offer_value34' => $request['offer_value34'],
           'offer_value35' => $request['offer_value35'],
           'offer_value36' => $request['offer_value36'],
           'offer_value37' => $request['offer_value37'],
           'offer_value38' => $request['offer_value38'],
           'offer_value39' => $request['offer_value39'],
           'offer_value40' => $request['offer_value40'],

           'offer_detail_value1' => $request['offer_detail_value1'],
           'offer_detail_value2' => $request['offer_detail_value2'],
           'offer_detail_value3' => $request['offer_detail_value3'],
           'offer_detail_value4' => $request['offer_detail_value4'],
           'offer_detail_value5' => $request['offer_detail_value5'],
           'offer_detail_value6' => $request['offer_detail_value6'],
           'offer_detail_value7' => $request['offer_detail_value7'],
           'offer_detail_value8' => $request['offer_detail_value8'],
           'offer_detail_value9' => $request['offer_detail_value9'],
           'offer_detail_value10' => $request['offer_detail_value10'],
           'offer_detail_value11' => $request['offer_detail_value11'],
           'offer_detail_value12' => $request['offer_detail_value12'],
           'offer_detail_value13' => $request['offer_detail_value13'],
           'offer_detail_value14' => $request['offer_detail_value14'],
           'offer_detail_value15' => $request['offer_detail_value15'],
           'offer_detail_value16' => $request['offer_detail_value16'],
           'offer_detail_value17' => $request['offer_detail_value17'],
           'offer_detail_value18' => $request['offer_detail_value18'],
           'offer_detail_value19' => $request['offer_detail_value19'],
           'offer_detail_value20' => $request['offer_detail_value20'],


           'offer_payment_value1' => $request['offer_payment_value1'],
           'offer_payment_value2' => $request['offer_payment_value2'],
           'offer_payment_value3' => $request['offer_payment_value3'],
           'offer_payment_value4' => $request['offer_payment_value4'],
           'offer_payment_value5' => $request['offer_payment_value5'],
           'offer_payment_value6' => $request['offer_payment_value6'],
           'offer_payment_value7' => $request['offer_payment_value7'],
           'offer_payment_value8' => $request['offer_payment_value8'],
           'offer_payment_value9' => $request['offer_payment_value9'],
           'offer_payment_value10' => $request['offer_payment_value10'],
           'offer_payment_value11' => $request['offer_payment_value11'],
           'offer_payment_value12' => $request['offer_payment_value12'],
           'offer_payment_value13' => $request['offer_payment_value13'],
           'offer_payment_value14' => $request['offer_payment_value14'],
           'offer_payment_value15' => $request['offer_payment_value15'],
           'offer_payment_value16' => $request['offer_payment_value16'],
           'offer_payment_value17' => $request['offer_payment_value17'],
           'offer_payment_value18' => $request['offer_payment_value18'],
           'offer_payment_value19' => $request['offer_payment_value19'],
           'offer_payment_value20' => $request['offer_payment_value20'],
           'offer_payment_value21' => $request['offer_payment_value21'],
           'offer_payment_value22' => $request['offer_payment_value22'],
           'offer_payment_value23' => $request['offer_payment_value23'],
           'offer_payment_value24' => $request['offer_payment_value24'],
           'offer_payment_value25' => $request['offer_payment_value25'],
           'offer_payment_value26' => $request['offer_payment_value26'],
           'offer_payment_value27' => $request['offer_payment_value27'],
           'offer_payment_value28' => $request['offer_payment_value28'],
           'offer_payment_value29' => $request['offer_payment_value29'],
           'offer_payment_value30' => $request['offer_payment_value30'],
           'offer_payment_value31' => $request['offer_payment_value31'],
           'offer_payment_value32' => $request['offer_payment_value32'],
           'offer_payment_value33' => $request['offer_payment_value33'],
           'offer_payment_value34' => $request['offer_payment_value34'],
           'offer_payment_value35' => $request['offer_payment_value35'],
           'offer_payment_value36' => $request['offer_payment_value36'],
           'offer_payment_value37' => $request['offer_payment_value37'],
           'offer_payment_value38' => $request['offer_payment_value38'],
           'offer_payment_value39' => $request['offer_payment_value39'],
           'offer_payment_value40' => $request['offer_payment_value40'],
        ]);
        if(strstr(url()->previous(),'?prev'))
        {
          $url = url()->previous();
          $exurl = explode('?prev',$url);
          $caenum = $exurl[1];
          return redirect ($caenum);

        }
        else
        {
          return redirect ('/admin/offer');
        }
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

        $data = Offer::find($id);
        $offertype = OfferType::all();
        $offer = Offer::all();
        $match_member_group = match_member_id::whereIn('member_group_id',['7','11'])->pluck('member_id')->toArray();
        $member = Person::whereIn('id',$match_member_group)->get();        $branch = Branch::all();
        $publicid = match_id::all();
        $findofferremember = Offer::where('id',$id)->value('ref_member_id');
        $branch = Branch::where('org_id',$findofferremember)->get();
        $campaign = Campaign::all();
        $promotion = Promotion::all();
        $findoffer = Offer::where('id',$id)->value('type_id');
        $findoffertype = OfferType::where('id',$findoffer)->get();
        $url = $_SERVER['REQUEST_URI'];
        $caseid = explode('?prev/wealththaiinsurance/cases/',$url);
        $caseid = explode('/offer/show',$caseid[1]);
        $caseid = $caseid[0];
      //  return $caseid;
        $proposal = Proposal::where('case_id',$caseid)->get();
        $membercase = Cases::where('id',$caseid)->value('member_case_owner');
        $memberlevel = Person::where('id',$membercase)->value('level');
        $castypeid = Cases::where('id',$caseid)->value('type_id');
        $casetypeconfigid = CaseType::where('id',$castypeid)->value('case_type_config');
        $taxrate = CaseTypeConfig::where('id',$casetypeconfigid)->value('config_value1');
        $coorrate = CaseTypeConfig::where('id',$casetypeconfigid)->value('config_value2');
        $otherrate = CaseTypeConfig::where('id',$casetypeconfigid)->value('config_value3');
        $partnerblockid = Cases::where('id',$caseid)->value('consult_partner_block_id');
        $partnerlevel = Partner_block::where('id',$partnerblockid)->value('level');
        $userblockid = Cases::where('id',$caseid)->value('service_user_block_id');
        $userlevel = Block::where('id',$userblockid)->value('level');

        if($memberlevel == NULL ||$memberlevel == 0 ||$memberlevel == '')
        {
          $memberlevel = 0;
        }
        if($taxrate == NULL ||$taxrate == 0 ||$taxrate == '')
        {
          $taxrate = 0;
        }
        if($coorrate == NULL ||$coorrate == 0 ||$coorrate == '')
        {
          $coorrate = 0;
        }
        if($otherrate == NULL ||$otherrate == 0 ||$otherrate == '')
        {
          $otherrate = 0;
        }
        if($partnerlevel == NULL ||$partnerlevel == 0 ||$partnerlevel == '')
        {
          $partnerlevel = 0;
        }
        if($userlevel == NULL ||$userlevel == 0 ||$userlevel == '')
        {
          $userlevel = 0;
        }
        $offerpaymentpremium   = $data->offer_payment_value4;
        $offerpaymentdiscount15 = $data->offer_payment_value15;
        $offerpaymentdiscount16 = $data->offer_payment_value16;
        $offerpaymentdiscount18 = $data->offer_payment_value18;
        $offerpaymentdiscount20 = $data->offer_payment_value20;
        $offerpaymenttaxdeduction = $data->offer_payment_value5;
        $offerpaymentpartnerconsultfee = $data->offer_payment_value17;
        $offerpaymentuserservicefee = $data->offer_payment_value19;
        $offerpaymentgrosscom = $data->offer_payment_value8;

        if($offerpaymentpremium == 'NaN' ||$offerpaymentpremium == '' ||$offerpaymentpremium == NULL)
        {
          $offerpaymentpremium = 0;
        }
        if($offerpaymentdiscount15 == 'NaN' ||$offerpaymentdiscount15 == '' ||$offerpaymentdiscount15 == NULL)
        {
          $offerpaymentdiscount15 = 0;
        }
        if($offerpaymentdiscount16 == 'NaN' ||$offerpaymentdiscount16 == '' ||$offerpaymentdiscount16 == NULL)
        {
          $offerpaymentdiscount16 = 0;
        }
        if($offerpaymentdiscount20 == 'NaN' ||$offerpaymentdiscount20 == '' ||$offerpaymentdiscount20 == NULL)
        {
          $offerpaymentdiscount20 = 0;
        }
        if($offerpaymenttaxdeduction == 'NaN' ||$offerpaymenttaxdeduction == '' ||$offerpaymenttaxdeduction == NULL )
        {
          $offerpaymenttaxdeduction = 0;
        }
        if($offerpaymentpartnerconsultfee == 'NaN' ||$offerpaymentpartnerconsultfee == '' ||$offerpaymentpartnerconsultfee == NULL )
        {
          $offerpaymentpartnerconsultfee = 0;
        }
        if($offerpaymentuserservicefee == 'NaN' ||$offerpaymentuserservicefee == '' ||$offerpaymentuserservicefee == NULL )
        {
          $offerpaymentuserservicefee = 0;
        }
        if($offerpaymentgrosscom == 'NaN' ||$offerpaymentgrosscom == '' ||$offerpaymentgrosscom == NULL||$offerpaymentgrosscom == 'กรุณาเลือกหมวดการคำนวณ' )
        {
          $offerpaymentgrosscom = 0;
        }
        $alldiscount = $offerpaymentdiscount15+$offerpaymentdiscount16+$offerpaymentdiscount18+$offerpaymentdiscount20;
        $alldiscount = round($alldiscount,2);
        $calculatebeforetaxdeduct =$offerpaymentpremium-$alldiscount;
        $calculatebeforetaxdeduct =  round($calculatebeforetaxdeduct,2);
        $calculateaftertaxdeduct =$calculatebeforetaxdeduct-$offerpaymenttaxdeduction;
        $calculateaftertaxdeduct =  round($calculateaftertaxdeduct,2);
        $totalpaidpartner =$calculateaftertaxdeduct-$offerpaymentpartnerconsultfee;
        $totalpaidpartner =  round($totalpaidpartner,2);
        $totalpaiduser =$totalpaidpartner-$offerpaymentuserservicefee;
        $totalpaiduser =  round($totalpaiduser,2);
        $totalpaidcompany =  $offerpaymentpremium-$offerpaymentgrosscom-$offerpaymenttaxdeduction;
        $totalpaidcompany =round($totalpaidcompany,2);
      //  return $findoffertype;
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Offer::find($id);

            return redirect ('/admin/offer');
        }

        return view( 'system-mgmt/offeruser/edit', ['totalpaidcompany' =>$totalpaidcompany,'totalpaiduser' =>$totalpaiduser,'totalpaidpartner' =>$totalpaidpartner,'calculateaftertaxdeduct' =>$calculateaftertaxdeduct,'calculatebeforetaxdeduct' =>$calculatebeforetaxdeduct,'alldiscount' =>$alldiscount,'offerpaymenttaxdeduction' =>$offerpaymenttaxdeduction,'offerpaymentpremium' =>$offerpaymentpremium,'branch' =>$branch,'userlevel' =>$userlevel,'partnerlevel'=>$partnerlevel,'otherrate'=>$otherrate,'coorrate'=>$coorrate,'taxrate'=>$taxrate,'memberlevel'=>$memberlevel,'campaign' => $campaign,'promotion' => $promotion,'findoffertype' => $findoffertype,'branch' => $branch,'publicid' => $publicid,'member' => $member,'publicid' => $publicid,'proposal' => $proposal,'offertype' => $offertype,'data' => $data]);
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
      $datacontoller = New DataController();
      $publicid = $datacontoller->findpublicidinuseridnoinputuserid();
      date_default_timezone_set('Asia/Bangkok');
            $date = date("d/m/Y");
        $this->validateInput($request);
        if($request->campaign_id != 0)
        {
          $offertype_id = Campaign::where('id',$request->campaign_id)->value('offer_type');
        }
        else
        {
          $offertype_id = $request->type_id;
        }
        $input = [
          'name' => $request['name'],
          'type_id' => $offertype_id,
          'campaign_id' => $request['campaign_id'],
          'promotion_id' => $request['promotion_id'],
          'proposal_id' => $request['proposal_id'],
          'modified_date' => $date,
          'attachment' => $request['attachment'],
          'ref_pid' => $publicid,
          'ref_member_id' => $request['ref_member_id'],
          'ref_branch_id' => $request['ref_branch_id'],
          'offer_value1' => $request['offer_value1'],
          'offer_value2' => $request['offer_value2'],
          'offer_value3' => $request['offer_value3'],
          'offer_value4' => $request['offer_value4'],
          'offer_value5' => $request['offer_value5'],
          'offer_value6' => $request['offer_value6'],
          'offer_value7' => $request['offer_value7'],
          'offer_value8' => $request['offer_value8'],
          'offer_value9' => $request['offer_value9'],
          'offer_value10' => $request['offer_value10'],
          'offer_value11' => $request['offer_value11'],
          'offer_value12' => $request['offer_value12'],
          'offer_value13' => $request['offer_value13'],
          'offer_value14' => $request['offer_value14'],
          'offer_value15' => $request['offer_value15'],
          'offer_value16' => $request['offer_value16'],
          'offer_value17' => $request['offer_value17'],
          'offer_value18' => $request['offer_value18'],
          'offer_value19' => $request['offer_value19'],
          'offer_value20' => $request['offer_value20'],
          'offer_value21' => $request['offer_value21'],
          'offer_value22' => $request['offer_value22'],
          'offer_value23' => $request['offer_value23'],
          'offer_value24' => $request['offer_value24'],
          'offer_value25' => $request['offer_value25'],
          'offer_value26' => $request['offer_value26'],
          'offer_value27' => $request['offer_value27'],
          'offer_value28' => $request['offer_value28'],
          'offer_value29' => $request['offer_value29'],
          'offer_value30' => $request['offer_value30'],
          'offer_value31' => $request['offer_value31'],
          'offer_value32' => $request['offer_value32'],
          'offer_value33' => $request['offer_value33'],
          'offer_value34' => $request['offer_value34'],
          'offer_value35' => $request['offer_value35'],
          'offer_value36' => $request['offer_value36'],
          'offer_value37' => $request['offer_value37'],
          'offer_value38' => $request['offer_value38'],
          'offer_value39' => $request['offer_value39'],
          'offer_value40' => $request['offer_value40'],

                     'offer_detail_value1' => $request['offer_detail_value1'],
                     'offer_detail_value2' => $request['offer_detail_value2'],
                     'offer_detail_value3' => $request['offer_detail_value3'],
                     'offer_detail_value4' => $request['offer_detail_value4'],
                     'offer_detail_value5' => $request['offer_detail_value5'],
                     'offer_detail_value6' => $request['offer_detail_value6'],
                     'offer_detail_value7' => $request['offer_detail_value7'],
                     'offer_detail_value8' => $request['offer_detail_value8'],
                     'offer_detail_value9' => $request['offer_detail_value9'],
                     'offer_detail_value10' => $request['offer_detail_value10'],
                     'offer_detail_value11' => $request['offer_detail_value11'],
                     'offer_detail_value12' => $request['offer_detail_value12'],
                     'offer_detail_value13' => $request['offer_detail_value13'],
                     'offer_detail_value14' => $request['offer_detail_value14'],
                     'offer_detail_value15' => $request['offer_detail_value15'],
                     'offer_detail_value16' => $request['offer_detail_value16'],
                     'offer_detail_value17' => $request['offer_detail_value17'],
                     'offer_detail_value18' => $request['offer_detail_value18'],
                     'offer_detail_value19' => $request['offer_detail_value19'],
                     'offer_detail_value20' => $request['offer_detail_value20'],


                     'offer_payment_value1' => $request['offer_payment_value1'],
                     'offer_payment_value2' => $request['offer_payment_value2'],
                     'offer_payment_value3' => $request['offer_payment_value3'],
                     'offer_payment_value4' => $request['offer_payment_value4'],
                     'offer_payment_value5' => $request['offer_payment_value5'],
                     'offer_payment_value6' => $request['offer_payment_value6'],
                     'offer_payment_value7' => $request['offer_payment_value7'],
                     'offer_payment_value8' => $request['offer_payment_value8'],
                     'offer_payment_value9' => $request['offer_payment_value9'],
                     'offer_payment_value10' => $request['offer_payment_value10'],
                     'offer_payment_value11' => $request['offer_payment_value11'],
                     'offer_payment_value12' => $request['offer_payment_value12'],
                     'offer_payment_value13' => $request['offer_payment_value13'],
                     'offer_payment_value14' => $request['offer_payment_value14'],
                     'offer_payment_value15' => $request['offer_payment_value15'],
                     'offer_payment_value16' => $request['offer_payment_value16'],
                     'offer_payment_value17' => $request['offer_payment_value17'],
                     'offer_payment_value18' => $request['offer_payment_value18'],
                     'offer_payment_value19' => $request['offer_payment_value19'],
                     'offer_payment_value20' => $request['offer_payment_value20'],
                     'offer_payment_value21' => $request['offer_payment_value21'],
                     'offer_payment_value22' => $request['offer_payment_value22'],
                     'offer_payment_value23' => $request['offer_payment_value23'],
                     'offer_payment_value24' => $request['offer_payment_value24'],
                     'offer_payment_value25' => $request['offer_payment_value25'],
                     'offer_payment_value26' => $request['offer_payment_value26'],
                     'offer_payment_value27' => $request['offer_payment_value27'],
                     'offer_payment_value28' => $request['offer_payment_value28'],
                     'offer_payment_value29' => $request['offer_payment_value29'],
                     'offer_payment_value30' => $request['offer_payment_value30'],
                     'offer_payment_value31' => $request['offer_payment_value31'],
                     'offer_payment_value32' => $request['offer_payment_value32'],
                     'offer_payment_value33' => $request['offer_payment_value33'],
                     'offer_payment_value34' => $request['offer_payment_value34'],
                     'offer_payment_value35' => $request['offer_payment_value35'],
                     'offer_payment_value36' => $request['offer_payment_value36'],
                     'offer_payment_value37' => $request['offer_payment_value37'],
                     'offer_payment_value38' => $request['offer_payment_value38'],
                     'offer_payment_value39' => $request['offer_payment_value39'],
                     'offer_payment_value40' => $request['offer_payment_value40'],
        ];
        Offer::where('id', $id)
            ->update($input);

            if(strstr(url()->previous(),'?prev'))
            {
              $url = url()->previous();
              $exurl = explode('?prev',$url);
              $caenum = $exurl[1];
              return redirect ($caenum);

            }
            else
            {
              return redirect ('/admin/offer');

            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Offer::where('id', $id)->delete();
         return redirect ('/admin/offer');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name'],
            'proposal_id' => $request['proposal_id'],
            'ref_member_id' => $request['ref_member_id'],
            'type_id' => $request['type_id'],
            'proposal_id' => $request['proposal_id'],
            'ref_pid' => $request['ref_pid'],
            'ref_branch_id' => $request['ref_branch_id'],
            'created_date' => $request['created_date'],
            'modified_date' => $request['modified_date'],
            ];
            $offertype = OfferType::all();
            $offer = Offer::all();
            $proposal = Proposal::all();
            $member = Person::all();
            $branch = Branch::all();
            $publicid = match_id::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/offeruser/index', ['proposal' => $proposal,'member' => $member,'branch' => $branch,'publicid' => $publicid,'offer' => $offer,'offertype' => $offertype,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Offer::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
        //'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
