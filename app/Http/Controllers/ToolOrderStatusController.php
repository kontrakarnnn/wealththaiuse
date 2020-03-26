<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\ToolType;
use App\ToolCategory;
use App\Tool_Order_Status;
use App\Http\Controllers\SidebarController;
class ToolOrderStatusController extends Controller
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
        $data = Tool_Order_Status::paginate(30);
        return view('system-mgmt/tool-order-status/index', ['data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'system-mgmt/tool-order-status/create');
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
         Tool_Order_Status::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);
        return redirect ('/admin/tool-order-status');
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
        $data = Tool_Order_Status::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = Tool_Order_Status::find($id);

            return redirect ('/admin/tool-order-status');
        }

        return view( 'system-mgmt/tool-order-status/edit', ['data' => $data]);
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
        $structure = Tool_Order_Status::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'description' => $request['description']
        ];
        Tool_Order_Status::where('id', $id)
            ->update($input);

        return redirect ('/admin/tool-order-status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tool_Order_Status::where('id', $id)->delete();
         return redirect ('/admin/tool-order-status');
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
            ];
       $data = $this->doSearchingQuery($constraints);
       return view( 'system-mgmt/tool-order-status/index', ['data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Tool_Order_Status::query();
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
