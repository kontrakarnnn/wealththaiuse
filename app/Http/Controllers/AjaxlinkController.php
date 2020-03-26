<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Department;
use App\Division;
use App\User;
use App\Person;
use App\Asset_type;
use App\Asset;
use App\View;
use App\Asset_Transaction;
use App\Block;
use App\Party;
use App\Province;
use App\District;
use App\Subdistrict;
use App\FileSubCat;
use App\FilePackagecat;
use App\ToolSet;
use App\Partner_block;
use App\CaseType;
use App\Condition;
use App\OfferType;
use App\Action;
use App\Campaign;

use App\Path_condition_detail;
class AjaxlinkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function findFileCat(Request $request){
     $data=FilePackagecat::leftJoin('file_category','file_package_cat.cat_id', '=','file_category.id')
     ->select('file_package_cat.*','file_category.name as file_category_name','file_category.id as file_category_id')->where('package_id',$request->id) ->get();
     return response()->json($data);
     }

     public function findFileCategory(Request $request){
     $data=FileSubCat::select('*')->where('id',$request->id) ->get();
     return response()->json($data);
     }

     public function findAssetLabel(Request $request){
     $data=Asset_type::select('ref_info_head1','ref_info_head2','ref_info_head3','ref_info_head4','ref_info_head5','ref_info_head6','ref_info_head7','ref_info_head8')->where('id',$request->id) ->get();
     return response()->json($data);
     }

     public function findAssetRef(Request $request){
     $data=Asset_type::select('ref_info_head1','ref_info_head2','ref_info_head3','ref_info_head4','ref_info_head5','ref_info_head6','ref_info_head7','ref_info_head8')->where('id',$request->id) ->get();
     return response()->json($data);
     }

     public function findPortnum(Request $request){
     $data=Portfolio::select('id')->where('id',$request->id) ->get();
     return response()->json($data);
     }

     public function findPortMember(Request $request){
     $data=Portfolio::select('id','type','number')->where('member_id',$request->id) ->get();
     return response()->json($data);
     }

     public function findPortAsset(Request $request){
       $data= DB::table('asset')
       ->leftJoin('asset_type','asset.la_nla_type', '=','asset_type.id')
       ->where('asset_type.la_nla','=','Non Liquidity Asset')
       ->where('asset.port_id',$request->id)
       ->select('asset.name','asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8')
        ->get();
     return response()->json($data);
     }
     public function findMemId(Request $request){
     $data=Person::select('id','name','lname')->where('id',$request->id) ->get();
     return response()->json($data);
     }
     public function findMemRefid(Request $request){
     $data=Person::select('id','name','lname')->where('id',$request->id) ->get();
     return response()->json($data);
     }
     public function findAssetType(Request $request){
     $data= DB::table('asset')
     ->leftJoin('asset_type','asset.la_nla_type', '=','asset_type.id')
     ->where('asset_type.la_nla','=','Non Liquidity Asset')
     ->where('asset.id',$request->id)
     ->select('asset.name','asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8')
      ->get();
     return response()->json($data);
     }

     public function findMemType(Request $request){
     $data= DB::table('persons')
     ->where('type',$request->id)
     ->get();
     return response()->json($data);
     }

     public function findPartyName(Request $request){
       $data=Party::select('name','id')->where('member_group_id',$request->id)->get();
       return response()->json($data);
     }

     public function findDistrict(Request $request){
     $data=District::select('name_in_thai','name_in_english','id')->where('province_id',$request->id) ->get();
     return response()->json($data);
     }
     public function findProvince(Request $request){
     $data=Province::select('name_in_thai','name_in_english','id')->where('country_id',$request->id) ->get();
     return response()->json($data);
     }
     public function findSubdistrict(Request $request){
     $data=SubDistrict::select('name_in_thai','name_in_english','id')->where('district_id',$request->id) ->get();
     return response()->json($data);
     }
	     public function findToolSet(Request $request){
     $data=ToolSet::select('*')->where('tool_id',$request->id) ->get();
     return response()->json($data);
     }

     public function findpartnerblock(Request $request){
       $data=Partner_block::select('*')->where('structure_id',$request->id)->get();
       return response()->json($data);
     }


     public function findCaseType(Request $request){
     $data= CaseType::join('partner_block','case_type.default_partner_block_id','=','partner_block.id')
     ->leftJoin('block as bu','case_type.default_user_block_id','=','bu.id')
     ->leftJoin('partner_group','case_type.default_partner_group','=','partner_group.id')
     ->where('case_type.id',$request->id)->select('*','bu.name as bu_name','partner_group.name as partner_group_name','partner_block.name as partner_block_name')->get();
     return response()->json($data);
     }

     public function findCondition(Request $request){
     $data= Condition::select('*')->where('id',$request->id)->get();
     return response()->json($data);
     }
     public function AssetTypeInfo(Request $request){
     $data= Asset_type::select('*')->where('id',$request->id)->get();
     return response()->json($data);
     }

     public function findOfferType(Request $request){
     $data= OfferType::select('*')->where('id',$request->id)->get();
     return response()->json($data);
     }

     public function findOfferTypeCampaign(Request $request){
     $data= Campaign::select('*')->where('id',$request->id)->get();
     return response()->json($data);
     }

     public function findAction(Request $request){
     $data= Action::select('*')->where('id',$request->id)->get();
     return response()->json($data);
     }
     public function pathcondetail(Request $request){
     $data= Path_condition_detail::select('*')->get();
     return response()->json($data);
     }
 }
