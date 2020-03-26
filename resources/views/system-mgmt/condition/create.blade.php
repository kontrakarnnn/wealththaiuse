@extends('system-mgmt.condition.base')

@section('action-content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

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
.card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}
</style>
<div class="container">
    <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">Add new Condition</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('condition.store') }}">
                        {{ csrf_field() }}
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columnauth">
                            <label for="name" class="">Condition Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>








    <div class="columnauth">

      <label for="case_channel" class="">Condition Type</label>


      <select  class="form-control " name="type_id">
        <option value="" >-select-</option>
        @foreach ($conditiontype as $sta)
            <option value="{{$sta->id}}">{{$sta->name}}</option>
        @endforeach
      </select>

</div>




                  </div>



                  <h3 style="color:#00325d;">Condition Parameter Name</h3>
                  <div class="row">
                    <div class="column">

                      <label for="name" class="la">Condition Parameter Name1</label>


                          <input id="con_para_name1" type="text" class="form-control" name="con_para_name1"  value="{{ old('con_para_name1') }}" >

                          @if ($errors->has('con_para_name1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('con_para_name1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">

                  <label for="con_para_name2" class="la2">Condition Parameter Name2</label>


                      <input id="con_para_name2" type="text" class="form-control" name="con_para_name2"  value="{{ old('con_para_name2') }}" >

                      @if ($errors->has('con_para_name2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('con_para_name2') }}</strong>
                          </span>
                      @endif

            </div>



            <div class="column">

              <label for="con_para_name3" class="la3">Condition Parameter Name3</label>


                  <input id="con_para_name3" type="text" class="form-control" name="con_para_name3"  value="{{ old('con_para_name3') }}" >

                  @if ($errors->has('con_para_name3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('con_para_name3') }}</strong>
                      </span>
                  @endif

        </div>
        <div class="column">

          <label for="con_para_name4" class="la4">Condition Parameter Name4</label>


              <input id="con_para_name4" type="text" class="form-control" name="con_para_name4"  value="{{ old('con_para_name4') }}" >

              @if ($errors->has('con_para_name4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('con_para_name4') }}</strong>
                  </span>
              @endif

    </div>
    <div class="column">

      <label for="con_para_name5" class="la5">Condition Parameter Name5</label>


          <input id="con_para_name5" type="text" class="form-control" name="con_para_name5"  value="{{ old('con_para_name5') }}" >

          @if ($errors->has('con_para_name5'))
              <span class="help-block">
                  <strong>{{ $errors->first('con_para_name5') }}</strong>
              </span>
          @endif

</div>

            </div>

            <div class="row">
              <div class="column">

                <label for="con_para_name6" class="la6">Condition Parameter Name6</label>


                    <input id="con_para_name6" type="text" class="form-control" name="con_para_name6"  value="{{ old('con_para_name6') }}" >

                    @if ($errors->has('con_para_name6'))
                        <span class="help-block">
                            <strong>{{ $errors->first('con_para_name6') }}</strong>
                        </span>
                    @endif

              </div>
              <div class="column">

                <label for="con_para_name7" class="la7">Condition Parameter Name7</label>


                    <input id="con_para_name7" type="text" class="form-control" name="con_para_name7"  value="{{ old('con_para_name7') }}" >

                    @if ($errors->has('con_para_name7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('con_para_name7') }}</strong>
                        </span>
                    @endif

          </div>
          <div class="column">

            <label for="con_para_name8" class="la8">Condition Parameter Name8</label>


                <input id="con_para_name8" type="text" class="form-control" name="con_para_name8"  value="{{ old('con_para_name8') }}" >

                @if ($errors->has('con_para_name8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('con_para_name8') }}</strong>
                    </span>
                @endif

      </div>



      <div class="column">

        <label for="con_para_name9" class="la9">Condition Parameter Name9</label>


            <input id="con_para_name9" type="text" class="form-control" name="con_para_name9"  value="{{ old('con_para_name9') }}" >

            @if ($errors->has('con_para_name9'))
                <span class="help-block">
                    <strong>{{ $errors->first('con_para_name9') }}</strong>
                </span>
            @endif

  </div>
  <div class="column">

    <label for="con_para_name10" class="la10">Condition Parameter Name10</label>


        <input id="con_para_name10" type="text" class="form-control" name="con_para_name10"  value="{{ old('con_para_name10') }}" >

        @if ($errors->has('con_para_name10'))
            <span class="help-block">
                <strong>{{ $errors->first('con_para_name10') }}</strong>
            </span>
        @endif

</div>

      </div>

      <div class="row">

        <div class="columnnote">

          <label for="description" class="">Description </label>


              <textarea id="description" type="text" class="form-control" name="description"  value="{{ old('description') }}"> </textarea>

              @if ($errors->has('description'))
                  <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
              @endif

      </div>




      </div>




    <!-- /.box-header -->

  <!-- /.box-body -->

</div>
                        <div class="form-group">
                            <div >
                                <button type="submit" class="btn btn-primary btn-margin">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
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
            $(document).on('change','.casetype',function(){
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
                    url:'{!!URL::to('findCaseType')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      console.log('success');

                      console.log(data);

                     console.log(data.length);

                      for(var i=0; i<data.length;i++){
                        op+='<label value="'+data[i].requirename_var1+'">'+data[i].requirename_var1+'</label>';
                        op2+='<label value="'+data[i].requirename_var2+'">'+data[i].requirename_var2+'</label>';
                        op3+='<label value="'+data[i].requirename_var3+'">'+data[i].requirename_var3+'</label>';
                        op4+='<label value="'+data[i].requirename_var4+'">'+data[i].requirename_var4+'</label>';
                        op5+='<label value="'+data[i].requirename_var5+'">'+data[i].requirename_var5+'</label>';
                        op6+='<label value="'+data[i].requirename_var6+'">'+data[i].requirename_var6+'</label>';
                        op7+='<label value="'+data[i].requirename_var7+'">'+data[i].requirename_var7+'</label>';
                        op8+='<label value="'+data[i].requirename_var8+'">'+data[i].requirename_var8+'</label>';
                        op9+='<label value="'+data[i].requirename_var9+'">'+data[i].requirename_var9+'</label>';
                        op10+='<label value="'+data[i].requirename_var10+'">'+data[i].requirename_var10+'</label>';
                        op11+='<label value="'+data[i].requirename_var11+'">'+data[i].requirename_var11+'</label>';
                        op12+='<label value="'+data[i].requirename_var12+'">'+data[i].requirename_var12+'</label>';
                        op13+='<label value="'+data[i].requirename_var13+'">'+data[i].requirename_var13+'</label>';
                        op14+='<label value="'+data[i].requirename_var14+'">'+data[i].requirename_var14+'</label>';
                        op15+='<label value="'+data[i].requirename_var15+'">'+data[i].requirename_var15+'</label>';
                        op16+='<label value="'+data[i].requirename_var16+'">'+data[i].requirename_var16+'</label>';
                        op17+='<label value="'+data[i].requirename_var17+'">'+data[i].requirename_var17+'</label>';
                        op18+='<label value="'+data[i].requirename_var18+'">'+data[i].requirename_var18+'</label>';
                        op19+='<label value="'+data[i].requirename_var19+'">'+data[i].requirename_var19+'</label>';
                        op20+='<label value="'+data[i].requirename_var20+'">'+data[i].requirename_var20+'</label>';


                        opn1+='<label value="'+data[i].var_name1+'">'+data[i].var_name1+'</label>';
                        opn2+='<label value="'+data[i].var_name2+'">'+data[i].var_name2+'</label>';
                        opn3+='<label value="'+data[i].var_name3+'">'+data[i].var_name3+'</label>';
                        opn4+='<label value="'+data[i].var_name4+'">'+data[i].var_name4+'</label>';
                        opn5+='<label value="'+data[i].var_name5+'">'+data[i].var_name5+'</label>';
                        opn6+='<label value="'+data[i].var_name6+'">'+data[i].var_name6+'</label>';
                        opn7+='<label value="'+data[i].var_name7+'">'+data[i].var_name7+'</label>';
                        opn8+='<label value="'+data[i].var_name8+'">'+data[i].var_name8+'</label>';
                        opn9+='<label value="'+data[i].var_name9+'">'+data[i].var_name9+'</label>';
                        opn10+='<label value="'+data[i].var_name10+'">'+data[i].var_name10+'</label>';
                        opn11+='<label value="'+data[i].var_name11+'">'+data[i].var_name11+'</label>';
                        opn12+='<label value="'+data[i].var_name12+'">'+data[i].var_name12+'</label>';
                        opn13+='<label value="'+data[i].var_name13+'">'+data[i].var_name13+'</label>';
                        opn14+='<label value="'+data[i].var_name14+'">'+data[i].var_name14+'</label>';
                        opn15+='<label value="'+data[i].var_name15+'">'+data[i].var_name15+'</label>';
                        opn16+='<label value="'+data[i].var_name16+'">'+data[i].var_name16+'</label>';
                        opn17+='<label value="'+data[i].var_name17+'">'+data[i].var_name17+'</label>';
                        opn18+='<label value="'+data[i].var_name18+'">'+data[i].var_name18+'</label>';
                        opn19+='<label value="'+data[i].var_name19+'">'+data[i].var_name19+'</label>';
                        opn20+='<label value="'+data[i].var_name20+'">'+data[i].var_name20+'</label>';
                        opn21+='<label value="'+data[i].var_name21+'">'+data[i].var_name21+'</label>';
                        opn22+='<label value="'+data[i].var_name22+'">'+data[i].var_name22+'</label>';
                        opn23+='<label value="'+data[i].var_name23+'">'+data[i].var_name23+'</label>';
                        opn24+='<label value="'+data[i].var_name24+'">'+data[i].var_name24+'</label>';
                        opn25+='<label value="'+data[i].var_name25+'">'+data[i].var_name25+'</label>';
                        opn26+='<label value="'+data[i].var_name26+'">'+data[i].var_name26+'</label>';
                        opn27+='<label value="'+data[i].var_name27+'">'+data[i].var_name27+'</label>';
                        opn28+='<label value="'+data[i].var_name28+'">'+data[i].var_name28+'</label>';
                        opn29+='<label value="'+data[i].var_name29+'">'+data[i].var_name29+'</label>';
                        opn30+='<label value="'+data[i].var_name30+'">'+data[i].var_name30+'</label>';
                        opn31+='<label value="'+data[i].var_name31+'">'+data[i].var_name31+'</label>';
                        opn32+='<label value="'+data[i].var_name32+'">'+data[i].var_name32+'</label>';
                        opn33+='<label value="'+data[i].var_name33+'">'+data[i].var_name33+'</label>';
                        opn34+='<label value="'+data[i].var_name34+'">'+data[i].var_name34+'</label>';
                        opn35+='<label value="'+data[i].var_name35+'">'+data[i].var_name35+'</label>';
                        opn36+='<label value="'+data[i].var_name36+'">'+data[i].var_name36+'</label>';
                        opn37+='<label value="'+data[i].var_name37+'">'+data[i].var_name37+'</label>';
                        opn38+='<label value="'+data[i].var_name38+'">'+data[i].var_name38+'</label>';
                        opn39+='<label value="'+data[i].var_name39+'">'+data[i].var_name39+'</label>';
                        opn40+='<label value="'+data[i].var_name40+'">'+data[i].var_name40+'</label>';
                        opn41+='<label value="'+data[i].var_name41+'">'+data[i].var_name41+'</label>';
                        opn42+='<label value="'+data[i].var_name42+'">'+data[i].var_name42+'</label>';
                        opn43+='<label value="'+data[i].var_name43+'">'+data[i].var_name43+'</label>';
                        opn44+='<label value="'+data[i].var_name44+'">'+data[i].var_name44+'</label>';
                        opn45+='<label value="'+data[i].var_name45+'">'+data[i].var_name45+'</label>';
                        opn46+='<label value="'+data[i].var_name46+'">'+data[i].var_name46+'</label>';
                        opn47+='<label value="'+data[i].var_name47+'">'+data[i].var_name47+'</label>';
                        opn48+='<label value="'+data[i].var_name48+'">'+data[i].var_name48+'</label>';
                        opn49+='<label value="'+data[i].var_name49+'">'+data[i].var_name49+'</label>';
                        opn50+='<label value="'+data[i].var_name50+'">'+data[i].var_name50+'</label>';
                        opn51+='<label value="'+data[i].var_name51+'">'+data[i].var_name51+'</label>';
                        opn52+='<label value="'+data[i].var_name52+'">'+data[i].var_name52+'</label>';
                        opn53+='<label value="'+data[i].var_name53+'">'+data[i].var_name53+'</label>';
                        opn54+='<label value="'+data[i].var_name54+'">'+data[i].var_name54+'</label>';
                        opn55+='<label value="'+data[i].var_name55+'">'+data[i].var_name55+'</label>';
                        opn56+='<label value="'+data[i].var_name56+'">'+data[i].var_name56+'</label>';
                        opn57+='<label value="'+data[i].var_name57+'">'+data[i].var_name57+'</label>';
                        opn58+='<label value="'+data[i].var_name58+'">'+data[i].var_name58+'</label>';
                        opn59+='<label value="'+data[i].var_name59+'">'+data[i].var_name59+'</label>';
                        opn60+='<label value="'+data[i].var_name60+'">'+data[i].var_name60+'</label>';
                        oppartner+='<option value="'+data[i].default_partner_block_id+'">'+data[i].partner_block_name+'</option>';
                        opuser+='<option value="'+data[i].default_user_block_id+'">'+data[i].bu_name+'</option>';
                        oppartnergroup+='<option value="'+data[i].default_partner_group+'">'+data[i].partner_group_name+'</option>';
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

                      $('.lan1').html(" ");
                      $('.lan2').html(" ");
                      $('.lan3').html(" ");
                      $('.lan4').html(" ");
                      $('.lan5').html(" ");
                      $('.lan6').html(" ");
                      $('.lan7').html(" ");
                      $('.lan8').html(" ");
                      $('.lan9').html(" ");
                      $('.lan10').html(" ");
                      $('.lan11').html(" ");
                      $('.lan12').html(" ");
                      $('.lan13').html(" ");
                      $('.lan14').html(" ");
                      $('.lan15').html(" ");
                      $('.lan16').html(" ");
                      $('.lan17').html(" ");
                      $('.lan18').html(" ");
                      $('.lan19').html(" ");
                      $('.lan20').html(" ");
                      $('.lan21').html(" ");
                      $('.lan22').html(" ");
                      $('.lan23').html(" ");
                      $('.lan24').html(" ");
                      $('.lan25').html(" ");
                      $('.lan26').html(" ");
                      $('.lan27').html(" ");
                      $('.lan28').html(" ");
                      $('.lan29').html(" ");
                      $('.lan30').html(" ");
                      $('.lan31').html(" ");
                      $('.lan32').html(" ");
                      $('.lan33').html(" ");
                      $('.lan34').html(" ");
                      $('.lan35').html(" ");
                      $('.lan36').html(" ");
                      $('.lan37').html(" ");
                      $('.lan38').html(" ");
                      $('.lan39').html(" ");
                      $('.lan40').html(" ");
                      $('.lan41').html(" ");
                      $('.lan42').html(" ");
                      $('.lan43').html(" ");
                      $('.lan44').html(" ");
                      $('.lan45').html(" ");
                      $('.lan46').html(" ");
                      $('.lan47').html(" ");
                      $('.lan48').html(" ");
                      $('.lan49').html(" ");
                      $('.lan50').html(" ");
                      $('.lan51').html(" ");
                      $('.lan52').html(" ");
                      $('.lan53').html(" ");
                      $('.lan54').html(" ");
                      $('.lan55').html(" ");
                      $('.lan56').html(" ");
                      $('.lan57').html(" ");
                      $('.lan58').html(" ");
                      $('.lan59').html(" ");
                      $('.lan60').html(" ");
                      $('.oppartner').html(" ");
                      $('.opuser').html(" ");
                      $('.oppartnergroup').html(" ");

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

                      $('.lan1').append(opn1);
                      $('.lan2').append(opn2);
                      $('.lan3').append(opn3);
                      $('.lan4').append(opn4);
                      $('.lan5').append(opn5);
                      $('.lan6').append(opn6);
                      $('.lan7').append(opn7);
                      $('.lan8').append(opn8);
                      $('.lan9').append(opn9);
                      $('.lan10').append(opn10);
                      $('.lan11').append(opn11);
                      $('.lan12').append(opn12);
                      $('.lan13').append(opn13);
                      $('.lan14').append(opn14);
                      $('.lan15').append(opn15);
                      $('.lan16').append(opn16);
                      $('.lan17').append(opn17);
                      $('.lan18').append(opn18);
                      $('.lan19').append(opn19);
                      $('.lan20').append(opn20);
                      $('.lan21').append(opn21);
                      $('.lan22').append(opn22);
                      $('.lan23').append(opn23);
                      $('.lan24').append(opn24);
                      $('.lan25').append(opn25);
                      $('.lan26').append(opn26);
                      $('.lan27').append(opn27);
                      $('.lan28').append(opn28);
                      $('.lan29').append(opn29);
                      $('.lan30').append(opn30);
                      $('.lan31').append(opn31);
                      $('.lan32').append(opn32);
                      $('.lan33').append(opn33);
                      $('.lan34').append(opn34);
                      $('.lan35').append(opn35);
                      $('.lan36').append(opn36);
                      $('.lan37').append(opn37);
                      $('.lan38').append(opn38);
                      $('.lan39').append(opn39);
                      $('.lan40').append(opn40);
                      $('.lan41').append(opn41);
                      $('.lan42').append(opn42);
                      $('.lan43').append(opn43);
                      $('.lan44').append(opn44);
                      $('.lan45').append(opn45);
                      $('.lan46').append(opn46);
                      $('.lan47').append(opn47);
                      $('.lan48').append(opn48);
                      $('.lan49').append(opn49);
                      $('.lan50').append(opn50);
                      $('.lan51').append(opn51);
                      $('.lan52').append(opn52);
                      $('.lan53').append(opn53);
                      $('.lan54').append(opn54);
                      $('.lan55').append(opn55);
                      $('.lan56').append(opn56);
                      $('.lan57').append(opn57);
                      $('.lan58').append(opn58);
                      $('.lan59').append(opn59);
                      $('.lan60').append(opn60);
                      $('.oppartner').append(oppartner);
                      $('.opuser').append(opuser);
                      $('.oppartnergroup').append(oppartnergroup);
                      console.log(op);
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
