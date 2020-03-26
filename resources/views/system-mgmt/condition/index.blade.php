@extends('system-mgmt.condition.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Condition</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('condition.create') }}">Add new Condition</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('condition.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Condition Name</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                     @foreach ($condition as $sta)
                          <option value="{{$sta->name}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Condition Type</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="type_id">
                     <option value="" ></option>
                      @foreach ($conditiontype as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>


          </div>





        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <a  style="color:blue"href="/admin/condition" for="file_category_name" class="btn btn-default "> ShowAll </a>

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th >Condition Name</th>
                <th>Condition Type </th>

                <th >Description</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{$da->name}}</td>
                  <td>{{$da->Condition_type->name}}</td>


                  <td>{{$da->description}}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('condition.destroy', ['id' =>$da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('condition.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{$da->id }}">More Details</button>
                    </form>

                    <div class="modal fade" id="myModal{{ $da->id }}" role="dialog">
                    <div class="modal-dialog">

                    <!-- Modal content-->

                    <div class="modal-content">


                      <div class="modal-header" style="background-color:#;">


                           Details
                      </div>
                      <div class="modal-body">



                            <h3>General Information</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name1 </p></th>
                            <td >{{$da->con_para_name1}} </td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name2 </p></th>
                            <td >{{$da->con_para_name2}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name3  </p></th>
                            <td >{{$da->con_para_name3}} </td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name4  </p></th>
                            <td >{{$da->con_para_name4}} </td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name5  </p></th>
                            <td >{{$da->con_para_name5}} </td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name6  </p></th>
                            <td >{{$da->con_para_name6}} </td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name7  </p></th>
                            <td >{{$da->con_para_name7}} </td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name8  </p></th>
                            <td >{{$da->con_para_name8}} </td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name9  </p></th>
                            <td >{{$da->con_para_name9}} </td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Condition Parameter Name10  </p></th>
                            <td >{{$da->con_para_name10}} </td>

                            </tr>





                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>



                            </table>




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
                <th >Condition Name</th>
                <th>Condition Type </th>

                <th >Description</th>

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
