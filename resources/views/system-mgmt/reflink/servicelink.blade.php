@extends('userprofile.refbase')
@section('action-content')

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
  .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}

  .card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-flex:1;-ms-flex:1 0 0%;flex:1 0 0%;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-webkit-box-flex:1;-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}

  </style>
    <!-- Main content -->
    <section class="content">
      <div class="container">
          <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="btn btn-primary" href="/reflink">My Link</a>

                        <a class="btn btn-primary" href="/reflink/event/link">Event Link</a>

                        <a class="btn btn-primary" href="/reflink/smart/link">Smart Link</a>
                        <a class="btn btn-primary" href="/reflink/content/link">Content Link</a>
                        <a class="btn btn-primary" href="/reflink/service/link">Service Link</a>

                      </div>
                      <div class="panel-body">


                        <form class="" role="form" method="POST" action="{{ route('reflink.storeservicelink') }}">
                            {{ csrf_field() }}

                                  @if($name != NULL || $source != NULL)
                                  <div class="box box-default">

                                  @else
                                  <div class="box collapsed-box">
                                  @endif
                                    <div class="box-header with-border">
                                      <h3 data-widget="collapse" class="box-title">Advance</h3>

                                      <div class="box-tools pull-right">
                                        @if($name != NULL || $source != NULL )
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        @else
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        @endif
                                      </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                      <div class="row">
                                        <div class="column">
                                      <div class="form-group">
                                        <label class=" ">Campaign Source</label>

                                          <input  id="select-source" name="source" value="{{$source}}" class="form-control" />


                                        </div>
                                        </div>
                                        <div class="column">

                                        <div class="form-group">
                                          <label class=" ">Campaign Medium</label>

                                          <input class="form-control" name="medium" value="{{$medium}}"/>



                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="column">
                                      <div class="form-group">
                                        <label class=" ">Campaign Name</label>

                                        <input class="form-control" name="name" value="{{$name}}"/>



                                        </div>
                                        </div>
                                        <div class="column">

                                        <div class="form-group">
                                          <label class=" ">Campaign Term</label>

                                          <input class="form-control" name="term" value="{{$term}}"/>



                                          </div>
                                        </div>
                                      </div>


                                      <div class="row">
                                        <div class="column">
                                      <div class="form-group">
                                        <label class=" ">Campaign Content</label>

                                        <input class="form-control" name="content" value="{{$content}}"/>


                                        </div>
                                        </div>
                                        <div class="column">
                                          <div class="form-group">
                                            <br />

                          <a href="/reflink/event/link" class="btn btn-danger btn-margin">Clear</a>
                                          </div>


                                        </div>

                                      </div>
                                    </div>
                                    <!-- /.box-body -->

                                  </div>
                                  <div class="form-group">
                                  <label >Select Service</label>



                                      <select onchange="myFunctions()" id="select-eventss" class="form-control department" name="event_id" required>

                                        <option value="" >-Select-</option>
                                      @foreach ($events as $event)
                                        <option value="{{$event->id}}"{{$event->id == $eventl ? 'selected' : ''}}>{{$event->name}}</option>
                                              @endforeach

                                  </select>

                                    </div>
                                    <div class="row">

                                  <div class="form-group">

                                    <button type ="submit"class="btn btn-warning btn-margin" >Generate Link</button>
                                  </div>

                                </div>

								@if($eventl != NULL)
									  
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="border-style: groove;padding:10px">
                                    <label for="name">Quick Register Service Link</label>

                                    <div class="">
                                      <textarea id="link4"class="form-control" readonly="readonly" type="text" value="{{ url('/quickregister') . '?/service/' . $eventl . '/??UTM??utm_source='. $source. '&utm_content=' . $content . '&utm_medium=' . $medium . '&utm_name=' . $name . '&utm_term=' . $term  }}">{{ url('/quickregister') . '?/service/' . $eventl . '/??UTM??utm_source='. $source. '&utm_content=' . $content . '&utm_medium=' . $medium . '&utm_name=' . $name . '&utm_term=' . $term  }}</textarea>


                                      <br>
                                      <button class="btn btn-info" onclick="myFunction4()">Copy Link</button>
                                    </div>
                                </div>

							@else
							@endif
















                      </div>
                  </div>
              </div>
          </div>
      </div>

{{--<input class="form-control" readonly="readonly" type="text" value="{{ url('/quickregister') . '?ref?' . $currentmatchids }}" id="myInput">--}}



<script>
function myFunctions() {
var x = document.getElementById("select-events").value;
document.getElementById("link").value ="{{ url('/quickregister') . '?ref?' . $currentmatchids }}?refevent?" + x;
  }
</script>
<script>
function myFunctionssource() {
var x = document.getElementById("select-events").value;
document.getElementById("source").value ="{{ url('/quickregister') . '?ref?' . $currentmatchids }}?refevent?" + x;
  }
</script>

<script>
function myFunctions2() {
var x = document.getElementById("select-events2").value;
document.getElementById("link2").value ="{{ url('/perregis/create') . '?ref?' . $currentmatchids }}?refevent?" + x;
  }
</script>
<script>
function myFunctions3() {
var x = document.getElementById("select-events3").value;
document.getElementById("link3").value ="$website . '?ref?' . $currentmatchids }}?refevent?" + x;
  }
</script>


      <!-- Your Page Content Here -->









<script>
function myFunction() {
  var copyText = document.getElementById("link");
  copyText.select();
  document.execCommand("copy");
  alert("Copied url: " + copyText.value);
}

function myFunction2() {
  var copyText = document.getElementById("link2");
  copyText.select();
  document.execCommand("copy");
  alert("Copied url: " + copyText.value);
}
function myFunction3() {
  var copyText = document.getElementById("link3");
  copyText.select();
  document.execCommand("copy");
  alert("Copied url: " + copyText.value);
}
function myFunction4() {
  var copyText = document.getElementById("link4");
  copyText.select();
  document.execCommand("copy");
  alert("Copied url: " + copyText.value);
}
function myFunction5() {
  var copyText = document.getElementById("link5");
  copyText.select();
  document.execCommand("copy");
  alert("Copied url: " + copyText.value);
}
function myFunction6() {
  var copyText = document.getElementById("link6");
  copyText.select();
  document.execCommand("copy");
  alert("Copied url: " + copyText.value);
}
</script>
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
                url:'{!!URL::to('findevent')!!}',
                data:{'id':department_id},

                success:function(data){
                  console.log('success');

                  console.log(data);

                 console.log(data.length);
          //  op+='<option value="0" selected disabled>chose Block</option>';
                  for(var i=0; i<data.length;i++){
                    op+='<input value="'+data[i].id+'" class="form-control" readonly="readonly" type="text" value="{{ url('/quickregister') . '?ref?'.'+data[i].id+' . $currentmatchids }}" id="myInput">';
                    //op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';

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
    </section>



@endsection
