@extends('system-mgmt.action.base')

@section('action-content')

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
                <div class="panel-heading">Update Action</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('action.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columnauth">
                            <label for="name" class="">Action Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name}}" required autofocus>

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
                                    <option value="{{$sta->id}}" {{$sta->id == $data->type_id ? 'selected' : ''}}>{{$sta->name}}</option>
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


                        <input id="action_para_name1" type="text" class="form-control" name="action_para_name1"  value="{{ $data->action_para_name1  }}" >

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


                      <input id="action_para_name2" type="text" class="form-control" name="action_para_name2"  value="{{ $data->action_para_name2  }}" >
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

                  <input id="action_para_name3" type="text" class="form-control" name="action_para_name3"  value="{{ $data->action_para_name3  }}" >
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


              <input id="action_para_name4" type="text" class="form-control" name="action_para_name4"  value="{{ $data->action_para_name4  }}" >
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


          <input id="action_para_name5" type="text" class="form-control" name="action_para_name5"  value="{{ $data->action_para_name5  }}" >
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


                    <input id="action_para_name6" type="text" class="form-control" name="action_para_name6"  value="{{ $data->action_para_name6  }}" >
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


                    <input id="action_para_name7" type="text" class="form-control" name="action_para_name7"  value="{{ $data->action_para_name7  }}" >
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


                <input id="action_para_name8" type="text" class="form-control " name="action_para_name8"  value="{{ $data->action_para_name8  }}" >
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


            <input id="action_para_name9" type="text" class="form-control la9" name="action_para_name9"  value="{{ $data->action_para_name9  }}" >
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


        <input id="action_para_name10" type="text" class="form-control la10" name="action_para_name10"  value="{{ $data->action_para_name10  }}" >
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

  <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}">{{$data->description}}</textarea>

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
                                    Update
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
@endsection
