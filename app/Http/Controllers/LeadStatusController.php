<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lead_Status;
use App\Person;
use App\Block;
use App\Structure;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Http\Controllers\SidebarController;
class LeadStatusController extends Controller
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
        $leadstatus = DB::table('lead_status')
        ->paginate(30);
        return view('system-mgmt/leadstatus/index', ['leadstatus' => $leadstatus]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system-mgmt/leadstatus/create');
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

      $leadstatus = new Lead_Status;
      $leadstatus->name = $request->name;
      $leadstatus->save();

       $request->session()->flash('alert-success', 'เพิ่มข้อมูลเรียบร้อย');
        return redirect ('/admin/leadstatus');
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

        $leadstatus = Lead_Status::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($leadstatus == null) {
          $leadstatus = Lead_Status::find($id);
          $data = array(
              'leadstatus' => $leadstatus
            );
            return redirect ('/admin/leadstatus');
        }

        return view('system-mgmt/leadstatus/edit', ['leadstatus' => $leadstatus]);
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

      $leadstatus = Lead_Status::find($id);
      $leadstatus->name = $request->name;
      $leadstatus->save();

       $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อย');

        return redirect ('/admin/leadstatus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lead_Status::where('id', $id)->delete();
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

       $leadstatus = $this->doSearchingQuery($constraints);

       return view('system-mgmt/leadstatus/index', ['leadstatus' => $leadstatus, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('lead_status');
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
