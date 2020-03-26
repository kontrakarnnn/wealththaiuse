<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

use App\User;
use App\match_view;
use App\match_view_partner;
use App\View;
use App\Viewper;
use App\User_group;
use App\Member_group;
use App\Pid_group;
use App\Structure;
use App\Block;
use App\Organize;
use App\Family;
use App\Person;
use App\Viewpartner;
use App\Partner;
use App\Partner_group;
use App\Partner_structure;
use App\Partner_block;
use App\Http\Controllers\SidebarController;
class MatchViewpartnerController extends Controller
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

    public function index()
    {
      //sidebar
  $tree = session()->get('tree');
  //sidebar
    $viewpartner = Viewpartner::all();
    $partner = Partner::all();
    $pidgroup = Pid_group::all();
    $partnergroup = Partner_group::all();
    $partnerstructure = Partner_structure::all();
    $partnerblock = Partner_block::all();
		$matchviews =match_view_partner::with(['Partner_structure','Partner_block','Viewpartner','Partner','Pid_group'])
  /*  ->leftJoin('partner_block as mp', 'match_view_partner.block_td', '=', 'mp.id')
    ->leftJoin('partner_block as btu', 'match_view_partner.block_btu', '=', 'btu.id')
    ->select('match_view_partner.*', 'mp.name as block_topdown', 'btu.name as block_bottomup')*/
    ->paginate(30);
     return view('system-mgmt/match-view-partner/index', ['partnerstructure' => $partnerstructure,
                                                          'partnerblock' => $partnerblock,
                                                          'partnergroup' => $partnergroup,
                                                          'viewpartner' => $viewpartner,
                                                          'pidgroup' => $pidgroup,'partner' => $partner,
                                                          'matchviews' => $matchviews,'tree' =>$tree]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {

       //sidebar

       $tree = session()->get('tree');
       //sidebar


       $views = Viewpartner::all();

       $member_groups = Member_group::all();
       $pid_groups = Pid_group::all();
       $orgs = Person::where('type',2)->get();
       $members = Partner::all();
       $groups = Family::all();
       $partnergroup = Partner_group::all();
       $partnerstructure = Partner_structure::all();
       $partnerblock = Partner_block::all();
       $matchviews = match_view_partner::all();

        return view('system-mgmt/match-view-partner/create', [
                                                        'orgs' => $orgs,
                                                        'partnerstructure' => $partnerstructure,
                                                        'partnerblock' => $partnerblock,
                                                        'partnergroup' => $partnergroup,
                                                        'members' => $members,
                                                        'groups' => $groups,
                                                        'matchviews' => $matchviews,
                                                        'member_groups' => $member_groups,
                                                        'pid_groups' => $pid_groups,
													  	                          'tree'=>$tree,
                                                        'views' => $views
                                                        ]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {


       //Person::findOrFail($request['member_id']); ใช้เพื่อทำให้ก่อนจะบันทึกต้องมีข้อมูลในตารางนี้ด้วย
      // User::findOrFail($request['user_id']);

       $this->validateInput($request,[

      //'description' => 'nullable|string|max:60'

      ]);
        match_view_partner::create([

          'view_id' => $request['view_id'],
          'pid_group_id' => $request['pid_group_id'],
          'all_partner' => $request['all_partner'],
          'partner_id' => $request['partner_id'],
          'structure_id' => $request['structure_id'],
          'block_id' => $request['block_id'],
          'block_td' => $request['block_td'],
          'block_btu' => $request['block_btu'],
          'partner_group_id' => $request['partner_group_id'],


       ]);


         return redirect ('/admin/match-view-partner');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */



     public function edit($id)
     {

       //sidebar

 $tree = session()->get('tree');
 //sidebar

         $matchview = match_view_partner::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($matchview == null) {
           $matchview = match_view_partner::find($id);
           $data = array(
               'matchview' => $matchview
             );
             return redirect ('/admin/match-view-partner');
           }


            $views = Viewpartner::all();

            $pid_groups = Pid_group::all();
            $members = Partner::all();
            $partnergroup = Partner_group::all();
            $partnerstructure = Partner_structure::all();
            $partnerblock = Partner_block::all();
         return view('system-mgmt/match-view-partner/edit',
                                                          ['partnergroup' => $partnergroup,
                                                           'partnerstructure' => $partnerstructure,
                                                           'partnerblock' => $partnerblock,
                                                           'members' => $members,
                                                           'matchview' => $matchview,
                                                           'views' => $views,
                                                           'pid_groups' => $pid_groups,
                                                           'tree'=>$tree]);
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
         $matchid = match_view_partner::findOrFail($id);
         $input = [
           'view_id' => $request['view_id'],
           'pid_group_id' => $request['pid_group_id'],
           'all_partner' => $request['all_partner'],
           'structure_id' => $request['structure_id'],
           'block_id' => $request['block_id'],
           'block_td' => $request['block_td'],
           'block_btu' => $request['block_btu'],
           'partner_id' => $request['partner_id'],
           'partner_group_id' => $request['partner_group_id'],
         ];
         $this->validate($request, [

         ]);
         match_view_partner::where('id', $id)
             ->update($input);

         return redirect ('/admin/match-view-partner');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         match_view_partner::where('id', $id)->delete();
          return redirect('/admin/match-view-partner');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */
     public function search(Request $request) {

       //sidebar

   $tree = session()->get('tree');
   //sidebar


          $constraints = [

            'partner_id' => $request['partner_id'],
            'view_id' => $request['view_id'],
			      'pid_group_id' => $request['pid_group_id'],
            'partner_group_id' => $request['partner_group_id'],
            'structure_id' => $request['partner_group_id'],
            'block_id' => $request['partner_group_id'],
            'block_td' => $request['block_td'],
            'block_btu' => $request['block_btu'],


             ];

             $viewpartner = Viewpartner::all();
             $partner = Partner::all();
             $pidgroup = Pid_group::all();
             $partnergroup = Partner_group::all();
             $partnerstructure = Partner_structure::all();
             $partnerblock = Partner_block::all();

        $matchviews = $this->doSearchingQuery($constraints);

        return view('system-mgmt/match-view-partner/index', ['partnerstructure' => $partnerstructure,
                                                             'partnerblock' => $partnerblock,
                                                             'partnergroup' => $partnergroup,
                                                             'viewpartner' => $viewpartner,
                                                             'partner' => $partner,
                                                             'pidgroup' => $pidgroup,
                                                             'matchviews' => $matchviews,
                                                             'searchingVals' => $constraints]);
     }

     private function doSearchingQuery($constraints) {
       //sidebar

$tree = session()->get('tree');
//sidebar

    $query = match_view_partner::with(['Viewpartner','Partner','Pid_group']);

         $fields = array_keys($constraints);
         $index = 0;
         foreach ($constraints as $constraint) {
             if ($constraint != null) {
                 $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
             }

             $index++;
         }
         return $query->paginate(1000);
     }
     private function validateInput($request) {
         $this->validate($request, [


     ]);
     }
 }
