@extends('system-mgmt.portfolio.base')

@section('action-content')
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
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
                <div class="panel-heading">Add new port</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('portfolioadmin.store') }}">
                        {{ csrf_field() }}

                        <div class="row">
                          <div class="column">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Port Name</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ old('type') }}"  required>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

            <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 control-label">Port Number</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control" name="number" value="{{ old('number') }}" required>

                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Port Type</label>
                            <div class="col-md-6">
                                <select class="form-control " id="nameid"name="port_id" required>
                                    <option></option>
                                    @foreach ($porttypes as $port)
                                        <option value="{{$port->id}}">{{$port->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Structure:</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="structure_id" required>

                              <option></option>
                              @foreach ($structures as $structure)
                                  <option value="{{$structure->id}}">{{$structure->name}}</option>
                              @endforeach

                          </select>
                          <label class="col-md-4 control-label">Belong to:</label>

                          <select class="col-md-6 form-control name" name="block_id" required>

                              <option  disabled="true" selected="true"></option>
                          </select>
                        </div>
                        </div>






                        <div class="form-group">
                      <label class="col-md-4 control-label">Member</label>
                        <div class="col-md-6">

                          <select class=" form-control citi" id="nameid2" name="member_id" required>

                            <option></option>
                            @foreach($persons as $person)
                            <option value="{{$person->id}}">{{$person->name}} {{$person->lname}}</option>
                            @endforeach

                          </select>





                        </div>
                        </div>

             <div class="form-group">
                            <label class="col-md-4 control-label">Port Status</label>
                            <div class="col-md-6">
                                <select class="form-control " name="status">
                                    <option></option>

                                        <option>Request</option>
                                        <option>Active</option>
                                        <option>Suspend</option>
                                        <option>Checking</option>
                                        <option>Close</option>
                                </select>
                            </div>
                        </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" >

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                      </div>
                      <div class="column">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">available from </label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="available_from_date" value="{{ old('available_from_date') }}"  required>

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">available to </label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="available_to_date" value="{{ old('available_to_date') }}"  required>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_data1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data1" value="{{ old('port_detail_data1') }}"  required>


                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_data2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data2" value="{{ old('port_detail_data2	') }}"  required>


                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_data3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data3" value="{{ old('port_detail_data3') }}"  required>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_data4</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data4" value="{{ old('port_detail_data4') }}"  required>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_data5</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data5" value="{{ old('port_detail_data5') }}"  required>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_data6</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data6" value="{{ old('port_detail_data6') }}"  required>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">port_detail_data7</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data7" value="{{ old('port_detail_data7') }}"  required>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_id1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_id1" value="{{ old('ref_link_id1') }}"  required>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_id2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_id2" value="{{ old('ref_link_id2') }}"  required>


                            </div>
                        </div>


                      </div>
                      <div class ="column">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_id3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_id3" value="{{ old('ref_link_id3') }}"  required>


                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">referal_id1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="referal_id1" value="{{ old('referal_id1') }}"  required>


                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">referal_id2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="referal_id2" value="{{ old('referal_id2') }}"  required>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">referal_id3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="referal_id3" value="{{ old('referal_id3') }}"  required>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">issuer_name</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="issuer_name" value="{{ old('issuer_name') }}"  required>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">portfo limit value</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="portfolio_limit_value" value="{{ old('portfolio_limit_value') }}"  required>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Notice</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="Notice" value="{{ old('Notice') }}"  required>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">call_center</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="call_center" value="{{ old('call_center') }}"  required>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">file_port_ref1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="file_port_ref1" value="{{ old('file_port_ref1') }}"  required>


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">file_port_ref2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="file_port_ref2" value="{{ old('file_port_ref2') }}"  required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">	file_port_ref3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="file_port_ref3" value="{{ old('	file_port_ref3') }}"  required>

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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#perid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.department',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findDivisionName')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
                  op+='<option value="0" selected disabled>chose Block</option>';
                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

                  }
                  div.find('.name').html(" ");
                  div.find('.name').append(op);

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

      $("#nameid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid2").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
@endsection
