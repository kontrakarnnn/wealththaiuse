<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Department;
use App\Division;
use App\User;
use App\Person;
use App\Asset_type;
use App\View;

use App\Block;

class AssetTypeController extends Controller
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








    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		//sidebar
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

		//sidebar
      $porttypes = Asset_type::paginate(30);
      return view('system-mgmt/asset-type/index', ['porttypes' => $porttypes,'tree'=>$tree]);
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
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

           $portcat = DB::table('asset_cat')->get();
         return view('system-mgmt/asset-type/create',['portcat'=>$portcat,'tree'=>$tree]);
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
          Asset_type::create([
             'la_nla' => $request['la_nla'],
             'asset_cat' => $request['asset_cat'],
             'la_nla_type' => $request['la_nla_type'],
             'nla_sub_type' => $request['nla_sub_type'],
             'link_info' => $request['link_info'],
             'call_center' => $request['call_center'],
             'ref_info_head1' => $request['ref_info_head1'],
             'ref_info_head2' => $request['ref_info_head2'],
             'ref_info_head3' => $request['ref_info_head3'],
             'ref_info_head4' => $request['ref_info_head4'],
             'ref_info_head5' => $request['ref_info_head5'],
             'ref_info_head6' => $request['ref_info_head6'],
             'ref_info_head7' => $request['ref_info_head7'],
             'ref_info_head8' => $request['ref_info_head8'],
             'unit' => $request['unit'],


         ]);

         return redirect ('/admin/asset-type');
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
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
         //
         $porttypes = DB::table('asset_type')->where('asset_type.id',$id)
         ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
         ->select('asset_type.*','asset_cat.name as portcat_name','asset_cat.id as portcat_id')
         ->get();
        // return $porttypes;
         return view('system-mgmt/asset-type/show',['porttypes'=>$porttypes,'tree' => $tree]);
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
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


         $porttype = Asset_type::find($id);
         // Redirect to country list if updating country wasn't existed
         if ($porttype == null) {
           $porttype = Asset_type::find($id);
           $data = array(
               'porttype' => $porttype
             );
             return redirect ('/admin/asset-type');
         }

          $portcat = DB::table('asset_cat')->get();
         return view('system-mgmt/asset-type/edit', ['portcat' => $portcat,'porttype' => $porttype,'tree'=>$tree]);
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
         $porttype = Asset_type::findOrFail($id);
         $input = [
           'la_nla' => $request['la_nla'],
           'asset_cat' => $request['asset_cat'],
           'la_nla_type' => $request['la_nla_type'],
           'nla_sub_type' => $request['nla_sub_type'],
           'link_info' => $request['link_info'],
           'call_center' => $request['call_center'],
           'ref_info_head1' => $request['ref_info_head1'],
           'ref_info_head2' => $request['ref_info_head2'],
           'ref_info_head3' => $request['ref_info_head3'],
           'ref_info_head4' => $request['ref_info_head4'],
           'ref_info_head5' => $request['ref_info_head5'],
           'ref_info_head6' => $request['ref_info_head6'],
           'ref_info_head7' => $request['ref_info_head7'],
           'ref_info_head8' => $request['ref_info_head8'],
           'unit' => $request['unit'],
         ];
         $this->validate($request, [
        // 'type' => 'required|max:60'
         ]);
         Asset_type::where('id', $id)
             ->update($input);

         return redirect ('/admin/asset-type');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Asset_type::where('id', $id)->delete();
          return redirect ('/admin/asset-type');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */


     public function search(Request $request) {

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


         $constraints = [
             'la_nla_type' => $request['la_nla_type'],
             'la_nla' => $request['la_nla']

             ];

        $porttypes = $this->doSearchingQuery($constraints);
        return view('system-mgmt/asset-type/index', ['porttypes' => $porttypes, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
         $query = Asset_type::query();
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
      //   'type' => 'required|max:60|unique:asset_type',

     ]);
     }
 }
