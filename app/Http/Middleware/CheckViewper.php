<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\View;
use App\Viewper;
use App\Block;
use App\User_auth;
use Session;
class CheckViewper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function getArrayAlldBlock($currentstruc,$currentid,$notebook){

    $CurrentDivisions = Block::where('id', '=' ,$currentid )->get();
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
    public function handle($request, Closure $next)
    {

      if ( ! Auth::guard('person')->user()) {
        return redirect('/');
    }
      $current = Auth::guard('person')->user()->id;
  //if (User::where('mobile', Input::get('mobile'))->exists())
  $whatINeed =$_SERVER['REQUEST_URI'];

  //$viewlevel = DB::table('views')->where('view_url',$whatINeed)->whereNull('sub_node')->where('level', \DB::raw("(select max(`level`) from views)"))->pluck('id');
  $viewlevel = DB::table('views_mem')->where('view_url',$whatINeed)->whereNull('sub_node')->orderBy('level','DESC')->take(1)->pluck('id')->toArray();

  if($viewlevel != NULL){
  //  $viewmatchcur = DB::table('views')->where('view_url',$whatINeed)->pluck('id');
  $viewauth = DB::table('match_views_mem')->whereIn('view_id',$viewlevel)->get();
  //  return $viewauth;
  foreach($viewauth as $v){
  //return $v->structure_id;
  if($v->member_group_id != NULL)
  {
    $currentgroup = DB::table('match_member_groups')

            ->where([
                      [ 'member_id', '=', $current]

                   ])
                   ->pluck('member_group_id');
        $currentgroup = $currentgroup->toArray();
        if(in_array($v->member_group_id,$currentgroup)){
          return $next($request);
        }

  }

  if($v->pid_group_id != NULL)
    {

    $currentmatchids = DB::table('match_id')

            ->where([
                      [ 'member_id', '=', $current]

                   ])
                   ->pluck('id');
    $currentmatchids = $currentmatchids->toArray();
    $currentpidgroups = DB::table('match_pid_groups')

                ->where([
                        [ 'id', '=', $currentmatchids]

                       ])
                       ->pluck('pid_group_id');
   if(in_array($v->pid_group_id,$currentpidgroups))
   {
     return $next($request);
   }

  }
  if($v->org_id != NULL)
    {

    $currentorg = DB::table('organize_auths')

            ->where([
                      [ 'member_id', '=', $current]

                   ])
                   ->pluck('organize_id');
    $currentorg = $currentorg->toArray();

   if(in_array($v->org_id,$currentorg))
   {
     return $next($request);
   }

  }
  if($v->all_member == 'Yes')
  {
    return $next($request);
  }
  if($v->member_id == $current)
  {
    return $next($request);
  }
  }
  return response("Insufficient permission", 401);
  }

  $model = Viewper::orderByRaw('CHAR_LENGTH(view_url) DESC ')->where('sub_node','=','Yes')->get();
  //$model = $model->toArray();

  //return $model;
  $string = $whatINeed;
  //$blacklistArray = ['ass','ball sack'];
  $blacklistArray = $model;
   //return $blacklistArray;
   //return $blacklistArray;
  $flag = false;

  foreach ($blacklistArray as $k => $v) {
    //return $v->view_url;

      if (str_contains($string, $v->view_url)) {
          $flag = true;

        //  return 'ada';
        $viewauthsub = DB::table('match_views_mem')->where('view_id',$v->id)->get();
        foreach($viewauthsub as $vs){
        //return $v->structure_id;
        if($vs->member_group_id != NULL)
        {
          $currentgroup = DB::table('match_member_groups')

                  ->where([
                            [ 'member_id', '=', $current]

                         ])
                         ->pluck('member_group_id');
              $currentgroup = $currentgroup->toArray();
              if(in_array($vs->member_group_id,$currentgroup)){
                return $next($request);
              }

        }

        if($vs->pid_group_id != NULL)
          {

          $currentmatchids = DB::table('match_id')

                  ->where([
                            [ 'member_id', '=', $current]

                         ])
                         ->pluck('id');
          $currentmatchids = $currentmatchids->toArray();
          $currentpidgroups = DB::table('match_pid_groups')

                      ->where([
                              [ 'id', '=', $currentmatchids]

                             ])
                             ->pluck('pid_group_id');
         if(in_array($vs->pid_group_id,$currentpidgroups))
         {
           return $next($request);
         }

        }
        if($vs->org_id != NULL)
          {

          $currentorg = DB::table('organize_auths')

                  ->where([
                            [ 'member_id', '=', $current]

                         ])
                         ->pluck('organize_id');
          $currentorg = $currentorg->toArray();

         if(in_array($vs->org_id,$currentorg))
         {
           return $next($request);
         }
        }
        if($vs->all_member == 'Yes')
        {
          return $next($request);
        }
        if($vs->member_id == $current)
        {
          return $next($request);
        }
      }
  break;
      }

      //return $v->id;
      //return $v->id; //จากตรงนี้จะได้ id มาและจะวิ่งหา สิทต่อว่าเลขนี้อยุในไหน

      //break;
    //  return $v->id;
  }
            return response("Insufficient permission", 401);
          /*if($request->user() == null) {
            return response("Insufficient permission", 401);
          }
          $actions = $request->route()->getAction();
          $roles = isset($actions ['roles']) ? $actions['roles'] : null;
          foreach ($currenter as $currenters) {
          if ($currenters->name == "Admin") {
              return $next($request);
          }
          return response("Insufficient permission", 401);*/
      }
}
