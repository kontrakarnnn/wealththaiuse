@extends('system-mgmt.asset-admin.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Asset</h3>
        </div>
        <div class="col-sm-4">

        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>




      <form method="POST" action="{{ route('asset-searchfromall.searchfromall') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['asset_type_name' ,'name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['asset_type_name'] : '', isset($searchingVals) ? $searchingVals['name'] :'']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['member_name' ,'user_name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['member_name'] : '', isset($searchingVals) ? $searchingVals['user_name'] :'']])
          @endcomponent
          <br />
          @component('layouts.two-cols-search-row', ['items' => ['block_name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['block_name'] : '']])
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
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
				  <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Sub Type</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
				 <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Referal Name</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">MemberName</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">BlockName</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              {{$porttypes}}
            @foreach ($porttypes as $port)
                <tr role="row" class="odd">
                  <td>{{ $port->la_nla}}</td>
                  <td>{{ $port->asset_type_name }}</td>
					<td>{{ $port->asset_subtype_name }}</td>
                  <td>{{ $port->name }}</td>
					<td>{{ $port->ref_name }}</td>
                  <td>{{ $port->member_name }}</td>
                  <td>{{ $port->block_name }}</td>



                  <td>
                    <form class="row" method="POST" action="{{ route('asset-admin.destroy', ['id' => $port->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <?php $currentyear = date('Y');
                        ?>
                        <a href="{{URL::to('Nonlife/showfromall', ['id' => $port->id,$port->port_id]) }}" class="btn btn-info  btn-margin">
                        Details
                        </a>
                        <a href="{{ URL::to('Nonlife/editfromall', ['id' => $port->id]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>

                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
				  <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Sub Type</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
				  <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Referal Name</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">MemberName</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">BlockName</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($porttypes)}} of {{count($porttypes)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $porttypes->links() }}
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
