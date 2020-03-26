@extends('person.base')
@section('action-content')
<style>
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

    <!-- Main content -->
    <section class="content">
      <div class="container">
          <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                      <div class="panel-heading">My Referal Link</div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-sm-5">



                        </div>
                      </div>





                              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="name" class="">Quick Register Referal</label>

                                  <div class="">
                                    <input class="form-control" readonly="readonly" type="text" value="{{ url('/quickregister') . '?refmem?' . $currentmatchids }}" id="myInput">
                                    <br>
                           <button class="btn btn-info" onclick="myFunction()">Copy Link</button>
                                  </div>
                              </div>


                              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label for="name" class="">Full Register Referal</label>

                                  <div class="">
                                    <input class="form-control" readonly="readonly" type="text" value="{{ url('/perregis/create') . '?refmem?' . $currentmatchids }}" id="myInput2">
                                      <br>
                                    <button class="btn btn-info" onclick="myFunction2()">Copy Link</button>
                                  </div>
                              </div>
                              <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">total  <b style="color:red;">{{count($refmem)}}</b> members</div>
                              <div style="overflow-x:auto;">

                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                      <thead>
                                        <tr role="row">

                                          <th>Name</th>
                                          <th>Lastname</th>
                                        </tr>
                                      </thead>
                                      <tbody>








                                      @foreach ($refmem as $index => $rm)
                                          <tr role="row" class="odd">
                                            <td>{{ $rm->name }}  </td>
                                                    <td> {{ $rm->lname }} </td>


                                 </td>




                                        </tr>
                                      @endforeach

                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th>Name</th>
                                          <th>Lastname</th>

                                        </tr>
                                      </tfoot>
                                    </table>
                                      </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>


      <!-- Your Page Content Here -->









<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}

function myFunction2() {
  var copyText = document.getElementById("myInput2");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
    </section>

    <!-- /.content -->

  <!-- /.content-wrapper -->

  <!-- Footer -->


<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

 <!-- jQuery 2.1.3 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
@endsection
