<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Partner_structure;
use Illuminate\Support\Facades\Auth;
use App\Partner_block;
use App\View;
use App\Asset_cat;
use App\ToolType;
use App\ToolCategory;
use App\Partner_auth;
use App\Http\Controllers\SidebarController;
class PartnerBlockController extends Controller
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
      $partnerstructure = Partner_structure::all();
      $partnerblock = Partner_block::all();
        $data = Partner_block::with(['Partner_block','Partner_structure'])
        ->leftJoin('partner_block as pb', 'pb.under_block', '=', 'partner_block.id')
        ->select('partner_block.*', 'pb.name as block_name')
        ->paginate(30);
      //  return $data;
        return view('system-mgmt/partnerblock/index', ['partnerblock' => $partnerblock,'partnerstructure' => $partnerstructure,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $partnerstructure = Partner_structure::all();
        return view( 'system-mgmt/partnerblock/create',compact('partnerstructure'));
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
      //  return $request->all();
         Partner_block::create([
            'name' => $request['name'],
            'structure_id' => $request['structure_id'],
            'under_block' => $request['under_block'],
            'contact_name' => $request['contact_name'],
            'contact_tel' => $request['contact_tel'],
            'contact_email' => $request['contact_email'],
            'status' => $request['status'],
            'default_pid' => $request['default_pid'],
        ]);
        return redirect ('/admin/partnerblock');
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
      $partnerstructure = Partner_structure::all();
        $data = Partner_block::find($id);
        $datas = Partner_block::all();
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Partner_block::find($id);

            return redirect ('/admin/partnerblock');
        }

        return view( 'system-mgmt/partnerblock/edit', ['datas' => $datas,'partnerstructure' => $partnerstructure,'data' => $data]);
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
          'name' => $request['name'],
          'structure_id' => $request['structure_id'],
          'under_block' => $request['under_block'],
          'contact_name' => $request['contact_name'],
          'contact_tel' => $request['contact_tel'],
          'contact_email' => $request['contact_email'],
          'status' => $request['status'],
          'default_pid' => $request['default_pid'],
        ];
        Partner_block::where('id', $id)
            ->update($input);

        return redirect ('/admin/partnerblock');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Partner_block::where('id', $id)->delete();
        Partner_auth::where('block_id', $id)->delete();

         return redirect ('/admin/partnerblock');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'partner_block.name' => $request['name'],
            'partner_block.structure_id' => $request['structure_id'],
            'partner_block.under_block' => $request['under_block'],
            ];

       $data = $this->doSearchingQuery($constraints);
       $partnerstructure = Partner_structure::all();
       $partnerblock = Partner_block::all();

       return view( 'system-mgmt/partnerblock/index', ['partnerblock' => $partnerblock,'partnerstructure' => $partnerstructure,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query =  Partner_block::with(['Partner_block','Partner_structure'])
                ->leftJoin('partner_block as pb', 'pb.under_block', '=', 'partner_block.id')
                ->select('partner_block.*', 'pb.name as block_name');
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
      //  'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
