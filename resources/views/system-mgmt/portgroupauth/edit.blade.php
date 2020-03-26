@extends('system-mgmt.organizeauth.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update organizeauth</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('organizeauth.update', ['id' => $userauth->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Member</label>
                            <div class="col-md-6">
                              <select class="form-control" name="member_id"  id="nameid">

                                @foreach($users as $user)
                              <option value="{{$user->id}}" {{$user->id == $userauth->member_id ? 'selected' : ''}}>{{$user->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('organize_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">organize</label>
                        <div class="col-md-6">
                          <select class=" form-control " name="organize_id" id="nameid2">

                              <option value="" >-Select-</option>
                              @foreach ($structures as $structure)
                                  <option value="{{$structure->id}}"{{$structure->id == $userauth->organize_id ? 'selected' : ''}}>{{$structure->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>




                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">description</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ $userauth->description }}" >

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

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $("#nameid2").select2({
            placeholder: "Select a Name",
            allowClear: true
        });
</script>

@endsection
