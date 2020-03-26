@extends('system-mgmt.onlinetoollog.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">

  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('onlinetoollog.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label ">Tool</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="tool_id">
                      <option value="" ></option>
                      @foreach ($tool as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Portfolio</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="portfolio_id">
                      <option value="" ></option>
                      @foreach ($portfolios as $sta)
                          <option value="{{$sta->id}}">{{$sta->number}} {{$sta->type}} {{$sta->port_type_name}}</option>
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

                  <label for="file_category_name" class="col-sm-3 control-label">Status</label>
                  <div class="col-md-9">

                    <select  class="form-control" name="flag_status">
                      <option value="" ></option>
                          <option value="1">Online</option>
                          <option value="2">Offline</option>
                          <option value="3">Banned</option>
							<option value="4">Request</option>
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="acname" class="col-sm-3 control-label">Account Name</label>
                  <div class="col-md-9">

                    <input id="acname" type="text" class="form-control" name="acname" value="{{ old('acname') }}" >


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
				      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Total {{$count}} Rows</div>
        </div>
						  <div class="col-sm-6">
          <td style="color:green;"><i style ="color:green;" class="fa fa-circle"></i><span style="color:green;">Total Online {{$onlinecount}}</span></td>
		  <td style="color:silver;"><i style ="color:silver;" class="fa fa-circle"></i><span style="color:silver;">Total Offline {{$offlinecount}}</span></td>
		  <td style="color:red;"><i style ="color:red;" class="fa fa-circle"></i><span style="color:red;">Total Baned {{$banedcount}}</span> </td>
		 <td style="color:orange;"><i style ="color:orange;" class="fa fa-circle"></i><span style="color:orange;">Total Request {{$requestcount}}</span></td>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $data->links() }}
          </div>
        </div>
      </div>
        <table id="example2" class="table  table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
				 <th>No</th>
				<th>Status</th>
				<th>Tool Name</th>
				  <th>Last Login</th>
				  <th>Last Logout</th>
                <th >Portfolio Name</th>
				 <th >Account Number</th>
                <th>Port Number</th>
                <th>Member Name</th>
                <th>Block Name</th>
				<th>Account Name</th>
                <th>Account Broker</th>
				<th>Account Server</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $i => $da)

                <tr role="row" class="odd">
					<td>{{++$i}}</td>
                  @if($da->flag_status == 1)
                  <td style="color:green;"><i style ="color:green;" class="fa fa-circle"></i> Online</td>
                  @elseif($da->flag_status == 2)
                  <td style="color:silver;"><i style ="color:silver;" class="fa fa-circle"></i> Offline</td>
                  @elseif($da->flag_status == 3)
                  <td style="color:red"><i style ="color:red;" class="fa fa-ban"></i> Banned</td>
				  @elseif($da->flag_status == 4)
                  <td style="color:orange">  Request</td>

                  @else
                  <td></td>
                  @endif

				@if(in_array($da->tool_id,$tools))
                  <td>{{ $da->Tool->name }} V.{{$da->version }}</td>
				@else
					@php
						$toolname = \App\Tool::where('tool_ref_product_id',$da->tool_id)->value('name');
						$toolversion = \App\Tool::where('tool_ref_product_id',$da->tool_id)->value('last_version');
						$toolcount = \App\Tool::where('tool_ref_product_id',$da->tool_id)->count();
					@endphp
					@if($toolcount == 0)
					<td style="color:red">Not Founded</td>
					@elseif($da->flag_status == 4)
					<td style="color:orange">{{$toolname }} V.{{$toolversion }}</td>
					@elseif($da->flag_status == 2)
					<td style="color:silver">{{$toolname }} V.{{$toolversion }}</td>
					@else
					<td style="color:red">{{$toolname }} V.{{$toolversion }}</td>
					@endif
				@endif

				@if(in_array($da->portfolio_id,$portfolio))
						<td  >{{ $da->last_login }}</td>
					<td  >{{ $da->last_logout }}</td>
                  <td>{{ $da->Portfolio->type }}</td>
				  <td>{{ $da->Portfolio->referal_id1 }}</td>
                  <td>{{ $da->Portfolio->number }}</td>
                  <td>{{ $da->Portfolio->Person->name }}</td>
                  <td>{{ $da->Portfolio->Block->name }}</td>
					<td>{{ $da->acname }}</td>
					<td>{{ $da->acbroker }}</td>
					<td>{{ $da->acserver }}</td>
				  <td>{{ $da->description }}</td>
				@elseif($da->flag_status == 4)
					<td  style="color:orange">{{ $da->last_login }}</td>
					<td  style="color:orange">{{ $da->last_logout }}</td>
					<td style="color:orange">Not Founded</td>
					<td style="color:orange">{{ $da->portfolio_id }}</td>
					<td style="color:orange">Not Founded</td>
					<td style="color:orange">Not Founded</td>
					<td style="color:orange">Not Founded</td>
					<td style="color:orange">{{ $da->acname }}</td>
					<td style="color:orange">{{ $da->acbroker }}</td>
					<td style="color:orange">{{ $da->acserver }}</td>
					<td style="color:orange">{{ $da->description }}</td>


				@else
					<td  style="color:red">{{ $da->last_login }}</td>
					<td  style="color:red">{{ $da->last_logout }}</td>
					<td style="color:red">Not Founded</td>
					<td style="color:red">{{ $da->portfolio_id }}</td>
					<td style="color:red">Not Founded</td>
					<td style="color:red">Not Founded</td>
					<td style="color:red">Not Founded</td>
					<td style="color:red">{{ $da->acname }}</td>
					<td style="color:red">{{ $da->acbroker }}</td>
					<td style="color:red">{{ $da->acserver }}</td>
					<td style="color:red">{{ $da->description }}</td>
				@endif


              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
				  <th>No</th>
								<th>Status</th>
				<th>Tool Name</th>
				  <th>Last Login</th>
				  <th>Last Logout</th>
                <th >Portfolio Name</th>
				 <th >Account Number</th>
                <th>Port Number</th>
                <th>Member Name</th>
                <th>Block Name</th>
				<th>Account Name</th>
                <th>Account Broker</th>
				<th>Account Server</th>
                <th>Description</th>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">

          $(".name").select2({
                placeholder: "Select",
                allowClear: true
            });
    </script>
    <!-- /.content -->
@endsection
