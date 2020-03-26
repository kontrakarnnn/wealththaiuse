@extends('system-mgmt.notiper.base')

@section('action-content')
    <!-- Main content -->
    <section class="content">

  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>


    <div id="example2_wrapper" class=" form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">



			<div style="overflow-x:auto;">

        <div class="panel panel-default">
          <div style=""class="panel-heading" >
@foreach ($notis as $notis)

			
          <H3 style=" text-align:left;">From : {{ $notis->recieve_name }} <p style="display: inline; font-size:55%;">({{ $notis->recieve_email }})</p></h3>

            <p style=" text-align:right;">{{ $notis->created_at }}   </p></div>
            <br>
<div class="container" >




			<p><p style="display: inline; font-weight: bold;">Message Topic : </p>{{ $notis->topic }}   </p>
              <p><p style="display: inline; font-weight: bold;">Sender Name </p>{{ $notis->recieve_name }}   </p>


        <p ><p style="display: inline; font-weight: bold;">Message Type : </p>{{ $notis->message_type_name }}   </p>


       


           


           <p><p style="display: inline; font-weight: bold;">Message : </p><p style="margin-left:100px;"> {{ $notis->message_type_default }} {!! html_entity_decode($notis->message)!!}</p>   </p>


           <p><p style="display: inline; font-weight: bold;">Public ID : </p>{{ $notis->recieve_id}}    </p>


           <p><p style="display: inline; font-weight: bold;">Email : </p><a href="mailto: {{ $notis->recieve_email }}" target="_top">{{ $notis->recieve_email }}</a>   </p>


           <p><p style="display: inline; font-weight: bold;">Mobile : </p><a href="tel: {{ $notis->recieve_mobile }}" target="_top">{{ $notis->recieve_mobile }}</a>   </p>


           <p><p style="display: inline; font-weight: bold;">Sender Name : </p>{{ $notis->recieve_name }}   </p>


        <p><p style="display: inline; font-weight: bold;">Sender Note : </p>{{ $notis->reciever_note}}  </p>


           <p><p style="display: inline; font-weight: bold;">My Note : </p>{{ $notis->sender_note}}   </p>








           <p><p style="display: inline; font-weight: bold;">Referal Link : </p><a href="{{ $notis->reflink }}" target="_blank">
            {{ $notis->reflink }}
          </a>   </p>


           <p><p style="display: inline; font-weight: bold;">Status : </p>{{ $notis->status}}   </p>

</div>

@endforeach

<form method="POST" action="{{ route('noti.destroy', ['id' => $notis->id]) }}" onsubmit = "return confirm('Are you sure?')">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">


    <a style ="Font-size:15px" class="btn btn-default btn-margin" href="{{ URL::to('message/reply',$notis->id)}}">
        Reply
      </a>

      <a style ="Font-size:15px" class="btn btn-default btn-margin " href="{{ URL::to('message/forward',$notis->id)}}">
          Forward
        </a>

</form>
<br>
</div>








          </div>

			</div>
        </div>
      </div>

</div>

    </section>


@endsection
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
