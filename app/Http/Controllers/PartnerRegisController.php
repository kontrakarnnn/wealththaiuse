<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\match_id;
use App\Asset_cat;
use App\ToolCategory;
use App\Partner;
use App\Http\Controllers\SidebarpartnerController;
use Crypt;
use Session;

class PartnerRegisController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:person');
    }

    public function index()
    {
      $current = Auth::guard('person')->user()->id;
      $data = Partner::where('member_id',$current)->value('status');
        return view('member/partnerregister/index', ['data' => $data]);
    }

    public function gotopartner(Request $request)
    {
      $current = Auth::guard('person')->user()->id;



      if(Auth::guard('partner')->attempt(['email' => Auth::guard('person')->user()->email,'password' => $request->password,'status' => 2],$request->remember)){
        $sidepart = new SidebarpartnerController();
      $sidepart = $sidepart->getSide();
      Session::put('sidepart', $sidepart);

    return redirect('/wealththaipartner/dashboard');
  }
  $request->session()->flash('alert-danger', 'รหัสผ่านไม่ถูกต้อง');
    return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'system-mgmt/tool-category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //$current = Auth::guard('person')->user()->id;
      $this->validate($request, [
       'member_id' => 'required|max:255|unique:partner',
      ],
        [ 'member_id.unique' => 'ท่านทำการสมัครเรียบร้อยแล้ว']);

         $partner = new Partner;
         $partner->name  = Auth::guard('person')->user()->name;
         $partner->lastname  = Auth::guard('person')->user()->lname;
         $partner->email  = Auth::guard('person')->user()->email;
         $partner->password  = Auth::guard('person')->user()->password;
         $partner->citizen_id  = Auth::guard('person')->user()->id_num;
         $partner->member_id  = Auth::guard('person')->user()->id;
         $partner->status  = 1;
         $partner->save();
         $match_id = new match_id;
                      $match_id->public_name = $partner->name;
                      $match_id->public_email = $partner->email;
                      $match_id->public_mobile = $partner->mobile;
                      $match_id->sender_citizen = $partner->citizen_id;
                      $match_id->partner_id = $partner->id;
                      $match_id->save();
         //return $partner;
      $request->session()->flash('alert-success', 'ลงทะเบียนเรียบร้อยแล้ว กรุณารอการอนุมัติจากระบบ');
       return redirect()->back();
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
      return view( 'system-mgmt/tool-category/index', compact(['structures','blocks','tree']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ToolCategory::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($data == null) {
          $data = ToolCategory::find($id);

            return redirect ('/admin/tool-category');
        }

        return view( 'system-mgmt/tool-category/edit', ['data' => $data]);
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
        $structure = ToolCategory::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'description' => $request['description']
        ];
        ToolCategory::where('id', $id)
            ->update($input);

        return redirect ('/admin/tool-category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ToolCategory::where('id', $id)->delete();
         return redirect ('/admin/tool-category');
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
       return view( 'system-mgmt/tool-category/index', ['data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = ToolCategory::query();
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
        'member_id' => 'required|max:60|unique:partner'
    ]);
    }
}
