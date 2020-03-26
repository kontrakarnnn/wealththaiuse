@extends('system-mgmt.match-id.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of PublicID</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('match-id.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('match-id.search') }}">
         {{ csrf_field() }}
           @component('layouts.search', ['title' => 'Search'])
           @component('layouts.two-cols-search-row', ['items' => ['user_name', 'member_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['user_name'] : '', isset($searchingVals) ? $searchingVals['member_name'] :'']])
           @endcomponent
             <br>
		  @component('layouts.two-cols-search-row', ['items' => ['public_name', 'public_email'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['public_name'] : '', isset($searchingVals) ? $searchingVals['public_email'] :'']])
           @endcomponent
             <br>
		  	  @component('layouts.two-cols-search-row', ['items' => ['public_mobile', 'sender_citizen'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['public_mobile'] : '', isset($searchingVals) ? $searchingVals['sender_citizen'] :'']])
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
                  <th width="5%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">P_id</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">public_name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">public_email</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">public_mobile</th>
				      <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">sender_citizen</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">user_name</th>

                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">member_name</th>
                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              {{$matchids}}
            @foreach ($matchids as $matchid)
                <tr role="row" class="odd">
                  <td>{{ $matchid->id }}</td>
                  <td>{{ $matchid->public_name }}</td>

                  <td>{{ $matchid->public_email}}</td>
                  <td>{{ $matchid->public_mobile}}</td>
                  <td>{{ $matchid->sender_citizen}}</td>

                  <td>{{ $matchid->user_name }}</td>
					<td>{{ $matchid->member_name }}</td>
                 

                  <td>
                    <form class="row" method="POST" action="{{ route('match-id.destroy', ['id' => $matchid->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('match-id.edit', ['id' => $matchid->id]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="5%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">P_id</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">public_name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">public_email</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">public_mobile</th>
				   <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">sender_citizen</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">user_name</th>

                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">member_name</th>
                <th >Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($matchids)}} of {{count($matchids)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $matchids->links() }}
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
