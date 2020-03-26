@extends('system-mgmt.tool-order.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Tool Order Status</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('tool-order.create') }}">Add new</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('tool-order.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Invoice Number</label>
                  <div class="col-md-9">

                    <input  class="form-control nameid" name="invoice_number">


                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label for="file_category_name" class="col-sm-3 control-label">Order Created Date</label>
                  <div class="col-md-9">
                    <input  class="form-control nameid"  data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" name="order_create_date">
                </div>
              </div>
            </div>
          </div>
          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Member</label>
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

                  <label for="file_category_name" class="col-sm-3 control-label">Tool Set</label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="tool_set_id">
                      <option value="" ></option>
                      @foreach ($toolset as $sta)
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

                             <label for="file_category_name" class="col-sm-3 control-label">Tool Package</label>
                             <div class="col-md-9">

                               <select  class="form-control nameid" name="tool_package_id">
                                 <option value="" ></option>
                                 @foreach ($toolpackage as $sta)
                                     <option value="{{$sta->id}}">{{$sta->name}}</option>
                                 @endforeach
                               </select>

                           </div>

                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group">

                             <label for="file_category_name" class="col-sm-3 control-label">Tool Order Status</label>
                             <div class="col-md-9">

                               <select  class="form-control nameid" name="order_status">
                                 <option value="" ></option>
                                 @foreach ($toolorderstatus as $sta)
                                     <option value="{{$sta->id}}">{{$sta->name}}</option>
                                 @endforeach
                               </select>

                           </div>

                         </div>
                       </div>


                     </div>
                     <br />

        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">

			<div style="overflow-x:auto;">
        <table class="table table-borderless table-hover" role="grid" aria-describedby="example2_info">
          <thead>
            <tr role="row">
              <th >Invoice Number</th>
              <th >Member</th>
              <th>Tool Set</th>
              <th>Tool Package</th>
              <th>Initial Fee</th>
              <th>Period Fee</th>
              <th>Order Create Date</th>
              <th>Initail Deal Date</th>
              <th>Next Deal Date</th>

              <th>Order Status</th>
              <th>Modified By</th>

              <th>Action</th>


            </tr>
          </thead>
          <tbody>
          @foreach ($data as $da)
              <tr role="row" class="odd">
                <td>{{ $da->invoice_number}}</td>
                <td>{{ $da->Person->name }} {{ $da->Person->lname }} <br />{{ $da->Person->email }} <br />{{ $da->Person->mobile }}</td>                @if($da->tool_set_id != NULL)
                <td>{{ $da->ToolSet->name }}</td>
                @else
                <td></td>
                @endif
                @if($da->tool_package_id != NULL)
                <td>{{ $da->ToolPackage->name }}</td>
                @else
                <td></td>
                @endif
                <td>{{ $da->initial_fee }}</td>
                <td>{{ $da->period_fee }}</td>
                <td>{{ $da->order_create_date }}</td>
                <td>{{ $da->initial_deal_date}}</td>
                <td>{{ $da->next_period_deal_date}}</td>
                @if($da->modified_by != NULL)
                <td>{{ $da->User->firstname }}</td>
                @else
                <td></td>
                @endif
                <td><select  class=" nameid" name="order_status" onchange="window.location.href=this.value;">
                  <option value="" ></option>
                  @foreach ($toolorderstatus as $sta)
                      <option value="/admin/tool-order-changestatus/{{$da->id}}/{{$sta->id}}" {{$sta->id == $da->order_status ? 'selected' : ''}}>{{$sta->name}}</option>
                  @endforeach
                </select>
</td>

                <td>
                  <form class="row" method="POST" action="{{ route('tool-order.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="/admin/tool-order/invoice/{{$da->id}}" target="_blank"class="btn btn-success btn-margin">
                        Invoice
                        </a>
                      <a href="{{ route('tool-order.edit', ['id' => $da->id]) }}" class="btn btn-warning btn-margin">
                      Update
                      </a>
                      <button type="submit" class="btn btn-danger btn-margin">
                        Delete
                      </button>
                  </form>
                  {{--}}<div class="modal fade" id="myModal{{ $da->id }}" role="dialog">
                  <div class="modal-dialog">

                  <!-- Modal content-->

                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="modal-content">
                  <div class="modal-header" style="background-color:#00325d;color:white;">
                  <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
                  <h4 class="modal-title">Order Detail</h4>
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
                  <th width="50%"><p>Invoice Number</p></th>
                  <td>{{ $da->invoice_number }}</td>
                  </tr>
                  <tr>
                  <th width="50%"><p>Member</p></th>
                  <td >{{ $da->Person->name }} {{ $da->Person->lname }}</td>

                  </tr>

                  <tr>
                  <th width="50%"><p>Tool Set</p></th>
                  @if($da->tool_set_id != NULL)
                  <td>{{ $da->ToolSet->name }}</td>
                  @else
                  <td></td>
                  @endif


                  </tr>

                  <tr>
                  <th width="50%"><p>Tool Package</p></th>
                  @if($da->tool_package_id != NULL)
                  <td>{{ $da->ToolPackage->name }}</td>
                  @else
                  <td></td>
                  @endif

                  </tr>

                  <tr>
                  <th width="50%"><p>Initail Fee</p></th>
                  <td >{{ $da->initial_fee }}</td>

                  </tr>

                  <tr>
                  <th width="50%"><p>Period Fee</p></th>
                  <td >{{ $da->period_fee}}</td>

                  </tr>
                  <tr>
                  <th width="50%"><p>Exit Fee</p></th>
                  <td >{{ $da->exit_fee}}</td>

                  </tr>

                  <tr>
                  <th width="50%"><p>Initail Deal Date</p></th>
                  <td >{{ $da->initial_deal_date}}</td>

                  </tr>
                  <tr>
                  <th width="50%"><p>Next Period Deal Date</p></th>
                  <td >{{ $da->next_period_deal_date}}</td>

                  </tr>

                  <tr>
                  <th width="50%"><p>Tool Order Status</p></th>
                  <td >{{ $da->Tool_Order_Status->name}}</td>

                  </tr>

                  <tr>
                  <th width="50%"><p>Description</p></th>
                  <td >{{ $da->description}}</td>

                  </tr>
                  <tr>
                  <th width="50%"><p>Order Created Date</p></th>
                  <td >{{ $da->order_create_date}}</td>

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
                </div>--}}
                </td>
            </tr>
          @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th >Invoice Number</th>
              <th >Member</th>
              <th>Tool Set</th>
              <th>Tool Package</th>
              <th>Initial Fee</th>
              <th>Period Fee</th>
              <th>Order Create Date</th>
              <th>Initail Deal Date</th>
              <th>Next Deal Date</th>

              <th>Order Status</th>
              <th>Modified By</th>

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

        $(".nameid").select2({
              placeholder: "Select",
              allowClear: true
          });
  </script>
@endsection
