@extends('system-mgmt.stageaction.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Action</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('stageaction.create') }}">Add new Stage Action</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('stageaction.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Stage Action Name</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="name">
                     <option value="" ></option>
                     @foreach ($stageaction as $sta)
                         <option value="{{$sta->name}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

                 </div>

             </div>
           </div>
           <div class="col-md-6">


         </div>
         <br />
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Action Name</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="action_id">
                     <option value="" ></option>
                     @foreach ($action as $sta)
                         <option value="{{$sta->id}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

                 </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Stage</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="current_stage_id">
                     <option value="" ></option>
                     @foreach ($stage as $sta)
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

                 <label for="file_category_name" class="col-sm-3 control-label">Action Time</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="action_time">
                     <option value="" ></option>

                    <option value="0">Entering</option>
                    <option value="1">Exiting</option>

                   </select>

                 </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Action Flag</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="action_flag">
                     <option value="" ></option>
                         <option value="0">0</option>
                         <option value="1">1</option>
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

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Stage Action Name</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Current Stage</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Action Name</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Action Time</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{ $da->name}}</td>
                  @if($da->current_stage_id == NULL || $da->current_stage_id ==0)
                  <td></td>
                  @else

                  <td>{{ $da->Stage->name }}</td>
                  @endif
                  @if($da->action_id == NULL || $da->action_id ==0)
                  <td></td>
                  @else
                  <td>{{ $da->Action->name }}</td>
                  @endif
                  @if($da->action_time == 0)
                  <td>Entering</td>
                  @elseif($da->action_time == 1)
                  <td>Exiting</td>
                  @endif
                  <td>
                    <form class="row" method="POST" action="{{ route('stageaction.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{$da->id }}">More Details</button>

                        <a href="{{ route('stageaction.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>
                    </form>
                    <div class="modal fade" id="myModal{{ $da->id }}" role="dialog">
                    <div class="modal-dialog">

                    <!-- Modal content-->

                    <div class="modal-content">


                      <div class="modal-header" style="background-color:#;">

                        <p style="" class="modal-title">
                          Detail
                        </p>
                      </div>
                      <div class="modal-body">


                        <div class="tab-content">
                          <div id="home{{ $da->id }}" class="tab-pane fade in active">
                            <h3>Action Value</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width="50%"><p>Action Value1 </p></th>
                            <td >{{$da->action_para_value1}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value2 </p></th>
                            <td >{{$da->action_para_value2}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value3 </p></th>
                            <td >{{$da->action_para_value3}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value4 </p></th>
                            <td >{{$da->action_para_value4}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value5 </p></th>
                            <td >{{$da->action_para_value5}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value6 </p></th>
                            <td >{{$da->action_para_value6}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value7 </p></th>
                            <td >{{$da->action_para_value7}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value8 </p></th>
                            <td >{{$da->action_para_value8}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value9 </p></th>
                            <td >{{$da->action_para_value9}}</td>

                            </tr>
                            <tr>
                            <th width="50%"><p>Action Value10 </p></th>
                            <td >{{$da->action_para_value10}}</td>

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
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Stage Action Name</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Current Stage</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Action Name</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Action Time</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
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
                allowClear: true
            });
    </script>
@endsection
