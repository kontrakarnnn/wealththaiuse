<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Branch;
use App\Person;
use App\Block;
use App\Structure;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Http\Controllers\SidebarController;
class BranchController extends Controller
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




        $branchs = DB::table('branch')
        ->leftJoin('persons','branch.org_id','=','persons.id')
        ->select('branch.*','persons.name as org_name','persons.id as org_id ')

        ->paginate(30);
        return view('system-mgmt/branch/index', ['branchs' => $branchs,'tree' => $tree]);
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



        $organizes = Person::where('type','=','2')->get();
      //  return $persons;
        return view('system-mgmt/branch/create',['organizes' => $organizes,'tree'=>$tree]);
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

      $branch = new Branch;
      $branch->org_id = $request->org_id;
      $branch->name = $request->name;
      $branch->add_no = $request->add_no;
      $branch->add_alley = $request->add_alley;
      $branch->add_road = $request->add_road;
      $branch->add_subdistrict = $request->add_subdistrict	;
      $branch->add_district = $request->add_district;
      $branch->add_city = $request->add_city;
      $branch->add_country = $request->add_country;
      $branch->add_postcode = $request->add_postcode;
      $branch->number = $request->number;
      $branch->	tel = $request->	tel;
      $branch->	fax = $request->	fax;
      $branch->	con_name = $request->	con_name;
      $branch->con_lastname = $request->con_lastname;
      $branch->con_tel = $request->con_tel;
      $branch->con_email = $request->con_email;
      $branch->save();

       $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อย');
        return redirect ('/branch');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $portfolios = Block::find($id)->portfolio;
      $blocks = Block::paginate(6);
      $blocks = DB::table('block')
     ->leftJoin('structure', 'block.structure_id', '=', 'structure.id')
     ->select('block.id', 'block.name','block.under_block','block.status', 'structure.name as structure_name', 'structure.id as structure_id')
     ->paginate(20);
      return view('system-mgmt/block/index', compact(['blocks','portfolios']));
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

        $branch = Branch::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($branch == null) {
          $branch = Block::find($id);
          $data = array(
              'branch' => $branch
            );
            return redirect ('/branch');
        }
      $organizes = Person::where('type','=', '2')->get();

        return view('system-mgmt/branch/edit', ['organizes' => $organizes,'branch' => $branch,'tree'=>$tree]);
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
		date_default_timezone_set('Asia/Bangkok');

      $branch = Branch::find($id);
      $branch->org_id = $request->org_id;
      $branch->name = $request->name;
      $branch->add_no = $request->add_no;
      $branch->add_alley = $request->add_alley;
      $branch->add_road = $request->add_road;
      $branch->add_subdistrict = $request->add_subdistrict	;
      $branch->add_district = $request->add_district;
      $branch->add_city = $request->add_city;
      $branch->add_country = $request->add_country;
      $branch->add_postcode = $request->add_postcode;
      $branch->number = $request->number;
      $branch->	tel = $request->	tel;
      $branch->	fax = $request->	fax;
      $branch->	con_name = $request->	con_name;
      $branch->con_lastname = $request->con_lastname;
      $branch->con_tel = $request->con_tel;
      $branch->con_email = $request->con_email;
      $branch->save();

       $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect ('/branch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::where('id', $id)->delete();
         return redirect ('/branch');
    }

    public function loadStates($structureId) {
        $blocks = Block::where('structure_id', '=', $structureId)->get(['id', 'name']);

        return response()->json($blocks);
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
            'block.name' => $request['name'],
            'structure.name' => $request['structure_name'],
            'block.name' => $request['block_name']

            ];

       $blocks = $this->doSearchingQuery($constraints);
      $constraints['structure_name'] = $request['structure_name'];

       return view('system-mgmt/block/index', ['blocks' => $blocks, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('block as b')
       ->leftJoin('structure', 'b.structure_id', '=', 'structure.id')
		->leftJoin('block as bl', 'b.under_block', '=', 'bl.id')
       ->select('b.*','b.name', 'bl.name as block_name', 'structure.name as structure_name', 'structure.id as structure_id');
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
        'name' => 'required|max:60'
    ]);
    }
    public function findBlockName(Request $request){
      $data=Block::select('name','id')->where('structure_id',$request->id)->take(100)->get();
      return response()->json($data);
    }

    public function divDep(Request $request){

      $dep = $request->dep;

      $data = DB::table('block')->join('structure','structure.id','block.structure_id')
      ->where('structure.name',$dep)->get();
      return view('system-mgmt/block/index',[
        'data' => $data ,'depByUser' => $dep
      ]);
    }
    public function divisionDep(Request $request){
       $structure_id = $request->structure_id;
      $data = DB::table('block')
      ->join('structure','structure.id','block.structure_id')
      ->where('block.structure_id',$structure_id)
      ->get();
    }
}
