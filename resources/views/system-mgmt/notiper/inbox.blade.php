@extends('system-mgmt.notiper.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Message</h3>

        </div>
        <div class="col-sm-8">
          <a class="btn btn-primary" href="{{ route('notiper.create') }}">Send Message</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
    {{--  <form method="POST" action="{{ route('notiper.search') }}">
         {{ csrf_field() }}
           @component('layouts.search', ['title' => 'Search'])
           @component('layouts.two-cols-search-row', ['items' => ['structure_name', 'block_name'],
           'oldVals' => [isset($searchingVals) ? $searchingVals['structure_name'] : '', isset($searchingVals) ? $searchingVals['block_name'] :'']])
           @endcomponent
             <br>
           @component('layouts.two-cols-search-row', ['items' => ['user_name' ],
           'oldVals' => [isset($searchingVals) ? $searchingVals['user_name'] : '']])
           @endcomponent
              @endcomponent
      </form>--}}
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
			         @foreach($curren as $current)

          <h3>Your P ID is :{{ $current->id}} </h3>
          @endforeach
          <div style="overflow-x:auto;">
              <table id="example2" class="table  table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                  <tr role="row">
                    <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                                      <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Message</th>
                      <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Date</th>
                  </tr>
                </thead>
                <tbody>

                @foreach ($notis as $noti)



                <tr class="table-tr" data-url="{{ URL::to('message/show',$noti->id)}}">


                    <td style ="font-weight:bold;" >  {{ $noti->recieve_name}}</td>
                          <td >  {{ $noti->message_type_name }}</td>
                          <td >  {{ $noti->created_at }}</td>





                    <div class="row">
      <div class="col-md-4 col-lg-2">

            {{--}}  <td>
                      <form class="row" method="POST" action="{{ route('noti.destroy', ['id' => $noti->id]) }}" onsubmit = "return confirm('Are you sure?')">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">

                          <a class="btn btn-warning " href="{{ URL::to('system-management/show',$noti->id)}}">
                              View
                            </a>
                          <a href="{{ route('noti.edit', ['id' => $noti->id]) }}" class="btn btn-warning ">
                          Update
                          </a>
                          <a class="btn btn-warning" href="{{ URL::to('system-management/reply',$noti->id)}}">
                              Reply
                            </a>

                            <a class="btn btn-warning  " href="{{ URL::to('system-management/forward',$noti->id)}}">
                                Forward
                              </a>

                      </form>
                    </td>--}}
                  </div>
                </div>


                </tr>

                @endforeach
                </tbody>

              </table>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>


$(function() {
  $('table.table').on("click", "tr.table-tr", function() {
    window.location = $(this).data("url");
    //alert($(this).data("url"));
  });
});
</script>
