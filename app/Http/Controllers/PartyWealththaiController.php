<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Party;
use App\Http\Controllers\SidebarController;
class PartyWealththaiController extends Controller
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


        $structures = DB::table('party')
        ->leftJoin('member_groups','party.member_group_id','member_groups.id')
        ->where('member_groups.id',6)
        ->select('party.*','member_groups.name as member_group_name','member_group_id as member_group_id')
        ->paginate(30);

        return view('system-mgmt/partywealththai/index', ['structures' => $structures,'tree'=>$tree]);
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
			$structure = Party::where('member_group_id',6)->get();
           $memgroup = DB::table('member_groups')->where('id',6)->get();
        return view('system-mgmt/partywealththai/create',['structure'=>$structure,'memgroup'=>$memgroup,'tree'=>$tree]);
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
         Party::create([
            'name' => $request['name'],
            'member_group_id' => $request['member_group_id'],
        ]);

        return redirect ('/partywealththai');
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
      return view('system-mgmt/structure/index', compact(['structures','blocks','tree']));
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


        $structure = Party::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($structure == null) {
          $structure = Party::find($id);
          $data = array(
              'structure' => $structure
            );
            return redirect ('//partywealththai');
        }
        $memgroup = DB::table('member_groups')->where('id',6)->get();
        return view('system-mgmt/partywealththai/edit', ['memgroup' => $memgroup,'structure' => $structure,'tree'=>$tree]);
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
        $structure = Party::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'member_group_id' => $request['member_group_id'],
        ];
        Party::where('id', $id)
            ->update($input);

        return redirect ('/partywealththai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Party::where('id', $id)->delete();
         return redirect()->back();
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

      //sidebar

      $tree = session()->get('tree');
      //sidebar


        $constraints = [
            'party.name' => $request['name']
            ];

       $structures = $this->doSearchingQuery($constraints);
       $constraints['name'] = $request['name'];
       return view('system-mgmt/partywealththai/index', ['structures' => $structures, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query =  DB::table('party')
        ->leftJoin('member_groups','party.member_group_id','member_groups.id')
        ->where('member_groups.id',6)
        ->select('party.*','member_groups.name as member_group_name','member_group_id as member_group_id');
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

    ]);
    }
}
