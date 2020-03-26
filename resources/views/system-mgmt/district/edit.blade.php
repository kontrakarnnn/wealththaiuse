@extends('system-mgmt.district.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update district</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('block.update', ['id' => $block->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                                  <label class="col-md-4 control-label">Province</label>
                                        <div class="col-md-6">
                                          <select class=" form-control department" name="province_id">

                                            <option value="0" >-Select-</option>
                                            @foreach ($structures as $structure)
                                              <option value="{{$structure->id}}"{{$structure->id == $block->province_id ? 'selected' : ''}}>{{$structure->name_in_thai}}</option>
                                                @endforeach

                                              </select>

                                    </div>
                                      </div>
                          <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Code</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{$block->code}}" required autofocus>

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name_in_thai') ? ' has-error' : '' }}">
                            <label for="name_in_thai" class="col-md-4 control-label">District Name In Thai</label>

                            <div class="col-md-6">
                                <input id="name_in_thai" type="text" class="form-control" name="name_in_thai" value="{{$block->name_in_thai}}" required autofocus>

                                @if ($errors->has('name_in_thai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name_in_thai') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name_in_english') ? ' has-error' : '' }}">
                            <label for="name_in_english" class="col-md-4 control-label">District Name In English</label>

                            <div class="col-md-6">
                                <input id="name_in_english" type="text" class="form-control" name="name_in_english" value="{{$block->name_in_english}}" required autofocus>

                                @if ($errors->has('name_in_english'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name_in_english') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
          .
                          </div>
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
