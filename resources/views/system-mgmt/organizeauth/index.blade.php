@extends('system-mgmt.organize.base')

@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div>
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of organize</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('organizeauth.create') }}">Invitation</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Member</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Email</th>

                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">status</th>
                  <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($userauths as $structure)
                <tr role="row" class="odd">
                  <td>{{ $structure->member_name }} {{$structure->member_lname}}</td>
                  <td>{{ $structure->member_email }}</td>
                  <td>{{ $structure->status }}</td>




                  <td>
                    <form class="row" method="POST" action="{{ route('organizeauth.destroy', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Member</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Email</th>

                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">status</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($userauths)}} of {{count($userauths)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $userauths->links() }}
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
