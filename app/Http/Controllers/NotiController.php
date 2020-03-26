<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Person;
use App\Noti;
use App\Message_type;
use App\match_id;
use App\Pid_group;
use Mail;
use App\View;
use App\Block;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\NotiCenterController;

use Session;
class NotiController extends Controller
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

     public function search(Request $request) {
       //sidebar

   $tree = session()->get('tree');
   //sidebar

         $constraints = [
             'from' => $request['from'],
             'to' => $request['to']
         ];
         $currents = Auth::user()->id;


            // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
               $curren = DB::table('match_id')

                       ->where(//[ 'structure_id', '=',9 ],
                                 'user_id', '=',$currents

                              )
                              ->get();

         $notis = $this->getHiredEmployees($constraints);
         return view('system-mgmt/noti/index', ['curren' => $curren,'notis' => $notis, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     public function searchinbox(Request $request) {
         $constraints = [
             'from' => $request['from'],
             'to' => $request['to']
         ];


         $notis = $this->getHiredEmployeesinbox($constraints);
         return view('system-mgmt/noti/inbox', ['notis' => $notis, 'searchingVals' => $constraints]);
     }

     public function searchsentbox(Request $request) {
         $constraints = [
             'from' => $request['from'],
             'to' => $request['to']
         ];

         $notis = $this->getHiredEmployeessentbox($constraints);
         return view('system-mgmt/noti/sentbox', ['notis' => $notis, 'searchingVals' => $constraints]);
     }

     private function getHiredEmployees($constraints) {
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->pluck('id');
                    $currentid = $currentid->toArray();
   $notis = DB::table('notis as d')
   ->where('d.created_at', '>=', $constraints['from'])
   ->where('d.created_at', '<=', $constraints['to'])
   ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

   ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
   ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
   ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
   ->whereIn('d.recieve_id',$currentid)


  ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
  ->get();

         return $notis;
     }

     private function getHiredEmployeesinbox($constraints) {
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->pluck('id');
                    $currentid = $currentid->toArray();
   $notis = DB::table('notis as d')
   ->whereNotIn('d.created_by',$currentid)
   ->where('d.created_at', '=', $constraints['from'])
   ->where('d.created_at', '=', $constraints['to'])
   ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

   ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
   ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
   ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
   ->whereIn('d.recieve_id',$currentid)


  ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
  ->get();

         return $notis;
     }

     private function getHiredEmployeessentbox($constraints) {


       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->pluck('id');
                    $currentid = $currentid->toArray();
   $notis = DB::table('notis as d')
   ->whereIn('d.created_by',$currentid)
   ->where('d.created_at', '=', $constraints['from'])
   ->where('d.created_at', '=', $constraints['to'])
   ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

   ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
   ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
   ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
   ->whereIn('d.recieve_id',$currentid)


  ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
  ->get();

         return $notis;
     }
    public function index()
    {
      //sidebar

    $tree = session()->get('tree');
    //sidebar

      $currents = Auth::user()->id;


         // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
            $curren = DB::table('match_id')

                    ->where(//[ 'structure_id', '=',9 ],
                              'user_id', '=',$currents

                           )
                           ->get();

      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'user_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')

  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
   ->whereIn('d.recieve_id',$currentid)
  ->orwhereIn('d.sender_id',$currentid)


 ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
->orderBy('id', 'desc')
 ->paginate(1000);

return view('system-mgmt/noti/index', ['notis' => $notis,'curren' => $curren,'tree'=>$tree]);
    }


    public function notigroup(Request $request)
    {
		date_default_timezone_set('Asia/Bangkok');
      $gnum = $request -> gnum;
      $matchids = DB::table('match_pid_groups')

      ->leftJoin('match_id', 'match_pid_groups.p_id', '=', 'match_id.id')

     ->leftJoin('pid_groups', 'match_pid_groups.pid_group_id', '=', 'pid_groups.id')
     ->where(
       'pid_groups.id',$gnum
     )
     //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

     ->get();


  foreach ( $matchids as  $matchid => $get) {
      $matchi[$matchid] =  $get->p_id;

    }




      message_type::findOrFail($request['message_type_id']);
      //match_id::findOrFail($request['recieve_id']);
   //   match_id::findOrFail($request['sender_id']);

      $this->validateInput($request,[

     'description' => 'nullable|string|max:60'

     ]);

     foreach ($matchi as $key => $v)
     {
       $data =array('recieve_id' => $v,
                   'message_type_id'=>$request->message_type_id,
                   'topic'=>$request->topic,
                   'message'=>$request->message,
                   'reflink'=>$request->reflink,
                   'sender_note'=>$request->sender_note,


                   'reciever_note'=>$request->reciever_note,
                   'sender_id'=>$request->sender_id,
                   'cc_reciever1'=>$request->cc_reciever1,
                   'cc_reciever2'=>$request->cc_reciever2,
                   'cc_reciever3'=>$request->cc_reciever3,
                   'created_by'=>$request->created_by,
                   'status'=>$request->status,
				           'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                   'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
               );

                    Noti::insert($data);
     }




                   $currentid =$matchi;

                   $matchids = DB::table('match_id')
                   ->whereIn('match_id.id',$currentid)
                   ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                  ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                  //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                  ->pluck('public_email');

                  $currentsender =$request->created_by;

                  $cursender = DB::table('match_id')
                  ->where('match_id.id',$currentsender)
                  ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                 ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                 ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
                 ->get();
                 //->pluck('public_email');

                  $curren = $request->sender_id;

                  $sender = DB::table('notis as d')

                  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

                  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
                  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
                  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
                  ->where('d.sender_id',$curren)


                 ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
                 ->get();

                  $current =$request->message_type_id;
                  $messagetypes = DB::table('message_types')
                  ->where('message_types.id',$current)
                  ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                  ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')
                   ->get();
                  $matchids = $matchids->toArray();
                  $cursender = $cursender->toArray();
                  $messages = $request->message;
                    Mail::send('emails.notimarketing',compact('messages','messagetypes','sender'),function($message) use ($matchids,$messagetypes,$cursender){
                      foreach ($cursender as $cursen) {

                      $message->from($cursen->public_email);
                         }
                      $message->to($matchids);

                      foreach ($messagetypes as $messages) {
                      $message->subject($messages->message_template);
                      }
                    });

                    $currentid =Auth::id();
                    $matchids = DB::table('match_id')
                    ->where('match_id.member_id',$currentid)

                   //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                   ->value('id');
                   $autore = DB::table('message_types')
                   ->where('id',$request->message_type_id)
                   ->value('auto_reply');
                   $replymes = DB::table('message_types')
                   ->where('id',$request->message_type_id)
                   ->value('reply_mst_id');
                    //return $autore;
                    if($autore == "Yes"){

                      $reply = new Noti;
                      $reply->message_type_id = $replymes ;
                      $reply->topic = $request-> topic;
                      $reply->message = $request-> message;
                      $reply->reflink = $request-> reflink;
                      $reply->sender_note = $request-> sender_note;
                      $reply->reciever_note = $request-> reciever_note ;
                      $reply->status = $request-> status;
                      $reply->sender_id =  1;
                      $reply->recieve_id = $request-> sender_id ;

                      $currents =$reply->message_type_id;

                      $messagetypesde = DB::table('message_types')
                      ->where('message_types.id',$currents)
                      ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                      ->value('default_recieve_id');

                     //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                     //->pluck('message_template');
                       //->first();
                       $reply->cc_reciever1 = $request-> cc_reciever1 ;
                       $reply->cc_reciever2 = $request-> cc_reciever2 ;
                       $reply->cc_reciever3 = $request-> cc_reciever3 ;
                       $reply->created_by =  1 ;
                    //   $reply->reply_msg = $noti->id ;

                      // $messagetypesde = $messagetypesde->toArray();
                       //dd($messagetypesde);
                      if($reply->recieve_id == NULL){
                        $reply->recieve_id = $messagetypesde;

                      }


                      $reply->save();

                      $currentmt =$reply->message_type_id;
                      $messagetyperep = DB::table('message_types')
                      ->where('message_types.id',$currentmt)
                      ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                      ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')

                      //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                      //->pluck('message_template');
                       ->get();

                      //  $mem = $this->$input->toArray();

                      $currentidss =$reply->recieve_id;

                      $matchidsss = DB::table('match_id')
                      ->where('match_id.id',$currentidss)
                      ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                      ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                      //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                      ->pluck('public_email');
                      $pname = DB::table('match_id')
                      ->where('match_id.id',$currentidss)


                      //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                      ->get();
                     // dd($pname);

                      $currentsenderss =$reply->recieve_id;

                      $cursenderss = DB::table('match_id')
                      ->where('match_id.id',$currentsenderss)
                      ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                     ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                     ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
                     ->get();


                     $currennn = $reply->sender_id;

                     $senderrr = DB::table('notis as d')

                     ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

                     ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
                     ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
                     ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
                     ->where('d.sender_id',$currennn)


                    ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

                    ->get();

                     $matchidsss = $matchidsss->toArray();
                     //$input = $request->all();

                     $cursenderss = $cursenderss->toArray();
                        Mail::send('emails.replymes',compact('messagetyperep','senderrr','pname'),function($message) use ($matchidsss,$messagetyperep,$cursenderss){
                          foreach ($cursenderss as $cursen) {

                          $message->from($cursen->public_email);
                             }
                          $message->to($matchidsss);

                          foreach ($messagetyperep as $messages) {
                          $message->subject($messages->message_template);
                          }
                        });
                      }
       /*  'message_type_id' => $request['message_type_id'],
         'topic' => $request['topic'],
         'message' => $request['message'],
         'reflink' => $request['reflink'],
         'sender_note' => $request['sender_note'],
         'reciever_note' => $request['reciever_note'],
         'status' => $request['status'],
         'sender_id' => $request['sender_id'],
         'recieve_id' => $request['recieve_id'],
         'cc_reciever1' => $request['cc_reciever1'],
         'cc_reciever2' => $request['cc_reciever2'],
         'cc_reciever3' => $request['cc_reciever3'],
         'created_by' => $request['created_by']*/




        return redirect ('/MessageCenter/noti');
    }


    public function email()
    {

    }
    public function sentbox()
    {

      //sidebar

    $tree = session()->get('tree');
    //sidebar


      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'user_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')
  ->whereIn('d.created_by',$currentid)
  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
  ->whereIn('d.sender_id',$currentid)


 ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);

	 return view('system-mgmt/noti/sentbox', ['notis' => $notis,'tree'=>$tree]);
    }

    public function inbox()
    {
      //sidebar

    $tree = session()->get('tree');
    //sidebar


      $current = Auth::user()->id;


     // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
        $currentid = DB::table('match_id')

                ->where(//[ 'structure_id', '=',9 ],
                          'user_id', '=',$current

                       )
                       ->pluck('id');
                   $currentid = $currentid->toArray();
  $notis = DB::table('notis as d')
  //->whereNotIn('d.created_by',$currentid)
  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

  ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
  ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
  ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
  ->whereIn('d.recieve_id',$currentid)


 ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

 ->paginate(1000);

  return view('system-mgmt/noti/inbox', ['notis' => $notis,'tree'=>$tree]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function creategroup()
     {

       //sidebar

$tree = session()->get('tree');
//sidebar


       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->get();


       $matchids = match_id::all();
       $messagetypes = message_type::where('message_cat_id','=',12)->get();

        $pidgroups = Pid_group::all();

        return view('system-mgmt/noti/creategroup', [ 'pidgroups' =>$pidgroups,'currentid' =>$currentid, 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree'=>$tree]);

     }
     public function create()
     {



       //sidebar

     $tree = session()->get('tree');
     //sidebar



		 //sidebar
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->get();


       $matchids = match_id::all();
       $messagetypes = message_type::where('message_cat_id','=',12)->get();

       $pidgroups = Pid_group::all();

        return view('system-mgmt/noti/create', [ 'pidgroups' =>$pidgroups,'currentid' =>$currentid, 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree'=>$tree]);

     }


     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
		     date_default_timezone_set('Asia/Bangkok');
       message_type::findOrFail($request['message_type_id']);
    //   match_id::findOrFail($request['recieve_id']);
       match_id::findOrFail($request['sender_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);

        $noticenter =  New NotiCenterController();
        $messagetype = $request-> message_type_id;
        $topic = $request-> topic;
        $message = $request-> message;
        $reflink = $request-> reflink;
        $sendernote = $request-> sender_note;
        $recievernote = $request-> reciever_note ;
        $status = $request-> status;
        $sender = $request-> sender_id;
        $reciver = $request-> recieve_id ;
        $cc1 = $request-> cc_reciever1;
        $cc2 = $request-> cc_reciever2;
        $cc3 = $request-> cc_reciever3;
        $createdby = $request-> created_by ;
        $noticenter->sentnoti($createdby,$cc1,$cc2,$cc3,$messagetype,$topic,$message,$reflink,$sendernote,$recievernote,$status,$sender,$reciver);




         return redirect ('/MessageCenter/noti');
     }



	


     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {


       //sidebar

   $tree = session()->get('tree');
   //sidebar
       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->get();


       $matchids = match_id::all();
       $messagetypes = message_type::all();
       $current = Auth::user()->id;

       $curmatch = DB::table('match_id')
                   ->where('user_id','=',$current)
                   ->pluck('id');
                   $curmatch  =$curmatch->toArray();
       $curmem = DB::table('notis')

              ->whereIn('sender_id',$curmatch)
                           ->orwhereIn('recieve_id',$curmatch)

                     ->pluck('id');
                     $curmem = $curmem->toArray();
       $portfolio = Noti::find($id);
       $number = [123, 713, 3];
       // Redirect to city list if updating city wasn't existed
       //if ($id == $number )
         if(in_array($id, $curmem)){
           $notis = DB::table('notis as d')
           ->where('d.id',$id)
           ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

           ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
           ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
           ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')



          ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','du.public_email as created_mail','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

          ->get();
         $data = array(
             'notis' => $notis,


         );
          return view('system-mgmt/noti/show',[ 'currentid' =>$currentid,'notis' =>$notis, 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree'=>$tree])->with('id',$id);


       }
        return view('error');


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

       $current = Auth::user()->id;


      // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
         $currentid = DB::table('match_id')

                 ->where(//[ 'structure_id', '=',9 ],
                           'user_id', '=',$current

                        )
                        ->pluck('id');
                    $currentid = $currentid->toArray();

                    $curnoti = DB::table('notis')

                           ->whereIn('recieve_id',$currentid)

                                  ->pluck('id');
                                  $curnoti = $curnoti->toArray();

         $noti = Noti::find($id);

         // Redirect to division list if updating division wasn't existed
         if(in_array($id,$curnoti)) {
           $noti = Noti::find($id);
           $data = array(
               'noti' => $noti
             );
             $matchids = match_id::all();
             $messagetypes = Message_type::all();
             $persons = Person::all();
             $users = User::all();
           return view('system-mgmt/noti/edit', ['noti' => $noti,'matchids' => $matchids,'messagetypes' => $messagetypes,'tree'=>$tree]);
           }

           return view('error');

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
         $noti = Noti::findOrFail($id);
         $input = [
           'message_type_id' => $noti->message_type_id,
           'topic' => $noti->topic,
           'message' => $noti->message,
           'reflink' => $noti->reflink,
           'sender_note' => $noti->sender_note,
           'reciever_note' => $request['reciever_note'],
           'status' => $request['status'],
           'sender_id' => $noti->sender_id,
           'recieve_id' => $noti->recieve_id,
           'cc_reciever1' => $noti->cc_reciever1,
           'cc_reciever2' => $noti->cc_reciever2,
           'cc_reciever3' =>$noti-> cc_reciever,
           'created_by' => $noti->created_by
         ];
         $this->validate($request, [

         ]);
         Noti::where('id', $id)
             ->update($input);
$request->session()->flash('alert-success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
         return redirect()->back();
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         Noti::where('id', $id)->delete();
		 return redirect()->back();
          //return redirect ('system-management/noti');
     }

     /**
      * Search country from database base on some specific constraints
      *
      * @param  \Illuminate\Http\Request  $request
      *  @return \Illuminate\Http\Response
      */

     private function validateInput($request) {
         $this->validate($request, [


     ]);
     }
     public function reply($id)
     {
		 date_default_timezone_set('Asia/Bangkok');
     //sidebar

 $tree = session()->get('tree');
 //sidebar

         /*$portfolio = Portfolio::find($id);
         // Redirect to city list if updating city wasn't existed
         if ($portfolio == null) {
           $portfolio = Portfolio::find($id);
           $data = array(
               'portfolio' => $portfolio
           );

         }*/
       /*  $u = Auth::user()->id;
         $user = DB::table('portfolio')

                 ->where(//[ 'structure_id', '=',9 ],
                           'member_id', '=',$u

                        )
                        ->pluck('id');
                    $user = $user->toArray();*/
                    $current = Auth::user()->id;


                   // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
                      $currentid = DB::table('match_id')

                              ->where(//[ 'structure_id', '=',9 ],
                                        'user_id', '=',$current

                                     )
                                     ->get();


                    $matchids = match_id::all();
                    $messagetypes = message_type::where('message_cat_id','=',12)->get();

                    $current = Auth::user()->id;

                    $curmatch = DB::table('match_id')
                                ->where('user_id','=',$current)
                                ->pluck('id');
                                $curmatch  =$curmatch->toArray();
                    $curmem = DB::table('notis')

                          ->whereIn('sender_id',$curmatch)
                           ->orwhereIn('recieve_id',$curmatch)

                                  ->pluck('id');
                                  $curmem = $curmem->toArray();
                    $portfolio = Noti::find($id);
                    $number = [123, 713, 3];
                    // Redirect to city list if updating city wasn't existed
                    //if ($id == $number )
                      if(in_array($id, $curmem)){
                      $noti = Noti::find($id);
                      $data = array(
                          'noti' => $noti,
                          'matchids' => $matchids,
                          'messagetypes' => $messagetypes,
                          'currentid' => $currentid

                      );
                       return view('system-mgmt/noti/reply',[ 'currentid' =>$currentid,'noti' =>$noti, 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree'=>$tree])->with('id',$id);


                    }
                     return view('error');

             //       $data = Hash::make($id);
         //$portfolio = DB::table('portfolio')->where('id',$id)->first();

       //return $data;
     //  return view('person/notebook',compact('portfolio'))->with('id',$id);
     }

     public function forward($id)
     {
		 date_default_timezone_set('Asia/Bangkok');

     //sidebar

$tree = session()->get('tree');
//sidebar

         /*$portfolio = Portfolio::find($id);
         // Redirect to city list if updating city wasn't existed
         if ($portfolio == null) {
           $portfolio = Portfolio::find($id);
           $data = array(
               'portfolio' => $portfolio
           );

         }*/
       /*  $u = Auth::user()->id;
         $user = DB::table('portfolio')

                 ->where(//[ 'structure_id', '=',9 ],
                           'member_id', '=',$u

                        )
                        ->pluck('id');
                    $user = $user->toArray();*/
                    $current = Auth::user()->id;


                   // $currentid = DB::table('user_auths')->select('user_auths.block_id')->where('user_id',$current)->first();
                      $currentid = DB::table('match_id')

                              ->where(//[ 'structure_id', '=',9 ],
                                        'user_id', '=',$current

                                     )
                                     ->get();


                    $matchids = match_id::all();
                    $messagetypes = message_type::where('message_cat_id','=',12)->get();

                    $current = Auth::user()->id;

                    $curmatch = DB::table('match_id')
                                ->where('user_id','=',$current)
                                ->pluck('id');
                                $curmatch  =$curmatch->toArray();
                    $curmem = DB::table('notis')

                           ->whereIn('sender_id',$curmatch)
                           ->orwhereIn('recieve_id',$curmatch)

                                  ->pluck('id');
                                  $curmem = $curmem->toArray();
                    $portfolio = Noti::find($id);
                    $number = [123, 713, 3];
                    // Redirect to city list if updating city wasn't existed
                    //if ($id == $number )
                      if(in_array($id, $curmem)){
                      $noti = Noti::find($id);
                      $data = array(
                          'noti' => $noti,
                          'matchids' => $matchids,
                          'messagetypes' => $messagetypes,
                          'currentid' => $currentid

                      );
                       return view('system-mgmt/noti/forward',[ 'currentid' =>$currentid,'noti' =>$noti, 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree'=>$tree])->with('id',$id);


                    }
                     return view('error');

             //       $data = Hash::make($id);
         //$portfolio = DB::table('portfolio')->where('id',$id)->first();

       //return $data;
     //  return view('person/notebook',compact('portfolio'))->with('id',$id);
     }

	     public function emailwelcome($sender,$reciever,$messagetypes){
  Mail::send('emails.notirefmem',compact('sender','reciever','messagetypes'),function($message) use ($messagetypes,$reciever){
    foreach ($reciever as $re) {
   $message->to($re->public_email);
           }

  foreach ($messagetypes as $messages) {
    $message->subject($messages->message_template);
   }
 });
}
 }
