@extends('system-mgmt.mytool.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Member Tool</h3>
        </div>


    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('member-tool-admin.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Member </label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="member_id">
                      <option value="" ></option>
                      @foreach ($member as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}} {{$sta->lname}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Tool</label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="tool_id">
                      <option value="" ></option>
                      @foreach ($tool as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>


          </div>
          <br />

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Member Tool Status</label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="member_tool_status">
                      <option value="" ></option>
                      @foreach ($membertoolstatus as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
          </div>
          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">valid_from</label>
                  <div class="col-md-9">
                    <div class="input-group date">

                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input   class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy"name="valid_from" id="file_category_name" placeholder="dd/mm/yyy">

                  </div>
                </div>

              </div>
            </div>

              <div class="col-md-6">
                <div class="form-group">

                    <label for="file_category_name" class="col-sm-3 control-label">valid_to</label>
                    <div class="col-sm-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                      <input   class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy"name="valid_to" id="file_category_name" placeholder="dd/mm/yyy">

                    </div>
                  </div>

                </div>
              </div>
          </div>
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th>Tool Name</th>
                <th>Member Tool Status</th>
                <th>Limit Number Port</th>
                <th>Register Key</th>
                <th>Valid From</th>
                <th>Valid To</th>
                <th>End Contract</th>
                <th>Used</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{ $da->Tool->name }}</td>

                  <td>{{ $da->Member_Tool_Status->name }}</td>
                  <td>{{ $da->limit_number_of_port}}</td>
                  <td>{{ $da->register_key}}</td>
                  <td>{{ $da->valid_from}}</td>
                  <td>{{ $da->valid_to}}</td>
                  <td>{{ $da->end_contract}}</td>
                  @php
                  $membertool = DB::table('member_tool')->where('tool_id',$da->Tool->id)->where('member_id',$current)->pluck('id')->toArray();
                  $countmembertool = DB::table('member_assign_tool_to_port')->whereIn('member_tool_id',$membertool)->count();
                  @endphp
                  <td>{{$countmembertool}} / {{ $da->limit_number_of_port }}</td>
                  <td>{{ $da->description}}</td>
                  <td>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('mytool.show', ['id' => $da->id]) }}" class="btn btn-info btn-margin">
                        Assign Tool
                        </a>

                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Tool Name</th>
                <th>Member Tool Status</th>
                <th>Limit Number Port</th>
                <th>Register Key</th>
                <th>Valid From</th>
                <th>Valid To</th>
                <th>End Contract</th>
                <th>Used</th>
                <th>Description</th>
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

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

  <script type="text/javascript">

        $(".nameid").select2({
              placeholder: "Select",
              allowClear: true
          });
  </script>
@endsection
