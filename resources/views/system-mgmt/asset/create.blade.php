@extends('system-mgmt.asset.base')

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




</style>


<div class="container">
    <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">Add new asset</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('asset.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="column">
                            <div class="form-group">
                          <label class="col-md-4 control-label">Asset type</label>
                            <div class="col-md-6">
                              <select class=" form-control assettype findis" name="la_nla_type">

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
                              <select class=" form-control findissue findbranch" name="issued_by">

                                  <option ></option>


                              </select>

                            </div>
                            </div>

                            <div class="form-group">
                          <label class="col-md-4 control-label">Branch</label>
                            <div class="col-md-6">
                              <select class=" form-control branch" name="branch_id">

                                  <option ></option>
                              </select>

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
                            <label for="ref_name" class="col-md-4 control-label la22">ref name</label>

                            <div class="col-md-6">
                                <input id="ref_name" type="text" class="form-control" name="ref_name" >

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
                                <input id="ref_number1" type="text" class="form-control" name="ref_number1" >

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
                                <input id="ref_number2" type="text" class="form-control" name="ref_number2" >

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
                      </div>
                      <div class="column">
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
                                <input id="ref_info9" type="text" class="form-control" name="ref_info9" >

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
                                <input id="ref_info10" type="text" class="form-control" name="ref_info10" >

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
                                <input id="ref_info11" type="text" class="form-control" name="ref_info11" >

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
                                <input id="ref_info12" type="text" class="form-control" name="ref_info12" >

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
                                <input id="ref_info13" type="text" class="form-control" name="ref_info13" >

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
                                <input id="ref_info14" type="text" class="form-control" name="ref_info14" >

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
                                <input id="ref_info15" type="text" class="form-control" name="ref_info15" >

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
                                <input id="ref_info8" type="text" class="form-control" name="ref_info16" >

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
                                <input id="ref_info17" type="text" class="form-control" name="ref_info17" >

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
                                <input id="ref_info18" type="text" class="form-control" name="ref_info18" >

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
                                <input id="amount" type="text" class="form-control" name="amount" >

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

                              <select id="date" type="text" name="df"   placeholder="วันที่">
                                <?php $currentyear = 3000;
                                ?>
								  {{--date('Y')--}}
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
                                @for ($i =$currentyear; $i >= 1900; $i--)
                                <option value="{{ $i }}">ค.ศ.{{ $i }}</option>
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

                              <select id="date" type="text" name="dt"   placeholder="วันที่">
                                <?php $currentyear = 3000;

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
                              </select> /   <select type="text" name="yt"   placeholder="ปี">
                                <option id="demos" ></option>
                                @for ($i =++$currentyear; $i >= 1900; $i--)

                                <option value="{{ $i }}">ค.ศ.{{ $i }}</option>
                                @endfor
                                </select>
                            	<br>
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif

                                <label for="btn2">
                                    <input id="mySelects"  onchange="myFunctions()" type="checkbox" class="" />
                                    Lifetime
                                </label>


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

                        <div class="row" id="dvPassport"  >

                          <div class="column">
                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date" class="col-md-4 control-label">Date</label>

                                <div class="col-md-6">

                                  <select id="date" type="text" name="d"   placeholder="วันที่">3
                                    <?php $currentyear = 3000;
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
                                  </select> / <select type="text" name="y"  id="year2"  placeholder="ปี">
                                    @for ($i =$currentyear; $i >= 1900; $i--)
                                <option value="{{ $i }}">ค.ศ.{{ $i }}</option>
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
                              <label for="btn2">
                                  <input id="Buyselect"  onchange="Buy()" type="checkbox" class="yesno btn2" />
                                  Buy
                              </label>
                              <label for="btn2">
                                  <input id="Sellselect"  onchange="Sell()" type="checkbox" class="yesno btn2" />
                                  Sell
                              </label>
                              <script type="text/javascript">
                                $('.yesno').on('change', function() {
                                  $('.yesno').not(this).prop('checked', false);
                              });
                            </script>
                              <select class=" form-control "name="l_s">
                                      <option id="ls">  </option>

                                      <option value="open">Long</option>
                                      <option value="close">Short</option>


                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('o_c') ? ' has-error' : '' }}">
                            <label for="ref_name" class="col-md-4 control-label">Open/Close</label>
                        <div class="col-md-6">
                          <select class=" form-control "name="o_c">

                                <option id="oc">  </option>
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
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid2").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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
<script>
function myFunction() {
  var x = document.getElementsByClassName("example");
  x[0].innerHTML = "Hello World!";
}
</script>
@endsection

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
<script>
function myFunctions() {
  var x = document.getElementById("mySelects").value;
  document.getElementById("demos").innerHTML =  3000;
}
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
