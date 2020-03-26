<?php
namespace App\Http\Controllers\printout;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Person;
use setasign\Fpdi\Fpdi;
use fpdf181\Fpdf;
require('fpdf181/fpdf.php');
require('fpdf1812/fpdi.php');


define('FPDF_FONTPATH','font/');

class ktbfirstpageController extends Controller
{
  public function index(Request $request) {
    $constraints = [
        'id_num' => $request['id_num']
    ];
      $employees = $this->getHiredEmployees($constraints);
      return view('indexpdf', ['employees' => $employees, 'constraints' => $constraints]);
  }
  public function search(Request $request) {
      $constraints = [
          'id_num' => $request['id_num']
      ];

      $employees = $this->getHiredEmployees($constraints);
      return view('indexpdf', ['employees' => $employees, 'searchingVals' => $constraints]);
  }
  private function getHiredEmployees($constraints) {
      $employees = Person::where('id_num','=',$constraints)

                      ->get();
      return $employees;
  }
public function exportPDF(Request $request) {
  $constraints = [
      'id_num' => $request['id_num']
  ];
$pdf = new fpdi('P' , 'mm' , 'A4');

$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
$pdf->AddFont('THSarabunNewb', '', 'THSarabunNew Bold.php');
$pdf->AddPage('P');
//$pdf->setSourceFile('ktbsecure_firstpage.pdf');
//$tplIdx = $pdf->importPage(1);
//$pdf->useTemplate($tplIdx,4,2);

//variable
  $employees = $this->getExportingData($constraints);
//$ChildDivisions =DB::table('persons')->where('id_num','=',$constraints)->get();
foreach ( $employees as $Division) {
$bname = {{$Division->gender; //คำนำหน้าชื่อ
$firstname = $Division->name; //ชื่อหน้า
$surname = $Division->lname; //นามสกุล
$idcode = $Division->id_num; //เลขบัตรประจำตัวประชาชน

$home_number = $Division->add1; //เลขที่บ้าน
$moo_number = $Division->add1_alley; //หมู่ที่

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
$pdf->Cell(10,8,iconv( 'UTF-8','cp874//IGNORE' , $moo_number),0,0,'C');





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
$pdf->Output($filename,'D');
}

}
public function exportExcel(Request $request) {
    $this->prepareExportingData($request)->export('xlsx');
    redirect()->intended('memreport');
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

    ->select('persons.*')
    ->where('id_num','=',3100600479670)

    ->get()
    ->map(function ($item, $key) {
    return (array) $item;
    })
    ->all();
}
}
?>
