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
use App\FilePackagecat;
use App\EventType;
use App\Organize;
use App\Family;
use App\Server;
use App\Member_group;
use App\Http\Controllers\SidebarController;
class FilePackagecatController extends Controller
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
$filepackage = DB::table('file_package')->get();
$filecat = DB::table('file_category')->get();
       $events = DB::table('file_package_cat')
       ->leftJoin('file_package','file_package_cat.package_id','=','file_package.id')
       ->leftJoin('file_category','file_package_cat.cat_id','=','file_category.id')
       ->select('file_package_cat.*','file_category.name as file_category_name','file_package.name as file_package_name')
       ->paginate(30);
        return view('system-mgmt/file-packagecat/index', ['filepackage' => $filepackage,'filecat' => $filecat,'events' => $events,'tree' => $tree]);
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


           $filecat = DB::table('file_category')->get();
           $filepackage = DB::table('file_package')->get();

    //    return $year;

        return view('system-mgmt/file-packagecat/create',['filecat' => $filecat,'filepackage' => $filepackage]);
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


        $data = new FilePackagecat;
        $data->cat_id = $request -> cat_id;
        $data->package_id = $request -> package_id;
        $data->name = $request -> name;
        $data->description = $request -> description;

        $data->save();

        return redirect ('/admin/file-packagecat');
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


      $filecat = DB::table('file_category')->get();

      $filepackage = DB::table('file_package')->get();
      //  return $member;
      $event = FilePackagecat::find($id);
        return view('system-mgmt/file-packagecat/edit', ['event' => $event,'filecat' => $filecat,'filepackage' => $filepackage]);
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

        $data = FilePackagecat::find($id);;

        $data->cat_id = $request -> cat_id;
        $data->package_id = $request -> package_id;
        $data->name = $request -> name;
        $data->description = $request -> description;

        $data->save();

        return redirect ('/admin/file-packagecat');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FilePackagecat::where('id', $id)->delete();
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
            'file_package_cat.name' => $request['name'],
            'file_category.name' => $request['file_category_name'],
            'file_package.name' => $request['file_package_name'],

            ];

       $events = $this->doSearchingQuery($constraints);
      $constraints['name'] = $request['name'];
      $constraints['file_cat_name'] = $request['file_category_name'];
      $constraints['file_package_name'] = $request['file_package_name'];
      $filecatgroup = DB::table('file_cat_group')->get();
      $filecat = DB::table('file_category')->get();
      $filepackage = DB::table('file_package')->get();

       return view('system-mgmt/file-packagecat/index', ['filepackage' => $filepackage,'filecat' => $filecat,'filecatgroup' => $filecatgroup,'events' => $events, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query =  DB::table('file_package_cat')
               ->leftJoin('file_package','file_package_cat.package_id','=','file_package.id')
               ->leftJoin('file_category','file_package_cat.cat_id','=','file_category.id')
               ->select('file_package_cat.*','file_category.name as file_category_name','file_package.name as file_package_name')
               ;
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
