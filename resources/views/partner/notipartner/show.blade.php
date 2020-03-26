@extends('partner.notipartner.sbase')
@section('action-content')
    <!-- Main content -->
    <section class="content">

  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

      <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p style="text-align: center" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div>
    <div id="example2_wrapper" class=" form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">



			<div style="overflow-x:auto;">

        <div class="panel panel-default">
          <div style=""class="panel-heading" >
@foreach ($notis as $notis)


          <H3 style=" text-align:left;">From : {{ $notis->created_name }} <p style="display: inline; font-size:55%;">({{ $notis->created_mail }})</p></h3>

            <p style=" text-align:right;">{{ $notis->created_at }}   </p></div>
            <br>
<div class="container" >

				 <p><p style="display: inline; font-weight: bold;">Message Topic : </p>{{ $notis->topic }}   </p>
                 <p><p style="display: inline; font-weight: bold;">Sender Name :  </p>{{ $notis->sender_name}}   </p>


              <p><p style="display: inline; font-weight: bold;">Member Name </p>{{ $notis->recieve_name }}   </p>


        <p ><p style="display: inline; font-weight: bold;">Message Type : </p>{{ $notis->message_type_name }}   </p>








          <p><p style="display: inline; font-weight: bold;">Message : </p><p style="margin-left:100px;"> {{ $notis->message_type_default }} {!! html_entity_decode($notis->message)!!}</p>   </p>


           <p><p style="display: inline; font-weight: bold;">Public ID : </p>{{ $notis->sender_id}}    </p>


           <p><p style="display: inline; font-weight: bold;">Email : </p><a href="mailto: {{ $notis->sender_email }}" target="_top">{{ $notis->sender_email }}</a>   </p>


           <p><p style="display: inline; font-weight: bold;">Mobile : </p><a href="tel: {{ $notis->sender_mobile }}" target="_top">{{ $notis->sender_mobile }}</a>   </p>


           <p><p style="display: inline; font-weight: bold;">Citizen ID : </p>{{ $notis->sender_idnum }}   </p>


        <p><p style="display: inline; font-weight: bold;">Note : </p>{{ $notis->sender_note}}   </p>











           <p><p style="display: inline; font-weight: bold;">Referal Link : </p><a href="{{ $notis->reflink }}" target="_blank">
            {{ $notis->reflink }}
          </a>   </p>


          {{--}} <p><p style="display: inline; font-weight: bold;">Status : </p>{{ $notis->status}}   </p>--}}
           <form class="form-horizontal" role="form" method="POST" action="{{ route('messagecenter-partner.update', ['id' => $notis->id]) }}">
               <input type="hidden" name="_method" value="PATCH">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <p><p style="display: inline; font-weight: bold;">Status : </p><select class="" name="status">
               <option>{{$notis->status}}</option>
               <option>Request</option>
               <option>On Progress</option>
               <option>Reject</option>
               <option>Finish</option>
           </select> <p><p style="display: inline; font-weight: bold;">My note : </p><br> <textarea name="reciever_note" style="display: inline; ">{{ $notis->reciever_note}}   </textarea></p> <br>
           <button type="submit" >
               Update
           </button> </p>
         </form>

</div>

@endforeach

<form method="POST" action="{{ route('messagecenter-partner.destroy', ['id' => $notis->id]) }}" onsubmit = "return confirm('Are you sure?')">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">


    <a class="btn btn-default btn-margin" href="{{ URL::to('wealththaipartner/messagecenter-partner/reply',$notis->id)}}">
        Reply
      </a>

      <a class="btn btn-default btn-margin " href="{{ URL::to('wealththaipartner/messagecenter-partner/forward',$notis->id)}}">
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
