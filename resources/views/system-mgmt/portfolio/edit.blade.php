@extends('system-mgmt.city.base')

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
                <div class="panel-heading">Update Portfolio</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('portfolio.update', ['id' => $portfolio->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                          <div class="column">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Port Name</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="{{ $portfolio->type }}" >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Port Type</label>
                            <div class="col-md-6">
                                <select class="form-control " name="port_id">

                                    @foreach ($porttypes as $port)
                                         <option value="{{$port->id}}"{{$port->id == $portfolio->port_id? 'selected' : ''}}>{{$port->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

						      <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 control-label">Port Number</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control" name="number" value="{{$portfolio->number}}" >

                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Structure:</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="structure_id">

                              <option value="0" >-Select-</option>
                              @foreach ($structures as $structure)
                                  <option value="{{$structure->id}}"{{$structure->id == $portfolio->structure_id ? 'selected' : ''}}>{{$structure->name}}</option>
                              @endforeach

                          </select>
                          <label class="col-md-4 control-label">Belong to:</label>

                          <select class="col-md-6 form-control name " name="block_id" required autofocus>

                              <option value="0" disabled="true" selected="true">Belong to</option>
                              @foreach ($blocks as $block)
                                  <option value="{{$block->id}}"{{$block->id == $portfolio->block_id ? 'selected' : ''}}>{{$block->name}}</option>
                              @endforeach
                          </select>
                        </div>
                        </div>
					<div class="form-group">
                            <label class="col-md-4 control-label">Member</label>
                            <div class="col-md-6">
                              <select class="form-control" name="member_id"  id="nameid">
                                <option></option>
                                @foreach($persons as $person)
                                <option value="{{$person->id}}" {{$person->id == $portfolio->member_id ? 'selected' : ''}}>{{$person->name}} {{$person->lname}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
							  
							  <div class="form-group{{ $errors->has('member_citi') ? ' has-error' : '' }}">
                                        <label for="member_citi" class="col-md-4 control-label">Member Citizen</label>

                                        <div class="col-md-6">

                                            <input id="member_citi" type="text" class="form-control" name="member_citi"  required autofocus   >
                                            <span class="help-block">
                                              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                                @if(Session::has('alert-' . $msg))

                                                <p style="color:red" class=" help-block {{ $msg }}">{{ Session::get('alert-' . $msg) }} </p>
                                                @endif
                                              @endforeach
                                            </span>
                                            @if ($errors->has('member_citi'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('member_citi') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Port Status</label>
                        <div class="col-md-6">
                            <select class="form-control " name="status">
                                <option value="{{ $portfolio->status }}">{{ $portfolio->status }}</option>

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
                            <input id="description" type="text" class="form-control" name="description" value="{{$portfolio->description}}" >


                        </div>
                    </div>
                  </div>
                  <div class="column">

                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                              <label for="description" class="col-md-4 control-label">available from</label>

                              <div class="col-md-6">
                                  <input id="available_from_date" type="text" class="form-control" name="available_from_date" value="{{ $portfolio->available_from_date }}" >


                              </div>
                          </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          <label for="description" class="col-md-4 control-label">available to</label>

                          <div class="col-md-6">
                          <input id="description" type="text" class="form-control" name="available_to_date" value="{{ $portfolio->available_to_date }}" >

                            @if ($errors->has('description'))
                          <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">port_detail_data1</label>

                            <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="port_detail_data1" value="{{$portfolio->port_detail_data1}}" >


                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                              <label for="description" class="col-md-4 control-label">port_detail_data2</label>

                              <div class="col-md-6">
                              <input id="description" type="text" class="form-control" name="port_detail_data2" value="{{$portfolio->port_detail_data2}}" >


                              </div>
                          </div>
                          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">port_detail_data3</label>

                                <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="port_detail_data3" value="{{$portfolio->port_detail_data3}}" >

                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                  <label for="description" class="col-md-4 control-label">port_detail_data4</label>

                                  <div class="col-md-6">
                                  <input id="description" type="text" class="form-control" name="port_detail_data4" value="{{$portfolio->port_detail_data4}}" >


                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-md-4 control-label">port_detail_data5</label>

                                    <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="port_detail_data5" value="{{$portfolio->port_detail_data5}}" >


                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                      <label for="description" class="col-md-4 control-label">port_detail_data6</label>

                                      <div class="col-md-6">
                                      <input id="description" type="text" class="form-control" name="port_detail_data6" value="{{$portfolio->port_detail_data6}}" >


                                      </div>
                                  </div>
                                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description" class="col-md-4 control-label">port_detail_data7</label>

                                        <div class="col-md-6">
                                        <input id="description" type="text" class="form-control" name="port_detail_data7" value="{{$portfolio->port_detail_data7}}" >


                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                          <label for="description" class="col-md-4 control-label">ref_link_id1</label>

                                          <div class="col-md-6">
                                          <input id="description" type="text" class="form-control" name="ref_link_id1" value="{{$portfolio->ref_link_id1}}" >


                                          </div>
                                      </div>
                                      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            <label for="description" class="col-md-4 control-label">ref_link_id2</label>

                                            <div class="col-md-6">
                                            <input id="description" type="text" class="form-control" name="ref_link_id2" value="{{$portfolio->ref_link_id2}}" >


                                            </div>
                                        </div>


                    </div>
                    <div class="column">

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">ref_link_id3</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="ref_link_id3" value="{{$portfolio->ref_link_id3}}" >


                                </div>
                            </div>
                      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">referal_id1</label>

                            <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="referal_id1" value="{{$portfolio->referal_id1}}" >


                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                              <label for="description" class="col-md-4 control-label">referal_id2</label>

                              <div class="col-md-6">
                              <input id="description" type="text" class="form-control" name="referal_id2" value="{{$portfolio->referal_id2}}" >


                              </div>
                          </div>
                          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">referal_id3</label>

                                <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="referal_id3" value="{{$portfolio->referal_id3}}" >


                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                  <label for="description" class="col-md-4 control-label">issuer_name</label>

                                  <div class="col-md-6">
                                  <input id="description" type="text" class="form-control" name="issuer_name" value="{{$portfolio->issuer_name}}" >

                                  </div>
                              </div>
                              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-md-4 control-label">portfolio limit value</label>

                                    <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="portfolio_limit_value" value="{{$portfolio->portfolio_limit_value}}" >

                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                      <label for="description" class="col-md-4 control-label">Notice</label>

                                      <div class="col-md-6">
                                      <input id="description" type="text" class="form-control" name="Notice" value="{{$portfolio->Notice}}" >


                                      </div>
                                  </div>
                                  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        <label for="description" class="col-md-4 control-label">call_center</label>

                                        <div class="col-md-6">
                                        <input id="description" type="text" class="form-control" name="call_center" value="{{$portfolio->call_center}}" >

                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                          <label for="description" class="col-md-4 control-label">file_port_ref1	</label>

                                          <div class="col-md-6">
                                          <input id="description" type="text" class="form-control" name="file_port_ref1" value="{{$portfolio->file_port_ref1}}" >


                                          </div>
                                      </div>
                                      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                            <label for="description" class="col-md-4 control-label">	file_port_ref2	</label>

                                            <div class="col-md-6">
                                            <input id="description" type="text" class="form-control" name="file_port_ref2" value="{{$portfolio->	file_port_ref2}}" >

                                              @if ($errors->has('description'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                              </span>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                              <label for="description" class="col-md-4 control-label">	file_port_ref3	</label>

                                              <div class="col-md-6">
                                              <input id="description" type="text" class="form-control" name="file_port_ref3" value="{{$portfolio->file_port_ref3}}" >

                                                @if ($errors->has('description'))
                                              <span class="help-block">
                                              <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                                @endif
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

        });
</script>
@endsection
