@extends('system-mgmt.case-auth.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Case Category</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('case-auth.create') }}">Add new Case Category</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('case-auth.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Case</label>
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

                 <label for="file_category_name" class="col-sm-3 control-label">Public ID</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="public_id">
                     <option value="" ></option>
                     @foreach ($public_id as $sta)
                         <option value="{{$sta->id}}">{{$sta->id}} {{$sta->public_name}}</option>
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

                 <label for="file_category_name" class="col-sm-3 control-label">User Block</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="block_user">
                     <option value="" ></option>
                     @foreach ($block as $sta)
                         <option value="{{$sta->id}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

               </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Partner Block</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="block_partner">
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

                 <label for="file_category_name" class="col-sm-3 control-label">Guild Member</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="guild_member">
                     <option value="" ></option>
                     @foreach ($guildmember as $sta)
                         <option value="{{$sta->id}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

               </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Member Group</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="group_member">
                     <option value="" ></option>
                     @foreach ($membergroup as $sta)
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

                 <label for="file_category_name" class="col-sm-3 control-label">PublicID Group </label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="pid_group">
                     <option value="" ></option>
                     @foreach ($pidgroup as $sta)
                         <option value="{{$sta->id}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

               </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Partner Group</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="partner_group">
                     <option value="" ></option>
                     @foreach ($partnergroup as $sta)
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
          <a  style="color:blue"href="/admin/case-auth" for="file_category_name" class="btn btn-default "> ShowAll </a>

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Case</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Public ID</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Partner Block</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">User Block</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Guild Member</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Group Member</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Group PID</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Group Partner</th>




                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  @if($da->case_id == NULL || $da->case_id == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Cases->name}}</td>
                  @endif
                  @if($da->public_id == NULL || $da->public_id == 0)
                  <td></td>
                  @else
                  <td>{{ $da->match_id->public_name }}</td>
                  @endif
                  @if($da->block_partner == NULL || $da->block_partner == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Partner_block->name }}</td>
                  @endif
                  @if($da->block_user == NULL || $da->block_user == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Block->name }}</td>
                  @endif
                  @if($da->guild_member == NULL || $da->guild_member == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Family->name }}</td>
                  @endif
                  @if($da->group_member == NULL || $da->group_member == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Member_group->name }}</td>
                  @endif
                  @if($da->group_pid == NULL || $da->group_pid == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Pid_group->name }}</td>
                  @endif
                  @if($da->group_partner == NULL || $da->group_partner == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Partner_group->name }}</td>
                  @endif
                  <td>
                    <form class="row" method="POST" action="{{ route('case-auth.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('case-auth.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
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
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Case</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Public ID</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Partner Block</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">User Block</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Guild Member</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Group Member</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Group PID</th>
                <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Group Partner</th>
                <th>
                  Action
                </th>
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
                //allowClear: true
            });
    </script>
@endsection
