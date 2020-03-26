@extends('person.base')
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
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">คำนำหน้า</th>
                <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">ชื่อ</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">นามสกุล</th>
                <th  class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Last Name</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ชื่อเล่น</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">อีเมลล์</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">โทรศัพท์</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">โทรศัพทฺ์มือถือ</th>
                <th  class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">วันเกิด</th>



              </tr>
            </thead>

            <tbody>




                <tr role="row" class="odd">
                  <td>{{ $per->gender }}</td>
                  <td>{{ $per->name}}</td>
                  <td>{{ $per->lname}}</td>
                  <td>{{ $per->Eng_name}}</td>
                  <td>{{ $per->Eng_lastname}}</td>
                  <td>{{ $per->nickname}}</td>
                  <td>{{ $per->email }}</td>

                  <td>{{ $per->phone }}</td>
                  <td>{{ $per->mobile }}</td>
                  <td>{{ $per->dob }}</td>




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

                            <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เลขบัตรประชาชน</th>
                <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">วันออกบัตรประชาชน</th>
                <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">วันหมดอายุบัตรประชาชน</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">สัญชาติ</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">เชื้อชาติ</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ศาสนา</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">สถานะ</th>

              </tr>
            </thead>

            <tbody>

                <tr role="row" class="odd">
                    <td>{{ $per->id_num }}</td>
                  <td>{{ $per->citizen_issued_date }}</td>
                  <td>{{ $per->citizen_expire_date }}</td>

                  <td>{{ $per->nationality }}</td>
                  <td>{{ $per->race }}</td>
                  <td>{{ $per->religion}}</td>
                  <td>{{ $per->couple}}</td>


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


                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">หมายเลขบัญชี</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ชื่อบัญชี</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ธนาคาร</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">สาขา</th>



              </tr>
            </thead>

            <tbody>

                <tr role="row" class="odd">


                  <td>{{ $per->bankaccount}}</td>
                  <td>{{ $per->bank_account_name}}</td>
                  <td>{{ $per->bank}}</td>
                  <td>{{ $per->branch}}</td>




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

                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ที่อยู่จัดส่งเอกสาร</th>

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

                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">บริษัท</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">อาชีพ</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ตำแหน่ง</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ประเภทธุรกิจ</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ประสบการณ์ทำงาน</th>

              </tr>
            </thead>

            <tbody>

                <tr role="row" class="odd">

                  <td>{{ $per->company }}</td>
                  <td>{{ $per->occupation}}</td>
                  <td>{{ $per->position}}</td>
                  <td>{{ $per->type_business}}</td>
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

                  @endforeach
                  <td>{{ $per->event_name }}</td>
                  <td>{{ $per->user_name }}</td>
                  <td>{{ $per->mem_name }}</td>



              </tr>

            </tbody>

          </table>
    		</div>
          <br>
          <table class="table table-bordered table-striped table-hover table-mc-red">
          <thead class ="thead-dark">
                  <tr>
                    <th> No. </th>
                    <th > File </th>





                  </tr>
          </thead>

          <tbody>

              @foreach($fileasset as $key => $a)
              <tr>
              <td> File{{++$key}}</td>
              <?php
                $filecatmember = \App\FileCat::where('id',$a->file_cat_id)->value('member_view');
                $filecatmiddle = \App\FileCat::where('id',$a->file_cat_id)->value('middle_view');
               ?>
              <td >  @if($filecatmember == 1 )<a style="font-size:16px" href="{{ URL::to('SecurityBroke/showfile',[$a->id])}}" >{{$a->file_public_name}}</a>
                @else
                @endif
                <br />

              </td >

              </tr>
              @endforeach




        </tbody>
        </table>

          <br>



    	  </div>
      </div>

    </div>


@endforeach
</div>
</section>
@endsection
