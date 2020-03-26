@extends('system-mgmt.toolpackageadmin.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Tool Package</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('toolpackageadmin.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                            <label for="attachment" class="col-md-4 control-label">attachment</label>

                            <div class="col-md-6">
                                <input id="name" type="file" class="form-control" name="attachment" value="{{ old('attachment') }}"  required autofocus>

                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tool Package Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('limit_number_port') ? ' has-error' : '' }}">
                            <label for="limit_number_port" class="col-md-4 control-label">Default Limit Number Portfolio </label>

                            <div class="col-md-6">
                                <input id="limit_number_port" type="text" class="form-control" name="limit_number_port" value="{{ old('limit_number_port') }}"  >

                                @if ($errors->has('limit_number_port'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('limit_number_port') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">

                          <label class="col-md-4 control-label">Default Tool Status</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="default_tool_status">
                            <option value="0" >-Select-</option>
                            @foreach ($membertoolstatus as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>
                        <div class="form-group">

                          <label class="col-md-4 control-label">Term Of Payment</label>
                          <div class="col-md-6">
                          <select class="form-control  name" name="term_of_payment">
                            <option value="0" >-Select-</option>
                            @foreach ($termofpayment as $ca)
                              <option value={{$ca->id}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('valid_period') ? ' has-error' : '' }}">
                            <label for="valid_period" class="col-md-4 control-label">Valid Period</label>

                            <div class="col-md-6">
                                <input id="valid_period" type="text" class="form-control" name="valid_period" value="{{ old('valid_period') }}"  >

                                @if ($errors->has('valid_period'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valid_period') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('initial_free') ? ' has-error' : '' }}">
                            <label for="initial_free" class="col-md-4 control-label">Initial Fee</label>

                            <div class="col-md-6">
                                <input id="initial_free" type="text" class="form-control" name="initial_free" value="{{ old('initial_free') }}"  >

                                @if ($errors->has('initial_free'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('initial_free') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('period_fee') ? ' has-error' : '' }}">
                            <label for="period_fee" class="col-md-4 control-label">Period Fee</label>

                            <div class="col-md-6">
                                <input id="period_fee" type="text" class="form-control" name="period_fee" value="{{ old('period_fee') }}"  >

                                @if ($errors->has('period_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('period_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('exit_fee') ? ' has-error' : '' }}">
                            <label for="exit_fee" class="col-md-4 control-label">Exit Fee</label>

                            <div class="col-md-6">
                                <input id="exit_fee" type="text" class="form-control" name="exit_fee" value="{{ old('exit_fee') }}"  >

                                @if ($errors->has('exit_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exit_fee') }}</strong>
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
                        @if($mainpage >= 1 )
                        @else
                        <div class="form-group">

                                          <label for="main_page" class="col-md-4 control-label"></label>
                                          <div class="col-md-6">
                                		<input id="main_page" type="checkbox"  name="main_page" value="1"> Main of Slider<br>
                                    @if ($errors->has('main_page'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('main_page') }}</strong>
                                        </span>
                                    @endif
                                        </div>
                                        </div>
                          @endif
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
@endsection
