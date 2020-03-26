@extends('system-mgmt.match-user-group.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Match</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('match-user-group.update', ['id' => $matchgroup->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">





                        <div class="form-group">
                            <label class="col-md-4 control-label">user</label>
                            <div class="col-md-6">
                              <select class="form-control" name="user_id"  id="nameid">
                                <option></option>
                                @foreach($users as $user)
                              <option value="{{$user->id}}" {{$user->id == $matchgroup->user_id ? 'selected' : ''}}>{{$user->username}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Group </label>
                            <div class="col-md-6">
                              <select class="form-control" name="user_group_id"  id="memid">
                                <option></option>
                                @foreach($ugroups as $ug)
                              <option value="{{$ug->id}}" {{$ug->id == $matchgroup->user_group_id ? 'selected' : ''}}>{{$ug->name}}</option>
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
