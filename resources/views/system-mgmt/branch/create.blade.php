@extends('system-mgmt.branch.base')

@section('action-content')
  <style>
  * {
    box-sizing: border-box;
  }

  /* Create two equal columns that floats next to each other */
  .column {
    float: left;
    width: 25%;
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


  }
    .form-control2{
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
                <div class="panel-heading">Add new branch</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('branch.store') }}">
                        {{ csrf_field() }}
                        <h3>General Information</h3>
                        <div class="row">
                          <div class="column">

                            <label for="name" class="">ชื่อบริษัท</label>


                            <select class=" form-control department" name="org_id">

                                <option value="" >-Select-</option>
                                @foreach ($organizes as $structure)
                                    <option value="{{$structure->id}}">{{$structure->name}}</option>
                                @endforeach

                            </select>

                      </div>
                      <div class="column">
                        <label for="name" class="">ชื่อสาขา</label>


                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>



                        </div>



                        <div class="column">
                          <label for="id_num" class="">เบอร์โทร</label>


                              <input id="tel" type="tel" class="form-control" name="tel" value="{{ old('tel') }}" required>





                        </div>
                        <div class="column">


                              <label for="fax" class="">แฟกซ์</label>


                                  <input id="fax" type="fax" class="form-control" name="fax" value="{{ old('fax') }}" required>



                        </div>
                  </div>

                  <div class="row">

                <div class="column">
                  <label for="number" class="">เลขสาขา</label>


                      <input id="number" type="text" class="form-control" name="number" value="{{ old('number') }}" required autofocus>



                  </div>




            </div>



                  <h3>Address Information</h3>
                  <div class="row">

                    <div class="column">


                            <label for="name" class="">ที่ตั้งบริษัทเลขที่</label>


                                <input id="add_no" type="text" class="form-control" name="add_no" value="{{ old('add_no') }}" required autofocus>



                      </div>

                          <div class="column">

                                <label for="add_alley" class="">ตรอก/ซอย</label>



                                <input id="add_alley" type="text" class="form-control" name="add_alley" value="{{ old('add_alley') }}" required autofocus>


                      </div>

                    <div class="column">


                            <label for="add_road" class="">ถนน</label>


                                <input id="add_road" type="text" class="form-control" name="add_road" value="{{ old('add_road') }}" required autofocus>



                      </div>
                          <div class="column">


                            <label for="add_subdistrict" class="">แขวง</label>


                                <input id="add_subdistrict" type="text" class="form-control" name="add_subdistrict" value="{{ old('add_subdistrict') }}" required autofocus>


                      </div>
                  </div>

                  <div class="row">
                    <div class="column">


                            <label for=" add_district" class="">เขต</label>


                                <input id=" add_district" type="text" class="form-control" name=" add_district" value="{{ old(' add_district') }}" required autofocus>



                        </div>
                        <div class="column">


                            <label for="add_city" class="">จังหวัด</label>


                                <input id="add_city" type="text" class="form-control" name="add_city" value="{{ old('add_city') }}" required autofocus>



                        </div>

                          <div class="column">


                            <label for="add2_country" class="">ประเทศ</label>


                                <input id="add_country" type="text" class="form-control" name="add_country" value="{{ old('add_country') }}" required autofocus>



                        </div>
                        <div class="column">


                            <label for="add_postcode" class="">หมายเลขไปรษณีย์</label>


                                <input id="add_postcode" type="text" class="form-control" name="add_postcode" value="{{ old('add_postcode') }}" required>


                        </div>
                        </div>
                          <h3>Contact Person Information</h3>

                        <div class="row">
                          <div class="column">

                            <label for="con_name" class="">ชื่อจริง</label>


                                <input id="con_name" type="text" class="form-control" name="con_name" value="{{ old('con_name') }}" required>



                        </div>
                        <div class="column">

                          <label for="con_lastname" class="">นามสกุล</label>


                              <input id="con_lastname" type="text" class="form-control" name="con_lastname" value="{{ old('con_lastname') }}" required>



                      </div>

                      <div class="column">

                        <label for="con_tel" class="">เบอร์โทร</label>


                            <input id="con_tel" type="text" class="form-control" name="con_tel" value="{{ old('con_tel') }}" required>



                    </div>

                    <div class="column">

                      <label for="con_email" class="">อีเมลล์</label>


                          <input id="con_email" type="email" class="form-control" name="con_email" value="{{ old('con_email') }}" required>



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
  </div>
  @endsection
