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
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('portfolio.store') }}">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="column">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Port Name</label>

                            <div class="col-md-6">
                                @if($ptnum == 30)
                                <input readonly id="type" type="text" class="form-control" name="type" value="personal_port"     >
                                @elseif($factport == 1)
                                <input readonly id="type" type="text" class="form-control" name="type" value="{{$person}}">
                                @else
                                <input id="type" type="text" class="form-control" name="type" value="{{ old('type') }}"     >

                                @endif
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
                              @if($ptnum == 30)
                                <input readonly id="number" type="text" class="form-control" name="number" value="000000"    >
                              @else
                                <input id="number" type="text" class="form-control" name="number" value="{{ old('number') }}"    >
                              @endif
                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                      <label class="col-md-4 control-label">Port Type:</label>
                        <div class="col-md-6">
                          @if($ptnum == 30)
                          <select readonly class="form-control porttype" name="port_id"    >
                            @else
                            <select class="form-control porttype" name="port_id"    >
                            @endif
                              @foreach ($porttypes as $port)
                                  <option value="{{$port->id}}">{{$port->type}}</option>
                              @endforeach
                          </select>




                        </div>
                        </div>


                        <div class="form-group">
                      <label class="col-md-4 control-label">Structure:</label>
                        <div class="col-md-6">
                          @if($ptnum == 30)
                          <select readonly class="form-control department" name="structure_id"    >
                            @else
                            <select  class="form-control department" name="structure_id"    >
                            @endif
								<option></option>
                              @foreach ($structures as $structure)
                                  <option value="{{$structure->id}}">{{$structure->name}}</option>
                              @endforeach

                          </select>
                          <label class="col-md-4 control-label">Belong to:</label>
                          @if($ptnum == 30)
                          <select readonly class="col-md-6 form-control name" name="block_id"    >
                            @else
                            <select class="col-md-6 form-control name" name="block_id"    >
                            @endif

                            @foreach ($blocks as $structure)
                                <option value="{{$structure->id}}">{{$structure->name}}</option>
                            @endforeach

                          </select>
                        </div>
                        </div>






                        <div class="form-group">
                      <label class="col-md-4 control-label">Member</label>
                        <div class="col-md-6">
                          @if($ptnum == 30)
                          <select readonly class=" form-control citi "  name="member_id"    >
                            @else
                            <select class=" form-control citi " id="nameid" name="member_id"    >
                            @endif

                            @foreach($persons as $person)
                            <option value="{{$person->id}}">{{$person->name}} {{$person->lname}}</option>
                            @endforeach

                          </select>





                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('member_citi') ? ' has-error' : '' }}">
                                        <label for="member_citi" class="col-md-4 control-label">Member Citizen</label>

                                        <div class="col-md-6">

                                            <input id="member_citi" type="text" class="form-control" name="member_citi"     >
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



                                  <select class="form-control  " name="status">

                                  @if($ptnum == 30)
                                    <option >Active</option>
                                    @elseif($factport == 1)
                                    <option>Active</option>
                                    @else
                                        <option>Request</option>
                                        <option>Active</option>
                                        <option>Suspend</option>
                                        <option>Checking</option>
                                        <option>Close</option>
                                        @endif
                                </select>
                            </div>
                        </div>
						<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                              @if($ptnum == 30)
                                <input readonly id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" >
                                @else
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" >

                                @endif
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                                <label for="chkPassport">
                                    <input type="checkbox" id="chkPassport" />
                                    Add More Data
                                </label>
                            </div>
                        </div>


                      </div>

                      <div  id="dvPassport"style="display:none;" >

                      <div class="column">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">available from </label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="available_from_date" value="{{ old('available_from_date') }}"  >

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">available to </label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="available_to_date" value="{{ old('available_to_date') }}"  >

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label la">port_detail_data1</label>

                            <div class="col-md-6">
                                <input id="label1" type="text" class="form-control" name="port_detail_data1" value="{{ old('port_detail_data1') }}"  >


                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label la2">port_detail_data2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data2" value="{{ old('port_detail_data2	') }}"  >


                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label la3">port_detail_data3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data3" value="{{ old('port_detail_data3') }}"  >

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label la4">port_detail_data4</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data4" value="{{ old('port_detail_data4') }}"  >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label la5">port_detail_data5</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data5" value="{{ old('port_detail_data5') }}"  >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label la6">port_detail_data6</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data6" value="{{ old('port_detail_data6') }}"  >

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label la7">port_detail_data7</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="port_detail_data7" value="{{ old('port_detail_data7') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_id1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_id1" value="{{ old('ref_link_id1') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_id2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_id2" value="{{ old('ref_link_id2') }}"  >


                            </div>
                        </div>


                      </div>
                      <div class ="column">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">ref_link_id3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="ref_link_id3" value="{{ old('ref_link_id3') }}"  >


                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">referal_id1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="referal_id1" value="{{ old('referal_id1') }}"  >


                            </div>
                        </div>




                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">referal_id2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="referal_id2" value="{{ old('referal_id2') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">referal_id3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="referal_id3" value="{{ old('referal_id3') }}"  >

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">issuer_name</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="issuer_name" value="{{ old('issuer_name') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">portfo limit value</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="portfolio_limit_value" value="{{ old('portfolio_limit_value') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Notice</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="Notice" value="{{ old('Notice') }}"  >

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">call_center</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="call_center" value="{{ old('call_center') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">file_port_ref1</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="file_port_ref1" value="{{ old('file_port_ref1') }}"  >


                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">file_port_ref2</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="file_port_ref2" value="{{ old('file_port_ref2') }}"  >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">	file_port_ref3</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="file_port_ref3" value="{{ old('	file_port_ref3') }}"  >

                            </div>

                        </div>

                      </div>
                      </div>
                      </div>
                        <div class="form-group">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                                @if($ptnum == 30)
                                @else

                                @endif
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

      $("#perid").select({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>
<script>
function validateForm() {
    var x = document.forms["form-horizontal"]["member_citi"].value;
    if (x != "1100702449064") {
        alert("Name must be filled out");
        return false;
    }
}
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $(document).on('change','.citi',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findMemberCiti')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);

                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id_num+'">'+data[i].id_num+'</option>';

                  }
                  div.find('.mem').html(" ");
                  div.find('.mem').append(op);

                },
                error:function(){

                }
            });
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.porttype',function(){
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
            $.ajax({
                type:'get',
                url:'{!!URL::to('findPortLabel')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);

                  for(var i=0; i<data.length;i++){
                    op+='<label value="'+data[i].port_detail_label1+'">'+data[i].port_detail_label1+'</label>';
                    op2+='<label value="'+data[i].port_detail_label2+'">'+data[i].port_detail_label2+'</label>';
                    op3+='<label value="'+data[i].port_detail_label3+'">'+data[i].port_detail_label3+'</label>';
                    op4+='<label value="'+data[i].port_detail_label4+'">'+data[i].port_detail_label4+'</label>';
                    op5+='<label value="'+data[i].port_detail_label5+'">'+data[i].port_detail_label5+'</label>';
                    op6+='<label value="'+data[i].port_detail_label6+'">'+data[i].port_detail_label6+'</label>';
                    op7+='<label value="'+data[i].port_detail_label7+'">'+data[i].port_detail_label7+'</label>';
}
                  $('.la').html(" ");
                  $('.la2').html(" ");
                  $('.la3').html(" ");
                  $('.la4').html(" ");
                  $('.la5').html(" ");
                  $('.la6').html(" ");
                  $('.la7').html(" ");
                  $('.la').append(op);
                  $('.la2').append(op2);
                  $('.la3').append(op3);
                  $('.la4').append(op4);
                  $('.la5').append(op4);
                  $('.la6').append(op6);
                  $('.la7').append(op7);
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $(".membername").select2({
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
@endsection
