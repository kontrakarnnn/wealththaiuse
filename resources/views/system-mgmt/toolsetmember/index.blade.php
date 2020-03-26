@extends('system-mgmt.toolsetmember.base')

@section('action-content')
<style>
.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}
.column2 {
  float: left;
  width: 60%;
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
<form class="form-horizontal" role="form" method="POST" action="{{ route('toolmember.store') }}">
    {{ csrf_field() }}
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{$tool->name}}</div>

                <div class="panel-body">
                  <div class="row" style="">
                    <div class="column">
                      @if($tool->attachment !=NULL)
                      <?php
                      $imageroot = '\tool'.'\\'.$tool->attachment;
                      $image =public_path('tool')."/".$tool->attachment;
                      // Read image path, convert to base64 encoding
                      $imageData = base64_encode(file_get_contents($image));

                      // Format the image SRC:  data:{mime};base64,{data};
                      $src = 'data: '.mime_content_type($image).';base64,'.$imageData;

                      // Echo out a sample image
                      //echo '<img src="' . $src . '">';
                      echo '<img class="img-responsive" src="'.$src.'" alt="{{$tool->name}}">';
                      ?>
                      @endif                    </div>
                    <div class="column2">

                                            <p style="font-size:200%;">{{$tool->name}}</p>
                                            <p><b>Description</b> : {{$tool->description}}</p>
                                            <p><b>Version</b> : {{$tool->last_version}}</p>
                                            <p><b>Created By</b> : {{$tool->User->firstname}} {{$tool->User->lastname}}</p>
                                            <p><b>Published Date</b> : {{$tool->published_date}}</p>
                                            <p><b>Last Updated Date</b> : {{$tool->update_date}}</p>

                                                                </div>

                  </div>



                      <br />
                      <h4>Select Choice</h4>
                      <div style="overflow-x:auto;">
                          <table id="example2" class="table table-sm">
                            <thead>
                              <tr role="row">
                                <th width="2%"></th>
                                <th>Product Name</th>
                                <th>Limit</th>
                                <th>Term of payment</th>
                                <th>Valid Period</th>
                                <th>Initial Fee</th>
                                <th>Period Fee</th>
                                <th>Exit Fee</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $da)
                                <tr role="row" class="odd">
                                  <td>

                                      <label><input class="subject-list "type="checkbox" name="tool_id" value="{{$da->id}}" ></label>
                                      <script type="text/javascript">
                                  	    $('.subject-list').on('change', function() {
                                  		    $('.subject-list').not(this).prop('checked', false);
                                  		});
                                      </script>
                                  </td>
                                  <td>{{ $da->name }}</td>
                                  <td>{{ $da->limit_number_port }}</td>
                                  <td>{{ $da->Term_Of_Payment->name }}</td>
                                  <td>{{ $da->valid_period }}</td>
                                  <td>{{ $da->initial_fee }}</td>
                                  <td>{{ $da->period_fee }}</td>
                                  <td>{{ $da->exit_fee }}</td>

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
                @if($cantbuy == 1)
                              <button type="submit" class="btn btn-success">
                                  Get
                              </button>
                @else
                <button disabled type="submit" class="btn btn-success">
                    You already get this tool
                </button>
                @endif
                          </div>
                      </div>
            </div>

    </div>
</div>

</div>

</form>
@endsection
