<?php
namespace App\Http\Controllers\printout;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;
use Illuminate\Support\Facades\Auth;

use App\View;
use App\Block;
use Excel;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\Fpdf;
use setasign\Fpdi\PdfReader;
use setasign\Fpdi\PdfParser;


class MtsfirstpageController extends Controller
{
		    public function __construct()
    {
        $this->middleware('view')->only([  "index"]);
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







  public function index(Request $request) {

	  //sidebar
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
	  //sidebar
    $constraints = [
        'id_num' => $request['id_num']
    ];
    $request = Person::where('id_num');
      $employees = $this->getHiredEmployees($constraints);
      return view('indexmts', ['employees' => $employees, 'searchingVals' => $constraints ,'request' => $request,'tree'=>$tree]);
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
          'id_num' => $request['id_num']
      ];

      $employees = $this->getHiredEmployees($constraints);
      return view('indexmts', ['employees' => $employees, 'searchingVals' => $constraints,'tree'=>$tree]);
  }
  private function getHiredEmployees($constraints) {
      $employees = Person::where('id_num', '=', $constraints)

                      ->get();
      return $employees;
  }
public function exportPDF(Request $request) {
  $correct =  __DIR__.'/corect.png';
  $filename =  __DIR__.'/page-1.pdf';
  $filename2 =  __DIR__.'/page-2.pdf';
  $filename3 =  __DIR__.'/page-3.pdf';
  $filename4 =  __DIR__.'/page-4.pdf';
  $filename5 =  __DIR__.'/page-5.pdf';
  $filename6 =  __DIR__.'/page-6.pdf';
  $filename7 =  __DIR__.'/page-7.pdf';
  $filename8 =  __DIR__.'/page-8.pdf';
  $filename9 =  __DIR__.'/page-9.pdf';
  $filename10 =  __DIR__.'/page-10.pdf';
  $filename11=  __DIR__.'/page-11.pdf';
  $filename12 =  __DIR__.'/page-12.pdf';
  $filename13 =  __DIR__.'/page-13.pdf';
  $filename14=  __DIR__.'/page-14.pdf';
  $filename15 =  __DIR__.'/page-15.pdf';
  $filename16 =  __DIR__.'/page-16.pdf';
  $filename17 =  __DIR__.'/page-17.pdf';
  $filename18 =  __DIR__.'/page-18.pdf';
  $filename19 =  __DIR__.'/page-19.pdf';
  $filename20 =  __DIR__.'/page-20.pdf';
  $filename21 =  __DIR__.'/page-21.pdf';
  $filename22 =  __DIR__.'/page-22.pdf';
  $filename23 =  __DIR__.'/page-23.pdf';
  $filename24 =  __DIR__.'/page-24.pdf';
  $filename25 =  __DIR__.'/page-25.pdf';
  $filename26 =  __DIR__.'/page-26.pdf';
  $filename27 =  __DIR__.'/page-27.pdf';
  $filename28 =  __DIR__.'/page-28.pdf';
  $filename29 =  __DIR__.'/page-29.pdf';
  $filename30 =  __DIR__.'/page-30.pdf';
  $filename31 =  __DIR__.'/page-31.pdf';
  $filename32 =  __DIR__.'/page-32.pdf';
  $filename33 =  __DIR__.'/page-33.pdf';
  $filename34 =  __DIR__.'/page-34.pdf';
  $filename35 =  __DIR__.'/page-35.pdf';
  $filename36 =  __DIR__.'/page-36.pdf';
  $filename37 =  __DIR__.'/page-37.pdf';
  $filename38 =  __DIR__.'/page-38.pdf';
  $filename39 =  __DIR__.'/page-39.pdf';
  $filename40 =  __DIR__.'/page-40.pdf';
  $filename41 =  __DIR__.'/page-41.pdf';
  $filename42 =  __DIR__.'/page-42.pdf';
  $filename43 =  __DIR__.'/page-43.pdf';

$name = $request->input('name');
$pdf = new fpdi('P' , 'mm' , 'A4');
$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
$pdf->AddFont('THSarabunNewb', '', 'THSarabunNew Bold.php');
$pdf->SetFont('THSarabunNew','',12); //Font และ ขนาดอักษร หากต้องการเป็นตัวหนา จะเป็น$pdf->SetFont('THSarabunNewb','',15);
$pdf->SetTextColor(0, 0 ,0);



//variable
$ChildDivisions =DB::table('persons')->where('id_num',$request->id_num)->get();
foreach ( $ChildDivisions as $Division) {
  $agent = "";//ช่องทางการซื้อขาย
  $agent_2 = ""; //บุคคลแนะนำการเปิดบัญชี
  $tsystem = "";//tradingsystem
  $agentname = "";//ชื่อผู้แนะนำ
  $agentsurname = ""; //นามสกุลผู้แนะนำ
  $agentrelation = ""; //ความสัมพันธ์ผู้แนะนำ
  $agentphone = "";//เบอร์โทรผู้แนะนำ


  $gender = $Division->gender; //เพศ
  $gender2 = "";//**
  if($gender == "นาย(Mr.)")
{
 $gender2 = "นาย";
}

else if($gender == "นาง(Mrs.)")
{
 $gender2 = "นาง";
}
else if($gender == "นางสาว(Ms.)")
{
 $gender2 = "นางสาว";
}
  $passport = ""; //เลขหนังสือเดินทาง **
  $bname = $Division->gender; //คำนำหน้าชื่อ
  $firstname = $Division->name; //ชื่อหน้า
  $efirstname = $Division->Eng_name;  //ชื่ออังกฤษ
  $surname = $Division->lname;  //นามสกุล
  $esurname = $Division->Eng_lastname;  //นามสกุลอังกฤษ

  $idcode = $Division->id_num;  //เลขบัตรประจำตัวประชาชน
  $otheridcard = "";//ชื่อบัตรอื่นๆ

  $phone = $Division->mobile;  //เบอร์โทรศัทพ์มือถือ
  $tel = $Division->phone;  //โทรศัพท์บ้าน
  $nationality = $Division->nationality;  //สัญชาติ

  //---------------------------------------------วันเกิด
  $dateofbirth = $Division->dob;  //วันเกิด
  $day = substr($dateofbirth,8,2); //วันที่
  $month = substr($dateofbirth,5,2); //เดือน
  $year = substr($dateofbirth,0,4); //ปี
  //---------------------------------------------วันเกิด

  $email = $Division->email; //email
  $idcard = "idcard"; //บัตรประชาชน
  $id_line = ""; //lineid

  //-------------------------------------วันหมดอายุบัตร
  $expdate = $Division->citizen_expire_date;//วันหมดอายุบัตร
  $expday = substr($expdate,8,2);//วันที่
  $expmonth = substr($expdate,5,2);//เดือน
  $expyear = substr($expdate,0,4);//ปี
  //--------------------------------------วันหมดอายุบัตร

  $education = "";//ระดับการศึกษา
  $educationname = "";//อื่นๆ

  //-------------------------------อาชีพ
  $jobs = $Division->job;
  $jobsdetail = $Division->position ;
  $type = $Division->type_business; //ประเภทธุรกิจ
  //----------------------อาชีพ

  //------------------------------ข้อมูลสถานที่ทำงาน

  $nameoffice = $Division->company;  //ชื่อสถานที่ทำงาน
  $position = $Division->position;  //ตำแหน่งงาน
  $ageofwork = $Division->work_experience;  //อายุงาน
  $wnoaddress = $Division->com_add_no;  //บ้านเลขที่ที่ทำงาน
  $wvillageno = "";  //หมู่ที่
  $wvillagename = ""; //อาคาร/หมู่บ้าน
  $walley = $Division->com_add_alley ; //ซอย
  $wroad = $Division->com_add_road; //ถนน
  $wdistrict = $Division->com_add_subdistrict; //แขวง/ตำบล
  $wdistrict_2 = $Division->com_add_district; //เขต/อำเภอ
  $wprovince = $Division->com_add_city; //จังหวัด
  $wpostnum = $Division->com_add_postcode; //รหัสไปรษณีย์

  //-------------------------------------

  //-------------------------------ผู้ติดต่อได้กรณีฉุกเฉิน
  $name_1 =""; //ชิ่อ
  $last_1 = ""; //นามสกุล
  $relation = "";//ความสัมพันธ์
  $phone_1 = "";//เบอร์โทรศัทพ์มือถือ

  //-------------------------------------

  $home_number = $Division->add1; //เลขที่บ้าน
  $moo_number = ""; //หมู่ที่
  $building_name = ""; //หมู่บ้าน/อาคาร
  $building_level = ""; //ชั้น
  $home_soi = $Division->add1_alley; //ซอย
  $home_road = $Division->add1_road; //ถนน
  $home_tumbon = $Division->add1_subdistrict; //แขวงตำบล
  $home_district = $Division->add1_district; //เขตอำเภอ
  $home_provience = $Division->add1_city; //จังหวัด
  $home_zipcode = $Division->add1_postcode; //รหัสไปรษณีย์

  $home_number2 = $Division->add2; //เลขที่บ้าน
  $moo_number2 = ""; //หมู่ที่
  $building_name2 = ""; //หมู่บ้าน/อาคาร
  $building_level2 = ""; //ชั้น
  $home_soi2 = $Division->add2_alley; //ซอย
  $home_road2 = $Division->add2_road; //ถนน
  $home_tumbon2 = $Division->add2_subdistrict; //แขวงตำบล
  $home_district2 = $Division->add2_district; //เขตอำเภอ
  $home_provience2 =$Division->add2_city; //จังหวัด
  $home_zipcode2 = $Division->add2_postcode; //รหัสไปรษณีย์
  $coutry = $Division->add2_country;//ประเทศที่สามารถติดต่อได้

  $idcard2 = $Division->id_num;//เช็คว่าตรงกับบัตรไหม
  $idcard3 = "";//เช็คว่าที่อยู่ตามทะเบียนบ้านไหม
  $income =$Division->income;//เงินเดือน
  $incomedetail = $Division->inctype;//แหล่งที่มาของรายได้

  $status = $Division->couple;//สถานะ
  $name_somros = $Division->couple_name; //ชื่อคู่สมรส
  $surname_somros = $Division->couple_lname; //นามสกุลคู่สมรส
  $work_somros = $Division->couple_job; //งานคู่สมรส
  $position_somros = $Division->couple_position; //ตำแหน่งงานคู่สมรส
  $phone_somros = $Division->couple_mobile; //เบอร์โทรคู่สมรส

  //---------------------------------ข้อมูลธนาคาร
  $bank = $Division->bank; //ธนาคารจ่ายเงินค่าประกัน
  $bank2 = $Division->bank;; //ธนารคารรับเงินประกัน
  $bankacc = $Division->bankaccount;; //เลชบัญชีจ่ายเงิน
  $bankacc2 = $Division->bankaccount; //เลขบัญชีรับเงิน
  $bankmajor = $Division->branch; //สาขาจ่ายเงิน
  $bankmajor2 = $Division->branch;; //สาขารับเงิน
  $banktype = ""; //ประเภทบัญชีจ่ายเงิน
  $banktype2 = ""; //ประเภทบัญชีรับเงิน

  $customer ="";
  $home_number3 ="";
  $moo_number3 ="";
  $building_name3 ="";
  $home_soi3 ="";
  $home_road3 ="";
  $home_tumbon3 ="";
  $home_district3 ="";
  $home_provience3 ="";
  $home_zipcode3 ="";

  $egender =$Division->gender;
  $efirstname =$Division->Eng_name;
  $esurname =$Division->Eng_lastname;
  //---------------------------------ข้อมูลธนาคาร

  //page 1
  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($agent == "ผ่านผู้แนะนำการลงทุน")
  {
  	$pdf->Image($correct,16.5,97,-300);//เครื่องหมาย
  }
  else if($agent == "ผ่านอินเทอร์เน็ต")
  {
  	$pdf->Image($correct,56,97,-300);//เครื่องหมาย
  }

  if($tsystem == "ระบบ Streaming(-2)")
  {
  	$pdf->Image($correct,112,97,-300);//เครื่องหมาย
  }
  else if($tsystem == "ระบบ Speed Trade(-9)")
  {
  	$pdf->Image($correct,146,97,-300);//เครื่องหมาย
  }
  else if($tsystem == "ระบบ MT4(-3)")
  {
  	$pdf->Image($correct,181,97,-300);//เครื่องหมาย
  }

  if($agent_2 == "ติดต่อเอง")
  {
  	$pdf->Image($correct,16.5,108,-300);//เครื่องหมาย
  	$pdf->SetXY(66, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentname),0,0,'C'); //ชื่อผู้แนะนำ
  	$pdf->SetXY(85, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentsurname),0,0,'C'); //นามสกุลผู้แนะนำ
  	$pdf->SetXY(140, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentrelation),0,0,'C'); //ความสัมพันธ์ผู้แนะนำ
  	$pdf->SetXY(190, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentphone),0,0,'C'); //เบอร์โทรผู้แนะนำ



  }
  else if($agent_2 == "เจ้าหน้าที่บริษัท")
  {
  	$pdf->Image($correct,41,108,-300);//เครื่องหมาย
  	$pdf->SetXY(66, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentname),0,0,'C'); //ชื่อผู้แนะนำ
  	$pdf->SetXY(85, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentsurname),0,0,'C'); //นามสกุลผู้แนะนำ
  	$pdf->SetXY(140, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentrelation),0,0,'C'); //ความสัมพันธ์ผู้แนะนำ
  	$pdf->SetXY(190, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentphone),0,0,'C'); //เบอร์โทรผู้แนะนำ
  }
  else if($agent_2 == "ลูกค้าบริษัท")
  {
  	$pdf->Image($correct,74.5,108,-300);//เครื่องหมาย
  	$pdf->SetXY(66, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentname),0,0,'C'); //ชื่อผู้แนะนำ
  	$pdf->SetXY(85, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentsurname),0,0,'C'); //นามสกุลผู้แนะนำ
  	$pdf->SetXY(140, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentrelation),0,0,'C'); //ความสัมพันธ์ผู้แนะนำ
  	$pdf->SetXY(190, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentphone),0,0,'C'); //เบอร์โทรผู้แนะนำ
  }

  else if($agent_2 == "เว็บไซต์บริษัท")
  {
  	$pdf->Image($correct,106,108,-300);//เครื่องหมาย
  	$pdf->SetXY(66, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentname),0,0,'C'); //ชื่อผู้แนะนำ
  	$pdf->SetXY(85, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentsurname),0,0,'C'); //นามสกุลผู้แนะนำ
  	$pdf->SetXY(140, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentrelation),0,0,'C'); //ความสัมพันธ์ผู้แนะนำ
  	$pdf->SetXY(190, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentphone),0,0,'C'); //เบอร์โทรผู้แนะนำ
  }

  else if($agent_2 == "อื่นๆ")
  {
  	$pdf->Image($correct,141,108,-300);//เครื่องหมาย
  	$pdf->SetXY(66, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentname),0,0,'C'); //ชื่อผู้แนะนำ
  	$pdf->SetXY(85, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentsurname),0,0,'C'); //นามสกุลผู้แนะนำ
  	$pdf->SetXY(140, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentrelation),0,0,'C'); //ความสัมพันธ์ผู้แนะนำ
  	$pdf->SetXY(190, 112.5);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $agentphone),0,0,'C'); //เบอร์โทรผู้แนะนำ
  }

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->Image($correct,16.5,128,-300);//เครื่องหมาย

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->Image($correct,28,128,-300);//เครื่องหมาย
  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->Image($correct,41.5,128,-300);//เครืองหมาย
  }


  $pdf->SetXY(65, 132);
  $pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  $pdf->SetXY(65, 132);
  $pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  $pdf->SetXY(65, 138);
  $pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $efirstname),0,0,'C');//ชื่ออังกฤษ

  $pdf->SetXY(65, 138);
  $pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $esurname),0,0,'C');//นามสกุลอังกฤษ

  $pdf->SetXY(127, 144);
  $pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $nationality),0,0,'C');//สัญชาติ


  if($idcard == "idcard")
  {
  	$pdf->Image($correct,16.5,152,-300);
  	$pdf->SetXY(46, 156.5);
  	$pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'C');//เลขบัตรประจำตัวประชาชน

    $pdf->SetXY(130, 157);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $expday),0,0,'C');//วันที่

  	$pdf->SetXY(145, 157);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $expmonth),0,0,'C');//เดือน

  	$pdf->SetXY(160, 157);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $expyear),0,0,'C');//ปี

  }
  else if($idcard == "otheridcard")
  {
  	$pdf->Image($correct,90,152,-300);

  	$pdf->SetXY(115, 151);
  	$pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $otheridcard),0,0,'C');//ชื่อบัตรอื่นๆ

  	$pdf->SetXY(46, 156.5);
  	$pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'C');//เลขบัตรประจำตัวประชาชน

  	$pdf->SetXY(130, 157);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $expday),0,0,'C');//วันที่

  	$pdf->SetXY(145, 157);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $expmonth),0,0,'C');//เดือน

  	$pdf->SetXY(160, 157);
  	$pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $expyear),0,0,'C');//ปี
  }

  $pdf->SetXY(55, 170.5);
  $pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $tel),0,0,'C');//โทรศํพท์บ้าน

  $pdf->SetXY(55, 144);
  $pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $day),0,0,'C');//วันที่

  $pdf->SetXY(67, 144);
  $pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $month),0,0,'C');//เดือน

  $pdf->SetXY(80, 144);
  $pdf->Cell(-30,8,iconv( 'UTF-8','cp874//IGNORE' , $year),0,0,'C');//ปี

  $pdf->SetXY(45, 176);
  $pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $email),0,0,'C');//email

  $pdf->SetXY(45, 176);
  $pdf->Cell(130,8,iconv( 'UTF-8','cp874//IGNORE' , $id_line),0,0,'C');//lineid

  $pdf->SetXY(115, 170.5);
  $pdf->Cell(25,8,iconv( 'UTF-8','cp874//IGNORE' , $phone),0,0,'C');//โทรศํพท์มือถือ

  if($education == "ต่ำกว่าปริญญาตรี")//เช็คระดับการศึกษา
  {
  	$pdf->Image($correct,45,183,-300);//เครื่องหมาย

  }
  else if($education == "ปริญญาตรี")//เช็คระดับการศึกษา
  {
  	$pdf->Image($correct,94.5,183,-300);//เครื่องหมาย
  }
  else if($education == "สูงกว่าปริญญาตรี")//เช็คระดับการศึกษา
  {
  	$pdf->Image($correct,129,183,-300);//เครืองหมาย
  }
  else if($education == "อื่นๆ")//เช็คระดับการศึกษา
  {
  	$pdf->Image($correct,167,183,-300);//เครืองหมาย
  	$pdf->SetXY(178, 183);
  	$pdf->Cell(0,5,iconv( 'UTF-8','cp874//IGNORE' , $educationname),0,0,'C');//คำอธิบายอื่น
  }


  if($jobs == "เจ้าของกิจการ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,194.5,-300);//เครื่องหมาย
  	$pdf->SetXY(15, 194.5);
  	$pdf->Cell(0,5,iconv( 'UTF-8','cp874//IGNORE' , $jobsdetail),0,0,'C');//คำอธิบายอื่น

  }
  else if($jobs == "อาชีพอิสระ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,194.5,-300);//เครื่องหมาย
  	$pdf->SetXY(15, 194.5);
  	$pdf->Cell(0,5,iconv( 'UTF-8','cp874//IGNORE' , $jobsdetail),0,0,'C');//คำอธิบายอื่น
  }
  else if($jobs == "ค้าขาย")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,194.5,-300);//เครื่องหมาย
  	$pdf->SetXY(15, 194.5);
  	$pdf->Cell(0,5,iconv( 'UTF-8','cp874//IGNORE' , $jobsdetail),0,0,'C');//คำอธิบายอื่น
  }

  else if($jobs == "พนักงานบริษัท")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,200,-300);//เครืองหมาย

  }

  else if($jobs == "ลูกจ้าง")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,200,-300);//เครืองหมาย

  }

  else if($jobs == "พนักงานรัฐวืสาหกิจ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,64.75,200,-300);//เครืองหมาย

  }

  else if($jobs == "ข้าราชการ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,115.5,200,-300);//เครืองหมาย

  }

  else if($jobs == "แพทย์")//เช็คอาชีพ
  {
  	$pdf->Image($correct,154,200,-300);//เครืองหมาย

  }

  else if($jobs == "พยาบาล")//เช็คอาชีพ
  {
  	$pdf->Image($correct,154,200,-300);//เครืองหมาย

  }

  else if($jobs == "อาจารย์")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,206,-300);//เครื่องหมาย

  }

  else if($jobs == "นักวิชาการ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,206,-300);//เครื่องหมาย

  }

  else if($jobs == "นักวิจัย")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,206,-300);//เครื่องหมาย

  }

  else if($jobs == "ทหาร")//เช็คอาชีพ
  {
  	$pdf->Image($correct,65,206,-300);//เครื่องหมาย

  }

  else if($jobs == "ตำรวจ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,65,206,-300);//เครื่องหมาย

  }

  else if($jobs == "นักเรียน")//เช็คอาชีพ
  {
  	$pdf->Image($correct,115.5,206,-300);//เครื่องหมาย

  }

  else if($jobs == "นักศึกษา")//เช็คอาชีพ
  {
  	$pdf->Image($correct,115.5,206,-300);//เครื่องหมาย

  }

  else if($jobs == "อัยการ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,154,206,-300);//เครื่องหมาย

  }

  else if($jobs == "ผู้พิพากษา")//เช็คอาชีพ
  {
  	$pdf->Image($correct,154,206,-300);//เครื่องหมาย

  }

  else if($jobs == "อาชีพอื่นๆ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,16.5,212,-300);//เครื่องหมาย
  	$pdf->SetXY(20,212);
  	$pdf->Cell(80,5,iconv( 'UTF-8','cp874//IGNORE' , $jobsdetail),0,0,'C');//คำอธิบายอื่น
  	$pdf->Cell(100,5,iconv( 'UTF-8','cp874//IGNORE' , $type),0,0,'C');//คำอธิบายอื่น

  }

  $pdf->SetXY(20, 212);
  $pdf->Cell(110,16.5,iconv( 'UTF-8','cp874//IGNORE' , $nameoffice),0,0,'C'); //ชื่อสถานที่ทำงาน

  $pdf->SetXY(20, 212);
  $pdf->Cell(230,16.5,iconv( 'UTF-8','cp874//IGNORE' , $position),0,0,'C'); //ตำแหน่งงาน

  $pdf->SetXY(20, 212);
  $pdf->Cell(350,16.5,iconv( 'UTF-8','cp874//IGNORE' , $ageofwork),0,0,'C'); //อายุงาน

  $pdf->SetXY(20, 212);
  $pdf->Cell(51,27.5,iconv( 'UTF-8','cp874//IGNORE' , $wnoaddress),0,0,'C'); //เลขที่

  $pdf->SetXY(20, 212);
  $pdf->Cell(81,27.5,iconv( 'UTF-8','cp874//IGNORE' , $wvillageno),0,0,'C');//หมู่ที่

  $pdf->SetXY(20, 212);
  $pdf->Cell(140,27.5,iconv( 'UTF-8','cp874//IGNORE' , $wvillagename),0,0,'C'); //หมู่บ้าน

  $pdf->SetXY(20, 212);
  $pdf->Cell(228,27.5,iconv( 'UTF-8','cp874//IGNORE' , $walley),0,0,'C'); //ซอย

  $pdf->SetXY(20, 212);
  $pdf->Cell(316,27.5,iconv( 'UTF-8','cp874//IGNORE' , $wroad),0,0,'C'); //ถนน

  $pdf->SetXY(20, 212);
  $pdf->Cell(51,40,iconv( 'UTF-8','cp874//IGNORE' , $wdistrict),0,0,'C'); //แขวง/ตำบล

  $pdf->SetXY(20, 212);
  $pdf->Cell(140,40,iconv( 'UTF-8','cp874//IGNORE' , $wdistrict_2),0,0,'C'); //อำเภอ

  $pdf->SetXY(20, 212);
  $pdf->Cell(240,40,iconv( 'UTF-8','cp874//IGNORE' , $wprovince),0,0,'C'); //จังหวัด

  $pdf->SetXY(20, 212);
  $pdf->Cell(340,40,iconv( 'UTF-8','cp874//IGNORE' , $wpostnum),0,0,'C'); //รหัสไปรษณีย์

  $pdf->SetXY(20, 230.5);
  $pdf->Cell(50,30,iconv( 'UTF-8','cp874//IGNORE' , $name_1),0,0,'C'); //ชื่อบุคคลติดต่อฉุกเฉิน

  $pdf->SetXY(20, 230.5);
  $pdf->Cell(80,30,iconv( 'UTF-8','cp874//IGNORE' , $last_1),0,0,'C'); //นามสกุลบุคคลติดต่อฉุกเฉิน

  $pdf->SetXY(20, 230.5);
  $pdf->Cell(200,30,iconv( 'UTF-8','cp874//IGNORE' , $relation),0,0,'C'); //ความสัมพันธ์

  $pdf->SetXY(20, 230.5);
  $pdf->Cell(340,30,iconv( 'UTF-8','cp874//IGNORE' , $phone_1),0,0,'C'); //เบอร์โทรศัทพ์มือถือฉุกเฉิน








  //page 2
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename2);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);


  if($idcard2 == "")
  {
  	$pdf->Image($correct,81,64,-300);//เครืองหมาย
  }
  else if($idcard2 == "")
  {
  	$pdf->Image($correct,81,70,-300);//เครืองหมาย
  }
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(160,47.5,iconv( 'UTF-8','cp874//IGNORE' , $home_number),0,0,'C'); //เลขที่ี่อยู่ตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(220,47.5,iconv( 'UTF-8','cp874//IGNORE' , $moo_number),0,0,'C'); //หมู่ที่ตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(310,47.5,iconv( 'UTF-8','cp874//IGNORE' , $building_name),0,0,'C'); //ชื่ออาคารตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(158,58,iconv( 'UTF-8','cp874//IGNORE' , $home_soi),0,0,'C'); //ซอยตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(278,58,iconv( 'UTF-8','cp874//IGNORE' , $home_road),0,0,'C'); //ถนนตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(167,70,iconv( 'UTF-8','cp874//IGNORE' , $home_tumbon),0,0,'C'); //ตำบลตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(289,70,iconv( 'UTF-8','cp874//IGNORE' , $home_district),0,0,'C'); //อำเภอตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(167,82.5,iconv( 'UTF-8','cp874//IGNORE' , $home_provience),0,0,'C'); //จังหวัดตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(289,82.5,iconv( 'UTF-8','cp874//IGNORE' , $home_zipcode),0,0,'C'); //รหัสไปรษณีย์ตามทะเบียนบ้าน

  if($idcard3 == "ตามที่อยู่ทะเบียนบ้าน")
  {
  	$pdf->Image($correct,81,77,-300);//เครืองหมาย
  }
  else if($idcard3 == "ที่อยู่อื่น")
  {
  	$pdf->Image($correct,117,77,-300);//เครืองหมาย
  }

  	$pdf->SetXY(20, 20);
  	$pdf->Cell(160,133,iconv( 'UTF-8','cp874//IGNORE' , $home_number2),0,0,'C'); //เลขที่ที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(220,133,iconv( 'UTF-8','cp874//IGNORE' , $moo_number2),0,0,'C'); //หมู่ที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(315,133,iconv( 'UTF-8','cp874//IGNORE' , $building_name2),0,0,'C'); //อาคารที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(155,146,iconv( 'UTF-8','cp874//IGNORE' , $home_soi2),0,0,'C'); //ซอยที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(280,146,iconv( 'UTF-8','cp874//IGNORE' , $home_road2),0,0,'C'); //ถนนที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(169,158,iconv( 'UTF-8','cp874//IGNORE' , $home_tumbon2),0,0,'C'); //ตำบลที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(295,158,iconv( 'UTF-8','cp874//IGNORE' , $home_district2),0,0,'C'); //อำเถอที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(164,170,iconv( 'UTF-8','cp874//IGNORE' , $home_provience2),0,0,'C'); //จังหวัดที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(254,170,iconv( 'UTF-8','cp874//IGNORE' , $home_zipcode2),0,0,'C'); //รหัสไปรษณีย์ที่สามารถติดต่อได้
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(320,170,iconv( 'UTF-8','cp874//IGNORE' , $coutry),0,0,'C'); //ประเทศที่สามารถติดต่อได้

  if($income < 10000)
  {
  	$pdf->Image($correct,39.5,160.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }
  else if($income > 10000 && $income < 20001)
  {
  	$pdf->Image($correct,67.5,160.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }
  else if($income > 20000 && $income < 30001)
  {
  	$pdf->Image($correct,103.5,160.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }
  else if($income > 30000 && $income < 50001)
  {
  	$pdf->Image($correct,141,160.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }
  else if($income > 50000 && $income < 80001)
  {
  	$pdf->Image($correct,170.5,160.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }
  else if($income > 80000 && $income < 100001)
  {
  	$pdf->Image($correct,39.5,166.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }
  else if($income > 100000 && $income < 150001)
  {
  	$pdf->Image($correct,67.5,166.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }
  else if($income > 150000 && $income < 200001)
  {
  	$pdf->Image($correct,103.5,166.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }
  else if($income > 200000)
  {
  	$pdf->Image($correct,141,166.5,-300);//เครืองหมาย
  	$pdf->SetXY(20, 176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $income),0,0,'C'); //income
  	$pdf->SetXY(95,176);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $incomedetail),0,0,'C'); //incomedetail
  }

  if($status == "โสด/Single")
  {
  	$pdf->Image($correct,53,202,-300);//เครืองหมาย

  }
  else if($status == "แต่งงาน/Married")
  {
  	$pdf->Image($correct,69.5,202,-300);//เครืองหมาย
  	$pdf->SetXY(45,210.5);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $name_somros),0,0,'C'); //incomedetail
  	$pdf->SetXY(65,210.5);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $surname_somros),0,0,'C'); //incomedetail
  	$pdf->SetXY(25,216);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $work_somros),0,0,'C'); //incomedetail
  	$pdf->SetXY(85,216);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $position_somros),0,0,'C'); //incomedetail
  	$pdf->SetXY(150,216);
  	$pdf->Cell(55,0,iconv( 'UTF-8','cp874//IGNORE' , $phone_somros),0,0,'C'); //incomedetail
  }
  else if($status == "หย่าร้าง/divorced")
  {
  	$pdf->Image($correct,103.5,166.5,-300);//เครืองหมาย
  }

  //page 3
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename3);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  $pdf->SetXY(40, 106.8);
  $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $bank),0,0,'C'); //ธนารคารจ่าายเงิน

  $pdf->SetXY(95, 106.8);
  $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $bankacc),0,0,'C'); //เลขที่บัญชีจ่ายเงิน

  $pdf->SetXY(130,106.8);
  $pdf->Cell(2,0,iconv( 'UTF-8','cp874//IGNORE' , $bankmajor),0,0,'C'); //สาขาจ่ายเงิน

  $pdf->SetXY(45, 130);
  $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $bank2),0,0,'C'); //ธนารคารรับเงืน

  $pdf->SetXY(100, 130);
  $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $bankacc2),0,0,'C'); //เลขที่บัญชีรับเงิน

  $pdf->SetXY(135,130);
  $pdf->Cell(2,0,iconv( 'UTF-8','cp874//IGNORE' , $bankmajor2),0,0,'C'); //สาขารับเงิน

  if($banktype == "ออมทรัพย์")//เช็คประเภทธนาคารจ่ายเงิน
  {
  	$pdf->Image($correct,161,103,-300);//เครื่องหมาย

  }
  else if($banktype == "กระแสรายวัน")//เช็คประเภทธนาคารจ่ายเงิน
  {
  	$pdf->Image($correct,179,103,-300);//เครื่องหมาย
  }
  if($banktype2 == "ออมทรัพย์")//เช็คประเภทธนาคารรับเงิน
  {
  	$pdf->Image($correct,165.5,126.5,-300);//เครื่องหมาย

  }
  else if($banktype2 == "กระแสรายวัน")//เช็คประเภทธนาคารรับเงิน
  {
  	$pdf->Image($correct,184,126.5,-300);//เครื่องหมาย
  }

  //page 4
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename4);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 5
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename5);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(98,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(121,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(174,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(98,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(121,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(174,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล
  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(102,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(129,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(180,254.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล
  }

  //page 6
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename6);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 7
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename7);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(45,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(57,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(83,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(155,57.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $phone),0,0,'C');//โทรศํพท์มือถือ

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(45,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(57,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(83,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(155,57.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $phone),0,0,'C');//โทรศํพท์มือถือ

  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(47,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(61,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(87.5,57.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(155,57.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $phone),0,0,'C');//โทรศํพท์มือถือ

  }
  if ($jobs == "พนักงานบริษัท")//เช็คอาชีพ
  {
  	$pdf->Image($correct,26,60.5,-300);//เครืองหมาย

  }
  else if($jobs == "ข้าราชการ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,41.3,60.5,-300);//เครืองหมาย

  }
  else if($jobs == "พนักงานรัฐวืสาหกิจ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,54.5,60.5,-300);//เครืองหมาย

  }
  else if($jobs == "เจ้าของกิจการ")//เช็คอาชีพ
  {
  	$pdf->Image($correct,72.5,60.5,-300);//เครื่องหมาย
  	$pdf->SetXY(20, 61);
  	$pdf->Cell(0,5,iconv( 'UTF-8','cp874//IGNORE' , $jobsdetail),0,0,'C');//คำอธิบายอื่น

  }


  //page 8
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename8);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(87,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(99,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(126,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(93,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(104.5,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(131.5,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(87,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(99,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(126,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(93,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(104.5,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(131.5,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(89,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(102.5,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(128.5,142);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(95,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(108.5,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(134.5,267);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }

  //page 9
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename9);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);


  //page 10
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename10);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(75,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(87,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(115,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(180,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $nationality),0,0,'C');//สัญชาติ


  	$pdf->SetXY(65,62);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'C'); //เลขบัตรประจำตัวประชาชน

  	$pdf->SetXY(190,62);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $passport),0,0,'C'); //เลขหนังสือเดินทาง


  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(75,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(87,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(115,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(180,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $nationality),0,0,'C');//สัญชาติ


  	$pdf->SetXY(65,62);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'C'); //เลขบัตรประจำตัวประชาชน

  	$pdf->SetXY(190,62);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $passport),0,0,'C'); //เลขหนังสือเดินทาง


  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(78,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(92,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(120,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(180,50);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $nationality),0,0,'C');//สัญชาติ


  	$pdf->SetXY(65,62);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'C'); //เลขบัตรประจำตัวประชาชน

  	$pdf->SetXY(190,62);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $passport),0,0,'C'); //เลขหนังสือเดินทาง


  }

  //page 11
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename11);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 12
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename12);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  $mark = "___";
  $markII = "______";

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(160,60);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(40,66);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(123,60);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $mark),0,0,'C'); //เส้นต๋าย


  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(160,60);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(40,66);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(128,60);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $mark),0,0,'C'); //เส้นต๋าย

  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(160,60);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(40,66);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(136,60);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $markII),0,0,'C'); //เส้นต๋าย

  }
  else if($gender == "บริษัท(Company)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(160,60);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(40,66);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(145,60);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $mark),0,0,'C'); //เส้นต๋าย

  }

  //page 13
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename13);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 14
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename14);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 15
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename15);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(18,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(29.5,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(55,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(18,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(29.5,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(55,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล
  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(20.5,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(34,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(60,270.7);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล
  }


  //page 16
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename16);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 17
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename17);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 18
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename18);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 19
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename19);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 20
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename20);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 21
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename21);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 22
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename22);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 23
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename23);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 24
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename24);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 25
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename25);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 26
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename26);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 27
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename27);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 28
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename28);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //page 29
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename29);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(28,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(39.5,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(68,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(28,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(39.5,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(68,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล
  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(30,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(43.5,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(69.5,241);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล
  }

  //page 30
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename30);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(70,74);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(87,74);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(115,74);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล


  	$pdf->SetXY(68.5,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(80,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(107,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(70,74);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(87,74);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(115,74);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล


  	$pdf->SetXY(68.5,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(80,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(107,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล
  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(70,74);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(89,74);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(115,74);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล


  	$pdf->SetXY(70.5,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(84,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(110,223);
  	$pdf->Cell(100,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C'); //นามสกุล
  }


  //page 31
  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename31);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(42,46.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(54.5,46.5);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(80,46.5);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(42,46.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(54.5,46.5);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(80,46.5);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(42,46.5);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(58.5,46.5);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(84,46.5);
  	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }


  $pdf->AddPage('P');
  $pdf->setSourceFile($filename32);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($customer == "ลูกค้าเดิม")
  {
  	$pdf->Image($correct,42.5,86,-300);//เครื่องหมาย
  }
  else if($customer == "ลูกค้าใหม่")
  {
  	$pdf->Image($correct,84.5,86,-300);//เครื่องหมาย
  }




  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(50,110);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(110,110);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(4,109.5);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $mark),0,0,'C'); //เส้นต๋าย


  }
  else if($gender == "นาง(Miss)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(50,110);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(110,110);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(12,109.5);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $mark),0,0,'C'); //เส้นต๋าย

  }
  else if($gender == "นางสาว(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(50,110);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(110,110);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(22,109.5);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $markII),0,0,'C'); //เส้นต๋าย

  }
  else if($gender == "บริษัท(Company)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(50,110);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(110,110);
  	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  	$pdf->SetXY(34,109.5);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $mark),0,0,'C'); //เส้นต๋าย

  }

  if($idcard == "idcard")
  {
  	$pdf->Image($correct,27,113.5,-300);//เครื่องหมาย
  	$pdf->SetXY(25,122.5);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'C'); //เลขบัตรประจำตัวประชาชน
  }
  else if($idcard == "ทะเบียนการค้า")
  {
  	$pdf->Image($correct,88.5,113.5,-300);//เครื่องหมาย
  	$pdf->SetXY(25,123.5);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'C'); //ชเลขบัตรประจำตัวประชาชน
  }
  else if($idcard == "อื่นๆ")
  {
  	$pdf->Image($correct,149.5,113.5,-300);//เครื่องหมาย
  	$pdf->SetXY(25,123.5);
  	$pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'C'); //เลขบัตรประจำตัวประชาชน
  }

  $pdf->SetXY(133, 122.5);
  $pdf->Cell(50,0,iconv( 'UTF-8','cp874//IGNORE' , $email),0,0,'C');//email

  	$pdf->SetXY(20, 20);
  	$pdf->Cell(110,220,iconv( 'UTF-8','cp874//IGNORE' , $home_number3),0,0,'C'); //เลขที่ี่อยู่ตามทะเบียนบ้าน
  	$pdf->SetXY(20,20);
  	$pdf->Cell(130,220,iconv( 'UTF-8','cp874//IGNORE' , $moo_number3),0,0,'C'); //หมู่ที่ตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(160,220,iconv( 'UTF-8','cp874//IGNORE' , $building_name3),0,0,'C'); //ชื่ออาคารตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(190,220,iconv( 'UTF-8','cp874//IGNORE' , $home_soi3),0,0,'C'); //ซอยตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(220,220,iconv( 'UTF-8','cp874//IGNORE' , $home_road3),0,0,'C'); //ถนนตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(250,220,iconv( 'UTF-8','cp874//IGNORE' , $home_tumbon3),0,0,'C'); //ตำบลตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(290,220,iconv( 'UTF-8','cp874//IGNORE' , $home_district3),0,0,'C'); //อำเภอตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(330,220,iconv( 'UTF-8','cp874//IGNORE' , $home_provience3),0,0,'C'); //จังหวัดตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(30,233.5,iconv( 'UTF-8','cp874//IGNORE' , $home_zipcode3),0,0,'C'); //รหัสไปรษณีย์ตามทะเบียนบ้าน
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(150,246.5,iconv( 'UTF-8','cp874//IGNORE' , $phone),0,0,'C');//โทรศํพท์มือถือ
  	$pdf->SetXY(20, 20);
  	$pdf->Cell(270,246.5,iconv( 'UTF-8','cp874//IGNORE' , $tel),0,0,'C');//โทรศํพท์บ้าน

    if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
    {
    	$pdf->SetXY(132,200);
    	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    	$pdf->SetXY(150,200);
    	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    	$pdf->SetXY(175,200);
    	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

    }
    else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
    {
    	$pdf->SetXY(132,200);
    	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    	$pdf->SetXY(150,200);
    	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    	$pdf->SetXY(175,200);
    	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

    }
    else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
    {
    	$pdf->SetXY(132,200);
    	$pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    	$pdf->SetXY(150,200);
    	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    	$pdf->SetXY(175,200);
    	$pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

    }


  $pdf->AddPage('P');
  $pdf->setSourceFile($filename33);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
    $pdf->SetXY(78,63);
    $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    $pdf->SetXY(100,63);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    $pdf->SetXY(135,63);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
    $pdf->SetXY(78,63);
    $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    $pdf->SetXY(100,63);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    $pdf->SetXY(135,63);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
    $pdf->SetXY(78,63);
    $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    $pdf->SetXY(100,63);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    $pdf->SetXY(135,63);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }

  $pdf->AddPage('P');
  $pdf->setSourceFile($filename34);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);


  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //page 35
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename35);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);


  //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //page 36
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename36);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  $pdf->AddPage('P');
  $pdf->setSourceFile($filename37);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //page 37
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename38);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);


  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //page 38

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
    $pdf->SetXY(134,125.5);
    $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    $pdf->SetXY(152,125.5);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    $pdf->SetXY(177,125.5);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }
  else if($gender == "นาง(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
    $pdf->SetXY(134,125.5);
    $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    $pdf->SetXY(152,125.5);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    $pdf->SetXY(177,125.5);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล

  }
  else if($gender == "นางสาว(Ms.)")//เช็คคำนำหน้าชื่อ
  {
    $pdf->SetXY(134,125.5);
    $pdf->Cell(-10,0,iconv( 'UTF-8','cp874//IGNORE' , $gender2),0,0,'C'); //คำนำหน้าชื่อ

    $pdf->SetXY(152,125.5);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C'); //ชื่อหน้า

    $pdf->SetXY(177,125.5);
    $pdf->Cell(-20,0,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'C');//นามสกุล
}

  $pdf->AddPage('P');
  $pdf->setSourceFile($filename39);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);


  $pdf->AddPage('P');
  $pdf->setSourceFile($filename40);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);


  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //page 41
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename41);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);



  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //page 42
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename42);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);





  //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //page 43
  $pdf->AddPage('P');
  $pdf->setSourceFile($filename43);
  $tplIdx = $pdf->importPage(1);
  $pdf->useTemplate($tplIdx,4,2);

  if($gender == "นาย(Mr.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(85,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $egender),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(107,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $efirstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(165,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $esurname),0,0,'C'); //นามสกุล

  }
  else if($gender == "นาง(Miss)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(85,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $egender),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(107,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $efirstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(165,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $esurname),0,0,'C'); //นามสกุล
  }
  else if($gender == "นางสาว(Mrs.)")//เช็คคำนำหน้าชื่อ
  {
  	$pdf->SetXY(85,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $egender),0,0,'C'); //คำนำหน้าชื่อ

  	$pdf->SetXY(107,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $efirstname),0,0,'C'); //ชื่อหน้า

  	$pdf->SetXY(165,196.5);
  	$pdf->Cell(0,0,iconv( 'UTF-8','cp874//IGNORE' , $esurname),0,0,'C'); //นามสกุล

  }











/*
//sellidshowprint
$pdf->SetTextColor(255, 0 ,0);
$pdf->SetFont('angsana','',15);
$pdf->SetXY(-15, 2);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $sellidshow." :".$Transname),0,0,'R');
$pdf->SetTextColor(0, 0 ,0);
//sender
$pdf->SetFont('angsana','B',20);
$pdf->SetXY(20, 49);
$pdf->Cell(85,8,iconv( 'UTF-8','cp874//IGNORE' , $sendername),0,1,'L');
$pdf->SetXY(20, 56);
$pdf->MultiCell(140,7,iconv( 'UTF-8','cp874//IGNORE' , $senderaddress),0,'L',0,2);
$pdf->SetXY(55, 78);
$pdf->Cell(85,8,iconv( 'UTF-8','cp874//IGNORE' , $sendertel),0,1,'L');
//receiver
$pdf->SetXY(20, 85);
$pdf->Cell(85,8,iconv( 'UTF-8','cp874//IGNORE' , $receivername),0,1,'L');

$pdf->SetXY(55, 91);
$pdf->Cell(85,8,iconv( 'UTF-8','cp874//IGNORE' , $receivertel),0,1,'L');
*/

//$dateselect = date("Y-m-d");

$filename = "mtsfirstpagewithtext_". date('_Ymd_Hi') . ".pdf";
$pdf->Output($filename,'I');
}
}
public function exportExcel(Request $request) {
    $this->prepareExportingData($request)->export('xlsx');
    redirect ('memreport');
}

private function prepareExportingData($request) {
    $author = Auth::user()->username;
    $employees = $this->getExportingData(['id_num'=> $request['id_num']]);
    return Excel::create('report_from_'. $request['id_num'], function($excel) use($employees, $request, $author) {

    // Set the title
    $excel->setTitle('List of hired employees from '. $request['id_num']);

    // Chain the setters
    $excel->setCreator($author)
        ->setCompany('Wealththai');

    // Call them separately
    $excel->setDescription('The list of hired employees');

    $excel->sheet('id_num', function($sheet) use($employees) {

    $sheet->fromArray($employees);
        });
    });
}
private function getExportingData($constraints) {
    return DB::table('persons')

    ->select('persons.*', 'persons.lname','persons.id_num','persons.Eng_name', 'persons.Eng_lastname', 'persons.gender')
      ->where('id_num','=', $constraints['id_num'])

    ->get()
    ->map(function ($item, $key) {
    return (array) $item;
    })
    ->all();
}
}
?>
