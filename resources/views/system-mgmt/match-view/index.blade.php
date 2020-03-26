@extends('system-mgmt.match-view.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of View Authentication</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('match-view.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('match-view.search') }}">
         {{ csrf_field() }}
           @component('layouts.search', ['title' => 'Search'])
		   @component('layouts.two-cols-search-row', ['items' => ['view_name', 'structure_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['view_name'] : '', isset($searchingVals) ? $searchingVals['structure_name'] :'']])
           @endcomponent
		  <br>
           @component('layouts.two-cols-search-row', ['items' => ['block_name', 'user_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['block_name'] : '', isset($searchingVals) ? $searchingVals['user_name'] :'']])
           @endcomponent
           <br>
           @component('layouts.two-cols-search-row', ['items' => ['user_group_name', 'pid_group_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['user_group_name'] : '', isset($searchingVals) ? $searchingVals['pid_group_name'] :'']])
           @endcomponent
           <br>


       @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                  <th width="5%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">view</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">structures</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">block</th>
				                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">block topdown</th>
              <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">block bottom-up</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">user</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group User</th>

                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group PID</th>

                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              {{$matchviews}}
            @foreach ($matchviews as $matchview)
                <tr role="row" class="odd">
                  <td>{{ $matchview->view_name }}</td>

                  <td>{{ $matchview->structure_name }}</td>

                  <td>{{ $matchview->block_name}}</td>
				  <td>{{ $matchview->blocktop_name}}</td>
                  <td>{{ $matchview->blockbottom_name}}</td>
                  @if ($matchview->all_user == "Yes")   <td>All User</td>
              @else  <td>{{ $matchview->user_name}}</td>
              @endif



                  <td>{{ $matchview->user_group_name}}</td>
                  <td>{{ $matchview->pid_group_name}}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('match-view.destroy', ['id' => $matchview->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('match-view.edit', ['id' => $matchview->id]) }}" class="btn btn-warning  btn-margin">
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
                <th width="5%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">view</th>
              <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">structures</th>
              <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">block</th>
				                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">block topdown</th>
              <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">block bottom-up</th>
              <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">user</th>
              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group User</th>

              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group PID</th>

              <th >Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($matchviews)}} of {{count($matchviews)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $matchviews->links() }}
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
