@extends('system-mgmt.report.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box" >
  <div class="box-header">
    <div class="row">
        <div class="col-sm-4">
          <h3 class="box-title">KTBST Document</h3>
        </div>
        <div class="col-sm-4" >
            <form class="form-horizontal" role="form" method="POST" action="{{ route('mem.excel') }}" target = "_blank">
                {{ csrf_field() }}
                <input type="hidden" value="{{$searchingVals['id_num']}}" name="id_num" />

                <button type="submit" class="btn btn-primary">
                  Export to Excel
                </button>
            </form>
        </div>
        <div class="col-sm-4">

          <form class="form-horizontal" role="form" method="POST" action="{{ route('per.pdf') }} " target = "_blank" >
              {{ csrf_field() }}
              <input type="hidden" value="{{$searchingVals['id_num']}}" name="id_num" />

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
      <form method="POST" action="{{ route('mem.search') }}">
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
          <div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th >Full Name</th>

                <th >Citizen ID</th>
                <th >Mobile</th>

              </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)
                <tr role="row" class="odd">
                  <td>{{ $employee->name }} {{ $employee->lname }}</td>

                  <td>{{ $employee->id_num }}</td>
                  <td>{{ $employee->mobile }}</td>

              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr role="row">
                <th >Full Name</th>

                <th >Citizen ID</th>
                <th >Mobile</th>
              </tr>
            </tfoot>
          </table>
        </div>
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
