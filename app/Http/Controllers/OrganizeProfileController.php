<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\role;
use App\Structure;
use App\Block;
use App\match_id;
use App\Person;
use Response;
use Session;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Viewper;
use App\Division;
use Illuminate\Support\Facades\Hash;


class OrganizeProfileController extends Controller
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
    $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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
		//sidebar

    $userauths = DB::table('organize_auths')
    ->leftJoin('persons', 'organize_auths.member_id', '=', 'persons.id')
   ->leftJoin('persons as organize', 'organize_auths.organize_id', '=', 'organize.id')

   ->where('organize.id',$current)
   ->orwhere('organize.belong_to',$current)
     ->where('organize_auths.status','=', "Accept")



 //  ->orwhere('organize.belong_to' , $current)


   ->select('organize_auths.*','organize_auths.description', 'organize.name as organize_name', 'organize.email as organize_email', 'organize.mobile as organize_mobile', 'organize.dob as organize_dob', 'organize.id_num as organize_idnum', 'organize.gender as organize_gender', 'organize.nationality as organize_nationality', 'organize.add2 as organize_add2', 'organize.add2_alley as organize_alley', 'organize.add2_road as organize_road', 'organize.add2_subdistrict as organize_subdistrict', 'organize.add2_district as organize_district', 'organize.add2_city as organize_city', 'organize.add2_country as organize_country', 'organize.add2_postcode as organize_postcode','organize.more as organize_more','organize.couple_email as organize_couple_email', 'organize.id as organize_id','persons.name as member_name', 'persons.id as member_id')


   ->get();
   //return $userauths;


        $persons = DB::table('persons')

      //  ->leftJoin('structure', 'users.structure_id', '=', 'structure.id')
        ->where('id',$current)
        ->where('type','=','Organize')
        ->orwhere('belong_to','=',$current)

      //  ->select('users.*')

        ->paginate(20);
        //return $persons;
        return view('organizeprofile/index', ['userauths' => $userauths,'persons' => $persons,'tree'=>$tree]);
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
      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
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



        // Redirect to user list if updating user wasn't existed
        $curmyor = Person::where('id',$current)->orwhere('belong_to',$current)->pluck('id');
        //return $curmyor;
        $curmyor = $curmyor->toArray();
        if(in_array($id, $curmyor)){
          $curdob = Person::where('id',$id)->value('dob');
          if($curdob != NULL){

        $curdob = explode('-', $curdob);
        $curdate =$curdob[0];
        $curmonth =$curdob[1];
        $curyear =$curdob[2];
    }
    else {
      $curdate ="";
      $curmonth ="";
      $curyear ="";
    }
          $person = Person::find($id);
        $data = array(
            'person' => $person
        );

        return view('organizeprofile/edit', ['curdate' => $curdate,'curmonth' => $curmonth,'curyear' => $curyear,'person' => $person,'tree'=>$tree]);
      }

              return view('error');
        }





    public function repassword($id)
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
      $current = Session::get('login_person_59ba36addc2b2f9401580f014c7f58ea4e30989d');
      $sd = $request->sd;
      $sm = $request->sm;
      $sy = $request->sy;

      $date = $sd."-".$sm."-".$sy;
      $per = Person::find($id);

      $per->name = $request -> name;
      $per->gender = $request-> gender;
      $per->id_num = $request-> id_num;
      $per->mobile = $request-> mobile;
      $per->dob = $date;
      $per->nationality = $request-> nationality;
      $per->couple_email = $request-> couple_email;
      $per->more = $request-> more;

      $per->add2 = $request-> add2;
      $per->add2_alley = $request-> add2_alley;
      $per->add2_road = $request-> add2_road;
      $per->add2_subdistrict = $request-> add2_subdistrict;
      $per->add2_district = $request-> add2_district;
      $per->add2_city = $request-> add2_city;
      $per->add2_country = $request-> add2_country;
      $per->add2_postcode = $request-> add2_postcode;

      $per->type = "Organize";
    //  $per->belong_to = $current ;

      $per->email = $request-> email;
      $per->save();
              $request->session()->flash('alert-success', 'แก้ไขข้อมูลเรียบร้อยแล้ว ');
        return redirect()->intended('/organizeprofile');
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




}
