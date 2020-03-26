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
                    <form class="form-horizontal" role="form" method="POST" action="{{URL::to('SecurityBroke/allinone/save')}}">
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
                              <select class=" form-control " id="nameid" name="edit_ref_id" onchange="window.location.href=this.value;">


                                  @foreach ($member as $mem)
                                      <option value="{{$url1}}??/refm{{$mem->id}}refm">{{$mem->name}}  {{$mem->lname}}</option>
                                  @endforeach

                              </select>
                              <small class="text-muted"><a  href="{{ URL::to('SecurityBroke/allinone/createmember??/SecurityBroke/create') }}">Create new Member</a> Or <a  href="{{ URL::to('SecurityBroke/allinone/createorganize??/SecurityBroke/create') }}">Organization</a> here</small>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Asset Owner</label>

                            <div class="col-md-6">
                            <label for="">  <input   class="subject-list memtype" type="checkbox" value="2">Organization </label>
                                  <label for=""><input   class="subject-list memtype" type="checkbox" value="1">Member </label>
                                  <script type="text/javascript">
                              	    $('.subject-list').on('change', function() {
                              		    $('.subject-list').not(this).prop('checked', false);
                              		});
                                  </script>

                              <select class=" form-control memt portmember" id="" name="edit_ref_id" onchange="window.location.href=this.value;" required autofocus>

                                @foreach ($ownass as $mem)
                                    <option value="{{$url1}}??/aow{{$mem->id}}aow">{{$mem->name}}  {{$mem->lname}}</option>
                                @endforeach

                              </select>

                              <small class="text-muted"><a  href="{{ URL::to('SecurityBroke/allinone/createmember?owner??/SecurityBroke/create/??') }}{{$url1}}">Create new Member</a> Or <a  href="{{ URL::to('SecurityBroke/allinone/createorganize?owner??/SecurityBroke/create') }}{{$url1}}">Organization</a> here</small>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Portfolio</label>

                            <div class="col-md-6">
                              <select class=" form-control me portasset portnum " name="port_id" onchange="window.location.href=this.value;"required autofocus>

                                @foreach ($portn as $mem)
                                    <option value="{{$url1}}??/pnumber/pf{{$mem->id}}pf">{{$mem->number}} </option>
                                @endforeach


                              </select>
                              <small class="text-muted">No portfolio ?  <a  href="{{ route('portfolio.create') }}??{{$url1}}pty30ptystrc15strcblc80blc">Create new Portfolio</a> here</small>
                            </div>
                        </div>
                          </div>
                            </div>
                      </div>
                    </div>
                    <br />
                    <div class="control-group increment" >
                    <div class="card">
                      <div class="card-header">
                        Asset Management

                      </div>
                      <div class="card-body">
                    <div class="row">
                      <div class="column">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Refered Asset</label>

                            <div class="col-md-6">
                              <select class=" form-control as" name="ref_to_asset" required autofocus>


                                    @foreach ($assetnl as $mem)
                                     <option value="{{$mem->id}}">{{$mem->name}}</option>
                                    @endforeach


                              </select>
                              <small class="text-muted">No asset ?  <a  class ="pn"href="{{ URL::to('SecurityBroke/SecurityBroke/allinone/createasset') }}??{{$url1}}">Create new Asset</a> here</small>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Asset name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">
                        <div class="form-group{{ $errors->has('ref_name') ? ' has-error' : '' }}">
                            <label for="ref_name" class="col-md-4 control-label">ref name</label>

                            <div class="col-md-6">
                                <input id="ref_name" type="text" class="form-control" name="ref_name" >

                                @if ($errors->has('ref_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                      <label class="col-md-4 control-label">Asset type</label>
                        <div class="col-md-6">
                          <select class=" form-control assettype" name="la_nla_type">

                              <option ></option>
                              @foreach ($assettype as $portca)
                                  <option value="{{$portca->id}}">{{$portca->la_nla_type}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_number1') ? ' has-error' : '' }}">
                            <label for="ref_number1" class="col-md-4 control-label">Ref Number1</label>

                            <div class="col-md-6">
                                <input id="ref_number1" type="text" class="form-control" name="ref_number1" >

                                @if ($errors->has('ref_number1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_number1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_number2') ? ' has-error' : '' }}">
                            <label for="ref_number2" class="col-md-4 control-label">Ref Number2</label>

                            <div class="col-md-6">
                                <input id="ref_number2" type="text" class="form-control" name="ref_number2" >

                                @if ($errors->has('ref_number2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_number2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_number3') ? ' has-error' : '' }}">
                            <label for="ref_number3" class="col-md-4 control-label">Ref number3</label>

                            <div class="col-md-6">
                                <input id="ref_number3" type="text" class="form-control" name="ref_number3" >

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
                                <input id="ref_info1" type="text" class="form-control" name="ref_info1" >

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
                                <input id="ref_info2" type="text" class="form-control" name="ref_info2" >

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
                                <input id="ref_info2" type="text" class="form-control" name="ref_info3" >

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
                                <input id="ref_info4" type="text" class="form-control" name="ref_info4" >

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
                                <input id="ref_info5" type="text" class="form-control" name="ref_info5" >

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
                                <input id="ref_info6" type="text" class="form-control" name="ref_info6" >

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
                                <input id="ref_info7" type="text" class="form-control" name="ref_info7" >

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
                                <input id="ref_info8" type="text" class="form-control" name="ref_info8" >

                                @if ($errors->has('ref_info8'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info8') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" >

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="value" class="col-md-4 control-label">Value</label>

                            <div class="col-md-6">
                                <input id="value" type="text" class="form-control" name="value" >

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
                                <input id="cost" type="text" class="form-control" name="cost" >

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

                              <select id="date" type="text" name="df"   placeholder="วันที่">3
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

                              </select> /  <select type="text" name="mf"   placeholder="เดือนที่">

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
                              </select> / <select type="text" name="yf"   placeholder="ปี">
                                @for ($i =++$currentyear; $i >= 2014; $i--)
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

                              <select id="date" type="text" name="dt"   placeholder="วันที่">3
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

                              </select> /  <select type="text" name="mt"   placeholder="เดือนที่">

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
                              </select> / <select type="text" name="yt"   placeholder="ปี">
                                @for ($i =++$currentyear; $i >= 2014; $i--)

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


                        <div class="form-group{{ $errors->has('link_to_more') ? ' has-error' : '' }}">
                            <label for="link_to_more" class="col-md-4 control-label">Link To More</label>

                            <div class="col-md-6">
                                <input id="link_to_more" type="text" class="form-control" name="link_to_more" >

                                @if ($errors->has('link_to_more'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_to_more') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_pid') ? ' has-error' : '' }}">
                            <label for="contact_pid" class="col-md-4 control-label">Contact PID</label>

                            <div class="col-md-6">
                                <input id="contact_pid" type="text" class="form-control" name="contact_pid" >

                                @if ($errors->has('contact_pid'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_pid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label">Note</label>

                            <div class="col-md-6">
                                <textarea id="note" type="text" class="form-control" name="note" ></textarea>
                                <br />
                                <label for="chkPassport">
                                    <input type="checkbox" id="chkPassport" checked/>
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

                <div class="card" id="dvPassport"  >
                  <div class="card-header">
                    Asset Transaction

                  </div>
                  <div class="card-body">
                <div class="row" >

                  <div class="column">
                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                        <label for="date" class="col-md-4 control-label">Date</label>

                        <div class="col-md-6">

                          <select id="date" type="text" name="d"   placeholder="วันที่">3
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

                          </select> /  <select type="text" name="m"   placeholder="เดือนที่">

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
                          </select> / <select type="text" name="y"   placeholder="ปี">
                            @for ($i =$currentyear; $i >= 2014; $i--)
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
                          <input name="time" class="timepicker form-control" type="text" placeholder="เวลา">
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
                      <select class=" form-control "name="l_s">

                              <option>  </option>
                              <option value="open">Long</option>
                              <option value="close">Short</option>


                      </select>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('o_c') ? ' has-error' : '' }}">
                    <label for="ref_name" class="col-md-4 control-label">Open/Close</label>
                <div class="col-md-6">
                  <select class=" form-control "name="o_c">

                        <option>  </option>
                          <option value="open">Open</option>
                          <option value="close">Close</option>


                  </select>
                </div>
            </div>


                    <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                        <label for="symbol" class="col-md-4 control-label">Symbol</label>
                    <div class="col-md-6">
                        <input id="symbol" type="text" class="form-control" name="symbol" >

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
                    <input id="volumn" type="text" class="form-control" name="volumn" >

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
                <input id="price" type="text" class="form-control" name="price" >

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
          <select class=" form-control department" id="nameid"name="status">

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
        <textarea id="note" type="text" class="form-control" name="note" ></textarea>

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
            </div>

            <br />
            <div class="clone hide">
              <br />
              <div class="card">
                <div class="card-header">
                  Asset Management

                </div>
                <div class="card-body">
              <div class="row">
                <div class="column">


                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="name" class="col-md-4 control-label">Asset name</label>

                      <div class="col-md-6">
                          <input id="name" type="text" class="form-control" name="name" >

                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">
                  <div class="form-group{{ $errors->has('ref_name') ? ' has-error' : '' }}">
                      <label for="ref_name" class="col-md-4 control-label">ref name</label>

                      <div class="col-md-6">
                          <input id="ref_name" type="text" class="form-control" name="ref_name" >

                          @if ($errors->has('ref_name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('ref_name') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group">
                <label class="col-md-4 control-label">Asset type</label>
                  <div class="col-md-6">
                    <select class=" form-control assettype" name="la_nla_type">

                        <option ></option>
                        @foreach ($assettype as $portca)
                            <option value="{{$portca->id}}">{{$portca->la_nla_type}}</option>
                        @endforeach

                    </select>

                  </div>
                  </div>
                  <div class="form-group{{ $errors->has('ref_number1') ? ' has-error' : '' }}">
                      <label for="ref_number1" class="col-md-4 control-label">Ref Number1</label>

                      <div class="col-md-6">
                          <input id="ref_number1" type="text" class="form-control" name="ref_number1" >

                          @if ($errors->has('ref_number1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('ref_number1') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('ref_number2') ? ' has-error' : '' }}">
                      <label for="ref_number2" class="col-md-4 control-label">Ref Number2</label>

                      <div class="col-md-6">
                          <input id="ref_number2" type="text" class="form-control" name="ref_number2" >

                          @if ($errors->has('ref_number2'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('ref_number2') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('ref_number3') ? ' has-error' : '' }}">
                      <label for="ref_number3" class="col-md-4 control-label">Ref number3</label>

                      <div class="col-md-6">
                          <input id="ref_number3" type="text" class="form-control" name="ref_number3" >

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
                          <input id="ref_info1" type="text" class="form-control" name="ref_info1" >

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
                          <input id="ref_info2" type="text" class="form-control" name="ref_info2" >

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
                          <input id="ref_info2" type="text" class="form-control" name="ref_info3" >

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
                          <input id="ref_info4" type="text" class="form-control" name="ref_info4" >

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
                          <input id="ref_info5" type="text" class="form-control" name="ref_info5" >

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
                          <input id="ref_info6" type="text" class="form-control" name="ref_info6" >

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
                          <input id="ref_info7" type="text" class="form-control" name="ref_info7" >

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
                          <input id="ref_info8" type="text" class="form-control" name="ref_info8" >

                          @if ($errors->has('ref_info8'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('ref_info8') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                      <label for="amount" class="col-md-4 control-label">Amount</label>

                      <div class="col-md-6">
                          <input id="amount" type="text" class="form-control" name="amount" >

                          @if ($errors->has('amount'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('amount') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                      <label for="value" class="col-md-4 control-label">Value</label>

                      <div class="col-md-6">
                          <input id="value" type="text" class="form-control" name="value" >

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
                          <input id="cost" type="text" class="form-control" name="cost" >

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

                        <select id="date" type="text" name="df"   placeholder="วันที่">3
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

                        </select> /  <select type="text" name="mf"   placeholder="เดือนที่">

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
                        </select> / <select type="text" name="yf"   placeholder="ปี">
                          @for ($i =++$currentyear; $i >= 2014; $i--)
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

                        <select id="date" type="text" name="dt"   placeholder="วันที่">3
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

                        </select> /  <select type="text" name="mt"   placeholder="เดือนที่">

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
                        </select> / <select type="text" name="yt"   placeholder="ปี">
                          @for ($i =++$currentyear; $i >= 2014; $i--)

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


                  <div class="form-group{{ $errors->has('link_to_more') ? ' has-error' : '' }}">
                      <label for="link_to_more" class="col-md-4 control-label">Link To More</label>

                      <div class="col-md-6">
                          <input id="link_to_more" type="text" class="form-control" name="link_to_more" >

                          @if ($errors->has('link_to_more'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('link_to_more') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('contact_pid') ? ' has-error' : '' }}">
                      <label for="contact_pid" class="col-md-4 control-label">Contact PID</label>

                      <div class="col-md-6">
                          <input id="contact_pid" type="text" class="form-control" name="contact_pid" >

                          @if ($errors->has('contact_pid'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('contact_pid') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                      <label for="note" class="col-md-4 control-label">Note</label>

                      <div class="col-md-6">
                          <textarea id="note" type="text" class="form-control" name="note" ></textarea>
                          <br />
                          <label for="chkPassport">
                              <input type="checkbox" id="chkPassport" checked/>
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

          <div class="card" id="dvPassport"  >
            <div class="card-header">
              Asset Transaction

            </div>
            <div class="card-body">
          <div class="row" >

            <div class="column">
              <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                  <label for="date" class="col-md-4 control-label">Date</label>

                  <div class="col-md-6">

                    <select id="date" type="text" name="d"   placeholder="วันที่">3
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

                    </select> /  <select type="text" name="m"   placeholder="เดือนที่">

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
                    </select> / <select type="text" name="y"   placeholder="ปี">
                      @for ($i =$currentyear; $i >= 2014; $i--)
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
                    <input name="time" class="timepicker form-control" type="text" placeholder="เวลา">
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
                <select class=" form-control "name="l_s">

                        <option>  </option>
                        <option value="open">Long</option>
                        <option value="close">Short</option>


                </select>
              </div>
          </div>
          <div class="form-group{{ $errors->has('o_c') ? ' has-error' : '' }}">
              <label for="ref_name" class="col-md-4 control-label">Open/Close</label>
          <div class="col-md-6">
            <select class=" form-control "name="o_c">

                  <option>  </option>
                    <option value="open">Open</option>
                    <option value="close">Close</option>


            </select>
          </div>
      </div>


              <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                  <label for="symbol" class="col-md-4 control-label">Symbol</label>
              <div class="col-md-6">
                  <input id="symbol" type="text" class="form-control" name="symbol" >

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
              <input id="volumn" type="text" class="form-control" name="volumn" >

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
          <input id="price" type="text" class="form-control" name="price" >

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
    <select class=" form-control department" id="nameid"name="status">

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
  <textarea id="note" type="text" class="form-control" name="note" ></textarea>

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
            </div>
            <button class="btn btn-success" type="button">Add more asset</button>

            <br />
            <br />
            <div style="border:none" class="card text-left">


            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">


                <div class="col-md-6">
                <label for="">  <input   class="subject-list memtype" type="checkbox" value="2"> Share This Asset With Refered Member / Organization </label>
                <br />
                      <label for=""><input   class="subject-list memtype" type="checkbox" value="1"> Invite Refered Member To Join Organization (In case Organization) </label>


                      <br />
                      <br />
                              <button type="submit" class="btn btn-primary">
                                  Create
                              </button>



                </div>
            </div>
            </div>
            <br />

                    </form>
                </div>
            </div>


    </div>
</div>
@endsection
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
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
                        //  {{ URL::to('SecurityBroke/allinone/createasset')}}??{{$url1}}
                          op+='<a href="SecurityBroke/allinone/createasset??{{$url1}}/pN'+data[i].id+'">Create new Asset</a>';

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
                       op+='<option value="0" selected disabled>chose asset</option>';
                        for(var i=0; i<data.length;i++){
                          op2+=data[i].id;
                            op+='<option value="{{$url1}}??/owner/aow'+data[i].id+'aow">'+data[i].name+'</option>';

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
}
                  $('.la').html(" ");
                  $('.la2').html(" ");
                  $('.la3').html(" ");
                  $('.la4').html(" ");
                  $('.la5').html(" ");
                  $('.la6').html(" ");
                  $('.la7').html(" ");
                  $('.la8').html(" ");
                  $('.la').append(op);
                  $('.la2').append(op2);
                  $('.la3').append(op3);
                  $('.la4').append(op4);
                  $('.la5').append(op4);
                  $('.la6').append(op6);
                  $('.la7').append(op7);
                  $('.la8').append(op8);
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
    <script type="text/javascript">

        $(document).ready(function() {

          $(".btn-success").click(function(){
              var html = $(".clone").html();
              $(".increment").after(html);
          });

          $("body").on("click",".btn-danger",function(){
              $(this).parents(".control-group").remove();
          });

        });

    </script>
