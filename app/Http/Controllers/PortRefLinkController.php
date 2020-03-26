<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Port_Ref_Link;
use App\Http\Controllers\SidebarController;


class PortRefLinkController extends Controller
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


        $structures = Port_Ref_Link::paginate(30);

        return view('system-mgmt/portreflink/index', ['structures' => $structures,'tree'=>$tree]);
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
        return view('system-mgmt/portreflink/create',['tree'=>$tree]);
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
         Port_Ref_Link::create([
           'ref_link_id' => $request['ref_link_id'],
            'port_id' => $request['port_id'],
            'real_url' => $request['real_url'],
        ]);

        return redirect ('/admin/portreflink');
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
      return view('system-mgmt/structure/index', compact(['structures','blocks','tree']));
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


        $structure = Port_Ref_Link::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($structure == null) {
          $structure = Port_Ref_Link::find($id);
          $data = array(
              'structure' => $structure
            );
            return redirect ('/admin/portreflink');
        }

        return view('system-mgmt/portreflink/edit', ['structure' => $structure,'tree'=>$tree]);
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
        //$structure = Structure::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'ref_link_id' => $request['ref_link_id'],
           'port_id' => $request['port_id'],
           'real_url' => $request['real_url'],
        ];
        Port_Ref_Link::where('id', $id)
            ->update($input);

        return redirect ('/admin/portreflink');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Port_Ref_Link::where('id', $id)->delete();
         return redirect ('/admin/portreflink');
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
            'ref_link_id' => $request['ref_link_id'],
            'real_url' => $request['real_url'],
            ];

       $structures = $this->doSearchingQuery($constraints);
       return view('system-mgmt/portreflink/index', ['structures' => $structures, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = Port_Ref_Link::query();
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
