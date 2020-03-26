@extends('system-mgmt.offer.base')

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
  width: 33.33%;
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
                <div class="panel-heading">Add new Offer </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('offer.store') }}">
                        {{ csrf_field() }}
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">


                          <div class="column">

                            <label for="case_channel " class="">Campaign</label>


                            <select  class="form-control conditioncampaign" name="campaign_id">
                              <option value="0" >-select-</option>
                              @foreach ($campaign as $sta)
                                  <option value="{{$sta->id}}">{{$sta->name}}</option>
                              @endforeach
                            </select>

                          </div>
                          <div class="column">

                          <label for="case_channel " class="">Promotion</label>
                          <select  class="form-control condition" name="promotion_id">
                          <option value="" >-select-</option>
                          @foreach ($promotion as $sta)
                              <option value="{{$sta->id}}">{{$sta->name}}</option>
                          @endforeach
                          </select>

                          </div>


                        </div>
                        <div class="row">
                          <div class="column">
                            <label for="name" class="">Offer Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>


                            <div class="column">
                              <div class="hideoffertype">
                              <label for="case_channel " class="">Offer Type </label>


                              <select  class="form-control condition" name="type_id">
                                <option value="" >-select-</option>
                                @foreach ($offertype as $sta)
                                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                                @endforeach
                              </select>
                            </div>

                        </div>









                  </div>

                  <div class="row">
                    <div class="column">

                      <label for="case_channel" class="">Proposal </label>


                      <select  class="form-control name" name="proposal_id">
                        <option value="" >-select-</option>
                        @foreach ($proposal as $sta)
                            <option value="{{$sta->id}}">{{$sta->name}}</option>
                        @endforeach
                      </select>

                </div>
                    <div class="column">

                      <label for="ref_pid" class="">Referal PublicID </label>


                      <select  class="form-control name" name="ref_pid">
                        <option value="" >-select-</option>
                        @foreach ($publicid as $sta)
                            <option value="{{$sta->id}}">{{$sta->public_name}} </option>
                        @endforeach
                      </select>

                </div>
              </div>
              <div class="row">


                      <div class="column">

                        <label for="ref_member_id " class="">Referal Member </label>


                        <select  class="form-control name" name="ref_member_id">
                          <option value="" >-select-</option>
                          @foreach ($member as $sta)
                              <option value="{{$sta->id}}">{{$sta->name}} {{$sta->lname}} </option>
                          @endforeach
                        </select>

                  </div>

                      <div class="column">

                        <label for="ref_branch_id" class="">Referal Branch </label>


                        <select  class="form-control name" name="ref_branch_id">
                          <option value="" >-select-</option>
                          @foreach ($branch as $sta)
                              <option value="{{$sta->id}}">{{$sta->name}}</option>
                          @endforeach
                        </select>

                  </div>







            </div>


                  <h3 style="color:#00325d;">Offer Value</h3>
                  <div class="row">
                    <div class="column">
                      <div class="la">

                      <label for="name" class="lasd">Offer Value1</label>


                        <input id="offer_value1" type="text" class="form-control" name="offer_value1"  value="{{ old('offer_value1') }}" >

                        </div>
                          @if ($errors->has('offer_value1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('offer_value1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">
                  <div class="la2">

                  <label for="offer_value2" class="lasd2">Offer Value2</label>


                      <input id="offer_value2" type="text" class="form-control" name="offer_value2"  value="{{ old('offer_value2') }}" >
                    </div>

                      @if ($errors->has('offer_value2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('offer_value2') }}</strong>
                          </span>
                      @endif
            </div>



            <div class="column">
              <div class="la3">

              <label for="offer_value3" class="lasd3">Offer Value3</label>

                  <input id="offer_value3" type="text" class="form-control" name="offer_value3"  value="{{ old('offer_value3') }}" >
                </div>

                  @if ($errors->has('offer_value3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('offer_value3') }}</strong>
                      </span>
                  @endif
        </div>
        <div class="column">
          <div class="la4">

          <label for="offer_value4" class="lasd4">Offer Value4</label>


              <input id="offer_value4" type="text" class="form-control" name="offer_value4"  value="{{ old('offer_value4') }}" >
            </div>

              @if ($errors->has('offer_value4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value4') }}</strong>
                  </span>
              @endif
    </div>
    <div class="column">
      <div class="la5">

      <label for="offer_value5" class="lasd5">Offer Value5</label>


          <input id="offer_value5" type="text" class="form-control" name="offer_value5"  value="{{ old('offer_value5') }}" >
        </div>

          @if ($errors->has('offer_value5'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value5') }}</strong>
              </span>
          @endif
</div>


              <div class="column">
                <div class="la6">

                <label for="offer_value6" class="lasd6">Offer Value6</label>


                    <input id="offer_value6" type="text" class="form-control" name="offer_value6"  value="{{ old('offer_value6') }}" >
                  </div>

                    @if ($errors->has('offer_value6'))
                        <span class="help-block">
                            <strong>{{ $errors->first('offer_value6') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="column">
                <div class="la7">

                <label for="offer_value7" class="lasd7">Offer Value7</label>


                    <input id="offer_value7" type="text" class="form-control" name="offer_value7"  value="{{ old('offer_value7') }}" >
                  </div>

                    @if ($errors->has('offer_value7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('offer_value7') }}</strong>
                        </span>
                    @endif
          </div>
          <div class="column">
            <div class="la8">

            <label for="offer_value8" class="lasd8">Offer Value8</label>


                <input id="offer_value8" type="text" class="form-control " name="offer_value8"  value="{{ old('offer_value8') }}" >
              </div>

                @if ($errors->has('offer_value8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('offer_value8') }}</strong>
                    </span>
                @endif
      </div>



      <div class="column">
        <div class="la9">

        <label for="offer_value9" class="lasd9">Offer Value9</label>


            <input id="offer_value9" type="text" class="form-control la9" name="offer_value9"  value="{{ old('offer_value9') }}" >
          </div>

            @if ($errors->has('offer_value9'))
                <span class="help-block">
                    <strong>{{ $errors->first('offer_value9') }}</strong>
                </span>
            @endif
  </div>
  <div class="column">
    <div class="la10">

    <label for="offer_value10" class="lasd10">Offer Value10</label>


        <input id="offer_value10" type="text" class="form-control la10" name="offer_value10"  value="{{ old('offer_value10') }}" >
      </div>

        @if ($errors->has('offer_value10'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value10') }}</strong>
            </span>
        @endif
</div>


        <div class="column">
          <div class="la11">

          <label for="offer_value11" class="lasd11">Offer Value11</label>


              <input id="offer_value11" type="text" class="form-control la11" name="offer_value11"  value="{{ old('offer_value11') }}" >
            </div>

              @if ($errors->has('offer_value11'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value11') }}</strong>
                  </span>
              @endif
        </div>
        <div class="column">
          <div class="la12">

          <label for="offer_value12" class="lasd7">Offer Value12</label>


              <input id="offer_value12" type="text" class="form-control la12" name="offer_value12"  value="{{ old('offer_value12') }}" >
            </div>

              @if ($errors->has('offer_value12'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value12') }}</strong>
                  </span>
              @endif
    </div>
    <div class="column">
      <div class="la13">

      <label for="offer_value13" class="lasd8">Offer Value13</label>


          <input id="offer_value13" type="text" class="form-control la13" name="offer_value13"  value="{{ old('offer_value13') }}" >
        </div>

          @if ($errors->has('offer_value13'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value13') }}</strong>
              </span>
          @endif
</div>



<div class="column">
  <div class="la14">

  <label for="offer_value14" class="lasd9">Offer Value14</label>


      <input id="offer_value14" type="text" class="form-control la14" name="offer_value14"  value="{{ old('offer_value14') }}" >
    </div>

      @if ($errors->has('offer_value14'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_value14') }}</strong>
          </span>
      @endif
</div>
<div class="column">
  <div class="la15">

<label for="offer_value15" class="lasd10">Offer Value15</label>


  <input id="offer_value15" type="text" class="form-control la15" name="offer_value15"  value="{{ old('offer_value15') }}" >
</div>

  @if ($errors->has('offer_value15'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_value15') }}</strong>
      </span>
  @endif
</div>


  <div class="column">
    <div class="la16">

    <label for="offer_value16" class="lasd6">Offer Value16</label>


        <input id="offer_value16" type="text" class="form-control la16" name="offer_value16"  value="{{ old('offer_value16') }}" >
      </div>

        @if ($errors->has('offer_value16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value16') }}</strong>
            </span>
        @endif
  </div>
  <div class="column">
    <div class="la17">

    <label for="offer_value17" class="lasd7">Offer Value17</label>


        <input id="offer_value17" type="text" class="form-control " name="offer_value17"  value="{{ old('offer_value17') }}" >
      </div>

        @if ($errors->has('offer_value17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value17') }}</strong>
            </span>
        @endif
</div>
<div class="column">
  <div class="la18">

<label for="offer_value18" class="lasd8">Offer Value18</label>


    <input id="offer_value18" type="text" class="form-control " name="offer_value18"  value="{{ old('offer_value18') }}" >
  </div>

    @if ($errors->has('offer_value18'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value18') }}</strong>
        </span>
    @endif
</div>



<div class="column">
  <div class="la19">

<label for="offer_value19" class="lasd9">Offer Value19</label>


<input id="offer_value19" type="text" class="form-control " name="offer_value19"  value="{{ old('offer_value19') }}" >
</div>
@if ($errors->has('offer_value19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value19') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la20">

<label for="offer_value20" class="lasd10">Offer Value20</label>


<input id="offer_value20" type="text" class="form-control " name="offer_value20"  value="{{ old('offer_value20') }}" >
</div>
@if ($errors->has('offer_value20'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value20') }}</strong>
</span>
@endif

</div>

</div>
<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Offer Value 21-40</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="box-body">

<div class="row">
  <div class="column">
    <div class="la20">

    <label for="offer_value21" class="lasd6">Offer Value21</label>


        <input id="offer_value21" type="text" class="form-control" name="offer_value21"  value="{{ old('offer_value21') }}" >
</div>
        @if ($errors->has('offer_value21'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value21') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="la22">
    <label for="offer_value22" class="lasd7">Offer Value22</label>


        <input id="offer_value22" type="text" class="form-control" name="offer_value22"  value="{{ old('offer_value22') }}" >
      </div>
        @if ($errors->has('offer_value22'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value22') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="la23">

<label for="offer_value23" class="lasd8">Offer Value23</label>


    <input id="offer_value23" type="text" class="form-control" name="offer_value23"  value="{{ old('offer_value23') }}" >
</div>
    @if ($errors->has('offer_value23'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value23') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="la24">

<label for="offer_value24" class="lasd9">Offer Value24</label>


<input id="offer_value24" type="text" class="form-control " name="offer_value24"  value="{{ old('offer_value24') }}" >
</div>
@if ($errors->has('offer_value24'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value24') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la25">

<label for="offer_value25" class="lasd10">Offer Value25</label>


<input id="offer_value25" type="text" class="form-control " name="offer_value25"  value="{{ old('offer_value25') }}" >
</div>
@if ($errors->has('offer_value25'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value25') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="la26">

    <label for="offer_value26" class="lasd6">Offer Value26</label>


        <input id="offer_value26" type="text" class="form-control " name="offer_value26"  value="{{ old('offer_value26') }}" >
</div>
        @if ($errors->has('offer_value26'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value26') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="la27">

    <label for="offer_value27" class="lasd7">Offer Value27</label>


        <input id="offer_value27" type="text" class="form-control " name="offer_value27"  value="{{ old('offer_value27') }}" >
</div>
        @if ($errors->has('offer_value27'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value27') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="la28">

<label for="offer_value28" class="lasd8">Offer Value28</label>


    <input id="offer_value28" type="text" class="form-control " name="offer_value28"  value="{{ old('offer_value28') }}" >
</div>
    @if ($errors->has('offer_value28'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value28') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="la29">

<label for="offer_value29" class="lasd9">Offer Value29</label>


<input id="offer_value29" type="text" class="form-control " name="offer_value29"  value="{{ old('offer_value29') }}" >
</div>
@if ($errors->has('offer_value29'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value29') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la30">

<label for="offer_value30" class="lasd10">Offer Value30</label>


<input id="offer_value30" type="text" class="form-control " name="offer_value30"  value="{{ old('offer_value30') }}" >
</div>
@if ($errors->has('offer_value30'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value30') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="la31">

    <label for="offer_value31" class="lasd6">Offer Value31</label>


        <input id="offer_value31" type="text" class="form-control" name="offer_value31"  value="{{ old('offer_value31') }}" >
</div>
        @if ($errors->has('offer_value31'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value31') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="la32">

    <label for="offer_value32" class="lasd7">Offer Value32</label>


        <input id="offer_value32" type="text" class="form-control " name="offer_value32"  value="{{ old('offer_value32') }}" >
</div>
        @if ($errors->has('offer_value32'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value32') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="la33">

<label for="offer_value33" class="lasd8">Offer Value33</label>


    <input id="offer_value33" type="text" class="form-control" name="offer_value33"  value="{{ old('offer_value33') }}" >
</div>
    @if ($errors->has('offer_value33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value33') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="la34">

<label for="offer_value34" class="lasd9">Offer Value34</label>


<input id="offer_value34" type="text" class="form-control" name="offer_value34"  value="{{ old('offer_value34') }}" >
</div>
@if ($errors->has('offer_value34'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value34') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la35">

<label for="offer_value35" class="lasd10">Offer Value35</label>


<input id="offer_value35" type="text" class="form-control " name="offer_value35"  value="{{ old('offer_value35') }}" >
</div>
@if ($errors->has('offer_value35'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value35') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="la36">

    <label for="offer_value36" class="lasd6">Offer Value36</label>


        <input id="offer_value36" type="text" class="form-control" name="offer_value36"  value="{{ old('offer_value36') }}" >
</div>
        @if ($errors->has('offer_value36'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value36') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="la37">

    <label for="offer_value37" class="lasd7">Offer Value37</label>


        <input id="offer_value37" type="text" class="form-control " name="offer_value37"  value="{{ old('offer_value37') }}" >
</div>
        @if ($errors->has('offer_value37'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value37') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="la38">

<label for="offer_value38" class="lasd8">Offer Value38</label>


    <input id="offer_value38" type="text" class="form-control" name="offer_value38"  value="{{ old('offer_value38') }}" >
</div>
    @if ($errors->has('offer_value38'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value38') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="la39">

<label for="offer_value39" class="lasd9">Offer Value39</label>


<input id="offer_value39" type="text" class="form-control " name="offer_value39"  value="{{ old('offer_value39') }}" >
</div>
@if ($errors->has('offer_value39'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value39') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la20">

<label for="offer_value40" class="lasd10">Offer Value40</label>


<input id="offer_value40" type="text" class="form-control la40" name="offer_value40"  value="{{ old('offer_value40') }}" >
</div>
@if ($errors->has('offer_value40'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value40') }}</strong>
</span>
@endif

</div>

</div>
</div>
</div>

<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Offer Payment </h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="box-body">

<div class="row">
  <div class="column">
    <div class="lapay1">

    <label for="offer_payment_value1" class="lapaysd6">Offer Payment Value1</label>


        <input id="offer_payment_value1" type="text" class="form-control" name="offer_payment_value1"  value="{{ old('offer_payment_value1') }}" >
</div>
        @if ($errors->has('offer_payment_value1'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value1') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay2">
    <label for="offer_payment_value2" class="lapaysd7">Offer Payment Value2</label>


        <input id="offer_payment_value2" type="text" class="form-control" name="offer_payment_value2"  value="{{ old('offer_payment_value2') }}" >
      </div>
        @if ($errors->has('offer_payment_value2'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value2') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay3">

<label for="offer_payment_value3" class="lapaysd8">Offer Payment Value3</label>


    <input id="offer_payment_value3" type="text" class="form-control" name="offer_payment_value3"  value="{{ old('offer_payment_value3') }}" >
</div>
    @if ($errors->has('offer_payment_value3'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value3') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay4">

<label for="offer_payment_value4" class="lapaysd9">Offer Payment Value4</label>


<input id="offer_payment_value4" type="text" class="form-control " name="offer_payment_value4"  value="{{ old('offer_payment_value4') }}" >
</div>
@if ($errors->has('offer_payment_value4'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value4') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay5">

<label for="offer_payment_value5" class="lapaysd10">Offer Payment Value5</label>


<input id="offer_payment_value5" type="text" class="form-control " name="offer_payment_value5"  value="{{ old('offer_payment_value5') }}" >
</div>
@if ($errors->has('offer_payment_value5'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value5') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="lapay6">

    <label for="offer_payment_value6" class="lapaysd6">Offer Payment Value6</label>


        <input id="offer_payment_value6" type="text" class="form-control " name="offer_payment_value6"  value="{{ old('offer_payment_value6') }}" >
</div>
        @if ($errors->has('offer_payment_value6'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value6') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay7">

    <label for="offer_payment_value7" class="lapaysd7">Offer Payment Value7</label>


        <input id="offer_payment_value7" type="text" class="form-control " name="offer_payment_value7"  value="{{ old('offer_payment_value7') }}" >
</div>
        @if ($errors->has('offer_payment_value7'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value7') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay8">

<label for="offer_payment_value8" class="lapaysd8">Offer Payment Value8</label>


    <input id="offer_payment_value8" type="text" class="form-control " name="offer_payment_value8"  value="{{ old('offer_payment_value8') }}" >
</div>
    @if ($errors->has('offer_payment_value8'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value8') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay9">

<label for="offer_payment_value9" class="lapaysd9">Offer Payment Value9</label>


<input id="offer_payment_value9" type="text" class="form-control " name="offer_payment_value9"  value="{{ old('offer_payment_value9') }}" >
</div>
@if ($errors->has('offer_payment_value9'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value9') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay10">

<label for="offer_payment_value10" class="lapaysd10">Offer Payment Value10</label>


<input id="offer_payment_value10" type="text" class="form-control " name="offer_payment_value10"  value="{{ old('offer_payment_value10') }}" >
</div>
@if ($errors->has('offer_payment_value10'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value10') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="lapay11">

    <label for="offer_payment_value11" class="lapaysd6">Offer Payment Value11</label>


        <input id="offer_payment_value11" type="text" class="form-control" name="offer_payment_value11"  value="{{ old('offer_payment_value11') }}" >
</div>
        @if ($errors->has('offer_payment_value11'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value11') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay12">

    <label for="offer_payment_value12" class="lapaysd7">Offer Payment Value12</label>


        <input id="offer_payment_value12" type="text" class="form-control " name="offer_payment_value12"  value="{{ old('offer_payment_value12') }}" >
</div>
        @if ($errors->has('offer_payment_value12'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value12') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay13">

<label for="offer_payment_value13" class="lapaysd8">Offer Payment Value13</label>


    <input id="offer_payment_value13" type="text" class="form-control" name="offer_payment_value13"  value="{{ old('offer_payment_value13') }}" >
</div>
    @if ($errors->has('offer_payment_value33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value13') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay14">

<label for="offer_payment_value34" class="lapaysd9">Offer Payment Value14</label>


<input id="offer_payment_value14" type="text" class="form-control" name="offer_payment_value14"  value="{{ old('offer_payment_value14') }}" >
</div>
@if ($errors->has('offer_payment_value14'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value14') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay15">

<label for="offer_payment_value15" class="lapaysd10">Offer Payment Value15</label>


<input id="offer_payment_value15" type="text" class="form-control " name="offer_payment_value15"  value="{{ old('offer_payment_value15') }}" >
</div>
@if ($errors->has('offer_payment_value15'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value15') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="lapay16">

    <label for="offer_payment_value16" class="lapaysd6">Offer Payment Value16</label>


        <input id="offer_payment_value16" type="text" class="form-control" name="offer_payment_value16"  value="{{ old('offer_payment_value16') }}" >
</div>
        @if ($errors->has('offer_payment_value16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value16') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay17">

    <label for="offer_payment_value17" class="lapaysd7">Offer Payment Value17</label>


        <input id="offer_payment_value37" type="text" class="form-control " name="offer_payment_value17"  value="{{ old('offer_payment_value17') }}" >
</div>
        @if ($errors->has('offer_payment_value17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value17') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay18">

<label for="offer_payment_value18" class="lapaysd8">Offer Payment Value18</label>


    <input id="offer_payment_value18" type="text" class="form-control" name="offer_payment_value18"  value="{{ old('offer_payment_value18') }}" >
</div>
    @if ($errors->has('offer_payment_value18'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value18') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay19">

<label for="offer_payment_value19" class="lapaysd9">Offer Payment Value19</label>


<input id="offer_payment_value19" type="text" class="form-control " name="offer_payment_value19"  value="{{ old('offer_payment_value19') }}" >
</div>
@if ($errors->has('offer_payment_value19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value19') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay20">

<label for="offer_payment_value20" class="lapaysd20">Offer Payment Value20</label>


<input id="offer_payment_value20" type="text" class="form-control la20" name="offer_payment_value20"  value="{{ old('offer_payment_value20') }}" >
</div>
@if ($errors->has('offer_payment_value20'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value20') }}</strong>
</span>
@endif

</div>
<div class="column">
  <div class="lapay21">

  <label for="offer_payment_value21" class="lapaysd6">Offer Payment Value21</label>


      <input id="offer_payment_value21" type="text" class="form-control" name="offer_payment_value21"  value="{{ old('offer_payment_value21') }}" >
</div>
      @if ($errors->has('offer_payment_value21'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value21') }}</strong>
          </span>
      @endif

</div>
<div class="column">
  <div class="lapay22">
  <label for="offer_payment_value22" class="lapaysd7">Offer Payment Value22</label>


      <input id="offer_payment_value22" type="text" class="form-control" name="offer_payment_value22"  value="{{ old('offer_payment_value22') }}" >
    </div>
      @if ($errors->has('offer_payment_value22'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value22') }}</strong>
          </span>
      @endif

</div>
<div class="column">
<div class="lapay23">

<label for="offer_payment_value23" class="lapaysd8">Offer Payment Value23</label>


  <input id="offer_payment_value23" type="text" class="form-control" name="offer_payment_value23"  value="{{ old('offer_payment_value23') }}" >
</div>
  @if ($errors->has('offer_payment_value23'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value23') }}</strong>
      </span>
  @endif

</div>



<div class="column">
<div class="lapay24">

<label for="offer_payment_value24" class="lapaysd9">Offer Payment Value24</label>


<input id="offer_payment_value24" type="text" class="form-control " name="offer_payment_value24"  value="{{ old('offer_payment_value24') }}" >
</div>
@if ($errors->has('offer_payment_value24'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value24') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay25">

<label for="offer_payment_value25" class="lapaysd10">Offer Payment Value25</label>


<input id="offer_payment_value25" type="text" class="form-control " name="offer_payment_value25"  value="{{ old('offer_payment_value25') }}" >
</div>
@if ($errors->has('offer_payment_value25'))
<span class="help-block">
  <strong>{{ $errors->first('offer_payment_value25') }}</strong>
</span>
@endif

</div>


<div class="column">
  <div class="lapay26">

  <label for="offer_payment_value26" class="lapaysd6">Offer Payment Value26</label>


      <input id="offer_payment_value26" type="text" class="form-control " name="offer_payment_value26"  value="{{ old('offer_payment_value26') }}" >
</div>
      @if ($errors->has('offer_payment_value26'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value26') }}</strong>
          </span>
      @endif

</div>
<div class="column">
  <div class="lapay27">

  <label for="offer_payment_value27" class="lapaysd7">Offer Payment Value27</label>


      <input id="offer_payment_value27" type="text" class="form-control " name="offer_payment_value27"  value="{{ old('offer_payment_value27') }}" >
</div>
      @if ($errors->has('offer_payment_value27'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value27') }}</strong>
          </span>
      @endif

</div>
<div class="column">
<div class="lapay28">

<label for="offer_payment_value28" class="lapaysd8">Offer Payment Value28</label>


  <input id="offer_payment_value28" type="text" class="form-control " name="offer_payment_value28"  value="{{ old('offer_payment_value28') }}" >
</div>
  @if ($errors->has('offer_payment_value28'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value28') }}</strong>
      </span>
  @endif

</div>



<div class="column">
<div class="lapay29">

<label for="offer_payment_value29" class="lapaysd9">Offer Payment Value29</label>


<input id="offer_payment_value29" type="text" class="form-control " name="offer_payment_value29"  value="{{ old('offer_payment_value29') }}" >
</div>
@if ($errors->has('offer_payment_value29'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value29') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay30">

<label for="offer_payment_value30" class="lapaysd10">Offer Payment Value30</label>


<input id="offer_payment_value30" type="text" class="form-control " name="offer_payment_value30"  value="{{ old('offer_payment_value30') }}" >
</div>
@if ($errors->has('offer_payment_value30'))
<span class="help-block">
  <strong>{{ $errors->first('offer_payment_value30') }}</strong>
</span>
@endif

</div>


<div class="column">
  <div class="lapay31">

  <label for="offer_payment_value31" class="lapaysd6">Offer Payment Value31</label>


      <input id="offer_payment_value31" type="text" class="form-control" name="offer_payment_value31"  value="{{ old('offer_payment_value31') }}" >
</div>
      @if ($errors->has('offer_payment_value31'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value31') }}</strong>
          </span>
      @endif

</div>
<div class="column">
  <div class="lapay32">

  <label for="offer_payment_value32" class="lapaysd7">Offer Payment Value32</label>


      <input id="offer_payment_value32" type="text" class="form-control " name="offer_payment_value32"  value="{{ old('offer_payment_value32') }}" >
</div>
      @if ($errors->has('offer_payment_value32'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value32') }}</strong>
          </span>
      @endif

</div>
<div class="column">
<div class="lapay33">

<label for="offer_payment_value33" class="lapaysd8">Offer Payment Value33</label>


  <input id="offer_payment_value33" type="text" class="form-control" name="offer_payment_value33"  value="{{ old('offer_payment_value33') }}" >
</div>
  @if ($errors->has('offer_payment_value33'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value33') }}</strong>
      </span>
  @endif

</div>



<div class="column">
<div class="lapay34">

<label for="offer_payment_value34" class="lapaysd9">Offer Payment Value34</label>


<input id="offer_payment_value34" type="text" class="form-control" name="offer_payment_value34"  value="{{ old('offer_payment_value34') }}" >
</div>
@if ($errors->has('offer_payment_value34'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value34') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay35">

<label for="offer_payment_value35" class="lapaysd10">Offer Payment Value35</label>


<input id="offer_payment_value35" type="text" class="form-control " name="offer_payment_value35"  value="{{ old('offer_payment_value35') }}" >
</div>
@if ($errors->has('offer_payment_value35'))
<span class="help-block">
  <strong>{{ $errors->first('offer_payment_value35') }}</strong>
</span>
@endif

</div>


<div class="column">
  <div class="lapay36">

  <label for="offer_payment_value36" class="lapaysd6">Offer Payment Value36</label>


      <input id="offer_payment_value36" type="text" class="form-control" name="offer_payment_value36"  value="{{ old('offer_payment_value36') }}" >
</div>
      @if ($errors->has('offer_payment_value36'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value36') }}</strong>
          </span>
      @endif

</div>
<div class="column">
  <div class="lapay37">

  <label for="offer_payment_value37" class="lapaysd7">Offer Payment Value37</label>


      <input id="offer_payment_value37" type="text" class="form-control " name="offer_payment_value37"  value="{{ old('offer_payment_value37') }}" >
</div>
      @if ($errors->has('offer_payment_value37'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value37') }}</strong>
          </span>
      @endif

</div>
<div class="column">
<div class="lapay38">

<label for="offer_payment_value38" class="lapaysd8">Offer Payment Value38</label>


  <input id="offer_payment_value38" type="text" class="form-control" name="offer_payment_value38"  value="{{ old('offer_payment_value38') }}" >
</div>
  @if ($errors->has('offer_payment_value38'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value38') }}</strong>
      </span>
  @endif

</div>



<div class="column">
<div class="lapay39">

<label for="offer_payment_value39" class="lapaysd9">Offer Payment Value39</label>


<input id="offer_payment_value39" type="text" class="form-control " name="offer_payment_value39"  value="{{ old('offer_payment_value39') }}" >
</div>
@if ($errors->has('offer_payment_value39'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value39') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay40">

<label for="offer_payment_value40" class="lapaysd10">Offer Payment Value40</label>


<input id="offer_payment_value40" type="text" class="form-control la40" name="offer_payment_value40"  value="{{ old('offer_payment_value40') }}" >
</div>
@if ($errors->has('offer_payment_value40'))
<span class="help-block">
  <strong>{{ $errors->first('offer_payment_value40') }}</strong>
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
                var oppay=" ";
                var oppay2=" ";
                var oppay3=" ";
                var oppay4=" ";
                var oppay5=" ";
                var oppay6=" ";
                var oppay7=" ";
                var oppay8=" ";
                var oppay9=" ";
                var oppay10=" ";
                var oppay11=" ";
                var oppay12=" ";
                var oppay13=" ";
                var oppay14=" ";
                var oppay15=" ";
                var oppay16=" ";
                var oppay17=" ";
                var oppay18=" ";
                var oppay19=" ";
                var oppay20=" ";
                var oppay21=" ";
                var oppay22=" ";
                var oppay23=" ";
                var oppay24=" ";
                var oppay25=" ";
                var oppay26=" ";
                var oppay27=" ";
                var oppay28=" ";
                var oppay29=" ";
                var oppay30=" ";
                var oppay31=" ";
                var oppay32=" ";
                var oppay33=" ";
                var oppay34=" ";
                var oppay35=" ";
                var oppay36=" ";
                var oppay37=" ";
                var oppay38=" ";
                var oppay39=" ";
                var oppay40=" ";


                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findOfferType')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      console.log('success');



                     console.log(data.length);

                      for(var i=0; i<data.length;i++){
                      //  op+='<label value="'+data[i].con_para_name1+'">'+data[i].con_para_name1+'</label>';
                      console.log(data[i].offer_payment_name1);
                        //op+='<input id="offer_value1" type="text" class="form-control " name="offer_value1" value="'+data[i].offer_value_name1+'" >';
                        if(data[i].offer_value_name1 != null)
                        {
                        op+='<div><label for="offer_value1" class="lasd">'+data[i].offer_value_name1+'</label><input id="offer_value1" type="text" class="form-control " name="offer_value1" value="{{ old('offer_value1') }}" ></div>';
                        }
                        else{
                          op+='';
                        }
                        if(data[i].offer_value_name2 != null)
                        {
                          op2+='<div><label for="offer_value2" class="lasd">'+data[i].offer_value_name2+'</label><input id="offer_value2" type="text" class="form-control " name="offer_value2" value="{{ old('offer_value2') }}" ></div>';
                        }

                        else{
                          op2+='';

                        }
                        if(data[i].offer_value_name3 != null)
                        {
                          op3+='<div><label for="offer_value3" class="lasd">'+data[i].offer_value_name3+'</label><input id="offer_value3" type="text" class="form-control " name="offer_value3" value="{{ old('offer_value3') }}" ></div>';
                        }
                        else{
                          op3+='';
                        }
                        if(data[i].offer_value_name4 != null)
                        {
                          op4+='<div><label for="offer_value4" class="lasd">'+data[i].offer_value_name4+'</label><input id="offer_value4" type="text" class="form-control " name="offer_value4" value="{{ old('offer_value4') }}" ></div>';
                        }
                        else{
                          op4+='';

                        }
                        if(data[i].offer_value_name5 != null)
                        {
                          op5+='<div><label for="offer_value5" class="lasd">'+data[i].offer_value_name5+'</label><input id="offer_value5" type="text" class="form-control " name="offer_value5" value="{{ old('offer_value5') }}" ></div>';
                        }
                        else{
                          op5+='';

                        }
                        if(data[i].offer_value_name6 != null)
                        {
                          op6+='<div><label for="offer_value6" class="lasd">'+data[i].offer_value_name6+'</label><input id="offer_value6" type="text" class="form-control " name="offer_value6" value="{{ old('offer_value6') }}" ></div>';
                        }
                        else{
                          op6+='';
                        }
                        if(data[i].offer_value_name7 != null)
                        {
                          op7+='<div><label for="offer_value7" class="lasd">'+data[i].offer_value_name7+'</label><input id="offer_value7" type="text" class="form-control " name="offer_value7" value="{{ old('offer_value7') }}" ></div>';
                        }
                        else{
                          op7+='';

                        }
                        if(data[i].offer_value_name8 != null)
                        {
                          op8+='<div><label for="offer_value8" class="lasd">'+data[i].offer_value_name8+'</label><input id="offer_value8" type="text" class="form-control " name="offer_value8" value="{{ old('offer_value8') }}" ></div>';
                        }
                        else {
                          op8+='';
                        }
                        if(data[i].offer_value_name9 != null)
                        {
                          op9+='<div><label for="offer_value9" class="lasd">'+data[i].offer_value_name9+'</label><input id="offer_value9" type="text" class="form-control " name="offer_value9" value="{{ old('offer_value9') }}" ></div>';
                        }
                        else{
                          op9+='';
                        }
                        if(data[i].offer_value_name10 != null)
                        {
                          op10+='<div><label for="offer_value10" class="lasd">'+data[i].offer_value_name10+'</label><input id="offer_value10" type="text" class="form-control " name="offer_value10" value="{{ old('offer_value10') }}" ></div>';
                        }
                        else {
                          op10+='';
                        }
                        if(data[i].offer_value_name11 != null)
                        {
                          op11+='<div><label for="offer_value11" class="lasd">'+data[i].offer_value_name11+'</label><input id="offer_value11" type="text" class="form-control " name="offer_value11" value="{{ old('offer_value11') }}" ></div>';
                        }
                        else{
                          op11+='';

                        }
                        if(data[i].offer_value_name12 != null)
                        {
                          op12+='<div><label for="offer_value12" class="lasd">'+data[i].offer_value_name12+'</label><input id="offer_value12" type="text" class="form-control " name="offer_value12" value="{{ old('offer_value12') }}" ></div>';
                        }
                        else {
                          op12+='';
                        }
                        if(data[i].offer_value_name13 != null)
                        {
                          op13+='<div><label for="offer_value13" class="lasd">'+data[i].offer_value_name13+'</label><input id="offer_value13" type="text" class="form-control " name="offer_value13" value="{{ old('offer_value13') }}" ></div>';
                        }
                        else{
                          op13+='';
                        }
                        if(data[i].offer_value_name14 != null)
                        {
                          op14+='<div><label for="offer_value14" class="lasd">'+data[i].offer_value_name14+'</label><input id="offer_value14" type="text" class="form-control " name="offer_value14" value="{{ old('offer_value14') }}" ></div>';
                        }
                        else{
                          op14+='';
                        }
                        if(data[i].offer_value_name15 != null)
                        {
                          op15+='<div><label for="offer_value15" class="lasd">'+data[i].offer_value_name15+'</label><input id="offer_value15" type="text" class="form-control " name="offer_value15" value="{{ old('offer_value15') }}" ></div>';
                        }
                        else {
                          op15+='';
                        }
                        if(data[i].offer_value_name16 != null)
                        {
                          op16+='<div><label for="offer_value16" class="lasd">'+data[i].offer_value_name16+'</label><input id="offer_value16" type="text" class="form-control " name="offer_value16" value="{{ old('offer_value16') }}" ></div>';
                        }
                        else{
                          op16+='';
                        }
                        if(data[i].offer_value_name17 != null)
                        {
                          op17+='<div><label for="offer_value17" class="lasd">'+data[i].offer_value_name17+'</label><input id="offer_value17" type="text" class="form-control " name="offer_value17" value="{{ old('offer_value17') }}" ></div>';
                        }
                        else{
                          op17+='';
                        }
                        if(data[i].offer_value_name18 != null)
                        {
                          op18+='<div><label for="offer_value18" class="lasd">'+data[i].offer_value_name18+'</label><input id="offer_value18" type="text" class="form-control " name="offer_value18" value="{{ old('offer_value18') }}" ></div>';
                        }
                        else
                        {
                        op18+='';
                      }
                      if(data[i].offer_value_name19 != null)
                      {
                        op19+='<div><label for="offer_value19" class="lasd">'+data[i].offer_value_name19+'</label><input id="offer_value19" type="text" class="form-control " name="offer_value19" value="{{ old('offer_value19') }}" ></div>';
                      }
                      else{
                        op19+='';
                      }
                      if(data[i].offer_value_name20 != null)
                      {
                        op20+='<div><label for="offer_value20" class="lasd">'+data[i].offer_value_name20+'</label><input id="offer_value20" type="text" class="form-control " name="offer_value20" value="{{ old('offer_value20') }}" ></div>';
                      }
                      else{
                        op20+='';
                      }
                      if(data[i].offer_value_name21 != null)
                      {
                        op21+='<div><label for="offer_value21" class="lasd">'+data[i].offer_value_name21+'</label><input id="offer_value21" type="text" class="form-control " name="offer_value21" value="{{ old('offer_value21') }}" ></div>';
                      }
                      else{
                        op21+='';
                      }

                      if(data[i].offer_value_name22 != null)
                      {
                        op22+='<div><label for="offer_value22" class="lasd">'+data[i].offer_value_name22+'</label><input id="offer_value22" type="text" class="form-control " name="offer_value22" value="{{ old('offer_value22') }}" ></div>';
                      }
                      else{
                        op22+='';
                      }

                      if(data[i].offer_value_name23 != null)
                      {
                        op23+='<div><label for="offer_value23" class="lasd">'+data[i].offer_value_name23+'</label><input id="offer_value23" type="text" class="form-control " name="offer_value23" value="{{ old('offer_value23') }}" ></div>';
                      }
                      else{
                        op23+='';
                      }
                      if(data[i].offer_value_name24 != null)
                      {
                        op24+='<div><label for="offer_value24" class="lasd">'+data[i].offer_value_name24+'</label><input id="offer_value24" type="text" class="form-control " name="offer_value24" value="{{ old('offer_value24') }}" ></div>';
                      }
                      else{
                        op24+='';
                      }

                      if(data[i].offer_value_name25 != null)
                      {
                        op25+='<div><label for="offer_value25" class="lasd">'+data[i].offer_value_name25+'</label><input id="offer_value25" type="text" class="form-control " name="offer_value25" value="{{ old('offer_value25') }}" ></div>';
                      }
                      else{
                        op25+='';
                      }

                      if(data[i].offer_value_name26 != null)
                      {
                        op26+='<div><label for="offer_value26" class="lasd">'+data[i].offer_value_name26+'</label><input id="offer_value26" type="text" class="form-control " name="offer_value26" value="{{ old('offer_value26') }}" ></div>';
                      }
                      else{
                        op26+='';
                      }

                      if(data[i].offer_value_name27 != null)
                      {
                        op27+='<div><label for="offer_value27" class="lasd">'+data[i].offer_value_name27+'</label><input id="offer_value27" type="text" class="form-control " name="offer_value27" value="{{ old('offer_value27') }}" ></div>';
                      }
                      else{
                        op27+='';
                      }

                      if(data[i].offer_value_name28 != null)
                      {
                        op28+='<div><label for="offer_value28" class="lasd">'+data[i].offer_value_name28+'</label><input id="offer_value28" type="text" class="form-control " name="offer_value28" value="{{ old('offer_value28') }}" ></div>';
                      }
                      else{
                        op28+='';
                      }

                      if(data[i].offer_value_name29 != null)
                      {
                        op29+='<div><label for="offer_value29" class="lasd">'+data[i].offer_value_name29+'</label><input id="offer_value29" type="text" class="form-control " name="offer_value29" value="{{ old('offer_value29') }}" ></div>';
                      }
                      else{
                        op29+='';
                      }
                      if(data[i].offer_value_name30 != null)
                      {
                        op30+='<div><label for="offer_value30" class="lasd">'+data[i].offer_value_name30+'</label><input id="offer_value30" type="text" class="form-control " name="offer_value30" value="{{ old('offer_value30') }}" ></div>';
                      }
                      else{
                        op30+='';
                      }

                      if(data[i].offer_value_name31 != null)
                      {
                        op31+='<div><label for="offer_value31" class="lasd">'+data[i].offer_value_name31+'</label><input id="offer_value31" type="text" class="form-control " name="offer_value31" value="{{ old('offer_value31') }}" ></div>';
                      }
                      else{
                        op31+='';
                      }

                      if(data[i].offer_value_name32 != null)
                      {
                        op32+='<div><label for="offer_value32" class="lasd">'+data[i].offer_value_name32+'</label><input id="offer_value32" type="text" class="form-control " name="offer_value32" value="{{ old('offer_value32') }}" ></div>';
                      }
                      else{
                        op32+='';
                      }

                      if(data[i].offer_value_name33 != null)
                      {
                        op33+='<div><label for="offer_value33" class="lasd">'+data[i].offer_value_name33+'</label><input id="offer_value33" type="text" class="form-control " name="offer_value33" value="{{ old('offer_value33') }}" ></div>';
                      }
                      else{
                        op33+='';
                      }

                      if(data[i].offer_value_name34 != null)
                      {
                        op34+='<div><label for="offer_value34" class="lasd">'+data[i].offer_value_name34+'</label><input id="offer_value34" type="text" class="form-control " name="offer_value34" value="{{ old('offer_value34') }}" ></div>';
                      }
                      else{
                        op34+='';
                      }

                      if(data[i].offer_value_name35 != null)
                      {
                        op35+='<div><label for="offer_value35" class="lasd">'+data[i].offer_value_name35+'</label><input id="offer_value35" type="text" class="form-control " name="offer_value35" value="{{ old('offer_value35') }}" ></div>';
                      }
                      else{
                        op35+='';
                      }

                      if(data[i].offer_value_name36 != null)
                      {
                        op36+='<div><label for="offer_value36" class="lasd">'+data[i].offer_value_name36+'</label><input id="offer_value36" type="text" class="form-control " name="offer_value36" value="{{ old('offer_value36') }}" ></div>';
                      }
                      else{
                        op36+='';
                      }

                      if(data[i].offer_value_name37 != null)
                      {
                        op37+='<div><label for="offer_value37" class="lasd">'+data[i].offer_value_name37+'</label><input id="offer_value37" type="text" class="form-control " name="offer_value37" value="{{ old('offer_value37') }}" ></div>';
                      }
                      else{
                        op37+='';
                      }

                      if(data[i].offer_value_name38 != null)
                      {
                        op38+='<div><label for="offer_value38" class="lasd">'+data[i].offer_value_name38+'</label><input id="offer_value38" type="text" class="form-control " name="offer_value38" value="{{ old('offer_value38') }}" ></div>';
                      }
                      else{
                        op38+='';
                      }

                      if(data[i].offer_value_name39 != null)
                      {
                        op39+='<div><label for="offer_value39" class="lasd">'+data[i].offer_value_name39+'</label><input id="offer_value39" type="text" class="form-control " name="offer_value39" value="{{ old('offer_value39') }}" ></div>';
                      }
                      else{
                        op39+='';
                      }

                      if(data[i].offer_value_name40 != null)
                      {
                        op40+='<div><label for="offer_value40" class="lasd">'+data[i].offer_value_name40+'</label><input id="offer_value40" type="text" class="form-control " name="offer_value40" value="{{ old('offer_value40') }}" ></div>';
                      }
                      else{
                        op40+='';
                      }

                      if(data[i].offer_payment_name1 != null)
                      {
                      oppay+='<div><label for="offer_payment_value1" class="lasd">'+data[i].offer_payment_name1+'</label><input id="offer_payment_value1" type="text" class="form-control " name="offer_payment_value1" value="{{ old('offer_payment_value1') }}" ></div>';
                      }
                      else{
                        oppay+='';
                      }
                      if(data[i].offer_payment_name2 != null)
                      {
                        oppay2+='<div><label for="offer_payment_value2" class="lasd">'+data[i].offer_payment_name2+'</label><input id="offer_payment_value2" type="text" class="form-control " name="offer_payment_value2" value="{{ old('offer_payment_value2') }}" ></div>';
                      }

                      else{
                        oppay2+='';

                      }
                      if(data[i].offer_payment_name3 != null)
                      {
                        oppay3+='<div><label for="offer_payment_value3" class="lasd">'+data[i].offer_payment_name3+'</label><input id="offer_payment_value3" type="text" class="form-control " name="offer_payment_value3" value="{{ old('offer_payment_value3') }}" ></div>';
                      }
                      else{
                        oppay3+='';
                      }
                      if(data[i].offer_payment_name4 != null)
                      {
                        oppay4+='<div><label for="offer_payment_value4" class="lasd">'+data[i].offer_payment_name4+'</label><input id="offer_payment_value4" type="text" class="form-control " name="offer_payment_value4" value="{{ old('offer_payment_value4') }}" ></div>';
                      }
                      else{
                        oppay4+='';

                      }
                      if(data[i].offer_payment_name5 != null)
                      {
                        oppay5+='<div><label for="offer_payment_value5" class="lasd">'+data[i].offer_payment_name5+'</label><input id="offer_payment_value5" type="text" class="form-control " name="offer_payment_value5" value="{{ old('offer_payment_value5') }}" ></div>';
                      }
                      else{
                        oppay5+='';

                      }
                      if(data[i].offer_payment_name6 != null)
                      {
                        oppay6+='<div><label for="offer_payment_value6" class="lasd">'+data[i].offer_payment_name6+'</label><input id="offer_payment_value6" type="text" class="form-control " name="offer_payment_value6" value="{{ old('offer_payment_value6') }}" ></div>';
                      }
                      else{
                        oppay6+='';
                      }
                      if(data[i].offer_payment_name7 != null)
                      {
                        oppay7+='<div><label for="offer_payment_value7" class="lasd">'+data[i].offer_payment_name7+'</label><input id="offer_payment_value7" type="text" class="form-control " name="offer_payment_value7" value="{{ old('offer_payment_value7') }}" ></div>';
                      }
                      else{
                        oppay7+='';

                      }
                      if(data[i].offer_payment_name8 != null)
                      {
                        oppay8+='<div><label for="offer_payment_value8" class="lasd">'+data[i].offer_payment_name8+'</label><input id="offer_payment_value8" type="text" class="form-control " name="offer_payment_value8" value="{{ old('offer_payment_value8') }}" ></div>';
                      }
                      else {
                        oppay8+='';
                      }
                      if(data[i].offer_payment_name9 != null)
                      {
                        oppay9+='<div><label for="offer_payment_value9" class="lasd">'+data[i].offer_payment_name9+'</label><input id="offer_payment_value9" type="text" class="form-control " name="offer_payment_value9" value="{{ old('offer_payment_value9') }}" ></div>';
                      }
                      else{
                        oppay9+='';
                      }
                      if(data[i].offer_payment_name10 != null)
                      {
                        oppay10+='<div><label for="offer_payment_value10" class="lasd">'+data[i].offer_payment_name10+'</label><input id="offer_payment_value10" type="text" class="form-control " name="offer_payment_value10" value="{{ old('offer_payment_value10') }}" ></div>';
                      }
                      else {
                        oppay10+='';
                      }
                      if(data[i].offer_payment_name11 != null)
                      {
                        oppay11+='<div><label for="offer_payment_value11" class="lasd">'+data[i].offer_payment_name11+'</label><input id="offer_payment_value11" type="text" class="form-control " name="offer_payment_value11" value="{{ old('offer_payment_value11') }}" ></div>';
                      }
                      else{
                        oppay11+='';

                      }
                      if(data[i].offer_payment_name12 != null)
                      {
                        oppay12+='<div><label for="offer_payment_value12" class="lasd">'+data[i].offer_payment_name12+'</label><input id="offer_payment_value12" type="text" class="form-control " name="offer_payment_value12" value="{{ old('offer_payment_value12') }}" ></div>';
                      }
                      else {
                        oppay12+='';
                      }
                      if(data[i].offer_payment_name13 != null)
                      {
                        oppay13+='<div><label for="offer_payment_value13" class="lasd">'+data[i].offer_payment_name13+'</label><input id="offer_payment_value13" type="text" class="form-control " name="offer_payment_value13" value="{{ old('offer_payment_value13') }}" ></div>';
                      }
                      else{
                        oppay13+='';
                      }
                      if(data[i].offer_payment_name14 != null)
                      {
                        oppay14+='<div><label for="offer_payment_value14" class="lasd">'+data[i].offer_payment_name14+'</label><input id="offer_payment_value14" type="text" class="form-control " name="offer_payment_value14" value="{{ old('offer_payment_value14') }}" ></div>';
                      }
                      else{
                        oppay14+='';
                      }
                      if(data[i].offer_payment_name15 != null)
                      {
                        oppay15+='<div><label for="offer_payment_value15" class="lasd">'+data[i].offer_payment_name15+'</label><input id="offer_payment_value15" type="text" class="form-control " name="offer_payment_value15" value="{{ old('offer_payment_value15') }}" ></div>';
                      }
                      else {
                        oppay15+='';
                      }
                      if(data[i].offer_payment_name16 != null)
                      {
                        oppay16+='<div><label for="offer_payment_value16" class="lasd">'+data[i].offer_payment_name16+'</label><input id="offer_payment_value16" type="text" class="form-control " name="offer_payment_value16" value="{{ old('offer_payment_value16') }}" ></div>';
                      }
                      else{
                        oppay16+='';
                      }
                      if(data[i].offer_payment_name17 != null)
                      {
                        oppay17+='<div><label for="offer_payment_value17" class="lasd">'+data[i].offer_payment_name17+'</label><input id="offer_payment_value17" type="text" class="form-control " name="offer_payment_value17" value="{{ old('offer_payment_value17') }}" ></div>';
                      }
                      else{
                        oppay17+='';
                      }
                      if(data[i].offer_payment_name18 != null)
                      {
                        oppay18+='<div><label for="offer_payment_value18" class="lasd">'+data[i].offer_payment_name18+'</label><input id="offer_payment_value18" type="text" class="form-control " name="offer_payment_value18" value="{{ old('offer_payment_value18') }}" ></div>';
                      }
                      else
                      {
                      oppay18+='';
                    }
                    if(data[i].offer_payment_name19 != null)
                    {
                      oppay19+='<div><label for="offer_payment_value19" class="lasd">'+data[i].offer_payment_name19+'</label><input id="offer_payment_value19" type="text" class="form-control " name="offer_payment_value19" value="{{ old('offer_payment_value19') }}" ></div>';
                    }
                    else{
                      oppay19+='';
                    }
                    if(data[i].offer_payment_name20 != null)
                    {
                      oppay20+='<div><label for="offer_payment_value20" class="lasd">'+data[i].offer_payment_name20+'</label><input id="offer_payment_value20" type="text" class="form-control " name="offer_payment_value20" value="{{ old('offer_payment_value20') }}" ></div>';
                    }
                    else{
                      oppay20+='';
                    }
                    if(data[i].offer_payment_name21 != null)
                    {
                      oppay21+='<div><label for="offer_payment_value21" class="lasd">'+data[i].offer_payment_name21+'</label><input id="offer_payment_value21" type="text" class="form-control " name="offer_payment_value21" value="{{ old('offer_payment_value21') }}" ></div>';
                    }
                    else{
                      oppay21+='';
                    }

                    if(data[i].offer_payment_name22 != null)
                    {
                      oppay22+='<div><label for="offer_payment_value22" class="lasd">'+data[i].offer_payment_name22+'</label><input id="offer_payment_value22" type="text" class="form-control " name="offer_payment_value22" value="{{ old('offer_payment_value22') }}" ></div>';
                    }
                    else{
                      oppay22+='';
                    }

                    if(data[i].offer_payment_name23 != null)
                    {
                      oppay23+='<div><label for="offer_payment_value23" class="lasd">'+data[i].offer_payment_name23+'</label><input id="offer_payment_value23" type="text" class="form-control " name="offer_payment_value23" value="{{ old('offer_payment_value23') }}" ></div>';
                    }
                    else{
                      oppay23+='';
                    }
                    if(data[i].offer_payment_name24 != null)
                    {
                      oppay24+='<div><label for="offer_payment_value24" class="lasd">'+data[i].offer_payment_name24+'</label><input id="offer_payment_value24" type="text" class="form-control " name="offer_payment_value24" value="{{ old('offer_payment_value24') }}" ></div>';
                    }
                    else{
                      oppay24+='';
                    }

                    if(data[i].offer_payment_name25 != null)
                    {
                      oppay25+='<div><label for="offer_payment_value25" class="lasd">'+data[i].offer_payment_name25+'</label><input id="offer_payment_value25" type="text" class="form-control " name="offer_payment_value25" value="{{ old('offer_payment_value25') }}" ></div>';
                    }
                    else{
                      oppay25+='';
                    }

                    if(data[i].offer_payment_name26 != null)
                    {
                      oppay26+='<div><label for="offer_payment_value26" class="lasd">'+data[i].offer_payment_name26+'</label><input id="offer_payment_value26" type="text" class="form-control " name="offer_payment_value26" value="{{ old('offer_payment_value26') }}" ></div>';
                    }
                    else{
                      oppay26+='';
                    }

                    if(data[i].offer_payment_name27 != null)
                    {
                      oppay27+='<div><label for="offer_payment_value27" class="lasd">'+data[i].offer_payment_name27+'</label><input id="offer_payment_value27" type="text" class="form-control " name="offer_payment_value27" value="{{ old('offer_payment_value27') }}" ></div>';
                    }
                    else{
                      oppay27+='';
                    }

                    if(data[i].offer_payment_name28 != null)
                    {
                      oppay28+='<div><label for="offer_payment_value28" class="lasd">'+data[i].offer_payment_name28+'</label><input id="offer_payment_value28" type="text" class="form-control " name="offer_payment_value28" value="{{ old('offer_payment_value28') }}" ></div>';
                    }
                    else{
                      oppay28+='';
                    }

                    if(data[i].offer_payment_name29 != null)
                    {
                      oppay29+='<div><label for="offer_payment_value29" class="lasd">'+data[i].offer_payment_name29+'</label><input id="offer_payment_value29" type="text" class="form-control " name="offer_payment_value29" value="{{ old('offer_payment_value29') }}" ></div>';
                    }
                    else{
                      oppay29+='';
                    }
                    if(data[i].offer_payment_name30 != null)
                    {
                      oppay30+='<div><label for="offer_payment_value30" class="lasd">'+data[i].offer_payment_name30+'</label><input id="offer_payment_value30" type="text" class="form-control " name="offer_payment_value30" value="{{ old('offer_payment_value30') }}" ></div>';
                    }
                    else{
                      oppay30+='';
                    }

                    if(data[i].offer_payment_name31 != null)
                    {
                      oppay31+='<div><label for="offer_payment_value31" class="lasd">'+data[i].offer_payment_name31+'</label><input id="offer_payment_value31" type="text" class="form-control " name="offer_payment_value31" value="{{ old('offer_payment_value31') }}" ></div>';
                    }
                    else{
                      oppay31+='';
                    }

                    if(data[i].offer_payment_name32 != null)
                    {
                      oppay32+='<div><label for="offer_payment_value32" class="lasd">'+data[i].offer_payment_name32+'</label><input id="offer_payment_value32" type="text" class="form-control " name="offer_payment_value32" value="{{ old('offer_payment_value32') }}" ></div>';
                    }
                    else{
                      oppay32+='';
                    }

                    if(data[i].offer_payment_name33 != null)
                    {
                      oppay33+='<div><label for="offer_payment_value33" class="lasd">'+data[i].offer_payment_name33+'</label><input id="offer_payment_value33" type="text" class="form-control " name="offer_payment_value33" value="{{ old('offer_payment_value33') }}" ></div>';
                    }
                    else{
                      oppay33+='';
                    }

                    if(data[i].offer_payment_name34 != null)
                    {
                      oppay34+='<div><label for="offer_payment_value34" class="lasd">'+data[i].offer_payment_name34+'</label><input id="offer_payment_value34" type="text" class="form-control " name="offer_payment_value34" value="{{ old('offer_payment_value34') }}" ></div>';
                    }
                    else{
                      oppay34+='';
                    }

                    if(data[i].offer_payment_name35 != null)
                    {
                      oppay35+='<div><label for="offer_payment_value35" class="lasd">'+data[i].offer_payment_name35+'</label><input id="offer_payment_value35" type="text" class="form-control " name="offer_payment_value35" value="{{ old('offer_payment_value35') }}" ></div>';
                    }
                    else{
                      oppay35+='';
                    }

                    if(data[i].offer_payment_name36 != null)
                    {
                      oppay36+='<div><label for="offer_payment_value36" class="lasd">'+data[i].offer_payment_name36+'</label><input id="offer_payment_value36" type="text" class="form-control " name="offer_payment_value36" value="{{ old('offer_payment_value36') }}" ></div>';
                    }
                    else{
                      oppay36+='';
                    }

                    if(data[i].offer_payment_name37 != null)
                    {
                      oppay37+='<div><label for="offer_payment_value37" class="lasd">'+data[i].offer_payment_name37+'</label><input id="offer_payment_value37" type="text" class="form-control " name="offer_payment_value37" value="{{ old('offer_payment_value37') }}" ></div>';
                    }
                    else{
                      oppay37+='';
                    }

                    if(data[i].offer_payment_name38 != null)
                    {
                      oppay38+='<div><label for="offer_payment_value38" class="lasd">'+data[i].offer_payment_name38+'</label><input id="offer_payment_value38" type="text" class="form-control " name="offer_payment_value38" value="{{ old('offer_payment_value38') }}" ></div>';
                    }
                    else{
                      oppay38+='';
                    }

                    if(data[i].offer_payment_name39 != null)
                    {
                      oppay39+='<div><label for="offer_payment_value39" class="lasd">'+data[i].offer_payment_name39+'</label><input id="offer_payment_value39" type="text" class="form-control " name="offer_payment_value39" value="{{ old('offer_payment_value39') }}" ></div>';
                    }
                    else{
                      oppay39+='';
                    }

                    if(data[i].offer_payment_name40 != null)
                    {
                      oppay40+='<div><label for="offer_payment_value40" class="lasd">'+data[i].offer_payment_name40+'</label><input id="offer_payment_value40" type="text" class="form-control " name="offer_payment_value40" value="{{ old('offer_payment_value40') }}" ></div>';
                    }
                    else{
                      oppay40+='';
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

                      $('.lapay1').html(" ");
                      $('.lapay2').html(" ");
                      $('.lapay3').html(" ");
                      $('.lapay4').html(" ");
                      $('.lapay5').html(" ");
                      $('.lapay6').html(" ");
                      $('.lapay7').html(" ");
                      $('.lapay8').html(" ");
                      $('.lapay9').html(" ");
                      $('.lapay10').html(" ");
                      $('.lapay11').html(" ");
                      $('.lapay12').html(" ");
                      $('.lapay13').html(" ");
                      $('.lapay14').html(" ");
                      $('.lapay15').html(" ");
                      $('.lapay16').html(" ");
                      $('.lapay17').html(" ");
                      $('.lapay18').html(" ");
                      $('.lapay19').html(" ");
                      $('.lapay20').html(" ");
                      $('.lapay21').html(" ");
                      $('.lapay22').html(" ");
                      $('.lapay23').html(" ");
                      $('.lapay24').html(" ");
                      $('.lapay25').html(" ");
                      $('.lapay26').html(" ");
                      $('.lapay27').html(" ");
                      $('.lapay28').html(" ");
                      $('.lapay29').html(" ");
                      $('.lapay30').html(" ");
                      $('.lapay31').html(" ");
                      $('.lapay32').html(" ");
                      $('.lapay33').html(" ");
                      $('.lapay34').html(" ");
                      $('.lapay35').html(" ");
                      $('.lapay36').html(" ");
                      $('.lapay37').html(" ");
                      $('.lapay38').html(" ");
                      $('.lapay39').html(" ");
                      $('.lapay40').html(" ");



                      $('.lapay1').append(oppay);
                      $('.lapay2').append(oppay2);
                      $('.lapay3').append(oppay3);
                      $('.lapay4').append(oppay4);
                      $('.lapay5').append(oppay5);
                      $('.lapay6').append(oppay6);
                      $('.lapay7').append(oppay7);
                      $('.lapay8').append(oppay8);
                      $('.lapay9').append(oppay9);
                      $('.lapay10').append(oppay10);
                      $('.lapay11').append(oppay11);
                      $('.lapay12').append(oppay12);
                      $('.lapay13').append(oppay13);
                      $('.lapay14').append(oppay14);
                      $('.lapay15').append(oppay15);
                      $('.lapay16').append(oppay16);
                      $('.lapay17').append(oppay17);
                      $('.lapay18').append(oppay18);
                      $('.lapay19').append(oppay19);
                      $('.lapay20').append(oppay20);
                      $('.lapay21').append(oppay21);
                      $('.lapay22').append(oppay22);
                      $('.lapay23').append(oppay23);
                      $('.lapay24').append(oppay24);
                      $('.lapay25').append(oppay25);
                      $('.lapay26').append(oppay26);
                      $('.lapay27').append(oppay27);
                      $('.lapay28').append(oppay28);
                      $('.lapay29').append(oppay29);
                      $('.lapay30').append(oppay30);
                      $('.lapay31').append(oppay31);
                      $('.lapay32').append(oppay32);
                      $('.lapay33').append(oppay33);
                      $('.lapay34').append(oppay34);
                      $('.lapay35').append(oppay35);
                      $('.lapay36').append(oppay36);
                      $('.lapay37').append(oppay37);
                      $('.lapay38').append(oppay38);
                      $('.lapay39').append(oppay39);
                      $('.lapay40').append(oppay40);
                      console.log(op);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>




    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.conditioncampaign',function(){
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
                var oppay=" ";
                var oppay2=" ";
                var oppay3=" ";
                var oppay4=" ";
                var oppay5=" ";
                var oppay6=" ";
                var oppay7=" ";
                var oppay8=" ";
                var oppay9=" ";
                var oppay10=" ";
                var oppay11=" ";
                var oppay12=" ";
                var oppay13=" ";
                var oppay14=" ";
                var oppay15=" ";
                var oppay16=" ";
                var oppay17=" ";
                var oppay18=" ";
                var oppay19=" ";
                var oppay20=" ";
                var oppay21=" ";
                var oppay22=" ";
                var oppay23=" ";
                var oppay24=" ";
                var oppay25=" ";
                var oppay26=" ";
                var oppay27=" ";
                var oppay28=" ";
                var oppay29=" ";
                var oppay30=" ";
                var oppay31=" ";
                var oppay32=" ";
                var oppay33=" ";
                var oppay34=" ";
                var oppay35=" ";
                var oppay36=" ";
                var oppay37=" ";
                var oppay38=" ";
                var oppay39=" ";
                var oppay40=" ";
                var hideoffertype=" ";


                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findOfferTypeCampaign')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      console.log('success');



                     console.log(data.length);
                  if(data.length >0 )
                  {
                    console.log("NONONONO");
                    hideoffertype+='';

                  }
                  else{
                    console.log("YESYESYESYES");
                    hideoffertype+='<label for="case_channel " class="">Offer Type </label><select  class="form-control condition" name="type_id"><option value="" >-select-</option>@foreach ($offertype as $sta)<option value="{{$sta->id}}">{{$sta->name}}</option>@endforeach  </select>  </div>';
                  }
                      for(var i=0; i<data.length;i++){
                      //  op+='<label value="'+data[i].con_para_name1+'">'+data[i].con_para_name1+'</label>';
                      console.log(data[i].id);
                        //op+='<input id="offer_value1" type="text" class="form-control " name="offer_value1" value="'+data[i].offer_value_name1+'" >';

                        if(data[i].offer_value_name1 != null)
                        {
                        op+='<div><label for="offer_value1" class="lasd">'+data[i].offer_value_name1+'</label><input id="offer_value1" type="text" class="form-control " name="offer_value1" value="{{ old('offer_value1') }}" ></div>';
                        }
                        else{
                          op+='';
                        }
                        if(data[i].offer_value_name2 != null)
                        {
                          op2+='<div><label for="offer_value2" class="lasd">'+data[i].offer_value_name2+'</label><input id="offer_value2" type="text" class="form-control " name="offer_value2" value="{{ old('offer_value2') }}" ></div>';
                        }

                        else{
                          op2+='';

                        }
                        if(data[i].offer_value_name3 != null)
                        {
                          op3+='<div><label for="offer_value3" class="lasd">'+data[i].offer_value_name3+'</label><input id="offer_value3" type="text" class="form-control " name="offer_value3" value="{{ old('offer_value3') }}" ></div>';
                        }
                        else{
                          op3+='';
                        }
                        if(data[i].offer_value_name4 != null)
                        {
                          op4+='<div><label for="offer_value4" class="lasd">'+data[i].offer_value_name4+'</label><input id="offer_value4" type="text" class="form-control " name="offer_value4" value="{{ old('offer_value4') }}" ></div>';
                        }
                        else{
                          op4+='';

                        }
                        if(data[i].offer_value_name5 != null)
                        {
                          op5+='<div><label for="offer_value5" class="lasd">'+data[i].offer_value_name5+'</label><input id="offer_value5" type="text" class="form-control " name="offer_value5" value="{{ old('offer_value5') }}" ></div>';
                        }
                        else{
                          op5+='';

                        }
                        if(data[i].offer_value_name6 != null)
                        {
                          op6+='<div><label for="offer_value6" class="lasd">'+data[i].offer_value_name6+'</label><input id="offer_value6" type="text" class="form-control " name="offer_value6" value="{{ old('offer_value6') }}" ></div>';
                        }
                        else{
                          op6+='';
                        }
                        if(data[i].offer_value_name7 != null)
                        {
                          op7+='<div><label for="offer_value7" class="lasd">'+data[i].offer_value_name7+'</label><input id="offer_value7" type="text" class="form-control " name="offer_value7" value="{{ old('offer_value7') }}" ></div>';
                        }
                        else{
                          op7+='';

                        }
                        if(data[i].offer_value_name8 != null)
                        {
                          op8+='<div><label for="offer_value8" class="lasd">'+data[i].offer_value_name8+'</label><input id="offer_value8" type="text" class="form-control " name="offer_value8" value="{{ old('offer_value8') }}" ></div>';
                        }
                        else {
                          op8+='';
                        }
                        if(data[i].offer_value_name9 != null)
                        {
                          op9+='<div><label for="offer_value9" class="lasd">'+data[i].offer_value_name9+'</label><input id="offer_value9" type="text" class="form-control " name="offer_value9" value="{{ old('offer_value9') }}" ></div>';
                        }
                        else{
                          op9+='';
                        }
                        if(data[i].offer_value_name10 != null)
                        {
                          op10+='<div><label for="offer_value10" class="lasd">'+data[i].offer_value_name10+'</label><input id="offer_value10" type="text" class="form-control " name="offer_value10" value="{{ old('offer_value10') }}" ></div>';
                        }
                        else {
                          op10+='';
                        }
                        if(data[i].offer_value_name11 != null)
                        {
                          op11+='<div><label for="offer_value11" class="lasd">'+data[i].offer_value_name11+'</label><input id="offer_value11" type="text" class="form-control " name="offer_value11" value="{{ old('offer_value11') }}" ></div>';
                        }
                        else{
                          op11+='';

                        }
                        if(data[i].offer_value_name12 != null)
                        {
                          op12+='<div><label for="offer_value12" class="lasd">'+data[i].offer_value_name12+'</label><input id="offer_value12" type="text" class="form-control " name="offer_value12" value="{{ old('offer_value12') }}" ></div>';
                        }
                        else {
                          op12+='';
                        }
                        if(data[i].offer_value_name13 != null)
                        {
                          op13+='<div><label for="offer_value13" class="lasd">'+data[i].offer_value_name13+'</label><input id="offer_value13" type="text" class="form-control " name="offer_value13" value="{{ old('offer_value13') }}" ></div>';
                        }
                        else{
                          op13+='';
                        }
                        if(data[i].offer_value_name14 != null)
                        {
                          op14+='<div><label for="offer_value14" class="lasd">'+data[i].offer_value_name14+'</label><input id="offer_value14" type="text" class="form-control " name="offer_value14" value="{{ old('offer_value14') }}" ></div>';
                        }
                        else{
                          op14+='';
                        }
                        if(data[i].offer_value_name15 != null)
                        {
                          op15+='<div><label for="offer_value15" class="lasd">'+data[i].offer_value_name15+'</label><input id="offer_value15" type="text" class="form-control " name="offer_value15" value="{{ old('offer_value15') }}" ></div>';
                        }
                        else {
                          op15+='';
                        }
                        if(data[i].offer_value_name16 != null)
                        {
                          op16+='<div><label for="offer_value16" class="lasd">'+data[i].offer_value_name16+'</label><input id="offer_value16" type="text" class="form-control " name="offer_value16" value="{{ old('offer_value16') }}" ></div>';
                        }
                        else{
                          op16+='';
                        }
                        if(data[i].offer_value_name17 != null)
                        {
                          op17+='<div><label for="offer_value17" class="lasd">'+data[i].offer_value_name17+'</label><input id="offer_value17" type="text" class="form-control " name="offer_value17" value="{{ old('offer_value17') }}" ></div>';
                        }
                        else{
                          op17+='';
                        }
                        if(data[i].offer_value_name18 != null)
                        {
                          op18+='<div><label for="offer_value18" class="lasd">'+data[i].offer_value_name18+'</label><input id="offer_value18" type="text" class="form-control " name="offer_value18" value="{{ old('offer_value18') }}" ></div>';
                        }
                        else
                        {
                        op18+='';
                      }
                      if(data[i].offer_value_name19 != null)
                      {
                        op19+='<div><label for="offer_value19" class="lasd">'+data[i].offer_value_name19+'</label><input id="offer_value19" type="text" class="form-control " name="offer_value19" value="{{ old('offer_value19') }}" ></div>';
                      }
                      else{
                        op19+='';
                      }
                      if(data[i].offer_value_name20 != null)
                      {
                        op20+='<div><label for="offer_value20" class="lasd">'+data[i].offer_value_name20+'</label><input id="offer_value20" type="text" class="form-control " name="offer_value20" value="{{ old('offer_value20') }}" ></div>';
                      }
                      else{
                        op20+='';
                      }
                      if(data[i].offer_value_name21 != null)
                      {
                        op21+='<div><label for="offer_value21" class="lasd">'+data[i].offer_value_name21+'</label><input id="offer_value21" type="text" class="form-control " name="offer_value21" value="{{ old('offer_value21') }}" ></div>';
                      }
                      else{
                        op21+='';
                      }

                      if(data[i].offer_value_name22 != null)
                      {
                        op22+='<div><label for="offer_value22" class="lasd">'+data[i].offer_value_name22+'</label><input id="offer_value22" type="text" class="form-control " name="offer_value22" value="{{ old('offer_value22') }}" ></div>';
                      }
                      else{
                        op22+='';
                      }

                      if(data[i].offer_value_name23 != null)
                      {
                        op23+='<div><label for="offer_value23" class="lasd">'+data[i].offer_value_name23+'</label><input id="offer_value23" type="text" class="form-control " name="offer_value23" value="{{ old('offer_value23') }}" ></div>';
                      }
                      else{
                        op23+='';
                      }
                      if(data[i].offer_value_name24 != null)
                      {
                        op24+='<div><label for="offer_value24" class="lasd">'+data[i].offer_value_name24+'</label><input id="offer_value24" type="text" class="form-control " name="offer_value24" value="{{ old('offer_value24') }}" ></div>';
                      }
                      else{
                        op24+='';
                      }

                      if(data[i].offer_value_name25 != null)
                      {
                        op25+='<div><label for="offer_value25" class="lasd">'+data[i].offer_value_name25+'</label><input id="offer_value25" type="text" class="form-control " name="offer_value25" value="{{ old('offer_value25') }}" ></div>';
                      }
                      else{
                        op25+='';
                      }

                      if(data[i].offer_value_name26 != null)
                      {
                        op26+='<div><label for="offer_value26" class="lasd">'+data[i].offer_value_name26+'</label><input id="offer_value26" type="text" class="form-control " name="offer_value26" value="{{ old('offer_value26') }}" ></div>';
                      }
                      else{
                        op26+='';
                      }

                      if(data[i].offer_value_name27 != null)
                      {
                        op27+='<div><label for="offer_value27" class="lasd">'+data[i].offer_value_name27+'</label><input id="offer_value27" type="text" class="form-control " name="offer_value27" value="{{ old('offer_value27') }}" ></div>';
                      }
                      else{
                        op27+='';
                      }

                      if(data[i].offer_value_name28 != null)
                      {
                        op28+='<div><label for="offer_value28" class="lasd">'+data[i].offer_value_name28+'</label><input id="offer_value28" type="text" class="form-control " name="offer_value28" value="{{ old('offer_value28') }}" ></div>';
                      }
                      else{
                        op28+='';
                      }

                      if(data[i].offer_value_name29 != null)
                      {
                        op29+='<div><label for="offer_value29" class="lasd">'+data[i].offer_value_name29+'</label><input id="offer_value29" type="text" class="form-control " name="offer_value29" value="{{ old('offer_value29') }}" ></div>';
                      }
                      else{
                        op29+='';
                      }
                      if(data[i].offer_value_name30 != null)
                      {
                        op30+='<div><label for="offer_value30" class="lasd">'+data[i].offer_value_name30+'</label><input id="offer_value30" type="text" class="form-control " name="offer_value30" value="{{ old('offer_value30') }}" ></div>';
                      }
                      else{
                        op30+='';
                      }

                      if(data[i].offer_value_name31 != null)
                      {
                        op31+='<div><label for="offer_value31" class="lasd">'+data[i].offer_value_name31+'</label><input id="offer_value31" type="text" class="form-control " name="offer_value31" value="{{ old('offer_value31') }}" ></div>';
                      }
                      else{
                        op31+='';
                      }

                      if(data[i].offer_value_name32 != null)
                      {
                        op32+='<div><label for="offer_value32" class="lasd">'+data[i].offer_value_name32+'</label><input id="offer_value32" type="text" class="form-control " name="offer_value32" value="{{ old('offer_value32') }}" ></div>';
                      }
                      else{
                        op32+='';
                      }

                      if(data[i].offer_value_name33 != null)
                      {
                        op33+='<div><label for="offer_value33" class="lasd">'+data[i].offer_value_name33+'</label><input id="offer_value33" type="text" class="form-control " name="offer_value33" value="{{ old('offer_value33') }}" ></div>';
                      }
                      else{
                        op33+='';
                      }

                      if(data[i].offer_value_name34 != null)
                      {
                        op34+='<div><label for="offer_value34" class="lasd">'+data[i].offer_value_name34+'</label><input id="offer_value34" type="text" class="form-control " name="offer_value34" value="{{ old('offer_value34') }}" ></div>';
                      }
                      else{
                        op34+='';
                      }

                      if(data[i].offer_value_name35 != null)
                      {
                        op35+='<div><label for="offer_value35" class="lasd">'+data[i].offer_value_name35+'</label><input id="offer_value35" type="text" class="form-control " name="offer_value35" value="{{ old('offer_value35') }}" ></div>';
                      }
                      else{
                        op35+='';
                      }

                      if(data[i].offer_value_name36 != null)
                      {
                        op36+='<div><label for="offer_value36" class="lasd">'+data[i].offer_value_name36+'</label><input id="offer_value36" type="text" class="form-control " name="offer_value36" value="{{ old('offer_value36') }}" ></div>';
                      }
                      else{
                        op36+='';
                      }

                      if(data[i].offer_value_name37 != null)
                      {
                        op37+='<div><label for="offer_value37" class="lasd">'+data[i].offer_value_name37+'</label><input id="offer_value37" type="text" class="form-control " name="offer_value37" value="{{ old('offer_value37') }}" ></div>';
                      }
                      else{
                        op37+='';
                      }

                      if(data[i].offer_value_name38 != null)
                      {
                        op38+='<div><label for="offer_value38" class="lasd">'+data[i].offer_value_name38+'</label><input id="offer_value38" type="text" class="form-control " name="offer_value38" value="{{ old('offer_value38') }}" ></div>';
                      }
                      else{
                        op38+='';
                      }

                      if(data[i].offer_value_name39 != null)
                      {
                        op39+='<div><label for="offer_value39" class="lasd">'+data[i].offer_value_name39+'</label><input id="offer_value39" type="text" class="form-control " name="offer_value39" value="{{ old('offer_value39') }}" ></div>';
                      }
                      else{
                        op39+='';
                      }

                      if(data[i].offer_value_name40 != null)
                      {
                        op40+='<div><label for="offer_value40" class="lasd">'+data[i].offer_value_name40+'</label><input id="offer_value40" type="text" class="form-control " name="offer_value40" value="{{ old('offer_value40') }}" ></div>';
                      }
                      else{
                        op40+='';
                      }

                      if(data[i].offer_payment_name1 != null)
                      {
                      oppay+='<div><label for="offer_payment_value1" class="lasd">'+data[i].offer_payment_name1+'</label><input id="offer_payment_value1" type="text" class="form-control " name="offer_payment_value1" value="{{ old('offer_payment_value1') }}" ></div>';
                      }
                      else{
                        oppay+='';
                      }
                      if(data[i].offer_payment_name2 != null)
                      {
                        oppay2+='<div><label for="offer_payment_value2" class="lasd">'+data[i].offer_payment_name2+'</label><input id="offer_payment_value2" type="text" class="form-control " name="offer_payment_value2" value="{{ old('offer_payment_value2') }}" ></div>';
                      }

                      else{
                        oppay2+='';

                      }
                      if(data[i].offer_payment_name3 != null)
                      {
                        oppay3+='<div><label for="offer_payment_value3" class="lasd">'+data[i].offer_payment_name3+'</label><input id="offer_payment_value3" type="text" class="form-control " name="offer_payment_value3" value="{{ old('offer_payment_value3') }}" ></div>';
                      }
                      else{
                        oppay3+='';
                      }
                      if(data[i].offer_payment_name4 != null)
                      {
                        oppay4+='<div><label for="offer_payment_value4" class="lasd">'+data[i].offer_payment_name4+'</label><input id="offer_payment_value4" type="text" class="form-control " name="offer_payment_value4" value="{{ old('offer_payment_value4') }}" ></div>';
                      }
                      else{
                        oppay4+='';

                      }
                      if(data[i].offer_payment_name5 != null)
                      {
                        oppay5+='<div><label for="offer_payment_value5" class="lasd">'+data[i].offer_payment_name5+'</label><input id="offer_payment_value5" type="text" class="form-control " name="offer_payment_value5" value="{{ old('offer_payment_value5') }}" ></div>';
                      }
                      else{
                        oppay5+='';

                      }
                      if(data[i].offer_payment_name6 != null)
                      {
                        oppay6+='<div><label for="offer_payment_value6" class="lasd">'+data[i].offer_payment_name6+'</label><input id="offer_payment_value6" type="text" class="form-control " name="offer_payment_value6" value="{{ old('offer_payment_value6') }}" ></div>';
                      }
                      else{
                        oppay6+='';
                      }
                      if(data[i].offer_payment_name7 != null)
                      {
                        oppay7+='<div><label for="offer_payment_value7" class="lasd">'+data[i].offer_payment_name7+'</label><input id="offer_payment_value7" type="text" class="form-control " name="offer_payment_value7" value="{{ old('offer_payment_value7') }}" ></div>';
                      }
                      else{
                        oppay7+='';

                      }
                      if(data[i].offer_payment_name8 != null)
                      {
                        oppay8+='<div><label for="offer_payment_value8" class="lasd">'+data[i].offer_payment_name8+'</label><input id="offer_payment_value8" type="text" class="form-control " name="offer_payment_value8" value="{{ old('offer_payment_value8') }}" ></div>';
                      }
                      else {
                        oppay8+='';
                      }
                      if(data[i].offer_payment_name9 != null)
                      {
                        oppay9+='<div><label for="offer_payment_value9" class="lasd">'+data[i].offer_payment_name9+'</label><input id="offer_payment_value9" type="text" class="form-control " name="offer_payment_value9" value="{{ old('offer_payment_value9') }}" ></div>';
                      }
                      else{
                        oppay9+='';
                      }
                      if(data[i].offer_payment_name10 != null)
                      {
                        oppay10+='<div><label for="offer_payment_value10" class="lasd">'+data[i].offer_payment_name10+'</label><input id="offer_payment_value10" type="text" class="form-control " name="offer_payment_value10" value="{{ old('offer_payment_value10') }}" ></div>';
                      }
                      else {
                        oppay10+='';
                      }
                      if(data[i].offer_payment_name11 != null)
                      {
                        oppay11+='<div><label for="offer_payment_value11" class="lasd">'+data[i].offer_payment_name11+'</label><input id="offer_payment_value11" type="text" class="form-control " name="offer_payment_value11" value="{{ old('offer_payment_value11') }}" ></div>';
                      }
                      else{
                        oppay11+='';

                      }
                      if(data[i].offer_payment_name12 != null)
                      {
                        oppay12+='<div><label for="offer_payment_value12" class="lasd">'+data[i].offer_payment_name12+'</label><input id="offer_payment_value12" type="text" class="form-control " name="offer_payment_value12" value="{{ old('offer_payment_value12') }}" ></div>';
                      }
                      else {
                        oppay12+='';
                      }
                      if(data[i].offer_payment_name13 != null)
                      {
                        oppay13+='<div><label for="offer_payment_value13" class="lasd">'+data[i].offer_payment_name13+'</label><input id="offer_payment_value13" type="text" class="form-control " name="offer_payment_value13" value="{{ old('offer_payment_value13') }}" ></div>';
                      }
                      else{
                        oppay13+='';
                      }
                      if(data[i].offer_payment_name14 != null)
                      {
                        oppay14+='<div><label for="offer_payment_value14" class="lasd">'+data[i].offer_payment_name14+'</label><input id="offer_payment_value14" type="text" class="form-control " name="offer_payment_value14" value="{{ old('offer_payment_value14') }}" ></div>';
                      }
                      else{
                        oppay14+='';
                      }
                      if(data[i].offer_payment_name15 != null)
                      {
                        oppay15+='<div><label for="offer_payment_value15" class="lasd">'+data[i].offer_payment_name15+'</label><input id="offer_payment_value15" type="text" class="form-control " name="offer_payment_value15" value="{{ old('offer_payment_value15') }}" ></div>';
                      }
                      else {
                        oppay15+='';
                      }
                      if(data[i].offer_payment_name16 != null)
                      {
                        oppay16+='<div><label for="offer_payment_value16" class="lasd">'+data[i].offer_payment_name16+'</label><input id="offer_payment_value16" type="text" class="form-control " name="offer_payment_value16" value="{{ old('offer_payment_value16') }}" ></div>';
                      }
                      else{
                        oppay16+='';
                      }
                      if(data[i].offer_payment_name17 != null)
                      {
                        oppay17+='<div><label for="offer_payment_value17" class="lasd">'+data[i].offer_payment_name17+'</label><input id="offer_payment_value17" type="text" class="form-control " name="offer_payment_value17" value="{{ old('offer_payment_value17') }}" ></div>';
                      }
                      else{
                        oppay17+='';
                      }
                      if(data[i].offer_payment_name18 != null)
                      {
                        oppay18+='<div><label for="offer_payment_value18" class="lasd">'+data[i].offer_payment_name18+'</label><input id="offer_payment_value18" type="text" class="form-control " name="offer_payment_value18" value="{{ old('offer_payment_value18') }}" ></div>';
                      }
                      else
                      {
                      oppay18+='';
                    }
                    if(data[i].offer_payment_name19 != null)
                    {
                      oppay19+='<div><label for="offer_payment_value19" class="lasd">'+data[i].offer_payment_name19+'</label><input id="offer_payment_value19" type="text" class="form-control " name="offer_payment_value19" value="{{ old('offer_payment_value19') }}" ></div>';
                    }
                    else{
                      oppay19+='';
                    }
                    if(data[i].offer_payment_name20 != null)
                    {
                      oppay20+='<div><label for="offer_payment_value20" class="lasd">'+data[i].offer_payment_name20+'</label><input id="offer_payment_value20" type="text" class="form-control " name="offer_payment_value20" value="{{ old('offer_payment_value20') }}" ></div>';
                    }
                    else{
                      oppay20+='';
                    }
                    if(data[i].offer_payment_name21 != null)
                    {
                      oppay21+='<div><label for="offer_payment_value21" class="lasd">'+data[i].offer_payment_name21+'</label><input id="offer_payment_value21" type="text" class="form-control " name="offer_payment_value21" value="{{ old('offer_payment_value21') }}" ></div>';
                    }
                    else{
                      oppay21+='';
                    }

                    if(data[i].offer_payment_name22 != null)
                    {
                      oppay22+='<div><label for="offer_payment_value22" class="lasd">'+data[i].offer_payment_name22+'</label><input id="offer_payment_value22" type="text" class="form-control " name="offer_payment_value22" value="{{ old('offer_payment_value22') }}" ></div>';
                    }
                    else{
                      oppay22+='';
                    }

                    if(data[i].offer_payment_name23 != null)
                    {
                      oppay23+='<div><label for="offer_payment_value23" class="lasd">'+data[i].offer_payment_name23+'</label><input id="offer_payment_value23" type="text" class="form-control " name="offer_payment_value23" value="{{ old('offer_payment_value23') }}" ></div>';
                    }
                    else{
                      oppay23+='';
                    }
                    if(data[i].offer_payment_name24 != null)
                    {
                      oppay24+='<div><label for="offer_payment_value24" class="lasd">'+data[i].offer_payment_name24+'</label><input id="offer_payment_value24" type="text" class="form-control " name="offer_payment_value24" value="{{ old('offer_payment_value24') }}" ></div>';
                    }
                    else{
                      oppay24+='';
                    }

                    if(data[i].offer_payment_name25 != null)
                    {
                      oppay25+='<div><label for="offer_payment_value25" class="lasd">'+data[i].offer_payment_name25+'</label><input id="offer_payment_value25" type="text" class="form-control " name="offer_payment_value25" value="{{ old('offer_payment_value25') }}" ></div>';
                    }
                    else{
                      oppay25+='';
                    }

                    if(data[i].offer_payment_name26 != null)
                    {
                      oppay26+='<div><label for="offer_payment_value26" class="lasd">'+data[i].offer_payment_name26+'</label><input id="offer_payment_value26" type="text" class="form-control " name="offer_payment_value26" value="{{ old('offer_payment_value26') }}" ></div>';
                    }
                    else{
                      oppay26+='';
                    }

                    if(data[i].offer_payment_name27 != null)
                    {
                      oppay27+='<div><label for="offer_payment_value27" class="lasd">'+data[i].offer_payment_name27+'</label><input id="offer_payment_value27" type="text" class="form-control " name="offer_payment_value27" value="{{ old('offer_payment_value27') }}" ></div>';
                    }
                    else{
                      oppay27+='';
                    }

                    if(data[i].offer_payment_name28 != null)
                    {
                      oppay28+='<div><label for="offer_payment_value28" class="lasd">'+data[i].offer_payment_name28+'</label><input id="offer_payment_value28" type="text" class="form-control " name="offer_payment_value28" value="{{ old('offer_payment_value28') }}" ></div>';
                    }
                    else{
                      oppay28+='';
                    }

                    if(data[i].offer_payment_name29 != null)
                    {
                      oppay29+='<div><label for="offer_payment_value29" class="lasd">'+data[i].offer_payment_name29+'</label><input id="offer_payment_value29" type="text" class="form-control " name="offer_payment_value29" value="{{ old('offer_payment_value29') }}" ></div>';
                    }
                    else{
                      oppay29+='';
                    }
                    if(data[i].offer_payment_name30 != null)
                    {
                      oppay30+='<div><label for="offer_payment_value30" class="lasd">'+data[i].offer_payment_name30+'</label><input id="offer_payment_value30" type="text" class="form-control " name="offer_payment_value30" value="{{ old('offer_payment_value30') }}" ></div>';
                    }
                    else{
                      oppay30+='';
                    }

                    if(data[i].offer_payment_name31 != null)
                    {
                      oppay31+='<div><label for="offer_payment_value31" class="lasd">'+data[i].offer_payment_name31+'</label><input id="offer_payment_value31" type="text" class="form-control " name="offer_payment_value31" value="{{ old('offer_payment_value31') }}" ></div>';
                    }
                    else{
                      oppay31+='';
                    }

                    if(data[i].offer_payment_name32 != null)
                    {
                      oppay32+='<div><label for="offer_payment_value32" class="lasd">'+data[i].offer_payment_name32+'</label><input id="offer_payment_value32" type="text" class="form-control " name="offer_payment_value32" value="{{ old('offer_payment_value32') }}" ></div>';
                    }
                    else{
                      oppay32+='';
                    }

                    if(data[i].offer_payment_name33 != null)
                    {
                      oppay33+='<div><label for="offer_payment_value33" class="lasd">'+data[i].offer_payment_name33+'</label><input id="offer_payment_value33" type="text" class="form-control " name="offer_payment_value33" value="{{ old('offer_payment_value33') }}" ></div>';
                    }
                    else{
                      oppay33+='';
                    }

                    if(data[i].offer_payment_name34 != null)
                    {
                      oppay34+='<div><label for="offer_payment_value34" class="lasd">'+data[i].offer_payment_name34+'</label><input id="offer_payment_value34" type="text" class="form-control " name="offer_payment_value34" value="{{ old('offer_payment_value34') }}" ></div>';
                    }
                    else{
                      oppay34+='';
                    }

                    if(data[i].offer_payment_name35 != null)
                    {
                      oppay35+='<div><label for="offer_payment_value35" class="lasd">'+data[i].offer_payment_name35+'</label><input id="offer_payment_value35" type="text" class="form-control " name="offer_payment_value35" value="{{ old('offer_payment_value35') }}" ></div>';
                    }
                    else{
                      oppay35+='';
                    }

                    if(data[i].offer_payment_name36 != null)
                    {
                      oppay36+='<div><label for="offer_payment_value36" class="lasd">'+data[i].offer_payment_name36+'</label><input id="offer_payment_value36" type="text" class="form-control " name="offer_payment_value36" value="{{ old('offer_payment_value36') }}" ></div>';
                    }
                    else{
                      oppay36+='';
                    }

                    if(data[i].offer_payment_name37 != null)
                    {
                      oppay37+='<div><label for="offer_payment_value37" class="lasd">'+data[i].offer_payment_name37+'</label><input id="offer_payment_value37" type="text" class="form-control " name="offer_payment_value37" value="{{ old('offer_payment_value37') }}" ></div>';
                    }
                    else{
                      oppay37+='';
                    }

                    if(data[i].offer_payment_name38 != null)
                    {
                      oppay38+='<div><label for="offer_payment_value38" class="lasd">'+data[i].offer_payment_name38+'</label><input id="offer_payment_value38" type="text" class="form-control " name="offer_payment_value38" value="{{ old('offer_payment_value38') }}" ></div>';
                    }
                    else{
                      oppay38+='';
                    }

                    if(data[i].offer_payment_name39 != null)
                    {
                      oppay39+='<div><label for="offer_payment_value39" class="lasd">'+data[i].offer_payment_name39+'</label><input id="offer_payment_value39" type="text" class="form-control " name="offer_payment_value39" value="{{ old('offer_payment_value39') }}" ></div>';
                    }
                    else{
                      oppay39+='';
                    }

                    if(data[i].offer_payment_name40 != null)
                    {
                      oppay40+='<div><label for="offer_payment_value40" class="lasd">'+data[i].offer_payment_name40+'</label><input id="offer_payment_value40" type="text" class="form-control " name="offer_payment_value40" value="{{ old('offer_payment_value40') }}" ></div>';
                    }
                    else{
                      oppay40+='';
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

                      $('.lapay1').html(" ");
                      $('.lapay2').html(" ");
                      $('.lapay3').html(" ");
                      $('.lapay4').html(" ");
                      $('.lapay5').html(" ");
                      $('.lapay6').html(" ");
                      $('.lapay7').html(" ");
                      $('.lapay8').html(" ");
                      $('.lapay9').html(" ");
                      $('.lapay10').html(" ");
                      $('.lapay11').html(" ");
                      $('.lapay12').html(" ");
                      $('.lapay13').html(" ");
                      $('.lapay14').html(" ");
                      $('.lapay15').html(" ");
                      $('.lapay16').html(" ");
                      $('.lapay17').html(" ");
                      $('.lapay18').html(" ");
                      $('.lapay19').html(" ");
                      $('.lapay20').html(" ");
                      $('.lapay21').html(" ");
                      $('.lapay22').html(" ");
                      $('.lapay23').html(" ");
                      $('.lapay24').html(" ");
                      $('.lapay25').html(" ");
                      $('.lapay26').html(" ");
                      $('.lapay27').html(" ");
                      $('.lapay28').html(" ");
                      $('.lapay29').html(" ");
                      $('.lapay30').html(" ");
                      $('.lapay31').html(" ");
                      $('.lapay32').html(" ");
                      $('.lapay33').html(" ");
                      $('.lapay34').html(" ");
                      $('.lapay35').html(" ");
                      $('.lapay36').html(" ");
                      $('.lapay37').html(" ");
                      $('.lapay38').html(" ");
                      $('.lapay39').html(" ");
                      $('.lapay40').html(" ");
                      $('.hideoffertype').html(" ");



                      $('.lapay1').append(oppay);
                      $('.lapay2').append(oppay2);
                      $('.lapay3').append(oppay3);
                      $('.lapay4').append(oppay4);
                      $('.lapay5').append(oppay5);
                      $('.lapay6').append(oppay6);
                      $('.lapay7').append(oppay7);
                      $('.lapay8').append(oppay8);
                      $('.lapay9').append(oppay9);
                      $('.lapay10').append(oppay10);
                      $('.lapay11').append(oppay11);
                      $('.lapay12').append(oppay12);
                      $('.lapay13').append(oppay13);
                      $('.lapay14').append(oppay14);
                      $('.lapay15').append(oppay15);
                      $('.lapay16').append(oppay16);
                      $('.lapay17').append(oppay17);
                      $('.lapay18').append(oppay18);
                      $('.lapay19').append(oppay19);
                      $('.lapay20').append(oppay20);
                      $('.lapay21').append(oppay21);
                      $('.lapay22').append(oppay22);
                      $('.lapay23').append(oppay23);
                      $('.lapay24').append(oppay24);
                      $('.lapay25').append(oppay25);
                      $('.lapay26').append(oppay26);
                      $('.lapay27').append(oppay27);
                      $('.lapay28').append(oppay28);
                      $('.lapay29').append(oppay29);
                      $('.lapay30').append(oppay30);
                      $('.lapay31').append(oppay31);
                      $('.lapay32').append(oppay32);
                      $('.lapay33').append(oppay33);
                      $('.lapay34').append(oppay34);
                      $('.lapay35').append(oppay35);
                      $('.lapay36').append(oppay36);
                      $('.lapay37').append(oppay37);
                      $('.lapay38').append(oppay38);
                      $('.lapay39').append(oppay39);
                      $('.lapay40').append(oppay40);
                      $('.hideoffertype').append(hideoffertype);

                      console.log(op);
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
