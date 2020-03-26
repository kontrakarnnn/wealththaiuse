@extends('system-mgmt.match-view-partner.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of View Authentication Partner</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('match-view-partner.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('match-view-partner.search') }}">
         {{ csrf_field() }}
           @component('layouts.search', ['title' => 'Search'])
           <div class="row">

             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">View Partner</label>
                   <div class="col-md-7">
                     <select  class="form-control nameid" name="view_id">
                       <option value="" ></option>
                       @foreach ($viewpartner as $sta)
                           <option value="{{$sta->id}}">{{$sta->name}}</option>
                       @endforeach
                     </select>
                 </div>

               </div>
             </div>

             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">Partner Name</label>
                   <div class="col-md-7">
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
           <br />
           <div class="row">
             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">Structure</label>
                   <div class="col-md-7">
                     <select  class="form-control nameid" name="structure_id">
                       <option value="" ></option>
                       @foreach ($partnergroup as $sta)
                           <option value="{{$sta->id}}">{{$sta->name}}</option>
                       @endforeach
                     </select>
                 </div>

               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">Block</label>
                   <div class="col-md-7">
                     <select  class="form-control nameid" name="block_id">
                       <option value="" ></option>
                       @foreach ($partnerstructure as $sta)
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

                   <label for="file_category_name" class="col-sm-3 control-label">Block Topdown</label>
                   <div class="col-md-7">
                     <select  class="form-control nameid" name="block_td">
                       <option value="" ></option>
                       @foreach ($partnerblock as $sta)
                           <option value="{{$sta->id}}">{{$sta->name}}</option>
                       @endforeach
                     </select>
                 </div>

               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">Block Bottomup</label>
                   <div class="col-md-7">
                     <select  class="form-control nameid" name="block_btu">
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

                   <label for="file_category_name" class="col-sm-3 control-label">Partner Group</label>
                   <div class="col-md-7">
                     <select  class="form-control nameid" name="partner_group_id">
                       <option value="" ></option>
                       @foreach ($partnergroup as $sta)
                           <option value="{{$sta->id}}">{{$sta->name}}</option>
                       @endforeach
                     </select>
                 </div>

               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">PID Group</label>
                   <div class="col-md-7">
                     <select  class="form-control nameid" name="pid_group_id">
                       <option value="" ></option>
                       @foreach ($pidgroup as $sta)
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
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">view</th>
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">All Partner</th>
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Structure</th>
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block_id</th>
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block_topdown</th>
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block_bottomup</th>
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group PID</th>
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner Group</th>
              <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner</th>
              <th >Action</th>
              </tr>
            </thead>
            <tbody>
              {{$matchviews}}
            @foreach ($matchviews as $matchview)
                  <tr role="row" class="odd">
                  <td>{{ $matchview->Viewpartner->name }}</td>
                  <td>{{ $matchview->all_partner }} </td>
                  @if($matchview->structure_id == NULL)
                  <td></td>
                  @else
                  <td>{{ $matchview->Partner_structure->name}}</td>
                  @endif
                  @if($matchview->block_id == NULL)
                  <td> </td>
                  @else
                  <td>{{ $matchview->Partner_block->name}}</td>
                  @endif
                  @if($matchview->block_td == NULL)
                  <td> </td>
                  @else
                  <td>{{ $matchview->partner_block_td->name}}</td>
                  @endif
                  @if($matchview->block_btu == NULL)
                  <td> </td>
                  @else
                  <td>{{ $matchview->partner_block_btu->name}}</td>
                  @endif
                  @if($matchview->pid_group_id == NULL)
                  <td> </td>
                  @else
                  <td>{{ $matchview->pid_group->name}}</td>
                  @endif
                  @if($matchview->partner_group_id == NULL)
                  <td> </td>
                  @else
                  <td>{{ $matchview->Partner_group->name}}</td>
                  @endif
                  @if($matchview->partner_id == NULL)
                  <td> </td>
                  @else
                  <td>{{ $matchview->Partner->name}}</td>
                  @endif


                  <td>
                    <form class="row" method="POST" action="{{ route('match-view-partner.destroy', ['id' => $matchview->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('match-view-partner.edit', ['id' => $matchview->id]) }}" class="btn btn-warning  btn-margin">
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
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">view</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">All Partner</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Structure</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block_id</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block_topdown</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Block_bottomup</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Group PID</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner Group</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Partner</th>
                <th >Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($matchviews)}} of {{count($matchviews)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $matchviews->links() }}
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
