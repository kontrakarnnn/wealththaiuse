@extends('system-mgmt.view-partner.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new view partner</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('viewpartner.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">View Partner Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('view_url') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">view_url</label>

                            <div class="col-md-6">
                                <input id="view_url" type="text" class="form-control" name="view_url" value="{{ old('view_url') }}" required autofocus>

                                @if ($errors->has('view_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('view_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                            <div class="form-group">

                              <label class="col-md-4 control-label">Belong to</label>
                              <div class="col-md-6">
                              <select class="form-control  name" name="belong_to">
                                <option value="" >-Select-</option>
                                @foreach ($views as $view)
                                  <option value={{$view->id}} >{{$view->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            </div>
						<div class="form-group">

                              <label class="col-md-4 control-label">Sub Node</label>
                              <div class="col-md-6">
                              <select class="form-control  name" name="sub_node">
                                <option value="" >-Select-</option>
								  <option value="Yes" >Yes</option>
								  <option value="No" >No</option>

                              </select>
                            </div>
                            </div>
                            <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Index</label>

                                <div class="col-md-6">
                                    <input id="priority" type="text" class="form-control" name="priority" value="{{ old('priority') }}" >

                                    @if ($errors->has('priority'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('priority') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
						<div class="form-group">

                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-6">
                    		<input type="checkbox"  name="add_to_side" value="Yes"> Add this view to sidebar menu<br>
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
