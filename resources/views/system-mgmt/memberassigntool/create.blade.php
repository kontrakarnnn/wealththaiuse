@extends('system-mgmt.mytool.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Assign Tool</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('memberassigntool.store') }}">
                        {{ csrf_field() }}

                        <input type="hidden" type="text" class="form-control" name="previous"  value="{{ URL::previous() }}">

                        <div class="form-group">

                          <label class="col-md-4 control-label">My Portfolio</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="port_id" required autofocus>
                            <option>

                            </option>
                            @foreach ($portfolio as $da)
                              <option value={{$da->id}} >{{ $da->type }} / {{ $da->number }} /  {{ $da->Port_type->type }} / {{ $da->Structure->name }} / {{ $da->Block->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">My Tool</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="member_tool_id">

                            @foreach ($membertool as $ca)
                              @php
                                $countmembertool = DB::table('member_assign_tool_to_port')->whereIn('port_id',$portforcheck)->where('member_tool_id',$ca->id)->count();
                              @endphp
                              @if($countmembertool >= $ca->limit_number_of_port)
                              <option disabled value={{$ca->id}} >{{$ca->Tool->name}} </option>
                              @else
                              <option value={{$ca->id}} >{{$ca->Tool->name}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">

      $(".nameid").select2({
            placeholder: "Select",
            allowClear: true
        });
</script>

<script>
function myFunction() {
  var today = new Date();
  var time = today.getMinutes();
  var sec  = today.getSeconds();
  var s =  Math.random().toString(12).substring(2, 8)+Math.random().toString(12).substring(2, 8);


  document.getElementById("keyss").innerHTML = s;
}
</script>

@endsection
