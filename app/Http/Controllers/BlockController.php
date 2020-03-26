<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Block;
use App\Structure;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\User;
use App\match_id;
use App\Http\Controllers\SidebarController;
class BlockController extends Controller
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
        $blocks = DB::table('block as b')
       ->leftJoin('structure', 'b.structure_id', '=', 'structure.id')
		   ->leftJoin('block as bl', 'b.under_block', '=', 'bl.id')
       ->select('b.*','b.name', 'bl.name as block_name', 'structure.name as structure_name', 'structure.id as structure_id')
       ->paginate(20);
        return view('system-mgmt/block/index', ['blocks' => $blocks,'tree' => $tree]);
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
        $structures = Structure::all();
        $blocks = Block::all();
        return view('system-mgmt/block/create',['structures' => $structures, 'blocks' => $blocks,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Structure::findOrFail($request['structure_id']);
        $this->savedata($request);
        return redirect ('/admin/block');
    }
    public function savedata($request)
    {
      $this->validate($request, [
		    'default_pid' => 'nullable|numeric',
        //'contact_email' => 'nullable|email',
      ]);
         $block = Block::create([
            'name' => $request['name'],
            'status' => $request['status'],
            'under_block' => $request['under_block'],
            'structure_id' => $request['structure_id'],
			      'contact_name' => $request['contact_name'],
            'contact_tel' => $request['contact_tel'],
            'contact_email' => $request['contact_email'],
            'default_pid' => $request['default_pid']
        ]);

    }
    public function savedataexcel($request)
    {
    /*  $this->validate($request, [
		    'default_pid' => 'nullable|numeric',
        //'contact_email' => 'nullable|email',
      ]);*/
            $user = User::where('user_code',$request->main_contact_user_code)->value('id');
            $pid =match_id::where('user_id',$user)->value('id');
            $block = Block::create([
            'name' => $request['name'],
            'status' => $request['status'],
            'under_block' => $request['under_block'],
            'structure_id' => $request['structure_id'],
			      'contact_name' => $request['contact_name'],
            'contact_tel' => $request['contact_tel'],
            'contact_email' => $request['contact_email'],
            'block_code' => $request['block_code'],
            'belong_to_block_code' => $request['belong_to_department_code'],
            'default_pid' => $pid
        ]);

    }
    public function updatebelongexcel($request)
    {
      $blocktoupdate = Block::whereNotNull('belong_to_block_code')->get();
      foreach($blocktoupdate as $bl)
      {
        $parentblock = Block::where('block_code',$bl->belong_to_block_code)->value('id');
        $input = [
            'under_block' =>$parentblock,
        ];
        Block::where('id', $bl->id)
            ->update($input);
      }
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


        $block = Block::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($block == null) {
          $block = Block::find($id);
          $data = array(
              'block' => $block
            );
            return redirect ('/admin/block');
        }
        $strucid = DB::table('block')->where('id',$id)->value('structure_id');
        $structures = Structure::all();
        $blocks = Block::where('structure_id',$strucid)->get();

        return view('system-mgmt/block/edit', ['block' => $block, 'structures' => $structures,'blocks' => $blocks,'tree'=>$tree]);
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

          'default_pid' => 'nullable|numeric',
          //'contact_email' => 'nullable|email',
        ]);
        $input = [
            'name' => $request['name'],
            'status' => $request['status'],
            'under_block' => $request['under_block'],
            'structure_id' => $request['structure_id'],
			'contact_name' => $request['contact_name'],
            'contact_tel' => $request['contact_tel'],
            'contact_email' => $request['contact_email'],
            'default_pid' => $request['default_pid']
        ];
        Block::where('id', $id)
            ->update($input);
          $prevurl = url()->previous();
          if(strstr($prevurl,"?redirect="))
          {
            $explode = explode('?redirect=',$prevurl);
            $redirecturl = $explode[1];
            return redirect($redirecturl);
          }
          else
          {
            return redirect ('/admin/block');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Block::where('id', $id)->delete();
        $prevurl  =  url()->previous();
          if(strstr($prevurl,'import_excel_block'))
          {
            return redirect ($prevurl);
          }
          else
          {
            return redirect ('/admin/block');
          }
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
      $data=Block::select('name','id')->where('structure_id',$request->id)->get();
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
