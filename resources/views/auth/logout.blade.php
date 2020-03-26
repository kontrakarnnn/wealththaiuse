@extends('layouts.app')

@section('content')
  <meta http-equiv="refresh" content="3;url=/wealththaiagent">
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))

              <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
            @endforeach
          </div>
            <div class="panel panel-default">
                <div class="panel-heading"><h4>You are now logout.</h4></div>
                <div class="panel-body">

                  You can return to the <a href="/wealththaiagent">home page</a> or <a href="/wealththaiagent">sign in again</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
