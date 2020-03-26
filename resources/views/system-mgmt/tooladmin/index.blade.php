@extends('system-mgmt.tooladmin.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Tool</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('tooladmin.create') }}">Add new Tool</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('tooladmin.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Tool Type</label>
                  <div class="col-md-9">

                    <select  class="form-control" name="tool_type">
                      <option value="" ></option>
                      @foreach ($tooltype as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
          {{--}}  <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Tool Category</label>
                  <div class="col-md-9">

                    <select  class="form-control" name="cat_id">
                      <option value="" ></option>
                      @foreach ($toolcat as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>--}}


          </div>
          <br />
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th >Tool Category</th>
                <th>Tool Type Name</th>
                <th>Tool Name</th>
                <th>Created By</th>
                <th>Customer Limit</th>
                <th>Match Broker</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{ $da->ToolType->ToolCategory->name }}</td>
                  <td>{{ $da->ToolType->name }}</td>
                  <td>{{ $da->name }}</td>
                  <td>{{ $da->User->firstname }} {{ $da->User->lastname }}</td>
                  <td>{{ $da->limit_assign }}</td>
                  @if($da->match_broker == 1)
                  <td style="text-align:center"><i style ="color:green;" class="fa fa-check"></i></td>
                  @else
                  <td style="text-align:center"><i style ="color:red;" class="fa fa-close"></i></td>
                  @endif
                  <td>
                    <form class="row" method="POST" action="{{ route('tooladmin.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $da->id }}">More Details</button>

                        <a href="{{ route('tooladmin.edit', ['id' => $da->id]) }}" class="btn btn-warning btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger btn-margin">
                          Delete
                        </button>
                    </form>
                    <div class="modal fade" id="myModal{{ $da->id }}" role="dialog">
                    <div class="modal-dialog">

                    <!-- Modal content-->

                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-content">
                    <div class="modal-header" style="background-color:#00325d;color:white;">
                    <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                    <h4 class="modal-title">Detail {{$da->name}}</h4>
                    </div>
                    <div class="modal-body">
                      <div style="overflow-x:auto;">

                    <table class="table table-bordered table-hover" style="width:100%;color:black">
                    <th style="background-color:;color:;">
                    Topic
                    </th>
                    <th style="background-color:;color:;">
                    Details
                    </th>
                    <tr>
                    <th width="50%"><p>Tool Category</p></th>
                    <td >{{ $da->ToolType->ToolCategory->name }}</td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Tool Type</p></th>
                    <td >{{ $da->ToolType->name }}</td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Tool Name</p></th>
                    <td >{{ $da->name }}</td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Created By</p></th>
                    <td >{{ $da->User->firstname }} {{ $da->User->lastname }}</td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Tool Information Link</p></th>
                    <td ><a href="{{ $da->tool_info_link }}" target="_blank">{{ $da->tool_info_link }}</a></td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Last Version</p></th>
                    <td >{{ $da->last_version }}</td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Published Date</p></th>
                    <td >{{ $da->published_date }}</td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Updated Date</p></th>
                    <td >{{ $da->update_date }}</td>

                    </tr>


                    <tr>
                    <th width="50%"><p>Description</p></th>
                    <td >{{ $da->description }}</td>
                    </tr>


                    <th style="background-color:;color:;">
                    Topic
                    </th>
                    <th style="background-color:;color:;">
                    Details
                    </th>



                    </table>
                  </div>
                    </div>
                    <div class="modal-footer" style="background-color:#00325d;color:white;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                    </div>
                    </div>
                    </div>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th >Tool Category</th>
                <th>Tool Type Name</th>
                <th>Tool Name</th>
                <th>Created By</th>
                <th>Customer Limit</th>
                <th>Match Broker</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($data)}} of {{count($data)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $data->links() }}
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
