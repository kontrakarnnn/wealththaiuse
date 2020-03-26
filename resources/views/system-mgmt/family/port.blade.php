@extends('system-mgmt.family.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Portfolio In Group</h3>
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
        <table class="table table-bordered table-hover dataTable" role="grid">

          <thead>
            <tr role="row">

              <th >No.</th>
              <th >Port Number</th>
              <th >Port Type</th>
              <th >Organization</th>
              <th >Department</th>
                   <th>Contact</th>
            <th >Shared By</th>
              <th >Service</th>





            </tr>
          </thead>
          <tbody>


            @foreach ($portingroup as $i => $u)
              <tr role="row" >


                <td>
                  {{ ++$i}}

                </td>

                <td>
                    {{ $u->number}}
                </td>
                <td>
                    {{ $u->port_type_name}}
                </td>
                <td>
                    {{ $u->structure_name}}
                </td>
                <td>
                    {{ $u->block_name}}
                </td>

                <td>
                      <a href="mailto: {{$u->contact_email}}" target="_top"><span class="fa fa-user" title="Login"> </span></a>  :<a href="mailto: {{$u->contact_email}}" target="_top">   {{ $u->contact_name}}</a><br>
                    <a href="tel: {{ $u->contact_tel}}" target="_top"> <span class="glyphicon glyphicon-phone-alt" title="Login"></span></a> :<a href="tel: {{ $u->contact_tel}}" target="_top">{{ $u->contact_tel}}</a><br>

                    <a href="mailto: {{$u->contact_email}}" target="_top"><span class="fa fa-envelope" title="Login"></span></a> :<a href="mailto: {{$u->contact_email}}" target="_top">{{ $u->contact_email}}</a>

                </td>
                <td>
                    {{ $u->creator}}  {{ $u->creatorl}}
                </td>

                <td>

                          <a class="btn btn-primary margin"href="{{ URL::to('/portfolio/showport/shows',$u->port_id)}}">
                              Portfolio Detail
                            </a>
                            <a class="btn btn-info margin"href="{{ URL::to('person/port/asset',$u->port_id)}}">
                                Portfolio Asset
                              </a>

                              <a style="width:"href="{{ URL::to('person/port-transaction',[$u->port_id])}}"
                                class="btn btn-default  btn-margin">
                              Portfolio Transaction
                              </a>
                  <a class="btn btn-default margin"href="{{ URL::to('/note',$u->port_id)}}">
                      Notebook
                    </a>
                    {{--}}a href="{{ $u->port_link}}" target="_blank">{{ $u->port_link}}</a>--}}

                </td>


              {{--  <td>

               <a class="btn btn-primary"href="/note/{{$u->id}}">Add Data</a>
                 <a class="btn btn-primary"href="{{ URL::to('/note',$u->id)}}">Add Data</a>
              </td>--}}
            </tr>

          @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th >No.</th>
              <th >Port Number</th>
              <th >Port Type</th>
                   <th >Organization</th>
              <th >Department</th>
       <th>Contact</th>
       <th >Shared By</th>
              <th >Service</th>
              {{--}}
              <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="User Name: activate to sort column ascending">Port Number</th>
              <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port type</th>
              <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Structure</th>
              <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Marketing</th>
              <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Service</th>--}}



              {{--<th width="12%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">No.</th>
              <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port Name</th>
              <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Port type</th>
              <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Structure</th>
              <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Block</th>
              <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>--}}



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
