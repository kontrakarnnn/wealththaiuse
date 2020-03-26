@extends('system-mgmt.case-middle-data.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Case Middle Data </h3>
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
      <form method="POST" action="{{ route('case-middle-data.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Middle Data Type</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                      @foreach ($casemiddledatatype as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Name</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="case_category">
                      <option value="" ></option>
                      @foreach ($casemiddledata as $sta)
                          <option value="{{$sta->name}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

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
                <th >Name</th>
                  <th>Case Category</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{ $da->name }}</td>
                  @if($da->middle_data_type == NULL || $da->middle_data_type == '' || $da->middle_data_type == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Casemiddledatatype->name }}</td>
                  @endif
                  <td>
                    <form class="row" method="POST" action="{{ route('case-middle-data.destroy', ['id' =>$da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{$da->id }}">More Details</button>
                    </form>

                    <div class="modal " id="myModal{{ $da->id }}" role="dialog">
                    <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header" >
                          Detail
                      </div>
                      <div class="modal-body">
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name1 }} </p></th>
                            <td >{{$da->para_value1}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name2 }} </p></th>
                            <td >{{$da->para_value2}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name3 }} </p></th>
                            <td >{{$da->para_value3}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name4 }} </p></th>
                            <td >{{$da->para_value4}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name5 }} </p></th>
                            <td >{{$da->para_value5}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name6 }} </p></th>
                            <td >{{$da->para_value6}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name7 }} </p></th>
                            <td >{{$da->para_value7}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name8 }} </p></th>
                            <td >{{$da->para_value8}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name9 }} </p></th>
                            <td >{{$da->para_value9}}</td>

                            </tr>
                            <tr>
                            <th width=""><p>{{ $da->Casemiddledatatype->para_name10 }} </p></th>
                            <td >{{$da->para_value10}}</td>

                            </tr>

                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>



                            </table>

                      <div class="modal-footer" >
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                      </div>
                    </div>
                    </form>
                    </div>
                    </div>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th >Name</th>
                <th >Case Category</th>
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
    </section>

    <!-- /.content -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">

          $(".name").select2({
                placeholder: "Select",
                //allowClear: true
            });
    </script>
@endsection
