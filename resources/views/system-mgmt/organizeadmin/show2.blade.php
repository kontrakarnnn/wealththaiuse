@extends('per.base')
@section('action-content')

<link href="{{ asset('css/shows.css') }}" rel="stylesheet">
<section class="content">
  <div class="box">
    <div class="box-header">
      <div class="row">
          <div class="col-sm-8">
            @foreach ($ref as $per)
            <h3 class="box-title">Detail of : {{$per->name}}</h3>
          </div>

      </div>
    </div>
<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
  <div class="row">
    <div class="col-sm-12">

      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">General Information</h4>
            </div>

        </div>
      </div>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">
            <th width="15%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">User Name</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">phone</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">mobile</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">dob</th>

            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">id_num</th>


          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">
              <td>{{ $per->name}}</td>
              <td>{{ $per->lname}}</td>
              <td>{{ $per->email }}</td>

              <td>{{ $per->phone }}</td>
              <td>{{ $per->mobile }}</td>
              <td>{{ $per->dob }}</td>

              <td>{{ $per->id_num }}</td>


          </tr>

        </tbody>

      </table>

		</div>


      <br>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Information</h4>
            </div>

        </div>
      </div>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">citizen issued date</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">citizen expire date</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Gender</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Nationality</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Race</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Religion</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Couple</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Income</th>

          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">
              <td>{{ $per->citizen_issued_date }}</td>
              <td>{{ $per->citizen_expire_date }}</td>
              <td>{{ $per->gender }}</td>
              <td>{{ $per->nationality }}</td>
              <td>{{ $per->race }}</td>
              <td>{{ $per->religion}}</td>
              <td>{{ $per->couple}}</td>
              <td>{{ $per->income}}</td>


          </tr>

        </tbody>

      </table>
		</div>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Bank Information</h4>
            </div>

        </div>
      </div>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">


            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Bankaccount</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Bank</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Branch</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Bank account name</th>


          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">


              <td>{{ $per->bankaccount}}</td>
              <td>{{ $per->bank}}</td>
              <td>{{ $per->branch}}</td>
              <td>{{ $per->bank_account_name}}</td>



          </tr>

        </tbody>

      </table>
		</div>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Passport Address Information</h4>
            </div>

        </div>
      </div>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">

            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เลขที่</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ตรอก/ซอย</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ถนน</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">แขวง</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เขต</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">จังหวัด</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ประเทศ</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">รหัสไปรษณีย์</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เบอรโทศัพท์</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">fax</th>
          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">

              <td>{{ $per->add1 }}</td>
              <td>{{ $per->add1_alley}}</td>
              <td>{{ $per->add1_road}}</td>
              <td>{{ $per->add1_subdistrict}}</td>
              <td>{{ $per->add1_district}}</td>
              <td>{{ $per->add1_city}}</td>
              <td>{{ $per->add1_country}}</td>
              <td>{{ $per->add1_postcode}}</td>
              <td>{{ $per->add1_tel}}</td>
              <td>{{ $per->add1_fax}}</td>

          </tr>

        </tbody>

      </table>
		</div>
      <br>

      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Current Address Information</h4>
            </div>

        </div>
      </div>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">

            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เลขที่</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ตรอก/ซอย</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ถนน</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">แขวง</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เขต</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">จังหวัด</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ประเทศ</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">รหัสไปรษณีย์</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เบอรโทศัพท์</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">fax</th>
          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">

              <td>{{ $per->add2 }}</td>
              <td>{{ $per->add2_alley}}</td>
              <td>{{ $per->add2_road}}</td>
              <td>{{ $per->add2_subdistrict}}</td>
              <td>{{ $per->add2_district}}</td>
              <td>{{ $per->add2_city}}</td>
              <td>{{ $per->add2_country}}</td>
              <td>{{ $per->add2_postcode}}</td>
              <td>{{ $per->add2_tel}}</td>
              <td>{{ $per->add2_fax}}</td>

          </tr>

        </tbody>

      </table>
	  </div>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Document Delivery Residence</h4>
            </div>

        </div>
      </div>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">

            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Adress Sentdoc</th>

          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">

              <td>{{ $per->add2_sentdoc }}</td>

          </tr>

        </tbody>

      </table>
		</div>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Company Information</h4>
            </div>

        </div>
      </div>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">

            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">company</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">position</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">type of business</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Occupation</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Work Experience</th>

          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">

              <td>{{ $per->company }}</td>
              <td>{{ $per->position}}</td>
              <td>{{ $per->type_business}}</td>
              <td>{{ $per->occupation}}</td>
              <td>{{ $per->work_experience}}</td>


          </tr>

        </tbody>

      </table>
	  </div>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Company Address</h4>
            </div>

        </div>
      </div>
	  <div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">


            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เลขที่</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ตรอก/ซอย</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ถนน</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">แขวง</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เขต</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">จังหวัด</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ประเทศ</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">รหัสไปรษณีย์</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เบอรโทศัพท์</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">fax</th>
          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">


              <td>{{ $per->com_add_no}}</td>
              <td>{{ $per->com_add_alley}}</td>
              <td>{{ $per->com_add_road}}</td>
              <td>{{ $per->com_add_subdistrict}}</td>
              <td>{{ $per->com_add_district}}</td>
              <td>{{ $per->com_add_city}}</td>
              <td>{{ $per->com_add_country}}</td>
              <td>{{ $per->com_add_postcode}}</td>
              <td>{{ $per->com_tel}}</td>
              <td>{{ $per->com_fax}}</td>

          </tr>

        </tbody>

      </table>
		</div>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Married Information</h4>
            </div>

        </div>
      </div>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">

            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ชื่อ</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">นามสกุล</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">งาน</th>
            <th width="12%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ตำแหน่ง</th>
            <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เบอร์โทร</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เบอร์โทรศัพท์มือถือ</th>

          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">

              <td>{{ $per->couple_name }}</td>
              <td>{{ $per->couple_lname}}</td>
              <td>{{ $per->couple_job}}</td>
              <td>{{ $per->couple_position}}</td>
              <td>{{ $per->couple_phone}}</td>
              <td>{{ $per->couple_mobile}}</td>




          </tr>

        </tbody>

      </table>
	  </div>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Scholaship & Job Information</h4>
            </div>

        </div>
      </div>
	  <div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">

            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">address</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">university</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">faculty</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">major</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">gpa</th>

          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">

            {{--}}  <td>{{ $per->address }}</td>--}}
              <td>{{ $per->university }}</td>
              <td>{{ $per->faculty }}</td>
              <td>{{ $per->major }}</td>
              <td>{{ $per->gpa }}</td>


          </tr>

        </tbody>

      </table>
		</div>
      <br>
		<div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">


            <th width="16%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">job</th>
            <th width="16%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">workexpr</th>
            <th width="16%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">skill</th>
            <th width="16%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">interest</th>
            <th width="16%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">another</th>
            <th width="16%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">status</th>

          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">


              <td>{{ $per->job }}</td>
            {{--}}  <td>{{ $per->workexpr }}</td>--}}
              <td>{{ $per->skill }}</td>
              <td>{{ $per->interest }}</td>
              <td>{{ $per->another }}</td>
              <td>{{ $per->status }}</td>



          </tr>

        </tbody>

      </table>
		</div>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title" style="color:red">Referral Details</h4>
            </div>

        </div>
      </div>
	  <div style="overflow-x:auto;">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">

            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Event</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">User Referral</th>
            <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Member Referral</th>


          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">
                @foreach ($ref as $per)
              <td>{{ $per->event_name }}</td>
              <td>{{ $per->user_name }}</td>
              <td>{{ $per->mem_name }}</td>
              @endforeach


          </tr>

        </tbody>

      </table>
		</div>


      <br>


	  </div>
  </div>

</div>

{{--<div class="container-fluid">
  <h1>Person Management</h1>
  <div class="panel-heading">
    <h2>Detail of : {{$per->name}}</h2>
  </div>
<br>


<div class ="table-responsive-vertical">
      <table class="table table-bordered table-striped table-hover table-mc-red">
      <thead class ="thead-dark">
              <tr>

                <th >Name</th>
                <th >Last Name</th>
                <th >email</th>

                <th >phone</th>
                <th >dob</th>
                <th >age</th>
                <th >id_num</th>
                <th >address</th>
                <th >university</th>
                <th >faculty</th>
                <th >major</th>
                <th >gpa</th>
                <th >job</th>
                <th >workexpr</th>
                <th >skill</th>
                <th >interest</th>
                <th >another</th>
                <th >status</th>



              </tr>
      </thead>

      <tbody>
      <tr>

          <td data-title="Name"> {{ $per->name}}</td>
          <td data-title="Last Name">{{ $per->lname}}</td>
          <td data-title="E-mail">{{ $per->email}}</td>

          <td data-title="Phone">{{ $per->phone}}</td>
          <td data-title="Position">{{ $per->dob}}</td>
          <td data-title="Address">{{ $per->age}}</td>
          <td data-title="Division">{{ $per->id_num}}</td>
          <td data-title="Branch">{{ $per->address}}</td>
          <td data-title="university">{{ $per->university}}</td>
          <td data-title="faculty">{{ $per->faculty}}</td>
          <td data-title="major">{{ $per->major}}</td>
          <td data-title="gpa">{{ $per->gpa}}</td>
          <td data-title="job">{{ $per->job}}</td>
          <td data-title="workexpr">{{ $per->workexpr}}</td>
          <td data-title="skill">{{ $per->skill}}</td>
          <td data-title="interest">{{ $per->interest}}</td>
          <td data-title="another">{{ $per->another}}</td>
          <td data-title="status">{{ $per->status}}</td>


      </tr>
    </tbody>
    </table>
  </div>
</div>--}}
@endforeach
</div>
</section>
@endsection
