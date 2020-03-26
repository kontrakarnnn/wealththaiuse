  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-color: rgba(0,0,0,0.5)">
	  
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">

       <!-- Sidebar user panel (optional) -->

       <!-- /.search form -->

       <!-- Sidebar Menu -->
       <ul class="sidebar-menu">
         {!!session()->get('tree')!!}
       <li ><a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i  style="color:red"class="fa fa-power-off"></i><span>Logout</span>

     </a></li>
       </ul>

     </section>


     <!-- /.sidebar -->
   </aside>
