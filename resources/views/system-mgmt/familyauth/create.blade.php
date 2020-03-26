@extends('system-mgmt.familyauth.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Invite Member to Group</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('familyauth.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('member_id') ? ' has-error' : '' }}">
                            <label for="member_id" class="col-md-4 control-label">Member Email</label>

                            <div class="col-md-6">
                              
                                <input id="member_id" type="email" class="form-control" name="member_id" value="{{ old('member_id') }}">

                                @if ($errors->has('member_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('member_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                      <label class="col-md-4 control-label">Group</label>
                        <div class="col-md-6">
                          <select class=" form-control " name="family_id" id="nameid2">


                              @foreach ($structures as $structure)
                                  <option value="{{$structure->id}}">{{$structure->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>


                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden"id="status" type="text" class="form-control" name="status"   value="Request" >
                        <input type="hidden"id="created_by" type="text" class="form-control" name="created_by"  value="{{ $current}}"  >
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                            <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">

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



@endsection
