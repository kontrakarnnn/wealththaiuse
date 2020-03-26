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
use App\Http\Controllers\SidebarController;
class DistrictController extends Controller
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

public function blockbtu($currentstruc,$currentid,$notebook){

$CurrentDivisions = Block::where('under_block', '=', NULL )->pluck('id');
$result =$notebook;
$ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
//  $ChildDivisions = Block::whereIn('id',$CurrentDivisions )->pluck('id');
foreach ( $ChildDivisions as $Division => $get) {
  $nextblockID[$Division] = $get;
  $arraylength = sizeof($result);
  //$currentid=$currentid;
  $result[$arraylength]  = $nextblockID[$Division];
  $result = $this->blockbtu($currentstruc,$nextblockID,$result);
  }

  return $result;
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




        $blocks = DB::table('districts')
       ->leftJoin('provinces', 'districts.province_id', '=', 'provinces.id')
       ->select('districts.*', 'provinces.name_in_thai as province_name_in_thai', 'provinces.name_in_english as province_name_in_english', 'provinces.id as province_id')
       ->paginate(30);
        return view('system-mgmt/district/index', ['blocks' => $blocks,'tree' => $tree]);
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


        $structures = Province::all();
        $blocks = District::all();
        return view('system-mgmt/district/create',['structures' => $structures, 'blocks' => $blocks,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Province::findOrFail($request['province_id']);
      $this->validate($request, [

      ]);
         District::create([
            'name_in_thai' => $request['name_in_thai'],
            'name_in_english' => $request['name_in_english'],
            'code' => $request['code'],
            'province_id' => $request['province_id'],

        ]);

        return redirect ('/admin/district');
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


        $block = District::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($block == null) {
          $block = District::find($id);
          $data = array(
              'block' => $block
            );
            return redirect ('/admin/district');
        }
        $structures = Province::all();
        $blocks = District::all();

        return view('system-mgmt/district/edit', ['block' => $block, 'structures' => $structures,'blocks' => $blocks,'tree'=>$tree]);
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
        $block = Block::findOrFail($id);
        $this->validate($request, [


        ]);
        $input = [
          'name_in_thai' => $request['name_in_thai'],
          'name_in_english' => $request['name_in_english'],
          'code' => $request['code'],
          'province_id' => $request['province_id'],
        ];
        District::where('id', $id)
            ->update($input);

        return redirect ('/admin/district');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        District::where('id', $id)->delete();
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
            'provinces.name_in_thai' => $request['province_name_in_thai'],
            'provinces.name_in_english' => $request['province_name_in_english'],
            'districts.name_in_thai' => $request['name_in_thai'],
            'districts.name_in_english' => $request['name_in_english'],
            'districts.code' => $request['code']

            ];

       $blocks = $this->doSearchingQuery($constraints);
      $constraints['province_name_in_thai'] = $request['province_name_in_thai'];
      $constraints['province_name_in_english'] = $request['province_name_in_english'];
      $constraints['name_in_thai'] = $request['name_in_thai'];
      $constraints['name_in_english'] = $request['name_in_english'];
      $constraints['code'] = $request['code'];
       return view('system-mgmt/district/index', ['blocks' => $blocks, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('districts')
       ->leftJoin('provinces', 'districts.province_id', '=', 'provinces.id')
       ->select('districts.*', 'provinces.name_in_thai as province_name_in_thai', 'provinces.name_in_english as province_name_in_english', 'provinces.id as province_id');
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
