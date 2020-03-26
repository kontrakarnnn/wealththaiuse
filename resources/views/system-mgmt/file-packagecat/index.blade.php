@extends('system-mgmt.file-packagecat.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">


        <div class="col-sm-8">
          <h3 class="box-title">List of File Package-Connect-Category</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('file-packagecat.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">

        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('file-packagecat.search') }}">
         {{ csrf_field() }}
        {{-- @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['name','name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '',isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent--}}

		         @component('layouts.search', ['title' => 'Search'])
             @component('layouts.two-cols-search-row', ['items' => ['name'],
             'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
             @endcomponent
             <br />
             <div class="row">

                 <div class="col-md-6">
                   <div class="form-group">

                       <label for="file_package_name" class="col-sm-3 control-label">file_package_name</label>
                       <div class="col-sm-9">
                         <select value="file_package_name"  class="form-control" name="file_package_name" id="file_package_name" placeholder="file_package_name">
                           <option>

                           </option>
                           @foreach($filepackage as $catgroup)
                            <option>
                             {{$catgroup->name}}
                           </option>
                           @endforeach
                         <select>
                       </div>
                   </div>
                 </div>

                 <div class="col-md-6">
                   <div class="form-group">

                       <label for="file_category_name" class="col-sm-3 control-label">file_category_name</label>
                       <div class="col-sm-9">
                         <select value="file_category_name"  class="form-control" name="file_category_name" id="file_category_name" placeholder="file_category_name">
                           <option>

                           </option>
                           @foreach($filecat as $cat)
                            <option>
                             {{$cat->name}}
                           </option>
                           @endforeach
                         <select>
                       </div>
                   </div>
                 </div>
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
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">File Package</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">File Category</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Description</th>
                <th >Action</th>
              </tr>
            </thead>
            <tbody>








            @foreach ($events as $event)
                <tr role="row" class="odd">



                  <td>{{ $event->file_package_name}}</td>
                  <td>{{ $event->file_category_name}}</td>
                  <td>{{ $event->name}}</td>
                  <td>{{ $event->description}}</td>




                  <td>
                    <form class="row" method="POST" action="{{ route('file-packagecat.destroy', ['id' => $event->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('file-packagecat.edit', ['id' => $event->id]) }}" class="btn btn-warning  btn-margin">
							Update
                        </a>
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
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">File Package</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">File Category</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Description</th>
                <th >Action</th>
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

@endsection
