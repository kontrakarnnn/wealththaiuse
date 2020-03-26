@extends('system-mgmt.branchuser.base')
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
          <h3 class="box-title">List of branch</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('branchuser.create') }}">Add new branch</a>
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
      <form method="POST" action="{{ route('branchuser.search') }}">
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
                <th  rowspan="1" colspan="1">Organization Name</th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Branch Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Branch Address</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Branch Number</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Tel</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">FAX</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Contact Person</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>




              </div>



            @foreach ($branchs as $branch)
                <tr role="row" class="odd">
                    <td>{{ $branch->org_name }}</td>
                  <td>{{ $branch->name }}</td>
                  <td>{{ $branch->add_no }} {{ $branch->add_alley }} {{ $branch->add_road }} {{ $branch->subdistrict_name }} {{ $branch->district_name }} {{ $branch->province_name }} {{ $branch->country_name }} {{ $branch->add_postcode}}</td>
                  <td>{{ $branch->number }}</td>
                  <td>{{ $branch->tel }}</td>
                  <td>{{ $branch->fax }}</td>
        	  <td> {{ $branch->con_name }} <br> {{ $branch->con_tel }} <br> <a href="mailto:{{$branch->con_email}}" target="_top">{{ $branch->con_email}}</a> </td>
                  <td>
                    <form class="row" method="POST" action="{{ route('branchuser.destroy', ['id' => $branch->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('branchuser.edit', ['id' => $branch->id]) }}" class="btn btn-warning  btn-margin">
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
                <th  rowspan="1" colspan="1">Organization Name</th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Branch Name</th>
                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Branch Address</th>
                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Branch Number</th>
                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Tel</th>
                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">FAX</th>
                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="branch: activate to sort column ascending">Contact Person</th>
                 <th>Action</th>
              </tr>
            </tfoot>
          </table>
		</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($branchs)}} of {{count($branchs)}} entries</div>

        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
              {{ $branchs->links() }}
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
