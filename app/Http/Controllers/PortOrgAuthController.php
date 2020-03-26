<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Organize;
use App\Block;
use App\Person;
use App\Port_auth;
use App\Port_Org_auth;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Viewper;
use Session;
class PortOrgAuthController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



      //sidebar
      $current = Auth::guard('person')->user()->id;
    //  $current2 = Session::all();
    //  return $current2;



     $orgauth = DB::table('organize_auths')->where('member_id',$current)->pluck('organize_id')->toArray();
     $orgs = Person::where('type' ,'=','2')->whereIn('id' , $orgauth)->get();
    //return $orgs;

  		//sidebar
      $structures = DB::table('portfolio')
      ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
     ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
     ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
      ->where('member_id' ,'=', $current)
      ->select('portfolio.*','portfolio.status', 'portfolio.type','portfolio.portfolio_type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as block_id','port_types.type as port_name', 'port_types.id as port_id')->get();
      $curor = Portfolio::where('member_id' ,'=', $current)->pluck('id');


      $userauths = DB::table('port_org_auths')
      ->leftJoin('persons as organize', 'port_org_auths.org_id', '=', 'organize.id')
     ->leftJoin('portfolio', 'port_org_auths.port_id', '=', 'portfolio.id')
     ->whereIn('portfolio.id',$curor)

     ->select('port_org_auths.*','port_org_auths.description', 'portfolio.type as port_name', 'portfolio.id as port_id','organize.name as organize_name', 'organize.id as organize_id')

     ->paginate(100);
    // return $curor;
     return view('system-mgmt/portorgauth/index', ['orgs'=>$orgs,'structures'=>$structures,'userauths' => $userauths]);
    }
public function childView($view){



        $html ='<ul class="treeview-menu">';
        foreach ($view->childs as $arr) {

            if(count($arr->childs) && $view->add_to_side == "Yes"){

            $html .='<li> <a  href ="'.$arr->view_url.'"class=""><i class="fa fa-link"></i>'.$arr->name.' <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span></a> ';
                    $html.= $this->childView($arr);


                }elseif($view->add_to_side == "Yes"){
                    $html .='<li class="treeview"><a href ="'.$arr->view_url.'"class="">'.$arr->name.'</a>' ;
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

       //sidebar
      $current = Auth::guard('person')->user()->id;
    //  $current2 = Session::all();
    //  return $current2;


              $currentmatchids = DB::table('match_id')

                      ->where([
                                [ 'member_id', '=', $current]

                             ])
                             ->pluck('id');
                  $currentmatchids = $currentmatchids->toArray();
                  $currentpidgroups = DB::table('match_pid_groups')

                          ->where([
                                    [ 'p_id', '=', $currentmatchids]

                                 ])
                                 ->pluck('pid_group_id');

                   $currentusergroups = DB::table('match_member_groups')

                         ->where([
                             [ 'member_id', '=', $current]

                              ])
                              ->pluck('member_group_id');
                      $currentorg = DB::table('persons')->where('id',$current)->where('type',2)->pluck('id');
                      $currentfamily = DB::table('family_auths')

                              ->where([
                                        [ 'member_id', '=', $current],

                                     ])
                                     ->where('status','=','Accept')
                                     ->pluck('family_id');




                                               //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
                                      $currents = DB::table('persons')->where('id',$current)->pluck('id');

                                      $matchviews = DB::table('match_views_mem as m')
                                      ->leftJoin('views_mem', 'm.view_id', '=', 'views_mem.id')







                                    ->orwhereIn(
                                      'pid_groups.id',$currentpidgroups
                                    )
                                    ->orwhereIn(
                                      'member_groups.id',$currentusergroups
                                    )
                                    ->orwhereIn(
                                      'm.org_id',$currentorg
                                    )
                                    ->orwhereIn(
                                      'm.member_id',$currents
                                    )
                                    ->orwhereIn(
                                      'm.group_id',$currentfamily
                                    )
                                    ->orwhere(
                                      'm.all_member','=','Yes'
                                    )


                                    ->leftJoin('member_groups', 'm.member_group_id', '=', 'member_groups.id')

                                   ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

                                   ->select('m.*','m.id', 'views_mem.name as view_name', 'views_mem.id as view_id',
                                    'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','member_groups.name as member_group_name', 'member_groups.id as member_group_id')
                                     ->pluck('view_id');


             $views = Viewper::whereIn('id',$matchviews )
                            ->where('belong_to','=',NULL )->get();
                            $viewss = Viewper::whereIn('id',$matchviews )
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







      // $structures = Organize::where('created_by','=',$current)->get();
       //return $structures;
       $structures = Portfolio::where('member_id' ,'=', $current)->get();

       $users = Person::all();

        return view('system-mgmt/portauth/create', ['structures' => $structures, 'users' => $users,'tree' =>$tree]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

    //   Portfolio::find($request['port_id']);

    //   Organize::find($request['org_id']);






       $current = Auth::guard('person')->user()->id;
       foreach($request->get('port_id') as $key =>$v){


                   $data = array(
                                   'port_id'=>$request->port_id[$key],
                                   'org_id'=>$request->org_id[$key],
                                   'description'=>$request->description [$key],
                                   'created_by' =>$current,

                       );



                       //return $data;
                           //return $matchi;

                       Port_Org_auth::insert($data);


                 }


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
      $current = Auth::guard('person')->user()->id;
    //  $current2 = Session::all();
    //  return $current2;


              $currentmatchids = DB::table('match_id')

                      ->where([
                                [ 'member_id', '=', $current]

                             ])
                             ->pluck('id');
                  $currentmatchids = $currentmatchids->toArray();
                  $currentpidgroups = DB::table('match_pid_groups')

                          ->where([
                                    [ 'p_id', '=', $currentmatchids]

                                 ])
                                 ->pluck('pid_group_id');

                   $currentusergroups = DB::table('match_member_groups')

                         ->where([
                             [ 'member_id', '=', $current]

                              ])
                              ->pluck('member_group_id');
                      $currentorg = DB::table('persons')->where('id',$current)->where('type',2)->pluck('id');
                      $currentfamily = DB::table('family_auths')

                              ->where([
                                        [ 'member_id', '=', $current],

                                     ])
                                     ->where('status','=','Accept')
                                     ->pluck('family_id');




                                               //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
                                      $currents = DB::table('persons')->where('id',$current)->pluck('id');

                                      $matchviews = DB::table('match_views_mem as m')
                                      ->leftJoin('views_mem', 'm.view_id', '=', 'views_mem.id')







                                    ->orwhereIn(
                                      'pid_groups.id',$currentpidgroups
                                    )
                                    ->orwhereIn(
                                      'member_groups.id',$currentusergroups
                                    )
                                    ->orwhereIn(
                                      'm.org_id',$currentorg
                                    )
                                    ->orwhereIn(
                                      'm.member_id',$currents
                                    )
                                    ->orwhereIn(
                                      'm.group_id',$currentfamily
                                    )
                                    ->orwhere(
                                      'm.all_member','=','Yes'
                                    )


                                    ->leftJoin('member_groups', 'm.member_group_id', '=', 'member_groups.id')

                                   ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

                                   ->select('m.*','m.id', 'views_mem.name as view_name', 'views_mem.id as view_id',
                                    'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','member_groups.name as member_group_name', 'member_groups.id as member_group_id')
                                     ->pluck('view_id');


             $views = Viewper::whereIn('id',$matchviews )
                            ->where('belong_to','=',NULL )->get();
                            $viewss = Viewper::whereIn('id',$matchviews )
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


         $userauth = Organize_auth::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($userauth == null) {
           $userauth = Organize_auth::find($id);
           $data = array(
               'userauth' => $userauth
             );
             return redirect()->intended('/organizeauth');
           }
           $structures = Organize::all();

           $users = Person::all();
         return view('system-mgmt/organizeauth/edit', ['userauth' => $userauth,'structures' => $structures,'users' => $users,'tree' =>$tree]);
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
         $userauth = Organize_auth::findOrFail($id);
         $input = [
           'member_id' => $request['member_id'],
           'organize_id' => $request['organize_id'],

           'description' => $request['description']

         ];
         $this->validate($request, [
         'member_id' => 'nullable|max:60',
         'organize_id' => 'nullable|max:60',

         'description' => 'nullable|max:60'
         ]);
         Organize_auth::where('id', $id)
             ->update($input);

         return redirect()->intended('/organizeauth');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Port_Org_auth::where('id', $id)->delete();
          return redirect()->back();
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */
     public function search(Request $request) {

       //sidebar
       $current = Auth::guard('person')->user()->id;
    //  $current2 = Session::all();
    //  return $current2;


              $currentmatchids = DB::table('match_id')

                      ->where([
                                [ 'member_id', '=', $current]

                             ])
                             ->pluck('id');
                  $currentmatchids = $currentmatchids->toArray();
                  $currentpidgroups = DB::table('match_pid_groups')

                          ->where([
                                    [ 'p_id', '=', $currentmatchids]

                                 ])
                                 ->pluck('pid_group_id');

                   $currentusergroups = DB::table('match_member_groups')

                         ->where([
                             [ 'member_id', '=', $current]

                              ])
                              ->pluck('member_group_id');
                      $currentorg = DB::table('persons')->where('id',$current)->where('type',2)->pluck('id');
                      $currentfamily = DB::table('family_auths')

                              ->where([
                                        [ 'member_id', '=', $current],

                                     ])
                                     ->where('status','=','Accept')
                                     ->pluck('family_id');




                                               //$notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
                                      $currents = DB::table('persons')->where('id',$current)->pluck('id');

                                      $matchviews = DB::table('match_views_mem as m')
                                      ->leftJoin('views_mem', 'm.view_id', '=', 'views_mem.id')







                                    ->orwhereIn(
                                      'pid_groups.id',$currentpidgroups
                                    )
                                    ->orwhereIn(
                                      'member_groups.id',$currentusergroups
                                    )
                                    ->orwhereIn(
                                      'm.org_id',$currentorg
                                    )
                                    ->orwhereIn(
                                      'm.member_id',$currents
                                    )
                                    ->orwhereIn(
                                      'm.group_id',$currentfamily
                                    )
                                    ->orwhere(
                                      'm.all_member','=','Yes'
                                    )


                                    ->leftJoin('member_groups', 'm.member_group_id', '=', 'member_groups.id')

                                   ->leftJoin('pid_groups', 'm.pid_group_id', '=', 'pid_groups.id')

                                   ->select('m.*','m.id', 'views_mem.name as view_name', 'views_mem.id as view_id',
                                    'pid_groups.name as pid_group_name', 'pid_groups.id as pid_group_id','member_groups.name as member_group_name', 'member_groups.id as member_group_id')
                                     ->pluck('view_id');


             $views = Viewper::whereIn('id',$matchviews )
                            ->where('belong_to','=',NULL )->get();
                            $viewss = Viewper::whereIn('id',$matchviews )
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



          $constraints = [
           'member_id' => $request['member_id'],
           'organize_id' => $request['organize_id'],

           'description' => $request['description'],
           'organize.name' => $request['organize_name'],

            'persons.name' => $request['member_name']
             ];

        $userauths = $this->doSearchingQuery($constraints);
        $constraints['organize_name'] = $request['organize_name'];
        $constraints['member_name'] = $request['member_name'];

        return view('system-mgmt/organizeauth/index', ['userauths' => $userauths, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
       $query = DB::table('organize_auths')
       ->leftJoin('persons', 'organize_auths.member_id', '=', 'persons.id')
      ->leftJoin('organize', 'organize_auths.organize_id', '=', 'organize.id')


      ->select('organize_auths.id','organize_auths.description', 'organize.name as organize_name', 'organize.id as organize_id','persons.name as member_name', 'persons.id as member_id');



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
