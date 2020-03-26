@extends('system-mgmt.path.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Path</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('path.update', ['id' => $data->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Path Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required autofocus>

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
                                  <option value="{{$st->id}}"{{$st->id == $data->from_stage ? 'selected' : ''}}  >{{$st->name}}</option>
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
                                  <option value="{{$st->id}}"{{$st->id == $data->to_stage ? 'selected' : ''}} >{{$st->name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('path_connection') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Path Connection</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="path_connection">

                              <option value="" >-select</option>
                              <option value="0"{{0 == $data->path_connection ? 'selected' : ''}} >0</option>
                              <option value="1"{{1 == $data->path_connection ? 'selected' : ''}} >1</option>



                          </select>

                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('path_priority') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Path Connection</label>
                        <div class="col-md-6">
                          <select class=" form-control department" name="path_priority">

                              <option value="" >-select-</option>
                              <option value="1"{{1 == $data->path_priority ? 'selected' : ''}} >1</option>
                              <option value="2"{{2 == $data->path_priority ? 'selected' : ''}} >2</option>
                              <option value="3"{{3 == $data->path_priority ? 'selected' : ''}} >3</option>
                              <option value="4"{{4 == $data->path_priority ? 'selected' : ''}} >4</option>
                              <option value="5"{{5 == $data->path_priority ? 'selected' : ''}} >5</option>



                          </select>

                        </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" value="{{ $data->description }}"  >{{ $data->description }}</textarea>

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
