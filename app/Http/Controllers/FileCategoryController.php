<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Block;
use App\Structure;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Person;
use App\FileCat;
use App\EventType;
use App\Organize;
use App\Family;
use App\Server;
use App\Member_group;
use App\Http\Controllers\SidebarController;
class FileCategoryController extends Controller
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

       $events = DB::table('file_category')
       ->leftJoin('server','file_category.default_server_id','=','server.id')
       ->leftJoin('file_cat_group','file_category.file_cat_group','=','file_cat_group.id')
       ->select('file_category.*','server.name as server_name','file_cat_group.name as file_cat_group_name')
       ->paginate(30);
        return view('system-mgmt/file-cat/index', ['events' => $events,'tree' => $tree]);
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


           $fileauth = DB::table('file_auth')->get();
           $server = Server::all();
           $filecatgroup = DB::table('file_cat_group')->get();
    //    return $year;
          $fileauth = DB::table('file_auth')->get();
        return view('system-mgmt/file-cat/create',['fileauth' => $fileauth,'server' => $server,'filecatgroup' => $filecatgroup,'fileauth' => $fileauth,'tree' => $tree]);
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
      date('D-m-y H:i:s');


        $event = new FileCat;
        $event->name = $request -> name;
        $event->file_type = $request -> file_type;
        $event->ref_label1 = $request -> ref_label1;
        $event->ref_label2 = $request -> ref_label2;
        $event->ref_label3 = $request -> ref_label3;
        $event->view_ref_id = $request -> view_ref_id;
        $event->edit_ref_id = $request -> edit_ref_id;
        $event->delete_ref_id = $request -> delete_ref_id;
        $event->max_file_size = $request-> max_file_size;
        $event->default_folder_path  = $request -> default_folder_path;
        $event->default_server_id = $request -> default_server_id;
        $event->file_cat_group = $request -> file_cat_group;
        $event->txt = $request -> txt;
        $event->subfolder = $request -> subfolder;
        $event->member_view = $request -> member_view;
        $event->user_view = $request -> user_view;
        $event->middle_view = $request -> middle_view;
        $event->save();

        return redirect ('/admin/file-cat');
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


    $event = FileCat::find($id);


        // Redirect to division list if updating division wasn't existed
        if ($event == null) {
          $event = FileCat::find($id);
          $data = array(
              'event' => $event
            );
            return redirect ('/admin/file-cat');
        }

        //return $event;
        return view('system-mgmt/file-cat/show',['event'=>$event,'tree'=>$tree]);
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


        $event = FileCat::find($id);

        $filecatgroup = DB::table('file_cat_group')->get();
        $server = Server::all();
        // Redirect to division list if updating division wasn't existed
        $fileauth = DB::table('file_auth')->get();
      //  return $member;
        return view('system-mgmt/file-cat/edit', ['fileauth' => $fileauth,'filecatgroup' => $filecatgroup,'server' => $server,'event' => $event,'tree'=>$tree]);
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

        //return $startdate;
        date_default_timezone_set('Asia/Bangkok');
        date('D-m-y H:i:s');

        $event = FileCat::find($id);;
        $event->name = $request -> name;
        $event->file_type = $request -> file_type;
        $event->ref_label1 = $request -> ref_label1;
        $event->ref_label2 = $request -> ref_label2;
        $event->ref_label3 = $request -> ref_label3;
        $event->view_ref_id = $request -> view_ref_id;
        $event->edit_ref_id = $request -> edit_ref_id;
        $event->delete_ref_id = $request -> delete_ref_id;
        $event->max_file_size = $request-> max_file_size;
        $event->default_folder_path  = $request -> default_folder_path;
        $event->default_server_id = $request -> default_server_id;
        $event->txt = $request -> txt;
        $event->file_cat_group = $request -> file_cat_group;
        $event->subfolder = $request -> subfolder;
        $event->member_view = $request -> member_view;
        $event->user_view = $request -> user_view;
        $event->middle_view = $request -> middle_view;
        $event->save();

        return redirect ('/admin/file-cat');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FileCat::where('id', $id)->delete();
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
            'name' => $request['name'],
            'server.name' => $request['server_name'],
            'file_cat_group.name' => $request['file_cat_group_name'],

            ];

       $events = $this->doSearchingQuery($constraints);
      $constraints['name'] = $request['name'];
      $constraints['server_name'] = $request['server_name'];
      $constraints['file_cat_group_name'] = $request['file_cat_group_name'];

       return view('system-mgmt/file-cat/index', ['events' => $events, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('file_category')
        ->leftJoin('server','file_category.default_server_id','=','server.id')
        ->leftJoin('file_cat_group','file_category.file_cat_group','=','file_cat_group.id')
        ->select('file_category.*','server.name as server_name','file_cat_group.name as file_cat_group_name');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(1000000);
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









}
