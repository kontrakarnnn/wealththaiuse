@extends('system-mgmt.asset-type.base')

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
                <div class="panel-heading">Update port</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('asset-type.update', ['id' => $porttype->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                          <div class="column">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                              <select class=" form-control department"  name="la_nla">

                                  <option value ="{{$porttype->la_nla}}">{{$porttype->la_nla}}</option>
                                  <option value ="Liquidity Asset">Liquidity Asset</option>
                                  <option value ="Non Liquidity Asset">Non Liquidity Asset</option>



                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('issuer_guild') ? ' has-error' : '' }}">
                            <label for="issuer_guild" class="col-md-4 control-label">Guild</label>

                            <div class="col-md-6">
                              <select class=" form-control department"  name="issuer_guild">

                                <option value ="0">-Select-</option>
                                @foreach ($membergroup as $portca)
                                    <option value="{{$portca->id}}"{{$portca->id == $porttype->issuer_guild ? 'selected' : ''}}>{{$portca->name}}</option>
                                @endforeach



                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Port Category</label>
                        <div class="col-md-6">
                          <select class=" form-control department" id="nameid" name="asset_cat">

                              <option value ="0">-Select-</option>
                              @foreach ($portcat as $portca)
                                  <option value="{{$portca->id}}"{{$portca->id == $porttype->asset_cat ? 'selected' : ''}}>{{$portca->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">type</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control" name="la_nla_type" value="{{$porttype->la_nla_type}}">

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">NLA Sub type</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="nla_sub_type" value="{{$porttype->nla_sub_type}}"  >

                                @if ($errors->has('port_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link_info') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">link_info</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="link_info" value="{{$porttype->link_info}}"  >

                                @if ($errors->has('link_info'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_info') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">call_center</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="call_center" value="{{$porttype->call_center}}"  >

                                @if ($errors->has('call_center'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('call_center') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">Unit</label>

                            <div class="col-md-6">
                                <input id="unit" type="text" class="form-control" name="unit" value="{{$porttype->unit}}"  >

                                @if ($errors->has('unit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_name_head') ? ' has-error' : '' }}">
                            <label for="ref_name_head" class="col-md-4 control-label">ref_name_head</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_name_head" value="{{$porttype->ref_name_head}}"  >

                                @if ($errors->has('ref_name_head'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_name_head') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_num_head1') ? ' has-error' : '' }}">
                            <label for="ref_num_head1" class="col-md-4 control-label">ref_num_head1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_num_head1" value="{{$porttype->ref_num_head1}}"  >

                                @if ($errors->has('ref_num_head1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_num_head1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_num_head2') ? ' has-error' : '' }}">
                            <label for="ref_num_head2" class="col-md-4 control-label">ref_num_head2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_num_head2" value="{{$porttype->ref_num_head2}}"  >

                                @if ($errors->has('ref_num_head2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_num_head2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_num_head3') ? ' has-error' : '' }}">
                            <label for="ref_num_head3" class="col-md-4 control-label">ref_num_head3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_num_head3" value="{{$porttype->ref_num_head3}}"  >

                                @if ($errors->has('ref_num_head3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_num_head3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head1') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head1" value="{{$porttype->ref_info_head1}}"  >

                                @if ($errors->has('ref_info_head1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info_head1') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head2" value="{{$porttype->ref_info_head2}}"  >

                                @if ($errors->has('ref_info_head2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info_head1') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head3" value="{{$porttype->ref_info_head3}}"  >

                                @if ($errors->has('ref_info_head3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                      </div>

                      <div class="column">
                        <div class="form-group{{ $errors->has('ref_info_head1') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head4</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head4" value="{{$porttype->ref_info_head4}}"  >

                                @if ($errors->has('ref_info_head4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info_head1') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head5</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head5" value="{{$porttype->ref_info_head5}}"  >

                                @if ($errors->has('ref_info_head5'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head5') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info_head1') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head6</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head6" value="{{$porttype->ref_info_head6}}"  >

                                @if ($errors->has('ref_info_head6'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head6') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_info_head1') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head7</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head7" value="{{$porttype->ref_info_head7}}"  >

                                @if ($errors->has('ref_info_head7'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head7') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head1') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head8</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head8" value="{{$porttype->ref_info_head8}}"  >

                                @if ($errors->has('ref_info_head8'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head8') }}</strong>
                                    </span>
                                @endif
                                <br />
                                <label for="chkPassport">
                                    <input type="checkbox" id="chkPassport" checked/>
                                    Add More Detail
                                </label>
                            </div>
                        </div>
                        <div  id="dvPassport"  >
                        <div class="form-group{{ $errors->has('ref_info_head9') ? ' has-error' : '' }}">
                            <label for="ref_info_head9" class="col-md-4 control-label">ref_info_head9</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head9" value="{{$porttype->ref_info_head9}}"  >

                                @if ($errors->has('ref_info_head9'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head9') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head10') ? ' has-error' : '' }}">
                            <label for="ref_info_head10" class="col-md-4 control-label">ref_info_head10</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head10" value="{{$porttype->ref_info_head10}}"  >

                                @if ($errors->has('ref_info_head10'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head10') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head11') ? ' has-error' : '' }}">
                            <label for="ref_info_head11" class="col-md-4 control-label">ref_info_head11</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head11" value="{{$porttype->ref_info_head11}}"  >

                                @if ($errors->has('ref_info_head11'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head11') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head12') ? ' has-error' : '' }}">
                            <label for="ref_info_head12" class="col-md-4 control-label">ref_info_head12</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head12" value="{{$porttype->ref_info_head12}}"  >

                                @if ($errors->has('ref_info_head12'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head12') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head13') ? ' has-error' : '' }}">
                            <label for="ref_info_head13" class="col-md-4 control-label">ref_info_head13</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head13" value="{{$porttype->ref_info_head13}}"  >

                                @if ($errors->has('ref_info_head13'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head13') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head14') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head14</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head14" value="{{$porttype->ref_info_head14}}"  >

                                @if ($errors->has('ref_info_head14'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head14') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head15') ? ' has-error' : '' }}">
                            <label for="ref_info_head15" class="col-md-4 control-label">ref_info_head15</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head15" value="{{$porttype->ref_info_head15}}"  >

                                @if ($errors->has('ref_info_head15'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head15') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head16') ? ' has-error' : '' }}">
                            <label for="ref_info_head16" class="col-md-4 control-label">ref_info_head16</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head16" value="{{$porttype->ref_info_head16}}"  >

                                @if ($errors->has('ref_info_head16'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head16') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head17') ? ' has-error' : '' }}">
                            <label for="port_type" class="col-md-4 control-label">ref_info_head17</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head17" value="{{$porttype->ref_info_head17}}"  >

                                @if ($errors->has('ref_info_head17'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head17') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ref_info_head18') ? ' has-error' : '' }}">
                            <label for="ref_info_head18" class="col-md-4 control-label">ref_info_head18</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_info_head18" value="{{$porttype->ref_info_head18}}"  >

                                @if ($errors->has('ref_info_head18'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_info_head18') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      </div>
                  </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid").select2({
            placeholder: "Select a Name",
            allowClear: true
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
