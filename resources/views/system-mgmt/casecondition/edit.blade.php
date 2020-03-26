@extends('system-mgmt.casecondition.base')

@section('action-content')
<style>


/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 20%;
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
  width: 100%;
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
  .columnauth {
    width: 100%;
  }
  .columnnote {
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

.form-control{


  border: 1px solid #aaaaaa;

}
.name{


border: 1px solid #aaaaaa;

}
  .form-control2{



  border: 1px solid #aaaaaa;

}
input {
  padding: 10px;
  width: 100%;


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
</style>
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Case Condition</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('casecondition.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columnauth">
                            <label for="name" class="">Condition Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>



                            
                            <div class="columnauth">

                              <label for="case_channel" class="">Case </label>


                              <select  class="form-control " name="case_id">
                                <option value="" >-select-</option>
                                @foreach ($case as $sta)
                                    <option value="{{$sta->id}}"{{$sta->id == $data->case_id ? 'selected' : ''}}>{{$sta->name}}</option>
                                @endforeach
                              </select>

                        </div>
                        <div class="columnauth">
                          <label for="case_channel" class="">Path Condition Detail </label>
                          <select  class="form-control" name="path_condition_detail">
                            <option value="" >-select-</option>
                            @foreach ($pathconditiondetail as $sta)
                                <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail ? 'selected' : ''}}>{{$sta->name}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="columnauth">

                          <label for="case_channel" class="">Condition Flag </label>


                          <select  class="form-control " name="condition_flag">
                            <option value="" >-select-</option>
                            <option value="0"{{0 == $data->condition_flag ? 'selected' : ''}} >0</option>
                            <option value="1" {{1 == $data->condition_flag ? 'selected' : ''}}>1</option>


                          </select>

                        </div>

                        <div class="columnauth">

                          <label for="case_channel" class="">Condition Flag </label>


                          <textarea class="form-control" name="description"></textarea>

                        </div>


                  </div>








    <!-- /.box-header -->

  <!-- /.box-body -->

  </div>


                        <div class="form-group">
                            <div >
                                <button type="submit" class="btn btn-primary btn-margin">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">

          $(".name").select2({
                placeholder: "Select",
                allowClear: true
            });
    </script>

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

                var opn1=" ";
                var opn2=" ";
                var opn3=" ";
                var opn4=" ";
                var opn5=" ";
                var opn6=" ";
                var opn7=" ";
                var opn8=" ";
                var opn9=" ";
                var opn10=" ";
                var opn11=" ";
                var opn12=" ";
                var opn13=" ";
                var opn14=" ";
                var opn15=" ";
                var opn16=" ";
                var opn17=" ";
                var opn18=" ";
                var opn19=" ";
                var opn20=" ";
                var opn21=" ";
                var opn22=" ";
                var opn23=" ";
                var opn24=" ";
                var opn25=" ";
                var opn26=" ";
                var opn27=" ";
                var opn28=" ";
                var opn29=" ";
                var opn30=" ";
                var opn31=" ";
                var opn32=" ";
                var opn33=" ";
                var opn34=" ";
                var opn35=" ";
                var opn36=" ";
                var opn37=" ";
                var opn38=" ";
                var opn39=" ";
                var opn40=" ";
                var opn41=" ";
                var opn42=" ";
                var opn43=" ";
                var opn44=" ";
                var opn45=" ";
                var opn46=" ";
                var opn47=" ";
                var opn48=" ";
                var opn49=" ";
                var opn50=" ";
                var opn51=" ";
                var opn52=" ";
                var opn53=" ";
                var opn54=" ";
                var opn55=" ";
                var opn56=" ";
                var opn57=" ";
                var opn58=" ";
                var opn59=" ";
                var opn60=" ";
                var oppartner=" ";
                var opuser=" ";
                var oppartnergroup=" ";

                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findCondition')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      console.log('success');

                      console.log(data);

                     console.log(data.length);

                      for(var i=0; i<data.length;i++){
                        op+='<label value="'+data[i].con_para_name1+'">'+data[i].con_para_name1+'</label>';
                        op2+='<label value="'+data[i].con_para_name2+'">'+data[i].con_para_name2+'</label>';
                        op3+='<label value="'+data[i].con_para_name3+'">'+data[i].con_para_name3+'</label>';
                        op4+='<label value="'+data[i].con_para_name4+'">'+data[i].con_para_name4+'</label>';
                        op5+='<label value="'+data[i].con_para_name5+'">'+data[i].con_para_name5+'</label>';
                        op6+='<label value="'+data[i].con_para_name6+'">'+data[i].con_para_name6+'</label>';
                        op7+='<label value="'+data[i].con_para_name7+'">'+data[i].con_para_name7+'</label>';
                        op8+='<label value="'+data[i].con_para_name8+'">'+data[i].con_para_name8+'</label>';
                        op9+='<label value="'+data[i].con_para_name9+'">'+data[i].con_para_name9+'</label>';
                        op10+='<label value="'+data[i].con_para_name10+'">'+data[i].con_para_name10+'</label>';

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

                      console.log(op2);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".publicadd").click(function(){
              var html = $(".clonepublic").html();
              $(".incrementpublic").after(html);
          });

          $("body").on("click",".publicremove",function(){
              $(this).parents(".control-grouppublic").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".partneradd").click(function(){
              var html = $(".clonepartner").html();
              $(".incrementpartner").after(html);
          });

          $("body").on("click",".partnerremove",function(){
              $(this).parents(".control-grouppartner").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".useradd").click(function(){
              var html = $(".cloneuser").html();
              $(".incrementuser").after(html);
          });

          $("body").on("click",".userremove",function(){
              $(this).parents(".control-groupuser").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".guildadd").click(function(){
              var html = $(".cloneguild").html();
              $(".incrementguild").after(html);
          });

          $("body").on("click",".guildremove",function(){
              $(this).parents(".control-groupguild").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".groupmemadd").click(function(){
              var html = $(".clonegroupmem").html();
              $(".incrementgroupmem").after(html);
          });

          $("body").on("click",".groupmemremove",function(){
              $(this).parents(".control-groupgroupmem").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".grouppidadd").click(function(){
              var html = $(".clonegrouppid").html();
              $(".incrementgrouppid").after(html);
          });

          $("body").on("click",".grouppidremove",function(){
              $(this).parents(".control-groupgrouppid").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".grouppartadd").click(function(){
              var html = $(".clonegrouppart").html();
              $(".incrementgrouppart").after(html);
          });

          $("body").on("click",".grouppartremove",function(){
              $(this).parents(".control-groupgrouppart").remove();
          });

        });

    </script>
  @endsection
