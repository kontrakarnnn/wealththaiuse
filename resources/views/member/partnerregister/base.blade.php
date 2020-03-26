@extends('layouts.app-template-per')
@section('content')
<style>
.content-wrapper {
  background-image:url({{url('../img/126.jpg')}});
  background-repeat: no-repeat, repeat;
 height: 500px;
 background-position: center;
 background-size: cover;
}
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

      </h1>

    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection
