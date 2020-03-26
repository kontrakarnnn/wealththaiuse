@extends('system-mgmt.asset-admin.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
		<div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div>
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Asset</h3>
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




      <form method="POST" action="{{ route('asset-searchonlynon.searchonlynon') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
           <div class="row">

             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">Asset Type</label>
                   <div class="col-sm-9">

                     <select  class="form-control name" name="asset_type">
                       <option value="" >โปรดเลือก</option>
                       @foreach ($assettype as $sta)
                           <option value="{{$sta->id}}">{{$sta->la_nla_type}}</option>
                       @endforeach
                     </select>

                 </div>

               </div>
             </div>
             @component('layouts.two-cols-search-row', ['items' => ['block_name'],
             'oldVals' => [isset($searchingVals) ? $searchingVals['block_name'] : '']])
             @endcomponent
           </div>

             <br />
             @component('layouts.two-cols-search-row', ['items' => ['member_name' ,'user_name'],
             'oldVals' => [isset($searchingVals) ? $searchingVals['member_name'] : '', isset($searchingVals) ? $searchingVals['user_name'] :'']])
             @endcomponent
             <br/>
             <div class="row">

               <div class="col-md-6">
                 <div class="form-group">

                     <label for="file_category_name" class="col-sm-3 control-label">Valid From</label>
                     <div class="col-sm-9">
                       <select name="valid_from_day">
                       <option value ="">  วัน  </option>
                       <option value ="01" >  01  </option>
                       <option value ="02" >  02  </option>
                       <option value ="03" >  03  </option>
                       <option value ="04" >  04  </option>
                       <option value ="05" >  05  </option>
                       <option value ="06" >  06  </option>
                       <option value ="07" >  07  </option>
                       <option value ="08" >  08  </option>
                       <option value ="09" >  09  </option>          {
                         @foreach($day as $da)
                       <option value={{$da}} >{{$da}}</option>
                      @endforeach
                       </select>

                       <select name="valid_from_month" >
                       <option value ="">  เดือน  </option>
                       <option value ="01"  >  01  </option>
                       <option value ="02"  >  02  </option>
                       <option value ="03"  >  03  </option>
                       <option value ="04"  >  04  </option>
                       <option value ="05"  >  05  </option>
                       <option value ="06"  >  06  </option>
                       <option value ="07"  >  07  </option>
                       <option value ="08"  >  08  </option>
                       <option value ="09"  >  09  </option>
                       @foreach($moth as $data)
                         <option value={{$data}}  >{{$data}}</option>
                       @endforeach
                       </select>
                       <select name="valid_from_year">
                       <option value ="">  ปี พ.ศ  </option>
                       @foreach($year as $data)
                       <option value={{$data}}  >{{$data}}</option>
                     @endforeach
                       </select>
                   </div>

                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">

                     <label for="file_category_name" class="col-sm-3 control-label">Valid To</label>
                     <div class="col-md-9">
                       <select name="valid_to_day">
                       <option value ="">  วัน  </option>
                       <option value ="01" >  01  </option>
                       <option value ="02" >  02  </option>
                       <option value ="03" >  03  </option>
                       <option value ="04" >  04  </option>
                       <option value ="05" >  05  </option>
                       <option value ="06" >  06  </option>
                       <option value ="07" >  07  </option>
                       <option value ="08" >  08  </option>
                       <option value ="09" >  09  </option>          {
                         @foreach($day as $da)
                       <option value={{$da}} >{{$da}}</option>
                       @endforeach
                       </select>

                       <select name="valid_to_month" >
                       <option value ="">  เดือน  </option>
                       <option value ="01"  >  01  </option>
                       <option value ="02"  >  02  </option>
                       <option value ="03"  >  03  </option>
                       <option value ="04"  >  04  </option>
                       <option value ="05"  >  05  </option>
                       <option value ="06"  >  06  </option>
                       <option value ="07"  >  07  </option>
                       <option value ="08"  >  08  </option>
                       <option value ="09"  >  09  </option>
                       @foreach($moth as $data)
                         <option value={{$data}}  >{{$data}}</option>
                       @endforeach
                       </select>
                       <select name="valid_to_year">
                       <option value ="">  ปี พ.ศ  </option>
                       @foreach($year as $data)
                       <option value={{$data}}  >{{$data}}</option>
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
			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
				  <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Sub Type</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
				  <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Referal Name</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">MemberName</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">BlockName</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              {{$porttypes}}
            @foreach ($porttypes as $port)
                <tr role="row" class="odd">
                  <td>{{ $port->la_nla}}</td>
                  <td>{{ $port->asset_type_name }}</td>
					<td>{{ $port->asset_subtype_name }}</td>
                  <td>{{ $port->name }}</td>
					<td>{{ $port->ref_name }}</td>
                  <td>{{ $port->member_name }}</td>
                  <td>{{ $port->block_name }}</td>



                  <td>
                    <form class="row" method="POST" action="{{ route('asset-admin.destroy', ['id' => $port->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <?php $currentyear = date('Y');
                        ?>
                        <a href="{{URL::to('Nonlife/showonlynon', ['id' => $port->id,$port->port_id]) }}" class="btn btn-info  btn-margin">
                        Details
                        </a>
                        <a href="{{ URL::to('Nonlife/editonlynon', ['id' => $port->id]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>

                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
				  <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Sub Type</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
				  <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Referal Name</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">MemberName</th>
                <th width=" " class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">BlockName</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($porttypes)}} of {{count($porttypes)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $porttypes->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>

@endsection
