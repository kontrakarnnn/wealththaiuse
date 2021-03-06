@extends('system-mgmt.toolset.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Tool Set</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('toolset.create',$urlpath) }}">Add new Tool Set</a>
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
              <tr >
                @foreach($tool as $to)
                <th colspan="6" style="font-size:18px;background-color:#00325d;color:white">Tool Set of {{$to->name}} Tool</th>
                @endforeach
              </tr>
              <tr role="row">
                <th >Tool Category</th>
                <th>Tool Type Name</th>
                <th>Tool Name</th>
                <th>Tool Set Name</th>
                <th>Created By</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{ $da->Tool->ToolType->ToolCategory->name }}</td>
                  <td>{{ $da->Tool->ToolType->name }}</td>
                  <td>{{ $da->Tool->name }}</td>
                  <td>{{ $da->name }}</td>
                  <td>{{ $da->Tool->User->firstname }} {{ $da->Tool->User->lastname }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('toolset.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $da->id }}">More Details</button>
                        <a href="{{ route('toolset.edit', ['id' => $da->id,$urlpath]) }}" class="btn btn-warning btn-margin">
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
                    <td >{{ $da->Tool->ToolType->ToolCategory->name }}</td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Tool Type</p></th>
                    <td >{{ $da->Tool->ToolType->name }}</td>

                    </tr>

                    <tr>
                    <th width="50%"><p>Tool Name</p></th>
                    <td >{{ $da->Tool->name }}</td>

                    </tr>
                    <tr>
                    <th width="50%"><p>Tool Set Name</p></th>
                    <td >{{ $da->name }}</td>

                    </tr>
                    <tr>
                    <th width="50%"><p>Limit Number Port</p></th>
                    <td >{{ $da->limit_number_port }}</td>

                    </tr>
                    <tr>
                    <th width="50%"><p>Default Tool Status</p></th>
                    <td >{{ $da->default_tool_status }}</td>

                    </tr>
                    <tr>
                    <th width="50%"><p>Term Of Payment</p></th>
                    <td >{{ $da->Term_Of_Payment->name }}</td>

                    </tr>
                    <tr>
                    <th width="50%"><p>Valid Period</p></th>
                    <td >{{ $da->valid_period }}</td>

                    </tr>
                    <tr>
                    <th width="50%"><p>Initial Fee</p></th>
                    <td >{{ $da->initial_free }}</td>

                    </tr>
                    <tr>
                    <th width="50%"><p>Period Fee</p></th>
                    <td >{{ $da->period_fee }}</td>

                    </tr>
                    <tr>
                    <th width="50%"><p>Exit Fee</p></th>
                    <td >{{ $da->exit_fee }}</td>

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
                <th>Tool Set Name</th>
                <th>Created By</th>
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
  </div>
@endsection
