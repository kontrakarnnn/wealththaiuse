@extends('admin.partnermanage.base')
@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="btn btn-default">Create New Partner </span> <a href="/admin/selectmember" style="margin-left:50px">Select From Member</a></div>
                <div class="panel-body">




                      <form class="form-horizontal" role="form" method="POST" action="{{ route('partnermanage.store') }}">
                          {{ csrf_field() }}






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
                              <label for="lname" class="col-md-4 control-label">Englisg Lastname</label>

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




                          <div class="form-group{{ $errors->has('id_num') ? ' has-error' : '' }}">
                              <label for="id_num" class="col-md-4 control-label">หมายเลขบัตรประชาชน</label>

                              <div class="col-md-6">
                                  <input id="id_num" type="id_num" class="form-control" name="id_num" value="{{ old('id_num') }}"  required autofocus>

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
                                    @foreach($province as $p)
                                    <option value = "{{$p->id}}">  {{$p->name_in_thai}}  </option>
                                    @endforeach
                                  </select>
                              </div>
                          </div>





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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $(".searchname").select2({
            placeholder: "Select a Name",
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
@endsection
