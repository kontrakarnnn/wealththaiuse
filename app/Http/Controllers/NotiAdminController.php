<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Block;
use App\User;
use App\Person;
use App\Noti;
use App\Message_type;
use App\match_id;
use App\Http\Controllers\SidebarController;
class NotiadminController extends Controller
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








    public function search(Request $request) {
      //sidebar

  $tree = session()->get('tree');
  //sidebar

        $constraints = [
            'from' => $request['from'],
            'to' => $request['to']
        ];

        $notis = $this->getHiredEmployees($constraints);
        return view('system-mgmt/notiadmin/index', ['notis' => $notis, 'searchingVals' => $constraints,'tree'=>$tree]);
    }

    private function getHiredEmployees($constraints) {

    $notis = DB::table('notis as d')
    ->where('d.created_at', '>=', $constraints['from'])
    ->where('d.created_at', '<=', $constraints['to'])
    ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

    ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
    ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
    ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')



  ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

->orderBy('created_at', 'desc')


    ->get();

        return $notis;
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


      /*$devices = DB::table('devices as d')
          ->leftJoin('users as au', 'd.assigned_user_id', '=', 'au.id')
          ->leftJoin('users as cu', 'd.completed_by_user_id', '=', 'cu.id')
          ->select('d.id','au.name as assigned_user_name','cu.name as completed_by_user_name'); ตัวอย่างการ join 2 column ที่ foreing key เหมือนกัน*/


      $notis = DB::table('notis as d')
      ->leftJoin('message_types', 'd.message_type_id', '=', 'message_types.id')

      ->leftJoin('match_id as au', 'd.sender_id', '=', 'au.id')
      ->leftJoin('match_id as cu', 'd.recieve_id', '=', 'cu.id')
      ->leftJoin('match_id as du', 'd.created_by', '=', 'du.id')


      ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')
->orderBy('created_at', 'desc')

     ->paginate(1000);
     return view('system-mgmt/notiadmin/index', ['notis' => $notis,'tree'=>$tree]);
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




       $matchids = match_id::all();
       $messagetypes = message_type::all();
        return view('system-mgmt/notiadmin/create', [ 'messagetypes' => $messagetypes,'matchids' => $matchids,'tree'=>$tree]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

       message_type::findOrFail($request['message_type_id']);
       match_id::findOrFail($request['recieve_id']);
       match_id::findOrFail($request['sender_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
        Noti::create([
          'message_type_id' => $request['message_type_id'],
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
          'created_by' => $request['created_by']

       ]);


         return redirect ('/admin/notiadmin');
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

         $noti = Noti::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($noti == null) {
           $noti = Noti::find($id);
           $data = array(
               'noti' => $noti
             );
             return redirect ('/admin/notiadmin');
           }


           $matchids = match_id::all();
           $messagetypes = Message_type::all();
           $persons = Person::all();
           $users = User::all();
         return view('system-mgmt/notiadmin/edit', ['noti' => $noti,'matchids' => $matchids,'messagetypes' => $messagetypes,'tree'=>$tree]);
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
           'message_type_id' => $request['message_type_id'],
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
           'created_by' => $request['created_by']

         ];
         $this->validate($request, [

         ]);
         Noti::where('id', $id)
             ->update($input);

         return redirect ('/admin/notiadmin');
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
          return redirect ('/admin/notiadmin');
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
 }
