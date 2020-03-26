@extends('system-mgmt.event.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">


        <div class="col-sm-8">
          <h3 class="box-title">Member In <b style="color:red;">{{$event->event_name}}</b> Event</h3>
        </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">

        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">



		<div style="overflow-x:auto;">

          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr>
                <th width="10%">No.</th>

                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Name Lastname</th>

              </tr>
            </thead>
            <tbody>








              @foreach(App\Person::where('event_id',$event->id)->get(); as $indexKey => $depList)
                <td width="10%">{{++$indexKey}}</td>
                <td width="10%">{{$depList->name}}  {{$depList->lname}}</td>


              @endforeach
            
            </tbody>
            <tfoot>
              <tr>
                <th width="10%">No.</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="event: activate to sort column ascending">Name Lastname</th>

              </tr>
            </tfoot>
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
  </div>

@endsection
