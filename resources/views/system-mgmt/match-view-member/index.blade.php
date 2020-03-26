@extends('system-mgmt.match-view-member.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of View Authentication Member</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('match-view-member.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('match-view-member.search') }}">
         {{ csrf_field() }}
           @component('layouts.search', ['title' => 'Search'])
		   @component('layouts.two-cols-search-row', ['items' => ['view_name','member_group_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['view_name'] : '', isset($searchingVals) ? $searchingVals['member_group_name'] :'']])
           @endcomponent


           <br>
           @component('layouts.two-cols-search-row', ['items' => ['pid_group_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['pid_group_name'] :'']])
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
                              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">All Member</th>
              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group Member</th>

              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group PID</th>
              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Guild Member</th>

              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member</th>
              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Organization</th>

                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              {{$matchviews}}
            @foreach ($matchviews as $matchview)
                <tr role="row" class="odd">
                  <td>{{ $matchview->view_name }}</td>
                  <td>{{ $matchview->all_member}}</td>
                  <td>{{ $matchview->group_name}}</td>
                  <td>{{ $matchview->pid_group_name}}</td>
                  <td>{{ $matchview->member_group_name}}</td>
                 <td>{{ $matchview->member_name}}</td>
                  <td>{{ $matchview->org_name}}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('match-view-member.destroy', ['id' => $matchview->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('match-view-member.edit', ['id' => $matchview->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th width="5%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">view</th>
                              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">All Member</th>
              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group Member</th>

              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group PID</th>
              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Guild Member</th>

              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member ID</th>
              <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Organization</th>


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
