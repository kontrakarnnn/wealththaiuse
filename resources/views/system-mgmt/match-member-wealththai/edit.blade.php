@extends('system-mgmt.match-member-wealththai.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Member In Academic</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('match-member-wealththai.update', ['id' => $matchgroup->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">





                        <div class="form-group">
                            <label class="col-md-4 control-label">member</label>
                            <div class="col-md-6">
                              <select class="form-control" name="member_id"  id="nameid">
                                <option></option>
                                @foreach($members as $member)
                              <option value="{{$member->id}}" {{$member->id == $matchgroup->member_id ? 'selected' : ''}}>{{$member->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Guild </label>
                            <div class="col-md-6">
                              <select class="form-control party" name="member_group_id"  id="">

                                @foreach($ugroups as $ug)
                              <option value="{{$ug->id}}" {{$ug->id == $matchgroup->member_group_id ? 'selected' : ''}}>{{$ug->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group">
                                          <label class="col-md-4 control-label">Party</label>
                                          <div class="col-md-6">
                                            <select class="form-control par" name="party_id"  id="">
                                              <option></option>
                                              @foreach($party as $person)
                                              <option value="{{$person->id}}" {{$person->id == $matchgroup->party_id ? 'selected' : ''}}>{{$person->name}}</option>
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
<script type="text/javascript">

      $("#par").select2({
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $(document).on('change','.party',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findPartyName')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);

                  for(var i=0; i<data.length;i++){

                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

                  }
                  $('.par').html(" ");
                  $('.par').append(op);

                },
                error:function(){

                }
            });
        });

    });
</script>
@endsection
