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
use App\FileCatGroup;
use App\EventType;
use App\Organize;
use App\Family;
use App\Server;
use App\Member_group;
use App\FileCatGroupGroup;
use App\Http\Controllers\SidebarController;
class FileCategoryGroupController extends Controller
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




        /*$events = DB::table('file_category as f')
       ->leftJoin('file_auth as fv', 'f.view_ref_id', '=', 'fv.id')
       ->leftJoin('file_auth as fe', 'f.edit_ref_id', '=', 'fe.id')
       ->leftJoin('file_auth as fd', 'f.delete_ref_id', '=', 'fd.id')
       ->select('f.*', 'event_type.name as event_type_name', 'event_type.id as event_type_id', 'organize.name as organize_name', 'organize.id as organize_id'
                , 'family.name as group_name', 'family.id as group_id', 'member_groups.name as member_group_name', 'member_groups.id as member_group_id')
       ->paginate(20);*/
       $events = DB::table('file_cat_group')
       ->paginate(30);
        return view('system-mgmt/file-cat-group/index', ['events' => $events,'tree' => $tree]);
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

    //    return $year;
        return view('system-mgmt/file-cat-group/create',['tree' => $tree]);
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


        $event = new FileCatGroup;
        $event->name = $request -> name;
        $event->description = $request -> description;

        $event->save();

        return redirect ('/admin/file-cat-group');
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


        $event = FileCatGroupGroup::find($id);


        // Redirect to division list if updating division wasn't existed
        if ($event == null) {
          $event = FileCatGroupGroup::find($id);
          $data = array(
              'event' => $event
            );
            return redirect ('/admin/file-cat-group');
        }

        //return $event;
        return view('system-mgmt/file-cat-group/show',['event'=>$event,'tree'=>$tree]);
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


        $event = FileCatGroup::find($id);

        $server = Server::all();
        // Redirect to division list if updating division wasn't existed

      //  return $member;
        return view('system-mgmt/file-cat-group/edit', ['server' => $server,'event' => $event,'tree'=>$tree]);
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

        $event = FileCatGroup::find($id);;
        $event->name = $request -> name;
        $event->description = $request -> description;

        $event->save();

        return redirect ('/admin/file-cat-group');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FileCatGroup::where('id', $id)->delete();
         return redirect()->back();
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
            'name' => $request['name'],


            ];

       $events = $this->doSearchingQuery($constraints);
      $constraints['name'] = $request['name'];


       return view('system-mgmt/file-cat-group/index', ['events' => $events, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('file_cat_group');

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
