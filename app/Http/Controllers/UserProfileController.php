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


class UserProfileController extends Controller
{
       /**
     * Where to redirect users after registration.
     *
     * @var string
     */
  //  protected $redirectTo = '/admin/user-management';

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

    $current = Auth::user()->id;

        $users = DB::table('users')

        ->leftJoin('structure', 'users.structure_id', '=', 'structure.id')
        ->where('users.id',$current)

        ->select('users.*')

        ->paginate(20);
        //return $users;

        $mypid = DB::table('match_id')->where('user_id',$current)->get();
        $mypidnum = DB::table('match_id')->where('user_id',$current)->value('id');

        return view('userprofile/index', ['mypidnum' => $mypidnum,'mypid' => $mypid,'users' => $users,'tree'=>$tree]);
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
    public function edit($id)
    {
      //sidebar

  $tree = session()->get('tree');
  //sidebar

	$current = Auth::user()->id;
        // Redirect to user list if updating user wasn't existed
        if($id == $current){
          $user = User::find($id);
        $data = array(
            'user' => $user
        );

        return view('userprofile/edit', ['user' => $user,'tree'=>$tree]);
      }

              return view('error');
        }





    public function repassword($id)
    {
      //sidebar

    $tree = session()->get('tree');
    //sidebar
		$current = Auth::user()->id;
           if($id == $current){
             $user = User::find($id);
           $data = array(
               'user' => $user
           );

           return view('userprofile/repassword', ['user' => $user,'tree'=>$tree]);
           }

                 return view('error');
           }


        // Redirect to user list if updating user wasn't existed





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
          //  'status' => $request['status'],
            //'password' => Hash::make($request['password']),

        ];
        if ($request['password'] != null && strlen($request['password']) > 0) {
            $constraints['password'] = 'required|min:6|confirmed';
            $input['password'] =  bcrypt($request['password']);
        }
        $this->validate($request, $constraints);
        User::where('id', $id)
            ->update($input);
              $request->session()->flash('alert-success', 'แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว ');
        return redirect()->intended('/userprofile');
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
        return redirect()->intended('/userprofile');
    }

    public function uppid(Request $request, $id)
    {
        $user = match_id::findOrFail($id);

        $input = [
        //  $user->password = Hash::make($request->password);

            'public_name' => $request['public_name'],
            'public_email' => $request['public_email'],
            'public_mobile' => $request['public_mobile'],

        ];


        match_id::where('id', $id)
            ->update($input);
          $request->session()->flash('alert-success', 'เปลี่ยนข้อมูล Public ID เรียบร้อยแล้ว!! ');
        return redirect()->intended('/userprofile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
       return view('users-mgmt/index', ['users' => $users, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('users')
        ->leftJoin('structure', 'users.structure_id', '=', 'structure.id')
        ->leftJoin('block', 'users.block_id', '=', 'block.id')
        ->select('users.username as user_name', 'users.*','structure.name as structure_name', 'structure.id as structure_id', 'block.name as block_name', 'block.id as block_id');
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


public function mypid($id){
  //sidebar

  $tree = session()->get('tree');
  //sidebar
$current = Auth::user()->id;
         $mypidnum = DB::table('match_id')->where('user_id',$current)->value('id');

    // Redirect to user list if updating user wasn't existed
    if($id == $mypidnum){
      $user = match_id::find($id);
    $data = array(
        'user' => $user
    );

    return view('userprofile/pid', ['user' => $user,'tree'=>$tree]);
  }

          return view('error');
    }
    public function uplineuserid()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?',$url);
        $url = $url[1];

        $current = Auth::user()->id;
        $input = [
        //  $user->password = Hash::make($request->password);
            'line_user_id' =>$url,
        ];

        User::where('id', $current)
            ->update($input);
        //  $request->session()->flash('alert-success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว!! ');

		        app('\App\Http\Controllers\LineBotController')->linebotupdateconfirm();

          $url2 = 'http://nav.cx/2sri9v4';
        return redirect($url2);
    }

}
