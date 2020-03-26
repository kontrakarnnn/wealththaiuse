@extends('system-mgmt.file.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">
      <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div>
      <div class="box">

  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">

        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('file.search') }}">
         {{ csrf_field() }}
        {{-- @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['name','name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '',isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent--}}

		         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['file_ref_name','file_public_name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['file_ref_name'] : '',isset($searchingVals) ? $searchingVals['file_public_name'] : '']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['file_cat_name','type'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['file_cat_name'] : '',isset($searchingVals) ? $searchingVals['type'] : '']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['status','ref_number1'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['status'] : '',isset($searchingVals) ? $searchingVals['ref_number1'] : '']])
          @endcomponent
          <br />
          <label for="chkPassport">
              <input type="checkbox" id="chkPassport" />
              More Filter
          </label>
          <div id="dvPassport" style="display:none">

          @component('layouts.two-cols-search-row', ['items' => ['ref_number2','ref_number3'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['ref_number2'] : '',isset($searchingVals) ? $searchingVals['ref_number3'] : '']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['view_ref_no','edit_ref_no'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['view_ref_no'] : '',isset($searchingVals) ? $searchingVals['edit_ref_no'] : '']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['delete_ref_no','last_time_view'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['delete_ref_no'] : '',isset($searchingVals) ? $searchingVals['last_time_view'] : '']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['last_time_edit','last_time_delete'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['last_time_edit'] : '',isset($searchingVals) ? $searchingVals['last_time_delete'] : '']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['add_by','edit_by'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['add_by'] : '',isset($searchingVals) ? $searchingVals['edit_by'] : '']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['delete_by'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['delete_by'] : '']])
          @endcomponent

        </div>
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">



		<div style="overflow-x:auto;">

          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Ref Name</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Public Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Category</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Type</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Status</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>








            @foreach ($events as $event)
                <tr role="row" class="odd">

                  <td>{{ $event->file_ref_name }}</td>
                  <td>{{ $event->file_public_name }}</td>
                  <td>{{ $event->file_cat_name }}</td>
                  <td>{{ $event->type }}</td>
                  @if($event->status == 'Active')
                  <td style="color:green">{{$event->status}}</td>
                  @elseif($event->status == 'Delete')
                  <td style="color:red">{{$event->status}}</td>
                  @else
                  <td>
                  </td>
                  @endif




                  <td>
                    <form class="row" method="POST" action="{{ route('file.destroy', ['id' => $event->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                          <a href="{{ route('file.show', ['id' => $event->id]) }}" class="btn btn-info  btn-margin">
                          Details
                        </a>
                        <a class="btn btn-primary  btn-margin"href="{{ URL::to('admin/file/fix',$event->id)}}">Update</a>
                        <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>



                    </form>
                  </td>
              </tr>
            @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Ref Name</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Public Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Category</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Type</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Status</th>

                <th>Action</th>
              </tr>
            </tfoot>
          </table>
            </div>
		</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($events)}} of {{count($events)}} entries</div>

        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
              {{ $events->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}

function myFunction2() {
  var copyText = document.getElementById("myInput2");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
    </section>



    <!-- /.content -->
  </div>
  <script>
  $(function () {
          $("#chkPassport").click(function () {
              if ($(this).is(":checked")) {
                  $("#dvPassport").show();
                  $("#AddPassport").hide();
              } else {
                  $("#dvPassport").hide();
                  $("#AddPassport").show();
              }
          });
      });
      </script>
@endsection
