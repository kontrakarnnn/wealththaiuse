<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\ActionType;
use App\ActionCategory;
use App\Action;
use App\Http\Controllers\SidebarController;
class ActionController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $data = Action::paginate(30);
      $actioncategory = ActionCategory::all();
      $actiontype = ActionType::all();
      $action = Action::all();

        return view('system-mgmt/action/index',compact(['action','actiontype','actioncategory','data']));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $actiontype = ActionType::all();
        return view( 'system-mgmt/action/create',compact(['actiontype']));
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
         Action::create([
            'name' => $request['name'],
            'type_id' => $request['type_id'],
            'action_para_name1' => $request['action_para_name1'],
            'action_para_name2' => $request['action_para_name2'],
            'action_para_name3' => $request['action_para_name3'],
            'action_para_name4' => $request['action_para_name4'],
            'action_para_name5' => $request['action_para_name5'],
            'action_para_name6' => $request['action_para_name6'],
            'action_para_name7' => $request['action_para_name7'],
            'action_para_name8' => $request['action_para_name8'],
            'action_para_name9' => $request['action_para_name9'],
            'action_para_name10' => $request['action_para_name10'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/action');
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
      return view( 'system-mgmt/action/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Action::find($id);
        $actiontype = ActionType::all();
        if ($data == null) {
          $data = Action::find($id);

            return redirect ('/admin/action');
        }

        return view( 'system-mgmt/action/edit',compact(['actiontype','data']));
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
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'type_id' => $request['type_id'],
          'action_para_name1' => $request['action_para_name1'],
          'action_para_name2' => $request['action_para_name2'],
          'action_para_name3' => $request['action_para_name3'],
          'action_para_name4' => $request['action_para_name4'],
          'action_para_name5' => $request['action_para_name5'],
          'action_para_name6' => $request['action_para_name6'],
          'action_para_name7' => $request['action_para_name7'],
          'action_para_name8' => $request['action_para_name8'],
          'action_para_name9' => $request['action_para_name9'],
          'action_para_name10' => $request['action_para_name10'],
          'description' => $request['description']
        ];
        Action::where('id', $id)
            ->update($input);

        return redirect ('/admin/action');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Action::where('id', $id)->delete();
         return redirect ('/admin/action');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name'],
            'cat_id' => $request['cat_id'],
            'description' => $request['description'],
            ];

       $data = $this->doSearchingQuery($constraints);
       $actiontype = ActionType::all();
       $actioncategory = ActionCategory::all();


       return view( 'system-mgmt/action/index', ['actioncategory' => $actioncategory, 'actiontype' => $actiontype, 'data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = ActionType::query();
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
        'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
