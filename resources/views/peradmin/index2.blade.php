@extends('users-mgmt.baseperson')
@section('action-content')
  <form method="POST" action="{{ route('per.search') }}">
     {{ csrf_field() }}
     @component('layouts.search', ['title' => 'Search'])
      @component('layouts.two-cols-search-row', ['items' => ['Thai Name', 'Eng Name'],
      'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '', isset($searchingVals) ? $searchingVals['Eng_name'] : '']])
      @endcomponent
      </br>
      @component('layouts.two-cols-search-row', ['items' => ['Last Name', 'Eng lastname'],
      'oldVals' => [isset($searchingVals) ? $searchingVals['lname'] : '', isset($searchingVals) ? $searchingVals['Eng_lastname'] : '']])
      @endcomponent
    </br>
    @component('layouts.two-cols-search-row', ['items' => ['Phone', 'Department'],
    'oldVals' => [isset($searchingVals) ? $searchingVals['Phone'] : '', isset($searchingVals) ? $searchingVals['department_name'] : '']])
    @endcomponent
  </br>
    @component('layouts.two-cols-search-row', ['items' => ['Division'],
    'oldVals' => [isset($searchingVals) ? $searchingVals['division_name'] : '']])
    @endcomponent
    @endcomponent
  </form>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Member</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('per.create') }}">Add new Member</a>
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
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">User Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Structure</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Block</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($per as $user)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{ $user->name }}</td>
                  <td class="sorting_1">{{ $user->lname }}</td>
                  <td>{{ $user->email }}</td>

                  <td class="hidden-xs">{{ $user->department_name }}</td>
                  <td class="hidden-xs">{{ $user->division_name }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('per.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <a href="{{ route('per.show', ['id' => $user->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        View
                        </a>
                        <a href="{{ route('per.edit', ['id' => $user->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending">User Name</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Last Name</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Structure</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Block</th>
                <th rowspan="0" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($per)}} of {{count($per)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $per->links() }}
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
