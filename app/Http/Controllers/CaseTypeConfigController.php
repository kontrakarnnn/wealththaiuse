<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\CaseType;
use App\CaseCategory;
use App\Partner_block;
use App\Partner_group;
use App\CaseTypeConfig;


use App\Http\Controllers\SidebarController;
class CaseTypeConfigController extends Controller
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
      $typeconfig = CaseTypeConfig::all();
      $data = CaseTypeConfig::paginate(30);
        return view('system-mgmt/case-type-config/index', ['typeconfig' => $typeconfig,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $block = Block::all();
      $partnerblock = Partner_block::all();
        $casecat = CaseCategory::all();
        $partnergroup = Partner_group::all();

        return view( 'system-mgmt/case-type-config/create',compact('partnergroup','block','partnerblock','casecat'));
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
         CaseTypeConfig::create([
           'sub_type_config_name' => $request['sub_type_config_name'],
           'config_label1' => $request['config_label1'],
           'config_label2' => $request['config_label2'],
           'config_label3' => $request['config_label3'],
           'config_label4' => $request['config_label4'],
           'config_label5' => $request['config_label5'],
           'config_label6' => $request['config_label6'],
           'config_label7' => $request['config_label7'],
           'config_label8' => $request['config_label8'],
           'config_label9' => $request['config_label9'],
           'config_label10' => $request['config_label10'],
           'config_value1' => $request['config_value1'],
           'config_value2' => $request['config_value2'],
           'config_value3' => $request['config_value3'],
           'config_value4' => $request['config_value4'],
           'config_value5' => $request['config_value5'],
           'config_value6' => $request['config_value6'],
           'config_value7' => $request['config_value7'],
           'config_value8' => $request['config_value8'],
           'config_value9' => $request['config_value9'],
           'config_value10' => $request['config_value10'],
           'description' => $request['description'],
        ]);
        return redirect ('/admin/case-type-config');
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
      return view( 'system-mgmt/case-type-config/index', compact(['structures','blocks','tree']));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = CaseTypeConfig::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = CaseTypeConfig::find($id);

            return redirect ('/admin/case-type-config');
        }

        return view( 'system-mgmt/case-type-config/edit', ['data' => $data]);
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
          'sub_type_config_name' => $request['sub_type_config_name'],
          'config_label1' => $request['config_label1'],
          'config_label2' => $request['config_label2'],
          'config_label3' => $request['config_label3'],
          'config_label4' => $request['config_label4'],
          'config_label5' => $request['config_label5'],
          'config_label6' => $request['config_label6'],
          'config_label7' => $request['config_label7'],
          'config_label8' => $request['config_label8'],
          'config_label9' => $request['config_label9'],
          'config_label10' => $request['config_label10'],
          'config_value1' => $request['config_value1'],
          'config_value2' => $request['config_value2'],
          'config_value3' => $request['config_value3'],
          'config_value4' => $request['config_value4'],
          'config_value5' => $request['config_value5'],
          'config_value6' => $request['config_value6'],
          'config_value7' => $request['config_value7'],
          'config_value8' => $request['config_value8'],
          'config_value9' => $request['config_value9'],
          'config_value10' => $request['config_value10'],
          'description' => $request['description'],

        ];
        CaseTypeConfig::where('id', $id)
            ->update($input);

        return redirect ('/admin/case-type-config');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CaseTypeConfig::where('id', $id)->delete();
         return redirect ('/admin/case-type-config');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'sub_type_config_name' => $request['sub_type_config_name'],

            ];

       $data = $this->doSearchingQuery($constraints);
       $typeconfig = CaseTypeConfig::all();

       return view( 'system-mgmt/case-type-config/index', ['typeconfig' => $typeconfig,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = CaseTypeConfig::query();
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
