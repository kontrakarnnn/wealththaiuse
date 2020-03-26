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
use App\Path;
use App\Proposal;
use App\match_id;
use App\Partner_block;
use App\Person;
use App\Cases;

use App\Http\Controllers\SidebarController;
class ProposalController extends Controller
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
        $data = Proposal::paginate(30);
        //return data;
        $publicid = match_id::all();
        $partnerblock = Partner_block::all();
        $userblock = Block::all();
        $member = Person::all();
        $cases = Cases::all();
        $proposal = Proposal::all();

        return view('system-mgmt/proposal/index',compact(['proposal','cases','publicid','partnerblock','userblock','member','data']));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $publicid = match_id::all();
      $partnerblock = Partner_block::all();
      $userblock = Block::all();
      $member = Person::all();
      $cases = Cases::all();
        return view( 'system-mgmt/proposal/create',compact(['cases','publicid','partnerblock','userblock','member']));
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
         Proposal::create([
           'name' => $request['name'],
           'case_id' => $request['case_id'],
           'created_date' => $date,
           'created_by' => $request['created_by'],
           'partner_block' => $request['partner_block'],
           'user_block' => $request['user_block'],
           'member_id' => $request['member_id'],
           'description' => $request['description'],
        ]);
        return redirect ('/admin/proposal');
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
        $data = Proposal::find($id);

        $publicid = match_id::all();
        $partnerblock = Partner_block::all();
        $userblock = Block::all();
        $member = Person::all();
        $cases = Cases::all();
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Proposal::find($id);

            return redirect ('/admin/proposal');
        }

        return view( 'system-mgmt/proposal/edit',compact(['cases','publicid','partnerblock','userblock','member','data']));
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
        $structure = Proposal::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'case_id' => $request['case_id'],
          'created_by' => $request['created_by'],
          'partner_block' => $request['partner_block'],
          'user_block' => $request['user_block'],
          'member_id' => $request['member_id'],
          'description' => $request['description'],
        ];
        Proposal::where('id', $id)
            ->update($input);

        return redirect ('/admin/proposal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proposal::where('id', $id)->delete();
         return redirect ('/admin/proposal');
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
          'case_id' => $request['case_id'],
          'created_date' => $request['created_date'],
          'created_by' => $request['created_by'],
          'partner_block' => $request['partner_block'],
          'user_block' => $request['user_block'],
          'member_id' => $request['member_id'],
          'description' => $request['description'],
            ];
            $publicid = match_id::all();
            $partnerblock = Partner_block::all();
            $userblock = Block::all();
            $member = Person::all();
            $cases = Cases::all();
            $proposal = Proposal::all();
            $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/proposal/index',['publicid' => $publicid,'partnerblock' => $partnerblock,'userblock' => $userblock,'member' => $member,'cases' => $cases,'proposal' => $proposal,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Proposal::query();
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
