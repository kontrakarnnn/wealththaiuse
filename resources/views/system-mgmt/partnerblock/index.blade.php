@extends('system-mgmt.partnerblock.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">


        <div class="col-sm-8">
          <h3 class="box-title">List of block</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('partnerblock.create') }}">Add new</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">

        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('partnerblock.search') }}">
         {{ csrf_field() }}


		         @component('layouts.search', ['title' => 'Search'])

          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Partner Block</label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="name">
                      <option value="" ></option>
                      @foreach ($partnerblock as $sta)
                          <option value="{{$sta->name}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Partner Structure</label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="structure_id">
                      <option value="" ></option>
                      @foreach ($partnerstructure as $sta)
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

                  <label for="file_category_name" class="col-sm-3 control-label">Underblock Block</label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="under_block">
                      <option value="" ></option>
                      @foreach ($partnerblock as $sta)
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
               <th width="20%" rowspan="1" colspan="1">Block Name</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Belong to</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Status</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Structure Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Default PID</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Contact</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>




              </div>



            @foreach ($data as $block)
                <tr role="row" class="odd">
                  <td>{{ $block->name }}</td>
                  <td>{{ $block->block_name }}</td>
                  <td>{{ $block->status }}</td>
                  <td>{{ $block->Partner_structure->name }}</td>
                  <td>{{ $block->default_pid }}</td>
					  <td> {{ $block->contact_name }} <br> {{ $block->contact_tel }} <br> <a href="mailto:{{$block->contact_email}}" target="_top">{{ $block->contact_email}}</a> </td>
                  <td>
                    <form class="row" method="POST" action="{{ route('partnerblock.destroy', ['id' => $block->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('partnerblock.edit', ['id' => $block->id]) }}" class="btn btn-warning  btn-margin">
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
                <th width="20%" rowspan="1" colspan="1">Block Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Belong to</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Status</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Structure Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Default PID</th>
                <th rowspan="0" colspan="2"> Action</th>
              </tr>
            </tfoot>
          </table>
		</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($data)}} of {{count($data)}} entries</div>

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

        $(".nameid").select2({
              placeholder: "Select",
              allowClear: true
          });
  </script>
@endsection
