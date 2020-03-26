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
use App\Procedures;
use App\OfferCategory;


use App\Http\Controllers\SidebarController;
class CaseTypeController extends Controller
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
      $block = Block::all();
      $partnerblock = Partner_block::all();
      $casecatcol = CaseCategory::casecategory();
      $casecat = CaseCategory::all();
      $casetypecol = CaseType::arraycolumn();
      $partnergroup = Partner_group::all();
      $casetypeconfig = CaseTypeConfig::all();
      $procedure = Procedures::all();
      $offercategory = OfferCategory::all();
      $casetype =  CaseType::with(['CaseCategory','Partner_block','Block'])->get();
      $data = CaseType::with(['offercategory','Partner_group','CaseCategory','Partner_block','Block'])->paginate(30);
      return view('system-mgmt/case-type/index', ['offercategory' => $offercategory,'procedure' => $procedure,'casetypeconfig' => $casetypeconfig,'partnergroup' => $partnergroup,'casetype' => $casetype,'block' => $block,'partnerblock' => $partnerblock,'casecatcol' => $casecatcol,'casetypecol' => $casetypecol,'casecat' => $casecat,'data' => $data]);
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
        $casetypeconfig = CaseTypeConfig::all();
        $procedure = Procedures::all();
        $offercategory = OfferCategory::all();
        return view( 'system-mgmt/case-type/create',compact('offercategory','procedure','casetypeconfig','partnergroup','block','partnerblock','casecat'));
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
         CaseType::create([
            'name' => $request['name'],
            'offer_cat' => $request['offer_cat'],
            'case_cat_id' => $request['case_cat_id'],
            'day_auto_renew' => $request['day_auto_renew'],
            'default_partner_block_id' => $request['default_partner_block_id'],
            'default_user_block_id' => $request['default_user_block_id'],
            'default_procedure_id' => $request['default_procedure_id'],
            'default_partner_group' => $request['default_partner_group'],
            'description' => $request['description'],
            'case_type_config' => $request['case_type_config'],
            'requirename_var1' => $request['requirename_var1'],
            'requirename_var2' => $request['requirename_var2'],
            'requirename_var3' => $request['requirename_var3'],
            'requirename_var4' => $request['requirename_var4'],
            'requirename_var5' => $request['requirename_var5'],
            'requirename_var6' => $request['requirename_var6'],
            'requirename_var7' => $request['requirename_var7'],
            'requirename_var8' => $request['requirename_var8'],
            'requirename_var9' => $request['requirename_var9'],
            'requirename_var10' => $request['requirename_var10'],
            'requirename_var11' => $request['requirename_var11'],
            'requirename_var12' => $request['requirename_var12'],
            'requirename_var13' => $request['requirename_var13'],
            'requirename_var14' => $request['requirename_var14'],
            'requirename_var15' => $request['requirename_var15'],
            'requirename_var16' => $request['requirename_var16'],
            'requirename_var17' => $request['requirename_var17'],
            'requirename_var18' => $request['requirename_var18'],
            'requirename_var19' => $request['requirename_var19'],
            'requirename_var20' => $request['requirename_var20'],


            'var_name1' => $request['var_name1'],
            'var_name2' => $request['var_name2'],
            'var_name3' => $request['var_name3'],
            'var_name4' => $request['var_name4'],
            'var_name5' => $request['var_name5'],
            'var_name6' => $request['var_name6'],
            'var_name7' => $request['var_name7'],
            'var_name8' => $request['var_name8'],
            'var_name9' => $request['var_name9'],
            'var_name10' => $request['var_name10'],
            'var_name11' => $request['var_name11'],
            'var_name12' => $request['var_name12'],
            'var_name13' => $request['var_name13'],
            'var_name14' => $request['var_name14'],
            'var_name15' => $request['var_name15'],
            'var_name16' => $request['var_name16'],
            'var_name17' => $request['var_name17'],
            'var_name18' => $request['var_name18'],
            'var_name19' => $request['var_name19'],
            'var_name20' => $request['var_name20'],
            'var_name21' => $request['var_name21'],
            'var_name22' => $request['var_name22'],
            'var_name23' => $request['var_name23'],
            'var_name24' => $request['var_name24'],
            'var_name25' => $request['var_name25'],
            'var_name26' => $request['var_name26'],
            'var_name27' => $request['var_name27'],
            'var_name28' => $request['var_name28'],
            'var_name29' => $request['var_name29'],
            'var_name30' => $request['var_name30'],
            'var_name31' => $request['var_name31'],
            'var_name32' => $request['var_name32'],
            'var_name33' => $request['var_name33'],
            'var_name34' => $request['var_name34'],
            'var_name35' => $request['var_name35'],
            'var_name36' => $request['var_name36'],
            'var_name37' => $request['var_name37'],
            'var_name38' => $request['var_name38'],
            'var_name39' => $request['var_name39'],
            'var_name40' => $request['var_name40'],
            'var_name41' => $request['var_name41'],
            'var_name42' => $request['var_name42'],
            'var_name43' => $request['var_name43'],
            'var_name44' => $request['var_name44'],
            'var_name45' => $request['var_name45'],
            'var_name46' => $request['var_name46'],
            'var_name47' => $request['var_name47'],
            'var_name48' => $request['var_name48'],
            'var_name49' => $request['var_name49'],
            'var_name50' => $request['var_name50'],
            'var_name51' => $request['var_name51'],
            'var_name52' => $request['var_name52'],
            'var_name53' => $request['var_name53'],
            'var_name54' => $request['var_name54'],
            'var_name55' => $request['var_name55'],
            'var_name56' => $request['var_name56'],
            'var_name57' => $request['var_name57'],
            'var_name58' => $request['var_name58'],
            'var_name59' => $request['var_name59'],
            'var_name60' => $request['var_name60'],
            'var_name61' => $request['var_name61'],
            'var_name62' => $request['var_name62'],
            'var_name63' => $request['var_name63'],
            'var_name64' => $request['var_name64'],
            'var_name65' => $request['var_name65'],
            'var_name66' => $request['var_name66'],
            'var_name67' => $request['var_name67'],
            'var_name68' => $request['var_name68'],
            'var_name69' => $request['var_name69'],
            'var_name70' => $request['var_name70'],
            'var_name71' => $request['var_name71'],
            'var_name72' => $request['var_name72'],
            'var_name73' => $request['var_name73'],
            'var_name74' => $request['var_name74'],
            'var_name75' => $request['var_name75'],
            'var_name76' => $request['var_name76'],
            'var_name77' => $request['var_name77'],
            'var_name78' => $request['var_name78'],
            'var_name79' => $request['var_name79'],
            'var_name80' => $request['var_name80'],
            'var_name81' => $request['var_name81'],
            'var_name82' => $request['var_name82'],
            'var_name83' => $request['var_name83'],
            'var_name84' => $request['var_name84'],
            'var_name85' => $request['var_name85'],
            'var_name86' => $request['var_name86'],
            'var_name87' => $request['var_name87'],
            'var_name88' => $request['var_name88'],
            'var_name89' => $request['var_name89'],
            'var_name90' => $request['var_name90'],
            'var_name91' => $request['var_name91'],
            'var_name92' => $request['var_name92'],
            'var_name93' => $request['var_name93'],
            'var_name94' => $request['var_name94'],
            'var_name95' => $request['var_name95'],
            'var_name96' => $request['var_name96'],
            'var_name97' => $request['var_name97'],
            'var_name98' => $request['var_name98'],
            'var_name99' => $request['var_name99'],
            'var_name100' => $request['var_name100'],
            'var_name101' => $request['var_name101'],
            'var_name102' => $request['var_name102'],
            'var_name103' => $request['var_name103'],
            'var_name104' => $request['var_name104'],
            'var_name105' => $request['var_name105'],
            'var_name106' => $request['var_name106'],
            'var_name107' => $request['var_name107'],
            'var_name108' => $request['var_name108'],
            'var_name109' => $request['var_name109'],
            'var_name110' => $request['var_name110'],
            'var_name111' => $request['var_name111'],
            'var_name112' => $request['var_name112'],
            'var_name113' => $request['var_name113'],
            'var_name114' => $request['var_name114'],
            'var_name115' => $request['var_name115'],
            'var_name116' => $request['var_name116'],
            'var_name117' => $request['var_name117'],
            'var_name118' => $request['var_name118'],
            'var_name119' => $request['var_name119'],
            'var_name120' => $request['var_name120'],
            'var_name121' => $request['var_name121'],
            'var_name122' => $request['var_name122'],
            'var_name123' => $request['var_name123'],
            'var_name124' => $request['var_name124'],
            'var_name125' => $request['var_name125'],
            'var_name126' => $request['var_name126'],
            'var_name127' => $request['var_name127'],
            'var_name128' => $request['var_name128'],
            'var_name129' => $request['var_name129'],
            'var_name130' => $request['var_name130'],






        ]);
        return redirect ('/admin/case-type');
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
      return view( 'system-mgmt/case-type/index', compact(['structures','blocks','tree']));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $casetypeconfig = CaseTypeConfig::all();
      $procedure = Procedures::all();
      $casecatcol = CaseCategory::casecategory();
      $casetypecol = CaseType::arraycolumn();
      $block = Block::all();
      $partnerblock = Partner_block::all();
      $partnergroup = Partner_group::all();
      $casecat = CaseCategory::all();
      $offercategory = OfferCategory::all();

        $data = CaseType::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = CaseType::find($id);

            return redirect ('/admin/case-type');
        }
        return view( 'system-mgmt/case-type/edit', ['offercategory' => $offercategory,'procedure' => $procedure,'casetypeconfig' => $casetypeconfig,'partnergroup' => $partnergroup,'casecatcol' => $casecatcol,'casetypecol' => $casetypecol,'block' => $block,'partnerblock' => $partnerblock,'casecat' => $casecat,'data' => $data]);
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
          'offer_cat' => $request['offer_cat'],
          'case_cat_id' => $request['case_cat_id'],
          'case_type_config' => $request['case_type_config'],
          'day_auto_renew' => $request['day_auto_renew'],
          'default_partner_block_id' => $request['default_partner_block_id'],
          'default_user_block_id' => $request['default_user_block_id'],
          'default_procedure_id' => $request['default_procedure_id'],
          'default_partner_group' => $request['default_partner_group'],
          'description' => $request['description'],
          'requirename_var1' => $request['requirename_var1'],
          'requirename_var2' => $request['requirename_var2'],
          'requirename_var3' => $request['requirename_var3'],
          'requirename_var4' => $request['requirename_var4'],
          'requirename_var5' => $request['requirename_var5'],
          'requirename_var6' => $request['requirename_var6'],
          'requirename_var7' => $request['requirename_var7'],
          'requirename_var8' => $request['requirename_var8'],
          'requirename_var9' => $request['requirename_var9'],
          'requirename_var10' => $request['requirename_var10'],
          'requirename_var11' => $request['requirename_var11'],
          'requirename_var12' => $request['requirename_var12'],
          'requirename_var13' => $request['requirename_var13'],
          'requirename_var14' => $request['requirename_var14'],
          'requirename_var15' => $request['requirename_var15'],
          'requirename_var16' => $request['requirename_var16'],
          'requirename_var17' => $request['requirename_var17'],
          'requirename_var18' => $request['requirename_var18'],
          'requirename_var19' => $request['requirename_var19'],
          'requirename_var20' => $request['requirename_var20'],
          'var_name1' => $request['var_name1'],
          'var_name2' => $request['var_name2'],
          'var_name3' => $request['var_name3'],
          'var_name4' => $request['var_name4'],
          'var_name5' => $request['var_name5'],
          'var_name6' => $request['var_name6'],
          'var_name7' => $request['var_name7'],
          'var_name8' => $request['var_name8'],
          'var_name9' => $request['var_name9'],
          'var_name10' => $request['var_name10'],
          'var_name11' => $request['var_name11'],
          'var_name12' => $request['var_name12'],
          'var_name13' => $request['var_name13'],
          'var_name14' => $request['var_name14'],
          'var_name15' => $request['var_name15'],
          'var_name16' => $request['var_name16'],
          'var_name17' => $request['var_name17'],
          'var_name18' => $request['var_name18'],
          'var_name19' => $request['var_name19'],
          'var_name20' => $request['var_name20'],
          'var_name21' => $request['var_name21'],
          'var_name22' => $request['var_name22'],
          'var_name23' => $request['var_name23'],
          'var_name24' => $request['var_name24'],
          'var_name25' => $request['var_name25'],
          'var_name26' => $request['var_name26'],
          'var_name27' => $request['var_name27'],
          'var_name28' => $request['var_name28'],
          'var_name29' => $request['var_name29'],
          'var_name30' => $request['var_name30'],
          'var_name31' => $request['var_name31'],
          'var_name32' => $request['var_name32'],
          'var_name33' => $request['var_name33'],
          'var_name34' => $request['var_name34'],
          'var_name35' => $request['var_name35'],
          'var_name36' => $request['var_name36'],
          'var_name37' => $request['var_name37'],
          'var_name38' => $request['var_name38'],
          'var_name39' => $request['var_name39'],
          'var_name40' => $request['var_name40'],
          'var_name41' => $request['var_name41'],
          'var_name42' => $request['var_name42'],
          'var_name43' => $request['var_name43'],
          'var_name44' => $request['var_name44'],
          'var_name45' => $request['var_name45'],
          'var_name46' => $request['var_name46'],
          'var_name47' => $request['var_name47'],
          'var_name48' => $request['var_name48'],
          'var_name49' => $request['var_name49'],
          'var_name50' => $request['var_name50'],
          'var_name51' => $request['var_name51'],
          'var_name52' => $request['var_name52'],
          'var_name53' => $request['var_name53'],
          'var_name54' => $request['var_name54'],
          'var_name55' => $request['var_name55'],
          'var_name56' => $request['var_name56'],
          'var_name57' => $request['var_name57'],
          'var_name58' => $request['var_name58'],
          'var_name59' => $request['var_name59'],
          'var_name60' => $request['var_name60'],
          'var_name61' => $request['var_name61'],
          'var_name62' => $request['var_name62'],
          'var_name63' => $request['var_name63'],
          'var_name64' => $request['var_name64'],
          'var_name65' => $request['var_name65'],
          'var_name66' => $request['var_name66'],
          'var_name67' => $request['var_name67'],
          'var_name68' => $request['var_name68'],
          'var_name69' => $request['var_name69'],
          'var_name70' => $request['var_name70'],
          'var_name71' => $request['var_name71'],
          'var_name72' => $request['var_name72'],
          'var_name73' => $request['var_name73'],
          'var_name74' => $request['var_name74'],
          'var_name75' => $request['var_name75'],
          'var_name76' => $request['var_name76'],
          'var_name77' => $request['var_name77'],
          'var_name78' => $request['var_name78'],
          'var_name79' => $request['var_name79'],
          'var_name80' => $request['var_name80'],
          'var_name81' => $request['var_name81'],
          'var_name82' => $request['var_name82'],
          'var_name83' => $request['var_name83'],
          'var_name84' => $request['var_name84'],
          'var_name85' => $request['var_name85'],
          'var_name86' => $request['var_name86'],
          'var_name87' => $request['var_name87'],
          'var_name88' => $request['var_name88'],
          'var_name89' => $request['var_name89'],
          'var_name90' => $request['var_name90'],
          'var_name91' => $request['var_name91'],
          'var_name92' => $request['var_name92'],
          'var_name93' => $request['var_name93'],
          'var_name94' => $request['var_name94'],
          'var_name95' => $request['var_name95'],
          'var_name96' => $request['var_name96'],
          'var_name97' => $request['var_name97'],
          'var_name98' => $request['var_name98'],
          'var_name99' => $request['var_name99'],
          'var_name100' => $request['var_name100'],
          'var_name101' => $request['var_name101'],
          'var_name102' => $request['var_name102'],
          'var_name103' => $request['var_name103'],
          'var_name104' => $request['var_name104'],
          'var_name105' => $request['var_name105'],
          'var_name106' => $request['var_name106'],
          'var_name107' => $request['var_name107'],
          'var_name108' => $request['var_name108'],
          'var_name109' => $request['var_name109'],
          'var_name110' => $request['var_name110'],
          'var_name111' => $request['var_name111'],
          'var_name112' => $request['var_name112'],
          'var_name113' => $request['var_name113'],
          'var_name114' => $request['var_name114'],
          'var_name115' => $request['var_name115'],
          'var_name116' => $request['var_name116'],
          'var_name117' => $request['var_name117'],
          'var_name118' => $request['var_name118'],
          'var_name119' => $request['var_name119'],
          'var_name120' => $request['var_name120'],
          'var_name121' => $request['var_name121'],
          'var_name122' => $request['var_name122'],
          'var_name123' => $request['var_name123'],
          'var_name124' => $request['var_name124'],
          'var_name125' => $request['var_name125'],
          'var_name126' => $request['var_name126'],
          'var_name127' => $request['var_name127'],
          'var_name128' => $request['var_name128'],
          'var_name129' => $request['var_name129'],
          'var_name130' => $request['var_name130'],
        ];
        CaseType::where('id', $id)
            ->update($input);

        return redirect ('/admin/case-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CaseType::where('id', $id)->delete();
         return redirect ('/admin/case-type');
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
            'case_cat_id' => $request['case_cat_id'],
            'offer_cat' => $request['offer_cat'],
            'default_partner_block_id' => $request['default_partner_block_id'],
            'default_user_block_id' => $request['default_user_block_id'],
            'default_partner_group' => $request['default_partner_group'],
            ];

       $data = $this->doSearchingQuery($constraints);
       $casetypeconfig = CaseTypeConfig::all();
       $procedure = Procedures::all();
       $casecat = CaseCategory::all();
       $block = Block::all();
       $partnerblock = Partner_block::all();
       $casecatcol = CaseCategory::casecategory();
       $casetypecol = CaseType::arraycolumn();
       $offercategory = OfferCategory::all();

       $partnergroup = Partner_group::all();
      $casetype =  CaseType::with(['CaseCategory','Partner_block','Block'])->get();
       return view( 'system-mgmt/case-type/index', ['offercategory' => $offercategory,'procedure' => $procedure,'casetypeconfig' => $casetypeconfig,'partnergroup' => $partnergroup,'casetype' => $casetype,'block' => $block,'partnerblock' => $partnerblock,'casecatcol' => $casecatcol,'casetypecol' => $casetypecol,'casecat' => $casecat,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = CaseType::with(['CaseCategory','Partner_block','Block']);
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
