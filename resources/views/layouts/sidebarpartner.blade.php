  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        {{--}}<div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/avatar5.png") }}" class="img-circle" alt="User Image">
        </div>--}}
        <div class="pull-left info">
          <p></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->

      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
     {!!session()->get('sidepart')!!}
		      
    </ul>
	<li class=""><a href="/wealththaipartner/logout"><i style ="color:red;" class="fa fa-power-off"></i><span>Logout</span></a></li>


    </section>


    <!-- /.sidebar -->
  </aside>
