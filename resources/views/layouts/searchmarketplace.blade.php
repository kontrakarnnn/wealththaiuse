<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 data-widget="collapse" class="box-title">{{isset($title) ? $title : 'Search'}}</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {{ $slot }}
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <button type="submit" class="btn btn-primary">
      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
      Search
    </button>
  </div>
</div>
