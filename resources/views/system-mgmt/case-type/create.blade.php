@extends('system-mgmt.case-type.base')

@section('action-content')
<style>


/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 16%;
  padding: 10px;
 /* Should be removed. Only for demonstration */
}
.column2 {
  float: left;
  width: 48%;
  padding: 10px;
 /* Should be removed. Only for demonstration */
}
.column3 {
  float: left;
  width: 32%;
  padding: 10px;
 /* Should be removed. Only for demonstration */
}
.columndesc {
  float: left;
  width: 96%;
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
  .column2 {
    width: 100%;
  }
  .column3 {
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
                <div class="panel-heading">Add new Case Type</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('case-type.store') }}">
                        {{ csrf_field() }}
                        <h3 style="color:#00325d;">General Information</h3>
                        <div class="row">
                          <div class="column">

                            <label for="name" class="">Case Category</label>


                            <select class="form-control  name" name="case_cat_id">
                              <option value="0" >-Select-</option>
                              @foreach ($casecat as $ca)
                                <option value={{$ca->id}} >{{$ca->name}}</option>
                              @endforeach
                            </select>

                      </div>
                      <div class="column">

                        <label for="name" class="">Case Type Config</label>

                        <select class="form-control  name" name="case_type_config">
                          <option value="0" >-Select-</option>
                          @foreach ($casetypeconfig as $ca)
                            <option value={{$ca->id}} >{{$ca->sub_type_config_name}}</option>
                          @endforeach
                        </select>

                  </div>




                        <div class="column">
                          <label for="id_num" class="">Default Partner Block</label>
                          <select class="form-control  name" name="default_partner_block_id">
                            <option value="0" >-Select-</option>
                            @foreach ($partnerblock as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>




                        </div>
                        <div class="column">

                          <label for="name" class="">Default User Block</label>


                          <select class="form-control  name" name="default_user_block_id">
                            <option value="0" >-Select-</option>
                            @foreach ($block as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>


                    </div>
                    <div class="column">

                      <label for="default_partner_group" class="">Partner Group</label>


                      <select class="form-control  name" name="default_partner_group">
                        <option value="0" >-Select-</option>
                        @foreach ($partnergroup as $ca)
                          <option value={{$ca->id}} >{{$ca->name}}</option>
                        @endforeach
                      </select>

                </div>
                <div class="column">

                  <label for="default_procedure_id" class="">Procedure</label>


                  <select class="form-control  name" name="default_procedure_id">
                    <option value="0" >-Select-</option>
                    @foreach ($procedure as $ca)
                      <option value={{$ca->id}} >{{$ca->name}}</option>
                    @endforeach
                  </select>

            </div>
            <div class="column3">
              <label for="name" class="">Offer Category</label>
              <select class="form-control  name" name="offer_cat">
                <option value="0" >-Select-</option>
                @foreach ($offercategory as $ca)
                  <option value={{$ca->id}} >{{$ca->name}}</option>
                @endforeach
              </select>

        </div>
            <div class="column3">
              <label for="name" class="">Type Name</label>


                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif

              </div>
              <div class="column3">
                <label for="day_auto_renew" class="">Day Auto Renew (วัน)</label>


                    <input id="day_auto_renew" type="text" class="form-control" name="day_auto_renew" value="{{ old('day_auto_renew') }}" required autofocus>

                    @if ($errors->has('day_auto_renew'))
                        <span class="help-block">
                            <strong>{{ $errors->first('day_auto_renew') }}</strong>
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
                  <h3 style="color:#00325d;">CASE Requirement Variable Name</h3>
                  <div class="row">
                    <div class="column">

                      <label for="name" class="">Requirement Name1</label>


                          <input id="requirename_var1" type="text" class="form-control" name="requirename_var1"  value="{{ old('requirename_var1') }}" >

                          @if ($errors->has('requirename_var1'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('requirename_var1') }}</strong>
                              </span>
                          @endif

                </div>
                <div class="column">

                  <label for="requirename_var2" class="">Requirement Name2</label>


                      <input id="requirename_var2" type="text" class="form-control" name="requirename_var2"  value="{{ old('requirename_var2') }}" >

                      @if ($errors->has('requirename_var2'))
                          <span class="help-block">
                              <strong>{{ $errors->first('requirename_var2') }}</strong>
                          </span>
                      @endif

            </div>



            <div class="column">

              <label for="requirename_var3" class="">Requirement Name3</label>


                  <input id="requirename_var3" type="text" class="form-control" name="requirename_var3"  value="{{ old('requirename_var3') }}" >

                  @if ($errors->has('requirename_var3'))
                      <span class="help-block">
                          <strong>{{ $errors->first('requirename_var3') }}</strong>
                      </span>
                  @endif

        </div>
        <div class="column">

          <label for="requirename_var4" class="">Requirement Name4</label>


              <input id="requirename_var4" type="text" class="form-control" name="requirename_var4"  value="{{ old('requirename_var4') }}" >

              @if ($errors->has('requirename_var4'))
                  <span class="help-block">
                      <strong>{{ $errors->first('requirename_var4') }}</strong>
                  </span>
              @endif

    </div>
    <div class="column">

      <label for="requirename_var5" class="">Requirement Name5</label>


          <input id="requirename_var5" type="text" class="form-control" name="requirename_var5"  value="{{ old('requirename_var5') }}" >

          @if ($errors->has('requirename_var5'))
              <span class="help-block">
                  <strong>{{ $errors->first('requirename_var5') }}</strong>
              </span>
          @endif

</div>
<div class="column">

  <label for="requirename_var6" class="">Requirement Name6</label>


      <input id="requirename_var6" type="text" class="form-control" name="requirename_var6"  value="{{ old('requirename_var6') }}" >

      @if ($errors->has('requirename_var6'))
          <span class="help-block">
              <strong>{{ $errors->first('requirename_var6') }}</strong>
          </span>
      @endif

</div>
            </div>

            <div class="row">
              <div class="column">

                <label for="requirename_var7" class="">Requirement Name7</label>


                    <input id="requirename_var7" type="text" class="form-control" name="requirename_var7"  value="{{ old('requirename_var7') }}" >

                    @if ($errors->has('requirename_var7'))
                        <span class="help-block">
                            <strong>{{ $errors->first('requirename_var7') }}</strong>
                        </span>
                    @endif

          </div>
          <div class="column">

            <label for="requirename_var8" class="">Requirement Name8</label>


                <input id="requirename_var8" type="text" class="form-control" name="requirename_var8"  value="{{ old('requirename_var8') }}" >

                @if ($errors->has('requirename_var8'))
                    <span class="help-block">
                        <strong>{{ $errors->first('requirename_var8') }}</strong>
                    </span>
                @endif

      </div>



      <div class="column">

        <label for="requirename_var9" class="">Requirement Name9</label>


            <input id="requirename_var9" type="text" class="form-control" name="requirename_var9"  value="{{ old('requirename_var9') }}" >

            @if ($errors->has('requirename_var9'))
                <span class="help-block">
                    <strong>{{ $errors->first('requirename_var9') }}</strong>
                </span>
            @endif

  </div>
  <div class="column">

    <label for="requirename_var10" class="">Requirement Name10</label>


        <input id="requirename_var10" type="text" class="form-control" name="requirename_var10"  value="{{ old('requirename_var10') }}" >

        @if ($errors->has('requirename_var10'))
            <span class="help-block">
                <strong>{{ $errors->first('requirename_var10') }}</strong>
            </span>
        @endif

</div>
<div class="column">

<label for="requirename_var11" class="">Requirement Name11</label>


    <input id="requirename_var11" type="text" class="form-control" name="requirename_var11"  value="{{ old('requirename_var11') }}" >

    @if ($errors->has('requirename_var11'))
        <span class="help-block">
            <strong>{{ $errors->first('requirename_var11') }}</strong>
        </span>
    @endif

</div>
<div class="column">

<label for="requirename_var12" class="">Requirement Name12</label>


<input id="requirename_var12" type="text" class="form-control" name="requirename_var12"  value="{{ old('requirename_var12') }}" >

@if ($errors->has('requirename_var12'))
    <span class="help-block">
        <strong>{{ $errors->first('requirename_var12') }}</strong>
    </span>
@endif

</div>
      </div>

      <div class="row">
        <div class="column">

          <label for="requirename_var13" class="">Requirement Name13</label>


              <input id="requirename_var13" type="text" class="form-control" name="requirename_var13"  value="{{ old('requirename_var13') }}" >

              @if ($errors->has('requirename_var13'))
                  <span class="help-block">
                      <strong>{{ $errors->first('requirename_var13') }}</strong>
                  </span>
              @endif

    </div>
    <div class="column">

      <label for="requirename_var14" class="">Requirement Name14</label>


          <input id="requirename_var14" type="text" class="form-control" name="requirename_var14"  value="{{ old('requirename_var14') }}" >

          @if ($errors->has('requirename_var14'))
              <span class="help-block">
                  <strong>{{ $errors->first('requirename_var14') }}</strong>
              </span>
          @endif

</div>



<div class="column">

  <label for="requirename_var15" class="">Requirement Name15</label>


      <input id="requirename_var15" type="text" class="form-control" name="requirename_var15"  value="{{ old('requirename_var15') }}" >

      @if ($errors->has('requirename_var15'))
          <span class="help-block">
              <strong>{{ $errors->first('requirename_var15') }}</strong>
          </span>
      @endif

</div>
<div class="column">

<label for="requirename_var16" class="">Requirement Name16</label>


  <input id="requirename_var16" type="text" class="form-control" name="requirename_var16"  value="{{ old('requirename_var16') }}" >

  @if ($errors->has('requirename_var16'))
      <span class="help-block">
          <strong>{{ $errors->first('requirename_var16') }}</strong>
      </span>
  @endif

</div>
<div class="column">

<label for="requirename_var17" class="">Requirement Name17</label>


<input id="requirename_var17" type="text" class="form-control" name="requirename_var17"  value="{{ old('requirename_var17') }}" >

@if ($errors->has('requirename_var17'))
  <span class="help-block">
      <strong>{{ $errors->first('requirename_var17') }}</strong>
  </span>
@endif

</div>
<div class="column">

<label for="requirename_var18" class="">Requirement Name18</label>


<input id="requirename_var18" type="text" class="form-control" name="requirename_var18"  value="{{ old('requirename_var18') }}" >

@if ($errors->has('requirename_var18'))
<span class="help-block">
  <strong>{{ $errors->first('requirename_var18') }}</strong>
</span>
@endif

</div>
</div>

<div class="row">
  <div class="column">

  <label for="requirename_var19" class="">Requirement Name19</label>


  <input id="requirename_var19" type="text" class="form-control" name="requirename_var19"  value="{{ old('requirename_var19') }}" >

  @if ($errors->has('requirename_var19'))
  <span class="help-block">
    <strong>{{ $errors->first('requirename_var19') }}</strong>
  </span>
  @endif

  </div>

  <div class="column">

  <label for="requirename_var20" class="">Requirement Name20</label>


  <input id="requirename_var20" type="text" class="form-control" name="requirename_var20"  value="{{ old('requirename_var20') }}" >

  @if ($errors->has('requirename_var20'))
  <span class="help-block">
    <strong>{{ $errors->first('requirename_var20') }}</strong>
  </span>
  @endif

  </div>

</div>
<h3 style="color:#00325d;">CASE Variable Name </h3>

<div class="row">
  <div class="column">

    <label for="var_name1" class="">Variable Name1</label>


        <input id="var_name1" type="text" class="form-control" name="var_name1"  value="{{ old('var_name1') }}" >

        @if ($errors->has('var_name1'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name1') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name2" class="">Variable Name2</label>


      <input id="var_name2" type="text" class="form-control" name="var_name2"  value="{{ old('var_name2') }}" >

      @if ($errors->has('var_name2'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name2') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name3" class="">Variable Name3</label>


      <input id="var_name3" type="text" class="form-control" name="var_name3"  value="{{ old('var_name3') }}" >

      @if ($errors->has('var_name3'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name3') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name4" class="">Variable Name4</label>


      <input id="var_name4" type="text" class="form-control" name="var_name4"  value="{{ old('var_name4') }}" >

      @if ($errors->has('var_name4'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name4') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name5" class="">Variable Name5</label>


      <input id="var_name5" type="text" class="form-control" name="var_name5"  value="{{ old('var_name5') }}" >

      @if ($errors->has('var_name5'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name5') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name6" class="">Variable Name6</label>


      <input id="var_name6" type="text" class="form-control" name="var_name6"  value="{{ old('var_name6') }}" >

      @if ($errors->has('var_name6'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name6') }}</strong>
          </span>
      @endif

</div>
</div>


<div class="row">
  <div class="column">

    <label for="var_name7" class="">Variable Name7</label>


        <input id="var_name7" type="text" class="form-control" name="var_name7"  value="{{ old('var_name7') }}" >

        @if ($errors->has('var_name7'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name7') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name8" class="">Variable Name8</label>


      <input id="var_name8" type="text" class="form-control" name="var_name8"  value="{{ old('var_name8') }}" >

      @if ($errors->has('var_name8'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name8') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name9" class="">Variable Name9</label>


      <input id="var_name9" type="text" class="form-control" name="var_name9"  value="{{ old('var_name9') }}" >

      @if ($errors->has('var_name9'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name9') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name10" class="">Variable Name10</label>


      <input id="var_name10" type="text" class="form-control" name="var_name10"  value="{{ old('var_name10') }}" >

      @if ($errors->has('var_name10'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name10') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name11" class="">Variable Name11</label>


      <input id="var_name11" type="text" class="form-control" name="var_name11"  value="{{ old('var_name11') }}" >

      @if ($errors->has('var_name11'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name11') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name12" class="">Variable Name12</label>


      <input id="var_name12" type="text" class="form-control" name="var_name12"  value="{{ old('var_name12') }}" >

      @if ($errors->has('var_name12'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name12') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_name13" class="">Variable Name13</label>


        <input id="var_name13" type="text" class="form-control" name="var_name13"  value="{{ old('var_name13') }}" >

        @if ($errors->has('var_name13'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name13') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name14" class="">Variable Name14</label>

      <input id="var_name14" type="text" class="form-control" name="var_name14"  value="{{ old('var_name14') }}" >

      @if ($errors->has('var_name14'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name14') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name15" class="">Variable Name15</label>


      <input id="var_name15" type="text" class="form-control" name="var_name15"  value="{{ old('var_name15') }}" >

      @if ($errors->has('var_name15'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name15') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name16" class="">Variable Name16</label>


      <input id="var_name16" type="text" class="form-control" name="var_name16"  value="{{ old('var_name16') }}" >

      @if ($errors->has('var_name16'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name16') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name17" class="">Variable Name17</label>


      <input id="var_name17" type="text" class="form-control" name="var_name17"  value="{{ old('var_name17') }}" >

      @if ($errors->has('var_name17'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name17') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name18" class="">Variable Name18</label>


      <input id="var_name18" type="text" class="form-control" name="var_name18"  value="{{ old('var_name18') }}" >

      @if ($errors->has('var_name18'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name18') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_name19" class="">Variable Name19</label>


        <input id="var_name19" type="text" class="form-control" name="var_name19"  value="{{ old('var_name19') }}" >

        @if ($errors->has('var_name19'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name19') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name20" class="">Variable Name20</label>

      <input id="var_name20" type="text" class="form-control" name="var_name20"  value="{{ old('var_name20') }}" >

      @if ($errors->has('var_name20'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name20') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name21" class="">Variable Name21</label>


      <input id="var_name21" type="text" class="form-control" name="var_name21"  value="{{ old('var_name21') }}" >

      @if ($errors->has('var_name21'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name21') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name22" class="">Variable Name22</label>


      <input id="var_name22" type="text" class="form-control" name="var_name22"  value="{{ old('var_name22') }}" >

      @if ($errors->has('var_name22'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name22') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name23" class="">Variable Name23</label>


      <input id="var_name23" type="text" class="form-control" name="var_name23"  value="{{ old('var_name23') }}" >

      @if ($errors->has('var_name23'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name23') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name24" class="">Variable Name24</label>


      <input id="var_name24" type="text" class="form-control" name="var_name24"  value="{{ old('var_name24') }}" >

      @if ($errors->has('var_name24'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name24') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_name25" class="">Variable Name25</label>


        <input id="var_name25" type="text" class="form-control" name="var_name25"  value="{{ old('var_name25') }}" >

        @if ($errors->has('var_name25'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name25') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name26" class="">Variable Name26</label>

      <input id="var_name26" type="text" class="form-control" name="var_name26"  value="{{ old('var_name26') }}" >

      @if ($errors->has('var_name26'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name26') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name27" class="">Variable Name27</label>


      <input id="var_name27" type="text" class="form-control" name="var_name27"  value="{{ old('var_name27') }}" >

      @if ($errors->has('var_name27'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name27') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name28" class="">Variable Name28</label>


      <input id="var_name28" type="text" class="form-control" name="var_name28"  value="{{ old('var_name28') }}" >

      @if ($errors->has('var_name28'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name28') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name29" class="">Variable Name29</label>


      <input id="var_name29" type="text" class="form-control" name="var_name29"  value="{{ old('var_name29') }}" >

      @if ($errors->has('var_name29'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name29') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name30" class="">Variable Name30</label>


      <input id="var_name30" type="text" class="form-control" name="var_name30"  value="{{ old('var_name30') }}" >

      @if ($errors->has('var_name30'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name30') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name31" class="">Variable Name31</label>


        <input id="var_name31" type="text" class="form-control" name="var_name31"  value="{{ old('var_name31') }}" >

        @if ($errors->has('var_name31'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name31') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name32" class="">Variable Name32</label>

      <input id="var_name32" type="text" class="form-control" name="var_name32"  value="{{ old('var_name32') }}" >

      @if ($errors->has('var_name32'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name32') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name33" class="">Variable Name33</label>


      <input id="var_name33" type="text" class="form-control" name="var_name33"  value="{{ old('var_name33') }}" >

      @if ($errors->has('var_name33'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name33') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name34" class="">Variable Name34</label>


      <input id="var_name34" type="text" class="form-control" name="var_name34"  value="{{ old('var_name34') }}" >

      @if ($errors->has('var_name34'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name34') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name35" class="">Variable Name35</label>


      <input id="var_name35" type="text" class="form-control" name="var_name35"  value="{{ old('var_name35') }}" >

      @if ($errors->has('var_name35'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name35') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name36" class="">Variable Name36</label>


      <input id="var_name36" type="text" class="form-control" name="var_name36"  value="{{ old('var_name36') }}" >

      @if ($errors->has('var_name36'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name36') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_name37" class="">Variable Name37</label>


        <input id="var_name37" type="text" class="form-control" name="var_name37"  value="{{ old('var_name37') }}" >

        @if ($errors->has('var_name37'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name37') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name38" class="">Variable Name38</label>

      <input id="var_name32" type="text" class="form-control" name="var_name38"  value="{{ old('var_name38') }}" >

      @if ($errors->has('var_name38'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name38') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name39" class="">Variable Name39</label>


      <input id="var_name39" type="text" class="form-control" name="var_name39"  value="{{ old('var_name39') }}" >

      @if ($errors->has('var_name39'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name39') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name40" class="">Variable Name40</label>


      <input id="var_name40" type="text" class="form-control" name="var_name40"  value="{{ old('var_name40') }}" >

      @if ($errors->has('var_name40'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name40') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name41" class="">Variable Name41</label>


      <input id="var_name41" type="text" class="form-control" name="var_name41"  value="{{ old('var_name41') }}" >

      @if ($errors->has('var_name41'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name41') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name42" class="">Variable Name42</label>


      <input id="var_name42" type="text" class="form-control" name="var_name42"  value="{{ old('var_name42') }}" >

      @if ($errors->has('var_name42'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name42') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_name43" class="">Variable Name43</label>


        <input id="var_name43" type="text" class="form-control" name="var_name43"  value="{{ old('var_name43') }}" >

        @if ($errors->has('var_name43'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name43') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name44" class="">Variable Name44</label>

      <input id="var_name44" type="text" class="form-control" name="var_name44"  value="{{ old('var_name44') }}" >

      @if ($errors->has('var_name44'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name44') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name45" class="">Variable Name45</label>


      <input id="var_name45" type="text" class="form-control" name="var_name45"  value="{{ old('var_name45') }}" >

      @if ($errors->has('var_name45'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name45') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name46" class="">Variable Name46</label>


      <input id="var_name46" type="text" class="form-control" name="var_name46"  value="{{ old('var_name46') }}" >

      @if ($errors->has('var_name46'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name46') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name47" class="">Variable Name47</label>


      <input id="var_name47" type="text" class="form-control" name="var_name47"  value="{{ old('var_name47') }}" >

      @if ($errors->has('var_name47'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name47') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name48" class="">Variable Name48</label>


      <input id="var_name48" type="text" class="form-control" name="var_name48"  value="{{ old('var_name48') }}" >

      @if ($errors->has('var_name48'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name48') }}</strong>
          </span>
      @endif

</div>
</div>


<div class="row">
  <div class="column">

    <label for="var_name49" class="">Variable Name49</label>


        <input id="var_name49" type="text" class="form-control" name="var_name49"  value="{{ old('var_name49') }}" >

        @if ($errors->has('var_name49'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name49') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name50" class="">Variable Name50</label>

      <input id="var_name50" type="text" class="form-control" name="var_name50"  value="{{ old('var_name50') }}" >

      @if ($errors->has('var_name50'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name50') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name51" class="">Variable Name51</label>


      <input id="var_name51" type="text" class="form-control" name="var_name51"  value="{{ old('var_name51') }}" >

      @if ($errors->has('var_name51'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name51') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name52" class="">Variable Name52</label>


      <input id="var_name52" type="text" class="form-control" name="var_name52"  value="{{ old('var_name52') }}" >

      @if ($errors->has('var_name52'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name52') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name53" class="">Variable Name53</label>


      <input id="var_name53" type="text" class="form-control" name="var_name53"  value="{{ old('var_name53') }}" >

      @if ($errors->has('var_name53'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name53') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name54" class="">Variable Name54</label>


      <input id="var_name54" type="text" class="form-control" name="var_name54"  value="{{ old('var_name54') }}" >

      @if ($errors->has('var_name54'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name54') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_name55" class="">Variable Name55</label>


        <input id="var_name55" type="text" class="form-control" name="var_name55"  value="{{ old('var_name55') }}" >

        @if ($errors->has('var_name55'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name55') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name56" class="">Variable Name56</label>

      <input id="var_name56" type="text" class="form-control" name="var_name56"  value="{{ old('var_name56') }}" >
      @if ($errors->has('var_name56'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name56') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name57" class="">Variable Name57</label>


      <input id="var_name57" type="text" class="form-control" name="var_name57"  value="{{ old('var_name57') }}" >

      @if ($errors->has('var_name57'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name57') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name58" class="">Variable Name58</label>


      <input id="var_name58" type="text" class="form-control" name="var_name58"  value="{{ old('var_name58') }}" >

      @if ($errors->has('var_name58'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name58') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name59" class="">Variable Name59</label>


      <input id="var_name59" type="text" class="form-control" name="var_name59"  value="{{ old('var_name59') }}" >

      @if ($errors->has('var_name59'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name59') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name60" class="">Variable Name60</label>


      <input id="var_name60" type="text" class="form-control" name="var_name60"  value="{{ old('var_name60') }}" >

      @if ($errors->has('var_name60'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name60') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name61" class="">Variable Name61</label>


        <input id="var_name61" type="text" class="form-control" name="var_name61"  value="{{ old('var_name61') }}" >

        @if ($errors->has('var_name61'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name61') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name62" class="">Variable Name62</label>

      <input id="var_name62" type="text" class="form-control" name="var_name62"  value="{{ old('var_name62') }}" >
      @if ($errors->has('var_name62'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name62') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name63" class="">Variable Name63</label>


      <input id="var_name63" type="text" class="form-control" name="var_name63"  value="{{ old('var_name63') }}" >

      @if ($errors->has('var_name63'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name63') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name64" class="">Variable Name64</label>


      <input id="var_name64" type="text" class="form-control" name="var_name64"  value="{{ old('var_name64') }}" >

      @if ($errors->has('var_name64'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name64') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name65" class="">Variable Name65</label>


      <input id="var_name65" type="text" class="form-control" name="var_name65"  value="{{ old('var_name65') }}" >

      @if ($errors->has('var_name65'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name65') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name66" class="">Variable Name66</label>


      <input id="var_name66" type="text" class="form-control" name="var_name66"  value="{{ old('var_name66') }}" >

      @if ($errors->has('var_name66'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name66') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name67" class="">Variable Name67</label>


        <input id="var_name67" type="text" class="form-control" name="var_name67"  value="{{ old('var_name67') }}" >

        @if ($errors->has('var_name67'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name67') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name68" class="">Variable Name68</label>

      <input id="var_name68" type="text" class="form-control" name="var_name68"  value="{{ old('var_name68') }}" >
      @if ($errors->has('var_name68'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name68') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name69" class="">Variable Name69</label>


      <input id="var_name69" type="text" class="form-control" name="var_name69"  value="{{ old('var_name69') }}" >

      @if ($errors->has('var_name69'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name69') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name70" class="">Variable Name70</label>


      <input id="var_name70" type="text" class="form-control" name="var_name70"  value="{{ old('var_name70') }}" >

      @if ($errors->has('var_name70'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name70') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name71" class="">Variable Name71</label>


      <input id="var_name71" type="text" class="form-control" name="var_name71"  value="{{ old('var_name71') }}" >

      @if ($errors->has('var_name71'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name71') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name72" class="">Variable Name72</label>


      <input id="var_name72" type="text" class="form-control" name="var_name72"  value="{{ old('var_name72') }}" >

      @if ($errors->has('var_name72'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name72') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name73" class="">Variable Name73</label>


        <input id="var_name73" type="text" class="form-control" name="var_name73"  value="{{ old('var_name73') }}" >

        @if ($errors->has('var_name73'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name73') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name74" class="">Variable Name74</label>

      <input id="var_name74" type="text" class="form-control" name="var_name74"  value="{{ old('var_name74') }}" >
      @if ($errors->has('var_name74'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name74') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name75" class="">Variable Name75</label>


      <input id="var_name75" type="text" class="form-control" name="var_name75"  value="{{ old('var_name75') }}" >

      @if ($errors->has('var_name75'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name75') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name76" class="">Variable Name76</label>


      <input id="var_name76" type="text" class="form-control" name="var_name76"  value="{{ old('var_name76') }}" >

      @if ($errors->has('var_name76'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name76') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name77" class="">Variable Name77</label>


      <input id="var_name77" type="text" class="form-control" name="var_name77"  value="{{ old('var_name77') }}" >

      @if ($errors->has('var_name77'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name77') }}</strong>
          </span>
      @endif
</div>
<div class="column">

  <label for="var_name78" class="">Variable Name78</label>


      <input id="var_name78" type="text" class="form-control" name="var_name78"  value="{{ old('var_name78') }}" >

      @if ($errors->has('var_name78'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name78') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name79" class="">Variable Name79</label>


        <input id="var_name79" type="text" class="form-control" name="var_name79"  value="{{ old('var_name79') }}" >

        @if ($errors->has('var_name79'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name79') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name80" class="">Variable Name80</label>

      <input id="var_name80" type="text" class="form-control" name="var_name56"  value="{{ old('var_name80') }}" >
      @if ($errors->has('var_name80'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name80') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name81" class="">Variable Name81</label>


      <input id="var_name81" type="text" class="form-control" name="var_name81"  value="{{ old('var_name81') }}" >

      @if ($errors->has('var_name81'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name81') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name82" class="">Variable Name82</label>


      <input id="var_name82" type="text" class="form-control" name="var_name82"  value="{{ old('var_name82') }}" >

      @if ($errors->has('var_name82'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name82') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name83" class="">Variable Name83</label>


      <input id="var_name83" type="text" class="form-control" name="var_name83"  value="{{ old('var_name83') }}" >

      @if ($errors->has('var_name83'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name83') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name84" class="">Variable Name84</label>


      <input id="var_name84" type="text" class="form-control" name="var_name84"  value="{{ old('var_name84') }}" >

      @if ($errors->has('var_name84'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name84') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name85" class="">Variable Name85</label>


        <input id="var_name85" type="text" class="form-control" name="var_name85"  value="{{ old('var_name85') }}" >

        @if ($errors->has('var_name85'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name85') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name86" class="">Variable Name86</label>

      <input id="var_name86" type="text" class="form-control" name="var_name86"  value="{{ old('var_name86') }}" >
      @if ($errors->has('var_name86'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name86') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name87" class="">Variable Name87</label>


      <input id="var_name87" type="text" class="form-control" name="var_name87"  value="{{ old('var_name87') }}" >

      @if ($errors->has('var_name87'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name87') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name88" class="">Variable Name88</label>


      <input id="var_name88" type="text" class="form-control" name="var_name88"  value="{{ old('var_name88') }}" >

      @if ($errors->has('var_name88'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name88') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name89" class="">Variable Name89</label>


      <input id="var_name89" type="text" class="form-control" name="var_name89"  value="{{ old('var_name89') }}" >

      @if ($errors->has('var_name89'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name89') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name90" class="">Variable Name90</label>


      <input id="var_name90" type="text" class="form-control" name="var_name90"  value="{{ old('var_name90') }}" >

      @if ($errors->has('var_name90'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name90') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name91" class="">Variable Name91</label>


        <input id="var_name91" type="text" class="form-control" name="var_name91"  value="{{ old('var_name91') }}" >

        @if ($errors->has('var_name91'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name91') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name92" class="">Variable Name92</label>

      <input id="var_name92" type="text" class="form-control" name="var_name92"  value="{{ old('var_name92') }}" >
      @if ($errors->has('var_name92'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name92') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name93" class="">Variable Name93</label>


      <input id="var_name93" type="text" class="form-control" name="var_name93"  value="{{ old('var_name93') }}" >

      @if ($errors->has('var_name93'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name93') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name94" class="">Variable Name94</label>


      <input id="var_name94" type="text" class="form-control" name="var_name94"  value="{{ old('var_name94') }}" >

      @if ($errors->has('var_name94'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name94') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name95" class="">Variable Name95</label>


      <input id="var_name95" type="text" class="form-control" name="var_name95"  value="{{ old('var_name95') }}" >

      @if ($errors->has('var_name95'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name95') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name96" class="">Variable Name96</label>


      <input id="var_name96" type="text" class="form-control" name="var_name96"  value="{{ old('var_name96') }}" >

      @if ($errors->has('var_name96'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name96') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name97" class="">Variable Name97</label>


        <input id="var_name97" type="text" class="form-control" name="var_name97"  value="{{ old('var_name97') }}" >

        @if ($errors->has('var_name97'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name97') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name98" class="">Variable Name98</label>

      <input id="var_name98" type="text" class="form-control" name="var_name98"  value="{{ old('var_name98') }}" >
      @if ($errors->has('var_name98'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name98') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name99" class="">Variable Name99</label>


      <input id="var_name99" type="text" class="form-control" name="var_name99"  value="{{ old('var_name99') }}" >

      @if ($errors->has('var_name99'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name99') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name100" class="">Variable Name100</label>


      <input id="var_name100" type="text" class="form-control" name="var_name100"  value="{{ old('var_name100') }}" >

      @if ($errors->has('var_name100'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name100') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name101" class="">Variable Name101</label>


      <input id="var_name101" type="text" class="form-control" name="var_name101"  value="{{ old('var_name101') }}" >

      @if ($errors->has('var_name101'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name101') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name102" class="">Variable Name102</label>


      <input id="var_name102" type="text" class="form-control" name="var_name84"  value="{{ old('var_name102') }}" >

      @if ($errors->has('var_name102'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name102') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name103" class="">Variable Name103</label>


        <input id="var_name103" type="text" class="form-control" name="var_name103"  value="{{ old('var_name103') }}" >

        @if ($errors->has('var_name103'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name103') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name104" class="">Variable Name104</label>

      <input id="var_name104" type="text" class="form-control" name="var_name104"  value="{{ old('var_name104') }}" >
      @if ($errors->has('var_name104'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name104') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name105" class="">Variable Name105</label>


      <input id="var_name105" type="text" class="form-control" name="var_name105"  value="{{ old('var_name105') }}" >

      @if ($errors->has('var_name105'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name105') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name106" class="">Variable Name106</label>


      <input id="var_name106" type="text" class="form-control" name="var_name106"  value="{{ old('var_name106') }}" >

      @if ($errors->has('var_name106'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name106') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name107" class="">Variable Name107</label>


      <input id="var_name107" type="text" class="form-control" name="var_name107"  value="{{ old('var_name107') }}" >

      @if ($errors->has('var_name107'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name107') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name108" class="">Variable Name108</label>


      <input id="var_name108" type="text" class="form-control" name="var_name108"  value="{{ old('var_name108') }}" >

      @if ($errors->has('var_name108'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name108') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name109" class="">Variable Name109</label>


        <input id="var_name109" type="text" class="form-control" name="var_name109"  value="{{ old('var_name109') }}" >

        @if ($errors->has('var_name109'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name109') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name110" class="">Variable Name110</label>

      <input id="var_name110" type="text" class="form-control" name="var_name110"  value="{{ old('var_name110') }}" >
      @if ($errors->has('var_name110'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name110') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name111" class="">Variable Name111</label>


      <input id="var_name111" type="text" class="form-control" name="var_name111"  value="{{ old('var_name111') }}" >

      @if ($errors->has('var_name111'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name111') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name112" class="">Variable Name112</label>


      <input id="var_name112" type="text" class="form-control" name="var_name112"  value="{{ old('var_name112') }}" >

      @if ($errors->has('var_name112'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name112') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name113" class="">Variable Name113</label>


      <input id="var_name113" type="text" class="form-control" name="var_name113"  value="{{ old('var_name113') }}" >

      @if ($errors->has('var_name113'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name113') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name114" class="">Variable Name114</label>


      <input id="var_name114" type="text" class="form-control" name="var_name114"  value="{{ old('var_name114') }}" >

      @if ($errors->has('var_name114'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name114') }}</strong>
          </span>
      @endif

</div>
</div>

<div class="row">
  <div class="column">

    <label for="var_name115" class="">Variable Name115</label>


        <input id="var_name115" type="text" class="form-control" name="var_name115"  value="{{ old('var_name115') }}" >

        @if ($errors->has('var_name115'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name115') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name116" class="">Variable Name116</label>

      <input id="var_name116" type="text" class="form-control" name="var_name116"  value="{{ old('var_name116') }}" >
      @if ($errors->has('var_name116'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name116') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name117" class="">Variable Name117</label>


      <input id="var_name117" type="text" class="form-control" name="var_name117"  value="{{ old('var_name117') }}" >

      @if ($errors->has('var_name117'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name117') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name118" class="">Variable Name118</label>


      <input id="var_name118" type="text" class="form-control" name="var_name118"  value="{{ old('var_name118') }}" >

      @if ($errors->has('var_name118'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name118') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name119" class="">Variable Name119</label>


      <input id="var_name119" type="text" class="form-control" name="var_name119"  value="{{ old('var_name119') }}" >

      @if ($errors->has('var_name119'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name119') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name120" class="">Variable Name120</label>


      <input id="var_name120" type="text" class="form-control" name="var_name120"  value="{{ old('var_name120') }}" >

      @if ($errors->has('var_name120'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name120') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name121" class="">Variable Name121</label>


        <input id="var_name121" type="text" class="form-control" name="var_name121"  value="{{ old('var_name121') }}" >

        @if ($errors->has('var_name121'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name121') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name122" class="">Variable Name122</label>

      <input id="var_name122" type="text" class="form-control" name="var_name122"  value="{{ old('var_name122') }}" >
      @if ($errors->has('var_name122'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name122') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name123" class="">Variable Name123</label>


      <input id="var_name123" type="text" class="form-control" name="var_name123"  value="{{ old('var_name123') }}" >

      @if ($errors->has('var_name123'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name123') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name124" class="">Variable Name124</label>


      <input id="var_name124" type="text" class="form-control" name="var_name124"  value="{{ old('var_name124') }}" >

      @if ($errors->has('var_name124'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name124') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name125" class="">Variable Name125</label>


      <input id="var_name125" type="text" class="form-control" name="var_name125"  value="{{ old('var_name125') }}" >

      @if ($errors->has('var_name125'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name125') }}</strong>
          </span>
      @endif

</div>
<div class="column">

  <label for="var_name126" class="">Variable Name126</label>


      <input id="var_name126" type="text" class="form-control" name="var_name126"  value="{{ old('var_name126') }}" >

      @if ($errors->has('var_name126'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name126') }}</strong>
          </span>
      @endif

</div>
</div>
<div class="row">
  <div class="column">

    <label for="var_name127" class="">Variable Name127</label>


        <input id="var_name127" type="text" class="form-control" name="var_name103"  value="{{ old('var_name127') }}" >

        @if ($errors->has('var_name127'))
            <span class="help-block">
                <strong>{{ $errors->first('var_name127') }}</strong>
            </span>
        @endif

</div>


<div class="column">

  <label for="var_name128" class="">Variable Name128</label>

      <input id="var_name128" type="text" class="form-control" name="var_name128"  value="{{ old('var_name128') }}" >
      @if ($errors->has('var_name128'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name128') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name129" class="">Variable Name129</label>


      <input id="var_name129" type="text" class="form-control" name="var_name129"  value="{{ old('var_name129') }}" >

      @if ($errors->has('var_name129'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name129') }}</strong>
          </span>
      @endif

</div>

<div class="column">

  <label for="var_name130" class="">Variable Name130</label>


      <input id="var_name130" type="text" class="form-control" name="var_name130"  value="{{ old('var_name130') }}" >

      @if ($errors->has('var_name130'))
          <span class="help-block">
              <strong>{{ $errors->first('var_name130') }}</strong>
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
