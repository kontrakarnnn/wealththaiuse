@extends('layouts.app-per')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
#spinner {
  position: fixed;
  top: 50%;
  left:50%;
}
.modal2 {

  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content2 {
  background-color: ;
  margin: auto;
  padding: 20px;

  width: 80%;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register  <a class="btn btn-default" href="https://erp.wealththai.net?lit?{{$loginurl}}" style="margin-left:50px">มีบัญชีผู้ใช้อยู่แล้ว / เคยสมัครแล้ว</a></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('quickregis.store') }}" onsubmit="$('#loading').show();" >
                        {{ csrf_field() }}





<div id="loading" style="display:none"><div id="myModal2" class="modal2">

  <!-- Modal content -->
  <div class="modal-content2">

    <p style="text-align:center"><img style="max-width:150px"
             src="{{url('../')}}/img/spinner.gif"></p>
  </div>

</div></div>



                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">คำนำหน้า</label>

                            <div class="col-md-6">
                              <select class=" form-control " name="gender" id="nameid2">

                                  <option value="นาย(Mr.)" >นาย(Mr.)</option>
                                  <option value="นาง(Mrs.)" >นาง(Mrs.)</option>
                                  <option value="นางสาว(Ms.)" >นางสาว(Ms.)</option>


                              </select>

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">ชื่อ(ภาษาไทย)</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                            <label for="lname" class="col-md-4 control-label">นามสกุล(ภาษาไทย)</label>

                            <div class="col-md-6">
                                <input id="lname" type="lname" class="form-control" name="lname" value="{{ old('lname') }}"  >

                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">English Name</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="Eng_name" value="{{ old('name') }}" >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                            <label for="lname" class="col-md-4 control-label">English Lastname</label>

                            <div class="col-md-6">
                                <input id="lname" type="lname" class="form-control" name="Eng_lastname" value="{{ old('lname') }}"  >

                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                            <label for="nickname" class="col-md-4 control-label">ชื่อเล่น(Nickname)</label>

                            <div class="col-md-6">
                                <input id="nickname" type="nickname" class="form-control" name="nickname" value="{{ old('nickname') }}"  >

                                @if ($errors->has('nickname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">อีเมลล์</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">รหัสผ่าน</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">ใส่รหัสผ่านอีกครั้ง</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('id_num') ? ' has-error' : '' }}">
                            <label for="id_num" class="col-md-4 control-label">หมายเลขบัตรประชาชน</label>

                            <div class="col-md-6">
                                <input id="id_num" type="id_num" class="form-control" name="id_num" value="{{ old('id_num') }}"  >

                                @if ($errors->has('id_num'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_num') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">

                            <label for="dob" class="col-md-4 control-label">วันเกิด</label>
                            <div style="margin-top:1%"class="col-md-6">
                              <select  id="date" type="text" name="sd"   placeholder="วันที่">


                                <option value ="01">  01  </option>
                                <option value ="02">  02  </option>
                                <option value ="03">  03  </option>
                                <option value ="04">  04  </option>
                                <option value ="05">  05  </option>
                                <option value ="06">  06  </option>
                                <option value ="07">  07  </option>
                                <option value ="08">  08  </option>
                                <option value ="09">  09  </option>

                              @for ($i =10; $i <= 31; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor

                              </select>

								<select type="text" name="sm"   placeholder="เดือนที่">

                                <option value ="01">  มกราคม  </option>
                                <option value ="02">  กุมภาพันธ์  </option>
                                <option value ="03">  มีนาคม  </option>
                                <option value ="04">  เมษายน  </option>
                                <option value ="05">  พฤษภาคม  </option>
                                <option value ="06">  มิถุนายน  </option>
                                <option value ="07">  กรกฎาคม  </option>
                                <option value ="08">  สิงหาคม  </option>
                                <option value ="09">  กันยายน  </option>
								<option value ="10">  ตุลาคม  </option>
								<option value ="11">  พฤศจิกายน  </option>
								<option value ="12">  ธันวาคม  </option>
							</select>
                              <select type="text" name="sy"   placeholder="ปี">
                                @for ($i =$currentyear; $i >= 1900; $i--)

                                <option value="{{ $i }}">พ.ศ.{{ $i }}</option>
                                @endfor
                                </select>
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('id_num') ? ' has-error' : '' }}">

                        <div class="col-md-6">

                                </div>
                                  </div>


                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">เบอร์โทรศัพท์</label>

                            <div class="col-md-6">
                                <input id="mobile" type="mobile" class="form-control" name="mobile" value="{{ old('mobile') }}"  >

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">จังหวัด</label>
                            <div class="col-md-6">
                                <select class="form-control " name="add2_city"   required autofocus>
                                  <option value="" >-เลือก-</option>
                                  @foreach($province as $i =>$p)
                                  <option value = "{{$p->id}}">{{$p->name_in_thai}}  </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

					                        <div class="form-group">

                                        <label class="col-md-4 control-label"></label>
                                      <div class="col-md-6">
                                        <div class="checkbox">
                                          @foreach($policy as $po)
                                          <label><input type="checkbox"   name="accept" value="yes" required autofocus>ฉันยอมรับข้อตกลงและเงื่อนไขในการใช้บริการ <a type="button" class="" data-toggle="modal" data-target="#myModal{{ $po->id }}">อ่านเงื่อนไขการใช้บริการ</a></label>
                                          <div class="modal fade" id="myModal{{ $po->id }}" role="dialog">
                                          <div class="modal-dialog modal-lg">

                                          <!-- Modal content-->

                                          <div class="modal-content">
                                          <div class="modal-header" >
                                          <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                                          <h4 class="modal-title">{{$po->name}} </h4>
                                          </div>
                                          <div class="modal-body">
                                            {!! html_entity_decode($po->policy)!!}
                                          </div>
                                          <div class="modal-footer" >
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                          </div>
                                          </div>
                                        </div>
                                      </div>
                                          @endforeach
                                          </div>
                                          </div>
                                          </div>
                        @if($eventcaptcha == 'No')
                        @else
                        <div class="form-group{{ $errors->has('add2_city') ? ' has-error' : '' }}">
                            <label for="add2_city" class="col-md-4 control-label"></label>

                            <div class="col-md-6">

                                <div class="g-recaptcha" data-sitekey="6LeaX2oUAAAAANi4r0XLv0VpixCxfl6s_LXooZxw"></div>
                                @if($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback" style="display:block">
                                      <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                        @endif


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>






                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(window).load(function() {
 $('.preloader').fadeOut('slow');
});
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid").select2({
            placeholder: "จังหวัด",
            allowClear: true
        });
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#cityid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#perid").select({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
<script>
@endsection
