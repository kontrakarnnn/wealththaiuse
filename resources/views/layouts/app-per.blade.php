<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow"/>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   <link rel="shortcut icon" href="/img/pigg.png" />
	<title>Wealththai</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous" -->
    <!-- Scripts -->
    <title>Dynamic Treeview with jQuery, Laravel PHP Framework Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="http://www.expertphp.in/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://demo.expertphp.in/css/jquery.treeview.css" />
    <script src="http://demo.expertphp.in/js/jquery.js"></script>
    <script src="http://demo.expertphp.in/js/jquery-treeview.js"></script>
    <script type="text/javascript" src="http://demo.expertphp.in/js/demo.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<style>

body {
  background-image: url(../img/home4.jpg);

background-repeat: no-repeat -9999px -9999px;
background-size: cover;
background-attachment: ;

}

</style>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-dark" style="background-color: #00325d;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="https://wealththai.co.th">
                      <img style="max-width:100px; margin-top: -5px;"
                      src="{{url('../')}}/img/logo.png">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <div class="nav navbar-nav navbar-right">
                  <a class="navbar" style="color:#FFFFFF" href="https://wealththai.co.th">
                  Back to main website
                  </a>
                </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
     <!--script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script -->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script-->
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script-->
</body>
</html>
