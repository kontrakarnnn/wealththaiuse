  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="https://wealththai.net" class="logo" style="background-color: #00325d;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>W</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img style="max-width:150px; "
               src="https://erp.wealththai.net/img/logo.png"></a> </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color: #00325d;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      {{--}}<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{ asset("/bower_components/AdminLTE/dist/img/avatar5.png") }}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"></span>
            </a>

          </li>
        </ul>
      </div>--}}
    </nav>
  </header>
   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>
