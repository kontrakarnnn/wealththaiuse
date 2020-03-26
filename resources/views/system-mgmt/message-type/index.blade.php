@extends('system-mgmt.message-type.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">


        <div class="col-sm-8">
          <h3 class="box-title">List of message type</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('message-type.create') }}">Add new</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">

        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('message-type.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['message_cat_name','message_template'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['message_cat_name'] : '',isset($searchingVals) ? $searchingVals['message_template'] : '']])
          @endcomponent
          <br>
          @component('layouts.two-cols-search-row', ['items' => ['cc_recieve','cc_email'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['cc_recieve'] : '',isset($searchingVals) ? $searchingVals['cc_email'] : '']])
          @endcomponent
          <br>
          @component('layouts.two-cols-search-row', ['items' => ['default_recieve','default_email'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['default_recieve'] : '',isset($searchingVals) ? $searchingVals['default_email'] : '']])
          @endcomponent
          <br>
          @component('layouts.two-cols-search-row', ['items' => ['default_status'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['default_status'] : '']])
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
               <th  rowspan="1" colspan="1">Category Name</th>
               <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">message template</th>
               <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">message default</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">cc_recieve</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">cc_email</th>

                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">default_recieve_id</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">default_email</th>
            <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">default_status</th>
            <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Auto_reply</th>
            <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Sent Email</th>
            <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Sent LINE</th>
            <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Sent Application</th>

            <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Reply Message</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>




              </div>



            @foreach ($msg_types as $mt)
                <tr role="row" class="odd">

                  <td>{{ $mt->message_cat_name }}</td>
                  <td>{{ $mt->message_template }}</td>
                  <td>{{ $mt->message_default }}</td>
                  <td>{{ $mt->cc_recieve }}</td>
                  <td>{{ $mt->cc_email }}</td>

                  <td> {{ $mt->default_recieve_id }}</td>
					        <td> {{ $mt->default_email }}</td>
                    <td>{{ $mt->default_status }}</td>
                    @if($mt->auto_reply == "Yes")
                    <td style="text-align:center"><i style ="color:green;" class="fa fa-check"></i></td>
                    @else
                    <td style="text-align:center"><i style ="color:red;" class="fa fa-close"></i></td>
                    @endif
                    @if($mt->email_flag == 1)
                    <td style="text-align:center"><i style ="color:green;" class="fa fa-check"></i></td>
                    @else
                    <td style="text-align:center"><i style ="color:red;" class="fa fa-close"></i></td>
                    @endif
                    @if($mt->line_flag == 1)
                    <td style="text-align:center"><i style ="color:green;" class="fa fa-check"></i></td>
                    @else
                    <td style="text-align:center"><i style ="color:red;" class="fa fa-close"></i></td>
                    @endif
                    @if($mt->app_flag == 1)
                    <td style="text-align:center"><i style ="color:green;" class="fa fa-check"></i></td>
                    @else
                    <td style="text-align:center"><i style ="color:red;" class="fa fa-close"></i></td>
                    @endif
                      <td>{{ $mt->bl_name }}</td>


                <td>
                    <form class="row" method="POST" action="{{ route('message-type.destroy', ['id' => $mt->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('message-type.edit', ['id' => $mt->id]) }}" class="btn btn-warning  btn-margin">
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
                <th  rowspan="1" colspan="1">Category Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">message template</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">message default</th>
                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">cc_recieve</th>
                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">cc_email</th>

                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">default_recieve_id</th>
                 <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">default_email</th>
             <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">default_status</th>
             <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Auto_reply</th>
             <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Sent Email</th>
             <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Sent LINE</th>
             <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Sent Application</th>

             <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Block: activate to sort column ascending">Reply Message</th>
                 <th>Action</th>
              </tr>
            </tfoot>
          </table>
		</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($msg_types)}} of {{count($msg_types)}} entries</div>

        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
              {{ $msg_types->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->

    </section>



    <!-- /.content -->


@endsection
