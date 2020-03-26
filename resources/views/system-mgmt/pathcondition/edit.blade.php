@extends('system-mgmt.pathcondition.base')

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
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Update Path Condition</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('pathcondition.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columnauth">
                            <label for="name" class="">Path Condition Name</label>


                                <input id="name" type="text" class="form-control " name="name" value="{{$data->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>



                            <div class="columnauth">

                              <label for="path_id" class="">Path </label>


                              <select  class="form-control condition name" name="path_id">
                                <option value="" >-select-</option>
                                @foreach ($path as $sta)
                                    <option value="{{$sta->id}}"{{$sta->id == $data->path_id ? 'selected' : ''}}>{{$sta->name}}</option>
                                @endforeach
                              </select>

                        </div>

                            <div class="columnauth">

                              <label for="revers_all_preposition" class="">Reverse All Preposition </label>


                              <select  class="form-control name" name="reverse_all_preposition">
                                <option value="" >-select-</option>
                                <option value="0"{{0 == $data->reverse_all_preposition ? 'selected' : ''}} >0</option>
                                <option value="1"{{1 == $data->reverse_all_preposition ? 'selected' : ''}} >1</option>

                              </select>

                        </div>







                  </div>
                  <h3 style="color:#00325d;">Reverse Each Preposition Flag</h3>

                  <div class="row">

                  <div class="column">

                    <label for="case_channel" class="">Reverse Each Preposition1 </label>


                    <select  class="form-control " name="reverse_each_preposition1">
                      <option value="" >-select-</option>
                      <option value="0"{{0 == $data->reverse_each_preposition1 ? 'selected' : ''}} >0</option>
                      <option value="1" {{1 == $data->reverse_each_preposition1 ? 'selected' : ''}}>1</option>

                    </select>

              </div>

              <div class="column">

                <label for="case_channel" class="">Reverse Each Preposition2 </label>


                <select  class="form-control " name="reverse_each_preposition2">
                  <option value="" >-select-</option>
                  <option value="0"{{0 == $data->reverse_each_preposition2 ? 'selected' : ''}} >0</option>
                  <option value="1"{{1 == $data->reverse_each_preposition2 ? 'selected' : ''}}>1</option>

                </select>

          </div>

          <div class="column">

            <label for="case_channel" class="">Reverse Each Preposition3 </label>


            <select  class="form-control " name="reverse_each_preposition3">
              <option value="" >-select-</option>
              <option value="0" {{0 == $data->reverse_each_preposition3 ? 'selected' : ''}}>0</option>
              <option value="1" {{1 == $data->reverse_each_preposition3 ? 'selected' : ''}}>1</option>

            </select>

      </div>
      <div class="column">

        <label for="case_channel" class="">Reverse Each Preposition4 </label>


        <select  class="form-control " name="reverse_each_preposition4">
          <option value="" >-select-</option>
          <option value="0" {{0 == $data->reverse_each_preposition4 ? 'selected' : ''}}>0</option>
          <option value="1" {{1 == $data->reverse_each_preposition4 ? 'selected' : ''}}>1</option>

        </select>

  </div>
      <div class="column">

          <label for="case_channel" class="">Reverse Each Preposition5 </label>


          <select  class="form-control " name="reverse_each_preposition5">
            <option value="" >-select-</option>
            <option value="0" {{0 == $data->reverse_each_preposition5 ? 'selected' : ''}}>0</option>
            <option value="1" {{1 == $data->reverse_each_preposition5 ? 'selected' : ''}}>1</option>

          </select>

        </div>
                </div>
                <div class="row">

                <div class="column">

                  <label for="case_channel" class="">Reverse Each Preposition6 </label>


                  <select  class="form-control " name="reverse_each_preposition6">
                    <option value="" >-select-</option>
                    <option value="0" {{0 == $data->reverse_each_preposition6 ? 'selected' : ''}}>0</option>
                    <option value="1" {{1 == $data->reverse_each_preposition6 ? 'selected' : ''}}>1</option>

                  </select>

            </div>

            <div class="column">

              <label for="case_channel" class="">Reverse Each Preposition7 </label>


              <select  class="form-control " name="reverse_each_preposition7">
                <option value="" >-select-</option>
                <option value="0" {{0 == $data->reverse_each_preposition7 ? 'selected' : ''}}>0</option>
                <option value="1" {{1 == $data->reverse_each_preposition7 ? 'selected' : ''}}>1</option>

              </select>

        </div>

        <div class="column">

          <label for="case_channel" class="">Reverse Each Preposition8 </label>


          <select  class="form-control " name="reverse_each_preposition8">
            <option value="" >-select-</option>
            <option value="0" {{0 == $data->reverse_each_preposition8 ? 'selected' : ''}}>0</option>
            <option value="1" {{1 == $data->reverse_each_preposition8 ? 'selected' : ''}}>1</option>

          </select>

    </div>
    <div class="column">

      <label for="case_channel" class="">Reverse Each Preposition9 </label>


      <select  class="form-control " name="reverse_each_preposition9">
        <option value="" >-select-</option>
        <option value="0" {{0 == $data->reverse_each_preposition9 ? 'selected' : ''}}>0</option>
        <option value="1" {{1 == $data->reverse_each_preposition9 ? 'selected' : ''}}>1</option>

      </select>

</div>
    <div class="column">

        <label for="case_channel" class="">Reverse Each Preposition10 </label>


        <select  class="form-control " name="reverse_each_preposition10">
          <option value="" >-select-</option>
          <option value="0" {{0 == $data->reverse_each_preposition10 ? 'selected' : ''}}>0</option>
          <option value="1" {{1 == $data->reverse_each_preposition10 ? 'selected' : ''}}>1</option>

        </select>

      </div>
              </div>
                  <h3 style="color:#00325d;">Path Condition Detail</h3>
                  <div class="row">
                    <div class="column">

                      <label for="path_condition_detail1" class="la">Path Condition Detail1</label>


                      <select  class="form-control condition name" name="path_condition_detail1">
                        <option value="" >-select-</option>
                        @foreach ($casecondition as $sta)
                            <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail1 ? 'selected' : ''}}>{{$sta->name}}</option>
                        @endforeach
                      </select>

                </div>
                <div class="column">

                  <label for="path_condition_detail2" class="la">Path Condition Detail2</label>


                  <select  class="form-control condition name" name="path_condition_detail2">
                    <option value="" >-select-</option>
                    @foreach ($casecondition as $sta)
                        <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail2 ? 'selected' : ''}}>{{$sta->name}}</option>
                    @endforeach
                  </select>

            </div>

            <div class="column">

              <label for="path_condition_detail3" class="la">Path Condition Detail3</label>


              <select  class="form-control condition name" name="path_condition_detail3">
                <option value="" >-select-</option>
                @foreach ($casecondition as $sta)
                    <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail3 ? 'selected' : ''}}>{{$sta->name}}</option>
                @endforeach
              </select>

        </div>

        <div class="column">

          <label for="path_condition_detail4" class="la">Path Condition Detail4</label>


          <select  class="form-control condition name" name="path_condition_detail4">
            <option value="" >-select-</option>
            @foreach ($casecondition as $sta)
                <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail4 ? 'selected' : ''}}>{{$sta->name}}</option>
            @endforeach
          </select>

    </div>

    <div class="column">

      <label for="path_condition_detail5" class="la">Path Condition Detail5</label>


      <select  class="form-control condition name" name="path_condition_detail5">
        <option value="" >-select-</option>
        @foreach ($casecondition as $sta)
            <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail5 ? 'selected' : ''}}>{{$sta->name}}</option>
        @endforeach
      </select>

</div>

<div class="column">

  <label for="path_condition_detail6" class="la">Path Condition Detail6</label>


  <select  class="form-control condition name" name="path_condition_detail6">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail6 ? 'selected' : ''}}>{{$sta->name}}</option>
    @endforeach
  </select>

</div>

<div class="column">

  <label for="path_condition_detail7" class="la">Path Condition Detail7</label>


  <select  class="form-control condition name" name="path_condition_detail7">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail7 ? 'selected' : ''}}>{{$sta->name}}</option>
    @endforeach
  </select>

</div>

<div class="column">

  <label for="path_condition_detail8" class="la">Path Condition Detail8</label>


  <select  class="form-control condition name" name="path_condition_detail8">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail8 ? 'selected' : ''}}>{{$sta->name}}</option>
    @endforeach
  </select>

</div>

<div class="column">

  <label for="path_condition_detail9" class="la">Path Condition Detail9</label>


  <select  class="form-control condition name" name="path_condition_detail9">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail9 ? 'selected' : ''}}>{{$sta->name}}</option>
    @endforeach
  </select>

</div>

<div class="column">

  <label for="path_condition_detail10" class="la">Path Condition Detail10</label>


  <select  class="form-control condition name" name="path_condition_detail10">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}"{{$sta->id == $data->path_condition_detail10 ? 'selected' : ''}}>{{$sta->name}}</option>
    @endforeach
  </select>

</div>
      </div>

      <div class="row">

        <div class="columnnote">

          <label for="description" class="">Description </label>


              <textarea id="description" type="text" class="form-control" name="description"  value="{{ $data->description }}">{{ $data->description }}</textarea>

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


  @endsection
