@extends('system-mgmt.match-view.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update View Authentication</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('match-view.update', ['id' => $matchview->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">





                        <div class="form-group">
                            <label class="col-md-4 control-label">view</label>
                            <div class="col-md-6">
                              <select class="form-control" name="view_id"  id="nameid">
                                <option></option>
                                @foreach($views as $view)
                              <option value="{{$view->id}}" {{$view->id == $matchview->view_id ? 'selected' : ''}}>{{$view->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Structure:</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="structure_id">

                              <option value="" >-Select-</option>
                              @foreach ($structures as $structure)
                                  <option value="{{$structure->id}}"{{$structure->id == $matchview->structure_id ? 'selected' : ''}}>{{$structure->name}}</option>
                              @endforeach

                          </select>
							   </div>
                        </div>
							<div class="form-group{{ $errors->has('block_id') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Block</label>
						 <div class="col-md-6">
                          <select class="col-md-6 form-control  " name="block_id" >

                              <option value="" >-Select-</option>
                              @foreach ($blocks as $block)
                                  <option value="{{$block->id}}"{{$block->id == $matchview->block_id ? 'selected' : ''}}>{{$block->name}}</option>
                              @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('block_td') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Block Top-down</label>
          						 <div class="col-md-6">
                                    <select class="col-md-6 form-control  " name="block_td" >

                                        <option value="" >-Select-</option>
                                        @foreach ($blocks as $block)
                                            <option value="{{$block->id}}"{{$block->id == $matchview->block_td ? 'selected' : ''}}>{{$block->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                  </div>

                        <div class="form-group{{ $errors->has('block_btu') ? ' has-error' : '' }}">
                           <label class="col-md-4 control-label">Block Bottom-up</label>
                         	 <div class="col-md-6">
                             <select class="col-md-6 form-control  " name="block_btu" >

                               <option value="" >-Select-</option>
                                        @foreach ($blocks as $block)
                                <option value="{{$block->id}}"{{$block->id == $matchview->block_btu ? 'selected' : ''}}>{{$block->name}}</option>
                                        @endforeach
                              </select>
                          </div>
                          </div>





                        <div class="form-group">
                            <label class="col-md-4 control-label">User</label>
                            <div class="col-md-6">
                              <select class="form-control" name="user_id"  id="nameid">
                                <option></option>
                                @foreach($users as $user)
                              <option value="{{$user->id}}" {{$user->id == $matchview->user_id ? 'selected' : ''}}>{{$user->username}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">user_group</label>
                            <div class="col-md-6">
                              <select class="form-control" name="user_group_id"  id="nameid">
                                <option></option>
                                @foreach($user_groups as $user_group)
                              <option value="{{$user_group->id}}" {{$user_group->id == $matchview->user_group_id ? 'selected' : ''}}>{{$user_group->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">pid_group</label>
                            <div class="col-md-6">
                              <select class="form-control" name="pid_group_id"  id="nameid">
                                <option></option>
                                @foreach($pid_groups as $pid_group)
                              <option value="{{$pid_group->id}}" {{$pid_group->id == $matchview->pid_group_id ? 'selected' : ''}}>{{$pid_group->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>





                        <div class="form-group">

                                          <label class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                    <input type="checkbox" {{  $matchview->all_user =="Yes" ? 'checked' : '' }} name="all_user" value="Yes"> All User<br>
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
