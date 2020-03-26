@extends('system-mgmt.stage.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Stage</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('stage.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label"> Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('process_id') ? ' has-error' : '' }}">
                            <label for="process_id" class="col-md-4 control-label">Process</label>

                            <div class="col-md-6">
                              <select class="form-control  name" name="process_id">
                                <option value="0" >-Select-</option>
                                @foreach ($process as $ca)
                                  <option value={{$ca->id}} >{{$ca->name}}</option>
                                @endforeach

                              </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('end_stage_flag') ? ' has-error' : '' }}">
                            <label for="end_stage_flag" class="col-md-4 control-label">End Stage Flag</label>

                            <div class="col-md-6">
                              <select class="form-control  " name="end_stage_flag">
                                  <option value="0" >0</option>
                                  <option value="1" >1</option>

                              </select>
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
