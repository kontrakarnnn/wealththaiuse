@extends('system-mgmt.group-of-service.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">


        <div class="col-sm-8">
          <h3 class="box-title">List of group</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('group-of-service.create') }}">Add new group</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">

        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('group-of-service.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['msg_type_name','name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['msg_type_name'] : '',isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent



        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">



		<div style="overflow-x:auto;">

          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">

               <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">name</th>
				<th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Default</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>




              </div>



            @foreach ($msg_types as $mt)
                <tr role="row" class="odd">


                  <td>{{ $mt->name }}</td>
					 <td>{{ $mt->main }}</td>



                <td>
                    <form class="row" method="POST" action="{{ route('group-of-service.destroy', ['id' => $mt->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('group-of-service.edit', ['id' => $mt->id]) }}" class="btn btn-warning  btn-margin">
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
                               <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">name</th>
				<th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Default</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
		</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($msg_types)}} of {{count($msg_types)}} entries</div>

        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
              {{ $msg_types->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>



    <!-- /.content -->
  </div>

@endsection
