@extends('system-mgmt.caseaction.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Action</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('caseaction.create') }}">Add new Case Action</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('caseaction.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Stage Action </label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="name">
                     <option value="" ></option>
                     @foreach ($caseaction as $sta)
                         <option value="{{$sta->name}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

                 </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Case </label>
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
       </div>
         <br />
         <div class="row">


           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Stage</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="current_stage_id">
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

                 <label for="file_category_name" class="col-sm-3 control-label">Action Time</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="action_time">
                     <option value="" ></option>
                    <option value="0">Entering</option>
                    <option value="1">Exiting</option>
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
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Case</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Stage Action</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Stage</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Action Flag</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Action Time</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Description</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  @if($da->case_id == NULL || $da->case_id ==0)
                  <td></td>
                  @else

                  <td>{{ $da->Cases->name }}</td>
                  @endif
                  @if($da->stage_action == NULL || $da->stage_action ==0)
                  <td></td>
                  @else
                  <td>{{ $da->StageAction->name }}</td>
                  @endif
                  @if($da->action_stage_id == NULL || $da->action_stage_id ==0)
                  <td></td>
                  @else
                  <td>{{ $da->Stage->name }}</td>
                  @endif
                  <td>{{$da->action_flag}}</td>

                  @if($da->action_time == 0)
                  <td>Entering</td>
                  @elseif($da->action_time == 1)
                  <td>Exiting</td>
                  @endif
                  <td>{{$da->description}}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('caseaction.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <a href="{{ route('caseaction.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
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
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Case</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Stage Action</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Stage</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Action Flag</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Action Time</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Description</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
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
