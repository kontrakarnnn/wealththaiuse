<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
  </head>
  <body>
    <h1>Hello user ID{{ Auth::user()->id}}, comming soon</h1>
    <h1>Hello {{ Auth::user()->username}}, comming soon</h1>
      <h1>lastname {{ Auth::user()->lastname}}, comming soon</h1>
      <h1>email {{ Auth::user()->email}}, comming soon</h1>
      <h1>department {{ Auth::user()->department_id}}, comming soon</h1>
      <h1>division {{ Auth::user()->division_id}}, comming soon</h1>
      <h1>division {{ Auth::user()->division_name}}, comming soon</h1>



  </body>
</html>
