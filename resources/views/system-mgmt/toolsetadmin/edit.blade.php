@extends('system-mgmt.toolsetadmin.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Tool Set</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('toolsetadmin.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('tool_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Tool</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="tool_id">
                              @foreach ($tool as $too)
                                  <option value="{{$too->id}}"{{$too->id == $data->tool_id ? 'selected' : ''}}>{{$too->name}}</option>
                              @endforeach
                          </select>
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('default_tool_status') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Default Tool Status</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="default_tool_status">

                              <option value="0" >-Select-</option>
                              @foreach ($membertoolstatus as $too)
                                  <option value="{{$too->id}}"{{$too->id == $data->default_tool_status ? 'selected' : ''}}>{{$too->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('term_of_payment') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Default Tool Status</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="term_of_payment">

                              <option value="0" >-Select-</option>
                              @foreach ($termofpayment as $too)
                                  <option value="{{$too->id}}"{{$too->id == $data->term_of_payment ? 'selected' : ''}}>{{$too->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('structure_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Tool</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="tool_type">

                              <option value="0" >-Select-</option>
                              @foreach ($tool as $too)
                                  <option value="{{$too->id}}"{{$too->id == $data->tool_id ? 'selected' : ''}}>{{$too->name}}</option>
                              @endforeach

                          </select>

                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tool Set Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('limit_number_port') ? ' has-error' : '' }}">
                            <label for="limit_number_port" class="col-md-4 control-label">Limit Number Of Portfolio</label>

                            <div class="col-md-6">
                                <input id="limit_number_port" type="text" class="form-control" name="limit_number_port" value="{{ $data->limit_number_port}}"  >

                                @if ($errors->has('limit_number_port'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('limit_number_port') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('valid_period') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Valid Period</label>
                        <div class="col-md-6">
                          <select class="form-control  name" name="valid_period" >
                            <option value="" >-select-</option>
                            <option value="15" {{$data->valid_period == 15 ? 'selected' : ''}} >15 Days</option>
                            <option value="30" {{$data->valid_period == 30 ? 'selected' : ''}}>30 Days</option>
                            <option value="90" {{$data->valid_period == 90 ? 'selected' : ''}}>90 Days</option>
                            <option value="180" {{$data->valid_period == 180 ? 'selected' : ''}}>180 Days</option>
                            <option value="360" {{$data->valid_period == 360 ? 'selected' : ''}}>360 Days</option>

                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('contract_period') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Contract Period</label>
                        <div class="col-md-6">
                          <select class="form-control  name" name="contract_period" >
                            <option value="" >-select-</option>
                            <option value="15" {{$data->contract_period == 15 ? 'selected' : ''}} >15 Days</option>
                            <option value="30" {{$data->contract_period == 30 ? 'selected' : ''}}>30 Days</option>
                            <option value="90" {{$data->contract_period == 90 ? 'selected' : ''}}>90 Days</option>
                            <option value="180" {{$data->contract_period == 180 ? 'selected' : ''}}>180 Days</option>
                            <option value="360" {{$data->contract_period == 360 ? 'selected' : ''}}>360 Days</option>

                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('initial_free') ? ' has-error' : '' }}">
                            <label for="initial_free" class="col-md-4 control-label">Initial Fee</label>

                            <div class="col-md-6">
                                <input id="initial_free" type="text" class="form-control" name="initial_free" value="{{ $data->initial_free }}"  >

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
                                <input id="period_fee" type="text" class="form-control" name="period_fee" value="{{ $data->period_fee }}"  >

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
                                <input id="exit_fee" type="text" class="form-control" name="exit_fee" value="{{$data->exit_fee}}"  >

                                @if ($errors->has('exit_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exit_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
