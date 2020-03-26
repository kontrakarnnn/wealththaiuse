@extends('layouts.app-template')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Action
      </h1>
      <ol class="breadcrumb" >
        <li ><a style="color:#00325d"href="/admin/case-caetgory"><i class="fa fa-dashboard"></i>Case Type</a></li>
        <li class="active"><a href="/admin/case-type-config">Case Type Config</a></li>
        <li class="active"><a href="/admin/case-type">Case Type</a></li>
        <li class="active"><a href="/admin/case-subtype">Case SubType</a></li>
        <li class="active"><a href="/admin/case-report">Case Report</a></li>
        <li class="active"><a href="/admin/case-type-report">Case Type To Case Report</a></li>
        <li class="active"><a href="/admin/conditiontype">Condition Type</a></li>
        <li class="active"><a href="/admin/condition">Condition</a></li>

      </ol>
    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection
