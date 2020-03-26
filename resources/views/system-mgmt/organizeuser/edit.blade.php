@extends('per.base')

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
                <div class="panel-heading">แก้ไขข้อมูล</div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('organizeuser.update', ['id' => $structure->id]) }}">
                      <input type="hidden" name="_method" value="PATCH">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3>General Information</h3>
                        <div class="row">
                          <div class="column">

                            <label for="name" class="">ชื่อบริษัท</label>


                                <input id="name" type="text" class="form-control" name="name"  value="{{ $structure->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                      </div>
                      <div class="column">
                        <label for="name" class="">ประเภทนิติบุคคล</label>


                            <input id="gender" type="text" class="form-control" name="gender" value="{{ $structure->gender }}" required autofocus>

                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif

                        </div>



                        <div class="column">
                          <label for="id_num" class="">เลขที่นิติบุคคล</label>


                              <input id="id_num" type="id_num" class="form-control" name="id_num" value="{{ $structure->id_num }}" required>

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


                              <input id="nationality" type="nationality" class="form-control" name="nationality" value="{{ $structure->nationality }}" required>

                              @if ($errors->has('nationality'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('nationality') }}</strong>
                                  </span>
                              @endif


                    </div>
                    <div class="column">


                          <label for="email" class="">ประเภทธุรกิจ</label>


                              <input id="more" type="more" class="form-control" name="more" value="{{ $structure->more }}" required>

                              @if ($errors->has('more'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('more') }}</strong>
                                  </span>
                              @endif


                  </div>



                    <div class="column">


                          <label for="email" class="">เบอร์โทรออฟฟิศสำนักงาน</label>


                              <input id="mobile" type="mobile" class="form-control" name="mobile" value="{{ $structure->mobile }}" required>

                              @if ($errors->has('mobile'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('mobile') }}</strong>
                                  </span>
                              @endif

                      </div>

                          <div class="column">

                                <label for="name" class="">อีเมลล์ติดต่อ</label>



                                <input id="couple_email" type="text" class="form-control" name="couple_email" value="{{ $structure->couple_email }}" required autofocus>

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


                                <input id="add2" type="text" class="form-control" name="add2" value="{{ $structure->add2 }}" required autofocus>

                                @if ($errors->has('add2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2') }}</strong>
                                    </span>
                                @endif

                      </div>

                          <div class="column">

                                <label for="add2_alley" class="">ตรอก/ซอย</label>



                                <input id="add2_alley" type="text" class="form-control" name="add2_alley" value="{{ $structure->add2_alley }}" required autofocus>

                                @if ($errors->has('add2_alley'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_alley') }}</strong>
                                    </span>
                                @endif

                      </div>

                    <div class="column">


                            <label for="add2_road" class="">ถนน</label>


                                <input id="add2_road" type="text" class="form-control" name="add2_road" value="{{ $structure->add2_road }}" required autofocus>

                                @if ($errors->has('add2_road'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_road') }}</strong>
                                    </span>
                                @endif

                      </div>
                      <div class="column">


                        <label for="add2_country" class="">ประเทศ</label>


                        <select class="form-control country" name="add2_country"  >
                          <option value="0">-เลือกประเทศ-</option>

                          @foreach($countrys as $country)
                          <option value="{{$country->id}}" {{$country->id == $structure->add2_country ? 'selected' : ''}}>{{$country->name}}</option>
                          @endforeach
                        </select>

                      </div>

                      </div>

                      <div class="row">
                      <div class="column">



                          <label class="">จังหวัด</label>

                            <select class="form-control pro prodis" name="add2_city"  id="nameid">

                              @foreach($provinces as $province)
                              <option value="{{$province->id}}" {{$province->id == $structure->add2_city ? 'selected' : ''}}>{{$province->name_in_thai}}</option>
                              @endforeach

                            </select>


                      </div>
                      <div class="column">


                            <label for=" add2_district" class="">เขต</label>


                            <select class="form-control dis dissub" name="add2_district"  id="nameid">
                              @foreach($districts as $district)
                              <option value="{{$district->id}}" {{$district->id == $structure->add2_district ? 'selected' : ''}}>{{$district->name_in_thai}}</option>
                              @endforeach


                            </select>

                        </div>
                      <div class="column">


                      <label for="add2_subdistrict" class="">แขวง</label>


                      <select class="form-control  subdis" name="add2_subdistrict"  id="nameid">
                        @foreach($subdistricts as $subdistrict)
                        <option value="{{$subdistrict->id}}" {{$subdistrict->id == $structure->add2_subdistrict ? 'selected' : ''}}>{{$subdistrict->name_in_thai}}</option>
                        @endforeach


                      </select>

                      </div>
                        <div class="column">


                            <label for="add2_postcode" class="">หมายเลขไปรษณีย์</label>


                                <input id="add2_postcode" type="text" class="form-control" name="add2_postcode" value="{{ $structure->add2_postcode }}" required>

                                @if ($errors->has('add2_postcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add2_postcode') }}</strong>
                                    </span>
                                @endif

                        </div>
                        </div>
                        <h3>Emergency Information</h3>

                      <div class="row">
                        <div class="column">

                          <label for="emergency_name" class="">ชื่อ Call center กรณีฉุกเฉิน</label>


                              <input id="emergency_name" type="emergency_name" class="form-control" name="emergency_name" value="{{ $structure->emergency_name}}" >

                              @if ($errors->has('emergency_name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('emergency_name') }}</strong>
                                  </span>
                              @endif

                      </div>

                      <div class="column">

                        <label for="emergency_phone" class="">เบอร์โทร</label>


                            <input id="emergency_phone" type="emergency_phone" class="form-control" name="emergency_phone" value="{{ $structure->emergency_phone}}" >

                            @if ($errors->has('emergency_phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('emergency_phone') }}</strong>
                                </span>
                            @endif

                    </div>
                    <div class="column">

                      <label for="emergency_email" class="">อีเมลล์</label>


                          <input id="emergency_email" type="emergency_email" class="form-control" name="emergency_email" value="{{ $structure->emergency_email}}" >

                          @if ($errors->has('emergency_email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('emergency_email') }}</strong>
                              </span>
                          @endif

                  </div>



                      </div>
                          <h3>Account Information</h3>

                        <div class="row">
                          <div class="column">

                            <label for="email" class="">อีเมลล์สำหรับเข้าใช้งานระบบ</label>


                                <input id="email" type="email" class="form-control" name="email" value="{{ $structure->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="column">

                          <label for="email" class="">Belong to (PID of Member)</label>
                              <input id="email" type="text" class="form-control" name="belong_to" value="{{ $ma }}" >

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
</div><script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.country',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findProvince')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
                  op+='<option value="0" selected disabled>-เลือกจังหวัด-</option>';
                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';

                  }
                  $('.pro').html(" ");
                  $('.pro').append(op);

                },
                error:function(){

                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.prodis',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findDistrict')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
                  op+='<option value="0" selected disabled>-เลือกเขต-</option>';
                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';

                  }
                  $('.dis').html(" ");
                  $('.dis').append(op);

                },
                error:function(){

                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.dissub',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            var op2=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findSubdistrict')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
                  op+='<option value="0" selected disabled>-เลือกแขวง-</option>';

                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';
                    op2+='<input id="add2_postcode" type="text" class="form-control subdis2" name="add2_postcode" value="'+data[i].zip_code+'" required>';
                  }
                  $('.subdis').html(" ");
                  $('.subdis').append(op);
                  $('.subdis2').html(" ");
                  $('.subdis2').append(op2);

                },
                error:function(){

                }
            });
        });
    });
</script>
@endsection
