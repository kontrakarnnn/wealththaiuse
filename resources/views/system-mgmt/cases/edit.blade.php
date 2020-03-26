@extends('system-mgmt.cases.base')

@section('action-content')
<style>


/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 16%;
  padding: 10px;
 /* Should be removed. Only for demonstration */
}
.columnnote {
  float: left;
  width: 33%;
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


  border: 1px solid #aaaaaa;

}
.name{


border: 1px solid #aaaaaa;

}
  .form-control2{



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
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Update Cases</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('cases.update', ['id' => $data[$casecol[0]]]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                        <div class="column">

                          <label for="name" class="">Case Name</label>


                              <input id="name" type="text" class="form-control" name="name" value="{{ $data[$casecol[1]] }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif

                          </div>
                        <div class="column">

                          <label for="name" class="">Case Type</label>


                          <select class="form-control  casetype" name="type_id">
                            <option value="0" >-Select-</option>
                            @foreach ($casetype as $ca)
                              <option value={{$ca->id}} {{$ca->id == $data[$casecol[2]] ? 'selected' : ''}}>{{$ca->name}}</option>
                            @endforeach
                          </select>

                        </div>





                        <div class="column">
                        <label for="id_num" class="">Case Sub Type</label>
                        <select class="form-control  name" name="sub_type_id">
                          <option value="0" >-Select-</option>
                          @foreach ($casesubtype as $ca)
                            <option value={{$ca->id}} {{$ca->id == $data[$casecol[3]] ? 'selected' : ''}} >{{$ca->name}}</option>
                          @endforeach
                        </select>




                        </div>
                        <div class="column">

                        <label for="name" class="">Created By(PID)</label>


                        <select class="form-control  name" name="created_by_pid">
                          <option value="0" >-Select-</option>
                          @foreach ($public_id as $ca)
                            <option value={{$ca->id}} {{$ca->id == $data[$casecol[4]] ? 'selected' : ''}}>{{$ca->id}} {{$ca->public_name}} </option>
                          @endforeach
                        </select>


                        </div>
                        <div class="column">

                        <label for="procedure_id" class="">Procedure</label>


                        <select class="form-control  " name="procedure_id">
                          <option value="0" >-Select-</option>
                          @foreach ($procedures as $ca)
                            <option value={{$ca->id}} {{$ca->id == $data[$casecol[5]] ? 'selected' : ''}} >{{$ca->name}}</option>
                          @endforeach
                        </select>

                        </div>
                        <div class="column">

                        <label for="stage" class="">Current Stage</label>


                        <select class="form-control  " name="stage">
                          <option value="0" >-Select-</option>
                          @foreach ($stage as $ca)
                            <option value={{$ca->id}} {{$ca->id == $data[$casecol[6]] ? 'selected' : ''}} >{{$ca->name}}</option>
                          @endforeach
                        </select>

                        </div>
                        <div class="column">

                        <label for="name" class="">Referal Asset</label>


                        <select class="form-control  name" name="referal_asset">
                        <option value="0" >-Select-</option>
                        @foreach ($asset as $ca)
                        <option value={{$ca->id}} {{$ca->id == $data[$casecol[89]] ? 'selected' : ''}}>{{$ca->name}} </option>
                        @endforeach
                        </select>


                        </div>
                        <div class="column">

                        <label for="name" class="">Referal Previous Cases</label>


                        <select class="form-control  name" name="ref_previous_case">
                        <option value="" >-Select-</option>
                        @foreach ($cases as $ca)
                        <option value={{$ca->id}} {{$ca->id == $data[$casecol[90]] ? 'selected' : ''}}>{{$ca->name}} </option>
                        @endforeach
                        </select>


                        </div>
                        <div class="column">

                        <label for="member_case_owner" class="">Member Case Owner</label>


                        <select class="form-control  name" name="member_case_owner">
                        <option value="0" >-Select-</option>
                        @foreach ($member as $ca)
                        <option value={{$ca->id}} {{$ca->id == $data[$casecol[104]] ? 'selected' : ''}}>{{$ca->name}} {{$ca->lname}} </option>
                        @endforeach
                        </select>


                        </div>
                        <div class="column">

                        <label for="name" class="">Consult Partner BlockID</label>


                        <select class="form-control  name" name="consult_partner_block_id">
                        <option value="0" >-Select-</option>
                        @foreach ($partnerblock as $ca)
                        <option value={{$ca->id}} {{$ca->id == $data[$casecol[92]] ? 'selected' : ''}}>{{$ca->name}} </option>
                        @endforeach
                        </select>


                        </div>
                        <div class="column">

                        <label for="name" class="">Service User BlockID</label>


                        <select class="form-control  name" name="service_user_block_id">
                        <option value="0" >-Select-</option>
                        @foreach ($block as $ca)
                        <option value={{$ca->id}} {{$ca->id == $data[$casecol[93]] ? 'selected' : ''}}>{{$ca->name}} </option>
                        @endforeach
                        </select>


                        </div>
                        <div class="column">

                        <label for="name" class="">Coordinate User BlockID</label>


                        <select class="form-control  name" name="coordinate_user_block_id">
                        <option value="0" >-Select-</option>
                        @foreach ($user as $ca)
                        <option value={{$ca->id}} {{$ca->id == $data[$casecol[94]] ? 'selected' : ''}}>{{$ca->firstname}} {{$ca->lastname}}</option>
                        @endforeach
                        </select>


                        </div>

                        </div>

                        <div class="row">
                          <div class="column">

                          <label for="case_channel" class="">Case Channel</label>


                          <input id="case_channel" type="text" class="form-control" name="case_channel"  value="{{ $data[$casecol[91]] }}" >

                          @if ($errors->has('case_channel'))
                          <span class="help-block">
                          <strong>{{ $errors->first('case_channel') }}</strong>
                          </span>
                          @endif

                          </div>
                        <div class="column">
                        <label for="name" class="">Auto Renew Date</label>


                        <input  name="auto_renew_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"class="form-control" value="{{$data[$casecol[97]]}}" />
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        </div>
                        <div class="column">
                        <label for="name" class="">Next Notify Date</label>


                        <input  name="next_notify_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"class="form-control" value="{{$data[$casecol[98]]}}" />
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif

                        </div>
      </div>
      <div class="row">

        <div class="columnnote">

          <label for="note_from_previous_case" class="">Note From Previous Case</label>


              <textarea id="note_from_previous_case" type="text" class="form-control" name="note_from_previous_case"  value="{{ old('note_from_previous_case') }}">{{$data[$casecol[99]]}} </textarea>

              @if ($errors->has('note_from_previous_case'))
                  <span class="help-block">
                      <strong>{{ $errors->first('note_from_previous_case') }}</strong>
                  </span>
              @endif

    </div>

    <div class="columnnote">

      <label for="note_to_copy_to_renew_case" class="">Note To Copy To Renew Case</label>


          <textarea id="note_to_copy_to_renew_case" type="text" class="form-control" name="note_to_copy_to_renew_case"  value="{{ old('note_to_copy_to_renew_case') }}"> {{$data[$casecol[100]]}}</textarea>

          @if ($errors->has('note_to_copy_to_renew_case'))
              <span class="help-block">
                  <strong>{{ $errors->first('note_to_copy_to_renew_case') }}</strong>
              </span>
          @endif

</div>
<div class="columnnote">

  <label for="note_from_member" class="">Note From Member</label>


      <textarea id="note_from_member" type="text" class="form-control" name="note_from_member"  value="{{ old('note_from_member') }}">{{$data[$casecol[101]]}} </textarea>

      @if ($errors->has('note_from_member'))
          <span class="help-block">
              <strong>{{ $errors->first('note_from_member') }}</strong>
          </span>
      @endif

</div>

<div class="columnnote">

<label for="note_from_user" class="">Note From User</label>


  <textarea id="note_from_user" type="text" class="form-control" name="note_from_user"  value="{{ old('note_from_user') }}">{{$data[$casecol[102]]}} </textarea>

  @if ($errors->has('note_from_user'))
      <span class="help-block">
          <strong>{{ $errors->first('note_from_user') }}</strong>
      </span>
  @endif

</div>
<div class="columnnote">

<label for="note_from_partner" class="">Note From Partner</label>


<textarea id="note_from_partner" type="text" class="form-control" name="note_from_partner"  value="{{ old('note_from_partner') }}">{{$data[$casecol[103]]}} </textarea>

@if ($errors->has('note_from_partner'))
  <span class="help-block">
      <strong>{{ $errors->first('note_from_partner') }}</strong>
  </span>
@endif

</div>
      </div>
                  <h3 style="color:#00325d;">CASE Requirement Variable Name</h3>
                  <div class="row">
                    <div class="column">

                      <label for="name" class="la">{{$casetypevar[$casetypecol[7]]}}</label>


                          <input id="requirename_var1" type="text" class="form-control" name="requirename_var1"  value="{{ $data[$casecol[7]] }}" >

                          @if ($errors->has('requirename_var1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('requirename_var1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">

                  <label for="requirename_var2" class="la2">{{$casetypevar[$casetypecol[8]]}}</label>


                      <input id="requirename_var2" type="text" class="form-control" name="requirename_var2"  value="{{ $data[$casecol[8]] }}" >

                      @if ($errors->has('requirename_var2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('requirename_var2') }}</strong>
                          </span>
                      @endif

            </div>



            <div class="column">

              <label for="requirename_var3" class="la3">{{$casetypevar[$casetypecol[9]]}}</label>


                  <input id="requirename_var3" type="text" class="form-control" name="requirename_var3"  value="{{ $data[$casecol[9]] }}" >

                  @if ($errors->has('requirename_var3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('requirename_var3') }}</strong>
                      </span>
                  @endif

        </div>
        <div class="column">

          <label for="requirename_var4" class="la4">{{$casetypevar[$casetypecol[10]]}}</label>


              <input id="requirename_var4" type="text" class="form-control" name="requirename_var4"  value="{{$data[$casecol[10]]}}" >

              @if ($errors->has('requirename_var4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('requirename_var4') }}</strong>
                  </span>
              @endif

    </div>
    <div class="column">

      <label for="requirename_var5" class="la5">{{$casetypevar[$casetypecol[11]]}}</label>


          <input id="requirename_var5" type="text" class="form-control" name="requirename_var5"  value="{{$data[$casecol[11]] }}" >

          @if ($errors->has('requirename_var5'))
              <span class="help-block">
                  <strong>{{ $errors->first('requirename_var5') }}</strong>
              </span>
          @endif

  </div>
  <div class="column">

  <label for="requirename_var6" class="la6">{{$casetypevar[$casetypecol[12]]}}</label>


      <input id="requirename_var6" type="text" class="form-control" name="requirename_var6"  value="{{ $data[$casecol[12]] }}" >

      @if ($errors->has('requirename_var6'))
          <span class="help-block">
              <strong>{{ $errors->first('requirename_var6') }}</strong>
          </span>
      @endif

  </div>
            </div>

            <div class="row">
              <div class="column">

                <label for="requirename_var7" class="la7">{{$casetypevar[$casetypecol[13]]}}</label>


                    <input id="requirename_var7" type="text" class="form-control" name="requirename_var7"  value="{{ $data[$casecol[13]] }}" >

                    @if ($errors->has('requirename_var7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('requirename_var7') }}</strong>
                        </span>
                    @endif

          </div>
          <div class="column">

            <label for="requirename_var8" class="la8">{{$casetypevar[$casetypecol[14]]}}</label>


                <input id="requirename_var8" type="text" class="form-control" name="requirename_var8"  value="{{ $data[$casecol[14]] }}" >

                @if ($errors->has('requirename_var8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('requirename_var8') }}</strong>
                    </span>
                @endif

      </div>



      <div class="column">

        <label for="requirename_var9" class="la9">{{$casetypevar[$casetypecol[15]]}}</label>


            <input id="requirename_var9" type="text" class="form-control" name="requirename_var9"  value="{{ $data[$casecol[15]]}}" >

            @if ($errors->has('requirename_var9'))
                <span class="help-block">
                    <strong>{{ $errors->first('requirename_var9') }}</strong>
                </span>
            @endif

  </div>
  <div class="column">

    <label for="requirename_var10" class="la10">{{$casetypevar[$casetypecol[16]]}}</label>


        <input id="requirename_var10" type="text" class="form-control" name="requirename_var10"  value="{{ $data[$casecol[16]] }}" >

        @if ($errors->has('requirename_var10'))
            <span class="help-block">
                <strong>{{ $errors->first('requirename_var10') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

  <label for="requirename_var11" class="la11">{{$casetypevar[$casetypecol[17]]}}</label>


    <input id="requirename_var11" type="text" class="form-control" name="requirename_var11"  value="{{ $data[$casecol[17]] }}" >

    @if ($errors->has('requirename_var11'))
        <span class="help-block">
            <strong>{{ $errors->first('requirename_var11') }}</strong>
        </span>
    @endif

  </div>
  <div class="column">

  <label for="requirename_var12" class="la12">{{$casetypevar[$casetypecol[18]]}}</label>


  <input id="requirename_var12" type="text" class="form-control" name="requirename_var12"  value="{{ $data[$casecol[18]] }}" >

  @if ($errors->has('requirename_var12'))
    <span class="help-block">
        <strong>{{ $errors->first('requirename_var12') }}</strong>
    </span>
  @endif

  </div>
      </div>

      <div class="row">
        <div class="column">

          <label for="requirename_var13" class="la13">{{$casetypevar[$casetypecol[19]]}}</label>


              <input id="requirename_var13" type="text" class="form-control" name="requirename_var13"  value="{{ $data[$casecol[19]] }}" >

              @if ($errors->has('requirename_var13'))
                  <span class="help-block">
                      <strong>{{ $errors->first('requirename_var13') }}</strong>
                  </span>
              @endif

    </div>
    <div class="column">

      <label for="requirename_var14" class="la14">{{$casetypevar[$casetypecol[20]]}}</label>


          <input id="requirename_var14" type="text" class="form-control" name="requirename_var14"  value="{{ $data[$casecol[20]] }}" >

          @if ($errors->has('requirename_var14'))
              <span class="help-block">
                  <strong>{{ $errors->first('requirename_var14') }}</strong>
              </span>
          @endif

  </div>



  <div class="column">

  <label for="requirename_var15" class="la15">{{$casetypevar[$casetypecol[21]]}}</label>


      <input id="requirename_var15" type="text" class="form-control" name="requirename_var15"  value="{{ $data[$casecol[21]] }}" >

      @if ($errors->has('requirename_var15'))
          <span class="help-block">
              <strong>{{ $errors->first('requirename_var15') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="requirename_var16" class="la16">{{$casetypevar[$casetypecol[22]]}}</label>


  <input id="requirename_var16" type="text" class="form-control" name="requirename_var16"  value="{{ $data[$casecol[22]] }}" >

  @if ($errors->has('requirename_var16requirename_var16'))
      <span class="help-block">
          <strong>{{ $errors->first('requirename_var16') }}</strong>
      </span>
  @endif

  </div>
  <div class="column">

  <label for="requirename_var17" class="la17">{{$casetypevar[$casetypecol[23]]}}</label>


  <input id="requirename_var17" type="text" class="form-control" name="requirename_var17"  value="{{ $data[$casecol[23]] }}" >

  @if ($errors->has('requirename_var17'))
  <span class="help-block">
      <strong>{{ $errors->first('requirename_var17') }}</strong>
  </span>
  @endif

  </div>
  <div class="column">

  <label for="requirename_var18" class="la18">{{$casetypevar[$casetypecol[24]]}}</label>


  <input id="requirename_var18" type="text" class="form-control" name="requirename_var18"  value="{{ $data[$casecol[24]] }}" >

  @if ($errors->has('requirename_var18'))
  <span class="help-block">
  <strong>{{ $errors->first('requirename_var18') }}</strong>
  </span>
  @endif

  </div>
  </div>

  <div class="row">
  <div class="column">

  <label for="requirename_var19" class="la19">{{$casetypevar[$casetypecol[25]]}}</label>


  <input id="requirename_var19" type="text" class="form-control" name="requirename_var19"  value="{{ $data[$casecol[25]] }}" >

  @if ($errors->has('requirename_var19'))
  <span class="help-block">
    <strong>{{ $errors->first('requirename_var19') }}</strong>
  </span>
  @endif

  </div>

  <div class="column">

  <label for="requirename_var20" class="la20">{{$casetypevar[$casetypecol[26]]}}</label>


  <input id="requirename_var20" type="text" class="form-control" name="requirename_var20"  value="{{ $data[$casecol[26]] }}" >

  @if ($errors->has('requirename_var20'))
  <span class="help-block">
    <strong>{{ $errors->first('requirename_var20') }}</strong>
  </span>
  @endif

  </div>

  </div>
  <label for="chkPassport">
      <input type="checkbox" id="chkPassport" />
      Add More Data
  </label>
  <div  id="dvPassport"style="display:none;" >

  <h3 style="color:#00325d;">CASE Variable Name </h3>

  <div class="row">
  <div class="column">

    <label for="var_value1" class="lan1">{{$casetypevar[$casetypecol[27]]}}</label>


        <input id="var_value1" type="text" class="form-control" name="var_value1"  value="{{ $data[$casecol[27]] }}" >

        @if ($errors->has('var_value1'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value1') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value2" class="lan2">{{$casetypevar[$casetypecol[28]]}}</label>


      <input id="var_value2" type="text" class="form-control" name="var_value2"  value="{{ $data[$casecol[28]] }}" >

      @if ($errors->has('var_value2'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value2') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value3" class="lan3">{{$casetypevar[$casetypecol[29]]}}</label>


      <input id="var_value3" type="text" class="form-control" name="var_value3"  value="{{ $data[$casecol[29]] }}" >

      @if ($errors->has('var_value3'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value3') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value4" class="lan4">{{$casetypevar[$casetypecol[30]]}}</label>


      <input id="var_value4" type="text" class="form-control" name="var_value4"  value="{{ $data[$casecol[30]] }}" >

      @if ($errors->has('var_value4'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value4') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value5" class="lan5">{{$casetypevar[$casetypecol[31]]}}</label>


      <input id="var_value5" type="text" class="form-control" name="var_value5"  value="{{ $data[$casecol[31]] }}" >

      @if ($errors->has('var_value5'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value5') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value6" class="lan6">{{$casetypevar[$casetypecol[32]]}}</label>


      <input id="var_value6" type="text" class="form-control" name="var_value6"  value="{{ $data[$casecol[32]] }}" >

      @if ($errors->has('var_value6'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value6') }}</strong>
          </span>
      @endif

  </div>
  </div>


  <div class="row">
  <div class="column">

    <label for="var_value7" class="lan7">{{$casetypevar[$casetypecol[33]]}}</label>


        <input id="var_value7" type="text" class="form-control" name="var_value7"  value="{{ $data[$casecol[33]] }}" >

        @if ($errors->has('var_value7'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value7') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value8" class="lan8">{{$casetypevar[$casetypecol[34]]}}</label>


      <input id="var_value8" type="text" class="form-control" name="var_value8"  value="{{ $data[$casecol[34]] }}" >

      @if ($errors->has('var_value8'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value8') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value9" class="lan9">{{$casetypevar[$casetypecol[35]]}}</label>


      <input id="var_value9" type="text" class="form-control" name="var_value9"  value="{{ $data[$casecol[35]] }}" >

      @if ($errors->has('var_value9'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value9') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value10" class="lan10">{{$casetypevar[$casetypecol[36]]}}</label>


      <input id="var_value10" type="text" class="form-control" name="var_value10"  value="{{ $data[$casecol[36]] }}" >

      @if ($errors->has('var_value10'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value10') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value11" class="lan11">{{$casetypevar[$casetypecol[37]]}}</label>


      <input id="var_value11" type="text" class="form-control" name="var_value11"  value="{{$data[$casecol[37]] }}" >

      @if ($errors->has('var_value11'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value11') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value12" class="lan12">{{$casetypevar[$casetypecol[38]]}}</label>


      <input id="var_value12" type="text" class="form-control" name="var_value12"  value="{{ $data[$casecol[38]] }}" >

      @if ($errors->has('var_value12'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value12') }}</strong>
          </span>
      @endif

  </div>
  </div>

  <div class="row">
  <div class="column">

    <label for="var_value13" class="lan13">{{$casetypevar[$casetypecol[39]]}}</label>


        <input id="var_value13" type="text" class="form-control" name="var_value13"  value="{{ $data[$casecol[39]] }}" >

        @if ($errors->has('var_value13'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value13') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value14" class="lan14">{{$casetypevar[$casetypecol[40]]}}</label>

      <input id="var_value14" type="text" class="form-control" name="var_value14"  value="{{ $data[$casecol[40]] }}" >

      @if ($errors->has('var_value14'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value14') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value15" class="lan15">{{$casetypevar[$casetypecol[41]]}}</label>


      <input id="var_value15" type="text" class="form-control" name="var_value15"  value="{{ $data[$casecol[41]] }}" >

      @if ($errors->has('var_value15'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value15') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value16" class="lan16">{{$casetypevar[$casetypecol[42]]}}</label>


      <input id="var_value16" type="text" class="form-control" name="var_value16"  value="{{ $data[$casecol[42]] }}" >

      @if ($errors->has('var_value16'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value16') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value17" class="lan17">{{$casetypevar[$casetypecol[43]]}}</label>


      <input id="var_value17" type="text" class="form-control" name="var_value17"  value="{{ $data[$casecol[43]] }}" >

      @if ($errors->has('var_value17'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value17') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value18" class="lan18">{{$casetypevar[$casetypecol[44]]}}</label>


      <input id="var_value18" type="text" class="form-control" name="var_value18"  value="{{ $data[$casecol[44]] }}" >

      @if ($errors->has('var_value18'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value18') }}</strong>
          </span>
      @endif

  </div>
  </div>

  <div class="row">
  <div class="column">

    <label for="var_value19" class="lan19">{{$casetypevar[$casetypecol[45]]}}</label>


        <input id="var_value19" type="text" class="form-control" name="var_value19"  value="{{ $data[$casecol[45]] }}" >

        @if ($errors->has('var_value19'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value19') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value20" class="lan20">{{$casetypevar[$casetypecol[46]]}}</label>

      <input id="var_value20" type="text" class="form-control" name="var_value20"  value="{{ $data[$casecol[46]] }}" >

      @if ($errors->has('var_value20'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value20') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value21" class="lan21">{{$casetypevar[$casetypecol[47]]}}</label>


      <input id="var_value21" type="text" class="form-control" name="var_value21"  value="{{ $data[$casecol[47]] }}" >

      @if ($errors->has('var_value21'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value21') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value22" class="lan22">{{$casetypevar[$casetypecol[48]]}}</label>


      <input id="var_value22" type="text" class="form-control" name="var_value22"  value="{{ $data[$casecol[48]] }}" >

      @if ($errors->has('var_value22'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value22') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value23" class="lan23">{{$casetypevar[$casetypecol[49]]}}</label>


      <input id="var_value23" type="text" class="form-control" name="var_value23"  value="{{$data[$casecol[49]] }}" >

      @if ($errors->has('var_value23'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value23') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value24" class="lan24">{{$casetypevar[$casetypecol[50]]}}</label>


      <input id="var_value24" type="text" class="form-control" name="var_value24"  value="{{ $data[$casecol[50]] }}" >

      @if ($errors->has('var_value24'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value24') }}</strong>
          </span>
      @endif

  </div>
  </div>

  <div class="row">
  <div class="column">

    <label for="var_value25" class="lan25">{{$casetypevar[$casetypecol[51]]}}</label>


        <input id="var_value25" type="text" class="form-control" name="var_value25"  value="{{ $data[$casecol[51]] }}" >

        @if ($errors->has('var_value25'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value25') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value26" class="lan26">{{$casetypevar[$casetypecol[52]]}}</label>

      <input id="var_value26" type="text" class="form-control" name="var_value26"  value="{{ $data[$casecol[52]] }}" >

      @if ($errors->has('var_value26'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value26') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value27" class="lan27">{{$casetypevar[$casetypecol[53]]}}</label>


      <input id="var_value27" type="text" class="form-control" name="var_value27"  value="{{ $data[$casecol[53]] }}" >

      @if ($errors->has('var_value27'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value27') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value28" class="lan28">{{$casetypevar[$casetypecol[54]]}}</label>


      <input id="var_value28" type="text" class="form-control" name="var_value28"  value="{{ $data[$casecol[54]] }}" >

      @if ($errors->has('var_value28'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value28') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value29" class="lan29">{{$casetypevar[$casetypecol[55]]}}</label>


      <input id="var_value29" type="text" class="form-control" name="var_value29"  value="{{$data[$casecol[55]] }}" >

      @if ($errors->has('var_value29'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value29') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value30" class="lan30">{{$casetypevar[$casetypecol[56]]}}</label>


      <input id="var_value30" type="text" class="form-control" name="var_value30"  value="{{ $data[$casecol[56]] }}" >

      @if ($errors->has('var_value30'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value30') }}</strong>
          </span>
      @endif

  </div>
  </div>
  <div class="row">
  <div class="column">

    <label for="var_value31" class="lan31">{{$casetypevar[$casetypecol[57]]}}</label>


        <input id="var_value31" type="text" class="form-control" name="var_value31"  value="{{ $data[$casecol[57]] }}" >

        @if ($errors->has('var_value31'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value31') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value32" class="lan32">{{$casetypevar[$casetypecol[58]]}}</label>

      <input id="var_value32" type="text" class="form-control" name="var_value32"  value="{{ $data[$casecol[58]] }}" >

      @if ($errors->has('var_value32'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value32') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value33" class="lan33">{{$casetypevar[$casetypecol[59]]}}</label>


      <input id="var_value33" type="text" class="form-control" name="var_value33"  value="{{ $data[$casecol[59]] }}" >

      @if ($errors->has('var_value33'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value33') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value34" class="lan34">{{$casetypevar[$casetypecol[60]]}}</label>


      <input id="var_value34" type="text" class="form-control" name="var_value34"  value="{{ $data[$casecol[60]] }}" >

      @if ($errors->has('var_value34'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value34') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value35" class="lan35">{{$casetypevar[$casetypecol[61]]}}</label>


      <input id="var_value35" type="text" class="form-control" name="var_value35"  value="{{ $data[$casecol[61]] }}" >

      @if ($errors->has('var_value35'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value35') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value36" class="lan36">{{$casetypevar[$casetypecol[62]]}}</label>


      <input id="var_value36" type="text" class="form-control" name="var_value36"  value="{{ $data[$casecol[62]] }}" >

      @if ($errors->has('var_value36'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value36') }}</strong>
          </span>
      @endif

  </div>
  </div>

  <div class="row">
  <div class="column">

    <label for="var_value37" class="lan37">{{$casetypevar[$casetypecol[63]]}}</label>


        <input id="var_value37" type="text" class="form-control" name="var_value37"  value="{{ $data[$casecol[63]] }}" >

        @if ($errors->has('var_value37'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value37') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value38" class="lan38">{{$casetypevar[$casetypecol[64]]}}</label>

      <input id="var_value32" type="text" class="form-control" name="var_value38"  value="{{ $data[$casecol[64]] }}" >

      @if ($errors->has('var_value38'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value38') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value39" class="lan39">{{$casetypevar[$casetypecol[65]]}}</label>


      <input id="var_value39" type="text" class="form-control" name="var_value39"  value="{{ $data[$casecol[65]] }}" >

      @if ($errors->has('var_value39'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value39') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value40" class="lan40">{{$casetypevar[$casetypecol[66]]}}</label>


      <input id="var_value40" type="text" class="form-control" name="var_value40"  value="{{ $data[$casecol[66]] }}" >

      @if ($errors->has('var_value40'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value40') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value41" class="lan41">{{$casetypevar[$casetypecol[67]]}}</label>


      <input id="var_value41" type="text" class="form-control" name="var_value41"  value="{{ $data[$casecol[67]] }}" >

      @if ($errors->has('var_value41'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value41') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value42" class="lan42">{{$casetypevar[$casetypecol[68]]}}</label>


      <input id="var_value42" type="text" class="form-control" name="var_value42"  value="{{ $data[$casecol[68]] }}" >

      @if ($errors->has('var_value42'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value42') }}</strong>
          </span>
      @endif

  </div>
  </div>

  <div class="row">
  <div class="column">

    <label for="var_value43" class="lan43">{{$casetypevar[$casetypecol[69]]}}</label>


        <input id="var_value43" type="text" class="form-control" name="var_value43"  value="{{ $data[$casecol[69]] }}" >

        @if ($errors->has('var_value43'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value43') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value44" class="lan44">{{$casetypevar[$casetypecol[70]]}}</label>

      <input id="var_value44" type="text" class="form-control" name="var_value44"  value="{{ $data[$casecol[70]] }}" >

      @if ($errors->has('var_value44'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value44') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value45" class="lan45">{{$casetypevar[$casetypecol[71]]}}</label>


      <input id="var_value45" type="text" class="form-control" name="var_value45"  value="{{ $data[$casecol[71]]}}" >

      @if ($errors->has('var_value45'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value45') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value46" class="lan46">{{$casetypevar[$casetypecol[72]]}}</label>


      <input id="var_value46" type="text" class="form-control" name="var_value46"  value="{{ $data[$casecol[72]] }}" >

      @if ($errors->has('var_value46'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value46') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value47" class="lan47">{{$casetypevar[$casetypecol[73]]}}</label>


      <input id="var_value47" type="text" class="form-control" name="var_value47"  value="{{ $data[$casecol[73]] }}" >

      @if ($errors->has('var_value47'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value47') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value48" class="lan48">{{$casetypevar[$casetypecol[74]]}}</label>


      <input id="var_value48" type="text" class="form-control" name="var_value48"  value="{{ $data[$casecol[74]] }}" >

      @if ($errors->has('var_value48'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value48') }}</strong>
          </span>
      @endif

  </div>
  </div>


  <div class="row">
  <div class="column">

    <label for="var_value49" class="lan49">{{$casetypevar[$casetypecol[75]]}}</label>


        <input id="var_value49" type="text" class="form-control" name="var_value49"  value="{{ $data[$casecol[75]] }}" >

        @if ($errors->has('var_value49'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value49') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value50" class="lan50">{{$casetypevar[$casetypecol[76]]}}</label>

      <input id="var_value50" type="text" class="form-control" name="var_value50"  value="{{$data[$casecol[76]] }}" >

      @if ($errors->has('var_value50'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value50') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value51" class="lan51">{{$casetypevar[$casetypecol[77]]}}</label>


      <input id="var_value51" type="text" class="form-control" name="var_value51"  value="{{ $data[$casecol[77]] }}" >

      @if ($errors->has('var_value51'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value51') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value52" class="lan52">{{$casetypevar[$casetypecol[78]]}}</label>


      <input id="var_value52" type="text" class="form-control" name="var_value52"  value="{{ $data[$casecol[78]] }}" >

      @if ($errors->has('var_value52'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value52') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value53" class="lan53">{{$casetypevar[$casetypecol[79]]}}</label>


      <input id="var_value53" type="text" class="form-control" name="var_value53"  value="{{ $data[$casecol[79]] }}" >

      @if ($errors->has('var_value53'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value53') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value54" class="lan54">{{$casetypevar[$casetypecol[80]]}}</label>


      <input id="var_value54" type="text" class="form-control" name="var_value54"  value="{{ $data[$casecol[80]] }}" >

      @if ($errors->has('var_value54'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value54') }}</strong>
          </span>
      @endif

  </div>
  </div>

  <div class="row">
  <div class="column">

    <label for="var_value55" class="lan55">{{$casetypevar[$casetypecol[81]]}}</label>


        <input id="var_value55" type="text" class="form-control" name="var_value55"  value="{{ $data[$casecol[81]] }}" >

        @if ($errors->has('var_value55'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value55') }}</strong>
            </span>
        @endif

  </div>


  <div class="column">

  <label for="var_value56" class="lan56">{{$casetypevar[$casetypecol[82]]}}</label>

      <input id="var_value56" type="text" class="form-control" name="var_value56"  value="{{ $data[$casecol[82]] }}" >
      @if ($errors->has('var_value56'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value56') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value57" class="lan57">{{$casetypevar[$casetypecol[83]]}}</label>


      <input id="var_value57" type="text" class="form-control" name="var_value57"  value="{{ $data[$casecol[83]]}}" >

      @if ($errors->has('var_value57'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value57') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value58" class="lan58">{{$casetypevar[$casetypecol[84]]}}</label>


      <input id="var_value58" type="text" class="form-control" name="var_value58"  value="{{ $data[$casecol[84]] }}" >

      @if ($errors->has('var_value58'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value58') }}</strong>
          </span>
      @endif

  </div>

  <div class="column">

  <label for="var_value59" class="lan59">{{$casetypevar[$casetypecol[85]]}}</label>


      <input id="var_value59" type="text" class="form-control" name="var_value59"  value="{{ $data[$casecol[85]] }}" >

      @if ($errors->has('var_value59'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value59') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">

  <label for="var_value60" class="lan60">{{$casetypevar[$casetypecol[86]]}}</label>


      <input id="var_value60" type="text" class="form-control" name="var_value60"  value="{{ $data[$casecol[86]] }}" >

      @if ($errors->has('var_value60'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value60') }}</strong>
          </span>
      @endif

  </div>
  </div>
</div>
                        <div class="form-group">
                            <div >
                                <button type="submit" class="btn btn-primary btn-margin">
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.casetype',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            var op2=" ";
            var op3=" ";
            var op4=" ";
            var op5=" ";
            var op6=" ";
            var op7=" ";
            var op8=" ";
            var op9=" ";
            var op10=" ";
            var op11=" ";
            var op12=" ";
            var op13=" ";
            var op14=" ";
            var op15=" ";
            var op16=" ";
            var op17=" ";
            var op18=" ";
            var op19=" ";
            var op20=" ";

            var opn1=" ";
            var opn2=" ";
            var opn3=" ";
            var opn4=" ";
            var opn5=" ";
            var opn6=" ";
            var opn7=" ";
            var opn8=" ";
            var opn9=" ";
            var opn10=" ";
            var opn11=" ";
            var opn12=" ";
            var opn13=" ";
            var opn14=" ";
            var opn15=" ";
            var opn16=" ";
            var opn17=" ";
            var opn18=" ";
            var opn19=" ";
            var opn20=" ";
            var opn21=" ";
            var opn22=" ";
            var opn23=" ";
            var opn24=" ";
            var opn25=" ";
            var opn26=" ";
            var opn27=" ";
            var opn28=" ";
            var opn29=" ";
            var opn30=" ";
            var opn31=" ";
            var opn32=" ";
            var opn33=" ";
            var opn34=" ";
            var opn35=" ";
            var opn36=" ";
            var opn37=" ";
            var opn38=" ";
            var opn39=" ";
            var opn40=" ";
            var opn41=" ";
            var opn42=" ";
            var opn43=" ";
            var opn44=" ";
            var opn45=" ";
            var opn46=" ";
            var opn47=" ";
            var opn48=" ";
            var opn49=" ";
            var opn50=" ";
            var opn51=" ";
            var opn52=" ";
            var opn53=" ";
            var opn54=" ";
            var opn55=" ";
            var opn56=" ";
            var opn57=" ";
            var opn58=" ";
            var opn59=" ";
            var opn60=" ";

            $.ajax({
                type:'get',
                url:'{!!URL::to('findCaseType')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);

                  for(var i=0; i<data.length;i++){
                    op+='<label value="'+data[i].requirename_var1+'">'+data[i].requirename_var1+'</label>';
                    op2+='<label value="'+data[i].requirename_var2+'">'+data[i].requirename_var2+'</label>';
                    op3+='<label value="'+data[i].requirename_var3+'">'+data[i].requirename_var3+'</label>';
                    op4+='<label value="'+data[i].requirename_var4+'">'+data[i].requirename_var4+'</label>';
                    op5+='<label value="'+data[i].requirename_var5+'">'+data[i].requirename_var5+'</label>';
                    op6+='<label value="'+data[i].requirename_var6+'">'+data[i].requirename_var6+'</label>';
                    op7+='<label value="'+data[i].requirename_var7+'">'+data[i].requirename_var7+'</label>';
                    op8+='<label value="'+data[i].requirename_var8+'">'+data[i].requirename_var8+'</label>';
                    op9+='<label value="'+data[i].requirename_var9+'">'+data[i].requirename_var9+'</label>';
                    op10+='<label value="'+data[i].requirename_var10+'">'+data[i].requirename_var10+'</label>';
                    op11+='<label value="'+data[i].requirename_var11+'">'+data[i].requirename_var11+'</label>';
                    op12+='<label value="'+data[i].requirename_var12+'">'+data[i].requirename_var12+'</label>';
                    op13+='<label value="'+data[i].requirename_var13+'">'+data[i].requirename_var13+'</label>';
                    op14+='<label value="'+data[i].requirename_var14+'">'+data[i].requirename_var14+'</label>';
                    op15+='<label value="'+data[i].requirename_var15+'">'+data[i].requirename_var15+'</label>';
                    op16+='<label value="'+data[i].requirename_var16+'">'+data[i].requirename_var16+'</label>';
                    op17+='<label value="'+data[i].requirename_var17+'">'+data[i].requirename_var17+'</label>';
                    op18+='<label value="'+data[i].requirename_var18+'">'+data[i].requirename_var18+'</label>';
                    op19+='<label value="'+data[i].requirename_var19+'">'+data[i].requirename_var19+'</label>';
                    op20+='<label value="'+data[i].requirename_var20+'">'+data[i].requirename_var20+'</label>';


                    opn1+='<label value="'+data[i].var_value1+'">'+data[i].var_value1+'</label>';
                    opn2+='<label value="'+data[i].var_value2+'">'+data[i].var_value2+'</label>';
                    opn3+='<label value="'+data[i].var_value3+'">'+data[i].var_value3+'</label>';
                    opn4+='<label value="'+data[i].var_value4+'">'+data[i].var_value4+'</label>';
                    opn5+='<label value="'+data[i].var_value5+'">'+data[i].var_value5+'</label>';
                    opn6+='<label value="'+data[i].var_value6+'">'+data[i].var_value6+'</label>';
                    opn7+='<label value="'+data[i].var_value7+'">'+data[i].var_value7+'</label>';
                    opn8+='<label value="'+data[i].var_value8+'">'+data[i].var_value8+'</label>';
                    opn9+='<label value="'+data[i].var_value9+'">'+data[i].var_value9+'</label>';
                    opn10+='<label value="'+data[i].var_value10+'">'+data[i].var_value10+'</label>';
                    opn11+='<label value="'+data[i].var_value11+'">'+data[i].var_value11+'</label>';
                    opn12+='<label value="'+data[i].var_value12+'">'+data[i].var_value12+'</label>';
                    opn13+='<label value="'+data[i].var_value13+'">'+data[i].var_value13+'</label>';
                    opn14+='<label value="'+data[i].var_value14+'">'+data[i].var_value14+'</label>';
                    opn15+='<label value="'+data[i].var_value15+'">'+data[i].var_value15+'</label>';
                    opn16+='<label value="'+data[i].var_value16+'">'+data[i].var_value16+'</label>';
                    opn17+='<label value="'+data[i].var_value17+'">'+data[i].var_value17+'</label>';
                    opn18+='<label value="'+data[i].var_value18+'">'+data[i].var_value18+'</label>';
                    opn19+='<label value="'+data[i].var_value19+'">'+data[i].var_value19+'</label>';
                    opn20+='<label value="'+data[i].var_value20+'">'+data[i].var_value20+'</label>';
                    opn21+='<label value="'+data[i].var_value21+'">'+data[i].var_value21+'</label>';
                    opn22+='<label value="'+data[i].var_value22+'">'+data[i].var_value22+'</label>';
                    opn23+='<label value="'+data[i].var_value23+'">'+data[i].var_value23+'</label>';
                    opn24+='<label value="'+data[i].var_value24+'">'+data[i].var_value24+'</label>';
                    opn25+='<label value="'+data[i].var_value25+'">'+data[i].var_value25+'</label>';
                    opn26+='<label value="'+data[i].var_value26+'">'+data[i].var_value26+'</label>';
                    opn27+='<label value="'+data[i].var_value27+'">'+data[i].var_value27+'</label>';
                    opn28+='<label value="'+data[i].var_value28+'">'+data[i].var_value28+'</label>';
                    opn29+='<label value="'+data[i].var_value29+'">'+data[i].var_value29+'</label>';
                    opn30+='<label value="'+data[i].var_value30+'">'+data[i].var_value30+'</label>';
                    opn31+='<label value="'+data[i].var_value31+'">'+data[i].var_value31+'</label>';
                    opn32+='<label value="'+data[i].var_value32+'">'+data[i].var_value32+'</label>';
                    opn33+='<label value="'+data[i].var_value33+'">'+data[i].var_value33+'</label>';
                    opn34+='<label value="'+data[i].var_value34+'">'+data[i].var_value34+'</label>';
                    opn35+='<label value="'+data[i].var_value35+'">'+data[i].var_value35+'</label>';
                    opn36+='<label value="'+data[i].var_value36+'">'+data[i].var_value36+'</label>';
                    opn37+='<label value="'+data[i].var_value37+'">'+data[i].var_value37+'</label>';
                    opn38+='<label value="'+data[i].var_value38+'">'+data[i].var_value38+'</label>';
                    opn39+='<label value="'+data[i].var_value39+'">'+data[i].var_value39+'</label>';
                    opn40+='<label value="'+data[i].var_value40+'">'+data[i].var_value40+'</label>';
                    opn41+='<label value="'+data[i].var_value41+'">'+data[i].var_value41+'</label>';
                    opn42+='<label value="'+data[i].var_value42+'">'+data[i].var_value42+'</label>';
                    opn43+='<label value="'+data[i].var_value43+'">'+data[i].var_value43+'</label>';
                    opn44+='<label value="'+data[i].var_value44+'">'+data[i].var_value44+'</label>';
                    opn45+='<label value="'+data[i].var_value45+'">'+data[i].var_value45+'</label>';
                    opn46+='<label value="'+data[i].var_value46+'">'+data[i].var_value46+'</label>';
                    opn47+='<label value="'+data[i].var_value47+'">'+data[i].var_value47+'</label>';
                    opn48+='<label value="'+data[i].var_value48+'">'+data[i].var_value48+'</label>';
                    opn49+='<label value="'+data[i].var_value49+'">'+data[i].var_value49+'</label>';
                    opn50+='<label value="'+data[i].var_value50+'">'+data[i].var_value50+'</label>';
                    opn51+='<label value="'+data[i].var_value51+'">'+data[i].var_value51+'</label>';
                    opn52+='<label value="'+data[i].var_value52+'">'+data[i].var_value52+'</label>';
                    opn53+='<label value="'+data[i].var_value53+'">'+data[i].var_value53+'</label>';
                    opn54+='<label value="'+data[i].var_value54+'">'+data[i].var_value54+'</label>';
                    opn55+='<label value="'+data[i].var_value55+'">'+data[i].var_value55+'</label>';
                    opn56+='<label value="'+data[i].var_value56+'">'+data[i].var_value56+'</label>';
                    opn57+='<label value="'+data[i].var_value57+'">'+data[i].var_value57+'</label>';
                    opn58+='<label value="'+data[i].var_value58+'">'+data[i].var_value58+'</label>';
                    opn59+='<label value="'+data[i].var_value59+'">'+data[i].var_value59+'</label>';
                    opn60+='<label value="'+data[i].var_value60+'">'+data[i].var_value60+'</label>';
}
                  $('.la').html(" ");
                  $('.la2').html(" ");
                  $('.la3').html(" ");
                  $('.la4').html(" ");
                  $('.la5').html(" ");
                  $('.la6').html(" ");
                  $('.la7').html(" ");
                  $('.la8').html(" ");
                  $('.la9').html(" ");
                  $('.la10').html(" ");
                  $('.la11').html(" ");
                  $('.la12').html(" ");
                  $('.la13').html(" ");
                  $('.la14').html(" ");
                  $('.la15').html(" ");
                  $('.la16').html(" ");
                  $('.la17').html(" ");
                  $('.la18').html(" ");
                  $('.la19').html(" ");
                  $('.la20').html(" ");

                  $('.lan1').html(" ");
                  $('.lan2').html(" ");
                  $('.lan3').html(" ");
                  $('.lan4').html(" ");
                  $('.lan5').html(" ");
                  $('.lan6').html(" ");
                  $('.lan7').html(" ");
                  $('.lan8').html(" ");
                  $('.lan9').html(" ");
                  $('.lan10').html(" ");
                  $('.lan11').html(" ");
                  $('.lan12').html(" ");
                  $('.lan13').html(" ");
                  $('.lan14').html(" ");
                  $('.lan15').html(" ");
                  $('.lan16').html(" ");
                  $('.lan17').html(" ");
                  $('.lan18').html(" ");
                  $('.lan19').html(" ");
                  $('.lan20').html(" ");
                  $('.lan21').html(" ");
                  $('.lan22').html(" ");
                  $('.lan23').html(" ");
                  $('.lan24').html(" ");
                  $('.lan25').html(" ");
                  $('.lan26').html(" ");
                  $('.lan27').html(" ");
                  $('.lan28').html(" ");
                  $('.lan29').html(" ");
                  $('.lan30').html(" ");
                  $('.lan31').html(" ");
                  $('.lan32').html(" ");
                  $('.lan33').html(" ");
                  $('.lan34').html(" ");
                  $('.lan35').html(" ");
                  $('.lan36').html(" ");
                  $('.lan37').html(" ");
                  $('.lan38').html(" ");
                  $('.lan39').html(" ");
                  $('.lan40').html(" ");
                  $('.lan41').html(" ");
                  $('.lan42').html(" ");
                  $('.lan43').html(" ");
                  $('.lan44').html(" ");
                  $('.lan45').html(" ");
                  $('.lan46').html(" ");
                  $('.lan47').html(" ");
                  $('.lan48').html(" ");
                  $('.lan49').html(" ");
                  $('.lan50').html(" ");
                  $('.lan51').html(" ");
                  $('.lan52').html(" ");
                  $('.lan53').html(" ");
                  $('.lan54').html(" ");
                  $('.lan55').html(" ");
                  $('.lan56').html(" ");
                  $('.lan57').html(" ");
                  $('.lan58').html(" ");
                  $('.lan59').html(" ");
                  $('.lan60').html(" ");

                  $('.la').append(op);
                  $('.la2').append(op2);
                  $('.la3').append(op3);
                  $('.la4').append(op4);
                  $('.la5').append(op5);
                  $('.la6').append(op6);
                  $('.la7').append(op7);
                  $('.la8').append(op8);
                  $('.la9').append(op9);
                  $('.la10').append(op10);
                  $('.la11').append(op11);
                  $('.la12').append(op12);
                  $('.la13').append(op13);
                  $('.la14').append(op14);
                  $('.la15').append(op15);
                  $('.la16').append(op16);
                  $('.la17').append(op17);
                  $('.la18').append(op18);
                  $('.la19').append(op19);
                  $('.la20').append(op20);

                  $('.lan1').append(opn1);
                  $('.lan2').append(opn2);
                  $('.lan3').append(opn3);
                  $('.lan4').append(opn4);
                  $('.lan5').append(opn5);
                  $('.lan6').append(opn6);
                  $('.lan7').append(opn7);
                  $('.lan8').append(opn8);
                  $('.lan9').append(opn9);
                  $('.lan10').append(opn10);
                  $('.lan11').append(opn11);
                  $('.lan12').append(opn12);
                  $('.lan13').append(opn13);
                  $('.lan14').append(opn14);
                  $('.lan15').append(opn15);
                  $('.lan16').append(opn16);
                  $('.lan17').append(opn17);
                  $('.lan18').append(opn18);
                  $('.lan19').append(opn19);
                  $('.lan20').append(opn20);
                  $('.lan21').append(opn21);
                  $('.lan22').append(opn22);
                  $('.lan23').append(opn23);
                  $('.lan24').append(opn24);
                  $('.lan25').append(opn25);
                  $('.lan26').append(opn26);
                  $('.lan27').append(opn27);
                  $('.lan28').append(opn28);
                  $('.lan29').append(opn29);
                  $('.lan30').append(opn30);
                  $('.lan31').append(opn31);
                  $('.lan32').append(opn32);
                  $('.lan33').append(opn33);
                  $('.lan34').append(opn34);
                  $('.lan35').append(opn35);
                  $('.lan36').append(opn36);
                  $('.lan37').append(opn37);
                  $('.lan38').append(opn38);
                  $('.lan39').append(opn39);
                  $('.lan40').append(opn40);
                  $('.lan41').append(opn41);
                  $('.lan42').append(opn42);
                  $('.lan43').append(opn43);
                  $('.lan44').append(opn44);
                  $('.lan45').append(opn45);
                  $('.lan46').append(opn46);
                  $('.lan47').append(opn47);
                  $('.lan48').append(opn48);
                  $('.lan49').append(opn49);
                  $('.lan50').append(opn50);
                  $('.lan51').append(opn51);
                  $('.lan52').append(opn52);
                  $('.lan53').append(opn53);
                  $('.lan54').append(opn54);
                  $('.lan55').append(opn55);
                  $('.lan56').append(opn56);
                  $('.lan57').append(opn57);
                  $('.lan58').append(opn58);
                  $('.lan59').append(opn59);
                  $('.lan60').append(opn60);



                  console.log(op);
                  console.log(op2);
                },
                error:function(){

                }
            });
        });
    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $(".name").select2({
            placeholder: "Select",
            //allowClear: true
        });
</script>
<script>
$(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
                $("#AddPassport").hide();
            } else {
                $("#dvPassport").hide();
                $("#AddPassport").show();
            }
        });
    });
    </script>
@endsection
