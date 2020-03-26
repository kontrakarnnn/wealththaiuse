@extends('system-mgmt.procedures-to-process.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Procedure</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('procedures-to-process.create') }}">Add new Procedure</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('procedures-to-process.search') }}">
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


              <tr role="row" >
                <th   rowspan="1" colspan="1"> Name</th>
                <th   rowspan="1" colspan="1"> Process</th>
                <th   rowspan="1" colspan="1"> Next Procedure to Process</th>
                <th   rowspan="1" colspan="1"> Procedure</th>
                <th   rowspan="1" colspan="1"> Start Flag</th>
                <th   rowspan="1" colspan="1"> End Flag</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Description</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>


            </thead>
            <tbody>
            @foreach ($data as $da)



                <tr class=" ">

                  <td class="">{{ $da->name }}</td>
                  @if($da->process_id == NULL || $da->process_id == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Process->name }}</td>
                  @endif
                  @if($da->next_procedure_to_process == NULL || $da->next_procedure_to_process == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Procedures_To_Process->name }}</td>
                  @endif
                  @if($da->procedure_id == NULL || $da->procedure_id == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Procedures->name }}</td>
                  @endif
                  <td>{{ $da->start_process_flag }}</td>
                  <td>{{ $da->end_process_flag }}</td>
                  <td>{{ $da->description }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('procedures-to-process.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="/admin/process?procdid{{$da->process_id}}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Details
                        </a>
                        <a href="{{ route('procedures-to-process.edit', ['id' => $da->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th   rowspan="1" colspan="1"> Name</th>
                <th   rowspan="1" colspan="1"> Process</th>
                <th   rowspan="1" colspan="1"> Next Procedure to Process</th>
                <th   rowspan="1" colspan="1"> Procedure</th>
                <th   rowspan="1" colspan="1"> Start Flag</th>
                <th   rowspan="1" colspan="1"> End Flag</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Description</th>
                <th rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
      <br />

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
@endsection
