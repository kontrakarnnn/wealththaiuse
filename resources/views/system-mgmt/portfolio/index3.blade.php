@extends('system-mgmt.portfolio.base')
@section('action-content')
@include('system-mgmt.portfolio.ourJs')
<div>

    {!! $tree !!}
</div>
<div class="nav-link">
  <ul>
    <li><a href="{{url('/portfolio')}}">Portfolio</a>
      <ul class="dropdown">
        @foreach(App\Division::all() as $depList)
        <li><a href="{{url('portfolio')}}/{{$depList->name}}">
          {{$depList->name}}</a></li>
        @endforeach
      </ul>
    </li>
    </ul>
  </div>
    <!-- Main content -->
    <ul>

      <li><a href="#">Home   </a><span class="dot">/</span>
        @if(count($data)=="0")
         <b>{{$divByUser}}</b>
       @else
         <a href="{{url('/portfolio')}}/{{$divByUser}}">{{$divByUser}}</a>
      @endif
      </li>
    </ul>
    <section class="content">

  <span>Structure</span>
      <ul>
        <li> Some option</li>
        @foreach(App\Division::all() as $dList)
        <li  id="div{{$dList->id}}" value="{{$dList->id}}">{{$dList->name}}</li>
      @endforeach
    </ul>

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Port</h3>

        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('portfolio.create') }}">Add new port</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('portfolio.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Type'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['Type'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Port Name</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="city: activate to sort column ascending">Port Type</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Department</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Division</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">User</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Member</th>
                <th tabindex="16" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>

            @if(count($data)=="0")
              <tr>
              <h1 align="center" style="margin:20px">NO PORT FOUND UNDER <b style="color:red">{{$depByUser}}</b> STRUCTURE </h1>
              </tr>
            @else
              <div id="portfolioData">
            @foreach ($data as $portfolio)

                <tr role="row" class="odd">
                  <td>{{ $portfolio->type }}</td>
                  <td>{{ $portfolio->portfolio_type}}</td>
                  <td>{{ $portfolio->status}}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('portfolio.destroy', ['id' => $portfolio->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('portfolio.edit', ['id' => $portfolio->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </div>
          @endif
            </tbody>
            <tfoot>
              <tr>
                <th width="10%" rowspan="1" colspan="1">Port Name</th>
                <th width="10%" rowspan="1" colspan="1">Port type</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Department Name</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Division Name</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">User Name</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="state: activate to sort column ascending">Member</th>
                <th rowspan="16" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($data)}} of {{count($data)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

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
