@extends('system-mgmt.asset.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ URL::to('SecurityBroke/asset/create',$r)}}">Add new asset</a>
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
			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>

              @if(count($porttypes) == 0)
              <td style="text-align:center;color:red;" colspan="4">
              <h3>Can't Find Asset In This Portfolio</h3>
              </td>
              @else
              {{$porttypes}}
              @foreach ($porttypes as $port)

                <tr role="row" class="odd">
                  <td>{{ $port->la_nla}}</td>
                  <td>{{ $port->asset_type_name }}</td>
                  <td>{{ $port->name }}</td>



                  <td>
                    <form class="row" method="POST" action="{{ route('asset.destroy', ['id' => $port->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ URL::to('SecurityBroke/portfolio/asset/detail',[$port->id,$r])}}" class="btn btn-info btn-margin">
                        Details
                        </a>
                        <a href="{{ route('asset.edit', ['id' => $port->id]) }}" class="btn btn-warning btn-margin">
                        Update
                        </a>

                    </form>
                  </td>
              </tr>
            @endforeach
            @endif
            </tbody>
            <tfoot>
              <tr>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
                  <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
<th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                <th rowspan="1" colspan="2">Action</th>
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
