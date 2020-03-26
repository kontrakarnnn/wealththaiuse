<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\User_auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\SidebarController;

class RefController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

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
    public function index()
    {
      //sidebar
      $tree = new SidebarController();
      $tree = session()->get('tree');
      //sidebar
	$current = Auth::user()->id;
    $matchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('id');
          $refmem = DB::table('persons')->where('ref_user_pid',$matchids)->orderBy('created_at','DESC')->take(10)->get();








    $currentmatchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->value('id');
      //  $currentmatchids = $currentmatchids->toArray();


      $geturl = urldecode($_SERVER['REQUEST_URI']);
      $geturl = explode('/',$geturl);
      $eventl = '';
      $source = '';
      $medium = '';
      $name = '';
      $term = '';
      $content = '';
      $website = '';
      if(in_array('generatelink',$geturl)){
        $url = urldecode($_SERVER['REQUEST_URI']);
        $eventl =  explode('=event=',$url);
        $eventl = $eventl[1];
        $source =  explode('=source=',$url);
        $source = $source[1];
        $medium =  explode('=medium=',$url);
        $medium = $medium[1];
        $name =  explode('=name=',$url);
        $name = $name[1];
        $term =  explode('=term=',$url);
        $term = $term[1];
        $content =  explode('=content=',$url);
        $content = $content[1];
        $website =  explode('=website=',$url);
        $website = $website[1];
      }
      $events = DB::table('event')->get();

        return view('system-mgmt/reflink/Ref',compact('website','content','source','term','eventl','name','medium','events','tree','currentmatchids','refmem'));
    }

    public function eventlink()
    {
      //sidebar
      $tree = new SidebarController();
      $tree = session()->get('tree');
      //sidebar
    $current = Auth::user()->id;
    $matchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('id');
          $refmem = DB::table('persons')->where('ref_user_pid',$matchids)->orderBy('created_at','DESC')->take(10)->get();








    $currentmatchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->value('id');
      //  $currentmatchids = $currentmatchids->toArray();


      $geturl = urldecode($_SERVER['REQUEST_URI']);
      $geturl = explode('/',$geturl);
      $eventl = '';
      $source = '';
      $medium = '';
      $name = '';
      $term = '';
      $content = '';
      $website = '';
      $eventlink = '';
      if(in_array('generatelink',$geturl)){
        $url = urldecode($_SERVER['REQUEST_URI']);
        $eventl =  explode('=event=',$url);
        $eventl = $eventl[1];
        $eventlink = DB::table('event')->where('id',$eventl)->value('link_moreinfo');
        $source =  explode('=source=',$url);
        $source = $source[1];
        $medium =  explode('=medium=',$url);
        $medium = $medium[1];
        $name =  explode('=name=',$url);
        $name = $name[1];
        $term =  explode('=term=',$url);
        $term = $term[1];
        $content =  explode('=content=',$url);
        $content = $content[1];
        $website =  explode('=website=',$url);
        $website = $website[1];
      }
      $events = DB::table('event')->get();

        return view('system-mgmt/reflink/eventlink',compact('eventlink','website','content','source','term','eventl','name','medium','events','tree','currentmatchids','refmem'));
    }

    public function smartlink()
    {
      //sidebar
      $tree = new SidebarController();
      $tree = session()->get('tree');
      //sidebar
	$current = Auth::user()->id;
    $matchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('id');
          $refmem = DB::table('persons')->where('ref_user_pid',$matchids)->orderBy('created_at','DESC')->take(10)->get();








    $currentmatchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->value('id');
      //  $currentmatchids = $currentmatchids->toArray();


      $geturl = urldecode($_SERVER['REQUEST_URI']);
      $geturl = explode('/',$geturl);
      $eventl = '';
      $source = '';
      $medium = '';
      $name = '';
      $term = '';
      $content = '';
      $website = '';
      if(in_array('generatelink',$geturl)){
        $url = urldecode($_SERVER['REQUEST_URI']);
        $eventl =  explode('=event=',$url);
        $eventl = $eventl[1];
        $source =  explode('=source=',$url);
        $source = $source[1];
        $medium =  explode('=medium=',$url);
        $medium = $medium[1];
        $name =  explode('=name=',$url);
        $name = $name[1];
        $term =  explode('=term=',$url);
        $term = $term[1];
        $content =  explode('=content=',$url);
        $content = $content[1];
        $website =  explode('=website=',$url);
        $website = $website[1];
      }
      $events = DB::table('event')->get();

        return view('system-mgmt/reflink/smartlink',compact('website','content','source','term','eventl','name','medium','events','tree','currentmatchids','refmem'));
    }

    public function contentlink()
    {
      //sidebar
      $tree = new SidebarController();
      $tree = session()->get('tree');
      //sidebar
    $current = Auth::user()->id;
    $matchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('id');
          $refmem = DB::table('persons')->where('ref_user_pid',$matchids)->orderBy('created_at','DESC')->take(10)->get();








    $currentmatchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->value('id');
      //  $currentmatchids = $currentmatchids->toArray();


      $geturl = urldecode($_SERVER['REQUEST_URI']);
      $geturl = explode('/',$geturl);
      $eventl = '';
      $source = '';
      $medium = '';
      $name = '';
      $term = '';
      $content = '';
      $website = '';
      if(in_array('generatelink',$geturl)){
        $url = urldecode($_SERVER['REQUEST_URI']);
        $eventl =  explode('=event=',$url);
        $eventl = $eventl[1];
        $source =  explode('=source=',$url);
        $source = $source[1];
        $medium =  explode('=medium=',$url);
        $medium = $medium[1];
        $name =  explode('=name=',$url);
        $name = $name[1];
        $term =  explode('=term=',$url);
        $term = $term[1];
        $content =  explode('=content=',$url);
        $content = $content[1];
        $website =  explode('=website=',$url);
        $website = $website[1];
      }
      $events = DB::table('event')->get();

        return view('system-mgmt/reflink/contentlink',compact('website','content','source','term','eventl','name','medium','events','tree','currentmatchids','refmem'));
    }
    public function servicelink()
    {
      //sidebar
      $tree = new SidebarController();
      $tree = session()->get('tree');
      //sidebar
    $current = Auth::user()->id;
    $matchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->pluck('id');
          $refmem = DB::table('persons')->where('ref_user_pid',$matchids)->orderBy('created_at','DESC')->take(10)->get();








    $currentmatchids = DB::table('match_id')

            ->where([
                      [ 'user_id', '=', $current]

                   ])
                   ->value('id');
      //  $currentmatchids = $currentmatchids->toArray();


      $geturl = urldecode($_SERVER['REQUEST_URI']);
      $geturl = explode('/',$geturl);
      $eventl = '';
      $source = '';
      $medium = '';
      $name = '';
      $term = '';
      $content = '';
      $website = '';
      $eventlink = '';
      if(in_array('generatelink',$geturl)){
        $url = urldecode($_SERVER['REQUEST_URI']);
        $eventl =  explode('=event=',$url);
        $eventl = $eventl[1];
        $eventlink = DB::table('event')->where('id',$eventl)->value('link_moreinfo');
        $source =  explode('=source=',$url);
        $source = $source[1];
        $medium =  explode('=medium=',$url);
        $medium = $medium[1];
        $name =  explode('=name=',$url);
        $name = $name[1];
        $term =  explode('=term=',$url);
        $term = $term[1];
        $content =  explode('=content=',$url);
        $content = $content[1];
        $website =  explode('=website=',$url);
        $website = $website[1];
      }
      $events = DB::table('service_form')->get();

        return view('system-mgmt/reflink/servicelink',compact('eventlink','website','content','source','term','eventl','name','medium','events','tree','currentmatchids','refmem'));
    }
    public function store(Request $request)
    {
      $current = Auth::user()->id;
        $currentmatchids = DB::table('match_id')

                ->where([
                          [ 'user_id', '=', $current]

                       ])
                       ->value('id');

      $event = $request->event_id;
      $source = $request->source;
      $medium = $request->medium;
      $name = $request->name;
      $term = $request->term;
      $website = $request->website;
      $content = $request->content;

		date_default_timezone_set('Asia/Bangkok');



       $url = '/reflink??/generatelink/=website='.$website.'=website==event='.$event.'=event==source='.$source.'=source==medium='.$medium.'=medium==name='.$name.'=name==term='.$term.'=term==content='.$content.'=content=';
        return redirect ($url);
    }

    public function storeeventlink(Request $request)
    {
      $current = Auth::user()->id;
        $currentmatchids = DB::table('match_id')

                ->where([
                          [ 'user_id', '=', $current]

                       ])
                       ->value('id');

      $event = $request->event_id;
      $source = $request->source;
      $medium = $request->medium;
      $name = $request->name;
      $term = $request->term;
      $website = $request->website;
      $content = $request->content;

    date_default_timezone_set('Asia/Bangkok');



       $url = '/reflink/event/link??/generatelink/=website='.$website.'=website==event='.$event.'=event==source='.$source.'=source==medium='.$medium.'=medium==name='.$name.'=name==term='.$term.'=term==content='.$content.'=content=';
        return redirect ($url);
    }
    public function storeservicelink(Request $request)
    {
      $current = Auth::user()->id;
        $currentmatchids = DB::table('match_id')

                ->where([
                          [ 'user_id', '=', $current]

                       ])
                       ->value('id');

      $event = $request->event_id;
      $source = $request->source;
      $medium = $request->medium;
      $name = $request->name;
      $term = $request->term;
      $website = $request->website;
      $content = $request->content;

    date_default_timezone_set('Asia/Bangkok');



       $url = '/reflink/service/link??/generatelink/=website='.$website.'=website==event='.$event.'=event==source='.$source.'=source==medium='.$medium.'=medium==name='.$name.'=name==term='.$term.'=term==content='.$content.'=content=';
        return redirect ($url);
    }

    public function storesmartlink(Request $request)
    {
      $current = Auth::user()->id;
        $currentmatchids = DB::table('match_id')

                ->where([
                          [ 'user_id', '=', $current]

                       ])
                       ->value('id');

      $event = $request->event_id;
      $source = $request->source;
      $medium = $request->medium;
      $name = $request->name;
      $term = $request->term;
      $website = $request->website;
      $content = $request->content;

      date_default_timezone_set('Asia/Bangkok');



       $url = '/reflink/smart/link??/generatelink/=website='.$website.'=website==event='.$event.'=event==source='.$source.'=source==medium='.$medium.'=medium==name='.$name.'=name==term='.$term.'=term==content='.$content.'=content=';
        return redirect ($url);
    }

    public function storecontentlink(Request $request)
    {
      $current = Auth::user()->id;
        $currentmatchids = DB::table('match_id')

                ->where([
                          [ 'user_id', '=', $current]

                       ])
                       ->value('id');

      $event = $request->event_id;
      $source = $request->source;
      $medium = $request->medium;
      $name = $request->name;
      $term = $request->term;
      $website = $request->website;
      $content = $request->content;

      date_default_timezone_set('Asia/Bangkok');


$url='/reflink/content/link??/generatelink/=website='.$website.'=website==event='.$event.'=event==source='.$source.'=source==medium='.$medium.'=medium==name='.$name.'=name==term='.$term.'=term==content='.$content.'=content=';
		return 'yes';
        return redirect ($url);
    }

public function findevent(Request $request){
  $data=Event::select('event_name','id')->where('id',$request->id)->take(100)->get();
  return response()->json($data);
}
}
