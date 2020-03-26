@extends('system-mgmt.portfolio.base')
@section('action-content')

    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Port</h3>

        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('portfolioadmin.create') }}">Add new port</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('portfolioadmin.search') }}">
         {{ csrf_field() }}


         @component('layouts.search', ['title' => 'Search'])
           @component('layouts.two-cols-search-row', ['items' => ['structure_name', 'block_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['structure_name'] : '', isset($searchingVals) ? $searchingVals['block_name'] :'']])
           @endcomponent
           <br>
           @component('layouts.two-cols-search-row', ['items' => ['port_number', 'portfolio_type'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['port_number'] : '', isset($searchingVals) ? $searchingVals['portfolio_type'] :'']])
           @endcomponent
           <br>
           @component('layouts.two-cols-search-row', ['items' => ['member_name', 'member_last_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['member_name'] : '', isset($searchingVals) ? $searchingVals['member_last_name'] :'']])
           @endcomponent







        @endcomponent


      </form>
      <div >
        <ul>
          <li><a href="{{url('admin/portfolioadmin')}}">Portfolio</a>
            <ul class="dropdown">
               {{--$current = Auth::user()->id;
              App\User::where('active', 1)->get();--}}

              @foreach(App\Structure::whereIn('id',$currentstruc)->get(); as $depList)

              <li><a href="{{url('/SecurityBroke/portstruc')}}/{{$depList->name}}">
                {{$depList->name}}</a></li>
              @endforeach
            </ul>
          </li>
          </ul>
          <ul style="display:none">
            <li><a class=" hidden-xs" href="{{url('admin/portfolio')}}">Portfolio</a>
              <ul class="dropdown">
                 {{--$current = Auth::user()->id;
                App\User::where('active', 1)->get();--}}

                @foreach(App\Block::whereIn('id',$notebook)->get(); as $blockList)

                <li><a href="{{url('admin/portfolioadmin')}}/{{$blockList->name}}">
                  {{$blockList->name}}</a></li>
                @endforeach
              </ul>
            </li>
            </ul>
            {!! $trees !!}

        </div>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
            <div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

            <thead>
              <tr role="row">

                <th width="2%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">No.</th>
                <th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Port Name</th>
                <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Port Number.</th>
                <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Port Type</th>
                <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Structure</th>
                <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Block</th>
                  <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Member</th>
                    <th width="10%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Description</th>


                <th tabindex="20%" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($portfolios)=="0")
                <tr>
                <h1 align="center" style="margin:20px">NO PORT FOUND UNDER <b style="color:red">{{$depByUser}}</b> STRUCTURE </h1>
                </tr>
              @else

            {{$portfolios}}
            @foreach ($portfolios as $portfolio)

                <tr role="row" class="odd">
                  <td >{{ ++$i}}</td>
                  <td >{{ $portfolio->type}}</td>
                  <td >{{ $portfolio->number}}</td>
                  <td >{{ $portfolio->port_name}}</td>

                  <td >{{ $portfolio->structure_name }}</td>
                  <td >{{ $portfolio->block_name }}</td>
                  <td >{{ $portfolio->member_name }} {{ $portfolio->member_last_name }}</td>
                  <td >{{ $portfolio->description }}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('portfolioadmin.destroy',
                       ['id' => $portfolio->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a class="btn btn-primary  btn-margin"href="{{ URL::to('admin/portfolioadmin/shows',$portfolio->id)}}">View Info</a>
                        <a href="{{ route('per.show', ['id' => $portfolio->member_id]) }}"
                          class="btn btn-info col-sm-3 col-xs-5 btn-margin">
                        Member
                        </a>
                        <a href="{{ route('portfolioadmin.edit', ['id' => $portfolio->id]) }}"
                          class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <br />
                        <a style="width:"href="{{ URL::to('admin/portfolio/asset',$portfolio->id)}}"
                          class="btn btn-default  btn-margin">
                        Portfolio Asset
                        </a>
                        <br />
                        <a style="width:"href="{{ URL::to('SecurityBroke/portfolio-transaction',[$portfolio->id])}}"
                          class="btn btn-default  btn-margin">
                        Portfolio Transaction
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr>

            @endforeach

          @endif
            </tbody>
            <tfoot>
              <tr>
                <th width="2%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending">No.</th>
                <th width="8%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Port Name</th>
                <th width="8%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending">Port Number</th>
                <th width="8%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port type</th>
                <th width="8%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Structure</th>
                <th width="8%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Block</th>
                <th width="8%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Member</th>
                <th width="8%" class="" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Description</th>
                <th tabindex="16" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                {{--<th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">No.</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port type</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Structure</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Block</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>--}}



              </tr>
            </tfoot>
          </table>


          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($portfolios)}} of {{count($portfolios)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $portfolios->links() }}
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
