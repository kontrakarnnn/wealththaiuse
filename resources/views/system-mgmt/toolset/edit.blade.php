@extends('system-mgmt.toolset.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Tool Set</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('toolset.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                        <div class="form-group{{ $errors->has('tool_id') ? ' has-error' : '' }}">
                      <label class="col-md-4 control-label">Tool</label>
                        <div class="col-md-6">
                          @if($fromtool == 1)
                          <select disabled readonly="readonly" class=" form-control department" name="">
                            @else
                          <select class=" form-control department" name="">
                            @endif
                              <option value="0" >-Select-</option>
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
                            <label for="valid_period" class="col-md-4 control-label">Valid Period</label>

                            <div class="col-md-6">
                                <input id="valid_period" type="text" class="form-control" name="valid_period" value="{{$data->valid_period}}"  >

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
