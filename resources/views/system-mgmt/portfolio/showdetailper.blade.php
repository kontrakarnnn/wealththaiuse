@extends('system-mgmt.portfolio.base2')
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
    .card,.btn {
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
            @foreach($ref as $porttype)
          <div class="card-header"><h4>{{$porttype->type}} Port Details</h4></div>
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
        <th    ><p>Port Name</p></th>
        <td >{{$porttype->type}} </td>

      </tr>

      <tr>
        <th    ><p>Port Number</p></th>
        <td >{{$porttype->number}} </td>
      </tr>
      <tr>
        <th    ><p>Structure</p></th>
        <td >{{$porttype->structure_name}} </td>
      </tr>
      <tr>
        <th    ><p>Block</p></th>
        <td >{{$porttype->block_name}} </td>
      </tr>
      <tr>
        <th    ><p>Member</p></th>
        <td >{{$porttype->member_name}} </td>
      </tr>
      <tr>
        <th    ><p>Status</p></th>
        <td >{{$porttype->status}} </td>
      </tr>
      <tr>
        <th    ><p>Portfolio Type</p></th>
        <td >{{$porttype->port_name}} </td>
      </tr>
      <tr>
        <th    ><p>Description</p></th>
        <td >{{$porttype->description}} </td>
      </tr>
      <tr>
        <th    ><p>available_from_date</p></th>
        <td >{{$porttype->available_from_date}} </td>
      </tr>
      <tr>
        <th    ><p>available_to_date</p></th>
        <td >{{$porttype->available_to_date}} </td>
      </tr>

      @if($porttype->port_lebel1 !=NULL)
      <tr>
        <th    ><p>{{$porttype->port_lebel1}}</p></th>
        <td >{{$porttype->port_detail_data1}} </td>
      </tr>
      @endif
      @if($porttype->port_lebel2 !=NULL)
      <tr>
        <th    ><p>{{$porttype->port_lebel2}}</p></th>
        <td >{{$porttype->port_detail_data2}} </td>
      </tr>
      @endif
      @if($porttype->port_lebel3 !=NULL)
      <tr>
        <th    ><p>{{$porttype->port_lebel3}}</p></th>
        <td >{{$porttype->port_detail_data3}} </td>
      </tr>
      @endif
      @if($porttype->port_lebel4 !=NULL)
      <tr>
        <th    ><p>{{$porttype->port_lebel4}}</p></th>
        <td >{{$porttype->port_detail_data4}} </td>
      </tr>
      @endif
      @if($porttype->port_lebel5 !=NULL)
      <tr>
        <th    ><p>{{$porttype->port_lebel5}}</p></th>
        <td >{{$porttype->port_detail_data5}} </td>
      </tr>
      @endif
      @if($porttype->port_lebel6 !=NULL)
      <tr>
        <th    ><p>{{$porttype->port_lebel6}}</p></th>
        <td >{{$porttype->port_detail_data6}} </td>
      </tr>
      @endif
      @if($porttype->port_lebel7 !=NULL)
      <tr>
        <th    ><p>{{$porttype->port_lebel7}}</p></th>
        <td >{{$porttype->port_detail_data7}} </td>
      </tr>
      @endif
      <tr>
        <th    ><p>Link 1</p></th>
        <td ><a href="/link/{{$porttype->ref_link_id1}}" >{{$porttype->ref_name1}} </td>
      </tr>
      <tr>
        <th    ><p>Link 2</p></th>
        <td ><a href="/link/{{$porttype->ref_link_id2}}" >{{$porttype->ref_name2}} </td>
      </tr>
      <tr>
        <th    ><p>Link 3</p></th>
        <td ><a href="/link/{{$porttype->ref_link_id3}}" >{{$porttype->ref_name3}} </td>
      </tr>
      <tr>
        <th    ><p>referal_id1</p></th>
        <td >{{$porttype->referal_id1}} </td>
      </tr>
      <tr>
        <th    ><p>referal_id2</p></th>
        <td >{{$porttype->referal_id2}} </td>
      </tr>
      <tr>
        <th    ><p>referal_id3</p></th>
        <td >{{$porttype->referal_id3}} </td>
      </tr>
      <tr>
        <th    ><p>issuer_name</p></th>
        <td >{{$porttype->issuer_name}} </td>
      </tr>
      @if($porttype->port_limitvalue !=NULL)
      <tr>
        <th    ><p>{{$porttype->port_limitvalue}}</p></th>
        <td >{{$porttype->portfolio_limit_value}} </td>
      </tr>
      @endif
      <tr>
        <th    ><p>Notice</p></th>
        <td >{{$porttype->Notice}} </td>
      </tr>
      <tr>
        <th    ><p>call_center</p></th>
        <td >{{$porttype->call_center}} </td>
      </tr>
      <tr>




        <th    ><p>{{$porttype->port_label1}}</p></th>



        @foreach ($files1 as $key =>$re)
          @if($re->status == 'Delete')
          <td style="color:red">this file has been deleted</td>

          @else
        <td ><a style="font-size:16px" href="{{ URL::to('port/showfile',[$re->id])}}" >{{$re->file_public_name}}</a>

          <br />

      </td>
      @endif
        @endforeach


      </tr>
      <tr>
        <th    ><p>{{$porttype->port_label2}}</p></th>
        @if($porttype->file_port_ref2 == NULL)
        <td > </td >
        @else
        @foreach ($files2 as $key =>$ree)
        @if($ree->status == 'Delete')
        <td style="color:red">this file has been deleted</td>

        @else
        <td ><a style="font-size:16px" href="{{ URL::to('port/showfile',[$ree->id])}}" >{{$ree->file_public_name}}</a></a>
        </td>
          @endif
        @endforeach
        @endif
      </tr>
      <tr>
        <th    ><p>{{$porttype->port_label3}}</p></th>
        @if($porttype->file_port_ref3 == NULL)
      <td > </td >
        @else
        @foreach ($files3 as $key =>$reee)
        @if($reee->status == 'Delete')
        <td style="color:red">this file has been deleted</td>

        @else
        <td ><a style="font-size:16px" href="{{ URL::to('port/showfile',[$reee->id])}}" >{{$reee->file_public_name}}</a>

        </td>
        @endif
        @endforeach
        @endif
      </tr>
      <th style="background-color:#00325d;color:white;">
        Topic
      </th>
      <th style="background-color:#00325d;color:white;">
        Details
      </th>



    </table>
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


@endsection
