@extends('system-mgmt.asset.base')
@section('action-content')
  <style>
  .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}

  .card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-ms-flex:1 0 0%;flex:1 0 0%;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-webkit-box-flex:1;-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}
  .column {
    float: left;
    width: 33%;
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
  }
  .container2 {
    display: inline-block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;

    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /* Hide the browser's default radio button */
  .container2 input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }

  /* Create a custom radio button */
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #BDBDB9;
    border-radius: 50%;
  }

  /* On mouse-over, add a grey background color */
  .container2:hover input ~ .checkmark {
    background-color: #ccc;
  }

  /* When the radio button is checked, add a blue background */
  .container2 input:checked ~ .checkmark {
    background-color: #2196F3;
  }

  /* Create the indicator (the dot/circle - hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the indicator (dot/circle) when checked */
  .container2 input:checked ~ .checkmark:after {
    display: block;
  }

  /* Style the indicator (dot/circle) */
  .container2 .checkmark:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
  }

  @media screen and (max-width: 600px) {
    .card {
      font-size: 10px;
    }
    .card {
      border:none;
    }
  }
  </style>
    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
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
          <div class="card">
            @foreach($porttypes as $porttype)

          <div class="card-header"><h4>{{$porttype->name}} Asset Details</h4><div class="box-header">
            <div class="row">
                <div class="col-sm-8">

                </div>

                  <a class="btn btn-default" href="{{ URL::to('SecurityBroke/asset-transaction/show',[$porttype->id,$portid])}}">Asset Transaction</a>

            </div>
          </div>
          </div></div>
          <div class="card-body">



            <h5 class="card-title"></h5>

                <table class="table table-bordered table-hover" style="width:100%">
            <th style="background-color:#00325d;color:white;">
              Topic
            </th>
            <th style="background-color:#00325d;color:white;">
              Details
            </th>
            <tr>
              <th width="50%"><p>Liquidity Asset / Non Liquidity Asset </p></th>
              <td >{{$porttype->la_nla}} </td>

            </tr>
            <tr>
              <th width="50%"><p>Issued By</p></th>
              <td >{{$porttype->member_name}} </td>

            </tr>
            <tr>
              <th width="50%"><p>Emergency Name</p></th>
              <td >{{$porttype->emergency_name}} </td>

            </tr>
            <tr>
              <th width="50%"><p>Emergency phone</p></th>
              <td >{{$porttype->emergency_phone}} </td>

            </tr>
            <tr>
              <th width="50%"><p>Emergency email</p></th>
              <td >{{$porttype->emergency_email}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Branch</p></th>
              <td >{{$porttype->branch_name}} </td>

            </tr>
            <tr>
              <th width="50%"><p>Branch Contact</p></th>
              <td >เบอร์โทรสาขา: {{$porttype->branch_tel}} แฟ็กซ์: {{$porttype->branch_fax}}
                  <p><b>ข้อมูลผู้ติดต่อสาขา</b>   ชื่อ: {{$porttype->branch_con_name}}  {{$porttype->branch_con_lastname}} เบอร์โทร: {{$porttype->branch_con_tel}}  อีเมลล์: {{$porttype->branch_con_email}}</p></td>

            </tr>

            <tr>
              <th width="50%"><p>Asset Name</p></th>
              <td >{{$porttype->name}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Asset Type</p></th>
              <td >{{$porttype->asset_type_name}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Sub Type</p></th>
              <td >{{$porttype->asset_subtype_name}} </td>

            </tr>
              @if($porttype->name_head != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->name_head}}</p></th>
              <td >{{$porttype->ref_name}} </td>

            </tr>
            @endif

            <tr>
              <th width="50%"><p>Portfolio</p></th>
              <td >{{$porttype->port_name}} </td>

            </tr>



            @if($porttype->num_head1 != NULL)
          <tr>
            <th width="50%"><p>{{$porttype->num_head1}}</p></th>
            <td >{{$porttype->ref_number1}} </td>


          </tr>
            @endif

            @if($porttype->num_head2 != NULL)
          <tr>
            <th width="50%"><p>{{$porttype->num_head2}}</p></th>
            <td >{{$porttype->ref_number2}} </td>


          </tr>
            @endif
            @if($porttype->num_head3 != NULL)
          <tr>
            <th width="50%"><p>{{$porttype->num_head3}}</p></th>
            <td >{{$porttype->ref_number3}} </td>


          </tr>
            @endif


            @if($porttype->ref_head1 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head1}}</p></th>
              <td >{{$porttype->ref_info1}} </td>

            </tr>
            @endif
              @if($porttype->ref_head2 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head2}}</p></th>
              <td >{{$porttype->ref_info2}} </td>
              @endif
            </tr>
            @if($porttype->ref_head3 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head3}}</p></th>
              <td >{{$porttype->ref_info3}} </td>

            </tr>
            @endif
            @if($porttype->ref_head4 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head4}}</p></th>
              <td >{{$porttype->ref_info4}} </td>

            </tr>
            @endif
            @if($porttype->ref_head5 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head5}}</p></th>
              <td >{{$porttype->ref_info5}} </td>

            </tr>
            @endif
            @if($porttype->ref_head6 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head6}}</p></th>
              <td >{{$porttype->ref_info6}} </td>

            </tr>
            @endif
            @if($porttype->ref_head7 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head7}}</p></th>
              <td >{{$porttype->ref_info7}} </td>

            </tr>
            @endif
            @if($porttype->ref_head8 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head8}}</p></th>
              <td >{{$porttype->ref_info8}} </td>

            </tr>
            @endif
            @if($porttype->ref_head9 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head9}}</p></th>
              <td >{{$porttype->ref_info9}} </td>

            </tr>
            @endif
            @if($porttype->ref_head10 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head10}}</p></th>
              <td >{{$porttype->ref_info10}} </td>

            </tr>
            @endif
            @if($porttype->ref_head11 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head11}}</p></th>
              <td >{{$porttype->ref_info11}} </td>

            </tr>
            @endif
            @if($porttype->ref_head12 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head12}}</p></th>
              <td >{{$porttype->ref_info12}} </td>

            </tr>
            @endif
            @if($porttype->ref_head13 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head13}}</p></th>
              <td >{{$porttype->ref_info13}} </td>

            </tr>
            @endif
            @if($porttype->ref_head14 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head14}}</p></th>
              <td >{{$porttype->ref_info14}} </td>

            </tr>
            @endif
            @if($porttype->ref_head15 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head15}}</p></th>
              <td >{{$porttype->ref_info15}} </td>

            </tr>
            @endif
            @if($porttype->ref_head16 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head16}}</p></th>
              <td >{{$porttype->ref_info16}} </td>

            </tr>
            @endif
            @if($porttype->ref_head17 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head17}}</p></th>
              <td >{{$porttype->ref_info17}} </td>

            </tr>
            @endif
            @if($porttype->ref_head18 != NULL)
            <tr>
              <th width="50%"><p>{{$porttype->ref_head18}}</p></th>
              <td >{{$porttype->ref_info18}} </td>

            </tr>
            @endif
            <tr>
              <th width="50%"><p>Link Underlying</p></th>
              <td >{{$porttype->link_underlying}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Amount</p></th>
              <td >{{$porttype->amount}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Value</p></th>
              <td >{{$porttype->value}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Cost</p></th>
              <td >{{$porttype->cost}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Referal Asset</p></th>
              <td >{{$porttype->ref_to_asset}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Valid from</p></th>
              <td >{{$porttype->valid_from}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Valid to</p></th>
              <td >{{$porttype->valid_to}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Link To More</p></th>
              <td >{{$porttype->link_to_more}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Contact</p></th>
              <td >@foreach($conblock as $c)
                    {{$c->contact_name}}<br />{{$c->contact_tel}}<br />{{$c->contact_email}}
                  @endforeach
               </td>

            </tr>




            <tr>
              <th width="50%"><p>Last Modified</p></th>
              <td >{{$porttype->last_modified_date}} </td>

            </tr>

            <tr>
              <th width="50%"><p>Note</p></th>
              <td >{{$porttype->note}} </td>

            </tr>

            @foreach($fileasset as $key => $a)
            <tr>
              <th width="50%"><p>File {{++$key}}</p></th>
              <?php
                          $filecatuser = \App\FileCat::where('id',$a->file_cat_id)->value('user_view');
                          $filecatmiddle = \App\FileCat::where('id',$a->file_cat_id)->value('middle_view');
              ?>
                <td >  @if($filecatuser == 1 || $filecatmiddle == 1)<a style="font-size:16px" href="{{ URL::to('SecurityBroke/showfile',[$a->id])}}" >{{$a->file_public_name}}</a>

                  <br />
                  <form  role="form" method="POST" action="{{ URL::to('SecurityBroke/file/fakedelete',[$a->id,$portnumber,'xxx'])}}" onsubmit = "return confirm('Are you sure?')">
                      <input type="hidden" name="_method" value="PATCH">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
				{{--<a class ="btn btn-warning"href="{{ URL::to('SecurityBroke/asset/editfile',[$portnumber,$porttype->id,'xxx','CG2CG',$filerefname,$a->id])}}">Edit File</a>--}}
                              <button class ="btn btn-danger" type="submit"  >
                                  Delete..
                              </button>

                  </form>
                  @else
                  @endif
                </td >

            </tr>
            @endforeach
            <tr>
              <th width="50%"><p>Add File</p></th>
                <td >  <a class ="btn btn-info" href="{{ URL::to('SecurityBroke/asset/uploadfile',[$portnumber,$porttype->id,'xxx','CG2CG',$filerefname])}}">Add File</a>

                </td >

            </tr>


          <th style="background-color:#00325d;color:white;">
            Topic
          </th>
          <th style="background-color:#00325d;color:white;">
            Details
          </th>



        </table>
	@break
        @endforeach


        <br>



          </div>
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
