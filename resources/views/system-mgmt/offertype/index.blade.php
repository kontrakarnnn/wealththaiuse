@extends('system-mgmt.offertype.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Offer Type</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('offertype.create') }}">Add new Offer type</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('offertype.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Case Name</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                     @foreach ($offertype as $sta)
                          <option value="{{$sta->name}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Offer Category </label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="offer_category">
                     <option value="" ></option>
                      @foreach ($offercategory as $sta)
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
          <a  style="color:blue"href="/admin/offertype" for="file_category_name" class="btn btn-default "> ShowAll </a>

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th >Offer type Name</th>
                <th >Offer Category Name</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{$da->name}}</td>
                  <td>{{$da->OfferCategory->name}}</td>
                  <td>{{$da->description}}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('offertype.destroy', ['id' =>$da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('offertype.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
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


                                          <div class="modal-header" style="background-color:#;color:white;">

                                            <p style="color:white" class="modal-title">
                                               <ul class="nav nav-tabs">
                                                                      <li class="active"><a data-toggle="tab" href="#home{{ $da->id}}">Offer value name 1-20 </a></li>
                                                                      <li><a data-toggle="tab" href="#menu1{{ $da->id }}">Offer value name 21-40</a></li>

                                                                    </ul></p>
                                          </div>
                                          <div class="modal-body">


                                            <div class="tab-content">
                                              <div id="home{{ $da->id }}" class="tab-pane fade in active">
                                                <h3>Offer Value Name 1-20</h3>
                                                <table class="table table-bordered table-hover" style="width:100%;color:black">
                                                <th style="background-color:;color:;">
                                                Topic
                                                </th>
                                                <th style="background-color:;color:;">
                                                Details
                                                </th>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name1 </p></th>
                                                <td >{{$da->offer_value_name1}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name2 </p></th>
                                                <td >{{$da->offer_value_name2}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name3 </p></th>
                                                <td >{{$da->offer_value_name3}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name4 </p></th>
                                                <td >{{$da->offer_value_name4}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name5 </p></th>
                                                <td >{{$da->offer_value_name5}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name6 </p></th>
                                                <td >{{$da->offer_value_name6}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name7 </p></th>
                                                <td >{{$da->offer_value_name7}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name8 </p></th>
                                                <td >{{$da->offer_value_name8}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name9 </p></th>
                                                <td >{{$da->offer_value_name9}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name10 </p></th>
                                                <td >{{$da->offer_value_name10}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name11 </p></th>
                                                <td >{{$da->offer_value_name11}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name12 </p></th>
                                                <td >{{$da->offer_value_name12}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name13 </p></th>
                                                <td >{{$da->offer_value_name13}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name14 </p></th>
                                                <td >{{$da->offer_value_name14}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name15 </p></th>
                                                <td >{{$da->offer_value_name15}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name16 </p></th>
                                                <td >{{$da->offer_value_name16}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name17 </p></th>
                                                <td >{{$da->offer_value_name17}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name18 </p></th>
                                                <td >{{$da->offer_value_name18}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name19 </p></th>
                                                <td >{{$da->offer_value_name19}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name20 </p></th>
                                                <td >{{$da->offer_value_name20}}</td>

                                                </tr>


                                                <th style="background-color:;color:;">
                                                Topic
                                                </th>
                                                <th style="background-color:;color:;">
                                                Details
                                                </th>



                                                </table>
                                              </div>
                                              <div id="menu1{{ $da->id }}" class="tab-pane fade">
                                                <h3>Offer Value Name 21-40</h3>
                                                <table class="table table-bordered table-hover" style="width:100%;color:black">
                                                <th style="background-color:;color:;">
                                                Topic
                                                </th>
                                                <th style="background-color:;color:;">
                                                Details
                                                </th>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name21 </p></th>
                                                <td >{{$da->offer_value_name21}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name22 </p></th>
                                                <td >{{$da->offer_value_name22}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name23 </p></th>
                                                <td >{{$da->offer_value_name23}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name24 </p></th>
                                                <td >{{$da->offer_value_name24}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name25 </p></th>
                                                <td >{{$da->offer_value_name25}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name26 </p></th>
                                                <td >{{$da->offer_value_name26}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name27 </p></th>
                                                <td >{{$da->offer_value_name27}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name28 </p></th>
                                                <td >{{$da->offer_value_name28}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name29 </p></th>
                                                <td >{{$da->offer_value_name29}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name30 </p></th>
                                                <td >{{$da->offer_value_name30}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name31 </p></th>
                                                <td >{{$da->offer_value_name31}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name32 </p></th>
                                                <td >{{$da->offer_value_name32}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name33 </p></th>
                                                <td >{{$da->offer_value_name33}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name34 </p></th>
                                                <td >{{$da->offer_value_name34}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name35 </p></th>
                                                <td >{{$da->offer_value_name35}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name36 </p></th>
                                                <td >{{$da->offer_value_name36}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name37 </p></th>
                                                <td >{{$da->offer_value_name37}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name38 </p></th>
                                                <td >{{$da->offer_value_name38}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name39 </p></th>
                                                <td >{{$da->offer_value_name39}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>Offer Value Name40 </p></th>
                                                <td >{{$da->offer_value_name40}}</td>

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
                <th >Offer type Name</th>
                <th >Offer Category Name</th>
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
