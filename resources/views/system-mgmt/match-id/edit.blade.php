@extends('system-mgmt.match-id.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Match</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('match-id.update', ['id' => $matchid->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group{{ $errors->has('public_name') ? ' has-error' : '' }}">
                            <label for="public_name" class="col-md-4 control-label">public_name</label>

                            <div class="col-md-6">
                                <input id="public_name" type="text" class="form-control" name="public_name" value="{{ $matchid->public_name }}" >

                                @if ($errors->has('public_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('public_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('public_email') ? ' has-error' : '' }}">
                            <label for="public_email" class="col-md-4 control-label">public_email</label>

                            <div class="col-md-6">
                                <input id="public_email" type="text" class="form-control" name="public_email" value="{{ $matchid->public_email }}" >

                                @if ($errors->has('public_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('public_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('public_mobile') ? ' has-error' : '' }}">
                            <label for="public_mobile" class="col-md-4 control-label">public_mobile</label>

                            <div class="col-md-6">
                                <input id="public_mobile" type="text" class="form-control" name="public_mobile" value="{{ $matchid->public_mobile }}" >

                                @if ($errors->has('public_mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('public_mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('sender_citizen') ? ' has-error' : '' }}">
                            <label for="sender_citizen" class="col-md-4 control-label">sender_citizen</label>

                            <div class="col-md-6">
                                <input id="sender_citizen" type="text" class="form-control" name="sender_citizen" value="{{ $matchid->sender_citizen }}" >

                                @if ($errors->has('sender_citizen'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sender_citizen') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-4 control-label">User</label>
                            <div class="col-md-6">
                              <select class="form-control" name="user_id"  id="nameid">
                                <option></option>
                                @foreach($users as $user)
                              <option value="{{$user->id}}" {{$user->id == $matchid->user_id ? 'selected' : ''}}>{{$user->username}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Member</label>
                            <div class="col-md-6">
                              <select class="form-control" name="member_id"  id="memid">
                                <option></option>
                                @foreach($persons as $person)
                              <option value="{{$person->id}}" {{$person->id == $matchid->member_id ? 'selected' : ''}}>{{$person->name}}</option>
                                @endforeach
                              </select>
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
