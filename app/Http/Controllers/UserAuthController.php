<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Structure;
use App\Block;
use App\User;
use App\User_auth;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Http\Controllers\SidebarController;

class UserAuthController extends Controller
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


      $userauths = DB::table('user_auths')
      ->leftJoin('users', 'user_auths.user_id', '=', 'users.id')
     ->leftJoin('structure', 'user_auths.structure_id', '=', 'structure.id')
     ->leftJoin('block', 'user_auths.block_id', '=', 'block.id')

     ->select('user_auths.id','user_auths.description', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as block_id','users.username as user_name', 'users.id as user_id')

     ->paginate(10);
     return view('system-mgmt/userauth/index', ['userauths' => $userauths,'tree'=>$tree]);
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

       $users = User::all();

        return view('system-mgmt/userauth/create', ['structures' => $structures, 'blocks' => $blocks, 'users' => $users,'tree'=>$tree]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

       Structure::findOrFail($request['structure_id']);
       Block::findOrFail($request['block_id']);
       User::findOrFail($request['user_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
        User_auth::create([
          'user_id' => $request['user_id'],
          'structure_id' => $request['structure_id'],
          'block_id' => $request['block_id'],
          'description' => $request['description']

       ]);


         return redirect ('admin/userauth');
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

         $userauth = User_auth::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($userauth == null) {
           $userauth = User_auth::find($id);
           $data = array(
               'userauth' => $userauth
             );
             return redirect ('/admin/userauth');
           }
           $structures = Structure::all();
           $blocks = Block::all();
           $users = User::all();
         return view('system-mgmt/userauth/edit', ['userauth' => $userauth,'structures' => $structures,'blocks' => $blocks,'users' => $users,'tree'=>$tree]);
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
         $userauth = User_auth::findOrFail($id);
         $input = [
           'user_id' => $request['user_id'],
           'structure_id' => $request['structure_id'],
           'block_id' => $request['block_id'],
           'description' => $request['description']

         ];
         $this->validate($request, [
         'user_id' => 'nullable|max:60',
         'structure_id' => 'nullable|max:60',
         'block_id' => 'nullable|max:60',
         'description' => 'nullable|max:60'
         ]);
         User_auth::where('id', $id)
             ->update($input);

         return redirect ('/admin/userauth');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         User_auth::where('id', $id)->delete();
          return redirect ('/admin/userauth');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */
     public function search(Request $request) {

       //sidebar

   $tree = session()->get('tree');
   //sidebar

          $constraints = [
           'user_id' => $request['user_id'],
           'structure_id' => $request['structure_id'],
           'block_id' => $request['block_id'],
           'description' => $request['description'],
           'structure.name' => $request['structure_name'],
           'block.name' => $request['block_name'],
            'users.username' => $request['user_name']
             ];

        $userauths = $this->doSearchingQuery($constraints);
        $constraints['structure_name'] = $request['structure_name'];
        $constraints['user_name'] = $request['user_name'];
        $constraints['block_name'] = $request['block_name'];
        return view('system-mgmt/userauth/index', ['userauths' => $userauths, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
                $query = DB::table('user_auths')
         ->leftJoin('users', 'user_auths.user_id', '=', 'users.id')
        ->leftJoin('structure', 'user_auths.structure_id', '=', 'structure.id')
        ->leftJoin('block', 'user_auths.block_id', '=', 'block.id')

        ->select('user_auths.id','user_auths.description', 'structure.name as structure_name',
         'structure.id as structure_id','block.name as block_name', 'block.id as block_id','users.username as user_name', 'users.id as user_id');


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
           'user_id' => 'nullable|max:60',
           'structure_id' => 'nullable|max:60',
           'block_id' => 'nullable|max:60',
           'description' => 'nullable|max:60'

     ]);
     }
 }
