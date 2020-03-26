@extends('system-mgmt.stage.base')
@section('action-content')
    <!-- Main content -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>


    /* Create two equal columns that floats next to each other */
    .column {
      float: left;
      width: 50%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }
    .columnnote {
      float: left;
      width: 100%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }
    .columnauth {
      float: left;
      width: 50%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }


    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .column {
        width: 100%;
      }
      .columnnote {
        width: 100%;
      }
      .columnauth {
        width: 100%;
      }
    }

    </style>

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Stage</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('stage.create') }}">Add new stage</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('stage.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <a href="#dd1">Back to point</a>


			<div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr>
                <th  width="1%">No.</th>
                  <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Stage Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Process</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">End Stage Flag</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Description</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $index => $da)
            <tr id="show{{$da->id}}" class=" ">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


          <script>
          $(document).ready(function(){
          $("#hide{{$da->id}}").click(function(){
          $("#dd{{$da->id}}").hide();
          });
          $("#show{{$da->id}}").click(function(){
          $("#dd{{$da->id}}").show();
          });
          });
          </script>
            <td>{{++$index}}</td>

                  <td>{{ $da->name }}</td>
                  @if($da->process_id == NULL || $da->process_id == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Process->name }}</td>
                  @endif
                  <td>{{ $da->end_stage_flag }}</td>
                  <td>{{ $da->description }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('stage.destroy', ['id' => $da->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('stage.edit', ['id' => $da->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th  width="1%">No.</th>

                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Stage Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Process</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">End Stage Flag</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Structure: activate to sort column ascending">Description</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </tfoot>
          </table>
          <p id="opening">Hyperlinks are utilized by a web browser to move from one page to another...</p>
			</div>
      <br />
      @foreach ($data as $da)
@if($da->id == $idcut )
<div id="dd{{$da->id}}" class="box " >
@elseif($idcut == 'No')
<div id="dd{{$da->id}}" class="box " style="display:none">
  @else
  <div id="dd{{$da->id}}" class="box " style="display:none">

@endif
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">{{ $da->name }}</h3>

    <div class="box-tools pull-right">
      <a  class="btn" id="hide{{$da->id}}"><i class="fa fa-minus"></i></a>
    </div>
  </div>

  <!-- /.box-header -->
  <div class="box-body">
    <table style="width:100%">
<tr>
<th width="20%">Stage ID</th>
<td >{{$da->id}}</td>
</tr>

<tr>
<th width="20%">Stage Name</th>
<td>{{$da->name}}</td>
</tr>
<tr>
<th width="20%">Process Name</th>
<td>{{$da->Process->name}}</td>
</tr>
<tr>
<th width="20%">End Stage Flag</th>
@if($da->end_stage_flag == 1)
<td>Yes</td>
@else
<td>No</td>
@endif
</tr>
<tr>
<th width="20%">Stage Description</th>
@if($da->description == NULL)
<td> -None- </td>
@else
<td>{{$da->description}}</td>
@endif
</tr>
</table>


<div style="overflow-x:auto;">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
        <tr>
          <tr style="background-color:#FFF4F4">
            <th colspan="3" >Action Lists</th>
          </tr>
        <tr>
          <th  width="1%">No.</th>
            <th  width="50%">Entering <a href="/admin/stageaction/create?stage{{$da->id}}actime=enterblink={{URL::current()}}?openflag?id=dd{{$da->id}}" class="btn"style="float:right"><i style="font-size:16px;color:green"class="fa fa-plus"></i></a></th>
            <th  width="50%">Exiting <a href="/admin/stageaction/create?stage{{$da->id}}actime=exitblink={{URL::current()}}?openflag?id=dd{{$da->id}}" class="btn"style="float:right"><i style="font-size:16px;color:green"class="fa fa-plus"></i></a></th>

        </tr>
      </thead>
      <tbody>
        @php
        $stageaction = \App\StageAction::where('current_stage_id',$da->id)->get();
        @endphp
        @foreach($stageaction as $indexx =>$st)

      <tr  class=" ">

      <td>{{++$indexx}}</td>
          @if($st->action_time == 0)
            <td>{{ $st->name }}<button style="float:right"><a href="/admin/deleteaction?{{$st->id}}"><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a></button></td>

          @else
            <td></td>
          @endif
          @if($st->action_time == 1)
            <td>{{ $st->name }}<button style="float:right"><a href="/admin/deleteaction?{{$st->id}}"><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a></button></td>

          @else
            <td></td>
          @endif
        </tr>
        @endforeach

      </tbody>
      <tfoot>
        <tr>
          <th  width="1%">No.</th>
            <th  width="50%" >Entering</th>
          <th  width="50%">Exiting</th>

        </tr>
      </tfoot>
    </table>

    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
        <tr>
          <tr style="background-color:#FFF4F4">
            <th colspan="6" >Path Lists</th>
          </tr>
        <tr>
          <th  width="1%">No.</th>
            <th  >Path Name</th>
          <th  >To Stage</th>
          <th  >Path Connection</th>
          <th  >Priority</th>
          <th  >Description</th>


        </tr>
      </thead>
      <tbody>
        @php
        $path = \App\Path::where('from_stage',$da->id)->get();
        @endphp
        @foreach($path as $indexxx =>$pa)
        <tr id="show2{{$pa->id}}" class=" ">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script>
      $(document).ready(function(){
      $("#hide2{{$pa->id}}").click(function(){
      $("#dd2{{$pa->id}}").hide();
      });
      $("#show2{{$pa->id}}").click(function(){
      $("#dd2{{$pa->id}}").show();
      });
      });
      </script>
      <td>{{++$indexxx}}</td>
            <td>{{ $pa->name }}</td>
            <td>{{ $pa->tostage->name }}</td>
            <td>{{ $pa->path_connection }}</td>
            <td>{{ $pa->path_priority }}</td>
            <td>{{ $pa->desctiption }}</td>

        </tr>
        @endforeach

      </tbody>
      <tfoot>
        <tr>
          <th  width="1%">No.</th>
            <th  >Path Name</th>
          <th  >To Stage</th>
          <th  >Path Connection</th>
          <th  >Priority</th>
          <th  >Description</th>

        </tr>
      </tfoot>
    </table>
</div>
<br />
@foreach($path as $indexxx =>$pa)
<div id="dd2{{$da->id}}" class="box " style="display:none">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">{{ $pa->name }}</h3>

    <div class="box-tools pull-right">
      <a  class="btn" id="hide2{{$da->id}}"><i class="fa fa-minus"></i></a>
    </div>
  </div>

  <!-- /.box-header -->
  <div class="box-body">


<div style="overflow-x:auto;">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
        <tr>
          <tr style="background-color:#FFF4F4">
            <th colspan="5" >Path Condition Lists</th>
          </tr>
        <tr>
          <th  width="1%">No.</th>
            <th  >Name</th>
          <th width="1%">Reverse All</th>
          <th >Description</th>
          <th >Action</th>

        </tr>
      </thead>
      <tbody>
        @php
        $pathcondition = \App\Path_condition::where('path_id',$pa->id)->get();
        @endphp
        @foreach($pathcondition as $indexxxx =>$pacon)

      <tr  class=" ">

      <td>{{++$indexxxx}}</td>

            <td>{{$pacon->name}}
</td>

            <td style="text-align:center"><input class="checkbox "type="checkbox"  value="/allservice" name="checket"
            onClick="if (this.checked) { window.location = this.value; }"  /></td>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
          $("#h{{$pacon->id}}").click(function(){
            $("#d{{$pacon->id}}").hide();
          });
          $("#s{{$pacon->id}}").click(function(){
            $("#d{{$pacon->id}}").show();
          });
        });
        </script>



            <td>{{$pacon->description}}</td>
            <td>
              <a class="btn btn-info" id="s{{$pacon->id}}">Show</a>
              <a class="btn btn-info" id="h{{$pacon->id}}" style="">Hide</a>

            </td>
        </tr>
        <tr>

          <td id="d{{$pacon->id}}" style="display:none;"colspan="5">
            <form id="submit_form{{$pacon->id}}" method="POST">

            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table style="width:100%">
              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 1:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition1 == 1 ? 'checked' : '' }} name="rv1{{$pacon->id}}" id="rv1{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail1:</th>

              <td width="20%"><div class="la{{$pacon->id}} ">@if($pacon->path_condition_detail1 == NULL) No Select @else{{$pacon->path_condition_detail_name1->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition las{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition las2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="la{{$pacon->id}}"><select name="pathcond1{{$pacon->id}}" id="pathcond1{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail1 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".las{{$pacon->id}}").click(function(){
                    $('.la{{$pacon->id}}').html(" ");
                    $('.la{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="la{{$pacon->id}} ">@if($pacon->path_condition_detail1 == NULL) No Select @else{{$pacon->path_condition_detail_name1->name}}@endif</div>';

                  $(".las2{{$pacon->id}}").click(function(){
                    $('.la{{$pacon->id}}').html(" ");
                    $('.la{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>
            <tr>

            <th width="4%"></th>
            <th width="20%">Reverse Each Preposition 2:</th>
            <td >
              <input type="checkbox" {{  $pacon->reverse_each_preposition2 == 1 ? 'checked' : '' }} name="rv2{{$pacon->id}}" id="rv2{{$pacon->id}}" >
            </td>

            </tr>
            <tr>

            <th width="4%"></th>
            <th width="20%">Path Condition Detail2:</th>

            <td width="20%"><div class="laa{{$pacon->id}} ">@if($pacon->path_condition_detail2 == NULL) No Select @else{{$pacon->path_condition_detail_name2->name}}@endif</div>

            </td>

            <td>
              <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lass{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
              <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lass2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
              <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
              <script>
              $(document).ready(function(){
                var op=" ";
                var op2=" ";

                op+= '<div class="laa{{$pacon->id}}"><select name="pathcond2{{$pacon->id}}" id="pathcond2{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail2 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                $(".lass{{$pacon->id}}").click(function(){
                  $('.laa{{$pacon->id}}').html(" ");
                  $('.laa{{$pacon->id}}').append(op);
                            });

                  op2+= '<div class="laa{{$pacon->id}} ">@if($pacon->path_condition_detail2 == NULL) No Select @else{{$pacon->path_condition_detail_name2->name}}@endif</div>';

                $(".lass2{{$pacon->id}}").click(function(){
                  $('.laa{{$pacon->id}}').html(" ");
                  $('.laa{{$pacon->id}}').append(op2);
                });
              });
              </script>
            </td>

          </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 3:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition3 == 1 ? 'checked' : '' }} name="rv3{{$pacon->id}}" id="rv3{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail3:</th>

              <td width="20%"><div class="laaa{{$pacon->id}} ">@if($pacon->path_condition_detail3 == NULL) No Select @else{{$pacon->path_condition_detail_name3->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lasss{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lasss2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="laa{{$pacon->id}}"><select name="pathcond3{{$pacon->id}}" id="pathcond3{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail3 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".lasss{{$pacon->id}}").click(function(){
                    $('.laaa{{$pacon->id}}').html(" ");
                    $('.laaa{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="laaa{{$pacon->id}} ">@if($pacon->path_condition_detail3 == NULL) No Select @else{{$pacon->path_condition_detail_name3->name}}@endif</div>';

                  $(".lasss2{{$pacon->id}}").click(function(){
                    $('.laaa{{$pacon->id}}').html(" ");
                    $('.laaa{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 4:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition4 == 1 ? 'checked' : '' }} name="rv4{{$pacon->id}}" id="rv4{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail4:</th>

              <td width="20%"><div class="laaaa{{$pacon->id}} ">@if($pacon->path_condition_detail4 == NULL) No Select @else{{$pacon->path_condition_detail_name4->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lassss{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lassss2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="laaaa{{$pacon->id}}"><select name="pathcond4{{$pacon->id}}" id="pathcond4{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail4 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".lassss{{$pacon->id}}").click(function(){
                    $('.laaaa{{$pacon->id}}').html(" ");
                    $('.laaaa{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="laa{{$pacon->id}} ">@if($pacon->path_condition_detail4 == NULL) No Select @else{{$pacon->path_condition_detail_name4->name}}@endif</div>';

                  $(".lassss2{{$pacon->id}}").click(function(){
                    $('.laaaa{{$pacon->id}}').html(" ");
                    $('.laaaa{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>
              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 5:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition5 == 1 ? 'checked' : '' }} name="rv5{{$pacon->id}}" id="rv5{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail5:</th>

              <td width="20%"><div class="laaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail5 == NULL) No Select @else{{$pacon->path_condition_detail_name5->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lasssss{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lasssss2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="laaaaa{{$pacon->id}}"><select name="pathcond5{{$pacon->id}}" id="pathcond5{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail5 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".lasssss{{$pacon->id}}").click(function(){
                    $('.laaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaa{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="laaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail5 == NULL) No Select @else{{$pacon->path_condition_detail_name5->name}}@endif</div>';

                  $(".lasssss2{{$pacon->id}}").click(function(){
                    $('.laaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaa{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>
              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 6:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition6 == 1 ? 'checked' : '' }} name="rv6{{$pacon->id}}" id="rv6{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail6:</th>

              <td width="20%"><div class="laaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail6 == NULL) No Select @else{{$pacon->path_condition_detail_name6->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lassssss{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lassssss2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="laaaaaa{{$pacon->id}}"><select name="pathcond6{{$pacon->id}}" id="pathcond6{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail6 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".lassssss{{$pacon->id}}").click(function(){
                    $('.laaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaa{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="laaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail6 == NULL) No Select @else{{$pacon->path_condition_detail_name6->name}}@endif</div>';

                  $(".lassssss2{{$pacon->id}}").click(function(){
                    $('.laaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaa{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>
              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 7:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition7 == 1 ? 'checked' : '' }} name="rv7{{$pacon->id}}" id="rv7{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail7:</th>

              <td width="20%"><div class="laaaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail7 == NULL) No Select @else{{$pacon->path_condition_detail_name7->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lasssssss{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lasssssss2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="laaaaaaa{{$pacon->id}}"><select name="pathcond7{{$pacon->id}}" id="pathcond7{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail2 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".lasssssss{{$pacon->id}}").click(function(){
                    $('.laaaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaaa{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="laaaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail7 == NULL) No Select @else{{$pacon->path_condition_detail_name7->name}}@endif</div>';

                  $(".lasssssss2{{$pacon->id}}").click(function(){
                    $('.laaaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaaa{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>
              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 8:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition8 == 1 ? 'checked' : '' }} name="rv8{{$pacon->id}}" id="rv8{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail8:</th>

              <td width="20%"><div class="laaaaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail8 == NULL) No Select @else{{$pacon->path_condition_detail_name8->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lassssssss{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lassssssss2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="laa{{$pacon->id}}"><select name="pathcond8{{$pacon->id}}" id="pathcond8{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail8 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".lassssssss{{$pacon->id}}").click(function(){
                    $('.laaaaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaaaa{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="laaaaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail8 == NULL) No Select @else{{$pacon->path_condition_detail_name8->name}}@endif</div>';

                  $(".lassssssss2{{$pacon->id}}").click(function(){
                    $('.laaaaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaaaa{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>
              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 9:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition9 == 1 ? 'checked' : '' }} name="rv9{{$pacon->id}}" id="rv9{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail9:</th>

              <td width="20%"><div class="laaaaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail9 == NULL) No Select @else{{$pacon->path_condition_detail_name9->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lasssssssss{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lasssssssss2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="laaaaaaaaa{{$pacon->id}}"><select name="pathcond9{{$pacon->id}}" id="pathcond9{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail9 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".lasssssssss{{$pacon->id}}").click(function(){
                    $('.laaaaaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaaaaa{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="laaaaaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail9 == NULL) No Select @else{{$pacon->path_condition_detail_name9->name}}@endif</div>';

                  $(".lasssssssss2{{$pacon->id}}").click(function(){
                    $('.laaaaaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaaaaa{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>
              <tr>

              <th width="4%"></th>
              <th width="20%">Reverse Each Preposition 10:</th>
              <td >
                <input type="checkbox" {{  $pacon->reverse_each_preposition10 == 1 ? 'checked' : '' }} name="rv10{{$pacon->id}}" id="rv10{{$pacon->id}}" >
              </td>

              </tr>

              <tr>

              <th width="4%"></th>
              <th width="20%">Path Condition Detail10:</th>

              <td width="20%"><div class="laaaaaaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail10 == NULL) No Select @else{{$pacon->path_condition_detail_name10->name}}@endif</div>

              </td>

              <td>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lassssssssss{{$pacon->id}}"><i style="font-size:17px;color:orange" class="fa fa-cog	"></i></a>
                <a  value="/admin/pathcondition/{{$pacon->id}}/edit" class="pathcondition lassssssssss2{{$pacon->id}}"><i style="font-size:17px;color:red" class="fa fa-remove"></i></a>
                <a ><i style="font-size:17px;color:red" class="fa fa-trash" onsubmit = "return confirm('Are you sure?')"></i></a>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script>
                $(document).ready(function(){
                  var op=" ";
                  var op2=" ";

                  op+= '<div class="laaaaaaaaaa{{$pacon->id}}"><select name="pathcond10{{$pacon->id}}" id="pathcond10{{$pacon->id}}" class="name">@foreach($pathconditiondetail as $stas)<option value="{{$stas->id}}"{{$stas->id == $pacon->path_condition_detail10 ? 'selected' : ''}}>{{$stas->name}}</option>@endforeach</select></div>';
                  $(".lassssssssss{{$pacon->id}}").click(function(){
                    $('.laaaaaaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaaaaaa{{$pacon->id}}').append(op);
                              });

                    op2+= '<div class="laaaaaaaaaa{{$pacon->id}} ">@if($pacon->path_condition_detail10 == NULL) No Select @else{{$pacon->path_condition_detail_name10->name}}@endif</div>';

                  $(".lassssssssss2{{$pacon->id}}").click(function(){
                    $('.laaaaaaaaaa{{$pacon->id}}').html(" ");
                    $('.laaaaaaaaaa{{$pacon->id}}').append(op2);
                  });
                });
                </script>
              </td>

            </tr>



        </table>
        <br />
        <input type="hidden" name="pathconid{{$pacon->id}}" id="pathconid{{$pacon->id}}" value="{{$pacon->id}}"class="form-control" />
        <input type="hidden" name="pathconds1{{$pacon->id}}" id="pathconds1{{$pacon->id}}" value="{{$pacon->path_condition_detail1}}"class="form-control" />
        <input type="hidden" name="pathconds2{{$pacon->id}}" id="pathconds2{{$pacon->id}}" value="{{$pacon->path_condition_detail2}}"class="form-control" />
        <input type="hidden" name="pathconds3{{$pacon->id}}" id="pathconds3{{$pacon->id}}" value="{{$pacon->path_condition_detail3}}"class="form-control" />
        <input type="hidden" name="pathconds4{{$pacon->id}}" id="pathconds4{{$pacon->id}}" value="{{$pacon->path_condition_detail4}}"class="form-control" />
        <input type="hidden" name="pathconds5{{$pacon->id}}" id="pathconds5{{$pacon->id}}" value="{{$pacon->path_condition_detail5}}"class="form-control" />
        <input type="hidden" name="pathconds6{{$pacon->id}}" id="pathconds6{{$pacon->id}}" value="{{$pacon->path_condition_detail6}}"class="form-control" />
        <input type="hidden" name="pathconds7{{$pacon->id}}" id="pathconds7{{$pacon->id}}" value="{{$pacon->path_condition_detail7}}"class="form-control" />
        <input type="hidden" name="pathconds8{{$pacon->id}}" id="pathconds8{{$pacon->id}}" value="{{$pacon->path_condition_detail8}}"class="form-control" />
        <input type="hidden" name="pathconds9{{$pacon->id}}" id="pathconds9{{$pacon->id}}" value="{{$pacon->path_condition_detail9}}"class="form-control" />
        <input type="hidden" name="pathconds10{{$pacon->id}}" id="pathconds10{{$pacon->id}}" value="{{$pacon->path_condition_detail10}}"class="form-control" />

<div style="text-align:center">

         <input type="button" name="submit{{$pacon->id}}" id="submit{{$pacon->id}}" class="" value="Submit" />


         <span id="error_message{{$pacon->id}}" class="text-danger"></span>
         <span id="success_message{{$pacon->id}}" class="text-success"> </span>
                </div>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
         <script>
          $(document).ready(function(){
               $('#submit{{$pacon->id}}').click(function(){
                    var pathconid = $('#pathconid{{$pacon->id}}').val();
                    var pathconds1 = $('#pathconds1{{$pacon->id}}').val();
                    var pathconds2 = $('#pathconds2{{$pacon->id}}').val();
                    var pathconds3 = $('#pathconds3{{$pacon->id}}').val();
                    var pathconds4 = $('#pathconds4{{$pacon->id}}').val();
                    var pathconds5 = $('#pathconds5{{$pacon->id}}').val();
                    var pathconds6 = $('#pathconds6{{$pacon->id}}').val();
                    var pathconds7 = $('#pathconds7{{$pacon->id}}').val();
                    var pathconds8 = $('#pathconds8{{$pacon->id}}').val();
                    var pathconds9 = $('#pathconds9{{$pacon->id}}').val();
                    var pathconds10 = $('#pathconds10{{$pacon->id}}').val();
                    var pathcond1 = $('#pathcond1{{$pacon->id}}').val();
                    var pathcond2 = $('#pathcond2{{$pacon->id}}').val();
                    var pathcond3 = $('#pathcond3{{$pacon->id}}').val();
                    var pathcond4 = $('#pathcond4{{$pacon->id}}').val();
                    var pathcond5 = $('#pathcond5{{$pacon->id}}').val();
                    var pathcond6 = $('#pathcond6{{$pacon->id}}').val();
                    var pathcond7 = $('#pathcond7{{$pacon->id}}').val();
                    var pathcond8 = $('#pathcond8{{$pacon->id}}').val();
                    var pathcond9 = $('#pathcond9{{$pacon->id}}').val();
                    var pathcond10 = $('#pathcond10{{$pacon->id}}').val();
                    var rv1 = $('#rv1{{$pacon->id}}').val();
                    var rv2 = $('#rv2{{$pacon->id}}').val();
                    var rv3 = $('#rv3{{$pacon->id}}').val();
                    var rv4 = $('#rv4{{$pacon->id}}').val();
                    var rv5 = $('#rv5{{$pacon->id}}').val();
                    var rv6 = $('#rv6{{$pacon->id}}').val();
                    var rv7 = $('#rv7{{$pacon->id}}').val();
                    var rv8 = $('#rv8{{$pacon->id}}').val();
                    var rv9 = $('#rv9{{$pacon->id}}').val();
                    var rv10 = $('#rv10{{$pacon->id}}').val();
                    if (typeof pathcond1 === "undefined")
                    {
                        var pathcond1 = pathconds1;
                    }
                    if (typeof pathcond2 === "undefined")
                    {
                        var pathcond2 = pathconds2;
                    }
                    if (typeof pathcond3 === "undefined")
                    {
                        var pathcond3 = pathconds3;
                    }
                    if (typeof pathcond4 === "undefined")
                    {
                        var pathcond4 = pathconds4;
                    }
                    if (typeof pathcond5 === "undefined")
                    {
                        var pathcond5 = pathconds5;
                    }
                    if (typeof pathcond6 === "undefined")
                    {
                        var pathcond6 = pathconds6;
                    }
                    if (typeof pathcond7 === "undefined")
                    {
                        var pathcond7 = pathconds7;
                    }
                    if (typeof pathcond8 === "undefined")
                    {
                        var pathcond8 = pathconds8;
                    }
                    if (typeof pathcond9 === "undefined")
                    {
                        var pathcond9 = pathconds9;
                    }
                    if (typeof pathcond10 === "undefined")
                    {
                        var pathcond10 = pathconds10;
                    }

                    if ($('#rv1{{$pacon->id}}').is(':checked'))
                    {
                        var rv1 = '1';
                    }
                    else
                    {
                      var  rv1 = '0';
                    }
                    if ($('#rv2{{$pacon->id}}').is(':checked'))
                    {
                        var rv2 = '1';
                    }
                    else
                    {
                      var  rv2 = '0';
                    }
                    if ($('#rv3{{$pacon->id}}').is(':checked'))
                    {
                        var rv3 = '1';
                    }
                    else
                    {
                      var  rv3 = '0';
                    }
                    if ($('#rv4{{$pacon->id}}').is(':checked'))
                    {
                        var rv4 = '1';
                    }
                    else
                    {
                      var  rv4 = '0';
                    }
                    if ($('#rv5{{$pacon->id}}').is(':checked'))
                    {
                        var rv5 = '1';
                    }
                    else
                    {
                      var  rv5 = '0';
                    }
                    if ($('#rv6{{$pacon->id}}').is(':checked'))
                    {
                        var rv6 = '1';
                    }
                    else
                    {
                      var  rv6 = '0';
                    }
                    if ($('#rv7{{$pacon->id}}').is(':checked'))
                    {
                        var rv7 = '1';
                    }
                    else
                    {
                      var  rv7 = '0';
                    }
                    if ($('#rv8{{$pacon->id}}').is(':checked'))
                    {
                        var rv8 = '1';
                    }
                    else
                    {
                      var  rv8 = '0';
                    }
                    if ($('#rv9{{$pacon->id}}').is(':checked'))
                    {
                        var rv9 = '1';
                    }
                    else
                    {
                      var  rv9 = '0';
                    }
                    if ($('#rv10{{$pacon->id}}').is(':checked'))
                    {
                        var rv10 = '1';
                    }
                    else
                    {
                      var  rv10 = '0';
                    }
                    if(pathconid == '')
                    {
                         $('#error_message').html("All Fields are required");
                    }
                    else
                    {
                         $('#error_message').html('');
                         $.ajaxSetup({
                           headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           }
                         });
                                              console.log(pathcond1);

                                             console.log(pathconid);
                                             console.log(rv1);
                         $.ajax({
                              url:"/admin/updatepathcondition?pathconid="+pathconid+"/reverse1="+rv1+"/reverse2="+rv2+"/reverse3="+rv3+"/reverse4="+rv4+"/reverse5="+rv5+"/reverse6="+rv6+"/reverse7="+rv7+"/reverse8="+rv8+"/reverse9="+rv9+"/reverse10="+rv10+"/pathdetail1="+pathcond1+"/pathdetail2="+pathcond2+"/pathdetail3="+pathcond3+"/pathdetail4="+pathcond4+"/pathdetail5="+pathcond5
                                  +"/pathdetail6="+pathcond6+"/pathdetail7="+pathcond7+"/pathdetail8="+pathcond8+"/pathdetail9="+pathcond9+"/pathdetail10="+pathcond10,
                              method:"POST",
                              data:{pathconid:pathconid},
                              success:function(data){
                                   $("form").trigger("reset");
                                   $('#success_message{{$pacon->id}}').fadeIn().html(data);
                                   setTimeout(function(){
                                        $('#success_message{{$pacon->id}}').fadeOut("Slow");
                                   }, 2000);
                              }
                         });
                    }
               });
          });

          </script>
      </form>
          </td>

        </tr>
        @endforeach

      </tbody>
      <tfoot>
        <tr>
          <th  width="1%">No.</th>
            <th  >Name</th>
          <th width="1%">Reverse All</th>
          <th >Description</th>
          <th >Action</th>

        </tr>
      </tfoot>
    </table>


</div>

</div>
<!-- /.box-body -->

</div>
@endforeach
</div>
<!-- /.box-body -->

</div>
@endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($data)}} of {{count($data)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $data->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>

    <!-- /.content -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.condition',function(){
            //  console.log("hmm its change");

                var department_id=$(this).val();
                //console.log(department_id);
                var div=$(this).parent();
                var op=" ";
                var op2=" ";
                var op3=" ";
                var op4=" ";
                var op5=" ";
                var op6=" ";
                var op7=" ";
                var op8=" ";
                var op9=" ";
                var op10=" ";
                var op11=" ";
                var op12=" ";
                var op13=" ";
                var op14=" ";
                var op15=" ";
                var op16=" ";
                var op17=" ";
                var op18=" ";
                var op19=" ";
                var op20=" ";
                var op21=" ";
                var op22=" ";
                var op23=" ";
                var op24=" ";
                var op25=" ";
                var op26=" ";
                var op27=" ";
                var op28=" ";
                var op29=" ";
                var op30=" ";
                var op31=" ";
                var op32=" ";
                var op33=" ";
                var op34=" ";
                var op35=" ";
                var op36=" ";
                var op37=" ";
                var op38=" ";
                var op39=" ";
                var op40=" ";



                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findAction')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      console.log('success');

                      console.log(data);

                     console.log(data.length);

                      for(var i=0; i<data.length;i++){
                      //  op+='<label value="'+data[i].con_para_name1+'">'+data[i].con_para_name1+'</label>';

                        //op+='<input id="action_para_value1" type="text" class="form-control " name="action_para_value1" value="'+data[i].action_para_name1+'" >';
                        if(data[i].action_para_name1 != null)
                        {
                        op+='<div><label for="action_para_value1" class="lasd">'+data[i].action_para_name1+'</label><br /><select  class="form-control" name="action_para_value1"><option value="" >-select-</option>@foreach($messagetype as $sta)<option value="{{$sta->id}}">{{$sta->message_template}}</option>@endforeach</select></div>';
                        }
                        else{
                          op+='';
                        }
                        if(data[i].action_para_name2 != null)
                        {
                          op2+='<div><label for="action_para_value2" class="lasd">'+data[i].action_para_name2+'</label><br /><input id="action_para_value2" type="text" class="form-control " name="action_para_value2" value="{{ old('action_para_value2') }}" ></div>';
                        }

                        else{
                          op2+='';

                        }
                        if(data[i].action_para_name3 != null)
                        {
                          op3+='<div><label for="action_para_value3" class="lasd">'+data[i].action_para_name3+'</label><br /><input id="action_para_value3" type="text" class="form-control " name="action_para_value3" value="{{ old('action_para_value3') }}" ></div>';
                        }
                        else{
                          op3+='';
                        }
                        if(data[i].action_para_name4 != null)
                        {
                          op4+='<div><label for="action_para_value4" class="lasd">'+data[i].action_para_name4+'</label><br /><input id="action_para_value4" type="text" class="form-control " name="action_para_value4" value="{{ old('action_para_value4') }}" ></div>';
                        }
                        else{
                          op4+='';

                        }
                        if(data[i].action_para_name5 != null)
                        {
                          op5+='<div><label for="action_para_value5" class="lasd">'+data[i].action_para_name5+'</label><br /><input id="action_para_value5" type="text" class="form-control " name="action_para_value5" value="{{ old('action_para_value5') }}" ></div>';
                        }
                        else{
                          op5+='';

                        }
                        if(data[i].action_para_name6 != null)
                        {
                          op6+='<div><label for="action_para_value6" class="lasd">'+data[i].action_para_name6+'</label><br /><select style="width:70%" class="form-control" name="action_para_value6"><option value="" >-select-</option>@foreach($publicid as $sta)<option value="{{$sta->id}}">Public ID : {{$sta->id}} Name : {{$sta->public_name}} Email : {{$sta->public_email}}</option>@endforeach</select></div>';
                        }
                        else{
                          op6+='';
                        }
                        if(data[i].action_para_name7 != null)
                        {
                          op7+='<div><label for="action_para_value7" class="lasd">'+data[i].action_para_name7+'</label><br /><select style="width:70%" class="form-control" name="action_para_value7"><option value="" >-select-</option>@foreach($publicid as $sta)<option value="{{$sta->id}}">Public ID : {{$sta->id}} Name : {{$sta->public_name}} Email : {{$sta->public_email}}</option>@endforeach</select></div>';

                        }
                        else{
                          op7+='';

                        }
                        if(data[i].action_para_name8 != null)
                        {
                          op8+='<div><label for="action_para_value8" class="lasd">'+data[i].action_para_name8+'</label><br /><select style="width:70%" class="form-control" name="action_para_value8"><option value="" >-select-</option>@foreach($publicid as $sta)<option value="{{$sta->id}}">Public ID : {{$sta->id}} Name : {{$sta->public_name}} Email : {{$sta->public_email}}</option>@endforeach</select></div>';

                        }
                        else {
                          op8+='';
                        }
                        if(data[i].action_para_name9 != null)
                        {
                          if(data[i].id == 8)
                          {
                          op9+='<div><label for="action_para_value9" class="lasd">'+data[i].action_para_name9+'</label><br /><select style="width:70%"  class="form-control" name="action_para_value9"><option value="" >-select-</option>@foreach($publicid as $sta)<option value="{{$sta->id}}">Public ID : {{$sta->id}} Name : {{$sta->public_name}} Email : {{$sta->public_email}}</option>@endforeach</select></div>';
                          }
                          if(data[i].id == 9)
                          {
                          op9+='<div><label for="action_para_value9" class="lasd">'+data[i].action_para_name9+'</label><br /><select  style="width:70%" class="form-control" name="action_para_value9"><option value="" >-select-</option>@foreach($guildmem as $sta)<option value="{{$sta->id}}">{{$sta->name}}</option>@endforeach</select></div>';
                          }
                          if(data[i].id == 10)
                          {
                            op9+='<div><label for="action_para_value9" class="lasd">'+data[i].action_para_name9+'</label><br /><select  style="width:70%" class="form-control" name="action_para_value9"><option value="" >-select-</option>@foreach($grouppartner as $sta)<option value="{{$sta->id}}">{{$sta->name}}</option>@endforeach</select></div>';
                          }
                          if(data[i].id == 11)
                          {
                            op9+='<div><label for="action_para_value9" class="lasd">'+data[i].action_para_name9+'</label><br /><select  style="width:70%"class="form-control name" name="action_para_value9"><option value="" >-select-</option>@foreach($grouppid as $sta)<option value="{{$sta->id}}">{{$sta->name}}</option>@endforeach</select></div>';
                          }
                        }
                        else{
                          op9+='';
                        }
                        if(data[i].action_para_name10 != null)
                        {
                          op10+='<div><label for="action_para_value10" class="lasd">'+data[i].action_para_name10+'</label><br /><input id="action_para_value10" type="text" class="form-control " name="action_para_value10" value="{{ old('action_para_value10') }}" ></div>';
                        }
                        else {
                          op10+='';
                        }
                        if(data[i].action_para_name11 != null)
                        {
                          op11+='<div><label for="action_para_value11" class="lasd">'+data[i].action_para_name11+'</label><br /><input id="action_para_value11" type="text" class="form-control " name="action_para_value11" value="{{ old('action_para_value11') }}" ></div>';
                        }
                        else{
                          op11+='';

                        }
                        if(data[i].action_para_name12 != null)
                        {
                          op12+='<div><label for="action_para_value12" class="lasd">'+data[i].action_para_name12+'</label><br /><input id="action_para_value12" type="text" class="form-control " name="action_para_value12" value="{{ old('action_para_value12') }}" ></div>';
                        }
                        else {
                          op12+='';
                        }
                        if(data[i].action_para_name13 != null)
                        {
                          op13+='<div><label for="action_para_value13" class="lasd">'+data[i].action_para_name13+'</label><br /><input id="action_para_value13" type="text" class="form-control " name="action_para_value13" value="{{ old('action_para_value13') }}" ></div>';
                        }
                        else{
                          op13+='';
                        }
                        if(data[i].action_para_name14 != null)
                        {
                          op14+='<div><label for="action_para_value14" class="lasd">'+data[i].action_para_name14+'</label><br /><input id="action_para_value14" type="text" class="form-control " name="action_para_value14" value="{{ old('action_para_value14') }}" ></div>';
                        }
                        else{
                          op14+='';
                        }
                        if(data[i].action_para_name15 != null)
                        {
                          op15+='<div><label for="action_para_value15" class="lasd">'+data[i].action_para_name15+'</label><br /><input id="action_para_value15" type="text" class="form-control " name="action_para_value15" value="{{ old('action_para_value15') }}" ></div>';
                        }
                        else {
                          op15+='';
                        }
                        if(data[i].action_para_name16 != null)
                        {
                          op16+='<div><label for="action_para_value16" class="lasd">'+data[i].action_para_name16+'</label><br /><input id="action_para_value16" type="text" class="form-control " name="action_para_value16" value="{{ old('action_para_value16') }}" ></div>';
                        }
                        else{
                          op16+='';
                        }
                        if(data[i].action_para_name17 != null)
                        {
                          op17+='<div><label for="action_para_value17" class="lasd">'+data[i].action_para_name17+'</label<br />><input id="action_para_value17" type="text" class="form-control " name="action_para_value17" value="{{ old('action_para_value17') }}" ></div>';
                        }
                        else{
                          op17+='';
                        }
                        if(data[i].action_para_name18 != null)
                        {
                          op18+='<div><label for="action_para_value18" class="lasd">'+data[i].action_para_name18+'</label><br /><input id="action_para_value18" type="text" class="form-control " name="action_para_value18" value="{{ old('action_para_value18') }}" ></div>';
                        }
                        else
                        {
                        op18+='';
                      }
                      if(data[i].action_para_name19 != null)
                      {
                        op19+='<div><label for="action_para_value19" class="lasd">'+data[i].action_para_name19+'</label><br /><input id="action_para_value19" type="text" class="form-control " name="action_para_value19" value="{{ old('action_para_value19') }}" ></div>';
                      }
                      else{
                        op19+='';
                      }
                      if(data[i].action_para_name20 != null)
                      {
                        op20+='<div><label for="action_para_value20" class="lasd">'+data[i].action_para_name20+'</label><input id="action_para_value20" type="text" class="form-control " name="action_para_value20" value="{{ old('action_para_value20') }}" ></div>';
                      }
                      else{
                        op20+='';
                      }
                      if(data[i].action_para_name21 != null)
                      {
                        op21+='<div><label for="action_para_value21" class="lasd">'+data[i].action_para_name21+'</label><input id="action_para_value21" type="text" class="form-control " name="action_para_value21" value="{{ old('action_para_value21') }}" ></div>';
                      }
                      else{
                        op21+='';
                      }

                      if(data[i].action_para_name22 != null)
                      {
                        op22+='<div><label for="action_para_value22" class="lasd">'+data[i].action_para_name22+'</label><input id="action_para_value22" type="text" class="form-control " name="action_para_value22" value="{{ old('action_para_value22') }}" ></div>';
                      }
                      else{
                        op22+='';
                      }

                      if(data[i].action_para_name23 != null)
                      {
                        op23+='<div><label for="action_para_value23" class="lasd">'+data[i].action_para_name23+'</label><input id="action_para_value23" type="text" class="form-control " name="action_para_value23" value="{{ old('action_para_value23') }}" ></div>';
                      }
                      else{
                        op23+='';
                      }
                      if(data[i].action_para_name24 != null)
                      {
                        op24+='<div><label for="action_para_value24" class="lasd">'+data[i].action_para_name24+'</label><input id="action_para_value24" type="text" class="form-control " name="action_para_value24" value="{{ old('action_para_value24') }}" ></div>';
                      }
                      else{
                        op24+='';
                      }

                      if(data[i].action_para_name25 != null)
                      {
                        op25+='<div><label for="action_para_value25" class="lasd">'+data[i].action_para_name25+'</label><input id="action_para_value25" type="text" class="form-control " name="action_para_value25" value="{{ old('action_para_value25') }}" ></div>';
                      }
                      else{
                        op25+='';
                      }

                      if(data[i].action_para_name26 != null)
                      {
                        op26+='<div><label for="action_para_value26" class="lasd">'+data[i].action_para_name26+'</label><input id="action_para_value26" type="text" class="form-control " name="action_para_value26" value="{{ old('action_para_value26') }}" ></div>';
                      }
                      else{
                        op26+='';
                      }

                      if(data[i].action_para_name27 != null)
                      {
                        op27+='<div><label for="action_para_value27" class="lasd">'+data[i].action_para_name27+'</label><input id="action_para_value27" type="text" class="form-control " name="action_para_value27" value="{{ old('action_para_value27') }}" ></div>';
                      }
                      else{
                        op27+='';
                      }

                      if(data[i].action_para_name28 != null)
                      {
                        op28+='<div><label for="action_para_value28" class="lasd">'+data[i].action_para_name28+'</label><input id="action_para_value28" type="text" class="form-control " name="action_para_value28" value="{{ old('action_para_value28') }}" ></div>';
                      }
                      else{
                        op28+='';
                      }

                      if(data[i].action_para_name29 != null)
                      {
                        op29+='<div><label for="action_para_value29" class="lasd">'+data[i].action_para_name29+'</label><input id="action_para_value29" type="text" class="form-control " name="action_para_value29" value="{{ old('action_para_value29') }}" ></div>';
                      }
                      else{
                        op29+='';
                      }
                      if(data[i].action_para_name30 != null)
                      {
                        op30+='<div><label for="action_para_value30" class="lasd">'+data[i].action_para_name30+'</label><input id="action_para_value30" type="text" class="form-control " name="action_para_value30" value="{{ old('action_para_value30') }}" ></div>';
                      }
                      else{
                        op30+='';
                      }

                      if(data[i].action_para_name31 != null)
                      {
                        op31+='<div><label for="action_para_value31" class="lasd">'+data[i].action_para_name31+'</label><input id="action_para_value31" type="text" class="form-control " name="action_para_value31" value="{{ old('action_para_value31') }}" ></div>';
                      }
                      else{
                        op31+='';
                      }

                      if(data[i].action_para_name32 != null)
                      {
                        op32+='<div><label for="action_para_value32" class="lasd">'+data[i].action_para_name32+'</label><input id="action_para_value32" type="text" class="form-control " name="action_para_value32" value="{{ old('action_para_value32') }}" ></div>';
                      }
                      else{
                        op32+='';
                      }

                      if(data[i].action_para_name33 != null)
                      {
                        op33+='<div><label for="action_para_value33" class="lasd">'+data[i].action_para_name33+'</label><input id="action_para_value33" type="text" class="form-control " name="action_para_value33" value="{{ old('action_para_value33') }}" ></div>';
                      }
                      else{
                        op33+='';
                      }

                      if(data[i].action_para_name34 != null)
                      {
                        op34+='<div><label for="action_para_value34" class="lasd">'+data[i].action_para_name34+'</label><input id="action_para_value34" type="text" class="form-control " name="action_para_value34" value="{{ old('action_para_value34') }}" ></div>';
                      }
                      else{
                        op34+='';
                      }

                      if(data[i].action_para_name35 != null)
                      {
                        op35+='<div><label for="action_para_value35" class="lasd">'+data[i].action_para_name35+'</label><input id="action_para_value35" type="text" class="form-control " name="action_para_value35" value="{{ old('action_para_value35') }}" ></div>';
                      }
                      else{
                        op35+='';
                      }

                      if(data[i].action_para_name36 != null)
                      {
                        op36+='<div><label for="action_para_value36" class="lasd">'+data[i].action_para_name36+'</label><input id="action_para_value36" type="text" class="form-control " name="action_para_value36" value="{{ old('action_para_value36') }}" ></div>';
                      }
                      else{
                        op36+='';
                      }

                      if(data[i].action_para_name37 != null)
                      {
                        op37+='<div><label for="action_para_value37" class="lasd">'+data[i].action_para_name37+'</label><input id="action_para_value37" type="text" class="form-control " name="action_para_value37" value="{{ old('action_para_value37') }}" ></div>';
                      }
                      else{
                        op37+='';
                      }

                      if(data[i].action_para_name38 != null)
                      {
                        op38+='<div><label for="action_para_value38" class="lasd">'+data[i].action_para_name38+'</label><input id="action_para_value38" type="text" class="form-control " name="action_para_value38" value="{{ old('action_para_value38') }}" ></div>';
                      }
                      else{
                        op38+='';
                      }

                      if(data[i].action_para_name39 != null)
                      {
                        op39+='<div><label for="action_para_value39" class="lasd">'+data[i].action_para_name39+'</label><input id="action_para_value39" type="text" class="form-control " name="action_para_value39" value="{{ old('action_para_value39') }}" ></div>';
                      }
                      else{
                        op39+='';
                      }

                      if(data[i].action_para_name40 != null)
                      {
                        op40+='<div><label for="action_para_value40" class="lasd">'+data[i].action_para_name40+'</label><input id="action_para_value40" type="text" class="form-control " name="action_para_value40" value="{{ old('action_para_value40') }}" ></div>';
                      }
                      else{
                        op40+='';
                      }
    }
                      $('.la').html(" ");
                      $('.la2').html(" ");
                      $('.la3').html(" ");
                      $('.la4').html(" ");
                      $('.la5').html(" ");
                      $('.la6').html(" ");
                      $('.la7').html(" ");
                      $('.la8').html(" ");
                      $('.la9').html(" ");
                      $('.la10').html(" ");
                      $('.la11').html(" ");
                      $('.la12').html(" ");
                      $('.la13').html(" ");
                      $('.la14').html(" ");
                      $('.la15').html(" ");
                      $('.la16').html(" ");
                      $('.la17').html(" ");
                      $('.la18').html(" ");
                      $('.la19').html(" ");
                      $('.la20').html(" ");
                      $('.la21').html(" ");
                      $('.la22').html(" ");
                      $('.la23').html(" ");
                      $('.la24').html(" ");
                      $('.la25').html(" ");
                      $('.la26').html(" ");
                      $('.la27').html(" ");
                      $('.la28').html(" ");
                      $('.la29').html(" ");
                      $('.la30').html(" ");
                      $('.la31').html(" ");
                      $('.la32').html(" ");
                      $('.la33').html(" ");
                      $('.la34').html(" ");
                      $('.la35').html(" ");
                      $('.la36').html(" ");
                      $('.la37').html(" ");
                      $('.la38').html(" ");
                      $('.la39').html(" ");
                      $('.la40').html(" ");



                      $('.la').append(op);
                      $('.la2').append(op2);
                      $('.la3').append(op3);
                      $('.la4').append(op4);
                      $('.la5').append(op5);
                      $('.la6').append(op6);
                      $('.la7').append(op7);
                      $('.la8').append(op8);
                      $('.la9').append(op9);
                      $('.la10').append(op10);
                      $('.la11').append(op11);
                      $('.la12').append(op12);
                      $('.la13').append(op13);
                      $('.la14').append(op14);
                      $('.la15').append(op15);
                      $('.la16').append(op16);
                      $('.la17').append(op17);
                      $('.la18').append(op18);
                      $('.la19').append(op19);
                      $('.la20').append(op20);
                      $('.la21').append(op21);
                      $('.la22').append(op22);
                      $('.la23').append(op23);
                      $('.la24').append(op24);
                      $('.la25').append(op25);
                      $('.la26').append(op26);
                      $('.la27').append(op27);
                      $('.la28').append(op28);
                      $('.la29').append(op29);
                      $('.la30').append(op30);
                      $('.la31').append(op31);
                      $('.la32').append(op32);
                      $('.la33').append(op33);
                      $('.la34').append(op34);
                      $('.la35').append(op35);
                      $('.la36').append(op36);
                      $('.la37').append(op37);
                      $('.la38').append(op38);
                      $('.la39').append(op39);
                      $('.la40').append(op40);

                      console.log(op);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>
@endsection
