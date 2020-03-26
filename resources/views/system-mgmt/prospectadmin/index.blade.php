@extends('system-mgmt.prospectadmin.base')
@section('action-content')
    <!-- Main content -->

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of prospect</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('prospectadmin.create') }}">Add new prospect</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>


      <form method="POST" action="{{ route('prospectadmin.searchnormal') }}">
         {{ csrf_field() }}



         @component('layouts.search', ['title' => 'Search'])
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Name</label>
                 <div class="col-md-7">

                   <input   class="form-control" name="name" id="file_category_name" placeholder="Name">

               </div>

             </div>
           </div>

             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">Lastname</label>
                   <div class="col-sm-7">

                     <input   class="form-control" name="lastname" id="file_category_name" placeholder="Lastname">

                 </div>

               </div>
             </div>

         </div>
         <br />
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Email</label>
                 <div class="col-md-7">

                   <input   class="form-control" name="email" id="file_category_name" placeholder="Email">

               </div>

             </div>
           </div>

             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">Phone</label>
                   <div class="col-sm-7">

                     <input   class="form-control" name="mobile" id="file_category_name" placeholder="Phone">

                 </div>

               </div>
             </div>

         </div>
         <br />
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Nickname</label>
                 <div class="col-sm-7">

                   <input   class="form-control" name="nickname" id="file_category_name" placeholder="Nickname">

               </div>

             </div>
           </div>

             <div class="col-md-6">
               <div class="form-group">

                   <label for="file_category_name" class="col-sm-3 control-label">Type</label>
                   <div class="col-sm-7">

                     <select  class="form-control" name="type">
                         <option value="" ></option>
                         {{--{{$event->id == $eventl ? 'selected' : ''}}--}}
                         <option >Personal</option>
                         <option >Refered</option>
                         <option>Office</option>
                         <option >Special</option>
                         <option >Partner</option>
                         <option >Event</option>
                         <option >Cold-Calling</option>
                         <option >Target_Group</option>
                     </select>
                 </div>

               </div>
             </div>

         </div>
         <br />
         <div class="row">

           <div class="col-md-6">
             <div class="form-group">

                 <label for="file_category_name" class="col-sm-3 control-label">Status</label>
                 <div class="col-md-7">

                   <select  class="form-control" name="lead_statusname">
                     <option value="" ></option>
                     @foreach ($leadstatus as $sta)
                         <option >{{$sta->name}}</option>
                     @endforeach
                   </select>
               </div>

             </div>
           </div>

             <div class="col-md-6">
               <div class="form-group">

                   <label for="" class="col-sm-3 control-label">Priority</label>
                   <div class="col-sm-7">

                     <select  class="form-control" name="priority">
                         <option value="" ></option>
                         <option >1</option>
                         <option >2</option>
                         <option>3</option>
                         <option >4</option>
                         <option >5</option>

                     </select>
                 </div>

               </div>
             </div>

         </div>
        @endcomponent
      </form>

      <form method="POST" action="{{ route('prospectadmin.search') }}">
         {{ csrf_field() }}



         @component('layouts.search-date', ['title' => 'Search From Date'])
         <div class="row" >

        <div class="col-md-6" >

        <div class="form-group">

          <label class="col-md-3 control-label"> Type Of Date</label>
          <div class="col-md-7">
              <div class="input-group date">
                  <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                  </div>
                  <select  class="form-control" name="column"  required autofocus>
                      <option value="" ></option>
                      {{--{{$event->id == $eventl ? 'selected' : ''}}--}}
                      <option value="regis_date">Register Time</option>
                      <option value="last_contact_date">last_contact_date</option>
                      <option value="re_contact_date">re_contact_date</option>
                      <option value="meeting_date">meeting_date</option>
                  </select>
                </div>
          </div>
        </div>
      </div>
    </div>
<br />

<div class="row">

  <div class="col-md-6">
    <div class="form-group">

        <label for="file_category_name" class="col-sm-3 control-label">From_Date</label>
        <div class="col-md-7">
          <div class="input-group date">

          <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
          </div>
          <input   class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy"name="from" id="file_category_name" placeholder="dd/mm/yyy">

        </div>
      </div>

    </div>
  </div>

    <div class="col-md-6">
      <div class="form-group">

          <label for="file_category_name" class="col-sm-3 control-label">To_Date</label>
          <div class="col-sm-7">
            <div class="input-group date">
              <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
              </div>
            <input   class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy"name="to" id="file_category_name" placeholder="dd/mm/yyy">

          </div>
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
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div>

        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">

                <th  colspan="10"  style=" font-size:20px;color:white;background-color:#00325d;"> Urgent</th>
              </tr>
              <tr role="row">
                <th width="1%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No.</th>
                <th width="12%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Register Time </th>
                <th width="5%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Priority</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Phone</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Email</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Status</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Assign</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Action</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($meetingdateearly as $num =>$l)
              @php
              $date1 = date('d-m-Y');
              $date3 = date('d-m-Y', strtotime("+2 days"));
              $date2 = date('m-d-Y', strtotime($l->meeting_date));
              $birth =' ';
              if($l->meeting_date != NULL)
              {

              $birth=explode("/",str_replace(" ","-",$l->meeting_date));
              //($birth[0])."-".$birth[1]."-".$birth[2];
              $birth = $birth[0]."-".$birth[1]."-".$birth[2];

            }
              $datetime1 = date_create($date1);
                  $datetime2 = date_create($birth);

                  $interval = date_diff($datetime1, $datetime2);

                  $day =  $interval->format("%R%a");

              @endphp

              @if($day < 0)
              <tr title="Meeting Date Missed"style="background-color:red; color:white"role="row" class="odd">

              <td >{{++$i}}</td>
              <td>{{$l->regis_date}} {{$l->regis_time}}</td>
              <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
                <option value="{{$l->priority}}" >{{$l->priority}}</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/1" >1</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/2" >2</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/3" >3</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/4" >4</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/5" >5</option>
              </select></td>
              <td>{{ $l->name }} {{ $l->lname }}</td>
              <td>{{ $l->mobile }}</td>
              <td>{{ $l->email }}</td>
              <td><select style="color:black" class=" department nameid" name="regis_default_status" onchange="window.location.href=this.value;">

                <option value="" ></option>
                @foreach ($leadstatus as $sta)
                    <option value="/admin/prospectadmin/status/{{$l->id}}/{{$sta->id}}"{{$sta->id == $l->status ? 'selected' : ''}}>{{$sta->name}}</option>
                @endforeach

              </select>
              </td>
              <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
              <option value="{{$l->priority}}" >{{$l->type}}</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Personal" >Personal</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Refered" >Refered</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Office" >Office</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Special" >Special</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Partner" >Partner</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Event" >Event</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Cold-Calling" >Cold-Calling</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Target_Group" >Target_Group</option>

              </select></td>
              <td>{{ $l->assign_from_center }}</td>

              <td>


<!-- Trigger the modal with a button -->
<form class="row" method="POST" action="{{ route('prospectadmin.destroy', ['id' => $l->id]) }}" onsubmit = "return confirm('Are you sure?')">
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $l->id }}">More Details</button>
              {{--<a href="/convert/prospectadmin/=name={{ $l->name }}=name=lname={{ $l->lname }}=lname==nickname={{ $l->nickname }}=nickname==email={{ $l->email }}=email==mobile={{ $l->mobile }}=mobile==lastcondate={{ date('d-m-Y', strtotime($l->last_contact_date)) }}=lastcondate==recondate={{ date('d-m-Y', strtotime($l->re_contact_date)) }}=recondate==recontime={{ $l->re_contact_time }}=recontime==meetdate={{  date('d-m-Y', strtotime($l->meeting_date)) }}=meetdate==meettime={{ $l->meeting_time }}=meettime==meetlocation={{ $l->meeting_location }}=meetlocation==leadnote={{ $l->note }}=leadnote=" class="btn btn-success btn-margin">Convert to lead</a>--}}
<!-- Modal -->
<button type="submit" class="btn btn-danger  btn-margin">
Delete
</button>
</form>
<div class="modal fade" id="myModal{{ $l->id }}" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<form class="form-horizontal" role="form" method="POST" action="{{ route('prospectadmin.update', ['id' =>  $l->id]) }}">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="modal-content">
  <div class="modal-header" style="background-color:#00325d;color:white;">
    <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
    <h4 class="modal-title">ข้อมูล {{$l->name}}</h4>
  </div>
  <div class="modal-body">

    <table class="table table-bordered table-hover" style="width:100%;color:black">
<th style="background-color:;color:;">
  Topic
</th>
<th style="background-color:;color:;">
  Details
</th>
<tr>
  <th width="50%"><p>Interest</p></th>

  <td ><input type="text" name="interest" class="form-control" value="{{$l->interest}}" /> </td>

</tr>
<tr>
  <th width="50%"><p>Relation</p></th>

  <td ><input type="text" name="relation" class="form-control" value="{{$l->relation}}" /> </td>

</tr>

<tr>
  <th width="50%"><p>Last Contact Date </p></th>
  <td ><input  name="last_contact_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->last_contact_date}}" /> </td>

</tr>
<tr>
  <th width="50%"><p>Re-Contact Date </p></th>

  <td ><input type="text" name="re_contact_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->re_contact_date}}" /> </td>

</tr>
<tr>
  <th width="50%"><p>Re-Contact Time</p></th>

  <td ><input type="text" name="re_contact_time" class="form-control timepicker" value="{{$l->re_contact_time}}" /> </td>
  <script type="text/javascript">

      $('.timepicker').datetimepicker({

          format: 'HH:mm:ss'

      });

  </script>
</tr>
<tr>
  <th width="50%"><p>Meeting Date</p></th>

  <td ><input type="text" name="meeting_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->meeting_date}}" /> </td>

</tr>
<tr>
  <th width="50%"><p>Meeting Time</p></th>

  <td ><input type="text" name="meeting_time" class="form-control timepicker" value="{{$l->meeting_time}}" /> </td>
  <script type="text/javascript">

      $('.timepicker').datetimepicker({

          format: 'HH:mm:ss'

      });

  </script>
</tr>
<tr>
  <th width="50%"><p>Meeting Location</p></th>

  <td ><input type="text" name="meeting_location" class="form-control" value="{{$l->meeting_location}}" /> </td>

</tr>


<tr>
  <th width="50%"><p>Note</p></th>
  <td ><textarea type="text" name="note" class="form-control">{{$l->note}}</textarea> </td>
</tr>

<tr>
  <th width="50%"><p>Assign To</p></th>
  <td >


        <select class="form-control " id="dsds" name="refered">
          <option></option>
          @foreach($ref as $r)
          <option value="{{$r->id}}" {{$r->id == $l->refered ? 'selected' : ''}}>{{$r->public_name}}</option>
          @endforeach
  </select>
</td>
</tr>


<th style="background-color:;color:;">
Topic
</th>
<th style="background-color:;color:;">
Details
</th>



</table>

  </div>
  <div class="modal-footer" style="background-color:#00325d;color:white;">
    <button type="submit" class="btn btn-default" >Save</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

  </div>
</div>
</form>
</div>
</div>

              </td>

              </tr>
              @else
              @endif
              @endforeach

              @foreach ($recontactearly as $num =>$l)
              @php
              $date1 = date('d-m-Y');
              $date3 = date('d-m-Y', strtotime("+2 days"));
              $date2 = date('m-d-Y', strtotime($l->re_contact_date));
              $birth =' ';
              if($l->re_contact_date != NULL)
              {

              $birth=explode("/",str_replace(" ","-",$l->re_contact_date));
              //($birth[0])."-".$birth[1]."-".$birth[2];
              $birth = $birth[0]."-".$birth[1]."-".$birth[2];

            }
              $datetime1 = date_create($date1);
                  $datetime2 = date_create($birth);

                  $interval = date_diff($datetime1, $datetime2);

                  $day =  $interval->format("%R%a");

              @endphp

              @if($day < 0)
              <tr title="Re-Contact Date Missed"style="background-color:red; color:white"role="row" class="odd">

              <td >{{++$i}}</td>
              <td>{{$l->regis_date}} {{$l->regis_time}}</td>
              <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
                <option value="{{$l->priority}}" >{{$l->priority}}</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/1" >1</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/2" >2</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/3" >3</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/4" >4</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/5" >5</option>
              </select></td>
              <td>{{ $l->name }} {{ $l->lname }}</td>
              <td>{{ $l->mobile }}</td>
              <td>{{ $l->email }}</td>
              <td><select style="color:black" class=" department nameid" name="regis_default_status" onchange="window.location.href=this.value;">

                <option value="" ></option>
                @foreach ($leadstatus as $sta)
                    <option value="/admin/prospectadmin/status/{{$l->id}}/{{$sta->id}}"{{$sta->id == $l->status ? 'selected' : ''}}>{{$sta->name}}</option>
                @endforeach

              </select>
              </td>
              <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
              <option value="{{$l->priority}}" >{{$l->type}}</option>
              <option value="/admin/prospectadmin/status/prospectadmin/type/{{$l->id}}/Personal" >Personal</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Refered" >Refered</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Office" >Office</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Special" >Special</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Partner" >Partner</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Event" >Event</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Cold-Calling" >Cold-Calling</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Target_Group" >Target_Group</option>

              </select></td>
              <td>{{ $l->assign_from_center }}</td>

              <td>


<!-- Trigger the modal with a button -->
<form class="row" method="POST" action="{{ route('prospectadmin.destroy', ['id' => $l->id]) }}" onsubmit = "return confirm('Are you sure?')">
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $l->id }}">More Details</button>
              {{--<a href="/convert/prospectadmin/=name={{ $l->name }}=name=lname={{ $l->lname }}=lname==nickname={{ $l->nickname }}=nickname==email={{ $l->email }}=email==mobile={{ $l->mobile }}=mobile==lastcondate={{ date('d-m-Y', strtotime($l->last_contact_date)) }}=lastcondate==recondate={{ date('d-m-Y', strtotime($l->re_contact_date)) }}=recondate==recontime={{ $l->re_contact_time }}=recontime==meetdate={{  date('d-m-Y', strtotime($l->meeting_date)) }}=meetdate==meettime={{ $l->meeting_time }}=meettime==meetlocation={{ $l->meeting_location }}=meetlocation==leadnote={{ $l->note }}=leadnote=" class="btn btn-success btn-margin">Convert to lead</a>--}}
<!-- Modal -->
<button type="submit" class="btn btn-danger  btn-margin">
Delete
</button>
</form>
<div class="modal fade" id="myModal{{ $l->id }}" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<form class="form-horizontal" role="form" method="POST" action="{{ route('prospectadmin.update', ['id' =>  $l->id]) }}">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="modal-content">
  <div class="modal-header" style="background-color:#00325d;color:white;">
    <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
    <h4 class="modal-title">ข้อมูล {{$l->name}}</h4>
  </div>
  <div class="modal-body">

    <table class="table table-bordered table-hover" style="width:100%;color:black">
<th style="background-color:;color:;">
  Topic
</th>
<th style="background-color:;color:;">
  Details
</th>
<tr>
  <th width="50%"><p>Interest</p></th>

  <td ><input type="text" name="interest" class="form-control" value="{{$l->interest}}" /> </td>

</tr>
<tr>
  <th width="50%"><p>Relation</p></th>

  <td ><input type="text" name="relation" class="form-control" value="{{$l->relation}}" /> </td>

</tr>

<tr>
  <th width="50%"><p>Last Contact Date </p></th>
  <td ><input  name="last_contact_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->last_contact_date}}" /> </td>

</tr>
<tr>
  <th width="50%"><p>Re-Contact Date </p></th>

  <td ><input type="text" name="re_contact_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->re_contact_date}}" /> </td>

</tr>
<tr>
  <th width="50%"><p>Re-Contact Time</p></th>

  <td ><input type="text" name="re_contact_time" class="form-control timepicker" value="{{$l->re_contact_time}}" /> </td>
  <script type="text/javascript">

      $('.timepicker').datetimepicker({

          format: 'HH:mm:ss'

      });

  </script>
</tr>
<tr>
  <th width="50%"><p>Meeting Date</p></th>

  <td ><input type="text" name="meeting_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->meeting_date}}" /> </td>

</tr>
<tr>
  <th width="50%"><p>Meeting Time</p></th>

  <td ><input type="text" name="meeting_time" class="form-control timepicker" value="{{$l->meeting_time}}" /> </td>
  <script type="text/javascript">

      $('.timepicker').datetimepicker({

          format: 'HH:mm:ss'

      });

  </script>
</tr>
<tr>
  <th width="50%"><p>Meeting Location</p></th>

  <td ><input type="text" name="meeting_location" class="form-control" value="{{$l->meeting_location}}" /> </td>

</tr>


<tr>
  <th width="50%"><p>Note</p></th>
  <td ><textarea type="text" name="note" class="form-control">{{$l->note}}</textarea> </td>
</tr>

<tr>
  <th width="50%"><p>Assign To</p></th>
  <td >


        <select class="form-control " id="dsds" name="refered">
          <option></option>
          @foreach($ref as $r)
          <option value="{{$r->id}}" {{$r->id == $l->refered ? 'selected' : ''}}>{{$r->public_name}}</option>
          @endforeach
  </select>
</td>
</tr>


<th style="background-color:;color:;">
Topic
</th>
<th style="background-color:;color:;">
Details
</th>



</table>

  </div>
  <div class="modal-footer" style="background-color:#00325d;color:white;">
    <button type="submit" class="btn btn-default" >Save</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

  </div>
</div>
</form>
</div>
</div>

              </td>

              </tr>
              @else
              @endif
              @endforeach
              @foreach ($meetingdatenear as $num =>$l)
              <tr title="Meeting Date Nearly"style="background-color:yellow; color:black"role="row" class="odd">

              <td >{{++$i}}</td>
              <td>{{$l->regis_date}} {{$l->regis_time}}</td>
              <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
                <option value="{{$l->priority}}" >{{$l->priority}}</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/1" >1</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/2" >2</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/3" >3</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/4" >4</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/5" >5</option>
              </select></td>
              <td>{{ $l->name }} {{ $l->lname }}</td>
              <td>{{ $l->mobile }}</td>
              <td>{{ $l->email }}</td>
              <td><select style="color:black" class=" department nameid" name="regis_default_status" onchange="window.location.href=this.value;">

                <option value="" ></option>
                @foreach ($leadstatus as $sta)
                    <option value="/prospect/status/{{$l->id}}/{{$sta->id}}"{{$sta->id == $l->status ? 'selected' : ''}}>{{$sta->name}}</option>
                @endforeach

              </select>
              </td>
              <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
              <option value="{{$l->priority}}" >{{$l->type}}</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Personal" >Personal</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Refered" >Refered</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Office" >Office</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Special" >Special</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Partner" >Partner</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Event" >Event</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Cold-Calling" >Cold-Calling</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Target_Group" >Target_Group</option>

              </select></td>
              <td>{{ $l->assign_from_center }}</td>

              <td>


              <!-- Trigger the modal with a button -->
              <form class="row" method="POST" action="{{ route('prospectadmin.destroy', ['id' => $l->id]) }}" onsubmit = "return confirm('Are you sure?')">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $l->id }}">More Details</button>
              {{--<a href="/convert/prospectadmin/=name={{ $l->name }}=name=lname={{ $l->lname }}=lname==nickname={{ $l->nickname }}=nickname==email={{ $l->email }}=email==mobile={{ $l->mobile }}=mobile==lastcondate={{ date('d-m-Y', strtotime($l->last_contact_date)) }}=lastcondate==recondate={{ date('d-m-Y', strtotime($l->re_contact_date)) }}=recondate==recontime={{ $l->re_contact_time }}=recontime==meetdate={{  date('d-m-Y', strtotime($l->meeting_date)) }}=meetdate==meettime={{ $l->meeting_time }}=meettime==meetlocation={{ $l->meeting_location }}=meetlocation==leadnote={{ $l->note }}=leadnote=" class="btn btn-success btn-margin">Convert to lead</a>--}}
              <!-- Modal -->
              <button type="submit" class="btn btn-danger  btn-margin">
              Delete
              </button>
              </form>
              <div class="modal fade" id="myModal{{ $l->id }}" role="dialog">
              <div class="modal-dialog">

              <!-- Modal content-->
              <form class="form-horizontal" role="form" method="POST" action="{{ route('prospectadmin.update', ['id' =>  $l->id]) }}">
              <input type="hidden" name="_method" value="PATCH">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="modal-content">
              <div class="modal-header" style="background-color:#00325d;color:white;">
              <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
              <h4 class="modal-title">ข้อมูล {{$l->name}}</h4>
              </div>
              <div class="modal-body">

              <table class="table table-bordered table-hover" style="width:100%;color:black">
              <th style="background-color:;color:;">
              Topic
              </th>
              <th style="background-color:;color:;">
              Details
              </th>
              <tr>
              <th width="50%"><p>Interest</p></th>

              <td ><input type="text" name="interest" class="form-control" value="{{$l->interest}}" /> </td>

              </tr>
              <tr>
              <th width="50%"><p>Relation</p></th>

              <td ><input type="text" name="relation" class="form-control" value="{{$l->relation}}" /> </td>

              </tr>

              <tr>
              <th width="50%"><p>Last Contact Date </p></th>
              <td ><input  name="last_contact_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->last_contact_date}}" /> </td>

              </tr>
              <tr>
              <th width="50%"><p>Re-Contact Date </p></th>

              <td ><input type="text" name="re_contact_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->re_contact_date}}" /> </td>

              </tr>
              <tr>
              <th width="50%"><p>Re-Contact Time</p></th>

              <td ><input type="text" name="re_contact_time" class="form-control timepicker" value="{{$l->re_contact_time}}" /> </td>
              <script type="text/javascript">

              $('.timepicker').datetimepicker({

              format: 'HH:mm:ss'

              });

              </script>
              </tr>
              <tr>
              <th width="50%"><p>Meeting Date</p></th>

              <td ><input type="text" name="meeting_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->meeting_date}}" /> </td>

              </tr>
              <tr>
              <th width="50%"><p>Meeting Time</p></th>

              <td ><input type="text" name="meeting_time" class="form-control timepicker" value="{{$l->meeting_time}}" /> </td>
              <script type="text/javascript">

              $('.timepicker').datetimepicker({

              format: 'HH:mm:ss'

              });

              </script>
              </tr>
              <tr>
              <th width="50%"><p>Meeting Location</p></th>

              <td ><input type="text" name="meeting_location" class="form-control" value="{{$l->meeting_location}}" /> </td>

              </tr>


              <tr>
              <th width="50%"><p>Note</p></th>
              <td ><textarea type="text" name="note" class="form-control">{{$l->note}}</textarea> </td>
              </tr>

              <tr>
              <th width="50%"><p>Assign To</p></th>
              <td >


              <select class="form-control " id="dsds" name="refered">
              <option></option>
              @foreach($ref as $r)
              <option value="{{$r->id}}" {{$r->id == $l->refered ? 'selected' : ''}}>{{$r->public_name}}</option>
              @endforeach
              </select>
              </td>
              </tr>


              <th style="background-color:;color:;">
              Topic
              </th>
              <th style="background-color:;color:;">
              Details
              </th>



              </table>

              </div>
              <div class="modal-footer" style="background-color:#00325d;color:white;">
              <button type="submit" class="btn btn-default" >Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

              </div>
              </div>
              </form>
              </div>
              </div>

              </td>
              </tr>
              @endforeach
              @foreach ($meetingdatecurrent as $num =>$l)
              <tr title="Meeting Date Arrived"style="background-color:green; color:white"role="row" class="odd">

            <td >{{++$i}}</td>
            <td>{{$l->regis_date}} {{$l->regis_time}}</td>
            <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
                <option value="{{$l->priority}}" >{{$l->priority}}</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/1" >1</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/2" >2</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/3" >3</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/4" >4</option>
                <option value="/admin/prospectadmin/priority/{{$l->id}}/5" >5</option>
            </select></td>
            <td>{{ $l->name }} {{ $l->lname }}</td>
            <td>{{ $l->mobile }}</td>
            <td>{{ $l->email }}</td>
            <td><select style="color:black" class=" department nameid" name="regis_default_status" onchange="window.location.href=this.value;">

                <option value="" ></option>
                @foreach ($leadstatus as $sta)
                    <option value="/admin/prospectadmin/status/{{$l->id}}/{{$sta->id}}"{{$sta->id == $l->status ? 'selected' : ''}}>{{$sta->name}}</option>
                @endforeach

            </select>
          </td>
          <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
              <option value="{{$l->priority}}" >{{$l->type}}</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Personal" >Personal</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Refered" >Refered</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Office" >Office</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Special" >Special</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Partner" >Partner</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Event" >Event</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Cold-Calling" >Cold-Calling</option>
              <option value="/admin/prospectadmin/type/{{$l->id}}/Target_Group" >Target_Group</option>

          </select></td>
          <td>{{ $l->assign_from_center }}</td>

          <td>


<!-- Trigger the modal with a button -->
<form class="row" method="POST" action="{{ route('prospectadmin.destroy', ['id' => $l->id]) }}" onsubmit = "return confirm('Are you sure?')">
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="_token" valueprospectadminprospectadminprospectadmin="{{ csrf_token() }}">
<button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $l->id }}">More Details</button>
          {{--<a href="/convert/prospectadmin/=name={{ $l->name }}=name=lname={{ $l->lname }}=lname==nickname={{ $l->nickname }}=nickname==email={{ $l->email }}=email==mobile={{ $l->mobile }}=mobile==lastcondate={{ date('d-m-Y', strtotime($l->last_contact_date)) }}=lastcondate==recondate={{ date('d-m-Y', strtotime($l->re_contact_date)) }}=recondate==recontime={{ $l->re_contact_time }}=recontime==meetdate={{  date('d-m-Y', strtotime($l->meeting_date)) }}=meetdate==meettime={{ $l->meeting_time }}=meettime==meetlocation={{ $l->meeting_location }}=meetlocation==leadnote={{ $l->note }}=leadnote=" class="btn btn-success btn-margin">Convert to lead</a>--}}
<!-- Modal -->
<button type="submit" class="btn btn-danger  btn-margin">
Delete
</button>
</form>
<div class="modal fade" id="myModal{{ $l->id }}" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<form class="form-horizontal" role="form" method="POST" action="{{ route('prospectadmin.update', ['id' =>  $l->id]) }}">
<input type="hidden" name="_method" value="PATCH">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="modal-content">
<div class="modal-header" style="background-color:#00325d;color:white;">
<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
<h4 class="modal-title">ข้อมูล {{$l->name}}</h4>
</div>
<div class="modal-body">

<table class="table table-bordered table-hover" style="width:100%;color:black">
<th style="background-color:;color:;">
Topic
</th>
<th style="background-color:;color:;">
Details
</th>
<tr>
<th width="50%"><p>Interest</p></th>

<td ><input type="text" name="interest" class="form-control" value="{{$l->interest}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Relation</p></th>

<td ><input type="text" name="relation" class="form-control" value="{{$l->relation}}" /> </td>

</tr>

<tr>
<th width="50%"><p>Last Contact Date </p></th>
<td ><input  name="last_contact_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->last_contact_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Re-Contact Date </p></th>

<td ><input type="text" name="re_contact_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->re_contact_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Re-Contact Time</p></th>

<td ><input type="text" name="re_contact_time" class="form-control timepicker" value="{{$l->re_contact_time}}" /> </td>
<script type="text/javascript">

  $('.timepicker').datetimepicker({

      format: 'HH:mm:ss'

  });

</script>
</tr>
<tr>
<th width="50%"><p>Meeting Date</p></th>

<td ><input type="text" name="meeting_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->meeting_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Meeting Time</p></th>

<td ><input type="text" name="meeting_time" class="form-control timepicker" value="{{$l->meeting_time}}" /> </td>
<script type="text/javascript">

  $('.timepicker').datetimepicker({

      format: 'HH:mm:ss'

  });

</script>
</tr>
<tr>
<th width="50%"><p>Meeting Location</p></th>

<td ><input type="text" name="meeting_location" class="form-control" value="{{$l->meeting_location}}" /> </td>

</tr>


<tr>
<th width="50%"><p>Note</p></th>
<td ><textarea type="text" name="note" class="form-control">{{$l->note}}</textarea> </td>
</tr>

<tr>
<th width="50%"><p>Assign To</p></th>
<td >


    <select class="form-control " id="dsds" name="refered">
      <option></option>
      @foreach($ref as $r)
      <option value="{{$r->id}}" {{$r->id == $l->refered ? 'selected' : ''}}>{{$r->public_name}}</option>
      @endforeach
</select>
</td>
</tr>


<th style="background-color:;color:;">
Topic
</th>
<th style="background-color:;color:;">
Details
</th>



</table>

</div>
<div class="modal-footer" style="background-color:#00325d;color:white;">
<button type="submit" class="btn btn-default" >Save</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</form>
</div>
</div>

          </td>
        </tr>
        @endforeach


        @foreach ($recontactcurrent as $num =>$l)
        <tr title="Re-Contact Date Arrived"style="background-color:green; color:white"role="row" class="odd">

      <td >{{++$i}}</td>
      <td>{{$l->regis_date}} {{$l->regis_time}}</td>
      <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
          <option value="{{$l->priority}}" >{{$l->priority}}</option>
          <option value="/admin/prospectadminprospectadminprospectadmin/priority/{{$l->id}}/1" >1</option>
          <option value="/admin/prospectadminprospectadminprospectadmin/priority/{{$l->id}}/2" >2</option>
          <option value="/admin/prospectadminprospectadminprospectadmin/priority/{{$l->id}}/3" >3</option>
          <option value="/admin/prospectadminprospectadminprospectadmin/priority/{{$l->id}}/4" >4</option>
          <option value="/admin/prospectadminprospectadminprospectadmin/priority/{{$l->id}}/5" >5</option>
      </select></td>
      <td>{{ $l->name }} {{ $l->lname }}</td>
      <td>{{ $l->mobile }}</td>
      <td>{{ $l->email }}</td>
      <td><select style="color:black" class=" department nameid" name="regis_default_status" onchange="window.location.href=this.value;">

          <option value="" ></option>
          @foreach ($leadstatus as $sta)
              <option value="/prospectadminprospectadminprospectadmin/status/{{$l->id}}/{{$sta->id}}"{{$sta->id == $l->status ? 'selected' : ''}}>{{$sta->name}}</option>
          @endforeach

      </select>
    </td>
    <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
        <option value="{{$l->priority}}" >{{$l->type}}</option>
        <option value="/admin/prospectadminprospectadmin/type/{{$l->id}}/Personal" >Personal</option>
        <option value="/admin/prospectadminprospectadmin/type/{{$l->id}}/Refered" >Refered</option>
        <option value="/admin/prospectadminprospectadmin/type/{{$l->id}}/Office" >Office</option>
        <option value="/admin/prospectadminprospectadmin/type/{{$l->id}}/Special" >Special</option>
        <option value="/admin/prospectadminprospectadmin/type/{{$l->id}}/Partner" >Partner</option>
        <option value="/admin/prospectadminprospectadmin/type/{{$l->id}}/Event" >Event</option>
        <option value="/admin/prospectadminprospectadmin/type/{{$l->id}}/Cold-Calling" >Cold-Calling</option>
        <option value="/admin/prospectadminprospectadmin/type/{{$l->id}}/Target_Group" >Target_Group</option>

    </select></td>
    <td>{{ $l->assign_from_center }}</td>

    <td>


<!-- Trigger the modal with a button -->
<form class="row" method="POST" action="{{ route('prospectadmin.destroy', ['id' => $l->id]) }}" onsubmit = "return confirm('Are you sure?')">
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $l->id }}">More Details</button>
    {{--<a href="/convert/prospectadmin/=name={{ $l->name }}=name=lname={{ $l->lname }}=lname==nickname={{ $l->nickname }}=nickname==email={{ $l->email }}=email==mobile={{ $l->mobile }}=mobile==lastcondate={{ date('d-m-Y', strtotime($l->last_contact_date)) }}=lastcondate==recondate={{ date('d-m-Y', strtotime($l->re_contact_date)) }}=recondate==recontime={{ $l->re_contact_time }}=recontime==meetdate={{  date('d-m-Y', strtotime($l->meeting_date)) }}=meetdate==meettime={{ $l->meeting_time }}=meettime==meetlocation={{ $l->meeting_location }}=meetlocation==leadnote={{ $l->note }}=leadnote=" class="btn btn-success btn-margin">Convert to lead</a>--}}
<!-- Modal -->
<button type="submit" class="btn btn-danger  btn-margin">
Delete
</button>
</form>
<div class="modal fade" id="myModal{{ $l->id }}" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<form class="form-horizontal" role="form" method="POST" action="{{ route('prospectadmin.update', ['id' =>  $l->id]) }}">
<input type="hidden" name="_method" value="PATCH">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="modal-content">
<div class="modal-header" style="background-color:#00325d;color:white;">
<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
<h4 class="modal-title">ข้อมูล {{$l->name}}</h4>
</div>
<div class="modal-body">

<table class="table table-bordered table-hover" style="width:100%;color:black">
<th style="background-color:;color:;">
Topic
</th>
<th style="background-color:;color:;">
Details
</th>
<tr>
<th width="50%"><p>Interest</p></th>

<td ><input type="text" name="interest" class="form-control" value="{{$l->interest}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Relation</p></th>

<td ><input type="text" name="relation" class="form-control" value="{{$l->relation}}" /> </td>

</tr>

<tr>
<th width="50%"><p>Last Contact Date </p></th>
<td ><input  name="last_contact_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->last_contact_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Re-Contact Date </p></th>

<td ><input type="text" name="re_contact_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->re_contact_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Re-Contact Time</p></th>

<td ><input type="text" name="re_contact_time" class="form-control timepicker" value="{{$l->re_contact_time}}" /> </td>
<script type="text/javascript">

$('.timepicker').datetimepicker({

format: 'HH:mm:ss'

});

</script>
</tr>
<tr>
<th width="50%"><p>Meeting Date</p></th>

<td ><input type="text" name="meeting_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->meeting_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Meeting Time</p></th>

<td ><input type="text" name="meeting_time" class="form-control timepicker" value="{{$l->meeting_time}}" /> </td>
<script type="text/javascript">

$('.timepicker').datetimepicker({

format: 'HH:mm:ss'

});

</script>
</tr>
<tr>
<th width="50%"><p>Meeting Location</p></th>

<td ><input type="text" name="meeting_location" class="form-control" value="{{$l->meeting_location}}" /> </td>

</tr>


<tr>
<th width="50%"><p>Note</p></th>
<td ><textarea type="text" name="note" class="form-control">{{$l->note}}</textarea> </td>
</tr>

<tr>
<th width="50%"><p>Assign To</p></th>
<td >


<select class="form-control " id="dsds" name="refered">
<option></option>
@foreach($ref as $r)
<option value="{{$r->id}}" {{$r->id == $l->refered ? 'selected' : ''}}>{{$r->public_name}}</option>
@endforeach
</select>
</td>
</tr>


<th style="background-color:;color:;">
Topic
</th>
<th style="background-color:;color:;">
Details
</th>



</table>

</div>
<div class="modal-footer" style="background-color:#00325d;color:white;">
<button type="submit" class="btn btn-default" >Save</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</form>
</div>
</div>

    </td>
  </tr>
  @endforeach

        @foreach ($recontact as $num =>$l)
        <tr title="Nearly Re-Contact Date"style="background-color:yellow; "role="row" class="odd">

      <td >{{++$i}}</td>
      <td>{{$l->regis_date}} {{$l->regis_time}}</td>
      <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
          <option value="{{$l->priority}}" >{{$l->priority}}</option>
          <option value="/admin/prospectadmin/priority/{{$l->id}}/1" >1</option>
          <option value="/admin/prospectadmin/priority/{{$l->id}}/2" >2</option>
          <option value="/admin/prospectadmin/priority/{{$l->id}}/3" >3</option>
          <option value="/admin/prospectadmin/priority/{{$l->id}}/4" >4</option>
          <option value="/admin/prospectadmin/priority/{{$l->id}}/5" >5</option>
      </select></td>
      <td>{{ $l->name }} {{ $l->lname }}</td>
      <td>{{ $l->mobile }}</td>
      <td>{{ $l->email }}</td>
      <td><select style="color:black" class=" department nameid" name="regis_default_status" onchange="window.location.href=this.value;">

          <option value="" ></option>
          @foreach ($leadstatus as $sta)
              <option value="/admin/prospectadmin/status/{{$l->id}}/{{$sta->id}}"{{$sta->id == $l->status ? 'selected' : ''}}>{{$sta->name}}</option>
          @endforeach

      </select>
    </td>
    <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
        <option value="{{$l->priority}}" >{{$l->type}}</option>
        <option value="/admin/prospectadmin/type/{{$l->id}}/Personal" >Personal</option>
        <option value="/admin/prospectadmin/type/{{$l->id}}/Refered" >Refered</option>
        <option value="/admin/prospectadmin/type/{{$l->id}}/Office" >Office</option>
        <option value="/admin/prospectadmin/type/{{$l->id}}/Special" >Special</option>
        <option value="/admin/prospectadmin/type/{{$l->id}}/Partner" >Partner</option>
        <option value="/admin/prospectadmin/type/{{$l->id}}/Event" >Event</option>
        <option value="/admin/prospectadmin/type/{{$l->id}}/Cold-Calling" >Cold-Calling</option>
        <option value="/admin/prospectadmin/type/{{$l->id}}/Target_Group" >Target_Group</option>

    </select></td>
    <td>{{ $l->assign_from_center }}</td>

    <td>


<!-- Trigger the modal with a button -->
<form class="row" method="POST" action="{{ route('prospectadmin.destroy', ['id' => $l->id]) }}" onsubmit = "return confirm('Are you sure?')">
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $l->id }}">More Details</button>
    {{--<a href="/convert/prospectadmin/=name={{ $l->name }}=name=lname={{ $l->lname }}=lname==nickname={{ $l->nickname }}=nickname==email={{ $l->email }}=email==mobile={{ $l->mobile }}=mobile==lastcondate={{ date('d-m-Y', strtotime($l->last_contact_date)) }}=lastcondate==recondate={{ date('d-m-Y', strtotime($l->re_contact_date)) }}=recondate==recontime={{ $l->re_contact_time }}=recontime==meetdate={{  date('d-m-Y', strtotime($l->meeting_date)) }}=meetdate==meettime={{ $l->meeting_time }}=meettime==meetlocation={{ $l->meeting_location }}=meetlocation==leadnote={{ $l->note }}=leadnote=" class="btn btn-success btn-margin">Convert to lead</a>--}}
<!-- Modal -->
<button type="submit" class="btn btn-danger  btn-margin">
Delete
</button>
</form>
<div class="modal fade" id="myModal{{ $l->id }}" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<form class="form-horizontal" role="form" method="POST" action="{{ route('prospectadmin.update', ['id' =>  $l->id]) }}">
<input type="hidden" name="_method" value="PATCH">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="modal-content">
<div class="modal-header" style="background-color:#00325d;color:white;">
<button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
<h4 class="modal-title">ข้อมูล {{$l->name}}</h4>
</div>
<div class="modal-body">

<table class="table table-bordered table-hover" style="width:100%;color:black">
<th style="background-color:;color:;">
Topic
</th>
<th style="background-color:;color:;">
Details
</th>
<tr>
<th width="50%"><p>Interest</p></th>

<td ><input type="text" name="interest" class="form-control" value="{{$l->interest}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Relation</p></th>

<td ><input type="text" name="relation" class="form-control" value="{{$l->relation}}" /> </td>

</tr>

<tr>
<th width="50%"><p>Last Contact Date </p></th>
<td ><input  name="last_contact_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->last_contact_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Re-Contact Date </p></th>

<td ><input type="text" name="re_contact_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->re_contact_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Re-Contact Time</p></th>

<td ><input type="text" name="re_contact_time" class="form-control timepicker" value="{{$l->re_contact_time}}" /> </td>
<script type="text/javascript">

$('.timepicker').datetimepicker({

format: 'HH:mm:ss'

});

</script>
</tr>
<tr>
<th width="50%"><p>Meeting Date</p></th>

<td ><input type="text" name="meeting_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->meeting_date}}" /> </td>

</tr>
<tr>
<th width="50%"><p>Meeting Time</p></th>

<td ><input type="text" name="meeting_time" class="form-control timepicker" value="{{$l->meeting_time}}" /> </td>
<script type="text/javascript">

$('.timepicker').datetimepicker({

format: 'HH:mm:ss'

});

</script>
</tr>
<tr>
<th width="50%"><p>Meeting Location</p></th>

<td ><input type="text" name="meeting_location" class="form-control" value="{{$l->meeting_location}}" /> </td>

</tr>


<tr>
<th width="50%"><p>Note</p></th>
<td ><textarea type="text" name="note" class="form-control">{{$l->note}}</textarea> </td>
</tr>

<tr>
<th width="50%"><p>Assign To</p></th>
<td >


<select class="form-control " id="dsds" name="refered">
<option></option>
@foreach($ref as $r)
<option value="{{$r->id}}" {{$r->id == $l->refered ? 'selected' : ''}}>{{$r->public_name}}</option>
@endforeach
</select>
</td>
</tr>


<th style="background-color:;color:;">
Topic
</th>
<th style="background-color:;color:;">
Details
</th>



</table>

</div>
<div class="modal-footer" style="background-color:#00325d;color:white;">
<button type="submit" class="btn btn-default" >Save</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>
</form>
</div>
</div>

    </td>

  </tr>
  @endforeach


            </tbody>
            <tfoot>
              <tr>
                <th width="1%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No.</th>
                <th width="12%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Register Time </th>
                <th width="5%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Priority</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Phone</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Email</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Status</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Assign</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Action</th>

              </tr>
              <tr role="row">

              <th  colspan="10"  style=" font-size:20px;color:white;background-color:#00325d;"> Urgent</th>
              </tr>
            </tfoot>
          </table>

<br />
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="1%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No.</th>
                <th width="12%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Register Time </th>
                <th width="5%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Priority</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Phone</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Email</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Status</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Assign</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Action</th>

              </tr>
            </thead>
            <tbody>
            @foreach ($prospect as $num =>$l)
                  <td >{{++$i2}}</td>
                  <td>{{$l->regis_date}} {{$l->regis_time}}</td>
                  <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
                      <option value="{{$l->priority}}" >{{$l->priority}}</option>
                      <option value="/admin/prospectadmin/priority/{{$l->id}}/1" >1</option>
                      <option value="/admin/prospectadmin/priority/{{$l->id}}/2" >2</option>
                      <option value="/admin/prospectadmin/priority/{{$l->id}}/3" >3</option>
                      <option value="/admin/prospectadmin/priority/{{$l->id}}/4" >4</option>
                      <option value="/admin/prospectadmin/priority/{{$l->id}}/5" >5</option>
                  </select></td>
                  <td>{{ $l->name }} {{ $l->lname }}</td>
                  <td>{{ $l->mobile }}</td>
                  <td>{{ $l->email }}</td>
                  <td><select style="color:black" class=" department nameid" name="regis_default_status" onchange="window.location.href=this.value;">

                      <option value="" ></option>
                      @foreach ($leadstatus as $sta)
                          <option value="/admin/prospectadmin/status/{{$l->id}}/{{$sta->id}}"{{$sta->id == $l->status ? 'selected' : ''}}>{{$sta->name}}</option>
                      @endforeach

                  </select>

                </td>
                <td><select style="color:black" class="  department nameid" name="regis_default_status" onchange="window.location.href=this.value;">
                    <option value="{{$l->priority}}" >{{$l->type}}</option>
                    <option value="/admin/prospectadmin/type/{{$l->id}}/Personal" >Personal</option>
                    <option value="/admin/prospectadmin/type/{{$l->id}}/Refered" >Refered</option>
                    <option value="/admin/prospectadmin/type/{{$l->id}}/Office" >Office</option>
                    <option value="/admin/prospectadmin/type/{{$l->id}}/Special" >Special</option>
                    <option value="/admin/prospectadmin/type/{{$l->id}}/Partner" >Partner</option>
                    <option value="/admin/prospectadmin/type/{{$l->id}}/Event" >Event</option>
                    <option value="/admin/prospectadmin/type/{{$l->id}}/Cold-Calling" >Cold-Calling</option>
                    <option value="/admin/prospectadmin/type/{{$l->id}}/Target_Group" >Target_Group</option>

                </select></td>
                @if($l->assign_from_center < 0)
                <td style="background-color:red;color:white">{{ $l->assign_from_center }}</td>
                @else
                <td>{{ $l->assign_from_center }}</td>
                @endif
                  <td>


<!-- Trigger the modal with a button -->
<form class="row" method="POST" action="{{ route('prospectadmin.destroy', ['id' => $l->id]) }}" onsubmit = "return confirm('Are you sure?')">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
<button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $l->id }}">More Details</button>
                  {{--<a href="/convert/prospectadmin/=name={{ $l->name }}=name=lname={{ $l->lname }}=lname==nickname={{ $l->nickname }}=nickname==email={{ $l->email }}=email==mobile={{ $l->mobile }}=mobile==lastcondate={{ date('d-m-Y', strtotime($l->last_contact_date)) }}=lastcondate==recondate={{ date('d-m-Y', strtotime($l->re_contact_date)) }}=recondate==recontime={{ $l->re_contact_time }}=recontime==meetdate={{  date('d-m-Y', strtotime($l->meeting_date)) }}=meetdate==meettime={{ $l->meeting_time }}=meettime==meetlocation={{ $l->meeting_location }}=meetlocation==leadnote={{ $l->note }}=leadnote=" class="btn btn-success btn-margin">Convert to lead</a>--}}
<!-- Modal -->
<button type="submit" class="btn btn-danger  btn-margin">
  Delete
</button>
</form>
<div class="modal fade" id="myModal{{ $l->id }}" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form class="form-horizontal" role="form" method="POST" action="{{ route('prospectadmin.update', ['id' =>  $l->id]) }}">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#00325d;color:white;">
        <button type="button" class="close" data-dismiss="modal" style="color:white;">&times;</button>
        <h4 class="modal-title">ข้อมูล {{$l->name}}</h4>
      </div>
      <div class="modal-body">

        <table class="table table-bordered table-hover" style="width:100%;color:black">
    <th style="background-color:;color:;">
      Topic
    </th>
    <th style="background-color:;color:;">
      Details
    </th>
    <tr>
      <th width="50%"><p>Interest</p></th>

      <td ><input type="text" name="interest" class="form-control" value="{{$l->interest}}" /> </td>

    </tr>
    <tr>
      <th width="50%"><p>Relation</p></th>

      <td ><input type="text" name="relation" class="form-control" value="{{$l->relation}}" /> </td>

    </tr>

    <tr>
      <th width="50%"><p>Last Contact Date </p></th>
      <td ><input  name="last_contact_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->last_contact_date}}" /> </td>

    </tr>
    <tr>
      <th width="50%"><p>Re-Contact Date </p></th>

      <td ><input type="text" name="re_contact_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->re_contact_date}}" /> </td>

    </tr>
    <tr>
      <th width="50%"><p>Re-Contact Time</p></th>

      <td ><input type="text" name="re_contact_time" class="form-control timepicker" value="{{$l->re_contact_time}}" /> </td>
      <script type="text/javascript">

          $('.timepicker').datetimepicker({

              format: 'HH:mm:ss'

          });

      </script>
    </tr>
    <tr>
      <th width="50%"><p>Meeting Date</p></th>

      <td ><input type="text" name="meeting_date" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" value="{{$l->meeting_date}}" /> </td>

    </tr>
    <tr>
      <th width="50%"><p>Meeting Time</p></th>

      <td ><input type="text" name="meeting_time" class="form-control timepicker" value="{{$l->meeting_time}}" /> </td>
      <script type="text/javascript">

          $('.timepicker').datetimepicker({

              format: 'HH:mm:ss'

          });

      </script>
    </tr>
    <tr>
      <th width="50%"><p>Meeting Location</p></th>

      <td ><input type="text" name="meeting_location" class="form-control" value="{{$l->meeting_location}}" /> </td>

    </tr>


    <tr>
      <th width="50%"><p>Note</p></th>
      <td ><textarea type="text" name="note" class="form-control">{{$l->note}}</textarea> </td>
    </tr>

    <tr>
      <th width="50%"><p>Assign To</p></th>
      <td >


            <select class="form-control " id="dsds" name="refered">
              <option></option>
              @foreach($ref as $r)
              <option value="{{$r->id}}" {{$r->id == $l->refered ? 'selected' : ''}}>{{$r->public_name}}</option>
              @endforeach
      </select>
    </td>
    </tr>


  <th style="background-color:;color:;">
    Topic
  </th>
  <th style="background-color:;color:;">
    Details
  </th>



</table>

      </div>
      <div class="modal-footer" style="background-color:#00325d;color:white;">
        <button type="submit" class="btn btn-default" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
</form>
  </div>
</div>

                  </td>

              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="1%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No.</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Register Time</th>
                <th width="5%"  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Priority</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Name</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Phone</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Email</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Status</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Assign</th>
                <th width=""  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Action</th>

              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($prospect)}} of {{count($prospect)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $prospect->links() }}
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

  <script type="text/javascript">

        $("#dsds").select2({
              placeholder: "Select a Name",
              allowClear: true
          });
  </script>
@endsection
