<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Person;
use App\Structure;
use App\Block;
use App\Portfolio;
use Response;
use Session;
use App\Viewper;
use App\Port_type;
use App\Port_Ref_Link;
use App\Asset;
use App\match_id;
use Illuminate\Support\Facades\Hash;
class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function __construct()
         {
             $this->middleware('viewper');
         }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     *///$c = Session::get('id');
     public function getperid(){
       $perid =Session_id();
       return $perid;
     }
    public function index()
    {
      $current = Auth::guard('person')->user()->id;

        return view('person');
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
    public function show()
    {
      $current = Auth::guard('person')->user()->id;
      $i=0;
      $user = Auth::guard('person')->user()->id;
    /*  $currentid = DB::table('portfolio')

              ->where(
                        [ 'member_id', '=', $user]

                     )
                     ->pluck('block_id');*/
                     $portfolios = DB::table('portfolio')

                     ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
                    ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
                    ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
                        ->where('member_id',$user)


                      //->whereIn('block.under_block',$notebook)



                      ->select('portfolio.*','portfolio.status', 'portfolio.type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name','block.contact_name as contact_name','block.contact_tel as contact_tel','block.contact_email as contact_email', 'block.id as block_id','port_types.id as port_id','port_types.type as port_name','port_types.link as port_link',
                      'port_types.port_limit_value as port_limitvalue','port_types.port_detail_label1 as port_lebel1','port_types.port_detail_label2 as port_lebel2','port_types.port_detail_label3 as port_lebel3','port_types.port_detail_label4 as port_lebel4','port_types.port_detail_label5 as port_lebel5','port_types.port_detail_label6 as port_lebel6','port_types.port_detail_label7 as port_lebel7',
                      'port_types.ref_link_name1 as ref_name1','port_types.ref_link_name2 as ref_name2','port_types.ref_link_name3 as ref_name3')

                      ->get();









                      //  return $portor;

                    //  return $notebook;

    //  return View::make('department.create')->with('user', $user);
      return view('person/showport',['portfolios'=>$portfolios,'i'=> $i]);

    }



    public function portshow()
    {
      $current = Auth::guard('person')->user()->id;
      $i =0;
       $portor = DB::table('port_auths')->where('port_auths.member_id',$current)
       ->leftJoin('persons','port_auths.created_by','persons.id')
       ->leftJoin('portfolio','port_auths.port_id','=','portfolio.id')
       ->leftJoin('port_types','portfolio.port_id','=','port_types.id')
       ->leftJoin('structure','portfolio.structure_id','=','structure.id')
       ->leftJoin('block','portfolio.block_id','=','block.id')
		   	 ->whereNotNull('port_auths.port_id')
       ->select('port_auths.*','port_types.type as port_type_name','portfolio.id as port_id','portfolio.number as number','portfolio.type as port_name','persons.name as creator','persons.lname as creatorl','structure.name as structure_name',
       'block.name as block_name','block.contact_name as contact_name','block.contact_tel as contact_tel','block.contact_email as contact_email')
		->orderBy('persons.name')
       ->get();

return view('person/portshow',['portor'=>$portor,'i'=>$i]);

}





    public function group(Request $request)
    {
      $current = Auth::guard('person')->user()->id;
      $i=0;
      $user = Auth::guard('person')->user()->id;
                      $org = $request->org;

                      $current = Auth::guard('person')->user()->id;


                      $curor = DB::table('family_auths')


                        ->where('status',  "Accept")
                         ->where('member_id',  $current)
                        ->pluck('family_id');

                        if(count($curor) =="0"){


                          return view('error');

                    }

                        $curorg = DB::table('port_group_auths')



                           ->where('group_id',  $curor)

                          ->pluck('port_id');

                       //->whereIn('block.under_block',$notebook)
                       $curorid = DB::table('family')



                          ->where('id',  $curor)
                         ->pluck('created_by');

                         $curorgs= DB::table('family')


                            ->where('created_by',$current)
                            ->orwhere('id',  $curor)
                           ->get();

                         $curorname = DB::table('family')



                            ->where('id',  $curor)
                           ->value('name');

                           $portor = DB::table('port_group_auths')
                           ->leftjoin('portfolio','port_group_auths.port_id', '=', 'portfolio.id')
                           ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
                          ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
                          ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
                          ->leftjoin('family', 'port_group_auths.group_id' ,'=', 'family.id')
                          ->where('family.name',$org)
                              ->whereIn('portfolio.id',$curorg)
                              ->select('port_group_auths.*','portfolio.*','family.name as family_name', 'family.id as group_id', 'portfolio.type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name','block.contact_name as contact_name','block.contact_tel as contact_tel','block.contact_email as contact_email', 'block.id as block_id','port_types.id as port_id','port_types.type as port_name','port_types.link as port_link')

                              ->get();

      return view('person/portshowgroup',['curorgs'=>$curorgs,'curorname'=>$curorname,'portor'=>$portor,'i'=> $i]);

    }



    public function create()
    {
      $current = Auth::guard('person')->user()->id;


        return view('person/create' );
    }

        public function note($id)
    {

                   $current = Auth::guard('person')->user()->id;
                   $curmem = DB::table('portfolio')

                          ->where('member_id','=',$current)

                                 ->pluck('id');
                                 $curmem = $curmem->toArray();
                   $portfolio = portfolio::find($id);
                   $number = [123, 713, 3];
                   // Redirect to city list if updating city wasn't existed
                   //if ($id == $number )
                   $current = Auth::guard('person')->user()->id;
                   $curmem = DB::table('portfolio')

                          ->where('member_id','=',$current)

                                 ->pluck('id');
                                 $curmem = $curmem->toArray();
                   //  $portfolio = portfolio::find($id);
                   $number = [123, 713, 3];
                   // Redirect to city list if updating city wasn't existed
                   //if ($id == $number )
                   $current = Auth::guard('person')->user()->id;
                   $groupauth = DB::table('family_auths')->where('member_id',$current)->pluck('family_id')->toArray();
                   $groupauthcount = DB::table('family_auths')->where('member_id',$current)->count();

                   $portauth = DB::table('port_group_auths')->where('group_id',0)->pluck('port_id')->toArray();

                   $orgauth = DB::table('organize_auths')->where('member_id',$current)->pluck('organize_id')->toArray();
                   $orgauthcount = DB::table('organize_auths')->where('member_id',$current)->count();
                   $portorgauth = DB::table('port_org_auths')->where('org_id',0)->pluck('port_id')->toArray();


                   $memauthcount = DB::table('port_auths')->where('member_id',$current)->count();
                   $portauthmem = DB::table('port_auths')->where('member_id',0)->pluck('port_id')->toArray();
                   if($memauthcount > 0){
                     $portauthmem = DB::table('port_auths')->where('member_id',$current)->pluck('port_id')->toArray();

                   }
                   if($orgauthcount > 0){
                     $portorgauth = DB::table('port_org_auths')->where('org_id',$orgauth)->pluck('port_id')->toArray();

                   }
                   if($groupauthcount > 0){

                   $portauth = DB::table('port_group_auths')->whereIn('group_id',$groupauth)->pluck('port_id')->toArray();
                   //return$portauth;
                   }

                   if(in_array($id, $curmem) || in_array($id,$portauth) || in_array($id, $portorgauth) || in_array($id, $portauthmem)){
                     $portfolio = Portfolio::find($id);
                     $data = array(
                         'portfolio' => $portfolio
                     );
                      return view('person/notebook',compact('portfolio'))->with('id',$id);


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
    public function update(Request $request)
    {

        $portfolio = ['note'=>$request->note];
        DB::table('portfolio')->where('id',$request->id)->update($portfolio);
		$re = $request->previous;
		return redirect($re);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Portfolio::where('id', $id)->delete();
         return redirect()->intended('person/showport');
    }



public function edit()
    {


      $current = Auth::guard('person')->user()->id;



      $current = Auth::guard('person')->user()->id;
      $per = Person::where('id',$current);
      $curdob = Person::where('id',$current)->value('dob');
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


      $curcitizenis = Person::where('id',$current)->value('citizen_issued_date');

      if($curcitizenis != NULL){
      $curcitizenis = explode('-', $curcitizenis);
      $curcitidate =$curcitizenis[0];
      $curcitimonth =$curcitizenis[1];
      $curcitiyear =$curcitizenis[2];
    }
  else {
    $curcitidate ="";
      $curcitimonth ="";
      $curcitiyear ="";
  }

      $curcitizenex = Person::where('id',$current)->value('citizen_expire_date');
      if($curcitizenex != NULL){
      $curcitizenex = explode('-', $curcitizenex);
      $curcitiexdate =$curcitizenex[0];
      $curcitiexmonth =$curcitizenex[1];
      $curcitiexyear =$curcitizenex[2];
    }
    else {
      $curcitiexdate ="";
      $curcitiexmonth ="";
      $curcitiexyear ="";
    }

    //  return $curcitiexdate;
      //return $curmonth;
      $provinces = DB::table('provinces')->get();
        $countrys = DB::table('country')->get();
          $subdistricts = DB::table('subdistricts')->get();
          $districts = DB::table('districts')->get();
      return view('person.editprofile2',['curcitiexdate' =>$curcitiexdate,'curcitiexmonth' =>$curcitiexmonth,
                                        'curcitiexyear' =>$curcitiexyear,'curcitidate' =>$curcitidate,'curcitimonth' =>$curcitimonth,
                                        'curcitiyear' =>$curcitiyear,'curdate' =>$curdate,'curmonth' =>$curmonth,
                                        'curyear' =>$curyear,'per' =>$per,
                                      'provinces' => $provinces,'countrys' => $countrys,'subdistricts' => $subdistricts,'districts' => $districts]);
    }
    public function profile()
    {

      $current = Auth::guard('person')->user()->id;

      $current = Auth::guard('person')->user()->id;
      $ref = DB::table('persons')
      ->where('persons.id' ,'=',$current)

      ->leftJoin('event', 'persons.event_id', '=', 'event.id')
//->leftJoin('match_id as re ', 'persons.ref_member_pid', '=', 're.id')
     ->leftJoin('match_id as u', 'persons.ref_user_pid', '=', 'u.id')
      ->leftJoin('match_id as i', 'persons.ref_member_pid', '=', 'i.id')
      ->leftJoin('provinces as p1', 'persons.add1_city', '=', 'p1.id')
      ->leftJoin('provinces as p2', 'persons.add2_city', '=', 'p2.id')
      ->leftJoin('districts as d1','persons.add1_district','=','d1.id')
      ->leftJoin('districts as d2','persons.add2_district','=','d2.id')
      ->leftJoin('subdistricts as s1','persons.add1_subdistrict','=','s1.id')
      ->leftJoin('subdistricts as s2','persons.add2_subdistrict','=','s2.id')
      ->leftJoin('country as c1','persons.add1_country','=','c1.id')
      ->leftJoin('country as c2','persons.add2_country','=','c2.id')
     ->select('persons.*', 'u.public_name as user_name', 'u.id as user_id', 'i.public_name as mem_name', 'i.id as mem_id', 'event.event_name as event_name', 'event.id as event_id'
     ,'c1.name as add1_country','c2.name as add2_country','p1.name_in_thai as add1_city','p2.name_in_thai as add2_city'
     ,'d1.name_in_thai as add1_district','d2.name_in_thai as add2_district','s1.name_in_thai as add1_subdistrict','s2.name_in_thai as add2_subdistrict')
       ->get();
       $findfileid = DB::table('member_attachment')->where('member_id',$current)->pluck('file_id');
       $fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','Active')->get();
      return view('person/profile',['ref' =>$ref,'fileasset' =>$fileasset]);

    }

    public function ref()
    {
      $current = Auth::guard('person')->user()->id;
     $currentmatchids = DB::table('match_id')

                     ->where([
                               [ 'member_id', '=', $current]

                            ])
                            ->value('id');
                            $matchids = DB::table('match_id')

                                    ->where([
                                              [ 'member_id', '=', $current]

                                           ])
                                           ->value('id');
                        $refmem = DB::table('persons')->where('ref_member_pid',$matchids)->get();
      return view('person/reflink',['refmem'=> $refmem,'currentmatchids'=> $currentmatchids ]);

    }
	    public function repassword($id)
    {
      $current = Auth::guard('person')->user()->id;

           if($id == $current){
             $user = Person::find($id);
           $data = array(
               'user' => $user
           );

           return view('person/repassword', ['user' => $user ]);
           }

                 return view('error');
           }

           public function uppass(Request $request, $id)
           {
               $user = Person::findOrFail($id);

               $input = [
               //  $user->password = Hash::make($request->password);

                   'password' => Hash::make($request['password']),

               ];
               if ($request['password'] != null && strlen($request['password']) > 0) {
                   $constraints['password'] = 'required|min:6|confirmed';
                   $input['password'] =  Hash::make($request['password']);
               }
               $oldpassword = $request->oldpassword;
               $curpass  = Auth::user()->password;

               if(!Hash::check($oldpassword,$curpass)){
                 $request->session()->flash('alert-danger', 'old password note match ');
                 return redirect()->back();
               }
               else{
              // return 'No';
               $this->validate($request, $constraints);
               Person::where('id', $id)
                   ->update($input);
                   $current = Auth::guard('person')->user()->id;
                     $per = ['status'=> 'Active'];
                     DB::table('persons')->where('id',$current)->update($per);

                 $request->session()->flash('alert-success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว!! ');
               return redirect()->intended('/person');
               }




           }
           public function showdetail($id){


                                  $current = Auth::guard('person')->user()->id;
                                  $curmem = DB::table('portfolio')

                                         ->where('member_id','=',$current)

                                                ->pluck('id');
                                                $curmem = $curmem->toArray();
                                  $portfolio = portfolio::find($id);
                                  $number = [123, 713, 3];
                                  // Redirect to city list if updating city wasn't existed
                                  //if ($id == $number )

                                      $ref = DB::table('portfolio')
                                      ->where('portfolio.id',$id)
                                        ->leftJoin('port_types', 'portfolio.port_id', '=', 'port_types.id')
                                       ->leftJoin('structure', 'portfolio.structure_id', '=', 'structure.id')
                                       ->leftJoin('block', 'portfolio.block_id', '=', 'block.id')
                                       //มันไม่เก็บของตัวเอง Notebookอะ ไม่เช็คลงไป ทำไม  ไม่เอา 55 มา
                                       ->leftJoin('persons', 'portfolio.member_id', '=', 'persons.id')
                                       ->leftJoin('file as f1', 'portfolio.file_port_ref1', '=', 'f1.id')
                                       ->leftJoin('file as f2', 'portfolio.file_port_ref2', '=', 'f2.id')
                                       ->leftJoin('file as f3', 'portfolio.file_port_ref3', '=', 'f3.id')
                                       ->select('portfolio.*','portfolio.status', 'portfolio.type','portfolio.portfolio_type', 'structure.name as structure_name', 'structure.id as structure_id','block.name as block_name', 'block.id as block_id','persons.name as member_name','persons.lname as member_lname', 'persons.id as member_id','port_types.type as port_name', 'port_types.id as port_id',
                                       'port_types.port_limit_value as port_limitvalue','port_types.port_detail_label1 as port_lebel1','port_types.port_detail_label2 as port_lebel2','port_types.port_detail_label3 as port_lebel3','port_types.port_detail_label4 as port_lebel4','port_types.port_detail_label5 as port_lebel5','port_types.port_detail_label6 as port_lebel6','port_types.port_detail_label7 as port_lebel7',
                                       'port_types.ref_link_name1 as ref_name1','port_types.ref_link_name2 as ref_name2','port_types.ref_link_name3 as ref_name3'
                                       ,'f1.file_public_name as file_port_name1','f2.file_public_name as file_port_name2','f3.file_public_name as file_port_name3',
                                       'port_types.port_label_ref1 as port_label1','port_types.port_label_ref2 as port_label2','port_types.port_label_ref3 as port_label3')
                                      //->orderBy('created_at', 'desc')
                                       ->get();

                          $findref1 = Portfolio::where('id',$id)
                         ->value('ref_link_id1');
                         $findref2 = Portfolio::where('id',$id)
                        ->value('ref_link_id2');
                        $findref3 = Portfolio::where('id',$id)
                       ->value('ref_link_id3');
                           $reflink1 = Port_Ref_Link::where('ref_link_id',$findref1)->value('real_url');
                           $reflink2 = Port_Ref_Link::where('ref_link_id',$findref2)->value('real_url');
                           $reflink3 = Port_Ref_Link::where('ref_link_id',$findref3)->value('real_url');

                         $data = array(
                           'ref' => $ref
                         );
                       $structures = Structure::all();
                       $blocks = Block::all();
                       $persons = Person::all();
                       $porttypes =Port_type::all();
                       $r = $_SERVER['REQUEST_URI'];
                       $r = explode('/', $r);
                       $r = $r[3];
                       $portnumber = Portfolio::where('id',$id)
                      ->value('number');
                      $name1 = 'Portfolio_Attachment_'.$r;
                      $filerefname =$name1.'_'.$portnumber ;
                      $filecat ='CA3CA';
                      $currentfile1 = DB::table('portfolio')->where('id',$id)->value('file_port_ref1');
                      $currentfile2 = DB::table('portfolio')->where('id',$id)->value('file_port_ref2');
                      $currentfile3 = DB::table('portfolio')->where('id',$id)->value('file_port_ref3');
                    //  $allcurrentport = [$currentfile1,$currentfile2,$currentfile3];

                      $files1 = DB::table('file')->where('id',$currentfile1)->get();
                      $files2 = DB::table('file')->where('id',$currentfile2)->get();
                      $files3 = DB::table('file')->where('id',$currentfile3)->get();
                      // return $reflink;
                      $current = Auth::guard('person')->user()->id;
                      $groupauth = DB::table('family_auths')->where('member_id',$current)->pluck('family_id')->toArray();
                      $groupauthcount = DB::table('family_auths')->where('member_id',$current)->count();

                      $portauth = DB::table('port_group_auths')->where('group_id',0)->pluck('port_id')->toArray();

                      $orgauth = DB::table('organize_auths')->where('member_id',$current)->pluck('organize_id')->toArray();
                      $orgauthcount = DB::table('organize_auths')->where('member_id',$current)->count();
                      $portorgauth = DB::table('port_org_auths')->where('org_id',0)->pluck('port_id')->toArray();


                      $memauthcount = DB::table('port_auths')->where('member_id',$current)->count();
                      $portauthmem = DB::table('port_auths')->where('member_id',0)->pluck('port_id')->toArray();
                      if($memauthcount > 0){
                        $portauthmem = DB::table('port_auths')->where('member_id',$current)->pluck('port_id')->toArray();

                      }
                      if($orgauthcount > 0){
                        $portorgauth = DB::table('port_org_auths')->whereIn('org_id',$orgauth)->pluck('port_id')->toArray();

                      }
                      if($groupauthcount > 0){

                      $portauth = DB::table('port_group_auths')->whereIn('group_id',$groupauth)->pluck('port_id')->toArray();
                      //return$portauth;
                    }

                    if(in_array($id, $curmem) || in_array($id,$portauth) || in_array($id, $portorgauth) || in_array($id, $portauthmem)){
                         return view('system-mgmt/portfolio/showdetailper',					     ['files1'=>$files1,'files2'=>$files2,'files3'=>$files3,'filecat'=>$filecat,'portnumber'=>$portnumber,'filerefname'=>$filerefname,'r'=>$r,'reflink1'=>$reflink1,'reflink2'=>$reflink2,'reflink3'=>$reflink3,'ref'=>$ref ]);

                    }

           return view('error');
       }


       public function showfile($id){
         //sidebar
         $current = Auth::guard('person')->user()->id;

         date_default_timezone_set('Asia/Bangkok');
         date('D-m-y H:i:s');
         $r = $_SERVER['REQUEST_URI'];
         $r = explode('/', $r);
         $r = $r[3];
        // return $r;
         $loadfile = DB::table('file')->where('id',$r)->value('physical_path');

         $asset = url()->previous();
        $asset = explode('/', $asset);
        $asset = $asset[5];
        if($asset == 'asset'){

            $refno = url()->previous();
           $refno = explode('/', $refno);
           $refno = $refno[8];

        }
        else{
          $refno = url()->previous();
         $refno = explode('/', $refno);
         $refno = $refno[6];
        }
      //return $refno;


        $r = $_SERVER['REQUEST_URI'];
      $r = explode('/', $r);
      $r = $r[3];
      $file = DB::table('file')->where('id',$r)->where('view_ref_no',$refno)->value('physical_path');
      $currenturl = $_SERVER['REQUEST_URI'];
      $currenturl = explode('/', $currenturl);
      $currenturl = $currenturl[3];

      $curdatetime = date('d-m-y H:i:s');
      //return $curdatetime;
      $lastview = ['last_time_view' =>$curdatetime ];
      $fileup = DB::table('file')->where('id',$currenturl)->update($lastview);
      //$fileup->last_time_view = $curdatetime;

         return Response::file(storage_path('app/'.$file));

         ///return view('system-mgmt/portfolio/showfile',['filepdf'=>$filepdf,'file'=>$file ]);
       }


       public function ownasset()
       {

         $current = Auth::guard('person')->user()->id;

      $r = $_SERVER['REQUEST_URI'];
      $r = explode('/', $r);
      $r = $r[4];


      $current = Auth::guard('person')->user()->id;
      $curmem = DB::table('portfolio')

             ->where('member_id','=',$current)

                    ->pluck('id');
                    $curmem = $curmem->toArray();
    //  $portfolio = portfolio::find($id);
      $number = [123, 713, 3];
      // Redirect to city list if updating city wasn't existed
      //if ($id == $number )

                  $porttypes = DB::table('asset')
         ->where('asset.port_id',$r)
         ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
         ->leftJoin('persons', 'asset.issued_by', '=', 'persons.id')
       // ->leftJoin('pid_groups', 'asset.pid_group_id', '=', 'pid_groups.id')
          ->select('asset.*', 'persons.name as issuer', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla')
          ->paginate(30);
          $current = Auth::guard('person')->user()->id;
          $groupauth = DB::table('family_auths')->where('member_id',$current)->pluck('family_id')->toArray();
          $groupauthcount = DB::table('family_auths')->where('member_id',$current)->count();

          $portauth = DB::table('port_group_auths')->where('group_id',0)->pluck('port_id')->toArray();

          $orgauth = DB::table('organize_auths')->where('member_id',$current)->pluck('organize_id')->toArray();
          $orgauthcount = DB::table('organize_auths')->where('member_id',$current)->count();
          $portorgauth = DB::table('port_org_auths')->where('org_id',0)->pluck('port_id')->toArray();


          $memauthcount = DB::table('port_auths')->where('member_id',$current)->count();
          $portauthmem = DB::table('port_auths')->where('member_id',0)->pluck('port_id')->toArray();
          if($memauthcount > 0){
            $portauthmem = DB::table('port_auths')->where('member_id',$current)->pluck('port_id')->toArray();

          }
          if($orgauthcount > 0){
            $portorgauth = DB::table('port_org_auths')->whereIn('org_id',$orgauth)->pluck('port_id')->toArray();

          }
          if($groupauthcount > 0){

          $portauth = DB::table('port_group_auths')->whereIn('group_id',$groupauth)->pluck('port_id')->toArray();
          //return$portauth;
        }

        if(in_array($r, $curmem) || in_array($r,$portauth) || in_array($r, $portorgauth) || in_array($r, $portauthmem)){
         return view('system-mgmt/asset/ownassetper', ['r'=>$r,'porttypes' => $porttypes ]);
       }

       return view('errortype2');
     }



       public function detail($id)
       {
         $current = Auth::guard('person')->user()->id;


         $current = Auth::guard('person')->user()->id;
           $findfileid = DB::table('asset_attachment')->where('asset_id',$id)->pluck('file_id');
           $fileasset = DB::table('file')->whereIn('id',$findfileid)->where('status','=','Active')->get();
           //return $findfileid;
           $portnumber = $_SERVER['REQUEST_URI'];
           $portnumber = explode('/', $portnumber);
           $portnumber = $portnumber[6];

      //return $portnumber;
        $r = $_SERVER['REQUEST_URI'];
        $r = explode('/', $r);
        $r = $r[4];
        $port = $_SERVER['REQUEST_URI'];
        $port = explode('/', $port);
        $port = $port[6];
      //  return $port;
        $assetnumber = Asset::where('id',$id)
       ->value('id');
       $name1 = 'Asset_Attachment_'.$r;
       $filerefname =$name1.'_'.$assetnumber ;
       $filecat ='CA8CA';
       $portid = DB::table('asset')
       ->where('asset.id',$id)
       ->value('port_id');

       $findblock = DB::table('portfolio')->where('id',$portid)->value('block_id');
       $conblock = DB::table('block')->where('id',$findblock)->get();

       $current = Auth::guard('person')->user()->id;
       $curmem = DB::table('portfolio')

              ->where('member_id','=',$current)

                     ->pluck('id');
                     $curmem = $curmem->toArray();
     //  $portfolio = portfolio::find($id);
       $number = [123, 713, 3];
       // Redirect to city list if updating city wasn't existed
       //if ($id == $number )
       $current = Auth::guard('person')->user()->id;
       $groupauth = DB::table('family_auths')->where('member_id',$current)->pluck('family_id')->toArray();
       $groupauthcount = DB::table('family_auths')->where('member_id',$current)->count();

       $portauth = DB::table('port_group_auths')->where('group_id',0)->pluck('port_id')->toArray();

       $orgauth = DB::table('organize_auths')->where('member_id',$current)->pluck('organize_id')->toArray();
       $orgauthcount = DB::table('organize_auths')->where('member_id',$current)->count();
       $portorgauth = DB::table('port_org_auths')->where('org_id',0)->pluck('port_id')->toArray();


       $memauthcount = DB::table('port_auths')->where('member_id',$current)->count();
       $portauthmem = DB::table('port_auths')->where('member_id',0)->pluck('port_id')->toArray();
       if($memauthcount > 0){
         $portauthmem = DB::table('port_auths')->where('member_id',$current)->pluck('port_id')->toArray();

       }
       if($orgauthcount > 0){
         $portorgauth = DB::table('port_org_auths')->whereIn('org_id',$orgauth)->pluck('port_id')->toArray();

       }
       if($groupauthcount > 0){

       $portauth = DB::table('port_group_auths')->whereIn('group_id',$groupauth)->pluck('port_id')->toArray();
       //return$portauth;
     }

     if(in_array($port, $curmem) || in_array($port,$portauth) || in_array($port, $portorgauth) || in_array($port, $portauthmem)){
       $porttypes = DB::table('asset')
       ->where('asset.id',$id)
       ->where('asset.port_id',$port)
       ->leftJoin('branch', 'asset.branch_id', '=', 'branch.id')
       ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
       ->leftJoin('member_groups', 'asset_type.issuer_guild', '=', 'member_groups.id')
       ->leftJoin('match_member_groups', 'member_groups.id', '=', 'match_member_groups.member_group_id')
       ->leftJoin('persons', 'asset.issued_by', '=', 'persons.id')
       ->leftJoin('portfolio','asset.port_id','=','portfolio.id')
	   ->leftJoin('asset as refasset','asset.ref_to_asset','=','refasset.id')
      ->select('asset.*', 'refasset.name as ref_asset', 'portfolio.id as port_id', 'portfolio.type as port_name', 'asset_type.nla_sub_type as asset_subtype_name', 'asset_type.la_nla_type as asset_type_name', 'asset_type.id as asset_type_id','asset_type.la_nla as la_nla'
      ,'asset_type.ref_info_head1 as ref_head1','asset_type.ref_info_head2 as ref_head2','asset_type.ref_info_head3 as ref_head3','asset_type.ref_info_head4 as ref_head4','asset_type.ref_info_head5 as ref_head5','asset_type.ref_info_head6 as ref_head6','asset_type.ref_info_head7 as ref_head7','asset_type.ref_info_head8 as ref_head8'
      ,'asset_type.ref_info_head9 as ref_head9','asset_type.ref_info_head10 as ref_head10','asset_type.ref_info_head11 as ref_head11','asset_type.ref_info_head12 as ref_head12','asset_type.ref_info_head13 as ref_head13','asset_type.ref_info_head14 as ref_head14','asset_type.ref_info_head15 as ref_head15','asset_type.ref_info_head16 as ref_head16'
      ,'asset_type.ref_info_head17 as ref_head17','asset_type.ref_name_head as name_head','asset_type.ref_info_head18 as ref_head18','asset_type.ref_num_head1 as num_head1','asset_type.ref_num_head2 as num_head2','asset_type.ref_num_head3 as num_head3','member_groups.name as guild_name','persons.name as member_name'
      ,'persons.emergency_name as emergency_name','persons.emergency_phone as emergency_phone','persons.emergency_email as emergency_email','branch.name as branch_name'
      ,'branch.tel as branch_tel','branch.fax as branch_fax','branch.con_name as branch_con_name','branch.con_tel as branch_con_tel','branch.con_email as branch_con_email','branch.con_lastname as branch_con_lastname')
        ->paginate(30);
       return view('system-mgmt/asset/showper',['conblock'=>$conblock,'portid'=>$portid,'fileasset'=>$fileasset,'filerefname'=>$filerefname,'filecat'=>$filecat,'portnumber'=>$portnumber,'porttypes'=>$porttypes]);
       }
       return view('errortype2');
       }
       public function porttransaction($id)
       {

         $current = Auth::guard('person')->user()->id;
         $groupauth = DB::table('family_auths')->where('member_id',$current)->pluck('family_id')->toArray();
         $groupauthcount = DB::table('family_auths')->where('member_id',$current)->count();

         $portauth = DB::table('port_group_auths')->where('group_id',0)->pluck('port_id')->toArray();

         $orgauth = DB::table('organize_auths')->where('member_id',$current)->pluck('organize_id')->toArray();
         $orgauthcount = DB::table('organize_auths')->where('member_id',$current)->count();
         $portorgauth = DB::table('port_org_auths')->where('org_id',0)->pluck('port_id')->toArray();


         $memauthcount = DB::table('port_auths')->where('member_id',$current)->count();
         $portauthmem = DB::table('port_auths')->where('member_id',0)->pluck('port_id')->toArray();
         if($memauthcount > 0){
           $portauthmem = DB::table('port_auths')->where('member_id',$current)->pluck('port_id')->toArray();

         }
         if($orgauthcount > 0){
           $portorgauth = DB::table('port_org_auths')->whereIn('org_id',$orgauth)->pluck('port_id')->toArray();

         }
         if($groupauthcount > 0){

         $portauth = DB::table('port_group_auths')->whereIn('group_id',$groupauth)->pluck('port_id')->toArray();
         //return$portauth;
       }
       $curmem = DB::table('portfolio')

              ->where('member_id','=',$current)

                     ->pluck('id');
                     $curmem = $curmem->toArray();


         $current = Auth::guard('person')->user()->id;

       $port = $_SERVER['REQUEST_URI'];
       $port = explode('/', $port);
       $port = $port[3];

     $reaminingvolumn = 0;
     $r = 0;
     if(in_array($port, $curmem) || in_array($port,$portauth) || in_array($port, $portorgauth) || in_array($port, $portauthmem)){

         $porttypes = DB::table('asset_transaction')
         ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
         ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
         ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
         ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
       //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
         ->where('asset_transaction.port_id',$port)
         ->orderBy('date')
        ->select('asset_transaction.*', 'asset_type.unit as asset_unit', 'asset_cat.name as asset_cat_name', 'asset_type.la_nla_type as la_nla_type', 'asset_type.la_nla as la_nla', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
          ->paginate(30);
         return view('system-mgmt/asset-transactionuser/porttransactionper', ['reaminingvolumn'=>$reaminingvolumn,'r'=>$r,'porttypes' => $porttypes ]);
       }
       return view('error');
}
             public function assettransaction()
       {
         $current = Auth::guard('person')->user()->id;


       $r = $_SERVER['REQUEST_URI'];
       $r = explode('/', $r);
       $r = $r[4];

       $port = $_SERVER['REQUEST_URI'];
       $port = explode('/', $port);
       $port = $port[5];
       //return $port;
       $portinasset = DB::table('asset')->where('id',$r)->value('port_id');
       //return $portinasset;
       $ls =  DB::table('asset_transaction')
       ->where('asset_transaction.port_id',$port)
       ->where('asset_transaction.asset_id',$r)
       ->value('l_s');
       $oc =  DB::table('asset_transaction')
       ->where('asset_transaction.port_id',$port)
       ->where('asset_transaction.asset_id',$r)
       ->value('o_c');
       $reaminingvolumn = 0;
     //  return $reaminingvolumn;
     $current = Auth::guard('person')->user()->id;
     $curmem = DB::table('portfolio')

            ->where('member_id','=',$current)

                   ->pluck('id');
                   $curmem = $curmem->toArray();
   //  $portfolio = portfolio::find($id);
     $number = [123, 713, 3];
     // Redirect to city list if updating city wasn't existed
     //if ($id == $number )
     $current = Auth::guard('person')->user()->id;
     $groupauth = DB::table('family_auths')->where('member_id',$current)->pluck('family_id')->toArray();
     $groupauthcount = DB::table('family_auths')->where('member_id',$current)->count();

     $portauth = DB::table('port_group_auths')->where('group_id',0)->pluck('port_id')->toArray();

     $orgauth = DB::table('organize_auths')->where('member_id',$current)->pluck('organize_id')->toArray();
     $orgauthcount = DB::table('organize_auths')->where('member_id',$current)->count();
     $portorgauth = DB::table('port_org_auths')->where('org_id',0)->pluck('port_id')->toArray();


     $memauthcount = DB::table('port_auths')->where('member_id',$current)->count();
     $portauthmem = DB::table('port_auths')->where('member_id',0)->pluck('port_id')->toArray();
     if($memauthcount > 0){
       $portauthmem = DB::table('port_auths')->where('member_id',$current)->pluck('port_id')->toArray();

     }
     if($orgauthcount > 0){
       $portorgauth = DB::table('port_org_auths')->whereIn('org_id',$orgauth)->pluck('port_id')->toArray();

     }
     if($groupauthcount > 0){

     $portauth = DB::table('port_group_auths')->whereIn('group_id',$groupauth)->pluck('port_id')->toArray();
     //return$portauth;
   }
   //return $portauth;
   if(in_array($port, $curmem) || in_array($port,$portauth) || in_array($port, $portorgauth) || in_array($port, $portauthmem)){
         $porttypes = DB::table('asset_transaction')
         ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
         ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
         ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
         ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
       //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
         ->where('asset_transaction.port_id',$port)
         ->where('asset_transaction.asset_id',$r)
        ->select('asset_transaction.*', 'asset_type.unit as asset_unit', 'asset_cat.name as asset_cat_name', 'asset_type.la_nla_type as la_nla_type', 'asset_type.la_nla as la_nla', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
          ->paginate(30);
         return view('system-mgmt/asset-transactionuser/assettransactionper', ['reaminingvolumn'=>$reaminingvolumn,'r'=>$r,'porttypes' => $porttypes ]);
       }
       return view('errortype2');
     }

       public function detailtransaction($id)
       {
         $current = Auth::guard('person')->user()->id;

            $porttran = DB::table('asset_transaction')->where('id',$id)->value('port_id');
          //  return $porttran;
            $current = Auth::guard('person')->user()->id;
            $curmem = DB::table('portfolio')

                   ->where('member_id','=',$current)

                          ->pluck('id');
                          $curmem = $curmem->toArray();
          //  $portfolio = portfolio::find($id);
            $number = [123, 713, 3];
            // Redirect to city list if updating city wasn't existed
            //if ($id == $number )
            $current = Auth::guard('person')->user()->id;
            $groupauth = DB::table('family_auths')->where('member_id',$current)->pluck('family_id')->toArray();
            $groupauthcount = DB::table('family_auths')->where('member_id',$current)->count();

            $portauth = DB::table('port_group_auths')->where('group_id',0)->pluck('port_id')->toArray();

            $orgauth = DB::table('organize_auths')->where('member_id',$current)->pluck('organize_id')->toArray();
            $orgauthcount = DB::table('organize_auths')->where('member_id',$current)->count();
            $portorgauth = DB::table('port_org_auths')->where('org_id',0)->pluck('port_id')->toArray();


            $memauthcount = DB::table('port_auths')->where('member_id',$current)->count();
            $portauthmem = DB::table('port_auths')->where('member_id',0)->pluck('port_id')->toArray();
            if($memauthcount > 0){
              $portauthmem = DB::table('port_auths')->where('member_id',$current)->pluck('port_id')->toArray();

            }
            if($orgauthcount > 0){
              $portorgauth = DB::table('port_org_auths')->whereIn('org_id',$orgauth)->pluck('port_id')->toArray();

            }
            if($groupauthcount > 0){

            $portauth = DB::table('port_group_auths')->whereIn('group_id',$groupauth)->pluck('port_id')->toArray();
            //return$portauth;
          }
          $curmem = DB::table('portfolio')

                 ->where('member_id','=',$current)

                        ->pluck('id');
                        $curmem = $curmem->toArray();
          //return $portauth;
          if(in_array($porttran, $curmem) || in_array($porttran,$portauth) || in_array($porttran, $portorgauth) || in_array($porttran, $portauthmem)){
              $transaction = DB::table('asset_transaction')
              ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
              ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
              ->leftJoin('asset_status', 'asset_transaction.status', '=', 'asset_status.id')

            //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
              ->where('asset_transaction.id',$id)
             ->select('asset_transaction.*', 'asset_status.name as asset_status_name', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
               ->get();
           return view('system-mgmt/asset-transactionuser/showper',['transaction'=>$transaction]);
       }
       return view('errortype2');
     }

       public function porttransearch(Request $request) {

         $current = Auth::guard('person')->user()->id;


           $constraints = [
              // 'portfolio.type' => $request['port_name'],
               //'asset.name' => $request['asset_name'],
               'fromdate' => $request['fromdate'],
               'todate' => $request['todate'],
               //'la_nla' => $request['la_nla']

               ];
               date_default_timezone_set('Asia/Bangkok');
                 date('d-m-y H:i:s');
                 $port = $_SERVER['REQUEST_URI'];
                 $port = explode('/', $port);
                 $port = $port[3];

               $reaminingvolumn = 0;
               $r = 0;



          $porttypes = $this->getHiredport($request,$constraints);
       //   return $porttypes;
          return view('system-mgmt/asset-transactionuser/porttransactionpersearch', ['reaminingvolumn'=>$reaminingvolumn,'r'=>$r,'porttypes' => $porttypes ]);
       }


       private function getHiredport($constraints) {

         $port = url()->previous();
         $port = explode('/', $port);
         $port = $port[5];

       $reaminingvolumn = 0;
       $r = 0;




      // $portfolio = portfolio::find($id);
       $number = [123, 713, 3];
       // Redirect to city list if updating city wasn't existed
       //if ($id == $number )

           $porttypes = DB::table('asset_transaction')
           ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
           ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
           ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
           ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
         //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')

           ->where('asset_transaction.port_id',$port)
           ->where('asset_transaction.date', '>=', $constraints['fromdate'])
           ->where('asset_transaction.date', '<=', $constraints['todate'])
           ->orderBy('date')
          ->select('asset_transaction.*', 'asset_type.unit as asset_unit', 'asset_cat.name as asset_cat_name', 'asset_type.la_nla_type as la_nla_type', 'asset_type.la_nla as la_nla', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')
              ->paginate(1000);

           return $porttypes;
       }


       public function assetsearch(Request $request) {

         $current = Auth::guard('person')->user()->id;



           $constraints = [
              // 'portfolio.type' => $request['port_name'],
               //'asset.name' => $request['asset_name'],
               'fromdate' => $request['fromdate'],
               'todate' => $request['todate'],
               //'la_nla' => $request['la_nla']

               ];
               $r = url()->previous();
               $r = explode('/', $r);
               $r = $r[6];

               $port =url()->previous();
               $port = explode('/', $port);
               $port = $port[7];
               //return $port;
               $portinasset = DB::table('asset')->where('id',$r)->value('port_id');
               //return $portinasset;
               $ls =  DB::table('asset_transaction')
               ->where('asset_transaction.port_id',$port)
               ->where('asset_transaction.asset_id',$r)
               ->value('l_s');
               $oc =  DB::table('asset_transaction')
               ->where('asset_transaction.port_id',$port)
               ->where('asset_transaction.asset_id',$r)
               ->value('o_c');
               $reaminingvolumn = $ls - $oc;
             //  return $reaminingvolumn;
             $current = Auth::guard('person')->user()->id;
             $curmem = DB::table('portfolio')

                    ->where('member_id','=',$current)

                           ->pluck('id');
                           $curmem = $curmem->toArray();
           //  $portfolio = portfolio::find($id);
             $number = [123, 713, 3];
             // Redirect to city list if updating city wasn't existed
             //if ($id == $number )
               if(in_array($port, $curmem)){
          $porttypes = $this->getHiredEmployeesinbox($request,$constraints);
           return view('system-mgmt/asset-transactionuser/assettransactionpersearch', ['reaminingvolumn'=>$reaminingvolumn,'r'=>$r,'porttypes' => $porttypes ]);
       }
       return view('errortype2');
  }

  private function getHiredEmployeesinbox($constraints) {

    $r = url()->previous();
    $r = explode('/', $r);
    $r = $r[6];

    $port =url()->previous();
    $port = explode('/', $port);
    $port = $port[7];
    //return $port;
    $portinasset = DB::table('asset')->where('id',$r)->value('port_id');
    //return $portinasset;
    $ls =  DB::table('asset_transaction')
    ->where('asset_transaction.port_id',$port)
    ->where('asset_transaction.asset_id',$r)
    ->value('l_s');
    $oc =  DB::table('asset_transaction')
    ->where('asset_transaction.port_id',$port)
    ->where('asset_transaction.asset_id',$r)
    ->value('o_c');
    $reaminingvolumn = $ls - $oc;
  //  return $reaminingvolumn;
  $current = Auth::guard('person')->user()->id;
  $curmem = DB::table('portfolio')

         ->where('member_id','=',$current)

                ->pluck('id');
                $curmem = $curmem->toArray();
//  $portfolio = portfolio::find($id);
  $number = [123, 713, 3];
  // Redirect to city list if updating city wasn't existed
  //if ($id == $number )
      $porttypes = DB::table('asset_transaction')
      ->leftJoin('asset', 'asset_transaction.asset_id', '=', 'asset.id')
      ->leftJoin('asset_type', 'asset.la_nla_type', '=', 'asset_type.id')
      ->leftJoin('asset_cat', 'asset_type.asset_cat', '=', 'asset_cat.id')
      ->leftJoin('portfolio', 'asset_transaction.port_id', '=', 'portfolio.id')
    //  ->leftJoin('underlying', 'asset_transaction.underlying_id', '=', 'portfolio.id')
      ->where('asset_transaction.port_id',$port)
      ->where('asset_transaction.asset_id',$r)
      ->where('asset_transaction.date', '>=', $constraints['fromdate'])
      ->where('asset_transaction.date', '<=', $constraints['todate'])
     ->select('asset_transaction.*', 'asset_type.unit as asset_unit', 'asset_cat.name as asset_cat_name', 'asset_type.la_nla_type as la_nla_type', 'asset_type.la_nla as la_nla', 'asset.name as asset_name', 'asset.id as asset_id','portfolio.type as port_name','portfolio.id as port_id')

         ->paginate(1000);

      return $porttypes;
  }

  public function mypid($id){
    $current = Auth::guard('person')->user()->id;



           $mypidnum = DB::table('match_id')->where('member_id',$current)->value('id');

      // Redirect to user list if updating user wasn't existed
      if($id == $mypidnum){
        $user = match_id::find($id);
      $data = array(
          'user' => $user
      );

      return view('person/editpid', ['user' => $user ]);
    }

            return view('error');
      }

  public function pid()
  {
    $current = Auth::guard('person')->user()->id;


      $users = DB::table('persons')

      ->where('persons.id',$current)

      ->select('persons.*')

      ->paginate(30);
      //return $users;
      $mypid = DB::table('match_id')->where('member_id',$current)->get();
      $mypidnum = DB::table('match_id')->where('member_id',$current)->value('id');
      return view('person/pid', ['mypidnum' => $mypidnum,'mypid' => $mypid,'users' => $users ]);
  }

  public function uppid(Request $request, $id)
  {
      //$user = match_id::findOrFail($id);

      $input = [
      //  $user->password = Hash::make($request->password);

          'public_name' => $request['public_name'],
          'public_email' => $request['public_email'],
          'public_mobile' => $request['public_mobile'],

      ];


      match_id::where('id', $id)
          ->update($input);
        $request->session()->flash('alert-success', 'เปลี่ยนข้อมูล Public ID เรียบร้อยแล้ว!! ');
      return redirect()->intended('/Profile/publicid');
  }

  public function uplineuserid()
  {
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('?',$url);
      $url = $url[1];

      $current = Auth::guard('person')->user()->id;
       $input = [
      //  $user->password = Hash::make($request->password);
          'line_user_id' =>$url,
      ];

      Person::where('id', $current)
          ->update($input);
      //  $request->session()->flash('alert-success', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว!! ');
      $lineid = Auth::guard('person')->user()->line_user_id;
      app('\App\Http\Controllers\LineBotController')->linebotupdateconfirmmember();
        $url2 = 'http://nav.cx/2sri9v4';
      return redirect($url2);
  }
  public function repasswordpage()
  {
    return view('person/repasswordpage');
  }

}
