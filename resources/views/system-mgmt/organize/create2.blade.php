@extends('system-mgmt.organize.base')

@section('action-content')
  <style>
  * {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 25%;
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
  </style>
<div class="container">
    <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">Add new organize</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('organize.store') }}">
                        {{ csrf_field() }}
                        <h3>ข้อมูลทั่วไปเกี่ยวกับบริษัท</h3>
                        <div class="row">
                          <div class="column">

                            <label for="name" class=""></label>


                                <input id="name" type="text" class="form-control" name="name" placeholder="ชื่อบริษัท"  value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                      </div>
                      <div class="column">

                            <label for="id_num" class=""></label>


                                <input id="id_num" type="id_num" class="form-control" name="id_num" placeholder="เลขที่นิติบุคคล"value="{{ old('id_num') }}" required>

                                @if ($errors->has('id_num'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>



                        <div class="column">


                            <label for="name" class=""></label>


                                <input id="gender" type="text" class="form-control" name="gender" placeholder="ประเภทนิติบุคคล" value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                        </div>
                        <div class="column">


                              <label for="email" class=""></label>


                                  <input id="mobile" type="mobile" class="form-control" name="mobile" placeholder="วันที่จดทะเบียนจัดตั้งบริษัท" value="{{ old('mobile') }}" required>

                                  @if ($errors->has('mobile'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('mobile') }}</strong>
                                      </span>
                                  @endif

                      </div>
                  </div>

                  <div class="row">
                    <div class="column">


                          <label for="email" class=""></label>


                              <input id="mobile" type="mobile" class="form-control" name="mobile" placeholder="บริษัทสัญชาติ" value="{{ old('mobile') }}" required>

                              @if ($errors->has('mobile'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('mobile') }}</strong>
                                  </span>
                              @endif


                    </div>
                    <div class="column">


                          <label for="email" class=""></label>


                              <input id="mobile" type="mobile" class="form-control" name="mobile" placeholder="ประเภทธุรกิจ" value="{{ old('mobile') }}" required>

                              @if ($errors->has('mobile'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('mobile') }}</strong>
                                  </span>
                              @endif


                  </div>



                    <div class="column">


                          <label for="email" class=""></label>


                              <input id="mobile" type="mobile" class="form-control" name="mobile" placeholder="เบอร์โทรออฟฟิศสำนักงาน"value="{{ old('mobile') }}" required>

                              @if ($errors->has('mobile'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('mobile') }}</strong>
                                  </span>
                              @endif

                      </div>

                          <div class="column">

                                <label for="name" class=""></label>



                                <input id="gender" type="textarea" class="form-control" name="gender" placeholder="ข้อมูลผู้ติดต่อ"value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                      </div>
                  </div>
                  <h3>ข้อมูลที่ตั้งบริษัท</h3>
                  <div class="row">

                    <div class="column">


                            <label for="name" class=""></label>


                                <input id="gender" type="textarea" class="form-control" placeholder="ที่ตั้งบริษัทเลขที่" name="gender" value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                      </div>

                          <div class="column">

                                <label for="name" class=""></label>



                                <input id="gender" type="textarea" class="form-control" name="gender" placeholder="ตรอก/ซอย" value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                      </div>

                    <div class="column">


                            <label for="name" class=""></label>


                                <input id="gender" type="textarea" class="form-control" name="gender" placeholder="ถนน" value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                      </div>
                          <div class="column">


                            <label for="name" class=""></label>


                                <input id="gender" type="textarea" class="form-control" name="gender" placeholder="แขวง" value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                      </div>
                  </div>

                  <div class="row">
                    <div class="column">


                            <label for="name" class=""></label>


                                <input id="gender" type="textarea" class="form-control" name="gender" placeholder="เขต"value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                        </div>
                        <div class="column">


                            <label for="name" class=""></label>


                                <input id="gender" type="textarea" class="form-control" name="gender" placeholder="จังหวัด" value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif

                        </div>

                          <div class="column">


                            <label for="name" class=""></label>


                                <input id="gender" type="textarea" class="form-control" name="gender" placeholder="ประเทศ" value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif


                        </div>
                        <div class="column">


                            <label for="email" class=""></label>


                                <input id="mobile" type="mobile" class="form-control" name="mobile" placeholder="หมายเลขไปรษณีย์" value="{{ old('mobile') }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif

                        </div>
                        </div>
                          <h3>ข้อมูลบัญชีในการเข้าใช้ระบบ</h3>

                        <div class="row">
                          <div class="column">

                            <label for="email" class=""></label>


                                <input id="email" type="email" class="form-control" name="email" placeholder="อีเมลล์สำหรับเข้าใช้งานระบบ" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>
                        <div class="column">



                            <label for="password" class=""></label>


                                <input id="password" type="password" class="form-control" placeholder="รหัสผ่านสำหรับเข้าใช้งานระบบ" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                          <div class="column">


                            <label for="password-confirm" class=""></label>


                                <input id="password-confirm" type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="password_confirmation" required>

                        </div>
                        </div>



                        <br>
                        <input type="hidden"id="created_by" type="text" class="form-control" name="created_by"  @foreach($currentid as $current) value="{{ $current->id}}"  @endforeach>
                        <div class="form-group">
                            <div >
                                <button type="submit" class="btn btn-primary btn-margin">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
