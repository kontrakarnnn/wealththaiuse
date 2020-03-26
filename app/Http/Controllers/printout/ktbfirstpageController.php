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


class ktbfirstpageController extends Controller
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
      return view('indexpdf', ['employees' => $employees, 'searchingVals' => $constraints ,'request' => $request,'tree'=>$tree]);
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
      return view('indexpdf', ['employees' => $employees, 'searchingVals' => $constraints,'tree'=>$tree]);
  }
  private function getHiredEmployees($constraints) {
      $employees = Person::where('id_num', '=', $constraints)

                      ->get();
      return $employees;
  }
public function exportPDF(Request $request) {
  $filename =  __DIR__.'/ktbsecure_firstpage.pdf';

$name = $request->input('name');
$pdf = new fpdi('P' , 'mm' , 'A4');

$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
$pdf->AddFont('THSarabunNewb', '', 'THSarabunNew Bold.php');
$pdf->AddPage('P');
$pdf->SetSourceFile($filename);
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx,4,2);

//variable
$ChildDivisions =DB::table('persons')->where('id_num',$request->id_num)->get();
foreach ( $ChildDivisions as $Division) {
$bname = $Division->gender; //คำนำหน้าชื่อ
$firstname = $Division->name; //ชื่อหน้า
$surname = $Division->lname; //นามสกุล
$idcode = $Division->id_num; //เลขบัตรประจำตัวประชาชน

$home_number = $Division->add1; //เลขที่บ้าน


$home_soi = $Division->add1_alley; //ซอย
$home_road =$Division->add1_road; //ถนน
$home_tumbon = $Division->add1_subdistrict; //แขวงตำบล
$home_district = $Division->add1_district; //เขตอำเภอ
$home_provience = $Division->add1_city; //จังหวัด
$home_zipcode = $Division->add1_postcode; //จังหวัด
$telcontract = $Division->mobile; //เบอร์โทรติดต่อ
$email = $Division->email;

$pdf->SetFont('THSarabunNew','',15); //Font และ ขนาดอักษร หากต้องการเป็นตัวหนา จะเป็น$pdf->SetFont('THSarabunNewb','',15);
$pdf->SetTextColor(0, 0 ,0);

$pdf->SetXY(49, 46);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $bname),0,0,'C');

$pdf->SetXY(95, 46);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $firstname),0,0,'C');

$pdf->SetXY(143, 46);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $surname),0,0,'L');

$pdf->SetXY(123, 55);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $idcode),0,0,'L');

$pdf->SetXY(40, 73);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $home_number),0,0,'C');

$pdf->SetXY(68, 73);






$pdf->SetXY(44, 82);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $home_soi),0,0,'C');

$pdf->SetXY(98, 82);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $home_road),0,0,'C');

$pdf->SetXY(167, 82);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $home_tumbon),0,0,'C');

$pdf->SetXY(60, 91);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $home_district),0,0,'C');

$pdf->SetXY(120, 91);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $home_provience),0,0,'C');

$pdf->SetXY(176, 91);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $home_zipcode),0,0,'C');

$pdf->SetXY(63, 100);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $telcontract),0,0,'L');

$pdf->SetXY(31, 109);
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $email),0,0,'L');

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

$filename = "ktbfirstpagewithtext_". date('_Ymd_Hi') . ".pdf";
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
