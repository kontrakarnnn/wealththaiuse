@extends('system-mgmt.view-member.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of view member</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('view-member.create') }}">Add new view</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('view-member.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          @if(!empty($divisions))
        <section>
            <h3>Portfolio</h3>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Block</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($divisions as $division)

                <tr>
                  <td>{{$division->portfolio_type}}</td>
                </tr>
              @empty
                <tr><td>No data</td></tr>

              @endforelse
              </tbody>
            </table>
        </section>
      @endif
			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">view Name</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">URL</th>
				  <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">Belong To</th>
				  <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">Sub Node</th>
				  <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">Add To Sidebar</th>
				            <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">Index</th>


                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($views as $view)
                <tr role="row" class="odd">
                  <td>{{ $view->name }}</td>
                  <td>{{ $view->view_url }}</td>
					<td>{{ $view->view_name }}</td>
					<td>{{ $view->sub_node }}</td>
					<td>{{ $view->add_to_side }}</td>
					        <td>{{ $view->priority }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('view-member.destroy', ['id' => $view->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('view-member.edit', ['id' => $view->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                 <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">view Name</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">URL</th>
				  <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">Belong To</th>
				  <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">Sub Node</th>
				  <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">Add To Sidebar</th>
				            <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="view: activate to sort column ascending">Index</th>


                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($views)}} of {{count($views)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $views->links() }}
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
