<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\CaseAuth;
use App\Cases;
use App\match_id;
use App\Partner_block;
use App\Family;
use App\Member_group;
use App\Pid_group;
use App\Partner_group;
use App\Http\Controllers\SidebarController;
class CaseAuthController extends Controller
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
      $col = CaseAuth::arraycolumn();

      $case = Cases::all();
      $public_id = match_id::all();
      $block = Block::all();
      $partnerblock = Partner_block::all();
      $guildmember =Family::all();
      $membergroup = Member_group::all();
      $pidgroup = Pid_group::all();
      $partnergroup = Partner_group::all();
      $caseauth = CaseAuth::all();
      $data = CaseAuth::with(['Cases','match_id','Partner_block','Block','Family','Member_group','Pid_group','Partner_group'])->paginate(30);
        return view('system-mgmt/case-auth/index',compact(['caseauth','partnergroup','pidgroup','col','data','case','public_id','block','partnerblock','guildmember','membergroup']));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $case = Cases::all();
      $public_id = match_id::all();
      $block = Block::all();
      $partnerblock = Partner_block::all();
      $guildmember =Family::all();
      $membergroup = member_group::all();
      $pidgroup = Pid_group::all();
      $partnergroup = Partner_group::all();
      return view( 'system-mgmt/case-auth/create',compact(['partnergroup','pidgroup','case','public_id','block','partnerblock','guildmember','membergroup']));
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
         CaseAuth::create([
            'case_id' => $request['case_id'],
            'public_id' => $request['public_id'],
            'block_partner' => $request['block_partner'],
            'block_user' => $request['block_user'],
            'guild_member' => $request['guild_member'],
            'group_member' => $request['group_member'],
            'group_pid' => $request['group_pid'],
            'group_partner' => $request['group_partner'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/case-auth');
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
      $case = Cases::all();
      $public_id = match_id::all();
      $block = Block::all();
      $partnerblock = Partner_block::all();
      $guildmember =Family::all();
      $membergroup = member_group::all();
      $pidgroup = Pid_group::all();
      $partnergroup = Partner_group::all();
        $data = CaseAuth::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = CaseAuth::find($id);

            return redirect ('/admin/case-auth');
        }

        return view( 'system-mgmt/case-auth/edit',compact(['partnergroup','pidgroup','case','public_id','block','partnerblock','guildmember','membergroup','data']));
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
        $structure = CaseAuth::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'case_id' => $request['case_id'],
          'public_id' => $request['public_id'],
          'block_partner' => $request['block_partner'],
          'block_user' => $request['block_user'],
          'guild_member' => $request['guild_member'],
          'group_member' => $request['group_member'],
          'group_pid' => $request['group_pid'],
          'group_partner' => $request['group_partner'],
          'description' => $request['description']
        ];
        CaseAuth::where('id', $id)
            ->update($input);

        return redirect ('/admin/case-auth');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CaseAuth::where('id', $id)->delete();
         return redirect ('/admin/case-auth');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
          'case_id' => $request['case_id'],
          'public_id' => $request['public_id'],
          'block_partner' => $request['block_partner'],
          'block_user' => $request['block_user'],
          'guild_member' => $request['guild_member'],
          'group_member' => $request['group_member'],
          'group_pid' => $request['group_pid'],
          'group_partner' => $request['group_partner'],
            ];
            $col = CaseAuth::arraycolumn();

            $case = Cases::all();
            $public_id = match_id::all();
            $block = Block::all();
            $partnerblock = Partner_block::all();
            $guildmember =Family::all();
            $membergroup = Member_group::all();
            $pidgroup = Pid_group::all();
            $partnergroup = Partner_group::all();
            $caseauth = CaseAuth::all();
            $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/case-auth/index', ['caseauth' => $caseauth,'case' => $case,'public_id' => $public_id,'block' => $block,'partnerblock' => $partnerblock,'guildmember' => $guildmember,'membergroup' => $membergroup,'pidgroup' => $pidgroup,'partnergroup' => $partnergroup,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = CaseAuth::with(['Cases','match_id','Partner_block','Block','Family','Member_group','Pid_group','Partner_group']);
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(1000000);
    }
    private function validateInput($request) {
        $this->validate($request, [

    ]);
    }
}
