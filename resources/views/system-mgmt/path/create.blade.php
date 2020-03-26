@extends('system-mgmt.path.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Path</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('path.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Path Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('from_stage') ? ' has-error' : '' }}">
                            <label for="from_stage" class="col-md-4 control-label">From Stage</label>

                            <div class="col-md-6">
                              <select class="form-control  " name="from_stage">
                                  <option value="" >-select-</option>
                                  @foreach($stage as $st)
                                  <option value="{{$st->id}}" >{{$st->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('to_stage') ? ' has-error' : '' }}">
                            <label for="to_stage" class="col-md-4 control-label">To Stage</label>

                            <div class="col-md-6">
                              <select class="form-control  " name="to_stage">
                                  <option value="" >-select-</option>
                                  @foreach($stage as $st)
                                  <option value="{{$st->id}}" >{{$st->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('path_connection') ? ' has-error' : '' }}">
                            <label for="path_connection" class="col-md-4 control-label">Path Connection</label>

                            <div class="col-md-6">
                              <select class="form-control  " name="path_connection">
                                  <option value="" >-select-</option>
                                  <option value="0" >0</option>
                                  <option value="1" >1</option>

                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('path_priority') ? ' has-error' : '' }}">
                            <label for="path_priority" class="col-md-4 control-label">Path Priority</label>

                            <div class="col-md-6">
                              <select class="form-control  " name="path_priority">
                                  <option value="" >-select-</option>
                                  <option value="1" >1</option>
                                  <option value="1" >2</option>
                                  <option value="1" >3</option>
                                  <option value="1" >4</option>
                                  <option value="1" >5</option>
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
