@extends('system-mgmt.insurance.base')
@section('action-content')
    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
      <div class="col-sm-6">
        <a href="/wealththaiinsuranceuser" class="btn btn-primary btn-margin">สร้างงานใหม่</a>
        @if($flagbutton == 1)
        <a href="/wealththaiinsurance/all/case/stageuser" class="btn btn-margin btn-default">ดูเฉพาะงานตัวเอง</a>
        @else
          <a href="/wealththaiinsurance/all/case/stageuser?alludb=1" class="btn btn-margin btn-default">ดูงานทั้งหมดที่มีสิทธิ</a>
        @endif

      </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">


        <div class="col-sm-6"></div>
      </div>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">

			<div style="overflow-x:auto;">
          <table style="font-size:16px" id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>

              <tr role="row">
                <th >สถานะงาน/ขั้นตอนงาน</th>
                <th style="width:80px">งานใหม่</th>
                <th style="width:80px">งานต่ออายุ</th>
                <th style="width:80px">ทั้งหมด</th>
                <th >เตือน</th>
              </tr>
            </thead>
            <tbody>

              @foreach($stage as $st)
              <tr class="table-tr" data-url="/wealththaiinsurance/all/casesuser?filterstage{{$st->id}}">
              <td>
                <a href="/wealththaiinsurance/all/casesuser?filterstage{{$st->id}}">{{$st->name}}</a>
              </td>
              @php
              $newcase = App\Cases::where('stage',$st->id)->whereIn('id',$casecansee)->whereNull('ref_previous_case')->get();
              $countnewcase = count($newcase);
              $oldcase = App\Cases::where('stage',$st->id)->whereIn('id',$casecansee)->whereNotNull('ref_previous_case')->get();
              $countoldcase = count($oldcase);
              $allcase = App\Cases::where('stage',$st->id)->whereIn('id',$casecansee)->get();
              $countallcase = count($allcase);
              @endphp
              <td>
                {{$countnewcase}}
              </td>
              <td>
                {{$countoldcase}}
              </td>
              <td>
                {{$countallcase}}
              </td>
              <td>

              </td>
            </tr>
            @endforeach
            <tr style="background-color:#01F346;">
              @php
              $newcaseall = App\Cases::whereNull('ref_previous_case')->whereIn('id',$casecansee)->get();
              $countnewcaseall = count($newcaseall);
              $oldcaseall = App\Cases::whereNotNull('ref_previous_case')->whereIn('id',$casecansee)->get();
              $countoldcaseall = count($oldcaseall);
              $allcaseall = App\Cases::whereIn('id',$casecansee)->get();
              $countallcaseall = count($allcaseall);
              @endphp
              <td>
                <a href="/wealththaiinsurance/all/casesuser">รวมงานทั้งหมด</a>
              </td>
              <td>
                {{$countnewcaseall}}
              </td>
              <td>
                {{$countoldcaseall}}
              </td>
              <td>
                {{$countallcaseall}}
              </td>
              <td>

              </td>
            </tr>
            </tbody>
            <tfoot>
              <tr>
                <th >สถานะงาน/ขั้นตอนงาน</th>
                <th >งานใหม่</th>
                <th >งานต่ออายุ</th>
                <th >ทั้งหมด</th>
                <th >เตือน</th>
              </tr>
            </tfoot>
          </table>
			</div>
        </div>
      </div>
      <div class="row">

        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>


$(function() {
  $('table.table').on("click", "tr.table-tr", function() {
    window.location = $(this).data("url");
    //alert($(this).data("url"));
  });
});
</script>
