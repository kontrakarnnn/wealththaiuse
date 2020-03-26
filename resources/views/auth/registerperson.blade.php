@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
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
                            <label for="lname" class="col-md-4 control-label">lName</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control" name="lname" value="{{ old('lname') }}" required autofocus>

                                @if ($errors->has('lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="dob" class="col-md-4 control-label">dob</label>

                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control" name="dob" value="{{ old('dob') }}" required autofocus>

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age" class="col-md-4 control-label">age</label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}" required autofocus>

                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('id_num') ? ' has-error' : '' }}">
                            <label for="id_num" class="col-md-4 control-label">id_num</label>

                            <div class="col-md-6">
                                <input id="id_num" type="text" class="form-control" name="id_num" value="{{ old('id_num') }}" required autofocus>

                                @if ($errors->has('id_num'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_num') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="id_num" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_num') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('university') ? ' has-error' : '' }}">
                            <label for="university" class="col-md-4 control-label">university</label>

                            <div class="col-md-6">
                                <input id="university" type="text" class="form-control" name="university" value="{{ old('university') }}" required autofocus>

                                @if ($errors->has('university'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('university') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }}">
                            <label for="faculty" class="col-md-4 control-label">faculty</label>

                            <div class="col-md-6">
                                <input id="faculty" type="text" class="form-control" name="faculty" value="{{ old('faculty') }}" required autofocus>

                                @if ($errors->has('faculty'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('faculty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
                            <label for="major" class="col-md-4 control-label">major</label>

                            <div class="col-md-6">
                                <input id="major" type="text" class="form-control" name="major" value="{{ old('major') }}" required autofocus>

                                @if ($errors->has('major'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('major') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gpa') ? ' has-error' : '' }}">
                            <label for="gpa" class="col-md-4 control-label">gpa</label>

                            <div class="col-md-6">
                                <input id="gpa" type="text" class="form-control" name="gpa" value="{{ old('gpa') }}" required autofocus>

                                @if ($errors->has('gpa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gpa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('job') ? ' has-error' : '' }}">
                            <label for="job" class="col-md-4 control-label">job</label>

                            <div class="col-md-6">
                                <input id="job" type="text" class="form-control" name="job" value="{{ old('job') }}" required autofocus>

                                @if ($errors->has('job'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('workexpr') ? ' has-error' : '' }}">
                            <label for="workexpr" class="col-md-4 control-label">workexpr</label>

                            <div class="col-md-6">
                                <input id="workexpr" type="text" class="form-control" name="workexpr" value="{{ old('workexpr') }}" required autofocus>

                                @if ($errors->has('workexpr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('workexpr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('skill') ? ' has-error' : '' }}">
                            <label for="skill" class="col-md-4 control-label">skill</label>

                            <div class="col-md-6">
                                <input id="skill" type="text" class="form-control" name="skill" value="{{ old('skill') }}" required autofocus>

                                @if ($errors->has('skill'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skill') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('interest') ? ' has-error' : '' }}">
                            <label for="skill" class="col-md-4 control-label">interest</label>

                            <div class="col-md-6">
                                <input id="interest" type="text" class="form-control" name="interest" value="{{ old('interest') }}" required autofocus>

                                @if ($errors->has('interest'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('interest') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('another') ? ' has-error' : '' }}">
                            <label for="skill" class="col-md-4 control-label">another</label>

                            <div class="col-md-6">
                                <input id="interest" type="text" class="form-control" name="another" value="{{ old('another') }}" required autofocus>

                                @if ($errors->has('another'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('another') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="skill" class="col-md-4 control-label">status</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control" name="status" value="{{ old('status') }}" required autofocus>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
