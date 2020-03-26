@extends('system-mgmt.toolsetmember.base')

@section('action-content')
<style>
.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 500px) {
  .column {
    width: 100%;
  }
  .column2 {
    width: 100%;
  }

}
</style>
<form class="form-horizontal" role="form" method="POST" action="{{ route('toolmember.storepackage') }}">
    {{ csrf_field() }}
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{$data->name}}</div>
                <input type="hidden" name="tool_package" value="{{$data->id}}" >
                <div class="panel-body">

                      @if($data->attachment !=NULL)
                      <?php
                      $imageroot = '\toolpackage'.'\\'.$data->attachment;
                      $image =public_path('toolpackage')."/".$data->attachment;
                      // Read image path, convert to base64 encoding
                      $imageData = base64_encode(file_get_contents($image));

                      // Format the image SRC:  data:{mime};base64,{data};
                      $src = 'data: '.mime_content_type($image).';base64,'.$imageData;

                      // Echo out a sample image
                      //echo '<img src="' . $src . '">';

                      echo '<img class="img-responsive"  src="'.$src.'" alt="{{$data->name}}">';
                      ?>
                      @endif
                                            <p style="font-size:200%;">{{$data->name}}</p>
                                            <div class="row" style="padding:10px">
                                                  <div class="column">
                                            <p><b>Limit Number Port</b> : {{$data->limit_number_port}}</p>
                                            <p><b>Term Of Payment</b> : {{$data->Term_Of_Payment->name}}</p>
                                            <p><b>Valid Period</b> : {{$data->valid_period}}</p>
                                            <p><b>Initail Fee</b> : {{$data->initial_fee}}</p>
                                          </div>
                                          <div class="column">
                                            <p><b>Period Fee</b> : {{$data->period_fee}}</p>
                                            <p><b>Exit Fee</b> : {{$data->exit_fee}}</p>
                                            <p><b>Description</b> : {{$data->description}}</p>

                                          </div>
                                        </div>


                      <br />
                      <h4>You Will Get</h4>
                      <div style="overflow-x:auto;">
                          <table id="example2" class="table table-sm">
                            <thead>
                              <tr role="row">
                                <th></th>
                                <th>Product Name</th>
                                <th>Set</th>
                                <th width="60%">Product Description</th>

                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($findset as $i =>$da)
                                <tr role="row" class="odd">
                                  <td> {{++$i}}</td>
                                  <td>{{ $da->ToolSet->Tool->name }}</td>
                                  <td>{{ $da->ToolSet->name }}</td>
                                  <td>{{ $da->ToolSet->Tool->description }}</td>
                              </tr>
                            @endforeach
                            </tbody>

                          </table>
                      </div>

                      <form>

                      </form>

                      <div class="form-group">
                          <div class="col-md-6 ">
    						<a href="/toolmember" class="btn btn-primary">Back</a>

                              <button type="submit" class="btn btn-success">
                                  Get
                              </button>
                          </div>
                      </div>
            </div>
    </div>
</div>

</div>

</form>
@endsection
