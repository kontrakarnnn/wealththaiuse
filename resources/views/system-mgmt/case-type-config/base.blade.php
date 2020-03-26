@extends('layouts.app-template')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Case Type Config
      </h1>
      <ol class="breadcrumb" >
        <li class="active"><a href="/admin/case-category">Case Category</a></li>
        <li ><a style="color:#00325d"href="/admin/case-type"><i class="fa fa-dashboard"></i>Case Type</a></li>
        <li class="active"><a href="/admin/case-subtype">Case SubType</a></li>
      </ol>
    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection
