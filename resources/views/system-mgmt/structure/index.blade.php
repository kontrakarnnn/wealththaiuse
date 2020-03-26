@extends('system-mgmt.structure.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of structure</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('structure.create') }}">Add new Structure</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('structure.search') }}">
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
          @if(!empty($divisions))
        <section>
            <h3>Portfolio</h3>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Block</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($divisions as $division)

                <tr>
                  <td>{{$division->portfolio_type}}</td>
                </tr>
              @empty
                <tr><td>No data</td></tr>

              @endforelse
              </tbody>
            </table>
        </section>
      @endif
			<div style="overflow-x:auto;">
        @if(count($errors) > 0)
         <div class="alert alert-danger">
          Upload Validation Error<br><br>
          <ul>
           @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
           @endforeach
          </ul>
         </div>
        @endif
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
         <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ url('/admin/import_excel/importstructure') }}">
         {{ csrf_field() }}
         <div class="form-group" style="overflow-x:auto;">
          <table class="table">
           <tr>
            <td width="40%" align="right"><label>Select File for Upload</label></td>
            <td >
             <input type="file" name="select_file" />
            </td>
            <td width="30" align="left">
             <input type="submit" name="upload" class="btn btn-primary" value="Upload">
            </td>
           </tr>
           <tr>
            <td width="30%" align="right"></td>
            <td width="30"><span class="text-muted">.xls, .xslx</span></td>
            <td width="30%" align="left"></td>
           </tr>
          </table>
         </div>
        </form>
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Structure Name</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($structures as $structure)
                <tr role="row" class="odd">
                  <td>{{ $structure->name }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('structure.destroy', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('structure.edit', ['id' => $structure->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th width="20%" rowspan="1" colspan="1">Structure Name</th>
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
  </div>
@endsection
