<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

use App\User;
use App\match_view;
use App\View;
use App\User_group;
use App\Pid_group;
use App\Structure;
use App\Block;
use App\Http\Controllers\SidebarController;
class MatchViewController extends Controller
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

	     public function getArrayAllddBlock($currentstruc,$currentid,$notebook){

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









    public function getArrayAlldBlock($currentstruc,$currentid,$notebook){

        $CurrentDivisions = Block::where('id', '=',$currentid )->get();
        $result =$notebook;
     //$arraylength = sizeof($result);
        //$currentid=$currentid;
     //  $result[$arraylength]  = $currentid;

       /* $arraylength = sizeof($result);
        //$currentid=$currentid;
        $result[$arraylength]  = $currentid;*/
     /*   $ChildDivisions = DB::table('block')

         //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา
           ->whereIn('block.under_block',$currentid)
           ->select('block.*')
           ->get();*/
         //  $payments = Payment::whereIn('status_id', $statuses)->get();
    $ChildDivisions = Block::whereIn('under_block',$currentid )->pluck('id');

     //  $ChildDivisions = Block::where('under_block','=',$currentid )->get();

       //  $ChildDivisions =  $ChildDivisions->whereIn('under_block',$currentid)->get();
     //  if (is_array($ChildDivisions) || is_object($ChildDivisions))
   //    {

           /*  foreach ( $ChildDivisions as $Division ) {
              $status = $Division->status;
               $currentstruc =$Division->structure_id;
               $nextblockID[$currentstruc] = $Division->id;
               $arraylength = sizeof($result);
               //$currentid=$currentid;

               $result[$arraylength]  = $nextblockID;
               $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);

              // $result = array_merge_recursive($result,$currentid);
           }*/

         /*  $Divisions = Block::where('structure_id','=',$currentstruc )->get();
           foreach ( $Divisions as $Division ) {
           $status = $Division->status;
             $nextblockID = $Division->id;
             $arraylength = sizeof($result);
             //$currentid=$currentid;
             $result[$arraylength]  = $nextblockID;
             $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);

            // $result = array_merge_recursive($result,$currentid);
         }*/


            foreach ( $ChildDivisions as $Division => $get) {
             // echo  $get;
              //$status = $get->status;
             // $nextblockID[$get] = $Division;
              $nextblockID[$Division] = $get;
              $arraylength = sizeof($result);
              //$currentid=$currentid;
              $result[$arraylength]  = $nextblockID[$Division];
              $result = $this->getArrayAlldBlock($currentstruc,$nextblockID,$result);

             // $result = array_merge_recursive($result,$currentid);
           }
//}
   //$result = array_merge_recursive($result,$arraylength);

      return $result;

    }

    public function getAlldBlock($currentid,$menudepth,$notebook){



        $CurrentDivisions = Block::where('id', '=',$currentid )->get();
        $count = $menudepth;
        $result ='<ul>';
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';

       /* @foreach(App\Structure::whereIn('id',$currentstruc)->get(); as $depList)
        <li><a href="{{url('portfolio')}}/{{$depList->name}}">
          {{$depList->name}}</a></li>
        @endforeach*/

        foreach ($CurrentDivisions as $Division) {
          $tree .='<li class="tree-view closed"<a  class="tree-name">'.$Division->name.'</a>';

          $status = $Division->status;
          if($count == 0){
               $result .='<li class="tree-view closed"><a  href="'.$Division->name.   ' "class="tree-name">'.$Division->name.'</a>'.' Category current Block ID is  :' .$currentid.'count:'.$count;

          }else{
                $result .='<li class="tree-view closed"><a href="'.$Division->name.   ' ">'.$Division->name.   ' <b>Status:</b> '.$status.'</a>';
          }

        }
         $count++;

       $ChildDivisions = Block::where('under_block', '=',$currentid )->get();
       foreach ($ChildDivisions as $Division) {
            $status = $Division->status;
            $nextblockID = $Division->id;
            if($status== 1){
                $result .= $this->getAlldBlock($nextblockID,$count,$notebook);
                $result   .="</li>";
            }else{
                  $result .=$this->getAlldBlock($nextblockID,$count,$notebook);
            }
          //  $tree .='<li class="tree-view closed"<a class="tree-name">'.$Division->name.'Status: '.$status.'</a>';

       }
       $result .="</ul>";
       return $result;


    }




    public function fib(Request $request)
    {
      $current = Auth::user()->id;


        $currentid = DB::table('user_auths')

                ->where([
                          [ 'user_id', '=', $current]

                       ])
                       ->pluck('block_id');

             //  $CurrentDivisions = $CurrentDivisions->toArray();


     //$currentid = Auth::user()->block_id;
     $menudepth = 0;
     $notebook = array();

    $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
    $tree .=$this->getAlldBlock($currentid,$menudepth,$notebook);
    $notebook = $this->getArrayAlldBlock($currentid,$notebook);
    /*
    $tree .='this is test to check value in arrays size :'.sizeof($notebook).'<br>';
    $count = 0;
    $size = sizeof($notebook);
      while($count<$size){
        $tree .='in notebook:'.$count.'their value is'.$notebook[$count].'<br>';
        $count++;
      }
    */
    $tree .='<ul>';



    return view('files.treeview',['tree' => $tree]);
    return $tree;


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


		$matchviews = DB::table('match_views as m')
      ->leftJoin('views', 'm.view_id', '=', 'views.id')

     ->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
     ->leftJoin('block as b', 'm.block_id', '=', 'b.id')
     ->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
     ->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')


    ->leftJoin('users', 'm.user_id', '=', 'users.id')
    ->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

   ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

     ->select('m.*','m.id', 'views.name as view_name', 'views.id as view_id','users.username as user_name',
      'users.id as user_id','structure.name as structure_name', 'structure.id as strucutre_id','b.name as block_name','bt.name as blocktop_name','bb.name as blockbottom_name', 'b.id as block_id', 'bt.id as blocktop_id', 		'bb.id as blockbottom_id',
      'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','user_groups.name as user_group_name', 'user_groups.id as user_group_id')

     ->paginate(100);
     return view('system-mgmt/match-view/index', ['matchviews' => $matchviews,'tree' =>$tree]);
    }



    public function sideview()
    {
      $current = Auth::user()->id;
      $currentstruc = DB::table('user_auths')

              ->where([
                        [ 'user_id', '=', $current]

                     ])
                     ->pluck('structure_id');
          $currentstruc = $currentstruc->toArray();

          $currentmatchids = DB::table('match_id')

                  ->where([
                            [ 'user_id', '=', $current]

                         ])
                         ->pluck('id');
              $currentmatchids = $currentmatchids->toArray();
              $currentpidgroups = DB::table('match_pid_groups')

                      ->where([
                                [ 'p_id', '=', $currentmatchids]

                             ])
                             ->pluck('pid_group_id');

               $currentusergroups = DB::table('match_user_groups')

                     ->where([
                         [ 'user_id', '=', $current]

                          ])
                          ->pluck('user_group_id');
                        $s = DB::table('user_auths')->pluck('block_id');
                        $s = $s->toArray();
                          if(in_array($current, $s)){
                             $currentid = DB::table('user_auths')

                                     ->where([ //[ 'structure_id', '=', 10 ],
                                               [ 'user_id', '=', $current]

                                            ])
                                            ->pluck('block_id');

                                            $currentid = $currentid->toArray();}
                $currentid = [0];
              //  $currentid = $currentid->toArray();
                $notebook = array();
               //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
              // $notebook = array_merge_recursive($currentid,$notebook);
              $notebook = array_merge_recursive($currentid,$notebook);
              $blocktd = array();
              $blocktd = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
              $blocktd = array_merge_recursive($currentid,$blocktd);
              $blockbtu = array();
              $blockbtu = $this->blockbtu($currentstruc,$currentid,$notebook);
              $blockbtu = array_merge_recursive($currentid,$blockbtu);

              $matchviews = DB::table('match_views as m')
              ->leftJoin('views', 'm.view_id', '=', 'views.id')

             ->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
             ->whereIn(
               'structure.id',$currentstruc
             )
             ->leftJoin('block as b', 'm.block_id', '=', 'b.id')
             ->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
             ->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')


            ->leftJoin('users', 'm.user_id', '=', 'users.id')
            ->orWhere(
              'users.id',$current
            )
            ->orwhereIn(
              'pid_groups.id',$currentpidgroups
            )
            ->orwhereIn(
              'user_groups.id',$currentusergroups
            )
            ->orwhereIn(
              'b.id',$notebook
            )
            ->orwhereIn(
              'bt.id',$blocktd
            )
            ->orwhereIn(
              'bb.id',$blockbtu
            )
            ->orwhere(
              'm.all_user','=','Yes'
            )
            ->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

           ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

           ->select('m.*','m.id', 'views.name as view_name', 'views.id as view_id','users.username as user_name',
            'users.id as user_id','structure.name as structure_name', 'structure.id as strucutre_id','b.name as block_name','bt.name as blocktop_name','bb.name as blockbottom_name', 'b.id as block_id', 'bt.id as blocktop_id', 'bb.id as blockbottom_id',
            'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','user_groups.name as user_group_name', 'user_groups.id as user_group_id')
             ->pluck('view_id');

       $views = DB::table('views')
       ->whereIn(
         'views.id',$matchviews
         )
         ->get();
     //return $matchviews;
    return view('system-mgmt/match-view/sideview', ['views' => $views]);
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


       $views = View::all();
       $structures = Structure::all();
       $blocks = Block::all();
       $user_groups = User_group::all();
       $pid_groups = Pid_group::all();
       $users = User::all();
       $matchviews = match_view::all();


        return view('system-mgmt/match-view/create', [ 'users' => $users,
                                                        'matchviews' => $matchviews,
                                                        'structures' => $structures,
                                                        'blocks' => $blocks,
                                                        'user_groups' => $user_groups,
                                                        'pid_groups' => $pid_groups,
													  	'tree'=>$tree,
                                                        'views' => $views
                                                        ]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {


       //Person::findOrFail($request['member_id']); ใช้เพื่อทำให้ก่อนจะบันทึกต้องมีข้อมูลในตารางนี้ด้วย
      // User::findOrFail($request['user_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
        match_view::create([
          'view_id' => $request['view_id'],
          'structure_id' => $request['structure_id'],
          'block_id' => $request['block_id'],
		  'block_td' => $request['block_td'],
          'block_btu' => $request['block_btu'],
          'user_id' => $request['user_id'],
          'user_group_id' => $request['user_group_id'],
          'pid_group_id' => $request['pid_group_id'],
          'all_user' => $request['all_user'],


       ]);


         return redirect ('/admin/match-view');
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


         $matchview = match_view::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($matchview == null) {
           $matchview = match_view::find($id);
           $data = array(
               'matchview' => $matchview
             );
             return redirect ('/admin/match-view');
           }


           $views = View::all();
           $structures = Structure::all();
           $blocks = Block::all();
           $user_groups = User_group::all();
           $pid_groups = Pid_group::all();
           $users = User::all();


         return view('system-mgmt/match-view/edit', ['matchview' => $matchview,'users' => $users,'views' => $views,'structures' => $structures,'blocks' => $blocks,'user_groups' => $user_groups,'pid_groups' => $pid_groups,'tree'=>$tree]);
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
         $matchid = match_view::findOrFail($id);
         $input = [
           'view_id' => $request['view_id'],
           'structure_id' => $request['structure_id'],
           'block_id' => $request['block_id'],
		   'block_td' => $request['block_td'],
           'block_btu' => $request['block_btu'],
           'user_id' => $request['user_id'],
           'all_user' => $request['all_user'],
           'user_group_id' => $request['user_group_id'],
           'pid_group_id' => $request['pid_group_id'],
         ];
         $this->validate($request, [

         ]);
         match_view::where('id', $id)
             ->update($input);

         return redirect ('/admin/match-view');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         match_view::where('id', $id)->delete();
          return redirect ('/admin/match-view');
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

            'views.name' => $request['view_name'],

            'structure.name' => $request['structure_name'],
            'block.name' => $request['block_name'],
            'users.username' => $request['user_name'],
            'persons.name' => $request['member_name'],
			'user_groups.name' => $request['user_group_name'],
			'pid_groups.name' => $request['pid_group_name'],



             ];

        $matchviews = $this->doSearchingQuery($constraints);

        $constraints['view_name'] = $request['view_name'];
       $constraints['structure_name'] = $request['structure_name'];
       $constraints['block_name'] = $request['block_name'];
       $constraints['user_name'] = $request['user_name'];
       $constraints['member_name'] = $request['member_name'];
		 $constraints['user_group_name'] = $request['user_group_name'];
		 $constraints['pid_group_name'] = $request['pid_group_name'];
        return view('system-mgmt/match-view/index', ['matchviews' => $matchviews, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
       //sidebar

$tree = session()->get('tree');
//sidebar


      		$query = DB::table('match_views as m')
      ->leftJoin('views', 'm.view_id', '=', 'views.id')

     ->leftJoin('structure', 'm.structure_id', '=', 'structure.id')
     ->leftJoin('block as b', 'm.block_id', '=', 'b.id')
     ->leftJoin('block as bt', 'm.block_td', '=', 'bt.id')
     ->leftJoin('block as bb', 'm.block_btu', '=', 'bb.id')


    ->leftJoin('users', 'm.user_id', '=', 'users.id')
    ->leftJoin('user_groups', 'm.user_group_id', '=', 'user_groups.id')

   ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

     ->select('m.*','m.id', 'views.name as view_name', 'views.id as view_id','users.username as user_name',
      'users.id as user_id','structure.name as structure_name', 'structure.id as strucutre_id','b.name as block_name','bt.name as blocktop_name','bb.name as blockbottom_name', 'b.id as block_id', 'bt.id as blocktop_id', 		'bb.id as blockbottom_id',
      'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','user_groups.name as user_group_name', 'user_groups.id as user_group_id');

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


     ]);
     }
 }
