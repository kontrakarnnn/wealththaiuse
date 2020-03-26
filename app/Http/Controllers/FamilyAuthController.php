<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Portfolio;
use App\Family;
use App\Block;
use App\Person;
use App\Family_auth;
use App\Port_Group_auth;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Viewper;
use Session;
use App\Noti;
use App\match_id;
use Mail;

class FamilyAuthController extends Controller
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
     public function home($id)
     {

       $current = Auth::guard('person')->user()->id;
       $url  = $_SERVER['REQUEST_URI'];
       $url = explode('/',$url);
       $url = $url[3];
       $current = Auth::guard('person')->user()->id;

        $currentid = DB::table('persons')

                ->where(//[ 'structure_id', '=',9 ],
                          'id', '=',$current

                       )
                       ->get();
                       $curfam = DB::table('family_auths')
                       ->where('member_id',$current)
                       ->where('status',"Accept")
                       ->pluck('family_id');
                       //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
                         $structures = Family::where('created_by',$current)->orwhereIn('id',$curfam)->pluck('id');
                         $structures = $structures->toArray();
      $userauths = DB::table('family_auths')
      ->leftJoin('match_id', 'family_auths.member_id', '=', 'match_id.member_id')
     ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
     ->where('family.id' , $url)
     ->where('family_auths.status','Request')
     ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','match_id.public_name as member_name', 'match_id.member_id as member_id')
     ->paginate(100);
     if(in_array($id,$structures))
     {
      return view('system-mgmt/familyauth/home', ['userauths' => $userauths ]);
     }
     return view ('error');
   }

    public function index()
    {
      $current = Auth::guard('person')->user()->id;
      $userauths = DB::table('family_auths')
      ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
     ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
     ->where('family_auths.created_by' , $current)
     ->where('family_auths.status' , "Request")

     ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id')

     ->paginate(100);

     return view('system-mgmt/familyauth/index', ['userauths' => $userauths ]);
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

public function list(){



        //sidebar
        $current = Auth::guard('person')->user()->id;
        $curfam = DB::table('family_auths')
        ->where('member_id',$current)
        ->where('status',"Accept")
        ->pluck('family_id');
      //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
          $curfamss = Family::where('created_by',$current)->orwhereIn('id',$curfam)->get();
	  $curfa = DB::table('family_auths')
        ->where('member_id',$current)
        ->where('status',"Accept")
        ->pluck('family_id');
	$curfa = $curfa->toArray();
        $userauths = DB::table('family_auths')
        ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
       ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
		->orwhereIn('family.id',$curfa)
       ->orwhere('family_auths.created_by' , $current)
       ->where('family_auths.status' , "Accept")

       ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id')

       ->paginate(100);
       return view('system-mgmt/familyauth/list', ['curfamss'=>$curfamss,'userauths' => $userauths ]);

}


public function listgroup(Request $request){

        $current = Auth::guard('person')->user()->id;

        $org = $request->org;
        $curfam = DB::table('family_auths')
        ->where('member_id',$current)
        ->where('status',"Accept")
        ->pluck('family_id');
      //  $structures = Organize::where('created_by' ,'=', $current)->paginate(100);
          $curfamss = Family::where('created_by',$current)->orwhereIn('id',$curfam)->get();
$curfa = DB::table('family_auths')
        ->where('member_id',$current)
        ->where('status',"Accept")
        ->pluck('family_id');
	$curfa = $curfa->toArray();

        $userauths = DB::table('family_auths')
        ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
       ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
       ->orwhereIn('family.id',$curfa)
       ->orwhere('family_auths.created_by' , $current)
       ->where('family.name' , $org)
       ->where('family_auths.status' , "Accept")

       ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id')

       ->paginate(100);
       return view('system-mgmt/familyauth/list', ['curfamss'=>$curfamss,'userauths' => $userauths ]);

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function request(Request $request){
      $current = Auth::guard('person')->user()->id;
      $curadd =  DB::table('family_auths')
      ->where('member_id' ,'=', $current)
      ->pluck('created_by');
      $curin = DB::table('persons')
      ->whereIn('id',$curadd)
      ->value('name');

       $userauths = DB::table('family_auths')
       ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
      ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')
      ->where('member_id' ,'=', $current)
      ->where('family_auths.status' ,'!=', 'Accept')
      ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id')
      ->paginate(100);
      //return $current;
      return view('system-mgmt/familyauth/request', ['userauths' => $userauths ,'curin' =>$curin]);
     }

     public function updaterequest(Request $request,$id){
      $userauth = Family_auth::findOrFail($id);
      $getid = Family_auth::where('id',$id)->value('family_id');
      $checkfam = Family::where('id',$getid)->value('approve');
      if($checkfam == 1){
        Family_auth::where('id', $id)
        ->update(['status'=>'Waiting']);
      }
      else{
      Family_auth::where('id', $id)
      ->update(['status'=>'Accept']);
    }
      return redirect()->back();
       //$submit =   Family_auth::where('member_id',$request->get('id'))->update(['status'=> 'Accept']);
       //return back();
     }
     public function create()
     {

       //sidebar
      $current = Auth::guard('person')->user()->id;
      $url = url()->previous();
      $url = explode('/',$url);
      $url = $url[4];
      $checkurl = url()->previous();
      $checkurl = explode('/',$checkurl);
      if(in_array('list',$checkurl)){
        $url = url()->previous();
        $url = explode('/',$url);
        $url = $url[5];
      }

        $structures = Family::where('id',$url)->get();
       $users = Person::all();

        return view('system-mgmt/familyauth/create', ['structures' => $structures, 'users' => $users ,'current' =>$current]);

     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {



       Family::findOrFail($request['family_id']);

      // Person::findOrFail($request['member_id']);

       $this->validateInput($request,[

      'description' => 'nullable|string|max:60'

      ]);
      $current = Auth::guard('person')->user()->id;
      $publicid = match_id::where('member_id',$current)->value('id');
      $publicname = match_id::where('member_id',$current)->value('public_name');

      $mail = $request->member_id;


      $matchids = DB::table('persons')


     ->where(
       'email',$mail
     )
     ->value('id');

     if($matchids == NULL){
       $link = 'https://erp.wealththai.net/quickregister?refmem?'.$publicid;
       $what = 'กลุ่ม';
       $previous = $request->previous;
       Mail::send('emails.requestregis',compact('what','link','publicid','publicname'),function($message) use ($mail){
        $message->to($mail);
        $message->subject('มีการเชิญเข้าร่วมกลุ่ม');
      });
       $request->session()->flash('alert-danger', 'อีเมลล์ '.$mail.' ไม่มีอยู่ในระบบเราได้ทำการส่งข้อความใหอีเมลล์นี้รับทราบแล้ว');
       return redirect()->intended($previous);
     }

     $pid = DB::table('match_id')->where('member_id',$matchids)->value('id');
     $current = Auth::guard('person')->user()->id;
     $currentpid = DB::table('match_id')->where('id',$current)->value('id');
        Family_auth::create([
          'member_id' => $matchids,
          'family_id' => $request['family_id'],
          'status' => $request['status'],
          'created_by' => $request['created_by'],

          'description' => $request['description']

       ]);
       $sendername = DB::table('family')->where('id',$request->family_id)->value('name');
       $noti = new Noti;
                 $noti->message_type_id = 39;
                 $message = DB::table('message_types')->where('id',$noti->message_type_id)->get();
                 foreach($message as $mes){
                 $noti->message = $mes->message_default.$sendername;
                 $noti->topic = $mes->message_template;
                }
                 $noti->sender_note  = $request-> sender_note;
                 $noti->status = $request-> status;
                 $noti->sender_id  = $currentpid;
                 $noti->created_by = 1;
                 $noti->recieve_id =$pid;
                 $noti->save();

                 $reciever = DB::table('match_id')->where('id',$pid)->get();
                 $sender = DB::table('match_id')->where('id',$currentpid)->get();
		 			//return  $reciever;
                 $messagetypes = DB::table('message_types')
                 ->where('message_types.id',$noti->message_type_id)
                 ->leftJoin('message_cats', 'message_types.message_cat_id', '=', 'message_cats.id')
                 ->select('message_types.*','message_cats.name as message_cat_name', 'message_cats.id as message_cat_id')
                 ->get();

     	  Mail::send('emails.invitationgroup',compact('messagetypes','sendername','reciever'),function($message) use ($matchids,$messagetypes,$sender,$reciever){
         foreach ($sender as $sen) {
         $message->from($sen->public_email);
            }
         foreach ($reciever as $cursen) {
         $message->to($cursen->public_email);
            }
         foreach ($messagetypes as $messages) {
         $message->subject($messages->message_template);
         }
       });
       $previous = $request->previous;
       $ex = explode('/',$previous);
       return redirect()->intended($previous);
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

       $current = Auth::guard('person')->user()->id;
         $userauth = Family_auth::find($id);

         // Redirect to division list if updating division wasn't existed
         if ($userauth == null) {
           $userauth = Family_auth::find($id);
           $data = array(
               'userauth' => $userauth
             );
             return redirect()->intended('/familyauth');
           }
           $structures = Family::all();

           $users = Person::all();
         return view('system-mgmt/familyauth/edit', ['userauth' => $userauth,'structures' => $structures,'users' => $users ,'current'=>$current]);
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
         $userauth = Family_auth::findOrFail($id);
         $input = [
           'member_id' => $request['member_id'],
           'family_id' => $request['family_id'],
           'status' => $request['status'],
           'created_by' => $request['created_by'],

           'description' => $request['description']

         ];
         $this->validate($request, [
         'member_id' => 'required|max:60',
         'family_id' => 'required|max:60',
         'status' => 'required|max:60',

         'description' => 'nullable|max:60'
         ]);
         Family_auth::where('id', $id)
             ->update($input);

         return redirect()->intended('/familyauth');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
        $url = url()->previous();
        $url = explode('/',$url);
        $url = $url[4];
         Family_auth::where('id', $id)->delete();
         Port_Group_auth::where('group_id',$url)->where('created_by',$id)->delete();
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
          $constraints = [
           'member_id' => $request['member_id'],
           'family_id' => $request['family_id'],
           'status' => $request['status'],
           'created_by' => $request['created_by'],

           'description' => $request['description'],
           'family.name' => $request['family_name'],

            'persons.name' => $request['member_name']
             ];

        $userauths = $this->doSearchingQuery($constraints);
        $constraints['family_name'] = $request['family_name'];
        $constraints['member_name'] = $request['member_name'];

        return view('system-mgmt/familyauth/index', ['userauths' => $userauths, 'searchingVals' => $constraints,'tree'=>$tree]);
     }

     private function doSearchingQuery($constraints) {
       $query = DB::table('family_auths')
       ->leftJoin('persons', 'family_auths.member_id', '=', 'persons.id')
      ->leftJoin('family', 'family_auths.family_id', '=', 'family.id')


      ->select('family_auths.*','family_auths.description', 'family.name as family_name', 'family.id as family_id','persons.name as member_name', 'persons.id as member_id');



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


     ]);
     }
 }
