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
<form class="form-horizontal" role="form" method="POST" action="{{ route('toolordermember.storepackage') }}">
    {{ csrf_field() }}
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Confirm Your Order</div>
                <div class="panel-body">
                  <div style="overflow-x:auto;">

                <table class="table table-borderless table-hover" style="width:100%;color:black; ">
                  @foreach($data as $da)
                  <input type="hidden" type="text" class="form-control" name="tool_package"  value="{{$da->id}}">
                <tr>
                <th width="50%"><p>Package</p></th>
                <td >{{$da->name}}</td>
                </tr>

                <tr>
                <th width="50%"><p>Term of payment</p></th>
                <td >{{$da->Term_Of_Payment->name}}</td>

                </tr>
                <tr>
                <th width="50%"><p>Valid Period</p></th>
                <td >{{$da->valid_period}}</td>

                </tr>
                <tr>
                <th width="50%"><p>Initial Fee</p></th>
                <td >฿{{$da->initial_free}}</td>

                </tr>
                <tr>
                <th width="50%"><p>Period Fee</p></th>
                <td >฿{{$da->period_fee}}</td>

                </tr>
                <tr>
                <th width="50%"><p>Exit Fee</p></th>
                <td >฿{{$da->exit_fee}}</td>

                </tr>
                @endforeach



                </table>
              </div>

                    <div class="form-group">
                        <div class="col-md-6 ">
                          <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-success">
                                Confirm
                            </button>
                        </div>
                    </div>
                    <!-- /.col -->
                  </div>

            </div>
          </div>

    </div>
</div>
</div>

</div>

</form>
@endsection
