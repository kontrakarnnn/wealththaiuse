@extends('system-mgmt.proposal.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of proposal</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('proposal.create') }}">Add new proposal</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('proposal.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Propsal Name</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                      @foreach($proposal as $da)
                          <option value="{{$da->name}}">{{$da->name}}</option>
                        @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="case_id" class="col-sm-3 control-label">Case</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="case_id">
                      <option value="" ></option>
                      @foreach($cases as $da)
                          <option value="{{$da->id}}">{{$da->name}}</option>
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

                  <label for="created_by" class="col-sm-3 control-label">Created By</label>
                  <div class="col-md-9">

                    <select  class="form-control name " name="created_by">
                      <option value="" ></option>
                      @foreach($publicid as $da)
                          <option value="{{$da->id}}">{{$da->public_name}}</option>
                        @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="partner_block" class="col-sm-3 control-label">Partner Block</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="partner_block">
                      <option value="" ></option>
                      @foreach($partnerblock as $da)
                          <option value="{{$da->id}}">{{$da->name}}</option>
                        @endforeach
                    </select>

                </div>

              </div>
            </div>


          </div><br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="user_block" class="col-sm-3 control-label">User Block</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="user_block">
                      <option value="" ></option>
                      @foreach($userblock as $da)
                          <option value="{{$da->id}}">{{$da->name}}</option>
                        @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="member_id" class="col-sm-3 control-label">Member</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="member_id">
                      <option value="" ></option>
                      @foreach($member as $da)
                          <option value="{{$da->id}}">{{$da->name}}</option>
                        @endforeach
                    </select>

                </div>

              </div>
            </div>

          </div><br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="created_date" class="col-sm-3 control-label">Created Date</label>
                  <div class="col-md-9">

                    <input  name="created_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"class="form-control"  />

                </div>

              </div>
            </div>



          </div>
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <a  style="color:blue"href="/admin/proposal" for="file_category_name" class="btn btn-default "> ShowAll </a>

			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th  >Proposal Name</th>
                <th  >Case</th>
                <th  >Created Date</th>
                <th  >Created By</th>
                <th  >Partner Block</th>
                <th  >User Block</th>
                <th  >Member</th>
                <th  >Description</th>
                <th  >Action</th>

              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{ $da->name }}</td>
                  <td>{{ $da->Cases->name}}</td>
                  <td>{{ $da->created_date }}</td>
                  <td>{{ $da->created_by }}</td>
                  @if($da->partner_block == NULL || $da->partner_block == 0 || $da->partner_block == '')
                    <td></td>
                  @else
                  <td>{{ $da->Partner_block->name }}</td>
                  @endif
                  @if($da->user_block == NULL || $da->user_block == 0 || $da->user_block == '')
                    <td></td>
                  @else
                  <td>{{ $da->Block->name }}</td>
                  @endif
                  @if($da->member_id == NULL || $da->member_id == 0 || $da->member_id == '')
                    <td></td>
                  @else
                  <td>{{ $da->Person->name }} {{ $da->Person->lname }}</td>
                  @endif
                  <td>{{ $da->description }}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('proposal.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('proposal.edit', ['id' => $da->id]) }}" class="btn btn-warning  btn-margin">
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
                <th  >Proposal Name</th>
                <th  >Case</th>
                <th  >Created Date</th>
                <th  >Created By</th>
                <th  >Partner Block</th>
                <th  >User Block</th>
                <th  >Member</th>
                <th  >Description</th>
                <th  >Action</th>
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
