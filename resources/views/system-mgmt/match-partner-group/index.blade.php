@extends('system-mgmt.match-partner-group.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Match</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('match-partner-group.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('match-partner-group.search') }}">
         {{ csrf_field() }}
           @component('layouts.search', ['title' => 'Search'])
           @component('layouts.two-cols-search-row', ['items' => ['group_name', 'partner_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['group_name'] : '', isset($searchingVals) ? $searchingVals['partner_name'] :'']])
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


                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner Group</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner Name</th>
                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              {{$matchgroups}}
            @foreach ($matchgroups as $matchid)
                <tr role="row" class="odd">


                  <td>{{ $matchid->Partner_group->name }}</td>
                  @if($matchid->partner_id == NULL || $matchid->partner_id == 0 ||$matchid->partner_id == '')
                    <td></td>
                  @else
                    <td>{{ $matchid->Partner->name }}</td>
                  @endif
                  <td>
                    <form class="row" method="POST" action="{{ route('match-partner-group.destroy', ['id' => $matchid->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('match-partner-group.edit', ['id' => $matchid->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner Group</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner Name</th>

                <th >Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($matchgroups)}} of {{count($matchgroups)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $matchgroups->links() }}
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
