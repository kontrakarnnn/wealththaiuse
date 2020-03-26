@extends('system-mgmt.organizeuser.base')

@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of organize</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('organizeadmin.create') }}">Add new organize</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('organizeadmin.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">


			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ชื่อบริษัท</th>

                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">เบอร์โทรออฟฟิศสำนักงาน</th>

                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">อีเมลล์สำหรับเข้าใช้งานระบบ</th>
                  <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($structures as $structure)
                <tr role="row" class="odd">
                  <td>{{ $structure->name }}</td>

                  <td>{{ $structure->mobile }}</td>
                  <td>{{ $structure->email }}</td>


                  <td>
                    <form class="row" method="POST" action="{{ route('organizeadmin.destroy', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('organizeadmin.show', ['id' => $structure->id]) }}" class="btn btn-info   btn-margin">
                        View
                        </a>
                        <a href="{{ URL::to('/organizeadmin/branch', ['id' => $structure->id]) }}" class="btn btn-success   btn-margin">
                        Branch
                        </a>
                        <a href="{{ route('organizeadmin.edit', ['id' => $structure->id]) }}" class="btn  btn-warning  btn-margin">
                          Update
                        </a>
                        <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>

                  {{--}}<td>
                    <form class="row" method="POST" action="{{ route('organize.destroy', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('organize.edit', ['id' => $structure->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>--}}
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ชื่อบริษัท</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">เบอร์โทรออฟฟิศสำนักงาน</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">อีเมลล์สำหรับเข้าใช้งานระบบ</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($structures)}} of {{count($structures)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $structures->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>

    <!-- /.content -->
@endsection
