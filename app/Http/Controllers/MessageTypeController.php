<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Message_cat;
use App\Message_type;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\Http\Controllers\SidebarController;
class MessageTypeController extends Controller
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
		//sidebar

        $msg_types = DB::table('message_types as s')

       ->leftJoin('message_cats', 's.message_cat_id', '=', 'message_cats.id')
      ->leftJoin('message_types as bl', 's.reply_mst_id', '=', 'bl.id')
       ->select('s.*','bl.message_template as bl_name', 'bl.id as bl_id','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')
       ->paginate(20);
        return view('system-mgmt/message-type/index', ['msg_types' => $msg_types,'tree'=>$tree]);
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


        $msg_cats = Message_cat::all();
        $msg_types = Message_type::where('message_cat_id','=',10)->get();
        return view('system-mgmt/message-type/create',['msg_cats' => $msg_cats, 'msg_types' => $msg_types,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Message_cat::findOrFail($request['message_cat_id']);

        $this->validateInput($request);
         Message_type::create([
           'message_cat_id' => $request['message_cat_id'],
            'message_template' => $request['message_template'],
            'message_default' => $request['message_default'],
            'cc_recieve' => $request['cc_recieve'],
            'cc_email' => $request['cc_email'],

			 'default_recieve' => $request['default_recieve'],
       'default_recieve_id' => $request['default_recieve_id'],
            'default_email' => $request['default_email'],
            'default_status' => $request['default_status'],
            'auto_reply' => $request['auto_reply'],
            'email_flag' => $request['email_flag'],
            'line_flag' => $request['line_flag'],
            'app_flag' => $request['app_flag'],
            'reply_mst_id' => $request['reply_mst_id']
        ]);

        return redirect ('/admin/message-type');
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

        $msg_type = Message_type::find($id);
      // Redirect to division list if updating division wasn't existed
      if ($msg_type == null) {
        $msg_type = Message_type::find($id);
        $data = array(
            'msg_type' => $msg_type
          );

        // Redirect to division list if updating division wasn't existed


            return redirect ('/admin/message-type');
        }
        $msg_cats = Message_cat::all();
        $msg_types = Message_type::where('message_cat_id','=',10)->get();

        return view('system-mgmt/message-type/edit', ['msg_types' => $msg_types, 'msg_type' => $msg_type, 'msg_cats' => $msg_cats,'tree'=>$tree]);
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
        $msg_types = Message_type::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'message_cat_id' => $request['message_cat_id'],
           'message_template' => $request['message_template'],
           'message_default' => $request['message_default'],
           'cc_recieve' => $request['cc_recieve'],
           'cc_email' => $request['cc_email'],

      'default_recieve' => $request['default_recieve'],
      'default_recieve_id' => $request['default_recieve_id'],
           'default_email' => $request['default_email'],
           'default_status' => $request['default_status'],
           'auto_reply' => $request['auto_reply'],
           'email_flag' => $request['email_flag'],
           'line_flag' => $request['line_flag'],
           'app_flag' => $request['app_flag'],
           'reply_mst_id' => $request['reply_mst_id']
        ];
        Message_type::where('id', $id)
            ->update($input);

        return redirect ('/admin/message-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message_type::where('id', $id)->delete();
         return redirect ('/admin/message-type');
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
          'message_cat_id' => $request['message_cat_id'],
            'message_cats.name' => $request['message_cat.name'],
           'message_template' => $request['message_message_template'],
           'message_default' => $request['message_default'],
           'cc_recieve' => $request['cc_recieve'],
           'cc_email' => $request['cc_email'],

        'default_recieve' => $request['cdefault_recieve'],
           'default_email' => $request['default_email'],
           'default_status' => $request['default_status']
            ];

       $msg_types = $this->doSearchingQuery($constraints);
      $constraints['message_cat_name'] = $request['message_cat_name'];
       return view('system-mgmt/message-type/index', ['msg_types' => $msg_types , 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('message_types')


        ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
        ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id');
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
