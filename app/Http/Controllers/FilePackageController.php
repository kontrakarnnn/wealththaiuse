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
use App\FilePackage;
use App\EventType;
use App\Organize;
use App\Family;
use App\Server;
use App\Member_group;
use App\Http\Controllers\SidebarController;
class FilePackageController extends Controller
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
       $events = DB::table('file_package')
       ->paginate(30);
        return view('system-mgmt/file-package/index', ['events' => $events]);
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

        return view('system-mgmt/file-package/create');
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


        $data = new FilePackage;
        $data->name = $request -> name;
        $data->description = $request -> description;

        $data->save();

        return redirect ('/admin/file-package');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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

      //  return $member;
      $event = FilePackage::find($id);
        return view('system-mgmt/file-package/edit',['event'=>$event]);
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

        $data =FilePackage::find($id);
        $data->name = $request -> name;
        $data->description = $request -> description;

        $data->save();

        return redirect ('/admin/file-package');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FilePackage::where('id', $id)->delete();
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


            ];

       $events = $this->doSearchingQuery($constraints);

       return view('system-mgmt/file-package/index', ['filecat' => $filecat,'filecatgroup' => $filecatgroup,'events' => $events, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('file_package');
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
