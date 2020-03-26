@extends('system-mgmt.case-auth.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('case-auth.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('case_id') ? ' has-error' : '' }}">
                            <label for="case_id" class="col-md-4 control-label">Case</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="case_id">
                                <option value="0" >-Select-</option>
                                @foreach ($case as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('public_id') ? ' has-error' : '' }}">
                            <label for="public_id" class="col-md-4 control-label">Public ID</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="public_id">
                                <option value="0" >-Select-</option>
                                @foreach ($public_id as $ca)
                                  <option value={{$ca->id}} >{{$ca->public_name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('block_partner') ? ' has-error' : '' }}">
                            <label for="block_partner" class="col-md-4 control-label">Block Partner</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="block_partner">
                                <option value="0" >-Select-</option>
                                @foreach ($partnerblock as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('block_user') ? ' has-error' : '' }}">
                            <label for="block_user" class="col-md-4 control-label">Block User</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="block_user">
                                <option value="0" >-Select-</option>
                                @foreach ($block as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('guild_member') ? ' has-error' : '' }}">
                            <label for="guild_member" class="col-md-4 control-label">Guild Member</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="guild_member">
                                <option value="0" >-Select-</option>
                                @foreach ($guildmember as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('group_member') ? ' has-error' : '' }}">
                            <label for="group_member" class="col-md-4 control-label">Group Member</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="group_member">
                                <option value="0" >-Select-</option>
                                @foreach ($membergroup as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('group_pid') ? ' has-error' : '' }}">
                            <label for="group_pid" class="col-md-4 control-label">Group PID</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="group_pid">
                                <option value="0" >-Select-</option>
                                @foreach ($pidgroup as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('group_partner') ? ' has-error' : '' }}">
                            <label for="group_partner" class="col-md-4 control-label">Group Partner</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="group_partner">
                                <option value="0" >-Select-</option>
                                @foreach ($partnergroup as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}"></textarea>

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
                                    Create
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

      $(".name").select2({
            placeholder: "Select",
            //allowClear: true
        });
</script>
@endsection
