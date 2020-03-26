@extends('system-mgmt.asset.base')

@section('action-content')
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
                <div class="panel-heading">Update Asset</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('asset.update', ['id' => $porttype->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                          <div class="column">
                            <div class="form-group">
                          <label class="col-md-4 control-label">Asset type</label>
                            <div class="col-md-6">
                              <select class=" form-control department assettype findis"  name="la_nla_type" value="{{$porttype->la_nla_type}}">

                                  <option value ="0">-Select-</option>
                                  @foreach ($portcat as $portca)
                                      <option value="{{$portca->id}}"{{$portca->id == $porttype->la_nla_type ? 'selected' : ''}}>{{$portca->la_nla_type}} {{$portca->nla_sub_type}}</option>
                                  @endforeach

                              </select>

                            </div>
                            </div>


                            <div class="form-group">
                          <label class="col-md-4 control-label">Issuer</label>
                            <div class="col-md-6">
                              <select class=" form-control findissue findbranch" name="issued_by">

                                @foreach ($issue as $is)
                                    <option value="{{$is->id}}"{{$is->id == $porttype->issued_by ? 'selected' : ''}}>{{$is->name}}</option>
                                @endforeach
                              </select>

                            </div>
                            </div>
                            <div class="form-group">
                          <label class="col-md-4 control-label">Branch</label>
                            <div class="col-md-6">
                              <select class=" form-control branch" name="branch_id">

                                @foreach ($branch as $is)
                                    <option value="{{$is->id}}"{{$is->id == $porttype->issued_by ? 'selected' : ''}}>{{$is->name}}</option>
                                @endforeach
                              </select>

                            </div>
                            </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$porttype->name}}" >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">


                        <div class="form-group{{ $errors->has('ref_name') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_name" class="col-md-4 control-label la22">{{$ref->ref_name_head}}</label>
                              @endforeach
                            <div class="col-md-6">
                                <input id="ref_name" type="text" class="form-control" name="ref_name" value="{{$porttype->ref_name}}">

                                @if ($errors->has('ref_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>






                        <div class="form-group{{ $errors->has('ref_number1') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_number1" class="col-md-4 control-label">{{$ref->ref_num_head1}}</label>
                            @endforeach
                            <div class="col-md-6">
                                <input id="ref_number1" type="text" class="form-control" name="ref_number1" value="{{$porttype->ref_number1}}">

                                @if ($errors->has('ref_number1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_number1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_number2') ? ' has-error' : '' }}">
                            @foreach($astrefinfo as $ref)
                            <label for="ref_number2" class="col-md-4 control-label">{{$ref->ref_num_head2}}</label>
                            @endforeach
                            <div class="col-md-6">
                                <input id="ref_number2" type="text" class="form-control" name="ref_number2" value="{{$porttype->ref_number2}}">

                                @if ($errors->has('ref_number2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_number2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_number3') ? ' has-error' : '' }}">
                            @foreach($astrefinfo as $ref)
                            <label for="ref_number3" class="col-md-4 control-label">{{$ref->ref_num_head3}}</label>
                            @endforeach
                            <div class="col-md-6">
                                <input id="ref_number3" type="text" class="form-control" name="ref_number3" value="{{$porttype->ref_number3}}">

                                @if ($errors->has('ref_number3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_number3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info1') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_info1" class="col-md-4 control-label la1">{{$ref->ref_info_head1}}</label>
                        @endforeach
                            <div class="col-md-6">
                                <input id="ref_info1" type="text" class="form-control" name="ref_info1" value="{{$porttype->ref_info1}}">

                                @if ($errors->has('ref_info1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info2') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_info1" class="col-md-4 control-label la2">{{$ref->ref_info_head2}}</label>
                        @endforeach

                            <div class="col-md-6">
                                <input id="ref_info2" type="text" class="form-control" name="ref_info2" value="{{$porttype->ref_info2}}">

                                @if ($errors->has('ref_info2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info2') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_info1" class="col-md-4 control-label la3">{{$ref->ref_info_head3}}</label>
                        @endforeach

                            <div class="col-md-6">
                                <input id="ref_info2" type="text" class="form-control" name="ref_info3" value="{{$porttype->ref_info3}}">

                                @if ($errors->has('ref_info2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info4') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_info1" class="col-md-4 control-label la4">{{$ref->ref_info_head4}}</label>
                        @endforeach

                            <div class="col-md-6">
                                <input id="ref_info4" type="text" class="form-control" name="ref_info4" value="{{$porttype->ref_info4}}">

                                @if ($errors->has('ref_info4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info5') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_info1" class="col-md-4 control-label la5">{{$ref->ref_info_head5}}</label>
                        @endforeach

                            <div class="col-md-6">
                                <input id="ref_info5" type="text" class="form-control" name="ref_info5" value="{{$porttype->ref_info5}}">

                                @if ($errors->has('ref_info5'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info5') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info6') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_info1" class="col-md-4 control-label la6">{{$ref->ref_info_head6}}</label>
                        @endforeach

                            <div class="col-md-6">
                                <input id="ref_info6" type="text" class="form-control" name="ref_info6" value="{{$porttype->ref_info6}}">

                                @if ($errors->has('ref_info6'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info6') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info7') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_info7" class="col-md-4 control-label la7">{{$ref->ref_info_head7}}</label>
                        @endforeach

                            <div class="col-md-6">
                                <input id="ref_info7" type="text" class="form-control" name="ref_info7" value="{{$porttype->ref_info7}}">

                                @if ($errors->has('ref_info7'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info7') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
							</div>
							  <div class="column">
                        <div class="form-group{{ $errors->has('ref_info8') ? ' has-error' : '' }}">
                          @foreach($astrefinfo as $ref)
                            <label for="ref_info8" class="col-md-4 control-label la8">{{$ref->ref_info_head8}}</label>
                        @endforeach

                            <div class="col-md-6">
                                <input id="ref_info8" type="text" class="form-control" name="ref_info8" value="{{$porttype->ref_info8}}">

                                @if ($errors->has('ref_info8'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info8') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @foreach($astrefinfo as $ref)
                        @if($ref->ref_info_head9 != NULL)
                        <div class="form-group{{ $errors->has('ref_info9') ? ' has-error' : '' }}">


                          <label for="ref_info1" class="col-md-4 control-label la9">{{$ref->ref_info_head9}}</label>




                            <div class="col-md-6">
                                <input id="ref_info9" type="text" class="form-control" name="ref_info9" value="{{$porttype->ref_info9}}" >

                                @if ($errors->has('ref_info9'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info9') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             
                          @else
                        @endif
                      @endforeach
                      
                      @foreach($astrefinfo as $ref)
                      @if($ref->ref_info_head10 != NULL)
                      <div class="form-group{{ $errors->has('ref_info10') ? ' has-error' : '' }}">


                        <label for="ref_info1" class="col-md-4 control-label la10">{{$ref->ref_info_head10}}</label>




                          <div class="col-md-6">
                              <input id="ref_info10" type="text" class="form-control" name="ref_info10" value="{{$porttype->ref_info10}}" >

                              @if ($errors->has('ref_info10'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ref_info10') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                        @else
                      @endif
                    @endforeach

                    @foreach($astrefinfo as $ref)
                    @if($ref->ref_info_head11 != NULL)
                    <div class="form-group{{ $errors->has('ref_info11') ? ' has-error' : '' }}">


                      <label for="ref_info1" class="col-md-4 control-label la11">{{$ref->ref_info_head11}}</label>




                        <div class="col-md-6">
                            <input id="ref_info11" type="text" class="form-control" name="ref_info11" value="{{$porttype->ref_info11}}" >

                            @if ($errors->has('ref_info11'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ref_info11') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                      @else
                    @endif
                  @endforeach

                  @foreach($astrefinfo as $ref)
                  @if($ref->ref_info_head12 != NULL)
                  <div class="form-group{{ $errors->has('ref_info12') ? ' has-error' : '' }}">


                    <label for="ref_info12" class="col-md-4 control-label la12">{{$ref->ref_info_head12}}</label>




                      <div class="col-md-6">
                          <input id="ref_info12" type="text" class="form-control" name="ref_info12" value="{{$porttype->ref_info12}}" >

                          @if ($errors->has('ref_info12'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('ref_info10') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                    @else
                  @endif
                @endforeach

                @foreach($astrefinfo as $ref)
                @if($ref->ref_info_head13 != NULL)
                <div class="form-group{{ $errors->has('ref_info13') ? ' has-error' : '' }}">


                  <label for="ref_info13" class="col-md-4 control-label la13">{{$ref->ref_info_head13}}</label>




                    <div class="col-md-6">
                        <input id="ref_info13" type="text" class="form-control" name="ref_info13" value="{{$porttype->ref_info13}}" >

                        @if ($errors->has('ref_info13'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ref_info13') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                  @else
                @endif
              @endforeach

              @foreach($astrefinfo as $ref)
              @if($ref->ref_info_head14 != NULL)
              <div class="form-group{{ $errors->has('ref_info14') ? ' has-error' : '' }}">


                <label for="ref_info14" class="col-md-4 control-label la14">{{$ref->ref_info_head14}}</label>




                  <div class="col-md-6">
                      <input id="ref_info10" type="text" class="form-control" name="ref_info14" value="{{$porttype->ref_info14}}" >

                      @if ($errors->has('ref_info14'))
                          <span class="help-block">
                              <strong>{{ $errors->first('ref_info14') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>
                @else
              @endif
            @endforeach

            @foreach($astrefinfo as $ref)
            @if($ref->ref_info_head15 != NULL)
            <div class="form-group{{ $errors->has('ref_info15') ? ' has-error' : '' }}">


              <label for="ref_info15" class="col-md-4 control-label la15">{{$ref->ref_info_head15}}</label>




                <div class="col-md-6">
                    <input id="ref_info15" type="text" class="form-control" name="ref_info15" value="{{$porttype->ref_info15}}" >

                    @if ($errors->has('ref_info15'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ref_info15') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
              @else
            @endif
          @endforeach

          @foreach($astrefinfo as $ref)
          @if($ref->ref_info_head16 != NULL)
          <div class="form-group{{ $errors->has('ref_info16') ? ' has-error' : '' }}">


            <label for="ref_info16" class="col-md-4 control-label la16">{{$ref->ref_info_head16}}</label>




              <div class="col-md-6">
                  <input id="ref_info16" type="text" class="form-control" name="ref_info16" value="{{$porttype->ref_info16}}" >

                  @if ($errors->has('ref_info16'))
                      <span class="help-block">
                          <strong>{{ $errors->first('ref_info16') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
            @else
          @endif
        @endforeach

        @foreach($astrefinfo as $ref)
        @if($ref->ref_info_head17 != NULL)
        <div class="form-group{{ $errors->has('ref_info17') ? ' has-error' : '' }}">


          <label for="ref_info17" class="col-md-4 control-label la17">{{$ref->ref_info_head17}}</label>




            <div class="col-md-6">
                <input id="ref_info17" type="text" class="form-control" name="ref_info17" value="{{$porttype->ref_info17}}" >

                @if ($errors->has('ref_info17'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ref_info17') }}</strong>
                    </span>
                @endif
            </div>
        </div>
          @else
        @endif
      @endforeach
      @foreach($astrefinfo as $ref)
      @if($ref->ref_info_head18 != NULL)
      <div class="form-group{{ $errors->has('ref_info18') ? ' has-error' : '' }}">


        <label for="ref_info18" class="col-md-4 control-label la18">{{$ref->ref_info_head18}}</label>




          <div class="col-md-6">
              <input id="ref_info18" type="text" class="form-control" name="ref_info18" value="{{$porttype->ref_info18}}" >

              @if ($errors->has('ref_info18'))
                  <span class="help-block">
                      <strong>{{ $errors->first('ref_info18') }}</strong>
                  </span>
              @endif
          </div>
      </div>
        @else
      @endif
    @endforeach

                        <div class="form-group">
                      <label class="col-md-4 control-label">Link Underlying</label>
                        <div class="col-md-6">
                          <select class=" form-control department"  name="link_underlying" value="{{$porttype->link_underlying}}">

                              <option value ="0">-Select-</option>
                              @foreach ($portcat as $portca)
                                  <option value="{{$portca->id}}">{{$portca->la_nla_type}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{$porttype->amount}}">

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
                                <input id="value" type="text" class="form-control" name="value" value="{{$porttype->value}}">

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
                                <input id="cost" type="text" class="form-control" name="cost" value="{{$porttype->cost}}">

                                @if ($errors->has('cost'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_to_asset') ? ' has-error' : '' }}">
                            <label for="ref_to_asset" class="col-md-4 control-label">Ref To Asset</label>

                            <div class="col-md-6">
                                <input id="ref_to_asset" type="text" class="form-control" name="ref_to_asset" value="{{$porttype->ref_to_asset}}">

                                @if ($errors->has('ref_to_asset'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_to_asset') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('valid_from') ? ' has-error' : '' }}">
                            <label for="valid_from" class="col-md-4 control-label">Valid From</label>

                            <div class="col-md-6">

                              <select id="date" type="text" name="df"   placeholder="วันที่">
                                <?php $currentyear = date('Y');
                                ?>
                                <option value ="{{$df}}">  {{$df}}  </option>
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
                                <option value ="{{$mf}}">  {{$mf}}  </option>
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
                                <option value ="{{$yf}}">  {{$yf}}  </option>
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
                                <option value ="{{$dt}}">  {{$dt}}  </option>
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
                                <option value ="{{$mt}}">  {{$mt}}  </option>
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
                                      <option value ="{{$yt}}">  {{$yt}}  </option>
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
                                <input id="link_to_more" type="text" class="form-control" name="link_to_more" value="{{$porttype->link_to_more}}">

                                @if ($errors->has('link_to_more'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_to_more') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label">Note</label>

                            <div class="col-md-6">
                                <input id="note" type="text" class="form-control" name="note" value="{{$porttype->note}}">

                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                            </div>
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

                     op+='<option value="0" selected disabled>Choose Issuer Type</option>';
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
@endsection
