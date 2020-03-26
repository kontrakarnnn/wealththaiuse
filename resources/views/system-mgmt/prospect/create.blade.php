@extends('system-mgmt.prospect.base')

@section('action-content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Prospect</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('prospect.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                            <label for="lname" class="col-md-4 control-label">Lastname</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}"  >

                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                            <label for="nickname" class="col-md-4 control-label">Nickname</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}"  >

                                @if ($errors->has('nickname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}"  >

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"  >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('relation') ? ' has-error' : '' }}">
                            <label for="relation" class="col-md-4 control-label">Relation</label>

                            <div class="col-md-6">
                                <input id="relation" type="text" class="form-control" name="relation" value="{{ old('relation') }}"  >

                                @if ($errors->has('relation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('relation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Type</label>

                            <div class="col-md-6">
                              <select  class="form-control nameid" name="type" >
                                  <option value="Personal" >Personal</option>
                                  <option value="Refered" >Refered</option>
                                  <option value="Office" >Office</option>
                                  <option value="Special" >Special</option>
                                  <option value="Partner" >Partner</option>
                                  <option value="Event" >Event</option>
                                  <option value="Cold-Calling" >Cold-Calling</option>
                                  <option value="Target_Group">Target_Group</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <label for="priority" class="col-md-4 control-label">Priority</label>

                            <div class="col-md-6">
                              <select  class="form-control nameid" name="priority" >
                                  <option value="1" >1</option>
                                  <option value="2" >2</option>
                                  <option value="3" >3</option>
                                  <option value="4" >4</option>
                                  <option value="5" >5</option>

                              </select>
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
  @endsection
