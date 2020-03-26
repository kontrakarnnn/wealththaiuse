@extends('system-mgmt.case-type-config.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Case Type Config</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('case-type-config.create') }}">Add new Case Type Config</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('case-type-config.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Sub Type Config Name</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="sub_type_config_name">

                      <option value="" ></option>
                      @foreach($typeconfig as $ty)
                      <option value="{{$ty->sub_type_config_name}}" >{{$ty->sub_type_config_name}}</option>

                      @endforeach
                    </select>

                </div>

              </div>
            </div>


          <br />
<br />
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <a  style="color:blue"href="/admin/case-type-config" for="file_category_name" class="btn btn-default "> ShowAll </a>

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th >Sub Type Config Name</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{ $da->sub_type_config_name }}</td>
                  <td>{{ $da->description }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('case-type-config.destroy', ['id' =>$da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('case-type-config.edit', ['id' => $da->id ])}}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{$da->id }}">More Details</button>
                    </form>

                    <div class="modal fade" id="myModal{{ $da->id }}" role="dialog">
                    <div class="modal-dialog">

                    <!-- Modal content-->

                    <div class="modal-content">


                      <div class="modal-header" style="background-color:#;color:white;">

                        <p style="color:white" class="modal-title">
                           <ul class="nav nav-tabs">
                                                  <li class="active"><a data-toggle="tab" href="#home">Config Label </a></li>
                                                  <li><a data-toggle="tab" href="#menu1">Config Value</a></li>

                                                </ul></p>
                      </div>
                      <div class="modal-body">


                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <h3>General Information</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>

                            <tr>
                            <th width="50%"><p>Config Label1</p></th>
                            <td >{{$da->config_label1}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label2</p></th>
                            <td >{{$da->config_label2}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label3</p></th>
                            <td >{{$da->config_label3}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label4</p></th>
                            <td >{{$da->config_label4}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label5</p></th>
                            <td >{{$da->config_label5}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label6</p></th>
                            <td >{{$da->config_label6}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label7</p></th>
                            <td >{{$da->config_label7}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label8</p></th>
                            <td >{{$da->config_label8}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label9</p></th>
                            <td >{{$da->config_label9}} </td>
                            </tr>
                            <tr>
                            <th width="50%"><p>Config Label10</p></th>
                            <td >{{$da->config_label10}} </td>
                            </tr>


                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            </table>
                          </div>
                          <div id="menu1" class="tab-pane fade">
                            <h3>Requirement Variable Name</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width="50%"><p>Config Value1</p></th>
                            <td >{{$da->config_value1}}</td>

                            </tr>

                            <tr>
                            <th width="50%"><p>Config Value2</p></th>
                            <td >{{$da->config_value2}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Config Value3</p></th>
                            <td >{{$da->config_value3}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Config Value4</p></th>
                            <td >{{$da->config_value4}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Config Value5</p></th>
                            <td >{{$da->config_value5}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Config Value6</p></th>
                            <td >{{$da->config_value6}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Config Value7</p></th>
                            <td >{{$da->config_value7}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Config Value8</p></th>
                            <td >{{$da->config_value8}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Config Value9</p></th>
                            <td >{{$da->config_value9}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Config Value10</p></th>
                            <td >{{$da->config_value10}}</td>

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


                      </div>
                      <div class="modal-footer" style="background-color:#00325d;color:white;">
                        <button type="submit" class="btn btn-default" >Save</button>
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
                <th >Sub Type Config Name</th>
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

          $(".name").select2({
                placeholder: "Select",
                //allowClear: true
            });
    </script>
@endsection
