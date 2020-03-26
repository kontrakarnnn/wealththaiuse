<!DOCTYPE html>
<html>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>

<style>
@font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url('http://wealththai.org/THSarabunNew.ttf') format('truetype');
        }
@font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url('http://wealththai.org/fonts/THSarabunNew Bold.ttf') format('truetype');
                }
@font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url('http://wealththai.org/fonts/THSarabunNew Italic.ttf') format('truetype');
                        }
  @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
    }
        body {
            font-family: 'THSarabunNew';
        }

          .footer {
              position: fixed;
              bottom: 45;
              width: 100%;

          }
table {
  font-family: 'THSarabunNew';
  border-collapse: collapse;
  border-spacing:0.5px;
  width: 100%;
  font-size: 15.5px
}
.table
{
    border:solid 0.5px;
    text-align:center;
}
.columnshow10 {
  float:left;
  padding:10px;
  width: 10%;
  margin-top:-15px
}
.wealth
{
  margin-top:-15px;
  max-width:100px
}
.carinsur
{
  margin-top:-20px;
  max-width:100px
}
</style>
</head>
<body>
  <img class='wealth'  src='https://erp.wealththai.net/img/wealth.png' />
  <img class='carinsur' src='https://erp.wealththai.net/img/carinsu.png' />

  <div style='width:450px;float:right;margin-top:-60px' >
    <p style='text-align:right;'>
      'ต่อประกันครั้งหน้า อย่าลืมคิดถึงเรา
 เพราะความพึงพอใจของคุณ คือเป้าหมายสูงสุดของเรา'
    </p>
  </div>
  <br />
  <br />
  <br />



<p style='text-align:center;font-size:18px;margin-top:-70px'><b>ใบแจ้งหนี้ /Invoice</b></p>
<div style='text-align:right'>
  <table style='width:250px;border:none;margin-left:600px;margin-top:-80px'>
    <tr>
    <th>วันที่</th>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>{{$date}}</td>
  </tr>
  <tr style='padding-bottom: 0;'>
    <th>เสนอราคาโดย</th>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>{{$username}}  ({{$usermobile}})</td>
  </tr>
    <tr>

    <th>E-mail</th>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>{{$useremail}}</td>
  </tr>
  </table>
</div>
<div style='text-align:left'>
  <table style='width:250px;border:none;margin-top:-60px'>
    <tr>
    <th>เรียนคุณ</th>
    <td>&nbsp;</td><td>{{$customername}} {{$customerlastname}}</td>
  </tr>
  <tr style='margin-top:-160px'>
    <th>เรื่อง</th>
    <td>&nbsp;</td><td>การแจ้งหนี้ชำระเบี้ยประกัน</td>
  </tr>
  </table>
</div>
<br/>
<table style='width:1000px;margin-top:-20px' class='table'>
  <tr>
    <th class='table' style='width:100px;height:5px;text-align:center;background-color:#dedee3'>ชื่อผู้เอาประกันภัย</th>
    <td colspan='5'class='table'style='text-align:center'>{{$customername}} {{$customerlastname}}</td>
    <th class='table'style='width:100px;height:5px;text-align:center;background-color:#dedee3'>เบอร์โทรผู้เอาประกัน</th>
    <td colspan='4'class='table'style='text-align:center'>0633636362</td>
  </tr>
  <tr>
    <th class='table'style='width:100px;height:5px;text-align:center;background-color:#dedee3'>ชื่อผู้ติดต่อ</th>
    <td colspan='5'class='table'style='text-align:center'>กลตระการ ทำอินลาด</td>
    <th class='table'style='width:100px;height:5px;text-align:center;background-color:#dedee3'>เบอร์โทรผู้ติดต่อ</th>
    <td colspan='4'class='table'style='text-align:center'>0633636362</td>
  </tr>
  <tr>
    <th class='table'style='background-color:#dedee3'>รหัสรถยนต์</th>
    <th colspan='3' class='table'style='background-color:#dedee3'>ยี่ห้อ</th>
    <th colspan='2' class='table' style='background-color:#dedee3'>รุ่น</th>
    <th  class='table'style='background-color:#dedee3;'>เลขทะเบียน</th>
    <th  class='table'style='background-color:#dedee3'>ปี/รุ่น</th>
    <th class='table'style='background-color:#dedee3'>รุ่นย่อย</th>
    <th colspan='2' class='table'style='background-color:#dedee3'>มูลค่าอุปกรณ์เสริม</th>

  </tr>
  <tr>
    <td class='table'>1144556666888</td>
    <td  colspan='3' class='table'>Honda</td>
    <td colspan='2' class='table'>Civic</td>
    <td  style=''class='table'>กข 4489</td>
    <td class='table'>2019</td>
    <td  class='table'>Rs</td>
    <td colspan='2' class='table'>รายละเอียดที่จะกรอก</td>
  </tr>
  <tr>
      <th class='table' style='background-color:#dedee3'>รายการอุปกรณ์เสริม</th>
      <td  colspan='10'class='table'>รายละเอียดที่จะกรอก</td>

  </tr>
  <tr>
      <th class='table' style='background-color:#dedee3'>ข้อมูลกรมธรรม์ภาคสมัครใจ</th>
      <td colspan='10'class='table'>รายละเอียดที่จะกรอก</td>

  </tr>
  <tr>
      <th class='table' style='background-color:#dedee3'>ที่อยู่บริษัท</th>
      <td colspan='10'class='table'>รายละเอียดที่จะกรอก</td>

  </tr>
  <tr>
      <th class='table' style='background-color:#dedee3'>หมายเลขผู้เสียภาษี</th>
      <td colspan='3'class='table'>รายละเอียดที่จะกรอก</td>
      <th class='table' style='background-color:#dedee3'>รหัสสาขา</th>
      <td colspan='2'class='table'>รายละเอียดที่จะกรอก</td>
      <th class='table' style='background-color:#dedee3'>ชื่อสาขา</th>
      <td colspan='3'class='table'>รายละเอียดที่จะกรอก</td>
  </tr>
  <tr>
      <th class='table' style='background-color:#dedee3'>ประเภทกรมธรรมภาคสมัครใจ</th>
      <td colspan='4'class='table'>2</td>
      <th colspan='6'class='table' style='background-color:#dedee3'>ความเสียหายต่อภายนอก</th>

  </tr>
  <tr>
    <th class='table' style='background-color:#dedee3'>รายละเอียดการชำระเงิน</th>
    <th class='table' style='background-color:#dedee3'>กรมธรรม์</th>
    <th class='table' style='background-color:#dedee3'>พรบ</th>
    <th class='table' style='background-color:#dedee3'>ภาษี</th>
    <th class='table' style='background-color:#dedee3'>รวม</th>
    <th class='table' style='background-color:#dedee3'>ผู้ขับขี่</th>
    <td class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>ต่อคน</th>
    <td class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>ต่อครั้ง</th>
    <td class='table'>รายละเอียดที่จะกรอก</td>
  </tr>
  <tr>
    <td class='table'>เบี้ยสุทธิ</td>
    <td class='table'>15000</td>
    <td class='table'>800</td>
    <td class='table'>1100</td>
    <td class='table'>20000</td>
    <th colspan='3' class='table' style='background-color:#dedee3'>ชดเชยความผิดส่วนแรก</th>
    <td colspan='3'  class='table'>รายละเอียดที่จะกรอก</td>
  </tr>
  <tr>
    <td class='table'>อากรแสตมป์</td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <th colspan='6' class='table' style='background-color:#dedee3'>ความเสียหายต่อทรัพย์สิน (ผู้เอาประกัน)</th>
  </tr>
  <tr>
    <td class='table'>ภาษีมูลค่าเพิ่ม</td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <th class='table' style='background-color:#dedee3'>ทุนประกัน</th>
    <td class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>ไฟไหม้/หาย</th>
    <td class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>น้ำท่วม</th>
    <td class='table'>รายละเอียดที่จะกรอก</td>
  </tr>
  <tr>
    <td class='table'>ยอดสุทธิก่อนหัก ณ ที่จ่าย</td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <th colspan='3' class='table' style='background-color:#dedee3'>ชดเชยความผิดส่วนแรก</th>
    <td colspan='3'  class='table'>รายละเอียดที่จะกรอก</td>
  </tr>
  <tr>
    <td class='table'>ภาษี หัก ณ ที่จ่าย</td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <th colspan='6' class='table' style='background-color:#dedee3'>ความคุ้มครองต่อบุคคล(เสียชีวิต,สูญเสียอวัยวะ,ทุพพลภาพถาวร)</th>
  </tr>
  <tr>
    <td class='table'>ยอดสุทธิหลังหัก ณ ที่จ่าย</td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <td class='table'></td>
    <th class='table' style='background-color:#dedee3'>วงเงินอุบัติเหตุ</th>
    <td class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>จำนวนผู้โดยสาร</th>
    <td class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>ค่ารักษาพยาบาล</th>
    <td class='table'>1,000,000</td>
   </tr>
  <tr>
    <th colspan='5'style='background-color:#dedee3'>รายละเอียดเพิ่มเติม</th>
    <th class='table' style='background-color:#dedee3'>วงเงินทุทุพพลภาพชั่วคราว(คนขับ)</th>
    <td colspan='2'class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>วงเงินทุวงเงินทุทุพพลภาพชั่วคราว(ผู้โดยสาร)</th>
    <td colspan='2'class='table'>รายละเอียดที่จะกรอก</td>

  <tr>
    <td colspan='5'class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>ค่ารักษาพยาบาล</th>
    <td colspan='2'class='table'>รายละเอียดที่จะกรอก</td>
    <th class='table' style='background-color:#dedee3'>ค่าประกันตัว</th>
    <td colspan='2'class='table'>รายละเอียดที่จะกรอก</td>
  </tr>
  <tr>
    <td colspan='11'class='table'>ที่อยู่จัดส่งเอกสารใบหัก ณ ที่จ่าย Wealth Thai Insurance ชั้น4 อาคารชาร์เตอร์เฮาส์ เลขที่ 23 ซอย ลาดพร้าว 124 (สวัสดิการ) แขวงพลับพลา เขตวังทองหลาง กทม. 10310</td>

  </tr>

</table>
<div class='footer'>
  <p style='font-size:15.5px ;line-height: 2px'><b style='color:red;border-bottom:solid red 0.5px'>หมายเหตุ</b></p>
  <p style='font-size:15.5px ;line-height: 2px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    1. ทั้งนี้ราคาที่เสนอดังกล่าวอาจมีการเปลี่ยนแปลงได้หากกรมธรรมเดิมยังไม่หมดอายุและมีการเคลมประกันค่าเสียหายในระยะเวลา ก่อนกรมธรรมเดิมหมดอายุและลูกค้าต้องการใช้ประกันภัยบริษัทเดิม </p>
  <p style='font-size:15.5px ;line-height: 2px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    2. ในกรณีเจ้าของกรรมธรรมเป็นนิติบุคคลและต้องการหัก ณ ที่จ่าย กรุณาแจ้งให้กับทางผู้แนะนำ [ชื่อ USER ,  เบอร์โทร ] ของท่านเพื่อดำเนินการ </p>
  <p style='font-size:15.5px ;line-height: 2px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    3. หากชำระเงินผ่านการโอนเงินทางธนาคาร ให้ผู้โอน ถ่ายสลิปหรือหลักฐานการโอนไว้ แล้วส่งให้กับผู้แนะนำเพื่อดำเนินการ หรือในกรณีชำระเป็นเช็ค หรือมีการออกใบหัก ณ ที่จ่าย รบกวนติดต่อ ผู้แนะนำ </p>
  <p style='font-size:15.5px ;line-height: 2px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    เพื่อดำเนินการในส่วนที่เหลือต่อไป หรือในกรณีที่ติดต่อผู้แนะนำไม่ได้ สามารถติดต่อที่ Customer Help Desk ของเราได้ที่เบอร์ [094-165-6019]</p>

</div>

  </body>

</html>
