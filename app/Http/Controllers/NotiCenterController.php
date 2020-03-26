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
use Session;
use App\Jobs\SendEmailJob;
class NotiCenterController extends Controller
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
    public function notigroup($createdby,$cc1,$cc2,$cc3,$messagetype,$topic,$message,$reflink,$sendernote,$recievernote,$status,$sender,$reciver)
    {
		date_default_timezone_set('Asia/Bangkok');
    //return $reciver;


     foreach ($reciver as $key => $v)
     {
       $data =  New Noti;
        $data->recieve_id = $v;
        $data->message_type_id = $messagetype;
        $data->topic = $topic;
        $data->message=$message;
        $data->reflink=$reflink;
        $data->sender_note=$sendernote;
        $data->reciever_note=$recievernote;
        $data->sender_id=$sender;
        $data->cc_reciever1=$cc1;
        $data->cc_reciever2=$cc2;
        $data->cc_reciever3=$cc3;
        $data->created_by=$createdby;
        $data->status=$status;
        $data->created_at=\Carbon\Carbon::now()->toDateTimeString();
        $data->updated_at=\Carbon\Carbon::now()->toDateTimeString();
            //   return $data['id'];
            $messagetypeemail= DB::table('message_types')
            ->where('message_types.id',$messagetype)
            ->value('email_flag');


          //return $data;
       $data->save();
       $noti = $data;

       if($messagetypeemail == 1)
       {

       $this->senttoemail($noti,$sender);
     }
     }

                   $currentid =$reciver;

                   $matchids = DB::table('match_id')
                   ->whereIn('match_id.id',$currentid)
                   ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                  ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                  //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                  ->pluck('public_email');

                  $currentsender =$createdby;

                  $cursender = DB::table('match_id')
                  ->where('match_id.id',$currentsender)
                  ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                 ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                 ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
                 ->get();
                 //->pluck('public_email');

                  $curren = $sender;

                  $sender = DB::table('notis as d')

                  ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')
                  ->where('d.sender_id',$curren)
                 ->get();
                  $current =$messagetype;
                  $messagetypes = DB::table('message_types')
                  ->where('message_types.id',$current)
                  ->get();
                  $matchids = $matchids->toArray();
                  $cursender = $cursender->toArray();
                  $messages = $message;
                    $currentid =Auth::id();
                    $matchids = DB::table('match_id')
                    ->where('match_id.member_id',$currentid)
                   ->value('id');
                   $autore = DB::table('message_types')
                   ->where('id',$messagetype)
                   ->value('auto_reply');
                   $replymes = DB::table('message_types')
                   ->where('id',$messagetype)
                   ->value('reply_mst_id');
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
                       $reply->cc_reciever1 = $request-> cc_reciever1 ;
                       $reply->cc_reciever2 = $request-> cc_reciever2 ;
                       $reply->cc_reciever3 = $request-> cc_reciever3 ;
                       $reply->created_by =  1 ;
                      if($reply->recieve_id == NULL){
                        $reply->recieve_id = $messagetypesde;
                      }
                      $reply->save();
                      $currentmt =$reply->message_type_id;
                      $messagetyperep = DB::table('message_types')
                      ->where('message_types.id',$currentmt)

                       ->get();
                      $currentidss =$reply->recieve_id;
                      $matchidsss = DB::table('match_id')
                      ->where('match_id.id',$currentidss)

                      ->pluck('public_email');
                      $pname = DB::table('match_id')
                      ->where('match_id.id',$currentidss)
                      ->get();
                      $currentsenderss =$reply->recieve_id;
                      $cursenderss = DB::table('match_id')
                      ->where('match_id.id',$currentsenderss)

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
        return redirect ('/MessageCenter/noti');
    }
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function sentnoti($createdby,$cc1,$cc2,$cc3,$messagetype,$topic,$message,$reflink,$sendernote,$recievernote,$status,$sender,$reciver)
     {
    //   return $messagetype;
		 date_default_timezone_set('Asia/Bangkok');
        $noti = new Noti;
        $noti->message_type_id = $messagetype;
        $noti->topic = $topic;
        $noti->message = $message;
        $noti->reflink = $reflink;
        $noti->sender_note = $sendernote;
        $noti->reciever_note = $recievernote;
        $noti->status = $status;
        $noti->sender_id = $sender;
        $noti->recieve_id = $reciver;
        $current =$noti->message_type_id;
        $messagetypesde = DB::table('message_types')
        ->where('message_types.id',$current)
        ->value('default_recieve');
         $noti->cc_reciever1 = $cc1 ;
         $noti->cc_reciever2 = $cc2 ;
         $noti->cc_reciever3 = $cc3 ;
         $noti->created_by = $createdby ;
        if($noti->recieve_id == NULL){
          $noti->recieve_id = $messagetypesde;
        }
      //  return $noti;
        $noti->save();
        $messagetypeemail= DB::table('message_types')
        ->where('message_types.id',$current)
        ->value('email_flag');
        if($messagetypeemail == 1)
        {
        $this->senttoemail($noti,$sender);
      }
      $matchids = DB::table('match_id')
      ->where('match_id.member_id',$current)
      ->value('id');
     $autore = DB::table('message_types')
     ->where('id',$noti->message_type_id)
     ->value('auto_reply');
     $replymes = DB::table('message_types')
     ->where('id',$noti->message_type_id)
     ->value('reply_mst_id');
      if($autore == "Yes"){
          return $this->replymessage($noti,$createdby,$cc1,$cc2,$cc3,$messagetype,$topic,$message,$reflink,$sendernote,$recievernote,$status,$sender,$reciver,$replymes);
        }
         return redirect ('/MessageCenter/noti');
     }


 public function replymessage($noti,$createdby,$cc1,$cc2,$cc3,$messagetype,$topic,$message,$reflink,$sendernote,$recievernote,$status,$sender,$reciver,$replymes)
 {
   $reply = new Noti;
   $reply->message_type_id = $replymes ;
   $reply->topic = $topic;
   $reply->message = $message;
   $reply->reflink = $reflink;
   $reply->sender_note = $sendernote;
   $reply->reciever_note = $recievernote ;
   $reply->status = $status;
   $reply->sender_id =  1;
   $reply->recieve_id = $sender;
   $currents =$reply->message_type_id;
   $messagetypesde = DB::table('message_types')
   ->where('message_types.id',$currents)
   ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
   ->value('default_recieve_id');
   $reply->created_by =  1 ;
   $reply->reply_msg = $noti->id ;
   if($reply->recieve_id == NULL){
    $reply->recieve_id = $messagetypesde;
   }
   $reply->save();
   $currentmt =$reply->message_type_id;
   $messagetyperep = DB::table('message_types')
   ->where('message_types.id',$currentmt)
   ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
   ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')
   ->get();
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
   $messagetypeemail= DB::table('message_types')
   ->where('message_types.id',$replymes)
   ->value('email_flag');
   if($messagetypeemail == 1)
   {
   $this->senttoemailreply($messagetyperep,$senderrr,$pname,$message,$matchidsss,$messagetyperep,$cursenderss);
  }

 }
 public function senttoemailreply($messagetyperep,$senderrr,$pname,$message,$matchidsss,$cursenderss)
 {
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
	public function senttoemail($noti,$sender)
     {
       $curid = $noti->sender_note;
       $currentid =$noti->recieve_id;

       $matchids = DB::table('match_id')
       ->where('match_id.id',$currentid)
       ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

       ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

       //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

       ->pluck('public_email');

       $currentsender =$noti->sender_id;

       $cursender = DB::table('match_id')
       ->where('match_id.id',$currentsender)
       ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

       ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

       ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
       ->get();
       //->pluck('public_email');

       $curren = $noti->sender_id;

       $sender = DB::table('notis as d')

       ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

       ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
       ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
       ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
       ->where('d.sender_id',$curren)


       ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

       ->get();


       //->pluck('public_email');

       $currenre = $noti->recieve_id;
       $reciever = DB::table('notis as d')

       ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

       ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
       ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
       ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
       ->where('d.sender_id',$currenre)


       ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

       ->get();


       $current =$noti->message_type_id;
       $messagetypes = DB::table('message_types')
       ->where('message_types.id',$current)
       ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
       ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')

       //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

       //->pluck('message_template');
       ->get();


       $matchids = $matchids->toArray();
       //$input = $request->all();

       $cursender = $cursender->toArray();
       $ans = $noti->message;
       //  $mem = $this->$input->toArray();
       $noid = $noti->id;

        Mail::send('emails.sent',compact('messagetypes','sender','ans','curid','reciever','cursender','noid'),function($message) use ($matchids,$messagetypes,$cursender){
          foreach ($cursender as $cursen) {

          $message->from($cursen->public_email);
             }
          $message->to($matchids);

          foreach ($messagetypes as $messages) {
          $message->subject($messages->message_template);
          }
        });
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
public function senttoemailgroup($noti,$sender)
   {


     $matchids = DB::table('match_id')
     ->where('match_id.id',$currentid)
     ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

     ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

     //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

     ->pluck('public_email');

     $currentsender =$noti->sender_id;

     $cursender = DB::table('match_id')
     ->where('match_id.id',$currentsender)
     ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

     ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

     ->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')
     ->get();
     //->pluck('public_email');

     $curren = $noti->sender_id;

     $sender = DB::table('notis as d')

     ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

     ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
     ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
     ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
     ->where('d.sender_id',$curren)


     ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

     ->get();


     //->pluck('public_email');

     $currenre = $noti->recieve_id;
     $reciever = DB::table('notis as d')

     ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

     ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
     ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
     ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')
     ->where('d.sender_id',$currenre)


     ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id', 'cu.public_email as recieve_email', 'cu.public_mobile as recieve_mobile','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

     ->get();


     $current =$noti->message_type_id;
     $messagetypes = DB::table('message_types')
     ->where('message_types.id',$current)
     ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
     ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')

     //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

     //->pluck('message_template');
     ->get();


     $matchids = $matchids->toArray();
     //$input = $request->all();

     $cursender = $cursender->toArray();
     $ans = $noti->message;
     //  $mem = $this->$input->toArray();
     $noid = $noti->id;
  /*   $sendmailjob = New SentEmailJob;
     $sendmailjob->hanbdle($messagetypes,$sender,$ans,$curid,$reciever,$cursender,$noid,$matchids);*/
      Mail::send('emails.sent',compact('messagetypes','sender','ans','curid','reciever','cursender','noid'),function($message) use ($matchids,$messagetypes,$cursender){
        foreach ($cursender as $cursen) {

        $message->from($cursen->public_email);
           }
        $message->to($matchids);

        foreach ($messagetypes as $messages) {
        $message->subject($messages->message_template);
        }
      });
   }
 }
