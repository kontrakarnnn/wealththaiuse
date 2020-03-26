<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Partner_structure;
use App\Partner_block;
use App\Partner_auth;

use App\Http\Controllers\SidebarController;


class PartnerStructureController extends Controller
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
        $structures = Partner_structure::paginate(30);

        return view('system-mgmt/partnerstructure/index', ['structures' => $structures]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('system-mgmt/partnerstructure/create');
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
         Partner_structure::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);

        return redirect ('/admin/partnerstructure');
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



        $structure = Partner_structure::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($structure == null) {
          $structure = Structure::find($id);
          $data = array(
              'structure' => $structure
            );
            return redirect ('/admin/partnerstructure');
        }

        return view('system-mgmt/partnerstructure/edit', ['structure' => $structure]);
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
        $structure = Partner_structure::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'description' => $request['description']
        ];
        Partner_structure::where('id', $id)
            ->update($input);

        return redirect ('/admin/partnerstructure');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Partner_auth::where('structure_id', $id)->delete();
        Partner_block::where('structure_id', $id)->delete();
        Partner_structure::where('id', $id)->delete();

         return redirect ('/admin/partnerstructure');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {



        $constraints = [
            'name' => $request['name']
            ];

       $structures = $this->doSearchingQuery($constraints);
       return view('system-mgmt/partnerstructure/index', ['structures' => $structures, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Partner_structure::query();
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
        'name' => 'required|max:60'
    ]);
    }
}
