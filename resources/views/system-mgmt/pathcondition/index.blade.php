@extends('system-mgmt.pathcondition.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Path Condition</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('pathcondition.create') }}">Add new Path Condition</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('pathcondition.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Name</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                     @foreach ($pathcondition as $sta)
                          <option value="{{$sta->name}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="path_id">
                     <option value="" ></option>
                      @foreach ($path as $sta)
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

                  <label for="file_category_name" class="col-sm-3 control-label">Reverse All Preposition</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                      <option value="0" >0</option>
                      <option value="1" >1</option>
                    </select>

                </div>

              </div>
            </div>



          </div>
          <br />
          <div class="row">
            <div class="col-md-6">

            <div class="col-md-9">
       <label for="chkPassport" class="btn btn-default">
              <input type="checkbox" id="chkPassport" />
              More Search
          </label>
        </div>
      </div>

      </div>
      <br />
        <div  id="dvPassport"style="display:none;" >
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail1</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail1">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail2 </label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail2">
                     <option value="" ></option>
                      @foreach ($condition as $sta)
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

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail3</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail3">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail4</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail4">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>


          </div><br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail5</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail5">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail6</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail6">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>


          </div><br />

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail7</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail7">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail8</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail8">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>


          </div><br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail9</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail9">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Path Condition Detail10</label>
                  <div class="col-md-9">

                    <select style="width:100%" class="form-control name" name="path_condition_detail10">
                      <option value="" ></option>
                     @foreach ($casecondition as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
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
          <a  style="color:blue"href="/admin/pathcondition" for="file_category_name" class="btn btn-default "> ShowAll </a>

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th >Path Condition Name</th>
                <th >Path Name</th>
                <th>Reverse All Preposition</th>
                <th >Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{$da->name}}</td>
                  @if($da->path_id == NULL ||$da->path_id == 0 ||$da->path_id == '')
                  <td></td>
                  @else
                  <td>{{$da->Path->name}}</td>
                  @endif
                  <td>{{$da->reverse_all_preposition}}</td>
                  <td>{{$da->description}}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('pathcondition.destroy', ['id' =>$da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('pathcondition.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{$da->id }}">More Details</button>
                    </form>

                    <div class="modal fade" id="myModal{{ $da->id  }}" role="dialog">
                    <div class="modal-dialog">

                    <!-- Modal content-->

                    <div class="modal-content">


                      <div class="modal-header" style="background-color:#;">

                      <h4>Details</h4>
                      </div>
                      <div class="modal-body">


                        <div class="tab-content">
                          <div id="home{{ $da->id }}" class="tab-pane fade in active">
                            <h3>Reverse Each Preposition</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Name
                            </th>
                            <th style="background-color:;color:;">
                            Flag
                            </th>
                            <tr>
                            <th width=""><p>Path Condition Detail Name 1</p></th>
                            @if($da->path_condition_detail1 == NULL ||$da->path_condition_detail1 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name1->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition1}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Path Condition Detail Name 2</p></th>
                            @if($da->path_condition_detail2 == NULL ||$da->path_condition_detail2 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name2->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition2}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Path Condition Detail Name 3</p></th>
                            @if($da->path_condition_detail3 == NULL ||$da->path_condition_detail3 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name3->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition3}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Path Condition Detail Name 4</p></th>
                            @if($da->path_condition_detail4 == NULL ||$da->path_condition_detail4 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name4->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition4}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Path Condition Detail Name 5</p></th>
                            @if($da->path_condition_detail5 == NULL ||$da->path_condition_detail5 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name5->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition5}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Path Condition Detail Name 6</p></th>
                            @if($da->path_condition_detail6 == NULL ||$da->path_condition_detail6 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name6->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition6}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Path Condition Detail Name 7</p></th>
                            @if($da->path_condition_detail7 == NULL ||$da->path_condition_detail7 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name7->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition7}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Path Condition Detail Name 8</p></th>
                            @if($da->path_condition_detail8 == NULL ||$da->path_condition_detail8 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name8->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition8}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Path Condition Detail Name 9</p></th>
                            @if($da->path_condition_detail9 == NULL ||$da->path_condition_detail9 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name9->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition9}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Path Condition Detail Name 10</p></th>
                            @if($da->path_condition_detail10 == NULL ||$da->path_condition_detail10 == 0 )
                              <td></td>
                            @else
                            <td >{{$da->path_condition_detail_name10->name}} </td>
                            @endif
                            <td >{{$da->reverse_each_preposition10}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Description</p></th>
                            <td colspan="2" style="text-align:center">{{$da->description}} </td>


                            </tr>
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Name
                            </th>
                            <th style="background-color:;color:;">
                            Flag
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
                <th >Path Condition Name</th>
                <th >Path Name</th>
                <th>Reverse All Preposition</th>
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
    <script>
    $(function () {
            $("#chkPassport").click(function () {
                if ($(this).is(":checked")) {
                    $("#dvPassport").show();
                    $("#AddPassport").hide();
                } else {
                    $("#dvPassport").hide();
                    $("#AddPassport").show();
                }
            });
        });
        </script>
@endsection
