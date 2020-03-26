@extends('system-mgmt.partnerauth.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Partner Authentication</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('partnerauth.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('partnerauth.search') }}">
         {{ csrf_field() }}
                @component('layouts.search', ['title' => 'Search'])
                <div class="row">
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
                  <div class="col-md-6">
                    <div class="form-group">

                        <label for="file_category_name" class="col-sm-3 control-label">Partner Block</label>
                        <div class="col-md-9">

                          <select  class="form-control nameid" name="block_id">
                            <option value="" ></option>
                            @foreach ($partnerblock as $sta)
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

                        <label for="file_category_name" class="col-sm-3 control-label">Partner</label>
                        <div class="col-md-9">

                          <select  class="form-control nameid" name="partner_id">
                            <option value="" ></option>
                            @foreach ($partner as $sta)
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
			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Structure</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              {{$partnerauths}}
            @foreach ($partnerauths as $partnerauth)
                <tr role="row" class="odd">

                  @if( $partnerauth->partner_id == NULL)
                  <td></td>
                  @else
                  <td>{{ $partnerauth->Partner->name }}</td>
                  @endif
                  @if( $partnerauth->structure_id == NULL)
                  <td></td>
                  @else
                  <td>{{ $partnerauth->Partner_structure->name}}</td>
                  @endif
                  @if( $partnerauth->structure_id == NULL)
                  <td></td>
                  @else
                  <td>{{ $partnerauth->Partner_block->name }}</td>
                  @endif
                  <td>{{ $partnerauth->description}}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('partnerauth.destroy', ['id' => $partnerauth->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('partnerauth.edit', ['id' => $partnerauth->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Structure</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($partnerauths)}} of {{count($partnerauths)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $partnerauths->links() }}
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

          $(".nameid").select2({
                placeholder: "Select",
                allowClear: true
            });
    </script>
@endsection
