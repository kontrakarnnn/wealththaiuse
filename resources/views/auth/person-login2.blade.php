@extends('layouts.app-per')

@section('content')
<div class="container">
	<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Member Login  </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('person.login.submit') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
															@if($chkmail == 1)
                                <input readonly id="email" type="email" class="form-control" name="email" value="{{$email}}" required autofocus>
															@else
															<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

															@endif
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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
																@if($chkrelink == 1)
                                <a class="btn btn-primary" href="/quickregister?{{$chkredirectlink}}">
                                    Register
                                </a>
																@else
																<a class="btn btn-primary" href="/quickregister">
																		Register
																</a>
																@endif

                                </a>



                               {{-- {{Html::link('perregis/create', 'Full Register', array(
                                'class' => 'btn btn-link'
                                ))}}--}}
                                <a class="btn btn-link" href="{{ route('person.password.request') }}">
                                    Forgot Your Password?
                                </a>
																@if($chkrelink == 1)
																<input type="hidden" type="text" class="form-control" name="previous"  value="{{$chkredirectlink}}">
																@else
																<input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">

																@endif


                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
