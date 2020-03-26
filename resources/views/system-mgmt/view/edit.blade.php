@extends('system-mgmt.view.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update view</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('view.update', ['id' => $view->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">



                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">view Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $view->name }}" required autofocus>

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
                                <input id="view_url" type="text" class="form-control" name="view_url" value="{{ $view->view_url }}" required autofocus>

                                @if ($errors->has('view_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('view_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						                        <div class="form-group{{ $errors->has('sub_node') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">sub_node</label>
                            <div class="col-md-6">
                                <select class="form-control" name="sub_node">
                                    <option>{{$view->sub_node}}</option>
                                    <option value ="Yes">Yes</option>
                                    <option value ="No">No</option>
                                </select>
                                 @if ($errors->has('sub_node'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_node') }}</strong>
                                    </span>
                                @endif
                            </div>
						</div>








                                                <div class="form-group">
                                                                  <label class="col-md-4 control-label">Belong to</label>
                                                                  <div class="col-md-6">
                                                                    <select class="form-control par" name="belong_to"  id="">
                                                                      <option></option>
                                                                      @foreach($views as $person)
                                                                      <option value="{{$person->id}}" {{$person->id == $view->belong_to ? 'selected' : ''}}>{{$person->name}}</option>
                                                                      @endforeach
                                                                    </select>
                                                                  </div>
                                                              </div>



                                                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Level</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="level">
                                                <option>{{$view->level}}</option>
                                                <option value ="1">1</option>
                                                <option value ="2">2</option>
                                                <option value ="3">3</option>
                                                <option value ="4">4</option>
                                                <option value ="5">5</option>
                                            </select>
                                             @if ($errors->has('sub_node'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('level') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                        </div>

                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Index</label>

                            <div class="col-md-6">
                                <input id="priority" type="text" class="form-control" name="priority" value="{{$view->priority}}" >

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
                    		<input type="checkbox" {{  $view->add_to_side =="Yes" ? 'checked' : '' }} name="add_to_side" value="Yes"> Add this view to side bar menu<br>
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
