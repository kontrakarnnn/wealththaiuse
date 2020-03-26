<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="shortcut icon" href="/img/pigg.png" />
	<title>Your Note</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
   <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
   <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('layouts.headerper')
  <!-- Sidebar -->
@include('layouts.sidebarper')
  <!-- Main Header -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">

      <div class="box">




            <div class="panel panel-default">
                <div class="panel-heading">Your Notebook</div>
                <div class="panel-body">

                    <form   class="form-horizontal" role="form" method="POST" action="{{ URL::to('/update')}}">
                      {{--}}<form  method="POST" action="{{ route('update')}}">--}}
                       {{ csrf_field() }}
                       <input type="hidden" name="id" value="{{ $id }}">


                      {{--}}  <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                            <label for="number" class="col-md-4 control-label">notebook</label>

                            <div class="col-md-6">
                                <input id="note" type="text" class="form-control" name="note" value="{{ $portfolio->note }}" >

                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>--}}

                        @if(isset($portfolio->note))
                        {{Form::textarea('note',$portfolio->note,['class'=> 'form-control'])}}
                        @else
                        {{Form::textarea('note','',['class'=> 'form-control'])}}
                        @endif






						<input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">

                        <br>
                        <div class="form-group">
                            <div class="col-md-6 ">
                                <a  href ="{{ URL::previous() }}"type="button" class="btn btn-warning">
                                    Back
                                </a>
								<button type="submit" class="btn btn-primary">
                                    Save
                                </button>
								 

                            </div>
                        </div>
                    </form>
                </div>
            </div>

          </div>
        </div>

    </section>



  @include('layouts.footer-per')


  <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>

  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
       Both of these plugins are recommended to enhance the
       user experience. Slimscroll is required when using the
       fixed layout. -->

  </body>
  </html>
