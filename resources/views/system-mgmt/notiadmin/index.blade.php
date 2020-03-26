@extends('system-mgmt.notiadmin.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Message</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('notiadmin.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('notiadmin.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-date-search-row', ['items' => ['From', 'To'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['from'] : '', isset($searchingVals) ? $searchingVals['to'] : '']])
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
              <th width="1%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Create_At</th>
                                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Create_By</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">sender</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message_type</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message_Default</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message_Topic</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message_detail</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_PID</th>

                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member email</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_mobile</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_Citizen</th>


              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_Note</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">reciever_note</th>




              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">reciever</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">cc_reciever1</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">cc_reciever2</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">cc_reciever3</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Referal Link</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">status</th>
              <th width="6%">Action</th>
            </tr>
          </thead>
          <tbody>

          @foreach ($notis as $noti)
            <tr role="row" class="odd">

              <td>{{ $noti->created_at }}</td>
                    <td> {{ $noti->created_name}}</td>
                <td>{{ $noti->sender_name }}</td>
              <td>{{ $noti->message_type_name }}</td>
              <td>{{ $noti->message_type_default }}</td>
              <td>{{ $noti->topic }}</td>
              <td>{{ $noti->message}}</td>
              <td>{{ $noti->sender_id}} </td>

              <td><a href="mailto: {{ $noti->sender_email }}" target="_top">{{ $noti->sender_email }}</a></td>
              <td><a href="tel: {{ $noti->sender_mobile }}" target="_top">{{ $noti->sender_mobile }}</a></td>
              <td>{{ $noti->sender_idnum }}</td>

              <td style="color:red;">{{ $noti->sender_note}}</td>
              <td>{{ $noti->reciever_note}}</td>





              <td>{{ $noti->recieve_name }}</td>
              <td>{{ $noti->cc_reciever1}}</td>
              <td>{{ $noti->cc_reciever2}}</td>
              <td>{{ $noti->cc_reciever3}}</td>

              <td><a href="{{ $noti->reflink }}" target="_blank">
                  {{ $noti->reflink }}
                </a></td>
              <td>{{ $noti->status}}</td>

              <td>
                <form class="row" method="POST" action="{{ route('notiadmin.destroy', ['id' => $noti->id]) }}" onsubmit = "return confirm('Are you sure?')">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a href="{{ route('notiadmin.edit', ['id' => $noti->id]) }}" class="btn btn-warning btn-margin ">
                    Update
                    </a>
                    <button type="submit" class="btn btn-danger btn-margin">
                      Delete
                    </button>
                </form>
              </td>
          </tr>
          @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th width="1%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Create_At</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">sender</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message_type</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message_Default</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message_Topic</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message_detail</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_PID</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_Name</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member email</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_mobile</th>
                <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_Citizen</th>


              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member_Note</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">reciever_note</th>




              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">reciever</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">cc_reciever1</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">cc_reciever2</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">cc_reciever3</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Referal Link</th>
              <th width="6%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">status</th>
              <th width="6%">Action</th>
            </tr>
          </tfoot>
        </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($notis)}} of {{count($notis)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

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
