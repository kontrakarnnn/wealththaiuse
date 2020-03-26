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
use App\OfferCategory;
use App\OfferType;
use App\Asset_type;


use App\Http\Controllers\SidebarController;
class OfferTypeController extends Controller
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
        $data = OfferType::paginate(30);
        $offertype = OfferType::all();
        $offercategory = OfferCategory::all();
        $assettype = Asset_type::all();
        return view('system-mgmt/offertype/index', ['assettype' => $assettype,'offertype' => $offertype,'offercategory' => $offercategory,'data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $offertype = OfferType::all();
      $offercategory = OfferCategory::all();
      $assettype = Asset_type::all();
        return view( 'system-mgmt/offertype/create',compact(['assettype','offertype','offercategory']));
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
         OfferType::create([
           'name' => $request['name'],
           'offer_category' => $request['offer_category'],
           'offer_value_name1' => $request['offer_value_name1'],
           'offer_value_name2' => $request['offer_value_name2'],
           'offer_value_name3' => $request['offer_value_name3'],
           'offer_value_name4' => $request['offer_value_name4'],
           'offer_value_name5' => $request['offer_value_name5'],
           'offer_value_name6' => $request['offer_value_name6'],
           'offer_value_name7' => $request['offer_value_name7'],
           'offer_value_name8' => $request['offer_value_name8'],
           'offer_value_name9' => $request['offer_value_name9'],
           'offer_value_name10' => $request['offer_value_name10'],
           'offer_value_name11' => $request['offer_value_name11'],
           'offer_value_name12' => $request['offer_value_name12'],
           'offer_value_name13' => $request['offer_value_name13'],
           'offer_value_name14' => $request['offer_value_name14'],
           'offer_value_name15' => $request['offer_value_name15'],
           'offer_value_name16' => $request['offer_value_name16'],
           'offer_value_name17' => $request['offer_value_name17'],
           'offer_value_name18' => $request['offer_value_name18'],
           'offer_value_name19' => $request['offer_value_name19'],
           'offer_value_name20' => $request['offer_value_name20'],
           'offer_value_name21' => $request['offer_value_name21'],
           'offer_value_name22' => $request['offer_value_name22'],
           'offer_value_name23' => $request['offer_value_name23'],
           'offer_value_name24' => $request['offer_value_name24'],
           'offer_value_name25' => $request['offer_value_name25'],
           'offer_value_name26' => $request['offer_value_name26'],
           'offer_value_name27' => $request['offer_value_name27'],
           'offer_value_name28' => $request['offer_value_name28'],
           'offer_value_name29' => $request['offer_value_name29'],
           'offer_value_name30' => $request['offer_value_name30'],
           'offer_value_name31' => $request['offer_value_name31'],
           'offer_value_name32' => $request['offer_value_name32'],
           'offer_value_name33' => $request['offer_value_name33'],
           'offer_value_name34' => $request['offer_value_name34'],
           'offer_value_name35' => $request['offer_value_name35'],
           'offer_value_name36' => $request['offer_value_name36'],
           'offer_value_name37' => $request['offer_value_name37'],
           'offer_value_name38' => $request['offer_value_name38'],
           'offer_value_name39' => $request['offer_value_name39'],
           'offer_value_name40' => $request['offer_value_name40'],
           'asset_type' => $request['asset_type'],
           'description' => $request['description']
        ]);
        return redirect ('/admin/offertype');
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
      return view( 'system-mgmt/offertype/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = OfferType::find($id);
        $offertype = OfferType::all();
        $offercategory = OfferCategory::all();
        $assettype = Asset_type::all();

        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = OfferType::find($id);

            return redirect ('/admin/offertype');
        }

        return view( 'system-mgmt/offertype/edit', ['assettype' => $assettype,'offertype' => $offertype,'offercategory' => $offercategory,'data' => $data]);
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
          'offer_category' => $request['offer_category'],
          'offer_value_name1' => $request['offer_value_name1'],
          'offer_value_name2' => $request['offer_value_name2'],
          'offer_value_name3' => $request['offer_value_name3'],
          'offer_value_name4' => $request['offer_value_name4'],
          'offer_value_name5' => $request['offer_value_name5'],
          'offer_value_name6' => $request['offer_value_name6'],
          'offer_value_name7' => $request['offer_value_name7'],
          'offer_value_name8' => $request['offer_value_name8'],
          'offer_value_name9' => $request['offer_value_name9'],
          'offer_value_name10' => $request['offer_value_name10'],
          'offer_value_name11' => $request['offer_value_name11'],
          'offer_value_name12' => $request['offer_value_name12'],
          'offer_value_name13' => $request['offer_value_name13'],
          'offer_value_name14' => $request['offer_value_name14'],
          'offer_value_name15' => $request['offer_value_name15'],
          'offer_value_name16' => $request['offer_value_name16'],
          'offer_value_name17' => $request['offer_value_name17'],
          'offer_value_name18' => $request['offer_value_name18'],
          'offer_value_name19' => $request['offer_value_name19'],
          'offer_value_name20' => $request['offer_value_name20'],
          'offer_value_name21' => $request['offer_value_name21'],
          'offer_value_name22' => $request['offer_value_name22'],
          'offer_value_name23' => $request['offer_value_name23'],
          'offer_value_name24' => $request['offer_value_name24'],
          'offer_value_name25' => $request['offer_value_name25'],
          'offer_value_name26' => $request['offer_value_name26'],
          'offer_value_name27' => $request['offer_value_name27'],
          'offer_value_name28' => $request['offer_value_name28'],
          'offer_value_name29' => $request['offer_value_name29'],
          'offer_value_name30' => $request['offer_value_name30'],
          'offer_value_name31' => $request['offer_value_name31'],
          'offer_value_name32' => $request['offer_value_name32'],
          'offer_value_name33' => $request['offer_value_name33'],
          'offer_value_name34' => $request['offer_value_name34'],
          'offer_value_name35' => $request['offer_value_name35'],
          'offer_value_name36' => $request['offer_value_name36'],
          'offer_value_name37' => $request['offer_value_name37'],
          'offer_value_name38' => $request['offer_value_name38'],
          'offer_value_name39' => $request['offer_value_name39'],
          'offer_value_name40' => $request['offer_value_name40'],
          'asset_type' => $request['asset_type'],
          'description' => $request['description']
        ];
        OfferType::where('id', $id)
            ->update($input);

        return redirect ('/admin/offertype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OfferType::where('id', $id)->delete();
         return redirect ('/admin/offertype');
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
            'offer_category' => $request['offer_category'],
            ];
            $offertype = OfferType::all();
            $offercategory = OfferCategory::all();
            $assettype = Asset_type::all();
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/offertype/index', ['offertype' => $offertype,'offercategory' => $offercategory,'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = OfferType::query();
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
