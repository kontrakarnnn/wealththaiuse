@extends('system-mgmt.action.base')

@section('action-content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<style>


/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
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
.name{
  height: auto !important;
}
</style>
<div class="container">
    <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">Add new Action</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('action.store') }}">
                        {{ csrf_field() }}
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columnauth">
                            <label for="name" class="">Action Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>



                            <div class="columnauth">

                              <label for="case_channel " class="">Action Type </label>


                              <select  class="form-control  name" name="type_id">
                                <option value="" >-select-</option>
                                @foreach ($actiontype as $sta)
                                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                                @endforeach
                              </select>

                        </div>









                  </div>


                  <div class="row">





                  </div>

                  <h3 style="color:#00325d;">Action Parameter Name</h3>
                  <div class="row">
                    <div class="column">
                      <div class="la">

                      <label for="name" class="lasd">Action Parameter Name1</label>


                        <input id="action_para_name1" type="text" class="form-control" name="action_para_name1"  value="{{ old('action_para_name1') }}" >

                        </div>
                          @if ($errors->has('action_para_name1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('action_para_name1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">
                  <div class="la2">

                  <label for="action_para_name2" class="lasd2">Action Parameter Name2</label>


                      <input id="action_para_name2" type="text" class="form-control" name="action_para_name2"  value="{{ old('action_para_name2') }}" >
                    </div>

                      @if ($errors->has('action_para_name2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('action_para_name2') }}</strong>
                          </span>
                      @endif
            </div>



            <div class="column">
              <div class="la3">

              <label for="action_para_name3" class="lasd3">Action Parameter Name3</label>

                  <input id="action_para_name3" type="text" class="form-control" name="action_para_name3"  value="{{ old('action_para_name3') }}" >
                </div>

                  @if ($errors->has('action_para_name3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('action_para_name3') }}</strong>
                      </span>
                  @endif
        </div>
        <div class="column">
          <div class="la4">

          <label for="action_para_name4" class="lasd4">Action Parameter Name4</label>


              <input id="action_para_name4" type="text" class="form-control" name="action_para_name4"  value="{{ old('action_para_name4') }}" >
            </div>

              @if ($errors->has('action_para_name4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('action_para_name4') }}</strong>
                  </span>
              @endif
    </div>
    <div class="column">
      <div class="la5">

      <label for="action_para_name5" class="lasd5">Action Parameter Name5</label>


          <input id="action_para_name5" type="text" class="form-control" name="action_para_name5"  value="{{ old('action_para_name5') }}" >
        </div>

          @if ($errors->has('action_para_name5'))
              <span class="help-block">
                  <strong>{{ $errors->first('action_para_name5') }}</strong>
              </span>
          @endif
</div>


              <div class="column">
                <div class="la6">

                <label for="action_para_name6" class="lasd6">Action Parameter Name6</label>


                    <input id="action_para_name6" type="text" class="form-control" name="action_para_name6"  value="{{ old('action_para_name6') }}" >
                  </div>

                    @if ($errors->has('action_para_name6'))
                        <span class="help-block">
                            <strong>{{ $errors->first('action_para_name6') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="column">
                <div class="la7">

                <label for="action_para_name7" class="lasd7">Action Parameter Name7</label>


                    <input id="action_para_name7" type="text" class="form-control" name="action_para_name7"  value="{{ old('action_para_name7') }}" >
                  </div>

                    @if ($errors->has('action_para_name7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('action_para_name7') }}</strong>
                        </span>
                    @endif
          </div>
          <div class="column">
            <div class="la8">

            <label for="action_para_name8" class="lasd8">Action Parameter Name8</label>


                <input id="action_para_name8" type="text" class="form-control " name="action_para_name8"  value="{{ old('action_para_name8') }}" >
              </div>

                @if ($errors->has('action_para_name8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('action_para_name8') }}</strong>
                    </span>
                @endif
      </div>



      <div class="column">
        <div class="la9">

        <label for="action_para_name9" class="lasd9">Action Parameter Name9</label>


            <input id="action_para_name9" type="text" class="form-control la9" name="action_para_name9"  value="{{ old('action_para_name9') }}" >
          </div>

            @if ($errors->has('action_para_name9'))
                <span class="help-block">
                    <strong>{{ $errors->first('action_para_name9') }}</strong>
                </span>
            @endif
  </div>
  <div class="column">
    <div class="la10">

    <label for="action_para_name10" class="lasd10">Action Parameter Name10</label>


        <input id="action_para_name10" type="text" class="form-control la10" name="action_para_name10"  value="{{ old('action_para_name10') }}" >
      </div>

        @if ($errors->has('action_para_name10'))
            <span class="help-block">
                <strong>{{ $errors->first('action_para_name10') }}</strong>
            </span>
        @endif
</div>







    <!-- /.box-header -->

  <!-- /.box-body -->
</div>
<div class="row">
  <div class="columnnote">
    <label for="action_para_name10" class="lasd10">Description</label>

  <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}"></textarea>

  @if ($errors->has('description'))
      <span class="help-block">
          <strong>{{ $errors->first('description') }}</strong>
      </span>
  @endif






</div>
</div>

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
                var op21=" ";
                var op22=" ";
                var op23=" ";
                var op24=" ";
                var op25=" ";
                var op26=" ";
                var op27=" ";
                var op28=" ";
                var op29=" ";
                var op30=" ";
                var op31=" ";
                var op32=" ";
                var op33=" ";
                var op34=" ";
                var op35=" ";
                var op36=" ";
                var op37=" ";
                var op38=" ";
                var op39=" ";
                var op40=" ";



                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findOfferType')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      console.log('success');

                      console.log(data);

                     console.log(data.length);

                      for(var i=0; i<data.length;i++){
                      //  op+='<label value="'+data[i].con_para_name1+'">'+data[i].con_para_name1+'</label>';

                        //op+='<input id="action_para_name1" type="text" class="form-control " name="action_para_name1" value="'+data[i].action_para_name_name1+'" >';
                        if(data[i].action_para_name_name1 != null)
                        {
                        op+='<div><label for="action_para_name1" class="lasd">'+data[i].action_para_name_name1+'</label><input id="action_para_name1" type="text" class="form-control " name="action_para_name1" value="{{ old('action_para_name1') }}" ></div>';
                        }
                        else{
                          op+='';
                        }
                        if(data[i].action_para_name_name2 != null)
                        {
                          op2+='<div><label for="action_para_name2" class="lasd">'+data[i].action_para_name_name2+'</label><input id="action_para_name2" type="text" class="form-control " name="action_para_name2" value="{{ old('action_para_name2') }}" ></div>';
                        }

                        else{
                          op2+='';

                        }
                        if(data[i].action_para_name_name3 != null)
                        {
                          op3+='<div><label for="action_para_name3" class="lasd">'+data[i].action_para_name_name3+'</label><input id="action_para_name3" type="text" class="form-control " name="action_para_name3" value="{{ old('action_para_name3') }}" ></div>';
                        }
                        else{
                          op3+='';
                        }
                        if(data[i].action_para_name_name4 != null)
                        {
                          op4+='<div><label for="action_para_name4" class="lasd">'+data[i].action_para_name_name4+'</label><input id="action_para_name4" type="text" class="form-control " name="action_para_name4" value="{{ old('action_para_name4') }}" ></div>';
                        }
                        else{
                          op4+='';

                        }
                        if(data[i].action_para_name_name5 != null)
                        {
                          op5+='<div><label for="action_para_name5" class="lasd">'+data[i].action_para_name_name5+'</label><input id="action_para_name5" type="text" class="form-control " name="action_para_name5" value="{{ old('action_para_name5') }}" ></div>';
                        }
                        else{
                          op5+='';

                        }
                        if(data[i].action_para_name_name6 != null)
                        {
                          op6+='<div><label for="action_para_name6" class="lasd">'+data[i].action_para_name_name6+'</label><input id="action_para_name6" type="text" class="form-control " name="action_para_name6" value="{{ old('action_para_name6') }}" ></div>';
                        }
                        else{
                          op6+='';
                        }
                        if(data[i].action_para_name_name7 != null)
                        {
                          op7+='<div><label for="action_para_name7" class="lasd">'+data[i].action_para_name_name7+'</label><input id="action_para_name7" type="text" class="form-control " name="action_para_name7" value="{{ old('action_para_name7') }}" ></div>';
                        }
                        else{
                          op7+='';

                        }
                        if(data[i].action_para_name_name8 != null)
                        {
                          op8+='<div><label for="action_para_name8" class="lasd">'+data[i].action_para_name_name8+'</label><input id="action_para_name8" type="text" class="form-control " name="action_para_name8" value="{{ old('action_para_name8') }}" ></div>';
                        }
                        else {
                          op8+='';
                        }
                        if(data[i].action_para_name_name9 != null)
                        {
                          op9+='<div><label for="action_para_name9" class="lasd">'+data[i].action_para_name_name9+'</label><input id="action_para_name9" type="text" class="form-control " name="action_para_name9" value="{{ old('action_para_name9') }}" ></div>';
                        }
                        else{
                          op9+='';
                        }
                        if(data[i].action_para_name_name10 != null)
                        {
                          op10+='<div><label for="action_para_name10" class="lasd">'+data[i].action_para_name_name10+'</label><input id="action_para_name10" type="text" class="form-control " name="action_para_name10" value="{{ old('action_para_name10') }}" ></div>';
                        }
                        else {
                          op10+='';
                        }
                        if(data[i].action_para_name_name11 != null)
                        {
                          op11+='<div><label for="action_para_name11" class="lasd">'+data[i].action_para_name_name11+'</label><input id="action_para_name11" type="text" class="form-control " name="action_para_name11" value="{{ old('action_para_name11') }}" ></div>';
                        }
                        else{
                          op11+='';

                        }
                        if(data[i].action_para_name_name12 != null)
                        {
                          op12+='<div><label for="action_para_name12" class="lasd">'+data[i].action_para_name_name12+'</label><input id="action_para_name12" type="text" class="form-control " name="action_para_name12" value="{{ old('action_para_name12') }}" ></div>';
                        }
                        else {
                          op12+='';
                        }
                        if(data[i].action_para_name_name13 != null)
                        {
                          op13+='<div><label for="action_para_name13" class="lasd">'+data[i].action_para_name_name13+'</label><input id="action_para_name13" type="text" class="form-control " name="action_para_name13" value="{{ old('action_para_name13') }}" ></div>';
                        }
                        else{
                          op13+='';
                        }
                        if(data[i].action_para_name_name14 != null)
                        {
                          op14+='<div><label for="action_para_name14" class="lasd">'+data[i].action_para_name_name14+'</label><input id="action_para_name14" type="text" class="form-control " name="action_para_name14" value="{{ old('action_para_name14') }}" ></div>';
                        }
                        else{
                          op14+='';
                        }
                        if(data[i].action_para_name_name15 != null)
                        {
                          op15+='<div><label for="action_para_name15" class="lasd">'+data[i].action_para_name_name15+'</label><input id="action_para_name15" type="text" class="form-control " name="action_para_name15" value="{{ old('action_para_name15') }}" ></div>';
                        }
                        else {
                          op15+='';
                        }
                        if(data[i].action_para_name_name16 != null)
                        {
                          op16+='<div><label for="action_para_name16" class="lasd">'+data[i].action_para_name_name16+'</label><input id="action_para_name16" type="text" class="form-control " name="action_para_name16" value="{{ old('action_para_name16') }}" ></div>';
                        }
                        else{
                          op16+='';
                        }
                        if(data[i].action_para_name_name17 != null)
                        {
                          op17+='<div><label for="action_para_name17" class="lasd">'+data[i].action_para_name_name17+'</label><input id="action_para_name17" type="text" class="form-control " name="action_para_name17" value="{{ old('action_para_name17') }}" ></div>';
                        }
                        else{
                          op17+='';
                        }
                        if(data[i].action_para_name_name18 != null)
                        {
                          op18+='<div><label for="action_para_name18" class="lasd">'+data[i].action_para_name_name18+'</label><input id="action_para_name18" type="text" class="form-control " name="action_para_name18" value="{{ old('action_para_name18') }}" ></div>';
                        }
                        else
                        {
                        op18+='';
                      }
                      if(data[i].action_para_name_name19 != null)
                      {
                        op19+='<div><label for="action_para_name19" class="lasd">'+data[i].action_para_name_name19+'</label><input id="action_para_name19" type="text" class="form-control " name="action_para_name19" value="{{ old('action_para_name19') }}" ></div>';
                      }
                      else{
                        op19+='';
                      }
                      if(data[i].action_para_name_name20 != null)
                      {
                        op20+='<div><label for="action_para_name20" class="lasd">'+data[i].action_para_name_name20+'</label><input id="action_para_name20" type="text" class="form-control " name="action_para_name20" value="{{ old('action_para_name20') }}" ></div>';
                      }
                      else{
                        op20+='';
                      }
                      if(data[i].action_para_name_name21 != null)
                      {
                        op21+='<div><label for="action_para_name21" class="lasd">'+data[i].action_para_name_name21+'</label><input id="action_para_name21" type="text" class="form-control " name="action_para_name21" value="{{ old('action_para_name21') }}" ></div>';
                      }
                      else{
                        op21+='';
                      }

                      if(data[i].action_para_name_name22 != null)
                      {
                        op22+='<div><label for="action_para_name22" class="lasd">'+data[i].action_para_name_name22+'</label><input id="action_para_name22" type="text" class="form-control " name="action_para_name22" value="{{ old('action_para_name22') }}" ></div>';
                      }
                      else{
                        op22+='';
                      }

                      if(data[i].action_para_name_name23 != null)
                      {
                        op23+='<div><label for="action_para_name23" class="lasd">'+data[i].action_para_name_name23+'</label><input id="action_para_name23" type="text" class="form-control " name="action_para_name23" value="{{ old('action_para_name23') }}" ></div>';
                      }
                      else{
                        op23+='';
                      }
                      if(data[i].action_para_name_name24 != null)
                      {
                        op24+='<div><label for="action_para_name24" class="lasd">'+data[i].action_para_name_name24+'</label><input id="action_para_name24" type="text" class="form-control " name="action_para_name24" value="{{ old('action_para_name24') }}" ></div>';
                      }
                      else{
                        op24+='';
                      }

                      if(data[i].action_para_name_name25 != null)
                      {
                        op25+='<div><label for="action_para_name25" class="lasd">'+data[i].action_para_name_name25+'</label><input id="action_para_name25" type="text" class="form-control " name="action_para_name25" value="{{ old('action_para_name25') }}" ></div>';
                      }
                      else{
                        op25+='';
                      }

                      if(data[i].action_para_name_name26 != null)
                      {
                        op26+='<div><label for="action_para_name26" class="lasd">'+data[i].action_para_name_name26+'</label><input id="action_para_name26" type="text" class="form-control " name="action_para_name26" value="{{ old('action_para_name26') }}" ></div>';
                      }
                      else{
                        op26+='';
                      }

                      if(data[i].action_para_name_name27 != null)
                      {
                        op27+='<div><label for="action_para_name27" class="lasd">'+data[i].action_para_name_name27+'</label><input id="action_para_name27" type="text" class="form-control " name="action_para_name27" value="{{ old('action_para_name27') }}" ></div>';
                      }
                      else{
                        op27+='';
                      }

                      if(data[i].action_para_name_name28 != null)
                      {
                        op28+='<div><label for="action_para_name28" class="lasd">'+data[i].action_para_name_name28+'</label><input id="action_para_name28" type="text" class="form-control " name="action_para_name28" value="{{ old('action_para_name28') }}" ></div>';
                      }
                      else{
                        op28+='';
                      }

                      if(data[i].action_para_name_name29 != null)
                      {
                        op29+='<div><label for="action_para_name29" class="lasd">'+data[i].action_para_name_name29+'</label><input id="action_para_name29" type="text" class="form-control " name="action_para_name29" value="{{ old('action_para_name29') }}" ></div>';
                      }
                      else{
                        op29+='';
                      }
                      if(data[i].action_para_name_name30 != null)
                      {
                        op30+='<div><label for="action_para_name30" class="lasd">'+data[i].action_para_name_name30+'</label><input id="action_para_name30" type="text" class="form-control " name="action_para_name30" value="{{ old('action_para_name30') }}" ></div>';
                      }
                      else{
                        op30+='';
                      }

                      if(data[i].action_para_name_name31 != null)
                      {
                        op31+='<div><label for="action_para_name31" class="lasd">'+data[i].action_para_name_name31+'</label><input id="action_para_name31" type="text" class="form-control " name="action_para_name31" value="{{ old('action_para_name31') }}" ></div>';
                      }
                      else{
                        op31+='';
                      }

                      if(data[i].action_para_name_name32 != null)
                      {
                        op32+='<div><label for="action_para_name32" class="lasd">'+data[i].action_para_name_name32+'</label><input id="action_para_name32" type="text" class="form-control " name="action_para_name32" value="{{ old('action_para_name32') }}" ></div>';
                      }
                      else{
                        op32+='';
                      }

                      if(data[i].action_para_name_name33 != null)
                      {
                        op33+='<div><label for="action_para_name33" class="lasd">'+data[i].action_para_name_name33+'</label><input id="action_para_name33" type="text" class="form-control " name="action_para_name33" value="{{ old('action_para_name33') }}" ></div>';
                      }
                      else{
                        op33+='';
                      }

                      if(data[i].action_para_name_name34 != null)
                      {
                        op34+='<div><label for="action_para_name34" class="lasd">'+data[i].action_para_name_name34+'</label><input id="action_para_name34" type="text" class="form-control " name="action_para_name34" value="{{ old('action_para_name34') }}" ></div>';
                      }
                      else{
                        op34+='';
                      }

                      if(data[i].action_para_name_name35 != null)
                      {
                        op35+='<div><label for="action_para_name35" class="lasd">'+data[i].action_para_name_name35+'</label><input id="action_para_name35" type="text" class="form-control " name="action_para_name35" value="{{ old('action_para_name35') }}" ></div>';
                      }
                      else{
                        op35+='';
                      }

                      if(data[i].action_para_name_name36 != null)
                      {
                        op36+='<div><label for="action_para_name36" class="lasd">'+data[i].action_para_name_name36+'</label><input id="action_para_name36" type="text" class="form-control " name="action_para_name36" value="{{ old('action_para_name36') }}" ></div>';
                      }
                      else{
                        op36+='';
                      }

                      if(data[i].action_para_name_name37 != null)
                      {
                        op37+='<div><label for="action_para_name37" class="lasd">'+data[i].action_para_name_name37+'</label><input id="action_para_name37" type="text" class="form-control " name="action_para_name37" value="{{ old('action_para_name37') }}" ></div>';
                      }
                      else{
                        op37+='';
                      }

                      if(data[i].action_para_name_name38 != null)
                      {
                        op38+='<div><label for="action_para_name38" class="lasd">'+data[i].action_para_name_name38+'</label><input id="action_para_name38" type="text" class="form-control " name="action_para_name38" value="{{ old('action_para_name38') }}" ></div>';
                      }
                      else{
                        op38+='';
                      }

                      if(data[i].action_para_name_name39 != null)
                      {
                        op39+='<div><label for="action_para_name39" class="lasd">'+data[i].action_para_name_name39+'</label><input id="action_para_name39" type="text" class="form-control " name="action_para_name39" value="{{ old('action_para_name39') }}" ></div>';
                      }
                      else{
                        op39+='';
                      }

                      if(data[i].action_para_name_name40 != null)
                      {
                        op40+='<div><label for="action_para_name40" class="lasd">'+data[i].action_para_name_name40+'</label><input id="action_para_name40" type="text" class="form-control " name="action_para_name40" value="{{ old('action_para_name40') }}" ></div>';
                      }
                      else{
                        op40+='';
                      }
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
                      $('.la21').html(" ");
                      $('.la22').html(" ");
                      $('.la23').html(" ");
                      $('.la24').html(" ");
                      $('.la25').html(" ");
                      $('.la26').html(" ");
                      $('.la27').html(" ");
                      $('.la28').html(" ");
                      $('.la29').html(" ");
                      $('.la30').html(" ");
                      $('.la31').html(" ");
                      $('.la32').html(" ");
                      $('.la33').html(" ");
                      $('.la34').html(" ");
                      $('.la35').html(" ");
                      $('.la36').html(" ");
                      $('.la37').html(" ");
                      $('.la38').html(" ");
                      $('.la39').html(" ");
                      $('.la40').html(" ");



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
                      $('.la21').append(op21);
                      $('.la22').append(op22);
                      $('.la23').append(op23);
                      $('.la24').append(op24);
                      $('.la25').append(op25);
                      $('.la26').append(op26);
                      $('.la27').append(op27);
                      $('.la28').append(op28);
                      $('.la29').append(op29);
                      $('.la30').append(op30);
                      $('.la31').append(op31);
                      $('.la32').append(op32);
                      $('.la33').append(op33);
                      $('.la34').append(op34);
                      $('.la35').append(op35);
                      $('.la36').append(op36);
                      $('.la37').append(op37);
                      $('.la38').append(op38);
                      $('.la39').append(op39);
                      $('.la40').append(op40);

                      console.log(op);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

@endsection
