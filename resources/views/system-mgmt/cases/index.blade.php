@extends('system-mgmt.cases.base')
@section('action-content')
    <!-- Main content -->
<style>
div.absolute {
  position: fixed;
  top: 200px;
  right: 15px;
  width: 200px;
  height: 500px;
  overflow-y:scroll;
  overflow-x:hidden;

}
.card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}
.column {
  float: left;
  width: 25%;
  right: 15px;

 /* Should be removed. Only for demonstration */
}
</style>
    <section class="content">

      <div class="box">

  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Case</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('cases.create') }}">Add new Case</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('cases.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Case Name</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="name">
                      <option value="" ></option>
                      @foreach ($case as $sta)
                          <option value="{{$sta->name}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Case Type</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="type_id">
                      <option value="" ></option>
                      @foreach ($casetype as $sta)
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

                  <label for="file_category_name" class="col-sm-3 control-label">Case Sub Type</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="sub_type_id">
                      <option value="" ></option>
                      @foreach ($casesubtype as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Created By</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="created_by_pid">
                      <option value="" ></option>
                      @foreach ($public_id as $sta)
                          <option value="{{$sta->id}}">{{$sta->id}} {{$sta->public_name}}</option>
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

                  <label for="file_category_name" class="col-sm-3 control-label">Consult Partner Block</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="consult_partner_block_id">
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

                  <label for="file_category_name" class="col-sm-3 control-label">Service User Block</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="service_user_block_id">
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

                  <label for="file_category_name" class="col-sm-3 control-label">Coordinate User Block</label>
                  <div class="col-md-9">

                    <select  class="form-control name" name="coordinate_user_block_id">
                      <option value="" ></option>
                      @foreach ($user as $sta)
                          <option value="{{$sta->id}}">{{$sta->firstname}} {{$sta->lastname}}</option>
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
                <th >Created Date</th>
                <th>Case Name </th>
                <th >Case Category</th>
                  <th>Case Type </th>
                  <th>Case SubType </th>

                  <th>Created By(PID)</th>
                  <th>Procedure</th>
                  <th>Stage</th>
                <th>Consult Partner Block</th>
                <th>Service User Block</th>
                <th>Coordinate User Block</th>
                <th>Case Owner</th>
                <th>Case Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $da)
            <tr  data-toggle="toggle" data-target="#myModal{{$da[$casecol[0]] }}">
                  <td>{{$da[$casecol[95]]}} </td>
                  <td>{{$da[$casecol[1]]}}</td>
                  <td>{{$da->CaseType->CaseCategory[$casecatcol[1]]}}</td>
                  <td>{{$da->CaseType[$casetypecol[2]]}}</td>
                  <td>{{$da->CaseSubType->name}}</td>
                  @if($da->created_by_pid == NULL || $da->created_by_pid == 0)
                  <td></td>
                  @else
                  <td>{{$da->match_id->public_name}}</td>
                  @endif
                  @if($da->procedure_id == NULL || $da->procedure_id == 0)
                  <td></td>
                  @else
                  <td>{{$da->Procedures->name}}</td>
                  @endif
                  @if($da->stage == NULL || $da->stage == 0)
                  <td></td>
                  @else
                  <td>{{$da->Stage->name}}
                    @if($da->description != NULL)
                    <p style="color:red">
                    {{$da->description}}
                  </p>
                  @else
                  @endif
                  </td>
                  @endif
                  @if($da->consult_partner_block_id == NULL || $da->consult_partner_block_id == 0)
                  <td></td>
                  @else
                  <td>{{$da->Partner_block->name}}</td>
                  @endif
                  @if($da->service_user_block_id == NULL || $da->service_user_block_id == 0)
                  <td></td>
                  @else
                  <td>{{$da->Block->name}}</td>
                  @endif
                  @if($da->coordinate_user_block_id == NULL || $da->coordinate_user_block_id == 0)
                  <td></td>
                  @else
                  <td>{{$da->coordiantor->firstname}} {{$da->coordiantor->lastname}}</td>
                  @endif
                  @if($da->member_case_owner == NULL || $da->member_case_owner == 0)
                  <td></td>
                  @else
                  <td>{{$da->Person->name}} {{$da->Person->lname}}</td>
                  @endif
                  @if($da->case_status == NULL || $da->case_status == 0)
                  <td></td>
                  @else
                  <td>{{$da->CaseStatus->name}} {{$da->CaseStatus->lname}}</td>
                  @endif
                  <td>
                    <form class="row" method="POST" action="{{ route('cases.destroy', ['id' =>$da[$casecol[0]]]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('cases.edit', ['id' => $da[$casecol[0]]]) }}" class="btn btn-warning  btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger  btn-margin">
                          Delete
                        </button>
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{$da[$casecol[0]] }}">More Details</button>
                    </form>

                    <div class="modal " id="myModal{{ $da[$casecol[0]] }}" role="dialog">
                    <div class="modal-dialog">

                    <!-- Modal content-->

                    <div class="modal-content">


                      <div class="modal-header" style="background-color:#;color:white;">

                        <p style="color:white" class="modal-title">
                           <ul class="nav nav-tabs">
                                                  <li class="active"><a data-toggle="tab" href="#home{{ $da[$casecol[0]] }}">General </a></li>
                                                  <li><a data-toggle="tab" href="#menu1{{ $da[$casecol[0]] }}">Requirement</a></li>
                                                  <li><a data-toggle="tab" href="#menu2{{ $da[$casecol[0]] }}">Variable1-40</a></li>
                                                  <li><a data-toggle="tab" href="#menu3{{ $da[$casecol[0]] }}">Variable41-80</a></li>
                                                  <li><a data-toggle="tab" href="#menu4{{ $da[$casecol[0]] }}">Variable81-130</a></li>
                                                </ul></p>
                      </div>
                      <div class="modal-body">


                        <div class="tab-content">
                          <div id="home{{ $da[$casecol[0]] }}" class="tab-pane  in active">
                            <h3>General Information</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width=""><p>Case Name </p></th>
                            <td >{{$da[$casecol[2]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Case Category </p></th>
                            <td >{{$da->CaseType->CaseCategory[$casecatcol[1]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Case Type </p></th>
                            <td >{{$da->CaseType[$casetypecol[2]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Case Sub Type </p></th>
                            <td >{{$da->CaseSubType->name}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Created By(PID) </p></th>
                            <td >{{$da->match_id->public_name}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Procedure </p></th>
                            @if($da->procedure_id == NULL || $da->procedure_id == 0)
                            <td></td>
                            @else
                            <td>{{$da->Procedures->name}}</td>
                            @endif

                            </tr>
                            <tr>
                            <th width=""><p>Stage </p></th>
                            @if($da->stage == NULL || $da->stage == 0)
                            <td></td>
                            @else
                            <td>{{$da->Stage->name}}</td>
                            @endif
                            </tr>
                            <tr>
                            <th width=""><p>Refereal Asset </p></th>
                            <td >{{$da->Asset->name}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>Referal Previous Case </p></th>
                            @if($da->ref_previous_case == NULL ||$da->ref_previous_case == 0 )
                            <td></td>
                            @else
                            <td >{{$da->Cases->name}} </td>
                            @endif
                            </tr>

                            <th width=""><p>Case Channel </p></th>
                            @if($da->case_channel == NULL || $da->case_channel == 0)
                            <td></td>
                            @else
                            <td>{{$da->CaseChannel->name}}</td>
                            @endif
                            <tr>
                            <th width=""><p>Consult Partner Block  </p></th>
                            <td >{{$da->Partner_block->name}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Service User Block </p></th>
                            <td >{{$da->Block->name}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Coordinate User Block </p></th>
                            <td >{{$da->coordiantor->name}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Case Created Date </p></th>
                            <td >{{$da[$casecol[95]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Case Last Updateed date </p></th>
                            <td >{{$da[$casecol[96]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Auto Renew Date </p></th>
                            <td >{{$da[$casecol[97]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Next Notify Date </p></th>
                            <td >{{$da[$casecol[98]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Note From Previous Case </p></th>
                            <td >{{$da[$casecol[99]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Note To Copy To Renew Case </p></th>
                            <td >{{$da[$casecol[100]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Note From Member </p></th>
                            <td >{{$da[$casecol[101]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Note From Partner </p></th>
                            <td >{{$da[$casecol[102]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>Note From User </p></th>
                            <td >{{$da[$casecol[103]]}} </td>

                            </tr>
                            <?php
                              $findfileid = \App\Case_Attacht::where('case_id',$da->id)->pluck('file_id');
                              $fileasset =\App\File::whereIn('id',$findfileid)->where('status','=','Active')->get();
                             ?>
                            @foreach($fileasset as $key => $a)
                            <tr>
                            <td> File{{++$key}}</td>
                            <?php
                              $filecatuser = \App\FileCat::where('id',$a->file_cat_id)->value('user_view');
                             ?>
                            <td >  @if($filecatuser == 1)<a style="font-size:16px" href="/SecurityBroke/showfile/{{$a->id}}?{{$da->id}}" >{{$a->file_public_name}}</a>
                              @else
                              @endif
                              <br />
                              <form  role="form" method="POST" action="/SecurityBroke/file/fakedelete/{{$a->id}}/{{$da->id}}/xxx?offerdelete" onsubmit = "return confirm('Are you sure?')">
                                  <input type="hidden" name="_method" value="PATCH">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                          <button class ="btn btn-danger" type="submit"  >
                                              Delete..
                                          </button>

                              </form>
                            </td >

                            </tr>
                            @endforeach
                            <tr>
                            <th width=""><p>Add File </p></th>
                            <th ><a class ="btn btn-info" href="/SecurityBroke/case/uploadfile/{{$da->id}}/xxx/CG4CG/{{$filerefname}}{{$da->id}}">Add File</a></th>

                            </tr>


                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>



                            </table>
                          </div>
                          <div id="menu1{{ $da[$casecol[0]] }}" class="tab-pane ">
                            <h3>Requirement Variable Name</h3>
                            <table class="table table-bordered table-hover" style="width:100%;color:black">
                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[7]]}} </p></th>
                            <td >{{$da[$casecol[7]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[8]]}} </p></th>
                            <td >{{$da[$casecol[8]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[9]]}} </p></th>
                            <td >{{$da[$casecol[9]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[10]]}} </p></th>
                            <td >{{$da[$casecol[10]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[11]]}} </p></th>
                            <td >{{$da[$casecol[11]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[12]]}} </p></th>
                            <td >{{$da[$casecol[12]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[13]]}} </p></th>
                            <td >{{$da[$casecol[13]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[14]]}} </p></th>
                            <td >{{$da[$casecol[14]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[15]]}} </p></th>
                            <td >{{$da[$casecol[15]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[16]]}} </p></th>
                            <td >{{$da[$casecol[16]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[17]]}} </p></th>
                            <td >{{$da[$casecol[17]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[18]]}} </p></th>
                            <td >{{$da[$casecol[18]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[19]]}} </p></th>
                            <td >{{$da[$casecol[19]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[20]]}} </p></th>
                            <td >{{$da[$casecol[20]]}} </td>

                            </tr>



                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[21]]}} </p></th>
                            <td >{{$da[$casecol[21]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[22]]}} </p></th>
                            <td >{{$da[$casecol[22]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[23]]}}</p></th>
                            <td >{{$da[$casecol[23]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[24]]}} </p></th>
                            <td >{{$da[$casecol[24]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[25]]}} </p></th>
                            <td >{{$da[$casecol[25]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[26]]}} </p></th>
                            <td >{{$da[$casecol[26]]}} </td>

                            </tr>


                            <th style="background-color:;color:;">
                            Topic
                            </th>
                            <th style="background-color:;color:;">
                            Details
                            </th>



                            </table>
                                                  </div>
                          <div id="menu2{{ $da[$casecol[0]] }}" class="tab-pane ">
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
                            <th width=""><p>{{$da->CaseType[$casetypecol[27]]}} </p></th>
                            <td >{{$da[$casecol[27]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[47]]}} </p></th>
                            <td >{{$da[$casecol[47]]}} </td>
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[28]]}} </p></th>
                            <td >{{$da[$casecol[28]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[48]]}} </p></th>
                            <td >{{$da[$casecol[48]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[29]]}} </p></th>
                            <td >{{$da[$casecol[29]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[49]]}} </p></th>
                            <td >{{$da[$casecol[49]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[30]]}}</p></th>
                            <td >{{$da[$casecol[30]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[50]]}}</p></th>
                            <td >{{$da[$casecol[50]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[31]]}}</p></th>
                            <td >{{$da[$casecol[31]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[51]]}}</p></th>
                            <td >{{$da[$casecol[51]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[32]]}} </p></th>
                            <td >{{$da[$casecol[32]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[52]]}} </p></th>
                            <td >{{$da[$casecol[52]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[33]]}} </p></th>
                            <td >{{$da[$casecol[33]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[53]]}} </p></th>
                            <td >{{$da[$casecol[53]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[34]]}} </p></th>
                            <td >{{$da[$casecol[34]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[54]]}}</p></th>
                            <td >{{$da[$casecol[54]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[35]]}} </p></th>
                            <td >{{$da[$casecol[35]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[55]]}} </p></th>
                            <td >{{$da[$casecol[55]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[36]]}} </p></th>
                            <td >{{$da[$casecol[36]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[56]]}} </p></th>
                            <td >{{$da[$casecol[56]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[37]]}} </p></th>
                            <td >{{$da[$casecol[37]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[57]]}} </p></th>
                            <td >{{$da[$casecol[57]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[38]]}} </p></th>
                            <td >{{$da[$casecol[38]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[58]]}} </p></th>
                            <td >{{$da[$casecol[58]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[39]]}} </p></th>
                            <td >{{$da[$casecol[39]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[59]]}} </p></th>
                            <td >{{$da[$casecol[59]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[40]]}} </p></th>
                            <td >{{$da[$casecol[40]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[60]]}} </p></th>
                            <td >{{$da[$casecol[60]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[41]]}} </p></th>
                            <td >{{$da[$casecol[41]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[61]]}} </p></th>
                            <td >{{$da[$casecol[61]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[42]]}} </p></th>
                            <td >{{$da[$casecol[42]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[62]]}} </p></th>
                            <td >{{$da[$casecol[62]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[43]]}} </p></th>
                            <td >{{$da[$casecol[43]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[63]]}} </p></th>
                            <td >{{$da[$casecol[63]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[44]]}} </p></th>
                            <td >{{$da[$casecol[44]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[64]]}} </p></th>
                            <td >{{$da[$casecol[64]]}} </td>

                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[45]]}} </p></th>
                            <td >{{$da[$casecol[45]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[64]]}} </p></th>
                            <td >{{$da[$casecol[64]]}} </td>

                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[46]]}} </p></th>
                            <td >{{$da[$casecol[46]]}} </td>
                            <th width=""><p>{{$da->CaseType[$casetypecol[66]]}} </p></th>
                            <td >{{$da[$casecol[66]]}} </td>

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
                          <div id="menu3{{ $da[$casecol[0]] }}" class="tab-pane ">
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
                            @if($da->CaseType->var_name81 == NULL ||$da->CaseType->var_name81 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name81}}</p></th>
                            <td >{{$da->var_value81}} </td>
                            @endif
                            @if($da->CaseType->var_name106 == NULL ||$da->CaseType->var_name106 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name106}}</p></th>
                            <td >{{$da->var_value106}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[68]]}} </p></th>
                            <td >{{$da[$casecol[68]]}} </td>
                            @if($da->CaseType->var_name62 == NULL ||$da->CaseType->var_name62 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name62}}</p></th>
                            <td >{{$da->var_value62}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[69]]}} </p></th>
                            <td >{{$da[$casecol[69]]}} </td>
                            @if($da->CaseType->var_name63 == NULL ||$da->CaseType->var_name63 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name63}}</p></th>
                            <td >{{$da->var_value63}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[70]]}}</p></th>
                            <td >{{$da[$casecol[70]]}} </td>
                            @if($da->CaseType->var_name64 == NULL ||$da->CaseType->var_name64 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name64}}</p></th>
                            <td >{{$da->var_value64}} </td>
                            @endif
                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[71]]}}</p></th>
                            <td >{{$da[$casecol[71]]}} </td>
                            @if($da->CaseType->var_name65 == NULL ||$da->CaseType->var_name65 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name65}}</p></th>
                            <td >{{$da->var_value65}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[72]]}} </p></th>
                            <td >{{$da[$casecol[72]]}} </td>
                            @if($da->CaseType->var_name66 == NULL ||$da->CaseType->var_name66 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name66}}</p></th>
                            <td >{{$da->var_value66}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[73]]}} </p></th>
                            <td >{{$da[$casecol[73]]}} </td>
                            @if($da->CaseType->var_name67 == NULL ||$da->CaseType->var_name67 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name67}}</p></th>
                            <td >{{$da->var_value67}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[74]]}} </p></th>
                            <td >{{$da[$casecol[74]]}} </td>
                            @if($da->CaseType->var_name68 == NULL ||$da->CaseType->var_name68 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name68}}</p></th>
                            <td >{{$da->var_value68}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[75]]}} </p></th>
                            <td >{{$da[$casecol[75]]}} </td>
                            @if($da->CaseType->var_name69 == NULL ||$da->CaseType->var_name69 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name69}}</p></th>
                            <td >{{$da->var_value69}} </td>
                            @endif
                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[76]]}} </p></th>
                            <td >{{$da[$casecol[76]]}} </td>
                            @if($da->CaseType->var_name70 == NULL ||$da->CaseType->var_name70 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name70}}</p></th>
                            <td >{{$da->var_value70}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[77]]}} </p></th>
                            <td >{{$da[$casecol[77]]}} </td>
                            @if($da->CaseType->var_name71 == NULL ||$da->CaseType->var_name71 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name71}}</p></th>
                            <td >{{$da->var_value71}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[78]]}} </p></th>
                            <td >{{$da[$casecol[78]]}} </td>
                            @if($da->CaseType->var_name72 == NULL ||$da->CaseType->var_name72 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name72}}</p></th>
                            <td >{{$da->var_value72}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[79]]}} </p></th>
                            <td >{{$da[$casecol[79]]}} </td>
                            @if($da->CaseType->var_name73 == NULL ||$da->CaseType->var_name73 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name73}}</p></th>
                            <td >{{$da->var_value73}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[80]]}} </p></th>
                            <td >{{$da[$casecol[80]]}} </td>
                            @if($da->CaseType->var_name74 == NULL ||$da->CaseType->var_name74 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name74}}</p></th>
                            <td >{{$da->var_value74}} </td>
                            @endif
                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[81]]}} </p></th>
                            <td >{{$da[$casecol[81]]}} </td>
                            @if($da->CaseType->var_name75 == NULL ||$da->CaseType->var_name75 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name75}}</p></th>
                            <td >{{$da->var_value75}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[82]]}} </p></th>
                            <td >{{$da[$casecol[82]]}} </td>
                            @if($da->CaseType->var_name76 == NULL ||$da->CaseType->var_name76 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name76}}</p></th>
                            <td >{{$da->var_value76}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[83]]}} </p></th>
                            <td >{{$da[$casecol[83]]}} </td>
                            @if($da->CaseType->var_name77 == NULL ||$da->CaseType->var_name77 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name77}}</p></th>
                            <td >{{$da->var_value77}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[84]]}} </p></th>
                            <td >{{$da[$casecol[84]]}} </td>
                            @if($da->CaseType->var_name78 == NULL ||$da->CaseType->var_name78 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name78}}</p></th>
                            <td >{{$da->var_value78}} </td>
                            @endif
                            </tr>

                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[85]]}} </p></th>
                            <td >{{$da[$casecol[85]]}} </td>
                            @if($da->CaseType->var_name79 == NULL ||$da->CaseType->var_name79 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name61}}</p></th>
                            <td >{{$da->var_value61}} </td>
                            @endif
                            </tr>
                            <tr>
                            <th width=""><p>{{$da->CaseType[$casetypecol[86]]}} </p></th>
                            <td >{{$da[$casecol[86]]}} </td>
                            @if($da->CaseType->var_name80 == NULL ||$da->CaseType->var_name80 == 0)
                            <th></th><td></td>
                            @else
                            <th width=""><p>{{$da->CaseType->var_name80}}</p></th>
                            <td >{{$da->var_value80}} </td>
                            @endif
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

                            <div id="menu4{{ $da[$casecol[0]] }}" class="tab-pane ">
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
                              @if($da->CaseType->var_name81 == NULL ||$da->CaseType->var_name81 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name81}}</p></th>
                              <td >{{$da->var_value81}} </td>
                              @endif
                              @if($da->CaseType->var_name106 == NULL ||$da->CaseType->var_name106 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name106}}</p></th>
                              <td >{{$da->var_value106}} </td>
                              @endif
                              </tr>

                              <tr>
                              @if($da->CaseType->var_name82 == NULL ||$da->CaseType->var_name82 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name82}}</p></th>
                              <td >{{$da->var_value82}} </td>
                              @endif
                              @if($da->CaseType->var_name107 == NULL ||$da->CaseType->var_name107 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name107}}</p></th>
                              <td >{{$da->var_value107}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name83 == NULL ||$da->CaseType->var_name83 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name83}}</p></th>
                              <td >{{$da->var_value83}} </td>
                              @endif
                              @if($da->CaseType->var_name108 == NULL ||$da->CaseType->var_name108 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name108}}</p></th>
                              <td >{{$da->var_value108}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name84 == NULL ||$da->CaseType->var_name84 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name84}}</p></th>
                              <td >{{$da->var_value84}} </td>
                              @endif
                              @if($da->CaseType->var_name109 == NULL ||$da->CaseType->var_name109 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name109}}</p></th>
                              <td >{{$da->var_value109}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name85 == NULL ||$da->CaseType->var_name85 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name85}}</p></th>
                              <td >{{$da->var_value85}} </td>
                              @endif
                              @if($da->CaseType->var_name110 == NULL ||$da->CaseType->var_name110 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name110}}</p></th>
                              <td >{{$da->var_value110}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name86 == NULL ||$da->CaseType->var_name86 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name86}}</p></th>
                              <td >{{$da->var_value86}} </td>
                              @endif
                              @if($da->CaseType->var_name111 == NULL ||$da->CaseType->var_name111 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name111}}</p></th>
                              <td >{{$da->var_value111}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name87 == NULL ||$da->CaseType->var_name87 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name87}}</p></th>
                              <td >{{$da->var_value87}} </td>
                              @endif
                              @if($da->CaseType->var_name112 == NULL ||$da->CaseType->var_name112 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name112}}</p></th>
                              <td >{{$da->var_value112}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name88 == NULL ||$da->CaseType->var_name88 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name88}}</p></th>
                              <td >{{$da->var_value88}} </td>
                              @endif
                              @if($da->CaseType->var_name113 == NULL ||$da->CaseType->var_name113 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name113}}</p></th>
                              <td >{{$da->var_value113}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name89 == NULL ||$da->CaseType->var_name89 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name89}}</p></th>
                              <td >{{$da->var_value89}} </td>
                              @endif
                              @if($da->CaseType->var_name114 == NULL ||$da->CaseType->var_name114 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name114}}</p></th>
                              <td >{{$da->var_value114}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name90 == NULL ||$da->CaseType->var_name90 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name90}}</p></th>
                              <td >{{$da->var_value90}} </td>
                              @endif
                              @if($da->CaseType->var_name115 == NULL ||$da->CaseType->var_name115 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name115}}</p></th>
                              <td >{{$da->var_value115}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name91 == NULL ||$da->CaseType->var_name91 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name91}}</p></th>
                              <td >{{$da->var_value91}} </td>
                              @endif
                              @if($da->CaseType->var_name116 == NULL ||$da->CaseType->var_name116 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name116}}</p></th>
                              <td >{{$da->var_value116}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name92 == NULL ||$da->CaseType->var_name92 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name92}}</p></th>
                              <td >{{$da->var_value92}} </td>
                              @endif
                              @if($da->CaseType->var_name117 == NULL ||$da->CaseType->var_name117 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name117}}</p></th>
                              <td >{{$da->var_value117}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name93 == NULL ||$da->CaseType->var_name93 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name118}}</p></th>
                              <td >{{$da->var_value118}} </td>
                              @endif
                              @if($da->CaseType->var_name118 == NULL ||$da->CaseType->var_name118 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name118}}</p></th>
                              <td >{{$da->var_value118}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name94 == NULL ||$da->CaseType->var_name94 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name94}}</p></th>
                              <td >{{$da->var_value94}} </td>
                              @endif
                              @if($da->CaseType->var_name119 == NULL ||$da->CaseType->var_name119 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name119}}</p></th>
                              <td >{{$da->var_value119}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name95 == NULL ||$da->CaseType->var_name95 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name95}}</p></th>
                              <td >{{$da->var_value95}} </td>
                              @endif
                              @if($da->CaseType->var_name120 == NULL ||$da->CaseType->var_name120 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name120}}</p></th>
                              <td >{{$da->var_value120}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name96 == NULL ||$da->CaseType->var_name96 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name96}}</p></th>
                              <td >{{$da->var_value96}} </td>
                              @endif
                              @if($da->CaseType->var_name121 == NULL ||$da->CaseType->var_name121 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name121}}</p></th>
                              <td >{{$da->var_value121}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name97 == NULL ||$da->CaseType->var_name97 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name97}}</p></th>
                              <td >{{$da->var_value97}} </td>
                              @endif
                              @if($da->CaseType->var_name122 == NULL ||$da->CaseType->var_name122 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name122}}</p></th>
                              <td >{{$da->var_value122}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name98 == NULL ||$da->CaseType->var_name98 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name98}}</p></th>
                              <td >{{$da->var_value98}} </td>
                              @endif
                              @if($da->CaseType->var_name123 == NULL ||$da->CaseType->var_name123 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name123}}</p></th>
                              <td >{{$da->var_value123}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name99 == NULL ||$da->CaseType->var_name99 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name99}}</p></th>
                              <td >{{$da->var_value99}} </td>
                              @endif
                              @if($da->CaseType->var_name124 == NULL ||$da->CaseType->var_name124 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name124}}</p></th>
                              <td >{{$da->var_value124}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name100 == NULL ||$da->CaseType->var_name100 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name100}}</p></th>
                              <td >{{$da->var_value100}} </td>
                              @endif
                              @if($da->CaseType->var_name125 == NULL ||$da->CaseType->var_name125 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name125}}</p></th>
                              <td >{{$da->var_value125}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name101 == NULL ||$da->CaseType->var_name101 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name101}}</p></th>
                              <td >{{$da->var_value101}} </td>
                              @endif
                              @if($da->CaseType->var_name126 == NULL ||$da->CaseType->var_name126 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name126}}</p></th>
                              <td >{{$da->var_value126}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name102 == NULL ||$da->CaseType->var_name102 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name102}}</p></th>
                              <td >{{$da->var_value102}} </td>
                              @endif
                              @if($da->CaseType->var_name127 == NULL ||$da->CaseType->var_name127 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name127}}</p></th>
                              <td >{{$da->var_value127}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name103 == NULL ||$da->CaseType->var_name103 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name103}}</p></th>
                              <td >{{$da->var_value103}} </td>
                              @endif
                              @if($da->CaseType->var_name128 == NULL ||$da->CaseType->var_name128 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name128}}</p></th>
                              <td >{{$da->var_value128}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name104 == NULL ||$da->CaseType->var_name104 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name104}}</p></th>
                              <td >{{$da->var_value104}} </td>
                              @endif
                              @if($da->CaseType->var_name129 == NULL ||$da->CaseType->var_name129 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name129}}</p></th>
                              <td >{{$da->var_value129}} </td>
                              @endif
                              </tr>
                              <tr>
                              @if($da->CaseType->var_name105 == NULL ||$da->CaseType->var_name105 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name105}}</p></th>
                              <td >{{$da->var_value105}} </td>
                              @endif
                              @if($da->CaseType->var_name130 == NULL ||$da->CaseType->var_name130 == 0)
                              <th></th><td></td>
                              @else
                              <th width=""><p>{{$da->CaseType->var_name130}}</p></th>
                              <td >{{$da->var_value130}} </td>
                              @endif
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
                <th >Created Date</th>
                <th >Case Category</th>
                  <th>Case Type </th>
                  <th>Case SubType </th>
                  <th>Case Name </th>
                  <th>Created By(PID)</th>
                  <th>Procedure</th>
                  <th>Stage</th>
                <th>Consult Partner Block</th>
                <th>Service User Block</th>
                <th>Coordinate User Block</th>
                <th>Case Owner</th>
                <th>Case Status</th>
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
