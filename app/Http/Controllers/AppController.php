<?php
namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class AppController extends Controller
{

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

public function blockbtu($currentstruc,$currentid,$notebook){

    $CurrentDivisions = Block::where('under_block', '=', NULL )->pluck('id');
    $result =$notebook;
    $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
  //  $ChildDivisions = Block::whereIn('id',$currentid)->pluck('under_block');
  //  $ChildDivisions = Block::whereIn('id',$CurrentDivisions )->pluck('id');
    foreach ( $ChildDivisions as $Division => $get) {
      $nextblockID[$Division] = $get;
      $arraylength = sizeof($result);
      //$currentid=$currentid;
      $result[$arraylength]  = $nextblockID[$Division];
      $result = $this->blockbtu($currentstruc,$nextblockID,$result);
      }

      return $result;
}
    public function getIndex()
    {
        return view('index');
    }

    public function getAuthorPage()
    {
        return view('author');
    }
    public function getAdminPage()
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


           $views = View::whereIn('id',$matchviews )
                          ->where('belong_to','=',NULL )->get();
                          $viewss = View::whereIn('id',$matchviews )
                                         ->pluck('id');
                                         $viewss =$viewss->toArray();
           $tree='<li class="treeview"></li>';
           foreach ($views as $view) {

                if(count($view->childs) &&in_array($view->id, $viewss)&& $view->add_to_side == "Yes"){
                  $tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i>'.$view->name.'     <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span></a>';

                }elseif($view->add_to_side == "Yes"){
                  $tree .='<li class="treeview" ><a  href ="'.$view->view_url.'"><i class="fa fa-link"></i>'.$view->name.'
                          </span></a>';
                }

                if(count($view->childs)) {

                   $tree .=$this->childView($view,$viewss);
               }
           }
           $tree .='<ul class="sidebar-menu">';


        $users = User::all();
        return view('admin', ['users' => $users,'tree'=>$tree]);
    }


	public function childView($view,$viewss){






        $html ='<ul class="treeview-menu">';
        foreach ($view->childs as $arr) {

            if(count($arr->childs) && in_array($arr->id, $viewss) && $view->add_to_side == "Yes"){

            $html .='<li> <a  href ="'.$arr->view_url.'"class=""><i class="fa fa-link"></i>'.$arr->name.'   <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span></a> ';
                    $html.= $this->childView($arr,$viewss);


                }elseif($view->add_to_side == "Yes" && in_array($arr->id, $viewss)){

                    $html .='<li class="treeview"><a href ="'.$arr->view_url.'"class="">'.$arr->name.'  </a>' ;
                    $html .="</li>";

                }

        }
        $html .="</ul>";

        return $html;
}
    public function getGenerateArticle()
    {
        return response('Article generated!', 200);
    }

    public function postAdminAssignRoles(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        if ($request['role_user']) {
            $user->roles()->attach(Role::where('name', 'User')->first());
        }
        if ($request['role_author']) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request['role_admin']) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect()->back();
    }


}
