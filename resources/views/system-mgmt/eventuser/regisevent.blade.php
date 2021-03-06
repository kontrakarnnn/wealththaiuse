@extends('system-mgmt.eventuser.base')

@section('action-content')
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registered Event</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('eventtomember.store') }}">
                        {{ csrf_field() }}


                        <div class="form-group">

                      <label class="col-md-4 control-label">Event</label>
                        <div class="col-md-6">
                          <select  readonly="readonly" class=" form-control department" name="event_id">
                              @foreach($event as $e)
                              <option value="{{$e->id}}" >{{$e->event_name}}   </option>
                              @endforeach

                          </select>



                        </div>
                        </div>






                        

                        <div class="form-group">
                      <label class="col-md-4 control-label">My Lead</label>
                        <div class="col-md-6">
                          <select class=" form-control department nameid" name="member_id">
                            @foreach($member as $m)
                              <option value="{{$m->id}}" >{{$m->name}} {{$m->lname}}</option>
                            @endforeach

                          </select>



                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label">Note</label>

                            <div class="col-md-6">
                                <textarea id="note" type="text" class="form-control" name="note" value="{{ old('note') }}" ></textarea>

                                @if ($errors->has('note'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="note" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <p id="note" type="text" class="" name="note"  ><b >Total Participant <b style="color:red">{{$eventcount}}</b>/<b style="color:red">{{$eventlimit}}</b></b></p>

                                @if ($errors->has('note'))
                                    <span class="help-event">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>







                        <div class="form-group">
                          @if($eventcount >= $eventlimit)
                            <div  class="col-md-6 col-md-offset-4">
                                <a class="btn btn-danger " readonly="readonly" disabled type="submit" class="btn btn-primary">
                                  This Event out of seat
                                </a>
                                <br />

                            </div>
                          @else
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Create
                              </button>
                          </div>
                          @endif
                        </div>
                    </form>
                </div>
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
                  op+='<option value="0" selected disabled>chose event</option>';
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

      $(".nameid").select2({
            placeholder: "Select a Name",

        });
</script>

@endsection
