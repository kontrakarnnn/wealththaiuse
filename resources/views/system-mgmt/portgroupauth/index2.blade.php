@extends('system-mgmt.portauth.base')
@section('action-content')
    <!-- Main content -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of port Authentication</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('portauth.create') }}">Add New</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('portauth.search') }}">
         {{ csrf_field() }}
                @component('layouts.search', ['title' => 'Search'])

             <br>
           @component('layouts.two-cols-search-row', ['items' => ['member_name', 'port_name' ],
           'oldVals' => [isset($searchingVals) ? $searchingVals['member_name'] : '', isset($searchingVals) ? $searchingVals['port_name'] :'']])
           @endcomponent
              @endcomponent
      </form>
    <div  class="dataTables_wrapper form-inline dt-bootstrap">

      <div class="form-group">
        <div class="col-sm-12">

          <form class="form-horizontal" role="form" method="POST" action="{{ route('organizeauth.store') }}">
              {{ csrf_field() }}
              <div style="overflow-x:auto;">


                <div class="input-group control-group increment" >

                  <table  class="table table-bordered " >
                      <thead>
                        <tr >
                                              <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">port</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member</th>


                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>


                          <th style="text-align:center;backgroung:#eee">  <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button></th>
                        </tr>
                      </thead>
                      <tbody>
                        {{$userauths}}

                          <tr>

                            <td><select class=" form-control " name="port_id" id="nameid2">

                                <option value="" >-Select-</option>
                                @foreach ($structures as $structure)
                                    <option value="{{$structure->id}}"> {{$structure->number}}  {{$structure->type}} {{$structure->port_name}} {{$structure->structure_name}} {{$structure->block_name}}</option>
                                @endforeach

                            </select>{{--}}{{ $userauth->organize_name }}--}}</td>

                            <td><input type="text" name="member_id[]" class="form-control member_id"></td>



                            <td ><input type="text" name="member_id[]" class="form-control member_id"></td>
                            <td>
                              {{--<form class="row" method="POST" action="{{ route('portauth.destroy', ['id' => $userauths->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                  <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                    Delete
                                  </button>
                              </form>--}}
                            </td>

                        </tr>

                      </tbody>
                    </table>




                  </div>

                <div class="clone hide">
                  <div class="input-group-btn">
                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                  </div>
                  <table  class="table table-bordered " >
                      <thead>
                        <tr >
                                              <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">port</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member</th>


                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>


                          <th style="text-align:center;backgroung:#eee">  <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button></th>
                        </tr>
                      </thead>
                      <tbody>
                        {{$userauths}}

                          <tr>

                            <td><select class=" form-control " name="port_id" id="nameid2">

                                <option value="" >-Select-</option>
                                @foreach ($structures as $structure)
                                    <option value="{{$structure->id}}"> {{$structure->number}}  {{$structure->type}} {{$structure->port_name}} {{$structure->structure_name}} {{$structure->block_name}}</option>
                                @endforeach

                            </select>{{--}}{{ $userauth->organize_name }}--}}</td>

                            <td><input type="text" name="member_id[]" class="form-control member_id"></td>



                            <td ><input type="text" name="member_id[]" class="form-control member_id"></td>
                            <td> <a href="#"  class="btn btn-danger btn-sm remove"><i  class="glyphicon glyphicon-remove"></i> </a>
                              {{--<form class="row" method="POST" action="{{ route('portauth.destroy', ['id' => $userauths->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                  <input type="hidden" name="_method" value="DELETE">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                  <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                    Delete
                                  </button>
                              </form>--}}
                            </td>

                        </tr>

                      </tbody>
                    </table>
                </div>
            <table  class="table table-bordered " >
                <thead>
                  <tr >
                                        <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">port</th>
                    <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member</th>


                    <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>


                    <th style="text-align:center;backgroung:#eee"><a href="#" class"addRow"<i class="glyphicon glyphicon-plus"></i></a></th>
                  </tr>
                </thead>
                <tbody>
                  {{$userauths}}

                    <tr>

                      <td><select class=" form-control " name="port_id" id="nameid2">

                          <option value="" >-Select-</option>
                          @foreach ($structures as $structure)
                              <option value="{{$structure->id}}"> {{$structure->number}}  {{$structure->type}} {{$structure->port_name}} {{$structure->structure_name}} {{$structure->block_name}}</option>
                          @endforeach

                      </select>{{--}}{{ $userauth->organize_name }}--}}</td>

                      <td><input type="text" name="member_id[]" class="form-control member_id"></td>



                      <td ><input type="text" name="member_id[]" class="form-control member_id"></td>
                      <td> <a href="#"  class="btn btn-danger btn-sm remove"><i  class="glyphicon glyphicon-remove" </a>
                        {{--<form class="row" method="POST" action="{{ route('portauth.destroy', ['id' => $userauths->id]) }}" onsubmit = "return confirm('Are you sure?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                              Delete
                            </button>
                        </form>--}}
                      </td>

                  </tr>

                </tbody>
              </table>

                </div>
          </form>


          <br>
          <br>
          <BR>



			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">port</th>

                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              {{$userauths}}
            @foreach ($userauths as $userauth)
                <tr role="row" class="odd">


                  <td>{{ $userauth->member_name }}</td>
                  <td>{{ $userauth->organize_name }}</td>


                  <td>{{ $userauth->description}}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('portauth.destroy', ['id' => $userauth->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('portauth.edit', ['id' => $userauth->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Member</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">port</th>

                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($userauths)}} of {{count($userauths)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $userauths->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<div class="container">

  <h3 class="jumbotron">Laravel Multiple File Upload</h3>
<form method="post" action="{{url('file')}}" enctype="multipart/form-data">
{{csrf_field()}}



      <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

</form>
</div>

    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">

      $(document).ready(function() {

        $(".btn-success").click(function(){
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click",".btn-danger",function(){
            $(this).parents(".control-group").remove();
        });

      });

  </script>


@endsection
