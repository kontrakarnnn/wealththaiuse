@extends('system-mgmt.notiper.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Send Message</div>
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

                        <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
                            <label for="topic" class="col-md-4 control-label">topic</label>

                            <div class="col-md-6">
                                <input id="topic" type="text" class="form-control" name="topic" value="{{ old('topic') }}">

                                @if ($errors->has('topic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic') }}</strong>
                                    </span>
                                @endif
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





                                <input type="hidden"id="sender_id" type="text" class="form-control" name="sender_id"  @foreach($currentid as $current) value="{{ $current->id}}"  @endforeach>
                                    <input type="hidden"id="created_by" type="text" class="form-control" name="created_by"  @foreach($currentid as $current) value="{{ $current->id}}"  @endforeach>


                        <div class="form-group{{ $errors->has('recieve_id') ? ' has-error' : '' }}">
                            <label for="recieve_id" class="col-md-4 control-label">recieve_id</label>

                            <div class="col-md-6">
                                <input id="recieve_id" type="text" class="form-control" name="recieve_id" value="{{ old('recieve_id') }}">

                                @if ($errors->has('recieve_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('recieve_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cc_reciever1') ? ' has-error' : '' }}">
                            <label for="cc_reciever1" class="col-md-4 control-label">cc_reciever1</label>

                            <div class="col-md-6">
                                <input id="cc_reciever1" type="text" class="form-control" name="cc_reciever1" value="{{ old('cc_reciever1') }}">

                                @if ($errors->has('cc_reciever1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cc_reciever1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cc_reciever2') ? ' has-error' : '' }}">
                            <label for="cc_reciever2" class="col-md-4 control-label">cc_reciever2</label>

                            <div class="col-md-6">
                                <input id="cc_reciever2" type="text" class="form-control" name="cc_reciever2" value="{{ old('cc_reciever2') }}">

                                @if ($errors->has('cc_reciever2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cc_reciever2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cc_reciever3') ? ' has-error' : '' }}">
                            <label for="cc_reciever3" class="col-md-4 control-label">cc_reciever3</label>

                            <div class="col-md-6">
                                <input id="cc_reciever3" type="text" class="form-control" name="cc_reciever3" value="{{ old('cc_reciever3') }}">

                                @if ($errors->has('cc_reciever3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cc_reciever3') }}</strong>
                                    </span>
                                @endif
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
