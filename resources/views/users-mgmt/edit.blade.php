@extends('users-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update user</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user-management.update', ['id' => $user->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" required>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                       <label class="col-md-4 control-label">Status</label>
                                       <div class="col-md-6">
                                           <select class="form-control " name="status">
                                           <option>{{$user->status}}</option>


                                                   <option>Request</option>
                                                   <option style="color:green">Active</option>
                                                   <option style="color:orange">Suspend</option>
                                                   <option style="color:red">Banned</option>
                                                   <option style="color:grey">Disabled</option>
                                           </select>
                                       </div>
                                   </div>

                                   <div class="form-group{{ $errors->has('limit_prospect') ? ' has-error' : '' }}">
                                       <label for="limit_prospect" class="col-md-4 control-label">Limit Prospect</label>

                                       <div class="col-md-6">
                                           <input id="limit_prospect" type="text" class="form-control" name="limit_prospect" value="{{ $user->limit_prospect }}" required>

                                           @if ($errors->has('lastname'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('limit_prospect') }}</strong>
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
@endsection
