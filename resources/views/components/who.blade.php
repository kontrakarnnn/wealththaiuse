@if(Auth::guard('web')->check())
  <p class="text-success">
    You are Logged In as a USER
  </p>
@else
  <p calss="text-danger">
    Youare logged out as User
  </p>
@endif

@if(Auth::guard('person')->check())
  <p class="text-success">
    You are Logged In as a Person
  </p>
@else
  <p calss="text-danger">
    Youare logged out as Person
  </p>
@endif
