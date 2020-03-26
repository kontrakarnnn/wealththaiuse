@extends('system-mgmt.check-order.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('tool-order.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
                            <label for="invoice_number" class="col-md-4 control-label">Invoice Number</label>

                            <div class="col-md-6">
                                <input id="invoice_number" type="text" class="form-control" name="invoice_number" value="{{ $data->invoice_number }}" >

                                @if ($errors->has('invoice_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('invoice_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Member</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="member_id">
                            <option  ></option>
                            @foreach ($member as $ca)
                              <option value="{{$ca->id}}"{{$ca->id == $data->member_id ? 'selected' : ''}} >{{$ca->name}} {{$ca->lname}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool Set</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="tool_set_id">
                            <option  ></option>
                            @foreach ($toolset as $ca)
                              <option value="{{$ca->id}}" {{$ca->id == $data->tool_set_id ? 'selected' : ''}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Tool Package</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="tool_package_id">
                            <option  ></option>                            @foreach ($toolpackage as $ca)
                              <option value="{{$ca->id}}"{{$ca->id == $data->tool_package_id ? 'selected' : ''}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('initial_fee') ? ' has-error' : '' }}">
                            <label for="initial_fee" class="col-md-4 control-label">Initial Fee</label>

                            <div class="col-md-6">
                                <input id="initial_fee" type="text" class="form-control" name="initial_fee" value="{{$data->initial_fee }}" required autofocus>

                                @if ($errors->has('initial_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('initial_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('period_fee') ? ' has-error' : '' }}">
                            <label for="period_fee" class="col-md-4 control-label">Period Fee</label>

                            <div class="col-md-6">
                                <input id="period_fee" type="text" class="form-control" name="period_fee" value="{{$data->period_fee }}"  >

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
                                <input id="exit_fee" type="text" class="form-control" name="exit_fee" value="{{ $data->exit_fee}}" >

                                @if ($errors->has('exit_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exit_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('initial_deal_date') ? ' has-error' : '' }}">
                            <label for="initial_deal_date" class="col-md-4 control-label">Initial Deal Date</label>

                            <div class="col-md-6">
                                <input id="initial_deal_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="form-control" name="initial_deal_date" value="{{$data->initial_deal_date }}" required autofocus>

                                @if ($errors->has('initial_deal_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('initial_deal_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('next_period_deal_date') ? ' has-error' : '' }}">
                            <label for="next_period_deal_date" class="col-md-4 control-label">Next Period Deal Date</label>

                            <div class="col-md-6">
                                <input id="next_period_deal_date" type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"  class="form-control" name="next_period_deal_date" value="{{ $data->next_period_deal_date }}" required autofocus>

                                @if ($errors->has('next_period_deal_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('next_period_deal_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                          <label class="col-md-4 control-label">Order Status</label>
                          <div class="col-md-6">
                          <select class="form-control  nameid" name="order_status">
                            <option ></option>
                            @foreach ($toolorderstatus as $ca)
                              <option value="{{$ca->id}}"{{$ca->id == $data->order_status ? 'selected' : ''}} >{{$ca->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ $data->description }}">{{ $data->description }}</textarea>

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
