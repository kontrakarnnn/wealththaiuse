@extends('per.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div>
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Member Product</h3>
        </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

      <div class="row">
        <div class="col-sm-12">
			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Product Name</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Product Status</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Product  Infomation Link</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Member Name</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Member Tool Status</th>

              </tr>
            </thead>
            <tbody>
            @foreach ($persons as $user)
                <tr role="row" class="odd">
                  <td style =" ">{{ $user->Tool->name }}</td>
                  <td style =" ">{{ $user->Tool->status }}</td>
                  <td style =" ">{{ $user->Tool->tool_info_link }}</td>
                  <td style =" ">{{ $user->Person->name }} {{ $user->Person->lname }}</td>
                  <td style =" ">{{ $user->Member_Tool_Status->name }}</td>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Product Name</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Product Status</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Product  Infomation Link</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Member Name</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Member Tool Status</th>

              </tr>
            </tfoot>
          </table>
        </div>
		  </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($persons)}} of {{count($persons)}} entries</div>
        </div>
        <div class="col-sm-7">

        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<script>
$('#button').click(function(){
var id='2';
$('#content').load('/admin/portreflink/'+id+'/edit')
})
</script>
    </section>
    <!-- /.content -->
@endsection
