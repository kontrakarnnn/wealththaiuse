@extends('system-mgmt.serviceper.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">
      <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div>

      <div class="box">
    <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Service</h3>
        </div>
        <div class="col-sm-4">

        </div>
    </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="servicetracking/search">

         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-date-search-row', ['items' => ['From', 'To'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['from'] : '', isset($searchingVals) ? $searchingVals['to'] : '']])
          @endcomponent



         @endcomponent
      </form>

      
      <div class="col-sm-9">
      <div class="row">
      <div class="col-md-6">
        <div class="form-group">



              <label for="input" class=" control-label">Select Group Of Service</label>
              <select class=" form-control department" name="structure_id" required>

                  <option disabled="true" selected="true">กลุ่มบริการ</option>
                  @foreach ($serg as $ser)
                      <option value="{{$ser->id}}">{{$ser->name}}</option>
                  @endforeach

              </select>
              <br>
            <label for="input" class=" control-label">Select Service Name</label>

              <select class="form-control name"size="1" name="links" onchange="window.location.href=this.value;">

                  <option  disabled="true" selected="true">กรุณาเลือกกลุ่มของบริการก่อน</option>
              </select>
              <br>
                  <label href="/servicetracking">show all
                    <input class="checkbox "type="checkbox"  value="/servicetracking" name="checket"
                        onClick="if (this.checked) { window.location = this.value; }"  /></p>

</label>
               

        </div>
        </div>
        </div>
        </div>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">


      <div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th>Created Date</th>
                <th >Service Type</th>
                <th>Sender Name</th>
                <th>Recieve Name</th>
                <th>Message</th>
                <th >Status</th>

              </tr>
            </thead>
            <tbody>
            @foreach ($noti as $not)
                <tr  >
                  <td>{{$not->created_at}}</td>
                  <td>{{$not->service_name}} </td>
                  <td>{{$not->sender_name}} </td>
                  <td>{{$not->recieve_name}} </td>
                  <td>{!! html_entity_decode($not->message)!!}</td>
                  <td>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('servicetracking.update', ['id' => $not->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <p><p style="display: inline; font-weight: bold;"> </p><select class="" name="status">
                        <option>{{$not->status}}</option>
                        <option>Request</option>
                        <option>On Progress</option>
                        <option>Reject</option>
                        <option>Finish</option>
                        <option>Cancel by user</option>
                    </select>  <button type="submit" >
                        Change
                    </button> </p>
                  </form> </td>

                </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Created Date</th>
                <th >Service Type</th>
                <th>Sender Name</th>
                <th>Recieve Name</th>
                <th>Message</th>
                <th >Status</th>
              </tr>
            </tfoot>
          </table>
      </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($noti)}} of {{count($noti)}} entries</div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.department',function(){
            //  console.log("hmm its change");

                var department_id=$(this).val();
                //console.log(department_id);
                var div=$(this).parent();
                var op=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findservice')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      console.log('success');

                      console.log(data);

                     console.log(data.length);
                      op+='<option value="0" selected disabled>เลือกบริการ</option>';
                      for(var i=0; i<data.length;i++){
                        op+='<option value="{{url('myservice')}}/'+data[i].name+'">'+data[i].name+'</option>';

                      }
                      div.find('.name').html(" ");
                      div.find('.name').append(op);

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>


@endsection
