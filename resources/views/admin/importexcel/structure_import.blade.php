@extends('admin.importexcel.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title"><a href="/admin/import_excel_user">User Data</a></h3> <i class="glyphicon glyphicon-arrow-right"></i> <h3 class="box-title"><a href="/admin/import_excel_structure">Structure Data</a></h3> <i class="glyphicon glyphicon-arrow-right"></i>
        </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div class="box ">
     <div class="box-header" style="background-color:#E3E1E1">
      <h3 class="box-title">Structure Data</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
     </div>
     <div class="box-body">
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
       <form method="post" enctype="multipart/form-data" action="{{ url('/admin/import_excel') }}">
        {{ csrf_field() }}
        <div class="form-group" style="overflow-x:auto;">
         <table class="table">
          <tr>
           <td width="40%" align="right"><label>Select File for Upload</label></td>
           <td >
            <input type="file" name="select_file" />
           </td>
           <td width="30" align="left">
            <input type="submit" name="upload" class="btn btn-primary" value="Upload">
           </td>
          </tr>
          <tr>
           <td width="30%" align="right"></td>
           <td width="30"><span class="text-muted">.xls, .xslx</span></td>
           <td width="30%" align="left"></td>
          </tr>
         </table>
        </div>
       </form>
      <div class="table-responsive">
        <div id="structuredata" >

        </div>
        <script src="{{ asset ("/js/app.js") }}" type="text/javascript"></script>

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
