<!DOCTYPE html>
<html lang="en">

<head>
	<title>Wealththai</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex,nofollow"/>

<!--===============================================================================================-->
<link rel="shortcut icon" href="/img/pigg.png" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fontslogin/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fontslogin/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendorlogin/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/util.css">
	<link rel="stylesheet" type="text/css" href="csslogin/main.css">
<!--===============================================================================================-->

</head>

<body >

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(img/1.jpg);">
					<a href="https://wealththai.co.th"><span class="login100-form-title-1">
            <img style="max-width:1000px; "
                     src="{{url('../')}}/img/logo.png">					</span></a>
				</div>
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div>
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">E-Mail</span>
            <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">
						<input class="input100" id="email" type="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input id="password" type="password" class="input100" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="{{ route('password.request') }}" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="vendorlogin/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/bootstrap/js/popper.js"></script>
	<script src="vendorlogin/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/daterangepicker/moment.min.js"></script>
	<script src="vendorlogin/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendorlogin/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="jslogin/main.js"></script>

</body>
</html>
