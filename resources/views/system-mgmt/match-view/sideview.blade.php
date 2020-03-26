
 <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/avatar5.png") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p></p>
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
      <ul class="sidebar-menu">
        @foreach ($views as $view)
              <li><a href="{{$view->view_url}}"><i class="fa fa-link"></i> <span>{{$view->name}}</span></a></li>
        @endforeach
      </ul>
      <!-- /.sidebar-menu -->
    </section>

    <section class="content">





    </section>
    <!-- /.sidebar -->
  </aside>
</div>
  <!-- Main Header -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">

      <div class="box">




            <div class="panel panel-default">
                <div class="panel-heading">Your Notebook</div>
                <div class="panel-body">

                  <button class="btn btn-primary btn-block"></button>
                </div>
            </div>

          </div>
        </div>

      </div>
    </section>


          </div>
  @include('layouts.footer-per')


  <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>

  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
       Both of these plugins are recommended to enhance the
       user experience. Slimscroll is required when using the
       fixed layout. -->

  </body>
  </html>
