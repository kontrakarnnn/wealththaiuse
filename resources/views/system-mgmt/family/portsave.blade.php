@extends('person.base')
@section('action-content')
    <!-- Content Header (Page header) -->
    <section class="content">


      <div class="box">



        <div style="overflow-x:auto;">
          <h3> My Port </h3>
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
                        {{ $u->number}}
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

                              <a class="btn btn-primary margin"href="{{ URL::to('/portfolio/showport/shows',$u->id)}}">
                                  Portfolio Detail
                                </a>
                                <a class="btn btn-info margin"href="{{ URL::to('person/port/asset',$u->id)}}">
                                    Portfolio Asset
                                  </a>

                                  <a style="width:"href="{{ URL::to('person/port-transaction',[$u->id])}}"
                                    class="btn btn-default  btn-margin">
                                  Portfolio Transaction
                                  </a>
                      <a class="btn btn-default margin"href="{{ URL::to('/note',$u->id)}}">
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
    </section>


          </div>
@endsection


  <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>

  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
       Both of these plugins are recommended to enhance the
       user experience. Slimscroll is required when using the
       fixed layout. -->
