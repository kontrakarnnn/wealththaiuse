<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\role;
use App\Structure;
use App\Block;
use App\match_id;
use Response;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Division;
use App\Http\Controllers\SidebarController;

use Illuminate\Support\Facades\Hash;


class UserManagementController extends Controller
{
       /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/user-management';

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




/*function index()
    {
     $data = DB::table('users')->orderBy('id', 'asc')->paginate(5);
     return view('users-mgmt/index', compact('data'));
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $sort_by = $request->get('sortby');
      $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
      $data = DB::table('users')
                    ->where('id', 'like', '%'.$query.'%')
                    ->orWhere('firstname', 'like', '%'.$query.'%')
                    ->orWhere('lastname', 'like', '%'.$query.'%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
      return view('pagination_data', compact('data'))->render();
     }
   }*/


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



        $users = DB::table('users')
        ->leftJoin('structure', 'users.structure_id', '=', 'structure.id')
        ->Join('match_id','match_id.user_id','=','users.id')

        ->select('users.*','match_id.id as user_pid')

        ->paginate(20);

        return view('users-mgmt/index', ['users' => $users,'tree'=>$tree]);
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $sort_by = $request->get('sortby');
      $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
      $users = DB::table('users')
      ->leftJoin('structure', 'users.structure_id', '=', 'structure.id')
      ->Join('match_id','match_id.user_id','=','users.id')
      ->orWhere('users.username', 'like', '%'.$query.'%')
      ->orWhere('users.firstname', 'like', '%'.$query.'%')
      ->orWhere('users.lastname', 'like', '%'.$query.'%')
      ->orWhere('users.email', 'like', '%'.$query.'%')
      ->orWhere('users.status', 'like', '%'.$query.'%')
      ->orWhere('match_id.id', 'like', '%'.$query.'%')
      ->select('users.*','match_id.id as user_pid')
      ->orderBy($sort_by, $sort_type)
      ->paginate(20);
      return view('users-mgmt/pagination_data', compact('users'))->render();
     }
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

      $structures = Structure::all();
      $blocks = Block::all();
        return view('users-mgmt/create',['structures' => $structures, 'blocks' => $blocks,'tree'=>$tree]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->savedata($request);
        return redirect()->intended('/admin/user-management');
    }
    function savedata($request)
    {
      		$user = new User;
          $user->username = $request->username;
          $user->email = $request->email;
          $user->password = Hash::make($request->password);
          $user->firstname = $request->firstname;
          $user->lastname = $request->lastname;
          $user->limit_prospect = $request->limit_prospect;
          $user->user_code = $request->user_code;
          $user->mobile_number = $request->mobile_number;
          $user->status = 'Active';
          $user->save();
      		$match_id = new match_id;
          $match_id->public_name = $user->firstname;
          $match_id->public_email = $user->email;
          $match_id->user_id = $user->id;
          $match_id->public_mobile = $user->mobile_number;
          $match_id->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


        $user = User::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($user == null)  {
          $user = User::find($id);
          $data = array(
              'user' => $user
          );
            return redirect()->intended('/admin/user-management');
        }

        return view('users-mgmt/edit', ['user' => $user,'tree'=>$tree]);
    }

    public function repassword($id)
    {
      //sidebar

  $tree = session()->get('tree');
  //sidebar


        $user = User::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($user == null)  {
          $user = User::find($id);
          $data = array(
              'user' => $user
          );
            return redirect()->intended('/admin/user-management');
        }

        return view('users-mgmt/repassword', ['user' => $user,'tree'=>$tree]);
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
        $user = User::findOrFail($id);
        $constraints = [
            'username' => 'required|max:20',
            'firstname'=> 'required|max:60',
            'lastname' => 'required|max:60',

            ];
        $input = [
        //  $user->password = Hash::make($request->password);
            'username' => $request['username'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'status' => $request['status'],
            'limit_prospect' => $request['limit_prospect'],
            //'password' => Hash::make($request['password']),

        ];
        if ($request['password'] != null && strlen($request['password']) > 0) {
            $constraints['password'] = 'required|min:6|confirmed';
            $input['password'] =  bcrypt($request['password']);
        }
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);

        return redirect()->intended('/admin/user-management');
    }

    public function uppass(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $input = [
        //  $user->password = Hash::make($request->password);

            'password' => Hash::make($request['password']),

        ];
        if ($request['password'] != null && strlen($request['password']) > 0) {
            $constraints['password'] = 'required|min:6|confirmed';
            $input['password'] =  bcrypt($request['password']);
        }
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);
          $request->session()->flash('alert-success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว!! ');
        return redirect()->intended('/admin/user-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        match_user_id::where('user_id',$id)->delete();
        User_auth::where('user_id',$id)->delete();
        match_id::where('member_id', $id)->delete();
        User::where('id', $id)->delete();
         return redirect()->intended('/admin/user-management');
    }

    /**
     * Search user from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {

      //sidebar

  $tree = session()->get('tree');
  //sidebar

        $constraints = [
            'username' => $request['username'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'structure.name' => $request['structure_name'],
            'block.name' => $request['block_name'],
			'email' =>$request['email']
            ];

       $users = $this->doSearchingQuery($constraints);
       $constraints = ['structure_name' => $request['structure_name'],
                   'block_name' => $request['block_name'],
                   'username' => $request['username'],
                   'firstname' => $request['firstname'],
                   'lastname' => $request['lastname'],
					'email' =>$request['email']
                 ];
       return view('users-mgmt/indexsave', ['users' => $users, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('users')
        ->leftJoin('structure', 'users.structure_id', '=', 'structure.id')
        ->Join('match_id','match_id.user_id','=','users.id')

        ->select('users.*','match_id.id as user_pid');
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
        'username' => 'required|max:20',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'firstname' => 'required|max:60',
        'lastname' => 'required|max:60'
    ]);
    }




}
