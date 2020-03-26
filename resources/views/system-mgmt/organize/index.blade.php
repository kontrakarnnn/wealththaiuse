@extends('system-mgmt.organize.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of organize</h3>
        </div>
        <div class="col-sm-4">

        </div>
    </div>
    <br />
    <a class="btn btn-primary" href="{{ route('organize.create') }}">Add new organize</a>
    <a class="btn btn-default" href="/organizerequest">Invite Request @if($alertinvite != 0)<i  style="color:red"class="fa fa-exclamation"></i>@else
    @endif</a>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('organize.search') }}">
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
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">organize Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Action</th>
            </thead>
            <tbody>
            @foreach ($structures as $structure)
                <tr role="row" class="odd">
                  <td>{{ $structure->name }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('family.destroy', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <a href="/organize/port/{{$structure->id}}" class="btn btn-primary  btn-margin">
                        Portfolio
                        </a>
                        
                        <a href="/organize/member/{{$structure->id}}" class="btn btn-info  btn-margin">
                         Member
                        </a>
                        
                        <a href="{{ route('organize.show', ['id' => $structure->id]) }}" class="btn btn-default   btn-margin">
                        Details
                        </a>

						                        <a href="/logout?mail?{{$structure->email}}" class="btn btn-default   btn-margin">
                        Login As Organization
                        </a>


                    </form>

                    <form   style="display:inline-block" class="row" method="POST" action="{{ route('leave.org', ['id' => $structure->id]) }}" onsubmit = "return confirm('Leave this group?')">
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
                <th width="20%" rowspan="1" colspan="1">organize Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Action</th>

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
