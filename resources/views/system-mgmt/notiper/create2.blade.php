@extends('system-mgmt.notiper.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Notis</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('notiper.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Message Type</label>
                            <div class="col-md-6">
                              <select class="form-control" name="message_type_id"  >
                                <option></option>
                                @foreach($messagetypes as $messagetype)
                                <option value="{{$messagetype->id}}">{{$messagetype->message_template}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-md-4 control-label">Message</label>

                            <div class="col-md-6">
                                <input id="message" type="text" class="form-control" name="message" value="{{ old('message') }}">

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('sender_note') ? ' has-error' : '' }}">
                            <label for="sender_note" class="col-md-4 control-label">sender_note</label>

                            <div class="col-md-6">
                                <input id="sender_note" type="text" class="form-control" name="sender_note" value="{{ old('public_emai') }}">

                                @if ($errors->has('sender_note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sender_note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('reciever_note') ? ' has-error' : '' }}">
                            <label for="reciever_note" class="col-md-4 control-label">reciever_note</label>

                            <div class="col-md-6">
                                <input id="reciever_note" type="text" class="form-control" name="reciever_note" value="{{ old('reciever_note') }}">

                                @if ($errors->has('reciever_note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reciever_note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option></option>
                                    <option>Request</option>
                                    <option>On Progress</option>
                                    <option>Reject</option>
                                    <option>Finish</option>
                                </select>
                                 @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sender</label>
                            <div class="col-md-6">
                              <select class="form-control" name="sender_id"  id="senderid">
                                @foreach($currentid as $current)
                                <option value ="{{$current->id}}"></option>
                                @endforeach
                                @foreach($matchids as $matchid)
                                <option value="{{$matchid->id}}">{{$matchid->public_name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Reciever</label>
                            <div class="col-md-6">
                              <select class="form-control" name="recieve_id"  id="recieveid">
                                <option></option>
                                @foreach($matchids as $matchid)
                                <option value="{{$matchid->id}}">{{$matchid->public_name}}</option>
                                @endforeach
                              </select>
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

      $("#nameid").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>

<script type="text/javascript">

      $("#memid").select2({
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
@endsection
