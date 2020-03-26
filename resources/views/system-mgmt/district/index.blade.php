@extends('system-mgmt.district.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">


        <div class="col-sm-8">
          <h3 class="box-title">List of district</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('district.create') }}">Add new district</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">

        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('district.search') }}">
         {{ csrf_field() }}
        {{-- @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['structure_name','name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['structure_name'] : '',isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent--}}

		         @component('layouts.search', ['title' => 'Search'])
             @component('layouts.two-cols-search-row', ['items' => ['province_name_in_thai','province_name_in_english'],
             'oldVals' => [isset($searchingVals) ? $searchingVals['province_name_in_thai'] : '',isset($searchingVals) ? $searchingVals['province_name_in_english'] : '']])
             @endcomponent
             <br />
              @component('layouts.two-cols-search-row', ['items' => ['name_in_thai','name_in_english'],
              'oldVals' => [isset($searchingVals) ? $searchingVals['name_in_thai'] : '',isset($searchingVals) ? $searchingVals['name_in_english'] : '']])
              @endcomponent
              <br />
          @component('layouts.two-cols-search-row', ['items' => ['code'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['code'] : '']])
          @endcomponent

        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          @if(!empty($portfolios))
        <section>
            <h3>Portfolio</h3>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Port</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($portfolios as $portfolio)

                <tr>
                  <td>{{$portfolio->type}}</td>
                </tr>
              @empty
                <tr><td>No data</td></tr>

              @endforelse
              </tbody>
            </table>
        </section>
      @endif


		<div style="overflow-x:auto;">

          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                 <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">No</th>
               <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">District Code</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Province Thai Name</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Province English Name</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">District Thai Name</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">District English Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>




              </div>



            @foreach ($blocks as $key => $block)
                <tr role="row" class="odd">
                  <td>{{++$key}}</td>
                  <td>{{ $block->code }}</td>
                  <td>{{ $block->province_name_in_thai }}</td>
                  <td>{{ $block->province_name_in_english }}</td>
                  <td>{{ $block->name_in_thai }}</td>
                  <td>{{ $block->name_in_english }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('district.destroy', ['id' => $block->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('district.edit', ['id' => $block->id]) }}" class="btn btn-warning  btn-margin">
							Update
                        </a>
                        <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>

                    </form>
                  </td>
              </tr>
            @endforeach

            </tbody>
            <tfoot>
              <tr>
                   <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">No</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">District Code</th>
                 <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Province Thai Name</th>
                 <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Province English Name</th>
                 <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">District Thai Name</th>
                 <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">District English Name</th>
                 <th>Action</th>
              </tr>
            </tfoot>
          </table>
		</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($blocks)}} of {{count($blocks)}} entries</div>

        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
              {{ $blocks->links() }}
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
