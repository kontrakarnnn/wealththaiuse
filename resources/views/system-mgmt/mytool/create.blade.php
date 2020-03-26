@extends('system-mgmt.mytool.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Tool To Member</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('member-tool-admin.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="tool_id" required autofocus>
                            <option>

                            </option>
                            @foreach ($tool as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Member</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="member_id" required autofocus>
                            <option>

                            </option>
                            @foreach ($member as $ca)
                              <option value={{$ca->id}} >{{$ca->name}} {{$ca->lname}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Member Tool Status</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="member_tool_status">
                            <option>

                            </option>
                            @foreach ($membertoolstatus as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('limit_number_of_port') ? ' has-error' : '' }}">
                            <label for="limit_number_of_port" class="col-md-4 control-label">Limit Number Port</label>

                            <div class="col-md-6">
                                <input id="limit_number_of_port" type="text" class="form-control" name="limit_number_of_port" value="{{ old('limit_number_of_port') }}"  >

                                @if ($errors->has('limit_number_of_port'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('limit_number_of_port') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('register_key') ? ' has-error' : '' }}">
                            <label for="register_key" class="col-md-4 control-label">Register Key</label>

                            <div class="col-md-6">
                              @php
                              $ran = str_random(12);
                              @endphp
                              <input id="register_key" type="text" class="form-control" name="register_key" value="{{$ran }}"  >

                              @if ($errors->has('register_key'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('register_key') }}</strong>
                                  </span>
                              @endif

                            </div>

                        </div>
                        <div class="form-group{{ $errors->has('valid_from') ? ' has-error' : '' }}">
                            <label for="valid_to" class="col-md-4 control-label">Valid From</label>

                            <div class="col-md-6">
                                <input id="valid_from" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" name="valid_from" value="{{ old('valid_from') }}"  >

                                @if ($errors->has('valid_from'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valid_from') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('valid_to') ? ' has-error' : '' }}">
                            <label for="valid_to" class="col-md-4 control-label">Valid To</label>

                            <div class="col-md-6">
                                <input id="valid_to" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" name="valid_to" value="{{ old('valid_to') }}"  >

                                @if ($errors->has('valid_to'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valid_to') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}"></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
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
