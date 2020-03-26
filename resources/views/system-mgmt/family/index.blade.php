@extends('system-mgmt.family.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Group</h3>
        </div>
        <div class="col-sm-4">


        </div>

    </div>
    <br />
    <a class="btn btn-primary" href="{{ route('family.create') }}">Add new Group</a>

    <a class="btn btn-default" href="/familyrequest">Invite Request @if($alertinvite != 0)<i  style="color:red"class="fa fa-exclamation"></i>@else
    @endif</a>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('family.search') }}">
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


			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="50%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="family: activate to sort column ascending">Group Name</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($structures as $structure)
                <tr role="row" class="odd">
                  <td>{{ $structure->name }} @if ($structure->created_by == $current) (OWNER) @else @endif</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('family.destroy', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="/family/port/{{$structure->id}}" class="btn btn-primary  btn-margin">
                        Portfolio Shared In Group
                        </a>
                        @if ($structure->show_mem == 1)
                        <a href="{{ route('family.show', ['id' => $structure->id]) }}" class="btn btn-info  btn-margin">
                        All Member In Group
                        </a>@else @endif
                        <a href="/familyauth/list/{{$structure->id}}" class="btn btn-default  btn-margin">
                        Invite Lists
                        </a>

                        @if ($structure->created_by == $current)
                        <a href="{{ route('family.edit', ['id' => $structure->id]) }}" class="btn btn-default  btn-margin">
                        Setting
                        </a>@else @endif

                    </form>

                    <form class="row" method="POST" action="{{ route('leave.group', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <button type="submit" class="btn btn-danger  btn-margin">
                    <i class="glyphicon glyphicon-log-out"></i>Leave
                    </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="20%" rowspan="1" colspan="1">Group Name</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($structures)}} of {{count($structures)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $structures->links() }}
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
