<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Viewper;
use Session;

class LineBotController extends Controller
{
  public function linebot($senderid,$sendername,$messagetype,$message,$recieverid,$recievername,$reciverlineuserid){
    $url = 'https://wealththai.org/testbot101-master/webhooks.php';
    $username = 'guest'; // กำหนด URl ของเว็บไวต์ B
    $id = 'Uaf703e9707ecc91b4ebb7f6bc758ee1a';
    $request = 'recievername='.$recievername.'&messagetype='.$messagetype.'&message='.$message.'&sendername='.$sendername.'&reciverlineuserid='.$reciverlineuserid;
 // กำหนด HTTP Request โดยระบุ username=guest และ password=เguest (รูปแบบเหมือนการส่งค่า $_GET แต่ข้างหน้าข้อความไม่มีเครื่องหมาย ?)
$ch = curl_init(); // เริ่มต้นใช้งาน cURL
curl_setopt($ch, CURLOPT_URL, $url); // กำหนดค่า URL
curl_setopt($ch, CURLOPT_POST, 1); // กำหนดรูปแบบการส่งข้อมูลเป็นแบบ $_POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // กำหนดค่า HTTP Request
curl_setopt($ch, CURLOPT_HEADER, 0); // กำให้ cURL ไม่มีการตั้งค่า Header
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // กำหนดให้ cURL คืนค่าผลลัพท์
$response = curl_exec($ch); // ประมวลผล cURL
curl_close($ch); // ปิดการใช้งาน cURL

echo $response;
  }

  public function linebotupdateconfirm(){
    $id= Auth::user()->line_user_id;
    $url = 'https://wealththai.org/testbot101-master/webhooks.php';
    $passwordconnecttoline = 'Connect1562Server'; // กำหนด URl ของเว็บไวต์ B
    $request = 'lineid='.$id.'&passwordconnecttoline='.$passwordconnecttoline.'เชื่อมต่อไลน์กับบัญชีระบบ Wealththai ของคุณเรียบร้อยแล้ว!';
 // กำหนด HTTP Request โดยระบุ username=guest และ password=เguest (รูปแบบเหมือนการส่งค่า $_GET แต่ข้างหน้าข้อความไม่มีเครื่องหมาย ?)
$ch = curl_init(); // เริ่มต้นใช้งาน cURL
curl_setopt($ch, CURLOPT_URL, $url); // กำหนดค่า URL
curl_setopt($ch, CURLOPT_POST, 1); // กำหนดรูปแบบการส่งข้อมูลเป็นแบบ $_POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // กำหนดค่า HTTP Request
curl_setopt($ch, CURLOPT_HEADER, 0); // กำให้ cURL ไม่มีการตั้งค่า Header
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // กำหนดให้ cURL คืนค่าผลลัพท์
$response = curl_exec($ch); // ประมวลผล cURL
curl_close($ch); // ปิดการใช้งาน cURL

echo $response;
  }
	  public function linebotupdateconfirmmember(){
    $id = Auth::guard('person')->user()->line_user_id;

    $url = 'https://testbot1012.herokuapp.com/webhooks.php';
      $passwordconnecttolinemember = 'ConnectMember'; // กำหนด URl ของเว็บไวต์ B
    $request = 'lineid='.$id.'&passwordconnecttolinemember='.$passwordconnecttolinemember.'เชื่อมต่อไลน์กับบัญชีระบบ Wealththai ของคุณเรียบร้อยแล้ว!';
 // กำหนด HTTP Request โดยระบุ username=guest และ password=เguest (รูปแบบเหมือนการส่งค่า $_GET แต่ข้างหน้าข้อความไม่มีเครื่องหมาย ?)
$ch = curl_init(); // เริ่มต้นใช้งาน cURL
curl_setopt($ch, CURLOPT_URL, $url); // กำหนดค่า URL
curl_setopt($ch, CURLOPT_POST, 1); // กำหนดรูปแบบการส่งข้อมูลเป็นแบบ $_POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // กำหนดค่า HTTP Request
curl_setopt($ch, CURLOPT_HEADER, 0); // กำให้ cURL ไม่มีการตั้งค่า Header
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // กำหนดให้ cURL คืนค่าผลลัพท์
$response = curl_exec($ch); // ประมวลผล cURL
curl_close($ch); // ปิดการใช้งาน cURL

echo $response;
  }
	
}
