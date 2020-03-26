@extends('layouts.app')

@section('content')
    <form action="{{ route('signup') }}" method="post">
        <div class="input-group">
            <label for="username">User Name</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="input-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname">
        </div>
        <div class="input-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname">
        </div>
        <div class="input-group">
            <label for="email">E-Mail</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        {{ csrf_field() }}
        <button type="submit">Sign Up</button>
    </form>
@endsection
