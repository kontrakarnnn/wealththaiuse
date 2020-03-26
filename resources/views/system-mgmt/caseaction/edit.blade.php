@extends('system-mgmt.caseaction.base')

@section('action-content')

<style>


/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 100%;
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
                <div class="panel-heading">Update Case Action</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('caseaction.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">

                          <div class="columnauth">

                            <label for="case_channel " class="">Case</label>


                            <select  class="form-control  name" name="case_id">
                              <option value="" >-select-</option>
                              @foreach ($case as $sta)
                                  <option value="{{$sta->id}}"{{$sta->id == $data->case_id ? 'selected' : ''}}>{{$sta->name}}</option>
                              @endforeach
                            </select>

                        </div>
                        <div class="columnauth">

                          <label for="case_channel " class="">Stage Action</label>


                          <select  class="form-control  name" name="stage_action">
                            <option value="" >-select-</option>
                            @foreach ($stageaction as $sta)
                                <option value="{{$sta->id}}"{{$sta->id == $data->stage_action ? 'selected' : ''}}>{{$sta->name}}</option>
                            @endforeach
                          </select>

                      </div>





                  </div>


                  <div class="row">


                <div class="columnauth">

                  <label for="case_channel " class="">Stage</label>


                  <select  class="form-control  name" name="action_stage_id">
                    <option value="" >-select-</option>
                    @foreach ($stage as $sta)
                        <option value="{{$sta->id}}"{{$sta->id == $data->action_stage_id ? 'selected' : ''}}>{{$sta->name}}</option>
                    @endforeach
                  </select>

            </div>

                  </div>

                  <div class="row">


                <div class="columnauth">

                  <label for="case_channel " class="">Action Flag </label>


                  <select  class="form-control  " name="action_flag">
                    <option value="" >-select-</option>
                    <option value="0" {{0 == $data->action_flag ? 'selected' : ''}}>0</option>
                    <option value="1"{{1 == $data->action_flag ? 'selected' : ''}} >1</option>

                  </select>

            </div>
                <div class="columnauth">

                  <label for="case_channel " class="">Action Time </label>


                  <select  class="form-control  " name="action_time">
                    <option value="" >-select-</option>
                    <option value="0" {{0 == $data->action_time ? 'selected' : ''}}>Entering</option>
                    <option value="1" {{1 == $data->action_time ? 'selected' : ''}}>Exiting</option>


                  </select>

            </div>

                  </div>

                  <div class="row">
                    <div class="column">
                      <label for="description" class="">Case Action Name</label>


                          <textarea id="description" type="text" class="form-control" name="description"   >{{$data->description}}</textarea>

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
