@extends('system-mgmt.case-log.base')
@section('action-content')
    <!-- Main content -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Case Log</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('case-log.create') }}">Add new Case Log</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('case-log.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="case_id" class="col-sm-3 control-label">Case</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="case_id">
                     <option value="" ></option>
                     @foreach ($case as $sta)
                         <option value="{{$sta->id}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

               </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="move_from_stage" class="col-sm-3 control-label">Move From Stage</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="move_from_stage">
                     <option value="" ></option>
                     @foreach ($stage as $sta)
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

                 <label for="move_to_stage" class="col-sm-3 control-label">Move To Stage</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="move_to_stage">
                     <option value="" ></option>
                     @foreach ($stage as $sta)
                         <option value="{{$sta->id}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

               </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="moving_path" class="col-sm-3 control-label">Moving Path</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="moving_path">
                     <option value="" ></option>
                     @foreach ($path as $sta)
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

                 <label for="move_to_stage" class="col-sm-3 control-label">Date</label>
                 <div class="col-md-9">

                   <input id="date" type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyy" class="form-control" name="date" value="{{ old('name') }}">


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
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Date/Time</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Case</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Move From Stage</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Move To Stage</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Moving Path</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Condition Match</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Description</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{$da->date_time}}</td>

                  @if($da->case_id == NULL ||$da->case_id == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Cases->name}}</td>
                  @endif
                  @if($da->move_from_stage == NULL ||$da->move_from_stage == 0)
                  <td></td>
                  @else
                  <td>{{$da->movefromstage->name}}</td>
                  @endif
                  @if($da->move_to_stage == NULL ||$da->move_to_stage == 0)
                  <td></td>
                  @else
                  <td>{{$da->movetostage->name}}</td>
                  @endif
                  @if($da->moving_path == NULL ||$da->moving_path == 0)
                  <td></td>
                  @else
                  <td>{{$da->Path->name}}</td>
                  @endif
                  <td>{{ $da->condition_match }}</td>
                  <td>{{ $da->description }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('case-log.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('case-log.edit', ['id' => $da->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Date/Time</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Case</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Move From Stage</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Move To Stage</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Moving Path</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Condition Match</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Description</th>
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

          $(".name").select2({
                placeholder: "Select",
                allowClear: true
            });
    </script>
@endsection
