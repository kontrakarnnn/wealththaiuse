@extends('person.base')
@section('action-content')
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
.column2 {
  float: left;
  width: 40.5%;
  padding:10px;
  margin-left: -2%;
 /* Should be removed. Only for demonstration */
}
.column3 {
  float: left;
  padding: 10px;
  width: 11.5%;
 /* Should be removed. Only for demonstration */
}
.column4 {
  float: left;
  padding: 10px;
  width: 50%;
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
  .column2 {
    width: 68%;
    margin-left: -8%;
  }
  .column3 {
    width: 40%;
  }
  .column4 {
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
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

h2,
h4 {
  margin-top: 0;
}
.form {

  background: #ffffff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, .4);



  border: 5px solid #FFFFFF;
 border-radius: 12px;
}
.wizard {
   border-radius: 12px;
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
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EM | Empployee Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
   <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
   <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('layouts.headerper')
  <!-- Sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/avatar5.png") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="/person"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
		  <li class="active"><a href="/system-management/notiper"><i class="fa fa-link"></i> <span>Notification</span></a></li>
  <li class="treeview">
          <a class="active" href="/profile/{{ $per->name}}"><i class="fa fa-link"></i><span>Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/profile/{{ $per->name}}"><i class="fa fa-link"></i><span>View Profile</span></a></li>
            <li class="active"><a href="/edit/{{ $per->name}}"><i class="fa fa-link"></i><span>Edit Profile</span></a></li>
			<li class="active"><a href="/password/reset"><i class="fa fa-link"></i><span>Change Password</span></a></li>

            </ul>
            </li>
        <li class="active"><a href="/show"><i class="fa fa-link"></i><span>My Portfolio</span></a></li>


        <li class="active"><a href='#'><i class="fa fa-link"></i><span>Scholarship (Comingsoon)</span></a></li>
        <li class="active"><a href="#"><i class="fa fa-link"></i><span>Job Seeker (Comingsoon)</span></a></li>
        <li class="active"><a href="/logout"><i class="fa fa-link"></i><span>Logout</span></a></li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>

    <section class="content">





    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Main Header -->


  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content">





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
                              <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Education Info">
                                  <span class="round-tab">

                                      <i class="glyphicon glyphicon-briefcase"></i>
                                  </span>
                              </a>
                          </li>
                      </ul>
                  </div>

                  @if(isset($per))
            {{Form::open(['method' => 'put', 'route' => ['perregis.update',$per->id]])}}
          @else
            {{Form::open(['url'=>'perregis']) }}
          @endif
          <div class="panel-body">


            @if (count($errors) > 0)
              <div class ="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>

              </div>
            @endif

                      <div class="tab-content">


                          <div class="tab-pane active" role="tabpanel" id="step1">
                              <h3>Account Information</h3>
                              <p><input value="{{ $per->email }}" class="form-control" placeholder="E-mail..."  name="email"></p>









                              <ul class="list-inline pull-right">
                                  <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                              </ul>
                          </div>
                          <div class="tab-pane" role="tabpanel" id="step2">
                              <h3>General Information</h3>


                                  <div class="row">
                                    <div class="column3">
                                      <select  name="gender" class="form-control" value="{{$per->gender}}">
                                        <option>{{$per->gender}}</option>
                                        <option>นาย(Mr.)</option>
                                        <option>นาง(Mrs.)</option>
                                        <option>นางสาว(Ms.)</option>


                                    </select>
                              </div>
                                    <div class="column2">

                              <p><input value="{{ $per->name }}"class="form-control"placeholder="ชื่อจริง..."  name="name"></p>
                              </div>
                              <div class="column4">
                              <p><input value="{{ $per->lname }}"class="form-control"placeholder="นามสกุล..."  name="lname"></p>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="column">
                              <p><input value="{{ $per->Eng_name }}"class="form-control"placeholder="Eng name..."   name="Eng_name"></p>
                                </div>
                                <div class="column">
                              <p><input value="{{ $per->Eng_lastname }}"class="form-control"placeholder="Eng Lastname..."   name="Eng_lastname"></p>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="column">

                                <p><input value="{{ $per->phone }}"class="form-control"placeholder="หมายเลขโทรศัพท์/Phone Number"   name="phone"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->mobile }}"class="form-control"placeholder="หมายเลขโทรศัพท์มือถือ/Mobile Phone"   name="mobile"></p>
                              </div>
                              </div>
                              <div class="row">
                                  <div class="column">
                                <p><input value="{{ $per->id_num }}"class="form-control"placeholder="หมายเลขบัตรประชาชน/Passport ID"   name="id_num"></p>
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
                                    <label for="citizen_issued_date">citizen issued date</label>
                                    @if(isset($per->citizen_issued_date))
                                    {{Form::date('citizen_issued_date',$per->citizen_issued_date,['class'=> 'form-control'])}}
                                    @else
                                    {{Form::date('citizen_issued_date','',['class'=> 'form-control','placeholder'=>'วันที่ออกบัตรประชาชน / Citizen,Passport  Issued Date ' ] ,['placeholder' => 'Pick a size...'])}}
                                  @endif
                            </div>
                              <div class="column">
                                <label for="citizen_issued_date">citizen expire date</label>
                                @if(isset($per->citizen_expire_date))
                                {{Form::date('citizen_expire_date',$per->citizen_expire_date,['class'=> 'form-control'])}}
                                @else
                                {{Form::date('citizen_expire_date','',['class'=> 'form-control' ])}}
                              @endif

                            </div>
                          </div>


                          <div class="row">
                              <div class="column">
								  <label for="dob">Date Of Birth</label>
                                @if(isset($per->dob))
                                {{Form::date('dob',$per->dob,['class'=> 'form-control'])}}
                                @else
                                {{Form::date('dob','',['class'=> 'form-control' ])}}
                              @endif

                            </div>
                                <div class="column">
									<label for="religion">Religion</label>
                                  <p><input value="{{ $per->religion }}"class="form-control"placeholder="ศาสนา (Religion) "   name="religion"></p>
                          </div>
                            </div>

                            <div class="row">
                                <div class="column">
                              <p><input value="{{ $per->nationality }}"class="form-control"placeholder="สัญชาติ (Nationality)"   name="nationality"></p>

                            </div>
                              <div class="column">
                                <p><input value="{{ $per->race }}"class="form-control"placeholder="เชื้อชาติ (Race/Ethnicity)"   name="race"></p>
                              </div>
                            </div>

                                <h4>ที่อยู่ตามทะเบียนบ้าน (Residence in Passport)</h4>
                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->add1 }}"class="form-control" placeholder="บ้านเลขที่ (Address)"   name="add1"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add1_alley }}"class="form-control"placeholder="ตรอก/ซอย(Soi)"   name="add1_alley"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add1_road }}"class="form-control"placeholder="ถนน(Road)"   name="add1_road"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add1_subdistrict }}"class="form-control"placeholder="แขวง(Sub District)"   name="add1_subdistrict"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add1_district }}"class="form-control"placeholder="เขต(District)"   name="add1_district"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add1_city }}"class="form-control" placeholder="จังหวัด (Province/State)"   name="add1_city"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add1_country }}"class="form-control"placeholder="ประเทศ(Country)"   name="add1_country"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add1_postcode }}"class="form-control"placeholder="หมายเลขไปรษณีย์ (Post ID)"   name="add1_postcode"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add1_tel }}"class="form-control"placeholder="เบอร์โทรศัพท์ติดต่อ(Tel No.)"   name="add1_tel"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add1_fax }}"class="form-control"placeholder="Fax"   name="add1_fax"></p>
                              </div>
                            </div>
                                <h4>ที่อยู่ปัจจุบัน (Present Residence)</h4>
                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->add2 }}"class="form-control"placeholder="บ้านเลขที่ (Address)"   name="add2"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add2_alley }}"class="form-control"placeholder="ตรอก/ซอย(Soi)"   name="add2_alley"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add2_road }}"class="form-control"placeholder="ถนน(Road)"   name="add2_road"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add2_subdistrict }}"class="form-control"placeholder="แขวง(Sub District)"   name="add2_subdistrict"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add2_district }}"class="form-control"placeholder="เขต(District)"   name="add2_district"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add2_city }}"class="form-control"placeholder="จังหวัด (Province/State)"   name="add2_city"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add2_country }}"class="form-control"placeholder="ประเทศ(Country)"   name="add2_country"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add2_postcode }}"class="form-control"placeholder="หมายเลขไปรษณีย์ (Post ID)"   name="add2_postcode"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add2_tel }}"class="form-control"placeholder="เบอร์โทรศัพท์ติดต่อ(Tel No.)"   name="add2_tel"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->add2_fax }}"class="form-control"placeholder="Fax"   name="add2_fax"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->add2_sentdoc }}"class="form-control"placeholder="ที่อยู่จัดส่งเอกสาร (เอาตามที่ปัจจุบัน/ทะเบียนบ้าน) (Document Delivery Residence)"   name="add2_sentdoc"></p>
                              </div>
                            </div>
                                <h4>ข้อมูลบัญชีเบื้องต้น</h4>
                                <p>ข้อมูลบัญชี ATS (บัญชีที่ต้องการผูกกับบัญชีซื้อขายหลักทรัพย์) (ATS Bank Account)</p>
                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->bank }}"class="form-control"placeholder="ธนาคาร(Bank) "   name="bank"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->branch }}"class="form-control"placeholder="สาขา(Branch)"   name="branch"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->bankaccount }}"class="form-control"placeholder="หมายเลขบัญชี(Bank Account Number)"   name="bankaccount"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->bank_account_name }}"class="form-control"placeholder="ชื่อบัญชี(Account Name)"   name="bank_account_name"></p>
                              </div>
                            </div>
                                <h4>สถานะปัจจุบัน</h4>




                                <select  name="couple" value="{{$per->couple}}">
                                  <option>{{$per->couple}}</option>
                                  <option>โสด/Single</option>
                                  <option>แต่งงาน/Married</option>
                                  <option>หย่าร้าง/ divorced</option>


                              </select>

                                <div id="text" >
                                  <h4>ข้อมูลคู่สมรส(กรณีแต่งงานแล้ว) Couple Information (if Married)</h4>
                                  <div class="row">
                                      <div class="column">
                                <p><input value="{{ $per->couple_name }}" class="form-control"placeholder="ชื่อ  (Name)"   name="couple_name"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->couple_lname }}"class="form-control"placeholder="นามสกุล (Surname)"   name="couple_lname"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->couple_job }}"class="form-control" placeholder="อาชีพ (occupation)"   name="couple_job"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->couple_position }}"class="form-control"placeholder="ตำแหน่ง (position)"   name="couple_position"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                <p><input value="{{ $per->couple_phone }}"class="form-control"placeholder="เบอร์โทรศัพท์ (Tel No.)"   name="couple_phone"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->couple_mobile }}"class="form-control"placeholder="เบอร์โทรศัพท์มือถือ (Mobile Phone)"   name="couple_mobile"></p>
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
                              <p style="color:red">กรณีต้องการเปิดบัญชีซื้อขายหลักทรัพย์หรืออนุพันธ์ หรือต้องการใช้บริการในส่วนของการจัดหางานและศึกษาต่อ กรุณากรอกข้อมูลดังต่อไปนี้)</p>
                              <div class="row">
                                  <div class="column">
                              <p><input value="{{ $per->company }}"class="form-control"placeholder="ชื่อสถานที่ทำงาน/Organization Name"   name="company"></p>
                            </div>
                              <div class="column">
                              <p><input value="{{ $per->position }}"class="form-control"placeholder="ตำแหน่ง/Position"   name="position"></p>
                            </div>
                              </div>
                              <div class="row">
                                  <div class="column">
                              <p><input value="{{ $per->type_business }}"class="form-control"placeholder="ประเภทธุรกิจ/Type Of Business"   name="type_business"></p>
                            </div>
                              <div class="column">

                                <p><input value="{{ $per->occupation }}"class="form-control"placeholder="อาชีพ(Occupation)"   name="occupation"></p>
                              </div>
                                </div>
                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->work_experience }}"class="form-control"placeholder="อายุการทำงาน(ปี)/Experience(Year) "   name="work_experience"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->com_add_no }}"class="form-control"placeholder="ที่อยู่บริษัทเลขที่(Address)"   name="com_add_no"></p>
                              </div>
                                </div>
                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->com_add_alley }}"class="form-control"placeholder="ตรอก/ซอย(Soi) "   name="com_add_alley"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->com_add_road }}"class="form-control" placeholder="ถนน(Road)"   name="com_add_road"></p>
                              </div>
                                </div>
                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->com_add_subdistrict }}"class="form-control"placeholder="แขวง(Sub District)"   name="com_add_subdistrict"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->com_add_district }}"class="form-control"placeholder="เขต(District)"   name="com_add_district"></p>
                              </div>
                                </div>

                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->com_add_city }}"class="form-control"placeholder="จังหวัด(Province)"   name="com_add_city"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->com_add_country }}"class="form-control"placeholder="ประเทศ(Country)"   name="com_add_country"></p>
                              </div>
                                </div>
                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->com_add_postcode }}"class="form-control"placeholder="หมายเลขไปรษณีย์(Postcode) "   name="com_add_postcode"></p>
                              </div>
                                <div class="column">
                                <p><input value="{{ $per->com_tel }}"class="form-control"placeholder="เบอร์โทรศัพท์ติดต่อ(Tel No.)"   name="com_tel"></p>
                              </div>
                                </div>
                                <div class="row">
                                    <div class="column">
                                <p><input value="{{ $per->com_fax }}"class="form-control"placeholder="Fax"   name="com_fax"></p>
                              </div>
                                </div>
                              <ul class="list-inline pull-right">
                                  <li><button type="button" class="btn btn-default prev-step">Previous</button></li>

                                  <li><button type="submit" class="btn btn-primary">
                                      Update
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





  </div>


        </div>

      </div>
    </section>


          </div>
  @include('layouts.footer-per')


  <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>

  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
       Both of these plugins are recommended to enhance the
       user experience. Slimscroll is required when using the
       fixed layout. -->

  </body>
  </html>
  <script>
  $(document).ready(function () {
      //Initialize tooltips
      $('.nav-tabs > li a[title]').tooltip();

      //Wizard


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
