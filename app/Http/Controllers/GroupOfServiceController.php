<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Message_cat;
use App\Message_type;
use App\Group_service;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\Http\Controllers\SidebarController;
class GroupOfServiceController extends Controller
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



        $msg_types = DB::table('group_of_service')
       ->leftJoin('message_types', 'group_of_service.msg_type_id', '=', 'message_types.id')
       ->select('group_of_service.*','message_types.message_template as msg_type_name', 'message_types.id as msg_type_id')
       ->paginate(20);
        return view('system-mgmt/group-of-service/index', ['msg_types' => $msg_types,'tree'=>$tree]);
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



        $msg_types = Message_type::all();
        $msg_cats = Group_service::all();
        return view('system-mgmt/group-of-service/create',['msg_cats' => $msg_cats, 'msg_types' => $msg_types,'tree'=>$tree]);
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
         Group_service::create([

            'name' => $request['name'],
			 'main' => $request['main'],

        ]);

        return redirect ('/admin/group-of-service');
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

        $msg_type = Group_service::find($id);
      // Redirect to division list if updating division wasn't existed
      if ($msg_type == null) {
        $msg_type = Group_service::find($id);
        $data = array(
            'msg_type' => $msg_type
          );

        // Redirect to division list if updating division wasn't existed


            return redirect ('/admin/group-of-service');
        }

        $msg_types = Message_type::all();
        $msg_cats = Group_service::all();

        return view('system-mgmt/group-of-service/edit', ['msg_types' => $msg_types, 'msg_type' => $msg_type, 'msg_cats' => $msg_cats,'tree'=>$tree]);
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
        $msg_types = Group_service::findOrFail($id);
        $this->validateInput($request);
        $input = [

           'name' => $request['name'],
			'main' => $request['main'],
        ];
        Group_service::where('id', $id)
            ->update($input);

        return redirect ('/admin/group-of-service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group_service::where('id', $id)->delete();
         return redirect()->back();
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
          'msg_type_id' => $request['msg_type_id'],
            'message_types.message_template' => $request['msg_type_name'],
           'name' => $request['name'],

            ];

       $msg_types = $this->doSearchingQuery($constraints);
      $constraints['msg_type_name'] = $request['msg_type_name'];
       return view('system-mgmt/group-of-service/index', ['msg_types' => $msg_types , 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
      $query = DB::table('group_of_service')
     ->leftJoin('message_types', 'group_of_service.msg_type_id', '=', 'message_types.id')
     ->select('group_of_service.*','message_types.message_template as msg_type_name', 'message_types.id as msg_type_id');
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
	    private function validateInput($request) {
        $this->validate($request, [
        'main' => 'nullable|max:60|unique:group_of_service'
    ]);
    }
}
