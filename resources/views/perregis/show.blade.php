@extends('users-mgmt.baseperson')
@section('action-content')

<link href="{{ asset('css/shows.css') }}" rel="stylesheet">
<section class="content">
  <div class="box">
    <div class="box-header">
      <div class="row">
          <div class="col-sm-8">
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
              <h4 class="box-title">General Information</h4>
            </div>

        </div>
      </div>
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
          <tr role="row">
            <th width="15%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">User Name</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">phone</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">dob</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">age</th>
            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">id_num</th>


          </tr>
        </thead>

        <tbody>

            <tr role="row" class="odd">
              <td>{{ $per->name}}</td>
              <td>{{ $per->lname}}</td>
              <td>{{ $per->email }}</td>

              <td>{{ $per->phone }}</td>
              <td>{{ $per->dob }}</td>
              <td>{{ $per->age }}</td>
              <td>{{ $per->id_num }}</td>


          </tr>

        </tbody>

      </table>
      <br>
      <br>
      <div class="box-header">
        <div class="row">
            <div class="col-sm-8">
              <h4 class="box-title">Scholaship & Job Information</h4>
            </div>

        </div>
      </div>
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

              <td>{{ $per->address }}</td>
              <td>{{ $per->university }}</td>
              <td>{{ $per->faculty }}</td>
              <td>{{ $per->major }}</td>
              <td>{{ $per->gpa }}</td>


          </tr>

        </tbody>

      </table>
      <br>

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
              <td>{{ $per->workexpr }}</td>
              <td>{{ $per->skill }}</td>
              <td>{{ $per->interest }}</td>
              <td>{{ $per->another }}</td>
              <td>{{ $per->status }}</td>



          </tr>

        </tbody>

      </table>
      <br>


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
</div>
</section>
@endsection
