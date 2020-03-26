@extends('system-mgmt.portorgauth.base')
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

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div  class="dataTables_wrapper form-inline dt-bootstrap">

      <div class="form-group">
        <div class="col-sm-12">



          <form class="form-horizontal" role="form" method="POST" action="{{ route('portorgauth.store') }}">
              {{ csrf_field() }}
              <div style="overflow-x:auto;">

              {{--}}  <input list="browsers" name="browser">
  <datalist style="display:none;" id="browsers">
    @foreach ($users as $structure)
    <option style="display:none;" data-value="{{$structure->id}}" value="{{$structure->email}}">
  @endforeach

</datalist>--}}
                  <div class="input-group control-group increment" >
                  <table  class="table table-bordered " >
                      <thead>
                      <tr role="row">
                  <th width="" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">port</th>
                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Organize</th>


                          <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>


                          <th style="text-align:center;backgroung:#eee"><div class="input-group-btn">
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                          </div></th>
                        </tr>
                      </thead>
                      <tbody>
                        {{$userauths}}

                          <tr>





                            <td><select class=" form-control " name="port_id[]" id="nameid2">

                                
                                @foreach ($structures as $structure)
                                    <option value="{{$structure->id}}"> {{$structure->number}}  {{$structure->type}} {{$structure->port_name}} {{$structure->structure_name}} {{$structure->block_name}}</option>
                                @endforeach
								<option value="">-No Sharing-</option>
                            </select>{{--}}{{ $userauth->organize_name }}--}}</td>

                            <td><div class="col-md-6"><select class=" form-control " name="org_id[]" id="nameid2">
                              @foreach ($orgs as $org)
                              

                                    <option value="{{$org->id}}"> {{$org->name}}  </option>
                                @endforeach

                            </select>{{--}}{{ $userauth->organize_name }}--}}</div></td>



                            <td ><input type="text" name="description[]" class="form-control description"></td>
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
                    <div class="control-group input-group" style="margin-top:10px">
                        <table  class="table table-bordered " >

                          <tbody>
                            {{$userauths}}

                              <tr role="row">

                                <td><select class=" form-control " name="port_id[]" id="nameid2">

                                    <option value=""></option>
                                    @foreach ($structures as $structure)
                                        <option value="{{$structure->id}}"> {{$structure->number}}  {{$structure->type}} {{$structure->port_name}} {{$structure->structure_name}} {{$structure->block_name}}</option>
                                    @endforeach
								
                                </select>{{--}}{{ $userauth->organize_name }}--}}</td>

                                <td><div class="col-md-6"><select class=" form-control " name="org_id[]" id="nameid2">

                                    <option value="" >-Select-</option>
                                    @foreach ($orgs as $org)
                                        <option value="{{$org->id}}"> {{$org->name}}  </option>
                                    @endforeach
						
                                </select>{{--}}{{ $userauth->organize_name }}--}}</div></td>



                                <td ><input type="text" name="description[]" class="form-control member_id"></td>
                                <td> <div class="input-group-btn">
                                  <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                </div>
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
                  </div>
	




                </div>

                <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
          </form>


          <br>
          <br>
          <BR>



			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Organize</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">port</th>

                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Description</th>

                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
              {{$userauths}}
            @foreach ($userauths as $userauth)
                <tr role="row" class="odd">


                  <td>{{ $userauth->organize_name }}</td>
                  <td>{{ $userauth->port_name }}</td>


                  <td>{{ $userauth->description}}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('portorgauth.destroy', ['id' => $userauth->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button class="btn btn-danger btn-margin" ><i class="glyphicon glyphicon-remove"></i>Remove </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Organize</th>
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


    </section>
    <!-- /.content -->

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
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

  <script type="text/javascript">

        $("#nameid").select2({
              placeholder: "Select a Name",
              allowClear: true
          });
  </script>

@endsection
