<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Department;
use App\Division;
use App\User;
use App\Person;
use App\Port_cat;
use App\View;
use App\Structure;

use App\Block;
use App\Http\Controllers\SidebarController;

class PortCatController extends Controller
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
      $porttypes = DB::table('port_cat')
      ->leftJoin('structure', 'port_cat.structure_id', '=', 'structure.id')
      ->select('port_cat.*','structure.name as structure_name','structure.id as structure_id')
      ->paginate(30);

      return view('system-mgmt/portcat/index', ['porttypes' => $porttypes,'tree'=>$tree]);
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

         return view('system-mgmt/portcat/create',['tree'=>$tree,'structures' => $structures]);
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
          Port_cat::create([
             'name' => $request['name'],
             'structure_id' => $request['structure_id'],

         ]);


         return redirect ('/admin/portcat');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
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

         $porttype = Port_cat::find($id);
         // Redirect to country list if updating country wasn't existed
         if ($porttype == null) {
           $porttype = Port_cat::find($id);
           $data = array(
               'porttype' => $porttype
             );
             return redirect ('/admin/portcat');
         }

        $structures = Structure::all();
         return view('system-mgmt/portcat/edit', ['structures' => $structures,'porttype' => $porttype,'tree'=>$tree]);
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
         $porttype = Port_cat::findOrFail($id);
         $input = [
             'name' => $request['name'],
             'structure_id' => $request['structure_id'],

         ];
         $this->validate($request, [
         'name' => 'required|max:60'
         ]);
         Port_cat::where('id', $id)
             ->update($input);

         return redirect ('/admin/portcat');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Port_cat::where('id', $id)->delete();
          return redirect ('/admin/portcat');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */


     public function search(Request $request) {

           //sidebar

           $tree = session()->get('tree');
           //sidebar


         $constraints = [
             'port_cat.name' => $request['name'],
             'structure.name' => $request['structure_name']
             ];

        $porttypes = $this->doSearchingQuery($constraints);
        $constraints['name'] = $request['name'];
        $constraints['structure_name'] = $request['structure_name'];
        return view('system-mgmt/portcat/index', ['porttypes' => $porttypes, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
         $query = DB::table('port_cat')
         ->leftJoin('structure', 'port_cat.structure_id', '=', 'structure.id')
         ->select('port_cat.*','structure.name as structure_name','structure.id as structure_id');
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
     private function validateInput($request) {
         $this->validate($request, [
         'name' => 'required|max:60|unique:port_cat',

     ]);
     }
 }
