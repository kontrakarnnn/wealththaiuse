@extends('system-mgmt.case-type.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Case Type</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('case-type.create') }}">Add new Case Type</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('case-type.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Case Category</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                      @foreach ($casetype as $sta)
                          <option value="{{$sta->name}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Case Category</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="case_cat_id">
                      <option value="" ></option>
                      @foreach ($casecat as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>


          </div>

          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Default Partner Block</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="default_partner_block_id">
                      <option value="" ></option>
                      @foreach ($partnerblock as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Default User Block</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="default_user_block_id">
                      <option value="" ></option>
                      @foreach ($block as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>


          </div>
          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="default_partner_group" class="col-sm-3 control-label">Default Partner Group</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="default_partner_group">
                      <option value="" ></option>
                      @foreach ($partnergroup as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="default_partner_group" class="col-sm-3 control-label">Offer Category</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="offer_cat">
                      <option value="" ></option>
                      @foreach ($offercategory as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

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
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th >Case Category</th>
                  <th>Case Type Name</th>
                <th>Default Partner Block</th>
                <th>Default User Block</th>
                <th>Default Partner group</th>
                <th>Default Procedure</th>
                <th>Day Auto Renew</th>
                <th>Offer Category</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
                <tr role="row" class="odd">
                  <td>{{ $da->CaseCategory[ $casecatcol[1]] }}</td>
                  <td>{{ $da[$casetypecol[2]] }}</td>
                  @if($da->default_partner_block_id == NULL ||$da->default_partner_block_id == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Partner_block->name }}</td>
                  @endif
                  @if($da->default_user_block_id == NULL ||$da->default_user_block_id == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Block->name }}</td>
                  @endif
                  @if($da->default_partner_group == NULL ||$da->default_partner_group == 0)
                  <td></td>
                  @else
                  <td>{{ $da->Partner_group->name }}</td>
                  @endif
                  @if($da[$casetypecol[5]] == 0 || $da[$casetypecol[5]] == NULL )
                  <td></td>
                  @else
                  <td>{{ $da->Procedures->name }}</td>
                  @endif
                  <td>{{$da->day_auto_renew}}</td>
                  @if($da->offer_cat == NULL ||$da->offer_cat == 0||$da->offer_cat == '' )
                    <td></td>
                  @else
                  <td>{{$da->offercategory->name}}</td>
                  @endif
                  <td>{{$da[$casetypecol[6]]}}</td>

                  <td>
                    <form class="row" method="POST" action="{{ route('case-type.destroy', ['id' =>$da[$casetypecol[0]]]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('case-type.edit', ['id' => $da[$casetypecol[0]]]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{$da[$casetypecol[0]] }}">More Details</button>
                    </form>

                    <div class="modal fade" id="myModal{{ $da[$casetypecol[0]] }}" role="dialog">
                    <div class="modal-dialog">

                    <!-- Modal content-->

                    <div class="modal-content">


                      <div class="modal-header" style="background-color:#;color:white;">

                        <p style="color:white" class="modal-title">
                           <ul class="nav nav-tabs">
                                                  <li class="active"><a data-toggle="tab" href="#home">General </a></li>
                                                  <li><a data-toggle="tab" href="#menu1">Requirement</a></li>
                                                  <li><a data-toggle="tab" href="#menu2">Variable1-40</a></li>
                                                  <li><a data-toggle="tab" href="#menu3">Variable40-80</a></li>
                                                  <li><a data-toggle="tab" href="#menu4">Variable80-130</a></li>
                                                </ul></p>
                      </div>
                      <div class="modal-body">


                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <h3>General Information</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width=""><p>Case Type Name </p></th>
                            <td >{{$da[$casetypecol[2]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Case Category Name </p></th>
                            <td >{{$da->CaseCategory[ $casecatcol[1]]}} </td>

                            </tr>

                            @if($da->default_partner_block_id == NULL ||$da->default_partner_block_id == 0)
                            <tr>
                            <th width=""><p>Default Partner Block</p></th>
                            <td ></td>

                            </tr>
                            @else

                            <tr>
                            <th width=""><p>Default Partner Block</p></th>
                            <td >{{$da->Partner_block->name}} </td>

                            </tr>
                            @endif
                            @if($da->default_user_block_id == NULL ||$da->default_user_block_id == 0)
                            <tr>
                            <th width=""><p>Default User Block </p></th>
                            <td ></td>

                            </tr>
                            @else
                            <tr>
                            <th width=""><p>Default User Block </p></th>
                            <td >{{$da->Block->name}} </td>
                            @endif
                            </tr>
                            <tr>
                            <th width=""><p>Default Procedure </p></th>
                            <td ></td>

                            </tr>

                            <tr>
                            <th width=""><p>Description Name </p></th>
                            <td >{{$da[$casetypecol[6]]}} </td>

                            </tr>
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>



                            </table>
                          </div>
                          <div id="menu1" class="tab-pane fade">
                            <h3>Requirement Variable Name</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width=""><p>Requirement Name1 </p></th>
                            <td >{{$da[$casetypecol[7]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name2 </p></th>
                            <td >{{$da[$casetypecol[8]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name3 </p></th>
                            <td >{{$da[$casetypecol[9]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name4 </p></th>
                            <td >{{$da[$casetypecol[10]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name5 </p></th>
                            <td >{{$da[$casetypecol[11]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name6 </p></th>
                            <td >{{$da[$casetypecol[12]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name7 </p></th>
                            <td >{{$da[$casetypecol[13]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name8 </p></th>
                            <td >{{$da[$casetypecol[14]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name9 </p></th>
                            <td >{{$da[$casetypecol[15]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name10 </p></th>
                            <td >{{$da[$casetypecol[16]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name11 </p></th>
                            <td >{{$da[$casetypecol[17]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name12 </p></th>
                            <td >{{$da[$casetypecol[18]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Requirement Name13 </p></th>
                            <td >{{$da[$casetypecol[19]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name14 </p></th>
                            <td >{{$da[$casetypecol[20]]}} </td>

                            </tr>



                            <tr>
                            <th width=""><p>Requirement Name15 </p></th>
                            <td >{{$da[$casetypecol[21]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name16 </p></th>
                            <td >{{$da[$casetypecol[22]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name17 </p></th>
                            <td >{{$da[$casetypecol[23]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name18 </p></th>
                            <td >{{$da[$casetypecol[24]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Requirement Name19 </p></th>
                            <td >{{$da[$casetypecol[25]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Requirement Name20 </p></th>
                            <td >{{$da[$casetypecol[26]]}} </td>

                            </tr>


                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>



                            </table>
                                                  </div>
                          <div id="menu2" class="tab-pane fade">
                            <h3>Case Variable Name 1-40</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width=""><p>Variable Name1 </p></th>
                            <td >{{$da[$casetypecol[27]]}} </td>
                            <th width=""><p>Variable Name21 </p></th>
                            <td >{{$da[$casetypecol[47]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name2 </p></th>
                            <td >{{$da[$casetypecol[28]]}} </td>
                            <th width=""><p>Variable Name22 </p></th>
                            <td >{{$da[$casetypecol[48]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name3 </p></th>
                            <td >{{$da[$casetypecol[29]]}} </td>
                            <th width=""><p>Variable Name23 </p></th>
                            <td >{{$da[$casetypecol[49]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name4</p></th>
                            <td >{{$da[$casetypecol[30]]}} </td>
                            <th width=""><p>Variable Name24</p></th>
                            <td >{{$da[$casetypecol[50]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Variable Name5</p></th>
                            <td >{{$da[$casetypecol[31]]}} </td>
                            <th width=""><p>Variable Name25</p></th>
                            <td >{{$da[$casetypecol[51]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Variable Name6 </p></th>
                            <td >{{$da[$casetypecol[32]]}} </td>
                            <th width=""><p>Variable Name26 </p></th>
                            <td >{{$da[$casetypecol[52]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name7 </p></th>
                            <td >{{$da[$casetypecol[33]]}} </td>
                            <th width=""><p>Variable Name27 </p></th>
                            <td >{{$da[$casetypecol[53]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Variable Name8 </p></th>
                            <td >{{$da[$casetypecol[34]]}} </td>
                            <th width=""><p>Variable Name28 </p></th>
                            <td >{{$da[$casetypecol[54]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name9 </p></th>
                            <td >{{$da[$casetypecol[35]]}} </td>
                            <th width=""><p>Variable Name29 </p></th>
                            <td >{{$da[$casetypecol[55]]}} </td>
                            </tr>
                            <tr>
                            <th width=""><p>Variable Name10 </p></th>
                            <td >{{$da[$casetypecol[36]]}} </td>
                            <th width=""><p>Variable Name30 </p></th>
                            <td >{{$da[$casetypecol[56]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name11 </p></th>
                            <td >{{$da[$casetypecol[37]]}} </td>
                            <th width=""><p>Variable Name31 </p></th>
                            <td >{{$da[$casetypecol[57]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name12 </p></th>
                            <td >{{$da[$casetypecol[38]]}} </td>
                            <th width=""><p>Variable Name32 </p></th>
                            <td >{{$da[$casetypecol[58]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name13 </p></th>
                            <td >{{$da[$casetypecol[39]]}} </td>
                            <th width=""><p>Variable Name33 </p></th>
                            <td >{{$da[$casetypecol[59]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name14 </p></th>
                            <td >{{$da[$casetypecol[40]]}} </td>
                            <th width=""><p>Variable Name34 </p></th>
                            <td >{{$da[$casetypecol[60]]}} </td>
                            </tr>
                            <tr>
                            <th width=""><p>Variable Name15 </p></th>
                            <td >{{$da[$casetypecol[41]]}} </td>
                            <th width=""><p>Variable Name35 </p></th>
                            <td >{{$da[$casetypecol[61]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name16 </p></th>
                            <td >{{$da[$casetypecol[42]]}} </td>
                            <th width=""><p>Variable Name36 </p></th>
                            <td >{{$da[$casetypecol[62]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name17 </p></th>
                            <td >{{$da[$casetypecol[43]]}} </td>
                            <th width=""><p>Variable Name37 </p></th>
                            <td >{{$da[$casetypecol[63]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name18 </p></th>
                            <td >{{$da[$casetypecol[44]]}} </td>
                            <th width=""><p>Variable Name38 </p></th>
                            <td >{{$da[$casetypecol[64]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name19 </p></th>
                            <td >{{$da[$casetypecol[45]]}} </td>
                            <th width=""><p>Variable Name39 </p></th>
                            <td >{{$da[$casetypecol[65]]}} </td>
                            </tr>
                            <tr>
                            <th width=""><p>Variable Name20 </p></th>
                            <td >{{$da[$casetypecol[46]]}} </td>
                            <th width=""><p>Variable Name40 </p></th>
                            <td >{{$da[$casetypecol[66]]}} </td>
                            </tr>




                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>



                            </table>
                                                    </div>
                          <div id="menu3" class="tab-pane fade">
                            <h3>Case Variable Name 40-80</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width=""><p>Variable Name41 </p></th>
                            <td >{{$da[$casetypecol[67]]}} </td>
                            <th width=""><p>Variable Name61 </p></th>
                            <td >{{$da->var_name61}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name42 </p></th>
                            <td >{{$da[$casetypecol[68]]}} </td>
                            <th width=""><p>Variable Name62 </p></th>
                            <td >{{$da->var_name62}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name43 </p></th>
                            <td >{{$da[$casetypecol[69]]}} </td>
                            <th width=""><p>Variable Name63 </p></th>
                            <td >{{$da->var_name63}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name44</p></th>
                            <td >{{$da[$casetypecol[70]]}} </td>
                            <th width=""><p>Variable Name64 </p></th>
                            <td >{{$da->var_name64}} </td>
                            </tr>
                            <tr>
                            <th width=""><p>Variable Name45</p></th>
                            <td >{{$da[$casetypecol[71]]}} </td>
                            <th width=""><p>Variable Name65 </p></th>
                            <td >{{$da->var_name65}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name46 </p></th>
                            <td >{{$da[$casetypecol[72]]}} </td>
                            <th width=""><p>Variable Name66 </p></th>
                            <td >{{$da->var_name66}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name47 </p></th>
                            <td >{{$da[$casetypecol[73]]}} </td>
                            <th width=""><p>Variable Name67 </p></th>
                            <td >{{$da->var_name67}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name48 </p></th>
                            <td >{{$da[$casetypecol[74]]}} </td>
                            <th width=""><p>Variable Name68 </p></th>
                            <td >{{$da->var_name68}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name49 </p></th>
                            <td >{{$da[$casetypecol[75]]}} </td>
                            <th width=""><p>Variable Name69 </p></th>
                            <td >{{$da->var_name69}} </td>
                            </tr>
                            <tr>
                            <th width=""><p>Variable Name50 </p></th>
                            <td >{{$da[$casetypecol[76]]}} </td>
                            <th width=""><p>Variable Name70 </p></th>
                            <td >{{$da->var_name70}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name51 </p></th>
                            <td >{{$da[$casetypecol[77]]}} </td>
                            <th width=""><p>Variable Name71 </p></th>
                            <td >{{$da->var_name71}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name52 </p></th>
                            <td >{{$da[$casetypecol[78]]}} </td>
                            <th width=""><p>Variable Name72 </p></th>
                            <td >{{$da->var_name72}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name53 </p></th>
                            <td >{{$da[$casetypecol[79]]}} </td>
                            <th width=""><p>Variable Name73 </p></th>
                            <td >{{$da->var_name73}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name54 </p></th>
                            <td >{{$da[$casetypecol[80]]}} </td>
                            <th width=""><p>Variable Name74 </p></th>
                            <td >{{$da->var_name74}} </td>
                            </tr>
                            <tr>
                            <th width=""><p>Variable Name55 </p></th>
                            <td >{{$da[$casetypecol[81]]}} </td>
                            <th width=""><p>Variable Name75 </p></th>
                            <td >{{$da->var_name75}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name56 </p></th>
                            <td >{{$da[$casetypecol[82]]}} </td>
                            <th width=""><p>Variable Name76 </p></th>
                            <td >{{$da->var_name76}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name57 </p></th>
                            <td >{{$da[$casetypecol[83]]}} </td>
                            <th width=""><p>Variable Name77 </p></th>
                            <td >{{$da->var_name77}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name58 </p></th>
                            <td >{{$da[$casetypecol[84]]}} </td>
                            <th width=""><p>Variable Name78 </p></th>
                            <td >{{$da->var_name78}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>Variable Name59 </p></th>
                            <td >{{$da[$casetypecol[85]]}} </td>
                            <th width=""><p>Variable Name79 </p></th>
                            <td >{{$da->var_name79}} </td>
                            </tr>
                            <tr>
                            <th width=""><p>Variable Name60 </p></th>
                            <td >{{$da[$casetypecol[86]]}} </td>
                            <th width=""><p>Variable Name80</p></th>
                            <td >{{$da->var_name80}} </td>
                            </tr>




                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>



                            </table>
                                                    </div>

                            <div id="menu4" class="tab-pane fade">
                                                      <h3>Case Variable Name 80-130</h3>
                                                      <table class="table table-bordered table-hover" style="width:100%;color:black">
                                                      <th style="background-color:;color:;">
                                                      Topic
                                                      </th>
                                                      <th style="background-color:;color:;">
                                                      Details
                                                      </th>
                                                      <th style="background-color:;color:;">
                                                      Topic
                                                      </th>
                                                      <th style="background-color:;color:;">
                                                      Details
                                                      </th>
                                                      <tr>
                                                      <th width=""><p>Variable Name81 </p></th>
                                                      <td >{{$da->var_name81}} </td>
                                                      <th width=""><p>Variable Name106 </p></th>
                                                      <td >{{$da->var_name106}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name82 </p></th>
                                                      <td >{{$da->var_name82}} </td>
                                                      <th width=""><p>Variable Name107 </p></th>
                                                      <td >{{$da->var_name107}} </td>
                                                      </tr>
                                                      <tr>
                                                      <th width=""><p>Variable Name83 </p></th>
                                                      <td >{{$da->var_name83}} </td>
                                                      <th width=""><p>Variable Name108 </p></th>
                                                      <td >{{$da->var_name108}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name84 </p></th>
                                                      <td >{{$da->var_name84}} </td>
                                                      <th width=""><p>Variable Name109 </p></th>
                                                      <td >{{$da->var_name109}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name85 </p></th>
                                                      <td >{{$da->var_name85}} </td>
                                                      <th width=""><p>Variable Name110 </p></th>
                                                      <td >{{$da->var_name110}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name86 </p></th>
                                                      <td >{{$da->var_name86}} </td>
                                                      <th width=""><p>Variable Name111 </p></th>
                                                      <td >{{$da->var_name111}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name87 </p></th>
                                                      <td >{{$da->var_name87}} </td>
                                                      <th width=""><p>Variable Name112 </p></th>
                                                      <td >{{$da->var_name112}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name88 </p></th>
                                                      <td >{{$da->var_name88}} </td>
                                                      <th width=""><p>Variable Name113 </p></th>
                                                      <td >{{$da->var_name113}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name89 </p></th>
                                                      <td >{{$da->var_name89}} </td>
                                                      <th width=""><p>Variable Name114 </p></th>
                                                      <td >{{$da->var_name114}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name90 </p></th>
                                                      <td >{{$da->var_name90}} </td>
                                                      <th width=""><p>Variable Name115 </p></th>
                                                      <td >{{$da->var_name115}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name91 </p></th>
                                                      <td >{{$da->var_name91}} </td>
                                                      <th width=""><p>Variable Name116 </p></th>
                                                      <td >{{$da->var_name116}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name92 </p></th>
                                                      <td >{{$da->var_name92}} </td>
                                                      <th width=""><p>Variable Name117 </p></th>
                                                      <td >{{$da->var_name117}} </td>
                                                      </tr>
                                                      <tr>
                                                      <th width=""><p>Variable Name93 </p></th>
                                                      <td >{{$da->var_name93}} </td>
                                                      <th width=""><p>Variable Name118 </p></th>
                                                      <td >{{$da->var_name118}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name94 </p></th>
                                                      <td >{{$da->var_name94}} </td>
                                                      <th width=""><p>Variable Name119 </p></th>
                                                      <td >{{$da->var_name119}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name95 </p></th>
                                                      <td >{{$da->var_name95}} </td>
                                                      <th width=""><p>Variable Name120 </p></th>
                                                      <td >{{$da->var_name120}} </td>
                                                      </tr>
                                                      <tr>
                                                      <th width=""><p>Variable Name96 </p></th>
                                                      <td >{{$da->var_name96}} </td>
                                                      <th width=""><p>Variable Name121 </p></th>
                                                      <td >{{$da->var_name121}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name97 </p></th>
                                                      <td >{{$da->var_name97}} </td>
                                                      <th width=""><p>Variable Name122 </p></th>
                                                      <td >{{$da->var_name122}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name98 </p></th>
                                                      <td >{{$da->var_name98}} </td>
                                                      <th width=""><p>Variable Name123 </p></th>
                                                      <td >{{$da->var_name123}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name99 </p></th>
                                                      <td >{{$da->var_name99}} </td>
                                                      <th width=""><p>Variable Name124 </p></th>
                                                      <td >{{$da->var_name124}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name100 </p></th>
                                                      <td >{{$da->var_name100}} </td>
                                                      <th width=""><p>Variable Name125 </p></th>
                                                      <td >{{$da->var_name125}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name101</p></th>
                                                      <td >{{$da->var_name101}} </td>
                                                      <th width=""><p>Variable Name126 </p></th>
                                                      <td >{{$da->var_name126}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name102 </p></th>
                                                      <td >{{$da->var_name102}} </td>
                                                      <th width=""><p>Variable Name127 </p></th>
                                                      <td >{{$da->var_name127}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name103</p></th>
                                                      <td >{{$da->var_name103}} </td>
                                                      <th width=""><p>Variable Name128 </p></th>
                                                      <td >{{$da->var_name128}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name104 </p></th>
                                                      <td >{{$da->var_name104}} </td>
                                                      <th width=""><p>Variable Name129 </p></th>
                                                      <td >{{$da->var_name129}} </td>
                                                      </tr>

                                                      <tr>
                                                      <th width=""><p>Variable Name105 </p></th>
                                                      <td >{{$da->var_name105}} </td>
                                                      <th width=""><p>Variable Name130 </p></th>
                                                      <td >{{$da->var_name130}} </td>
                                                      </tr>
                                                      <th style="background-color:;color:;">
                                                      Topic
                                                      </th>
                                                      <th style="background-color:;color:;">
                                                      Details
                                                      </th>
                                                      <th style="background-color:;color:;">
                                                      Topic
                                                      </th>
                                                      <th style="background-color:;color:;">
                                                      Details
                                                      </th>



                                                      </table>
                                                                              </div>
                        </div>


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
                <th >Case Category</th>
                <th>Case Type Name</th>
                <th>Default Partner Block</th>
                <th>Default User Block</th>
                <th>Default Partner group</th>
                <th>Default Procedure</th>
                <th>Day Auto Renew</th>
                <th>Offer Category</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
			</div>
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

    <script type="text/javascript">

          $(".name").select2({
                placeholder: "Select",
                //allowClear: true
            });
    </script>
@endsection
