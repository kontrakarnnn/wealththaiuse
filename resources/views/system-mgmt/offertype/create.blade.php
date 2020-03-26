@extends('system-mgmt.offertype.base')

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
                <div class="panel-heading">Add new Offer Type</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('offertype.store') }}">
                        {{ csrf_field() }}
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columnauth">
                            <label for="name" class="">Offer Type Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>



                            <div class="columnauth">

                              <label for="case_channel" class="">Offer Category </label>


                              <select  class="form-control " name="offer_category">
                                <option value="" >-select-</option>
                                @foreach ($offercategory as $sta)
                                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                                @endforeach
                              </select>

                        </div>

                            <div class="columnauth">

                              <label for="case_channel" class="">Asset Type </label>


                              <select  class="form-control condition" name="asset_type">
                                <option value="" >-select-</option>
                                @foreach ($assettype as $sta)
                                    <option value="{{$sta->id}}">{{$sta->la_nla_type}} {{$sta->nla_sub_type}}</option>
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



                  <h3 style="color:#00325d;">Offer Value Name</h3>
                  <div class="row">
                    <div class="column">

                      <label for="name" class="lasd">Offer Value Name1</label>

                      <div class="la">

                        <input id="offer_value_name1" type="text" class="form-control" name="offer_value_name1"  value="{{ old('offer_value_name1') }}" >

                        </div>
                          @if ($errors->has('offer_value_name1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('offer_value_name1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">

                  <label for="offer_value_name2" class="lasd2">Offer Value Name2</label>

                  <div class="la2">

                      <input id="offer_value_name2" type="text" class="form-control" name="offer_value_name2"  value="{{ old('offer_value_name2') }}" >
                    </div>

                      @if ($errors->has('offer_value_name2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('offer_value_name2') }}</strong>
                          </span>
                      @endif
            </div>



            <div class="column">

              <label for="offer_value_name3" class="lasd3">Offer Value Name3</label>

              <div class="la3">

                  <input id="offer_value_name3" type="text" class="form-control" name="offer_value_name3"  value="{{ old('offer_value_name3') }}" >
                </div>

                  @if ($errors->has('offer_value_name3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('offer_value_name3') }}</strong>
                      </span>
                  @endif
        </div>
        <div class="column">

          <label for="offer_value_name4" class="lasd4">Offer Value Name4</label>

          <div class="la4">

              <input id="offer_value_name4" type="text" class="form-control" name="offer_value_name4"  value="{{ old('offer_value_name4') }}" >
            </div>

              @if ($errors->has('offer_value_name4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value_name4') }}</strong>
                  </span>
              @endif
    </div>
    <div class="column">

      <label for="offer_value_name5" class="lasd5">Offer Value Name5</label>

      <div class="la5">

          <input id="offer_value_name5" type="text" class="form-control" name="offer_value_name5"  value="{{ old('offer_value_name5') }}" >
        </div>

          @if ($errors->has('offer_value_name5'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_name5') }}</strong>
              </span>
          @endif
</div>

            </div>

            <div class="row">
              <div class="column">

                <label for="offer_value_name6" class="lasd6">Offer Value Name6</label>

                <div class="la6">

                    <input id="offer_value_name6" type="text" class="form-control" name="offer_value_name6"  value="{{ old('offer_value_name6') }}" >
                  </div>

                    @if ($errors->has('offer_value_name6'))
                        <span class="help-block">
                            <strong>{{ $errors->first('offer_value_name6') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="column">

                <label for="offer_value_name7" class="lasd7">Offer Value Name7</label>

                <div class="la7">

                    <input id="offer_value_name7" type="text" class="form-control" name="offer_value_name7"  value="{{ old('offer_value_name7') }}" >
                  </div>

                    @if ($errors->has('offer_value_name7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('offer_value_name7') }}</strong>
                        </span>
                    @endif
          </div>
          <div class="column">

            <label for="offer_value_name8" class="lasd8">Offer Value Name8</label>

            <div class="la8">

                <input id="offer_value_name8" type="text" class="form-control " name="offer_value_name8"  value="{{ old('offer_value_name8') }}" >
              </div>

                @if ($errors->has('offer_value_name8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('offer_value_name8') }}</strong>
                    </span>
                @endif
      </div>



      <div class="column">

        <label for="offer_value_name9" class="lasd9">Offer Value Name9</label>

        <div class="la9">

            <input id="offer_value_name9" type="text" class="form-control la9" name="offer_value_name9"  value="{{ old('offer_value_name9') }}" >
          </div>

            @if ($errors->has('offer_value_name9'))
                <span class="help-block">
                    <strong>{{ $errors->first('offer_value_name9') }}</strong>
                </span>
            @endif
  </div>
  <div class="column">

    <label for="offer_value_name10" class="lasd10">Offer Value Name10</label>

    <div class="la10">

        <input id="offer_value_name10" type="text" class="form-control la10" name="offer_value_name10"  value="{{ old('offer_value_name10') }}" >
      </div>

        @if ($errors->has('offer_value_name10'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name10') }}</strong>
            </span>
        @endif
</div>

      </div>
      <div class="row">
        <div class="column">

          <label for="offer_value_name11" class="lasd11">Offer Value Name11</label>

          <div class="la11">

              <input id="offer_value_name11" type="text" class="form-control la11" name="offer_value_name11"  value="{{ old('offer_value_name11') }}" >
            </div>

              @if ($errors->has('offer_value_name11'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value_name11') }}</strong>
                  </span>
              @endif
        </div>
        <div class="column">

          <label for="offer_value_name12" class="lasd7">Offer Value Name12</label>

          <div class="la12">

              <input id="offer_value_name12" type="text" class="form-control la12" name="offer_value_name12"  value="{{ old('offer_value_name12') }}" >
            </div>

              @if ($errors->has('offer_value_name12'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value_name12') }}</strong>
                  </span>
              @endif
    </div>
    <div class="column">

      <label for="offer_value_name13" class="lasd8">Offer Value Name13</label>

      <div class="la13">

          <input id="offer_value_name13" type="text" class="form-control la13" name="offer_value_name13"  value="{{ old('offer_value_name13') }}" >
        </div>

          @if ($errors->has('offer_value_name13'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_name13') }}</strong>
              </span>
          @endif
</div>



<div class="column">

  <label for="offer_value_name14" class="lasd9">Offer Value Name14</label>

  <div class="la14">

      <input id="offer_value_name14" type="text" class="form-control la14" name="offer_value_name14"  value="{{ old('offer_value_name14') }}" >
    </div>

      @if ($errors->has('offer_value_name14'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_value_name14') }}</strong>
          </span>
      @endif
</div>
<div class="column">

<label for="offer_value_name15" class="lasd10">Offer Value Name15</label>

<div class="la15">

  <input id="offer_value_name15" type="text" class="form-control la15" name="offer_value_name15"  value="{{ old('offer_value_name15') }}" >
</div>

  @if ($errors->has('offer_value_name15'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_value_name15') }}</strong>
      </span>
  @endif
</div>

</div>

<div class="row">
  <div class="column">

    <label for="offer_value_name16" class="lasd6">Offer Value Name16</label>

    <div class="la16">

        <input id="offer_value_name16" type="text" class="form-control la16" name="offer_value_name16"  value="{{ old('offer_value_name16') }}" >
      </div>

        @if ($errors->has('offer_value_name16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name16') }}</strong>
            </span>
        @endif
  </div>
  <div class="column">

    <label for="offer_value_name17" class="lasd7">Offer Value Name17</label>

    <div class="la17">

        <input id="offer_value_name17" type="text" class="form-control " name="offer_value_name17"  value="{{ old('offer_value_name17') }}" >
      </div>

        @if ($errors->has('offer_value_name17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name17') }}</strong>
            </span>
        @endif
</div>
<div class="column">

<label for="offer_value_name18" class="lasd8">Offer Value Name18</label>

<div class="la18">

    <input id="offer_value_name18" type="text" class="form-control " name="offer_value_name18"  value="{{ old('offer_value_name18') }}" >
  </div>

    @if ($errors->has('offer_value_name18'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name18') }}</strong>
        </span>
    @endif
</div>



<div class="column">

<label for="offer_value_name19" class="lasd9">Offer Value Name19</label>


<input id="offer_value_name19" type="text" class="form-control la19" name="offer_value_name19"  value="{{ old('offer_value_name19') }}" >

@if ($errors->has('offer_value_name19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name19') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name20" class="lasd10">Offer Value Name20</label>


<input id="offer_value_name20" type="text" class="form-control la20" name="offer_value_name20"  value="{{ old('offer_value_name20') }}" >

@if ($errors->has('offer_value_name20'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name20') }}</strong>
</span>
@endif

</div>

</div>
<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Offer Value Name 21-40</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="box-body">

<div class="row">
  <div class="column">

    <label for="offer_value_name21" class="lasd6">Offer Value Name21</label>


        <input id="offer_value_name21" type="text" class="form-control la21" name="offer_value_name21"  value="{{ old('offer_value_name21') }}" >

        @if ($errors->has('offer_value_name21'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name21') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="offer_value_name22" class="lasd7">Offer Value Name22</label>


        <input id="offer_value_name22" type="text" class="form-control la22" name="offer_value_name22"  value="{{ old('offer_value_name22') }}" >

        @if ($errors->has('offer_value_name22'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name22') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="offer_value_name23" class="lasd8">Offer Value Name23</label>


    <input id="offer_value_name23" type="text" class="form-control la23" name="offer_value_name83"  value="{{ old('offer_value_name23') }}" >

    @if ($errors->has('offer_value_name23'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name23') }}</strong>
        </span>
    @endif

</div>



<div class="column">

<label for="offer_value_name24" class="lasd9">Offer Value Name24</label>


<input id="offer_value_name24" type="text" class="form-control la24" name="offer_value_name24"  value="{{ old('offer_value_name24') }}" >

@if ($errors->has('offer_value_name24'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name24') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name25" class="lasd10">Offer Value Name25</label>


<input id="offer_value_name25" type="text" class="form-control la25" name="offer_value_name25"  value="{{ old('offer_value_name25') }}" >

@if ($errors->has('offer_value_name25'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name25') }}</strong>
</span>
@endif

</div>

</div>

<div class="row">
  <div class="column">

    <label for="offer_value_name26" class="lasd6">Offer Value Name26</label>


        <input id="offer_value_name26" type="text" class="form-control la26" name="offer_value_name26"  value="{{ old('offer_value_name26') }}" >

        @if ($errors->has('offer_value_name26'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name26') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="offer_value_name27" class="lasd7">Offer Value Name27</label>


        <input id="offer_value_name27" type="text" class="form-control la27" name="offer_value_name27"  value="{{ old('offer_value_name27') }}" >

        @if ($errors->has('offer_value_name27'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name27') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="offer_value_name28" class="lasd8">Offer Value Name28</label>


    <input id="offer_value_name28" type="text" class="form-control la28" name="offer_value_name28"  value="{{ old('offer_value_name28') }}" >

    @if ($errors->has('offer_value_name28'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name28') }}</strong>
        </span>
    @endif

</div>



<div class="column">

<label for="offer_value_name29" class="lasd9">Offer Value Name29</label>


<input id="offer_value_name29" type="text" class="form-control la29" name="offer_value_name29"  value="{{ old('offer_value_name29') }}" >

@if ($errors->has('offer_value_name29'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name29') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name30" class="lasd10">Offer Value Name30</label>


<input id="offer_value_name30" type="text" class="form-control la30" name="offer_value_name30"  value="{{ old('offer_value_name30') }}" >

@if ($errors->has('offer_value_name30'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name30') }}</strong>
</span>
@endif

</div>

</div>

<div class="row">
  <div class="column">

    <label for="offer_value_name31" class="lasd6">Offer Value Name31</label>


        <input id="offer_value_name31" type="text" class="form-control la31" name="offer_value_name31"  value="{{ old('offer_value_name31') }}" >

        @if ($errors->has('offer_value_name31'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name31') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="offer_value_name32" class="lasd7">Offer Value Name32</label>


        <input id="offer_value_name32" type="text" class="form-control la32" name="offer_value_name32"  value="{{ old('offer_value_name32') }}" >

        @if ($errors->has('offer_value_name32'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name32') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="offer_value_name33" class="lasd8">Offer Value Name33</label>


    <input id="offer_value_name33" type="text" class="form-control la33" name="offer_value_name33"  value="{{ old('offer_value_name33') }}" >

    @if ($errors->has('offer_value_name33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name33') }}</strong>
        </span>
    @endif

</div>



<div class="column">

<label for="offer_value_name34" class="lasd9">Offer Value Name34</label>


<input id="offer_value_name34" type="text" class="form-control la34" name="offer_value_name34"  value="{{ old('offer_value_name34') }}" >

@if ($errors->has('offer_value_name34'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name34') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name35" class="lasd10">Offer Value Name35</label>


<input id="offer_value_name35" type="text" class="form-control la35" name="offer_value_name35"  value="{{ old('offer_value_name35') }}" >

@if ($errors->has('offer_value_name35'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name35') }}</strong>
</span>
@endif

</div>

</div>

<div class="row">
  <div class="column">

    <label for="offer_value_name36" class="lasd6">Offer Value Name36</label>


        <input id="offer_value_name36" type="text" class="form-control la36" name="offer_value_name36"  value="{{ old('offer_value_name36') }}" >

        @if ($errors->has('offer_value_name36'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name36') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="offer_value_name37" class="lasd7">Offer Value Name37</label>


        <input id="offer_value_name37" type="text" class="form-control la37" name="offer_value_name37"  value="{{ old('offer_value_name37') }}" >

        @if ($errors->has('offer_value_name37'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name37') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="offer_value_name38" class="lasd8">Offer Value Name38</label>


    <input id="offer_value_name38" type="text" class="form-control la38" name="offer_value_name38"  value="{{ old('offer_value_name38') }}" >

    @if ($errors->has('offer_value_name38'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name38') }}</strong>
        </span>
    @endif

</div>



<div class="column">

<label for="offer_value_name39" class="lasd9">Offer Value Name39</label>


<input id="offer_value_name39" type="text" class="form-control la39" name="offer_value_name39"  value="{{ old('offer_value_name39') }}" >

@if ($errors->has('offer_value_name39'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name39') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name40" class="lasd10">Offer Value Name40</label>


<input id="offer_value_name40" type="text" class="form-control la40" name="offer_value_name40"  value="{{ old('offer_value_name40') }}" >

@if ($errors->has('offer_value_name40'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name40') }}</strong>
</span>
@endif

</div>

</div>
</div>
</div>
<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Offer Payment Name 1-40</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="box-body">

<div class="row">
  <div class="column">

    <label for="offer_value_name21" class="lasd6">Offer Payment Name1</label>


        <input id="offer_payment_name1" type="text" class="form-control la21" name="offer_payment_name1"  value="{{ old('offer_payment_name1') }}" >

        @if ($errors->has('offer_payment_name1'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_name1') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="offer_payment_name2" class="lasd7">Offer Payment Name2</label>


        <input id="offer_payment_name2" type="text" class="form-control la22" name="offer_payment_name2"  value="{{ old('offer_payment_name2') }}" >

        @if ($errors->has('offer_payment_name2'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_name2') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="offer_payment_name23" class="lasd8">Offer Payment Name3</label>


    <input id="offer_value_name23" type="text" class="form-control la23" name="offer_value_name83"  value="{{ old('offer_value_name23') }}" >

    @if ($errors->has('offer_value_name23'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name23') }}</strong>
        </span>
    @endif

</div>



<div class="column">

<label for="offer_value_name24" class="lasd9">Offer Value Name24</label>


<input id="offer_value_name24" type="text" class="form-control la24" name="offer_value_name24"  value="{{ old('offer_value_name24') }}" >

@if ($errors->has('offer_value_name24'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name24') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name25" class="lasd10">Offer Value Name25</label>


<input id="offer_value_name25" type="text" class="form-control la25" name="offer_value_name25"  value="{{ old('offer_value_name25') }}" >

@if ($errors->has('offer_value_name25'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name25') }}</strong>
</span>
@endif

</div>

</div>

<div class="row">
  <div class="column">

    <label for="offer_value_name26" class="lasd6">Offer Value Name26</label>


        <input id="offer_value_name26" type="text" class="form-control la26" name="offer_value_name26"  value="{{ old('offer_value_name26') }}" >

        @if ($errors->has('offer_value_name26'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name26') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="offer_value_name27" class="lasd7">Offer Value Name27</label>


        <input id="offer_value_name27" type="text" class="form-control la27" name="offer_value_name27"  value="{{ old('offer_value_name27') }}" >

        @if ($errors->has('offer_value_name27'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name27') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="offer_value_name28" class="lasd8">Offer Value Name28</label>


    <input id="offer_value_name28" type="text" class="form-control la28" name="offer_value_name28"  value="{{ old('offer_value_name28') }}" >

    @if ($errors->has('offer_value_name28'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name28') }}</strong>
        </span>
    @endif

</div>



<div class="column">

<label for="offer_value_name29" class="lasd9">Offer Value Name29</label>


<input id="offer_value_name29" type="text" class="form-control la29" name="offer_value_name29"  value="{{ old('offer_value_name29') }}" >

@if ($errors->has('offer_value_name29'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name29') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name30" class="lasd10">Offer Value Name30</label>


<input id="offer_value_name30" type="text" class="form-control la30" name="offer_value_name30"  value="{{ old('offer_value_name30') }}" >

@if ($errors->has('offer_value_name30'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name30') }}</strong>
</span>
@endif

</div>

</div>

<div class="row">
  <div class="column">

    <label for="offer_value_name31" class="lasd6">Offer Value Name31</label>


        <input id="offer_value_name31" type="text" class="form-control la31" name="offer_value_name31"  value="{{ old('offer_value_name31') }}" >

        @if ($errors->has('offer_value_name31'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name31') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="offer_value_name32" class="lasd7">Offer Value Name32</label>


        <input id="offer_value_name32" type="text" class="form-control la32" name="offer_value_name32"  value="{{ old('offer_value_name32') }}" >

        @if ($errors->has('offer_value_name32'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name32') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="offer_value_name33" class="lasd8">Offer Value Name33</label>


    <input id="offer_value_name33" type="text" class="form-control la33" name="offer_value_name33"  value="{{ old('offer_value_name33') }}" >

    @if ($errors->has('offer_value_name33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name33') }}</strong>
        </span>
    @endif

</div>



<div class="column">

<label for="offer_value_name34" class="lasd9">Offer Value Name34</label>


<input id="offer_value_name34" type="text" class="form-control la34" name="offer_value_name34"  value="{{ old('offer_value_name34') }}" >

@if ($errors->has('offer_value_name34'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name34') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name35" class="lasd10">Offer Value Name35</label>


<input id="offer_value_name35" type="text" class="form-control la35" name="offer_value_name35"  value="{{ old('offer_value_name35') }}" >

@if ($errors->has('offer_value_name35'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name35') }}</strong>
</span>
@endif

</div>

</div>

<div class="row">
  <div class="column">

    <label for="offer_value_name36" class="lasd6">Offer Value Name36</label>


        <input id="offer_value_name36" type="text" class="form-control la36" name="offer_value_name36"  value="{{ old('offer_value_name36') }}" >

        @if ($errors->has('offer_value_name36'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name36') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">

    <label for="offer_value_name37" class="lasd7">Offer Value Name37</label>


        <input id="offer_value_name37" type="text" class="form-control la37" name="offer_value_name37"  value="{{ old('offer_value_name37') }}" >

        @if ($errors->has('offer_value_name37'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_name37') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="offer_value_name38" class="lasd8">Offer Value Name38</label>


    <input id="offer_value_name38" type="text" class="form-control la38" name="offer_value_name38"  value="{{ old('offer_value_name38') }}" >

    @if ($errors->has('offer_value_name38'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_name38') }}</strong>
        </span>
    @endif

</div>



<div class="column">

<label for="offer_value_name39" class="lasd9">Offer Value Name39</label>


<input id="offer_value_name39" type="text" class="form-control la39" name="offer_value_name39"  value="{{ old('offer_value_name39') }}" >

@if ($errors->has('offer_value_name39'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_name39') }}</strong>
    </span>
@endif

</div>
<div class="column">

<label for="offer_value_name40" class="lasd10">Offer Value Name40</label>


<input id="offer_value_name40" type="text" class="form-control la40" name="offer_value_name40"  value="{{ old('offer_value_name40') }}" >

@if ($errors->has('offer_value_name40'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value_name40') }}</strong>
</span>
@endif

</div>

</div>
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



                $.ajax({
                    type:'get',
                    url:'{!!URL::to('AssetTypeInfo')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      console.log('success');

                      console.log(data);

                     console.log(data.length);

                      for(var i=0; i<data.length;i++){
                      //  op+='<label value="'+data[i].con_para_name1+'">'+data[i].con_para_name1+'</label>';

                        //op+='<input id="offer_value_name1" type="text" class="form-control " name="offer_value_name1" value="'+data[i].ref_info_head1+'" >';
                        if(data[i].ref_info_head1 != null)
                        {
                        op+='<div><input id="offer_value_name1" type="text" class="form-control " name="offer_value_name1" value="'+data[i].ref_info_head1+'" ></div>';
                        }
                        else{
                          op+='<div><input id="offer_value_name1" type="text" class="form-control " name="offer_value_name1" value="" ></div>';
                        }
                        if(data[i].ref_info_head2 != null)
                        {
                        op2+='<div><input id="offer_value_name2" type="text" class="form-control " name="offer_value_name2" value="'+data[i].ref_info_head2+'" ></div>';
                        }
                        else{
                          op2+='<div><input id="offer_value_name2" type="text" class="form-control " name="offer_value_name2" value="" ></div>';

                        }
                        if(data[i].ref_info_head3 != null)
                        {
                        op3+='<div><input id="offer_value_name3" type="text" class="form-control " name="offer_value_name3" value="'+data[i].ref_info_head3+'" ></div>';
                        }
                        else{
                          op3+='<div><input id="offer_value_name3" type="text" class="form-control " name="offer_value_name3" value="" ></div>';
                        }
                        if(data[i].ref_info_head4 != null)
                        {
                        op4+='<div><input id="offer_value_name4" type="text" class="form-control " name="offer_value_name4" value="'+data[i].ref_info_head4+'" ></div>';
                        }
                        else{
                          op4+='<div><input id="offer_value_name4" type="text" class="form-control " name="offer_value_name4" value="" ></div>';

                        }
                        if(data[i].ref_info_head5 != null)
                        {
                        op5+='<div><input id="offer_value_name5" type="text" class="form-control " name="offer_value_name5" value="'+data[i].ref_info_head5+'" ></div>';
                        }
                        else{
                          op5+='<div><input id="offer_value_name5" type="text" class="form-control " name="offer_value_name5" value="" ></div>';

                        }
                        if(data[i].ref_info_head6 != null)
                        {
                        op6+='<div><input id="offer_value_name6" type="text" class="form-control " name="offer_value_name6" value="'+data[i].ref_info_head6+'" ></div>';
                        }
                        else{
                          op6+='<div><input id="offer_value_name6" type="text" class="form-control " name="offer_value_name6" value="" ></div>';
                        }
                        if(data[i].ref_info_head7 != null)
                        {
                        op7+='<div><input id="offer_value_name7" type="text" class="form-control " name="offer_value_name7" value="'+data[i].ref_info_head7+'" ></div>';
                        }
                        else{
                          op7+='<div><input id="offer_value_name7" type="text" class="form-control " name="offer_value_name7" value="" ></div>';

                        }
                        if(data[i].ref_info_head8 != null)
                        {
                        op8+='<div><input id="offer_value_name8" type="text" class="form-control " name="offer_value_name8" value="'+data[i].ref_info_head8+'" ></div>';
                        }
                        else {
                          op8+='<div><input id="offer_value_name8" type="text" class="form-control " name="offer_value_name8" value="" ></div>';
                        }
                        if(data[i].ref_info_head9 != null)
                        {
                        op9+='<div><input id="offer_value_name9" type="text" class="form-control " name="offer_value_name9" value="'+data[i].ref_info_head9+'" ></div>';
                        }
                        else{
                          op9+='<div><input id="offer_value_name9" type="text" class="form-control " name="offer_value_name9" value="" ></div>';
                        }
                        if(data[i].ref_info_head10 != null)
                        {
                        op10+='<div><input id="offer_value_name10" type="text" class="form-control " name="offer_value_name10" value="'+data[i].ref_info_head10+'" ></div>';
                        }
                        else {
                          op10+='<div><input id="offer_value_name10" type="text" class="form-control " name="offer_value_name10" value="" ></div>';
                        }
                        if(data[i].ref_info_head11 != null)
                        {
                        op11+='<div><input id="offer_value_name11" type="text" class="form-control " name="offer_value_name11" value="'+data[i].ref_info_head11+'" ></div>';
                        }
                        else{
                          op11+='<div><input id="offer_value_name11" type="text" class="form-control " name="offer_value_name11" value="" ></div>';

                        }
                        if(data[i].ref_info_head12 != null)
                        {
                        op12+='<div><input id="offer_value_name12" type="text" class="form-control " name="offer_value_name12" value="'+data[i].ref_info_head12+'" ></div>';
                        }
                        else {
                          op12+='<div><input id="offer_value_name12" type="text" class="form-control " name="offer_value_name12" value="" ></div>';
                        }
                        if(data[i].ref_info_head13 != null)
                        {
                        op13+='<div><input id="offer_value_name13" type="text" class="form-control " name="offer_value_name13" value="'+data[i].ref_info_head13+'" ></div>';
                        }
                        else{
                          op13+='<div><input id="offer_value_name13" type="text" class="form-control " name="offer_value_name13" value="" ></div>';
                        }
                        if(data[i].ref_info_head14 != null)
                        {
                        op14+='<div><input id="offer_value_name14" type="text" class="form-control " name="offer_value_name14" value="'+data[i].ref_info_head14+'" ></div>';
                        }
                        else{
                          op14+='<div><input id="offer_value_name14" type="text" class="form-control " name="offer_value_name14" value="" ></div>';
                        }
                        if(data[i].ref_info_head15 != null)
                        {
                        op15+='<div><input id="offer_value_name15" type="text" class="form-control " name="offer_value_name15" value="'+data[i].ref_info_head15+'" ></div>';
                        }
                        else {
                          op15+='<div><input id="offer_value_name15" type="text" class="form-control " name="offer_value_name15" value="" ></div>';
                        }
                        if(data[i].ref_info_head16 != null)
                        {
                        op16+='<div><input id="offer_value_name16" type="text" class="form-control " name="offer_value_name16" value="'+data[i].ref_info_head16+'" ></div>';
                        }
                        else{
                          op16+='<div><input id="offer_value_name16" type="text" class="form-control " name="offer_value_name16" value="" ></div>';
                        }
                        if(data[i].ref_info_head17 != null)
                        {
                        op17+='<div><input id="offer_value_name17" type="text" class="form-control " name="offer_value_name17" value="'+data[i].ref_info_head17+'" ></div>';
                        }
                        else{
                          op17+='<div><input id="offer_value_name17" type="text" class="form-control " name="offer_value_name17" value="" ></div>';
                        }
                        if(data[i].ref_info_head18 != null)
                        {
                          op18+='<div><input id="offer_value_name18" type="text" class="form-control " name="offer_value_name18" value="'+data[i].ref_info_head18+'" ></div>';
                        }
                        else
                        {
                        op18+='<div><input id="offer_value_name18" type="text" class="form-control " name="offer_value_name18" value="" ></div>';
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


                      console.log(op);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>


@endsection
