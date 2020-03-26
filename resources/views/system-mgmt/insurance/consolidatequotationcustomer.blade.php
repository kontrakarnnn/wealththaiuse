<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
@font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
@font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
                }
@font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
                        }
  @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
    }
        body {
            font-family: "THSarabunNew";
        }

  .footer {
      position: fixed;
              bottom: 45;
              width: 100%;

          }
          .header {
              position: fixed;
                      top: 0;
                      width: 100%;
                  }
          .page-break {
    page-break-after: always;
}
header { position: fixed;
        top: 0;
        width: 100%; }

table {
  font-family: "THSarabunNew";
  border-collapse: collapse;
  border-spacing:0.5px;
  width: 100%;


}
.table
{
  font-size:12px;
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
  <header>
    <div class="header">

  <img class="wealth"  src="https://erp.wealththai.net/img/wealth.png" />
  <img class="carinsur" src="https://erp.wealththai.net/img/carinsu.png" />

  <div style="width:450px;float:right;margin-top:-60px" >
    <p style="text-align:right;font-size:14px">
      "ต่อประกันครั้งหน้า อย่าลืมคิดถึงเรา
 เพราะความพึงพอใจของคุณ คือเป้าหมายสูงสุดของเรา"
    </p>
  </div>
  <br />
  <br />
  <br />



<p style="text-align:center;font-size:18px;margin-top:-70px"><b>ใบเสนอราคา/Quotation</b></p>
<div style="text-align:right">
  <table style="width:250px;border:none;margin-left:350px;margin-top:-80px">
    <tr>
    <th>วันที่</th>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>{{$date}}</td>
  </tr>
  <tr style="padding-bottom: 0;">
    <th>เสนอราคาโดย</th>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>{{$username}}  ({{$usermobile}})</td>
  </tr>
    <tr>

    <th>E-mail</th>
    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>{{$useremail}}</td>
  </tr>
  </table>
</div>
<div style="text-align:left">
  <table style="width:250px;border:none;margin-top:-70px">
    <tr>
    <th>เรียนคุณ</th>
    <td>&nbsp;</td><td> {{$customername}} {{$customerlastname}}</td>
  </tr>
  <tr style="margin-top:-160px">
    <th>เรื่อง</th>
    <td>&nbsp;</td><td>ข้อเสนอราคากรมธรรมประกันภัย</td>
  </tr>
  </table>
</div>
<br/>
<table style="margin-top:-20px" class="table">
  <tr>
    <th width:10% class="table"style="background-color:#dedee3;text-align:left;">รหัสรถยนต์</th>
    <th  class="table"style="background-color:#dedee3">ยี่ห้อ</th>
    <th class="table" style="background-color:#dedee3">รุ่น</th>
    <th  class="table"style="background-color:#dedee3;">เลขทะเบียน</th>
    <th  class="table"style="background-color:#dedee3">ปี/รุ่น</th>
    <th class="table"style="background-color:#dedee3;text-align:left;">รุ่นย่อย</th>
    <th  class="table" style="background-color:#dedee3">มูลค่าอุปกรณ์เสริม</th>
  </tr>
  <tr>
    <td class="table">{{$findasset->ref_info7}}</td>
    <td  class="table">{{$findasset->ref_info3}}</td>
    <td  class="table">{{$findasset->ref_info4}}</td>
    <td  style=""class="table">{{$findasset->ref_name}}</td>
    <td class="table">{{$findasset->ref_info5}}</td>
    <td  class="table">{{$findasset->ref_info6}}</td>
    <td  class="table">รายละเอียดที่จะกรอก</td>
  </tr>
  <tr>
    <th class="table"style="background-color:#dedee3;text-align:left;">รายการอุปกรณ์เสริม</th>
    <td colspan="6" class="table"></td>
  </tr>

</table>

</div>
</header>

@foreach ($findoffer as $index =>$chunk)
        <table style="margin-top:160px" class="table">

          <tr>

              <th  colspan="{{count($chunk)+1}}" style="background-color:#7EC1D5">
               กรมธรรมภาคสมัครใจ
            </th>
          </tr>

          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ชื่อบริษัท พันธมิตร</th>
            @foreach($chunk as $findof)
            @php
            $partnerblockname = \App\Partner_block::where('id',$findof->proposal->partner_block)->value('name');
            @endphp
            <td class="table">{{$partnerblockname}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">วันที่ออกข้อเสนอ</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->created_date}}</td>
            @endforeach

            </tr>
            <tr>
              <th class="table"style="background-color:#dedee3;text-align:left; ">บริษัทประกัน</th>
              @foreach($chunk as $findof)
              <td class="table">{{$findof->Person->name}}</td>
              @endforeach

              </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ประเภทการซ่อม</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->OfferType->name}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ชนิดกรมธรรม์</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->OfferType->name}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ผู้ขับขี่</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value17}}</td>
            @endforeach
          </tr>
          <tr>

            <th  colspan="{{count($chunk)+1}}" style="background-color:white">
               ความเสียหายต่อภายนอก
            </th>
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ต่อคน</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value1}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ต่อครั้ง</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value2}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ทรัพย์สินต่อครั้ง</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value2}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ชดเชยความผิดส่วนแรก</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value4}}</td>
            @endforeach
          </tr>
          <tr>

            <th  colspan="{{count($chunk)+1}}" style="background-color:white">
               ทุนประกันรถยนต์
            </th>
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ความเสียหาย</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value3}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ไฟไหม้/สูญหาย</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value7}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">น้ำท่วม</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value14}}</td>
            @endforeach
          </tr>
          <tr>
            <th  colspan="{{count($chunk)+1}}" style="background-color:white">
               ความคุ้มครองต่อบุคคล
            </th>
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">จำนวนคน</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value19}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">อุบัติเหตุส่วนบุคคล</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value8}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ค่ารักษาพยาบาล</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value12}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ค่าประกันตัว</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value13}}</td>
            @endforeach
          </tr>
          <tr>
            <th  colspan="{{count($chunk)+1}}" style="background-color:white">
               ค่าเบี้ยประกัน
            </th>
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">เบียสุทธิ</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_payment_value1}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">อากรแสตมป์</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_payment_value2}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ภาษีมูลค่าเพิ่ม</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_payment_value3}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ยอดสุทธิ</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_payment_value4}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ส่วนลดพิเศษ</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_payment_value15}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ราคาจ่ายจริง (เฉพาะชำระเงินสด)</th>
            @foreach($chunk as $findof)
            @php
            $result = $findof->offer_payment_value4- $findof->offer_payment_value15;
            @endphp
            <td class="table">{{$result}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">หมายเหตุ</th>
            @foreach($chunk as $findof)
            <td class="table">{{$findof->offer_value18}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">พรบ หน้าตั๋ว</th>
            @foreach($chunk as $findof)
            @php
            $offeract = App\Offer::with(['promotion','campaign','OfferType','match_id','Person','branch','proposal'])->where('ref_member_id',$findof->ref_member_id)->where('interest',1)->where('type_id',7)->value('offer_payment_value4');
            @endphp
            <td class="table">{{$offeract}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ราคาจ่ายจริง (พรบ/เฉพาะเงินสด)</th>
            @foreach($chunk as $findof)
            @php
            $offeract4 = App\Offer::with(['promotion','campaign','OfferType','match_id','Person','branch','proposal'])->where('ref_member_id',$findof->ref_member_id)->where('interest',1)->where('type_id',7)->value('offer_payment_value4');
            $offeract15 = App\Offer::with(['promotion','campaign','OfferType','match_id','Person','branch','proposal'])->where('ref_member_id',$findof->ref_member_id)->where('interest',1)->where('type_id',7)->value('offer_payment_value15');

            $resultact = $offeract4- $offeract15;
            @endphp
            <td class="table">{{$resultact}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">ราคาชำระค่าภาษี</th>
            @foreach($chunk as $findof)
            @php
            $offeract4 = App\Offer::with(['promotion','campaign','OfferType','match_id','Person','branch','proposal'])->where('ref_member_id',$findof->ref_member_id)->where('interest',1)->where('type_id',8)->value('offer_payment_value4');
            $offeract15 = App\Offer::with(['promotion','campaign','OfferType','match_id','Person','branch','proposal'])->where('ref_member_id',$findof->ref_member_id)->where('interest',1)->where('type_id',8)->value('offer_payment_value15');

            $resulttax = $offeract4- $offeract15;
            @endphp
            <td class="table">{{$resulttax}}</td>
            @endforeach
          </tr>
          <tr>
            <th class="table"style="background-color:#dedee3;text-align:left; ">เบี้ยที่ต้องชำระรวม</th>
            @foreach($chunk as $findof)
            @php
            $allresult = ($result+$resultact)+$resulttax;
            @endphp
            <td class="table">{{$allresult}}</td>
            @endforeach
          </tr>
        </table>
        <br />
        <table class="table">
          <tr>
            <td style="text-align:center">
              ทั้งนี้หากท่านมีข้อสงสัยประการใดเพิ่มเติมสามารถสอบถามข้อมูลเพิ่มเติมได้ที่ผู้ประสานงานของเรา {{$coorname}} {{$coormobile}} หรือติดต่อได้ที่ Call Center 02-539-2798 ต่อ 2 ทางทีมงานของเรามีความยินดีเป็นอย่างยิ่งที่ได้รับโอกาสในการเสนอราคาให้แก่ท่าน และหวังเป็นอย่างยิ่งว่าเราจะได้รับโอกาสในการให้บริการท่าน
            </td>
          </tr>
        </table>
        <div class="page-break"></div>

        @endforeach


  </body>

</html>
