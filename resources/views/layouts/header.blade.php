  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="https://wealththai.co.th" class="logo" style="background-color: #00325d;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>W</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" ><img style="max-width:150px; "
               src="{{url('../')}}/img/logo.png"></a></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color: #00325d;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu" >
        <ul class="nav navbar-nav" >
          <!-- User Account Menu -->

        </ul>
      </div>
    </nav>
  </header>
   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>
