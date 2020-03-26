@extends('system-mgmt.case-type-config.base')

@section('action-content')
<style>


/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 20%;
  padding: 10px;
 /* Should be removed. Only for demonstration */
}
.columndesc {
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
  .columndesc {
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

            <div class="panel panel-default">
                <div class="panel-heading">Add new Case Type Config</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('case-type-config.store') }}">
                        {{ csrf_field() }}
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columndesc">
                            <label for="sub_type_config_name" class="">Sub Type Config Name</label>


                                <input id="sub_type_config_name" type="text" class="form-control" name="sub_type_config_name" value="{{ old('sub_type_config_name') }}" >

                                @if ($errors->has('sub_type_config_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_type_config_name') }}</strong>
                                    </span>
                                @endif

                            </div>

                <div class="columndesc">

                  <label for="description" class="">Description</label>


                      <textarea id="description" type="text" class="form-control" name="description"  value="{{ old('description') }}" ></textarea>

                      @if ($errors->has('description'))
                          <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif

            </div>
                  </div>
                  <h3 style="color:#00325d;">Config Label</h3>
                  <div class="row">
                    <div class="column">

                      <label for="name" class="">Config Label1</label>


                          <input id="config_label1" type="text" class="form-control" name="config_label1"  value="{{ old('config_label1') }}" >

                          @if ($errors->has('config_label1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('config_label1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">

                  <label for="config_label2" class="">Config Label2</label>


                      <input id="config_label2" type="text" class="form-control" name="config_label2"  value="{{ old('config_label2') }}" >

                      @if ($errors->has('config_label2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('config_label2') }}</strong>
                          </span>
                      @endif

            </div>



            <div class="column">

              <label for="config_label3" class="">Config Label3</label>


                  <input id="config_label3" type="text" class="form-control" name="config_label3"  value="{{ old('config_label3') }}" >

                  @if ($errors->has('config_label3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('config_label3') }}</strong>
                      </span>
                  @endif

        </div>
        <div class="column">

          <label for="config_label4" class="">Config Label4</label>


              <input id="config_label4" type="text" class="form-control" name="config_label4"  value="{{ old('config_label4') }}" >

              @if ($errors->has('config_label4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('config_label4') }}</strong>
                  </span>
              @endif

    </div>
    <div class="column">

      <label for="config_label5" class="">Config Label5</label>


          <input id="config_label5" type="text" class="form-control" name="config_label5"  value="{{ old('config_label5') }}" >

          @if ($errors->has('config_label5'))
              <span class="help-block">
                  <strong>{{ $errors->first('config_label5') }}</strong>
              </span>
          @endif

</div>

            </div>

            <div class="row">
              <div class="column">

                <label for="config_label6" class="">Config Label6</label>


                    <input id="config_label6" type="text" class="form-control" name="config_label6"  value="{{ old('config_label6') }}" >

                    @if ($errors->has('config_label6'))
                        <span class="help-block">
                            <strong>{{ $errors->first('config_label6') }}</strong>
                        </span>
                    @endif

              </div>
              <div class="column">

                <label for="config_label7" class="">Config Label7</label>


                    <input id="config_label7" type="text" class="form-control" name="config_label7"  value="{{ old('config_label7') }}" >

                    @if ($errors->has('config_label7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('config_label7') }}</strong>
                        </span>
                    @endif

          </div>
          <div class="column">

            <label for="config_label8" class="">Config Label8</label>


                <input id="config_label8" type="text" class="form-control" name="config_label8"  value="{{ old('config_label8') }}" >

                @if ($errors->has('config_label8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('config_label8') }}</strong>
                    </span>
                @endif

      </div>



      <div class="column">

        <label for="config_label9" class="">Config Label9</label>


            <input id="config_label9" type="text" class="form-control" name="config_label9"  value="{{ old('config_label9') }}" >

            @if ($errors->has('config_label9'))
                <span class="help-block">
                    <strong>{{ $errors->first('config_label9') }}</strong>
                </span>
            @endif

  </div>
  <div class="column">

    <label for="config_label10" class="">Config Label10</label>


        <input id="config_label10" type="text" class="form-control" name="config_label10"  value="{{ old('config_label10') }}" >

        @if ($errors->has('config_label10'))
            <span class="help-block">
                <strong>{{ $errors->first('config_label10') }}</strong>
            </span>
        @endif

</div>

</div>
<h3 style="color:#00325d;">Config Value </h3>

<div class="row">
  <div class="column">

    <label for="config_value1" class="">Config Value1</label>


        <input id="config_value1" type="text" class="form-control" name="config_value1"  value="{{ old('config_value1') }}" >

        @if ($errors->has('config_value1'))
            <span class="help-block">
                <strong>{{ $errors->first('config_value1') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="config_value2" class="">Config Value2</label>


      <input id="config_value2" type="text" class="form-control" name="config_value2"  value="{{ old('config_value2') }}" >

      @if ($errors->has('config_value2'))
          <span class="help-block">
              <strong>{{ $errors->first('config_value2') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="config_value3" class="">Config Value3</label>


      <input id="config_value3" type="text" class="form-control" name="config_value3"  value="{{ old('config_value3') }}" >

      @if ($errors->has('config_value3'))
          <span class="help-block">
              <strong>{{ $errors->first('config_value3') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="config_value4" class="">Config Value4</label>


      <input id="config_value4" type="text" class="form-control" name="config_value4"  value="{{ old('config_value4') }}" >

      @if ($errors->has('config_value4'))
          <span class="help-block">
              <strong>{{ $errors->first('config_value4') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="config_value5" class="">Config Value5</label>


      <input id="config_value5" type="text" class="form-control" name="config_value5"  value="{{ old('config_value5') }}" >

      @if ($errors->has('config_value5'))
          <span class="help-block">
              <strong>{{ $errors->first('config_value5') }}</strong>
          </span>
      @endif

</div>

</div>


<div class="row">
  <div class="column">

    <label for="config_value6" class="">Config Value6</label>


        <input id="config_value6" type="text" class="form-control" name="config_value6"  value="{{ old('config_value6') }}" >

        @if ($errors->has('config_value6'))
            <span class="help-block">
                <strong>{{ $errors->first('config_value6') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="config_value7" class="">Config Value7</label>


        <input id="config_value7" type="text" class="form-control" name="config_value7"  value="{{ old('config_value7') }}" >

        @if ($errors->has('config_value7'))
            <span class="help-block">
                <strong>{{ $errors->first('config_value7') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="config_value8" class="">Config Value8</label>


      <input id="config_value8" type="text" class="form-control" name="config_value8"  value="{{ old('config_value8') }}" >

      @if ($errors->has('config_value8'))
          <span class="help-block">
              <strong>{{ $errors->first('config_value8') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="config_value9" class="">Config Value9</label>


      <input id="config_value9" type="text" class="form-control" name="config_value9"  value="{{ old('config_value9') }}" >

      @if ($errors->has('config_value9'))
          <span class="help-block">
              <strong>{{ $errors->first('config_value9') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="config_value10" class="">Config Value10</label>


      <input id="config_value10" type="text" class="form-control" name="config_value10"  value="{{ old('config_value10') }}" >

      @if ($errors->has('config_value10'))
          <span class="help-block">
              <strong>{{ $errors->first('config_value10') }}</strong>
          </span>
      @endif

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
    </div>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">

          $(".name").select2({
                placeholder: "Select",
                //allowClear: true
            });
    </script>
@endsection
