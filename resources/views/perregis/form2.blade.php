<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Register</title>
	 <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  * {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
   /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .column {
      width: 100%;
    }
}
  .container2 {
    display: inline-block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 15px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container2 input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #BDBDB9;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container2:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container2 input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container2 input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container2 .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}

  .form-control{
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;

  }
	  .form-control2{
    padding: 10px;
    width: 100%;

    font-family: Raleway;
    border: 1px solid #aaaaaa;

  }
  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }
  body {
    background-image: url(../img/home4.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  }
  h2,
  h4 {
  	margin-top: 0;
  }
  .form {

  	background: #ffffff;
  	box-shadow: 0 5px 10px rgba(0, 0, 0, .4);
  	margin: 4em;
  	min-width: 480px;
  	padding: 1em;
    border: 5px solid #FFFFFF;
   border-radius: 12px;
  }
 .wizard {
    margin: 20px auto;
    background: #fff;
}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #3e5e9a;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #3e5e9a;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #3e5e9a;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#3e5e9a;

}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #999;

}
.wizard li.active span.round-tab i{
    color: #999;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 25%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }

}
  </style>
 </head>
 <body>
   <nav class="navbar navbar-default navbar-static-top navbar-dark" style="background-color: #00325d;">
       <div class="container">
           <div class="navbar-header">

               <!-- Collapsed Hamburger -->
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                   <span class="sr-only">Toggle Navigation</span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
               </button>

               <!-- Branding Image -->
               <a class="navbar-brand" href="https://wealththai.co.th">
                 <img style="max-width:100px; margin-top: -5px;"
                 src="{{url('../')}}/img/logo.png">
               </a>
           </div>

           <div class="collapse navbar-collapse" id="app-navbar-collapse">
               <!-- Left Side Of Navbar -->
               <ul class="nav navbar-nav">
                   &nbsp;
               </ul>

               <!-- Right Side Of Navbar -->
               <div class="nav navbar-nav navbar-right">
             <a class="navbar" style="color:#FFFFFF" href="https://wealththai.co.th">
             Back to main website
             </a>
           </div>
           </div>
       </div>
   </nav>


<!------ Include the above in your HEAD tag ---------->



<div class="form">

<div class="container">

	<div class="row">
		<section>


        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Account Info">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-home"></i>

                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="General Info">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>

                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Detail Info">
                            <span class="round-tab">
                              <i class="glyphicon glyphicon-pencil"></i>

                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Career Info">
                            <span class="round-tab">

                                <i class="glyphicon glyphicon-briefcase"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            @if(count($errors)>0)

                @foreach($errors->all() as $error)
                  <li style="list-style-type:none;" class="alert alert-danger">{{$error}}</li>

                @endforeach

            @endif
            <form role="form" method="POST" action="{{ route('perregis.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="tab-content">


                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h3>Account Information</h3>
						<p style="color:red">ช่องที่มี * หมายถึงจำเป็นต้องใส่</p>
						<label ><span style="color:red">* </span> E-mail</label>
                        <p><input class="form-control" placeholder="E-mail..."  name="email"></p>


								<label ><span style="color:red">* </span> Password</label>
                          <p><input placeholder="Password..."  id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required></p>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif



						<label ><span style="color:red">* </span> Confirm Password</label>

                        <p><input placeholder="Password Confirm..." id="password-confirm" type="password" class="form-control" name="password_confirmation" required></p>





                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <h3>General Information</h3>
						<p style="color:red">ช่องที่มี * หมายถึงจำเป็นต้องใส่</p>

                        <label class="container2">นาย(Mr.)
                          <input type="radio" checked="checked" name="gender" value="นาย(Mr.)">
                          <span class="checkmark"></span>
                        </label>
                        <label class="container2">นาง(Mrs.)
                          <input type="radio"  name="gender" value="นาง(Mrs.)" >
                          <span class="checkmark"></span>
                        </label>
                        <label class="container2">นางสาว(Ms.)
                          <input type="radio"  name="gender" value="นางสาว(Ms.)">
                          <span class="checkmark"></span>
                        </label>
                        <br>

                            <div class="row">
                              <div class="column">
								  <label ><span style="color:red">* </span> ชื่อจริง</label>
                        <p><input class="form-control"placeholder="ชื่อจริง..."  name="name"></p>
                        </div>
                        <div class="column">
							<label ><span style="color:red">* </span> นามสกุล</label>
                        <p><input class="form-control"placeholder="นามสกุล..."  name="lname"></p>
                          </div>
                        </div>
                        <div class="row">
                            <div class="column">
								<label ><span style="color:red">* </span> Eng name</label>
                        <p><input class="form-control"placeholder="Eng name..."   name="Eng_name"></p>
                          </div>
                          <div class="column">
							  <label ><span style="color:red">* </span> Eng Lastname</label>
                        <p><input class="form-control"placeholder="Eng Lastname..."   name="Eng_lastname"></p>
                          </div>
                          </div>
                          <div class="row">
                              <div class="column">
							<label ><span style="color:red">* </span> Nickname</label>
              <p><input class="form-control"placeholder="ชื่อเล่น/Nickname"   name="nickname"></p>

                        </div>
                          <div class="column">
							  <label ><span style="color:red">* </span> หมายเลขโทรศัพท์/Phone Number</label>
                          <p><input class="form-control"placeholder="หมายเลขโทรศัพท์/Phone Number"   name="phone"></p>
                        </div>
                        </div>
                        <div class="row">
                          <div class="column">
							  <label ><span style="color:red">* </span> หมายเลขโทรศัพท์มือถือ/Mobile Phone</label>
                          <p><input class="form-control"placeholder="หมายเลขโทรศัพท์มือถือ/Mobile Phone"   name="mobile"></p>
                        </div>
                            <div class="column">
								<label ><span style="color:red">* </span> หมายเลขบัตรประชาชน/Passport ID</label>
                          <p><input class="form-control"placeholder="หมายเลขบัตรประชาชน/Passport ID"   name="id_num"></p>
                        </div>

                        </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>

                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>Details Information (Opt but need if want to open Acc)</h3>
                        <div class="row">
                            <div class="column">
                         <label for="citizen_issued_date">วันที่ออกบัตรประชาชน</label>
                         <br>
                         <input  style="width:30%;display: inline;" class="form-control" name="citiisd"size="4"  placeholder="วันที่"  />
                         -

                           <input  style="width:30%;display: inline;"class="form-control" name="citiism"  size="4" placeholder="เดือนที่" />
                         -
                         <input type="text" style="width:30%;display: inline;"class="form-control" name="citiisy"  size="4" placeholder="ปี ค.ศ." >
                      </div>
                        <div class="column">
                        <label for="citizen_issued_date">วันที่หมดอายุบัตรประชาชน</label>
                        <br>
                        <input  style="width:30%;display: inline;" class="form-control" name="citiexd"size="4"  placeholder="วันที่"  />
                        -

                          <input  style="width:30%;display: inline;"class="form-control" name="citiexm"  size="4" placeholder="เดือนที่"/>
                        -
                        <input type="text" style="width:30%;display: inline;"class="form-control" name="citiexy"  size="4" placeholder="ปี ค.ศ." >
                      </div>
                    </div>


                    <div class="row">
                        <div class="column">
							<label for="dob">วันเกิด</label>
              <br>
              <input  style="width:30%;display: inline;" class="form-control" name="sd"size="4"  placeholder="วันที่" />
              -

                <input  style="width:30%;display: inline;"class="form-control" name="sm"  size="4" placeholder="เดือนที่" />
-
              <input type="text" style="width:30%;display: inline;"class="form-control" name="sy"  size="4" placeholder="ปี ค.ศ." >

                      </div>
                          <div class="column">
							  <label for="Religion">ศาสนา</label>
                            <p><input class="form-control"placeholder="ศาสนา (Religion) "   name="religion"></p>
                    </div>
                      </div>

                      <div class="row">
                          <div class="column">
							  <label for="Religion">สัญชาติ</label>
                        <p><input class="form-control"placeholder="สัญชาติ (Nationality)"   name="nationality"></p>

                      </div>
                        <div class="column">
							<label for="Religion">เชื้อชาติ</label>
                          <p><input class="form-control"placeholder="เชื้อชาติ (Race/Ethnicity)"   name="race"></p>
                        </div>
                      </div>

                          <h4>ที่อยู่ตามทะเบียนบ้าน (Residence in Passport)</h4>
                          <div class="row">
                              <div class="column">
                          <p><input class="form-control" placeholder="บ้านเลขที่ (Address)"   name="add1"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="ตรอก/ซอย(Soi)"   name="add1_alley"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="ถนน(Road)"   name="add1_road"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="แขวง(Sub District)"   name="add1_subdistrict"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="เขต(District)"   name="add1_district"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control" placeholder="จังหวัด (Province/State)"   name="add1_city"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="ประเทศ(Country)"   name="add1_country"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="หมายเลขไปรษณีย์ (Post ID)"   name="add1_postcode"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="เบอร์โทรศัพท์ติดต่อ(Tel No.)"   name="add1_tel"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="Fax"   name="add1_fax"></p>
                        </div>
                      </div>
                          <h4>ที่อยู่ปัจจุบัน (Present Residence)</h4>
                          <div class="row">
                              <div class="column">
                          <p><input class="form-control"placeholder="บ้านเลขที่ (Address)"   name="add2"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="ตรอก/ซอย(Soi)"   name="add2_alley"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="ถนน(Road)"   name="add2_road"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="แขวง(Sub District)"   name="add2_subdistrict"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="เขต(District)"   name="add2_district"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="จังหวัด (Province/State)"   name="add2_city"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="ประเทศ(Country)"   name="add2_country"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="หมายเลขไปรษณีย์ (Post ID)"   name="add2_postcode"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="เบอร์โทรศัพท์ติดต่อ(Tel No.)"   name="add2_tel"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="Fax"   name="add2_fax"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="ที่อยู่จัดส่งเอกสาร (เอาตามที่ปัจจุบัน/ทะเบียนบ้าน) (Document Delivery Residence)"   name="add2_sentdoc"></p>
                        </div>
                      </div>
                          <h4>ข้อมูลบัญชีเบื้องต้น</h4>
                          <p>ข้อมูลบัญชี ATS (บัญชีที่ต้องการผูกกับบัญชีซื้อขายหลักทรัพย์) (ATS Bank Account)</p>
                          <div class="row">
                              <div class="column">
                          <p><input class="form-control"placeholder="ธนาคาร(Bank) "   name="bank"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="สาขา(Branch)"   name="branch"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="หมายเลขบัญชี(Bank Account Number)"   name="bankaccount"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="ชื่อบัญชี(Account Name)"   name="bank_account_name"></p>
                        </div>
                      </div>
                          <h4>สถานะปัจจุบัน</h4>

                          <label class="container2">โสด/Single
                            <input type="radio" checked="checked" name="couple" value="โสด/Single">
                            <span class="checkmark"></span>
                          </label>
                          <label class="container2">แต่งงาน/Married
                            <input id="myCheck"type="radio"  name="couple" onclick="myFunction()" value="แต่งงาน/Married">
                            <span class="checkmark"></span>
                          </label>
                          <label class="container2">หย่าร้าง/ divorced
                            <input type="radio" name="couple" value="หย่าร้าง/ divorced">
                            <span class="checkmark"></span>
                          </label>




                          <div id="text" style="display:none">
                            <h4>ข้อมูลคู่สมรส(กรณีแต่งงานแล้ว) Couple Information (if Married)</h4>
                            <div class="row">
                                <div class="column">
                          <p><input class="form-control"placeholder="ชื่อ  (Name)"   name="couple_name"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="นามสกุล (Surname)"   name="couple_lname"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control" placeholder="อาชีพ (occupation)"   name="couple_job"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="ตำแหน่ง (position)"   name="couple_position"></p>
                        </div>
                      </div>
                      <div class="row">
                          <div class="column">
                          <p><input class="form-control"placeholder="เบอร์โทรศัพท์ (Tel No.)"   name="couple_phone"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="เบอร์โทรศัพท์มือถือ (Mobile Phone)"   name="couple_mobile"></p>
                        </div>
                      </div>
                        </div>

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Career Information (Opt but need if want to open Acc.)</h3>
                        <p style="color:red">กรณีต้องการเปิดบัญชีซื้อขายหลักทรัพย์หรืออนุพันธ์ หรือต้องการใช้บริการในส่วนของการจัดหางานและศึกษาต่อ กรุณากรอกข้อมูลดังต่อไปนี้</p>
                        <div class="row">
                            <div class="column">
                        <p><input class="form-control"placeholder="ชื่อสถานที่ทำงาน/Organization Name"   name="company"></p>
                      </div>
                        <div class="column">
                        <p><input class="form-control"placeholder="ตำแหน่ง/Position"   name="position"></p>
                      </div>
                        </div>
                        <div class="row">
                            <div class="column">
                        <p><input class="form-control"placeholder="ประเภทธุรกิจ/Type Of Business"   name="type_business"></p>
                      </div>
                        <div class="column">

                          <p><input class="form-control"placeholder="อาชีพ(Occupation)"   name="occupation"></p>
                        </div>
                          </div>
                          <div class="row">
                              <div class="column">
                          <p><input class="form-control"placeholder="อายุการทำงาน(ปี)/Experience(Year) "   name="work_experience"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="ที่อยู่บริษัทเลขที่(Address)"   name="com_add_no"></p>
                        </div>
                          </div>
                          <div class="row">
                              <div class="column">
                          <p><input class="form-control"placeholder="ตรอก/ซอย(Soi) "   name="com_add_alley"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control" placeholder="ถนน(Road)"   name="com_add_road"></p>
                        </div>
                          </div>
                          <div class="row">
                              <div class="column">
                          <p><input class="form-control"placeholder="แขวง(Sub District)"   name="com_add_subdistrict"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="เขต(District)"   name="com_add_district"></p>
                        </div>
                          </div>

                          <div class="row">
                              <div class="column">
                          <p><input class="form-control"placeholder="จังหวัด(Province)"   name="com_add_city"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="ประเทศ(Country)"   name="com_add_country"></p>
                        </div>
                          </div>
                          <div class="row">
                              <div class="column">
                          <p><input class="form-control"placeholder="หมายเลขไปรษณีย์(Postcode) "   name="com_add_postcode"></p>
                        </div>
                          <div class="column">
                          <p><input class="form-control"placeholder="เบอร์โทรศัพท์ติดต่อ(Tel No.)"   name="com_tel"></p>
                        </div>
                          </div>
                         <div class="row">
                              <div class="column">
                          <p><input class="form-control"placeholder="Fax"   name="com_fax"></p>
                        </div>
                        <div class="column">
                        <div class="g-recaptcha" data-sitekey="6LeaX2oUAAAAANi4r0XLv0VpixCxfl6s_LXooZxw"></div>
                        @if($errors->has('g-recaptcha-response'))
                            <span class="invalid-feedback" style="display:block">
                              <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                            </span>
                        @endif
                      </div>
                          </div>




                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                            <li><button type="submit" class="btn btn-primary">
                                Save
                            </button></li>
                          {{--  <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>--}}
                        </ul>
                    </div>

                    {{--<div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Complete</h3>
                        <p>You have successfully completed all steps.</p>
                    </div>--}}
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
   </div>
</div>
</div>
<script>
function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
       text.style.display = "none";
    }
}
</script>
 </body>
</html>

<script>
$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
</script>
