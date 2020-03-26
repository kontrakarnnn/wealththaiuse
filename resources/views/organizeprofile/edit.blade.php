@extends('organizeprofile.base')

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


    border: 1px solid #aaaaaa;

  }
	  .form-control2{
    padding: 10px;
    width: 100%;


    border: 1px solid #aaaaaa;

  }
  input {
    padding: 10px;
    width: 100%;


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
                <div class="panel-heading">แก้ไขข้อมูล</div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('organizeprofile.update', ['id' => $person->id]) }}">
                      <input type="hidden" name="_method" value="PATCH">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3>General Information</h3>
                        <div class="row">
                          <div class="column">

                            <label for="name" class="">ชื่อบริษัท</label>


                                <input id="name" type="text" class="form-control" name="name"  value="{{ $person->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                      </div>
                      <div class="column">
                        <label for="name" class="">ประเภทนิติบุคคล</label>


                            <input id="gender" type="text" class="form-control" name="gender" value="{{ $person->gender }}" required autofocus>

                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif

                        </div>



                        <div class="column">
                          <label for="id_num" class="">เลขที่นิติบุคคล</label>


                              <input id="id_num" type="id_num" class="form-control" name="id_num" value="{{ $person->id_num }}" required>

                              @if ($errors->has('id_num'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('id_num') }}</strong>
                                  </span>
                              @endif




                        </div>
                        <div class="column">


                              <label for="email" class="">วันที่จดทะเบียนจัดตั้งบริษัท</label>
                              <br>


                              <input  style="width:30%;display: inline;" class="form-control" name="sd"size="3"  placeholder="วันที่" value="{{$curdate}}"  />
                              -

                                <input  style="width:30%;display: inline;"class="form-control" name="sm"  size="3" placeholder="เดือนที่" value="{{$curmonth}}" />
                              -
                              <input type="text" style="width:30%;display: inline;" class="form-control"name="sy"  size="3" placeholder="ปี ค.ศ." value="{{$curyear}}" >



                      </div>
                  </div>

                  <div class="row">
                    <div class="column">


                          <label for="email" class="">บริษัทสัญชาติ</label>


                              <input id="nationality" type="nationality" class="form-control" name="nationality" value="{{ $person->nationality }}" required>

                              @if ($errors->has('nationality'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('nationality') }}</strong>
                                  </span>
                              @endif


                    </div>
                    <div class="column">


                          <label for="email" class="">ประเภทธุรกิจ</label>


                              <input id="more" type="more" class="form-control" name="more" value="{{ $person->more }}" required>

                              @if ($errors->has('more'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('more') }}</strong>
                                  </span>
                              @endif


                  </div>



                    <div class="column">


                          <label for="email" class="">เบอร์โทรออฟฟิศสำนักงาน</label>


                              <input id="mobile" type="mobile" class="form-control" name="mobile" value="{{ $person->mobile }}" required>

                              @if ($errors->has('mobile'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('mobile') }}</strong>
                                  </span>
                              @endif

                      </div>

                          <div class="column">

                                <label for="name" class="">อีเมลล์ติดต่อ</label>



                                <input id="couple_email" type="text" class="form-control" name="couple_email" value="{{ $person->couple_email }}" required autofocus>

                                @if ($errors->has('couple_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('couple_email') }}</strong>
                                    </span>
                                @endif

                      </div>
                  </div>
                  <h3>Address Information</h3>
                  <div class="row">

                    <div class="column">


                            <label for="name" class="">ที่ตั้งบริษัทเลขที่</label>


                                <input id="add2" type="text" class="form-control" name="add2" value="{{ $person->add2 }}" required autofocus>

                                @if ($errors->has('add2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2') }}</strong>
                                    </span>
                                @endif

                      </div>

                          <div class="column">

                                <label for="add2_alley" class="">ตรอก/ซอย</label>



                                <input id="add2_alley" type="text" class="form-control" name="add2_alley" value="{{ $person->add2_alley }}" required autofocus>

                                @if ($errors->has('add2_alley'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_alley') }}</strong>
                                    </span>
                                @endif

                      </div>

                    <div class="column">


                            <label for="add2_road" class="">ถนน</label>


                                <input id="add2_road" type="text" class="form-control" name="add2_road" value="{{ $person->add2_road }}" required autofocus>

                                @if ($errors->has('add2_road'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_road') }}</strong>
                                    </span>
                                @endif

                      </div>
                          <div class="column">


                            <label for="add2_subdistrict" class="">แขวง</label>


                                <input id="add2_subdistrict" type="text" class="form-control" name="add2_subdistrict" value="{{ $person->add2_subdistrict }}" required autofocus>

                                @if ($errors->has('add2_subdistrict'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_subdistrict') }}</strong>
                                    </span>
                                @endif

                      </div>
                  </div>

                  <div class="row">
                    <div class="column">


                            <label for=" add2_district" class="">เขต</label>


                                <input id=" add2_district" type="text" class="form-control" name=" add2_district" value="{{ $person->add2_district }}" required autofocus>

                                @if ($errors->has(' add2_district'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first(' add2_district') }}</strong>
                                    </span>
                                @endif

                        </div>
                        <div class="column">


                            <label for="add2_city" class="">จังหวัด</label>


                                <input id="add2_cityr" type="text" class="form-control" name="add2_city" value="{{ $person->add2_city }}" required autofocus>

                                @if ($errors->has('add2_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_city') }}</strong>
                                    </span>
                                @endif

                        </div>

                          <div class="column">


                            <label for="add2_country" class="">ประเทศ</label>


                                <input id="add2_country" type="text" class="form-control" name="add2_country" value="{{ $person->add2_country }}" required autofocus>

                                @if ($errors->has('add2_country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_country') }}</strong>
                                    </span>
                                @endif


                        </div>
                        <div class="column">


                            <label for="add2_postcode" class="">หมายเลขไปรษณีย์</label>


                                <input id="add2_postcode" type="text" class="form-control" name="add2_postcode" value="{{ $person->add2_postcode }}" required>

                                @if ($errors->has('add2_postcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_postcode') }}</strong>
                                    </span>
                                @endif

                        </div>
                        </div>
                          <h3>Account Information</h3>

                        <div class="row">
                          <div class="column">

                            <label for="email" class="">อีเมลล์สำหรับเข้าใช้งานระบบ</label>


                                <input id="email" type="email" class="form-control" name="email" value="{{ $person->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>



                        </div>





                        <div class="form-group">
                            <div >
                                <button type="submit" class="btn btn-margin btn-warning">
                                    Update
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
