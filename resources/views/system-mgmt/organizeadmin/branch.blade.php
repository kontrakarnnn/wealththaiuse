@extends('system-mgmt.organizeadmin.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Branch</h3>
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
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ชื่อบริษัท</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ชื่อสาขา</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ที่อยู่</th>

                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">เลขที่สาขา</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">เบอร์ติดต่อ</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">แฟกซ์</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ผู้ติดต่อ</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">เบอร์โทรผู้ติดต่อ</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">อีเมลล์ผู้ติดต่อ</th>
                  <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($listallbranch as $structure)
                <tr role="row" class="odd">

                  <td>{{ $structure->name }}</td>

                  <td>{{ $structure->name }}</td>
                  <td><b>เลขที่:</b> {{ $structure->add_no }} <b>ซอย:</b> {{ $structure->add_alley }} <b>ถนน:</b> {{ $structure->add_road }} <b>แขวง:</b> {{ $structure->subdistrict_name }} <br /><b>เขต:</b> {{ $structure->district_name }} <b>จังหวัด:</b> {{ $structure->province_name }} <b>ประเทศ:</b>{{ $structure->country_name}} <b>รหัสไปรษณีย์:</b> {{$structure->add_postcode}}</td>
                  <td>{{ $structure->number }}</td>
                  <td>{{ $structure->tel }}</td>
                  <td>{{ $structure->fax }}</td>
                  <td>{{ $structure->con_name }} {{ $structure->con_lastname }}</td>
                  <td>{{ $structure->con_tel }}</td>
                  <td>{{ $structure->con_email }}</td>


                  <td>
                    <form class="row" method="POST" action="{{ route('branchuser.destroy', ['id' => $structure->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <a href="{{ URL::to('branch/update',$orgid) }}" class="btn  btn-warning  btn-margin">
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
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ชื่อสาขา</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ที่อยู่</th>

                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">เลขที่สาขา</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">เบอร์ติดต่อ</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">แฟกซ์</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">ผู้ติดต่อ</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">เบอร์โทรผู้ติดต่อ</th>
                <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">อีเมลล์ผู้ติดต่อ</th>
                  <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="organize: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($listallbranch)}} of {{count($listallbranch)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $listallbranch->links() }}
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
