<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
use App\match_id;
use App\Message_type;
use App\Person;
use App\Noti;
use App\Province;
use App\Mail\Welcome;
use App\Policy;
use App\Http\Controllers\SidebarperController;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\NotiController;

class QuickregisController extends Controller
{
use Queueable, SerializesModels;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     /*protected function validator(array $data){
       return Validator::make($data,[
         'name' => 'required|string|max:255',
         'Eng_name' => 'required|string|max:255',
         'lname' => 'required|string|max:255',
         'Eng_lastname' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:persons',
         'password' => 'required|confirmed'



       ]);
     }*/
    public function store(Request $request)
    {
		date_default_timezone_set('Asia/Bangkok');
    $whatINeed5 = explode('?', $_SERVER['HTTP_REFERER']);

    $refevent = 0;
    if(in_array("refevent",$whatINeed5)){
      $refevent = $whatINeed5[2];
		if(in_array("ref",$whatINeed5)){
		$refevent = $whatINeed5[4];
		}
    }
    $eventcaptcha = DB::table('event')->where('id',$refevent)->value('captcha');

    //return $refevent;

    if($eventcaptcha != 'No'){
      $this->validate($request, [

      //  'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
      //  'name' => 'required|string|max:255',
        //'Eng_name' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
      //  'lname' => 'required|string|max:255',
      //  'Eng_lastname' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
      //  'phone' => 'required|numeric',
        'mobile' => 'required|min:6',
		  'email' => 'required|email|max:255|unique:persons',
		    'id_num' => 'required|min:13|unique:persons',
		     'g-recaptcha-response' => 'required',
         //'Eng_lastname' => 'string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
         //'Eng_name' => 'string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',


      ],
      [ 'name.required' => 'กรุณาใส่ชื่อของท่าน',
      'password.required' => 'กรุณาใส่รหัสผ่านของท่าน',
      'password.min' => 'รหัสผ่านต้องไม่น้อยกว่า6ตัวอักษร',
    //  'Eng_name.required' => 'กรุณาใส่ชื่อ(ภาษาอังกฤษ)ของท่าน',
     // 'Eng_name.regex' => 'ในช่อง Eng name กรุณาใส่เฉพาะตัวอักษรภาษาอังกฤษเท่านั้น',
      // 'lname.required' => 'กรุณาใส่นามสกุลของท่าน',
      // 'Eng_lastname.required' => 'กรุณาใส่นามสกุล(ภาษาอังกฤษ)ของท่าน',
      // 'Eng_lastname.regex' => 'ในช่อง Eng Lastname กรุณาใส่เฉพาะตัวอักษรภาษาอังกฤษเท่านั้น',
      // 'phone.required' => 'กรุณาใส่หมายเลขโทรศัพท์ของท่าน',
      // 'mobile.required' => 'กรุณาใส่หมายเลขโทรศัพท์ของท่าน',
       //'id_num.required' => 'กรุณาใส่หมายเลขบัตรประจำตัวประชาชนของท่าน',
       //'id_num.numeric' => 'หมายเลขบัตรประชาชนต้องแก เป็นตัวเลขเท่านั้น',
	   //'id_num.min' => 'กรุณากรอกเลขบัตรประจำตัวประชาชนให้ครับ 13 หลัก',
     'id_num.unique' => 'รหัสบัตรประชาชนนี้ถูกใช้ไปแล้ว',
     //  'email.required' => 'กรุณาใส่อีเมลล์ของท่าน',
       //'email.email' => 'รูปแบบของอีเมลล์ไม่ถูกต้อง',
      // 'phone.required' => 'กรุณาใส่หมายเลขโทรศัพท์',
      // 'mobile.required' => 'กรุณาใส่หมายเลขโทรศัพท์มือถือ',
       //'mobile.numeric' => 'เบอร์โทรศัพท์มือถือต้องเป็นตัวเลขเท่านั้น',
  //     'phone.numeric' => 'เบอร์โทรศัพท์ต้องเป็นตัวเลขเท่านั้น',
	   'g-recaptcha-response.required' => 'ท่านยังไม่ได้กด Captcha',
       'password.confirmed' => 'ขออภัยท่านใส่รหัสผ่านไม่ตรงกัน']
      );
    }
		$this->validate($request, [

      //  'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
      //  'name' => 'required|string|max:255',
        //'Eng_name' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
      //  'lname' => 'required|string|max:255',
      //  'Eng_lastname' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
      //  'phone' => 'required|numeric',
        'mobile' => 'required|min:6',
      //  'id_num' => 'required|numeric',
		  'email' => 'required|email|max:255|unique:persons',
		    'id_num' => 'required|min:13|unique:persons',
		     //'g-recaptcha-response' => 'required',
         //'Eng_lastname' => 'string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
         //'Eng_name' => 'string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',


      ],
      [ 'name.required' => 'กรุณาใส่ชื่อของท่าน',
      'password.required' => 'กรุณาใส่รหัสผ่านของท่าน',
      'password.min' => 'รหัสผ่านต้องไม่น้อยกว่า6ตัวอักษร',
    //  'Eng_name.required' => 'กรุณาใส่ชื่อ(ภาษาอังกฤษ)ของท่าน',
     // 'Eng_name.regex' => 'ในช่อง Eng name กรุณาใส่เฉพาะตัวอักษรภาษาอังกฤษเท่านั้น',
      // 'lname.required' => 'กรุณาใส่นามสกุลของท่าน',
      // 'Eng_lastname.required' => 'กรุณาใส่นามสกุล(ภาษาอังกฤษ)ของท่าน',
      // 'Eng_lastname.regex' => 'ในช่อง Eng Lastname กรุณาใส่เฉพาะตัวอักษรภาษาอังกฤษเท่านั้น',
      // 'phone.required' => 'กรุณาใส่หมายเลขโทรศัพท์ของท่าน',
      // 'mobile.required' => 'กรุณาใส่หมายเลขโทรศัพท์ของท่าน',
       //'id_num.required' => 'กรุณาใส่หมายเลขบัตรประจำตัวประชาชนของท่าน',
       //'id_num.numeric' => 'หมายเลขบัตรประชาชนต้องแก เป็นตัวเลขเท่านั้น',
	   //'id_num.min' => 'กรุณากรอกเลขบัตรประจำตัวประชาชนให้ครับ 13 หลัก',
     //'id_num.unique' => 'รหัสบัตรประชาชนนี้ถูกใช้ไปแล้ว',
     //  'email.required' => 'กรุณาใส่อีเมลล์ของท่าน',
       //'email.email' => 'รูปแบบของอีเมลล์ไม่ถูกต้อง',
      // 'phone.required' => 'กรุณาใส่หมายเลขโทรศัพท์',
      // 'mobile.required' => 'กรุณาใส่หมายเลขโทรศัพท์มือถือ',
       //'mobile.numeric' => 'เบอร์โทรศัพท์มือถือต้องเป็นตัวเลขเท่านั้น',
  //     'phone.numeric' => 'เบอร์โทรศัพท์ต้องเป็นตัวเลขเท่านั้น',
	  // 'g-recaptcha-response.required' => 'ท่านยังไม่ได้กด Captcha',
       'password.confirmed' => 'ขออภัยท่านใส่รหัสผ่านไม่ตรงกัน']
      );
    /*  return Person::created([
        'name'        =>$data['name'],
        'Eng_name' =>$data['Eng_name'],
        'lname'     =>$data['lname'],
        'nickname'  =>$data['nickname'],
        'Eng_lastname'  =>$data['Eng_lastname'],
        'email' =>$data['email'],
        'password'  =>hash($data['password']),
        'phone' =>$data['phone'],
        'dob'   =>$data['dob'],
        'id_num'    =>$data['id_num'],
        'university'  =>$data['university'],
        'faculty' =>$data['faculty'],
        'major' =>$data['major'],
        'gpa' =>$data['gpa'],
        'job' =>$data['job'],
        'gender'  =>$data['gender'],
        'nationality' =>$data['nationality'],
        'religion'  =>$data['religion'],
        'couple'  =>$data['couple'],
        'income'  =>$data['income'],
        'inctype' =>$data['inctype'],
        'incbonus'  =>$data['incbonus'],
        'bankaccount' =>$data['bankaccount'],
        'bank'  =>$data['bank'],
        'activestatus'  =>$data['activestatus'],
        'add1'  =>$data['add1'],
        'add1_alley'  =>$data['add1_alley'],
        'add1_road' =>$data['add1_road'],
        'add1_subdistrict'  =>$data['add1_subdistrict'],
        'add1_district '=>$data['add1_district'],
        'add1_city' =>$data['add1_city'],
        'add1_postcode'=>$data['add1_postcode'],
        ' add1_tel'=>$data['add1_tel'],
         'add1_fax'=>$data['add1_fax'],
         'add2_tel'=>$data['add2_tel'],
         'add2_fax'=>$data['add2_fax'],
         ' add2'=>$data['add2'],
         'add2_alley' =>$data['add2_alley'],
         'add2_road'=>$data['add2_road'],
         ' add2_subdistrict'=>$data['add2_subdistrict'],
          'add2_district'=>$data['add2_district'],
          'add2_city'=>$data['add2_city'],
          'add2_postcode'=>$data['add2_postcode'],
          ' add2_sentdoc'=>$data['add2_sentdoc'],
          'add3' =>$data['add3'],
          'company'=>$data['company'],
          'position '=>$data['position'],
           'com_add_no'=>$data['com_add_no'],
           'com_add_road '=>$data['com_add_road'],
           'com_add_subdistrict' =>$data['com_add_subdistrict'],
           'com_add_district'=>$data['com_add_district'],
           ' com_add_city'=>$data['com_add_city'],
            'com_add_postcode'=>$data['com_add_postcode'],
            'com_tel'=>$data['com_tel'],
            'com_fax'=>$data['com_fax'],
            'couple_name '=>$data['couple_name'],
            'couple_lname' =>$data['couple_lname'],
            'couple_job'=>$data['couple_job'],
            ' couple_phone'=>$data['couple_phone'],
             'couple_workplace'=>$data['couple_workplace'],
             'mobile' =>$data['mobile'],
             'citizen_issued_date'=>$data['citizen_issued_date'],
             'citizen_expire_date '=>$data['citizen_expire_date'],
              'race'=>$data['race'],
              'branch' =>$data['branch'],
              'bank_account_name'=>$data['bank_account_name'],
              ' add1_country'=>$data['add1_country'],
               'add2_country'=>$data['add2_country'],
               'type_business' =>$data['type_business'],
               'occupation'=>$data['occupation'],
               'work_experience '=>$data['work_experience'],
                'com_add_country'=>$data['com_add_country'],
                'couple_position' =>$data['couple_position'],
                'couple_mobile'=>$data['couple_mobile']


      ]);*/

      /*  $this->validate($request, [
          'name' => 'required|string|max:255',
          'Eng_name' => 'required|string|max:255',
          'lname' => 'required|string|max:255',
          'Eng_lastname' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:persons',

          'phone' => 'nullable|string|max:20',
          'dob' => 'nullable|string|max:255',
          'age' => 'nullable|integer|max:255',
          'id_num' => 'required|string|max:25|unique:persons',

          'university' => 'nullable|string|max:25',
          'faculty' => 'nullable|string|max:255',
          'major' => 'nullable|string|max:255',
          'gpa' => 'nullable|string|max:255',
          'job' => 'nullable|string|max:255',

          'status' => 'nullable|string|max:255',

        ]);*/
      //  $whatINeed = explode('?ref?', $_SERVER['HTTP_REFERER']);
        //$whatINeed2 = explode('?refevent?', $_SERVER['HTTP_REFERER']);

        date_default_timezone_set('Asia/Bangkok');
        date('D-m-y H:i:s');
        $whatINeed3 = explode('?refmem?', urldecode($_SERVER['HTTP_REFERER']));
		        $urlfortool = url()->previous();
        		$myString = 'toolid=';
        		 if ( strstr($urlfortool, 'toolid=') ) {
         		 $positiontoolid = strpos($urlfortool,"toolid=");
             $positiontoolid = $positiontoolid+7;
        	 $toolid = substr($urlfortool, $positiontoolid,9);
             $positionaccount = strpos($urlfortool,"accountnumber=");
             $positionaccount = $positionaccount+14;
		     $positionendaccount = strpos($urlfortool,"endacnum");
             $accountnumber = substr($urlfortool, $positionaccount,$positionendaccount);
			 $accountnumber = explode('endacnum',$accountnumber);
			 $accountnumber	= $accountnumber[0];
			 $positionrefuto = strpos($urlfortool,"refuto=");
			 $positionrefuto = $positionrefuto+7;
		     $positionendrefuto = strpos($urlfortool,"endrefu");
             $refuto = substr($urlfortool, $positionrefuto,$positionendrefuto);
		     $refuto = explode('endrefu',$refuto);
			 $refuto = $refuto[0];
             $lastview = ['flag_status' =>4 ];
             $requesttool = DB::table('online_tool')->where('tool_id',$toolid)->where('portfolio_id',$accountnumber)->update($lastview);

        		}




          $whatINeed2 =  urldecode($_SERVER['HTTP_REFERER']);
          $whatINeed2 = explode('?refevent?', $whatINeed2);
      //     $whatINeed2 = $whatINeed2[1];


    $whatINeed5 = explode('?', urldecode($_SERVER['HTTP_REFERER']));
   // $whatINeed2 = $whatINeed2[1];
   //return $whatINeed2;

        //$referred_byy = Cookie::get('referral');
        //return $referred_byy;


        $per = new Person;

        $sd = $request->sd;
        $sm = $request->sm;
        $sy = $request->sy -543;

        $date = $sd."-".$sm."-".$sy;
			if ( strstr($urlfortool, 'toolid=') ) {
				$referred_by = $refuto;
				$per->ref_user_pid =$referred_by;
			}

        if(in_array("ref",$whatINeed5)){
			//return 'yes';
		$whatINeed =  $_SERVER['HTTP_REFERER'];
        $whatINeed = explode('?ref?', $whatINeed);
        $whatINeed = $whatINeed[1];
			//return $whatINeed;
         $whatINeed = explode('?', $whatINeed);
        //  $whatINeed = $whatINeed[0];

          $whatINeed = $whatINeed[0];
           $referred_by = $whatINeed;
			$per->ref_user_pid =$referred_by;
        }

        if(in_array("refevent",$whatINeed5)){
              $per->event_id =$whatINeed5[4];
        }

        if(in_array("refmem",$whatINeed5)){
          $whatINeed3 = $whatINeed3[1];
            $mem_by = $whatINeed3;
              $per->ref_member_pid =$mem_by;
        }
        $per->name = $request -> name;
        $per->lname = $request -> lname;
        $per->Eng_name = $request ->Eng_name;
        $per->Eng_lastname = $request -> Eng_lastname;
		    $per->nickname = $request -> nickname;
        $per->email = $request-> email;
        $per->password = Hash::make($request->password);
        $per->gender = $request-> gender;
        $per->id_num = $request-> id_num;
        $per->mobile = $request-> mobile;
        $per->add2_city = $request-> add2_city;
		    $per->type = 0;
        $per->status = 'Active';
        $per->dob = $date;
		      $source = '';
      $medium = '';
      $name = '';
      $term = '';
      $content = '';
        if(in_array("UTM",$whatINeed5)){
          //return 'yes';
        $whatINeed1 = explode('?UTM??', urldecode($_SERVER['HTTP_REFERER']));
        $source = explode('utm_source=',$whatINeed1[1]);
        $source = explode('&',$source[1]);
        $source = $source[0];
        $medium = explode('utm_medium=',$whatINeed1[1]);
        $medium = explode('&',$medium[1]);
        $medium = $medium[0];
        $name = explode('utm_name=',$whatINeed1[1]);
        $name = explode('&',$name[1]);
        $name = $name[0];
        $term = explode('utm_term=',$whatINeed1[1]);
        $term = explode('&',$term[1]);
        $term = $term[0];
        $content = explode('utm_content=',$whatINeed1[1]);
        $content = explode('&',$content[1]);
        $content = $content[0];

        $per->utm_source = $source;
        $per->utm_medium = $medium;
        $per->utm_name = $name;
        $per->utm_term = $term;
        $per->utm_content = $content;
        //return 'yes';
        $currentdate = date('d/m/Y');
        $currenttime = date('H:i:s');
        $per->regis_date =$currentdate;
        $per->regis_time =$currenttime;
        $per->lead_status =0;
      }
        if(in_array("UTM",$whatINeed5)){
          $whatINeed3 = explode('?refmem?', urldecode($_SERVER['HTTP_REFERER']));

        }



      ///  Mail::to($per)->send(new Welcome);
          //Mail::to($per)->send(new Welcome);
        /*  Mail::send('emails.welcome', compact('per'), function ($message) use($per) {
              $message->to($per['email'])
                      ->subject('Verify Your Email Address');

          });*/

                       $input = $request->all();
                      //  $validator = $this->validate($input);
                        $password = $request->password;
                        $input['password'] =substr($password, 0, -3);

                      $input['password'] .= "***";


                        //  $mem = $this->$input->toArray();
                          Mail::send('emails.welcome',$input,function($message) use ($input){

                            $message->to($input['email']);
                            $message->subject('ยืนยันการสมัครเข้าใช้งาน Website Wealth Thai ');
                          });
                          $per->save();
							$match_id = new match_id;
                          $match_id->public_name = $per->name;
                          $match_id->public_email = $per->email;
                          $match_id->public_mobile = $per->mobile;
                          $match_id->sender_citizen = $per->id_num;
                          $match_id->member_id = $per->id;
                          $match_id->save();

		                if($per->ref_user_pid != NULL || $per->ref_member_pid != NULL)
                {
							  if($per->ref_user_pid != NULL)
                {

							  $noti = new Noti;
                          $noti->message_type_id = 7;
                          $noti->message = $request-> message;
                          $noti->topic = $request-> topic;
                          $noti->sender_note  = $request-> sender_note;
                          $noti->status = $request-> status;
                          $noti->sender_id  = $match_id->id;
                          $noti->created_by = 1;
                          $noti->recieve_id =$per->ref_user_pid;
                          $noti->save();

                        }
                  if($per->ref_member_pid != NULL)
                  {
                    $noti = new Noti;
                              $noti->message_type_id = 7;
                              $noti->message = $request-> message;
                              $noti->topic = $request-> topic;
                              $noti->sender_note  = $request-> sender_note;
                              $noti->status = $request-> status;
                              $noti->sender_id  = $match_id->id;
                              $noti->created_by = 1;
                              $noti->recieve_id =$per->ref_member_pid;
                              $noti->save();
                  }

                          $currentid =$noti->recieve_id;

                          $matchids = DB::table('match_id')
                          ->where('match_id.id',$currentid)
                          ->leftJoin('users', 'match_id.user_id', '=', 'users.id')

                         ->leftJoin('persons', 'match_id.member_id', '=', 'persons.id')

                         //->select('match_id.*','match_id.id', 'persons.name as member_name', 'persons.id as member_id','users.username as user_name', 'users.id as user_id')

                         ->pluck('public_email');

                         $currentsender =$noti->created_by;

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


                        ->select('d.*','d.id', 'au.public_name as sender_name', 'au.public_email as sender_email', 'au.public_mobile as sender_mobile','au.sender_citizen as sender_idnum', 'au.id as sender_id','cu.public_name as recieve_name', 'cu.id as recieve_id' , 'du.id as created_by','du.public_name as created_name','message_types.message_template as message_type_name','message_types.message_default as message_type_default', 'message_types.id as message_type_id')

                        ->get();
                        //->pluck('public_email');


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

							$messages = $request->message;

                           Mail::send('emails.noti',compact('messages','messagetypes','sender'),function($message) use ($matchids,$messagetypes,$cursender){
                             foreach ($cursender as $cursen) {

                            $message->from($cursen->public_email);
                               }
                            $message->to($matchids);

                           foreach ($messagetypes as $messages) {
                             $message->subject($messages->message_template);
                            }
                          });
		  $sender = match_id::where('id',$match_id->id)->get();
                          $reciever = match_id::where('id',$per->ref_member_pid)->get();
                          $sentmail = new NotiController();
                          $sentmail = $sentmail->emailwelcome($sender,$reciever,$messagetypes);
						}
                           $request->session()->flash('alert-success', 'การลงทะเบียนของท่านสำเร็จแล้ว!! ขณะนี้ท่านสามารถท่านสามารถเข้าใช้งานระบบได้ ');
		$chkurl = url()->previous();
                          /* if($chkurl != 'https://erp.wealththai.net/quickregister')
                             {

                              $chkrelink = urldecode(url()->previous());
							  $numchk = explode('?',$chkrelink);
							  $chkrelink = explode('?',$chkrelink);
                              $chkrelink = $chkrelink[1];
							   $countchk = count($numchk);
							  $chkrelink2 = '';
                             /* if($countchk > 2){
                                $chkrelink2 =  $numchk[5];
                              }
							   //return $chkrelink;
							   if(Auth::guard('person')->attempt(['email' => $request->email,'password' => $request->password],$request->remember)){
                  				 $side = new SidebarperController();
                 				 $side = $side->getSide();
                  				 Session::put('side', $side);
                  				 if($chkrelink == "ref"){
                 			     return redirect('/person');
                 			    }
							  $chkrelink = $chkrelink.'?'.$chkrelink2;
							 if ( strstr($urlfortool, 'toolid=') ) {

								 $chkrelink = DB::table('tool')->where('tool_ref_product_id',$toolid)->value('id');
								 $chkrelink = 'https://erp.wealththai.net/toolmember/toolset/'.$chkrelink;

							   }
                 			  return redirect($chkrelink);
                 }
                 return redirect()->back()->withInput($request->only('email','remember'));

							   $returnlink = '/'.'??wealththaievent??'.$chkrelink;
			   		   if(strstr($chkurl,'password') || strstr($chkurl,'refmem'))
		   {
				return redirect('/person');
		   }
                              return redirect($returnlink);
                             }*/
							//return 'omg';
                             if(Auth::guard('person')->attempt(['email' => $request->email,'password' => $request->password],$request->remember)){
                               $side = new SidebarperController();
                               $side = $side->getSide();
                               Session::put('side', $side);
                           return redirect('/person');
                         }
                  }





    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
		        $currentyear = date('Y') + 543;
       //$whatINeed5 = explode('?', $_SERVER['HTTP_REFERER']);
       $whatINeed5 = explode('?', $_SERVER['REQUEST_URI']);
		 $loginurl = '/person';
		 if(count($whatINeed5) > 1)
		 {
		 $loginurl = $whatINeed5[1];
		 }
       //return $whatINeed5;
       $refevent = 0;
       if(in_array("refevent",$whatINeed5)){
         $refevent = $whatINeed5[2];
		   if(in_array("ref",$whatINeed5)){
				   $refevent = $whatINeed5[4];
		   }
       }

       $eventcaptcha = DB::table('event')->where('id',$refevent)->value('captcha');

       //return $eventcaptcha;
     $matchids = match_id::all();
       $messagetypes = message_type::all();

       $province = Province::orderBy('name_in_thai','ASC')->get();


       //return $whatINeed2;
       $policy = Policy::where('id',1)->get();

       return view('perregis.quickregis', [ 'loginurl' => $loginurl,'policy' => $policy,'currentyear' => $currentyear,'eventcaptcha' => $eventcaptcha,'province' => $province,'messagetypes' => $messagetypes,'matchids' => $matchids,]);

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
       $this->validate($request, [
         'name' => 'required|string|max:255',
         'Eng_name' => 'required|string|max:255',
         'lname' => 'required|string|max:255',
         'Eng_lastname' => 'required|string|max:255',
         'phone' => 'nullable|string|max:20',
         'dob' => 'nullable|string|max:255',


         'id_num' => 'required|string|max:25',

         'university' => 'nullable|string|max:25',
         'faculty' => 'nullable|string|max:255',
         'major' => 'nullable|string|max:255',
         'gpa' => 'nullable|string|max:255',
         'job' => 'nullable|string|max:255',



         'port_status' => 'nullable|string|max:255',
         'per_port' => 'nullable|string|max:255'
       ]);
       $per = Person::find($id);

       $per->name = $request -> name;
       $per->Eng_name = $request -> Eng_name;
       $per->lname = $request -> lname;
       $per->nickname = $request -> name;
       $per->Eng_lastname = $request -> Eng_lastname;
       $per->email = $request-> email;

       $per->phone = $request-> phone;
       $per->dob = $request-> dob;

       $per->id_num = $request-> id_num;

       $per->university = $request-> university;
       $per->faculty = $request-> faculty;
       $per->major = $request-> major;
       $per->gpa = $request-> gpa;
       $per->job = $request-> job;


       $per->gender = $request-> gender;
       $per->nationality = $request-> nationality;
       $per->religion = $request-> religion;
       $per->couple = $request-> couple;
       $per->income = $request-> income;
       $per->inctype = $request-> inctype;
       $per->incbonus = $request-> incbonus;
       $per->bankaccount = $request-> bankaccount;
       $per->bank = $request-> bank;
       $per->activestatus = $request-> activestatus;
       $per->add1 = $request-> add1;
       $per->add1_alley = $request-> add1_alley;
       $per->add1_road = $request-> add1_road;
       $per->add1_subdistrict = $request-> add1_subdistrict;
       $per->add1_district = $request-> add1_district;
       $per->add1_city = $request-> add1_city;
       $per->add1_postcode = $request-> add1_postcode;
       $per->add1_tel = $request-> add1_tel;
       $per->add1_fax = $request-> add1_fax;
       $per->add2_tel = $request-> add2_tel;
       $per->add2_fax = $request-> add2_fax;
       $per->add2 = $request-> add2;
       $per->add2_alley = $request-> add2_alley;
       $per->add2_road = $request->add2_road;
       $per->add2_subdistrict = $request-> add2_subdistrict;
       $per->add2_district = $request-> add2_district;
       $per->add2_city = $request-> add2_city;
       $per->add2_postcode = $request-> add2_postcode;
       $per->add2_sentdoc = $request-> add2_sentdoc;

       $per->add3 = $request-> add3;
       $per->company = $request-> company;
       $per->position = $request-> position;
       $per->com_add_no = $request-> com_add_no;
       $per->com_add_alley = $request-> com_add_alley;
       $per->com_add_road = $request-> com_add_road;
       $per->com_add_subdistrict = $request-> com_add_subdistrict;
       $per->com_add_district = $request-> com_add_district;
       $per->com_add_city = $request-> com_add_city;
       $per->com_add_postcode = $request-> com_add_postcode;
       $per->com_tel = $request-> com_tel;
       $per->com_fax = $request-> com_fax;
       $per->couple_name = $request-> couple_name;
       $per->couple_lname = $request-> couple_lname;
       $per->couple_job = $request-> couple_job;
       $per->couple_phone = $request-> couple_phone;
       $per->couple_workplace = $request-> couple_workplace;


       $per->mobile = $request-> mobile;
       $per->citizen_issued_date = $request-> citizen_issued_date;
       $per->citizen_expire_date = $request-> citizen_expire_date;


       $per->race = $request-> race;
       $per->branch = $request-> branch;
       $per->bank_account_name	 = $request-> bank_account_name;

       $per->add1_country = $request-> add1_country;

       $per->add2_country = $request-> add2_country;
       $per->type_business = $request-> type_business;
       $per->occupation = $request-> occupation;
       $per->work_experience = $request-> work_experience;
       $per->com_add_country = $request-> com_add_country;
       $per->couple_position = $request-> couple_position;

       $per->couple_mobile = $request-> couple_mobile;
       $per->save();

       Session::flash('message','Success Update !');
       return redirect('/person');


     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



}
