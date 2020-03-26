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
                <div class="panel-heading">Update Case Condition</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('campaign.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="columnauth">
                            <label for="name" class="">Campaign Name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            </div>



                            <div class="columnauth">

                              <label for="case_channel " class="">Offer Type </label>


                              <select  class="form-control condition" name="type_id">
                                <option value="" >-select-</option>
                                @foreach ($offertype as $sta)
                                    <option value="{{$sta->id}}"{{$sta->id == $data->offer_type ? 'selected' : ''}}>{{$sta->name}}</option>
                                @endforeach &nbsp;
                              </select>

                        </div>








            </div>
            <div class="row">
              <div class="columnauth">
                <label for="valid_from" class="">Valid Form</label>


                    <input id="valid_from" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy" type="text"  name="valid_from" value="{{$data->valid_from}}" required autofocus>

                    @if ($errors->has('valid_from'))
                        <span class="help-block">
                            <strong>{{ $errors->first('valid_from') }}</strong>
                        </span>
                    @endif

                </div>
              <div class="columnauth">
                <label for="valid_to" class="">Valid To</label>


                    <input id="valid_to" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy" type="text"  name="valid_to" value="{{$data->valid_to}}" required autofocus>

                    @if ($errors->has('valid_to'))
                        <span class="help-block">
                            <strong>{{ $errors->first('valid_to') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="columnnote">
                  <label for="description" class="">Description</label>
                      <textarea id="description" type="text" class="form-control" name="description" value="{{$data->description }}" >{{$data->description }}</textarea>
                      @if ($errors->has('description'))
                          <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif
                  </div>
      </div>
                  <div class="row">





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



<div class="column">
  <div class="la19">

<label for="offer_value19" class="lasd9">@foreach($findoffertype as $fi){{$fi->offer_value_name19}}@endforeach &nbsp;	</label>


<input id="offer_value19" type="text" class="form-control " name="offer_value19"  value="{{$data->offer_value19 }}" >
</div>
@if ($errors->has('offer_value19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value19') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="la20">

<label for="offer_value20" class="lasd10">@foreach($findoffertype as $fi){{$fi->offer_value_name20}}@endforeach &nbsp;	</label>


<input id="offer_value20" type="text" class="form-control " name="offer_value20"  value="{{$data->offer_value20 }}" >
</div>
@if ($errors->has('offer_value20'))
<span class="help-block">
    <strong>{{ $errors->first('offer_value20') }}</strong>
</span>
@endif

</div>

</div>
<div class="hideoffer21-40">

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


        <input id="offer_detail_value1" type="text" class="form-control" name="offer_detail_value1"  value="{{ $data->offer_detail_value1 }}" >
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


        <input id="offer_detail_value2" type="text" class="form-control" name="offer_detail_value2"  value="{{ $data->offer_detail_value2 }}" >
</div>
        @if ($errors->has('offer_detail_value2'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value2') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail3">

    <label for="offer_detail_value3" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name3}}@endforeach</label>


        <input id="offer_detail_value3" type="text" class="form-control" name="offer_detail_value3"  value="{{ $data->offer_detail_value3 }}" >
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


        <input id="offer_detail_value4" type="text" class="form-control" name="offer_detail_value4"  value="{{ $data->offer_detail_value4 }}" >
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


        <input id="offer_detail_value5" type="text" class="form-control" name="offer_detail_value5"  value="{{ $data->offer_detail_value4 }}" >
</div>
        @if ($errors->has('offer_detail_value5'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value5') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="ladetail6">

    <label for="offer_detail_value6" class="lasd6">@foreach($findoffertype as $fi){{$fi->offer_detail_name6}}@endforeach</label>


        <input id="offer_detail_value6" type="text" class="form-control" name="offer_detail_value6"  value="{{ $data->offer_detail_value6 }}" >
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


        <input id="offer_detail_value7" type="text" class="form-control" name="offer_detail_value7"  value="{{ $data->offer_detail_value7 }}" >
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


        <input id="offer_detail_value8" type="text" class="form-control" name="offer_detail_value8"  value="{{ $data->offer_detail_value8 }}" >
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


        <input id="offer_detail_value9" type="text" class="form-control" name="offer_detail_value9"  value="{{ $data->offer_detail_value9 }}" >
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


        <input id="offer_detail_value10" type="text" class="form-control" name="offer_detail_value10"  value="{{ $data->offer_detail_value10 }}" >
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


        <input id="offer_detail_value11" type="text" class="form-control" name="offer_detail_value11"  value="{{ $data->offer_detail_value11 }}" >
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


        <input id="offer_detail_value12" type="text" class="form-control" name="offer_detail_value12"  value="{{ $data->offer_detail_value12 }}" >
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


        <input id="offer_detail_value13" type="text" class="form-control" name="offer_detail_value13"  value="{{ $data->offer_detail_value13 }}" >
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


        <input id="offer_detail_value14" type="text" class="form-control" name="offer_detail_value14"  value="{{ $data->offer_detail_value14 }}" >
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


        <input id="offer_detail_value15" type="text" class="form-control" name="offer_detail_value15"  value="{{ $data->offer_detail_value15 }}" >
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


        <input id="offer_detail_value16" type="text" class="form-control" name="offer_detail_value16"  value="{{ $data->offer_detail_value16 }}" >
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


        <input id="offer_detail_value17" type="text" class="form-control" name="offer_detail_value17"  value="{{ $data->offer_detail_value17 }}" >
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


        <input id="offer_detail_value18" type="text" class="form-control" name="offer_detail_value18"  value="{{ $data->offer_detail_value18 }}" >
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


        <input id="offer_detail_value19" type="text" class="form-control" name="offer_detail_value19"  value="{{ $data->offer_detail_value19 }}" >
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


        <input id="offer_detail_value20" type="text" class="form-control" name="offer_detail_value20"  value="{{ $data->offer_detail_value20 }}" >
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
<div class="hideofferpayment">

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

    <label for="offer_payment_value1" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name1}}@endforeach</label>


        <input id="offer_payment_value1" type="text" class="form-control" name="offer_payment_value1"  value="{{ $data->offer_payment_value1 }}" >
</div>
        @if ($errors->has('offer_payment_value1'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value1') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay2">
    <label for="offer_payment_value2" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name2}}@endforeach</label>


        <input id="offer_payment_value2" type="text" class="form-control" name="offer_payment_value2"  value="{{ $data->offer_payment_value2 }}" >
      </div>
        @if ($errors->has('offer_payment_value2'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value2') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay3">

<label for="offer_payment_value3" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name3}}@endforeach</label>


    <input id="offer_payment_value3" type="text" class="form-control" name="offer_payment_value3"  value="{{ $data->offer_payment_value3 }}" >
</div>
    @if ($errors->has('offer_payment_value3'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value3') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay4">

<label for="offer_payment_value4" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name4}}@endforeach</label>


<input id="offer_payment_value4" type="text" class="form-control " name="offer_payment_value4"  value="{{ $data->offer_payment_value4 }}" >
</div>
@if ($errors->has('offer_payment_value4'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value4') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay5">

<label for="offer_payment_value5" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name5}}@endforeach</label>


<input id="offer_payment_value5" type="text" class="form-control " name="offer_payment_value5"  value="{{ $data->offer_payment_value5 }}" >
</div>
@if ($errors->has('offer_payment_value5'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value5') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="lapay6">

    <label for="offer_payment_value6" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name6}}@endforeach</label>


        <input id="offer_payment_value6" type="text" class="form-control " name="offer_payment_value6"  value="{{ $data->offer_payment_value6 }}" >
</div>
        @if ($errors->has('offer_payment_value6'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value6') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay7">

    <label for="offer_payment_value7" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name7}}@endforeach</label>


        <input id="offer_payment_value7" type="text" class="form-control " name="offer_payment_value7"  value="{{ $data->offer_payment_value7 }}" >
</div>
        @if ($errors->has('offer_payment_value7'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value7') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay8">

<label for="offer_payment_value8" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name7}}@endforeach</label>


    <input id="offer_payment_value8" type="text" class="form-control " name="offer_payment_value8"  value="{{ $data->offer_payment_value8 }}" >
</div>
    @if ($errors->has('offer_payment_value8'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value8') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay9">

<label for="offer_payment_value9" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name9}}@endforeach</label>


<input id="offer_payment_value9" type="text" class="form-control " name="offer_payment_value9"  value="{{ $data->offer_payment_value9 }}" >
</div>
@if ($errors->has('offer_payment_value9'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value9') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay10">

<label for="offer_payment_value10" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name10}}@endforeach</label>


<input id="offer_payment_value10" type="text" class="form-control " name="offer_payment_value10"  value="{{ $data->offer_payment_value10 }}" >
</div>
@if ($errors->has('offer_payment_value10'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value10') }}</strong>
</span>
@endif

</div>


  <div class="column">
    <div class="lapay11">

    <label for="offer_payment_value11" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name11}}@endforeach</label>


        <input id="offer_payment_value11" type="text" class="form-control" name="offer_payment_value11"  value="{{ $data->offer_payment_value11 }}" >
</div>
        @if ($errors->has('offer_payment_value11'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value11') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay12">

    <label for="offer_payment_value12" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name12}}@endforeach</label>


        <input id="offer_payment_value12" type="text" class="form-control " name="offer_payment_value12"  value="{{ $data->offer_payment_value12 }}" >
</div>
        @if ($errors->has('offer_payment_value12'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value12') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay13">

<label for="offer_payment_value13" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name13}}@endforeach</label>


    <input id="offer_payment_value13" type="text" class="form-control" name="offer_payment_value13"  value="{{ $data->offer_payment_value13 }}" >
</div>
    @if ($errors->has('offer_payment_value33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value13') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay14">

<label for="offer_payment_value34" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name14}}@endforeach</label>


<input id="offer_payment_value14" type="text" class="form-control" name="offer_payment_value14"  value="{{ $data->offer_payment_value14 }}" >
</div>
@if ($errors->has('offer_payment_value14'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value14') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay15">

<label for="offer_payment_value15" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name15}}@endforeach</label>


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

    <label for="offer_payment_value16" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name16}}@endforeach</label>


        <input id="offer_payment_value16" type="text" class="form-control" name="offer_payment_value16"  value="{{ $data->offer_payment_value16 }}" >
</div>
        @if ($errors->has('offer_payment_value16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value16') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="lapay17">

    <label for="offer_payment_value17" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name17}}@endforeach</label>


        <input id="offer_payment_value37" type="text" class="form-control " name="offer_payment_value17"  value="{{ $data->offer_payment_value17 }}" >
</div>
        @if ($errors->has('offer_payment_value17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value17') }}</strong>
            </span>
        @endif

</div>
<div class="column">
  <div class="lapay18">

<label for="offer_payment_value18" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name18}}@endforeach</label>


    <input id="offer_payment_value18" type="text" class="form-control" name="offer_payment_value18"  value="{{ $data->offer_payment_value18 }}" >
</div>
    @if ($errors->has('offer_payment_value18'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value18') }}</strong>
        </span>
    @endif

</div>



<div class="column">
  <div class="lapay19">

<label for="offer_payment_value19" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name19}}@endforeach</label>


<input id="offer_payment_value19" type="text" class="form-control " name="offer_payment_value19"  value="{{ $data->offer_payment_value19 }}" >
</div>
@if ($errors->has('offer_payment_value19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value19') }}</strong>
    </span>
@endif

</div>
<div class="column">
  <div class="lapay20">

<label for="offer_payment_value20" class="lapaysd20">@foreach($findoffertype as $fi){{$fi->offer_payment_name20}}@endforeach</label>


<input id="offer_payment_value20" type="text" class="form-control la20" name="offer_payment_value20"  value="{{ $data->offer_payment_value20 }}" >
</div>
@if ($errors->has('offer_payment_value20'))
<span class="help-block">
    <strong>{{ $errors->first('offer_payment_value20') }}</strong>
</span>
@endif

</div>
<div class="column">
  <div class="lapay21">

  <label for="offer_payment_value21" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name21}}@endforeach</label>


      <input id="offer_payment_value21" type="text" class="form-control" name="offer_payment_value21"  value="{{ $data->offer_payment_value21 }}" >
</div>
      @if ($errors->has('offer_payment_value21'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value21') }}</strong>
          </span>
      @endif

</div>
<div class="column">
  <div class="lapay22">
  <label for="offer_payment_value22" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name22}}@endforeach</label>


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

<label for="offer_payment_value23" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name23}}@endforeach</label>


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

<label for="offer_payment_value24" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name24}}@endforeach</label>


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

<label for="offer_payment_value25" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name25}}@endforeach</label>


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

  <label for="offer_payment_value26" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name26}}@endforeach</label>


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

  <label for="offer_payment_value27" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name27}}@endforeach</label>


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

<label for="offer_payment_value28" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name28}}@endforeach</label>


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

<label for="offer_payment_value29" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name29}}@endforeach</label>


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

<label for="offer_payment_value30" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name30}}@endforeach</label>


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

  <label for="offer_payment_value31" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name31}}@endforeach</label>


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

  <label for="offer_payment_value32" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name32}}@endforeach</label>


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

<label for="offer_payment_value33" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name33}}@endforeach</label>


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

<label for="offer_payment_value34" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name34}}@endforeach</label>


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

<label for="offer_payment_value35" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name35}}@endforeach</label>


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

  <label for="offer_payment_value36" class="lapaysd6">@foreach($findoffertype as $fi){{$fi->offer_payment_name36}}@endforeach</label>


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

  <label for="offer_payment_value37" class="lapaysd7">@foreach($findoffertype as $fi){{$fi->offer_payment_name37}}@endforeach</label>


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

<label for="offer_payment_value38" class="lapaysd8">@foreach($findoffertype as $fi){{$fi->offer_payment_name38}}@endforeach</label>


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

<label for="offer_payment_value39" class="lapaysd9">@foreach($findoffertype as $fi){{$fi->offer_payment_name39}}@endforeach</label>


<input id="offer_payment_value39" type="text" class="form-control " name="offer_payment_value39"  value="{{ $data->offer_payment_value39}}" >
</div>
@if ($errors->has('offer_payment_value39'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value39') }}</strong>
  </span>
@endif

</div>
<div class="column">
<div class="lapay40">

<label for="offer_payment_value40" class="lapaysd10">@foreach($findoffertype as $fi){{$fi->offer_payment_name40}}@endforeach</label>


<input id="offer_payment_value40" type="text" class="form-control la40" name="offer_payment_value40"  value="{{ $data->offer_payment_value40 }}" >
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
</div>
<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Offer Value Flag </h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="box-body">

    <div class="column">
      <div class="as1">

      <label for="offer_value_flag1" class="">Offer Value Flag1</label>


      <select  class="form-control" name="offer_value_flag1"  >
          <option value="0"{{$data->offer_value_flag1 == 0 ? 'selected' : ''}}>No</option>
          <option value="1"{{$data->offer_value_flag1 == 1 ? 'selected' : ''}}>Yes</option>
      </select></div>
          @if ($errors->has('offer_value_flag1'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_flag1') }}</strong>
              </span>
          @endif

    </div>
    <div class="column">
      <div class="as2">
      <label for="offer_value_flag2" class="7">Offer Value Flag2</label>


      <select  class="form-control" name="offer_value_flag2"  >
        <option value="0"{{$data->offer_value_flag2 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_value_flag2 == 1 ? 'selected' : ''}}>Yes</option>
      </select>      </div>
          @if ($errors->has('offer_value_flag2'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_flag2') }}</strong>
              </span>
          @endif

    </div>
    <div class="column">
    <div class="as3">

    <label for="offer_value_flag3" class="8">Offer Value Flag3</label>
    <select  class="form-control" name="offer_value_flag3"  >
      <option value="0"{{$data->offer_value_flag3 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag3 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
      @if ($errors->has('offer_value_flag3'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_value_flag3') }}</strong>
          </span>
      @endif

    </div>



    <div class="column">
    <div class="as4">

    <label for="offer_value_flag4" class="9">Offer Value Flag4</label>


    <select  class="form-control" name="offer_value_flag4"  >
      <option value="0"{{$data->offer_value_flag4 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag4 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag4'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_value_flag4') }}</strong>
      </span>
    @endif

    </div>
    <div class="column">
    <div class="as5">

    <label for="offer_value_flag5" class="10">Offer Value Flag5</label>


    <select  class="form-control" name="offer_value_flag5"  >
      <option value="0"{{$data->offer_value_flag5 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag5 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag5'))
    <span class="help-block">
      <strong>{{ $errors->first('offer_value_flag5') }}</strong>
    </span>
    @endif

    </div>


    <div class="column">
      <div class="as6">

      <label for="offer_value_flag6" class="6">Offer Value Flag6</label>


      <select  class="form-control" name="offer_value_flag6"  >
        <option value="0"{{$data->offer_value_flag6 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_value_flag6 == 1 ? 'selected' : ''}}>Yes</option>
      </select></div>
          @if ($errors->has('offer_value_flag6'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_flag6') }}</strong>
              </span>
          @endif

    </div>
    <div class="column">
      <div class="as7">

      <label for="offer_value_flag7" class="7">Offer Value Flag7</label>


      <select  class="form-control" name="offer_value_flag7"  >
        <option value="0"{{$data->offer_value_flag7 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_value_flag7 == 1 ? 'selected' : ''}}>Yes</option>
      </select></div>
          @if ($errors->has('offer_value_flag7'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_flag7') }}</strong>
              </span>
          @endif

    </div>
    <div class="column">
    <div class="as8">

    <label for="offer_value_flag8" class="8">Offer Value Flag8</label>


    <select  class="form-control" name="offer_value_flag8"  >
      <option value="0"{{$data->offer_value_flag8 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag8 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
      @if ($errors->has('offer_value_flag8'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_value_flag8') }}</strong>
          </span>
      @endif

    </div>



    <div class="column">
    <div class="as9">

    <label for="offer_value_flag9" class="9">Offer Value Flag9</label>


    <select  class="form-control" name="offer_value_flag9"  >
      <option value="0"{{$data->offer_value_flag9 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag9 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag9'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_value_flag9') }}</strong>
      </span>
    @endif

    </div>
    <div class="column">
    <div class="as10">

    <label for="offer_value_flag10" class="10">Offer Value Flag10</label>


    <select  class="form-control" name="offer_value_flag10"  >
      <option value="0"{{$data->offer_value_flag10 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag10 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag10'))
    <span class="help-block">
      <strong>{{ $errors->first('offer_value_flag10') }}</strong>
    </span>
    @endif

    </div>


    <div class="column">
      <div class="as11">
      <label for="offer_value_flag11" class="6">Offer Value Flag11</label>
      <select  class="form-control" name="offer_value_flag11"  >
        <option value="0"{{$data->offer_value_flag11 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_value_flag11 == 1 ? 'selected' : ''}}>Yes</option>
      </select></div>
          @if ($errors->has('offer_value_flag11'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_flag11') }}</strong>
              </span>
          @endif

    </div>
    <div class="column">
      <div class="as12">

      <label for="offer_value_flag12" class="7">Offer Value Flag12</label>


      <select  class="form-control" name="offer_value_flag12"  >
        <option value="0"{{$data->offer_value_flag12 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_value_flag12 == 1 ? 'selected' : ''}}>Yes</option>
      </select></div>
          @if ($errors->has('offer_value_flag12'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_flag12') }}</strong>
              </span>
          @endif

    </div>
    <div class="column">
    <div class="as13">

    <label for="offer_value_flag13" class="8">Offer Value Flag13</label>


    <select  class="form-control" name="offer_value_flag13"  >
      <option value="0"{{$data->offer_value_flag13 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag13 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
      @if ($errors->has('offer_value_flag33'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_value_flag13') }}</strong>
          </span>
      @endif

    </div>



    <div class="column">
    <div class="as14">

    <label for="offer_value_flag34" class="9">Offer Value Flag14</label>


    <select  class="form-control" name="offer_value_flag14"  >
      <option value="0"{{$data->offer_value_flag14 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag14 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag14'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_value_flag14') }}</strong>
      </span>
    @endif

    </div>
    <div class="column">
    <div class="as15">

    <label for="offer_value_flag15" class="10">Offer Value Flag15</label>


    <select  class="form-control" name="offer_value_flag15"  >
      <option value="0"{{$data->offer_value_flag15 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag15 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag15'))
    <span class="help-block">
      <strong>{{ $errors->first('offer_value_flag15') }}</strong>
    </span>
    @endif

    </div>


    <div class="column">
      <div class="as16">

      <label for="offer_value_flag16" class="6">Offer Value Flag16</label>


      <select  class="form-control" name="offer_value_flag16"  >
        <option value="0"{{$data->offer_value_flag16 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_value_flag16 == 1 ? 'selected' : ''}}>Yes</option>
      </select></div>
          @if ($errors->has('offer_value_flag16'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_flag16') }}</strong>
              </span>
          @endif

    </div>
    <div class="column">
      <div class="as17">

      <label for="offer_value_flag17" class="7">Offer Value Flag17</label>


      <select  class="form-control" name="offer_value_flag17"  >
        <option value="0"{{$data->offer_value_flag17 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_value_flag17 == 1 ? 'selected' : ''}}>Yes</option>
      </select></div>
          @if ($errors->has('offer_value_flag17'))
              <span class="help-block">
                  <strong>{{ $errors->first('offer_value_flag17') }}</strong>
              </span>
          @endif

    </div>
    <div class="column">
    <div class="as18">

    <label for="offer_value_flag18" class="8">Offer Value Flag18</label>


    <select  class="form-control" name="offer_value_flag18"  >
      <option value="0"{{$data->offer_value_flag18 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag18 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
      @if ($errors->has('offer_value_flag18'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_value_flag18') }}</strong>
          </span>
      @endif

    </div>



    <div class="column">
    <div class="as19">

    <label for="offer_value_flag19" class="9">Offer Value Flag19</label>


    <select  class="form-control" name="offer_value_flag19"  >
      <option value="0"{{$data->offer_value_flag19 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag19 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag19'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_value_flag19') }}</strong>
      </span>
    @endif

    </div>
    <div class="column">
    <div class="as20">

    <label for="offer_value_flag20" class="20">Offer Value Flag20</label>


    <select  class="form-control" name="offer_value_flag20"  >
      <option value="0"{{$data->offer_value_flag20 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag20 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag20'))
    <span class="help-block">
      <strong>{{ $errors->first('offer_value_flag20') }}</strong>
    </span>
    @endif

    </div>
    <div class="column">
    <div class="as21">

    <label for="offer_value_flag21" class="6">Offer Value Flag21</label>


    <select  class="form-control" name="offer_value_flag21"  >
      <option value="0"{{$data->offer_value_flag21 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag21 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_value_flag21'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_flag21') }}</strong>
            </span>
        @endif

    </div>
    <div class="column">
    <div class="as22">
    <label for="offer_value_flag22" class="7">Offer Value Flag22</label>


    <select  class="form-control" name="offer_value_flag22"  >
      <option value="0"{{$data->offer_value_flag22 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag22 == 1 ? 'selected' : ''}}>Yes</option>
    </select>    </div>
        @if ($errors->has('offer_value_flag22'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_flag22') }}</strong>
            </span>
        @endif

    </div>
    <div class="column">
    <div class="as23">

    <label for="offer_value_flag23" class="8">Offer Value Flag23</label>


    <select  class="form-control" name="offer_value_flag23"  >
      <option value="0"{{$data->offer_value_flag23 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag23 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag23'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_flag23') }}</strong>
        </span>
    @endif

    </div>



    <div class="column">
    <div class="as24">

    <label for="offer_value_flag24" class="9">Offer Value Flag24</label>


    <select  class="form-control" name="offer_value_flag24"  >
      <option value="0"{{$data->offer_value_flag24 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag24 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag24'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_flag24') }}</strong>
    </span>
    @endif

    </div>
    <div class="column">
    <div class="as25">

    <label for="offer_value_flag25" class="10">Offer Value Flag25</label>


    <select  class="form-control" name="offer_value_flag25"  >
      <option value="0"{{$data->offer_value_flag25 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag25 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag25'))
    <span class="help-block">
    <strong>{{ $errors->first('offer_value_flag25') }}</strong>
    </span>
    @endif

    </div>


    <div class="column">
    <div class="as26">
    <label for="offer_value_flag26" class="6">Offer Value Flag26</label>


    <select  class="form-control" name="offer_value_flag26"  >
      <option value="0"{{$data->offer_value_flag26 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag26 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_value_flag26'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_flag26') }}</strong>
            </span>
        @endif

    </div>
    <div class="column">
    <div class="as27">

    <label for="offer_value_flag27" class="7">Offer Value Flag27</label>


    <select  class="form-control" name="offer_value_flag27"  >
      <option value="0"{{$data->offer_value_flag27 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag27 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_value_flag27'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_flag27') }}</strong>
            </span>
        @endif

    </div>
    <div class="column">
    <div class="as28">

    <label for="offer_value_flag28" class="8">Offer Value Flag28</label>


    <select  class="form-control" name="offer_value_flag28"  >
      <option value="0"{{$data->offer_value_flag28 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag28 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag28'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_flag28') }}</strong>
        </span>
    @endif

    </div>



    <div class="column">
    <div class="as29">

    <label for="offer_value_flag29" class="9">Offer Value Flag29</label>


    <select  class="form-control" name="offer_value_flag29"  >
      <option value="0"{{$data->offer_value_flag29 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag29 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag29'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_flag29') }}</strong>
    </span>
    @endif

    </div>
    <div class="column">
    <div class="as30">

    <label for="offer_value_flag30" class="10">Offer Value Flag30</label>


    <select  class="form-control" name="offer_value_flag30"  >
      <option value="0"{{$data->offer_value_flag30 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag30 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag30'))
    <span class="help-block">
    <strong>{{ $errors->first('offer_value_flag30') }}</strong>
    </span>
    @endif

    </div>


    <div class="column">
    <div class="as31">

    <label for="offer_value_flag31" class="6">Offer Value Flag31</label>


    <select  class="form-control" name="offer_value_flag31"  >
      <option value="0"{{$data->offer_value_flag31 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag31 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_value_flag31'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_flag31') }}</strong>
            </span>
        @endif

    </div>
    <div class="column">
    <div class="as32">

    <label for="offer_value_flag32" class="7">Offer Value Flag32</label>


    <select  class="form-control" name="offer_value_flag32"  >
      <option value="0"{{$data->offer_value_flag32 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag32 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_value_flag32'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_flag32') }}</strong>
            </span>
        @endif

    </div>
    <div class="column">
    <div class="as33">

    <label for="offer_value_flag33" class="8">Offer Value Flag33</label>


    <select  class="form-control" name="offer_value_flag33"  >
      <option value="0"{{$data->offer_value_flag33 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag33 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_flag33') }}</strong>
        </span>
    @endif

    </div>



    <div class="column">
    <div class="as34">

    <label for="offer_value_flag34" class="9">Offer Value Flag34</label>


    <select  class="form-control" name="offer_value_flag34"  >
      <option value="0"{{$data->offer_value_flag34 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag34 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag34'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_flag34') }}</strong>
    </span>
    @endif

    </div>
    <div class="column">
    <div class="as35">

    <label for="offer_value_flag35" class="10">Offer Value Flag35</label>


    <select  class="form-control" name="offer_value_flag35"  >
      <option value="0"{{$data->offer_value_flag35 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag35 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag35'))
    <span class="help-block">
    <strong>{{ $errors->first('offer_value_flag35') }}</strong>
    </span>
    @endif

    </div>


    <div class="column">
    <div class="as36">

    <label for="offer_value_flag36" class="6">Offer Value Flag36</label>


    <select  class="form-control" name="offer_value_flag36"  >
      <option value="0"{{$data->offer_value_flag36 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag36 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_value_flag36'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_flag36') }}</strong>
            </span>
        @endif

    </div>
    <div class="column">
    <div class="as37">

    <label for="offer_value_flag37" class="7">Offer Value Flag37</label>


    <select  class="form-control" name="offer_value_flag37"  >
      <option value="0"{{$data->offer_value_flag37 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag37 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_value_flag37'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_value_flag37') }}</strong>
            </span>
        @endif

    </div>
    <div class="column">
    <div class="as38">

    <label for="offer_value_flag38" class="8">Offer Value Flag38</label>


    <select  class="form-control" name="offer_value_flag38"  >
      <option value="0"{{$data->offer_value_flag38 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag38 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag38'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_value_flag38') }}</strong>
        </span>
    @endif

    </div>



    <div class="column">
    <div class="as39">
    <label for="offer_value_flag39" class="9">Offer Value Flag39</label>
    <select  class="form-control" name="offer_value_flag39"  >
      <option value="0"{{$data->offer_value_flag39 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag39 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag39'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_value_flag39') }}</strong>
    </span>
    @endif

    </div>
    <div class="column">
    <div class="as40">

    <label for="offer_value_flag40" class="10">Offer Value Flag40</label>


    <select  class="form-control" name="offer_value_flag40"  >
      <option value="0"{{$data->offer_value_flag40 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_value_flag40 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
    @if ($errors->has('offer_value_flag40'))
    <span class="help-block">
    <strong>{{ $errors->first('offer_value_flag40') }}</strong>
    </span>
    @endif

    </div>
    </div>
</div>
<div class="hideofferdetail">


<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Offer detail value Flag </h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="box-body">

<div class="row">
  <div class="column">
    <div class="as1">

    <label for="offer_detail_value_flag1" class="">Offer Detail Value Flag1</label>


    <select  class="form-control" name="offer_detail_value_flag1"  >
        <option value="0"{{$data->offer_detail_value_flag1 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_detail_value_flag1 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_detail_value_flag1'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value_flag1') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="as2">
    <label for="offer_detail_value_flag2" class="7">Offer Detail Value Flag2</label>


    <select  class="form-control" name="offer_detail_value_flag2"  >
      <option value="0"{{$data->offer_detail_value_flag2 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_detail_value_flag2 == 1 ? 'selected' : ''}}>Yes</option>
    </select>      </div>
        @if ($errors->has('offer_detail_value_flag2'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value_flag2') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
  <div class="as3">

  <label for="offer_detail_value_flag3" class="8">Offer Detail Value Flag3</label>
  <select  class="form-control" name="offer_detail_value_flag3"  >
    <option value="0"{{$data->offer_detail_value_flag3 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag3 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
    @if ($errors->has('offer_detail_value_flag3'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_detail_value_flag3') }}</strong>
        </span>
    @endif

  </div>



  <div class="column">
  <div class="as4">

  <label for="offer_detail_value_flag4" class="9">Offer Detail Value Flag4</label>


  <select  class="form-control" name="offer_detail_value_flag4"  >
    <option value="0"{{$data->offer_detail_value_flag4 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag4 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_detail_value_flag4'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_detail_value_flag4') }}</strong>
    </span>
  @endif

  </div>
  <div class="column">
  <div class="as5">

  <label for="offer_detail_value_flag5" class="10">Offer Detail Value Flag5</label>


  <select  class="form-control" name="offer_detail_value_flag5"  >
    <option value="0"{{$data->offer_detail_value_flag5 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag5 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_detail_value_flag5'))
  <span class="help-block">
    <strong>{{ $errors->first('offer_detail_value_flag5') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
    <div class="as6">

    <label for="offer_detail_value_flag6" class="6">Offer Detail Value Flag6</label>


    <select  class="form-control" name="offer_detail_value_flag6"  >
      <option value="0"{{$data->offer_detail_value_flag6 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_detail_value_flag6 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_detail_value_flag6'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value_flag6') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="as7">

    <label for="offer_detail_value_flag7" class="7">Offer Detail Value Flag7</label>


    <select  class="form-control" name="offer_detail_value_flag7"  >
      <option value="0"{{$data->offer_detail_value_flag7 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_detail_value_flag7 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_detail_value_flag7'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value_flag7') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
  <div class="as8">

  <label for="offer_detail_value_flag8" class="8">Offer Detail Value Flag8</label>


  <select  class="form-control" name="offer_detail_value_flag8"  >
    <option value="0"{{$data->offer_detail_value_flag8 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag8 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
    @if ($errors->has('offer_detail_value_flag8'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_detail_value_flag8') }}</strong>
        </span>
    @endif

  </div>



  <div class="column">
  <div class="as9">

  <label for="offer_detail_value_flag9" class="9">Offer Detail Value Flag9</label>


  <select  class="form-control" name="offer_detail_value_flag9"  >
    <option value="0"{{$data->offer_detail_value_flag9 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag9 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_detail_value_flag9'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_detail_value_flag9') }}</strong>
    </span>
  @endif

  </div>
  <div class="column">
  <div class="as10">

  <label for="offer_detail_value_flag10" class="10">Offer Detail Value Flag10</label>


  <select  class="form-control" name="offer_detail_value_flag10"  >
    <option value="0"{{$data->offer_detail_value_flag10 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag10 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_detail_value_flag10'))
  <span class="help-block">
    <strong>{{ $errors->first('offer_detail_value_flag10') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
    <div class="as11">
    <label for="offer_detail_value_flag11" class="6">Offer Detail Value Flag11</label>
    <select  class="form-control" name="offer_detail_value_flag11"  >
      <option value="0"{{$data->offer_detail_value_flag11 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_detail_value_flag11 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_detail_value_flag11'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value_flag11') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="as12">

    <label for="offer_detail_value_flag12" class="7">Offer Detail Value Flag12</label>


    <select  class="form-control" name="offer_detail_value_flag12"  >
      <option value="0"{{$data->offer_detail_value_flag12 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_detail_value_flag12 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_detail_value_flag12'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value_flag12') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
  <div class="as13">

  <label for="offer_detail_value_flag13" class="8">Offer Detail Value Flag13</label>


  <select  class="form-control" name="offer_detail_value_flag13"  >
    <option value="0"{{$data->offer_detail_value_flag13 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag13 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
    @if ($errors->has('offer_detail_value_flag33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_detail_value_flag13') }}</strong>
        </span>
    @endif

  </div>



  <div class="column">
  <div class="as14">

  <label for="offer_detail_value_flag34" class="9">Offer Detail Value Flag14</label>


  <select  class="form-control" name="offer_detail_value_flag14"  >
    <option value="0"{{$data->offer_detail_value_flag14 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag14 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_detail_value_flag14'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_detail_value_flag14') }}</strong>
    </span>
  @endif

  </div>
  <div class="column">
  <div class="as15">

  <label for="offer_detail_value_flag15" class="10">Offer Detail Value Flag15</label>


  <select  class="form-control" name="offer_detail_value_flag15"  >
    <option value="0"{{$data->offer_detail_value_flag15 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag15 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_detail_value_flag15'))
  <span class="help-block">
    <strong>{{ $errors->first('offer_detail_value_flag15') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
    <div class="as16">

    <label for="offer_detail_value_flag16" class="6">Offer Detail Value Flag16</label>


    <select  class="form-control" name="offer_detail_value_flag16"  >
      <option value="0"{{$data->offer_detail_value_flag16 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_detail_value_flag16 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_detail_value_flag16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value_flag16') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="as17">

    <label for="offer_detail_value_flag17" class="7">Offer Detail Value Flag17</label>


    <select  class="form-control" name="offer_detail_value_flag17"  >
      <option value="0"{{$data->offer_detail_value_flag17 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_detail_value_flag17 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_detail_value_flag17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_detail_value_flag17') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
  <div class="as18">

  <label for="offer_detail_value_flag18" class="8">Offer Detail Value Flag18</label>


  <select  class="form-control" name="offer_detail_value_flag18"  >
    <option value="0"{{$data->offer_detail_value_flag18 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag18 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
    @if ($errors->has('offer_detail_value_flag18'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_detail_value_flag18') }}</strong>
        </span>
    @endif

  </div>



  <div class="column">
  <div class="as19">

  <label for="offer_detail_value_flag19" class="9">Offer Detail Value Flag19</label>


  <select  class="form-control" name="offer_detail_value_flag19"  >
    <option value="0"{{$data->offer_detail_value_flag19 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag19 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_detail_value_flag19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_detail_value_flag19') }}</strong>
    </span>
  @endif

  </div>
  <div class="column">
  <div class="as20">

  <label for="offer_detail_value_flag20" class="20">Offer Detail Value Flag20</label>


  <select  class="form-control" name="offer_detail_value_flag20"  >
    <option value="0"{{$data->offer_detail_value_flag20 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_detail_value_flag20 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_detail_value_flag20'))
  <span class="help-block">
    <strong>{{ $errors->first('offer_detail_value_flag20') }}</strong>
  </span>
  @endif

  </div>
</div>
</div>
</div>
</div>
<div class="hideofferpayment">
<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title" data-widget="collapse">Offer Payment Value Flag </h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
    </div>
  </div>
  <div class="box-body">

<div class="row">
  <div class="column">
    <div class="as1">

    <label for="offer_payment_value_flag1" class="">Offer Payment Value Flag1</label>


    <select  class="form-control" name="offer_payment_value_flag1"  >
        <option value="0"{{$data->offer_payment_value_flag1 == 0 ? 'selected' : ''}}>No</option>
        <option value="1"{{$data->offer_payment_value_flag1 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_payment_value_flag1'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value_flag1') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="as2">
    <label for="offer_payment_value_flag2" class="7">Offer Payment Value Flag2</label>


    <select  class="form-control" name="offer_payment_value_flag2"  >
      <option value="0"{{$data->offer_payment_value_flag2 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_payment_value_flag2 == 1 ? 'selected' : ''}}>Yes</option>
    </select>      </div>
        @if ($errors->has('offer_payment_value_flag2'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value_flag2') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
  <div class="as3">

  <label for="offer_payment_value_flag3" class="8">Offer Payment Value Flag3</label>
  <select  class="form-control" name="offer_payment_value_flag3"  >
    <option value="0"{{$data->offer_payment_value_flag3 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag3 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
    @if ($errors->has('offer_payment_value_flag3'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value_flag3') }}</strong>
        </span>
    @endif

  </div>



  <div class="column">
  <div class="as4">

  <label for="offer_payment_value_flag4" class="9">Offer Payment Value Flag4</label>


  <select  class="form-control" name="offer_payment_value_flag4"  >
    <option value="0"{{$data->offer_payment_value_flag4 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag4 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag4'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value_flag4') }}</strong>
    </span>
  @endif

  </div>
  <div class="column">
  <div class="as5">

  <label for="offer_payment_value_flag5" class="10">Offer Payment Value Flag5</label>


  <select  class="form-control" name="offer_payment_value_flag5"  >
    <option value="0"{{$data->offer_payment_value_flag5 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag5 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag5'))
  <span class="help-block">
    <strong>{{ $errors->first('offer_payment_value_flag5') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
    <div class="as6">

    <label for="offer_payment_value_flag6" class="6">Offer Payment Value Flag6</label>


    <select  class="form-control" name="offer_payment_value_flag6"  >
      <option value="0"{{$data->offer_payment_value_flag6 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_payment_value_flag6 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_payment_value_flag6'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value_flag6') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="as7">

    <label for="offer_payment_value_flag7" class="7">Offer Payment Value Flag7</label>


    <select  class="form-control" name="offer_payment_value_flag7"  >
      <option value="0"{{$data->offer_payment_value_flag7 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_payment_value_flag7 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_payment_value_flag7'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value_flag7') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
  <div class="as8">

  <label for="offer_payment_value_flag8" class="8">Offer Payment Value Flag8</label>


  <select  class="form-control" name="offer_payment_value_flag8"  >
    <option value="0"{{$data->offer_payment_value_flag8 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag8 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
    @if ($errors->has('offer_payment_value_flag8'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value_flag8') }}</strong>
        </span>
    @endif

  </div>



  <div class="column">
  <div class="as9">

  <label for="offer_payment_value_flag9" class="9">Offer Payment Value Flag9</label>


  <select  class="form-control" name="offer_payment_value_flag9"  >
    <option value="0"{{$data->offer_payment_value_flag9 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag9 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag9'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value_flag9') }}</strong>
    </span>
  @endif

  </div>
  <div class="column">
  <div class="as10">

  <label for="offer_payment_value_flag10" class="10">Offer Payment Value Flag10</label>


  <select  class="form-control" name="offer_payment_value_flag10"  >
    <option value="0"{{$data->offer_payment_value_flag10 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag10 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag10'))
  <span class="help-block">
    <strong>{{ $errors->first('offer_payment_value_flag10') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
    <div class="as11">
    <label for="offer_payment_value_flag11" class="6">Offer Payment Value Flag11</label>
    <select  class="form-control" name="offer_payment_value_flag11"  >
      <option value="0"{{$data->offer_payment_value_flag11 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_payment_value_flag11 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_payment_value_flag11'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value_flag11') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="as12">

    <label for="offer_payment_value_flag12" class="7">Offer Payment Value Flag12</label>


    <select  class="form-control" name="offer_payment_value_flag12"  >
      <option value="0"{{$data->offer_payment_value_flag12 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_payment_value_flag12 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_payment_value_flag12'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value_flag12') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
  <div class="as13">

  <label for="offer_payment_value_flag13" class="8">Offer Payment Value Flag13</label>


  <select  class="form-control" name="offer_payment_value_flag13"  >
    <option value="0"{{$data->offer_payment_value_flag13 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag13 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
    @if ($errors->has('offer_payment_value_flag33'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value_flag13') }}</strong>
        </span>
    @endif

  </div>



  <div class="column">
  <div class="as14">

  <label for="offer_payment_value_flag34" class="9">Offer Payment Value Flag14</label>


  <select  class="form-control" name="offer_payment_value_flag14"  >
    <option value="0"{{$data->offer_payment_value_flag14 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag14 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag14'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value_flag14') }}</strong>
    </span>
  @endif

  </div>
  <div class="column">
  <div class="as15">

  <label for="offer_payment_value_flag15" class="10">Offer Payment Value Flag15</label>


  <select  class="form-control" name="offer_payment_value_flag15"  >
    <option value="0"{{$data->offer_payment_value_flag15 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag15 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag15'))
  <span class="help-block">
    <strong>{{ $errors->first('offer_payment_value_flag15') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
    <div class="as16">

    <label for="offer_payment_value_flag16" class="6">Offer Payment Value Flag16</label>


    <select  class="form-control" name="offer_payment_value_flag16"  >
      <option value="0"{{$data->offer_payment_value_flag16 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_payment_value_flag16 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_payment_value_flag16'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value_flag16') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
    <div class="as17">

    <label for="offer_payment_value_flag17" class="7">Offer Payment Value Flag17</label>


    <select  class="form-control" name="offer_payment_value_flag17"  >
      <option value="0"{{$data->offer_payment_value_flag17 == 0 ? 'selected' : ''}}>No</option>
      <option value="1"{{$data->offer_payment_value_flag17 == 1 ? 'selected' : ''}}>Yes</option>
    </select></div>
        @if ($errors->has('offer_payment_value_flag17'))
            <span class="help-block">
                <strong>{{ $errors->first('offer_payment_value_flag17') }}</strong>
            </span>
        @endif

  </div>
  <div class="column">
  <div class="as18">

  <label for="offer_payment_value_flag18" class="8">Offer Payment Value Flag18</label>


  <select  class="form-control" name="offer_payment_value_flag18"  >
    <option value="0"{{$data->offer_payment_value_flag18 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag18 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
    @if ($errors->has('offer_payment_value_flag18'))
        <span class="help-block">
            <strong>{{ $errors->first('offer_payment_value_flag18') }}</strong>
        </span>
    @endif

  </div>



  <div class="column">
  <div class="as19">

  <label for="offer_payment_value_flag19" class="9">Offer Payment Value Flag19</label>


  <select  class="form-control" name="offer_payment_value_flag19"  >
    <option value="0"{{$data->offer_payment_value_flag19 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag19 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag19'))
    <span class="help-block">
        <strong>{{ $errors->first('offer_payment_value_flag19') }}</strong>
    </span>
  @endif

  </div>
  <div class="column">
  <div class="as20">

  <label for="offer_payment_value_flag20" class="20">Offer Payment Value Flag20</label>


  <select  class="form-control" name="offer_payment_value_flag20"  >
    <option value="0"{{$data->offer_payment_value_flag20 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag20 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag20'))
  <span class="help-block">
    <strong>{{ $errors->first('offer_payment_value_flag20') }}</strong>
  </span>
  @endif

  </div>
  <div class="column">
  <div class="as21">

  <label for="offer_payment_value_flag21" class="6">Offer Payment Value Flag21</label>


  <select  class="form-control" name="offer_payment_value_flag21"  >
    <option value="0"{{$data->offer_payment_value_flag21 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag21 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
      @if ($errors->has('offer_payment_value_flag21'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value_flag21') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">
  <div class="as22">
  <label for="offer_payment_value_flag22" class="7">Offer Payment Value Flag22</label>


  <select  class="form-control" name="offer_payment_value_flag22"  >
    <option value="0"{{$data->offer_payment_value_flag22 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag22 == 1 ? 'selected' : ''}}>Yes</option>
  </select>    </div>
      @if ($errors->has('offer_payment_value_flag22'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value_flag22') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">
  <div class="as23">

  <label for="offer_payment_value_flag23" class="8">Offer Payment Value Flag23</label>


  <select  class="form-control" name="offer_payment_value_flag23"  >
    <option value="0"{{$data->offer_payment_value_flag23 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag23 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag23'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value_flag23') }}</strong>
      </span>
  @endif

  </div>



  <div class="column">
  <div class="as24">

  <label for="offer_payment_value_flag24" class="9">Offer Payment Value Flag24</label>


  <select  class="form-control" name="offer_payment_value_flag24"  >
    <option value="0"{{$data->offer_payment_value_flag24 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag24 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag24'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value_flag24') }}</strong>
  </span>
  @endif

  </div>
  <div class="column">
  <div class="as25">

  <label for="offer_payment_value_flag25" class="10">Offer Payment Value Flag25</label>


  <select  class="form-control" name="offer_payment_value_flag25"  >
    <option value="0"{{$data->offer_payment_value_flag25 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag25 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag25'))
  <span class="help-block">
  <strong>{{ $errors->first('offer_payment_value_flag25') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
  <div class="as26">
  <label for="offer_payment_value_flag26" class="6">Offer Payment Value Flag26</label>


  <select  class="form-control" name="offer_payment_value_flag26"  >
    <option value="0"{{$data->offer_payment_value_flag26 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag26 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
      @if ($errors->has('offer_payment_value_flag26'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value_flag26') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">
  <div class="as27">

  <label for="offer_payment_value_flag27" class="7">Offer Payment Value Flag27</label>


  <select  class="form-control" name="offer_payment_value_flag27"  >
    <option value="0"{{$data->offer_payment_value_flag27 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag27 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
      @if ($errors->has('offer_payment_value_flag27'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value_flag27') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">
  <div class="as28">

  <label for="offer_payment_value_flag28" class="8">Offer Payment Value Flag28</label>


  <select  class="form-control" name="offer_payment_value_flag28"  >
    <option value="0"{{$data->offer_payment_value_flag28 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag28 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag28'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value_flag28') }}</strong>
      </span>
  @endif

  </div>



  <div class="column">
  <div class="as29">

  <label for="offer_payment_value_flag29" class="9">Offer Payment Value Flag29</label>


  <select  class="form-control" name="offer_payment_value_flag29"  >
    <option value="0"{{$data->offer_payment_value_flag29 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag29 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag29'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value_flag29') }}</strong>
  </span>
  @endif

  </div>
  <div class="column">
  <div class="as30">

  <label for="offer_payment_value_flag30" class="10">Offer Payment Value Flag30</label>


  <select  class="form-control" name="offer_payment_value_flag30"  >
    <option value="0"{{$data->offer_payment_value_flag30 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag30 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag30'))
  <span class="help-block">
  <strong>{{ $errors->first('offer_payment_value_flag30') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
  <div class="as31">

  <label for="offer_payment_value_flag31" class="6">Offer Payment Value Flag31</label>


  <select  class="form-control" name="offer_payment_value_flag31"  >
    <option value="0"{{$data->offer_payment_value_flag31 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag31 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
      @if ($errors->has('offer_payment_value_flag31'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value_flag31') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">
  <div class="as32">

  <label for="offer_payment_value_flag32" class="7">Offer Payment Value Flag32</label>


  <select  class="form-control" name="offer_payment_value_flag32"  >
    <option value="0"{{$data->offer_payment_value_flag32 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag32 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
      @if ($errors->has('offer_payment_value_flag32'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value_flag32') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">
  <div class="as33">

  <label for="offer_payment_value_flag33" class="8">Offer Payment Value Flag33</label>


  <select  class="form-control" name="offer_payment_value_flag33"  >
    <option value="0"{{$data->offer_payment_value_flag33 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag33 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag33'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value_flag33') }}</strong>
      </span>
  @endif

  </div>



  <div class="column">
  <div class="as34">

  <label for="offer_payment_value_flag34" class="9">Offer Payment Value Flag34</label>


  <select  class="form-control" name="offer_payment_value_flag34"  >
    <option value="0"{{$data->offer_payment_value_flag34 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag34 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag34'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value_flag34') }}</strong>
  </span>
  @endif

  </div>
  <div class="column">
  <div class="as35">

  <label for="offer_payment_value_flag35" class="10">Offer Payment Value Flag35</label>


  <select  class="form-control" name="offer_payment_value_flag35"  >
    <option value="0"{{$data->offer_payment_value_flag35 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag35 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag35'))
  <span class="help-block">
  <strong>{{ $errors->first('offer_payment_value_flag35') }}</strong>
  </span>
  @endif

  </div>


  <div class="column">
  <div class="as36">

  <label for="offer_payment_value_flag36" class="6">Offer Payment Value Flag36</label>


  <select  class="form-control" name="offer_payment_value_flag36"  >
    <option value="0"{{$data->offer_payment_value_flag36 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag36 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
      @if ($errors->has('offer_payment_value_flag36'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value_flag36') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">
  <div class="as37">

  <label for="offer_payment_value_flag37" class="7">Offer Payment Value Flag37</label>


  <select  class="form-control" name="offer_payment_value_flag37"  >
    <option value="0"{{$data->offer_payment_value_flag37 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag37 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
      @if ($errors->has('offer_payment_value_flag37'))
          <span class="help-block">
              <strong>{{ $errors->first('offer_payment_value_flag37') }}</strong>
          </span>
      @endif

  </div>
  <div class="column">
  <div class="as38">

  <label for="offer_payment_value_flag38" class="8">Offer Payment Value Flag38</label>


  <select  class="form-control" name="offer_payment_value_flag38"  >
    <option value="0"{{$data->offer_payment_value_flag38 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag38 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag38'))
      <span class="help-block">
          <strong>{{ $errors->first('offer_payment_value_flag38') }}</strong>
      </span>
  @endif

  </div>



  <div class="column">
  <div class="as39">
  <label for="offer_payment_value_flag39" class="9">Offer Payment Value Flag39</label>
  <select  class="form-control" name="offer_payment_value_flag39"  >
    <option value="0"{{$data->offer_payment_value_flag39 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag39 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag39'))
  <span class="help-block">
      <strong>{{ $errors->first('offer_payment_value_flag39') }}</strong>
  </span>
  @endif

  </div>
  <div class="column">
  <div class="as40">

  <label for="offer_payment_value_flag40" class="10">Offer Payment Value Flag40</label>


  <select  class="form-control" name="offer_payment_value_flag40"  >
    <option value="0"{{$data->offer_payment_value_flag40 == 0 ? 'selected' : ''}}>No</option>
    <option value="1"{{$data->offer_payment_value_flag40 == 1 ? 'selected' : ''}}>Yes</option>
  </select></div>
  @if ($errors->has('offer_payment_value_flag40'))
  <span class="help-block">
  <strong>{{ $errors->first('offer_payment_value_flag40') }}</strong>
  </span>
  @endif

  </div>
  </div>
</div>
</div>
</div>
</div>


    <!-- /.box-header -->

  <!-- /.box-body -->

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
                        hideoffer21_40+='';
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
                        hideofferpayment+='';
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
                    if(data[i].offer_detail_name1 != null)
                    {
                    opdetail+='<div><label for="offer_detail_value1" class="lasd">'+data[i].offer_detail_name1+'</label><input id="offer_detail_value1" type="text" class="form-control " name="offer_detail_value1" value="{{ old('offer_detail_value1') }}" ></div>';
                    }
                    else{
                      opdetail+='';
                      hideofferdetail+='';
                    }
                    if(data[i].offer_detail_name2 != null)
                    {
                      opdetail2+='<div><label for="offer_detail_value2" class="lasd">'+data[i].offer_detail_name2+'</label><input id="offer_detail_value2" type="text" class="form-control " name="offer_detail_value2" value="{{ old('offer_detail_value2') }}" ></div>';
                    }

                    else{
                      opdetail2+='';

                    }
                    if(data[i].offer_detail_name3 != null)
                    {
                      opdetail3+='<div><label for="offer_detail_value3" class="lasd">'+data[i].offer_detail_name3+'</label><input id="offer_detail_value3" type="text" class="form-control " name="offer_detail_value3" value="{{ old('offer_detail_value3') }}" ></div>';
                    }
                    else{
                      opdetail3+='';
                    }
                    if(data[i].offer_detail_name4 != null)
                    {
                      opdetail4+='<div><label for="offer_detail_value4" class="lasd">'+data[i].offer_detail_name4+'</label><input id="offer_detail_value4" type="text" class="form-control " name="offer_detail_value4" value="{{ old('offer_detail_value4') }}" ></div>';
                    }
                    else{
                      opdetail4+='';

                    }
                    if(data[i].offer_detail_name5 != null)
                    {
                      opdetail5+='<div><label for="offer_detail_value5" class="lasd">'+data[i].offer_detail_name5+'</label><input id="offer_detail_value5" type="text" class="form-control " name="offer_detail_value5" value="{{ old('offer_detail_value5') }}" ></div>';
                    }
                    else{
                      opdetail5+='';

                    }
                    if(data[i].offer_detail_name6 != null)
                    {
                      opdetail6+='<div><label for="offer_detail_value6" class="lasd">'+data[i].offer_detail_name6+'</label><input id="offer_detail_value6" type="text" class="form-control " name="offer_detail_value6" value="{{ old('offer_detail_value6') }}" ></div>';
                    }
                    else{
                      opdetail6+='';
                    }
                    if(data[i].offer_detail_name7 != null)
                    {
                      opdetail7+='<div><label for="offer_detail_value7" class="lasd">'+data[i].offer_detail_name7+'</label><input id="offer_detail_value7" type="text" class="form-control " name="offer_detail_value7" value="{{ old('offer_detail_value7') }}" ></div>';
                    }
                    else{
                      opdetail7+='';

                    }
                    if(data[i].offer_detail_name8 != null)
                    {
                      opdetail8+='<div><label for="offer_detail_value8" class="lasd">'+data[i].offer_detail_name8+'</label><input id="offer_detail_value8" type="text" class="form-control " name="offer_detail_value8" value="{{ old('offer_detail_value8') }}" ></div>';
                    }
                    else {
                      opdetail8+='';
                    }
                    if(data[i].offer_detail_name9 != null)
                    {
                      opdetail9+='<div><label for="offer_detail_value9" class="lasd">'+data[i].offer_detail_name9+'</label><input id="offer_detail_value9" type="text" class="form-control " name="offer_detail_value9" value="{{ old('offer_detail_value9') }}" ></div>';
                    }
                    else{
                      opdetail9+='';
                    }
                    if(data[i].offer_detail_name10 != null)
                    {
                      opdetail10+='<div><label for="offer_detail_value10" class="lasd">'+data[i].offer_detail_name10+'</label><input id="offer_detail_value10" type="text" class="form-control " name="offer_detail_value10" value="{{ old('offer_detail_value10') }}" ></div>';
                    }
                    else {
                      opdetail10+='';
                    }
                    if(data[i].offer_detail_name11 != null)
                    {
                      opdetail11+='<div><label for="offer_detail_value11" class="lasd">'+data[i].offer_detail_name11+'</label><input id="offer_detail_value11" type="text" class="form-control " name="offer_detail_value11" value="{{ old('offer_detail_value11') }}" ></div>';
                    }
                    else{
                      opdetail11+='';

                    }
                    if(data[i].offer_detail_name12 != null)
                    {
                      opdetail12+='<div><label for="offer_detail_value12" class="lasd">'+data[i].offer_detail_name12+'</label><input id="offer_detail_value12" type="text" class="form-control " name="offer_detail_value12" value="{{ old('offer_detail_value12') }}" ></div>';
                    }
                    else {
                      opdetail12+='';
                    }
                    if(data[i].offer_detail_name13 != null)
                    {
                      opdetail13+='<div><label for="offer_detail_value13" class="lasd">'+data[i].offer_detail_name13+'</label><input id="offer_detail_value13" type="text" class="form-control " name="offer_detail_value13" value="{{ old('offer_detail_value13') }}" ></div>';
                    }
                    else{
                      opdetail13+='';
                    }
                    if(data[i].offer_detail_name14 != null)
                    {
                      opdetail14+='<div><label for="offer_detail_value14" class="lasd">'+data[i].offer_detail_name14+'</label><input id="offer_detail_value14" type="text" class="form-control " name="offer_detail_value14" value="{{ old('offer_detail_value14') }}" ></div>';
                    }
                    else{
                      opdetail14+='';
                    }
                    if(data[i].offer_detail_name15 != null)
                    {
                      opdetail15+='<div><label for="offer_detail_value15" class="lasd">'+data[i].offer_detail_name15+'</label><input id="offer_detail_value15" type="text" class="form-control " name="offer_detail_value15" value="{{ old('offer_detail_value15') }}" ></div>';
                    }
                    else {
                      opdetail15+='';
                    }
                    if(data[i].offer_detail_name16 != null)
                    {
                      opdetail16+='<div><label for="offer_detail_value16" class="lasd">'+data[i].offer_detail_name16+'</label><input id="offer_detail_value16" type="text" class="form-control " name="offer_detail_value16" value="{{ old('offer_detail_value16') }}" ></div>';
                    }
                    else{
                      opdetail16+='';
                    }
                    if(data[i].offer_detail_name17 != null)
                    {
                      opdetail17+='<div><label for="offer_detail_value17" class="lasd">'+data[i].offer_detail_name17+'</label><input id="offer_detail_value17" type="text" class="form-control " name="offer_detail_value17" value="{{ old('offer_detail_value17') }}" ></div>';
                    }
                    else{
                      opdetail17+='';
                    }
                    if(data[i].offer_detail_name18 != null)
                    {
                      opdetail18+='<div><label for="offer_detail_value18" class="lasd">'+data[i].offer_detail_name18+'</label><input id="offer_detail_value18" type="text" class="form-control " name="offer_detail_value18" value="{{ old('offer_detail_value18') }}" ></div>';
                    }
                    else
                    {
                    opdetail18+='';
                  }
                  if(data[i].offer_detail_name19 != null)
                  {
                    opdetail19+='<div><label for="offer_detail_value19" class="lasd">'+data[i].offer_detail_name19+'</label><input id="offer_detail_value19" type="text" class="form-control " name="offer_detail_value19" value="{{ old('offer_detail_value19') }}" ></div>';
                  }
                  else{
                    opdetail19+='';
                  }
                  if(data[i].offer_detail_name20 != null)
                  {
                    opdetail20+='<div><label for="offer_detail_value20" class="lasd">'+data[i].offer_detail_name20+'</label><input id="offer_detail_value20" type="text" class="form-control " name="offer_detail_value20" value="{{ old('offer_detail_value20') }}" ></div>';
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

                      $('.hideoffer21-40').html(" ");
                      $('.ladetail20').append(hideoffer21_40);
                      $('.hideofferdetail').html(" ");
                      $('.hideofferdetail').append(hideofferdetail);
                      $('.hideofferpayment').html(" ");
                      $('.hideofferpayment').append(hideofferpayment);

                      console.log(op);
                    },
                    error:function(){

                    }
                });
            });
        });
    </script>
  @endsection
