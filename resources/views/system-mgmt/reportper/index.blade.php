@extends('system-mgmt.report.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-4">
          <h3 class="box-title">List of hired employees</h3>
        </div>
        <div class="col-sm-4">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('reportper.excel') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$searchingVals['id_num']}}" name="id_num" />

                <button type="submit" class="btn btn-primary">
                  Export to Excel
                </button>
            </form>
        </div>
        <div class="col-sm-4">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('reportper.pdf') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$searchingVals['id_num']}}" name="from" />

                <button type="submit" class="btn btn-info">
                  Export to PDF
                </button>
            </form>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('reportper.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-date-search-row', ['items' => ['id_num'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['id_num'] : '']])
          @endcomponent
         @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Employee Name</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">Birthday</th>
                <th width = "40%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">Hired Day</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)
                <tr role="row" class="odd">
                  <td>{{ $employee->name }} {{ $employee->lastname }}</td>
                  <td>{{ $employee->id_num }}</td>

              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr role="row">
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Employee Name</th>
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">Birthday</th>
                  <th width = "40%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">Hired Day</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($employees)}} of {{count($employees)}} entries</div>
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
