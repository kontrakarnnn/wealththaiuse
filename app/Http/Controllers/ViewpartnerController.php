<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Viewpartner;
use App\View;
use App\Block;
use App\Http\Controllers\SidebarController;

class ViewpartnerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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


    $views = DB::table('views_partner as v')
  ->leftJoin('views_partner as vi', 'v.belong_to', '=', 'vi.id')
  ->select('v.*','vi.name as view_name', 'vi.id as view_id')
  ->paginate(50);
          //return $views;
        return view('system-mgmt/view-partner/index', ['views' => $views,'tree'=>$tree]);
    }



    public function side()
    {
        $views = View::paginate(5);

        return view('system-mgmt/view/side', ['views' => $views]);
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




        $views = Viewpartner::all();
        return view('system-mgmt/view-partner/create',['views' => $views,'tree'=>$tree]);
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
         Viewpartner::create([
            'name' => $request['name'],
            'view_url' => $request['view_url'],
            'belong_to' => $request['belong_to'],
			         'add_to_side' => $request['add_to_side'],
			            'sub_node' => $request['sub_node'],
      'priority' => $request['priority'],
        ]);

        return redirect()->intended('/admin/viewpartner');
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


        $view =Viewpartner::find($id);
		$views =Viewpartner::all();
        // Redirect to department list if updating department wasn't existed
        if ($view == null) {
          $view = Viewpartner::find($id);
          $data = array(
              'view' => $view
            );
            return redirect()->intended('/admin/viewpartner');
        }

        return view('system-mgmt/view-partner/edit', ['view' => $view,'views' => $views,'tree'=>$tree]);
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
        $view = Viewpartner::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'view_url' => $request['view_url'],
            'belong_to' => $request['belong_to'],
			'add_to_side' => $request['add_to_side'],
			'sub_node' => $request['sub_node'],
      'priority' => $request['priority'],
        ];
        Viewpartner::where('id', $id)
            ->update($input);

        return redirect()->intended('/admin/viewpartner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Viewpartner::where('id', $id)->delete();
         return redirect()->intended('/admin/viewpartner');
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
            'v.name' => $request['name']
            ];

       $views = $this->doSearchingQuery($constraints);
       $constraints['name'] = $request['name'];
       return view('system-mgmt/view-partner/index', ['views' => $views, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('views_partner as v')
      ->leftJoin('views_partner as vi', 'v.belong_to', '=', 'vi.id')
      ->select('v.*','vi.name as view_name', 'vi.id as view_id');
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
        //'name' => 'unique:views',
        'view_url' => 'required|'
    ]);
    }
}
