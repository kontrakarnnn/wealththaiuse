@extends('layouts.app-template-per')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <ol class="breadcrumb">
        <!-- li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li-->
 		Message Center
      </ol>
    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection
