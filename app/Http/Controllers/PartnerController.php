<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Block;
use App\Structure;
use App\Portfolio;
use App\Partner;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Person;
use Illuminate\Support\Facades\Hash;
use App\Province;
use App\match_id;
use App\Http\Controllers\SidebarController;
class PartnerController extends Controller
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
        $data = Partner::paginate(20);
        $partner = Partner::all();

        return view('admin/partnermanage/index', ['partner' => $partner,'data' => $data]);
    }


    public function create()
    {
        $province = Province::all();
        $currentyear = date('Y') + 543;
        $member = Person::all();
         return view('admin/partnermanage/create', ['currentyear' => $currentyear,'province' => $province,'member' => $member]);
    }

    public function selectmember()
    {
        $province = Province::all();
        $currentyear = date('Y') + 543;
        $member = Person::all();
         return view('admin/partnermanage/selectmember', ['currentyear' => $currentyear,'province' => $province,'member' => $member]);
    }

    public function store(Request $request)
    {
      $url  = url()->previous();

      if(strstr($url, 'selectmember'))
      {

        $member = Person::where('id',$request->member_id)->get();
         foreach($member as $m)
         {
           $memberemail = Partner::pluck('email')->toArray();
           if(in_array($m->email,$memberemail) )
           {
             $request->session()->flash('alert-danger', 'Email Already Used');
             return redirect()->back();
           }
           $partner = new Partner;
           $partner->name = $m->name;
           $partner->lastname = $m->lname;
           $partner->email = $m->email;
           $partner->mobile = $m->mobile;
           $partner->citizen_id = $m->id_num;
           $partner->password = Hash::make($partner->citizen_id);
           $partner->status = 2;
           $partner->save();
           $match_id = new match_id;
                        $match_id->public_name = $partner->name;
                        $match_id->public_email = $partner->email;
                        $match_id->public_mobile = $partner->mobile;
                        $match_id->sender_citizen = $partner->citizen_id;
                        $match_id->partner_id = $partner->id;
                        $match_id->save();

         }

         return redirect('/admin/partnermanage');
      }
    $this->validate($request, [

        'mobile' => 'required|min:6',
      //  'id_num' => 'required|numeric',
      'email' => 'required|email|max:255|unique:partner',
        'id_num' => 'required|min:13|unique:persons',

      ],
      [ 'name.required' => 'กรุณาใส่ชื่อของท่าน',
      'password.required' => 'กรุณาใส่รหัสผ่านของท่าน',
      'password.min' => 'รหัสผ่านต้องไม่น้อยกว่า6ตัวอักษร',

       'password.confirmed' => 'ขออภัยท่านใส่รหัสผ่านไม่ตรงกัน']
      );
        date_default_timezone_set('Asia/Bangkok');
        date('D-m-y H:i:s');
        //return('yesy');
        $partner = new Partner;
        $partner->name = $request->name;
        $partner->lastname = $request->lname;
        $partner->email = $request->email;
        $partner->mobile = $request->mobile;
        $partner->citizen_id = $request->id_num;
        $partner->password = Hash::make($partner->citizen_id);
        $partner->status = 2;
        $partner->save();

        $match_id = new match_id;
                     $match_id->public_name = $partner->name;
                     $match_id->public_email = $partner->email;
                     $match_id->public_mobile = $partner->mobile;
                     $match_id->sender_citizen = $partner->citizen_id;
                     $match_id->partner_id = $partner->id;
                     $match_id->save();
        return redirect('/admin/partnermanage');
    //    $partner->name = $request->name;

      }

    public function changestatuspartner(Request $request)
    {

      $statusid = $_SERVER['REQUEST_URI'];
      $statusid = explode('/',$statusid);
      $statusid = $statusid[3];
      $pid = $_SERVER['REQUEST_URI'];
      $pid = explode('/',$pid);
      $pid = $pid[4];
      $current = Auth::user()->id;
      $input = [
          'status' => $statusid,
          'verify_by' => $current,
      ];

      Partner::where('id', $pid)
            ->update($input);
            $partner = Partner::find($pid);

      $request->session()->flash('alert-success', 'เปลี่ยนข้อมูลเรียบร้อยแล้ว');
      return redirect('/admin/partnermanage');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Partner::where('id', $id)->delete();
         return redirect('/admin/partnermanage');
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
            'partner.id' => $request['partner_id'],
            'partner.mobile' => $request['mobile'],
            'partner.email' => $request['email'],
            'partner.citizen_id' => $request['citizen_id'],
            'partner.status' => $request['status'],
            ];
    $data = $this->doSearchingQuery($constraints);
    $partner = Partner::all();
    return view('admin/partnermanage/index', ['partner' => $partner,'data' => $data, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query  = Partner::query();
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
