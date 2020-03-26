@extends('system-mgmt.caseproposal.base')
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
          <a class="btn btn-primary" href="{{ route('caseproposal.create') }}">Add new </a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('caseproposal.search') }}">
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

                 <label for="file_category_name" class="col-sm-3 control-label">Proposal</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="proposal_id">
                     <option value="" ></option>
                     @foreach ($proposal as $sta)
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

                 <label for="file_category_name" class="col-sm-3 control-label">Offer</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="offer_id">
                     <option value="" ></option>
                     @foreach ($offer as $sta)
                         <option value="{{$sta->id}}">{{$sta->name}}</option>
                     @endforeach
                   </select>

                 </div>

             </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Asset</label>
                 <div class="col-md-9">

                   <select  class="form-control name" name="asset_id">
                     <option value="" ></option>
                     @foreach ($asset as $sta)
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
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Case </th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Proposal</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Offer</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Asset</th>
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
                  @if($da->proposal_id == NULL || $da->proposal_id ==0)
                  <td></td>
                  @else
                  <td>{{ $da->Proposal->name }}</td>
                  @endif
                  @if($da->offer_id == NULL || $da->offer_id ==0)
                  <td></td>
                  @else
                  <td>{{ $da->Offer->name }}</td>
                  @endif
                  @if($da->asset_id == NULL || $da->asset_id ==0)
                  <td></td>
                  @else
                  <td>{{ $da->Asset->name }}</td>
                  @endif
                  <td>{{ $da->description }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('caseproposal.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <a href="{{ route('caseproposal.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
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
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Case </th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Proposal</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Offer</th>
                <th   class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Asset</th>
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
