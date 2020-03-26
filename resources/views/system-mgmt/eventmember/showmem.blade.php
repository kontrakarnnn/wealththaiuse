@extends('system-mgmt.eventmember.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">




    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Event Details</a></li>
    <li><a data-toggle="tab" href="#menu1">Member Lists</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div style="overflow-x:auto;">
        @foreach ($ref as $per)
      <div class="card-header"><h4>ข้อมูล {{ $per->event_name}}</h4></div>
      <div class="card-body">

        <h5 class="card-title"></h5>

            <table style="width:100%" class="table table-bordered">
      <tr>
        <th width="10%"><p>Type of Event</p></th>
        <td ><p>{{ $per->event_type_name}} </p> </td>
      </tr>
      <tr>
        <th width="10%"><p>Organization</p></th>
        <td><p>{{ $per->organize_name }}</p></td>
      </tr>
      <tr>
        <th width="10%"><p>Member Group</p></th>
        <td><p>{{ $per->group_name }}</p></td>
      </tr>
      <tr>
        <th width="10%"><p>Guild Member </p></th>
        <td><p>{{ $per->member_group_name }}</p></td>
      </tr>
      <tr>
        <th width="10%"><p>Event Name</p></th>
        <td><p>{{ $per->event_name}}</p></td>
      </tr>
      <tr>
        <th width="10%"><p>Start Date</p></th>
        <td><p>{{ $per->event_start_date }}</p></td>
      </tr>

      <tr>
        <th width="10%"><p>Start Time</p></th>
        <td><p>{{ $per->event_start_time }}</p></td>
      </tr>

      <tr>
        <th width="10%"><p>End Date</p></th>
        <td><p>{{ $per->event_end_date }}</p></td>
      </tr>


      <tr>
        <th width="10%"><p>End Time</p></th>
        <td><p>{{ $per->event_end_time }}</p></td>

      </tr>
      <tr>
        <th width="10%"><p>Location</p></th>
        <td><p>{{ $per->location }}</p></td>

      </tr>
      <tr>
        <th width="10%"><p>Location Map</p></th>
        <td><a href="{{ $per->link }}" target="_blank"><p>แผนที่</p></a></td>

      </tr>
      <tr>
        <th width="10%"><p>Number of Seats</p></th>
        <td><p>
        {{ $per->number_seat }}</p></td>

      </tr>
      <tr>
        <th width="10%"><p>Register Default Status</p></th>
        <td><p>{{ $per->status_name}}</p></td>

      </tr>
      <tr>
        <th width="10%"><p>Link More Information</p></th>
        <td><a href="{{ $per->link_moreinfo }}" target="_blank"><p>{{ $per->link_moreinfo }}</p></a></td>

      </tr>
      <tr>
        <th width="10%"><p>Description</p></th>
        <td><p>{{ $per->event_description }}</p></td>

      </tr>



    </table>
      @endforeach
    </div>
      </div>


      </div>
    <div id="menu1" class="tab-pane fade">
      <div style="overflow-x:auto;">

      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead >

            <tr>
              <th style="background-color:#00325d;color:white" colspan="7" >Member Registered {{ $per->event_name}} Event</th>

            </tr>
          <tr>
            <th width="1%">No.</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Regist Period</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Name</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Lastname</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Note</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Status</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Created By</th>

          </tr>
        </thead>
        <tbody>
          @foreach($member as $i =>$m)

          <tr>

            <td width="">{{++$i}}</td>
            @if($m->regis_period == 1)
            <td width="">Pre Regist</td>
            @elseif($m->regis_period == 2)
            <td width="">On Event</td>
            @elseif($m->regis_period == 3)
            <td width="">Post Event</td>
            @else
            <td>          </td>
            @endif
            <td width="">{{$m->member_name}}  </td>
            <td width="">{{$m->member_lname}}  </td>
            <td width="">{{$m->note}}  </td>
            <td width="">{{$m->status_name}}  </td>
            @if($current == $m->creator_id)
            <td width="">Me</td>

            @else
            <td width="">{{$m->creator_name}} {{$m->creator_lname}}  </td>
            @endif
  </tr>
      @endforeach

        </tbody>
        <tfoot>
          <tr>
            <th width="10%">No.</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Regist Period</th>

            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Name</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Lastname</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Note</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Status</th>
            <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Created By</th>


          </tr>

        </tfoot>
      </table>
  </div>
</div>


  </div>






  <!-- /.box-body -->


    </section>



    <!-- /.content -->


@endsection
