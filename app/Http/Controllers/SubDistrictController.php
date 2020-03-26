<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Block;
use App\Structure;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Province;
use App\District;
use App\Subdistrict;
use App\Http\Controllers\SidebarController;

class SubDistrictController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('view')->except(["findBlockName"]);
    }

	     public function getArrayAlldBlock($currentstruc,$currentid,$notebook){

    $CurrentDivisions = Block::where('id', '=',$currentid )->get();
    $result =$notebook;
    $ChildDivisions = Block::whereIn('under_block',$currentid )->pluck('id');
    foreach ( $ChildDivisions as $Division => $get) {
      $nextblockID[$Division] = $get;
      $arraylength = sizeof($result);
      //$currentid=$currentid;
      $result[$arraylength]  = $nextblockID[$Division];
      $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);
      }

      return $result;
}


public function blockbtu($currentstruc2,$currentid2,$notebook2){

$CurrentDivisions = Block::where('under_block', '=', NULL )->pluck('id');
$result2 =$notebook2;
$ChildDivisions = Block::whereIn('id',$currentid2)->pluck('under_block');
//$ChildDivisions = Block::whereIn('under_block',$currentid2)->pluck('id'); topdown
//  $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$CurrentDivisions )->pluck('id');
foreach ( $ChildDivisions as $Division => $get) {
  $nextblockID2[$Division] = $get;
  $arraylength = sizeof($result2);
  //$currentid=$currentid;
  $result2[$arraylength]  = $nextblockID2[$Division];
  $result2 = $this->blockbtu($currentstruc2,$nextblockID2,$result2);
  }

  return $result2;
}







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      //sidebar

      $tree = session()->get('tree');
      //sidebar




        $blocks = DB::table('subdistricts')
       ->leftJoin('districts', 'subdistricts.district_id', '=', 'districts.id')
       ->select('subdistricts.*', 'districts.name_in_thai as district_name_in_thai', 'districts.name_in_english as district_name_in_english', 'districts.id as district_id')
       ->paginate(30);
        return view('system-mgmt/subdistrict/index', ['blocks' => $blocks,'tree' => $tree]);
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

        $structures = District::all();
        $blocks = Subdistrict::all();
        return view('system-mgmt/subdistrict/create',['structures' => $structures, 'blocks' => $blocks,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      District::findOrFail($request['province_id']);
      $this->validate($request, [

      ]);
         Subdistrict::create([
            'name_in_thai' => $request['name_in_thai'],
            'name_in_english' => $request['name_in_english'],
            'code' => $request['code'],
            'district_id' => $request['district_id'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'zip_code' => $request['zip_code'],
        ]);

        return redirect ('/admin/subdistrict');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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


        $block = Subdistrict::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($block == null) {
          $block = District::find($id);
          $data = array(
              'block' => $block
            );
            return redirect ('/admin/district');
        }
        $structures = District::all();
        $blocks = Subdistrict::all();

        return view('system-mgmt/subdistrict/edit', ['block' => $block, 'structures' => $structures,'blocks' => $blocks,'tree'=>$tree]);
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
        $block = Subdistrict::findOrFail($id);
        $this->validate($request, [


        ]);
        $input = [
          'name_in_thai' => $request['name_in_thai'],
          'name_in_english' => $request['name_in_english'],
          'code' => $request['code'],
          'district_id' => $request['district_id'],
          'latitude' => $request['latitude'],
          'longitude' => $request['longitude'],
          'zip_code' => $request['zip_code'],
        ];
        Subdistrict::where('id', $id)
            ->update($input);

        return redirect ('/admin/subdistrict');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subdistrict::where('id', $id)->delete();
         return redirect ('/admin/district');
    }


    /**
     * Search division from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

      //sidebar

  $tree = session()->get('tree');
  //sidebar

        $constraints = [
            'districts.name_in_thai' => $request['district_name_in_thai'],
            'districts.name_in_english' => $request['district_name_in_english'],
            'subdistricts.name_in_thai' => $request['name_in_thai'],
            'subdistricts.name_in_english' => $request['name_in_english'],
            'subdistricts.code' => $request['code'],
            'subdistricts.latitude' => $request['latitude'],
            'subdistricts.longitude' => $request['longitude'],
            'subdistricts.zip_code' => $request['zip_code'],
            ];

       $blocks = $this->doSearchingQuery($constraints);
      $constraints['district_name_in_thai'] = $request['district_name_in_thai'];
      $constraints['district_name_in_english'] = $request['district_name_in_english'];
      $constraints['code'] = $request['code'];
      $constraints['name_in_thai'] = $request['name_in_thai'];
      $constraints['name_in_english'] = $request['name_in_english'];
      $constraints['latitude'] = $request['latitude'];
      $constraints['longitude'] = $request['longitude'];
      $constraints['zip_code'] = $request['zip_code'];
       return view('system-mgmt/subdistrict/index', ['blocks' => $blocks, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('subdistricts')
       ->leftJoin('districts', 'subdistricts.district_id', '=', 'districts.id')
       ->select('subdistricts.*', 'districts.name_in_thai as district_name_in_thai', 'districts.name_in_english as district_name_in_english', 'districts.id as district_id');
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


    /*public function load($name) {
         $path = storage_path().'/app/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }*/


    private function validateInput($request) {
        $this->validate($request, [

    ]);
    }

}
