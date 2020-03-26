
@extends('admin.importexcel.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
        </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="panel panel-default ">
     <div class="panel-heading" style="background-color:#E3E1E1">
      <h3 class="panel-title">Import File</h3>
     </div>
     <div class="panel-body">
       @if(count($errors) > 0)
        <div class="alert alert-danger">
         Upload Validation Error<br><br>
         <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
         </ul>
        </div>
       @endif
       @if($message = Session::get('success'))
       <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $message }}</strong>
       </div>
       @endif
       @if($message = Session::get('warning'))
       <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $message }}</strong>
       </div>
       @endif
        <div class="form-group" style="overflow-x:auto;">
         <table class="table">
           <form method="post" enctype="multipart/form-data" action="{{ url('/admin/import_excel/importuser') }}">
            {{ csrf_field() }}
          <tr>
           <td width="40%" align="right"><label>Upload User File <span style="color:red">(only .xls, .xslx)</span></label></td>
           @if(strstr($url,'?userdata=success'))
             <td width="30%">
               <span ><i style="color:green;font-size:24px;" class="fa fa-check-square"></i></span>
             </td>
             <td width="30" align="left">
             </td>
           @else
           <td width="30%">
            <input type="file" name="select_user_file" required autofocus/>
           </td>
           <td width="30" align="left">
             <input type="submit" name="upload" class="btn btn-primary" value="Upload">
           </td>
         @endif
          </tr>
          </form>
          <form method="post" enctype="multipart/form-data" action="{{ url('/admin/import_excel/importblock') }}">
           {{ csrf_field() }}
          <tr>
           <td width="40%" align="right"><label>Upload Block File <span style="color:red">(only .xls, .xslx)</span></label></td>
           @if(strstr($url,'blockdata=success'))
             <td width="30%">
               <span ><i style="color:green;font-size:24px;" class="fa fa-check-square"></i></span>
             </td>
             <td width="30" align="left">
             </td>
           @else
           <td  width="30%">
            <input type="file" name="select_block_file" required autofocus/>
           </td>
           <td width="30" align="left">
             <input type="submit" name="upload" class="btn btn-primary" value="Upload">
           </td>
         @endif
          </tr>
        </form>
        <form method="post" enctype="multipart/form-data" action="{{ url('/admin/import_excel/importcustomer') }}">
         {{ csrf_field() }}
        <tr>
         <td width="40%" align="right"><label>Upload Customer File <span style="color:red">(only .xls, .xslx)</span></label></td>
         @if(strstr($url,'customerdata=success'))
           <td width="30%">
             <span ><i style="color:green;font-size:24px;" class="fa fa-check-square"></i></span>
           </td>
           <td width="30" align="left">
           </td>
         @else
         <td  width="30%">
          <input type="file" name="select_customer_file" required autofocus/>
         </td>
         <td width="30" align="left">
           <input type="submit" name="upload" class="btn btn-primary" value="Upload">
         </td>
       @endif
        </tr>
      </form>
      <form method="post" enctype="multipart/form-data" action="{{ url('/admin/import_excel/importcar') }}">
       {{ csrf_field() }}
      <tr>
       <td width="40%" align="right"><label>Upload Car File <span style="color:red">(only .xls, .xslx)</span></label></td>
       @if(strstr($url,'cardata=success'))
         <td width="30%">
           <span ><i style="color:green;font-size:24px;" class="fa fa-check-square"></i></span>
         </td>
         <td width="30" align="left">
         </td>
       @else
       <td  width="30%">
        <input type="file" name="select_car_file" required autofocus/>
       </td>
       <td width="30" align="left">
         <input type="submit" name="upload" class="btn btn-primary" value="Upload">
       </td>
     @endif
      </tr>
    </form>
    <form method="post" enctype="multipart/form-data" action="{{ url('/admin/import_excel/importcarinsurance') }}">
     {{ csrf_field() }}
    <tr>
     <td width="40%" align="right"><label>Upload Car Insurance File <span style="color:red">(only .xls, .xslx)</span></label></td>
     @if(strstr($url,'carinsurancedata=success'))
       <td width="30%">
         <span ><i style="color:green;font-size:24px;" class="fa fa-check-square"></i></span>
       </td>
       <td width="30" align="left">
       </td>
     @else
     <td  width="30%">
      <input type="file" name="select_carinsurance_file" required autofocus/>
     </td>
     <td width="30" align="left">
       <input type="submit" name="upload" class="btn btn-primary" value="Upload">
     </td>
   @endif
    </tr>
  </form>
          {{--<tr>
           <td width="40%" align="right"><label>Upload Car File <span style="color:red">(only .xls, .xslx)</span></label></td>
           <td >
            <input type="file" name="select_car_file" required autofocus/>
           </td>
           <td width="30" align="left">
           </td>
          </tr>
          <tr>
           <td width="40%" align="right"><label>Upload Car Insurance File <span style="color:red">(only .xls, .xslx)</span></label></td>
           <td >
            <input type="file" name="select_carinsurance_file" required autofocus/>
           </td>
           <td width="30" align="left">
           </td>
          </tr>
          <tr>
           <td width="40%" align="right"><label>Upload Other Insurance File <span style="color:red">(only .xls, .xslx)</span></label></td>
           <td >
            <input type="file" name="select_other_insurance_file" required autofocus/>
           </td>
           <td width="30" align="left">
           </td>
         </tr>--}}
         </table>
        </div>

      <div class="table-responsive">

        {{--total row {{count($data)}} rows
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
         <tr>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">No. <span id="id_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="firstname" style="cursor: pointer">user_code <span id="post_title_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="firstname" style="cursor: pointer">Email <span id="post_title_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="lastname" style="cursor: pointer">password  <span id="id_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="email" style="cursor: pointer">Name <span id="post_title_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="status" style="cursor: pointer">Surname<span id="id_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="user_pid" style="cursor: pointer">Nick Name  <span id="post_title_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="limit_prospect" style="cursor: pointer">Mobile Phone Number<span id="post_title_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="limit_prospect" style="cursor: pointer">Birth Date <span id="post_title_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="limit_prospect" style="cursor: pointer">Department  Code<span id="post_title_icon"></span></th>
          <th width="" class="sorting" data-sorting_type="asc" data-column_name="limit_prospect" style="cursor: pointer">Team Code<span id="post_title_icon"></span></th>
         </tr>
        </thead>
        <tbody>
          @foreach($data as $key =>$d)
          <tr styler="color:green;"role="row" class="odd">
          <td>{{++$key}}</td>
          <td>{{$d->user_code}}</td>
          <td>{{$d->email}}</td>
          <td>{{$d->password}}</td>
          <td>{{$d->name}}</td>
          <td>{{$d->surname}}</td>
          <td>{{$d->nick_name}}</td>
          <td>{{$d->mobile_phone_number}}</td>
          <td>{{$d->birth_date}}</td>
          <td>{{$d->department_code }}</td>
          <td>{{$d->team_code}}</td>
        </tr>
        @endforeach
        </tbody>
      </table>--}}
       @if(count($data)>0)
       <form method="post" enctype="multipart/form-data" action="{{ url('/admin/import_excel/import') }}">
        {{ csrf_field() }}

            <input type="hidden" name="array_user[]"  value="{{$data}}">
            <button type="submit" class="btn btn-success btn-margin">Save</button><a href="/admin/import_excel_user" class="btn btn-danger btn-margin">Cancel</a>

       </form>
       @else
       @endif
      </div>
     </div>
    </div>

  {{--}}   @component('admin.importexcel.step2',compact('data'))
  @endcomponent --}}
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

  <script type="text/javascript">

        $(".nameid").select2({
              placeholder: "Select",
              allowClear: true
          });
  </script>
@endsection
