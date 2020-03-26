@extends('layouts.app-template')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Partner Block Management
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="/admin/partnerstructure">Partner Structure</a></li>
        <li ><a  style="color:#00325d" href="/admin/partnerblock"><i class="fa fa-dashboard"></i>Partner Block</a></li>
        <li class="active"><a href="/admin/partnerauth">Partner Auththentication</a></li>
      </ol>
    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection
