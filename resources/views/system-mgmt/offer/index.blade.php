@extends('system-mgmt.offer.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Offer</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('offer.create') }}">Add new Offer</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('offer.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Name</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                     @foreach ($offer as $sta)
                          <option value="{{$sta->name}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Offer Type </label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="type_id">
                     <option value="" ></option>
                      @foreach ($offertype as $sta)
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

                  <label for="file_category_name" class="col-sm-3 control-label">Proposal</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="proposal_id">
                      <option value="" ></option>
                     @foreach ($proposal as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Referal PID </label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="ref_pid">
                     <option value="" ></option>
                      @foreach ($publicid as $sta)
                          <option value="{{$sta->id}}">{{$sta->id}} {{$sta->public_name}}</option>
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

                  <label for="file_category_name" class="col-sm-3 control-label">Referal Member</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="ref_member_id">
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

                  <label for="file_category_name" class="col-sm-3 control-label">Referal Branch</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="ref_branch_id">
                     <option value="" ></option>
                      @foreach ($branch as $sta)
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

                  <label for="file_category_name" class="col-sm-3 control-label">Created Date</label>
                  <div class="col-md-9">

                    <input   class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy"name="created_date" id="created_date" placeholder="dd/mm/yyy">


                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Modified Date</label>
                  <div class="col-md-9">

                    <input   class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy"name="modified_date" id="modified_date" placeholder="dd/mm/yyy">


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
                <th >Created Date</th>
                <th >Modified Date</th>
                <th >Offer Name</th>
                <th >Proposal Name</th>
                <th >Offer type Name</th>
                <th >Attachment</th>
                <th >Referal PID</th>
                <th >Referal Member</th>
                <th >Referal Branch</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{$da->created_date}}</td>
                  <td>{{$da->modified_date}}</td>

                  <td>{{$da->name}}</td>
                  @if($da->proposal_id == NULL || $da->proposal_id == 0)
                  <td></td>
                  @else
                  <td>{{$da->Proposal->name}}</td>
                  @endif
                  @if($da->type_id == NULL || $da->type_id == 0)
                  <td></td>
                  @else
                  <td>{{$da->OfferType->name}}</td>
                  @endif
                  <td>{{$da->attachment}}</td>
                  @if($da->ref_pid == NULL || $da->ref_pid == 0)
                  <td></td>
                  @else
                  <td>{{$da->match_id->public_name}}</td>
                  @endif
                  @if($da->ref_member_id == NULL || $da->ref_member_id == 0)
                  <td></td>
                  @else
                  <td>{{$da->Person->name}} {{$da->Person->lname}}</td>
                  @endif
                  @if($da->ref_branch_id == NULL || $da->ref_branch_id == 0)
                  <td></td>
                  @else
                  <td>{{$da->Branch->name}}</td>
                  @endif

                  <td>
                    <form class="row" method="POST" action="{{ route('offer.destroy', ['id' =>$da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('offer.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
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
                                                                      <li class="active"><a data-toggle="tab" href="#home{{ $da->id}}">offer_value name 1-20 </a></li>
                                                                      <li><a data-toggle="tab" href="#menu1{{ $da->id }}">offer_value name 21-40</a></li>

                                                                    </ul></p>
                                          </div>
                                          <div class="modal-body">


                                            <div class="tab-content">
                                              <div id="home{{ $da->id }}" class="tab-pane fade in active">
                                                <h3>offer_value Name 1-20</h3>
                                                <table class="table table-bordered table-hover" style="width:100%;color:black">
                                                <th style="background-color:;color:;">
                                                Topic
                                                </th>
                                                <th style="background-color:;color:;">
                                                Details
                                                </th>
                                                <?php
                                                  $findfileid = \App\Offer_Attacht::where('offer_id',$da->id)->pluck('file_id');
                                                  $fileasset =\App\File::whereIn('id',$findfileid)->where('status','=','Active')->get();
                                                 ?>
                                                @foreach($fileasset as $key => $a)
                                                <tr>
                                                <td> File{{++$key}}</td>
                                                <?php
                                                  $filecatuser = \App\FileCat::where('id',$a->file_cat_id)->value('user_view');
                                                 ?>
                                                <td >  @if($filecatuser == 1)<a style="font-size:16px" href="/SecurityBroke/showfile/{{$a->id}}?{{$da->id}}" >{{$a->file_public_name}}</a>
                                                  @else
                                                  @endif
                                                  <br />
                                                  <form  role="form" method="POST" action="/SecurityBroke/file/fakedelete/{{$a->id}}/{{$da->id}}/xxx?casesdelete" onsubmit = "return confirm('Are you sure?')">
                                                      <input type="hidden" name="_method" value="PATCH">
                                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                              <button class ="btn btn-danger" type="submit"  >
                                                                  Delete..
                                                              </button>

                                                  </form>
                                                </td >

                                                </tr>
                                                @endforeach
                                                <tr>
                                                <th width="50%"><p>Add File </p></th>
                                                <th ><a class ="btn btn-info" href="/SecurityBroke/offer/uploadfile/{{$da->id}}/xxx/CG5CG/{{$filerefname}}{{$da->id}}">Add File</a></th>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name1 </p></th>
                                                <td >{{$da->offer_value1}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name2 </p></th>
                                                <td >{{$da->offer_value2}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name3 </p></th>
                                                <td >{{$da->offer_value3}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name4 </p></th>
                                                <td >{{$da->offer_value4}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name5 </p></th>
                                                <td >{{$da->offer_value5}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name6 </p></th>
                                                <td >{{$da->offer_value6}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name7 </p></th>
                                                <td >{{$da->offer_value7}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name8 </p></th>
                                                <td >{{$da->offer_value8}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name9 </p></th>
                                                <td >{{$da->offer_value9}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name10 </p></th>
                                                <td >{{$da->offer_value10}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name11 </p></th>
                                                <td >{{$da->offer_value11}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name12 </p></th>
                                                <td >{{$da->offer_value12}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name13 </p></th>
                                                <td >{{$da->offer_value13}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name14 </p></th>
                                                <td >{{$da->offer_value14}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name15 </p></th>
                                                <td >{{$da->offer_value15}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name16 </p></th>
                                                <td >{{$da->offer_value16}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name17 </p></th>
                                                <td >{{$da->offer_value17}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name18 </p></th>
                                                <td >{{$da->offer_value18}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name19 </p></th>
                                                <td >{{$da->offer_value19}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name20 </p></th>
                                                <td >{{$da->offer_value20}}</td>

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
                                                <h3>offer_value Name 21-40</h3>
                                                <table class="table table-bordered table-hover" style="width:100%;color:black">
                                                <th style="background-color:;color:;">
                                                Topic
                                                </th>
                                                <th style="background-color:;color:;">
                                                Details
                                                </th>
                                                <tr>
                                                <th width="50%"><p>offer_value Name21 </p></th>
                                                <td >{{$da->offer_value21}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name22 </p></th>
                                                <td >{{$da->offer_value22}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name23 </p></th>
                                                <td >{{$da->offer_value23}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name24 </p></th>
                                                <td >{{$da->offer_value24}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name25 </p></th>
                                                <td >{{$da->offer_value25}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name26 </p></th>
                                                <td >{{$da->offer_value26}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name27 </p></th>
                                                <td >{{$da->offer_value27}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name28 </p></th>
                                                <td >{{$da->offer_value28}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name29 </p></th>
                                                <td >{{$da->offer_value29}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name30 </p></th>
                                                <td >{{$da->offer_value30}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name31 </p></th>
                                                <td >{{$da->offer_value31}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name32 </p></th>
                                                <td >{{$da->offer_value32}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name33 </p></th>
                                                <td >{{$da->offer_value33}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name34 </p></th>
                                                <td >{{$da->offer_value34}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name35 </p></th>
                                                <td >{{$da->offer_value35}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name36 </p></th>
                                                <td >{{$da->offer_value36}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name37 </p></th>
                                                <td >{{$da->offer_value37}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name38 </p></th>
                                                <td >{{$da->offer_value38}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name39 </p></th>
                                                <td >{{$da->offer_value39}}</td>

                                                </tr>
                                                <tr>
                                                <th width="50%"><p>offer_value Name40 </p></th>
                                                <td >{{$da->offer_value40}}</td>

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
                <th >Created Date</th>
                <th >Modified Date</th>
                <th >Offer Name</th>
                <th >Proposal Name</th>
                <th >Offer type Name</th>
                <th >Attachment</th>
                <th >Referal PID</th>
                <th >Referal Member</th>
                <th >Referal Branch</th>

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
