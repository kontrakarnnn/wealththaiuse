@extends('system-mgmt.leadstatus.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div>
  <div class="box-header">
    <div class="row">


        <div class="col-sm-8">
          <h3 class="box-title">List of Lead Status</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('leadstatus.create') }}">Add New Lead Status</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">

        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
	  {{--
      <form method="POST" action="{{ route('leadstatus.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['structure_name','name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['structure_name'] : '',isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent

		         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['structure_name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['structure_name'] : '']])
          @endcomponent

        @endcomponent
      </form>--}}
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">



		<div style="overflow-x:auto;">

          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Lead Status Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>




              </div>



            @foreach ($leadstatus as $status)
                <tr role="row" class="odd">
                    <td>{{ $status->name }}</td>
                    <td>
                    <form class="row" method="POST" action="{{ route('leadstatus.destroy', ['id' => $status->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('leadstatus.edit', ['id' => $status->id]) }}" class="btn btn-warning  btn-margin">
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
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Lead Status Name</th>
                 <th>Action</th>
              </tr>
            </tfoot>
          </table>
		</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($leadstatus)}} of {{count($leadstatus)}} entries</div>

        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
              {{ $leadstatus->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>



    <!-- /.content -->


@endsection
