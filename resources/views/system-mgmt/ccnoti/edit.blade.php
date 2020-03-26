@extends('system-mgmt.noti.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Notification</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('noti.update', ['id' => $noti->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">




                        <div class="form-group{{ $errors->has('message_type_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">message_type_id:</label>
                        <div class="col-md-6">
                          <select class=" form-control" name="message_type_id">

                              <option value="0" >-Select-</option>
                              @foreach ($messagetypes as $mc)
                                  <option value="{{$mc->id}}"{{$mc->id == $noti->message_type_id ? 'selected' : ''}}>{{$mc->message_template}}</option>
                              @endforeach

                          </select>



                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('topic') ? ' has-error' : '' }}">
                            <label for="topic" class="col-md-4 control-label">topic</label>

                            <div class="col-md-6">
                                <input id="topic" type="text" class="form-control" name="topic" value="{{ $noti->topic }}" >

                                @if ($errors->has('topic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-md-4 control-label">message</label>

                            <div class="col-md-6">
                                <input id="message" type="text" class="form-control" name="message" value="{{ $noti->message }}" >

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                                <input  type="hidden"id="sender_note" type="text" class="form-control" name="sender_note" value="{{ $noti->sender_note }}" >


                        <div class="form-group{{ $errors->has('reciever_note') ? ' has-error' : '' }}">
                            <label for="reciever_note" class="col-md-4 control-label">reciever_note</label>

                            <div class="col-md-6">
                                <input id="reciever_note" type="text" class="form-control" name="reciever_note" value="{{ $noti->reciever_note }}" >

                                @if ($errors->has('reciever_note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reciever_note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reflink') ? ' has-error' : '' }}">
                            <label for="reflink" class="col-md-4 control-label">Referral Link</label>

                            <div class="col-md-6">
                                <input id="reflink" type="text" class="form-control" name="reflink" value="{{ $noti->reflink }}" >

                                @if ($errors->has('reflink'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reflink') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input  type="hidden"id="sender_id" type="text" class="form-control" name="sender_id" value="{{ $noti->sender_id }}" >


                        <input  type="hidden"id="recieve_id" type="text" class="form-control" name="recieve_id" value="{{ $noti->recieve_id }}" >
                        <input  type="hidden"id="created_by" type="text" class="form-control" name="created_by" value="{{ $noti->created_by }}" >


                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option>{{$noti->status}}</option>
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
