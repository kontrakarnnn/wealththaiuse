@extends('admin.partnermanage.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Partner</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('partnermanage.create') }}">Add new partner</a>
        </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>



      <form method="POST" action="{{ route('partnermanage.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Partner</label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="partner_id">
                      <option value="" ></option>
                      @foreach ($partner as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}  {{$sta->lastname}} </option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
      <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Status </label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="status">
                      <option value="" ></option>
                      <option value="1" >Request</option>
                      <option value="2" >Active</option>
                      <option value="3" >Disabled</option>

                    </select>

                </div>

              </div>
            </div>


          </div>
          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Mobile</label>
                  <div class="col-md-9">

                    <select  class="form-control nameid" name="mobile">
                      <option value="" ></option>
                      @foreach ($partner as $sta)
                          <option value="{{$sta->mobile}}">{{$sta->mobile}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
      <div class="col-md-6">
        <div class="form-group">

            <label for="file_category_name" class="col-sm-3 control-label">Email</label>
            <div class="col-md-9">

              <select  class="form-control nameid" name="email">
                <option value="" ></option>
                @foreach ($partner as $sta)
                    <option value="{{$sta->email}}">{{$sta->email}}</option>
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

                  <label for="file_category_name" class="col-sm-3 control-label">Citizen ID</label>
                  <div class="col-md-9">
                    <select  class="form-control nameid" name="citizen_id">
                      <option value="" ></option>
                      @foreach ($partner as $sta)
                          <option value="{{$sta->citizen_id}}">{{$sta->citizen_id}}</option>
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
        <br />
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
          @endforeach
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Lastname</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Email</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Citizen ID</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Status</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              {{$data}}
            @foreach ($data as $d)
                <tr role="row" class="odd">
                  <td>{{ $d->name}}</td>
                  <td>{{ $d->lastname }}</td>
                  <td>{{ $d->email }}</td>
                  <td>{{ $d->citizen_id }}</td>

                  <td><select style="color:black"  name="status" onchange="window.location.href=this.value;">
                      <option value="/admin/changestatuspartner/1/{{ $d->id}}" {{$d->status == 1 ? 'selected' : ''}}>Request</option>
                      <option value="/admin/changestatuspartner/2/{{ $d->id}}" {{$d->status == 2 ? 'selected' : ''}}>Active</option>
                      <option value="/admin/changestatuspartner/3/{{ $d->id}}" {{$d->status == 3 ? 'selected' : ''}}>Disabled</option>
                  </select></td>




                  <td>
                    <form class="row" method="POST" action="{{ route('partnermanage.destroy', ['id' => $d->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Lastname</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Email</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Citizen ID</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Status</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
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

        $(".nameid").select2({
              placeholder: "Select",
              allowClear: true
          });
  </script>
@endsection
