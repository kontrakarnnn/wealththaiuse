<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<style>

table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
}


</style>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/img/pigg.png" />
	<title>Total Portfolio</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect.
    -->
  <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/app-template.css') }}" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
  <link href="http://www.expertphp.in/css/bootstrap.css" rel="stylesheet">


  <script src="http://demo.expertphp.in/js/jquery.js"></script>
  <script src="http://demo.expertphp.in/js/jquery-treeview.js"></script>
  <script type="text/javascript" src="http://demo.expertphp.in/js/demo.js"></script>


  {{--for datatable dropdown--}}
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


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
  @include('layouts.sidebarper')
  <!-- Sidebar -->

  <!-- Main Header -->


  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">


      <div class="box">
<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">

        <div style="overflow-x:auto;">




            @if(count($portor)!="0")
              <h3> Group Port </h3>
              <select class="form-control"size="1" name="links" onchange="window.location.href=this.value;">
                <option>Select Your Organize</option>
                @foreach($curorgs as $depList)

      <option value="{{url('portshowgroups')}}/{{$depList->name}}">  {{$depList->name}}</option>
      @endforeach

      </select>
      <br>
            <table class="table table-bordered table-hover dataTable" role="grid">

              <thead>
                <tr role="row">
                  {{--}}<th width="2%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">No.</th>

                  <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Port Number.</th>
                  <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Port Type</th>
                  <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Structure</th>
                  <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Marketing</th>
                  <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Service</th>--}}
                  <th >No.</th>
                  <th >Port Number</th>
                  <th >Port Type</th>
                  <th >Company</th>
                  <th >Organization</th>
                  <th >Department</th>
          <th>Contact</th>
                  <th >Service</th>





                </tr>
              </thead>
              <tbody>


                @foreach ($portor as $u)
                  <tr role="row" >


                    <td>
                      {{ ++$i}}

                    </td>

                    <td>
                        {{ $u->number}}
                    </td>
                    <td>
                        {{ $u->port_name}}
                    </td>
                    <td>
                        {{ $u->family_name}}
                    </td>
                    <td>
                        {{ $u->structure_name}}
                    </td>
                    <td>
                        {{ $u->block_name}}
                    </td>
             <td>
                          <a href="mailto: {{$u->contact_email}}" target="_top"><span class="fa fa-user" title="Login"> </span></a>  :<a href="mailto: {{$u->contact_email}}" target="_top">   {{ $u->contact_name}}</a><br>
                        <a href="tel: {{ $u->contact_tel}}" target="_top"> <span class="glyphicon glyphicon-phone-alt" title="Login"></span></a> :<a href="tel: {{ $u->contact_tel}}" target="_top">{{ $u->contact_tel}}</a><br>

                        <a href="mailto: {{$u->contact_email}}" target="_top"><span class="fa fa-envelope" title="Login"></span></a> :<a href="mailto: {{$u->contact_email}}" target="_top">{{ $u->contact_email}}</a>

                    </td>

                    <td>

                    <a href="{{ $u->port_link}}" target="_blank">
                        <span style="margin-left:5%;font-size:150%"class="glyphicon glyphicon-log-in" title="Login"></span>
                      </a>
                      <a href="{{ URL::to('/note',$u->id)}}">
                          <span style="margin-left:5%;font-size:150%"class="glyphicon glyphicon-list-alt" title="Notebook"></span>
                        </a>
                        {{--}}a href="{{ $u->port_link}}" target="_blank">{{ $u->port_link}}</a>--}}

                    </td>

                  {{--  <td>

                   <a class="btn btn-primary"href="/note/{{$u->id}}">Add Data</a>
                     <a class="btn btn-primary"href="{{ URL::to('/note',$u->id)}}">Add Data</a>
                  </td>--}}
                </tr>

              @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th >No.</th>
                  <th >Port Number</th>
                  <th >Port Type</th>
                  <th >Company</th>
                       <th >Organization</th>
                  <th >Department</th>
           <th>Contact</th>
                  <th >Service</th>
                  {{--}}
                  <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending">Port Number</th>
                  <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port type</th>
                  <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Structure</th>
                  <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Marketing</th>
                  <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Service</th>--}}



                  {{--<th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">No.</th>
                  <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port Name</th>
                  <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port type</th>
                  <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Structure</th>
                  <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Block</th>
                  <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>--}}



                </tr>
              </tfoot>
            </table>
          @endif

  </div>
        </div>
        </div>
          </div>
        </div>

      </div>
    </section>


          </div>
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
