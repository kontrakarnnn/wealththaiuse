<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_status;
use App\Http\Controllers\SidebarController;
class AssetStatusController extends Controller
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


        $structures = Asset_status::paginate(30);

        return view('system-mgmt/asset-status/index', ['structures' => $structures,'tree'=>$tree]);
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


        return view( 'system-mgmt/asset-status/create',['tree'=>$tree]);
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
         Asset_status::create([
            'name' => $request['name']
        ]);

        return redirect ('/admin/asset-status');
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
      return view( 'system-mgmt/asset-status/index', compact(['structures','blocks','tree']));
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



        $structure = Asset_status::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($structure == null) {
          $structure = Asset_status::find($id);
          $data = array(
              'structure' => $structure
            );
            return redirect ('/admin/asset-status');
        }

        return view( 'system-mgmt/asset-status/edit', ['structure' => $structure,'tree'=>$tree]);
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
        $structure = Asset_status::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
        ];
        Asset_status::where('id', $id)
            ->update($input);

        return redirect ('/admin/asset-status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asset_status::where('id', $id)->delete();
         return redirect ('/admin/asset-status');
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
            'name' => $request['name']
            ];

       $structures = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/asset-status/index', ['structures' => $structures, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = Asset_status::query();
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
