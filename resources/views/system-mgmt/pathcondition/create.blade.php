@extends('system-mgmt.pathcondition.base')

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
                <div class="panel-heading">Add new Path Condition</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('pathcondition.store') }}">
                        {{ csrf_field() }}
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columnauth">
                            <label for="name" class="">Path Condition Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>



                            <div class="columnauth">

                              <label for="path_id" class="">Path </label>


                              <select  class="form-control condition " name="path_id">
                                <option value="" >-select-</option>
                                @foreach ($path as $sta)
                                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                                @endforeach
                              </select>

                        </div>

                            <div class="columnauth">

                              <label for="revers_all_preposition" class="">Reverse All Preposition </label>


                              <select  class="form-control " name="reverse_all_preposition">
                                <option value="" >-select-</option>
                                <option value="0" >0</option>
                                <option value="1" >1</option>

                              </select>

                        </div>







                  </div>
                  <h3 style="color:#00325d;">Reverse Each Preposition Flag</h3>

                  <div class="row">

                  <div class="column">

                    <label for="case_channel" class="">Reverse Each Preposition1 </label>


                    <select  class="form-control " name="reverse_each_preposition1">
                      <option value="" >-select-</option>
                      <option value="0" >0</option>
                      <option value="1" >1</option>

                    </select>

              </div>

              <div class="column">

                <label for="case_channel" class="">Reverse Each Preposition2 </label>


                <select  class="form-control " name="reverse_each_preposition2">
                  <option value="" >-select-</option>
                  <option value="0" >0</option>
                  <option value="1" >1</option>

                </select>

          </div>

          <div class="column">

            <label for="case_channel" class="">Reverse Each Preposition3 </label>


            <select  class="form-control " name="reverse_each_preposition3">
              <option value="" >-select-</option>
              <option value="0" >0</option>
              <option value="1" >1</option>

            </select>

      </div>
      <div class="column">

        <label for="case_channel" class="">Reverse Each Preposition4 </label>


        <select  class="form-control " name="reverse_each_preposition4">
          <option value="" >-select-</option>
          <option value="0" >0</option>
          <option value="1" >1</option>

        </select>

  </div>
      <div class="column">

          <label for="case_channel" class="">Reverse Each Preposition5 </label>


          <select  class="form-control " name="reverse_each_preposition5">
            <option value="" >-select-</option>
            <option value="0" >0</option>
            <option value="1" >1</option>

          </select>

        </div>
                </div>
                <div class="row">

                <div class="column">

                  <label for="case_channel" class="">Reverse Each Preposition6 </label>


                  <select  class="form-control " name="reverse_each_preposition6">
                    <option value="" >-select-</option>
                    <option value="0" >0</option>
                    <option value="1" >1</option>

                  </select>

            </div>

            <div class="column">

              <label for="case_channel" class="">Reverse Each Preposition7 </label>


              <select  class="form-control " name="reverse_each_preposition7">
                <option value="" >-select-</option>
                <option value="0" >0</option>
                <option value="1" >1</option>

              </select>

        </div>

        <div class="column">

          <label for="case_channel" class="">Reverse Each Preposition8 </label>


          <select  class="form-control " name="reverse_each_preposition8">
            <option value="" >-select-</option>
            <option value="0" >0</option>
            <option value="1" >1</option>

          </select>

    </div>
    <div class="column">

      <label for="case_channel" class="">Reverse Each Preposition9 </label>


      <select  class="form-control " name="reverse_each_preposition9">
        <option value="" >-select-</option>
        <option value="0" >0</option>
        <option value="1" >1</option>

      </select>

</div>
    <div class="column">

        <label for="case_channel" class="">Reverse Each Preposition10 </label>


        <select  class="form-control " name="reverse_each_preposition10">
          <option value="" >-select-</option>
          <option value="0" >0</option>
          <option value="1" >1</option>

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
                            <option value="{{$sta->id}}">{{$sta->name}}</option>
                        @endforeach
                      </select>

                </div>
                <div class="column">

                  <label for="path_condition_detail2" class="la">Path Condition Detail2</label>


                  <select  class="form-control condition name" name="path_condition_detail2">
                    <option value="" >-select-</option>
                    @foreach ($casecondition as $sta)
                        <option value="{{$sta->id}}">{{$sta->name}}</option>
                    @endforeach
                  </select>

            </div>

            <div class="column">

              <label for="path_condition_detail3" class="la">Path Condition Detail3</label>


              <select  class="form-control condition name" name="path_condition_detail3">
                <option value="" >-select-</option>
                @foreach ($casecondition as $sta)
                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                @endforeach
              </select>

        </div>

        <div class="column">

          <label for="path_condition_detail4" class="la">Path Condition Detail4</label>


          <select  class="form-control condition name" name="path_condition_detail4">
            <option value="" >-select-</option>
            @foreach ($casecondition as $sta)
                <option value="{{$sta->id}}">{{$sta->name}}</option>
            @endforeach
          </select>

    </div>

    <div class="column">

      <label for="path_condition_detail5" class="la">Path Condition Detail5</label>


      <select  class="form-control condition name" name="path_condition_detail5">
        <option value="" >-select-</option>
        @foreach ($casecondition as $sta)
            <option value="{{$sta->id}}">{{$sta->name}}</option>
        @endforeach
      </select>

</div>

<div class="column">

  <label for="path_condition_detail6" class="la">Path Condition Detail6</label>


  <select  class="form-control condition name" name="path_condition_detail6">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}">{{$sta->name}}</option>
    @endforeach
  </select>

</div>

<div class="column">

  <label for="path_condition_detail7" class="la">Path Condition Detail7</label>


  <select  class="form-control condition name" name="path_condition_detail7">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}">{{$sta->name}}</option>
    @endforeach
  </select>

</div>

<div class="column">

  <label for="path_condition_detail8" class="la">Path Condition Detail8</label>


  <select  class="form-control condition name" name="path_condition_detail8">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}">{{$sta->name}}</option>
    @endforeach
  </select>

</div>

<div class="column">

  <label for="path_condition_detail9" class="la">Path Condition Detail9</label>


  <select  class="form-control condition name" name="path_condition_detail9">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}">{{$sta->name}}</option>
    @endforeach
  </select>

</div>

<div class="column">

  <label for="path_condition_detail10" class="la">Path Condition Detail10</label>


  <select  class="form-control condition name" name="path_condition_detail10">
    <option value="" >-select-</option>
    @foreach ($casecondition as $sta)
        <option value="{{$sta->id}}">{{$sta->name}}</option>
    @endforeach
  </select>

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


@endsection
