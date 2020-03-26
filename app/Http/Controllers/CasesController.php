<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset;
use App\CaseType;
use App\CaseCategory;
use App\Partner_block;
use App\Cases;
use App\match_id;
use App\CaseSubType;
use App\Family;
use App\Member_group;
use App\Partner_group;
use App\Pid_group;
use App\CaseAuth;
use App\Procedures;
use App\Stage;
use App\Person;
use App\User_auth;
use App\User;
use App\Path_condition_detail;
use App\Path_condition;
use Mail;
use App\Http\Controllers\CaseCenterController;





use App\Http\Controllers\SidebarController;
class CasesController extends Controller
{
  protected $details;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('view', ['except' => ['approveupdate' ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


      $public_id = match_id::all();
      $asset = Asset::all();
      $block = Block::all();
      $partnerblock = Partner_block::all();
      $casecatcol = CaseCategory::casecategory();
      $casecat = CaseCategory::all();
      $casesubtype = CaseSubType::all();
      $casetypecol = CaseType::arraycolumn();
      $procedures = Procedures::all();
      $stage = Stage::all();
      $casetype =  CaseType::with(['CaseCategory','Partner_block','Block'])->get();
      $casecol = Cases::arraycolumn();
      $case = Cases::all();
      $member = Person::all();
      $userauth = User_auth::where('block_id',72)->pluck('user_id')->toArray();
      $user = User::whereIn('id',$userauth)->get();

      $data = Cases::with(['Person','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id'])->paginate(30);
      $filerefname = 'Case_Attachment_';
        return view('system-mgmt/cases/index', ['user' => $user,'member' => $member,'filerefname' => $filerefname,'stage' => $stage,'procedures' => $procedures,'case' => $case,'block' => $block,'partnerblock' => $partnerblock,'casesubtype' => $casesubtype,'asset' => $asset,'public_id' => $public_id,'casecol' => $casecol,'casetype' => $casetype,'block' => $block,'partnerblock' => $partnerblock,'casecatcol' => $casecatcol,'casetypecol' => $casetypecol,'casecat' => $casecat,'data' => $data]);
    }

    public function approveupdate()
    {
      $uri = $_SERVER['REQUEST_URI'];
      $uri = explode('/',$uri);
      $caseid = $uri[3];
      $pathconid = $uri[4];
      $casefind = Cases::find($caseid);
      $current = Auth::user()->id;
      //if($casefind->member_case_owner == $current ||$casefind->member_case_owner)
      $input = ['con_para_value2' =>1,];
      Path_condition_detail::where('id', $pathconid)
          ->update($input);
      return redirect('/admin/cases');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $guildmember =Family::all();
      $membergroup = Member_group::all();
      $pidgroup = Pid_group::all();
      $partnergroup = Partner_group::all();
      $member = Person::all();
      $public_id = match_id::all();
      $asset = Asset::all();
      $block = Block::all();
      $userauth = User_auth::where('block_id',72)->pluck('user_id')->toArray();
      $user = User::whereIn('id',$userauth)->get();
      $partnerblock = Partner_block::all();
      $casecatcol = CaseCategory::casecategory();
      $casecat = CaseCategory::all();
      $casesubtype = CaseSubType::all();
      $procedures = Procedures::all();
      $stage = Stage::all();
      $casetypecol = CaseType::arraycolumn();
      $casetype =  CaseType::with(['CaseCategory','Partner_block','Block'])->get();
      $cases = Cases::with(['Block','Partner_block','CaseType','CaseSubType','Asset','match_id'])->get();

        return view( 'system-mgmt/cases/create',compact('user','member','stage','procedures','guildmember','membergroup','pidgroup','partnergroup','cases','casesubtype','casetype','public_id','asset','casecatcol','casesubtype','casetypecol','block','partnerblock','casecat'));
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
      //  return $request->get('public_id');

        $this->validateInput($request);
         $data = Cases::create([
            'name' => $request['name'],
            'type_id' => $request['type_id'],
            'sub_type_id' => $request['sub_type_id'],
            'created_by_pid' => $request['created_by_pid'],
            'procedure_id' => $request['procedure_id'],
            'stage' => $request['stage'],
            'referal_asset' => $request['referal_asset'],
            'ref_previous_case' => $request['ref_previous_case'],
            'case_channel' => $request['case_channel'],
            'member_case_owner' => $request['member_case_owner'],
            'consult_partner_block_id' => $request['consult_partner_block_id'],
            'service_user_block_id' => $request['service_user_block_id'],
            'coordinate_user_block_id' => $request['coordinate_user_block_id'],
            'case_created_date' => $date,
            'auto_renew_date' => $request['auto_renew_date'],
            'next_notify_date' => $request['next_notify_date'],
            'note_from_previous_case' => $request['note_from_previous_case'],
            'note_to_copy_to_renew_case' => $request['note_to_copy_to_renew_case'],
            'note_from_partner' => $request['note_from_partner'],
            'note_from_member' => $request['note_from_member'],
            'note_from_user' => $request['note_from_user'],
            'require_value1' => $request['require_value1'],
            'require_value2' => $request['require_value2'],
            'require_value3' => $request['require_value3'],
            'require_value4' => $request['require_value4'],
            'require_value5' => $request['require_value5'],
            'require_value6' => $request['require_value6'],
            'require_value7' => $request['require_value7'],
            'require_value8' => $request['require_value8'],
            'require_value9' => $request['require_value9'],
            'require_value10' => $request['require_value10'],
            'require_value11' => $request['require_value11'],
            'require_value12' => $request['require_value12'],
            'require_value13' => $request['require_value13'],
            'require_value14' => $request['require_value14'],
            'require_value15' => $request['require_value15'],
            'require_value16' => $request['require_value16'],
            'require_value17' => $request['require_value17'],
            'require_value18' => $request['require_value18'],
            'require_value19' => $request['require_value19'],
            'require_value20' => $request['require_value20'],


            'var_value1' => $request['var_value1'],
            'var_value2' => $request['var_value2'],
            'var_value3' => $request['var_value3'],
            'var_value4' => $request['var_value4'],
            'var_value5' => $request['var_value5'],
            'var_value6' => $request['var_value6'],
            'var_value7' => $request['var_value7'],
            'var_value8' => $request['var_value8'],
            'var_value9' => $request['var_value9'],
            'var_value10' => $request['var_value10'],
            'var_value11' => $request['var_value11'],
            'var_value12' => $request['var_value12'],
            'var_value13' => $request['var_value13'],
            'var_value14' => $request['var_value14'],
            'var_value15' => $request['var_value15'],
            'var_value16' => $request['var_value16'],
            'var_value17' => $request['var_value17'],
            'var_value18' => $request['var_value18'],
            'var_value19' => $request['var_value19'],
            'var_value20' => $request['var_value20'],
            'var_value21' => $request['var_value21'],
            'var_value22' => $request['var_value22'],
            'var_value23' => $request['var_value23'],
            'var_value24' => $request['var_value24'],
            'var_value25' => $request['var_value25'],
            'var_value26' => $request['var_value26'],
            'var_value27' => $request['var_value27'],
            'var_value28' => $request['var_value28'],
            'var_value29' => $request['var_value29'],
            'var_value30' => $request['var_value30'],
            'var_value31' => $request['var_value31'],
            'var_value32' => $request['var_value32'],
            'var_value33' => $request['var_value33'],
            'var_value34' => $request['var_value34'],
            'var_value35' => $request['var_value35'],
            'var_value36' => $request['var_value36'],
            'var_value37' => $request['var_value37'],
            'var_value38' => $request['var_value38'],
            'var_value39' => $request['var_value39'],
            'var_value40' => $request['var_value40'],
            'var_value41' => $request['var_value41'],
            'var_value42' => $request['var_value42'],
            'var_value43' => $request['var_value43'],
            'var_value44' => $request['var_value44'],
            'var_value45' => $request['var_value45'],
            'var_value46' => $request['var_value46'],
            'var_value47' => $request['var_value47'],
            'var_value48' => $request['var_value48'],
            'var_value49' => $request['var_value49'],
            'var_value50' => $request['var_value50'],
            'var_value51' => $request['var_value51'],
            'var_value52' => $request['var_value52'],
            'var_value53' => $request['var_value53'],
            'var_value54' => $request['var_value54'],
            'var_value55' => $request['var_value55'],
            'var_value56' => $request['var_value56'],
            'var_value57' => $request['var_value57'],
            'var_value58' => $request['var_value58'],
            'var_value59' => $request['var_value59'],
            'var_value60' => $request['var_value60'],

        ]);
        //$id = $data->id;
      //  return $id;


                      foreach($request->get('public_id') as $key =>$v)
                       {
                         $input = [
                           'case_id' => $data->id,
                           'public_id' => $request->public_id[$key],



                         ];

                           if($request->public_id[$key] !=0)
                           {
                           CaseAuth::insert($input);
                           }


                       }
                       foreach($request->get('block_partner') as $key2 =>$v2)
                        {
                          $input2 = [
                            'case_id' => $data->id,
                            'block_partner' => $request->block_partner[$key2],



                          ];

                            if($request->block_partner[$key2] !=0)
                            {
                            CaseAuth::insert($input2);
                            }


                        }

                        foreach($request->get('block_user') as $key3 =>$v3)
                         {
                           $input3 = [
                             'case_id' => $data->id,
                             'block_user' => $request->block_user[$key3],



                           ];

                             if($request->block_user[$key3] !=0)
                             {
                             CaseAuth::insert($input3);
                             }


                         }

                         foreach($request->get('guild_member') as $key4 =>$v4)
                          {
                            $input4 = [
                              'case_id' => $data->id,
                              'guild_member' => $request->guild_member[$key4],



                            ];

                              if($request->guild_member[$key4] !=0)
                              {
                              CaseAuth::insert($input4);
                              }


                          }

                          foreach($request->get('group_partner') as $key5 =>$v5)
                           {
                             $input5 = [
                               'case_id' => $data->id,
                               'group_partner' => $request->group_partner[$key5],



                             ];

                               if($request->group_partner[$key5] !=0)
                               {
                               CaseAuth::insert($input5);
                               }


                           }

                           foreach($request->get('group_member') as $key6 =>$v6)
                            {
                              $input6 = [
                                'case_id' => $data->id,
                                'group_member' => $request->group_member[$key6],



                              ];

                                if($request->group_member[$key6] !=0)
                                {
                                CaseAuth::insert($input6);
                                }


                            }

                            foreach($request->get('group_pid') as $key7 =>$v7)
                             {
                               $input7 = [
                                 'case_id' => $data->id,
                                 'group_pid' => $request->group_pid[$key7],



                               ];

                                 if($request->group_pid[$key7] !=0)
                                 {
                                 CaseAuth::insert($input7);
                                 }


                             }

        return redirect ('/admin/cases');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $blocks = Structure::find($id)->portfolio;
      $structures = Structure::paginate(5);
      return view( 'system-mgmt/cases/index', compact(['structures','blocks','tree']));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $public_id = match_id::all();
      $asset = Asset::all();
      $block = Block::all();
      $partnerblock = Partner_block::all();
      $casecatcol = CaseCategory::casecategory();
      $casecat = CaseCategory::all();
      $casesubtype = CaseSubType::all();
      $casetypecol = CaseType::arraycolumn();
      $casetype =  CaseType::with(['CaseCategory','Partner_block','Block'])->get();
      $casecol = Cases::arraycolumn();
      $procedures = Procedures::all();
      $stage = Stage::all();
      $cases = Cases::all();
      $member = Person::all();
      $userauth = User_auth::where('block_id',72)->pluck('user_id')->toArray();
      $user = User::whereIn('id',$userauth)->get();
      $casetypevar = Cases::where('id',$id)->value('type_id');
      $casetypevar = CaseType::find($casetypevar);
        $data = Cases::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Cases::find($id);

            return redirect ('/admin/cases');
        }

        return view( 'system-mgmt/cases/edit', ['user' => $user,'member' => $member,'stage' => $stage,'procedures' => $procedures,'casetypevar' => $casetypevar,'cases' => $cases,'block' => $block,'partnerblock' => $partnerblock,'casesubtype' => $casesubtype,'asset' => $asset,'public_id' => $public_id,'casecol' => $casecol,'casetype' => $casetype,'block' => $block,'partnerblock' => $partnerblock,'casecatcol' => $casecatcol,'casetypecol' => $casetypecol,'casecat' => $casecat,'data' => $data]);
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
          'type_id' => $request['type_id'],
          'sub_type_id' => $request['sub_type_id'],
          'created_by_pid' => $request['created_by_pid'],
          'procedure_id' => $request['procedure_id'],
          'stage' => $request['stage'],
          'referal_asset' => $request['referal_asset'],
          'ref_previous_case' => $request['ref_previous_case'],
          'case_channel' => $request['case_channel'],
          'member_case_owner' => $request['member_case_owner'],
          'consult_partner_block_id' => $request['consult_partner_block_id'],
          'service_user_block_id' => $request['service_user_block_id'],
          'coordinate_user_block_id' => $request['coordinate_user_block_id'],
          'last_updated_date' => $date,
          'auto_renew_date' => $request['auto_renew_date'],
          'next_notify_date' => $request['next_notify_date'],
          'note_from_previous_case' => $request['note_from_previous_case'],
          'note_to_copy_to_renew_case' => $request['note_to_copy_to_renew_case'],
          'note_from_partner' => $request['note_from_partner'],
          'note_from_member' => $request['note_from_member'],
          'note_from_user' => $request['note_from_user'],
          'require_value1' => $request['require_value1'],
          'require_value2' => $request['require_value2'],
          'require_value3' => $request['require_value3'],
          'require_value4' => $request['require_value4'],
          'require_value5' => $request['require_value5'],
          'require_value6' => $request['require_value6'],
          'require_value7' => $request['require_value7'],
          'require_value8' => $request['require_value8'],
          'require_value9' => $request['require_value9'],
          'require_value10' => $request['require_value10'],
          'require_value11' => $request['require_value11'],
          'require_value12' => $request['require_value12'],
          'require_value13' => $request['require_value13'],
          'require_value14' => $request['require_value14'],
          'require_value15' => $request['require_value15'],
          'require_value16' => $request['require_value16'],
          'require_value17' => $request['require_value17'],
          'require_value18' => $request['require_value18'],
          'require_value19' => $request['require_value19'],
          'require_value20' => $request['require_value20'],


          'var_value1' => $request['var_value1'],
          'var_value2' => $request['var_value2'],
          'var_value3' => $request['var_value3'],
          'var_value4' => $request['var_value4'],
          'var_value5' => $request['var_value5'],
          'var_value6' => $request['var_value6'],
          'var_value7' => $request['var_value7'],
          'var_value8' => $request['var_value8'],
          'var_value9' => $request['var_value9'],
          'var_value10' => $request['var_value10'],
          'var_value11' => $request['var_value11'],
          'var_value12' => $request['var_value12'],
          'var_value13' => $request['var_value13'],
          'var_value14' => $request['var_value14'],
          'var_value15' => $request['var_value15'],
          'var_value16' => $request['var_value16'],
          'var_value17' => $request['var_value17'],
          'var_value18' => $request['var_value18'],
          'var_value19' => $request['var_value19'],
          'var_value20' => $request['var_value20'],
          'var_value21' => $request['var_value21'],
          'var_value22' => $request['var_value22'],
          'var_value23' => $request['var_value23'],
          'var_value24' => $request['var_value24'],
          'var_value25' => $request['var_value25'],
          'var_value26' => $request['var_value26'],
          'var_value27' => $request['var_value27'],
          'var_value28' => $request['var_value28'],
          'var_value29' => $request['var_value29'],
          'var_value30' => $request['var_value30'],
          'var_value31' => $request['var_value31'],
          'var_value32' => $request['var_value32'],
          'var_value33' => $request['var_value33'],
          'var_value34' => $request['var_value34'],
          'var_value35' => $request['var_value35'],
          'var_value36' => $request['var_value36'],
          'var_value37' => $request['var_value37'],
          'var_value38' => $request['var_value38'],
          'var_value39' => $request['var_value39'],
          'var_value40' => $request['var_value40'],
          'var_value41' => $request['var_value41'],
          'var_value42' => $request['var_value42'],
          'var_value43' => $request['var_value43'],
          'var_value44' => $request['var_value44'],
          'var_value45' => $request['var_value45'],
          'var_value46' => $request['var_value46'],
          'var_value47' => $request['var_value47'],
          'var_value48' => $request['var_value48'],
          'var_value49' => $request['var_value49'],
          'var_value50' => $request['var_value50'],
          'var_value51' => $request['var_value51'],
          'var_value52' => $request['var_value52'],
          'var_value53' => $request['var_value53'],
          'var_value54' => $request['var_value54'],
          'var_value55' => $request['var_value55'],
          'var_value56' => $request['var_value56'],
          'var_value57' => $request['var_value57'],
          'var_value58' => $request['var_value58'],
          'var_value59' => $request['var_value59'],
          'var_value60' => $request['var_value60'],

        ];
        Cases::where('id', $id)
            ->update($input);

        return redirect ('/admin/cases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cases::where('id', $id)->delete();
         return redirect ('/admin/cases');
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
            'type_id' => $request['type_id'],
            'case_created_date' => $request['case_created_date'],
            'sub_type_id' => $request['sub_type_id'],
            'created_by_pid' => $request['created_by_pid'],
            'member_case_owner' => $request['member_case_owner'],
            'consult_partner_block_id' => $request['consult_partner_block_id'],
            'service_user_block_id' => $request['service_user_block_id'],
            'coordinate_user_block_id' => $request['coordinate_user_block_id'],
            'name' => $request['name'],

            ];

       $data = $this->doSearchingQuery($constraints);
       $public_id = match_id::all();
       $asset = Asset::all();
       $block = Block::all();
       $partnerblock = Partner_block::all();
       $casecatcol = CaseCategory::casecategory();
       $casecat = CaseCategory::all();
       $casesubtype = CaseSubType::all();
       $casetypecol = CaseType::arraycolumn();
       $casetype =  CaseType::with(['CaseCategory','Partner_block','Block'])->get();
       $casecol = Cases::arraycolumn();
       $case = Cases::all();
       $member = Person::all();

       //$data = Cases::with(['Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id'])->paginate(30);

       return view( 'system-mgmt/cases/index', ['member' => $member,'case' => $case,'block' => $block,'partnerblock' => $partnerblock,'casesubtype' => $casesubtype,'asset' => $asset,'public_id' => $public_id,'casecol' => $casecol,'casetype' => $casetype,'block' => $block,'partnerblock' => $partnerblock,'casecatcol' => $casecatcol,'casetypecol' => $casetypecol,'casecat' => $casecat,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Cases::with(['Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id']);
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(10000000000);
    }
    private function validateInput($request) {
        $this->validate($request, [
        //'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
