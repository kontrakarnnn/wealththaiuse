@extends('system-mgmt.partnerauth.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('partnerauth.update', ['id' => $partnerauth->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Partner</label>
                            <div class="col-md-6">
                              <select class="form-control" name="partner_id"  id="nameid">
                                <option></option>
                                @foreach($partner as $user)
                              <option value="{{$user->id}}" {{$user->id == $partnerauth->partner_id ? 'selected' : ''}}>{{$user->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Structure:</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="structure_id">

                              <option value="0" >-Select-</option>
                              @foreach ($partnerstructure as $structure)
                                  <option value="{{$structure->id}}"{{$structure->id == $partnerauth->structure_id ? 'selected' : ''}}>{{$structure->name}}</option>
                              @endforeach

                          </select>
                          <label class="col-md-4 control-label">Belong to:</label>

                          <select class="col-md-6 form-control name " name="block_id" required autofocus>

                              <option value="0" disabled="true" selected="true">Belong to</option>
                              @foreach ($partnerblock as $block)
                                  <option value="{{$block->id}}"{{$block->id == $partnerauth->block_id ? 'selected' : ''}}>{{$block->name}}</option>
                              @endforeach
                          </select>
                        </div>
                        </div>




                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">description</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ $partnerauth->description }}" >

                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
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
                url:'{!!URL::to('findpartnerblock')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
                  op+='<option value="0" selected disabled>chose Block</option>';
                  for(var i=0; i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

                  }
                  $('.name').html(" ");
                  $('.name').append(op);

                },
                error:function(){

                }
            });
        });
    });
</script>
@endsection
