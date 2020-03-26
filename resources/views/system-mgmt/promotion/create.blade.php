@extends('system-mgmt.promotion.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Promotion</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('promotion.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label"> Promotion Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('percent_promotion') ? ' has-error' : '' }}">
                            <label for="percent_promotion" class="col-md-4 control-label"> %Promotion </label>

                            <div class="col-md-6">
                                  <div class="input-group date">
                                <input id="percent_promotion" type="text" class="form-control" name="percent_promotion" value="{{ old('percent_promotion') }}" required autofocus>
                                <div class="input-group-addon">
                                    %
                                </div>
                              </div>

                                @if ($errors->has('percent_promotion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('percent_promotion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('valid_from') ? ' has-error' : '' }}">
                            <label for="valid_from" class="col-md-4 control-label">Valid From</label>

                            <div class="col-md-6">
                              <input id="valid_from" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy" type="text"  name="valid_from" value="{{ old('valid_from') }}" required autofocus>

                                @if ($errors->has('valid_from'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valid_from') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('valid_to') ? ' has-error' : '' }}">
                            <label for="valid_to" class="col-md-4 control-label"> Valid To</label>

                            <div class="col-md-6">
                              <input id="valid_to" class="form-control" data-provide="datepicker" data-date-format="dd/mm/yyyy" type="text"  name="valid_to" value="{{ old('valid_to') }}" required autofocus>

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
@endsection
