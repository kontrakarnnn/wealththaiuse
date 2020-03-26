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
use App\Case_proposal;
use App\Cases;
use App\Proposal;
use App\Offer;
use App\Asset;

use App\Http\Controllers\SidebarController;
class CaseProposalController extends Controller
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
        $data = Case_proposal::paginate(30);
        $case = Cases::all();
        $proposal = Proposal::all();
        $offer = Offer::all();
        $asset = Asset::all();
        $caseproposal = Case_proposal::all();

        return view('system-mgmt/caseproposal/index', ['caseproposal' => $caseproposal,'proposal' => $proposal,'asset' => $asset,'offer' => $offer,'case' => $case,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $case = Cases::all();
      $proposal = Proposal::all();
      $offer = Offer::all();
      $asset = Asset::all();
        return view( 'system-mgmt/caseproposal/create',compact(['offer','asset','case','proposal']));
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
         Case_proposal::create([

           'case_id' => $request['case_id'],
           'proposal_id' => $request['proposal_id'],
           'offer_id' => $request['offer_id'],
           'asset_id' => $request['asset_id'],
           'description' => $request['description']
        ]);
        return redirect ('/admin/caseproposal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      //sidebar

$tree = session()->get('tree');
//sidebar


      $blocks = Structure::find($id)->portfolio;
      $structures = Structure::paginate(5);
      return view( 'system-mgmt/condition/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Case_proposal::find($id);
        $case = Cases::all();
        $proposal = Proposal::all();
        $offer = Offer::all();
        $asset = Asset::all();

        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Case_proposal::find($id);

            return redirect ('/admin/caseproposal');
        }

        return view( 'system-mgmt/caseproposal/edit', ['proposal' => $proposal,'offer' => $offer,'asset' => $asset,'case' => $case,'data' => $data]);
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
        $this->validateInput($request);
        $input = [
          'case_id' => $request['case_id'],
          'proposal_id' => $request['proposal_id'],
          'offer_id' => $request['offer_id'],
          'asset_id' => $request['asset_id'],
          'description' => $request['description']
        ];
        Case_proposal::where('id', $id)
            ->update($input);

        return redirect ('/admin/caseproposal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Case_proposal::where('id', $id)->delete();
         return redirect ('/admin/caseproposal');
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
          'proposal_id' => $request['proposal_id'],
          'offer_id' => $request['offer_id'],
          'asset_id' => $request['asset_id'],
            ];
            $case = Cases::all();
            $proposal = Proposal::all();
            $offer = Offer::all();
            $asset = Asset::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/caseproposal/index', ['asset' => $asset,'offer' => $offer,'proposal' => $proposal,'case' => $case,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Case_proposal::query();
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
        //'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
