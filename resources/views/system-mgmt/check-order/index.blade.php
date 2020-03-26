@extends('system-mgmt.check-order.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Order </h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('check-order.create') }}">Add new</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('check-order.search') }}">
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



            </tr>
          </thead>
          <tbody>
          @foreach ($data as $da)
              <tr role="row" class="odd">
                <td>{{ $da->invoice_number}}</td>
                <td>{{ $da->Person->name }} {{ $da->Person->lname }} <br />{{ $da->Person->email }} <br />{{ $da->Person->mobile }}</td>
                @if($da->tool_set_id != NULL)
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
                <td><select  class=" nameid" name="order_status" onchange="window.location.href=this.value;">
                  <option value="" ></option>
                  @foreach ($toolorderstatus as $sta)
                      <option value="/check-order/{{$da->id}}/{{$sta->id}}" {{$sta->id == $da->order_status ? 'selected' : ''}}>{{$sta->name}}</option>
                  @endforeach
                </select>
</td>


            </tr>
          @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th >Invoice Number</th>
              <th >Member</th>
              <th>Order Status</th>
              <th>Initial Fee</th>
              <th>Period Fee</th>
              <th>Order Create Date</th>
              <th>Initail Deal Date</th>
              <th>Next Deal Date</th>
              <th>Tool Set</th>
              <th>Tool Package</th>
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
