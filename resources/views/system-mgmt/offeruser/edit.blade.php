@extends('system-mgmt.offer.base')

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
                <div class="panel-heading">Update Offer</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('offeruser.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3 style="color:#00325d;">General Information</h3>

                        <div class="row">
                          <div class="column">
                            <label for="name" class="">Offer Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

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
                                    <option value="{{$sta->id}}"{{$sta->id == $data->type_id ? 'selected' : ''}}>{{$sta->name}}</option>
                                @endforeach &nbsp;
                              </select>
                            </div>

                        </div>
                  </div>
                  <div class="row">


                    <div class="column">

                      <label for="case_channel " class="">Campaign</label>


                      <select  class="form-control conditioncampaign" name="campaign_id">
                        <option value="0" >-select-</option>
                        @foreach ($campaign as $sta)
                            <option value="{{$sta->id}}"{{$sta->id == $data->campaign_id ? 'selected' : ''}}>{{$sta->name}}</option>
                        @endforeach
                      </select>

                    </div>
                    <div class="column">

                    <label for="case_channel " class="">Promotion</label>
                    <select  class="form-control " name="promotion_id" id="promotion_id" onchange="chgtext()">
                    <option value="" >-select-</option>
                    @foreach ($promotion as $sta)
                        <option value="{{$sta->id}}"{{$sta->id == $data->promotion_id ? 'selected' : ''}}>{{$sta->name}}</option>
                    @endforeach
                    </select>

                    </div>


                  </div>
                  <div class="row">
                    <div class="column">

                      <label for="case_channel" class="">Proposal </label>


                      <select  class="form-control " name="proposal_id">
                        <option value="" >-select-</option>
                        @foreach ($proposal as $sta)
                            <option value="{{$sta->id}}"{{$sta->id == $data->proposal_id ? 'selected' : ''}}>{{$sta->name}}</option>
                        @endforeach &nbsp;
                      </select>

                </div>

            </div>
                  <div class="row">

                    <div class="column">

                      <label for="ref_member_id" class="">Referal Member </label>


                      <select  class="form-control " name="ref_member_id" id="ref_member_id" onchange="selectbranch()">
                        <option value="" >-select-</option>
                        @foreach ($member as $sta)
                            <option value="{{$sta->id}}"{{$sta->id == $data->ref_member_id ? 'selected' : ''}}>{{$sta->name}} {{$sta->lname}} </option>
                        @endforeach &nbsp;
                      </select>

                    </div>

                    <div class="column">

                      <label for="ref_branch_id" class="">Referal Branch </label>


                      <select  class="form-control name changebranch" name="ref_branch_id">
                        <option value="" >-select-</option>
                        @foreach ($branch as $sta)
                            <option value="{{$sta->id}}"{{$sta->id == $data->ref_branch_id ? 'selected' : ''}}>{{$sta->name}}</option>
                        @endforeach &nbsp;
                      </select>

                    </div>



                  </div>

                  <h3 style="color:#00325d;">Offer Value</h3>
                  <div class="row">
                    <div class="column">
                      <div class="la">

                      <label for="name" class="lasd">@foreach($findoffertype as $fi){{$fi->offer_value_name1}}@endforeach &nbsp;	</label>


                        <input id="offer_value1" type="text" class="form-control" name="offer_value1"  value="{{ $data->offer_value1 }}" >

                        </div>
                          @if ($errors->has('offer_value1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('offer_value1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">
                  <div class="la2">

                  <label for="offer_value2" class="lasd2">@foreach($findoffertype as $fi){{$fi->offer_value_name2}}@endforeach &nbsp;	</label>


                      <input id="offer_value2" type="text" class="form-control" name="offer_value2"  value="{{$data->offer_value2}}" >
                    </div>

                      @if ($errors->has('offer_value2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('offer_value2') }}</strong>
                          </span>
                      @endif
            </div>



            <div class="column">
              <div class="la3">

              <label for="offer_value3" class="lasd3">@foreach($findoffertype as $fi){{$fi->offer_value_name3}}@endforeach &nbsp;	</label>

                  <input id="offer_value3" type="text" class="form-control" name="offer_value3"  value="{{ $data->offer_value3 }}" >
                </div>

                  @if ($errors->has('offer_value3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('offer_value3') }}</strong>
                      </span>
                  @endif
        </div>
        <div class="column">
          <div class="la4">

          <label for="offer_value4" class="lasd4">@foreach($findoffertype as $fi){{$fi->offer_value_name4}}@endforeach &nbsp;	</label>


              <input id="offer_value4" type="text" class="form-control" name="offer_value4"  value="{{ $data->offer_value4 }}" >
            </div>

              @if ($errors->has('offer_value4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value4') }}</strong>
                  </span>
              @endif
    </div>
    <div class="column">
      <div class="la5">

      <label for="offer_value5" class="lasd5">@foreach($findoffertype as $fi){{$fi->offer_value_name5}}@endforeach &nbsp;	</label>


          <input id="offer_value5" type="text" class="form-control" name="offer_value5"  value="{{ $data->offer_value5 }}" >
        </div>

          @if ($errors->has('offer_value5'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value5') }}</strong>
              </span>
          @endif
</div>


              <div class="column">
                <div class="la6">

                <label for="offer_value6" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_value_name6}}@endforeach &nbsp;	</label>


                    <input id="offer_value6" type="text" class="form-control" name="offer_value6"  value="{{ $data->offer_value6 }}" >
                  </div>

                    @if ($errors->has('offer_value6'))
                        <span class="help-block">
                            <strong>{{ $errors->first('offer_value6') }}</strong>
                        </span>
                    @endif
              </div>
              <div class="column">
                <div class="la7">

                <label for="offer_value7" class="lasd7">@foreach($findoffertype as $fi){{$fi->offer_value_name7}}@endforeach &nbsp;	</label>


                    <input id="offer_value7" type="text" class="form-control" name="offer_value7"  value="{{ $data->offer_value7 }}" >
                  </div>

                    @if ($errors->has('offer_value7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('offer_value7') }}</strong>
                        </span>
                    @endif
          </div>
          <div class="column">
            <div class="la8">

            <label for="offer_value8" class="lasd8">@foreach($findoffertype as $fi){{$fi->offer_value_name8}}@endforeach &nbsp;	</label>


                <input id="offer_value8" type="text" class="form-control " name="offer_value8"  value="{{ $data->offer_value8 }}" >
              </div>

                @if ($errors->has('offer_value8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('offer_value8') }}</strong>
                    </span>
                @endif
      </div>



      <div class="column">
        <div class="la9">

        <label for="offer_value9" class="lasd9">@foreach($findoffertype as $fi){{$fi->offer_value_name9}}@endforeach &nbsp;	</label>


            <input id="offer_value9" type="text" class="form-control la9" name="offer_value9"  value="{{ $data->offer_value9 }}" >
          </div>

            @if ($errors->has('offer_value9'))
                <span class="help-block">
                    <strong>{{ $errors->first('offer_value9') }}</strong>
                </span>
            @endif
  </div>
  <div class="column">
    <div class="la10">

    <label for="offer_value10" class="lasd10">@foreach($findoffertype as $fi){{$fi->offer_value_name10}}@endforeach &nbsp;	</label>


        <input id="offer_value10" type="text" class="form-control la10" name="offer_value10"  value="{{ $data->offer_value10 }}" >
      </div>

        @if ($errors->has('offer_value10'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value10') }}</strong>
            </span>
        @endif
</div>


        <div class="column">
          <div class="la11">

          <label for="offer_value11" class="lasd11">@foreach($findoffertype as $fi){{$fi->offer_value_name11}}@endforeach &nbsp;	</label>


              <input id="offer_value11" type="text" class="form-control la11" name="offer_value11"  value="{{ $data->offer_value11 }}" >
            </div>

              @if ($errors->has('offer_value11'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value11') }}</strong>
                  </span>
              @endif
        </div>
        <div class="column">
          <div class="la12">

          <label for="offer_value12" class="lasd7">@foreach($findoffertype as $fi){{$fi->offer_value_name12}}@endforeach &nbsp;	</label>


              <input id="offer_value12" type="text" class="form-control la12" name="offer_value12"  value="{{ $data->offer_value12 }}" >
            </div>

              @if ($errors->has('offer_value12'))
                  <span class="help-block">
                      <strong>{{ $errors->first('offer_value12') }}</strong>
                  </span>
              @endif
    </div>
    <div class="column">
      <div class="la13">

      <label for="offer_value13" class="lasd8">@foreach($findoffertype as $fi){{$fi->offer_value_name13}}@endforeach &nbsp;	</label>


          <input id="offer_value13" type="text" class="form-control la13" name="offer_value13"  value="{{ $data->offer_value13 }}" >
        </div>

          @if ($errors->has('offer_value13'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value13') }}</strong>
              </span>
          @endif
</div>



<div class="column">
  <div class="la14">

  <label for="offer_value14" class="lasd9">@foreach($findoffertype as $fi){{$fi->offer_value_name14}}@endforeach &nbsp;	 &nbsp;	</label>


      <input id="offer_value14" type="text" class="form-control la14" name="offer_value14"  value="{{ $data->offer_value14 }}" >
    </div>

      @if ($errors->has('offer_value14'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_value14') }}</strong>
          </span>
      @endif
</div>
<div class="column">
  <div class="la15">

<label for="offer_value15" class="lasd10">@foreach($findoffertype as $fi){{$fi->offer_value_name15}}@endforeach &nbsp;	</label>


  <input id="offer_value15" type="text" class="form-control la15" name="offer_value15"  value="{{$data->offer_value15}}" >
</div>

  @if ($errors->has('offer_value15'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_value15') }}</strong>
      </span>
  @endif
</div>


  <div class="column">
    <div class="la16">

    <label for="offer_value16" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_value_name16}}@endforeach &nbsp;	</label>


        <input id="offer_value16" type="text" class="form-control la16" name="offer_value16"  value="{{ $data->offer_value16 }}" >
      </div>

        @if ($errors->has('offer_value16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value16') }}</strong>
            </span>
        @endif
  </div>
  <div class="column">
    <div class="la17">

    <label for="offer_value17" class="lasd7">@foreach($findoffertype as $fi){{$fi->offer_value_name17}}@endforeach &nbsp;	</label>


        <input id="offer_value17" type="text" class="form-control " name="offer_value17"  value="{{ $data->offer_value17 }}" >
      </div>

        @if ($errors->has('offer_value17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value17') }}</strong>
            </span>
        @endif
</div>
<div class="column">
  <div class="la18">

<label for="offer_value18" class="lasd8">@foreach($findoffertype as $fi){{$fi->offer_value_name18}}@endforeach &nbsp;	</label>


    <input id="offer_value18" type="text" class="form-control " name="offer_value18"  value="{{ $data->offer_value18 }}" >
  </div>

    @if ($errors->has('offer_value18'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value18') }}</strong>
        </span>
    @endif
</div>


@foreach($findoffertype as $fi)
@if($fi->offer_value_name19 != NULL)
<div class="column">
  <div class="la19">

<label for="offer_value19" class="lasd9"> {{$fi->offer_value_name19}} &nbsp;	</label>


<input id="offer_value19" type="text" class="form-control " name="offer_value19"  value="{{$data->offer_value19 }}" >
</div>
@if ($errors->has('offer_value19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value19') }}</strong>
    </span>
@endif

</div>
@else

@endif
@endforeach

@foreach($findoffertype as $fi)
@if($fi->offer_value_name20 != NULL)
<div class="column">
  <div class="la20">

<label for="offer_value20" class="lasd10">{{$fi->offer_value_name20}}&nbsp;	</label>


<input id="offer_value20" type="text" class="form-control " name="offer_value20"  value="{{$data->offer_value20 }}" >
</div>
@if ($errors->has('offer_value20'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value20') }}</strong>
</span>
@endif
</div>
@else

@endif
@endforeach
</div>
@foreach($findoffertype as $fi)
@if($fi->offer_value_name21 != NULL)
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

    <label for="offer_value21" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_value_name21}}@endforeach &nbsp;	</label>


        <input id="offer_value21" type="text" class="form-control" name="offer_value21"  value="{{ $data->offer_value21 }}" >
</div>
        @if ($errors->has('offer_value21'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value21') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="la22">
    <label for="offer_value22" class="lasd7">@foreach($findoffertype as $fi){{$fi->offer_value_name22}}@endforeach &nbsp;	</label>


        <input id="offer_value22" type="text" class="form-control" name="offer_value22"  value="{{$data->offer_value22 }}" >
      </div>
        @if ($errors->has('offer_value22'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value22') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="la23">

<label for="offer_value23" class="lasd8">@foreach($findoffertype as $fi){{$fi->offer_value_name23}}@endforeach &nbsp;	</label>


    <input id="offer_value23" type="text" class="form-control" name="offer_value23"  value="{{ $data->offer_value23 }}" >
</div>
    @if ($errors->has('offer_value23'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value23') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="la24">

<label for="offer_value24" class="lasd9">@foreach($findoffertype as $fi){{$fi->offer_value_name24}}@endforeach &nbsp;	</label>


<input id="offer_value24" type="text" class="form-control " name="offer_value24"  value="{{ $data->offer_value24 }}" >
</div>
@if ($errors->has('offer_value24'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value24') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la25">

<label for="offer_value25" class="lasd10">@foreach($findoffertype as $fi){{$fi->offer_value_name25}}@endforeach &nbsp;	</label>


<input id="offer_value25" type="text" class="form-control " name="offer_value25"  value="{{ $data->offer_value25 }}" >
</div>
@if ($errors->has('offer_value25'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value25') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="la26">

    <label for="offer_value26" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_value_name26}}@endforeach &nbsp;	</label>


        <input id="offer_value26" type="text" class="form-control " name="offer_value26"  value="{{ $data->offer_value26 }}" >
</div>
        @if ($errors->has('offer_value26'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value26') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="la27">

    <label for="offer_value27" class="lasd7">@foreach($findoffertype as $fi){{$fi->offer_value_name27}}@endforeach &nbsp;	</label>


        <input id="offer_value27" type="text" class="form-control " name="offer_value27"  value="{{ $data->offer_value27 }}" >
</div>
        @if ($errors->has('offer_value27'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value27') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="la28">

<label for="offer_value28" class="lasd8">@foreach($findoffertype as $fi){{$fi->offer_value_name28}}@endforeach &nbsp;	</label>


    <input id="offer_value28" type="text" class="form-control " name="offer_value28"  value="{{$data->offer_value28 }}" >
</div>
    @if ($errors->has('offer_value28'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value28') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="la29">

<label for="offer_value29" class="lasd9">@foreach($findoffertype as $fi){{$fi->offer_value_name29}}@endforeach &nbsp;	</label>


<input id="offer_value29" type="text" class="form-control " name="offer_value29"  value="{{ $data->offer_value29 }}" >
</div>
@if ($errors->has('offer_value29'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value29') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la30">

<label for="offer_value30" class="lasd10">@foreach($findoffertype as $fi){{$fi->offer_value_name30}}@endforeach &nbsp;	</label>


<input id="offer_value30" type="text" class="form-control " name="offer_value30"  value="{{ $data->offer_value30 }}" >
</div>
@if ($errors->has('offer_value30'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value30') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="la31">

    <label for="offer_value31" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_value_name31}}@endforeach &nbsp;	</label>


        <input id="offer_value31" type="text" class="form-control" name="offer_value31"  value="{{ $data->offer_value31 }}" >
</div>
        @if ($errors->has('offer_value31'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value31') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="la32">

    <label for="offer_value32" class="lasd7">@foreach($findoffertype as $fi){{$fi->offer_value_name32}}@endforeach &nbsp;	</label>


        <input id="offer_value32" type="text" class="form-control " name="offer_value32"  value="{{ $data->offer_value32 }}" >
</div>
        @if ($errors->has('offer_value32'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value32') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="la33">

<label for="offer_value33" class="lasd8">@foreach($findoffertype as $fi){{$fi->offer_value_name33}}@endforeach &nbsp;	</label>


    <input id="offer_value33" type="text" class="form-control" name="offer_value33"  value="{{ $data->offer_value33 }}" >
</div>
    @if ($errors->has('offer_value33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value33') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="la34">

<label for="offer_value34" class="lasd9">@foreach($findoffertype as $fi){{$fi->offer_value_name34}}@endforeach &nbsp;	</label>


<input id="offer_value34" type="text" class="form-control" name="offer_value34"  value="{{ $data->offer_value34 }}" >
</div>
@if ($errors->has('offer_value34'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value34') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la35">

<label for="offer_value35" class="lasd10">@foreach($findoffertype as $fi){{$fi->offer_value_name35}}@endforeach &nbsp;	</label>


<input id="offer_value35" type="text" class="form-control " name="offer_value35"  value="{{ $data->offer_value35 }}" >
</div>
@if ($errors->has('offer_value35'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value35') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="la36">

    <label for="offer_value36" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_value_name36}}@endforeach &nbsp;	</label>


        <input id="offer_value36" type="text" class="form-control" name="offer_value36"  value="{{ $data->offer_value36 }}" >
</div>
        @if ($errors->has('offer_value36'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value36') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="la37">

    <label for="offer_value37" class="lasd7">@foreach($findoffertype as $fi){{$fi->offer_value_name37}}@endforeach &nbsp;	</label>


        <input id="offer_value37" type="text" class="form-control " name="offer_value37"  value="{{ $data->offer_value37 }}" >
</div>
        @if ($errors->has('offer_value37'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value37') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="la38">

<label for="offer_value38" class="lasd8">@foreach($findoffertype as $fi){{$fi->offer_value_name38}}@endforeach &nbsp;	</label>


    <input id="offer_value38" type="text" class="form-control" name="offer_value38"  value="{{ $data->offer_value38 }}" >
</div>
    @if ($errors->has('offer_value38'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value38') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="la39">

<label for="offer_value39" class="lasd9">@foreach($findoffertype as $fi){{$fi->offer_value_name39}}@endforeach &nbsp;	</label>


<input id="offer_value39" type="text" class="form-control " name="offer_value39"  value="{{$data->offer_value39}}" >
</div>
@if ($errors->has('offer_value39'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value39') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la20">

<label for="offer_value40" class="lasd10">@foreach($findoffertype as $fi){{$fi->offer_value_name40}}@endforeach &nbsp;	</label>


<input id="offer_value40" type="text" class="form-control la40" name="offer_value40"  value="{{ $data->offer_value40 }}" >
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
@else
@endif
@endforeach
@foreach($findoffertype as $fi)
@if($fi->offer_detail_value_name1 != NULL)
<div class="hideofferdetail">

<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Offer Detail</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>


  <div class="box-body">

<div class="row">
  <div class="column">
    <div class="ladetail">

    <label for="offer_detail_value1" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name1}}@endforeach</label>

    <div class="lacamdetail">

        <input id="offer_detail_value1" type="text" class="form-control" name="offer_detail_value1"  value="{{ $data->offer_detail_value1 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value1'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value1') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail2">

    <label for="offer_detail_value2" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name2}}@endforeach</label>

    <div class="lacamdetail2">

        <input id="offer_detail_value2" type="text" class="form-control" name="offer_detail_value2"  value="{{ $data->offer_detail_value2 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value2'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value2') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail3">

    <label for="offer_detail_value3" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name1}}@endforeach</label>

    <div class="lacamdetail3">

        <input id="offer_detail_value3" type="text" class="form-control" name="offer_detail_value3"  value="{{ $data->offer_detail_value3 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value3'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value3') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail4">

    <label for="offer_detail_value4" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name4}}@endforeach</label>

    <div class="lacamdetail4">

        <input id="offer_detail_value4" type="text" class="form-control" name="offer_detail_value4"  value="{{ $data->offer_detail_value4 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value4'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value4') }}</strong>
            </span>
        @endif

  </div>

  <div class="column">
    <div class="ladetail5">

    <label for="offer_detail_value5" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name5}}@endforeach</label>

    <div class="lacamdetail5">

        <input id="offer_detail_value5" type="text" class="form-control" name="offer_detail_value5"  value="{{ $data->offer_detail_value5 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value5'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value5') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail6">

    <label for="offer_detail_value6" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name5}}@endforeach</label>

    <div class="lacamdetail6">

        <input id="offer_detail_value6" type="text" class="form-control" name="offer_detail_value6"  value="{{ $data->offer_detail_value6 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value6'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value6') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail7">

    <label for="offer_detail_value7" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name7}}@endforeach</label>

    <div class="lacamdetail7">

        <input id="offer_detail_value7" type="text" class="form-control" name="offer_detail_value7"  value="{{ $data->offer_detail_value7 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value7'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value7') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail8">

    <label for="offer_detail_value8" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name8}}@endforeach</label>

    <div class="lacamdetail8">

        <input id="offer_detail_value8" type="text" class="form-control" name="offer_detail_value8"  value="{{ $data->offer_detail_value8 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value8'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value8') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail9">

    <label for="offer_detail_value9" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name9}}@endforeach</label>

    <div class="lacamdetail9">

        <input id="offer_detail_value9" type="text" class="form-control" name="offer_detail_value9"  value="{{ $data->offer_detail_value9 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value9'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value9') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail10">

    <label for="offer_detail_value10" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name10}}@endforeach</label>

    <div class="lacamdetail10">

        <input id="offer_detail_value10" type="text" class="form-control" name="offer_detail_value10"  value="{{ $data->offer_detail_value10 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value10'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value10') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail11">

    <label for="offer_detail_value11" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name11}}@endforeach</label>

    <div class="lacamdetail11">

        <input id="offer_detail_value11" type="text" class="form-control" name="offer_detail_value11"  value="{{ $data->offer_detail_value11 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value11'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value11') }}</strong>
            </span>
        @endif

  </div>

  <div class="column">
    <div class="ladetail12">

    <label for="offer_detail_value12" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name12}}@endforeach</label>

    <div class="lacamdetail12">

        <input id="offer_detail_value12" type="text" class="form-control" name="offer_detail_value12"  value="{{ $data->offer_detail_value12 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value12'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value12') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail13">

    <label for="offer_detail_value13" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name13}}@endforeach</label>

    <div class="lacamdetail13">

        <input id="offer_detail_value13" type="text" class="form-control" name="offer_detail_value13"  value="{{ $data->offer_detail_value13 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value13'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value13') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail14">

    <label for="offer_detail_value14" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name14}}@endforeach</label>

    <div class="lacamdetail14">

        <input id="offer_detail_value14" type="text" class="form-control" name="offer_detail_value14"  value="{{ $data->offer_detail_value14 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value14'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value14') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail15">

    <label for="offer_detail_value15" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name15}}@endforeach</label>

    <div class="lacamdetail15">

        <input id="offer_detail_value15" type="text" class="form-control" name="offer_detail_value15"  value="{{ $data->offer_detail_value15 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value15'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value15') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail16">

    <label for="offer_detail_value16" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name16}}@endforeach</label>

    <div class="lacamdetail16">

        <input id="offer_detail_value16" type="text" class="form-control" name="offer_detail_value16"  value="{{ $data->offer_detail_value16 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value16') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail17">

    <label for="offer_detail_value17" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name17}}@endforeach</label>

    <div class="lacamdetail17">

        <input id="offer_detail_value17" type="text" class="form-control" name="offer_detail_value17"  value="{{ $data->offer_detail_value17 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value17') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail18">

    <label for="offer_detail_value18" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name18}}@endforeach</label>

    <div class="lacamdetail18">

        <input id="offer_detail_value18" type="text" class="form-control" name="offer_detail_value18"  value="{{ $data->offer_detail_value18 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value18'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value18') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail19">

    <label for="offer_detail_value19" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name19}}@endforeach</label>

    <div class="lacamdetail19">

        <input id="offer_detail_value19" type="text" class="form-control" name="offer_detail_value19"  value="{{ $data->offer_detail_value19 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value19'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value19') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail20">

    <label for="offer_detail_value20" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name20}}@endforeach</label>

    <div class="lacamdetail20">

        <input id="offer_detail_value20" type="text" class="form-control" name="offer_detail_value20"  value="{{ $data->offer_detail_value20 }}" >
</div>
</div>

        @if ($errors->has('offer_detail_value20'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value20') }}</strong>
            </span>
        @endif

  </div>
</div>
</div>
</div>
</div>
@else
@endif
@endforeach
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

    <label for="offer_payment_value1" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name1}}@endforeach &nbsp;	</label>


        <input id="offer_payment_value1" onKeyUp="chgtext()" type="text" class="form-control" name="offer_payment_value1"  value="{{ $data->offer_payment_value1 }}" >
</div>
        @if ($errors->has('offer_payment_value1'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value1') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay2">
    <label for="offer_payment_value2" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name2}}@endforeach &nbsp;	</label>


        <input id="offer_payment_value2" type="text" onKeyUp="chgtext()" class="form-control" name="offer_payment_value2"  value="{{ $data->offer_payment_value2 }}" >
      </div>
        @if ($errors->has('offer_payment_value2'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value2') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay3">

<label for="offer_payment_value3" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name3}}@endforeach &nbsp;	</label>


    <input id="offer_payment_value3" type="text" class="form-control" name="offer_payment_value3" onKeyUp="chgtext()" value="{{ $data->offer_payment_value3 }}" >
</div>
    @if ($errors->has('offer_payment_value3'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value3') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay4">

<label for="offer_payment_value4" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name4}}@endforeach &nbsp;	</label>


<input id="offer_payment_value4" type="text" readonly class="form-control " name="offer_payment_value4"  value="{{ $data->offer_payment_value4 }}" >
</div>
@if ($errors->has('offer_payment_value4'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value4') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay5">

<label style="margin-top:-3px"for="offer_payment_value5" class="checkbox">
<input type="checkbox" id="checkoff5" value="1" onclick="chgtext()" {{  $data->offer_payment_value5 != NULL && $data->offer_payment_value5 != 0  ? 'checked' : '' }}/>@foreach($findoffertype as $fi){{$fi->offer_payment_name5}}@endforeach</label>
<input id="offer_payment_value5" readonly onKeyUp="chgtext()" type="text" class="form-control " readonly name="offer_payment_value5" value="{{ $data->offer_payment_value5 }}" ></div>
@if ($errors->has('offer_payment_value5'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value5') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="lapay6">

    <label for="offer_payment_value6" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name6}}@endforeach &nbsp;	</label>


        <select  id="offer_payment_value6" class="form-control" onchange="chgtext()" name="offer_payment_value6">
          <option value="0"{{$data->offer_payment_value6 == 0 ? 'selected' : ''}}>-เลือกหมวดการคำนวณ-</option>
          <option value="1"{{$data->offer_payment_value6 == 1 ? 'selected' : ''}}>อัตราค่าอัตราค่าคอมมิชชั่น</option>
          <option value="2"{{$data->offer_payment_value6 == 2 ? 'selected' : ''}}>ค่าคอมมิชชั่นที่แจ้ง</option>
          <option value="3"{{$data->offer_payment_value6 == 3 ? 'selected' : ''}}>เบี้ยนำจ่ายก่อนหักภาษี</option>
          </select>
</div>
        @if ($errors->has('offer_payment_value6'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value6') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay7">

    <label for="offer_payment_value7" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name7}}@endforeach &nbsp;	</label>


        <input id="offer_payment_value7" type="text" class="form-control "  onKeyUp="chgtext()" name="offer_payment_value7"  value="{{ $data->offer_payment_value7 }}" >
</div>
        @if ($errors->has('offer_payment_value7'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value7') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay8">

<label for="offer_payment_value8" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name8}}@endforeach &nbsp;	</label>


    <input id="offer_payment_value8" type="text" class="form-control " readonly name="offer_payment_value8"  value="{{ $data->offer_payment_value8 }}" >
</div>
    @if ($errors->has('offer_payment_value8'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value8') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay9">

<label for="offer_payment_value9" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name9}}@endforeach &nbsp;	</label>


<input id="offer_payment_value9" type="text" class="form-control " readonly name="offer_payment_value9"  value="{{ $data->offer_payment_value9 }}" >
</div>
@if ($errors->has('offer_payment_value9'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value9') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay10">

<label for="offer_payment_value10" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name10}}@endforeach &nbsp;	</label>


<input id="offer_payment_value10" type="text" class="form-control " readonly  name="offer_payment_value10"  value="{{ $data->offer_payment_value10 }}" >
</div>
@if ($errors->has('offer_payment_value10'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value10') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="lapay11">

    <label for="offer_payment_value11" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name11}}@endforeach &nbsp;	</label>


        <input id="offer_payment_value11" type="text" class="form-control"  readonly name="offer_payment_value11" readonly value="{{ $data->offer_payment_value11 }}" >
</div>
        @if ($errors->has('offer_payment_value11'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value11') }}</strong>
            </span>
        @endif

  </div>
  <div class="row">

  <div class="column">
    &nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;
  </div>

</div>
  <div class="column">
    <div class="lapay12">

    <label for="offer_payment_value12" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name12}}@endforeach &nbsp;	</label>


        <input id="offer_payment_value12" type="text" class="form-control " readonly name="offer_payment_value12"  value="{{ $data->offer_payment_value12 }}" >
</div>
        @if ($errors->has('offer_payment_value12'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value12') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay13">

<label for="offer_payment_value13" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name13}}@endforeach &nbsp;	</label>


    <input id="offer_payment_value13" type="text" class="form-control" readonly name="offer_payment_value13"  value="{{ $data->offer_payment_value13 }}" >
</div>
    @if ($errors->has('offer_payment_value33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value13') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay14">

<label for="offer_payment_value34" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name14}}@endforeach &nbsp;	 </label>


<input id="offer_payment_value14" type="text" class="form-control" onKeyUp="chgtext()" name="offer_payment_value14"  value="{{ $data->offer_payment_value14 }}" >
</div>
@if ($errors->has('offer_payment_value14'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value14') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay15">

<label for="offer_payment_value15" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name15}}@endforeach &nbsp;	</label>


<input id="offer_payment_value15" type="text" class="form-control " name="offer_payment_value15"  value="{{ $data->offer_payment_value15 }}" >
</div>
@if ($errors->has('offer_payment_value15'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value15') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="lapay16">

    <label for="offer_payment_value16" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name16}}@endforeach &nbsp;	</label>

    <div class="input-group date">
        <input id="offer_payment_value16" type="text" class="form-control" onKeyUp="chgtext()" name="offer_payment_value16"  value="{{ $data->offer_payment_value16 }}" >
      <div class="input-group-addon"> <span class="partnerquota"></span></div></div></div>
        @if ($errors->has('offer_payment_value16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value16') }}</strong>
            </span>
        @endif


</div>
  <div class="column">
    <div class="lapay17">

    <label for="offer_payment_value17" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name17}}@endforeach &nbsp;	</label>


        <input id="offer_payment_value17" type="text" class="form-control " name="offer_payment_value17"  value="{{ $data->offer_payment_value17 }}" >
</div>
        @if ($errors->has('offer_payment_value17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value17') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay18">

<label for="offer_payment_value18" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name18}}@endforeach &nbsp;	</label>

<div class="input-group date">
    <input id="offer_payment_value18" type="text" class="form-control" name="offer_payment_value18" onKeyUp="chgtext()" value="{{ $data->offer_payment_value18 }}" >
  <div class="input-group-addon"> <span class="userquota"></span></div></div>
</div>
    @if ($errors->has('offer_payment_value18'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value18') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay19">

<label for="offer_payment_value19" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name19}}@endforeach &nbsp;	</label>


<input id="offer_payment_value19" type="text" class="form-control " readonly name="offer_payment_value19"  value="{{ $data->offer_payment_value19 }}" >
</div>
@if ($errors->has('offer_payment_value19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value19') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay20">

<label for="offer_payment_value20" class="lapaysd20">@foreach($findoffertype as $fi){{$fi->offer_payment_name20}}@endforeach &nbsp;	</label>


<input id="offer_payment_value20" type="text" class="form-control la20" name="offer_payment_value20" onKeyUp="chgtext()" value="{{ $data->offer_payment_value20 }}" >
</div>
@if ($errors->has('offer_payment_value20'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value20') }}</strong>
</span>
@endif

</div>
<div class="column">
  <div class="lapay21">

  <label for="offer_payment_value21" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name21}}@endforeach &nbsp;	</label>


      <input id="offer_payment_value21" type="text" class="form-control" name="offer_payment_value21"  value="{{ $data->offer_payment_value21 }}" >
</div>
      @if ($errors->has('offer_payment_value21'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value21') }}</strong>
          </span>
      @endif

</div>
@foreach($findoffertype as $fi)
@if($fi->offer_payment_name22 != NULL)
<div class="column">
  <div class="lapay22">
  <label for="offer_payment_value22" class="lapaysd7">{{$fi->offer_payment_name22}}	</label>


      <input id="offer_payment_value22" type="text" class="form-control" name="offer_payment_value22"  value="{{ $data->offer_payment_value22 }}" >
    </div>
      @if ($errors->has('offer_payment_value22'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value22') }}</strong>
          </span>
      @endif

</div>
<div class="column">
<div class="lapay23">

<label for="offer_payment_value23" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name23}}@endforeach &nbsp;	</label>


  <input id="offer_payment_value23" type="text" class="form-control" name="offer_payment_value23"  value="{{ $data->offer_payment_value23 }}" >
</div>
  @if ($errors->has('offer_payment_value23'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value23') }}</strong>
      </span>
  @endif

</div>



<div class="column">
<div class="lapay24">

<label for="offer_payment_value24" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name24}}@endforeach &nbsp;	</label>


<input id="offer_payment_value24" type="text" class="form-control " name="offer_payment_value24"  value="{{ $data->offer_payment_value24 }}" >
</div>
@if ($errors->has('offer_payment_value24'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value24') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay25">

<label for="offer_payment_value25" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name25}}@endforeach &nbsp;	</label>


<input id="offer_payment_value25" type="text" class="form-control " name="offer_payment_value25"  value="{{ $data->offer_payment_value25 }}" >
</div>
@if ($errors->has('offer_payment_value25'))
<span class="help-block">
  <strong>{{ $errors->first('offer_payment_value25') }}</strong>
</span>
@endif

</div>


<div class="column">
  <div class="lapay26">

  <label for="offer_payment_value26" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name26}}@endforeach &nbsp;	</label>


      <input id="offer_payment_value26" type="text" class="form-control " name="offer_payment_value26"  value="{{ $data->offer_payment_value26 }}" >
</div>
      @if ($errors->has('offer_payment_value26'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value26') }}</strong>
          </span>
      @endif

</div>
<div class="column">
  <div class="lapay27">

  <label for="offer_payment_value27" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name27}}@endforeach &nbsp;	</label>


      <input id="offer_payment_value27" type="text" class="form-control " name="offer_payment_value27"  value="{{ $data->offer_payment_value27 }}" >
</div>
      @if ($errors->has('offer_payment_value27'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value27') }}</strong>
          </span>
      @endif

</div>
<div class="column">
<div class="lapay28">

<label for="offer_payment_value28" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name28}}@endforeach &nbsp;	</label>


  <input id="offer_payment_value28" type="text" class="form-control " name="offer_payment_value28"  value="{{ $data->offer_payment_value28 }}" >
</div>
  @if ($errors->has('offer_payment_value28'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value28') }}</strong>
      </span>
  @endif

</div>



<div class="column">
<div class="lapay29">

<label for="offer_payment_value29" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name29}}@endforeach &nbsp;	</label>


<input id="offer_payment_value29" type="text" class="form-control " name="offer_payment_value29"  value="{{ $data->offer_payment_value29 }}" >
</div>
@if ($errors->has('offer_payment_value29'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value29') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay30">

<label for="offer_payment_value30" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name30}}@endforeach &nbsp;	</label>


<input id="offer_payment_value30" type="text" class="form-control " name="offer_payment_value30"  value="{{ $data->offer_payment_value30 }}" >
</div>
@if ($errors->has('offer_payment_value30'))
<span class="help-block">
  <strong>{{ $errors->first('offer_payment_value30') }}</strong>
</span>
@endif

</div>


<div class="column">
  <div class="lapay31">

  <label for="offer_payment_value31" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name31}}@endforeach &nbsp;	</label>


      <input id="offer_payment_value31" type="text" class="form-control" name="offer_payment_value31"  value="{{ $data->offer_payment_value31 }}" >
</div>
      @if ($errors->has('offer_payment_value31'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value31') }}</strong>
          </span>
      @endif

</div>
<div class="column">
  <div class="lapay32">

  <label for="offer_payment_value32" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name32}}@endforeach &nbsp;	</label>


      <input id="offer_payment_value32" type="text" class="form-control " name="offer_payment_value32"  value="{{ $data->offer_payment_value32 }}" >
</div>
      @if ($errors->has('offer_payment_value32'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value32') }}</strong>
          </span>
      @endif

</div>
<div class="column">
<div class="lapay33">

<label for="offer_payment_value33" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name33}}@endforeach &nbsp;	</label>


  <input id="offer_payment_value33" type="text" class="form-control" name="offer_payment_value33"  value="{{ $data->offer_payment_value33 }}" >
</div>
  @if ($errors->has('offer_payment_value33'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value33') }}</strong>
      </span>
  @endif

</div>



<div class="column">
<div class="lapay34">

<label for="offer_payment_value34" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name34}}@endforeach &nbsp;	</label>


<input id="offer_payment_value34" type="text" class="form-control" name="offer_payment_value34"  value="{{ $data->offer_payment_value34 }}" >
</div>
@if ($errors->has('offer_payment_value34'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value34') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay35">

<label for="offer_payment_value35" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name35}}@endforeach &nbsp;	</label>


<input id="offer_payment_value35" type="text" class="form-control " name="offer_payment_value35"  value="{{ $data->offer_payment_value35 }}" >
</div>
@if ($errors->has('offer_payment_value35'))
<span class="help-block">
  <strong>{{ $errors->first('offer_payment_value35') }}</strong>
</span>
@endif

</div>


<div class="column">
  <div class="lapay36">

  <label for="offer_payment_value36" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name36}}@endforeach &nbsp;	</label>


      <input id="offer_payment_value36" type="text" class="form-control" name="offer_payment_value36"  value="{{ $data->offer_payment_value36 }}" >
</div>
      @if ($errors->has('offer_payment_value36'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value36') }}</strong>
          </span>
      @endif

</div>
<div class="column">
  <div class="lapay37">

  <label for="offer_payment_value37" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name37}}@endforeach &nbsp;	</label>


      <input id="offer_payment_value37" type="text" class="form-control " name="offer_payment_value37"  value="{{ $data->offer_payment_value37 }}" >
</div>
      @if ($errors->has('offer_payment_value37'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value37') }}</strong>
          </span>
      @endif

</div>
<div class="column">
<div class="lapay38">

<label for="offer_payment_value38" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name38}}@endforeach &nbsp;	</label>


  <input id="offer_payment_value38" type="text" class="form-control" name="offer_payment_value38"  value="{{ $data->offer_payment_value38 }}" >
</div>
  @if ($errors->has('offer_payment_value38'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value38') }}</strong>
      </span>
  @endif

</div>



<div class="column">
<div class="lapay39">

<label for="offer_payment_value39" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name39}}@endforeach &nbsp;	</label>


<input id="offer_payment_value39" type="text" class="form-control " name="offer_payment_value39"  value="{{ $data->offer_payment_value39 }}" >
</div>
@if ($errors->has('offer_payment_value39'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value39') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay40">

<label for="offer_payment_value40" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name40}}@endforeach &nbsp;	</label>


<input id="offer_payment_value40" type="text" class="form-control la40" name="offer_payment_value40"  value="{{ $data->offer_payment_value40 }}" >
</div>
@if ($errors->has('offer_payment_value40'))
<span class="help-block">
  <strong>{{ $errors->first('offer_payment_value40') }}</strong>
</span>
@endif

</div>
@else
@endif
@endforeach
</div>

<div style="overflow-x:auto;">
    <table style="border: solid 3px #00325d;"id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
        <tr role="row"  >
          <th style="background-color: #00325d;color:white">หัวข้อ</th>
          <th style="background-color: #00325d;color:white">จำนวน</th>


        </tr>

      </thead>
    <tbody>
      <tr role="row" class="odd">
        <th>เบี้ยรวมหน้าตั๋ว</th>
        <td><input class="form-control" readonly id="lastshow1" value="{{$offerpaymentpremium}}"/></td>
      </tr>
      <tr role="row" class="odd">
        <th>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
        <td><input class="form-control" readonly id="lastshow2" value="{{$offerpaymenttaxdeduction}}"/></td>
      </tr>
      <tr role="row" class="odd">
        <th>ส่วนลดพิเศษทั้งหมด </th>
        <td><input class="form-control" readonly id="lastshow3" value="{{$alldiscount}}"/></td>
      </tr>
      <tr role="row" class="odd">
        <th>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
        <td><input class="form-control" readonly id="lastshow4"value="{{$calculatebeforetaxdeduct}}"/></td>
      </tr>
      <tr role="row" class="odd">
        <th>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
        <td><input class="form-control" readonly id="lastshow5" value="{{$calculateaftertaxdeduct}}"/></td>
      </tr>
      <tr role="row" class="odd">
        <th>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
        <td><input class="form-control" readonly id="lastshow6" value="{{$totalpaidpartner}}"/></td>
      </tr>
      <tr role="row" class="odd">
        <th>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) /(เบี้ยที่ผู้แจ้งงานต้องโอนเดิม)</th>
        <td><input class="form-control" readonly id="lastshow7" value="{{$totalpaiduser}}"/></td>
      </tr>
      <tr role="row" class="odd">
        <th>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company)</th>
        <td><input class="form-control" readonly id="lastshow8" value="{{$totalpaidcompany}}"/></td>
      </tr>
    </tbody>
  </table>
</div>
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
            //  //console.logg("hmm its change");

                var department_id=$(this).val();
                ////console.logg(department_id);
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
                var opdetail=" ";
                var opdetail2=" ";
                var opdetail3=" ";
                var opdetail4=" ";
                var opdetail5=" ";
                var opdetail6=" ";
                var opdetail7=" ";
                var opdetail8=" ";
                var opdetail9=" ";
                var opdetail10=" ";
                var opdetail11=" ";
                var opdetail12=" ";
                var opdetail13=" ";
                var opdetail14=" ";
                var opdetail15=" ";
                var opdetail16=" ";
                var opdetail17=" ";
                var opdetail18=" ";
                var opdetail19=" ";
                var opdetail20=" ";

                var hideoffer21_40=" ";
                var hideofferdetail=" ";
                var hideofferpayment=" ";


                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findOfferType')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      //console.logg('success');



                     //console.logg(data.length);

                      for(var i=0; i<data.length;i++){
                      //  op+='<label value="'+data[i].con_para_name1+'">'+data[i].con_para_name1+'</label>';
                      //console.logg(data[i].offer_payment_name1);
                        //op+='<input id="offer_value1" type="text" class="form-control " name="offer_value1" value="'+data[i].offer_value_name1+'" >';
                        if(data[i].offer_value_name1 != null)
                        {
                        op+='<div class="la"><label for="offer_value1" class="lasd">'+data[i].offer_value_name1+'</label><div class="lacam"><input id="offer_value1" type="text" class="form-control " name="offer_value1" value="" ></div></div>';
                        }
                        else{
                          op+='';
                        }
                        if(data[i].offer_value_name2 != null)
                        {
                          op2+='<div><label for="offer_value2" class="lasd">'+data[i].offer_value_name2+'</label><div class="lacam2"><input id="offer_value2" type="text" class="form-control " name="offer_value2" value="" ></div></div>';
                        }

                        else{
                          op2+='';

                        }
                        if(data[i].offer_value_name3 != null)
                        {
                          op3+='<div><label for="offer_value3" class="lasd">'+data[i].offer_value_name3+'</label><div class="lacam3"><input id="offer_value3" type="text" class="form-control " name="offer_value3" value="{{ old('offer_value3') }}" ></div></div>';
                        }
                        else{
                          op3+='';
                        }
                        if(data[i].offer_value_name4 != null)
                        {
                          op4+='<div><label for="offer_value4" class="lasd">'+data[i].offer_value_name4+'</label><div class="lacam4"><input id="offer_value4" type="text" class="form-control " name="offer_value4" value="{{ old('offer_value4') }}" ></div></div>';
                        }
                        else{
                          op4+='';

                        }
                        if(data[i].offer_value_name5 != null)
                        {
                          op5+='<div><label for="offer_value5" class="lasd">'+data[i].offer_value_name5+'</label><div class="lacam5"><input id="offer_value5" type="text" class="form-control " name="offer_value5" value="{{ old('offer_value5') }}" ></div></div>';
                        }
                        else{
                          op5+='';

                        }
                        if(data[i].offer_value_name6 != null)
                        {
                          op6+='<div><label for="offer_value6" class="lasd">'+data[i].offer_value_name6+'</label><div class="lacam6"><input id="offer_value6" type="text" class="form-control " name="offer_value6" value="{{ old('offer_value6') }}" ></div></div>';
                        }
                        else{
                          op6+='';
                        }
                        if(data[i].offer_value_name7 != null)
                        {
                          op7+='<div><label for="offer_value7" class="lasd">'+data[i].offer_value_name7+'</label><div class="lacam7"><input id="offer_value7" type="text" class="form-control " name="offer_value7" value="{{ old('offer_value7') }}" ></div></div>';
                        }
                        else{
                          op7+='';

                        }
                        if(data[i].offer_value_name8 != null)
                        {
                          op8+='<div><label for="offer_value8" class="lasd">'+data[i].offer_value_name8+'</label><div class="lacam8"><input id="offer_value8" type="text" class="form-control " name="offer_value8" value="{{ old('offer_value8') }}" ></div></div>';
                        }
                        else {
                          op8+='';
                        }
                        if(data[i].offer_value_name9 != null)
                        {
                          op9+='<div><label for="offer_value9" class="lasd">'+data[i].offer_value_name9+'</label><div class="lacam9"><input id="offer_value9" type="text" class="form-control " name="offer_value9" value="{{ old('offer_value9') }}" ></div></div>';
                        }
                        else{
                          op9+='';
                        }
                        if(data[i].offer_value_name10 != null)
                        {
                          op10+='<div><label for="offer_value10" class="lasd">'+data[i].offer_value_name10+'</label><div class="lacam10"><input id="offer_value10" type="text" class="form-control " name="offer_value10" value="{{ old('offer_value10') }}" ></div></div>';
                        }
                        else {
                          op10+='';
                        }
                        if(data[i].offer_value_name11 != null)
                        {
                          op11+='<div><label for="offer_value11" class="lasd">'+data[i].offer_value_name11+'</label><div class="lacam11"><input id="offer_value11" type="text" class="form-control " name="offer_value11" value="{{ old('offer_value11') }}" ></div></div>';
                        }
                        else{
                          op11+='';

                        }
                        if(data[i].offer_value_name12 != null)
                        {
                          op12+='<div><label for="offer_value12" class="lasd">'+data[i].offer_value_name12+'</label><div class="lacam12"><input id="offer_value12" type="text" class="form-control " name="offer_value12" value="{{ old('offer_value12') }}" ></div></div>';
                        }
                        else {
                          op12+='';
                        }
                        if(data[i].offer_value_name13 != null)
                        {
                          op13+='<div><label for="offer_value13" class="lasd">'+data[i].offer_value_name13+'</label><div class="lacam13"><input id="offer_value13" type="text" class="form-control " name="offer_value13" value="{{ old('offer_value13') }}" ></div></div>';
                        }
                        else{
                          op13+='';
                        }
                        if(data[i].offer_value_name14 != null)
                        {
                          op14+='<div><label for="offer_value14" class="lasd">'+data[i].offer_value_name14+'</label><div class="lacam14"><input id="offer_value14" type="text" class="form-control " name="offer_value14" value="{{ old('offer_value14') }}" ></div></div>';
                        }
                        else{
                          op14+='';
                        }
                        if(data[i].offer_value_name15 != null)
                        {
                          op15+='<div><label for="offer_value15" class="lasd">'+data[i].offer_value_name15+'</label><div class="lacam15"><input id="offer_value15" type="text" class="form-control " name="offer_value15" value="{{ old('offer_value15') }}" ></div></div>';
                        }
                        else {
                          op15+='';
                        }
                        if(data[i].offer_value_name16 != null)
                        {
                          op16+='<div><label for="offer_value16" class="lasd">'+data[i].offer_value_name16+'</label><div class="lacam16"><input id="offer_value16" type="text" class="form-control " name="offer_value16" value="{{ old('offer_value16') }}" ></div></div>';
                        }
                        else{
                          op16+='';
                        }
                        if(data[i].offer_value_name17 != null)
                        {
                          op17+='<div><label for="offer_value17" class="lasd">'+data[i].offer_value_name17+'</label><div class="lacam17"><input id="offer_value17" type="text" class="form-control " name="offer_value17" value="{{ old('offer_value17') }}" ></div></div>';
                        }
                        else{
                          op17+='';
                        }
                        if(data[i].offer_value_name18 != null)
                        {
                          op18+='<div><label for="offer_value18" class="lasd">'+data[i].offer_value_name18+'</label><div class="lacam18"><input id="offer_value18" type="text" class="form-control " name="offer_value18" value="{{ old('offer_value18') }}" ></div></div>';
                        }
                        else
                        {
                        op18+='';
                      }
                      if(data[i].offer_value_name19 != null)
                      {
                        op19+='<div><label for="offer_value19" class="lasd">'+data[i].offer_value_name19+'</label><div class="lacam19"><input id="offer_value19" type="text" class="form-control " name="offer_value19" value="{{ old('offer_value19') }}" ></div></div>';
                      }
                      else{
                        op19+='';
                      }
                      if(data[i].offer_value_name20 != null)
                      {
                        op20+='<div><label for="offer_value20" class="lasd">'+data[i].offer_value_name20+'</label><div class="lacam20"><input id="offer_value20" type="text" class="form-control " name="offer_value20" value="{{ old('offer_value20') }}" ></div></div>';
                      }
                      else{
                        op20+='';
                      }
                      if(data[i].offer_value_name21 != null)
                      {
                        op21+='<div><label for="offer_value21" class="lasd">'+data[i].offer_value_name21+'</label><div class="lacam21"><input id="offer_value21" type="text" class="form-control " name="offer_value21" value="{{ old('offer_value21') }}" ></div></div>';
                      }
                      else{
                        op21+='';
                        hideoffer21_40+='';
                        $('.hideoffer21-40').html(" ");

                      }

                      if(data[i].offer_value_name22 != null)
                      {
                        op22+='<div><label for="offer_value22" class="lasd">'+data[i].offer_value_name22+'</label><div class="lacam22"><input id="offer_value22" type="text" class="form-control " name="offer_value22" value="{{ old('offer_value22') }}" ></div></div>';
                      }
                      else{
                        op22+='';
                      }

                      if(data[i].offer_value_name23 != null)
                      {
                        op23+='<div><label for="offer_value23" class="lasd">'+data[i].offer_value_name23+'</label><div class="lacam23"><input id="offer_value23" type="text" class="form-control " name="offer_value23" value="{{ old('offer_value23') }}" ></div></div>';
                      }
                      else{
                        op23+='';
                      }
                      if(data[i].offer_value_name24 != null)
                      {
                        op24+='<div><label for="offer_value24" class="lasd">'+data[i].offer_value_name24+'</label><div class="lacam24"><input id="offer_value24" type="text" class="form-control " name="offer_value24" value="{{ old('offer_value24') }}" ></div></div>';
                      }
                      else{
                        op24+='';
                      }

                      if(data[i].offer_value_name25 != null)
                      {
                        op25+='<div><label for="offer_value25" class="lasd">'+data[i].offer_value_name25+'</label><div class="lacam25"><input id="offer_value25" type="text" class="form-control " name="offer_value25" value="{{ old('offer_value25') }}" ></div></div>';
                      }
                      else{
                        op25+='';
                      }

                      if(data[i].offer_value_name26 != null)
                      {
                        op26+='<div><label for="offer_value26" class="lasd">'+data[i].offer_value_name26+'</label><div class="lacam26"><input id="offer_value26" type="text" class="form-control " name="offer_value26" value="{{ old('offer_value26') }}" ></div></div>';
                      }
                      else{
                        op26+='';
                      }

                      if(data[i].offer_value_name27 != null)
                      {
                        op27+='<div><label for="offer_value27" class="lasd">'+data[i].offer_value_name27+'</label><div class="lacam27"><input id="offer_value27" type="text" class="form-control " name="offer_value27" value="{{ old('offer_value27') }}" ></div></div>';
                      }
                      else{
                        op27+='';
                      }

                      if(data[i].offer_value_name28 != null)
                      {
                        op28+='<div><label for="offer_value28" class="lasd">'+data[i].offer_value_name28+'</label><div class="lacam28"><input id="offer_value28" type="text" class="form-control " name="offer_value28" value="{{ old('offer_value28') }}" ></div></div>';
                      }
                      else{
                        op28+='';
                      }

                      if(data[i].offer_value_name29 != null)
                      {
                        op29+='<div><label for="offer_value29" class="lasd">'+data[i].offer_value_name29+'</label><div class="lacam29"><input id="offer_value29" type="text" class="form-control " name="offer_value29" value="{{ old('offer_value29') }}" ></div></div>';
                      }
                      else{
                        op29+='';
                      }
                      if(data[i].offer_value_name30 != null)
                      {
                        op30+='<div><label for="offer_value30" class="lasd">'+data[i].offer_value_name30+'</label><div class="lacam30"><input id="offer_value30" type="text" class="form-control " name="offer_value30" value="{{ old('offer_value30') }}" ></div></div>';
                      }
                      else{
                        op30+='';
                      }

                      if(data[i].offer_value_name31 != null)
                      {
                        op31+='<div><label for="offer_value31" class="lasd">'+data[i].offer_value_name31+'</label><div class="lacam31"><input id="offer_value31" type="text" class="form-control " name="offer_value31" value="{{ old('offer_value31') }}" ></div></div>';
                      }
                      else{
                        op31+='';
                      }

                      if(data[i].offer_value_name32 != null)
                      {
                        op32+='<div><label for="offer_value32" class="lasd">'+data[i].offer_value_name32+'</label><div class="lacam32"><input id="offer_value32" type="text" class="form-control " name="offer_value32" value="{{ old('offer_value32') }}" ></div></div>';
                      }
                      else{
                        op32+='';
                      }

                      if(data[i].offer_value_name33 != null)
                      {
                        op33+='<div><label for="offer_value33" class="lasd">'+data[i].offer_value_name33+'</label><div class="lacam33"><input id="offer_value33" type="text" class="form-control " name="offer_value33" value="{{ old('offer_value33') }}" ></div></div>';
                      }
                      else{
                        op33+='';
                      }

                      if(data[i].offer_value_name34 != null)
                      {
                        op34+='<div><label for="offer_value34" class="lasd">'+data[i].offer_value_name34+'</label><div class="lacam34"><input id="offer_value34" type="text" class="form-control " name="offer_value34" value="{{ old('offer_value34') }}" ></div></div>';
                      }
                      else{
                        op34+='';
                      }

                      if(data[i].offer_value_name35 != null)
                      {
                        op35+='<div><label for="offer_value35" class="lasd">'+data[i].offer_value_name35+'</label><div class="lacam35"><input id="offer_value35" type="text" class="form-control " name="offer_value35" value="{{ old('offer_value35') }}" ></div></div>';
                      }
                      else{
                        op35+='';
                      }

                      if(data[i].offer_value_name36 != null)
                      {
                        op36+='<div><label for="offer_value36" class="lasd">'+data[i].offer_value_name36+'</label><div class="lacam36"><input id="offer_value36" type="text" class="form-control " name="offer_value36" value="{{ old('offer_value36') }}" ></div></div>';
                      }
                      else{
                        op36+='';
                      }

                      if(data[i].offer_value_name37 != null)
                      {
                        op37+='<div><label for="offer_value37" class="lasd">'+data[i].offer_value_name37+'</label><div class="lacam37"><input id="offer_value37" type="text" class="form-control " name="offer_value37" value="{{ old('offer_value37') }}" ></div></div>';
                      }
                      else{
                        op37+='';
                      }

                      if(data[i].offer_value_name38 != null)
                      {
                        op38+='<div><label for="offer_value38" class="lasd">'+data[i].offer_value_name38+'</label><div class="lacam38"><input id="offer_value38" type="text" class="form-control " name="offer_value38" value="{{ old('offer_value38') }}" ></div></div>';
                      }
                      else{
                        op38+='';
                      }

                      if(data[i].offer_value_name39 != null)
                      {
                        op39+='<div><label for="offer_value39" class="lasd">'+data[i].offer_value_name39+'</label><div class="lacam39"><input id="offer_value39" type="text" class="form-control " name="offer_value39" value="{{ old('offer_value39') }}" ></div></div>';
                      }
                      else{
                        op39+='';
                      }

                      if(data[i].offer_value_name40 != null)
                      {
                        op40+='<div><label for="offer_value40" class="lasd">'+data[i].offer_value_name40+'</label><div class="lacam40"><input id="offer_value40" type="text" class="form-control " name="offer_value40" value="{{ old('offer_value40') }}" ></div></div>';
                      }
                      else{
                        op40+='';
                      }

                      if(data[i].offer_payment_name1 != null)
                      {
                      oppay+='<div><label for="offer_payment_value1" class="lasd">'+data[i].offer_payment_name1+'</label><div class="lacampay"><input id="offer_payment_value1"  onKeyUp="chgtext()"type="text" class="form-control " name="offer_payment_value1"  value="{{ old('offer_payment_value1') }}" ></div></div>';
                      }
                      else{
                        oppay+='';
                        hideofferpayment+='';
                        $('.hideofferpayment').html(" ");

                      }
                      if(data[i].offer_payment_name2 != null)
                      {
                        oppay2+='<div><label for="offer_payment_value2" class="lasd">'+data[i].offer_payment_name2+'</label><div class="lacampay2"><input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control " name="offer_payment_value2" value="{{ old('offer_payment_value2') }}" ></div></div>';
                      }

                      else{
                        oppay2+='';

                      }
                      if(data[i].offer_payment_name3 != null)
                      {
                        oppay3+='<div><label for="offer_payment_value3" class="lasd">'+data[i].offer_payment_name3+'</label><div class="lacampay3"><input id="offer_payment_value3"  onKeyUp="chgtext()"type="text" class="form-control " name="offer_payment_value3" value="{{ old('offer_payment_value3') }}" ></div></div>';
                      }
                      else{
                        oppay3+='';
                      }
                      if(data[i].offer_payment_name4 != null)
                      {
                        oppay4+='<div><label for="offer_payment_value4" class="lasd">'+data[i].offer_payment_name4+'</label><div class="lacampay4"><input id="offer_payment_value4" readonly onKeyUp="chgtext()" type="text" class="form-control " name="offer_payment_value4" value="{{ old('offer_payment_value4') }}" ></div></div>';
                      }
                      else{
                        oppay4+='';

                      }
                      if(data[i].offer_payment_name5 != null)
                      {
                        oppay5+='<div><label style="margin-top:-3px"for="offer_payment_value5" class="checkbox"><input type="checkbox" id="checkoff5" value="1" onclick="chgtext()"/>'+data[i].offer_payment_name5+'</label><div class="lacampay5"><input id="offer_payment_value5" readonly onKeyUp="chgtext()" type="text" class="form-control " readonly name="offer_payment_value5" value="{{ old('offer_payment_value5') }}" ></div></div>';
                      }
                      else{
                        oppay5+='';

                      }
                      if(data[i].offer_payment_name6 != null)
                      {
                        oppay6+='<div><label for="offer_payment_value6" class="lasd">'+data[i].offer_payment_name6+'</label><div class="lacampay6"><select id="offer_payment_value6" class="form-control" onchange="chgtext()"><option value="0">-เลือกหมวดการคำนวณ-</option><option value="1">อัตราค่าคอมมิชชั่น</option><option value="2">ค่าคอมมิชชั่นที่แจ้ง</option><option value="3">เบี้ยนำจ่ายก่อนหักภาษี ณ ที่จ่าย</option></select></div></div>';
                      }
                      else{
                        oppay6+='';
                      }
                      if(data[i].offer_payment_name7 != null)
                      {
                        oppay7+='<div><label for="offer_payment_value7" class="lasd">'+data[i].offer_payment_name7+'</label><div class="lacampay7"><input id="offer_payment_value7" onKeyUp="chgtext()"  type="text" class="form-control " name="offer_payment_value7" value="{{ old('offer_payment_value7') }}" ></div></div>';
                      }
                      else{
                        oppay7+='';

                      }
                      if(data[i].offer_payment_name8 != null)
                      {
                        oppay8+='<div><label for="offer_payment_value8" class="lasd">'+data[i].offer_payment_name8+'</label><div class="lacampay8"><input id="offer_payment_value8" onKeyUp="chgtext()" readonly type="text" class="form-control " name="offer_payment_value8" value="{{ old('offer_payment_value8') }}" ></div></div>';
                      }
                      else {
                        oppay8+='';
                      }
                      if(data[i].offer_payment_name9 != null)
                      {
                        oppay9+='<div><label for="offer_payment_value9" class="lasd">'+data[i].offer_payment_name9+'</label><div class="lacampay9"><input id="offer_payment_value9" type="text" class="form-control " readonly name="offer_payment_value9" value="{{ old('offer_payment_value9') }}" ></div></div>';
                      }
                      else{
                        oppay9+='';
                      }
                      if(data[i].offer_payment_name10 != null)
                      {
                        oppay10+='<div><label for="offer_payment_value10" class="lasd">'+data[i].offer_payment_name10+'</label><div class="lacampay10"><input id="offer_payment_value10" readonly type="text" class="form-control " name="offer_payment_value10" value="{{ old('offer_payment_value10') }}" ></div></div>';
                      }
                      else {
                        oppay10+='';
                      }
                      if(data[i].offer_payment_name11 != null)
                      {
                        oppay11+='<div><label for="offer_payment_value11" class="lasd">'+data[i].offer_payment_name11+'</label><div class="lacampay11"><input id="offer_payment_value11" type="text" class="form-control "  readonly name="offer_payment_value11" value="{{ old('offer_payment_value11') }}" ></div></div>';
                      }
                      else{
                        oppay11+='';

                      }
                      if(data[i].offer_payment_name12 != null)
                      {
                        oppay12+='<div><label for="offer_payment_value12" class="lasd">'+data[i].offer_payment_name12+'</label><div class="lacampay12"><input id="offer_payment_value12" type="text" class="form-control " name="offer_payment_value12" readonly value="{{ old('offer_payment_value12') }}" ></div></div>';
                      }
                      else {
                        oppay12+='';
                      }
                      if(data[i].offer_payment_name13 != null)
                      {
                        oppay13+='<div><label for="offer_payment_value13" class="lasd">'+data[i].offer_payment_name13+'</label><div class="lacampay13"><input id="offer_payment_value13" readonly onKeyUp="chgtext()" type="text" class="form-control " name="offer_payment_value13" value="{{ old('offer_payment_value13') }}" ></div></div>';
                      }
                      else{
                        oppay13+='';
                      }
                      if(data[i].offer_payment_name14 != null)
                      {
                        oppay14+='<div><label for="offer_payment_value14" class="lasd">'+data[i].offer_payment_name14+'</label><div class="lacampay14"><input id="offer_payment_value14" onKeyUp="chgtext()" type="text" class="form-control " name="offer_payment_value14" value="{{ old('offer_payment_value14') }}" ></div></div>';
                      }
                      else{
                        oppay14+='';
                      }
                      if(data[i].offer_payment_name15 != null)
                      {
                        oppay15+='<div><label for="offer_payment_value15" class="lasd">'+data[i].offer_payment_name15+'</label><div class="lacampay15"><input id="offer_payment_value15" onKeyUp="chgtext()"readonly type="text" class="form-control " name="offer_payment_value15" value="{{ old('offer_payment_value15') }}" ></div></div>';
                      }
                      else {
                        oppay15+='';
                      }
                      if(data[i].offer_payment_name16 != null)
                      {
                        oppay16+='<div><label for="offer_payment_value16" class="lasd">'+data[i].offer_payment_name16+'</label><div class="lacampay16"><div class="input-group date"><input id="offer_payment_value16" onKeyUp="chgtext()" type="text" class="form-control " name="offer_payment_value16" onKeyUp="chgtext()" value="{{ old('offer_payment_value16') }}" ><div class="input-group-addon"> <span class="partnerquota"></span></div></div></div></div>';
                      }
                      else{
                        oppay16+='';
                      }
                      if(data[i].offer_payment_name17 != null)
                      {
                        oppay17+='<div><label for="offer_payment_value17" class="lasd">'+data[i].offer_payment_name17+'</label><div class="lacampay17"><input id="offer_payment_value17" type="text" class="form-control " readonly onKeyUp="chgtext()" name="offer_payment_value17" value="{{ old('offer_payment_value17') }}" ></div></div>';
                      }
                      else{
                        oppay17+='';
                      }
                      if(data[i].offer_payment_name18 != null)
                      {
                        oppay18+='<div><label for="offer_payment_value18" class="lasd">'+data[i].offer_payment_name18+'</label><div class="lacampay18"><div class="input-group date"><input id="offer_payment_value18"  onKeyUp="chgtext()" type="text" class="form-control " name="offer_payment_value18" onKeyUp="chgtext()" value="{{ old('offer_payment_value18') }}" ><div class="input-group-addon"> <span class="userquota"></span></div></div></div></div>';
                      }
                      else
                      {
                      oppay18+='';
                    }
                    if(data[i].offer_payment_name19 != null)
                    {
                      oppay19+='<div><label for="offer_payment_value19" class="lasd">'+data[i].offer_payment_name19+'</label><div class="lacampay19"><input id="offer_payment_value19" readonly type="text" class="form-control " onKeyUp="chgtext()" name="offer_payment_value19" value="{{ old('offer_payment_value19') }}" ></div></div>';
                    }
                    else{
                      oppay19+='';
                    }
                    if(data[i].offer_payment_name20 != null)
                    {
                      oppay20+='<div><label for="offer_payment_value20" class="lasd">'+data[i].offer_payment_name20+'</label><div class="lacampay20"><input id="offer_payment_value20" type="text" class="form-control " onKeyUp="chgtext()" name="offer_payment_value20" value="{{ old('offer_payment_value20') }}" ></div></div>';
                    }
                    else{
                      oppay20+='';
                    }
                    if(data[i].offer_payment_name21 != null)
                    {
                      oppay21+='<div><label for="offer_payment_value21" class="lasd">'+data[i].offer_payment_name21+'</label><div class="lacampay21"><input id="offer_payment_value21" type="text" class="form-control " readonly name="offer_payment_value21" value="{{ old('offer_payment_value21') }}" ></div></div>';
                    }
                    else{
                      oppay21+='';
                    }

                    if(data[i].offer_payment_name22 != null)
                    {
                      oppay22+='<div><label for="offer_payment_value22" class="lasd">'+data[i].offer_payment_name22+'</label><div class="lacampay22"><input id="offer_payment_value22" type="text" class="form-control " name="offer_payment_value22" value="{{ old('offer_payment_value22') }}" ></div></div>';
                    }
                    else{
                      oppay22+='';
                    }

                    if(data[i].offer_payment_name23 != null)
                    {
                      oppay23+='<div><label for="offer_payment_value23" class="lasd">'+data[i].offer_payment_name23+'</label><div class="lacampay23"><input id="offer_payment_value23" type="text" class="form-control " name="offer_payment_value23" value="{{ old('offer_payment_value23') }}" ></div></div>';
                    }
                    else{
                      oppay23+='';
                    }
                    if(data[i].offer_payment_name24 != null)
                    {
                      oppay24+='<div><label for="offer_payment_value24" class="lasd">'+data[i].offer_payment_name24+'</label><div class="lacampay24"><input id="offer_payment_value24" type="text" class="form-control " name="offer_payment_value24" value="{{ old('offer_payment_value24') }}" ></div></div>';
                    }
                    else{
                      oppay24+='';
                    }

                    if(data[i].offer_payment_name25 != null)
                    {
                      oppay25+='<div><label for="offer_payment_value25" class="lasd">'+data[i].offer_payment_name25+'</label><input id="offer_payment_value25" type="text" class="form-control " name="offer_payment_value25" value="{{ old('offer_payment_value25') }}" ></div></div>';
                    }
                    else{
                      oppay25+='';
                    }

                    if(data[i].offer_payment_name26 != null)
                    {
                      oppay26+='<div><label for="offer_payment_value26" class="lasd">'+data[i].offer_payment_name26+'</label><div class="lacampay26"><input id="offer_payment_value26" type="text" class="form-control " name="offer_payment_value26" value="{{ old('offer_payment_value26') }}" ></div></div>';
                    }
                    else{
                      oppay26+='';
                    }

                    if(data[i].offer_payment_name27 != null)
                    {
                      oppay27+='<div><label for="offer_payment_value27" class="lasd">'+data[i].offer_payment_name27+'</label><div class="lacampay27"><input id="offer_payment_value27" type="text" class="form-control " name="offer_payment_value27" value="{{ old('offer_payment_value27') }}" ></div></div>';
                    }
                    else{
                      oppay27+='';
                    }

                    if(data[i].offer_payment_name28 != null)
                    {
                      oppay28+='<div><label for="offer_payment_value28" class="lasd">'+data[i].offer_payment_name28+'</label><div class="lacampay28"><input id="offer_payment_value28" type="text" class="form-control " name="offer_payment_value28" value="{{ old('offer_payment_value28') }}" ></div></div>';
                    }
                    else{
                      oppay28+='';
                    }

                    if(data[i].offer_payment_name29 != null)
                    {
                      oppay29+='<div><label for="offer_payment_value29" class="lasd">'+data[i].offer_payment_name29+'</label><div class="lacampay29"><input id="offer_payment_value29" type="text" class="form-control " name="offer_payment_value29" value="{{ old('offer_payment_value29') }}" ></div></div>';
                    }
                    else{
                      oppay29+='';
                    }
                    if(data[i].offer_payment_name30 != null)
                    {
                      oppay30+='<div><label for="offer_payment_value30" class="lasd">'+data[i].offer_payment_name30+'</label><div class="lacampay30"><input id="offer_payment_value30" type="text" class="form-control " name="offer_payment_value30" value="{{ old('offer_payment_value30') }}" ></div></div>';
                    }
                    else{
                      oppay30+='';
                    }

                    if(data[i].offer_payment_name31 != null)
                    {
                      oppay31+='<div><label for="offer_payment_value31" class="lasd">'+data[i].offer_payment_name31+'</label><div class="lacampay31"><input id="offer_payment_value31" type="text" class="form-control " name="offer_payment_value31" value="{{ old('offer_payment_value31') }}" ></div></div>';
                    }
                    else{
                      oppay31+='';
                    }

                    if(data[i].offer_payment_name32 != null)
                    {
                      oppay32+='<div><label for="offer_payment_value32" class="lasd">'+data[i].offer_payment_name32+'</label><div class="lacampay32"><input id="offer_payment_value32" type="text" class="form-control " name="offer_payment_value32" value="{{ old('offer_payment_value32') }}" ></div></div>';
                    }
                    else{
                      oppay32+='';
                    }

                    if(data[i].offer_payment_name33 != null)
                    {
                      oppay33+='<div><label for="offer_payment_value33" class="lasd">'+data[i].offer_payment_name33+'</label><div class="lacampay33"><input id="offer_payment_value33" type="text" class="form-control " name="offer_payment_value33" value="{{ old('offer_payment_value33') }}" ></div></div>';
                    }
                    else{
                      oppay33+='';
                    }

                    if(data[i].offer_payment_name34 != null)
                    {
                      oppay34+='<div><label for="offer_payment_value34" class="lasd">'+data[i].offer_payment_name34+'</label><div class="lacampay34"><input id="offer_payment_value34" type="text" class="form-control " name="offer_payment_value34" value="{{ old('offer_payment_value34') }}" ></div></div>';
                    }
                    else{
                      oppay34+='';
                    }

                    if(data[i].offer_payment_name35 != null)
                    {
                      oppay35+='<div><label for="offer_payment_value35" class="lasd">'+data[i].offer_payment_name35+'</label><div class="lacampay35"><input id="offer_payment_value35" type="text" class="form-control " name="offer_payment_value35" value="{{ old('offer_payment_value35') }}" ></div></div>';
                    }
                    else{
                      oppay35+='';
                    }

                    if(data[i].offer_payment_name36 != null)
                    {
                      oppay36+='<div><label for="offer_payment_value36" class="lasd">'+data[i].offer_payment_name36+'</label><div class="lacampay36"><input id="offer_payment_value36" type="text" class="form-control " name="offer_payment_value36" value="{{ old('offer_payment_value36') }}" ></div></div>';
                    }
                    else{
                      oppay36+='';
                    }

                    if(data[i].offer_payment_name37 != null)
                    {
                      oppay37+='<div><label for="offer_payment_value37" class="lasd">'+data[i].offer_payment_name37+'</label><div class="lacampay37"><input id="offer_payment_value37" type="text" class="form-control " name="offer_payment_value37" value="{{ old('offer_payment_value37') }}" ></div></div>';
                    }
                    else{
                      oppay37+='';
                    }

                    if(data[i].offer_payment_name38 != null)
                    {
                      oppay38+='<div><label for="offer_payment_value38" class="lasd">'+data[i].offer_payment_name38+'</label><div class="lacampay38"><input id="offer_payment_value38" type="text" class="form-control " name="offer_payment_value38" value="{{ old('offer_payment_value38') }}" ></div></div>';
                    }
                    else{
                      oppay38+='';
                    }

                    if(data[i].offer_payment_name39 != null)
                    {
                      oppay39+='<div><label for="offer_payment_value39" class="lasd">'+data[i].offer_payment_name39+'</label><div class="lacampay39"><input id="offer_payment_value39" type="text" class="form-control " name="offer_payment_value39" value="{{ old('offer_payment_value39') }}" ></div></div>';
                    }
                    else{
                      oppay39+='';
                    }

                    if(data[i].offer_payment_name40 != null)
                    {
                      oppay40+='<div><label for="offer_payment_value40" class="lasd">'+data[i].offer_payment_name40+'</label><div class="lacampay40"><input id="offer_payment_value40" type="text" class="form-control " name="offer_payment_value40" value="{{ old('offer_payment_value40') }}" ></div></div>';
                    }
                    else{
                      oppay40+='';
                    }
                    if(data[i].offer_detail_name1 != null)
                    {
                    opdetail+='<div><label for="offer_detail_value1" class="lasd">'+data[i].offer_detail_name1+'</label><div class="lacamdetail"><input id="offer_detail_value1" type="text" class="form-control " name="offer_detail_value1" value="{{ old('offer_detail_value1') }}" ></div></div>';
                    }
                    else{
                      opdetail+='';
                      hideofferdetail+='';
                      $('.hideofferdetail').html(" ");

                    }
                    if(data[i].offer_detail_name2 != null)
                    {
                      opdetail2+='<div><label for="offer_detail_value2" class="lasd">'+data[i].offer_detail_name2+'</label><div class="lacamdetail2"><input id="offer_detail_value2" type="text" class="form-control " name="offer_detail_value2" value="{{ old('offer_detail_value2') }}" ></div></div>';
                    }

                    else{
                      opdetail2+='';

                    }
                    if(data[i].offer_detail_name3 != null)
                    {
                      opdetail3+='<div><label for="offer_detail_value3" class="lasd">'+data[i].offer_detail_name3+'</label><div class="lacamdetail3"><input id="offer_detail_value3" type="text" class="form-control " name="offer_detail_value3" value="{{ old('offer_detail_value3') }}" ></div></div>';
                    }
                    else{
                      opdetail3+='';
                    }
                    if(data[i].offer_detail_name4 != null)
                    {
                      opdetail4+='<div><label for="offer_detail_value4" class="lasd">'+data[i].offer_detail_name4+'</label><div class="lacamdetail4"><input id="offer_detail_value4" type="text" class="form-control " name="offer_detail_value4" value="{{ old('offer_detail_value4') }}" ></div></div>';
                    }
                    else{
                      opdetail4+='';

                    }
                    if(data[i].offer_detail_name5 != null)
                    {
                      opdetail5+='<div><label for="offer_detail_value5" class="lasd">'+data[i].offer_detail_name5+'</label><div class="lacamdetail5"><input id="offer_detail_value5" type="text" class="form-control " name="offer_detail_value5" value="{{ old('offer_detail_value5') }}" ></div></div>';
                    }
                    else{
                      opdetail5+='';

                    }
                    if(data[i].offer_detail_name6 != null)
                    {
                      opdetail6+='<div><label for="offer_detail_value6" class="lasd">'+data[i].offer_detail_name6+'</label><div class="lacamdetail6"><input id="offer_detail_value6" type="text" class="form-control " name="offer_detail_value6" value="{{ old('offer_detail_value6') }}" ></div></div>';
                    }
                    else{
                      opdetail6+='';
                    }
                    if(data[i].offer_detail_name7 != null)
                    {
                      opdetail7+='<div><label for="offer_detail_value7" class="lasd">'+data[i].offer_detail_name7+'</label><div class="lacamdetail7"><input id="offer_detail_value7" type="text" class="form-control " name="offer_detail_value7" value="{{ old('offer_detail_value7') }}" ></div></div>';
                    }
                    else{
                      opdetail7+='';

                    }
                    if(data[i].offer_detail_name8 != null)
                    {
                      opdetail8+='<div><label for="offer_detail_value8" class="lasd">'+data[i].offer_detail_name8+'</label><div class="lacamdetail8"><input id="offer_detail_value8" type="text" class="form-control " name="offer_detail_value8" value="{{ old('offer_detail_value8') }}" ></div></div>';
                    }
                    else {
                      opdetail8+='';
                    }
                    if(data[i].offer_detail_name9 != null)
                    {
                      opdetail9+='<div><label for="offer_detail_value9" class="lasd">'+data[i].offer_detail_name9+'</label><div class="lacamdetail9"><input id="offer_detail_value9" type="text" class="form-control " name="offer_detail_value9" value="{{ old('offer_detail_value9') }}" ></div></div>';
                    }
                    else{
                      opdetail9+='';
                    }
                    if(data[i].offer_detail_name10 != null)
                    {
                      opdetail10+='<div><label for="offer_detail_value10" class="lasd">'+data[i].offer_detail_name10+'</label><div class="lacamdetail10"><input id="offer_detail_value10" type="text" class="form-control " name="offer_detail_value10" value="{{ old('offer_detail_value10') }}" ></div></div>';
                    }
                    else {
                      opdetail10+='';
                    }
                    if(data[i].offer_detail_name11 != null)
                    {
                      opdetail11+='<div><label for="offer_detail_value11" class="lasd">'+data[i].offer_detail_name11+'</label><div class="lacamdetail11"><input id="offer_detail_value11" type="text" class="form-control " name="offer_detail_value11" value="{{ old('offer_detail_value11') }}" ></div></div>';
                    }
                    else{
                      opdetail11+='';

                    }
                    if(data[i].offer_detail_name12 != null)
                    {
                      opdetail12+='<div><label for="offer_detail_value12" class="lasd">'+data[i].offer_detail_name12+'</label><div class="lacamdetail12"><input id="offer_detail_value12" type="text" class="form-control " name="offer_detail_value12" value="{{ old('offer_detail_value12') }}" ></div></div>';
                    }
                    else {
                      opdetail12+='';
                    }
                    if(data[i].offer_detail_name13 != null)
                    {
                      opdetail13+='<div><label for="offer_detail_value13" class="lasd">'+data[i].offer_detail_name13+'</label><div class="lacamdetail13"><input id="offer_detail_value13" type="text" class="form-control " name="offer_detail_value13" value="{{ old('offer_detail_value13') }}" ></div></div>';
                    }
                    else{
                      opdetail13+='';
                    }
                    if(data[i].offer_detail_name14 != null)
                    {
                      opdetail14+='<div><label for="offer_detail_value14" class="lasd">'+data[i].offer_detail_name14+'</label><div class="lacamdetail14"><input id="offer_detail_value14" type="text" class="form-control " name="offer_detail_value14" value="{{ old('offer_detail_value14') }}" ></div></div>';
                    }
                    else{
                      opdetail14+='';
                    }
                    if(data[i].offer_detail_name15 != null)
                    {
                      opdetail15+='<div><label for="offer_detail_value15" class="lasd">'+data[i].offer_detail_name15+'</label><div class="lacamdetail15"><input id="offer_detail_value15" type="text" class="form-control " name="offer_detail_value15" value="{{ old('offer_detail_value15') }}" ></div></div>';
                    }
                    else {
                      opdetail15+='';
                    }
                    if(data[i].offer_detail_name16 != null)
                    {
                      opdetail16+='<div><label for="offer_detail_value16" class="lasd">'+data[i].offer_detail_name16+'</label><div class="lacamdetail16"><input id="offer_detail_value16" type="text" class="form-control " name="offer_detail_value16" value="{{ old('offer_detail_value16') }}" ></div></div>';
                    }
                    else{
                      opdetail16+='';
                    }
                    if(data[i].offer_detail_name17 != null)
                    {
                      opdetail17+='<div><label for="offer_detail_value17" class="lasd">'+data[i].offer_detail_name17+'</label><div class="lacamdetail17"><input id="offer_detail_value17" type="text" class="form-control " name="offer_detail_value17" value="{{ old('offer_detail_value17') }}" ></div></div>';
                    }
                    else{
                      opdetail17+='';
                    }
                    if(data[i].offer_detail_name18 != null)
                    {
                      opdetail18+='<div><label for="offer_detail_value18" class="lasd">'+data[i].offer_detail_name18+'</label><div class="lacamdetail18"><input id="offer_detail_value18" type="text" class="form-control " name="offer_detail_value18" value="{{ old('offer_detail_value18') }}" ></div></div>';
                    }
                    else
                    {
                    opdetail18+='';
                  }
                  if(data[i].offer_detail_name19 != null)
                  {
                    opdetail19+='<div><label for="offer_detail_value19" class="lasd">'+data[i].offer_detail_name19+'</label><div class="lacamdetail19"><input id="offer_detail_value19" type="text" class="form-control " name="offer_detail_value19" value="{{ old('offer_detail_value19') }}" ></div></div>';
                  }
                  else{
                    opdetail19+='';
                  }
                  if(data[i].offer_detail_name20 != null)
                  {
                    opdetail20+='<div><label for="offer_detail_value20" class="lasd">'+data[i].offer_detail_name20+'</label><div class="lacamdetail20"><input id="offer_detail_value20" type="text" class="form-control " name="offer_detail_value20" value="{{ old('offer_detail_value20') }}" ></div></div>';
                  }
                  else{
                    opdetail20+='';
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

                      $('.ladetail').html(" ");
                      $('.ladetail2').html(" ");
                      $('.ladetail3').html(" ");
                      $('.ladetail4').html(" ");
                      $('.ladetail5').html(" ");
                      $('.ladetail6').html(" ");
                      $('.ladetail7').html(" ");
                      $('.ladetail8').html(" ");
                      $('.ladetail9').html(" ");
                      $('.ladetail10').html(" ");
                      $('.ladetail11').html(" ");
                      $('.ladetail12').html(" ");
                      $('.ladetail13').html(" ");
                      $('.ladetail14').html(" ");
                      $('.ladetail15').html(" ");
                      $('.ladetail16').html(" ");
                      $('.ladetail17').html(" ");
                      $('.ladetail18').html(" ");
                      $('.ladetail19').html(" ");
                      $('.ladetail20').html(" ");

                      $('.ladetail').append(opdetail);
                      $('.ladetail2').append(opdetail2);
                      $('.ladetail3').append(opdetail3);
                      $('.ladetail4').append(opdetail4);
                      $('.ladetail5').append(opdetail5);
                      $('.ladetail6').append(opdetail6);
                      $('.ladetail7').append(opdetail7);
                      $('.ladetail8').append(opdetail8);
                      $('.ladetail9').append(opdetail9);
                      $('.ladetail10').append(opdetail10);
                      $('.ladetail11').append(opdetail11);
                      $('.ladetail12').append(opdetail12);
                      $('.ladetail13').append(opdetail13);
                      $('.ladetail14').append(opdetail14);
                      $('.ladetail15').append(opdetail15);
                      $('.ladetail16').append(opdetail16);
                      $('.ladetail17').append(opdetail17);
                      $('.ladetail18').append(opdetail18);
                      $('.ladetail19').append(opdetail19);
                      $('.ladetail20').append(opdetail20);

                      $('.ladetail20').append(hideoffer21_40);
                      $('.hideofferdetail').append(hideofferdetail);
                      $('.hideofferpayment').append(hideofferpayment);

                      //console.logg(op);
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
            //  //console.logg("hmm its change");

                var department_id=$(this).val();
                ////console.logg(department_id);
                var div=$(this).parent();
                var opcam=" ";
                var opcam2=" ";
                var opcam3=" ";
                var opcam4=" ";
                var opcam5=" ";
                var opcam6=" ";
                var opcam7=" ";
                var opcam8=" ";
                var opcam9=" ";
                var opcam10=" ";
                var opcam11=" ";
                var opcam12=" ";
                var opcam13=" ";
                var opcam14=" ";
                var opcam15=" ";
                var opcam16=" ";
                var opcam17=" ";
                var opcam18=" ";
                var opcam19=" ";
                var opcam20=" ";
                var opcam21=" ";
                var opcam22=" ";
                var opcam23=" ";
                var opcam24=" ";
                var opcam25=" ";
                var opcam26=" ";
                var opcam27=" ";
                var opcam28=" ";
                var opcam29=" ";
                var opcam30=" ";
                var opcam31=" ";
                var opcam32=" ";
                var opcam33=" ";
                var opcam34=" ";
                var opcam35=" ";
                var opcam36=" ";
                var opcam37=" ";
                var opcam38=" ";
                var opcam39=" ";
                var opcam40=" ";
                var opcampay=" ";
                var opcampay2=" ";
                var opcampay3=" ";
                var opcampay4=" ";
                var opcampay5=" ";
                var opcampay6=" ";
                var opcampay7=" ";
                var opcampay8=" ";
                var opcampay9=" ";
                var opcampay10=" ";
                var opcampay11=" ";
                var opcampay12=" ";
                var opcampay13=" ";
                var opcampay14=" ";
                var opcampay15=" ";
                var opcampay16=" ";
                var opcampay17=" ";
                var opcampay18=" ";
                var opcampay19=" ";
                var opcampay20=" ";
                var opcampay21=" ";
                var opcampay22=" ";
                var opcampay23=" ";
                var opcampay24=" ";
                var opcampay25=" ";
                var opcampay26=" ";
                var opcampay27=" ";
                var opcampay28=" ";
                var opcampay29=" ";
                var opcampay30=" ";
                var opcampay31=" ";
                var opcampay32=" ";
                var opcampay33=" ";
                var opcampay34=" ";
                var opcampay35=" ";
                var opcampay36=" ";
                var opcampay37=" ";
                var opcampay38=" ";
                var opcampay39=" ";
                var opcampay40=" ";
                var opcamdetail=" ";
                var opcamdetail2=" ";
                var opcamdetail3=" ";
                var opcamdetail4=" ";
                var opcamdetail5=" ";
                var opcamdetail6=" ";
                var opcamdetail7=" ";
                var opcamdetail8=" ";
                var opcamdetail9=" ";
                var opcamdetail10=" ";
                var opcamdetail11=" ";
                var opcamdetail12=" ";
                var opcamdetail13=" ";
                var opcamdetail14=" ";
                var opcamdetail15=" ";
                var opcamdetail16=" ";
                var opcamdetail17=" ";
                var opcamdetail18=" ";
                var opcamdetail19=" ";
                var opcamdetail20=" ";
                var hideoffertype=" ";


                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findOfferTypeCampaign')!!}',
                    data:{'id':department_id},

                    success:function(data){
                      //console.logg('success');



                     //console.logg(data.length);
                     if(data.length == null || data.length <= 0)
                     {
                       $('.lacam').html(" ");
                       $('.lacam2').html(" ");
                       $('.lacam3').html(" ");
                       $('.lacam4').html(" ");
                       $('.lacam5').html(" ");
                       $('.lacam6').html(" ");
                       $('.lacam7').html(" ");
                       $('.lacam8').html(" ");
                       $('.lacam9').html(" ");
                       $('.lacam10').html(" ");
                       $('.lacam11').html(" ");
                       $('.lacam12').html(" ");
                       $('.lacam13').html(" ");
                       $('.lacam14').html(" ");
                       $('.lacam15').html(" ");
                       $('.lacam16').html(" ");
                       $('.lacam17').html(" ");
                       $('.lacam18').html(" ");
                       $('.lacam19').html(" ");
                       $('.lacam20').html(" ");
                       $('.lacam21').html(" ");
                       $('.lacam22').html(" ");
                       $('.lacam23').html(" ");
                       $('.lacam24').html(" ");
                       $('.lacam25').html(" ");
                       $('.lacam26').html(" ");
                       $('.lacam27').html(" ");
                       $('.lacam28').html(" ");
                       $('.lacam29').html(" ");
                       $('.lacam30').html(" ");
                       $('.lacam31').html(" ");
                       $('.lacam32').html(" ");
                       $('.lacam33').html(" ");
                       $('.lacam34').html(" ");
                       $('.lacam35').html(" ");
                       $('.lacam36').html(" ");
                       $('.lacam37').html(" ");
                       $('.lacam38').html(" ");
                       $('.lacam39').html(" ");
                       $('.lacam40').html(" ");


                       $('.lacampay').html(" ");
                       $('.lacampay2').html(" ");
                       $('.lacampay3').html(" ");
                       $('.lacampay4').html(" ");
                       $('.lacampay5').html(" ");
                       $('.lacampay6').html(" ");
                       $('.lacampay7').html(" ");
                       $('.lacampay8').html(" ");
                       $('.lacampay9').html(" ");
                       $('.lacampay10').html(" ");
                       $('.lacampay11').html(" ");
                       $('.lacampay12').html(" ");
                       $('.lacampay13').html(" ");
                       $('.lacampay14').html(" ");
                       $('.lacampay15').html(" ");
                       $('.lacampay16').html(" ");
                       $('.lacampay17').html(" ");
                       $('.lacampay18').html(" ");
                       $('.lacampay19').html(" ");
                       $('.lacampay20').html(" ");
                       $('.lacampay21').html(" ");
                       $('.lacampay22').html(" ");
                       $('.lacampay23').html(" ");
                       $('.lacampay24').html(" ");
                       $('.lacampay25').html(" ");
                       $('.lacampay26').html(" ");
                       $('.lacampay27').html(" ");
                       $('.lacampay28').html(" ");
                       $('.lacampay29').html(" ");
                       $('.lacampay30').html(" ");
                       $('.lacampay31').html(" ");
                       $('.lacampay32').html(" ");
                       $('.lacampay33').html(" ");
                       $('.lacampay34').html(" ");
                       $('.lacampay35').html(" ");
                       $('.lacampay36').html(" ");
                       $('.lacampay37').html(" ");
                       $('.lacampay38').html(" ");
                       $('.lacampay39').html(" ");
                       $('.lacampay40').html(" ");


                       $('.lacamdetail').html(" ");
                       $('.lacamdetail2').html(" ");
                       $('.lacamdetail3').html(" ");
                       $('.lacamdetail4').html(" ");
                       $('.lacamdetail5').html(" ");
                       $('.lacamdetail6').html(" ");
                       $('.lacamdetail7').html(" ");
                       $('.lacamdetail8').html(" ");
                       $('.lacamdetail9').html(" ");
                       $('.lacamdetail10').html(" ");
                       $('.lacamdetail11').html(" ");
                       $('.lacamdetail12').html(" ");
                       $('.lacamdetail13').html(" ");
                       $('.lacamdetail14').html(" ");
                       $('.lacamdetail15').html(" ");
                       $('.lacamdetail16').html(" ");
                       $('.lacamdetail17').html(" ");
                       $('.lacamdetail18').html(" ");
                       $('.lacamdetail19').html(" ");
                       $('.lacamdetail20').html(" ");

                       opcam+='<input id="offer_value1" type="text" class="form-control" name="offer_value1"   >';
                       opcam2+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                       opcam3+='<input id="offer_value3" type="text" class="form-control" name="offer_value3"   >';
                       opcam4+='<input id="offer_value4" type="text" class="form-control" name="offer_value4"   >';
                       opcam5+='<input id="offer_value5" type="text" class="form-control" name="offer_value5"   >';
                       opcam6+='<input id="offer_value6" type="text" class="form-control" name="offer_value6"   >';
                       opcam7+='<input id="offer_value7" type="text" class="form-control" name="offer_value7"   >';
                       opcam8+='<input id="offer_value8" type="text" class="form-control" name="offer_value8"   >';
                       opcam9+='<input id="offer_value9" type="text" class="form-control" name="offer_value9"   >';
                       opcam10+='<input id="offer_value10" type="text" class="form-control" name="offer_value10"   >';
                       opcam11+='<input id="offer_value11" type="text" class="form-control" name="offer_value11"   >';
                       opcam12+='<input id="offer_value12" type="text" class="form-control" name="offer_value12"   >';
                       opcam13+='<input id="offer_value13" type="text" class="form-control" name="offer_value13"   >';
                       opcam14+='<input id="offer_value14" type="text" class="form-control" name="offer_value14"   >';
                       opcam15+='<input id="offer_value15" type="text" class="form-control" name="offer_value15"   >';
                       opcam16+='<input id="offer_value16" type="text" class="form-control" name="offer_value16"   >';
                       opcam17+='<input id="offer_value17" type="text" class="form-control" name="offer_value17"   >';
                       opcam18+='<input id="offer_value18" type="text" class="form-control" name="offer_value18"   >';
                       opcam19+='<input id="offer_value19" type="text" class="form-control" name="offer_value19"   >';
                       opcam20+='<input id="offer_value20" type="text" class="form-control" name="offer_value20"   >';
                       opcam21+='<input id="offer_value21" type="text" class="form-control" name="offer_value21"   >';
                       opcam22+='<input id="offer_value22" type="text" class="form-control" name="offer_value22"   >';
                       opcam23+='<input id="offer_value23" type="text" class="form-control" name="offer_value23"   >';
                       opcam24+='<input id="offer_value24" type="text" class="form-control" name="offer_value24"   >';
                       opcam25+='<input id="offer_value25" type="text" class="form-control" name="offer_value25"   >';
                       opcam26+='<input id="offer_value26" type="text" class="form-control" name="offer_value26"   >';
                       opcam27+='<input id="offer_value27" type="text" class="form-control" name="offer_value27"   >';
                       opcam28+='<input id="offer_value28" type="text" class="form-control" name="offer_value28"   >';
                       opcam29+='<input id="offer_value29" type="text" class="form-control" name="offer_value29"   >';
                       opcam30+='<input id="offer_value30" type="text" class="form-control" name="offer_value30"   >';
                       opcam31+='<input id="offer_value31" type="text" class="form-control" name="offer_value31"   >';
                       opcam32+='<input id="offer_value32" type="text" class="form-control" name="offer_value32"   >';
                       opcam33+='<input id="offer_value33" type="text" class="form-control" name="offer_value33"   >';
                       opcam34+='<input id="offer_value34" type="text" class="form-control" name="offer_value34"   >';
                       opcam35+='<input id="offer_value35" type="text" class="form-control" name="offer_value35"   >';
                       opcam36+='<input id="offer_value36" type="text" class="form-control" name="offer_value36"   >';
                       opcam37+='<input id="offer_value37" type="text" class="form-control" name="offer_value37"   >';
                       opcam38+='<input id="offer_value38" type="text" class="form-control" name="offer_value38"   >';
                       opcam39+='<input id="offer_value39" type="text" class="form-control" name="offer_value39"   >';
                       opcam40+='<input id="offer_value40" type="text" class="form-control" name="offer_value40"   >';

                       opcamdetail+='<input id="offer_detail_value1" type="text" class="form-control" name="offer_detail_value1"   >';
                       opcamdetail2+='<input id="offer_detail_value2" type="text" class="form-control" name="offer_detail_value2"   >';
                       opcamdetail3+='<input id="offer_detail_value3" type="text" class="form-control" name="offer_detail_value3"   >';
                       opcamdetail4+='<input id="offer_detail_value4" type="text" class="form-control" name="offer_detail_value4"   >';
                       opcamdetail5+='<input id="offer_detail_value5" type="text" class="form-control" name="offer_detail_value5"   >';
                       opcamdetail6+='<input id="offer_detail_value6" type="text" class="form-control" name="offer_detail_value6"   >';
                       opcamdetail7+='<input id="offer_detail_value7" type="text" class="form-control" name="offer_detail_value7"   >';
                       opcamdetail8+='<input id="offer_detail_value8" type="text" class="form-control" name="offer_detail_value8"   >';
                       opcamdetail9+='<input id="offer_detail_value9" type="text" class="form-control" name="offer_detail_value9"   >';
                       opcamdetail10+='<input id="offer_detail_value10" type="text" class="form-control" name="offer_detail_value10"   >';
                       opcamdetail11+='<input id="offer_detail_value11" type="text" class="form-control" name="offer_detail_value11"   >';
                       opcamdetail12+='<input id="offer_detail_value12" type="text" class="form-control" name="offer_detail_value12"   >';
                       opcamdetail13+='<input id="offer_detail_value13" type="text" class="form-control" name="offer_detail_value13"   >';
                       opcamdetail14+='<input id="offer_detail_value14" type="text" class="form-control" name="offer_detail_value14"   >';
                       opcamdetail15+='<input id="offer_detail_value15" type="text" class="form-control" name="offer_detail_value15"   >';
                       opcamdetail16+='<input id="offer_detail_value16" type="text" class="form-control" name="offer_detail_value16"   >';
                       opcamdetail17+='<input id="offer_detail_value17" type="text" class="form-control" name="offer_detail_value17"   >';
                       opcamdetail18+='<input id="offer_detail_value18" type="text" class="form-control" name="offer_detail_value18"   >';
                       opcamdetail19+='<input id="offer_detail_value19" type="text" class="form-control" name="offer_detail_value19"   >';
                       opcamdetail20+='<input id="offer_detail_value20" type="text" class="form-control" name="offer_detail_value20"   >';

                       opcampay+='<input id="offer_payment_value1"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value1"   >';
                       opcampay2+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                       opcampay3+='<input id="offer_payment_value3"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value3"   >';
                       opcampay4+='<input id="offer_payment_value4" readonly onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value4"   >';
                       opcampay5+='<input id="offer_payment_value5" type="text" class="form-control" name="offer_payment_value5"   >';
                       opcampay6+='<input id="offer_payment_value6" type="text" class="form-control" name="offer_payment_value6"   >';
                       opcampay7+='<input id="offer_payment_value7" type="text" class="form-control" name="offer_payment_value7"   >';
                       opcampay8+='<input id="offer_payment_value8" type="text" class="form-control" name="offer_payment_value8"   >';
                       opcampay9+='<input id="offer_payment_value9" type="text" class="form-control" name="offer_payment_value9"   >';
                       opcampay10+='<input id="offer_payment_value10" type="text" class="form-control" name="offer_payment_value10"   >';
                       opcampay11+='<input id="offer_payment_value11" type="text" class="form-control" name="offer_payment_value11"   >';
                       opcampay12+='<input id="offer_payment_value12" type="text" class="form-control" name="offer_payment_value12"   >';
                       opcampay13+='<input id="offer_payment_value13" type="text" class="form-control" name="offer_payment_value13"   >';
                       opcampay14+='<input id="offer_payment_value14" type="text" class="form-control" name="offer_payment_value14"   >';
                       opcampay15+='<input id="offer_payment_value15" type="text" class="form-control" name="offer_payment_value15"   >';
                       opcampay16+='<input id="offer_payment_value16" type="text" class="form-control" name="offer_payment_value16"   >';
                       opcampay17+='<input id="offer_payment_value17" type="text" class="form-control" name="offer_payment_value17"   >';
                       opcampay18+='<input id="offer_payment_value18" type="text" class="form-control" name="offer_payment_value18"   >';
                       opcampay19+='<input id="offer_payment_value19" type="text" class="form-control" name="offer_payment_value19"   >';
                       opcampay20+='<input id="offer_payment_value20" type="text" class="form-control" name="offer_payment_value20"   >';
                       opcampay21+='<input id="offer_payment_value21" type="text" class="form-control" name="offer_payment_value21"   >';
                       opcampay22+='<input id="offer_payment_value22" type="text" class="form-control" name="offer_payment_value22"   >';
                       opcampay23+='<input id="offer_payment_value23" type="text" class="form-control" name="offer_payment_value23"   >';
                       opcampay24+='<input id="offer_payment_value24" type="text" class="form-control" name="offer_payment_value24"   >';
                       opcampay25+='<input id="offer_payment_value25" type="text" class="form-control" name="offer_payment_value25"   >';
                       opcampay26+='<input id="offer_payment_value26" type="text" class="form-control" name="offer_payment_value26"   >';
                       opcampay27+='<input id="offer_payment_value27" type="text" class="form-control" name="offer_payment_value27"   >';
                       opcampay28+='<input id="offer_payment_value28" type="text" class="form-control" name="offer_payment_value28"   >';
                       opcampay29+='<input id="offer_payment_value29" type="text" class="form-control" name="offer_payment_value29"   >';
                       opcampay30+='<input id="offer_payment_value30" type="text" class="form-control" name="offer_payment_value30"   >';
                       opcampay31+='<input id="offer_payment_value31" type="text" class="form-control" name="offer_payment_value31"   >';
                       opcampay32+='<input id="offer_payment_value32" type="text" class="form-control" name="offer_payment_value32"   >';
                       opcampay33+='<input id="offer_payment_value33" type="text" class="form-control" name="offer_payment_value33"   >';
                       opcampay34+='<input id="offer_payment_value34" type="text" class="form-control" name="offer_payment_value34"   >';
                       opcampay35+='<input id="offer_payment_value35" type="text" class="form-control" name="offer_payment_value35"   >';
                       opcampay36+='<input id="offer_payment_value36" type="text" class="form-control" name="offer_payment_value36"   >';
                       opcampay37+='<input id="offer_payment_value37" type="text" class="form-control" name="offer_payment_value37"   >';
                       opcampay38+='<input id="offer_payment_value38" type="text" class="form-control" name="offer_payment_value38"   >';
                       opcampay39+='<input id="offer_payment_value39" type="text" class="form-control" name="offer_payment_value39"   >';
                       opcampay40+='<input id="offer_payment_value40" type="text" class="form-control" name="offer_payment_value40"   >';

                     }

                      for(var i=0; i<data.length;i++){
                      //  op+='<label value="'+data[i].con_para_name1+'">'+data[i].con_para_name1+'</label>';
                      //console.logg(data[i].offer_value1);
                        //op+='<input id="offer_value1" type="text" class="form-control " name="offer_value1" value="'+data[i].offer_value_name1+'" >';
                        if(data[i].offer_value_flag1 ==1)
                        {
                          $('.lacam').html(" ");
                          if(data[i].offer_value1 != null)
                          {
                          opcam+='<div class="input"><input id="offer_value1" readonly type="text" class="form-control" name="offer_value1"  value='+data[i].offer_value1+' ></div>';
                          }
                          else{

                            opcam+='<input id="offer_value1" type="text" readonly class="form-control" name="offer_value1">';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value1" type="text" class="form-control" name="offer_value1"   >';
                        }

                        if(data[i].offer_value_flag2 == 1)
                        {
                          $('.lacam2').html(" ");
                          if(data[i].offer_value2 != null)
                          {
                          opcam2+='<div class="input"><input id="offer_value2" readonly type="text" class="form-control" name="offer_value2"  value='+data[i].offer_value2+' ></div>';
                          }
                          else{
                            opcam2+='<input id="offer_value2" type="text" readonly class="form-control" name="offer_value2"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_value_flag3 == 1)
                        {
                          $('.lacam3').html(" ");
                          if(data[i].offer_value3 != null)
                          {
                          opcam3+='<div class="input"><input id="offer_value3" readonly type="text" class="form-control" name="offer_value3"  value='+data[i].offer_value3+' ></div>';
                          }
                          else{
                            opcam3+='<input id="offer_value3" type="text" readonly class="form-control" name="offer_value3"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_value_flag4 == 1)
                        {
                          $('.lacam4').html(" ");

                          if(data[i].offer_value4 != null)
                          {
                          opcam4+='<div class="input"><input id="offer_value4" readonly type="text" class="form-control" name="offer_value4"  value='+data[i].offer_value4+' ></div>';
                          }
                          else{
                            opcam4+='<input id="offer_value4" type="text" readonly class="form-control" name="offer_value4"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag5 == 1)
                        {
                          $('.lacam5').html(" ");

                          if(data[i].offer_value5 != null)
                          {
                          opcam5+='<div class="input"><input id="offer_value5" readonly type="text" class="form-control" name="offer_value5"  value='+data[i].offer_value5+' ></div>';
                          }
                          else{
                            opcam5+='<input id="offer_value5" type="text" readonly class="form-control" name="offer_value5"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_value_flag6 == 1)
                        {
                          $('.lacam6').html(" ");

                          if(data[i].offer_value6 != null)
                          {
                          opcam6+='<div class="input"><input id="offer_value6" readonly type="text" class="form-control" name="offer_value6"  value='+data[i].offer_value6+' ></div>';
                          }
                          else{
                            opcam6+='<input id="offer_value6" type="text" readonly class="form-control" name="offer_value6"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_value_flag7 == 1)
                        {
                          $('.lacam7').html(" ");

                          if(data[i].offer_value7 != null)
                          {
                          opcam7+='<div class="input"><input id="offer_value7" readonly type="text" class="form-control" name="offer_value7"  value='+data[i].offer_value7+' ></div>';
                          }
                          else{
                            opcam7+='<input id="offer_value7" type="text" readonly class="form-control" name="offer_value7"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_value_flag8 == 1)
                        {
                          $('.lacam8').html(" ");

                          if(data[i].offer_value8 != null)
                          {
                          opcam8+='<div class="input"><input id="offer_value8" readonly type="text" class="form-control" name="offer_value8"  value='+data[i].offer_value8+' ></div>';
                          }
                          else{
                            opcam8+='<input id="offer_value8" type="text" readonly class="form-control" name="offer_value8"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag9 == 1)
                        {
                          $('.lacam9').html(" ");

                          if(data[i].offer_value9 != null)
                          {
                          opcam9+='<div class="input"><input id="offer_value9" readonly type="text" class="form-control" name="offer_value9"  value='+data[i].offer_value9+' ></div>';
                          }
                          else{
                            opcam9+='<input id="offer_value9" type="text" readonly class="form-control" name="offer_value9"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag10 == 1)
                        {
                          $('.lacam10').html(" ");

                          if(data[i].offer_value10 != null)
                          {
                          opcam10+='<div class="input"><input id="offer_value10" readonly type="text" class="form-control" name="offer_value10"  value='+data[i].offer_value10+' ></div>';
                          }
                          else{
                            opcam10+='<input id="offer_value10" type="text" readonly class="form-control" name="offer_value10"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag11 == 1)
                        {
                          $('.lacam11').html(" ");

                          if(data[i].offer_value11 != null)
                          {
                          opcam11+='<div class="input"><input id="offer_value11" readonly type="text" class="form-control" name="offer_value11"  value='+data[i].offer_value11+' ></div>';
                          }
                          else{
                            opcam11+='<input id="offer_value11" type="text" readonly class="form-control" name="offer_value11"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag12 == 1)
                        {
                          $('.lacam12').html(" ");

                          if(data[i].offer_value12 != null)
                          {
                          opcam12+='<div class="input"><input id="offer_value12" readonly type="text" class="form-control" name="offer_value12"  value='+data[i].offer_value12+' ></div>';
                          }
                          else{
                            opcam12+='<input id="offer_value12" type="text" readonly class="form-control" name="offer_value12"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }


                        if(data[i].offer_value_flag13 == 1)
                        {
                          $('.lacam13').html(" ");

                          if(data[i].offer_value13 != null)
                          {
                          opcam13+='<div class="input"><input id="offer_value13" readonly type="text" class="form-control" name="offer_value13"  value='+data[i].offer_value13+' ></div>';
                          }
                          else{
                            opcam13+='<input id="offer_value13" type="text" readonly class="form-control" name="offer_value13"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag14 == 1)
                        {
                          $('.lacam14').html(" ");

                          if(data[i].offer_value14 != null)
                          {
                          opcam14+='<div class="input"><input id="offer_value14" readonly type="text" class="form-control" name="offer_value14"  value='+data[i].offer_value14+' ></div>';
                          }
                          else{
                            opcam14+='<input id="offer_value14" type="text" readonly class="form-control" name="offer_value14"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag15 == 1)
                        {
                          $('.lacam15').html(" ");

                          if(data[i].offer_value15 != null)
                          {
                          opcam15+='<div class="input"><input id="offer_value15" readonly type="text" class="form-control" name="offer_value15"  value='+data[i].offer_value15+' ></div>';
                          }
                          else{
                            opcam15+='<input id="offer_value15" type="text" readonly class="form-control" name="offer_value15"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag16 == 1)
                        {
                          $('.lacam16').html(" ");

                          if(data[i].offer_value16 != null)
                          {
                          opcam16+='<div class="input"><input id="offer_value16" readonly type="text" class="form-control" name="offer_value16"  value='+data[i].offer_value16+' ></div>';
                          }
                          else{
                            opcam16+='<input id="offer_value16" type="text" readonly class="form-control" name="offer_value16"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_value_flag17 == 1)
                        {
                          $('.lacam17').html(" ");

                          if(data[i].offer_value17 != null)
                          {
                          opcam17+='<div class="input"><input id="offer_value17" readonly type="text" class="form-control" name="offer_value17"  value='+data[i].offer_value17+' ></div>';
                          }
                          else{
                            opcam17+='<input id="offer_value17" type="text" readonly class="form-control" name="offer_value17"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag18 == 1)
                        {
                          $('.lacam18').html(" ");

                          if(data[i].offer_value18 != null)
                          {
                          opcam18+='<div class="input"><input id="offer_value18" readonly type="text" class="form-control" name="offer_value17"  value='+data[i].offer_value18+' ></div>';
                          }
                          else{
                            opcam18+='<input id="offer_value18" type="text" readonly class="form-control" name="offer_value17"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag19 == 1)
                        {
                          $('.lacam19').html(" ");

                          if(data[i].offer_value19 != null)
                          {
                          opcam19+='<div class="input"><input id="offer_value19" readonly type="text" class="form-control" name="offer_value19"  value='+data[i].offer_value19+' ></div>';
                          }
                          else{
                            opcam19+='<input id="offer_value19" type="text" readonly class="form-control" name="offer_value19"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag20 == 1)
                        {
                          $('.lacam20').html(" ");

                          if(data[i].offer_value20 != null)
                          {
                          opcam20+='<div class="input"><input id="offer_value20" readonly type="text" class="form-control" name="offer_value20"  value='+data[i].offer_value20+' ></div>';
                          }
                          else{
                            opcam20+='<input id="offer_value20" type="text" readonly class="form-control" name="offer_value20"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag21 == 1)
                        {
                          $('.lacam21').html(" ");

                          if(data[i].offer_value21 != null)
                          {
                          opcam21+='<div class="input"><input id="offer_value21" readonly type="text" class="form-control" name="offer_value21"  value='+data[i].offer_value21+' ></div>';
                          }
                          else{
                            opcam21+='<input id="offer_value21" type="text" readonly class="form-control" name="offer_value21"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag22 == 1)
                        {
                          $('.lacam22').html(" ");

                          if(data[i].offer_value22 != null)
                          {
                          opcam22+='<div class="input"><input id="offer_value22" readonly type="text" class="form-control" name="offer_value22"  value='+data[i].offer_value22+' ></div>';
                          }
                          else{
                            opcam22+='<input id="offer_value22" type="text" readonly class="form-control" name="offer_value22"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag23 == 1)
                        {
                          $('.lacam23').html(" ");

                          if(data[i].offer_value23 != null)
                          {
                          opcam23+='<div class="input"><input id="offer_value23" readonly type="text" class="form-control" name="offer_value23"  value='+data[i].offer_value23+' ></div>';
                          }
                          else{
                            opcam23+='<input id="offer_value23" type="text" readonly class="form-control" name="offer_value23"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag24 == 1)
                        {
                          $('.lacam24').html(" ");

                          if(data[i].offer_value24 != null)
                          {
                          opcam24+='<div class="input"><input id="offer_value24" readonly type="text" class="form-control" name="offer_value24"  value='+data[i].offer_value23+' ></div>';
                          }
                          else{
                            opcam24+='<input id="offer_value24" type="text" readonly class="form-control" name="offer_value24"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_value_flag25 == 1)
                        {
                          $('.lacam25').html(" ");
                          if(data[i].offer_value25 != null)
                          {
                          opcam25+='<div class="input"><input id="offer_value25" readonly type="text" class="form-control" name="offer_value25"  value='+data[i].offer_value25+' ></div>';
                          }
                          else{
                            opcam25+='<input id="offer_value25" type="text" readonly class="form-control" name="offer_value25"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag26 == 1)
                        {
                          $('.lacam26').html(" ");

                          if(data[i].offer_value26 != null)
                          {
                          opcam26+='<div class="input"><input id="offer_value26" readonly type="text" class="form-control" name="offer_value26"  value='+data[i].offer_value26+' ></div>';
                          }
                          else{
                            opcam26+='<input id="offer_value26" type="text" readonly class="form-control" name="offer_value26"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag27 == 1)
                        {
                          $('.lacam27').html(" ");

                          if(data[i].offer_value27 != null)
                          {
                          opcam27+='<div class="input"><input id="offer_value27" readonly type="text" class="form-control" name="offer_value27"  value='+data[i].offer_value27+' ></div>';
                          }
                          else{
                            opcam27+='<input id="offer_value27" type="text" readonly class="form-control" name="offer_value27"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }


                        if(data[i].offer_value_flag28 == 1)
                        {
                          $('.lacam28').html(" ");

                          if(data[i].offer_value28 != null)
                          {
                          opcam28+='<div class="input"><input id="offer_value28" readonly type="text" class="form-control" name="offer_value28"  value='+data[i].offer_value28+' ></div>';
                          }
                          else{
                            opcam28+='<input id="offer_value28" type="text" readonly class="form-control" name="offer_value28"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }


                        if(data[i].offer_value_flag29 == 1)
                        {
                          $('.lacam29').html(" ");

                          if(data[i].offer_value29 != null)
                          {
                          opcam29+='<div class="input"><input id="offer_value29" readonly type="text" class="form-control" name="offer_value29"  value='+data[i].offer_value29+' ></div>';
                          }
                          else{
                            opcam29+='<input id="offer_value29" type="text" readonly class="form-control" name="offer_value29"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag30 == 1)
                        {
                          $('.lacam30').html(" ");

                          if(data[i].offer_value30 != null)
                          {
                          opcam30+='<div class="input"><input id="offer_value30" readonly type="text" class="form-control" name="offer_value30"  value='+data[i].offer_value30+' ></div>';
                          }
                          else{
                            opcam30+='<input id="offer_value30" type="text" readonly class="form-control" name="offer_value30"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag31 == 1)
                        {
                          $('.lacam31').html(" ");

                          if(data[i].offer_value31 != null)
                          {
                          opcam31+='<div class="input"><input id="offer_value31" readonly type="text" class="form-control" name="offer_value31"  value='+data[i].offer_value31+' ></div>';
                          }
                          else{
                            opcam31+='<input id="offer_value31" type="text" readonly class="form-control" name="offer_value31"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }


                        if(data[i].offer_value_flag32 == 1)
                        {
                          $('.lacam32').html(" ");

                          if(data[i].offer_value32 != null)
                          {
                          opcam32+='<div class="input"><input id="offer_value32" readonly type="text" class="form-control" name="offer_value32"  value='+data[i].offer_value32+' ></div>';
                          }
                          else{
                            opcam32+='<input id="offer_value32" type="text" readonly class="form-control" name="offer_value32"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag33 == 1)
                        {
                          $('.lacam33').html(" ");

                          if(data[i].offer_value33 != null)
                          {
                          opcam33+='<div class="input"><input id="offer_value33" readonly type="text" class="form-control" name="offer_value33"  value='+data[i].offer_value33+' ></div>';
                          }
                          else{
                            opcam33+='<input id="offer_value33" type="text" readonly class="form-control" name="offer_value33"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_value_flag34 == 1)
                        {
                          $('.lacam34').html(" ");

                          if(data[i].offer_value34 != null)
                          {
                          opcam34+='<div class="input"><input id="offer_value34" readonly type="text" class="form-control" name="offer_value34"  value='+data[i].offer_value34+' ></div>';
                          }
                          else{
                            opcam34+='<input id="offer_value34" type="text" readonly class="form-control" name="offer_value34"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag35 == 1)
                        {
                          $('.lacam35').html(" ");

                          if(data[i].offer_value35 != null)
                          {
                          opcam35+='<div class="input"><input id="offer_value35" readonly type="text" class="form-control" name="offer_value35"  value='+data[i].offer_value35+' ></div>';
                          }
                          else{
                            opcam35+='<input id="offer_value35" type="text" readonly class="form-control" name="offer_value35"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }


                        if(data[i].offer_value_flag36 == 1)
                        {
                          $('.lacam36').html(" ");

                          if(data[i].offer_value36 != null)
                          {
                          opcam36+='<div class="input"><input id="offer_value36" readonly type="text" class="form-control" name="offer_value36"  value='+data[i].offer_value36+' ></div>';
                          }
                          else{
                            opcam36+='<input id="offer_value36" type="text" readonly class="form-control" name="offer_value36"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }


                        if(data[i].offer_value_flag37 == 1)
                        {
                          $('.lacam37').html(" ");

                          if(data[i].offer_value37 != null)
                          {
                          opcam37+='<div class="input"><input id="offer_value37" readonly type="text" class="form-control" name="offer_value37"  value='+data[i].offer_value37+' ></div>';
                          }
                          else{
                            opcam37+='<input id="offer_value37" type="text" readonly class="form-control" name="offer_value37"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }


                        if(data[i].offer_value_flag38 == 1)
                        {
                          $('.lacam38').html(" ");

                          if(data[i].offer_value38 != null)
                          {
                          opcam38+='<div class="input"><input id="offer_value38" readonly type="text" class="form-control" name="offer_value38"  value='+data[i].offer_value38+' ></div>';
                          }
                          else{
                            opcam38+='<input id="offer_value38" type="text" readonly class="form-control" name="offer_value38"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }


                        if(data[i].offer_value_flag39 == 1)
                        {
                          $('.lacam39').html(" ");

                          if(data[i].offer_value39 != null)
                          {
                          opcam39+='<div class="input"><input id="offer_value39" readonly type="text" class="form-control" name="offer_value39"  value='+data[i].offer_value39+' ></div>';
                          }
                          else{
                            opcam39+='<input id="offer_value39" type="text" readonly class="form-control" name="offer_value39"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_value_flag40 == 1)
                        {
                          $('.lacam40').html(" ");

                          if(data[i].offer_value40 != null)
                          {
                          opcam40+='<div class="input"><input id="offer_value40" readonly type="text" class="form-control" name="offer_value40"  value='+data[i].offer_value40+' ></div>';
                          }
                          else{
                            opcam40+='<input id="offer_value40" type="text" readonly class="form-control" name="offer_value40"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_detail_value_flag1 == 1)
                        {
                          $('.lacamdetail').html(" ");

                          if(data[i].offer_detail_value1 != null)
                          {
                          opcamdetail+='<div class="input"><input id="offer_detail_value1" readonly type="text" class="form-control" name="offer_detail_value1"  value='+data[i].offer_detail_value1+' ></div>';
                          }
                          else{

                            opcamdetail+='<input id="offer_detail_value1" type="text" readonly class="form-control" name="offer_detail_value1"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }
                        if(data[i].offer_detail_value_flag2 == 1)
                        {

                          $('.lacamdetail2').html(" ");

                          if(data[i].offer_detail_value2 != null)
                          {
                          opcamdetail2+='<div class="input"><input id="offer_detail_value2" readonly type="text" class="form-control" name="offer_detail_value2"  value='+data[i].offer_detail_value2+' ></div>';
                          }
                          else{
                            opcamdetail2+='<input id="offer_detail_value2" type="text" readonly class="form-control" name="offer_detail_value2"   >';
                          }
                        }
                        else{

                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag3 == 1)
                        {
                          $('.lacamdetail3').html(" ");
                          if(data[i].offer_detail_value3 != null)
                          {
                          opcamdetail3+='<div class="input"><input id="offer_detail_value3" readonly type="text" class="form-control" name="offer_detail_value3"  value='+data[i].offer_detail_value3+' ></div>';
                          }
                          else{

                            opcamdetail3+='<input id="offer_detail_value3" type="text" readonly class="form-control" name="offer_detail_value3"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag4 == 1)
                        {
                          $('.lacamdetail4').html(" ");

                          if(data[i].offer_detail_value4 != null)
                          {
                          opcamdetail4+='<div class="input"><input id="offer_detail_value4" readonly type="text" class="form-control" name="offer_detail_value4"  value='+data[i].offer_detail_value4+' ></div>';
                          }
                          else{
                            opcamdetail4+='<input id="offer_detail_value4" type="text" readonly class="form-control" name="offer_detail_value4"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag5 == 1)
                        {
                          $('.lacamdetail5').html(" ");
                          if(data[i].offer_detail_value5 != null)
                          {
                          opcamdetail5+='<div class="input"><input id="offer_detail_value5" readonly type="text" class="form-control" name="offer_detail_value5"  value='+data[i].offer_detail_value5+' ></div>';
                          }
                          else{
                            opcamdetail5+='<input id="offer_detail_value5" type="text" readonly class="form-control" name="offer_detail_value5"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag6 == 1)
                        {
                          $('.lacamdetail6').html(" ");

                          if(data[i].offer_detail_value6 != null)
                          {
                          opcamdetail6+='<div class="input"><input id="offer_detail_value6" readonly type="text" class="form-control" name="offer_detail_value6"  value='+data[i].offer_detail_value6+' ></div>';
                          }
                          else{
                            opcamdetail6+='<input id="offer_detail_value6" type="text" readonly class="form-control" name="offer_detail_value6"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag7 == 1)
                        {
                          $('.lacamdetail7').html(" ");
                          if(data[i].offer_detail_value7 != null)
                          {
                          opcamdetail7+='<div class="input"><input id="offer_detail_value7" readonly type="text" class="form-control" name="offer_detail_value7"  value='+data[i].offer_detail_value7+' ></div>';
                          }
                          else{
                            opcamdetail7+='<input id="offer_detail_value7" type="text" readonly class="form-control" name="offer_detail_value7"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag8 == 1)
                        {
                          $('.lacamdetail8').html(" ");
                          if(data[i].offer_detail_value8 != null)
                          {
                          opcamdetail8+='<div class="input"><input id="offer_detail_value8" readonly type="text" class="form-control" name="offer_detail_value8"  value='+data[i].offer_detail_value8+' ></div>';
                          }
                          else{
                            opcamdetail8+='<input id="offer_detail_value8" type="text" readonly class="form-control" name="offer_detail_value8"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag9 == 1)
                        {
                          $('.lacamdetail9').html(" ");
                          if(data[i].offer_detail_value9 != null)
                          {
                          opcamdetail9+='<div class="input"><input id="offer_detail_value9" readonly type="text" class="form-control" name="offer_detail_value9"  value='+data[i].offer_detail_value9+' ></div>';
                          }
                          else{
                            opcamdetail9+='<input id="offer_detail_value9" type="text" readonly class="form-control" name="offer_detail_value9"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag10 == 1)
                        {
                          $('.lacamdetail10').html(" ");
                          if(data[i].offer_detail_value10 != null)
                          {
                          opcamdetail10+='<div class="input"><input id="offer_detail_value10" readonly type="text" class="form-control" name="offer_detail_value10"  value='+data[i].offer_detail_value10+' ></div>';
                          }
                          else{
                            opcamdetail10+='<input id="offer_detail_value10" type="text" readonly class="form-control" name="offer_detail_value10"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag11 == 1)
                        {
                          $('.lacamdetail11').html(" ");
                          if(data[i].offer_detail_value11 != null)
                          {
                          opcamdetail11+='<div class="input"><input id="offer_detail_value11" readonly type="text" class="form-control" name="offer_detail_value11"  value='+data[i].offer_detail_value11+' ></div>';
                          }
                          else{
                            opcamdetail11+='<input id="offer_detail_value11" type="text" readonly class="form-control" name="offer_detail_value11"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag12 == 1)
                        {
                          $('.lacamdetail12').html(" ");
                          if(data[i].offer_detail_value12 != null)
                          {
                          opcamdetail12+='<div class="input"><input id="offer_detail_value12" readonly type="text" class="form-control" name="offer_detail_value12"  value='+data[i].offer_detail_value12+' ></div>';
                          }
                          else{
                            opcamdetail12+='<input id="offer_detail_value12" type="text" readonly class="form-control" name="offer_detail_value12"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag13 == 1)
                        {
                          $('.lacamdetail13').html(" ");
                          if(data[i].offer_detail_value13 != null)
                          {
                          opcamdetail13+='<div class="input"><input id="offer_detail_value13" readonly type="text" class="form-control" name="offer_detail_value13"  value='+data[i].offer_detail_value13+' ></div>';
                          }
                          else{
                            opcamdetail13+='<input id="offer_detail_value13" type="text" readonly class="form-control" name="offer_detail_value13"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag14 == 1)
                        {
                          $('.lacamdetail14').html(" ");
                          if(data[i].offer_detail_value14 != null)
                          {
                          opcamdetail14+='<div class="input"><input id="offer_detail_value14" readonly type="text" class="form-control" name="offer_detail_value14"  value='+data[i].offer_detail_value14+' ></div>';
                          }
                          else{
                            opcamdetail14+='<input id="offer_detail_value14" type="text" readonly class="form-control" name="offer_detail_value14"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag15 == 1)
                        {
                          $('.lacamdetail15').html(" ");
                          if(data[i].offer_detail_value15 != null)
                          {
                          opcamdetail15+='<div class="input"><input id="offer_detail_value15" readonly type="text" class="form-control" name="offer_detail_value15"  value='+data[i].offer_detail_value15+' ></div>';
                          }
                          else{
                            opcamdetail15+='<input id="offer_detail_value15" type="text" readonly class="form-control" name="offer_detail_value15"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag16 == 1)
                        {
                          $('.lacamdetail16').html(" ");
                          if(data[i].offer_detail_value16 != null)
                          {
                          opcamdetail16+='<div class="input"><input id="offer_detail_value16" readonly type="text" class="form-control" name="offer_detail_value16"  value='+data[i].offer_detail_value16+' ></div>';
                          }
                          else{
                            opcamdetail16+='<input id="offer_detail_value16" type="text" readonly class="form-control" name="offer_detail_value16"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag17 == 1)
                        {
                          $('.lacamdetail17').html(" ");
                          if(data[i].offer_detail_value17 != null)
                          {
                          opcamdetail17+='<div class="input"><input id="offer_detail_value17" readonly type="text" class="form-control" name="offer_detail_value17"  value='+data[i].offer_detail_value17+' ></div>';
                          }
                          else{
                            opcamdetail17+='<input id="offer_detail_value17" type="text" readonly class="form-control" name="offer_detail_value17"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag18 == 1)
                        {
                          $('.lacamdetail18').html(" ");
                          if(data[i].offer_detail_value18 != null)
                          {
                          opcamdetail18+='<div class="input"><input id="offer_detail_value18" readonly type="text" class="form-control" name="offer_detail_value18"  value='+data[i].offer_detail_value18+' ></div>';
                          }
                          else{
                            opcamdetail18+='<input id="offer_detail_value18" type="text" readonly class="form-control" name="offer_detail_value18"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag19 == 1)
                        {
                          $('.lacamdetail19').html(" ");
                          if(data[i].offer_detail_value19 != null)
                          {
                          opcamdetail19+='<div class="input"><input id="offer_detail_value19" readonly type="text" class="form-control" name="offer_detail_value19"  value='+data[i].offer_detail_value19+' ></div>';
                          }
                          else{
                            opcamdetail19+='<input id="offer_detail_value19" type="text" readonly class="form-control" name="offer_detail_value19"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_detail_value_flag20 == 1)
                        {
                          $('.lacamdetail20').html(" ");
                          if(data[i].offer_detail_value20 != null)
                          {
                          opcamdetail20+='<div class="input"><input id="offer_detail_value20" readonly type="text" class="form-control" name="offer_detail_value20"  value='+data[i].offer_detail_value20+' ></div>';
                          }
                          else{
                            opcamdetail20+='<input id="offer_detail_value20" type="text" readonly class="form-control" name="offer_detail_value20"   >';
                          }
                        }
                        else{
                        //  opcam+='<input id="offer_value2" type="text" class="form-control" name="offer_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag1 ==1)
                        {
                          $('.lacampay').html(" ");
                          if(data[i].offer_payment_value1 != null)
                          {
                          opcampay+='<div class="input"><input id="offer_payment_value1"  onKeyUp="chgtext()"readonly type="text" class="form-control" name="offer_payment_value1"  value='+data[i].offer_payment_value1+' ></div>';
                          }
                          else{

                            opcampay+='<input id="offer_payment_value1"  onKeyUp="chgtext()"type="text" readonly class="form-control" name="offer_payment_value1">';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value1"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value1"   >';
                        }

                        if(data[i].offer_payment_value_flag2 == 1)
                        {
                          $('.lacampay2').html(" ");
                          if(data[i].offer_payment_value2 != null)
                          {
                          opcampay2+='<div class="input"><input id="offer_payment_value2"  onKeyUp="chgtext()"readonly type="text" class="form-control" name="offer_payment_value2"  value='+data[i].offer_payment_value2+' ></div>';
                          }
                          else{
                            opcampay2+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" readonly class="form-control" name="offer_payment_value2"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
                        if(data[i].offer_payment_value_flag3 == 1)
                        {
                          $('.lacampay3').html(" ");
                          if(data[i].offer_payment_value3 != null)
                          {
                          opcampay3+='<div class="input"><input id="offer_payment_value3"  onKeyUp="chgtext()"readonly type="text" class="form-control" name="offer_payment_value3"  value='+data[i].offer_payment_value3+' ></div>';
                          }
                          else{
                            opcampay3+='<input id="offer_payment_value3"  onKeyUp="chgtext()"type="text" readonly class="form-control" name="offer_payment_value3"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
                        if(data[i].offer_payment_value_flag4 == 1)
                        {
                          $('.lacampay4').html(" ");

                          if(data[i].offer_payment_value4 != null)
                          {
                          opcampay4+='<div class="input"><input id="offer_payment_value4" readonly onKeyUp="chgtext()" type="text" class="form-control" name="offer_payment_value4"  value='+data[i].offer_payment_value4+' ></div>';
                          }
                          else{
                            opcampay4+='<input id="offer_payment_value4" readonly onKeyUp="chgtext()"type="text" readonly class="form-control" name="offer_payment_value4"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag5 == 1)
                        {
                          $('.lacampay5').html(" ");

                          if(data[i].offer_payment_value5 != null)
                          {
                          opcampay5+='<div class="input"><input id="offer_payment_value5" readonly type="text" class="form-control" name="offer_payment_value5"  value='+data[i].offer_payment_value5+' ></div>';
                          }
                          else{
                            opcampay5+='<input id="offer_payment_value5" type="text" readonly class="form-control" name="offer_payment_value5"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
                        if(data[i].offer_payment_value_flag6 == 1)
                        {
                          $('.lacampay6').html(" ");

                          if(data[i].offer_payment_value6 != null)
                          {
                          if(data[i].offer_payment_value6 == 1)
                          {
                            opcampay6+='<div class="input"><select  readonly id="offer_payment_value6" class="form-control" onchange="chgtext()"><option value="1">อัตราค่าคอมมิชชั่น</option></select></div>';
                          }
                          else if(data[i].offer_payment_value6 == 2)
                          {
                            opcampay6+='<div class="input"><select readonly id="offer_payment_value6" class="form-control" onchange="chgtext()"><option value="2">ค่าคอมมิชชั่นที่แจ้ง</option></select></div>';
                          }
                          else if(data[i].offer_payment_value6 == 3)
                          {
                            opcampay6+='<div class="input"><select readonly id="offer_payment_value6" class="form-control" onchange="chgtext()"><option value="3">เบี้ยนำจ่ายก่อนหักภาษี ณ ที่จ่าย</option></select></div>';
                          }
                          else
                          {
                            opcampay6+='<div class="input"><select readonly id="offer_payment_value6" class="form-control" onchange="chgtext()"><option value="0">-เลือกหมวดการคำนวณ-</option></select></div>';
                          }
                          }
                          else{
                            opcampay6+='<input id="offer_payment_value6" type="text" readonly class="form-control" name="offer_payment_value6"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
                        if(data[i].offer_payment_value_flag7 == 1)
                        {
                          $('.lacampay7').html(" ");

                          if(data[i].offer_payment_value7 != null)
                          {
                          opcampay7+='<div class="input"><input id="offer_payment_value7" readonly type="text" class="form-control" name="offer_payment_value7"  value='+data[i].offer_payment_value7+' ></div>';
                          }
                          else{
                            opcampay7+='<input id="offer_payment_value7" type="text" readonly class="form-control" name="offer_payment_value7"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
                        if(data[i].offer_payment_value_flag8 == 1)
                        {
                          $('.lacampay8').html(" ");

                          if(data[i].offer_payment_value8 != null)
                          {
                          opcampay8+='<div class="input"><input id="offer_payment_value8" readonly type="text" class="form-control" name="offer_payment_value8"  value='+data[i].offer_payment_value8+' ></div>';
                          }
                          else{
                            opcampay8+='<input id="offer_payment_value8" type="text" readonly class="form-control" name="offer_payment_value8"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag9 == 1)
                        {
                          $('.lacampay9').html(" ");

                          if(data[i].offer_payment_value9 != null)
                          {
                          opcampay9+='<div class="input"><input id="offer_payment_value9" readonly type="text" class="form-control" name="offer_payment_value9"  value='+data[i].offer_payment_value9+' ></div>';
                          }
                          else{
                            opcampay9+='<input id="offer_payment_value9" type="text" readonly class="form-control" name="offer_payment_value9"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag10 == 1)
                        {
                          $('.lacampay10').html(" ");

                          if(data[i].offer_payment_value10 != null)
                          {
                          opcampay10+='<div class="input"><input id="offer_payment_value10" readonly type="text" class="form-control" name="offer_payment_value10"  value='+data[i].offer_payment_value10+' ></div>';
                          }
                          else{
                            opcampay10+='<input id="offer_payment_value10" type="text" readonly class="form-control" name="offer_payment_value10"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag11 == 1)
                        {
                          $('.lacampay11').html(" ");

                          if(data[i].offer_payment_value11 != null)
                          {
                          opcampay11+='<div class="input"><input id="offer_payment_value11" readonly type="text" class="form-control" name="offer_payment_value11"  value='+data[i].offer_payment_value11+' ></div>';
                          }
                          else{
                            opcampay11+='<input id="offer_payment_value11" type="text" readonly class="form-control" name="offer_payment_value11"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag12 == 1)
                        {
                          $('.lacampay12').html(" ");

                          if(data[i].offer_payment_value12 != null)
                          {
                          opcampay12+='<div class="input"><input id="offer_payment_value12" readonly type="text" class="form-control" name="offer_payment_value12"  value='+data[i].offer_payment_value12+' ></div>';
                          }
                          else{
                            opcampay12+='<input id="offer_payment_value12" type="text" readonly class="form-control" name="offer_payment_value12"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }


                        if(data[i].offer_payment_value_flag13 == 1)
                        {
                          $('.lacampay13').html(" ");

                          if(data[i].offer_payment_value13 != null)
                          {
                          opcampay13+='<div class="input"><input id="offer_payment_value13" readonly type="text" class="form-control" name="offer_payment_value13"  value='+data[i].offer_payment_value13+' ></div>';
                          }
                          else{
                            opcampay13+='<input id="offer_payment_value13" type="text" readonly class="form-control" name="offer_payment_value13"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag14 == 1)
                        {
                          $('.lacampay14').html(" ");

                          if(data[i].offer_payment_value14 != null)
                          {
                          opcampay14+='<div class="input"><input id="offer_payment_value14" readonly type="text" class="form-control" name="offer_payment_value14"  value='+data[i].offer_payment_value14+' ></div>';
                          }
                          else{
                            opcampay14+='<input id="offer_payment_value14" type="text" readonly class="form-control" name="offer_payment_value14"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag15 == 1)
                        {
                          $('.lacampay15').html(" ");

                          if(data[i].offer_payment_value15 != null)
                          {
                          opcampay15+='<div class="input"><input id="offer_payment_value15" readonly type="text" class="form-control" name="offer_payment_value15"  value='+data[i].offer_payment_value15+' ></div>';
                          }
                          else{
                            opcampay15+='<input id="offer_payment_value15" type="text" readonly class="form-control" name="offer_payment_value15"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag16 == 1)
                        {
                          $('.lacampay16').html(" ");

                          if(data[i].offer_payment_value16 != null)
                          {
                          opcampay16+='<div class="input"><div class="input-group date"><input id="offer_payment_value16" readonly type="text" class="form-control" name="offer_payment_value16"  value='+data[i].offer_payment_value16+' ><div class="input-group-addon"> <span class="partnerquota"></span></div></div>';
                          }
                          else{
                            opcampay16+='<div class="input-group date"><input id="offer_payment_value16" type="text" readonly class="form-control" name="offer_payment_value16"   ><div class="input-group-addon"> <span class="partnerquota"></span></div>';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
                        if(data[i].offer_payment_value_flag17 == 1)
                        {
                          $('.lacampay17').html(" ");

                          if(data[i].offer_payment_value17 != null)
                          {
                          opcampay17+='<div class="input"><input id="offer_payment_value17" readonly type="text" class="form-control" name="offer_payment_value17"  value='+data[i].offer_payment_value17+' ></div>';
                          }
                          else{
                            opcampay17+='<div class="input-group date"><input id="offer_payment_value17" type="text" readonly class="form-control" name="offer_payment_value17"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag18 == 1)
                        {
                          $('.lacampay18').html(" ");

                          if(data[i].offer_payment_value18 != null)
                          {
                          opcampay18+='<div class="input"><div class="input-group date"><input id="offer_payment_value18" readonly type="text" class="form-control" name="offer_payment_value18"  value='+data[i].offer_payment_value18+' ><div class="input-group-addon"> <span class="userquota"></span></div></div>';
                          }
                          else{
                            opcampay18+='<input id="offer_payment_value18" type="text" readonly class="form-control" name="offer_payment_value17"   ><div class="input-group-addon"> <span class="userquota"></span></div>';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag19 == 1)
                        {
                          $('.lacampay19').html(" ");

                          if(data[i].offer_payment_value19 != null)
                          {
                          opcampay19+='<div class="input"><input id="offer_payment_value19" readonly type="text" class="form-control" name="offer_payment_value19"  readonly value='+data[i].offer_payment_value19+' ></div>';
                          }
                          else{
                            opcampay19+='<input id="offer_payment_value19" type="text" readonly class="form-control" name="offer_payment_value19" readonly  >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag20 == 1)
                        {
                          $('.lacampay20').html(" ");

                          if(data[i].offer_payment_value20 != null)
                          {
                          opcampay20+='<div class="input"><input id="offer_payment_value20" readonly type="text" class="form-control" name="offer_payment_value20"  value='+data[i].offer_payment_value20+' ></div>';
                          }
                          else{
                            opcampay20+='<input id="offer_payment_value20" type="text" readonly class="form-control" name="offer_payment_value20"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag21 == 1)
                        {
                          $('.lacampay21').html(" ");

                          if(data[i].offer_payment_value21 != null)
                          {
                          opcampay21+='<div class="input"><input id="offer_payment_value21" readonly type="text" class="form-control" name="offer_payment_value21"  value='+data[i].offer_payment_value21+' ></div>';
                          }
                          else{
                            opcampay21+='<input id="offer_payment_value21" type="text" readonly class="form-control" name="offer_payment_value21"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag22 == 1)
                        {
                          $('.lacampay22').html(" ");

                          if(data[i].offer_payment_value22 != null)
                          {
                          opcampay22+='<div class="input"><input id="offer_payment_value22" readonly type="text" class="form-control" name="offer_payment_value22"  value='+data[i].offer_payment_value22+' ></div>';
                          }
                          else{
                            opcampay22+='<input id="offer_payment_value22" type="text" readonly class="form-control" name="offer_payment_value22"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag23 == 1)
                        {
                          $('.lacampay23').html(" ");

                          if(data[i].offer_payment_value23 != null)
                          {
                          opcampay23+='<div class="input"><input id="offer_payment_value23" readonly type="text" class="form-control" name="offer_payment_value23"  value='+data[i].offer_payment_value23+' ></div>';
                          }
                          else{
                            opcampay23+='<input id="offer_payment_value23" type="text" readonly class="form-control" name="offer_payment_value23"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag24 == 1)
                        {
                          $('.lacampay24').html(" ");

                          if(data[i].offer_payment_value24 != null)
                          {
                          opcampay24+='<div class="input"><input id="offer_payment_value24" readonly type="text" class="form-control" name="offer_payment_value24"  value='+data[i].offer_payment_value23+' ></div>';
                          }
                          else{
                            opcampay24+='<input id="offer_payment_value24" type="text" readonly class="form-control" name="offer_payment_value24"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
                        if(data[i].offer_payment_value_flag25 == 1)
                        {
                          $('.lacampay25').html(" ");
                          if(data[i].offer_payment_value25 != null)
                          {
                          opcampay25+='<div class="input"><input id="offer_payment_value25" readonly type="text" class="form-control" name="offer_payment_value25"  value='+data[i].offer_payment_value25+' ></div>';
                          }
                          else{
                            opcampay25+='<input id="offer_payment_value25" type="text" readonly class="form-control" name="offer_payment_value25"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag26 == 1)
                        {
                          $('.lacampay26').html(" ");

                          if(data[i].offer_payment_value26 != null)
                          {
                          opcampay26+='<div class="input"><input id="offer_payment_value26" readonly type="text" class="form-control" name="offer_payment_value26"  value='+data[i].offer_payment_value26+' ></div>';
                          }
                          else{
                            opcampay26+='<input id="offer_payment_value26" type="text" readonly class="form-control" name="offer_payment_value26"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag27 == 1)
                        {
                          $('.lacampay27').html(" ");

                          if(data[i].offer_payment_value27 != null)
                          {
                          opcampay27+='<div class="input"><input id="offer_payment_value27" readonly type="text" class="form-control" name="offer_payment_value27"  value='+data[i].offer_payment_value27+' ></div>';
                          }
                          else{
                            opcampay27+='<input id="offer_payment_value27" type="text" readonly class="form-control" name="offer_payment_value27"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }


                        if(data[i].offer_payment_value_flag28 == 1)
                        {
                          $('.lacampay28').html(" ");

                          if(data[i].offer_payment_value28 != null)
                          {
                          opcampay28+='<div class="input"><input id="offer_payment_value28" readonly type="text" class="form-control" name="offer_payment_value28"  value='+data[i].offer_payment_value28+' ></div>';
                          }
                          else{
                            opcampay28+='<input id="offer_payment_value28" type="text" readonly class="form-control" name="offer_payment_value28"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }


                        if(data[i].offer_payment_value_flag29 == 1)
                        {
                          $('.lacampay29').html(" ");

                          if(data[i].offer_payment_value29 != null)
                          {
                          opcampay29+='<div class="input"><input id="offer_payment_value29" readonly type="text" class="form-control" name="offer_payment_value29"  value='+data[i].offer_payment_value29+' ></div>';
                          }
                          else{
                            opcampay29+='<input id="offer_payment_value29" type="text" readonly class="form-control" name="offer_payment_value29"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag30 == 1)
                        {
                          $('.lacampay30').html(" ");

                          if(data[i].offer_payment_value30 != null)
                          {
                          opcampay30+='<div class="input"><input id="offer_payment_value30" readonly type="text" class="form-control" name="offer_payment_value30"  value='+data[i].offer_payment_value30+' ></div>';
                          }
                          else{
                            opcampay30+='<input id="offer_payment_value30" type="text" readonly class="form-control" name="offer_payment_value30"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag31 == 1)
                        {
                          $('.lacampay31').html(" ");

                          if(data[i].offer_payment_value31 != null)
                          {
                          opcampay31+='<div class="input"><input id="offer_payment_value31" readonly type="text" class="form-control" name="offer_payment_value31"  value='+data[i].offer_payment_value31+' ></div>';
                          }
                          else{
                            opcampay31+='<input id="offer_payment_value31" type="text" readonly class="form-control" name="offer_payment_value31"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }


                        if(data[i].offer_payment_value_flag32 == 1)
                        {
                          $('.lacampay32').html(" ");

                          if(data[i].offer_payment_value32 != null)
                          {
                          opcampay32+='<div class="input"><input id="offer_payment_value32" readonly type="text" class="form-control" name="offer_payment_value32"  value='+data[i].offer_payment_value32+' ></div>';
                          }
                          else{
                            opcampay32+='<input id="offer_payment_value32" type="text" readonly class="form-control" name="offer_payment_value32"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag33 == 1)
                        {
                          $('.lacampay33').html(" ");

                          if(data[i].offer_payment_value33 != null)
                          {
                          opcampay33+='<div class="input"><input id="offer_payment_value33" readonly type="text" class="form-control" name="offer_payment_value33"  value='+data[i].offer_payment_value33+' ></div>';
                          }
                          else{
                            opcampay33+='<input id="offer_payment_value33" type="text" readonly class="form-control" name="offer_payment_value33"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
                        if(data[i].offer_payment_value_flag34 == 1)
                        {
                          $('.lacampay34').html(" ");

                          if(data[i].offer_payment_value34 != null)
                          {
                          opcampay34+='<div class="input"><input id="offer_payment_value34" readonly type="text" class="form-control" name="offer_payment_value34"  value='+data[i].offer_payment_value34+' ></div>';
                          }
                          else{
                            opcampay34+='<input id="offer_payment_value34" type="text" readonly class="form-control" name="offer_payment_value34"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag35 == 1)
                        {
                          $('.lacampay35').html(" ");

                          if(data[i].offer_payment_value35 != null)
                          {
                          opcampay35+='<div class="input"><input id="offer_payment_value35" readonly type="text" class="form-control" name="offer_payment_value35"  value='+data[i].offer_payment_value35+' ></div>';
                          }
                          else{
                            opcampay35+='<input id="offer_payment_value35" type="text" readonly class="form-control" name="offer_payment_value35"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }


                        if(data[i].offer_payment_value_flag36 == 1)
                        {
                          $('.lacampay36').html(" ");

                          if(data[i].offer_payment_value36 != null)
                          {
                          opcampay36+='<div class="input"><input id="offer_payment_value36" readonly type="text" class="form-control" name="offer_payment_value36"  value='+data[i].offer_payment_value36+' ></div>';
                          }
                          else{
                            opcampay36+='<input id="offer_payment_value36" type="text" readonly class="form-control" name="offer_payment_value36"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }


                        if(data[i].offer_payment_value_flag37 == 1)
                        {
                          $('.lacampay37').html(" ");

                          if(data[i].offer_payment_value37 != null)
                          {
                          opcampay37+='<div class="input"><input id="offer_payment_value37" readonly type="text" class="form-control" name="offer_payment_value37"  value='+data[i].offer_payment_value37+' ></div>';
                          }
                          else{
                            opcampay37+='<input id="offer_payment_value37" type="text" readonly class="form-control" name="offer_payment_value37"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }


                        if(data[i].offer_payment_value_flag38 == 1)
                        {
                          $('.lacampay38').html(" ");

                          if(data[i].offer_payment_value38 != null)
                          {
                          opcampay38+='<div class="input"><input id="offer_payment_value38" readonly type="text" class="form-control" name="offer_payment_value38"  value='+data[i].offer_payment_value38+' ></div>';
                          }
                          else{
                            opcampay38+='<input id="offer_payment_value38" type="text" readonly class="form-control" name="offer_payment_value38"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }


                        if(data[i].offer_payment_value_flag39 == 1)
                        {
                          $('.lacampay39').html(" ");

                          if(data[i].offer_payment_value39 != null)
                          {
                          opcampay39+='<div class="input"><input id="offer_payment_value39" readonly type="text" class="form-control" name="offer_payment_value39"  value='+data[i].offer_payment_value39+' ></div>';
                          }
                          else{
                            opcampay39+='<input id="offer_payment_value39" type="text" readonly class="form-control" name="offer_payment_value39"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }

                        if(data[i].offer_payment_value_flag40 == 1)
                        {
                          $('.lacampay40').html(" ");

                          if(data[i].offer_payment_value40 != null)
                          {
                          opcampay40+='<div class="input"><input id="offer_payment_value40" readonly type="text" class="form-control" name="offer_payment_value40"  value='+data[i].offer_payment_value40+' ></div>';
                          }
                          else{
                            opcampay40+='<input id="offer_payment_value40" type="text" readonly class="form-control" name="offer_payment_value40"   >';
                          }
                        }
                        else{
                        //  opcampay+='<input id="offer_payment_value2"  onKeyUp="chgtext()"type="text" class="form-control" name="offer_payment_value2"   >';
                        }
    }



    $('.lacam').append(opcam);
    $('.lacam2').append(opcam2);
    $('.lacam3').append(opcam3);
    $('.lacam4').append(opcam4);
    $('.lacam5').append(opcam5);
    $('.lacam6').append(opcam6);
    $('.lacam7').append(opcam7);
    $('.lacam8').append(opcam8);
    $('.lacam9').append(opcam9);
    $('.lacam10').append(opcam10);
    $('.lacam11').append(opcam11);
    $('.lacam12').append(opcam12);
    $('.lacam13').append(opcam13);
    $('.lacam14').append(opcam14);
    $('.lacam15').append(opcam15);
    $('.lacam16').append(opcam16);
    $('.lacam17').append(opcam17);
    $('.lacam18').append(opcam18);
    $('.lacam19').append(opcam19);
    $('.lacam20').append(opcam20);
    $('.lacam21').append(opcam21);
    $('.lacam22').append(opcam22);
    $('.lacam23').append(opcam23);
    $('.lacam24').append(opcam24);
    $('.lacam25').append(opcam25);
    $('.lacam26').append(opcam26);
    $('.lacam27').append(opcam27);
    $('.lacam28').append(opcam28);
    $('.lacam29').append(opcam29);
    $('.lacam30').append(opcam30);
    $('.lacam31').append(opcam31);
    $('.lacam32').append(opcam32);
    $('.lacam33').append(opcam33);
    $('.lacam34').append(opcam34);
    $('.lacam35').append(opcam35);
    $('.lacam36').append(opcam36);
    $('.lacam37').append(opcam37);
    $('.lacam38').append(opcam38);
    $('.lacam39').append(opcam39);
    $('.lacam40').append(opcam40);

    $('.lacamdetail').append(opcamdetail);
    $('.lacamdetail2').append(opcamdetail2);
    $('.lacamdetail3').append(opcamdetail3);
    $('.lacamdetail4').append(opcamdetail4);
    $('.lacamdetail5').append(opcamdetail5);
    $('.lacamdetail6').append(opcamdetail6);
    $('.lacamdetail7').append(opcamdetail7);
    $('.lacamdetail8').append(opcamdetail8);
    $('.lacamdetail9').append(opcamdetail9);
    $('.lacamdetail10').append(opcamdetail10);
    $('.lacamdetail11').append(opcamdetail11);
    $('.lacamdetail12').append(opcamdetail12);
    $('.lacamdetail13').append(opcamdetail13);
    $('.lacamdetail14').append(opcamdetail14);
    $('.lacamdetail15').append(opcamdetail15);
    $('.lacamdetail16').append(opcamdetail16);
    $('.lacamdetail17').append(opcamdetail17);
    $('.lacamdetail18').append(opcamdetail18);
    $('.lacamdetail19').append(opcamdetail19);
    $('.lacamdetail20').append(opcamdetail20);

    $('.lacampay').append(opcampay);
    $('.lacampay2').append(opcampay2);
    $('.lacampay3').append(opcampay3);
    $('.lacampay4').append(opcampay4);
    $('.lacampay5').append(opcampay5);
    $('.lacampay6').append(opcampay6);
    $('.lacampay7').append(opcampay7);
    $('.lacampay8').append(opcampay8);
    $('.lacampay9').append(opcampay9);
    $('.lacampay10').append(opcampay10);
    $('.lacampay11').append(opcampay11);
    $('.lacampay12').append(opcampay12);
    $('.lacampay13').append(opcampay13);
    $('.lacampay14').append(opcampay14);
    $('.lacampay15').append(opcampay15);
    $('.lacampay16').append(opcampay16);
    $('.lacampay17').append(opcampay17);
    $('.lacampay18').append(opcampay18);
    $('.lacampay19').append(opcampay19);
    $('.lacampay20').append(opcampay20);
    $('.lacampay21').append(opcampay21);
    $('.lacampay22').append(opcampay22);
    $('.lacampay23').append(opcampay23);
    $('.lacampay24').append(opcampay24);
    $('.lacampay25').append(opcampay25);
    $('.lacampay26').append(opcampay26);
    $('.lacampay27').append(opcampay27);
    $('.lacampay28').append(opcampay28);
    $('.lacampay29').append(opcampay29);
    $('.lacampay30').append(opcampay30);
    $('.lacampay31').append(opcampay31);
    $('.lacampay32').append(opcampay32);
    $('.lacampay33').append(opcampay33);
    $('.lacampay34').append(opcampay34);
    $('.lacampay35').append(opcampay35);
    $('.lacampay36').append(opcampay36);
    $('.lacampay37').append(opcampay37);
    $('.lacampay38').append(opcampay38);
    $('.lacampay39').append(opcampay39);
    $('.lacampay40').append(opcampay40);
                      //console.logg(opcam);

                      var data = <?php echo $promotion ?>;
                          var mode = document.getElementById('promotion_id').value;
                          for(var i=0; i<data.length;i++){
                            if(data[i].id == mode)
                            {
                              var x4 = document.getElementById('offer_payment_value4').value;
                                document.getElementById('offer_payment_value12').value = Number(data[i].percent_promotion) * Number(x4)/100;
                            }
                            else
                            {
                              document.getElementById('offer_payment_value12').value = '';

                            }
                          }

                    var x1 = document.getElementById('offer_payment_value1').value;
                    var x2 = document.getElementById('offer_payment_value2').value;
                    var x3 = document.getElementById('offer_payment_value3').value;
                    var xans = Number(x1) + Number(x2) + Number(x3);
                    //console.logg("yeyeyeye"+x1);
                    var x4 = document.getElementById('offer_payment_value4').value = xans;
                    var data = <?php echo $promotion ?>;
                    var memlevel = <?php echo $memberlevel ?>;

                        var mode = document.getElementById('promotion_id').value;
                        //console.logg('mode'+mode);
                        if(mode == 0 || mode == null ||mode == '')
                        {
                          var x4 = document.getElementById('offer_payment_value4').value;
                          var numbercal = document.getElementById('offer_payment_value7').value;
                          document.getElementById('offer_payment_value8').value = Number(x4)-Number(numbercal);
                          var x8 = document.getElementById('offer_payment_value8').value;
                          var x15 = document.getElementById('offer_payment_value15').value;
                          var taxrate = <?php echo $taxrate ?>;
                          var coorrate = <?php echo $coorrate ?>;
                          var otherrate = <?php echo $otherrate ?>;
                          var grosscom = x8;
                          var xanstaxfee = Number(taxrate) * Number(grosscom)/100;
                          var cat  =  grosscom-xanstaxfee;
                          var xanscoorfee = Number(cat) * Number(coorrate)/100;
                          var catc  =  cat-xanscoorfee;
                          var xansotherfee = Number(catc) * Number(otherrate)/100;
                          var catco  =  catc-xansotherfee;
                          //console.logg("X8 "+x8);
                          //console.logg("Grosscom "+grosscom);
                          //console.logg("CAT "+cat);
                          //console.logg("CATC "+catc);
                          //console.logg("CATCO "+catco);
                          var mdiscount = x15;
                          var ncm  =  catco-mdiscount;

                          var xansmemlevel =Number(catco) * Number(memlevel)/100;
                          //var xansmemlevel = Number(xansmemlevel)/100;
                          document.getElementById('offer_payment_value13').value = xansmemlevel.toFixed(2);

                        }
                        else
                        {
                          for(var i=0; i<data.length;i++){
                            if(data[i].id == mode)
                            {
                              if(data[i].percent_promotion > memlevel)
                              {
                                //console.logg("heyyyyyy");
                                var xanspro = Number(data[i].percent_promotion) * Number(x4)/100;
                                  document.getElementById('offer_payment_value12').value =xanspro.toFixed(2) ;
                                  document.getElementById('offer_payment_value13').value = '';

                              }
                              else
                              {

                                var xansmemlevel = Number(memlevel) * Number(x4)/100;
                                document.getElementById('offer_payment_value12').value ='' ;
                                document.getElementById('offer_payment_value13').value = xansmemlevel.toFixed(2);
                              }
                            }
                          }
                        }

                        var x12 = document.getElementById('offer_payment_value12').value;
                        var x13 = document.getElementById('offer_payment_value13').value;
                        var x14 = document.getElementById('offer_payment_value14').value;
                        var xanalldis = Number(x12) + Number(x13)+ Number(x14);

                        document.getElementById('offer_payment_value15').value =xanalldis.toFixed(2) ;
                        document.getElementById('offer_payment_value4').value = xans.toFixed(2);
                        document.getElementById('lastshow1').value = xans.toFixed(2);


                        var modepay = document.getElementById('offer_payment_value6').value;


                        var x4 = document.getElementById('offer_payment_value4').value;
                        var x5 = document.getElementById('offer_payment_value5').value;
                        if(modepay == 1)
                        {
                          var x1 = document.getElementById('offer_payment_value1').value;

                          var numbercal = document.getElementById('offer_payment_value7').value;
                          document.getElementById('offer_payment_value8').value = Number(x1) * Number(numbercal)/100;
                          var x8 = document.getElementById('offer_payment_value8').value;
                          var xlastshow8 =  Number(x4) - Number(x8)- Number(x5);
                          document.getElementById('lastshow8').value = xlastshow8.toFixed(2);

                        }
                        else if(modepay == 2)
                        {
                          var numbercal = document.getElementById('offer_payment_value7').value;
                          document.getElementById('offer_payment_value8').value = Number(numbercal) ;
                          var x8 = document.getElementById('offer_payment_value8').value;
                          var xlastshow8 =  Number(x4) - Number(x8)- Number(x5);
                          document.getElementById('lastshow8').value = xlastshow8.toFixed(2);
                        }
                        else if(modepay == 3)
                        {
                          var x4 = document.getElementById('offer_payment_value4').value;
                          var numbercal = document.getElementById('offer_payment_value7').value;
                          document.getElementById('offer_payment_value8').value = Number(x4)-Number(numbercal);
                          var x8 = document.getElementById('offer_payment_value8').value;
                          var xlastshow8 =  Number(x4) - Number(x8)- Number(x5);
                          document.getElementById('lastshow8').value = xlastshow8.toFixed(2);
                        }
                        else
                        {
                          document.getElementById('offer_payment_value8').value = "กรุณาเลือกหมวดการคำนวณ";
                        }
                        var x8 = document.getElementById('offer_payment_value8').value;
                        var x15 = document.getElementById('offer_payment_value15').value;

                        var taxrate = <?php echo $taxrate ?>;
                        var coorrate = <?php echo $coorrate ?>;
                        var otherrate = <?php echo $otherrate ?>;
                        var partnerlevel = <?php echo $partnerlevel ?>;
                        var userlevel = <?php echo $userlevel ?>;
                        var grosscom = x8;
                        var xanstaxfee = Number(taxrate) * Number(grosscom)/100;
                        var cat  =  grosscom-xanstaxfee;
                        var xanscoorfee = Number(cat) * Number(coorrate)/100;
                        var catc  =  cat-xanscoorfee;
                        var xansotherfee = Number(catc) * Number(otherrate)/100;
                        var catco  =  catc-xansotherfee;
                        var mdiscount = x15;
                        var ncm  =  catco-mdiscount;
                        var pquota = Number(partnerlevel) * Number(ncm)/100;
                        var discountpartner = document.getElementById('offer_payment_value16').value;
                        var discountuser = document.getElementById('offer_payment_value18').value;
                        var consultfee = pquota  -  discountpartner;
                        if(Number(consultfee) < 0)
                        {
                          var consultfee = 0;
                        }

                        document.getElementById('offer_payment_value17').value = consultfee.toFixed(2);
                        //var pquota = pquota-consultfee;
                        var pquota = pquota.toFixed(2);
                        var ncmp = ncm-pquota;
                        var uquota = Number(userlevel) * Number(ncmp)/100;
                        var uquota = uquota.toFixed(2);
                        var servicefee = uquota  -  discountuser;
                        if(Number(servicefee) < 0)
                        {
                          var servicefee = 0;
                        }
                        var ncmpu = Number(ncmp) - uquota;
                        document.getElementById('offer_payment_value19').value = servicefee.toFixed(2);
                        var oquota = document.getElementById('offer_payment_value20').value;
                        var ci = Number(ncmpu) - Number(oquota);
                        document.getElementById('offer_payment_value21').value = ci.toFixed(2);

                        //console.logg("Oquota"+oquota);
                        //console.logg("pquota"+pquota);
                        var text = '<span style="color:red">ไม่เกิน '+pquota+'</span>';
                        var text2 = '<span style="color:red">ไม่เกิน '+uquota+'</span>';
                        $('.userquota').html(" ");
                        $('.userquota').append(text2);
                        $('.partnerquota').html(" ");
                        $('.partnerquota').append(text);


                        if(Number(pquota) <= 0)
                        {
                          var text = '<span style="color:red">คุณไม่สามารถให้ส่วนลดได้</span>';
                          $('.partnerquota').html(" ");
                          $('.partnerquota').append(text);
                        }
                        if(Number(discountpartner) <1)
                        {
                          //alert('คุณให้ส่วนลดเกินQuotaของคุณ');
                          document.getElementById('offer_payment_value16').value = "";

                        }
                        if(Number(discountpartner) >Number(pquota))
                        {
                          //alert('คุณให้ส่วนลดเกินQuotaของคุณ');
                          document.getElementById('offer_payment_value16').value = "";
                        }
                        if(Number(uquota) <= 0)
                        {
                          var text2 = '<span style="color:red">คุณไม่สามารถให้ส่วนลดได้</span>';
                          $('.userquota').html(" ");
                          $('.userquota').append(text2);
                        }
                        if(Number(discountuser) <1)
                        {
                          //alert('คุณให้ส่วนลดเกินQuotaของคุณ');
                          document.getElementById('offer_payment_value18').value = "";

                        }
                        if(Number(discountuser) >Number(uquota))
                        {
                          //alert('คุณให้ส่วนลดเกินQuotaของคุณ');
                          document.getElementById('offer_payment_value18').value = "";

                        }
                        document.getElementById('offer_payment_value9').value =xanstaxfee.toFixed(2);
                        document.getElementById('offer_payment_value10').value =xanscoorfee.toFixed(2);
                        document.getElementById('offer_payment_value11').value =xansotherfee.toFixed(2);
                        var alldiscount = Number(mdiscount) + Number(discountpartner) + Number(discountuser) + Number(oquota);
                        document.getElementById('lastshow3').value =alldiscount.toFixed(2);
                        var alllast4 = Number(x4) - Number(alldiscount);
                        document.getElementById('lastshow4').value =alllast4.toFixed(2);
                        var tax =  document.getElementById('offer_payment_value5').value;
                        var alllast5 = Number(alllast4) - Number(tax);
                        document.getElementById('lastshow5').value =alllast5.toFixed(2);
                        var alllast6 = Number(alllast5) - Number(consultfee);
                        document.getElementById('lastshow6').value =alllast6.toFixed(2);
                        var alllast7 = Number(alllast5) - Number(servicefee);
                        document.getElementById('lastshow7').value =alllast7.toFixed(2);

                        //console.logg(xanstaxfee);
                        var mode = document.getElementById("checkoff5");
                        if(mode.checked == true)
                        {
                          //console.logg(mode);
                          var x1 = document.getElementById('offer_payment_value1').value;
                          var x2 = document.getElementById('offer_payment_value2').value;
                          var anstocal = Number(x1)+Number(x2);
                          var allans = Number(anstocal) * Number(1)/100;
                          document.getElementById('offer_payment_value5').value = allans.toFixed(2);
                          document.getElementById('lastshow2').value =  allans.toFixed(2);
                        }
                        else
                        {
                          document.getElementById('offer_payment_value5').value = "ไม่มี" ;
                        }

                    },
                    error:function(){

                    }
                });
            });
        });

    </script>
    <script>
    function chgtext() {
      var data = <?php echo $promotion ?>;
      var promotion = 0;
          var mode = document.getElementById('promotion_id').value;
          for(var i=0; i<data.length;i++){
            if(data[i].id == mode)
            {
              //console.logg("hey");
              var x1 = document.getElementById('offer_payment_value1').value;
              promotion = Number(data[i].percent_promotion) * Number(x1)/100;
                document.getElementById('offer_payment_value12').value =promotion.toFixed(2) ;
            }
            else
            {
              document.getElementById('offer_payment_value12').value = '';

            }
          }
          var mode2 = document.getElementById("checkoff5");
          if(mode2.checked == true)
          {
            //console.logg(mode2);
            var x1 = document.getElementById('offer_payment_value1').value;
            var x2 = document.getElementById('offer_payment_value2').value;
            var anstocal = Number(x1)+Number(x2);
            var allans = Number(anstocal) * Number(1)/100;
            document.getElementById('offer_payment_value5').value = allans.toFixed(2);
            document.getElementById('lastshow2').value =  allans.toFixed(2);
          }
          else
          {
            document.getElementById('offer_payment_value5').value = "0" ;
            document.getElementById('lastshow2').value ="0";

          }
    var x1 = document.getElementById('offer_payment_value1').value;
    var x2 = document.getElementById('offer_payment_value2').value;
    var x3 = document.getElementById('offer_payment_value3').value;
    var xans = Number(x1) + Number(x2) + Number(x3);
    var modepay = document.getElementById('offer_payment_value6').value;
    var x4 = document.getElementById('offer_payment_value4').value;
    var x5 = document.getElementById('offer_payment_value5').value;
    var x8 = document.getElementById('offer_payment_value8').value;
    //console.logg("motherfucker"+modepay);
    if(modepay == 1)
    {
      var x4 = Number(x1) + Number(x2) + Number(x3);
      var x1 = document.getElementById('offer_payment_value1').value;

      var numbercal = document.getElementById('offer_payment_value7').value;
      document.getElementById('offer_payment_value8').value = Number(x1) * Number(numbercal)/100;
      var x5 = document.getElementById('offer_payment_value5').value;
      x8 = document.getElementById('offer_payment_value8').value;
      var xlastshow8 =  Number(x4) - Number(x8)- Number(x5);
      document.getElementById('lastshow8').value = xlastshow8.toFixed(2);

    }
    else if(modepay == 2)
    {
      var x4 = Number(x1) + Number(x2) + Number(x3);
      //console.logg("Mode2");
      var numbercal = document.getElementById('offer_payment_value7').value;
      //console.logg(numbercal);
    document.getElementById('offer_payment_value8').value = Number(numbercal) ;
    var x5 = document.getElementById('offer_payment_value5').value;
      x8 = document.getElementById('offer_payment_value8').value = Number(numbercal);
      var xlastshow8 =  Number(x4) - Number(x8)- Number(x5);
      document.getElementById('lastshow8').value = xlastshow8.toFixed(2);
    }
    else if(modepay == 3)
    {
      var x4 = Number(x1) + Number(x2) + Number(x3);
      x4 = x4.toFixed(2);
      var numbercal = document.getElementById('offer_payment_value7').value;
      document.getElementById('offer_payment_value8').value = Number(x4)-Number(numbercal);
      var x5 = document.getElementById('offer_payment_value5').value;
    var x8 = document.getElementById('offer_payment_value8').value;
      //console.logg("checkX5"+x5);
      //console.logg("checkX4"+x4);
      //console.logg("checkX8"+x8);

      var xlastshow8 =  Number(x4) - Number(x8)- Number(x5);
      //console.logg("sasashfjcjfjcjf"+xlastshow8.toFixed(2));
      document.getElementById('lastshow8').value = xlastshow8.toFixed(2);
    }
    else
    {
      document.getElementById('offer_payment_value8').value = "กรุณาเลือกหมวดการคำนวณ";
    }
    //console.logg("yeyeyeye"+x8);
    var x4 = document.getElementById('offer_payment_value4').value = xans;
    var data = <?php echo $promotion ?>;
    var memlevel = <?php echo $memberlevel ?>;
    var x4 = document.getElementById('offer_payment_value4').value;
    var numbercal = document.getElementById('offer_payment_value7').value;
    //  document.getElementById('offer_payment_value8').value = Number(x4)-Number(numbercal);
    //var x8 = document.getElementById('offer_payment_value8').value;
    var x15 = document.getElementById('offer_payment_value15').value;
    var taxrate = <?php echo $taxrate ?>;
    var coorrate = <?php echo $coorrate ?>;
    var otherrate = <?php echo $otherrate ?>;
    var grosscom = x8;
    var xanstaxfee = Number(taxrate) * Number(grosscom)/100;
    var cat  =  grosscom-xanstaxfee;
    var xanscoorfee = Number(cat) * Number(coorrate)/100;
    var catc  =  cat-xanscoorfee;
    var xansotherfee = Number(catc) * Number(otherrate)/100;
    var catco  =  catc-xansotherfee;
    //console.logg("X8 "+x8);
    //console.logg("Grosscom "+grosscom);
    //console.logg("CAT "+cat);
    //console.logg("CATC "+catc);
    //console.logg("CATCO "+catco);
    var mdiscount = x15;
    var ncm  =  catco-mdiscount;

    var xansmemlevel =Number(catco) * Number(memlevel)/100;
        var mode = document.getElementById('promotion_id').value;
        //console.logg('mode'+mode);
        if(mode == 0 || mode == null ||mode == '')
        {


          //console.logg(xansmemlevel);
          //var xansmemlevel = Number(xansmemlevel)/100;
          document.getElementById('offer_payment_value13').value = xansmemlevel.toFixed(2);

        }
        else
        {
          for(var i=0; i<data.length;i++){
            if(data[i].id == mode)
            {
              if(promotion > xansmemlevel)
              {
                //console.logg("heyyyyyy");
                var xanspro = Number(data[i].percent_promotion) * Number(x1)/100;
                  document.getElementById('offer_payment_value12').value =xanspro.toFixed(2) ;
                  document.getElementById('offer_payment_value13').value = '';

              }
              else
              {

                document.getElementById('offer_payment_value12').value ='' ;
                document.getElementById('offer_payment_value13').value = xansmemlevel.toFixed(2);
              }
            }
          }
        }

        var x12 = document.getElementById('offer_payment_value12').value;
        var x13 = document.getElementById('offer_payment_value13').value;
        var x14 = document.getElementById('offer_payment_value14').value;
        var xanalldis = Number(x12) + Number(x13)+ Number(x14);

        document.getElementById('offer_payment_value15').value =xanalldis.toFixed(2) ;
        document.getElementById('offer_payment_value4').value = xans.toFixed(2);
        document.getElementById('lastshow1').value = xans.toFixed(2);



         x8 = document.getElementById('offer_payment_value8').value;
        var x15 = document.getElementById('offer_payment_value15').value;

        var taxrate = <?php echo $taxrate ?>;
        var coorrate = <?php echo $coorrate ?>;
        var otherrate = <?php echo $otherrate ?>;
        var partnerlevel = <?php echo $partnerlevel ?>;
        var userlevel = <?php echo $userlevel ?>;
        var grosscom = x8;
        var xanstaxfee = Number(taxrate) * Number(grosscom)/100;
        var cat  =  grosscom-xanstaxfee;
        var xanscoorfee = Number(cat) * Number(coorrate)/100;
        var catc  =  cat-xanscoorfee;
        var xansotherfee = Number(catc) * Number(otherrate)/100;
        var catco  =  catc-xansotherfee;
        var mdiscount = x15;
        var ncm  =  catco-mdiscount;
        var pquota = Number(partnerlevel) * Number(ncm)/100;
        var discountpartner = document.getElementById('offer_payment_value16').value;
        var discountuser = document.getElementById('offer_payment_value18').value;
        var consultfee = pquota  -  discountpartner;
        if(Number(consultfee) < 0)
        {
          var consultfee = 0;
        }

        document.getElementById('offer_payment_value17').value = consultfee.toFixed(2);
        //var pquota = pquota-consultfee;
        var pquota = pquota.toFixed(2);
        var ncmp = ncm-pquota;
        var uquota = Number(userlevel) * Number(ncmp)/100;
        var uquota = uquota.toFixed(2);
        var servicefee = uquota  -  discountuser;
        if(Number(servicefee) < 0)
        {
          var servicefee = 0;
        }
        var ncmpu = Number(ncmp) - uquota;
        document.getElementById('offer_payment_value19').value = servicefee.toFixed(2);
        var oquota = document.getElementById('offer_payment_value20').value;
        var ci = Number(ncmpu) - Number(oquota);
        document.getElementById('offer_payment_value21').value = ci.toFixed(2);

        //console.logg("Oquota"+oquota);
        //console.logg("pquota"+pquota);
        var text = '<span style="color:red">ไม่เกิน '+pquota+'</span>';
        var text2 = '<span style="color:red">ไม่เกิน '+uquota+'</span>';
        $('.userquota').html(" ");
        $('.userquota').append(text2);
        $('.partnerquota').html(" ");
        $('.partnerquota').append(text);


        if(Number(pquota) <= 0)
        {
          var text = '<span style="color:red">คุณไม่สามารถให้ส่วนลดได้</span>';
          $('.partnerquota').html(" ");
          $('.partnerquota').append(text);
        }
        if(Number(discountpartner) <1)
        {
          //alert('คุณให้ส่วนลดเกินQuotaของคุณ');
          document.getElementById('offer_payment_value16').value = "";

        }
        if(Number(discountpartner) >Number(pquota))
        {
          //alert('คุณให้ส่วนลดเกินQuotaของคุณ');
          document.getElementById('offer_payment_value16').value = "";
        }
        if(Number(uquota) <= 0)
        {
          var text2 = '<span style="color:red">คุณไม่สามารถให้ส่วนลดได้</span>';
          $('.userquota').html(" ");
          $('.userquota').append(text2);
        }
        if(Number(discountuser) <1)
        {
          //alert('คุณให้ส่วนลดเกินQuotaของคุณ');
          document.getElementById('offer_payment_value18').value = "";

        }
        if(Number(discountuser) >Number(uquota))
        {
          //alert('คุณให้ส่วนลดเกินQuotaของคุณ');
          document.getElementById('offer_payment_value18').value = "";

        }
        document.getElementById('offer_payment_value9').value =xanstaxfee.toFixed(2);
        document.getElementById('offer_payment_value10').value =xanscoorfee.toFixed(2);
        document.getElementById('offer_payment_value11').value =xansotherfee.toFixed(2);
        var alldiscount = Number(mdiscount) + Number(discountpartner) + Number(discountuser) + Number(oquota);
        document.getElementById('lastshow3').value =alldiscount.toFixed(2);
        var alllast4 = Number(x4) - Number(alldiscount);
        document.getElementById('lastshow4').value =alllast4.toFixed(2);
        var tax =  document.getElementById('offer_payment_value5').value;
        var alllast5 = Number(alllast4) - Number(tax);
        document.getElementById('lastshow5').value =alllast5.toFixed(2);
        var alllast6 = Number(alllast5) - Number(consultfee);
        if(consultfee < 1)
        {
          document.getElementById('lastshow6').value ="0";
        }
        else
        {
          document.getElementById('lastshow6').value =alllast6.toFixed(2);
        }
        var alllast7 = Number(alllast5) - Number(servicefee);
        if(servicefee < 1)
        {
          document.getElementById('lastshow7').value ="0";
        }
        else
        {
          document.getElementById('lastshow7').value =alllast7.toFixed(2);
        }
        //console.logg("ServiceFee"+servicefee);

        //console.logg(xanstaxfee);

    }

    </script>

    </script>

    <script>
    function selectbranch(){
    var br =" ";
    var branch = <?php echo $branch ?>;
    var orgid = document.getElementById('ref_member_id').value;
    for(var i=0; i<branch.length;i++){
      if(branch[i].org_id == orgid)
      {
          br+='<option value="'+branch[i].id+'">'+branch[i].name+'</option>';
        $('.changebranch').html(" ");

        //console.logg(br);

      }
      else
      {
        $('.changebranch').html(" ");
        br+='<option value=""></option>';
        //console.logg(orgid);

      }

    }
    $('.changebranch').append(br);
      }
    </script>

  @endsection
