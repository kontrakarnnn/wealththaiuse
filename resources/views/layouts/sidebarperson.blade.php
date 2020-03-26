  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/avatar5.png") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" >
        <!-- Optionally, you can add icons to the links -->

        <li><a href="/dashboard"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Form Center</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">


<li ><a href="/memreport"><i class="fa fa-link"></i> <span>Ktbst_Open_accountForm</span></a></li>
		  <li ><a href="/memmtsreport"><i class="fa fa-link"></i> <span>MTS_Open_accountForm</span></a></li>
            </ul>
          </li>

        <li class="treeview">
          <a href="{{ route('user-management.index') }}"><i class="fa fa-link"></i> <span>Admin management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user-management.index') }}"><span>Admin management</span></a></li>
			        <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Notification Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">


                <li><a href="{{ url('system-management/message_category') }}">Message Category</a></li>
                <li><a href="{{ url('/system-management/message-type') }}">Message Type</a></li>
                <li><a href="{{ url('system-management/match-id') }}">Public ID</a></li>
                  <li><a href="{{ url('/system-management/notiadmin') }}">Notification Management</a></li>


              </ul>
            </li>
            <li><a href="{{ url('employee-management') }}">Employee Management</a></li>
            <li><a href="/admin">Role Management</a></li>
            <li><a href="{{ route('user-management.index') }}">User Management</a></li>
            <li><a href="{{ url('system-management/userauth') }}">Userauth</a></li>
            <li><a href="{{ url('system-management/structure') }}">Structure</a></li>
            <li><a href="{{ url('system-management/block') }}">Block</a></li>
            <li><a href="{{ url('system-management/porttype') }}">PortType</a></li>
			  <li><a href="{{ url('admin/portfolioadmin') }}">Portfolio Management</a></li>
        <li><a href="{{ url('peradmin') }}">Member Management</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Pre-Config System Data</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">


                <li><a href="{{ url('system-management/country') }}">Country</a></li>
                <li><a href="{{ url('system-management/state') }}">State</a></li>
                <li><a href="{{ url('system-management/city') }}">City</a></li>


              </ul>
            </li>
          </ul>
        </li>

        {{--<li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>System Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('system-management/structure') }}">Structure</a></li>
            <li><a href="{{ url('system-management/block') }}">Block</a></li>
            <li><a href="{{ url('system-management/country') }}">Country</a></li>
            <li><a href="{{ url('system-management/state') }}">State</a></li>
            <li><a href="{{ url('system-management/city') }}">City</a></li>
            <li><a href="{{ url('system-managements/report') }}">Report</a></li>
			  <li><a href="{{ url('reportper') }}">Report Customer Demo</a></li>
            <li><a href="{{ url('system-management/portfolio') }}">Portfolio</a></li>
            <li><a href="{{ url('system-management/porttype') }}">PortType</a></li>

            <li><a href="{{ url('system-management/userauth') }}">Userauth</a></li>
          </ul>
        </li>--}}

          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Member Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">


              <li><a href="{{ route('per.index') }}">Member</a></li>
              <li><a href="{{ url('system-management/portfolio') }}">Portfolio</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Message Center</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">


              <li><a href="{{ url('/system-management/noti/create') }}">Create New Message</a></li>
              <li><a href="{{ url('/system-management/noti') }}">All</a></li>
              <li><a href="{{ url('/system-management/inbox') }}">Inbox</a></li>
              <li><a href="{{ url('/system-management/sentbox') }}">Sent Box</a></li>
              <li><a href="#">Edit My Contact</a></li>
            </ul>
          </li>
            <li><a href="{{ url('/system-management/ccnoti') }}"><i class="fa fa-link"></i> <span>CC Notification</span></a></li>
        <li><a href="{{ url('system-managements/report') }}"><i class="fa fa-link"></i> <span>Report</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>System Configuration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

          </ul>
        </li>
        <li ><a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-link"></i><span>Logout</span>

      </a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
