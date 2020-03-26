@extends('system-mgmt.cases.base')

@section('action-content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

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
.columnauth {
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
  .columnnote {
    width: 100%;
  }
  .columnauth {
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
.card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}
</style>
<div class="container">
    <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">Add new Cases</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('cases.store') }}">
                        {{ csrf_field() }}
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="column">
                            <label for="name" class="">Case Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                                <option value={{$ca->id}} >{{$ca->name}}</option>
                              @endforeach
                            </select>

                      </div>





                        <div class="column">
                          <label for="id_num" class="">Case Sub Type</label>
                          <select class="form-control  name" name="sub_type_id">
                            <option value="0" >-Select-</option>
                            @foreach ($casesubtype as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>




                        </div>
                        <div class="column">

                          <label for="name" class="">Created By(PID)</label>


                          <select class="form-control  name" name="created_by_pid">
                            <option value="0" >-Select-</option>
                            @foreach ($public_id as $ca)
                              <option value={{$ca->id}} >{{$ca->id}} {{$ca->public_name}} </option>
                            @endforeach
                          </select>


                    </div>
                    <div class="column">

                      <label for="procedure_id" class="">Procedure</label>


                      <select class="form-control  " name="procedure_id">
                        <option value="0" >-Select-</option>
                        @foreach ($procedures as $ca)
                          <option value={{$ca->id}} >{{$ca->name}}</option>
                        @endforeach
                      </select>

                </div>
                <div class="column">

                  <label for="stage" class="">Current Stage</label>


                  <select class="form-control  " name="stage">
                    <option value="0" >-Select-</option>
                    @foreach ($stage as $ca)
                      <option value={{$ca->id}} >{{$ca->name}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="column">

              <label for="name" class="">Referal Asset</label>


              <select class="form-control  name" name="referal_asset">
                <option value="0" >-Select-</option>
                @foreach ($asset as $ca)
                  <option value={{$ca->id}} >{{$ca->name}} </option>
                @endforeach
              </select>
        </div>
        <div class="column">

          <label for="name" class="">Referal Previous Cases</label>


          <select class="form-control  name" name="ref_previous_case">
            <option value="" >-Select-</option>
            @foreach ($cases as $ca)
              <option value={{$ca->id}} >{{$ca->name}} </option>
            @endforeach
          </select>


    </div>
    <div class="column">

      <label for="member_case_owner" class="">Member Case Owner</label>


      <select class="form-control  name" name="member_case_owner">
        <option value="0" >-Select-</option>
        @foreach ($member as $ca)
          <option value={{$ca->id}} >{{$ca->name}} {{$ca->lname}} </option>
        @endforeach
      </select>


    </div>
<div class="column">

  <label for="name" class="">Consult Partner BlockID</label>


  <select class="form-control  name" name="consult_partner_block_id">
    <option value="0" >-Select-</option>
    @foreach ($partnerblock as $ca)
      <option value={{$ca->id}} >{{$ca->name}} </option>
    @endforeach
  </select>


</div>
<div class="column">

  <label for="name" class="">Service User BlockID</label>


  <select class="form-control  name" name="service_user_block_id">
    <option value="0" >-Select-</option>
    @foreach ($block as $ca)
      <option value={{$ca->id}} >{{$ca->name}} </option>
    @endforeach
  </select>


</div>
<div class="column">

  <label for="name" class="">Coordinate User ID</label>


  <select class="form-control  name" name="coordinate_user_block_id">
    <option value="0" >-Select-</option>
    @foreach ($user as $ca)
      <option value={{$ca->id}} >{{$ca->firstname}} {{$ca->lastname}}</option>
    @endforeach
  </select>


</div>

                  </div>

                  <div class="row">
                    <div class="column">

                      <label for="case_channel" class="">Case Channel</label>


                          <input id="case_channel" type="text" class="form-control" name="case_channel"  value="{{ old('case_channel') }}" >

                          @if ($errors->has('case_channel'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('case_channel') }}</strong>
                              </span>
                          @endif

                </div>
                    <div class="column">
                      <label for="name" class="">Auto Renew Date</label>


                      <input  name="auto_renew_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"class="form-control" value="{{ old('auto_renew_date') }}" />
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif

                      </div>
                      <div class="column">
                        <label for="name" class="">Next Notify Date</label>


                        <input  name="next_notify_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"class="form-control" value="{{ old('next_notify_date') }}" />
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


                    <textarea id="note_from_previous_case" type="text" class="form-control" name="note_from_previous_case"  value="{{ old('note_from_previous_case') }}"> </textarea>

                    @if ($errors->has('note_from_previous_case'))
                        <span class="help-block">
                            <strong>{{ $errors->first('note_from_previous_case') }}</strong>
                        </span>
                    @endif

          </div>

          <div class="columnnote">

            <label for="note_to_copy_to_renew_case" class="">Note To Copy To Renew Case</label>


                <textarea id="note_to_copy_to_renew_case" type="text" class="form-control" name="note_to_copy_to_renew_case"  value="{{ old('note_to_copy_to_renew_case') }}"> </textarea>

                @if ($errors->has('note_to_copy_to_renew_case'))
                    <span class="help-block">
                        <strong>{{ $errors->first('note_to_copy_to_renew_case') }}</strong>
                    </span>
                @endif

      </div>
      <div class="columnnote">

        <label for="note_from_member" class="">Note From Member</label>


            <textarea id="note_from_member" type="text" class="form-control" name="note_from_member"  value="{{ old('note_from_member') }}"> </textarea>

            @if ($errors->has('note_from_member'))
                <span class="help-block">
                    <strong>{{ $errors->first('note_from_member') }}</strong>
                </span>
            @endif

  </div>

  <div class="columnnote">

    <label for="note_from_user" class="">Note From User</label>


        <textarea id="note_from_user" type="text" class="form-control" name="note_from_user"  value="{{ old('note_from_user') }}"> </textarea>

        @if ($errors->has('note_from_user'))
            <span class="help-block">
                <strong>{{ $errors->first('note_from_user') }}</strong>
            </span>
        @endif

</div>
<div class="columnnote">

<label for="note_from_partner" class="">Note From Partner</label>


    <textarea id="note_from_partner" type="text" class="form-control" name="note_from_partner"  value="{{ old('note_from_partner') }}"> </textarea>

    @if ($errors->has('note_from_partner'))
        <span class="help-block">
            <strong>{{ $errors->first('note_from_partner') }}</strong>
        </span>
    @endif

</div>
            </div>
                  <h3 style="color:#00325d;">CASE Requirement Variable Value</h3>
                  <div class="row">
                    <div class="column">

                      <label for="name" class="la">Requirement Value1</label>


                          <input id="require_value1" type="text" class="form-control" name="require_value1"  value="{{ old('require_value1') }}" >

                          @if ($errors->has('require_value1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('require_value1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">

                  <label for="require_value2" class="la2">Requirement Value2</label>


                      <input id="require_value2" type="text" class="form-control" name="require_value2"  value="{{ old('require_value2') }}" >

                      @if ($errors->has('require_value2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('require_value2') }}</strong>
                          </span>
                      @endif

            </div>



            <div class="column">

              <label for="require_value3" class="la3">Requirement Value3</label>


                  <input id="require_value3" type="text" class="form-control" name="require_value3"  value="{{ old('require_value3') }}" >

                  @if ($errors->has('require_value3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('require_value3') }}</strong>
                      </span>
                  @endif

        </div>
        <div class="column">

          <label for="require_value4" class="la4">Requirement Value4</label>


              <input id="require_value4" type="text" class="form-control" name="require_value4"  value="{{ old('require_value4') }}" >

              @if ($errors->has('require_value4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('require_value4') }}</strong>
                  </span>
              @endif

    </div>
    <div class="column">

      <label for="require_value5" class="la5">Requirement Value5</label>


          <input id="require_value5" type="text" class="form-control" name="require_value5"  value="{{ old('require_value5') }}" >

          @if ($errors->has('require_value5'))
              <span class="help-block">
                  <strong>{{ $errors->first('require_value5') }}</strong>
              </span>
          @endif

</div>
<div class="column">

  <label for="require_value6" class="la6">Requirement Value6</label>


      <input id="require_value6" type="text" class="form-control" name="require_value6"  value="{{ old('require_value6') }}" >

      @if ($errors->has('require_value6'))
          <span class="help-block">
              <strong>{{ $errors->first('require_value6') }}</strong>
          </span>
      @endif

</div>
            </div>

            <div class="row">
              <div class="column">

                <label for="require_value7" class="la7">Requirement Value7</label>


                    <input id="require_value7" type="text" class="form-control" name="require_value7"  value="{{ old('require_value7') }}" >

                    @if ($errors->has('require_value7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('require_value7') }}</strong>
                        </span>
                    @endif

          </div>
          <div class="column">

            <label for="require_value8" class="la8">Requirement Value8</label>


                <input id="require_value8" type="text" class="form-control" name="require_value8"  value="{{ old('require_value8') }}" >

                @if ($errors->has('require_value8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('require_value8') }}</strong>
                    </span>
                @endif

      </div>



      <div class="column">

        <label for="require_value9" class="la9">Requirement Value9</label>


            <input id="require_value9" type="text" class="form-control" name="require_value9"  value="{{ old('require_value9') }}" >

            @if ($errors->has('require_value9'))
                <span class="help-block">
                    <strong>{{ $errors->first('require_value9') }}</strong>
                </span>
            @endif

  </div>
  <div class="column">

    <label for="require_value10" class="la10">Requirement Value10</label>


        <input id="require_value10" type="text" class="form-control" name="require_value10"  value="{{ old('require_value10') }}" >

        @if ($errors->has('require_value10'))
            <span class="help-block">
                <strong>{{ $errors->first('require_value10') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="require_value11" class="la11">Requirement Value11</label>


    <input id="require_value11" type="text" class="form-control" name="require_value11"  value="{{ old('require_value11') }}" >

    @if ($errors->has('require_value11'))
        <span class="help-block">
            <strong>{{ $errors->first('require_value11') }}</strong>
        </span>
    @endif

</div>
<div class="column">

<label for="require_value12" class="la12">Requirement Value12</label>


<input id="require_value12" type="text" class="form-control" name="require_value12"  value="{{ old('require_value12') }}" >

@if ($errors->has('require_value12'))
    <span class="help-block">
        <strong>{{ $errors->first('require_value12') }}</strong>
    </span>
@endif

</div>
      </div>

      <div class="row">
        <div class="column">

          <label for="require_value13" class="la13">Requirement Value13</label>


              <input id="require_value13" type="text" class="form-control" name="require_value13"  value="{{ old('require_value13') }}" >

              @if ($errors->has('require_value13'))
                  <span class="help-block">
                      <strong>{{ $errors->first('require_value13') }}</strong>
                  </span>
              @endif

    </div>
    <div class="column">

      <label for="require_value14" class="la14">Requirement Value14</label>


          <input id="require_value14" type="text" class="form-control" name="require_value14"  value="{{ old('require_value14') }}" >

          @if ($errors->has('require_value14'))
              <span class="help-block">
                  <strong>{{ $errors->first('require_value14') }}</strong>
              </span>
          @endif

</div>



<div class="column">

  <label for="require_value15" class="la15">Requirement Value15</label>


      <input id="require_value15" type="text" class="form-control" name="require_value15"  value="{{ old('require_value15') }}" >

      @if ($errors->has('require_value15'))
          <span class="help-block">
              <strong>{{ $errors->first('require_value15') }}</strong>
          </span>
      @endif

</div>
<div class="column">

<label for="require_value16" class="la16">Requirement Value16</label>


  <input id="require_value16" type="text" class="form-control" name="require_value16"  value="{{ old('require_value16') }}" >

  @if ($errors->has('require_value16'))
      <span class="help-block">
          <strong>{{ $errors->first('require_value16') }}</strong>
      </span>
  @endif

</div>
<div class="column">

<label for="require_value17" class="la17">Requirement Value17</label>


<input id="require_value17" type="text" class="form-control" name="require_value17"  value="{{ old('require_value17') }}" >

@if ($errors->has('require_value17'))
  <span class="help-block">
      <strong>{{ $errors->first('require_value17') }}</strong>
  </span>
@endif

</div>
<div class="column">

<label for="require_value18" class="la18">Requirement Value18</label>


<input id="require_value18" type="text" class="form-control" name="require_value18"  value="{{ old('require_value18') }}" >

@if ($errors->has('require_value18'))
<span class="help-block">
  <strong>{{ $errors->first('require_value18') }}</strong>
</span>
@endif

</div>
</div>

<div class="row">
  <div class="column">

  <label for="require_value19" class="la19">Requirement Value19</label>


  <input id="require_value19" type="text" class="form-control" name="require_value19"  value="{{ old('require_value19') }}" >

  @if ($errors->has('require_value19'))
  <span class="help-block">
    <strong>{{ $errors->first('require_value19') }}</strong>
  </span>
  @endif

  </div>

  <div class="column">

  <label for="require_value20" class="la20">Requirement Value20</label>


  <input id="require_value20" type="text" class="form-control" name="require_value20"  value="{{ old('require_value20') }}" >

  @if ($errors->has('require_value20'))
  <span class="help-block">
    <strong>{{ $errors->first('require_value20') }}</strong>
  </span>
  @endif

  </div>

</div>

  <div class="box collapsed-box">
    <div class="box-header with-border">
      <h3 class="box-title" data-widget="collapse">Case Variable Value</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
<h3 style="color:#00325d;">CASE Variable Value </h3>

<div class="row">
  <div class="column">

    <label for="var_value1" class="lan1">Variable Value1</label>


        <input id="var_value1" type="text" class="form-control" name="var_value1"  value="{{ old('var_value1') }}" >

        @if ($errors->has('var_value1'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value1') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value2" class="lan2">Variable Value2</label>


      <input id="var_value2" type="text" class="form-control" name="var_value2"  value="{{ old('var_value2') }}" >

      @if ($errors->has('var_value2'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value2') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value3" class="lan3">Variable Value3</label>


      <input id="var_value3" type="text" class="form-control" name="var_value3"  value="{{ old('var_value3') }}" >

      @if ($errors->has('var_value3'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value3') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value4" class="lan4">Variable Value4</label>


      <input id="var_value4" type="text" class="form-control" name="var_value4"  value="{{ old('var_value4') }}" >

      @if ($errors->has('var_value4'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value4') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value5" class="lan5">Variable Value5</label>


      <input id="var_value5" type="text" class="form-control" name="var_value5"  value="{{ old('var_value5') }}" >

      @if ($errors->has('var_value5'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value5') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value6" class="lan6">Variable Value6</label>


      <input id="var_value6" type="text" class="form-control" name="var_value6"  value="{{ old('var_value6') }}" >

      @if ($errors->has('var_value6'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value6') }}</strong>
          </span>
      @endif

</div>
</div>


<div class="row">
  <div class="column">

    <label for="var_value7" class="lan7">Variable Value7</label>


        <input id="var_value7" type="text" class="form-control" name="var_value7"  value="{{ old('var_value7') }}" >

        @if ($errors->has('var_value7'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value7') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value8" class="lan8">Variable Value8</label>


      <input id="var_value8" type="text" class="form-control" name="var_value8"  value="{{ old('var_value8') }}" >

      @if ($errors->has('var_value8'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value8') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value9" class="lan9">Variable Value9</label>


      <input id="var_value9" type="text" class="form-control" name="var_value9"  value="{{ old('var_value9') }}" >

      @if ($errors->has('var_value9'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value9') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value10" class="lan10">Variable Value10</label>


      <input id="var_value10" type="text" class="form-control" name="var_value10"  value="{{ old('var_value10') }}" >

      @if ($errors->has('var_value10'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value10') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value11" class="lan11">Variable Value11</label>


      <input id="var_value11" type="text" class="form-control" name="var_value11"  value="{{ old('var_value11') }}" >

      @if ($errors->has('var_value11'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value11') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value12" class="lan12">Variable Value12</label>


      <input id="var_value12" type="text" class="form-control" name="var_value12"  value="{{ old('var_value12') }}" >

      @if ($errors->has('var_value12'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value12') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_value13" class="lan13">Variable Value13</label>


        <input id="var_value13" type="text" class="form-control" name="var_value13"  value="{{ old('var_value13') }}" >

        @if ($errors->has('var_value13'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value13') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value14" class="lan14">Variable Value14</label>

      <input id="var_value14" type="text" class="form-control" name="var_value14"  value="{{ old('var_value14') }}" >

      @if ($errors->has('var_value14'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value14') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value15" class="lan15">Variable Value15</label>


      <input id="var_value15" type="text" class="form-control" name="var_value15"  value="{{ old('var_value15') }}" >

      @if ($errors->has('var_value15'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value15') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value16" class="lan16">Variable Value16</label>


      <input id="var_value16" type="text" class="form-control" name="var_value16"  value="{{ old('var_value16') }}" >

      @if ($errors->has('var_value16'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value16') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value17" class="lan17">Variable Value17</label>


      <input id="var_value17" type="text" class="form-control" name="var_value17"  value="{{ old('var_value17') }}" >

      @if ($errors->has('var_value17'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value17') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value18" class="lan18">Variable Value18</label>


      <input id="var_value18" type="text" class="form-control" name="var_value18"  value="{{ old('var_value18') }}" >

      @if ($errors->has('var_value18'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value18') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_value19" class="lan19">Variable Value19</label>


        <input id="var_value19" type="text" class="form-control" name="var_value19"  value="{{ old('var_value19') }}" >

        @if ($errors->has('var_value19'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value19') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value20" class="lan20">Variable Value20</label>

      <input id="var_value20" type="text" class="form-control" name="var_value20"  value="{{ old('var_value20') }}" >

      @if ($errors->has('var_value20'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value20') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value21" class="lan21">Variable Value21</label>


      <input id="var_value21" type="text" class="form-control" name="var_value21"  value="{{ old('var_value21') }}" >

      @if ($errors->has('var_value21'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value21') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value22" class="lan22">Variable Value22</label>


      <input id="var_value22" type="text" class="form-control" name="var_value22"  value="{{ old('var_value22') }}" >

      @if ($errors->has('var_value22'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value22') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value23" class="lan23">Variable Value23</label>


      <input id="var_value23" type="text" class="form-control" name="var_value23"  value="{{ old('var_value23') }}" >

      @if ($errors->has('var_value23'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value23') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value24" class="lan24">Variable Value24</label>


      <input id="var_value24" type="text" class="form-control" name="var_value24"  value="{{ old('var_value24') }}" >

      @if ($errors->has('var_value24'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value24') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_value25" class="lan25">Variable Value25</label>


        <input id="var_value25" type="text" class="form-control" name="var_value25"  value="{{ old('var_value25') }}" >

        @if ($errors->has('var_value25'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value25') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value26" class="lan26">Variable Value26</label>

      <input id="var_value26" type="text" class="form-control" name="var_value26"  value="{{ old('var_value26') }}" >

      @if ($errors->has('var_value26'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value26') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value27" class="lan27">Variable Value27</label>


      <input id="var_value27" type="text" class="form-control" name="var_value27"  value="{{ old('var_value27') }}" >

      @if ($errors->has('var_value27'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value27') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value28" class="lan28">Variable Value28</label>


      <input id="var_value28" type="text" class="form-control" name="var_value28"  value="{{ old('var_value28') }}" >

      @if ($errors->has('var_value28'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value28') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value29" class="lan29">Variable Value29</label>


      <input id="var_value29" type="text" class="form-control" name="var_value29"  value="{{ old('var_value29') }}" >

      @if ($errors->has('var_value29'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value29') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value30" class="lan30">Variable Value30</label>


      <input id="var_value30" type="text" class="form-control" name="var_value30"  value="{{ old('var_value30') }}" >

      @if ($errors->has('var_value30'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value30') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_value31" class="lan31">Variable Value31</label>


        <input id="var_value31" type="text" class="form-control" name="var_value31"  value="{{ old('var_value31') }}" >

        @if ($errors->has('var_value31'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value31') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value32" class="lan32">Variable Value32</label>

      <input id="var_value32" type="text" class="form-control" name="var_value32"  value="{{ old('var_value32') }}" >

      @if ($errors->has('var_value32'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value32') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value33" class="lan33">Variable Value33</label>


      <input id="var_value33" type="text" class="form-control" name="var_value33"  value="{{ old('var_value33') }}" >

      @if ($errors->has('var_value33'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value33') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value34" class="lan34">Variable Value34</label>


      <input id="var_value34" type="text" class="form-control" name="var_value34"  value="{{ old('var_value34') }}" >

      @if ($errors->has('var_value34'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value34') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value35" class="lan35">Variable Value35</label>


      <input id="var_value35" type="text" class="form-control" name="var_value35"  value="{{ old('var_value35') }}" >

      @if ($errors->has('var_value35'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value35') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value36" class="lan36">Variable Value36</label>


      <input id="var_value36" type="text" class="form-control" name="var_value36"  value="{{ old('var_value36') }}" >

      @if ($errors->has('var_value36'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value36') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_value37" class="lan37">Variable Value37</label>


        <input id="var_value37" type="text" class="form-control" name="var_value37"  value="{{ old('var_value37') }}" >

        @if ($errors->has('var_value37'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value37') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value38" class="lan38">Variable Value38</label>

      <input id="var_value32" type="text" class="form-control" name="var_value38"  value="{{ old('var_value38') }}" >

      @if ($errors->has('var_value38'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value38') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value39" class="lan39">Variable Value39</label>


      <input id="var_value39" type="text" class="form-control" name="var_value39"  value="{{ old('var_value39') }}" >

      @if ($errors->has('var_value39'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value39') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value40" class="lan40">Variable Value40</label>


      <input id="var_value40" type="text" class="form-control" name="var_value40"  value="{{ old('var_value40') }}" >

      @if ($errors->has('var_value40'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value40') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value41" class="lan41">Variable Value41</label>


      <input id="var_value41" type="text" class="form-control" name="var_value41"  value="{{ old('var_value41') }}" >

      @if ($errors->has('var_value41'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value41') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value42" class="lan42">Variable Value42</label>


      <input id="var_value42" type="text" class="form-control" name="var_value42"  value="{{ old('var_value42') }}" >

      @if ($errors->has('var_value42'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value42') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_value43" class="lan43">Variable Value43</label>


        <input id="var_value43" type="text" class="form-control" name="var_value43"  value="{{ old('var_value43') }}" >

        @if ($errors->has('var_value43'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value43') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value44" class="lan44">Variable Value44</label>

      <input id="var_value44" type="text" class="form-control" name="var_value44"  value="{{ old('var_value44') }}" >

      @if ($errors->has('var_value44'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value44') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value45" class="lan45">Variable Value45</label>


      <input id="var_value45" type="text" class="form-control" name="var_value45"  value="{{ old('var_value45') }}" >

      @if ($errors->has('var_value45'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value45') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value46" class="lan46">Variable Value46</label>


      <input id="var_value46" type="text" class="form-control" name="var_value46"  value="{{ old('var_value46') }}" >

      @if ($errors->has('var_value46'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value46') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value47" class="lan47">Variable Value47</label>


      <input id="var_value47" type="text" class="form-control" name="var_value47"  value="{{ old('var_value47') }}" >

      @if ($errors->has('var_value47'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value47') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value48" class="lan48">Variable Value48</label>


      <input id="var_value48" type="text" class="form-control" name="var_value48"  value="{{ old('var_value48') }}" >

      @if ($errors->has('var_value48'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value48') }}</strong>
          </span>
      @endif

</div>
</div>


<div class="row">
  <div class="column">

    <label for="var_value49" class="lan49">Variable Value49</label>


        <input id="var_value49" type="text" class="form-control" name="var_value49"  value="{{ old('var_value49') }}" >

        @if ($errors->has('var_value49'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value49') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value50" class="lan50">Variable Value50</label>

      <input id="var_value50" type="text" class="form-control" name="var_value50"  value="{{ old('var_value50') }}" >

      @if ($errors->has('var_value50'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value50') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value51" class="lan51">Variable Value51</label>


      <input id="var_value51" type="text" class="form-control" name="var_value51"  value="{{ old('var_value51') }}" >

      @if ($errors->has('var_value51'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value51') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value52" class="lan52">Variable Value52</label>


      <input id="var_value52" type="text" class="form-control" name="var_value52"  value="{{ old('var_value52') }}" >

      @if ($errors->has('var_value52'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value52') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value53" class="lan53">Variable Value53</label>


      <input id="var_value53" type="text" class="form-control" name="var_value53"  value="{{ old('var_value53') }}" >

      @if ($errors->has('var_value53'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value53') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value54" class="lan54">Variable Value54</label>


      <input id="var_value54" type="text" class="form-control" name="var_value54"  value="{{ old('var_value54') }}" >

      @if ($errors->has('var_value54'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value54') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_value55" class="lan55">Variable Value55</label>


        <input id="var_value55" type="text" class="form-control" name="var_value55"  value="{{ old('var_value55') }}" >

        @if ($errors->has('var_value55'))
            <span class="help-block">
                <strong>{{ $errors->first('var_value55') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_value56" class="lan56">Variable Value56</label>

      <input id="var_value56" type="text" class="form-control" name="var_value56"  value="{{ old('var_value56') }}" >
      @if ($errors->has('var_value56'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value56') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value57" class="lan57">Variable Value57</label>


      <input id="var_value57" type="text" class="form-control" name="var_value57"  value="{{ old('var_value57') }}" >

      @if ($errors->has('var_value57'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value57') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value58" class="lan58">Variable Value58</label>


      <input id="var_value58" type="text" class="form-control" name="var_value58"  value="{{ old('var_value58') }}" >

      @if ($errors->has('var_value58'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value58') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_value59" class="lan59">Variable Value59</label>


      <input id="var_value59" type="text" class="form-control" name="var_value59"  value="{{ old('var_value59') }}" >

      @if ($errors->has('var_value59'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value59') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_value60" class="lan60">Variable Value60</label>


      <input id="var_value60" type="text" class="form-control" name="var_value60"  value="{{ old('var_value60') }}" >

      @if ($errors->has('var_value60'))
          <span class="help-block">
              <strong>{{ $errors->first('var_value60') }}</strong>
          </span>
      @endif

</div>
</div>
</div>
<!-- /.box-body -->

</div>

<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Case Authentication</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">

      <div class="columnauth">
        <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-sm-8">
                  Public ID
                </div>
                <div class="col-sm-4">
                </div>
            </div>
          </div>
          <div class="card-body">


            <div class="" >
              <select style="width:100%"class="form-control  name" name="public_id[]">
                <option value="0" >-Select-</option>
                @foreach ($public_id as $ca)
                  <option value={{$ca->id}} >{{$ca->id}} {{$ca->public_name}}</option>
                @endforeach
              </select>
              <br />

            </div>


            <div class="clonepublic hide">
              <div class="control-grouppublic input-group input-grouppublic" style="margin-top:10px">

              <select style="width:100%"class="form-control  " name="public_id[]">
                <option value="0" >-Select-</option>
                @foreach ($public_id as $ca)
                  <option value={{$ca->id}} >{{$ca->id}} {{$ca->public_name}}</option>
                @endforeach
              </select><div class="input-group-btn">
                <button class="btn btn-danger publicremove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
              </div>

            </div>
          </div>
          <div class="incrementpublic" >
          </div>

        <br />
        <button class="btn btn-success publicadd" type="button"><i class="glyphicon glyphicon-plus"></i></button>

        </div>

        </div>
        </div>
        <div class="columnauth">
          <div class="card">
            <div class="card-header">
            Block Partner

            </div>
            <div class="card-body">
                        <div class="" >
                            <select style="width:100%"class="form-control  oppartner" name="block_partner[]">
                              <option value="0" >-Select-</option>
                              @foreach ($partnerblock as $ca)
                                <option value={{$ca->id}} >{{$ca->name}}</option>
                              @endforeach
                            </select>
                            <br />

                          </div>

                          <div class="clonepartner hide">
                            <div class="control-grouppartner input-group input-grouppartner" style="margin-top:10px">

                            <select style="width:100%"class="form-control  " name="block_partner[]">
                              <option value="0" >-Select-</option>
                              @foreach ($partnerblock as $ca)
                                <option value={{$ca->id}} >{{$ca->name}}</option>
                              @endforeach
                            </select><div class="input-group-btn">
                              <button class="btn btn-danger partnerremove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                            </div>

                          </div>
                        </div>
                        <div class="incrementpartner">


                        </div>

                      <br />
                      <button class="btn btn-success partneradd" type="button"><i class="glyphicon glyphicon-plus"></i></button>

          </div>

          </div>

          </div>
          <div class="columnauth">
                  <div class="card">
                    <div class="card-header">
                      Block User

                    </div>
                    <div class="card-body">
                      <div class="" >
                        <select style="width:100%"class="form-control  opuser" name="block_user[]">
                          <option value="0" >-Select-</option>
                          @foreach ($block as $ca)
                            <option value={{$ca->id}} >{{$ca->name}}</option>
                          @endforeach
                        </select>
                        <br />

                      </div>

                      <div class="cloneuser hide">
                        <div class="control-groupuser input-group input-groupuser" style="margin-top:10px">

                        <select style="width:100%"class="form-control" name="block_user[]">
                          <option value="0" >-Select-</option>
                          @foreach ($block as $ca)
                            <option value={{$ca->id}} >{{$ca->name}}</option>
                          @endforeach
                        </select><div class="input-group-btn">
                          <button class="btn btn-danger userremove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                        </div>

                      </div>
                    </div>
                    <div class="incrementuser">

                    </div>

                  <br />
                  <button class="btn btn-success useradd" type="button"><i class="glyphicon glyphicon-plus"></i></button>

                  </div>
                </div>
                </div>
                  <div class="columnauth">
                          <div class="card">
                            <div class="card-header">
                              Guild Member

                            </div>
                            <div class="card-body">
                              <div class="" >
                                <select style="width:100%"class="form-control  " name="guild_member[]">
                                  <option value="0" >-Select-</option>
                                  @foreach ($guildmember as $ca)
                                    <option value={{$ca->id}} >{{$ca->name}}</option>
                                  @endforeach
                                </select>
                                <br />

                              </div>

                              <div class="cloneguild hide">
                                <div class="control-groupguild input-group input-groupguild" style="margin-top:10px">

                                <select style="width:100%"class="form-control  " name="guild_member[]">
                                  <option value="0" >-Select-</option>
                                  @foreach ($guildmember as $ca)
                                    <option value={{$ca->id}} >{{$ca->name}}</option>
                                  @endforeach
                                </select><div class="input-group-btn">
                                  <button class="btn btn-danger guildremove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                </div>

                              </div>
                              </div>
                              <div class="incrementguild">

                              </div>

                              <br />
                              <button class="btn btn-success guildadd" type="button"><i class="glyphicon glyphicon-plus"></i></button>

                            </div>

                          </div>
                          </div>

    </div>
    <div class="row">

      <div class="columnauth">
        <div class="card">
          <div class="card-header">
          Group Member

          </div>
          <div class="card-body">

            <div class="" >
              <select style="width:100%"class="form-control  " name="group_member[]">
                <option value="0" >-Select-</option>
                @foreach ($membergroup as $ca)
                  <option value={{$ca->id}} >{{$ca->name}}</option>
                @endforeach
              </select>
              <br />

            </div>

            <div class="clonegroupmem hide">
              <div class="control-groupgroupmem input-group input-groupgroupmem" style="margin-top:10px">

              <select style="width:100%"class="form-control  " name="group_member[]">
                <option value="0" >-Select-</option>
                @foreach ($membergroup as $ca)
                  <option value={{$ca->id}} >{{$ca->name}}</option>
                @endforeach
              </select><div class="input-group-btn">
                <button class="btn btn-danger groupmemremove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
              </div>

            </div>
            </div>

            <div class="incrementgroupmem">

            </div>
            <br />
            <button class="btn btn-success groupmemadd" type="button"><i class="glyphicon glyphicon-plus"></i></button>

          </div>

        </div>
        </div>
        <div class="columnauth">
          <div class="card">
            <div class="card-header">
            Group PID

            </div>
            <div class="card-body">

              <div class="" >
                <select style="width:100%"class="form-control  " name="group_pid[]">
                  <option value="0" >-Select-</option>
                  @foreach ($pidgroup as $ca)
                    <option value={{$ca->id}} >{{$ca->name}}</option>
                  @endforeach
                </select>
                <br />

              </div>

              <div class="clonegrouppid hide">
                <div class="control-groupgrouppid input-group input-groupgrouppid" style="margin-top:10px">

                <select style="width:100%"class="form-control  " name="group_pid[]">
                  <option value="0" >-Select-</option>
                  @foreach ($pidgroup as $ca)
                    <option value={{$ca->id}} >{{$ca->name}}</option>
                  @endforeach
                </select><div class="input-group-btn">
                  <button class="btn btn-danger grouppidremove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                </div>

              </div>
              </div>

              <div class="incrementgrouppid">


              </div>
              <br />
              <button class="btn btn-success grouppidadd" type="button"><i class="glyphicon glyphicon-plus"></i></button>

            </div>

          </div>
          </div>
          <div class="columnauth">
                  <div class="card">
                    <div class="card-header">
                      Group Partner
                    </div>
                    <div class="card-body">

                      <div class="" >
                        <select style="width:100%"class="form-control  oppartnergroup" name="group_partner[]">
                          <option value="0" >-Select-</option>
                          @foreach ($partnergroup as $ca)
                            <option value={{$ca->id}} >{{$ca->name}}</option>
                          @endforeach
                        </select>
                        <br />

                      </div>

                      <div class="clonegrouppart hide">
                        <div class="control-groupgrouppart input-group input-groupgrouppart" style="margin-top:10px">

                        <select style="width:100%"class="form-control  " name="group_partner[]">
                          <option value="0" >-Select-</option>
                          @foreach ($partnergroup as $ca)
                            <option value={{$ca->id}} >{{$ca->name}}</option>
                          @endforeach
                        </select><div class="input-group-btn">
                          <button class="btn btn-danger grouppartremove" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                        </div>

                      </div>
                      </div>

                      <div class="incrementgrouppart">


                      </div>
                      <br />
                      <button class="btn btn-success grouppartadd" type="button"><i class="glyphicon glyphicon-plus"></i></button>

                    </div>

                  </div>
                  </div>



    </div>
  </div>
  </div>
  <!-- /.box-body -->

</div>
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


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">

          $(".name").select2({
                placeholder: "Select",
                allowClear: true
            });
    </script>

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
                var oppartner=" ";
                var opuser=" ";
                var oppartnergroup=" ";

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


                        opn1+='<label value="'+data[i].var_name1+'">'+data[i].var_name1+'</label>';
                        opn2+='<label value="'+data[i].var_name2+'">'+data[i].var_name2+'</label>';
                        opn3+='<label value="'+data[i].var_name3+'">'+data[i].var_name3+'</label>';
                        opn4+='<label value="'+data[i].var_name4+'">'+data[i].var_name4+'</label>';
                        opn5+='<label value="'+data[i].var_name5+'">'+data[i].var_name5+'</label>';
                        opn6+='<label value="'+data[i].var_name6+'">'+data[i].var_name6+'</label>';
                        opn7+='<label value="'+data[i].var_name7+'">'+data[i].var_name7+'</label>';
                        opn8+='<label value="'+data[i].var_name8+'">'+data[i].var_name8+'</label>';
                        opn9+='<label value="'+data[i].var_name9+'">'+data[i].var_name9+'</label>';
                        opn10+='<label value="'+data[i].var_name10+'">'+data[i].var_name10+'</label>';
                        opn11+='<label value="'+data[i].var_name11+'">'+data[i].var_name11+'</label>';
                        opn12+='<label value="'+data[i].var_name12+'">'+data[i].var_name12+'</label>';
                        opn13+='<label value="'+data[i].var_name13+'">'+data[i].var_name13+'</label>';
                        opn14+='<label value="'+data[i].var_name14+'">'+data[i].var_name14+'</label>';
                        opn15+='<label value="'+data[i].var_name15+'">'+data[i].var_name15+'</label>';
                        opn16+='<label value="'+data[i].var_name16+'">'+data[i].var_name16+'</label>';
                        opn17+='<label value="'+data[i].var_name17+'">'+data[i].var_name17+'</label>';
                        opn18+='<label value="'+data[i].var_name18+'">'+data[i].var_name18+'</label>';
                        opn19+='<label value="'+data[i].var_name19+'">'+data[i].var_name19+'</label>';
                        opn20+='<label value="'+data[i].var_name20+'">'+data[i].var_name20+'</label>';
                        opn21+='<label value="'+data[i].var_name21+'">'+data[i].var_name21+'</label>';
                        opn22+='<label value="'+data[i].var_name22+'">'+data[i].var_name22+'</label>';
                        opn23+='<label value="'+data[i].var_name23+'">'+data[i].var_name23+'</label>';
                        opn24+='<label value="'+data[i].var_name24+'">'+data[i].var_name24+'</label>';
                        opn25+='<label value="'+data[i].var_name25+'">'+data[i].var_name25+'</label>';
                        opn26+='<label value="'+data[i].var_name26+'">'+data[i].var_name26+'</label>';
                        opn27+='<label value="'+data[i].var_name27+'">'+data[i].var_name27+'</label>';
                        opn28+='<label value="'+data[i].var_name28+'">'+data[i].var_name28+'</label>';
                        opn29+='<label value="'+data[i].var_name29+'">'+data[i].var_name29+'</label>';
                        opn30+='<label value="'+data[i].var_name30+'">'+data[i].var_name30+'</label>';
                        opn31+='<label value="'+data[i].var_name31+'">'+data[i].var_name31+'</label>';
                        opn32+='<label value="'+data[i].var_name32+'">'+data[i].var_name32+'</label>';
                        opn33+='<label value="'+data[i].var_name33+'">'+data[i].var_name33+'</label>';
                        opn34+='<label value="'+data[i].var_name34+'">'+data[i].var_name34+'</label>';
                        opn35+='<label value="'+data[i].var_name35+'">'+data[i].var_name35+'</label>';
                        opn36+='<label value="'+data[i].var_name36+'">'+data[i].var_name36+'</label>';
                        opn37+='<label value="'+data[i].var_name37+'">'+data[i].var_name37+'</label>';
                        opn38+='<label value="'+data[i].var_name38+'">'+data[i].var_name38+'</label>';
                        opn39+='<label value="'+data[i].var_name39+'">'+data[i].var_name39+'</label>';
                        opn40+='<label value="'+data[i].var_name40+'">'+data[i].var_name40+'</label>';
                        opn41+='<label value="'+data[i].var_name41+'">'+data[i].var_name41+'</label>';
                        opn42+='<label value="'+data[i].var_name42+'">'+data[i].var_name42+'</label>';
                        opn43+='<label value="'+data[i].var_name43+'">'+data[i].var_name43+'</label>';
                        opn44+='<label value="'+data[i].var_name44+'">'+data[i].var_name44+'</label>';
                        opn45+='<label value="'+data[i].var_name45+'">'+data[i].var_name45+'</label>';
                        opn46+='<label value="'+data[i].var_name46+'">'+data[i].var_name46+'</label>';
                        opn47+='<label value="'+data[i].var_name47+'">'+data[i].var_name47+'</label>';
                        opn48+='<label value="'+data[i].var_name48+'">'+data[i].var_name48+'</label>';
                        opn49+='<label value="'+data[i].var_name49+'">'+data[i].var_name49+'</label>';
                        opn50+='<label value="'+data[i].var_name50+'">'+data[i].var_name50+'</label>';
                        opn51+='<label value="'+data[i].var_name51+'">'+data[i].var_name51+'</label>';
                        opn52+='<label value="'+data[i].var_name52+'">'+data[i].var_name52+'</label>';
                        opn53+='<label value="'+data[i].var_name53+'">'+data[i].var_name53+'</label>';
                        opn54+='<label value="'+data[i].var_name54+'">'+data[i].var_name54+'</label>';
                        opn55+='<label value="'+data[i].var_name55+'">'+data[i].var_name55+'</label>';
                        opn56+='<label value="'+data[i].var_name56+'">'+data[i].var_name56+'</label>';
                        opn57+='<label value="'+data[i].var_name57+'">'+data[i].var_name57+'</label>';
                        opn58+='<label value="'+data[i].var_name58+'">'+data[i].var_name58+'</label>';
                        opn59+='<label value="'+data[i].var_name59+'">'+data[i].var_name59+'</label>';
                        opn60+='<label value="'+data[i].var_name60+'">'+data[i].var_name60+'</label>';
                        oppartner+='<option value="'+data[i].default_partner_block_id+'">'+data[i].partner_block_name+'</option>';
                        opuser+='<option value="'+data[i].default_user_block_id+'">'+data[i].bu_name+'</option>';
                        oppartnergroup+='<option value="'+data[i].default_partner_group+'">'+data[i].partner_group_name+'</option>';
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
                      $('.oppartner').html(" ");
                      $('.opuser').html(" ");
                      $('.oppartnergroup').html(" ");

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
                      $('.oppartner').append(oppartner);
                      $('.opuser').append(opuser);
                      $('.oppartnergroup').append(oppartnergroup);
                      console.log(op);
                      console.log(op2);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".publicadd").click(function(){
              var html = $(".clonepublic").html();
              $(".incrementpublic").after(html);
          });

          $("body").on("click",".publicremove",function(){
              $(this).parents(".control-grouppublic").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".partneradd").click(function(){
              var html = $(".clonepartner").html();
              $(".incrementpartner").after(html);
          });

          $("body").on("click",".partnerremove",function(){
              $(this).parents(".control-grouppartner").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".useradd").click(function(){
              var html = $(".cloneuser").html();
              $(".incrementuser").after(html);
          });

          $("body").on("click",".userremove",function(){
              $(this).parents(".control-groupuser").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".guildadd").click(function(){
              var html = $(".cloneguild").html();
              $(".incrementguild").after(html);
          });

          $("body").on("click",".guildremove",function(){
              $(this).parents(".control-groupguild").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".groupmemadd").click(function(){
              var html = $(".clonegroupmem").html();
              $(".incrementgroupmem").after(html);
          });

          $("body").on("click",".groupmemremove",function(){
              $(this).parents(".control-groupgroupmem").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".grouppidadd").click(function(){
              var html = $(".clonegrouppid").html();
              $(".incrementgrouppid").after(html);
          });

          $("body").on("click",".grouppidremove",function(){
              $(this).parents(".control-groupgrouppid").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".grouppartadd").click(function(){
              var html = $(".clonegrouppart").html();
              $(".incrementgrouppart").after(html);
          });

          $("body").on("click",".grouppartremove",function(){
              $(this).parents(".control-groupgrouppart").remove();
          });

        });

    </script>
@endsection
