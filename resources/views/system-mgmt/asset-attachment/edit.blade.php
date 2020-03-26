@extends('system-mgmt.asset-attachment.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Port Asset</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('asset-attachment.update', ['id' => $userauth->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">





                        <div class="form-group{{ $errors->has('asset_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Asset:</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="asset_id" id="nameid">

                              <option value="0" >-Select-</option>
                              @foreach ($structures as $structure)
                                  <option value="{{$structure->id}}"{{$structure->id == $userauth->asset_id ? 'selected' : ''}}>{{$structure->name}}</option>
                              @endforeach

                          </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">File</label>
                            <div class="col-md-6">
                              <select class="col-md-6 form-control name " name="file_id" id="nameid2">


                                  @foreach ($blocks as $block)
                                      <option value="{{$block->id}}"{{$block->id == $userauth->file_id ? 'selected' : ''}}>{{$block->file_public_name}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>


                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $userauth->name}}" >

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid2").select2({
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
