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
use App\Offer;
use App\OfferType;
use App\Asset_type;
use App\Proposal;
use App\match_id;
use App\Branch;
use App\Person;
use App\Campaign;




use App\Http\Controllers\SidebarController;
class CampaignController extends Controller
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
        $data = Campaign::paginate(30);
        $offertype = OfferType::all();
        $offer = Campaign::all();
        $proposal = Proposal::all();
        $member = Person::all();
        $branch = Branch::all();
        $publicid = match_id::all();
        $filerefname = 'Offer_Attachment_';

        return view('system-mgmt/campaign/index', ['filerefname' => $filerefname,'proposal' => $proposal,'member' => $member,'branch' => $branch,'publicid' => $publicid,'offertype' => $offertype,'offer' => $offer,'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $offertype = OfferType::all();
      $offer = Offer::all();
      $proposal = Proposal::all();
      $member = Person::all();
      $branch = Branch::all();
      $publicid = match_id::all();
        return view( 'system-mgmt/campaign/create',compact(['proposal','member','branch','publicid','offer','offertype']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
            $date = date("d/m/Y");
        $this->validateInput($request);
         Campaign::create([
           'name' => $request['name'],
           'offer_type' => $request['offer_type'],
           'valid_to' => $request['valid_to'],
           'valid_from' => $request['valid_from'],
           //'attachment' => $request['attachment'],
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

           'offer_value_flag1' => $request['offer_value_flag1'],
           'offer_value_flag2' => $request['offer_value_flag2'],
           'offer_value_flag3' => $request['offer_value_flag3'],
           'offer_value_flag4' => $request['offer_value_flag4'],
           'offer_value_flag5' => $request['offer_value_flag5'],
           'offer_value_flag6' => $request['offer_value_flag6'],
           'offer_value_flag7' => $request['offer_value_flag7'],
           'offer_value_flag8' => $request['offer_value_flag8'],
           'offer_value_flag9' => $request['offer_value_flag9'],
           'offer_value_flag10' => $request['offer_value_flag10'],
           'offer_value_flag11' => $request['offer_value_flag11'],
           'offer_value_flag12' => $request['offer_value_flag12'],
           'offer_value_flag13' => $request['offer_value_flag13'],
           'offer_value_flag14' => $request['offer_value_flag14'],
           'offer_value_flag15' => $request['offer_value_flag15'],
           'offer_value_flag16' => $request['offer_value_flag16'],
           'offer_value_flag17' => $request['offer_value_flag17'],
           'offer_value_flag18' => $request['offer_value_flag18'],
           'offer_value_flag19' => $request['offer_value_flag19'],
           'offer_value_flag20' => $request['offer_value_flag20'],
           'offer_value_flag21' => $request['offer_value_flag21'],
           'offer_value_flag22' => $request['offer_value_flag22'],
           'offer_value_flag23' => $request['offer_value_flag23'],
           'offer_value_flag24' => $request['offer_value_flag24'],
           'offer_value_flag25' => $request['offer_value_flag25'],
           'offer_value_flag26' => $request['offer_value_flag26'],
           'offer_value_flag27' => $request['offer_value_flag27'],
           'offer_value_flag28' => $request['offer_value_flag28'],
           'offer_value_flag29' => $request['offer_value_flag29'],
           'offer_value_flag30' => $request['offer_value_flag30'],
           'offer_value_flag31' => $request['offer_value_flag31'],
           'offer_value_flag32' => $request['offer_value_flag32'],
           'offer_value_flag33' => $request['offer_value_flag33'],
           'offer_value_flag34' => $request['offer_value_flag34'],
           'offer_value_flag35' => $request['offer_value_flag35'],
           'offer_value_flag36' => $request['offer_value_flag36'],
           'offer_value_flag37' => $request['offer_value_flag37'],
           'offer_value_flag38' => $request['offer_value_flag38'],
           'offer_value_flag39' => $request['offer_value_flag39'],
           'offer_value_flag40' => $request['offer_value_flag40'],

           'offer_payment_value_flag1' => $request['offer_payment_value_flag1'],
           'offer_payment_value_flag2' => $request['offer_payment_value_flag2'],
           'offer_payment_value_flag3' => $request['offer_payment_value_flag3'],
           'offer_payment_value_flag4' => $request['offer_payment_value_flag4'],
           'offer_payment_value_flag5' => $request['offer_payment_value_flag5'],
           'offer_payment_value_flag6' => $request['offer_payment_value_flag6'],
           'offer_payment_value_flag7' => $request['offer_payment_value_flag7'],
           'offer_payment_value_flag8' => $request['offer_payment_value_flag8'],
           'offer_payment_value_flag9' => $request['offer_payment_value_flag9'],
           'offer_payment_value_flag10' => $request['offer_payment_value_flag10'],
           'offer_payment_value_flag11' => $request['offer_payment_value_flag11'],
           'offer_payment_value_flag12' => $request['offer_payment_value_flag12'],
           'offer_payment_value_flag13' => $request['offer_payment_value_flag13'],
           'offer_payment_value_flag14' => $request['offer_payment_value_flag14'],
           'offer_payment_value_flag15' => $request['offer_payment_value_flag15'],
           'offer_payment_value_flag16' => $request['offer_payment_value_flag16'],
           'offer_payment_value_flag17' => $request['offer_payment_value_flag17'],
           'offer_payment_value_flag18' => $request['offer_payment_value_flag18'],
           'offer_payment_value_flag19' => $request['offer_payment_value_flag19'],
           'offer_payment_value_flag20' => $request['offer_payment_value_flag20'],
           'offer_payment_value_flag21' => $request['offer_payment_value_flag21'],
           'offer_payment_value_flag22' => $request['offer_payment_value_flag22'],
           'offer_payment_value_flag23' => $request['offer_payment_value_flag23'],
           'offer_payment_value_flag24' => $request['offer_payment_value_flag24'],
           'offer_payment_value_flag25' => $request['offer_payment_value_flag25'],
           'offer_payment_value_flag26' => $request['offer_payment_value_flag26'],
           'offer_payment_value_flag27' => $request['offer_payment_value_flag27'],
           'offer_payment_value_flag28' => $request['offer_payment_value_flag28'],
           'offer_payment_value_flag29' => $request['offer_payment_value_flag29'],
           'offer_payment_value_flag30' => $request['offer_payment_value_flag30'],
           'offer_payment_value_flag31' => $request['offer_payment_value_flag31'],
           'offer_payment_value_flag32' => $request['offer_payment_value_flag32'],
           'offer_payment_value_flag33' => $request['offer_payment_value_flag33'],
           'offer_payment_value_flag34' => $request['offer_payment_value_flag34'],
           'offer_payment_value_flag35' => $request['offer_payment_value_flag35'],
           'offer_payment_value_flag36' => $request['offer_payment_value_flag36'],
           'offer_payment_value_flag37' => $request['offer_payment_value_flag37'],
           'offer_payment_value_flag38' => $request['offer_payment_value_flag38'],
           'offer_payment_value_flag39' => $request['offer_payment_value_flag39'],
           'offer_payment_value_flag40' => $request['offer_payment_value_flag40'],

           'offer_detail_value_flag1' => $request['offer_detail_value_flag1'],
           'offer_detail_value_flag2' => $request['offer_detail_value_flag2'],
           'offer_detail_value_flag3' => $request['offer_detail_value_flag3'],
           'offer_detail_value_flag4' => $request['offer_detail_value_flag4'],
           'offer_detail_value_flag5' => $request['offer_detail_value_flag5'],
           'offer_detail_value_flag6' => $request['offer_detail_value_flag6'],
           'offer_detail_value_flag7' => $request['offer_detail_value_flag7'],
           'offer_detail_value_flag8' => $request['offer_detail_value_flag8'],
           'offer_detail_value_flag9' => $request['offer_detail_value_flag9'],
           'offer_detail_value_flag10' => $request['offer_detail_value_flag10'],
           'offer_detail_value_flag11' => $request['offer_detail_value_flag11'],
           'offer_detail_value_flag12' => $request['offer_detail_value_flag12'],
           'offer_detail_value_flag13' => $request['offer_detail_value_flag13'],
           'offer_detail_value_flag14' => $request['offer_detail_value_flag14'],
           'offer_detail_value_flag15' => $request['offer_detail_value_flag15'],
           'offer_detail_value_flag16' => $request['offer_detail_value_flag16'],
           'offer_detail_value_flag17' => $request['offer_detail_value_flag17'],
           'offer_detail_value_flag18' => $request['offer_detail_value_flag18'],
           'offer_detail_value_flag19' => $request['offer_detail_value_flag19'],
           'offer_detail_value_flag20' => $request['offer_detail_value_flag20'],

           'description' => $request['description'],

        ]);
        if(strstr(url()->previous(),'prev/wealththaiinsurance/all/cases?page=offer'))
        {
          $url = url()->previous();
          $exurl = explode('?page=offer',$url);
          $caenum = $exurl[1];
          return redirect ('/wealththaiinsurance/all/cases?page=offer'.$caenum);
        }
        else
        {
          return redirect ('/admin/campaign');
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

        $data = Campaign::find($id);
        $offertype = OfferType::all();
        $offer = Campaign::all();
        $proposal = Proposal::all();
        $member = Person::all();
        $branch = Branch::all();
        $publicid = match_id::all();

        $findoffer = Campaign::where('id',$id)->value('offer_type');
        $findoffertype = OfferType::where('id',$findoffer)->get();
      //  return $findoffertype;
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Campaign::find($id);

            return redirect ('/admin/campaign');
        }

        return view( 'system-mgmt/campaign/edit', ['findoffertype' => $findoffertype,'branch' => $branch,'publicid' => $publicid,'member' => $member,'publicid' => $publicid,'proposal' => $proposal,'offertype' => $offertype,'data' => $data]);
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
      date_default_timezone_set('Asia/Bangkok');
            $date = date("d/m/Y");
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'offer_type' => $request['offer_type'],
          'valid_to' => $request['valid_to'],
          'valid_from' => $request['valid_from'],
          //'attachment' => $request['attachment'],
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

          'offer_value_flag1' => $request['offer_value_flag1'],
          'offer_value_flag2' => $request['offer_value_flag2'],
          'offer_value_flag3' => $request['offer_value_flag3'],
          'offer_value_flag4' => $request['offer_value_flag4'],
          'offer_value_flag5' => $request['offer_value_flag5'],
          'offer_value_flag6' => $request['offer_value_flag6'],
          'offer_value_flag7' => $request['offer_value_flag7'],
          'offer_value_flag8' => $request['offer_value_flag8'],
          'offer_value_flag9' => $request['offer_value_flag9'],
          'offer_value_flag10' => $request['offer_value_flag10'],
          'offer_value_flag11' => $request['offer_value_flag11'],
          'offer_value_flag12' => $request['offer_value_flag12'],
          'offer_value_flag13' => $request['offer_value_flag13'],
          'offer_value_flag14' => $request['offer_value_flag14'],
          'offer_value_flag15' => $request['offer_value_flag15'],
          'offer_value_flag16' => $request['offer_value_flag16'],
          'offer_value_flag17' => $request['offer_value_flag17'],
          'offer_value_flag18' => $request['offer_value_flag18'],
          'offer_value_flag19' => $request['offer_value_flag19'],
          'offer_value_flag20' => $request['offer_value_flag20'],
          'offer_value_flag21' => $request['offer_value_flag21'],
          'offer_value_flag22' => $request['offer_value_flag22'],
          'offer_value_flag23' => $request['offer_value_flag23'],
          'offer_value_flag24' => $request['offer_value_flag24'],
          'offer_value_flag25' => $request['offer_value_flag25'],
          'offer_value_flag26' => $request['offer_value_flag26'],
          'offer_value_flag27' => $request['offer_value_flag27'],
          'offer_value_flag28' => $request['offer_value_flag28'],
          'offer_value_flag29' => $request['offer_value_flag29'],
          'offer_value_flag30' => $request['offer_value_flag30'],
          'offer_value_flag31' => $request['offer_value_flag31'],
          'offer_value_flag32' => $request['offer_value_flag32'],
          'offer_value_flag33' => $request['offer_value_flag33'],
          'offer_value_flag34' => $request['offer_value_flag34'],
          'offer_value_flag35' => $request['offer_value_flag35'],
          'offer_value_flag36' => $request['offer_value_flag36'],
          'offer_value_flag37' => $request['offer_value_flag37'],
          'offer_value_flag38' => $request['offer_value_flag38'],
          'offer_value_flag39' => $request['offer_value_flag39'],
          'offer_value_flag40' => $request['offer_value_flag40'],

          'offer_payment_value_flag1' => $request['offer_payment_value_flag1'],
          'offer_payment_value_flag2' => $request['offer_payment_value_flag2'],
          'offer_payment_value_flag3' => $request['offer_payment_value_flag3'],
          'offer_payment_value_flag4' => $request['offer_payment_value_flag4'],
          'offer_payment_value_flag5' => $request['offer_payment_value_flag5'],
          'offer_payment_value_flag6' => $request['offer_payment_value_flag6'],
          'offer_payment_value_flag7' => $request['offer_payment_value_flag7'],
          'offer_payment_value_flag8' => $request['offer_payment_value_flag8'],
          'offer_payment_value_flag9' => $request['offer_payment_value_flag9'],
          'offer_payment_value_flag10' => $request['offer_payment_value_flag10'],
          'offer_payment_value_flag11' => $request['offer_payment_value_flag11'],
          'offer_payment_value_flag12' => $request['offer_payment_value_flag12'],
          'offer_payment_value_flag13' => $request['offer_payment_value_flag13'],
          'offer_payment_value_flag14' => $request['offer_payment_value_flag14'],
          'offer_payment_value_flag15' => $request['offer_payment_value_flag15'],
          'offer_payment_value_flag16' => $request['offer_payment_value_flag16'],
          'offer_payment_value_flag17' => $request['offer_payment_value_flag17'],
          'offer_payment_value_flag18' => $request['offer_payment_value_flag18'],
          'offer_payment_value_flag19' => $request['offer_payment_value_flag19'],
          'offer_payment_value_flag20' => $request['offer_payment_value_flag20'],
          'offer_payment_value_flag21' => $request['offer_payment_value_flag21'],
          'offer_payment_value_flag22' => $request['offer_payment_value_flag22'],
          'offer_payment_value_flag23' => $request['offer_payment_value_flag23'],
          'offer_payment_value_flag24' => $request['offer_payment_value_flag24'],
          'offer_payment_value_flag25' => $request['offer_payment_value_flag25'],
          'offer_payment_value_flag26' => $request['offer_payment_value_flag26'],
          'offer_payment_value_flag27' => $request['offer_payment_value_flag27'],
          'offer_payment_value_flag28' => $request['offer_payment_value_flag28'],
          'offer_payment_value_flag29' => $request['offer_payment_value_flag29'],
          'offer_payment_value_flag30' => $request['offer_payment_value_flag30'],
          'offer_payment_value_flag31' => $request['offer_payment_value_flag31'],
          'offer_payment_value_flag32' => $request['offer_payment_value_flag32'],
          'offer_payment_value_flag33' => $request['offer_payment_value_flag33'],
          'offer_payment_value_flag34' => $request['offer_payment_value_flag34'],
          'offer_payment_value_flag35' => $request['offer_payment_value_flag35'],
          'offer_payment_value_flag36' => $request['offer_payment_value_flag36'],
          'offer_payment_value_flag37' => $request['offer_payment_value_flag37'],
          'offer_payment_value_flag38' => $request['offer_payment_value_flag38'],
          'offer_payment_value_flag39' => $request['offer_payment_value_flag39'],
          'offer_payment_value_flag40' => $request['offer_payment_value_flag40'],

          'offer_detail_value_flag1' => $request['offer_detail_value_flag1'],
          'offer_detail_value_flag2' => $request['offer_detail_value_flag2'],
          'offer_detail_value_flag3' => $request['offer_detail_value_flag3'],
          'offer_detail_value_flag4' => $request['offer_detail_value_flag4'],
          'offer_detail_value_flag5' => $request['offer_detail_value_flag5'],
          'offer_detail_value_flag6' => $request['offer_detail_value_flag6'],
          'offer_detail_value_flag7' => $request['offer_detail_value_flag7'],
          'offer_detail_value_flag8' => $request['offer_detail_value_flag8'],
          'offer_detail_value_flag9' => $request['offer_detail_value_flag9'],
          'offer_detail_value_flag10' => $request['offer_detail_value_flag10'],
          'offer_detail_value_flag11' => $request['offer_detail_value_flag11'],
          'offer_detail_value_flag12' => $request['offer_detail_value_flag12'],
          'offer_detail_value_flag13' => $request['offer_detail_value_flag13'],
          'offer_detail_value_flag14' => $request['offer_detail_value_flag14'],
          'offer_detail_value_flag15' => $request['offer_detail_value_flag15'],
          'offer_detail_value_flag16' => $request['offer_detail_value_flag16'],
          'offer_detail_value_flag17' => $request['offer_detail_value_flag17'],
          'offer_detail_value_flag18' => $request['offer_detail_value_flag18'],
          'offer_detail_value_flag19' => $request['offer_detail_value_flag19'],
          'offer_detail_value_flag20' => $request['offer_detail_value_flag20'],
          'description' => $request['description'],
        ];
        Campaign::where('id', $id)
            ->update($input);

            if(strstr(url()->previous(),'prev/wealththaiinsurance/all/cases?page=offer'))
            {
              $url = url()->previous();
              $exurl = explode('?page=offer',$url);
              $caenum = $exurl[1];
              return redirect ('/wealththaiinsurance/all/cases?page=offer'.$caenum);

            }
            else
            {
              return redirect ('/admin/campaign');

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
        Campaign::where('id', $id)->delete();
         return redirect ('/admin/campaign');
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
            $offer = Campaign::all();
            $proposal = Proposal::all();
            $member = Person::all();
            $branch = Branch::all();
            $publicid = match_id::all();
            $filerefname = 'Offer_Attachment_';

       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/campaign/index', ['filerefname' => $filerefname,'proposal' => $proposal,'member' => $member,'branch' => $branch,'publicid' => $publicid,'offer' => $offer,'offertype' => $offertype,'data' => $data, 'searchingVals' => $constraints]);
    }
    private function doSearchingQuery($constraints) {
        $query = Campaign::query();
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
