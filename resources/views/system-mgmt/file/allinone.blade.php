@extends('system-mgmt.file.allinonebase')

@section('action-content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

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


.card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}





</style>

<div class="container">
    <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">Add new asset</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{URL::to('Nonlife/allinone/save')}}">
                        {{ csrf_field() }}
                        <div class="card">
                          <div class="card-header">
                            Member & Portfolio Management

                          </div>
                          <div class="card-body">
                        <div class="row">
                          <div class="column">



                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Refered Member</label>

                            <div class="col-md-6">
                              @if($ifrefm == 1)
                              <select disabled class=" form-control " name="edit_ref_id" onchange="window.location.href=this.value;">
                                @else
                                <select class=" form-control nameid" name="edit_ref_id" onchange="window.location.href=this.value;">
                                @endif
                                @if($ifrefm == 0)
                                <option></option>
								<option value="{{$url1}}??/refermem/refm0refm">-ไม่มี-</option>
                                @endif
                                  @foreach ($member as $mem)

                                      <option value="{{$url1}}??/refermem/refm{{$mem->id}}refm">{{$mem->name}}  {{$mem->lname}}</option>
                                  @endforeach

                              </select>
                              @if($ifrefm == 1)
                                @else
                                <small class="text-muted"><a  href="{{ URL::to('Nonlife/allinone/createmember??/Nonlife/create') }}">Create new Member</a></small>

                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Asset Owner</label>

                            <div class="col-md-6">

                               @if($ifaow == 1)
                              @else
                              <label for="">  <input   class="subject-list memtype" type="checkbox" value="2">Organization </label>

                              @endif

                                    @if($ifaow == 1)
                                   @else
                                     <label for=""><input   class="subject-list memtype" type="checkbox" value="1">Member </label>
                                   @endif
                                  <script type="text/javascript">
                              	    $('.subject-list').on('change', function() {
                              		    $('.subject-list').not(this).prop('checked', false);
                              		});
                                  </script>
                                @if($ifaow == 1)
                              <select disabled class=" form-control memt portmember " id="" name="edit_ref_id" onchange="window.location.href=this.value;"  >

                                @else
                                <select class=" form-control memt portmember nameid" id="" name="edit_ref_id" onchange="window.location.href=this.value;"  >
                                  @endif
                                @foreach ($ownass as $mem)
                                    <option value="{{$url1}}??/aow{{$mem->id}}aow">{{$mem->name}}  {{$mem->lname}}</option>
                                @endforeach

                              </select>
                              @if($ifaow == 1)
                                @else
                              <small class="text-muted"><a  href="{{ URL::to('Nonlife/allinone/createmember?owner??/Nonlife/create/??') }}{{$url1}}">Create new Member</a> Or <a  href="{{ URL::to('Nonlife/allinone/createorganize?owner??/Nonlife/create') }}{{$url1}}">Organization</a> here</small>
                              @endif
                            </div>
                        </div>


                          </div>
                            </div>
                      </div>
                    </div>
                    <br />
                    <div class="card">
                      <div class="card-header">
                        Refered Asset

                      </div>
                      <div class="card-body">
                    <div class="row">
                      <div class="column">
                        <label for="btn2">
                          @if($ifport == 1)
                          <input type="checkbox" class="yesno btn2" checked/>
                          @else
                            <input type="checkbox" class="yesno btn2" />
                            @endif
                            Yes
                        </label>
                        <label for="btn1">
                            <input type="checkbox" class="yesno btn1" />
                            No
                        </label>

                        <script type="text/javascript">
                          $('.yesno').on('change', function() {
                            $('.yesno').not(this).prop('checked', false);
                        });
                        </script>
                        @if($ifport == 1)
                        <div class="more" >

                        @else
                        <div class="more" style="display:none">
                        @endif
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Portfolio</label>

                        <div class="col-md-6">
                          @if($ifaow == 0)
                          <select disabled class=" form-control me portasset portnum " name="port_id" onchange="window.location.href=this.value;" >
                            @endif
                          @if($ifport == 1)
                          <select disabled class=" form-control me portasset portnum " name="port_id" onchange="window.location.href=this.value;" >
                            @else
                            <select class=" form-control me portasset portnum " name="port_id" onchange="window.location.href=this.value;" >

                            @endif
                            @if($ifport == 0)
                            <option></option>
                            @endif
                            @foreach ($portn as $mem)
                                <option value="{{$url1}}??/pnumber/pf{{$mem->id}}pf">{{$mem->number}} </option>
                            @endforeach


                          </select><br />

                          @if($ifport == 1)
                            @else
                          <small class="text-muted">No portfolio ?  <a  href="{{ route('portfolio.create') }}??{{$url1}}pty30ptystrc15strcblc80blc">Create new Portfolio</a> here</small>
                          @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label"></label>

                        <div class="col-md-6">

                          @if($ifas == 1)
                          @elseif($ifport == 0)
                          @else
                          <a style="color:red" class ="pn"href="{{ URL::to('Nonlife/Nonlife/allinone/createasset') }}??{{$url1}}">Create new Asset</a>

                          @endif
                        </div>
                    </div>

                  </div>
                      </div>
                        </div>
                  </div>
                </div>
                <br />
                <div class="card">
                  <div class="card-header">
                    Portfolio Management For Add New Asset

                  </div>
                  <div class="card-body">
                <div class="row">
                  <div class="column">




                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Portfolio</label>

                    <div class="col-md-6">
                      @if($ifaow == 0)
                      <select disabled class=" form-control me portasset portnum " name="port_id" onchange="window.location.href=this.value;" >
                        @endif
                      @if($ifwealth == 1)
                      <select disabled class=" form-control me portasset portnum " name="port_id" onchange="window.location.href=this.value;" >
                        @else
                        <select class=" form-control me portasset portnum nameid" name="port_id" onchange="window.location.href=this.value;" required autofocus >

                        @endif
                        @if($ifwealth == 0)
                        <option></option>
                        @endif
                        @foreach ($portwealth as $mem)
                            @foreach($curport as $cu)
                            <option value="{{$curport}}">{{$cu->number}} </option>
                            @endforeach
                            <option value="{{$url1}}??/WealthNon/pw{{$mem->id}}pw">{{$mem->number}} </option>
                        @endforeach


                      </select>
                      @if($ifwealth == 1)
                        @else
                      <small class="text-muted">No portfolio ?  <a  href="{{ route('portfolio.create') }}??{{$url1}}/WealthNon/pty0ptystrcwn15strcwnblc0blc">Create new Portfolio</a> here</small>
                      @endif
                    </div>
                </div>

                  </div>
                    </div>
              </div>
            </div>
            <br />
                    <div class="clones">
                    <div class="card">
                      <div class="card-header">
                        Asset Management

                      </div>
                      <div class="card-body">
                    <div class="row">
                      <div class="column">
                        @if($ifport == 1)
                        <div class="more" >

                        @else
                        <div class="more" style="display:none">
                          @endif
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Refered Asset</label>

                            <div class="col-md-6">
                              <select class=" form-control as" name="ref_to_asset[]"  >


                                    @foreach ($asset as $mem)
                                     <option value="{{$mem->id}}">{{$mem->name}}</option>
                                    @endforeach


                              </select>

                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                      <label class="col-md-4 control-label">Asset type</label>
                        <div class="col-md-6">
                          <select class=" form-control assettype findis" name="la_nla_type[]">

                              <option ></option>
                              @foreach ($assettype as $portca)
                                  <option value="{{$portca->id}}">{{$portca->la_nla_type}} {{$portca->nla_sub_type}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>
                        <div class="form-group">
                      <label class="col-md-4 control-label">Issuer</label>
                        <div class="col-md-6">
                          <select class=" form-control findissue findbranch" name="issued_by[]">

                              <option ></option>


                          </select>

                        </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Branch</label>
                        <div class="col-md-6">
                          <select class=" form-control branch" name="branch_id[]">

                              <option ></option>
                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Asset name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name[]" >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">
                        <div class="form-group{{ $errors->has('ref_name') ? ' has-error' : '' }}">
                            <label for="ref_name" class="col-md-4 control-label la22">ref name</label>

                            <div class="col-md-6">
                                <input id="ref_name" type="text" class="form-control" name="ref_name[]" >

                                @if ($errors->has('ref_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_number1') ? ' has-error' : '' }}">
                            <label for="ref_number1" class="col-md-4 control-label la19">Ref Number1</label>

                            <div class="col-md-6">
                                <input id="ref_number1" type="text" class="form-control" name="ref_number1[]" >

                                @if ($errors->has('ref_number1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_number1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_number2') ? ' has-error' : '' }}">
                            <label for="ref_number2" class="col-md-4 control-label la20">Ref Number2</label>

                            <div class="col-md-6">
                                <input id="ref_number2" type="text" class="form-control" name="ref_number2[]" >

                                @if ($errors->has('ref_number2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_number2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_number3') ? ' has-error' : '' }}">
                            <label for="ref_number3" class="col-md-4 control-label la21">Ref number3</label>

                            <div class="col-md-6">
                                <input id="ref_number3" type="text" class="form-control" name="ref_number3[]" >

                                @if ($errors->has('ref_number3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_number3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info1') ? ' has-error' : '' }}">
                            <label for="ref_info1" class="col-md-4 control-label la">Ref Info1</label>

                            <div class="col-md-6">
                                <input id="ref_info1" type="text" class="form-control" name="ref_info1[]" >

                                @if ($errors->has('ref_info1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info2') ? ' has-error' : '' }}">
                            <label for="ref_info2" class="col-md-4 control-label la2">Ref Info2</label>

                            <div class="col-md-6">
                                <input id="ref_info2" type="text" class="form-control" name="ref_info2[]" >

                                @if ($errors->has('ref_info2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info2') ? ' has-error' : '' }}">
                            <label for="ref_info2" class="col-md-4 control-label la3">Ref Info3</label>

                            <div class="col-md-6">
                                <input id="ref_info2" type="text" class="form-control" name="ref_info3[]" >

                                @if ($errors->has('ref_info2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info4') ? ' has-error' : '' }}">
                            <label for="ref_info4" class="col-md-4 control-label la4">Ref Info4</label>

                            <div class="col-md-6">
                                <input id="ref_info4" type="text" class="form-control" name="ref_info4[]" >

                                @if ($errors->has('ref_info4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info5') ? ' has-error' : '' }}">
                            <label for="ref_info5" class="col-md-4 control-label la5">Ref Info5</label>

                            <div class="col-md-6">
                                <input id="ref_info5" type="text" class="form-control" name="ref_info5[]" >

                                @if ($errors->has('ref_info5'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info5') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="column">

                        <div class="form-group{{ $errors->has('ref_info6') ? ' has-error' : '' }}">
                            <label for="ref_info6" class="col-md-4 control-label la6">Ref Info6</label>

                            <div class="col-md-6">
                                <input id="ref_info6" type="text" class="form-control" name="ref_info6[]" >

                                @if ($errors->has('ref_info6'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info6') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('ref_info7') ? ' has-error' : '' }}">
                            <label for="ref_info7" class="col-md-4 control-label la7">Ref Info7</label>

                            <div class="col-md-6">
                                <input id="ref_info7" type="text" class="form-control" name="ref_info7[]" >

                                @if ($errors->has('ref_info7'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info7') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info8') ? ' has-error' : '' }}">
                            <label for="ref_info8" class="col-md-4 control-label la8">Ref Info8</label>

                            <div class="col-md-6">
                                <input id="ref_info8" type="text" class="form-control" name="ref_info8[]" >

                                @if ($errors->has('ref_info8'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info8') }}</strong>
                                    </span>
                                @endif
                                <br />
                                <label >
                                    <input type="checkbox" id="myCheck5"  onclick="myFunction5()" />
                                    Add More Detail
                                </label>
                            </div>
                        </div>
                        <div  id="text5"style="display:none;" >
                        <div class="form-group{{ $errors->has('ref_info9') ? ' has-error' : '' }}">
                            <label for="ref_info9" class="col-md-4 control-label la9">Ref Info9</label>

                            <div class="col-md-6">
                                <input id="ref_info9" type="text" class="form-control" name="ref_info9[]" >

                                @if ($errors->has('ref_info9'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info9') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info10') ? ' has-error' : '' }}">
                            <label for="ref_info10" class="col-md-4 control-label la10">Ref Info10</label>

                            <div class="col-md-6">
                                <input id="ref_info10" type="text" class="form-control" name="ref_info10[]" >

                                @if ($errors->has('ref_info10'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info10') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info11') ? ' has-error' : '' }}">
                            <label for="ref_info11" class="col-md-4 control-label la11">Ref Info11</label>

                            <div class="col-md-6">
                                <input id="ref_info11" type="text" class="form-control" name="ref_info11[]" >

                                @if ($errors->has('ref_info11'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info11') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info12') ? ' has-error' : '' }}">
                            <label for="ref_info12" class="col-md-4 control-label la12">Ref Info12</label>

                            <div class="col-md-6">
                                <input id="ref_info12" type="text" class="form-control" name="ref_info12[]" >

                                @if ($errors->has('ref_info12'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info12') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info13') ? ' has-error' : '' }}">
                            <label for="ref_info8" class="col-md-4 control-label la13">Ref Info13</label>

                            <div class="col-md-6">
                                <input id="ref_info13" type="text" class="form-control" name="ref_info13[]" >

                                @if ($errors->has('ref_info13'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info13') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info14') ? ' has-error' : '' }}">
                            <label for="ref_info14" class="col-md-4 control-label la14">Ref Info14</label>

                            <div class="col-md-6">
                                <input id="ref_info14" type="text" class="form-control" name="ref_info14[]" >

                                @if ($errors->has('ref_info14'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info14') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info15') ? ' has-error' : '' }}">
                            <label for="ref_info15" class="col-md-4 control-label la15">Ref Info15</label>

                            <div class="col-md-6">
                                <input id="ref_info15" type="text" class="form-control" name="ref_info15[]" >

                                @if ($errors->has('ref_info15'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info15') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info16') ? ' has-error' : '' }}">
                            <label for="ref_info16" class="col-md-4 control-label la16">Ref Info16</label>

                            <div class="col-md-6">
                                <input id="ref_info8" type="text" class="form-control" name="ref_info16[]" >

                                @if ($errors->has('ref_info16'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info16') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info17') ? ' has-error' : '' }}">
                            <label for="ref_info17" class="col-md-4 control-label la17">Ref Info17</label>

                            <div class="col-md-6">
                                <input id="ref_info17" type="text" class="form-control" name="ref_info17[]" >

                                @if ($errors->has('ref_info17'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info17') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info18') ? ' has-error' : '' }}">
                            <label for="ref_info18" class="col-md-4 control-label la18">Ref Info18</label>

                            <div class="col-md-6">
                                <input id="ref_info18" type="text" class="form-control" name="ref_info18[]" >

                                @if ($errors->has('ref_info18'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info18') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount[]" >

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="value" class="col-md-4 control-label">Estimate Market Value</label>

                            <div class="col-md-6">
                                <input id="value" type="text" class="form-control" name="value[]" >

                                @if ($errors->has('value'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('value')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="cost" class="col-md-4 control-label">Cost</label>

                            <div class="col-md-6">
                                <input id="cost" type="text" class="form-control" name="cost[]" >

                                @if ($errors->has('cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('valid_from') ? ' has-error' : '' }}">
                            <label for="valid_from" class="col-md-4 control-label">Valid From</label>

                            <div class="col-md-6">

                              <select id="date" type="text" name="df[]"   placeholder="วันที่">
                                <?php $currentyear = date('Y');
                                ?>
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

                              </select> /  <select type="text" name="mf[]"   placeholder="เดือนที่">

                                <option value ="01">  01  </option>
                                <option value ="02">  02  </option>
                                <option value ="03">  03  </option>
                                <option value ="04">  04  </option>
                                <option value ="05">  05  </option>
                                <option value ="06">  06  </option>
                                <option value ="07">  07  </option>
                                <option value ="08">  08  </option>
                                <option value ="09">  09  </option>

                              @for ($i =10; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                              </select> / <select type="text" name="yf[]"   placeholder="ปี">
                                @for ($i =++$currentyear; $i >= 1900; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                </select><br>
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('valid_to') ? ' has-error' : '' }}">
                            <label for="valid_to" class="col-md-4 control-label">Valid To</label>

                            <div class="col-md-6">

                              <select id="date" type="text" name="dt[]"   placeholder="วันที่">
                                <?php $currentyear = date('Y');

                                ?>
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

                              </select> /  <select type="text" name="mt[]"   placeholder="เดือนที่">

                                <option value ="01">  01  </option>
                                <option value ="02">  02  </option>
                                <option value ="03">  03  </option>
                                <option value ="04">  04  </option>
                                <option value ="05">  05  </option>
                                <option value ="06">  06  </option>
                                <option value ="07">  07  </option>
                                <option value ="08">  08  </option>
                                <option value ="09">  09  </option>

                              @for ($i =10; $i <= 12; $i++)

                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                              </select> / <select type="text" name="yt[]"   placeholder="ปี">
                                <option id="demo" ></option>
                                @for ($i =++$currentyear; $i >= 1900; $i--)

                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                                </select><br>
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif

                                <label for="btn2">
                                    <input id="mySelect"  onchange="myFunction()" type="checkbox" class="" />
                                    Lifetime
                                </label>


                            </div>

                        </div>






                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label">Note</label>

                            <div class="col-md-6">
                                <textarea id="note" type="text" class="form-control" name="note[]" ></textarea>
                                <br />
                                <label for="chkPassport">
                                    <input type="checkbox" class="chkPassport" checked/>
                                    Add Asset Transaction
                                </label>
                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <br />

                <div class="card dvPassport"   >
                  <div class="card-header">
                    Asset Transaction

                  </div>
                  <div class="card-body">
                <div class="row" >

                  <div class="column">
                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                        <label for="date" class="col-md-4 control-label">Date</label>

                        <div class="col-md-6">

                          <select id="date" type="text" name="d[]"   placeholder="วันที่">3
                            <?php $currentyear = date('Y');
                            ?>
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

                          </select> /  <select type="text" name="m[]"   placeholder="เดือนที่">

                            <option value ="01">  01  </option>
                            <option value ="02">  02  </option>
                            <option value ="03">  03  </option>
                            <option value ="04">  04  </option>
                            <option value ="05">  05  </option>
                            <option value ="06">  06  </option>
                            <option value ="07">  07  </option>
                            <option value ="08">  08  </option>
                            <option value ="09">  09  </option>

                          @for ($i =10; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                          </select> / <select type="text" name="y[]"   placeholder="ปี">
                            @for ($i =$currentyear; $i >= 1900; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select><br>
                            @if ($errors->has('date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">
                    <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                        <label for="ref_name" class="col-md-4 control-label">Time</label>

                        <div class="col-md-6">
                          <input name="time[]" class="timepicker form-control" type="text" placeholder="00:00:00">
                          <script type="text/javascript">

                              $('.timepicker').datetimepicker({

                                  format: 'HH:mm:ss'

                              });

                          </script>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('l_s') ? ' has-error' : '' }}">
                        <label for="ref_name" class="col-md-4 control-label">Long/Short</label>
                    <div class="col-md-6">
                      <label for="btn2">
                          <input id="Buyselect"  onchange="Buy()" type="checkbox" class="buysell" />
                          Buy
                      </label>
                      <label for="btn2">
                          <input id="Sellselect"  onchange="Sell()" type="checkbox" class="buysell " />
                          Sell
                      </label>
                      <script type="text/javascript">
                        $('.buysell').on('change', function() {
                          $('.buysell').not(this).prop('checked', false);
                      });
                    </script>
                      <select class=" form-control "name="l_s[]">
                              <option id="ls">  </option>

                              <option value="open">Long</option>
                              <option value="close">Short</option>


                      </select>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('o_c') ? ' has-error' : '' }}">
                    <label for="ref_name" class="col-md-4 control-label">Open/Close</label>
                <div class="col-md-6">
                  <select class=" form-control "name="o_c[]">

                        <option id="oc">  </option>

                          <option value="open">Open</option>
                          <option value="close">Close</option>


                  </select>
                </div>
            </div>


                    <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                        <label for="symbol" class="col-md-4 control-label">Symbol</label>
                    <div class="col-md-6">
                        <input id="symbol" type="text" class="form-control" name="symbol[]" >

                        @if ($errors->has('symbol'))
                            <span class="help-block">
                                <strong>{{ $errors->first('symbol') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
              <div class="column">
                <div class="form-group{{ $errors->has('volumn') ? ' has-error' : '' }}">
                    <label for="volumn" class="col-md-4 control-label">Volumn</label>
                <div class="col-md-6">
                    <input id="volumn" type="text" class="form-control" name="volumn[]" >

                    @if ($errors->has('volumn'))
                        <span class="help-block">
                            <strong>{{ $errors->first('volumn') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                <label for="price" class="col-md-4 control-label">Price</label>
            <div class="col-md-6">
                <input id="price" type="text" class="form-control" name="price[]" >

                @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label for="status" class="col-md-4 control-label">Status</label>
        <div class="col-md-6">
          <select class=" form-control department" id="nameid"name="status[]">

              <option ></option>
              @foreach ($status as $p)
                  <option value="{{$p->id}}">{{$p->name}}</option>
              @endforeach

          </select>
        </div>
    </div>

    <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
        <label for="note" class="col-md-4 control-label">Note</label>
    <div class="col-md-6">
        <textarea id="note" type="text" class="form-control" name="note[]" ></textarea>

        @if ($errors->has('note'))
            <span class="help-block">
                <strong>{{ $errors->first('note') }}</strong>
            </span>
        @endif
    </div>
</div>


                </div>
                </div>
              </div>
            </div>
            <br />
            </div>

            <br />
            <div class="cloned" >
              <br />


          <br />


            </div>
            <br />

            <a class="btn btn-default cloning" type="button">Add more Asset</a>



            <br />
            <br />

            <div style="border:none" class="card text-left">


            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">


                <div class="col-md-6">
                <label for="">  <input   class="subject-list memtype" type="checkbox" name="share" value="1"> Share This Asset With Refered Member / Organization </label>
                <br />




                      <br />
                              <button type="submit" class="btn btn-success">
                                  Submit
                              </button>

                              <a class="btn btn-danger" href="{{URL::to('Nonlife/create')}}">Cancel</a>



                </div>
            </div>
            </div>

                    </form>
                </div>
            </div>


    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".cloning").click(function(){
    $(".clones").clone().removeClass('clones').appendTo(".cloned");

  });
});
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    $("p").clone().appendTo("body");
  });
});
</script>
<script>
function moreass() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $(".nameid").select2({
            placeholder: "Select a Name",
          //  allowClear: true
        });
</script>


@endsection

<script type="text/javascript">

      $("#serm").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}

function myFunction2() {
  var copyText = document.getElementById("myInput2");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
    </section>



    <!-- /.content -->
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $(".btn1").click(function(){
      $(".more").hide();
    });
    $(".btn2").click(function(){
      $(".more").show();
    });
  });
  </script>

  <script>
  $(function () {
          $("#chkmoreasset").click(function () {
              if ($(this).is(":checked")) {
                  $("#dvAsset").show();
                  $("#dvAsset").hide();
              } else {
                  $("#dvAsset").hide();
                  $("#dvAsset").show();
              }
          });
      });
      </script>

  <script>
  $(function () {
          $(".chkPassport").click(function () {
              if ($(this).is(":checked")) {
                  $(".dvPassport").show();
                  $(".AddPassport").hide();
              } else {
                  $(".dvPassport").hide();
                  $(".AddPassport").show();
              }
          });
      });
      </script>


      <script>
      $(function () {
              $(".chkAsset").click(function () {
                  if ($(this).is(":checked")) {
                      $(".dvAsset").show();
                      $(".AddAsset").hide();
                  } else {
                      $(".dvAsset").hide();
                      $(".AddAsset").show();
                  }
              });
          });
          </script>

      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

      <script type="text/javascript">

            $(".membername").select2({
                  placeholder: "Select a Name",
                  allowClear: true
              });
      </script>



      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

      <script type="text/javascript">
          $(document).ready(function(){
              $(document).on('change','.portnum',function(){
              //  console.log("hmm its change");

                  var department_id=$(this).val();
                  //console.log(department_id);
                  var div=$(this).parent();
                  var op=" ";
                  var op2=" ";
                  var url1 = <?php echo json_encode($url1) ?>;
                  $.ajax({
                      type:'get',
                      url:'{!!URL::to('findPortnum')!!}',
                      data:{'id':department_id},

                      success:function(data){
                        console.log('success');

                        console.log(data);

                       console.log(data.length);

                        for(var i=0; i<data.length;i++){
                          op2+=data[i].id;
                        //  {{ URL::to('Nonlife/allinone/createasset')}}??{{$url1}}
                          op+='<a href="Nonlife/allinone/createasset??{{$url1}}/pN'+data[i].id+'">Create new Asset</a>';

      }
                        $('.pn').html(" ");
                        $('.pn').append(op);
                        console.log(op);

                      },
                      error:function(){

                      }
                  });
              });
          });
      </script>


      <script type="text/javascript">
          $(document).ready(function(){
              $(document).on('change','.portmember',function(){
              //  console.log("hmm its change");

                  var department_id=$(this).val();
                  //console.log(department_id);
                  var div=$(this).parent();
                  var op=" ";
                  var op2=" ";
                  $.ajax({
                      type:'get',
                      url:'{!!URL::to('findPortmember')!!}',
                      data:{'id':department_id},

                      success:function(data){
                        console.log('success');

                        console.log(data);

                       console.log(data.length);
                       op+='<option value="0" selected disabled>chose portfolio</option>';
                        for(var i=0; i<data.length;i++){
                          op2+=data[i].id;
                            op+='<option value="'+data[i].id+'">'+data[i].number+'</option>';

      }
                        $('.me').html(" ");
                        $('.me').append(op);
                        console.log(op);

                      },
                      error:function(){

                      }
                  });
              });
          });
      </script>

      <script type="text/javascript">
          $(document).ready(function(){
              $(document).on('change','.portasset',function(){
              //  console.log("hmm its change");

                  var department_id=$(this).val();
                  //console.log(department_id);
                  var div=$(this).parent();
                  var op=" ";
                  var op2=" ";
                  $.ajax({
                      type:'get',
                      url:'{!!URL::to('findPortasset')!!}',
                      data:{'id':department_id},

                      success:function(data){
                        console.log('success');

                        console.log(data);

                       console.log(data.length);
                       op+='<option value="0" selected disabled>chose asset</option>';
                        for(var i=0; i<data.length;i++){
                          op2+=data[i].id;
                            op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

      }
                        $('.as').html(" ");
                        $('.as').append(op);
                        console.log(op);

                      },
                      error:function(){

                      }
                  });
              });
          });
      </script>
      <script type="text/javascript">
          $(document).ready(function(){
              $(document).on('change','.memid',function(){
              //  console.log("hmm its change");

                  var department_id=$(this).val();
                  //console.log(department_id);
                  var div=$(this).parent();
                  var op=" ";
                  var op2=" ";
                  $.ajax({
                      type:'get',
                      url:'{!!URL::to('findmemid')!!}',
                      data:{'id':department_id},

                      success:function(data){
                        console.log('success');

                        console.log(data);

                       console.log(data.length);
                       op+='<option value="0" selected disabled>chose asset</option>';
                        for(var i=0; i<data.length;i++){
                          op2+=data[i].id;
                            op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

      }
                        $('.as').html(" ");
                        $('.as').append(op);
                        console.log(op);

                      },
                      error:function(){

                      }
                  });
              });
          });
      </script>
      <script type="text/javascript">
          $(document).ready(function(){
              $(document).on('change','.memrefid',function(){
              //  console.log("hmm its change");

                  var department_id=$(this).val();
                  //console.log(department_id);
                  var div=$(this).parent();
                  var op=" ";
                  var op2=" ";
                  $.ajax({
                      type:'get',
                      url:'{!!URL::to('findmemrefid')!!}',
                      data:{'id':department_id},

                      success:function(data){
                        console.log('success');

                        console.log(data);

                       console.log(data.length);
                       op+='<option value="0" selected disabled>chose asset</option>';
                        for(var i=0; i<data.length;i++){
                          op2+=data[i].id;
                            op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

      }
                        $('.as').html(" ");
                        $('.as').append(op);
                        console.log(op);

                      },
                      error:function(){

                      }
                  });
              });
          });
      </script>

      <script type="text/javascript">
          $(document).ready(function(){
              $(document).on('change','.memtype',function(){
              //  console.log("hmm its change");

                  var department_id=$(this).val();
                  //console.log(department_id);
                  var div=$(this).parent();
                  var op=" ";
                  var op2=" ";
                  var url1 = <?php echo json_encode($url1) ?>;
                  $.ajax({
                      type:'get',
                      url:'{!!URL::to('findmemtype')!!}',
                      data:{'id':department_id},

                      success:function(data){
                        console.log('success');

                        console.log(data);

                       console.log(data.length);
                       op+='<option value="0" selected disabled>Select Member </option>';
                        for(var i=0; i<data.length;i++){
                          op2+=data[i].id;
                            op+='<option value="{{$url1}}??/owner/aow'+data[i].id+'aow">'+data[i].name+' '+data[i].lname+'</option>';

      }
                        $('.memt').html(" ");
                        $('.memt').append(op);
                        console.log(op);

                      },
                      error:function(){

                      }
                  });
              });
          });
      </script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script type="text/javascript">
  $('.subject-list').on('change', function() {
    $('.subject-list').not(this).prop('checked', false);
});
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.assettype',function(){
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
            var opn1=" ";
            var opn2=" ";
            var opn3=" ";
            var opn4=" ";

            $.ajax({
                type:'get',
                url:'{!!URL::to('findAssetLabel')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);

                  for(var i=0; i<data.length;i++){
                    op+='<label value="'+data[i].ref_info_head1+'">'+data[i].ref_info_head1+'</label>';
                    op2+='<label value="'+data[i].ref_info_head2+'">'+data[i].ref_info_head2+'</label>';
                    op3+='<label value="'+data[i].ref_info_head3+'">'+data[i].ref_info_head3+'</label>';
                    op4+='<label value="'+data[i].ref_info_head4+'">'+data[i].ref_info_head4+'</label>';
                    op5+='<label value="'+data[i].ref_info_head5+'">'+data[i].ref_info_head5+'</label>';
                    op6+='<label value="'+data[i].ref_info_head6+'">'+data[i].ref_info_head6+'</label>';
                    op7+='<label value="'+data[i].ref_info_head7+'">'+data[i].ref_info_head7+'</label>';
                    op8+='<label value="'+data[i].ref_info_head8+'">'+data[i].ref_info_head8+'</label>';
                    op9+='<label value="'+data[i].ref_info_head9+'">'+data[i].ref_info_head9+'</label>';
                    op10+='<label value="'+data[i].ref_info_head10+'">'+data[i].ref_info_head10+'</label>';
                    op11+='<label value="'+data[i].ref_info_head11+'">'+data[i].ref_info_head11+'</label>';
                    op12+='<label value="'+data[i].ref_info_head12+'">'+data[i].ref_info_head12+'</label>';
                    op13+='<label value="'+data[i].ref_info_head13+'">'+data[i].ref_info_head13+'</label>';
                    op14+='<label value="'+data[i].ref_info_head14+'">'+data[i].ref_info_head14+'</label>';
                    op15+='<label value="'+data[i].ref_info_head15+'">'+data[i].ref_info_head15+'</label>';
                    op16+='<label value="'+data[i].ref_info_head16+'">'+data[i].ref_info_head16+'</label>';
                    op17+='<label value="'+data[i].ref_info_head17+'">'+data[i].ref_info_head17+'</label>';
                    op18+='<label value="'+data[i].ref_info_head18+'">'+data[i].ref_info_head18+'</label>';
                    opn1+='<label value="'+data[i].ref_num_head1+'">'+data[i].ref_num_head1+'</label>';
                    opn2+='<label value="'+data[i].ref_num_head2+'">'+data[i].ref_num_head2+'</label>';
                    opn3+='<label value="'+data[i].ref_num_head3+'">'+data[i].ref_num_head3+'</label>';
                    opn4+='<label value="'+data[i].ref_name_head+'">'+data[i].ref_name_head+'</label>';
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
                  $('.la21').html(" ");
                  $('.la22').html(" ");
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
                  $('.la19').append(opn1);
                  $('.la20').append(opn2);
                  $('.la21').append(opn3);
                  $('.la22').append(opn4);
                  console.log(op);
                  console.log(op2);
                },
                error:function(){

                }
            });
        });
    });
</script>

<script>
function myFunction5() {
  var checkBox = document.getElementById("myCheck5");
  var text = document.getElementById("text5");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>

<script>
$(function () {
        $(".chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $(".dvPassport").show();
                $(".AddPassport").hide();
            } else {
                $(".dvPassport").hide();
                $(".AddPassport").show();
            }
        });
    });
    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".btn-default").click(function(){
              var html = $(".clone").html();
              $(".increment").after(html);
          });

          $("body").on("click",".btn-danger",function(){
              $(this).parents(".control-group").remove();
          });

        });
    </script>
    <script>
function myFunction() {
  var x = document.getElementById("myRef");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<script>
function myFunction() {
  var x = document.getElementById("mySelect").value;
  document.getElementById("demo").innerHTML =  3000;
}
</script>
<script>
function Buy() {
  var x = document.getElementById("Buyselect").value;
  document.getElementById("ls").innerHTML =  "Long";
  document.getElementById("oc").innerHTML =  "Open";
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>

function Sell() {
  var x = document.getElementById("Sellselect").value;
  document.getElementById("ls").innerHTML =  "Short";
  document.getElementById("oc").innerHTML =  "Sell";
}
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.findis',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";



            $.ajax({
                type:'get',
                url:'{!!URL::to('findAssetIssue')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);

                 op+='<option value="0" selected disabled>Choose Issuer</option>';
                 for(var i=0; i<data.length;i++){
                   op+='<option value="'+data[i].member_id+'">'+data[i].member_name+'</option>';

                 }
                  $('.findissue').html(" ");

                  $('.findissue').append(op);
                  console.log(op);
                },
                error:function(){

                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.findbranch',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";



            $.ajax({
                type:'get',
                url:'{!!URL::to('findAssetIssueBranch')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);

                 op+='<option value="0" selected disabled>Choose Branch</option>';
                 for(var i=0; i<data.length;i++){
                   op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

                 }
                  $('.branch').html(" ");

                  $('.branch').append(op);
                  console.log(op);
                },
                error:function(){

                }
            });
        });
    });
</script>
