@extends('system-mgmt.serviceuser.base')
@section('action-content')
    <!-- Main content -->
<style>
.card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}

<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
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
}
.container2 {
  display: inline-block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 15px;
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


  .form-control2{
  padding: 10px;
  width: 100%;

  font-family: Raleway;
  border: 1px solid #aaaaaa;

}
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}
body {
  background-image: url(../img/home4.jpg);
background-repeat: no-repeat;
background-size: cover;
background-attachment: fixed;
}
h2,
h4 {
  margin-top: 0;
}
.form {

  background: #ffffff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, .4);
  margin: 4em;
  min-width: 480px;
  padding: 1em;
  border: 5px solid #FFFFFF;
 border-radius: 12px;
}
.wizard {
  margin: 20px auto;
  background: #fff;
}

  .wizard .nav-tabs {
      position: relative;
      margin: 40px auto;
      margin-bottom: 0;
      border-bottom-color: #e0e0e0;
  }

  .wizard > div.wizard-inner {
      position: relative;
  }

.connecting-line {
  height: 2px;
  background: #3e5e9a;
  position: absolute;
  width: 80%;
  margin: 0 auto;
  left: 0;
  right: 0;
  top: 50%;
  z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
  color: #3e5e9a;
  cursor: default;
  border: 0;
  border-bottom-color: transparent;
}

span.round-tab {
  width: 70px;
  height: 70px;
  line-height: 70px;
  display: inline-block;
  border-radius: 100px;
  background: #fff;
  border: 2px solid #3e5e9a;
  z-index: 2;
  position: absolute;
  left: 0;
  text-align: center;
  font-size: 25px;
}
span.round-tab i{
  color:#3e5e9a;

}
.wizard li.active span.round-tab {
  background: #fff;
  border: 2px solid #999;

}
.wizard li.active span.round-tab i{
  color: #999;
}

span.round-tab:hover {
  color: #333;
  border: 2px solid #333;
}

.wizard .nav-tabs > li {
  width: 25%;
}

.wizard li:after {
  content: " ";
  position: absolute;
  left: 46%;
  opacity: 0;
  margin: 0 auto;
  bottom: 0px;
  border: 5px solid transparent;
  border-bottom-color: #5bc0de;
  transition: 0.1s ease-in-out;
}

.wizard li.active:after {
  content: " ";
  position: absolute;
  left: 46%;
  opacity: 1;
  margin: 0 auto;
  bottom: 0px;
  border: 10px solid transparent;
  border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
  width: 70px;
  height: 70px;
  margin: 20px auto;
  border-radius: 100%;
  padding: 0;
}

  .wizard .nav-tabs > li a:hover {
      background: transparent;
  }

.wizard .tab-pane {
  position: relative;
  padding-top: 50px;
}

.wizard h3 {
  margin-top: 0;
}

@media( max-width : 585px ) {

  .wizard {
      width: 90%;
      height: auto !important;
  }

  span.round-tab {
      font-size: 16px;
      width: 50px;
      height: 50px;
      line-height: 50px;
  }

  .wizard .nav-tabs > li a {
      width: 50px;
      height: 50px;
      line-height: 50px;
  }

  .wizard li.active:after {
      content: " ";
      position: absolute;
      left: 35%;
  }



}


.card-header{
  background-color:#00325d;				;
  color:white;
}

</style>
    <section class="content">

      <div class="box">

  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of serviccenter</h3>
        </div>

    </div>
  </div>
  <!-- /.box-header -->

  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
    {{--}}  <form method="POST" action="{{ route('service.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>--}}



      <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div>


      <div class="container">
        <div class="row">
        <div class="col-md-6">
          <div class="form-group">



                <label for="input" class=" control-label">Select Group Of Service</label>
                <select class=" form-control department"  onchange="window.location.href=this.value;" name="structure_id"required>

                  @foreach ($group as $g)
  <option    value="{{url('serviceuser/group')}}/{{$g->id}}">{{$g->name}}</option>
@endforeach
                    @foreach ($serg as $ser)
                        <option  value="{{url('serviceuser/group')}}/{{$g->id}}">{{$ser->name}}</option>
                    @endforeach

                </select>
                <br>
              <label for="input" class=" control-label">Select Service Name</label>

                <select class="form-control name"size="1" name="links" onchange="window.location.href=this.value;">

                  @foreach ($serv as $s)
                    <option value="{{url('serviceuser/list')}}/{{$s->id}}">{{$s->name}}</option>
                @endforeach
                </select>
                <br>
<label href="/serviceuser/lists/all">show all
                    <input class="checkbox "type="checkbox"  value="/serviceuser/lists/all" name="checket"
                        onClick="if (this.checked) { window.location = this.value; }"  /></p>

</label>


          </div>
          </div>
          </div>
          <br>

   <div class="row">
     @foreach ($serviceforms as $type=> $serviccente)


   <div class="col-6 col-md-4" >
     <div class="box" >

<div class="box collapsed-box" >
  @if($serviccente->attachment !=NULL)




  <?php
  $imageroot = '\service'.'\\'.$serviccente->attachment;
  $image =public_path('service')."/".$serviccente->attachment;
// Read image path, convert to base64 encoding
$imageData = base64_encode(file_get_contents($image));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

// Echo out a sample image
//echo '<img src="' . $src . '">';

 echo '<img class="card-img-top" src="'.$src.'" data-widget="collapse" alt="Card image cap">';
?>
  @endif
  <div class="box-header with-border " ><p style="text-align:center;"><b>{{$serviccente->name}}</b></p></div>
  <div class="box-body">


  <p class="card-text">กรุณากรอกข้อมูลดังต่อไปนี้</p>

  <form class="form-horizontal" role="form" method="POST" action="{{ route('serviceper.sentservice') }}">
      {{ csrf_field() }}
  {{--<h3 class="card-title">{{$serviccenter->name}}{{$serviccenter->msg_type_name}}</h5>--}}


@if($serviccente->port_number != NULL)
<label>หมายเลข บัญชี ที่ต้องการฝากหลักประกัน (portfolio number)</label>

   <p> <select class="form-control " name="port">
     @foreach ($port as $p)


        <option value="{{$p->id}}">{{$p->number}}</option>
             @endforeach

    </select></p>
  @endif
      @if($serviccente->text_field1 !=NULL)


      <label >{{$serviccente->text_field1}}</label>
<p><input class="form-control"  name="a1">{{$serviccente->unit_field1}}</p>

@endif
@if($serviccente->text_field2 !=NULL)


<label >{{$serviccente->text_field2}}</label>
<p><input class="form-control"  name="a2">{{$serviccente->unit_field2}}</p>

@endif



@if($serviccente->text_field3 !=NULL)

  <label >{{$serviccente->text_field3}}</label>
<p><input class="form-control"  name="a3">{{$serviccente->unit_field3}}</p>

@endif
@if($serviccente->text_field4 !=NULL)


<label >{{$serviccente->text_field4}}</label>
<p><input class="form-control"  name="a4">{{$serviccente->unit_field4}}</p>

@endif



@if($serviccente->text_field5 !=NULL)

<label >{{$serviccente->text_field5}}</label>
<p><input class="form-control"  name="a5">{{$serviccente->unit_field5}}</p>


@endif

<label>ความต้องการพิเศษ</label>
<p> <textarea class="form-control" id="message-text" name="more"></textarea></p>





   <label >ช่วงเวลาที่สะดวกให้ติดต่อ</label>

      <p> <select class="form-control " name="time">
           <option></option>

               <option>โดยเร็วที่สุด</option>
               <option>ช่วงเช้า (9:00-12:00)</option>
               <option>ช่วงบ่าย (13:00-17:00)</option>
               <option>หลังเลิกงาน  (17:00-18:00)</option>
               <option>เสาร์-อาทิตย์ (9:00-17:00)</option>
       </select></p>



<label >ระบุ วันเวลา และ ช่วงเวลา (ต้องตั้งล่วงหน้า 1 วัน )</label>
<p><input class="form-control"  name="ati"></p>
<label >Reciever ID (ถ้าไม่มีไม่ต้องใส่)</label>
<p><input class="form-control"  name="recieve_id"></p>







<input type="hidden"id="sender_id" type="text" class="form-control" name="mst" value=" {{$serviccente->msg_type_id}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="n" value=" {{$serviccente->name}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="t1" value=" {{$serviccente->text_field1}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="t2" value=" {{$serviccente->text_field2}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="t3" value=" {{$serviccente->text_field3}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="t4" value=" {{$serviccente->text_field4}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="t5" value=" {{$serviccente->text_field5}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="u1" value=" {{$serviccente->unit_field1}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="u2" value=" {{$serviccente->unit_field2}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="u3" value=" {{$serviccente->unit_field3}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="u4" value=" {{$serviccente->unit_field4}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="u5" value=" {{$serviccente->unit_field5}}">
<input type="hidden"id="sender_id" type="text" class="form-control" name="qm" value="ความต้องการพิเศษ ">
<input type="hidden"id="sender_id" type="text" class="form-control" name="qt" value="ช่วงเวลาที่สะดวกให้ติดต่อ ">
<input type="hidden"id="sender_id" type="text" class="form-control" name="qp" value="หมายเลข บัญชี ที่ต้องการฝากหลักประกัน (portfolio number ) ">
<input type="hidden"id="sender_id" type="text" class="form-control" name="qti" value="ระบุ วันเวลา และ ช่วงเวลา (ต้องตั้งล่วงหน้า 1 วัน ) ">

<div class="form-group">

  <div class="col-md-4">

    <button type="submit" class="btn btn-outline-primary" disabled  >
      Sent
    </button>











  </div>
</div>
</form>

    </div>
    <div class="card-footer">
      <p style="text-align:center;">
        <a class"btn btn-box-tool" data-widget="collapse"><i style="text-align:center;" class="fa fa-plus"></i></a>
      </p>


    </div>
  </div>


     </div>
     <br>



   </div>
      @endforeach



 </div>
</div>
  <!-- /.box-body -->

    </section>

    <!-- /.content -->
  </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.department',function(){
        //  console.log("hmm its change");

            var department_id=$(this).val();
            //console.log(department_id);
            var div=$(this).parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('findservice')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
                  op+='<option value="0" selected disabled>เลือกบริการ</option>';
                  for(var i=0; i<data.length;i++){
                    op+='<option value="{{url('serviceuser/list')}}/'+data[i].id+'">'+data[i].name+'</option>';

                  }
                  div.find('.name').html(" ");
                  div.find('.name').append(op);

                },
                error:function(){

                }
            });
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
