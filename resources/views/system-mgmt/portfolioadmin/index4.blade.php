@extends('system-mgmt.portfolio.base')
@section('action-content')
@include('system-mgmt.portfolio.ourJs')

    {{ $user->user_auths->block_id }}


@endsection
