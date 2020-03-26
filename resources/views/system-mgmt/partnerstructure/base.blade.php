@extends('layouts.app-template')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Partner Structure Mangement
      </h1>
      <ol class="breadcrumb" >
        <li ><a style="color:#00325d"href="/admin/partnerstructure"><i class="fa fa-dashboard"></i>Partner Structure</a></li>
        <li class="active"><a href="/admin/partnerblock">Partner Block</a></li>
        <li class="active"><a href="/admin/partnerauth">Partner Auththentication</a></li>
      </ol>
    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection
