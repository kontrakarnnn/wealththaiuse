<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\View;
use App\Viewpartner;
use App\Block;
use App\Partner_block;
use App\User_auth;
use App\Partner_auth;
use Session;
class CheckViewpartner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function getArrayAlldBlock($currentstruc,$currentid,$notebook){

    $CurrentDivisions = Partner_block::where('id', '=' ,$currentid )->get();
    $result =$notebook;
    $ChildDivisions = Partner_block::whereIn('under_block',$currentid )->pluck('id');
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

    $CurrentDivisions = Partner_block::where('under_block', '=', NULL )->pluck('id');
    $result =$notebook;
    $ChildDivisions = Partner_block::whereIn('id',$currentid)->pluck('under_block');
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

      if ( ! Auth::guard('partner')->user()) {
        return redirect('/wealththaipartner');
    }
      $current = Auth::guard('partner')->user()->id;
  //if (User::where('mobile', Input::get('mobile'))->exists())
  $whatINeed =$_SERVER['REQUEST_URI'];

  //$viewlevel = DB::table('views')->where('view_url',$whatINeed)->whereNull('sub_node')->where('level', \DB::raw("(select max(`level`) from views)"))->pluck('id');
  $viewlevel = DB::table('views_partner')->where('view_url',$whatINeed)->whereNull('sub_node')->orderBy('level','DESC')->take(1)->pluck('id')->toArray();

  if($viewlevel != NULL){
  //  $viewmatchcur = DB::table('views')->where('view_url',$whatINeed)->pluck('id');
  $viewauth = DB::table('match_views_partner')->whereIn('view_id',$viewlevel)->get();
  //  return $viewauth;
  foreach($viewauth as $v){
    if($v->structure_id != NULL)
    {
      $currentstruc = DB::table('partner_auths')

              ->where([
                        [ 'partner_id', '=', $current]

                     ])
                     ->pluck('structure_id');
          $currentstruc = $currentstruc->toArray();
          if(in_array($v->structure_id,$currentstruc)){
            return $next($request);
          }

    }
    if($v->block_id != NULL)
    {
      $curblock = DB::table('partner_auths')->where('partner_id',$current)->pluck('block_id')->toArray();
      if(in_array($v->block_id,$curblock)){
        return $next($request);
      }

    }
    if($v->block_td != NULL)
    {
      $currentstruc = DB::table('partner_auths')

              ->where([
                        [ 'partner_id', '=', $current]

                     ])
                     ->pluck('structure_id');
          $currentstruc = $currentstruc->toArray();
          $currentid = DB::table('partner_auths')

                  ->where([ //[ 'structure_id', '=', 10 ],
                            [ 'partner_id', '=', $current]
                         ])
                  ->pluck('block_id');

          $currentid = $currentid->toArray();
     $notebook = array();
     $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
     $notebook = array_merge_recursive($currentid,$notebook);
     if(in_array($v->block_td,$notebook)){
      return $next($request);
      }
    }
    if($v->block_btu != NULL)
    {
      $currentstruc2 = DB::table('partner_auths')

              ->where([
                        [ 'partner_id', '=', $current]

                     ])
                     ->pluck('structure_id');
      $currentstruc2 = $currentstruc2->toArray();

    $viewid = DB::table('views')->where('view_url',$whatINeed)->pluck('id');
            $currentid2= DB::table('match_views')->whereIn('view_id',$viewid)->where('block_btu','!=',NULL)
                           ->pluck('block_btu');
             $currentid2 = $currentid2->toArray();
      $notebook2 = array();
      $notebook2 = $this->blockbtu($currentstruc2,$currentid2,$notebook2);
      $notebook2 = array_merge_recursive($currentid2,$notebook2);
      if(in_array($v->block_btu,$notebook2))
       {
       return $next($request);
       }

    }

  //return $v->structure_id;
  if($v->partner_group_id != NULL)
  {
    $currentgroup = DB::table('match_partner_group')

            ->where([
                      [ 'partner_id', '=', $current]

                   ])
                   ->pluck('partner_group_id');
        $currentgroup = $currentgroup->toArray();
        if(in_array($v->partner_group_id,$currentgroup)){
          return $next($request);
        }

  }

  if($v->pid_group_id != NULL)
    {

    $currentmatchids = DB::table('match_id')

            ->where([
                      [ 'partner_id', '=', $current]

                   ])
                   ->pluck('id');
    $currentmatchids = $currentmatchids->toArray();
    $currentpidgroups = DB::table('match_pid_groups')

                ->where([
                        [ 'id', '=', $currentmatchids]

                       ])
                       ->pluck('pid_group_id')->toarray();
   if(in_array($v->pid_group_id,$currentpidgroups))
   {
     return $next($request);
   }

  }

  if($v->all_partner == 'Yes')
  {
    return $next($request);
  }
  if($v->partner_id == $current)
  {
    return $next($request);
  }
  }
  return response("Insufficient permission", 401);
  }

  $model = Viewpartner::orderByRaw('CHAR_LENGTH(view_url) DESC ')->where('sub_node','=','Yes')->get();
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
        $viewauthsub = DB::table('match_views_partner')->where('view_id',$v->id)->get();
        foreach($viewauthsub as $vs){
          if($vs->structure_id != NULL)
          {
            $currentstruc = DB::table('partner_auths')

                    ->where([
                              [ 'partner_id', '=', $current]

                           ])
                           ->pluck('structure_id');
                $currentstruc = $currentstruc->toArray();
                if(in_array($vs->structure_id,$currentstruc)){
                  return $next($request);
                }

          }
          if($vs->block_id != NULL)
          {
            $curblock = DB::table('partner_auths')->where('partner_id',$current)->pluck('block_id')->toArray();
            if(in_array($vs->block_id,$curblock)){
              return $next($request);
            }

          }
          if($vs->block_td != NULL)
          {
            $currentstruc = DB::table('partner_auths')

                    ->where([
                              [ 'partner_id', '=', $current]

                           ])
                           ->pluck('structure_id');
                $currentstruc = $currentstruc->toArray();
                $currentid= DB::table('match_views')->where('block_btu','!=',NULL)
                               ->pluck('block_btu');
                $currentid = $currentid->toArray();
           $notebook = array();
           $notebook = $this->getArrayAlldBlock($currentstruc,$currentid,$notebook);
           $notebook = array_merge_recursive($currentid,$notebook);
           if(in_array($vs->block_td,$notebook)){
            return $next($request);
            }
          }
          if($vs->block_btu != NULL)
          {
            $currentstruc2 = DB::table('partner_auths')

                    ->where([
                              [ 'partner_id', '=', $current]

                           ])
                           ->pluck('structure_id');
            $currentstruc2 = $currentstruc2->toArray();
            $currentid2= DB::table('match_views')->where('block_btu','!=',NULL)
                           ->pluck('block_btu');
            $currentid2 = $currentid2->toArray();
            $notebook2 = array();
            $notebook2 = $this->blockbtu($currentstruc2,$currentid2,$notebook2);
            $notebook2 = array_merge_recursive($currentid2,$notebook2);
            if(in_array($vs->block_btu,$notebook2))
             {
             return $next($request);
             }

          }

        //return $v->structure_id;
        if($v->partner_group_id != NULL)
        {
          $currentgroup = DB::table('match_partner_group')

                  ->where([
                            [ 'partner_id', '=', $current]

                         ])
                         ->pluck('partner_group_id');
              $currentgroup = $currentgroup->toArray();
              if(in_array($v->partner_group_id,$currentgroup)){
                return $next($request);
              }

        }

        if($vs->pid_group_id != NULL)
          {
          $currentmatchids = DB::table('match_id')

                  ->where([
                            [ 'partner_id', '=', $current]

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

        if($vs->all_partner == 'Yes')
        {
          return $next($request);
        }
        if($vs->partner_id == $current)
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
