<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Promotion;
use App\Http\Controllers\SidebarController;
class PromotionController extends Controller
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
      //  $data = Promotion::$colName;
      //$col =
      $data = Promotion::paginate(30);
        //return $data;

        return view('system-mgmt/promotion/index', ['data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'system-mgmt/promotion/create');
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
         Promotion::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'percent_promotion' => $request['percent_promotion'],
            'valid_from' => $request['valid_from'],
            'valid_to' => $request['valid_to'],

        ]);
        return redirect ('/admin/promotion');
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
      return view( 'system-mgmt/promotion/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Promotion::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Promotion::find($id);

            return redirect ('/admin/promotion');
        }

        return view( 'system-mgmt/promotion/edit', ['data' => $data]);
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
        $structure = Promotion::findOrFail($id);
        $this->validateInput($request);
        $input = [
          'name' => $request['name'],
          'description' => $request['description'],
          'percent_promotion' => $request['percent_promotion'],
          'valid_from' => $request['valid_from'],
          'valid_to' => $request['valid_to'],
        ];
        Promotion::where('id', $id)
            ->update($input);

        return redirect ('/admin/promotion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Promotion::where('id', $id)->delete();
         return redirect ('/admin/promotion');
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
            'description' => $request['description']
            ];

       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/promotion/index', ['data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Promotion::query();
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
      //  'name' => 'required|max:60|unique:asset_cat'
    ]);
    }
}
